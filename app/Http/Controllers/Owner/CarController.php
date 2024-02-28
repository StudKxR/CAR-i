<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\RentalCar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\GeocodingService;

class CarController extends Controller
{

    public function index()
    {
        $userId = auth()->user()->id;
        $cars = RentalCar::where('user_id', $userId)->get();

        foreach ($cars as $car) {
            $upcomingService = $car->maintenance()
                ->whereDate('service_date', '>=', now())
                ->whereDate('service_date', '<=', now()->addDays(3))
                ->first();

            if ($upcomingService) {
                $carName = $car->name; 
                $carPlate = $car->plate; // You may adjust this based on your actual car model structure
                $maintenanceDate = Carbon::parse($upcomingService->service_date)->format('Y-m-d');
                $notificationMessage = "Service appointment for {$carName}, {$carPlate} on {$maintenanceDate}!";
                notify()->warning($notificationMessage,'Upcoming appointment!');

                $car->update(['status' => 'Not available']);
                
            }elseif ($car->status === 'Not Available' && $car->maintenance()->whereDate('service_date', '<', now())->exists()) {
                // Check if the maintenance date has passed
                // If so, update car status to "Available"
                $car->update(['status' => 'Available']);
            }

            if ($car->packages->isEmpty()) {
                $notificationMessage = "There are cars that has no package, please add one to change car status to available.";
                notify()->warning($notificationMessage,'Car package is missing');
                $car->update(['status' => 'Not available']);
            }
        }

        return view('owner.car.index', compact('cars'));
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
        return view('owner.car.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'plate' => 'required|unique:car',
            'category' => 'required',
            'mode' => 'required',
            'seats' => 'required',
            'status' => 'required',
            'aircond' => 'required',
            'pickup' => 'required',
            'luggage' => 'required',
            'price' => 'required',
            'images' => 'required',
            'mileage' => 'required',
            'date' => 'required',
        ]);

        $geocodedLocation = GeocodingService::geocode($request->pickup);

        // dd($geocodedLocation['longitude']);
        $image = null; // Initialize the $image variable

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('public/images');
            $image = basename($imagePath);
        }
        
        // Create the car record with the image filename
        RentalCar::create([
            'name' => $request->name,
            'plate' => $request->plate,
            'category' => $request->category,
            'mode' => $request->mode,
            'seats' => $request->seats,
            'status' => $request->status,
            'aircond' => $request->aircond,
            'pickup' => $request->pickup,
            'latitude' => $geocodedLocation['latitude'],
            'longitude' => $geocodedLocation['longitude'],
            'luggage' => $request->luggage,
            'rental_price' => $request->price,
            'user_id' => auth()->user()->id,
            'images' => $image, 
            'mileage' => $request->mileage,
            'last_maintenance' => $request->date,
        ]);

        notify()->success('New car has been added!');
        return redirect()->route('car.index');
    }

    public function edit(RentalCar $car)
    {
        return view('owner.car.edit',compact('car'));
    }

    public function update(Request $request, RentalCar $car)
    {
        $image = null; // Initialize the $image variable
        if ($request->hasFile('images')) {
            // Store the new image
            $imagePath = $request->file('images')->store('public/images');
            $car->images = basename($imagePath);
        }
       
        $geocodedLocation = GeocodingService::geocode($request->pickup);
        $car->update([
            'name' => $request->name,
            'plate' => $request->plate,
            'category' => $request->category,
            'mode' => $request->mode,
            'seats' => $request->seats,
            'status' => $request->status,
            'aircond' => $request->aircond,
            'pickup' => $request->pickup,
            'latitude' => $geocodedLocation['latitude'],
            'longitude' => $geocodedLocation['longitude'],
            'luggage' => $request->luggage,
            'rental_price' => $request->price,
            'user_id' => auth()->user()->id,
            'images' => $image, 
            'mileage' => $request->mileage,
            'last_maintenance' => $request->date,
        ]);  
        
       
        $car->save();
        notify()->success('Car has been updated!');
        return redirect()->route('car.index');
    }

    public function show($cars)
    {
        $cars= RentalCar::where('id',$cars)->first();
        return view('owner.car.show',compact('cars'));
    }

    public function destroy($cars)
    {
        $cars= RentalCar::where('id',$cars)->first();
        $cars->delete();

        return redirect()->route('car.index')
                        ->with('success','Car deleted successfully');    
    }
}