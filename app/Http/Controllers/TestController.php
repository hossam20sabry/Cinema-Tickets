<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Screen;
use App\Models\Section;
use App\Models\Row;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\ShowTime;
use App\Models\movie_theaters;
use BaconQrCode\Renderer\Path\Move;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function get_full_namespace(){
        $sessionNamespace = get_class(app('session'));
        return $sessionNamespace;
    }
    public function show_theater_screens(){
        $theater = Theater::with('screens')->find(1);
        return $theater;
    }
    public function show_screens_sections(){
        $screen = Screen::with('sections')->find(1);
        return $screen;
    }
    public function show_theater_sections(){
        $theater = Theater::with('sections')->find(1);
        return $theater;
    }
    public function show_section_rows(){
        $section = Section::with('rows')->find(1);
        return $section;
    }
    public function show_row_seats(){
        $row = Row::with('seats')->find(1);
        return $row;
    }
    public function show_screens_rows(){
        $screen = Screen::with('rows')->find(1);
        return $screen;
    }
    public function show_section_seats(){
        $section = Section::with('seats')->find(1);
        return $section;
    }
    public function show_theater_rows(){
        $theater = Theater::with('rows')->find(1);
        return $theater;
    }

    public function show_section_theater(){
        $section = Section::with('theater')->find(1);
        return $section;
    }

    // public function show_screen_seats(){
    //     $screen = Screen::with('seats')->find(6);
    //     return $screen;
    // }

    public function show_screen_seats(){
        $screen = Screen::find(6);
        $screen = DB::table('seats')
        ->join('rows', 'seats.row_id', '=', 'rows.id')
        ->join('sections', 'rows.section_id', '=', 'sections.id')
        ->join('screens', 'sections.screen_id', '=', 'screens.id')
        ->where('screens.id', $screen->id) // Assuming $this->id is the ID of the Screen model
        ->select('seats.*')
        ->get();
        return $screen;
    }

    //ajax 

    public function add_data(){
        return view('home.ajax_test');
    }

    public function delete_movie(Request $request)
    {
        $movie = Movie::findOrFail($request->id);
        
        if(isset($movie)){
            return response()->json([
                'status' => true,
                'message' => 'movie is deleted successfuly',
                'data' => $request->id,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'there is some error',
            ]);
        }
        $movie->delete();
        
    }

    public function show_doctors(){
        $doctors = Doctor::all();
        return view('home.doctors', compact('doctors'));
    }
    public function delete_doctor(Request $request){
        $doctor = Doctor::findOrFail($request->id);
        $doctor->delete();
        if(isset($doctor)){
            return response()->json([
                'status' => true,
                'message' => 'doctor is deleted successfuly',
                'id' => $request->id,
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'there is some error',
            ]);
        }
        

        // return $request;
    }

    public function show_movie_showtimes(){
        $show_time = ShowTime::with('movie')->find(1);
        return $show_time;

        // $booking = Booking::with('user')->find(1);
        // return $booking;	
    }


    public function main( $screen = null, $section = null, $row = null, $seat = null){

        if(isset($screen)){
            if (isset($section)){
                if (isset($row)){
                    if (isset($seat)){
                        return 'seat';
                    }
                    return 'row';
                }
                return 'section';
            }
            return 'screen';
        }
        
        return 'theater';
    }


    public function qrCode(){
        $booking = Booking::where('QRcode', '6513f54760fb8')->first();
        return $booking;
        return view('home.doctors', compact('booking'));
    }

    public function total(){
        $movie = Movie::find(1);
        $movie->movie_renevues =+ 100;
        return $movie->movie_renevues;
    }
}

