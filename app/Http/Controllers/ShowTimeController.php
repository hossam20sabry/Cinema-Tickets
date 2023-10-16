<?php

namespace App\Http\Controllers;

use App\Models\date;
use Illuminate\Http\Request;
use App\Models\Theater;
use App\Models\Screen;
use App\Models\Movie;
use App\Models\ShowTime;
use App\Models\Seat;

class ShowTimeController extends Controller
{
    public function create($movie_id, $theater_id){
        $theater = Theater::find($theater_id);
        $movie = Movie::find($movie_id);
        return view('admin.showtimes.create', compact('theater', 'movie'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theater_id' => 'required',
            'screens' => 'required',
            'movie_id' => 'required',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ], [
            'theater_id.required' => 'The theater id is required.',
            'screens.required' => 'The screen id is required.',
            'movie_id.required' => 'The movie id is required.',
            'date.required' => 'The date is required.',
            'start_time.required' => 'The start time is required.',
            'end_time.required' => 'The end time is required.',
        ]);

        $startTime = $request->date . ' ' . $request->start_time;
        $endTime = $request->date . ' ' . $request->end_time;

        // Check for overlapping showtimes
        $overlapShowtime = ShowTime::where('show_times.theater_id', $request->theater_id)
        ->where('show_times.date', $request->date)
        ->whereHas('screens', function ($query) use ($request) {
            $query->whereIn('screens.id', $request->screens);
        })
        ->where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->where('show_times.start_time', '<', $startTime)
                    ->where('show_times.end_time', '>', $startTime);
            })
            ->orWhere(function ($q) use ($startTime, $endTime) {
                $q->where('show_times.start_time', '<', $endTime)
                    ->where('show_times.end_time', '>', $endTime);
            })
            ->orWhere(function ($q) use ($startTime, $endTime) {
                $q->where('show_times.start_time', '>=', $startTime)
                    ->where('show_times.end_time', '<=', $endTime);
            });
        })
        ->first();


        if ($overlapShowtime) {
            return response()->json([
                'status' => false,
                'message' => 'There is an overlapping showtime for the same screen and date.',
            ]);
        }

        // Create and save the new showtime
        $showTime = new ShowTime();
        $showTime->movie_id = $request->movie_id;
        $showTime->theater_id = $request->theater_id;
        $showTime->date = $request->date;
        $showTime->start_time = $request->start_time;
        $showTime->end_time = $request->end_time;
        $showTime->save();
        $showTime->screens()->syncWithoutDetaching($request->screens);

        return response()->json([
            'status' => true,
            'message' => 'Showtime created successfully.',
        ]);
    }


    public function show($movie_id ,$theater_id){
        $theater = Theater::find($theater_id);
        $movie = Movie::find($movie_id);
        // $thisTheaterShowTimes = $theater->showTimes;
        $showTimes = ShowTime::where('movie_id', $movie_id)->where('theater_id', $theater_id)->get();
        return view('admin.showtimes.show', compact('theater', 'showTimes', 'movie'));
    }

    public function edit($showTime_id){
        $showTime = ShowTime::find($showTime_id);
        return view('admin.showtimes.edit', compact('showTime'));
    }

    public function update(Request $request){
        $showTime = ShowTime::find($request->showTime_id);
        $showTime->screens()->sync($request->screens);
        $showTime->date = $request->date;
        $showTime->start_time = $request->start_time;
        $showTime->end_time = $request->end_time;
        $showTime->save();
        if(isset($showTime)){
            return response()->json([
                'status' => true,
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function destroy(Request $request){
        $showTime_id = ShowTime::find($request->showTime_id);
        $showTime_id->delete();
        if(isset($showTime_id)){
            return response()->json([
                'status' => true,
                'showTime_id' => $request->showTime_id,
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
