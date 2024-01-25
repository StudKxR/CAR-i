@extends('customer.layout.layout')

@section('content')

<div class="my-4">
    <form action="{{ route('car2.search') }}" method="GET" class=" p-4 rounded-lg">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="col-span-2">
                <label for="location" class="block text-gray-700 text-sm font-bold">Pickup Location</span></label>
                    <input type="text" id="location" name="location" class="form-input bg-slate-100 border border-none rounded-md w-full py-2 px-3" required list="locationSuggestions" placeholder="Enter any location">
                    <datalist id="locationSuggestions"></datalist>
            </div>       
            <div>
                <label for="pickup_datetime" class="block text-gray-700 text-sm font-bold">Pick-up Date & Time:</label>
                <input type="datetime-local" name="pickup_datetime" id="pickup_datetime" class="form-input bg-slate-100 border border-none rounded-md w-full py-2 px-3" required>
            </div>
            <div>
                <label for="dropoff_datetime" class="block text-gray-700 text-sm font-bold">Drop-off Date & Time:</label>
                <input type="datetime-local" name="dropoff_datetime" id="dropoff_datetime" class="form-input bg-slate-100 border border-none rounded-md w-full py-2 px-3" required>
            </div>
        </div>

        <div class="mt-5 flex flex-col md:flex-row md:justify-between md:items-center">
            <a href="{{ route('booking.index') }}" class="text-slate-800 hover:text-[#FE0000] hover:underline font-bold duration-300 md:mb-0 mb-4">Your Bookings: {{ $bookingCount }}</a>
            <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                Search
            </button>
        </div>
    </form>
</div>
<p class="text-2xl font-bold">What CAR-i brings to the table</p>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-4 justify-center pt-6">
    <div class="grid grid-cols-3 items-center p-4 max-w-sm h-full w-full border rounded-lg">
        <div class="ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="red" class="w-16 h-16">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
            </svg>
        </div>
        <div class="flex flex-col col-span-2 h-full">
            <p class="text-xl font-bold">Flexible rentals</p>
            <p class="text-slate-800 text-base mb-4">Cancel or change most bookings for free up to 48 hours before pick-up</p>
        </div>
    </div>
    <div class="grid grid-cols-3 items-center p-4 max-w-sm h-full w-full border rounded-lg">
        <div class="ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="red" class="w-16 h-16">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
        </div>
        <div class="flex flex-col col-span-2 h-full">
            <p class="text-xl font-bold">No hidden fees</p>
            <p class="text-slate-800 text-base mb-4">Know exactly what you're paying</p>
        </div>
    </div>
    <div class="grid grid-cols-3 items-center p-4 max-w-sm h-full w-full border rounded-lg">
        <div class="ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="red" class="w-16 h-16">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
            </svg>
        </div>
        <div class="flex flex-col col-span-2 h-full">
            <p class="text-xl font-bold">Price Match Guarantee</p>
            <p class="text-slate-800 text-base mb-4">Found the same deal for less? We'll match the price</p>
        </div>
    </div>
</div>
<!-- <div class="border shadow-xl rounded-lg p-2 bg-slate-100 text-center md:w-1/2 lg:w-1/3 xl:w-full break-words mx-auto mt-4">
    <script type="text/javascript" src="https://www.brainyquote.com/link/quotebr.js"></script>
</div> -->


<script>
    function updateLocationSuggestions() {
        // Get the input element and datalist
        var locationInput = document.getElementById('location');
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
    document.getElementById('location').addEventListener('input', updateLocationSuggestions);



    // TIME


    // Add an event listener to the drop-off datetime input
    document.getElementById('dropoff_datetime').addEventListener('input', function() {
        // Get the values of pickup and drop-off datetime inputs
        var pickupDatetime = new Date(document.getElementById('pickup_datetime').value);
        var dropoffDatetime = new Date(this.value);

        // Check if drop-off datetime is less than or equal to pickup datetime
        if (dropoffDatetime <= pickupDatetime) {
            // Display an alert or any other validation message
            alert('Drop-off date & time must be greater than pickup datetime.');
            // Reset the drop-off datetime input value
            this.value = '';
        }
    });
</script>

@endsection
