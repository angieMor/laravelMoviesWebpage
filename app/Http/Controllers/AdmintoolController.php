<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Validation\ValidationException;

class AdmintoolController extends Controller
{
    public function showAdmintoolForSave(){
        return view('adminmoviestool');
    }

    public function showAdmintoolForUpdate(){
        return view('admintoolupdate');
    }

    public function createMovie(Request $request){
        
        # Validates that all the labels are provided
        $request->validate([
            'title' => 'required|min:3',
            'year'  => 'required|numeric',
            'image' => 'required|string',
            'type'  => 'required|string'
        ]);
        
        # Create a Movie Object instance
        $movie = new Movie;
        
        # Filling out the movies object with the data provided via request
        $movie->title     = $request->title;
        $movie->year      = $request->year;
        $movie->image_url = $request->image;
        $movie->type      = $request->type;
        $movie->total_rates= 0;
        $movie->sum_rates=0;

        # Save the movie object
        $movie->save();
        
        # Redirects user to the route given with a message
        return redirect()->route('admintool')->with('success', 'Saved succesfully');
    }

    public function updateMovie(Request $request){
        $title = $request->title;

        try {
            $movieFound = Movie::where('title', $title)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'La película no se encuentra en la base de datos.']);
        }
        
        $movieFound->year = $request->year;
        $movieFound->image_url = $request->image;
        $movieFound->type = $request->type;

        $movieFound->save();

        return redirect()->route('admintool')->with('success', 'Update succesfull');
    }
}
