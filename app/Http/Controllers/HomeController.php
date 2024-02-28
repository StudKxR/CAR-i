<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RentalCar;
use App\Models\Booking;
use App\Models\Package;
use App\Models\BookingPackage;
use App\Models\Addons;
use App\Models\BookingAddon;
use Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $roles = Auth::user()->roles;

        if ($roles == '2') {
            return $this->custDashboard();
        } elseif ($roles == '1') {
            return $this->ownerDashboard();
        } else {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
    }

    public function custDashboard(){
        $user_id = Auth()->user()->id;
        $carCount = RentalCar::where('status', 'Available')->count();
        $bookingCount = Booking::where('user_id', $user_id)->count();
        $bookings = Booking::where('user_id', $user_id)->get();
        return view('customer.home', compact('carCount', 'bookingCount', 'bookings'));
    
    }

    public function ownerDashboard(){
        $user_id = Auth()->user()->id;

        $bookingsPerMonth = Booking::where('user_id', $user_id)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $carCount = RentalCar::where('user_id', $user_id)->count();
        $cars = RentalCar::where('user_id', $user_id)->get();

        $bookingCount = Booking::whereHas('cars', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->count();

        $bookingsPerMonth = Booking::whereHas('cars', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->selectRaw('MONTH(pickup_date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        // Extracting data for JavaScript
        $months = $bookingsPerMonth->pluck('month')->toArray();
        $counts = $bookingsPerMonth->pluck('count')->toArray();

        // Compact an array to store the count of bookings for each car
        $bookingsCountByCar = [];

        foreach ($cars as $car) {
            // Get the count of bookings for each car
            $bookingsCountByCar[$car->id] = $car->bookings()->count();

            // Check for upcoming service
            $upcomingService = $car->maintenance()->whereDate('service_date', '>=', now())
                ->whereDate('service_date', '<=', now()->addDays(3))
                ->first();

            if ($upcomingService) {
                $carName = $car->name;
                $carPlate = $car->plate;
                $maintenanceDate = Carbon::parse($upcomingService->service_date)->format('Y-m-d');
                $notificationMessage = "Service appointment for {$carName}, {$carPlate} on {$maintenanceDate}!";
                notify()->warning($notificationMessage, 'Upcoming appointment!');
            }
        }

        return view('owner.home', compact('cars', 'carCount', 'bookingsCountByCar', 'bookingCount', 'months', 'counts'));
    
    }
}
