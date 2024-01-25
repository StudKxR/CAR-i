@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 pb-4">
    <div class="col-span-2">
        <label for="pickup" class="block text-gray-700 text-sm font-bold">Pickup Location</label>
        <input readonly value="{{$pickupLocation}}" type="text" id="pickup" name="pickup" class="form-input bg-slate-100 border border-none rounded-md w-full py-2 px-3" >
    </div>       
    <div>
        <label for="pickup_datetime" class="block text-gray-700 text-sm font-bold">Pick-up Date & Time:</label>
        <input readonly value="{{ \Carbon\Carbon::parse($pickupDateTime)->format('Y-m-d H:i') }}" type="datetime-local" name="pickup_datetime" id="pickup_datetime" class="form-input bg-slate-100 border border-none rounded-md w-full py-2 px-3">
    </div>
    <div>
        <label for="dropoff_datetime" class="block text-gray-700 text-sm font-bold">Drop-off Date & Time:</label>
        <input readonly value="{{ \Carbon\Carbon::parse($dropoffDateTime)->format('Y-m-d H:i') }}" type="datetime-local" name="dropoff_datetime" id="dropoff_datetime" class="form-input bg-slate-100 border border-none rounded-md w-full py-2 px-3" >
    </div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-between">

    <!-- FILTER -->
    <div class="col-span-2 md:col-span-1 border border-slate-200 rounded-lg p-4"style="height: fit-content;">
        <div class="flex justify-between items-center">
            <div class="text-lg font-semibold">
                Filter
            </div>
            <button id="clear-filter-button" class="text-gray-800 hover:text-gray-500 font-light">
                Clear Filter
            </button>
        </div>
        
        <hr><br>
        <div class="flex flex-col justify-between text-center gap-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                            <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z"/>
                            <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z"/>
                        </svg>
                    <select id="category-select" class="rounded-md w-full bg-white border border-slate-300 p-2">
                        <option value="All">All</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Economy">Economy</option>
                        <option value="Compact">Compact</option>
                        <option value="SUV">SUV</option>
                        <option value="Convertible">Convertible</option>
                        <option value="Van">Van</option>
                    </select>
                </div>
                <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                        </svg>
                    <select id="transmission-select" class="rounded-md w-full bg-white border border-slate-300 p-2">
                        <option value="All">All</option>
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    <select id="seats-select" class="rounded-md w-full bg-white border border-slate-300 p-2">
                        <option value="All">All</option>
                        <option value="1-2">1-2 seats</option>
                        <option value="3-5">3-5 seats</option>
                        <option value="6+">6 or more seats</option>
                    </select>
                </div>
                <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                        </svg>
                    <select id="aircond-heater-select" class="rounded-md w-full bg-white border border-slate-300 p-2">
                        <option value="All">All</option>
                        <option value="AC">Aircond</option>
                        <option value="Heater">Heater</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    <select id="luggage-select" class="rounded-md w-full bg-white border border-slate-300 p-2">
                        <option value="All">All</option>
                        <option value="1-2">1-2 Luggages</option>
                        <option value="3-4">3-4 Luggages</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex gap-2 items-center col-span-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <select id="price-select" class="rounded-md w-full bg-white border border-slate-300 p-2">
                        <option value="All">All</option>
                        <option value="0-200">MYR 0 - MYR 200</option>
                        <option value="200-400">MYR 200 - MYR 400</option>
                        <option value="400-600">MYR 400 - MYR 600</option>
                        <option value="600-800">MYR 600 - MYR 800</option>
                        <option value="800+">MYR 800 +</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    <!-- DISPLAY -->
    <div class="col-span-2 bg-slate-100 rounded-lg p-4">
    @if(!$availableCars->isEmpty())
        @foreach($availableCars as $car)
            <div class="p-4 bg-white rounded-lg group-hover:bg-gray-200 shadow-xl duration-300 mb-4 car-section" 
            data-car-category="{{$car->category}}" data-car-mode="{{$car->mode}}" data-car-seats="{{$car->seats}}" 
            data-car-aircond="{{$car->aircond}}" data-car-luggage="{{$car->luggage}}" data-car-price="{{$car->rental_price * $dayDifference }}">
                
            <div class="grid grid-cols-4 gap-4">
                    <img class="h-60 object-scale-down rounded-t-xl" src="{{ asset('storage/images/' . $car->images) }}" />
                    <div class="col-span-2 grid grid-cols-2 h-1/3">


                        <div class="col-span-2 py-2">
                            <h1 class="text-2xl font-bold truncate">{{$car->name}}</h1>
                        </div>


                        <div class="sm:col-span-2 md:flex md:flex-row md:gap-8 md:items-center">
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

                        <div class="col-span-2 py-4">
                            <div class="flex relative gap-2 group items-center bg-slate-100 border border-none rounded-md w-full py-2 px-2 " >
                                <div class="flex gap-2 cursor-pointer rounded truncate">    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                
                                    <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                        {{$pickupLocation}}
                                    </div>
                                    <div class="truncate">
                                        {{$pickupLocation}}
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="col-span-2">
                            <hr>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="py-2 flex sm:flex-col md:flex-row justify-between gap-2">
                                <div>
                                    @if($car->packages->isNotEmpty())
                                        <div class="flex relative flex-col gap-2 group items-center">
                                            <div class="flex gap-2 cursor-pointer rounded">    
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                                <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                    Fuel Description: {{$car->packages->first()->fuel_description}}
                                                </div>
                                                <div class="truncate w-40">
                                                    {{$car->packages->first()->fuel_description}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex relative flex-col gap-2 group items-center">
                                            <div class="flex gap-2 cursor-pointer rounded">    
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                                <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                    Mileage Policy: {{$car->packages->first()->mileage_policy}}
                                                </div>
                                                <div class="truncate w-40">
                                                    {{$car->packages->first()->mileage_policy}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    @if($car->packages->isNotEmpty())
                                        <div class="flex relative flex-col gap-2 group items-center">
                                            <div class="flex gap-2 cursor-pointer rounded">    
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                                <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                    Included Protection: {{$car->packages->first()->included_protection}}
                                                </div>
                                                <div class="truncate w-40">
                                                    {{$car->packages->first()->included_protection}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex relative flex-col gap-2 group items-center">
                                            <div class="flex gap-2 cursor-pointer rounded">    
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                                <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                    Cancellation Policy: {{$car->packages->first()->cancellation_policy}}
                                                </div>
                                                <div class="truncate w-40">
                                                    {{$car->packages->first()->cancellation_policy}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="flex flex-col justify-between border-l py-2">
                        <div class="flex justify-center">
                            <div class="flex flex-col">
                                <p>Total</p>
                                <p id="totalPrice" class="text-2xl font-bold">RM {{ $car->rental_price * $dayDifference }}</p>
                                <p>For {{$dayDifference}} day(s)</p>
                            </div>
                        </div>
                        <div class="flex justify-center w-full drop-shadow-xl">
                            <a href="{{ route('booking.display', ['car' => $car->id, 'pickupDateTime' => $pickupDateTime , 'dropoffDateTime' => $dropoffDateTime, 'pickupLocation' => $pickupLocation, 'dayDifference'=> $dayDifference]) }}" 
                             class="bg-red-600 hover:bg-red-500 p-2 px-4 text-white rounded-lg">View Deal</a>
                        </div>
                    </div>   
                </div>
            </div>
        @endforeach
    @else
    <div class="flex justify-center">
        <p class="text-2xl font-bold">No cars available for the selected dates and location.</p>
    </div>
    @endif
    </div>
</div>



<div class="flex justify-center p-6">
<a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>

</div>


<script>
    const availableCars = @json($availableCars);
    const categorySelect = document.getElementById('category-select');
    const transmissionSelect = document.getElementById('transmission-select');
    const seatsSelect = document.getElementById('seats-select');
    const aircondHeaterSelect = document.getElementById('aircond-heater-select');
    const luggageSelect = document.getElementById('luggage-select');
    const priceSelect = document.getElementById('price-select'); // Add this line

    const cars = document.querySelectorAll('.car-section');
    const carCountElement = document.getElementById('car-count');
    const allCarsCount = availableCars.length;
    const clearFilterButton = document.getElementById('clear-filter-button');
    const carCountText = ' cars available';

    function updateCarVisibility() {
        let visibleCarCount = 0;

        cars.forEach(car => {
            car.style.display = 'none';

            const carCategory = car.getAttribute('data-car-category');
            const carTransmission = car.getAttribute('data-car-mode');
            const carSeats = parseInt(car.getAttribute('data-car-seats'));
            const carAircondHeater = car.getAttribute('data-car-aircond');
            const carLuggage = parseInt(car.getAttribute('data-car-luggage'));
            const carPrice = parseInt(car.getAttribute('data-car-price')); // Add this line

            const categoryFilter = categorySelect.value;
            const transmissionFilter = transmissionSelect.value;
            const seatsFilter = seatsSelect.value;
            const aircondHeaterFilter = aircondHeaterSelect.value;
            const luggageFilter = luggageSelect.value;
            const priceFilter = priceSelect.value; // Add this line

            const isCategoryMatch = categoryFilter === 'All' || carCategory === categoryFilter;
            const isTransmissionMatch = transmissionFilter === 'All' || carTransmission === transmissionFilter;
            const isSeatsMatch = seatsFilter === 'All' ||
                (seatsFilter === '1-2' && carSeats >= 1 && carSeats <= 2) ||
                (seatsFilter === '3-5' && carSeats >= 3 && carSeats <= 5) ||
                (seatsFilter === '6+' && carSeats >= 6);
            const isAircondHeaterMatch = aircondHeaterFilter === 'All' || carAircondHeater === aircondHeaterFilter;
            const isLuggageMatch = luggageFilter === 'All' ||
                (luggageFilter === '1-2' && carLuggage >= 1 && carLuggage <= 2) ||
                (luggageFilter === '3-4' && carLuggage >= 3 && carLuggage <= 4);
            const isPriceMatch = priceFilter === 'All' ||
                (priceFilter === '0-200' && carPrice >= 0 && carPrice <= 200) ||
                (priceFilter === '200-400' && carPrice >= 200 && carPrice <= 400) ||
                (priceFilter === '400-600' && carPrice >= 400 && carPrice <= 600) ||
                (priceFilter === '600-800' && carPrice >= 600 && carPrice <= 800) ||
                (priceFilter === '800+' && carPrice >= 800);

            if (isCategoryMatch && isTransmissionMatch && isSeatsMatch && isAircondHeaterMatch && isLuggageMatch && isPriceMatch) {
                car.style.display = 'block';
                visibleCarCount++;
            }
        });

        carCountElement.textContent = `${visibleCarCount}${carCountText}`;
    }

    categorySelect.addEventListener('change', updateCarVisibility);
    transmissionSelect.addEventListener('change', updateCarVisibility);
    seatsSelect.addEventListener('change', updateCarVisibility);
    aircondHeaterSelect.addEventListener('change', updateCarVisibility);
    luggageSelect.addEventListener('change', updateCarVisibility);
    priceSelect.addEventListener('change', updateCarVisibility); // Add this line


    // Event listener for the "Clear Filter" button
    clearFilterButton.addEventListener('click', clearAllFilters);


    // Function to clear all filters
    function clearAllFilters() {
        categorySelect.value = 'All';
        transmissionSelect.value = 'All';
        seatsSelect.value = 'All';
        aircondHeaterSelect.value = 'All';
        luggageSelect.value = 'All';
        priceSelect.value = 'All';
        // Add additional code to reset price filter if applicable

        // Update car visibility after clearing filters
        updateCarVisibility();
    }



</script>


@endsection