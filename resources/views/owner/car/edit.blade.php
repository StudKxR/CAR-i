@extends('owner.layout.layout')
@section('content')

<div class=" w-full">
    <div class="flex flex-col gap-4"> 
        <div class="col-lg-12 margin-tb pb-1 flex justify-between">
            <div id="headerTitle">
                <h2 class="text-2xl font-medium text-black ">
                    {{ __('Edit Rental Car') }}
                </h2>
            </div>
        </div>
    </div>
</div>
</header>
<form method="POST" action="{{ route('car.update',$car->id) }}" id="myForm" enctype="multipart/form-data">
    @csrf 
    @method('PUT')
    <div class="rounded-lg space-y-4 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white"> 
        <div class="border-b border-gray-900/10 pb-4"> 
            <div class="mt-2 grid grid-cols-2 gap-x-4 gap-y-4">
                <div class="sm:col-span-1"> 
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Car name <span class="text-red-500">*</span></label>
                    <div class="mt-2"> 
                        <x-input id="name" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="name" value="{{$car->name}}" /> 
                    </div> 
                </div> 
                <div class="sm:col-span-1"> 
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Car plate number <span class="text-red-500">*</span></label>
                    <div class=" mt-2">
                        <x-input id="plate" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="plate" value="{{$car->plate}}"  />
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="seats" class="block text-xl font-medium leading-6 text-gray-900">Car seats <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-input id="seats" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="seats" value="{{$car->seats}}" />
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="category" class="block text-xl font-medium leading-6 text-gray-900">Car category <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select id="category" name="category"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>{{$car->category}}</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Economy">Economy</option>
                            <option value="Compact">Compact</option>
                            <option value="SUV">SUV</option>
                            <option value="Convertible">Convertible</option>
                            <option value="Van">Van</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="mode" class="block text-xl font-medium leading-6 text-gray-900">Car mode <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select id="mode" name="mode"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>{{$car->mode}}</option>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Status <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select id="status" name="status"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>{{$car->status}}</option>
                            <option value="Available">Available</option>
                            <option value="Not available">Not available</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="aircond" class="block text-xl font-medium leading-6 text-gray-900">Air Conditioning / Heater <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select id="aircond" name="aircond"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>{{$car->aircond}}</option>
                            <option value="AC">Air Conditioning</option>
                            <option value="Heater">Heater</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="pickup" class="block text-xl font-medium leading-6 text-gray-900">Pickup Location <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <x-input type="text" id="pickup" name="pickup" placeholder="{{$car->pickup}}" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" list="locationSuggestions"/>
                        <datalist id="locationSuggestions"></datalist>
                    </div>
                </div>
                <div class="sm:col-span-1"> 
                    <label for="luggage" class="block text-xl font-medium leading-6 text-gray-900">Luggage Capacity <span class="text-red-500">*</span></label>
                    <div class=" mt-2">
                        <x-input id="luggage" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="luggage" value="{{$car->luggage}}" />
                    </div>
                </div>
                <div class="sm:col-span-1"> 
                    <label for="price" class="block text-xl font-medium leading-6 text-gray-900">Rental Price <span class="text-red-500">*</span></label>
                    <div class=" mt-2">
                        <x-input id="price" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="price" value="{{$car->rental_price}}" />
                    </div>
                </div>
                <div class="sm:col-span-1"> 
                    <label for="mileage" class="block text-xl font-medium leading-6 text-gray-900">Current mileage <span class="text-red-500">*</span></label>
                    <div class=" mt-2">
                        <x-input id="mileage" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="mileage" value="{{$car->mileage}}" />
                    </div>
                </div>
                <div class="sm:col-span-1"> 
                    <label for="date" class="block text-xl font-medium leading-6 text-gray-900">Last maintenance <span class="text-red-500">*</span></label>
                    <div class=" mt-2">
                        <x-input id="date" class="block bg-transparent py-1.5 pl-1 flex-1 border border-gray-00 rounded-md mt-1 w-full sm:text-sm sm:leading-6" type="date" name="date" value="{{$car->last_maintenance}}"/>
                    </div>
                </div>
                <div class="col-span-full">
                    <label for="cover-photo" class="block text-xl font-medium leading-6 text-gray-900">Car photo <span class="text-red-500">*</span></label>
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
    <a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="clearForm()">Clear</button>
        <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>


<script>
    function clearForm() {
        document.getElementById('myForm').reset();
    }



    function updateLocationSuggestions() {
        // Get the input element and datalist
        var locationInput = document.getElementById('pickup');
        var locationDatalist = document.getElementById('locationSuggestions');

        // Clear existing suggestions
        locationDatalist.innerHTML = '';

        // Fetch location suggestions from the API
        fetch('https://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + locationInput.value)
            .then(response => response.json())
            .then(data => {
                // Add suggestions to the datalist
                data.forEach(place => {
                    var option = document.createElement('option');
                    option.value = place.display_name;
                    locationDatalist.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching location suggestions:', error));
    }

    // Attach the updateLocationSuggestions function to the input's input event
    document.getElementById('pickup').addEventListener('input', updateLocationSuggestions);
</script>
@endsection