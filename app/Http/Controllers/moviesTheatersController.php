<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\movie_Theater;
use Illuminate\Support\Facades\Auth;

class moviesTheatersController extends Controller
{
    public function add_avilable_movies(Request $request ,$id){
        $theater = Theater::find($id);
        $selectedMoviesIds = $request->input('movies_ids', []);
        // $new_selectedMoviesIds = implode(',', $selectedMoviesIds);
        $theater->movies()->syncWithoutDetaching($selectedMoviesIds);
        return redirect()->back();
    }

    public function delete_avilable_movies($id){
        $movies_theaters = movie_Theater::findOrFail($id);
        $movies_theaters->delete();
        return redirect()->back();
    }

    // test
    public function show_theater_movies(){
        $theater = Theater::find(1);
        return $theater->movies;
    }
}
