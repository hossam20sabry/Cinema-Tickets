<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kind;

class KindController extends Controller
{
    public function index(){
        $kinds = Kind::all();
        return view('admin.kinds.index', compact('kinds'));
    }

    public function create(){
        return view('admin.kinds.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
        ]);

        $kind = new Kind();
        $kind->title = $request->title;
        $kind->save();

        return response()->json([
            'status' => true
        ]);
    }

    public function edit($id){
        $kind = Kind::find($id);
        return view('admin.kinds.edit', compact('kind'));
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
        ]);

        $kind = Kind::find($request->kind_id);
        $kind->title = $request->title;
        $kind->save();

        return response()->json([
            'status' => true
        ]);
    }

    public function destroy(Request $request){
        $kind = Kind::find($request->kind_id);
        $kind->delete();

        return response()->json([
            'status' => true,
            'kind_id'=> $request->kind_id
        ]);
        
    }

    public function movies($id){
        $kind = Kind::find($id);
        return view('admin.kinds.movies', compact('kind'));
    }

    public function show($id){
        $kind = Kind::find($id);
        $kinds = Kind::all();
        $movies = $kind->movies;
        return view('home.kind_show', compact('movies', 'kinds', 'kind'));
    }
}
