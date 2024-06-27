<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\venueController;
//use App\Http\Controllers\reservationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlutterwaveController;
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
    Route::get('/welcome', [DashboardController::class, 'user'])->name('welcome')->middleware(['auth', 'verified']);
  
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);
       
  
    Route::get('/reserve', function () {
        return view('reservations.create');
   });  
  
     //...........login and registration ends.........

//.................USERS MANAGEMENT MODULE ROUTES STARTS HERE................ 


Route::middleware(['auth', 'role:PRO'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');    
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::patch('/admin/users/{user}/role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
});







//................USERS MANAGEMENT ROUTES ENDS HERE................

//.................VENUE MODULE ROUTES STARTS HERE................

Route::middleware(['auth'])->group(function () {

Route::get('/see_venue', [venueController::class, 'index'])->name('index_venues');
Route::get('/venue_explorer', [venueController::class, 'explorer'])->name('venue_explorer');

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


//.................VENUE MODULE ROUTES ENDS HERE................
});




Route::middleware(['auth'])->group(function () {
//.................RESERVATIONS MODULE ROUTES STARTS HERE.............

    //users
Route::get('/check_availability/{id}', [venueController::class, 'checkAvailability'])->name('check_availability');
Route::get('/form_reserve', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/form_reserve', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/reservations_user', [ReservationController::class, 'userReservations'])->name('reservations.user');


Route::post('/reservations/{id}/withdraw', [ReservationController::class, 'withdraw'])->name('reservations.withdraw');
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');



   //admins
   Route::get('/see_reservations', [ReservationController::class, 'index'])->name('see_reservations');
   Route::post('/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
   Route::post('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');

//.................RESERVATIONS MODULE ROUTES ENDS HERE.............
});


// .........EVENTS DASHBOARD MODULE ROUTES STARTS HERE...............

Route::get('/events', [EventController::class, 'index'])->name('events.index');



// .........EVENTS DASHBOARD MODULE ROUTES ENDS HERE...............


//.................PAYMENTS MODULE ROUTES STARTS HERE.............


Route::middleware(['auth'])->group(function () {
    //Route::get('/payment-requests', [PaymentRequestController::class, 'index'])->name('payment-requests.index');
    //Route::post('/payment-requests', [PaymentRequestController::class, 'store'])->name('payment-requests.store');
    
    //Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/confirm/{id}', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
    Route::get('/see_payments', [PaymentController::class, 'index'])->name('payments.index');
    
    Route::post('/payment/initialize/{id}', [PaymentController::class, 'initialize'])->name('payment.initialize');
    Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    
   Route::post('/payment/process/{id}', [PaymentController::class, 'processPayment'])->name('payment.process');

   Route::get('payments/create/{reservationId}', [PaymentController::class, 'createPayment'])->name('payments.create');
    //.................PAYMENTS MODULE ROUTES ENDS HERE.............
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// The route that the button calls to initialize payment
//Route::post('/pay', [FlutterwaveController::class, 'initialize'])->name('pay');
// The callback url after a payment
//Route::get('/rave/callback', [FlutterwaveController::class, 'callback'])->name('callback');

// Route::get('/flutterwave', function () {
//     return view('flutterwave');
// });
// use App\Http\Controllers\FlutterwaveController;

// Route::get('/payment', [FlutterwaveController::class, 'showPaymentForm'])->name('flutterwave.paymentForm');
// Route::post('/payment/initialize', [FlutterwaveController::class, 'initializePayment'])->name('flutterwave.initialize');
// Route::get('/payment/callback', [FlutterwaveController::class, 'handleCallback'])->name('flutterwave.callback');



// The page that displays the payment form
// Route::get('/', function () {
//     return view('flutterwave');
// });
// // The route that the button calls to initialize payment
// Route::post('/pay', [FlutterwaveController::class, 'initialize'])->name('pay');
// // The callback url after a payment
// Route::get('/rave/callback', [FlutterwaveController::class, 'callback'])->name('callback');


require __DIR__.'/auth.php';



