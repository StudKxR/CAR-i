<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RentalCar;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = User::where('name', 'test')->get();
        $carCount = RentalCar::count();
        return view("owner.home", compact('data',));
    }

}
