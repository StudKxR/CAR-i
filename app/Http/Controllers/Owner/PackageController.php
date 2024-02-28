<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\RentalCar;
use App\Models\AddOns;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // Find the RentalCar with the given id
        $car = RentalCar::findOrFail($id);

        return view('owner.car.package.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $carId)
    {  
        // Determine whether it's an Add On or Package based on the submitted form
        if (!is_null($request->input('package_name')) && is_null($request->input('name'))) {
            // It's a Package, so store it accordingly
            $packageData = $request->validate([
                'package_name' => 'required|string|max:255',
                'fuel' => 'required|string|max:255',
                'mileage' => 'required|string|max:255',
                'protect' => 'required|string|max:255',
                'cancel' => 'required|string|max:255',
                'add_price' => 'required|numeric',
                // Add other validation rules as needed for Packages
            ]);
        
            $package = new Package();
            $package->car_id = $carId;
            $package->name = $packageData['package_name'];
            $package->fuel_description = $packageData['fuel'];
            $package->mileage_policy = $packageData['mileage'];
            $package->included_protection = $packageData['protect'];
            $package->cancellation_policy = $packageData['cancel'];
            $package->add_price = $packageData['add_price'];
            // Add other fields as needed for Packages
            $package->save();
        }else if(is_null($request->input('package_name')) && !is_null($request->input('name'))){
            // It's an Add On, so store it accordingly
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
            ]);
        
            $addOn = new AddOns();
            $addOn->car_id = $carId;
            $addOn->name = $validatedData['name'];
            $addOn->price = $validatedData['price'];
            $addOn->description = $validatedData['description'];
            // Add other fields as needed for Add Ons
            $addOn->save();
        }else {
            $packageData = $request->validate([
                'package_name' => 'required|string|max:255',
                'fuel' => 'required|string|max:255',
                'mileage' => 'required|string|max:255',
                'protect' => 'required|string|max:255',
                'cancel' => 'required|string|max:255',
                'add_price' => 'required|numeric',
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
                // Add other validation rules as needed for Packages
            ]);

                $package = new Package();
                $package->car_id = $carId;
                $package->name = $packageData['package_name'];
                $package->fuel_description = $packageData['fuel'];
                $package->mileage_policy = $packageData['mileage'];
                $package->included_protection = $packageData['protect'];
                $package->cancellation_policy = $packageData['cancel'];
                $package->add_price = $packageData['add_price'];
                // Add other fields as needed for Packages
                $package->save();



                $addOn = new AddOns();
                $addOn->car_id = $carId;
                $addOn->name = $packageData['name'];
                $addOn->price = $packageData['price'];
                $addOn->description = $packageData['description'];
                // Add other fields as needed for Add Ons
                $addOn->save();
           
        }        
        $car = RentalCar::findOrFail($carId);

        // Update the status of the car to "Available"
        $car->update(['status' => 'Available']);
    
        // Redirect back or wherever you want after saving
        notify()->success('Finished!');
        return redirect()->back();
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the RentalCar with the given id
        $car = RentalCar::with('addOns', 'packages')->findOrFail($id);

        return view('owner.car.package.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Determine whether it's an Add On or Package based on the submitted form
        if ($request->input('package_name')) {
        
            $package = Package::findOrFail($id);

            // Update the package with the validated data
            $package->update([
                'name' => $request->package_name,
                'fuel_description' => $request->fuel,
                'mileage_policy' => $request->mileage,
                'included_protection' => $request->protect,
                'cancellation_policy' => $request->cancel,
                'add_price' => $request->PackPrice,
                // Add other fields as needed
            ]);
        }else {
        
            $addOn = AddOns::findOrFail($id);
        
            $addOn->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                // Add other fields as needed for Add Ons
            ]);
        }
        notify()->success('Changed!');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $type = $request->input('type');

        if ($type === 'addon') {
            // Delete addon
            $id= Addons::where('id',$id)->first();
            $id->delete();
        } elseif ($type === 'package') {
            // Delete package
            $id= Package::where('id',$id)->first();
            $id->delete();
        } 
        notify()->success('Delete Successful!');
        return redirect()->back();
    }
}
