<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\RentalCar;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

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
        if ($dropoffDateTimeObject->format('H:i') > $pickupDateTimeObject->format('H:i')) {
            $dayDifference += 1;
        }

        // Format date and time strings
        $pickupDate = $pickupDateTimeObject->toDateString();
        $pickupTime = $pickupDateTimeObject->format('H:i');

        $dropoffDate = $dropoffDateTimeObject->toDateString();
        $dropoffTime = $dropoffDateTimeObject->format('H:i');

        // dd($pickupDate,$pickupTime,$dropoffDate,$dropoffTime);
        // Find available cars that don't have conflicting bookings
        $availableCars = RentalCar::where('status', 'Available')
        ->where('pickup', $pickupLocation)
        ->whereDoesntHave('bookings', function ($query) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime, $pickupLocation) {
            $query->where(function ($subQuery) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime, $pickupLocation) {
                // Check for overlapping bookings
                $subQuery->where('pickup_date', '<', $dropoffDate)
                    ->where('dropoff_date', '>', $pickupDate)
                    ->orWhere(function ($innerSubQuery) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime, $pickupLocation) {
                        $innerSubQuery->where('pickup_date', '=', $pickupDate)
                            ->where('pickup_time', '<', $dropoffTime);
                    })
                    ->orWhere(function ($innerSubQuery) use ($pickupDate, $pickupTime, $dropoffDate, $dropoffTime, $pickupLocation) {
                        $innerSubQuery->where('dropoff_date', '=', $dropoffDate)
                            ->where('dropoff_time', '>', $pickupTime);
                    });
            })->where('pickup', '=', $pickupLocation);
        })->get();

        return view('customer.car.index', compact('availableCars', 'pickupDateTime', 'dropoffDateTime', 'bookings','pickupLocation', 'dayDifference'));
    }


    public function getPriceRange()
    {
        $minPrice = RentalCar::min('rental_price');
        $maxPrice = RentalCar::max('rental_price');

        return response()->json(['minPrice' => $minPrice, 'maxPrice' => $maxPrice]);
    }


}
