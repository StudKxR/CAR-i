@extends('customer.layout.layout')
@section('content')
<div class="pb-2">	
	<!-- <span class="text-3xl font-bold text-black">New Booking</span> -->
    <a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-between">
    

    <div class="col-span-2 bg-slate-100 rounded-lg p-4">

        <!-- Details -->
        <div class="p-4 flex flex-col bg-white rounded-lg shadow-xl mb-4">
            <div class="grid grid-cols-4 gap-4">
                <img class="h-60 object-scale-down rounded-t-xl" src="{{ asset('storage/images/' . $car->images) }}" />
                <div class="col-span-3 grid grid-cols-2 h-1/3">


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
                        <hr>
                    </div>

                    <div class="col-span-2 ">
                        <p class="text-xl font-semibold">Reviews <a href="#reviewSection">
                                <span class="text-base font-light underline">
                                    ( {{ $car->bookings->filter(function($booking) { return !empty($booking->review); })->count() }} reviews )
                                </span>
                            </a>
                        </p>
                    </div>
                </div>
            </div><hr>

            
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
        
        <!-- Package -->
        <div class="p-4 flex flex-col bg-white rounded-lg shadow-xl mb-4">
            <div class="flex flex-col gap-4">
                <p class="text-xl font-semibold">Package Selection <span class="text-red-500">*</span></p>

                @if($car->packages->isNotEmpty())
                    <div class="flex gap-4">
                        @foreach($car->packages as $package)
                        <div
                            onclick="selectPackage(this, '{{ $package->id }}', '{{ $package->fuel_description }}', '{{ $package->mileage_policy }}', '{{ $package->included_protection }}', '{{ $package->cancellation_policy }}')"
                            class="cursor-pointer border border-none rounded-md py-2 px-3 bg-slate-200"
                            data-package-id="{{ $package->id }}"
                            data-package-price="{{ $package->add_price }}">
                            <p class="mb-1">{{ $package->name }}</p>
                            <p>+ RM {{ $package->add_price }}</p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p>No packages available for this car.</p>
                @endif

                <div id="packageDetails" class="rounded-md bg-white">
                    <div class="rounded-t-md bg-slate-300 p-4 pb-2">
                        <p class="text-lg font-semibold">Package Details</p>
                    </div>

                    <div id="selectedPackageDetails" class="flex gap-4 p-4 bg-slate-100 rounded-b-md">
                        <!-- Details will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Add Ons -->
        <div class="p-4 flex flex-col bg-white rounded-lg shadow-xl mb-4">
            <div class="flex flex-col gap-4">
                <p class="text-lg font-semibold">Choose Add-Ons</p>

                <div class="rounded-md bg-white">
                    @if($car->addOns->isNotEmpty())
                        <div class="flex flex-col gap-4 p-4 bg-slate-100 rounded-md">
                            @foreach($car->addOns as $addOn)
                                <div class="flex gap-2 items-center">
                                    <div class="w-2/4">
                                        <p class="block text-gray-700 text-base font-semibold">{{ $addOn->name }}</p>
                                        <p class="block text-gray-700 text-base font-light">{{ $addOn->description }}</p>
                                    </div>
                                    <div class="w-1/4 flex justify-center">
                                        <p class="block text-gray-700 text-base font-light">RM {{ $addOn->price }} per rental</p>
                                    </div>
                                    <div class="w-1/4 flex justify-center">
                                        <button 
                                            data-price="{{ $addOn->price }}" 
                                            data-addon-id="{{ $addOn->id }}" 
                                            class="bg-blue-500 text-white shadow-lg hover:bg-blue-400 px-4 py-2 rounded-full focus:outline-none select-addon">
                                            Select
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No add-ons available for this car.</p>
                    @endif
                </div>
            </div>
        </div>


        <!-- Review -->
        <div id="reviewSection" class="p-4 flex flex-col bg-white rounded-lg shadow-xl">
            <div class="flex flex-col gap-4">                
                <p class="text-xl font-semibold">Reviews <span class="text-base font-light underline">( {{ $car->bookings->filter(function($booking) { return !empty($booking->review); })->count() }} reviews ) </span></p>

                @if($car->bookings->isEmpty())
                    <p>No reviews yet.</p>
                @else
                    <ul>
                        @foreach($car->bookings as $booking)
                            @if($booking->review)
                                <li><span class="text-red-500">*</span> {{ $booking->review }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        
    </div>

    
    <!-- Total Price Section -->
    <div class="col-span-2 md:col-span-1 border border-slate-200 rounded-lg p-4 sticky top-10" style="height: fit-content;">
        <div class="flex flex-col gap-2">
            <div class="text-lg font-light">
                Total Price for {{ $dayDifference }} day(s)
            </div>
            <div class="text-sm font-light">
                Price of Package: RM <span id="packagePrice">0.00</span>
            </div>
            <div class="text-sm font-light">
                Price of Addons: RM <span id="addonsPrice">0.00</span>
            </div>
        </div>

        <br><hr><br>
        <div class="flex flex-col gap-2">
            <div id="totalPrice" class="text-lg font-semibold">
                Total Price: RM {{ $car->rental_price * $dayDifference }}
            </div>
        </div>

        <br><hr><br>

        <div class="flex justify-center w-full drop-shadow-xl">
          
            <a id="nextStepLink" class="cursor-pointer bg-red-600 hover:bg-red-500 p-2 px-4 text-white rounded-lg" onclick="submitForm()">Next Step</a>
        </div>
    </div>

</div>   


     





<script>
    function clearForm() {
        document.getElementById('myForm').reset();
    }

    function submitForm() {

        // Check if selectedPackageId is set
        if (!selectedPackageId) {
            // If not set, show an alert or perform any other action to inform the user
            alert("Please select a package before proceeding to the next step.");
            return; // Prevent further execution
        }


        // Build the URL with all parameters
        var baseUrl = "{{ route('booking.create') }}";
        var queryParams = `?car={{ $car->id }}&pickupDateTime={{ $pickupDateTime }}&dropoffDateTime={{ $dropoffDateTime }}&pickupLocation={{ $pickupLocation }}&dayDifference={{ $dayDifference }}&selectedPackageId=${selectedPackageId}`;

        // Append selectedAddons to the URL if it's not empty
        if (Object.keys(selectedAddons).length > 0) {
            queryParams += `&selectedAddons=${JSON.stringify(selectedAddons)}`;
        }

        // Update the href attribute with the constructed URL
        var nextStepLink = document.getElementById('nextStepLink');
        nextStepLink.href = baseUrl + queryParams;

        // Perform any asynchronous operations if needed, then submit the form
        // document.getElementById('yourFormId').submit();
    }


    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });



    var selectedPackageId = null; // Variable to store the currently selected package ID
    var selectedPackagePrice = 0;

    function selectPackage(element, id, fuelDescription, mileagePolicy, includedProtection, cancellationPolicy) {
        // Clear the background color for the previously selected package div
        if (selectedPackageId !== null) {
            var prevSelectedPackageDiv = document.querySelector(`[data-package-id="${selectedPackageId}"]`);
            if (prevSelectedPackageDiv) {
                prevSelectedPackageDiv.style.backgroundColor = '#F3F4F6';
            }
        }

        // Set the background color for the selected package div
        element.style.backgroundColor = '#D1D5DB';
        
        // Update the selected package ID
        selectedPackageId = id;

         // Retrieve the package price from the data attribute
        selectedPackagePrice = parseFloat(element.getAttribute('data-package-price'));


        // Display the selected package details
        var detailsContainer = document.getElementById('selectedPackageDetails');
        detailsContainer.innerHTML = `
            <div class="flex flex-col gap-2">
                <p class="block text-gray-700 text-base font-light">Fuel Description: ${fuelDescription}</p>
                <p class="block text-gray-700 text-base font-light">Mileage Policy: ${mileagePolicy}</p>
                <p class="block text-gray-700 text-base font-light">Included Protection: ${includedProtection}</p>
                <p class="block text-gray-700 text-base font-light">Cancellation Policy: ${cancellationPolicy}</p>
            </div>
        `;

        
        updateTotalPrice(selectedPackagePrice);
    }


    var selectedAddons = {}; // Object to store selected addons with their prices
  

    function toggleAddonSelection(button) {
        var addonId = button.getAttribute('data-addon-id');
        var price = parseFloat(button.getAttribute('data-price'));

        if (selectedAddons[addonId]) {
            // Addon is already selected, so deselect it
            button.classList.remove('bg-green-500');
            button.classList.remove('hover:bg-green-400');
            button.classList.add('bg-blue-500');
            button.classList.add('hover:bg-blue-400');
            button.innerText = 'Select';
            delete selectedAddons[addonId];
        } else {
            // Addon is not selected, so select it
            button.classList.remove('bg-blue-500');
            button.classList.remove('hover:bg-blue-400');
            button.classList.add('bg-green-500');
            button.classList.add('hover:bg-green-400');
            button.innerText = 'Selected';
            selectedAddons[addonId] = price;
        }

        // Update the total price
        updateTotalPrice(selectedPackagePrice);
    }

    function updateTotalPrice(selectedPackagePrice) {
        // Calculate total price
        var carPrice = {{ $car->rental_price * $dayDifference }}; 
        

        console.log("carPrice:", carPrice);
        console.log("selectedPackagePrice:", selectedPackagePrice);
        console.log("selectedAddons:", selectedAddons);


        
        var totalAddon = Object.values(selectedAddons).reduce(function (acc, addonPrice) {
            return acc + addonPrice;
        }, 0);

        var totalPrice = carPrice + selectedPackagePrice  + totalAddon;

        // Display the total price
        document.getElementById('packagePrice').innerText = "" + selectedPackagePrice.toFixed(2);
        document.getElementById('addonsPrice').innerText = "" + totalAddon.toFixed(2);
        document.getElementById('totalPrice').innerText = "Total Price: RM " + totalPrice.toFixed(2);
    }

    // Attach event listeners to all addon buttons
    var addonButtons = document.querySelectorAll('.select-addon');
    addonButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            toggleAddonSelection(button);
        });
    });

    
</script>
@endsection