<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>CAR-i</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,400&display=swap"
        rel="stylesheet">


    {{-- Link Tailwind Components --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />

    {{-- Script Tailwind Components --}}
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    @vite('resources/css/app.css')

    {{-- Script import --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    @notifyCss
    

</head>

<body class="">
    {{-- sidebar with nav links --}}
    <nav class="py-4 px-10 bg-white shadow md:flex md:items-center md:justify-between  border-b border-[#FE0000] ">
        <div class="flex justify-between items-center ">
            <a href="{{route('dashboard')}}" class="text-xl text-[#FE0000] font-semibold cursor-pointer mx-4 my-6 md:my-0">CAR-i</a>    
            <span class="text-3xl cursor-pointer mx-2 md:hidden block">
                <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
            </span>
        </div>

        <ul class="md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-white w-full  left-0 md:w-auto md:py-0 py-4 md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-300">
            <li class="mx-4 my-6 md:my-0">
                <a href="{{route('dashboard')}}" class="text-xl font-light hover:text-[#FE0000]  duration-200">Home</a>
            </li>
            <li class="mx-4 my-6 md:my-0">
                <a href="{{route('booking.index')}}" class="text-xl font-light hover:text-[#FE0000]  duration-200">Booking</a>
            </li>
            {{--User Profile--}} 
            <div x-data="{ isShow: false }">
                <div class="relative inline-block" @click.away="isShow = false">
                    <button @click="isShow = !isShow" class="inline-flex text-xl font-light hover:text-[#FE0000] duration-200 mx-4 my-6 md:my-0">Profile</button>
                    <div x-cloak x-show="isShow"
                        x-transition:enter="transition ease-out origin-top-right duration-200"
                        x-transition:enter-start="opacity-0 transform scale-90 translate-x-0"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-x-0"
                        x-transition:leave="transition origin-top-right ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-x-0"
                        x-transition:leave-end="opacity-0 transform scale-90 translate-x-0"
                        class="text-left absolute right-0">
                        <div class="flex-shrink">
                            <div class="w-40 bg-white border drop-shadow-xl rounded-md">
                                <nav class="flex flex-col space-y-2 w-full py-4 px-4">
                                    <a href="{{ route('profile.edit') }}" class="w-full rounded-lg text-left">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="hover:text-[#FE0000] font-light duration-200">Edit profile</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('settings.index') }}" class="w-full rounded-lg text-left">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="hover:text-[#FE0000] font-light duration-200">Settings</span>
                                        </div>
                                    </a>
                                    {{-- Logout --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit(); " class="hover:text-[#FE0000] font-light duration-200">Logout</a>
                                    </form>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
            <h2 class=""></h2>
        </ul>
    </nav>
    <div class="h-full mx-10 mt-2">
        <div class="text-center flex flex-col">
            <a class="text-3xl font-semibold  ">Welcome to <span class="text-[#FE0000]">CAR-i!</span></a>
            <a class="text-lg font-normal">Search and discover your favorite Rental Cars</a>
        </div><br>
        {{-- Content --}}
        @include('notify::components.notify')
        @yield('content')
        @foreach($bookings as $booking)
        <div class="tracking flex flex-row w-full h-full bg-white "data-status= "{{ $booking->status}}" 
        data-pickup-date="{{ $booking->pickup_date }}" data-dropoff-date="{{ $booking->dropoff_date }}" 
        data-track-id="{{ $booking->id }}" latitude-value ="{{ $booking->latitude}}" longitude-value ="{{$booking->longitude}}" >        
            <form id="locationForm{{ $booking->id }}" method="POST" action="{{ route('update.location',$booking->id) }}">
                @csrf
                <input type="hidden" id="latitudeInput{{ $booking->id }}" name="latitude">
                <input type="hidden" id="longitudeInput{{ $booking->id }}"name="longitude">
            </form>          
        </div>
        @endforeach
    </div>
    
<script>
//NAVBAR
    function Menu(e){
        let list = document.querySelector('ul');
        e.name === 'menu' ? (e.name = "close",list.classList.add('top-[80px]') , list.classList.add('opacity-100'),list.classList.add('z-40')) :( e.name = "menu" ,list.classList.remove('top-[80px]'),list.classList.remove('opacity-100'),list.classList.remove('z-auto'))
    }


//////////


    // Function to check if geolocation tracking should start
    function shouldStartTracking(rentalStartDate, rentalEndDate) {
        var currentDate = new Date();
        return currentDate >= rentalStartDate && currentDate <= rentalEndDate;
    }

    let trackId;
    var trackingInterval;

    function getPosition(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;
        // var form = document.getElementById('locationForm'+trackId);

        console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);

         // Set the latitude and longitude in the hidden input fields
        document.getElementById('latitudeInput'+trackId).value = lat;
        document.getElementById('longitudeInput'+trackId).value = long;
     

    document.getElementById('locationForm'+trackId).submit();

    }
    

    // Function to start tracking
    function startTracking() {
        trackingInterval = setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition);
        }, 5000); // Update the position every 5 seconds
    }

    function updatePosition(position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;

        }

    // Check if geolocation is supported
    if (!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!");
    } else {
        // Check if the booking data is available
        @if(isset($booking))
            // Get the pickup date from the server-side (PHP)
            const trackDiv = document.querySelector('.tracking');

            // Get the attribute values
            trackId = trackDiv.getAttribute('data-track-id');
            const pickupDate = new Date(trackDiv.getAttribute('data-pickup-date'));
            const dropoffDate = new Date(trackDiv.getAttribute('data-dropoff-date'));
            const status = trackDiv.getAttribute('data-status');
            const latitude = trackDiv.getAttribute('latitude-value');
            const longitude = trackDiv.getAttribute('longitude-value');
                

                
                const trackModal = document.getElementById('track_' + trackId);
                const tracking = document.getElementById('track'+ trackId);
                const req = document.getElementById('req'+ trackId);
                const start = document.getElementById('start'+ trackId);

                if (shouldStartTracking(pickupDate,dropoffDate) && status === 'Approved') {
                    // Display the tracking modal for the clicked row

                    if ( !(latitude == 0.0 && longitude == 0.0) ) {
                        startTracking();
                    } else {
                        if (!startTracking()) {
                            startTracking();
                        }
                    }  
                }
            
        @else
            console.log("Booking data is not available.");
        @endif
    };
</script>

@notifyJs
</body>

</html>
