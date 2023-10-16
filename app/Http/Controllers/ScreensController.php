<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Theater;
use App\Models\Screen;
use App\Models\Section;
use App\Models\Row;
use App\Models\Seat;
use App\Models\ShowTime;

class ScreensController extends Controller
{
    public function create($theater_id){
        $theater = Theater::find($theater_id);
        return view('admin.screens.create', compact('theater_id', 'theater'));
    }

    public function store(Request $request){
        $screen = new Screen();
        $request->validate([
            'screen_number' => 'required',
            'total_rows' => 'required|integer|min:1',
            'total_columns' => 'required|integer|min:1',
            'seat_price' => 'required|integer|min:1',
        ],
        [
            'screen_number.required' => 'Screen Number is required',
            'total_rows.required' => 'Screen Number is required',
            'total_rows.min:1' => 'at least 1 rows',
            'total_columns.required' => 'Screen Number is required',
            'total_columns.min:1' => 'at least 1 columns',
            'seat_price.required' => 'Screen Number is required',
            'seat_price.min:1' => 'at least 1 seat price',
        ]);
        $theater = Theater::find($request->theater_id);
        $screen_name = $theater->name . ' - screen ' . $request->screen_number;
        $existingScreen = $theater->screens()->where('screen_number', $screen_name)->first();
        if ($existingScreen) {
            return redirect()->back()->with('error', 'A screen with the same name already exists in this theater.');
        }
        $screen->theater_id = $request->theater_id;
        $screen->screen_number = $screen_name;
        $screen->total_rows = $request->total_rows;
        $screen->total_columns = $request->total_columns;
        $screen->save();

        for($i = 1, $letter = 'A'; $i <= $screen->total_rows; $i++, $letter++){
            $row = new Row();
            $row->screen_id = $screen->id;
            $row->letter = $letter;
            $row->seats_count = $screen->total_columns;
            $row->save();

            if($i % 2 != 0){
                $count = 1;
            }
            else{
                $count = $screen->total_columns + 1;
            }
            
            for($j = 1; $j <= $screen->total_columns; $j++){
                $seat = new Seat();
                $seat->row_id = $row->id;
                $seat->number = $count;
                $seat->price = $request->seat_price;
                $seat->save();
                $count++;
            }
        }

        return redirect()->back()->with('message', 'Screen Created Successfully');
    }



    public function index($theater_id){
        $theater = Theater::find($theater_id);
        $screens = $theater->screens;
        return view('admin.theaters.avilable_screens', compact('screens', 'theater'));
    }

    public function show($screen_id){
        $screen = Screen::find($screen_id);
        $theater = $screen->theater;
        return view('admin.screens.show', compact('theater', 'screen'));
    }

    public function edit($screen_id){
        $screen = Screen::find($screen_id);
        $seat_price = $screen->seats->first()->price;
        return view('admin.screens.edit', compact('screen', 'seat_price'));
        
    }

    public function update(Request $request, $screen_id){
        $screen = Screen::find($screen_id);
        $request->validate([
            'screen_number' => 'required|integer|min:1',
            'seat_price' => 'required|integer|min:1',
        ],
        [
            'screen_number.required' => 'Screen Number is required',
            'screen_number.min:1' => 'at least 1 Screen',
            'seat_price.required' => 'Screen Number is required',
            'seat_price.min:1' => 'at least 1 seat price',
        ]);
        $screen->screen_number = $request->screen_number;
        foreach($screen->seats as $seat){
            $seat->price = $request->seat_price;
            $seat->save();
        }
        $screen->save();
        return redirect()->back()->with('message', 'Screen Updated Successfully');
    }

    public function destroy($screen_id){
        $screen = Screen::find($screen_id);
        $screen->delete();
        return redirect()->back()->with('message', 'Screen Deleted Successfully');
    }


    public function fake_seat(Request $request, $screen_id){
        $selectedseats = $request->input('seatsIds');
        if($selectedseats == null){
            return redirect()->back()->with('message', 'No seats selected.');
        }
        $screen = Screen::find($screen_id);
        $seats = $screen->seats;
        foreach($selectedseats as $selectedseat){
            foreach($seats as $seat){
                if($seat->id == $selectedseat){
                    $seat->apearance = 1;
                    $seat->save();
                }
            }
        }
        // dd($selectedseats);
        return redirect()->back()->with('message', 'Seats deleted successfully.');
    }

    public function real_seat($seat_id){
        $seat = Seat::find($seat_id);
        $screen = $seat->row->screen;
        $seats_screen = $screen->seats;
            foreach($seats_screen as $seats_screen){
                if($seats_screen->id == $seat->id){
                    $seats_screen->apearance = 0;
                    $seats_screen->save();
                }
            }
        // dd($selectedseats);
        return redirect()->back()->with('message', 'Seats deleted successfully.');
    }
    
}
