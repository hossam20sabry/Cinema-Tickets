<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\movie_Theater;
use App\Models\Kind;
use Illuminate\Support\Facades\Auth;


class TheatersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kinds = Kind::all();
        $theaters = Theater::all();
        if(Auth::id()){
            if(Auth::user()->user_type == '1'){
                return view('admin.theaters.index', compact('theaters'));
            }
            else{
                return view('home.theaters.index', compact('theaters', 'kinds'));
            } 
        }
        return view('home.theaters.index', compact('theaters', 'kinds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.theaters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $theater = new Theater;

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'email' => 'required | email',
            'img' => 'required',
            'wide_img' => 'required',

        ],[
            'name.required' => 'Please Write Name.',
            'location.required' => 'The location is required.',
            'city.required' => 'The city is required.',
            'phone.required' => 'The phone is required.',
            'email.email' => 'must be email.',
            'img.required' => 'The img is required.',
            'wide_img.required' => 'The wide_img is required.',
        ]);

        $theater->name = $request->name;
        $theater->location = $request->location;
        $theater->city = $request->city;
        $theater->phone = $request->phone;
        $theater->email = $request->email;

        // $moviesIds = [3, 13];
        // $new_moviesIds = implode(',', $moviesIds);
        // $theater->movie_id = $new_moviesIds;

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $img_name = time().'.'. $img->getClientOriginalExtension();
            $img->move('cinema_photos', $img_name);
            $theater->img = $img_name;
        }else {
            // Set a default placeholder URL if no file is uploaded
            $theater->img = 'default_placeholder.jpg'; // Replace with your actual default URL
        }

        if ($request->hasFile('wide_img')) {
            $wide_img = $request->file('wide_img');
            $img_name = time().'.'. $wide_img->getClientOriginalExtension();
            $wide_img->move('wide_img_cinema_photos', $img_name);
            $theater->wide_img = $img_name;
        }else {
            // Set a default placeholder URL if no file is uploaded
            $theater->wide_img = 'default_placeholder.jpg'; // Replace with your actual default URL
        }

        $theater->save();

        return redirect()->back()->with('message', 'Theater Created Successfuly');

    }

    
    public function show(string $id)
    {
        $theater = Theater::findOrfail($id);
        // $movies_theaters = Movies_Theaters::where('theater_id', '=', $theater->id)->get();
        $kinds = Kind::all();
        $movies =  $theater->movies;
        return view('home.theaters.show', compact('movies', 'theater', 'kinds'));
    }

    
    public function edit(string $id)
    {
        $theater = Theater::findOrfail($id);
        return view('admin.theaters.edit', compact('theater'));
    }

    
    public function update(Request $request, string $id)
    {
        $theater = Theater::findOrfail($id);
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'screens_count' =>  ['required','integer'],
            'city' => 'required',
            'phone' => 'required',
            'email' => 'required | email',
            'img' => 'required',
            'wide_img' => 'required',

        ],[
            'name.required' => 'Please Write Name.',
            'location.required' => 'The location is required.',
            'screens_count.required' => 'how many screens.',
            'city.required' => 'The city is required.',
            'phone.required' => 'The phone is required.',
            'email.email' => 'must be email.',
            'img.required' => 'The img is required.',
            'wide_img.required' => 'The wide_img is required.',
        ]);

        

        // theater table only
        $theater->name = $request->name;
        $theater->location = $request->location;
        $theater->screens_count = $request->screens_count;
        $theater->city = $request->city;
        $theater->phone = $request->phone;
        $theater->email = $request->email;

        $img = $request->file('img');
        if($img){
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $img->move('cinema_photos', $img_name);
            $theater->img = $img_name;
        }

        $wide_img = $request->file('wide_img');
        if($wide_img){
            $img_name = time().'.'. $wide_img->getClientOriginalExtension();
            $wide_img->move('wide_img_cinema_photos', $img_name);
            $theater->wide_img = $img_name;
        }

        

        $theater->save();

        return redirect()->back()->with('message', 'Theater updated successfuly');
    }

    
    public function destroy(string $id)
    {
        $theater = Theater::findOrFail($id);
        $theater->delete();
        return redirect()->back()->with('message', 'Theater deleted successfuly');
    }

    public function avilable_movies($id){
        $theater = Theater::find($id);
        $movies = Movie::all();
        $movies_theaters = movie_Theater::where('theater_id', $theater->id)->get();
        return view('admin.theaters.avilable_movies', compact('theater','movies','movies_theaters'));
    }

    public function theater_info($theater_id){
        $theater = Theater::find($theater_id);
        return view('admin.theaters.theater_info', compact('theater'));
    }

}
