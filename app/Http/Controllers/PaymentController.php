<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Notifications\CinemaTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Stripe;


class PaymentController extends Controller
{
    public function checkout(Request $request){

        $booking = Booking::find($request->booking_id);

        if(!$booking) return redirect()->route('home');

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

        $response = $stripe->checkout->sessions->create([

            'success_url' => $redirectUrl . '&booking_id=' . $booking->id,

            'customer_email' => 'demo@gmail.com',

            'payment_method_types' => ['link','card'],

            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $booking->movie->name,
                        ],
                        'unit_amount' => 100 * $booking->total_price,
                        'currency' => 'USD',
                    ],
                    'quantity' => 1
                ],
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => true,
        ]);


        return redirect($response['url']);
    }

    public function checkoutSuccess(Request $request){

        $booking = Booking::find($request->booking_id);

        if(!$booking) return redirect()->route('home');

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));


        $booking->payment_status = true;
        $booking->booking_status = 'confirmed';
        $booking->QRcode = uniqid() . '-' . $booking->id;
        $booking->save();
        

        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        
        return redirect()->route('bookings.thanks');
    }
}
