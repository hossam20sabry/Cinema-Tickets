<?php

namespace App\Http\Controllers;
use App\Models\Kind;
use App\Models\Theater;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    public function index(){
        $theaters = Theater::all();
        $kinds = Kind::all();
        return response()->view('home.theaters.index' , compact('theaters' , 'kinds'));
    }

    public function show($id){
        $theater = Theater::find($id);
        $kinds = Kind::all();
        return response()->view('home.theaters.show' , compact('theater' , 'kinds'));
    }

    public function search(Request $request){
        $search = $request->input('search');
        $theaters = Theater::where('name' , 'like' , "%$search%")->get();
        $kinds = Kind::all();
        return response()->view('home.theaters.index' , compact('theaters' , 'kinds'));
    }
}
