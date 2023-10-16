<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required'
        ]);
        $category = new Category();
        $category->title = $request->title;
        $category->save();

        if($category){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required'
        ]);
        $category = Category::find($request->category_id);
        $category->title = $request->title;
        $category->save();

        if($category){
            return response()->json([
                'status' => true
            ]);
        }
    }

    public function destroy(Request $request){
        $category = Category::find($request->category_id);
        $category->delete();

        if($category){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function movies($id){
        $category = Category::find($id);
        return view('admin.categories.movies', ['category' => $category]);
    }
}
