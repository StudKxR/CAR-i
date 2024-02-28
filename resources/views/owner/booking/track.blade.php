@extends('owner.layout.layout')
@section('content')
<header>
<div class=" w-full">
    <div class="row">
        <div class="col-lg-12 margin-tb pb-1 justify-between">
            <div>
            <h2 class="text-2xl font-medium text-black ">
                {{ __('Tracking') }}
                </h2>
            </div>
        </div>
    </div>
</div>
<script src="OpenLayers.js"></script>
</header>
<body>
    <div class="flex justify-center">
        <div class="p-4 bg-white shadow-sm rounded-lg group-hover:bg-gray-200 shadow-xl duration-300 mb-4 car-section" data-car-category="{{$booking->category}}">
            <div class="grid grid-cols-3 gap-4">
                <img class="h-60 object-scale-down rounded-t-xl" src="{{ asset('storage/images/' . $booking->cars->images) }}" />
                <div class="col-span-2 grid grid-cols-2 h-1/3">
                    <div class="col-span-2 py-2">
                        <h1 class="text-2xl font-bold truncate">{{$booking->first_name}} {{$booking->last_name}} ( {{$booking->phone}} )</h1>
                    </div>
                    <div class="flex flex-col gap-4 col-span-2">
                        <div class="flex gap-2 justify-between">
                            <p>{{$booking->cars->name}} ( {{$booking->cars->plate}} )</p>
                            @if($booking->tracking !== "Done")
                                <form id="deleteForm" method="POST" action="{{ route('stop-tracking', $booking->id) }}">
                                    @csrf
                                    <button type="submit" onclick="confirmDelete()" class="p-2 rounded-md hover:bg-red-500 bg-red-600 text-white font-medium stop-rental">Stop Tracking</button>
                                </form>
                            @endif
                        </div>
                    
                        <div class="md:col-span-2 flex flex-row gap-4 pt-8">
                            <div class="flex flex-col  justify-between">
                                <h2 class="font-bold">Pickup Information</h2>
                                <div class="flex gap-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    <p>{{$booking->pickup_date}}</p>
                                </div>
                                <div class="flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p>{{$booking->pickup_time}}</p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between ">
                                <h2 class="font-bold">Dropoff Information</h2>
                                <div class="flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    <p>{{$booking->dropoff_date}}</p>
                                </div>
                                <div class="flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p>{{$booking->dropoff_time}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
            </div>
        </div>
    </div>  
    <!-- <div id="map" class="h-2/3"></div> -->
    <div id="osm-map"></div>

<script>
    function confirmDelete() {
        // Show the confirmation dialog
        if (confirm('Are you sure you want to stop tracking this booking? You wont be able to track it again.')) {
            // If confirmed, submit the form
            document.getElementById('deleteForm').submit();
        }
    }



    console.log("Initializing the map");
    // var map = L.map('map').setView([14.0860746, 100.608406], 6);
    // var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    // });
    // osm.addTo(map);

    if (!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        var trackingInterval;

        function startTracking() {
            trackingInterval = setInterval(() => {
                navigator.geolocation.getCurrentPosition(getPosition);
            }, 30000);
        }

        function stopTracking() {
            clearInterval(trackingInterval);
        }

        @if($booking->tracking !== 'Done')
            startTracking();
        @endif
    }

    var marker, circle;

    function getPosition(position) {
        // var lat = position.coords.latitude;
        // var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;

        // if (marker) {
        //     map.removeLayer(marker);
        // }

        // if (circle) {
        //     map.removeLayer(circle);
        // }

        // marker = L.marker([bookingLat, bookingLng]);
        // circle = L.circle([bookingLat, bookingLng], { radius: accuracy });

        // var featureGroup = L.featureGroup([marker, circle]).addTo(map);

        // map.fitBounds(featureGroup.getBounds());

        // console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);

        @if(isset($booking) && $booking->latitude && $booking->longitude)
        var bookingLat = {{ $booking->latitude }};
        var bookingLng = {{ $booking->longitude }};


        if (marker) {
            map.removeLayer(marker);
        }

        if (circle) {
            map.removeLayer(circle);
        }

        marker = L.marker([bookingLat, bookingLng]);
        circle = L.circle([bookingLat, bookingLng],{ radius: accuracy });

        var featureGroup = L.featureGroup([marker, circle]).addTo(map);

        map.fitBounds(featureGroup.getBounds());
        // Use the latitude and longitude from the $booking model here
        // For example, you can create a marker for the booking location:
        var bookingMarker = L.marker([bookingLat, bookingLng]).addTo(map);
        
        @endif
        console.log("Destination coordinate is: Lat: " + bookingLat + " Long: " + bookingLng + " Accuracy: " + accuracy);
    }


    /////////////////

    var element = document.getElementById('osm-map');

    // Height has to be set. You can do this in CSS too.
    element.style = 'height:300px;';

    // Create Leaflet map on map element.
    var map = L.map(element);

    // Add OSM tile layer to the Leaflet map.
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Target's GPS coordinates.
    var target = L.latLng({{ $booking->latitude }}, {{ $booking->longitude }});

    // Set map's center to target with zoom 14.
    map.setView(target, 14);

    // Place a marker on the same location.
    L.marker(target).addTo(map);
</script>

</body>
@endsection