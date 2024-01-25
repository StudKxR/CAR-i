<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RentalCar;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CustController extends Controller
{
    public function index()
    {
        $customers = User::where('roles', '2')->get();
        return view('owner.customer.index',compact('customers'));
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
        
    }

    public function update(Request $request, RentalCar $car)
    {

    }

    public function show($cars)
    {
       
    }

    public function destroy($customers)
    {
        $customers= User::where('id',$customers)->first();
        $customers->delete();

        return redirect()->route('customer.index')
                        ->with('success','Customer deleted successfully');    
    }
}