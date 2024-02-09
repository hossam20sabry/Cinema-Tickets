<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Kind;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $explores = Movie::where('explore' , '1')->get();
        $theaters = Theater::paginate(3);
        $kinds = Kind::all();
        return view('home.index', compact('explores' , 'theaters' , 'kinds'));
    }
}
