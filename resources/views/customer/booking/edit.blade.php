@extends('customer.layout.layout')
@section('content')
<div class="pb-2">	
	<!-- <span class="text-3xl font-bold text-black">New Booking</span> -->
    <a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-between">
    

    <div class="col-span-2 bg-slate-100 rounded-lg p-4">

        
        
        <div>
            <form method="POST" action="{{ route('booking.update',$booking->id) }}" id="myForm" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <div class="rounded-lg space-y-4 p-2 bg-white shadow-lg">
                    <div class="border-b border-gray-900/10 pb-4"> 
                        <div class="mt-2 grid grid-cols-2 gap-4">


                            <div class="sm:col-span-2 border-l-8 border-red-500"> 
                                <p class="text-2xl font-bold ml-2">Driver's Info</p>
                            </div> 
                            <div class="sm:col-span-1"> 
                                <label for="Fname" class="block text-xl font-light leading-6 text-gray-900">First name (as on passport) <span class="text-red-500">*</span></label>
                                <div class="mt-2"> 
                                    <x-input id="Fname" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="Fname" :value="$booking->first_name" /> 
                                </div> 
                            </div> 
                            <div class="sm:col-span-1"> 
                                <label for="Lname" class="block text-xl font-light leading-6 text-gray-900">Last name (as on passport) <span class="text-red-500">*</span></label>
                                <div class="mt-2"> 
                                    <x-input id="Lname" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="Lname" :value="$booking->last_name" /> 
                                </div> 
                            </div> 
                            <div class="sm:col-span-1">
                                <label for="age" class="block text-xl font-light leading-6 text-gray-900">Age Range <span class="text-red-500">*</span></label>
                                <div class="mt-2">
                                    <select id="age" name="age" class="block bg-transparent py-1.5 pl-1 flex-1 border-gray-900 rounded-md mt-1 w-full sm:text-sm sm:leading-6">
                                        <option value="" disabled>Select your age range</option>
                                        <option value="18-25" {{ old('age', $booking->age) == '18-25' ? 'selected' : '' }}>18 - 25</option>
                                        <option value="26-35" {{ old('age', $booking->age) == '26-35' ? 'selected' : '' }}>26 - 35</option>
                                        <option value="36-45" {{ old('age', $booking->age) == '36-45' ? 'selected' : '' }}>36 - 45</option>
                                        <option value="46-55" {{ old('age', $booking->age) == '46-55' ? 'selected' : '' }}>46 - 55</option>
                                        <option value="56-65" {{ old('age', $booking->age) == '56-65' ? 'selected' : '' }}>56 - 65</option>
                                        <option value="66+" {{ old('age', $booking->age) == '66+' ? 'selected' : '' }}>66+</option>
                                    </select>

                                </div>
                            </div>




                            
                            <div class="sm:col-span-2 border-l-8 border-red-500 mt-6"> 
                                <p class="text-2xl font-bold ml-2">Contact Info</p>
                            </div> 
                            <div class="sm:col-span-1"> 
                                <label for="name" class="block text-xl font-light leading-6 text-gray-900">Phone number <span class="text-red-500">*</span></label>
                                <div class=" mt-2">
                                    <x-input id="phone" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="phone" :value="$booking->phone" /> 
                                </div>
                            </div>


                            <div class="sm:col-span-2 border-l-8 border-red-500 mt-6"> 
                                <p class="text-2xl font-bold ml-2">License</p>
                            </div> 
                            <div class="sm:col-span-2"> 
                                <label for="images" class="block text-xl font-light leading-6 text-gray-900">Upload driving license <span class="text-red-500">*</span></label>
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-2 py-2">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="flex text-sm leading-6 text-gray-600 my-2">
                                            <label for="formFileSm" class="relative cursor-pointer rounded-md bg-white font-semibold text-red-600 hover:text-indigo-500">
                                                <input class="form-control form-control-sm" id="images" name="images"  type="file">
                                            </label>
                                        </div>
                                        <p class="pl-1">or drag and drop</p>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="clearForm()">Clear</button>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    onclick="return validateForm()">Save</button>
                </div>
            </form>
        </div>
        
    </div>

    </div>
    
    
    <div>
        <!-- Details -->
        <div class="p-4 flex flex-col bg-white rounded-lg border border-slate-200 shadow-md mb-4">
            <div class="grid grid-cols-4 gap-2">
                <img class="h-45 object-scale-down mt-4" src="{{ asset('storage/images/' . $car->images) }}" />
                <div class="col-span-3 grid grid-cols-2 h-1/3">


                    <div class="col-span-2 py-2">
                        <h1 class="text-2xl font-bold truncate">{{$car->name}}</h1>
                    </div>


                    <div class="sm:col-span-2 md:flex md:flex-row md:gap-4 md:items-center">
                        <div class="flex relative group items-center">
                            <div class="flex gap-2 cursor-pointer rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                            <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                {{$car->seats}} adult passengers
                            </div>
                            {{$car->seats}}
                            </div>
                        </div>


                        <div class="flex relative group items-center">
                            <div class="flex gap-2 cursor-pointer rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                                </svg>
                            <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                {{$car->mode}} transmission
                            </div>
                                @if ($car->mode === 'Manual')
                                    M
                                @elseif ($car->mode === 'Automatic')
                                    A
                                @else
                                    {{$car->mode}} <!-- Display the mode if it's neither Manual nor Automatic -->
                                @endif
                            </div>
                        </div>


                        <div class="flex relative group items-center">
                            <div class="flex gap-2 cursor-pointer rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                {{$car->luggage}} large bag(s)
                            </div>
                            {{$car->luggage}}
                            </div>
                        </div>


                        <div class="flex relative group items-center">
                            <div class="flex gap-2 cursor-pointer rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                                </svg>
                            <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                @if ($car->aircond === 'AC')
                                    AirCond available
                                @elseif ($car->aircond === 'Heater')
                                    Heater available
                                @else
                                    {{$car->aircond}} available <!-- Display the aircond value if it's neither AC nor Heater -->
                                @endif
                            </div>
                                @if ($car->aircond === 'AC')
                                    AC
                                @elseif ($car->aircond === 'Heater')
                                    H
                                @else
                                    {{$car->aircond}} <!-- Display the aircond value if it's neither AC nor Heater -->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><br><hr>

            
            <div class="flex flex-col">
                <p class="text-xl font-semibold py-2">Pick-up and Drop-off details </p>

                <div class="bg-slate-100 border border-none rounded-md w-full py-2 px-3">
                    <p class="block text-gray-700 text-base font-light">Pickup Location: {{$pickupLocation}} </p>
                    <p class="block text-gray-700 text-base font-light">Date: {{ \Carbon\Carbon::parse($pickupDateTime)->format('Y-m-d H:i') }} </p><br>
                    <p class="block text-gray-700 text-base font-light">Pickup Location: {{$pickupLocation}} </p>
                    <p class="block text-gray-700 text-base font-light">Date: {{ \Carbon\Carbon::parse($dropoffDateTime)->format('Y-m-d H:i') }} </p>
                </div>
            </div>

        </div>


        <!-- Total Price Section -->
        <div class="col-span-2 md:col-span-1 border border-slate-200 shadow-md rounded-lg p-4 sticky top-0" style="height: fit-content;">
            <div class="flex flex-col gap-2">
                <div class="text-lg font-light">
                    Total Price for {{ $dayDifference }} day(s)
                </div>
                <div class="text-sm font-light">
                    Price of Package: RM <span id="packagePrice">{{ $packagePrice }}</span>
                </div>
                <div class="text-sm font-light">
                    Price of Addons: RM <span id="addonsPrice">{{ $addonPrice }}</span>
                </div>
            </div>
            <br><hr><br>
            <div class="flex flex-col gap-2">
                <div id="totalPrice" class="text-lg font-semibold">
                    Total Price: RM <span id="totalPrice">{{ $totalPrice }}</span>
                </div>
            </div>
        </div>
    </div>
</div>   





<script>
    function clearForm() {
        document.getElementById('myForm').reset();
    }


    function validateForm() {
        // Check if all required fields are filled
        var requiredFields = ['Fname', 'Lname', 'age', 'phone', 'images'];

        for (var i = 0; i < requiredFields.length; i++) {
            var fieldName = requiredFields[i];
            var fieldValue = document.getElementById(fieldName).value;

            if (!fieldValue) {
                alert('Please fill out all required fields.');
                return false;
            }
        }

        return true;
    }





    

</script>
@endsection