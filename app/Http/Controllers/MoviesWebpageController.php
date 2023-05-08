<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;


class MoviesWebpageController extends Controller
{
    /** 
     * Reads movies from DB and orders them depending on the user's input
     * @param $request from the navbar.blade.php form
     * @return EloquentCollection that contains the movies retrieved from the DB
     */
    public function readMovies(Request $request){
        # Checks if the method was post from the form
        if ($request->isMethod('post')) {
            $order = $request->order;
            $type = $request->type;
            # Order items by title/rate and by type if was selected in the form
            if($order !== "noOption"){
                # Orders by title
                if(strpos($order, "Title")){
                    $order = str_replace("Title","", $order);
                    $movies = Movie::orderBy('title', $order)->get();                    
                } else {
                    $order = str_replace("Rate","", $order);
                    # Calculates average and order movies by it
                    $movies = DB::table('movies')
                    ->select('*', DB::raw('sum_rates / total_rates AS avg_rating'))
                    ->where('total_rates', '>', 0)
                    ->orderBy(DB::raw('sum_rates / total_rates'), $order)
                    ->get();
                }
               # Checks if type was filled
                if($type !== "noOption"){
                    # Filters by type
                    $movies = $movies->filter(function ($movie) use ($type) {
                        return $movie->type === $type;
                    });    
                } 
            } else if($type !== "noOption"){
                $movies = Movie::where('type', $type)->get();
            } else {
                $movies = Movie::all();
            }
                
            # Returns the view movieswebpage ordered and send the key movies with the $movies found
            return view('movieswebpage', ['movies'=>$movies]);
        } 
        # If there was a GET, the movies will show normally without filters      
        # Founds all movies
        $movies = Movie::all();
        # Returns the view movieswebpage and send the key movies with the $movies found
        return view('movieswebpage', ['movies'=>$movies]);
    }

    /**
     * Updates the rate of the Movie which should be given by a user in the movieslist
     * @param $request from the movieswebpage.blade.php by submiting the button to rate a movie
     * @return redirect for the view of movieswebpage after saving the rate
     */
    public function rateMovie($title, Request $request){
        # Validates that the label mimimum requires will sufy
        $request->validate([
            'rate' => 'required|numeric|min:1|max:5'
        ]);


        $movie = Movie::where('title', $title)->first();
        
        $movie["total_rates"] = $movie["total_rates"] + 1;
        $movie["sum_rates"] = $movie["sum_rates"] + $request->rate;

        $movie->save();
        return redirect()->route('movieslist')->with('success', 'Saved rate');
    }

    public function deleteMovie($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movieslist')->with('success', 'Deleted');
    }
    /*
    public function updateMovie(Request $request){
        

        $request->validate([
            'title' => 'required|min:3',
            'year' => 'numeric',
            'image' => 'string'
        ]);

        # Create a Movie Object instance
        $movie = new Movie;
        $movie->title = $request->title;

        $movie->
    }
    */
}
