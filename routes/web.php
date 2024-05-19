<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\venueController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\paymentController;
use Illuminate\Support\Facades\Route;

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

    //...........login and registration starts.........
    Route::get('/welcome', function () {
         return view('welcome');
    });
  
    Route::get('/reserve', function () {
        return view('reservations.create');
   });

//    Route::get('/userprofile', function () {
//     return view('userprofile');
// });
    
  
     //...........login and registration ends.........





//.................VENUE MODULE ROUTES STARTS HERE................


Route::get('/see_venue', [venueController::class, 'index'])->name('index_venues');
Route::get('/venue_explorer', [venueController::class, 'explorer'])->name('venue_explorer');


// Route::get('/see_dashboard', function () {
//     return view('dash');
// });

// Route::get('/see_reservations', function () {
//     return view('reservations');
// });

Route::get('/see_events', function () {
    return view('events');
});

Route::get('/see_venue_register', function () {
    return view('venues.venue_register');
});

// Route::get('/see_payments', function () {
//     return view('payments');
// });

Route::get('/see_venue_edit/{id}', [venueController::class, 'edit'])->name('see_venue_edit');
Route::put('/see_venue_update/{id}', [venueController::class, 'update'])->name('see_venue_update');

Route::get('/see_venue_profile/{id}', [venueController::class, 'profile'])->name('see_venue_profile');
Route::get('/venue_view/{id}', [venueController::class, 'view'])->name('venue_view');


Route::post('/create_venue', [venueController::class, 'create'])->name('create_venue');
Route::delete('/see_venue_delete/{id}', [venueController::class, 'delete'])->name('see_venue_delete');

//Route::get('/filter_venue', [VenueController::class, 'filter'])->name('venue_explorer');


//.................VENUE MODULE ROUTES ENDS HERE................



//.................RESERVATIONS MODULE ROUTES STARTS HERE.............


// Route::get('/form_reserve/{id}', [reservationController::class, 'reserve'])->name('form_reserve');
Route::get('/see_reservations', [reservationController::class, 'requests'])->name('see_reservations');
Route::get('/check_availability/{id}', [venueController::class, 'checkAvailability'])->name('check_availability');
Route::get('/form_reserve', [reservationController::class, 'create'])->name('reservation.create');
Route::post('/form_reserve', [reservationController::class, 'store'])->name('reservation.store');



   //admins
   Route::post('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
   Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
   

// Route::get('/see_filter_venues', [reservationController::class, 'index'])->name('see_filter_venues');


//.................RESERVATIONS MODULE ROUTES ENDS HERE.............




//.................PAYMENTS MODULE ROUTES STARTS HERE.............

Route::get('/see_payments', [paymentController::class, 'status'])->name('see_payments');



//.................PAYMENTS MODULE ROUTES ENDS HERE.............







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
