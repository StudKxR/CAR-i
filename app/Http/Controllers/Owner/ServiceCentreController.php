<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Maintenance;


class ServiceCentreController extends Controller
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
    public function create()
    {
        //
    }

    public function showForm($maintenance_id)
    {
        return view('owner.maintenance.emails.form', ['maintenance_id' => $maintenance_id]);
    }

    public function submitForm(Request $request)
    {
       // Validate the form data
        $request->validate([
            'service_date' => 'required|date',
            'service_description' => 'required',
        ]);

        // Process the form data and store it (replace this with your actual logic)
        $serviceDate = $request->input('service_date');
        $serviceDescription = $request->input('service_description');

        $maintenance = Maintenance::find($request->maintenance_id);

        // Update the column in RentalCar based on the last_date
        $maintenance->update([
            'maintenance_needed' => $serviceDescription,
            'service_date' => $serviceDate,
        ]);


        // Redirect back or display a thank you message
        return redirect()->route('thankyou')->with('success', 'Form submitted successfully!');
    }

    public function showMileageForm($maintenance_id)
    {
        $maintenance = Maintenance::findOrFail($maintenance_id);
        $mileage = $maintenance->cars->mileage;
        return view('owner.maintenance.emails.mileage-form', compact('maintenance_id', 'mileage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'location' => 'required',
        ]);
        
        Service::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->contact,
            'location' => $request->location,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('maintenance.index')->with('success', 'Service centre added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
