<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\RentalCar;
use App\Models\Booking;
use App\Models\Maintenance;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

use PDF;

class MaintenanceController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();
        $cars = RentalCar::where('user_id', $user->id)->get();
        $services = Service::where('user_id', $user->id)->get();
        // $maintenances = [];
        // if (!$cars->isEmpty()) {
            // In your controller
            $maintenances = Maintenance::with('serviceProvider')->whereIn('car_id', $cars->pluck('id'))->get();
        // }


        foreach ($cars as $car) {
            $upcomingService = $car->maintenance()
                ->whereDate('service_date', '>=', now())
                ->whereDate('service_date', '<=', now()->addDays(3))
                ->first();

            if ($upcomingService && $upcomingService->status !== 'Done') {
                $carName = $car->name; 
                $carPlate = $car->plate; // You may adjust this based on your actual car model structure
                $maintenanceDate = Carbon::parse($upcomingService->service_date)->format('Y-m-d');
                $notificationMessage = "Service appointment for {$carName}, {$carPlate} on {$maintenanceDate}!";
                notify()->warning($notificationMessage,'Upcoming appointment!');
            }
        }

        if ($services->isEmpty()) {
            // In your controller
            notify()->warning('Please add a service center','Missing service center!');    
        }        // }
        return view('owner.maintenance.index',compact('cars','bookings','maintenances','services'));
    }

    public function show($maintenances)
    {
        $user = auth()->user();
        $maintenances= Maintenance::where('id',$maintenances)->first();
        
        return view('owner.maintenance.show',compact('maintenances','user'));
    }


    public function create()
    {
        $user = auth()->user();
        $cars = RentalCar::where('user_id', $user->id)->get();
        $services = Service::where('user_id', $user->id)->get();
        return view('owner.maintenance.create',compact('cars','services'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'mileage' => 'required',
        ]);
        $car = RentalCar::find($request->car_id);
        $past_mileage = $car->mileage;
        // Update the column in RentalCar based on the last_date
        $car->update(['mileage' => $request->mileage]);

        
        // Define a default array
        $maintenanceNeeded = [];

       
        // Create the car record with the image filename
        $newMaintenance = Maintenance::create([
            'car_id' => $request->car_id,
            'service_centre_id' => $request->service,
            'mileage' => $request->mileage,
            'description' => $request->description,
        ]);

        $newMaintenanceId = $newMaintenance->id;
        $user = auth()->user();
        $email = $user->email;
        $name = $user->name;
        $service_email = $request->service_email;
        $service = $request->service;
        $data = [
            'name' => $name,
            'car_name' => $car->name,
            'car_mode' => $car->mode,
            'mileage' => $request->mileage,
            'last_date' => $request->last_date,
            'description' => $request->description,
            'service_email' => $request->service_email,
            'maintenance_id' => $newMaintenanceId,
        ];

        Mail::send('owner.maintenance.emails.AddMaintenance',$data,
        function($message) use ($email, $name,$service_email,$service){
            $message->from($email,$name)
            ->to($service_email,$service)
            ->subject('Maintenance Schedule Created');
        });

        notify()->success('Email sent!');
        return redirect()->route('maintenance.index');
        }

    public function next(Request $request)
    {
        $carId = $request->input('id');
        $type = $request->input('type');
        $serviceId = $request->input('service');
        $date = $request->input('date');
        $service = Service::find($serviceId);
        $car = RentalCar::find($carId);

        return view('owner.maintenance.details',compact('car','type','service','date'));
    }

    public function pdf(Maintenance $maintenance)
    {
        $pdf = PDF::loadView('owner.maintenance.pdf.users', compact('maintenance'));
        
        return $pdf->stream();
    }

    public function markAsDone(Maintenance $maintenance)
    {
        $user = auth()->user();
        $email = $user->email;
        $name = $user->name;
        $service_email = $maintenance->serviceProvider->email;
        $service = $maintenance->serviceProvider->name;
        $data = [
            'name' => $name, 
            'car_name' => $maintenance->cars->name,
            'car_plate' => $maintenance->cars->plate,
            'description' => $maintenance->description,
            'maintenance_id' => $maintenance->id,
        ];

        // dd($data);

        // Mail::send('owner.maintenance.emails.thankyou',$data,
        // function($message) use ($email, $name,$service_email,$service){
        //     $message->from($email,$name)
        //     ->to($service_email,$service)
        //     ->subject('Maintenance Finished');
        // });


        // Access the related car and update the last_maintenance_date
        $maintenance->cars->update([
            'last_maintenance' => $maintenance->service_date,
        ]);

        // Mark the maintenance as done
        $maintenance->update([
            'status' => 'Done',
        ]);

        notify()->success('Maintenance Finished!');
        return redirect()->back();
    }

    public function destroy($maintenances)
    {
        $maintenances= Maintenance::where('id',$maintenances)->first();
        $maintenances->delete();

        return redirect()->route('maintenance.index')
                        ->with('success','Car deleted successfully');    
    }
}
