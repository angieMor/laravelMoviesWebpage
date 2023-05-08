<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringhandlingController extends Controller
{
    public function showReduceStringView(){
        return view('reducestring');
    }

    public function reduceString(Request $request){
        
        $input = $request->string;
        $stack = [];

        for ($i = 0; $i < strlen($input); $i++) {
            $currentChar = $input[$i];

            if (empty($stack) || end($stack) !== $currentChar) {
                array_push($stack, $currentChar);
            } else {
                array_pop($stack);
            }
        }

        if (empty($stack)) {
            $string = "Empty String";
            
        } else {
            $string = implode("", $stack);
        }
        
        return view('reducestring', ['string' => $string]);
    }
}
