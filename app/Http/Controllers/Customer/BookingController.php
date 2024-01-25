<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
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
    
        // Iterate through bookings to get pickup and dropoff date-time
        foreach ($bookings as $booking) {
            $booking->pickupDateTime = $booking->pickup_date . ' ' . $booking->pickup_time;
            $booking->dropoffDateTime = $booking->dropoff_date . ' ' . $booking->dropoff_time;
        }
    
        return view('customer.booking.index', compact('cars', 'bookings'));
    }
    
    // public function cust()
    // {
    //     $car = RentalCar::all();
    //     return view('customer.court.index',compact('car'));
    // }
    // public function display($car)
    // {
    //     $car= RentalCar::where('id',$car)->first();
    //     return view('customer.court.show',compact('courts'));
    // }

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


        // dd($selectedAddonsDetails);

        // Retrieve the car information based on $carId
        $car = RentalCar::find($carId);

        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();

        return view('customer.booking.create', compact('car', 'bookings', 'pickupDateTime', 'dropoffDateTime', 'pickupLocation', 'dayDifference', 'selectedPackage', 'selectedAddonsDetails'));
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
        $message = new TelegramController;

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
        if ($oldLatitude != $request->input('latitude') || $oldLongitude != $request->input('longitude')) {
            // Send the message only if the location has changed
            $message = new TelegramController;
            $message->send("<---RENTING IS IN PROCESS--->\n\nBooking name : " . $booking->name . "\nPhone Number : " . $booking->phone . "\nPickup Date : " . $booking->pickup_date . "\nPickup Time : " . $booking->pickup_time . "\nDropoff Date : " . $booking->dropoff_date . "\nDropoff Time : " . $booking->dropoff_time);
        }
    
        return back();
    }

    public function display($car, $pickupDateTime,$dropoffDateTime, $pickupLocation,$dayDifference)
    {
        $car = RentalCar::find($car);
        $user_id = Auth()->user()->id;
        $bookings = Booking::where('user_id', $user_id)->get();
        return view('customer.booking.show', compact('car', 'pickupDateTime','dropoffDateTime', 'pickupLocation','dayDifference','bookings'));
    }

    public function show($car)
    {
    //     $car= RentalCar::where('id',$car)->first();
    //     return view('customer.booking.show',compact('car'));
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
