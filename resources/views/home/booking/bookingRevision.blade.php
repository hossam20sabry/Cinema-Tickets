@extends('home.user_layout')
@section('title', 'Booking Revision')
@section('style', '/home/css/revision-page.css')



@section('Booking_Revision')
<div class="container py-3 minHei" id="booking_details">
    <h3 class="pb-3">Check all your Reservation Details</h3>
    <div class="row mt-3">
        <div class="col m-3">
            <div class="diiv">
                <img src="{{asset('/home/icon/film-slate.png')}}" class="top-img" alt="">
                <p class="movie-name text-uppercase">{{$booking->showTime->movie->name}}</p>
            </div>
        </div>
        <div class="col m-3">
            <div class="diiv">
                <img src="{{asset('/home/icon/clock.png')}}" class="top-img" alt="">
                <p>{{$booking->showTime->date}} <br>{{$booking->showTime->start_time}}</p>
            </div>
        </div>
        <div class="col m-3">
            <div class="diiv">
                <img src="{{asset('/home/icon/location-pin.png')}}" class="top-img" alt="">
                <p class="text-uppercase">{{$booking->showTime->theater->location}} <br>{{$booking->showTime->theater->city}}</p>
            </div>
        </div>
        <div class="col m-3">
            <div class="diiv">
                <img src="{{asset('/home/icon/film.png')}}" class="top-img" alt="">
                <p class="text-uppercase">{{$booking->showTime->theater->name}}</p>
            </div>
        </div>
        <div class="col m-3">
            <div class="diiv">
                <img src="{{asset('/home/icon/ticket (1).png')}}" class="top-img" alt="">
            <p id="tickets_nums">{{$booking->total_seats}} Ticket <br>2D</p>
            </div>
        </div>
        <div class="col m-3">
            <div class="diiv">
                <img src="{{asset('/home/icon/chair.png')}}" class="top-img" alt="">
                <div id="ticket_num">
                    @foreach($booking->seats as $seat)
                        <p>{{$seat->row->letter}}{{$seat->number}}</p>
                    @endforeach
                </div>  
            </div>
        </div>
    </div>
    <div class="row py-3 ">

        <div class="col-md-6">
            <table class="table table-light table-striped-columns table-hover p-3">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td class="text-uppercase">{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{$user->phone}}</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <table class="table table-light table-striped-columns  p-3">
                <tbody>
                    <tr>
                        <td>Tickets</td>
                        <td>{{$booking->total_seats}}</td>
                        @php $total_price = ($booking->total_seats * $booking->seats()->first()->price) + 10 @endphp
                        <td rowspan="3" class="total text-center mt-3"><h4 class="my_padding">Total <br> <span>{{$total_price}} EG</span></h4> </td>

                    </tr>
                    <tr>
                        <td class="smaler">Ticket Price</td>
                        <td>{{$booking->seats()->first()->price}} EG &nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="smaler">Booking Fees</td>
                        <td>10 EG &nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="col-12 space">
            {{-- <button data-bs-target="#exampleModal" class="btn  mt-3 " id="btn">NEXT</button> --}}
            <a  href="{{route('booking.cancel', $booking->id)}}" class="btn btn-warning mt-3" id="btn">Cancel</a>

            <a href="{{route('booking_pay', $booking->id)}}" class="btn btn-primary my_btn_style px-3" id="next">
                NEXT
            </a>
            
            
        </div>
        

    </div>
</div>

@endsection