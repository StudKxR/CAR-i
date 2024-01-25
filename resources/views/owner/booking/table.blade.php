@section('content')
<header>
<div class=" w-full">
    <div class="row">
        <div class="col-lg-12 margin-tb pb-1 justify-between">
            <div>
            <h2 class="text-2xl font-medium text-black ">
                {{ __('Bookings') }}
                </h2>
            </div>
        </div>
    </div>
</div>
</header>
<div class="py-6">
    <div class="rounded-lg shadow-sm sm:rounded-lg p-5 bg-white">
            @if ($bookings->isEmpty())
            <div class="flex justify-center items-center">
                <p class="text-xl font-light justify-center">You have no bookings yet</p>
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
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Status</th>
                            <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                        </tr>
                    </thead>
                    @foreach ($bookings as $index => $booking)
                    <tbody class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <tr class="border border-gray-200">
                            <td class="p-4 pl-8 ">{{$booking->first_name}} {{$booking->last_name}}</td>
                            <td class="p-4">{{$booking->pickup_date}}</td>
                            <td class="p-4">{{$booking->pickup_time}}</td>
                            <td class="p-4">{{$booking->cars->name}}</td>
                            <td class="p-4 pr-8">
                                @if ($booking->status == 'Pending')
                                    <span class="font-bold text-yellow-400 rounded-lg">{{$booking->status}}</span>
                                @elseif ($booking->status == 'Approved')
                                    <span class="font-bold text-green-600 rounded-lg">{{$booking->status}}</span>
                                @else
                                    <span class="font-bold  rounded-lg">{{$booking->status}}</span>
                                @endif</td>
                            <td class="p-4 pr-8">
                                <div class="flex justify-around items-center space-x-2">
                                    <a id="showModal_{{ $booking->id }}"class="bg-sky-300 text-blue-600 font-medium rounded-md p-1 hover:bg-sky-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('booking2.location',$booking->id) }}"class="bg-green-300 text-emerald-600 font-medium rounded-md p-1 hover:bg-sky-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </a>
                                    <!-- Details popup -->
                                    <div id="modal_{{ $booking->id }}" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-500 bg-opacity-80">
                                        <div class="bg-white p-6 rounded-lg shadow-lg">
                                            <div class="flex flex-col justify-center text-center gap-4">
                                                
                                                <div class="p-4 bg-white rounded-lg shadow-xl mb-4 car-section" data-car-category="{{$booking->cars->category}}">
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                                        <img class="h-60 object-scale-down rounded-t-xl" src="{{ asset('storage/images/' . $booking->cars->images) }}" />
                                                        <div class="col-span-2 grid grid-cols-4 h-1/3">
                                                            <div class="col-span-4 flex flex-col gap-2 py-4 text-left">
                                                                <h1 class="text-2xl font-bold truncate">{{$booking->cars->name}} ({{$booking->cars->plate}})</h1>
                                                                <h2 class="text-xl font-semibold truncate">Booking name: {{$booking->name}}</h2>
                                                            </div>
                                                            <div class="flex flex-col gap-4">
                                                                <div class="flex relative group items-center">
                                                                    <div class="flex gap-2 cursor-pointer rounded">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                                        </svg>
                                                                        <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                                            {{$booking->cars->seats}} adult passengers
                                                                        </div>
                                                                        {{$booking->cars->seats}}
                                                                    </div>
                                                                </div>
                                                                <div class="flex relative group items-center">
                                                                    <div class="flex gap-2 cursor-pointer rounded">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                                                                        </svg>
                                                                    <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                                        {{$booking->cars->mode}} transmission
                                                                    </div>
                                                                        @if ($booking->cars->mode === 'Manual')
                                                                            M
                                                                        @elseif ($booking->cars->mode === 'Automatic')
                                                                            A
                                                                        @else
                                                                            {{$booking->cars->mode}} <!-- Display the mode if it's neither Manual nor Automatic -->
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="flex relative group items-center">
                                                                    <div class="flex gap-2 cursor-pointer rounded">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                                        </svg>
                                                                    <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                                        {{$booking->cars->luggage}} large bag(s)
                                                                    </div>
                                                                    {{$booking->cars->luggage}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col  gap-4 text-left ">
                                                                <div class="flex relative group items-center">
                                                                    <div class="flex gap-2 cursor-pointer rounded">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                                                                        </svg>
                                                                    <div class="hidden group-hover:block absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-2 py-1 rounded whitespace-nowrap">
                                                                        @if ($booking->cars->aircond === 'AC')
                                                                            AirCond available
                                                                        @elseif ($booking->cars->aircond === 'Heater')
                                                                            Heater available
                                                                        @else
                                                                            {{$booking->cars->aircond}} available <!-- Display the aircond value if it's neither AC nor Heater -->
                                                                        @endif
                                                                    </div>
                                                                        @if ($booking->cars->aircond === 'AC')
                                                                            AC
                                                                        @elseif ($booking->cars->aircond === 'Heater')
                                                                            H
                                                                        @else
                                                                            {{$booking->cars->aircond}} <!-- Display the aircond value if it's neither AC nor Heater -->
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                @if ($booking->status == 'Pending')
                                                                    <span class="font-bold  text-yellow-400 rounded-lg">{{$booking->status}}</span>
                                                                @elseif ($booking->status == 'Approved')
                                                                    <span class="font-bold  text-green-600 rounded-lg">{{$booking->status}}</span>
                                                                @else
                                                                    <span class="font-bold  rounded-lg">{{$booking->status}}</span>
                                                                @endif
                                                                </div>
                                                                <div>
                                                                    <button id="openImagePopup_{{ $booking->id }}" class="text-blue-500 hover:text-blue-700 focus:outline-none open-image-popup"  data-image-src="{{ asset('storage/images/' . $booking->images) }}">View License</button>
                                                                </div>
                                                                <!-- Image Popup -->
                                                                <div class="image-popup hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-75 z-50" data-image-popup="{{ $booking->id }}">
                                                                    <div class="bg-white p-4 max-w-lg rounded-lg shadow-lg text-center">
                                                                        <img id="popup-image_{{ $booking->id }}" src="{{ asset('storage/images/' . $booking->images) }}" class="w-full h-full"  alt="License Image" />
                                                                        <p class="mt-4 text-red-500">Click anywhere else</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="md:col-span-2 flex flex-row gap-4 justify-around">
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
                                                            <div class="col-span-3 flex justify-center pt-8">
                                                                <form action="{{ route('booking2.approve',$booking->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    @if ($booking->status == 'Pending')
                                                                    <button type="submit" class="group bg-green-500 rounded-md p-2 hover:bg-green-800"><span class="group-hover:text-white">Approve</button>
                                                                    @elseif ($booking->status == 'Approved')
                                                                    <button type="submit" class="group bg-green-500 rounded-md p-2 hover:bg-green-800 hidden"><span class="group-hover:text-white">Approve</button>
                                                                    @else
                                                                    <button type="submit" class="group bg-green-500 rounded-md p-2 hover:bg-green-800"><span class="group-hover:text-white">Approve</button>
                                                                    @endif
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            <a href="#" id="closeModal_{{ $booking->id }}" class="text-red-600 font-medium">Close</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('booking2.destroy',$booking->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-300 text-red-600 font-medium rounded-md p-1 hover:bg-red-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>   
            @endif
    </div>
</div>

<script>
        // Get all elements with class "showModal" and loop through them
        const showModalButtons = document.querySelectorAll('[id^=showModal_]');
        showModalButtons.forEach((showModalButton) => {
            showModalButton.addEventListener('click', function (e) {
                e.preventDefault();
                // Find the associated modal by extracting the ID from the button's ID
                const bookingId = this.id.split('_')[1];
                const modal = document.getElementById(`modal_${bookingId}`);
                modal.classList.remove('hidden');
            });
        });

        // Get all elements with class "closeModal" and loop through them
        const closeModalButtons = document.querySelectorAll('[id^=closeModal_]');
        closeModalButtons.forEach((closeModalButton) => {
            closeModalButton.addEventListener('click', function () {
                // Find the associated modal by extracting the ID from the button's ID
                const bookingId = this.id.split('_')[1];
                const modal = document.getElementById(`modal_${bookingId}`);
                modal.classList.add('hidden');
            });
        });

    // Get all "View License" buttons and image popups
    const openImagePopupButtons = document.querySelectorAll('.open-image-popup');
    const imagePopups = document.querySelectorAll('.image-popup');

    // Attach a click event listener to each button
    openImagePopupButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            const imageSrc = button.getAttribute('data-image-src');
            const imagePopup = imagePopups[index];

            // Find the corresponding image popup by using the unique data-image-popup attribute
            const popupImage = imagePopup.querySelector('img');
            popupImage.src = imageSrc; // Set the image source
            imagePopup.classList.remove('hidden'); // Show the popup
        });
    });

    // Close the popup when clicking outside of it
    window.addEventListener('click', (event) => {
        imagePopups.forEach(imagePopup => {
            if (event.target === imagePopup) {
                imagePopup.classList.add('hidden');
            }
        });
    });

</script>
@endsection