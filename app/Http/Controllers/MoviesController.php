<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Explore;
use App\Models\Kind;
use App\Models\Category;
use App\Models\Theaters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kinds = Kind::all();
        // $movies = Movie::all();
        $movies = Movie::orderBy('movie_renevues', 'desc')->get();
        if(Auth::id()){
            if(Auth::user()->user_type == '1'){
                return view('admin.movies.index', compact('movies'));
            }
            else{
                return view('home.movies.index', compact('kinds', 'movies'));
            }  
        }
        return view('home.movies.index', compact('kinds', 'movies'));
    }

    public function top_movies(){
        $kinds = Kind::all();
        $movies = Movie::orderBy('movie_renevues', 'desc')->get();
        return view('home.movies.top5', compact('movies', 'kinds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kinds = Kind::all();
        $categories = Category::all();
        return view('admin.movies.create', compact('kinds', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rating' => 'required|numeric|between:1,10',
            'kind' =>  'required',
            'release_date' => 'required|date',
            'category' => 'required',
            'duration' => 'required',
            'lang' => 'required',
            'director' => 'required|string',
            'poster_url' => 'required',
            'photo_url' => 'required',
            // 'trailer_url' => 'required',

        ],[
            'name.required' => 'Please Write Name.',
            'rating.required' => 'The movie rating is required.',
            'rating.numeric' => 'The movie rating must be a number.',
            'rating.between' => 'The movie rating must be between 1 and 10.',
            'kind.required' => 'The movie kind is required.',
            'category.required' => 'The movie category is required.',
            'duration.required' => 'The movie duration is required.',
            'poster_url.required' => 'The movie poster_url is required.',
            'photo_url.required' => 'The movie photo_url is required.',
            // 'trailer_url.required' => 'The movie trailer_url is required.',
            'lang.required' => 'The movie language is required.',
            'director.required' => 'The movie director is required.',
        ]);

        $movies = new Movie();
        $movies->name = $request->name;
        $movies->rating = $request->rating;
        $movies->release_date = $request->release_date;
        $movies->duration = $request->duration;
        $movies->lang = $request->lang;
        $movies->director = $request->director;
        $movies->category_id = $request->category;



        $poster = $request->file('poster_url');
        $poster_name = time() . '.' . $poster->getClientOriginalExtension();
        $poster->move('posters', $poster_name);
        $movies->poster_url = $poster_name;

        $photo = $request->file('photo_url');
        $photo_name = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move('photos', $photo_name);
        $movies->photo_url = $photo_name;

        $trailer = $request->file('trailer_url');
        if(isset($trailer)){
        $trailer_name = time() . '.' . $trailer->getClientOriginalExtension();
        $trailer->move('trailers', $trailer_name);
        $movies->trailer_url = $trailer_name;
        }
        else{
            $movies->trailer_url = 'default';
        }
        $movies->save();

        // start saving kinds
        $selectedKins = $request->kind; 
        // save for many to many movie_kinds
        $movies->kinds()->syncWithoutDetaching($selectedKins);
        // end saving kinds

        

        if(isset($movies)){
            return response()->json([
                'status' => true,
                'message' => 'movie is created successfuly',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'there is some error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all();
        $kinds = Kind::all();
        return view('admin.movies.edit', compact('movie', 'categories', 'kinds'));
    }

    

    public function update_movie(Request $request){
        // return $request;
        $request->validate([
            'name' => 'required',
            'rating' => 'required|numeric|between:1,10',
            'kind' =>  'required',
            'release_date' => 'required|date',
            'category' => 'required',
            'duration' => 'required',
            'lang' => 'required',
            'director' => 'required|string',
        ],[
            'name.required' => 'Please Write Name.',
            'rating.required' => 'The movie rating is required.',
            'rating.numeric' => 'The movie rating must be a number.',
            'rating.between' => 'The movie rating must be between 1 and 10.',
            'kind.required' => 'The movie kind is required.',
            'category.required' => 'The movie category is required.',
            'duration.required' => 'The movie duration is required.',
            'lang.required' => 'The movie language is required.',
            'director.required' => 'The movie director is required.',
        ]);

        $movie = Movie::find($request->movie_id);
        $movie->name = $request->name;
        $movie->rating = $request->rating;
        $movie->release_date = $request->release_date;
        $movie->duration = $request->duration;
        $movie->lang = $request->lang;
        $movie->director = $request->director;
        $movie->category_id = $request->category;
        $selectedKins = $request->kind;
        $movie->kinds()->sync($selectedKins);

        $poster = $request->file('poster_url');
        if($poster) {
            $poster_name = time() . '.' . $poster->getClientOriginalExtension();
            $poster->move('posters', $poster_name);
            $movie->poster_url = $poster_name;
        }

        $photo = $request->file('photo_url');
        if($photo){
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('photos', $photo_name);
            $movie->photo_url = $photo_name;
        }

        $trailer = $request->file('trailer_url');
        if($trailer){
            $trailer_name = time() . '.' . $trailer->getClientOriginalExtension();
            $trailer->move('trailers', $trailer_name);
            $movie->trailer_url = $trailer_name;
        }


        $movie->save();
        
        if(isset($movie)){
            return response()->json([
                'status' => true,
                'message' => 'movie is updated successfuly',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'there is some error',
            ]);
        }
    }
    

    public function delete(Request $request){
        
        $movie = Movie::findOrFail($request->id);
        $movie->delete();
        
        if(isset($movie)){
            return response()->json([
                'status' => true,
                'message' => 'movie is deleted successfuly',
                'id' => $request->id,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'there is some error',
            ]);
        }
    }

    



    public function add_to_explore($id){
        $movie = Movie::findOrFail($id);
        $movie->explore = 1;
        $movie->save();
        return redirect()->back()->with('message', 'Movie added to explored  successfuly');
    }

    public function delete_explore($id){
        $movie = Movie::findOrFail($id);
        $movie->explore = 0;
        $movie->save();
        return redirect()->back()->with('message', 'Movie deleted from explore  successfuly');
    }

    
    
}
