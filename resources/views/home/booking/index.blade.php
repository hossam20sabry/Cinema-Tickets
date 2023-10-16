@extends('home.user_layout')
@section('title', 'Bookings')
@section('style', '/home/css/booking_index.css')



@section('booking_index')
    <div class="container py-3 minheight">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Movie</th>
                    <th scope="col">Theater</th>
                    <th scope="col">Total Seats</th>
                    <th scope="col">Booking Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">ShowTime</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                
                @php $count = 1 @endphp
                @foreach($bookings as $booking)
                <tr>
                    <th scope="row">{{$count}}</th>
                    <td>{{$booking->ShowTime->movie->name}}</td>
                    <td>{{$booking->ShowTime->theater->name}}</td>
                    <td>{{$booking->total_seats}}</td>
                    <td>{{$booking->booking_status}}</td>
                    <td>{{$booking->ShowTime->date}}</td>
                    <td>{{$booking->ShowTime->start_time}}</td>
                    @php $count++ @endphp
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection