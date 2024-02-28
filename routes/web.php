<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\ToyyibpayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Owner\MaintenanceController;
use App\Http\Controllers\Customer\CarController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\RentalCar;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    return view('auth.front_page');
});


Route::get('/telegram-callback', [TelegramController::class, 'TelegramCallback'])->name('telegram-callback');

// Route::get('/app',[UserController::class,'index'])->name('customer.home');

Route::middleware(['auth', 'verified'])->get('/dashboard',[HomeController::class, 'index'] )->name('dashboard');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::resource('settings','App\Http\Controllers\SettingController');

Route::get('toyyibpay/{bookingId}/{totalPrice}',[ToyyibpayController::class, 'createBill'])->name('toyyibpay-create');
Route::get('toyyibpay-status',[ToyyibpayController::class, 'paymentStatus'])->name('toyyibpay-status');
Route::post('toyyibpay-callback',[ToyyibpayController::class, 'callback'])->name('toyyibpay-callback');





// Owner
Route::resource('car','App\Http\Controllers\Owner\CarController');
Route::resource('booking2','App\Http\Controllers\Owner\BookingController');
Route::resource('customer','App\Http\Controllers\Owner\CustController');
Route::resource('maintenance','App\Http\Controllers\Owner\MaintenanceController');
Route::resource('service','App\Http\Controllers\Owner\ServiceCentreController');
Route::resource('package','App\Http\Controllers\Owner\PackageController');


Route::get('package/{id}/create', 'App\Http\Controllers\Owner\PackageController@create')->name('package.create');
Route::post('package/{id}', 'App\Http\Controllers\Owner\PackageController@store')->name('package.store');

Route::put('package/{id}', 'App\Http\Controllers\Owner\PackageController@update')->name('package.update');

Route::put('booking2/approve/{booking}', 'App\Http\Controllers\Owner\BookingController@approve')->name('booking2.approve');
Route::post('/stop-tracking/{booking}', 'App\Http\Controllers\Owner\BookingController@stopTracking')->name('stop-tracking');

Route::get('booking2/location/{booking}', 'App\Http\Controllers\Owner\BookingController@location')->name('booking2.location');
Route::post('/maintenance/details', 'App\Http\Controllers\Owner\MaintenanceController@next')->name('maintenance.details');
Route::get('/export_pdf/{maintenance}', 'App\Http\Controllers\Owner\MaintenanceController@pdf')->name('export_pdf');


// Show the form
Route::get('/service-center/form/{maintenance_id}', 'App\Http\Controllers\Owner\ServiceCentreController@showForm')->name('service-center.form');

// Submit the form
Route::post('/service-center/submit', 'App\Http\Controllers\Owner\ServiceCentreController@submitForm')->name('service-center.submit');

// Show the mileage form
Route::get('/mileage/form/{maintenance_id}', 'App\Http\Controllers\Owner\ServiceCentreController@showMileageForm')->name('mileage.form');

// Submit the mileage form
Route::post('/mileage/submit', 'App\Http\Controllers\Owner\ServiceCentreController@submitMileageForm')->name('mileage.submit');

// Thank you page (optional)
Route::get('/thankyou', function () {
    return 'Thank you for submitting the form!';
})->name('thankyou');



Route::patch('/mark-as-done/{maintenance}', [MaintenanceController::class, 'markAsDone'])->name('mark_as_done');



// Customer

// CAR CONTROLLER
Route::resource('car2','App\Http\Controllers\Customer\CarController');
Route::get('/search', 'App\Http\Controllers\Customer\CarController@search')->name('car2.search');
Route::get('/get-price-range', [CarController::class, 'getPriceRange']);

// BOOKING CONTROLLER
Route::resource('booking','App\Http\Controllers\Customer\BookingController');

Route::get('/booking/show/{car}/{pickupDateTime}/{dropoffDateTime}/{pickupLocation}/{dayDifference}', 'App\Http\Controllers\Customer\BookingController@display')->name('booking.display');

Route::post('/update-location/{booking}', 'App\Http\Controllers\Customer\BookingController@updateLocation')->name('update.location');
Route::post('/stop-rental/{booking}', 'App\Http\Controllers\Customer\BookingController@stopRental')->name('stop-rental');
Route::post('/finish-rental/{booking}', 'App\Http\Controllers\Customer\BookingController@finishRental')->name('finish-rental');
Route::put('/review/{booking}', 'App\Http\Controllers\Customer\BookingController@review')->name('booking.review');


Route::get('/geolocation','App\Http\Controllers\Customer\BookingController@updateLocation');   

Route::get('/bookings', 'App\Http\Controllers\Customer\BookingController@index')->name('booking.index');
Route::get('bookings/{booking}/location', 'BookingController@location')->name('booking.location');


require __DIR__.'/auth.php';
