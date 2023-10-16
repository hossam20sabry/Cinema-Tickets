{{-- @extends('admin.parts.css') --}}
{{-- @section('head_name', 'Theater screen') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    {{-- @include('admin.parts.css') --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/home/css/theater.css')}}">
    <link rel="icon" href="{{asset('/home/img/logo 102.png')}}">
    <title>{{$screen->screen_number}}</title>
</head>
<body>

    <div class="mainSpinner d-none" id="mainSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only"></span>
        </div>
    </div>


    <div class="row content_center" style="--bs-gutter-x: 0rem;">
    <div class="container  my">
        <div class="row" id="movies-page">
            <div class="movie-container">
                
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button> --}}
                    {{session()->get('error')}}
                    
                </div>
                @endif
                
                
                <div class="alert alert-danger d-none" id="alert">
                </div>
                <div class="alert alert-danger d-none" id="max">
                    The Max seats you can select is 6.
                </div>
                

                <div class="head">
                    <div class="col1 mb-3 mx-3">
                        <label class="text-uppercase">{{$this_booking->showTime->movie->name}}</label>
                    </div>
                    <div class="col1" >
                        <ul class="showcase">
                            <li>
                                <label class="pt-1">{{$screen->screen_number}}</label>
                            </li>
                            <li>
                                <div class="top_seat"></div>
                                <small>N/A</small>
                            </li>
                            <li>
                                <div class="top_seat selected"></div>
                                <small>Selected</small>
                            </li>
                            <li>
                                <div class="top_seat occupied"></div>
                                <small>Occupied</small>
                            </li>    
                        </ul>
                    </div>
                
                    
                </div>
                
                
                <div class="container" id="container">
                    <div class="screen"></div>
                </div>
                <form action="{{route('get_info2')}}" method="GET">
                    @csrf
                    <div class="mmy">
                        <div class="row">
                            @php $count = 1; $ch = 0; $letter ='A'; $check_apearance = 0; @endphp
                            <div class="col" id="col">
                                @foreach ($screen->rows as $row)
                                    <div class="my_row">    
                                        <div class="row_letter">{{$row->letter}}</div>
                                        @foreach ($row->seats as $key => $seat)
                                            @if($seat->apearance == 1)
                                            <div class="fake_seat"> </div>
                                            @php $check_apearance = 1; @endphp
                                            @else
                                            
                                            
                                            
                                            <div class="seat 
                                                @if($seat->bookings->count())
                                                    @foreach($seat->bookings as $booking)
                                                        @if($booking->show_time_id == $showTime_id && $booking->booking_status == 'confirmed' )
                                                            occupied
                                                        @endif
                                                    @endforeach
                                                @endif"
                                            
                                            data-seat-id="{{$seat->id}}">
                                                {{$seat->number}}
                                            </div>
                                            
                                            {{-- <div class="spinner spinnerNum{{$seat->id}} d-none">
                                                <img src="{{asset('/home/img/Spinner-0.5s-371px.gif')}}" alt="">
                                            </div> --}}
                                            
                                            
                                            @endif
                                        @endforeach
                                        <div class="row_letter">{{$row->letter}}</div>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    
                

                <input type="hidden" name="booking_id" id="" value="{{$this_booking->id}}">
                <input type="hidden" name="seat_price" id="" value="{{$seat_price}}">
                <input type="hidden" name="selected_seats" id="selected_seats" value="">

                <div class="container my d-flex" id="container">
                    <p class="text">
                        You have selected <span id="count">0</span> seats for the total price of Rs. <span id="total">0</span>
                    </p>

                    <div class="row row_width">
                        <div class="col d-flex rel">
                            <a  href="{{route('booking.cancel', $this_booking->id)}}" class="btn btn-warning flex_end">Cancel</a>
                        </div>
                        <div class="col d-flex rel">
                            <button type="submit" class="btn next_btn">Next</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>
                
                
        </div>
        
    </div>

    </div>
<script src="{{asset('/jquery-3.7.1.min.js')}}"></script>
<script>
    const seat_price = {!! json_encode($seat_price) !!};
    const booking_id = {!! json_encode($this_booking->id) !!};
    const ticket_counter = document.querySelector('#count');
    const mainSpinner = document.querySelector('#mainSpinner');
    const alert = document.querySelector('#alert');
    const max = document.querySelector('#max');
    const ticket_price_total = document.querySelector('#total');
    const selected_seats_input = document.querySelector('#selected_seats');
    const selectedSeats = new Set(); // Create a Set to store selected seat IDs

    $(document).ready(function(){
        $('.seat').click(function(){
            // this.classList.add('d-none');
            mainSpinner.classList.remove('d-none');
            alert.classList.add('d-none');
            max.classList.add('d-none');
            // $('#mainSpinner').removeclass('d-none');
            if (!this.classList.contains('occupied')){
                const seatId = this.getAttribute('data-seat-id');
                if (this.classList.contains('active')) {
                    var self = this;
                    $.ajax({
                        url: "{{route('seat.unclick')}}",
                        data: {
                            seatId: seatId,
                            booking_id: booking_id
                        },
                        success:function(data){
                            // self.classList.remove('d-none');
                            self.classList.remove('active');
                            self.style.backgroundColor = '#444451';
                            selectedSeats.delete(seatId);
                            // Update the selected_seats input field value with the Set contents
                            selected_seats_input.value = Array.from(selectedSeats).join(',');
                            var count = selectedSeats.size;
                            var total = count * seat_price;
                            ticket_price_total.innerHTML = `${total}`;
                            ticket_counter.innerHTML = `${count}`;
                            // $('#mainSpinner').addclass('d-none');
                            mainSpinner.classList.add('d-none');
                        }
                    })
                    
                } else {
                    var self = this;
                    var selected_seats_size = selectedSeats.size
                    $.ajax({
                        url: "{{route('seat.click')}}",
                        method: "GET",
                        data: {
                            seatId: seatId,
                            booking_id: booking_id,
                            selected_seats_size: selected_seats_size
                        },
                        success:function(data){
                            
                            if(data.message == 'true'){
                                // self.classList.remove('d-none');
                                self.classList.add('active');
                                self.style.backgroundColor = '#0081cb';
                                selectedSeats.add(seatId);
                                // Update the selected_seats input field value with the Set contents
                                selected_seats_input.value = Array.from(selectedSeats).join(',');
                                var count = selectedSeats.size;
                                var total = count * seat_price;
                                ticket_price_total.innerHTML = `${total}`;
                                ticket_counter.innerHTML = `${count}`;
                                mainSpinner.classList.add('d-none');
                            }
                            else if(data.message == 'max'){
                                mainSpinner.classList.add('d-none');
                                max.classList.remove('d-none');
                            }
                            else {
                                alert.innerHTML = data.alert;
                                alert.classList.remove('d-none');
                                mainSpinner.classList.add('d-none');
                            }
                        },
                        
                    });
                    
                }
                

                // Update the selected_seats input field value with the Set contents
                selected_seats_input.value = Array.from(selectedSeats).join(',');
                }
        })

    })
</script>


{{-- <script src="{{asset('home/js/seats.js')}}"></script> --}}

</body>
</html>