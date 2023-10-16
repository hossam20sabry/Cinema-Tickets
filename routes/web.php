<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TheatersController;
use App\Http\Controllers\moviesTheatersController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ScreensController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ShowTimeController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\CategoriesController;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// home controller
Route::get('/',[HomeController::class, 'index'])->name('index');
route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');
Route::get('/search',[HomeController::class, 'search'])->name('search');
// Route::get('auto-search',[HomeController::class, 'autoComlete'])->name('auto_search');



// movies controller
Route::resource('movies', App\Http\Controllers\MoviesController::class);
Route::post('movies-delete', [MoviesController::class, 'delete'])->name('movies.delete');
Route::post('movies-update', [MoviesController::class, 'update_movie'])->name('movies.update');
Route::get('top-movies', [MoviesController::class, 'top_movies'])->name('movies.top');

// kind
Route::get('kind-create', [KindController::class, 'create'])->name('kind.create');
Route::post('kind-store', [KindController::class, 'store'])->name('kind.store');
Route::get('kind-index', [KindController::class, 'index'])->name('kind.index');
Route::get('kind-edit/{id}', [KindController::class, 'edit'])->name('kind.edit');
Route::post('kind-update', [KindController::class, 'update'])->name('kind.update');
Route::post('kind-delete', [KindController::class, 'destroy'])->name('kind.destroy');
Route::get('kind-movies/{id}', [KindController::class, 'movies'])->name('kind.movies');
Route::get('kind-show/{id}', [KindController::class, 'show'])->name('kind.show');
//category
Route::get('category-create', [CategoriesController::class, 'create'])->name('category.create');
Route::post('category-store', [CategoriesController::class, 'store'])->name('category.store');
Route::get('category-index', [CategoriesController::class, 'index'])->name('category.index');
Route::get('category-edit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
Route::post('category-update', [CategoriesController::class, 'update'])->name('category.update');
Route::post('category-delete', [CategoriesController::class, 'destroy'])->name('category.destroy');
Route::get('category-movies/{id}', [CategoriesController::class, 'movies'])->name('category.movies');

// explore 
route::get('add_to_explore/{id}', [MoviesController::class, 'add_to_explore'])->name('add_to_explore');
route::get('delete_explore/{id}', [MoviesController::class, 'delete_explore'])->name('delete_explore');



// theaters controller
Route::resource('theaters', App\Http\Controllers\TheatersController::class);
Route::get('theater_info/{theater_id}', [TheatersController::class, 'theater_info'])->name('theater.info');

// showTime
Route::get('create-showtime/{movie_id},{theater_id}', [ShowTimeController::class, 'create'])->name('showtime.create');
Route::post('store-showtime', [ShowTimeController::class, 'store'])->name('showtime.store');
Route::get('avilable_showtime/{movie_id},{theater_id}', [ShowTimeController::class, 'show'])->name('showtime.show');
Route::post('update-showtime', [ShowTimeController::class, 'update'])->name('showtime.update');
Route::get('edit-showtime/{showTime_id}', [ShowTimeController::class, 'edit'])->name('showtime.edit');
Route::post('delete-showtime', [ShowTimeController::class, 'destroy'])->name('showtime.destroy');

// screen controller
Route::get('screens/{theater_id}', [ScreensController::class, 'index'])->name('screens');
Route::get('show_screen/{screen_id}', [ScreensController::class, 'show'])->name('screen.show');
Route::get('create_screen/{theater_id}', [ScreensController::class, 'create'])->name('screen.create');
Route::post('store_screen', [ScreensController::class, 'store'])->name('screen.store');
Route::get('delete_screen/{screen_id}', [ScreensController::class, 'destroy'])->name('screen.destroy');
Route::get('edit_screen/{screen_id}', [ScreensController::class, 'edit'])->name('screen.edit');
Route::put('update_screen/{screen_id}', [ScreensController::class, 'update'])->name('screen.update');
//seats
Route::POST('fake_seat/{screen_id}', [ScreensController::class, 'fake_seat'])->name('fake_seat');
Route::get('real_seat/{seat_id}', [ScreensController::class, 'real_seat'])->name('real_seat');





// movies Theaters Controller
route::get('avilable_movies/{id}', [TheatersController::class, 'avilable_movies']);
route::post('add_avilable_movies/{id}', [moviesTheatersController::class, 'add_avilable_movies']);
route::get('delete_avilable_movies/{id}', [moviesTheatersController::class, 'delete_avilable_movies']);




// new booking
Route::get('booking/{movie_id}/{theater_id?}', [BookingsController::class, 'new_booking'])->name('new_booking');
Route::get('get-theater', [BookingsController::class, 'theater_id'])->name('theater_id');
Route::get('get-date', [BookingsController::class, 'date'])->name('date');
Route::get('get-time', [BookingsController::class, 'time'])->name('time');
Route::get('get-info1', [BookingsController::class, 'get_info1'])->name('get_info1');
Route::get('seat-click', [BookingsController::class, 'seat_click'])->name('seat.click');
Route::get('seat-unclick', [BookingsController::class, 'seat_unclick'])->name('seat.unclick');
Route::get('get-info2', [BookingsController::class, 'get_info2'])->name('get_info2');
Route::get('booking-pay/{booking_id}', [BookingsController::class, 'booking_pay'])->name('booking_pay');
Route::post('stripe', [BookingsController::class, 'stripePost'])->name('stripe.post');
Route::get('booking-cancel/{booking_id}', [BookingsController::class, 'booking_cancel'])->name('booking.cancel');
Route::get('bookings', [BookingsController::class, 'index'])->name('booking.index');
Route::get('all-bookings', [BookingsController::class, 'all_bookings'])->name('allbooking.index');
Route::get('send-email/{user_id}', [BookingsController::class, 'send_email'])->name('send_email');
Route::post('send-user-email/{user_id}', [BookingsController::class, 'send_user_email'])->name('send_user_email');

// testing
route::get('show_theater_movies', [moviesTheatersController::class, 'show_theater_movies']);    
route::get('show_theater_screens', [TestController::class, 'show_theater_screens']);    
route::get('show_screens_sections', [TestController::class, 'show_screens_sections']);    
route::get('show_theater_sections', [TestController::class, 'show_theater_sections']);    
route::get('show_section_rows', [TestController::class, 'show_section_rows']);    
route::get('show_row_seats', [TestController::class, 'show_row_seats']);    
route::get('show_screens_rows', [TestController::class, 'show_screens_rows']);    
route::get('show_section_seats', [TestController::class, 'show_section_seats']);    
route::get('show_theater_rows', [TestController::class, 'show_theater_rows']);    
route::get('show_section_theater', [TestController::class, 'show_section_theater']);    
route::get('show_screen_seats', [TestController::class, 'show_screen_seats']);  
route::get('show_movie_showtimes', [TestController::class, 'show_movie_showtimes']);  
route::get('get-full-namespace', [TestController::class, 'get_full_namespace']);  
Route::get('/qrCode', [TestController::class, 'qrCode']);
Route::get('/total', [TestController::class, 'total']);

//ajax 
route::get('add_data', [TestController::class, 'add_data']);
route::post('store_data', [TestController::class, 'store_data']);
route::get('show_doctors', [TestController::class, 'show_doctors']);
route::post('delete_doctor', [TestController::class, 'delete_doctor'])->name('delete_doctor');

// theater --- screen --- section --- row --- seat
route::get('ttheater/{screen?}/{section?}/{row?}/{seat?}', [TestController::class, 'main']);







