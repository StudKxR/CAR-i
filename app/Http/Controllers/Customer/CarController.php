<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\RentalCar;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use App\Services\GeocodingService;

class CarController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id; // Get the ID of the authenticated user
        $cars = RentalCar::where('status', 'Available')->get();
        $count = RentalCar::where('status', 'Available')->count();
        return view('customer.car.index',compact('cars','count'));
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

    public function create()
    {
        $user_id = Auth()->user()->id;
        $bookings = Booking::where('user_id', $user_id)->get();
        return view('customer.car.create');
    }
    public function store(Request $request)
{
    return redirect()->route('car.index')->with('success', 'Car added!');
}

    public function edit(RentalCar $car)
    {
        return view('customer.car.edit');
    }

    public function update(Request $request, RentalCar $car)
    {
        return redirect()->route('car.index')
                        ->with('success','Car updated successfully.'); 

    }

    public function show($cars)
    {
        $user_id = Auth()->user()->id;
        $bookings = Booking::where('user_id', $user_id)->get();
        $cars= RentalCar::where('id',$cars)->first();
        return view('customer.car.show',compact('cars','bookings'));
    }

    public function destroy($cars)
    {
        $cars= RentalCar::where('id',$cars)->first();
        $cars->delete();

        return redirect()->route('car.index')
                        ->with('success','Car deleted successfully');    
    }

    public function search(Request $request)
    {
        $user_id = Auth()->user()->id;
        $bookings = Booking::where('user_id', $user_id)->get();

        // Validate the search criteria
        $request->validate([
            'pickup_datetime' => 'required|date',
            'dropoff_datetime' => 'required|date',
            'location' => 'required|string',
        ]);

        $pickupDateTime = $request->input('pickup_datetime');
        $dropoffDateTime = $request->input('dropoff_datetime');
        $pickupLocation = $request->input('location');




        // Parse input strings into Carbon objects
        $pickupDateTimeObject = Carbon::parse($pickupDateTime);
        $dropoffDateTimeObject = Carbon::parse($dropoffDateTime);

        // Calculate the day difference
        $dayDifference = $pickupDateTimeObject->diffInDays($dropoffDateTimeObject);
        if ($dropoffDateTimeObject->gt($pickupDateTimeObject) || ($dropoffDateTimeObject->eq($pickupDateTimeObject) && $dropoffDateTimeObject->gt($pickupDateTimeObject))) {
            $dayDifference += 1;
        }

        // Format date and time strings
        $pickupDate = $pickupDateTimeObject->toDateString();
        $pickupTime = $pickupDateTimeObject->format('H:i');

        $dropoffDate = $dropoffDateTimeObject->toDateString();
        $dropoffTime = $dropoffDateTimeObject->format('H:i');

        // Find available cars that don't have conflicting bookings
        $availableCars = RentalCar::where('status', 'Available')
        ->whereDoesntHave('bookings', function ($query) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime) {
            $query->where(function ($subQuery) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime) {
                // Check for overlapping bookings
                $subQuery->where('pickup_date', '<', $dropoffDate)
                    ->where('dropoff_date', '>', $pickupDate)
                    ->orWhere(function ($innerSubQuery) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime) {
                        $innerSubQuery->where('pickup_date', '=', $pickupDate)
                            ->where('pickup_time', '<', $dropoffTime);
                    })
                    ->orWhere(function ($innerSubQuery) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime) {
                        $innerSubQuery->where('dropoff_date', '=', $dropoffDate)
                            ->where('dropoff_time', '>', $pickupTime);
                    });
            });
        })
        ->get();

        // Filter cars based on user location
        $nearbyCars = [];
        foreach ($availableCars as $car) {
            // Access latitude and longitude directly from the car object
            $carLatitude = $car->latitude;
            $carLongitude = $car->longitude;

             // Calculate distance between car and user location
            $userLatitude = $request->input('latitude');
            $userLongitude = $request->input('longitude');
            
            $earthRadius = 6371; // Earth's radius in kilometers

            // Convert latitude and longitude from degrees to radians
            $latFrom = deg2rad($userLatitude);
            $lonFrom = deg2rad($userLongitude);
            $latTo = deg2rad($carLatitude);
            $lonTo = deg2rad($carLongitude);

            // Calculate the change in coordinates
            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            // Haversine formula
            $distance = 2 * $earthRadius * asin(
                sqrt(
                    pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)
                )
            );

            // Consider a threshold distance (e.g., 10 kilometers) for nearby cars
            if ($distance <= 10) {
                $nearbyCars[] = $car;
            }
        }

        return view('customer.car.index', compact('nearbyCars', 'pickupDateTime', 'dropoffDateTime', 'bookings','pickupLocation', 'dayDifference'));
    }


    
    

    public function getPriceRange()
    {
        $minPrice = RentalCar::min('rental_price');
        $maxPrice = RentalCar::max('rental_price');

        return response()->json(['minPrice' => $minPrice, 'maxPrice' => $maxPrice]);
    }


}
