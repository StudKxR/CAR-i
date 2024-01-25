<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\RentalCar;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id; // Get the ID of the authenticated user
        $bookings = Booking::whereHas('cars', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return view('owner.booking.index',compact('bookings'));
    }

    public function location($id)
    {
        $booking = Booking::find($id);
        return view('owner.booking.track',compact('booking'));
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

    }
    public function store(Request $request)
    {

    }

    public function edit(RentalCar $car)
    {
        return view('owner.car.edit',compact('car'));
    }

    public function update(Request $request, RentalCar $car)
    {
        
       
        // $car->update([
        //     'name' => $request->name,
        //     'plate' => $request->plate,
        //     'category' => $request->category,
        //     'mode' => $request->mode,
        //     'seats' => $request->seats,
        //     'status' => $request->status,
        //     'color' => $request->color,
        // ]);  
        // if ($request->hasFile('images')) {
        //     // Store the new image
        //     $imagePath = $request->file('images')->store('public/images');
        //     $car->images = basename($imagePath);
        // }
        // $car->save();
        // return redirect()->route('car.index')
        //                 ->with('success','Car updated successfully.'); 

    }

    public function approve($booking)
    {
        $book = Booking::find($booking);
        $book->status = 'Approved';
        $book->save();

        return redirect()->back()->with('message','Status Apporved');
    }

    public function show($cars)
    {
        // $cars= RentalCar::where('id',$cars)->first();
        // return view('owner.car.show',compact('cars'));
    }

    public function destroy($bookings)
    {
        $bookings= Booking::where('id',$bookings)->first();
        $bookings->delete();

        return redirect()->route('booking2.index')
                        ->with('success','Booking deleted successfully');    
    }
}