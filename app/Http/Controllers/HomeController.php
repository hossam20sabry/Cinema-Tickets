<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Kind;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use app\Models\User;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){
        $explores = Movie::where('explore' , '=' , '1')->get();
        $theaters = Theater::all();
        $kinds = Kind::all();
        return view('home.userPage', compact('explores', 'kinds', 'theaters'));
    }
    public function redirect(){
        $user_type = Auth::user()->user_type;
        if($user_type == '1'){

            $startDate = Carbon::now()->startOfDay();
            $endDate = Carbon::now()->endOfDay();
            $totalPrice = Booking::whereBetween('created_at', [$startDate, $endDate])->sum('total_price');
            
            $startDateWeek = Carbon::now()->startOfWeek();
            $endDateWeek = Carbon::now()->endOfWeek();
            $totalPriceWeek = Booking::whereBetween('created_at', [$startDateWeek, $endDateWeek])->sum('total_price');

            $startDateMonth = Carbon::now()->startOfMonth();
            $endDateMonth = Carbon::now()->endOfMonth();
            $totalPriceMonth = Booking::whereBetween('created_at', [$startDateMonth, $endDateMonth])->sum('total_price');

            $movies = Movie::all();
            $movies_count =  count($movies);

            $theaters = Theater::all();
            $theaters_count =  count($theaters);

            return view('admin.dashboard', compact('totalPrice', 'totalPriceWeek', 'movies_count', 'theaters_count', 'totalPriceMonth'));
        }
        else{
            $explores = Movie::where('explore' , '=' , '1')->get();
            $theaters = Theater::all();
            $kinds = Kind::all();
            return view('home.userPage', compact('explores', 'kinds', 'theaters'));
        }
    }

    public function search(Request $request){
        $kinds = Kind::all();
        $text = $request->search;
        $movies = Movie::where('name', 'LIKE' , "%$text%")->paginate(6);
        $theaters = Theater::where('name', 'LIKE' , "%$text%")->orWhere('city', 'LIKE' , "%$text%")->paginate(6);
        // $theaters_addresses = Theater::where('city', 'LIKE' , "%$text%")orWhere()->paginate(6);
        return view('home.search', compact('movies', 'kinds', 'theaters'));
    }

    public function autoComlete(Request $request){
        $movies = Movie::select('name')
                        ->where('name', 'LIKE' , "%{$request->terms}%")
                        ->get();
        return response()->json($movies);                
    }
}
