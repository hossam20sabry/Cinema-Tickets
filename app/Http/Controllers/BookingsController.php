<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Kind;
use App\Models\Seat;
use App\Models\ShowTime;
use App\Models\Theater;
use App\Notifications\CinemaTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Stripe;


class BookingsController extends Controller
{
    public function index(){
        $kinds = Kind::all();
        $user = Auth::user();
        $bookings = $user->bookings->filter(function($booking){
            return $booking->booking_status == 'confirmed';
        });
        return view('home.bookings.index', compact('bookings', 'kinds'));
    }
    
    //phase 1
    public function store(Request $request){
        $booking = new Booking();
        $booking->user_id = Auth::user()->id;
        $booking->movie_id = $request->movie_id;
        $booking->save();
        if($request->theater_id){
            return redirect()->route('bookings.create', ['booking' => $booking->id, 'theater_id' => $request->theater_id]);
        }
        return redirect()->route('bookings.create', $booking->id);
    }

    public function create($booking_id, $theater_id = null){
        $kinds = Kind::all();
        $booking = Booking::find($booking_id);
        if(!$booking) return redirect()->route('bookings.redirect');
        $movie = Movie::findOrFail($booking->movie_id);
        $theaters = $movie->theaters;
        if($theater_id){
            $theater = Theater::findOrFail($theater_id);
            return view('home.bookings.create', compact('kinds', 'booking', 'movie', 'theater', 'theaters'));
        }
        return view('home.bookings.create', compact('kinds', 'booking', 'movie', 'theaters'));
    }

    public function theater(Request $request){
        $booking = Booking::find($request->booking_id);
        if(!$booking) return response()->json(['status' => 404]);

        $theater = Theater::findOrFail($request->theater_id);
        $show_times = $theater->showTimes->where('movie_id', $request->movie_id);
        return response()->json($show_times);
    }

    public function date(Request $request){
        $booking = Booking::find($request->booking_id);
        if(!$booking) return response()->json(['status' => 404]);

        $show_time = ShowTime::find($request->showtime_id);
        $movie_id = $request->movie_id;
        $theater_id = $show_time->theater_id;
        $date = $show_time->date;
        $theater = Theater::find($theater_id);
        $show_times = $theater->showTimes()
            ->where('movie_id', $movie_id)
            ->where('theater_id', $theater_id)
            ->where('date', $date)
            ->get();
        return response()->json($show_times);
    }

    public function time(Request $request){
        $booking = Booking::find($request->booking_id);
        if(!$booking) return response()->json(['status' => 404]);

        $show_time = ShowTime::find($request->showTime_id);
        $screens = $show_time->screens;
        return response()->json([
            'screens' => $screens,
            'show_time' => $show_time
        ]);
    }

    

    //phase 2
    public function store2(Request $request){
        $booking = Booking::find($request->booking_id);
        if(!$booking) return response()->json(['status' => 404]);

        $request->validate([
            'theater_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'screen_id' => 'required',
        ],[
            'theater_id.required' => 'please select cenima',
            'date.required' => 'please select date',
            'time.required' => 'please select time',
            'screen_id.required' => 'please select screen',
        ]);

        $booking->show_time_id = $request->time;
        $booking->screen_id = $request->screen_id;
        $booking->save();


        return response()->json([
            'status' => 200,
        ]);

    }

    public function seats($booking_id){
        $booking = Booking::find($booking_id);
        if(!$booking) return redirect()->route('bookings.redirect');

        return view('home.bookings.seats', compact('booking'));
    }

    public function select(Request $request){
        $booking = Booking::find($request->booking_id);
        if(!$booking) return response()->json(['status' => 404]);

        $selected_seats_size = $request->selected_seats_size;

        if($selected_seats_size > 5) {
            return response()->json([
                'status' => 400,
                'msg' => 'The maximum number of seats is 6.',
            ]);
        }

        $seat = Seat::find($request->seatId);
        $letter = $seat->row->letter;
        $booking = Booking::find($request->booking_id);

        // if(!$booking) return redirect()->back()->with('error', 'Your Booking is not found');
        $showTime = $booking->ShowTime;
        $hisBookings = $seat->bookings()->where('show_time_id', $showTime->id)->first();

        if(!$hisBookings){
            $booking->seats()->syncWithoutDetaching($seat->id);
            $booking->total_price += $seat->price;
            $booking->save();

            return response()->json([
                'status' => 200,
                'seat_id' => $seat->id,
            ]);
        }
        else
        {
            return response()->json([
                'status' => 401, 
                'seat_id' => $seat->id,
                'msg' => "Seat [$letter$seat->number] is no longer available.",
            ]);
        }

        // if something goes wrong
        return response()->json([
            'seat_id' => $seat->id,
        ]);
    }

    public function unSelect(Request $request){
        $booking = Booking::find($request->booking_id);
        if(!$booking) return response()->json(['status' => 404]);

        $seat = Seat::find($request->seatId);
        $letter = $seat->row->letter;
        $showTime = $booking->showTime;
        $hisBookings = $seat->bookings()->where('show_time_id', $showTime->id)->first();
        if($hisBookings){
            $booking->seats()->detach($seat->id);
            $booking->total_price -= $seat->price;
            $booking->save();
            return response()->json([
                'status' => 200,
                'seat_id' => $seat->id,
            ]);
        }
    }

    public function storeSeats(Request $request){
        
        $user = Auth::user();
        $kinds = Kind::all();
        $booking = Booking::find($request->booking_id);


        if(!$booking) return redirect()->route('bookings.redirect');

        
        $selectedSeats = explode(',', $request->input('selected_seats'));

        if(count($selectedSeats) > 6) return redirect()->back()->with('error', 'The maximum number of seats is 6.');


        if(count($selectedSeats) > 0){
            $booking->total_seats = count($selectedSeats);
            $booking->total_price = $booking->total_price + 10;
            $booking->booking_status = 'reserved';
            $booking->save();
            return redirect()->route('bookings.confirm', $booking->id);
        }
        else
        {
            return redirect()->back()->with('error', 'Please Select Seat');
        } 
    }

    public function confirm($booking_id){
        $booking = Booking::find($booking_id);
        if(!$booking) return redirect()->route('bookings.redirect');
        $kinds = Kind::all();
        return view('home.bookings.confirm', compact('booking', 'kinds'));
    }

    public function thanks(){
        $kinds = Kind::all();
        return view('home.bookings.thanks', compact('kinds'));
    }

    public function destroy(Request $request){
        $booking = Booking::find($request->booking_id);
        if(!$booking) return redirect()->route('bookings.redirect');
        $booking->delete();
        return redirect('/');
    }

    public function show($booking_id){
        $booking = Booking::find($booking_id);
        $kinds = Kind::all();

        $details = [
            'greeting' => 'Welcome to Cinema Tickets',
            'firstline' => 'Good Day',
            'secondtline' => 'This is your Booking Code: ' . $booking->QRcode,
            'button' => 'Cinema Tickets',
            'url' => route('index'),
            'lastline' => 'Thank you',
        ];

        $user = Auth::user();

        try {
            Notification::send($user , new CinemaTickets($details));
        } 
        catch (\Exception $e) {
            return view('home.bookings.show')->with([
                'booking' => $booking,
                'kinds' => $kinds,
                'error' => 'Something went wrong with email sending, check your Bookings to get your booking code',
            ]);
        }

        return view('home.bookings.show', compact('booking', 'kinds'));
    }

    public function redirect(){
        return redirect()->route('index')->with('error', 'Your Booking Time is finished, Please try again');
    }

}
