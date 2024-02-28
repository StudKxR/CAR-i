<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RentalCar;
use App\Models\Booking;
use App\Models\Package;
use App\Models\BookingPackage;
use App\Models\Addons;
use App\Models\BookingAddon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\TelegramController;
use Carbon\Carbon;


class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Retrieve user's bookings
        $bookings = Booking::where('user_id', $user->id)->get();
    
        // Retrieve user's cars
        $cars = RentalCar::where('user_id', $user->id)->get();
    
         // Initialize variables
        $packagePrice = 0;
        $addonPrice = 0;
        $totalPrice = 0;
        $dayDifference = 0;
        $carPrice = 0;

        if ($bookings->isNotEmpty()) {
            // Iterate through bookings to get pickup and dropoff date-time
            foreach ($bookings as $booking) {
                if ($booking->pickup_date && $booking->pickup_time && $booking->dropoff_date && $booking->dropoff_time) {
                    $pickupDateTime = $booking->pickup_date . ' ' . $booking->pickup_time;
                    $dropoffDateTime = $booking->dropoff_date . ' ' . $booking->dropoff_time;
               
                    // Parse input strings into Carbon objects
                    $pickupDateTimeObject = Carbon::parse($pickupDateTime);
                    $dropoffDateTimeObject = Carbon::parse($dropoffDateTime);
                    $currentDateTime = Carbon::now();

                    
                    // Calculate the day difference
                    $dayDifference = $pickupDateTimeObject->diffInDays($dropoffDateTimeObject);
                    $daysUntilPickup = $pickupDateTimeObject->diffInDays($currentDateTime);
                    
                    if ($dropoffDateTimeObject->gt($pickupDateTimeObject) || ($dropoffDateTimeObject->eq($pickupDateTimeObject) && $dropoffDateTimeObject->gt($pickupDateTimeObject))) {
                        $dayDifference += 1;
                    }

                    // if ($booking->status === "Payment made") {
                    //     // Include a success notification
                    //     notify()->success('Please wait for booking to be approved','Payment Successful!');
                    // }
            
                    if ($booking->status === "Approved" && $booking->tracking === "off") {
                        // Include a success notification
                        notify()->success('Please click on the green button to start rental','Booking Approved!');
                    }

                    if ($booking->status === "Pending"  || $currentDateTime->diffInMinutes($pickupDateTimeObject) <= 7) {
                        // Include a success notification
                        notify()->warning('Please make payment before booking is cancelled','Make Payment!');
                    }
            

                    $carsToUpdate = []; // Create an array to store car IDs for status update

                    // Check if the pickup date has passed or payment is not made
                    if ($currentDateTime > $pickupDateTimeObject && 
                        $booking->status !== 'Payment made' && 
                        $booking->status !== 'Approved'&&
                        $booking->status !== 'Finished') {
                        // Update the booking status to "Canceled"
                        Booking::where('id', $booking->id)->update([
                            'status' => 'Canceled'
                        ]);

                        // Add the car ID to the array for status update
                        $carsToUpdate[] = $booking->car_id;
                    }

                    
                }
            }
        }

        // Loop through each car and calculate the total price
        foreach ($cars as $car) {

            // If the car ID is in the array, update its status to "Available"
            if (in_array($car->id, $carsToUpdate)) {
                $car->update(['status' => 'Available']);
            }
        }

    
        
        return view('customer.booking.index', compact( 'bookings'));
    }
    
    public function show(Booking $booking)
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();
        
        $pickupDateTime = $booking->pickup_date . ' ' . $booking->pickup_time;
        $dropoffDateTime = $booking->dropoff_date . ' ' . $booking->dropoff_time;
        
        // Parse input strings into Carbon objects
        $pickupDateTimeObject = Carbon::parse($pickupDateTime);
        $dropoffDateTimeObject = Carbon::parse($dropoffDateTime);
        $currentDateTime = Carbon::now();
        
        // Calculate the day difference
        $dayDifference = $pickupDateTimeObject->diffInDays($dropoffDateTimeObject);
        $daysUntilPickup = $pickupDateTimeObject->diffInDays($currentDateTime);
        
        if ($dropoffDateTimeObject->gt($pickupDateTimeObject) || ($dropoffDateTimeObject->eq($pickupDateTimeObject) && $dropoffDateTimeObject->gt($pickupDateTimeObject))) {
            $dayDifference += 1;
        }

        $packagePrice = $booking->bookingPackages->sum('packages.add_price');
        $addonPrice = $booking->bookingAddons->sum('addons.price');
        $carPrice = $booking->cars->rental_price * $dayDifference;
        $totalPrice = $carPrice + $packagePrice + $addonPrice;

        return view('customer.booking.popup',compact('bookings','booking','pickupDateTime','dropoffDateTime','dayDifference','packagePrice','addonPrice','totalPrice'));
    }

    public function create(Request $request)
    {
        $carId = $request->input('car');

        $pickupDateTime = $request->input('pickupDateTime');
        $dropoffDateTime = $request->input('dropoffDateTime');
        
        $pickupLocation = $request->input('pickupLocation');
        $dayDifference = $request->input('dayDifference');

        $selectedPackageId = $request->input('selectedPackageId');
        $selectedPackage = Package::find($selectedPackageId);

        $selectedAddons = $request->input('selectedAddons');
        $selectedAddonsArray = json_decode($selectedAddons, true);
        // Check if $selectedAddonsArray is not null before getting the keys
        $addonIds = $selectedAddonsArray ? array_keys($selectedAddonsArray) : [];
        // Now you can use $addonIds to retrieve addon details
        $selectedAddonsDetails = Addons::whereIn('id', $addonIds)->get();
        // Retrieve the car information based on $carId
        $car = RentalCar::find($carId);

        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();

        return view('customer.booking.create', compact('car', 'bookings', 'pickupDateTime', 'dropoffDateTime', 
                                                    'pickupLocation', 'dayDifference', 'selectedPackage', 'selectedAddonsDetails'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'Fname' => 'required',
            'Lname' => 'required',
            'age' => 'required',
            'phone' => 'required',
        ]);

        $image = null; // Initialize the $image variable

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('public/images');
            $image = basename($imagePath);
        }

        $pickupDateTime = $request->input('pickupDateTime');
        $dropoffDateTime = $request->input('dropoffDateTime');
        $pickupDate = date('Y-m-d', strtotime($pickupDateTime));
        $pickupTime = date('H:i:s', strtotime($pickupDateTime));
        $dropoffDate = date('Y-m-d', strtotime($dropoffDateTime));
        $dropoffTime = date('H:i:s', strtotime($dropoffDateTime));

        $booking = Booking::create([
            'first_name' => $request->Fname,
            'last_name' => $request->Lname,
            'age' => $request->age,
            'location' => $request->pickupLocation,
            'phone' => $request->phone,
            'pickup_date' => $pickupDate,
            'pickup_time' => $pickupTime,
            'dropoff_date' => $dropoffDate,
            'dropoff_time' => $dropoffTime,
            'car_id' => $request->car_id,
            'user_id' => auth()->user()->id,
            'images' => $image, // Use the $image variable here
        ]);
        $bookingPackage = new BookingPackage();
        $bookingPackage->booking_id = $booking->id; // Use the ID of the created booking
        $bookingPackage->rental_car_id = $request->input('car_id');
        $bookingPackage->selected_package_id = $request->input('selectedPackageId');
        $bookingPackage->save();

        $selectedAddons = json_decode($request->input('selectedAddons'), true);
        foreach ($selectedAddons as $addon) {
            $bookingAddon = new BookingAddon();
            $bookingAddon->booking_id = $booking->id; // Use the ID of the created booking
            $bookingAddon->rental_car_id = $request->input('car_id');
            $bookingAddon->selected_addon_id = $addon['id'];
            $bookingAddon->save();
        }
        notify()->success('New Booking made!');
        return redirect()->route('booking.index');
    }   



    public function edit(Booking $booking)
    {
        $car = $booking->cars;
        $user = auth()->user();
        $bookings = Booking::with(['bookingPackages.packages', 'bookingAddons.addons'])
            ->where('user_id', $user->id)
            ->get();

        // Retrieve pickup and dropoff details from the first booking (assuming they are the same for all bookings)
        $pickupDateTime = $bookings->first()->pickup_date . ' ' . $bookings->first()->pickup_time;
        $dropoffDateTime = $bookings->first()->dropoff_date . ' ' . $bookings->first()->dropoff_time;
        // Parse input strings into Carbon objects
        $pickupDateTimeObject = Carbon::parse($pickupDateTime);
        $dropoffDateTimeObject = Carbon::parse($dropoffDateTime);
        // Calculate the day difference
        $dayDifference = $pickupDateTimeObject->diffInDays($dropoffDateTimeObject);
        if ($dropoffDateTimeObject->format('H:i') > $pickupDateTimeObject->format('H:i')) {
            $dayDifference += 1;
        }

        // Calculate package and addon prices
        $packagePrice = $booking->bookingPackages->sum('packages.add_price');
        $addonPrice = $booking->bookingAddons->sum('addons.price');
        // Calculate total price
        $carPrice = $car->rental_price * $dayDifference;
        $totalPrice = $carPrice + $packagePrice + $addonPrice;

        $pickupLocation = $bookings->first()->location;

        return view('customer.booking.edit', compact('booking', 'car', 'bookings', 'pickupDateTime', 'dropoffDateTime', 'dayDifference', 'packagePrice', 'addonPrice', 'totalPrice','pickupLocation'));
    }


    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'Fname' => 'required',
            'Lname' => 'required',
            'age' => 'required',
            'phone' => 'required',
        ]);
     
        $booking->update([
            'first_name' => $request->Fname,
            'last_name' => $request->Lname,
            'age' => $request->age,
            'location' => $request->pickupLocation,
            'phone' => $request->phone, 
            'images' => $request->lesen, // Update images field

            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);
        
        notify()->success('Booking updated!');
        return redirect()->route('booking.index');

    }

    public function updateLocation(Request $request, Booking $booking)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            // Add validation rules for other data as needed
        ]);

        // Check if the location has changed before updating
        $oldLatitude = $booking->latitude;
        $oldLongitude = $booking->longitude;

        $booking->update([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);
        
        // Check if the location has actually changed
        if ($booking->tracking != 'On') {
            // Check if the message has been sent before
            // Send the message only if the location has changed and the message hasn't been sent before
            
            $cust = User::find($booking->user_id);
            $custTelegramChatId = $cust->telegram_chat_id;
            
            $message = new TelegramController;
            $message = "RENTING IS IN PROCESS\n\n" .
            "Booking name: " . $booking->first_name . " " . $booking->last_name . "\n".
            "Phone Number: " . $booking->phone . "\n\n" .
            "################################\n\n" .
            "Pickup Date: " . $booking->pickup_date . "\n" .
            "Pickup Time: " . $booking->pickup_time . "\n\n" .
            "################################\n\n" .
            "Dropoff Date: " . $booking->dropoff_date . "\n" .
            "Dropoff Time: " . $booking->dropoff_time . "\n\n" .
            "################################\n\n" .
            "NOTICE: This booking is being tracked for the safety of the car. You may stop the rental, but it will notify the owner immediately. Additionally, please ensure you remain logged in to the website to allow car tracking.";

            $messageController = new TelegramController;
            $messageController->send($custTelegramChatId,$message, 'HTML');

            // Set the message_sent flag to true to indicate that the message has been sent
            $booking->update(['tracking' => 'On']);
        }

        return back();
    }


    public function stopRental(Request $request, Booking $booking)
    {
        // Update the tracking status to 'Off'
        $booking->tracking = 'Off';
        $booking->save();


        if ($booking->tracking != 'On') {
            // Check if the message has been sent before
            // Send the message only if the location has changed and the message hasn't been sent before
            $owner = User::find($booking->cars->user_id);
            $ownerTelegramChatId = $owner->telegram_chat_id;

            
            $message = new TelegramController;
            $message = "TRACKING HAS BEEN STOPPED!!!!\n\n" .
            "Booking name:  " . $booking->first_name . " " . $booking->last_name . "\n".
            "Phone Number:  " . $booking->phone . "\n" .
            "Car:  " . $booking->cars->name . "\n\n" .
            "################################\n\n" .
            "Last location:  " . $booking->latitude . " " . $booking->longitude;

            $messageController = new TelegramController;
            $messageController->send($ownerTelegramChatId,$message, 'HTML');

         
        }

        notify()->warning('Rental has been stopped!');
        // Redirect back to the previous page or wherever you need
        return back();
    }

    public function finishRental(Request $request, Booking $booking)
    {
        // Update the tracking status to 'Off'
        $booking->status = 'Finished';
        $booking->tracking = 'Off';
        $booking->save();

        if ($booking->tracking != 'On' && $booking->status == 'Finished') {
            // Check if the message has been sent before
            // Send the message only if the location has changed and the message hasn't been sent before
            $owner = User::find($booking->cars->user_id);
            $ownerTelegramChatId = $owner->telegram_chat_id;

            
            $message = new TelegramController;
            $message = "BOOKING HAS FINISHED!\n\n" .
            "Booking name:  " . $booking->first_name . " " . $booking->last_name . "\n".
            "Phone Number:  " . $booking->phone . "\n" .
            "Car:  " . $booking->cars->name . "\n\n" .
            "################################\n\n" .
            "Last location:  " . $booking->latitude . " " . $booking->longitude;


            $messageController = new TelegramController;
            $messageController->send($ownerTelegramChatId,$message, 'HTML');

// //////////////////////////////////////////////////////////////////////////////
            $cust = User::find($booking->user_id);
            $custTelegramChatId = $cust->telegram_chat_id;

            
            $messageCust = new TelegramController;
            $messageCust = "BOOKING HAS FINISHED!\n\n" .
            "Booking name:  " . $booking->first_name . " " . $booking->last_name . "\n".
            "Phone Number:  " . $booking->phone . "\n" .
            "Car:  " . $booking->cars->name . "\n\n" .
            "################################\n\n" .
            "Thank you for choosing CAR-i. We sincerely appreciate your business and trust in our services.";


            $messageControllerCust = new TelegramController;
            $messageControllerCust->send($custTelegramChatId,$messageCust, 'HTML');

         
        }

        notify()->success('Booking has finished!');
        // Redirect back to the previous page or wherever you need
        return back();
    }

    public function review(Request $request,Booking $booking)
    {
        // Update the booking review
        $booking->review = $request->review;
        $booking->save();
        notify()->success('Review Submitted!');
        return back();
    }


    public function display($car, $pickupDateTime,$dropoffDateTime, $pickupLocation,$dayDifference)
    {
        $car = RentalCar::find($car);
        $user_id = Auth()->user()->id;
        $bookings = Booking::where('user_id', $user_id)->get();
        return view('customer.booking.show', compact('car', 'pickupDateTime','dropoffDateTime', 'pickupLocation','dayDifference','bookings'));
    }




    public function destroy($bookings)
    {
        $bookings = Booking::where('id',$bookings)->first();
        $bookings->delete();

        notify()->success('Booking deleted!');
        return redirect()->route('booking.index')
                        ->with('success','Booking deleted successfully');    
    }
}
