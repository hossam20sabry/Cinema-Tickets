const seat = document.querySelectorAll('.seat');
const ticket_counter = document.querySelector('#count');
const ticket_price_total = document.querySelector('#total');
const selected_seats_input = document.querySelector('#selected_seats');
let count = 0;
let ticket_price = 0;
const selectedSeats = new Set(); // Create a Set to store selected seat IDs


seat.forEach(seat => {
    seat.addEventListener('click', () => {
        if (!seat.classList.contains('occupied')) {
            const seatId = seat.getAttribute('data-seat-id'); 
            if (seat.classList.contains('active')) {
                seat.classList.remove('active');
                seat.style.backgroundColor = '#444451';
                count--;
                ticket_price -= +seat_price;
                selectedSeats.delete(seatId);
            } else {
                seat.classList.add('active');
                seat.style.backgroundColor = '#0081cb';
                count++;
                ticket_price += +seat_price;
                selectedSeats.add(seatId); 
            }
            ticket_price_total.innerHTML = `${ticket_price}`;
            ticket_counter.innerHTML = `${count}`;

            // Update the selected_seats input field value with the Set contents
            selected_seats_input.value = Array.from(selectedSeats).join(',');
        }
    });
});