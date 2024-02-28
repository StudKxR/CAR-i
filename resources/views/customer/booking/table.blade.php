@section('content')
<header>
    <div class=" w-full">
        <div class="row"> 
            <div class="col-lg-12 margin-tb pb-1 justify-between"> 
                <div>
                    <h2 class="text-2xl font-medium text-black ">
                        {{ __('Your Bookings') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="py-4">
    <div class="rounded-lg shadow-sm sm:rounded-lg p-5 bg-white">
        @if ($bookings->isEmpty())
            <div class="flex justify-center items-center">
                <p class="text-xl justify-center">You have no bookings yet</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-sm ">
                <thead>
                    <tr>
                        <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Booking name</th>
                        <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800  text-left">Pickup Date</th>
                        <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Pickup Time</th>
                        <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Car name</th>
                        <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Payment Status</th>
                        <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                    </tr>
                </thead>
                @foreach($bookings as $index => $booking)
                <tbody class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                    <tr class="border border-gray-200">
                        <td class="p-4 pl-8 ">{{$booking->first_name}} {{$booking->last_name}}</td>
                        <td class="p-4">{{$booking->pickup_date}}</td>
                        <td class="p-4">{{$booking->pickup_time}}</td>
                        <td class="p-4">{{$booking->cars->name}}</td>
                        <td class="p-4">@if ($booking->status == 'Pending')
                            <span class="font-bold text-yellow-400 rounded-lg">{{$booking->status}}</span>
                        @elseif ($booking->status == 'Approved')
                            <span class="font-bold text-green-600 rounded-lg">{{$booking->status}}</span>
                        @elseif ($booking->status == 'Payment made')
                            <span class="font-bold text-blue-600 rounded-lg">{{$booking->status}}</span>
                        @elseif ($booking->status == 'Finished')
                            <span class="font-bold text-red-600 rounded-lg">{{$booking->status}}
                            @if (empty($booking->review))
                                <a data-booking-id="{{ $booking->id }}" class="bg-purple-300 text-purple-600 font-medium rounded-md p-1 hover:bg-purple-200 block flex justify-center cursor-pointer openModalButton">
                                    Write a review
                                </a>  
                            @endif
                            </span>
                        @else
                            <span class="font-bold text-red-600 rounded-lg">{{$booking->status}}</span>
                        @endif</td>
                        <td class="p-4 pr-8">
                            <div class="flex justify-around items-center space-x-2">
                                
                                @if($booking->status !== "Finished" && $booking->status !== "Canceled")  
                                <form id="locationForm{{ $booking->id }}" method="POST" action="{{ route('update.location',$booking->id) }}">
                                    @csrf
                                    <input type="hidden" id="latitudeInput{{ $booking->id }}" name="latitude">
                                    <input type="hidden" id="longitudeInput{{ $booking->id }}"name="longitude">
                                
                                    <button class="show-track  bg-green-300 text-green-600 font-medium rounded-md p-1 hover:bg-green-200 m-auto block" 
                                        data-status= "{{ $booking->status}}" 
                                        data-tracking= "{$booking->tracking}}"
                                        data-pickup-date="{{ $booking->pickup_date }}" 
                                        data-pickup-time="{{ $booking->pickup_time }}" 
                                        data-dropoff-date="{{ $booking->dropoff_date }}" 
                                        data-dropoff-time="{{ $booking->dropoff_time }}" 
                                        data-track-id="{{ $booking->id }}"
                                        latitude-value ="{{ $booking->latitude}}"
                                        longitude-value ="{{$booking->longitude}}" >
                                    @if($booking->tracking == "On")
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin w-6 h-6 z-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg> 
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                        </svg>
                                    @endif
                                    </button>
                                    
                                </form>
                                @endif
                                
                                <a href="{{route('booking.show',$booking->id)}}" class="bg-sky-300 text-blue-600 font-medium rounded-md p-1 hover:bg-sky-200 block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>  
                                @if($booking->tracking !== "On")  
                                <a class="bg-yellow-300 text-yellow-600 font-medium rounded-md p-1 hover:bg-yellow-200 m-auto block"
                                    href="{{route('booking.edit',$booking->id)}}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                
                                <form id="deleteForm" action="{{ route('booking.destroy', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="bg-red-300 text-red-600 font-medium rounded-md p-1 hover:bg-red-200 m-auto block" onclick="confirmDelete()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div> 
                        </td>
                    </tr>
                    <div class="grid grid-rows-3">
                        <!-- RENT IN PROCESS -->
                        <div>      
                            <div id="track_{{ $booking->id }}" class="hidden top-0 left-0 w-full h-full flex items-center justify-center bg-gray-500 bg-opacity-80">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <div class="flex flex-col justify-center text-center gap-4">
                                        <div id="start{{ $booking->id }}" class=" hidden flex gap-2 p-4 mb-4 car-section">
                                            Rental start in 5 seconds
                                        </div>
                                        <div id="track{{ $booking->id }}" class="hidden flex gap-2 p-4 bg-white text-green-600 border border-gray-400 rounded-lg group-hover:bg-gray-200 shadow-xl duration-300 mb-4 car-section">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="animate-spin w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg> 
                                            Rent in process
                                        </div>
                                        <div id="req{{ $booking->id }}" class=" hidden flex gap-2 p-4 mb-4 car-section">
                                            Rent requirements not fulfilled
                                        </div>
                                        @if($booking->tracking == "On")
                                        <form method="POST" action="{{ route('stop-rental', $booking->id) }}">
                                        @csrf
                                            <button type="submit" class="p-2 rounded-md hover:bg-yellow-200 bg-yellow-300 text-yellow-600 font-medium stop-rental">Pause Rental</button>
                                        </form>
                                        <form method="POST" action="{{ route('finish-rental', $booking->id) }}">
                                        @csrf
                                            <button type="submit" class="p-2 rounded-md hover:bg-red-500 bg-red-600 text-white font-medium">Finish Rental</button>
                                        </form>
                                        @endif
                                        <a href="#" class="text-red-600 font-medium close-track" data-track-id="{{ $booking->id }}">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- REVIEW -->
                        <div>
                        <form method="POST" action="{{ route('booking.review', ['booking' => ':bookingId']) }}" id="reviewForm" style="display: none;">
                            @csrf
                            @method('PUT')
                            <div id="reviewModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
                                <div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%;">
                                    <span class="close" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
                                    <h2>Write a Review</h2>
                                    <textarea name="review" id="reviewTextArea" rows="4" cols="50" placeholder="Write your review here..." style="width: 100%;"></textarea>
                                    <button type="submit" style="background-color: #FF0000; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer; width: 100%;">Submit</button>
                                </div>
                            </div>
                        </form>
                        </div>
                </tbody>
            @endforeach
            </table>
        </div>
        @endif
    </div>
</div>


<script>
    function confirmDelete() {
        // Show the confirmation dialog
        if (confirm('Are you sure you want to delete this booking?')) {
            // If confirmed, submit the form
            document.getElementById('deleteForm').submit();
        }
    }

// REVIEW


document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('reviewModal');
        var openButtons = document.querySelectorAll('.openModalButton');
        var form = document.getElementById('reviewForm');

        // Loop through all buttons and attach event listeners
        openButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var bookingId = this.getAttribute('data-booking-id');
                var action = "{{ route('booking.review', ['booking' => ':bookingId']) }}".replace(':bookingId', bookingId);
                form.setAttribute('action', action);
                modal.style.display = 'block';
            });
        });

        // Get the <span> element that closes the modal
        var span = document.querySelector('.close');

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = 'none';
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    });



















    // Function to check if geolocation tracking should start
    function shouldStartTracking(rentalStartDate, rentalEndDate) {
        var currentDate = new Date();
        return currentDate >= rentalStartDate && currentDate <= rentalEndDate;
    }

    var trackingInterval;

    function getPosition(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;
        // var form = document.getElementById('locationForm'+trackId);

        console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);

        var tracking = document.querySelector('.show-track').getAttribute('data-tracking');

        if (tracking === 'On') {
            console.log('Tracking is already On. Form submission is prevented.');
            return; // Exit the function without submitting the form
        }

         // Set the latitude and longitude in the hidden input fields
        document.getElementById('latitudeInput'+trackId).value = lat;
        document.getElementById('longitudeInput'+trackId).value = long;
     

    document.getElementById('locationForm'+trackId).submit();

    }
    

    // Function to start tracking
    function startTracking() {
        trackingInterval = setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition);
        }, 30000); // Update the position every 30 seconds
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
            const trackButtons = document.querySelectorAll('.show-track');
            trackButtons.forEach(trackButton => {
            trackButton.addEventListener('click', (e) => {
                e.preventDefault();
                trackId = trackButton.getAttribute('data-track-id');
                const pickupDate = new Date(`${trackButton.getAttribute('data-pickup-date')}T${trackButton.getAttribute('data-pickup-time')}`);
                const dropoffDate = new Date(`${trackButton.getAttribute('data-dropoff-date')}T${trackButton.getAttribute('data-dropoff-time')}`);
                const status = trackButton.getAttribute('data-status');
                const latitude = trackButton.getAttribute('latitude-value');
                const longitude = trackButton.getAttribute('longitude-value');
                

                
                const trackModal = document.getElementById('track_' + trackId);
                const tracking = document.getElementById('track'+ trackId);
                const req = document.getElementById('req'+ trackId);
                const start = document.getElementById('start'+ trackId);

                if (shouldStartTracking(pickupDate,dropoffDate) && status === 'Approved') {
                    // Display the tracking modal for the clicked row
                    trackModal.classList.remove('hidden');
                    trackModal.classList.add('fixed');

                    if ( !(latitude == 0.0 && longitude == 0.0) ) {
                        start.classList.add('hidden');
                        tracking.classList.remove('hidden');
                        startTracking();
                    } else {
                        if (!startTracking()) {
                            start.classList.remove('hidden');
                            setTimeout(function() {
                                start.classList.add('hidden');
                                tracking.classList.remove('hidden');
                            }, 5000);
                            startTracking();
                        }
                    }   
                    console.log('LEPAS');

                    const closeTrackButtons = document.querySelectorAll('.close-track');
                    closeTrackButtons.forEach(closeTrackButton => {
                        closeTrackButton.addEventListener('click', (e) => {
                            e.preventDefault();
                            const trackModal = document.getElementById('track_' + trackId);

                            // Display the tracking modal for the clicked row
                            trackModal.classList.add('hidden');
                            trackModal.classList.remove('fixed');
                        });
                    });
                } else {
                    // Handle the case when tracking should not start
                    trackModal.classList.remove('hidden');
                    trackModal.classList.add('fixed');
                    req.classList.remove('hidden');
                    console.log('TAK LEPAS');
                    const closeTrackButtons = document.querySelectorAll('.close-track');
                    closeTrackButtons.forEach(closeTrackButton => {
                        closeTrackButton.addEventListener('click', (e) => {
                            e.preventDefault();
                            const trackModal = document.getElementById('track_' + trackId);

                            // Display the tracking modal for the clicked row
                            trackModal.classList.add('hidden');
                            trackModal.classList.remove('fixed');
                        });
                    });
                }


            });
        });  
            
        @else
            console.log("Booking data is not available.");
        @endif
    };
        
</script>


@endsection