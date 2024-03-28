<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\venueController;
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

//.................VENUE MODULE ROUTES STARTS HERE................
Route::get('/', function () {
    return view('welcome');
});

Route::get('/see_venues', [venueController::class, 'index'])->name('index_venues');

Route::get('/see_dashboard', function () {
    return view('dash');
});

Route::get('/see_reservations', function () {
    return view('reservations');
});

Route::get('/see_events', function () {
    return view('events');
});

Route::get('/see_venue_register', function () {
    return view('venue_register');
});

Route::get('/see_payments', function () {
    return view('payments');
});

Route::get('/see_venue_edit/{id}', [venueController::class, 'edit'])->name('see_venue_edit');

Route::put('/see_venue_update/{id}', [venueController::class, 'update'])->name('see_venue_update');

Route::get('/see_venue_profile/{id}', [venueController::class, 'profile'])->name('see_venue_profile');

Route::post('/create_venue', [venueController::class, 'create'])->name('create_venue');

Route::delete('/see_venue_delete/{id}', [venueController::class, 'delete'])->name('see_venue_delete');


//.................VENUE MODULE ROUTES ENDS HERE................



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
