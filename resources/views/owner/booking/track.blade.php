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
                        <h1 class="text-2xl font-bold truncate">{{$booking->name}}  ( {{$booking->phone}} )</h1>
                    </div>
                    <div class="flex flex-col gap-4 col-span-2">
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                            <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z"/>
                            <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z"/>
                            </svg>
                            <p>{{$booking->cars->name}} ( {{$booking->cars->plate}} )</p>
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
    console.log("Initializing the map");
    // var map = L.map('map').setView([14.0860746, 100.608406], 6);
    // var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    // });
    // osm.addTo(map);

    if (!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition)
        }, 5000);
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