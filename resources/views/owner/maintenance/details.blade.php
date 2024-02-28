@extends('owner.layout.layout')
@section('content')

@if (Session::has('success'))
<div class="alert alert-success">
{{ Session::get('success') }}
</div> 
@endif 
<form method="POST" action="{{ route('maintenance.store') }}" id="myForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="car_id" value="{{ $car->id }}">
    <input type="hidden" name="last_date" value="{{ $car->last_maintenance}}">
    <input type="hidden" name="service" value="{{$service->id}}"> 
    <input type="hidden" name="service_email" value="{{$service->email}}"> 
<div class="grid grid-cols-3 gap-2">
    <div class="space-y-4 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white"> 
    <a href="javascript:window.history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
        <div class="mt-2 gap-x-2 gap-y-1.5">
            <div class="sm:col-span-1"> 
                <div class="p-4 bg-white border border-gray-400 rounded-lg group-hover:bg-gray-200 shadow-xl duration-300 mb-4 car-section">
                    <div class="flex flex-col">
                        <div class="grid grid-cols-3 gap-4">
                            <img class="h-60 object-scale-down rounded-t-xl" src="{{ asset('storage/images/' . $car->images) }}" />
                            <div class="col-span-2 grid grid-cols-2 h-1/3">
                                <div class="col-span-2 py-2">
                                    <h1 class="text-2xl font-bold truncate">{{$car->name}} ({{$car->plate}})</h1>
                                </div>
                                <div class="sm:col-span-2  md:flex-row md:gap-8 md:items-center">
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
                                <div class="hidden group-hover:block absolute bottom-full left-1/2 transform-translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
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
                                        Air conditioning available
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

                        <div class="col-span-2 py-4">
                            <div class="flex relative gap-2 group items-center bg-slate-100 border border-none rounded-md w-full py-2 px-2 " >
                                <div class="flex gap-2 cursor-pointer rounded truncate">    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                
                                    <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                        {{$car->pickup}}
                                    </div>
                                    <div class="truncate">
                                        {{$car->pickup}}
                                    </div>
                                </div>
                            </div>
                        </div> 

                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between">
                        <div class="m-0">
                            <p class="text-l font-bold">Current mileage:</p>
                            <p>{{$car->mileage}} km</p>
                        </div>
                        <div class=" m-0">
                            <p class="text-l font-bold">Last maintenance:</p>
                            <p>{{$car->last_maintenance}}</p>
                        </div> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!--  -->
    <!--  -->
    <div class="col-span-2 space-y-4 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white"> 
        <div class="border-b border-gray-900/10 pb-4">
    
            <p class="block text-xl font-medium leading-6 text-gray-900 pt-2">Email to service center</p>

            <div class="col-span-2 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white">
                <label for="date" class="block text-xl font-medium leading-6 text-gray-900 pt-2">Insert latest mileage</label>
                <div class="mt-2">
                    <div id="mileageError" class="text-red-600 mt-2"></div>              
                    <x-input id="mileage" class="block py-1.5 pl-1 flex-1 text-gray-900 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="mileage" oninput="showCheckboxes()"/> 
                </div>
                <p class="block text-xl font-medium leading-6 text-gray-900 pt-4">Description</p>
                <p class="block text-base font-light leading-6 text-gray-900 pb-2">Please give a description of what is wrong with the car.</p>
                <textarea id="description" name="description" rows="4" cols="50" class="rounded-md w-full"></textarea>

                <p class="block text-base font-light leading-6 text-gray-900 pt-4">Email will be send to {{$service->email}}</p>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit Email</button>
            </div>          
        </div>
    </div>
</div>
</form>

<script>
    function clearForm() {
        document.getElementById('myForm').reset();
    }
    function goBack() {
        window.history.back();
    }


    function showCheckboxes() {
        // Get the elements
        var userInput = document.getElementById('mileage').value;
        var currentMileage = parseFloat("{{$car->mileage}}");
        var checkboxContainer = document.getElementById('checkboxContainer'); // replace 'checkboxContainer' with the actual ID of your checkbox container
        var mileageError = document.getElementById('mileageError');


        // Your condition to show/hide checkboxes and submit button
        if (userInput.trim() !== '' && parseFloat(userInput) <= currentMileage) {
            mileageError.textContent = 'Please enter a mileage greater than the current mileage.';
        } else {
            mileageError.textContent = ''; // Clear the error message
        }
    }

    
</script>
@endsection