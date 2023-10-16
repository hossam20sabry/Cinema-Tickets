<?php

namespace App\Http\Controllers;
// use BaconQrCode\Encoder\QrCode;
// use BaconQrCode\Renderer\Image\Png;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Kind;
use App\Models\Screen;
use App\Models\Booking;
use App\Models\ShowTime;
use App\Models\User;
use App\Models\Seat;
use App\Jobs\CancelBookingJob;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BookingsController extends Controller
{
    public function new_booking($movie_id, $theater_id = null){
        if(Auth::id()){
            $movie = Movie::findOrFail($movie_id);
            $theaters = $movie->theaters;
            $kinds = Kind::all();
            if($theater_id){
                $theater = Theater::findOrFail($theater_id);
                // $showTimes = $theater->showTimes;
                // $showTimes = $showTimes->where('movie_id', $movie_id);
                return view('home.booking.booking', compact('movie', 'theater', 'theaters', 'kinds'));
            }
            
            return view('home.booking.booking', compact('movie', 'theaters', 'kinds'));
        }
        else{
            return redirect('login');
        }
        
        
    }

    public function theater_id(Request $request){
        $theater = Theater::findOrFail($request->theater_id);
        $show_times = $theater->showTimes->where('movie_id', $request->movie_id);
        return response()->json($show_times);
    }
    public function date(Request $request){
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
        $show_time = ShowTime::find($request->showTime_id);
        $screens = $show_time->screens;
        return response()->json([
            'screens' => $screens,
            'show_time' => $show_time
        ]);
    }

    public function get_info1(Request $request){
        if(Auth::id()){
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
            $showTime_id = $request->time;
            $screen_id = $request->screen_id;
            $user_id = Auth::user()->id;

            $booking = new Booking;
            $booking->show_time_id = $showTime_id;
            $booking->screen_id = $screen_id;
            $booking->user_id = $user_id;
            $booking->save();

            $this_booking = Booking::find($booking->id);
            // return $this_booking;
            $screen = Screen::find($screen_id);
            $seat_price =  $screen->seats->first()->price;
            return view('home.booking.bookingSeats', compact('screen', 'this_booking', 'seat_price', 'showTime_id'));
            // return route('booking_seats',  $screen_id,  $booking->id);
        }
        else{
            return redirect('login');
        }
        
    }

    // public function get_info2(Request $request){
    //     if(Auth::id()){
    //         $user = Auth::user();
    //         $kinds = Kind::all();
    //         $booking = Booking::find($request->booking_id);
    //         $selectedSeats = explode(',', $request->input('selected_seats'));
            
    //         if($request->input('selected_seats') != null){
    //             $booking->total_seats = count($selectedSeats);
    //             $booking->save();
    //             $booking->seats()->syncWithoutDetaching($selectedSeats);
    //             return view('home.booking.bookingRevision', compact('booking', 'user', 'kinds'));
    //         }
    //         else{
    //             return redirect()->back()->with('error', 'Please Select Seats');
    //         }
            
    //     }
    //     else{
    //         return redirect('login');
    //     }
    // }


    public function seat_click(Request $request){
        $seat = Seat::find($request->seatId);
        $letter = $seat->row->letter;
        $booking = Booking::find($request->booking_id);
        $showTime = $booking->showTime;
        $hisBookings = $seat->bookings()->where('show_time_id', $showTime->id)->first();
        $selected_seats_size = $request->selected_seats_size;
        if($selected_seats_size > 5) return response()->json(['message' => 'max']);
        if(!$hisBookings){
            $booking->seats()->syncWithoutDetaching($seat->id);
            return response()->json(['message' => 'true']);
        }
        else{
            return response()->json(['message' => 'false', 'alert' => "Seat [$letter$seat->number] is no longer available."]);
        }
    }
    public function seat_unclick(Request $request){
        $seat = Seat::find($request->seatId);
        $letter = $seat->row->letter;
        $booking = Booking::find($request->booking_id);
        $showTime = $booking->showTime;
        $hisBookings = $seat->bookings()->where('show_time_id', $showTime->id)->first();
        if($hisBookings){
            $booking->seats()->detach($seat->id);
            return response()->json(['message' => 'unclick']);
        }
    }
    public function get_info2(Request $request){
        if(Auth::id()){
            $user = Auth::user();
            $kinds = Kind::all();
            $booking = Booking::find($request->booking_id);
            if(!$booking) return redirect('/');
            $showTime = $booking->showTime;
            $selectedSeats = explode(',', $request->input('selected_seats'));
            if(count($selectedSeats) > 6) return redirect()->back()->with('error', 'Max Seats is 6');
            if(count($selectedSeats) > 0){
                $booking->total_seats = count($selectedSeats);
                $booking->booking_status = 'reserved';
                $booking->save();
                return view('home.booking.bookingRevision', compact('booking', 'user', 'kinds'));
            }
            else{
                return redirect()->back()->with('error', 'Please Select Seat');
            } 
            
            
        } else {
            return redirect('login');
        }
    }


    public function booking_pay($booking_id){
        if(Auth::id()){
            $kinds = Kind::all();
            $booking = Booking::find($booking_id);
            if(!$booking) return redirect('/');
            $total_price = $booking->total_seats * $booking->seats()->first()->price + 10;
            return view('home.booking.bookingPay', compact('booking', 'total_price', 'kinds'));
        }
        else{
            return redirect('login');
        }
    }

    public function stripePost(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $booking = Booking::find($request->booking_id);
        if(!$booking) return redirect('/');
        if($booking->payment_status != true){
            Stripe\Charge::create ([
                "amount" => $request->total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment" 
            ]);
            $booking->payment_status = true;
            $booking->booking_status = 'confirmed';    
            // $qrCodeContent = $booking->id . uniqid() . $booking->user_id;
            $qrCodeContent =  uniqid();
            // $qrCode = QrCode::size(200)->generate($qrCodeContent);
            $booking->QRcode = $qrCodeContent;
            $booking->total_price = $request->total_price;
            $booking->save();
            $user = $booking->user;
            $details = [
                'greeting' => 'Hello to Cinema Tickets',
                'firstline' => 'Good Day',
                'body' => 'This is your Booking Code '. $qrCodeContent,
                'button' => 'Cinema Tickets',
                'url' => 'http://127.0.0.1:8000/',
                'lastline' => 'Thank you',
                // 'attatched' => $booking->QRcode
            ];
            $movie = Movie::find($booking->ShowTime->movie->id);
            $movie->movie_renevues = $movie->movie_renevues + ($request->total_price - 10);
            $movie->save();
            Notification::send($user, new MyFirstNotification($details));
            Session::flash('success', 'Payment successful! Now your Reservation has been confirmed, We have Sent to you an Email With Booking Code');
            
            return back();
        }
        else{
            Session::flash('failed', 'your Reservation already confirmed');
            
            return back();
        }
        
    }

    public function booking_cancel($booking_id){
        $booking = Booking::find($booking_id);
        // $booking->booking_status = 'cancelled';
        if(!$booking) return redirect('/');
        $booking->delete();
        return redirect('/');
    }

    // public function booking_cancel_10_min($booking_id){
    //     $booking = Booking::find($booking_id);
    //     // $booking->booking_status = 'cancelled';
    //     $booking->delete();
    //     return redirect('/');
    // }

    public function index(){
        if(Auth::id()){
            $user = Auth::user();
            $kinds = Kind::all();
            $bookings = Booking::where('user_id', $user->id)->where('booking_status','!=', 'pending')->get();
            return view('home.booking.index', compact('bookings', 'kinds'));
        }
        else{
            return redirect('login');
        }
    }

    public function all_bookings(){
        if(Auth::id() && Auth::user()->user_type == 1){
            $bookings = Booking::all();
            return view('admin.bookings.index', compact('bookings'));
        }
        else{
            return redirect('login');
        }
    }

    public function send_email($user_id){
        $user = User::find($user_id);
        return view('admin.bookings.send_email', compact('user'));
    }

    public function send_user_email(Request $request, $user_id){
        $user = User::find($user_id);
        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];

        Notification::send($user, new MyFirstNotification($details));
        return redirect()->back();
    }
}
