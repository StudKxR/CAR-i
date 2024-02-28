@extends('customer.layout.layout')
@section('content')
<!-- show pop up details -->
<div class="w-full h-full flex items-center justify-center ">
    <div class="bg-white p-6 rounded-xl shadow-lg sm:w-2/3 md:w-1/2 lg:w-4/5 ">
        <div class="p-4 flex flex-col bg-white rounded-lg shadow-xl ">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 ">
                <img class="md:h-60 sm:h-20 object-scale-down rounded-t-xl" src="{{ asset('storage/images/' . $booking->cars->images) }}"alt="Car Image" />
                <div class="col-span-3 grid grid-cols-2 h-1/3">


                    <div class="col-span-2 py-2">
                        <h1 class="text-2xl font-bold truncate">{{$booking->cars->name}}</h1>
                    </div>


                    <div class="sm:col-span-2 flex md:gap-8 sm:gap-4 md:items-center">
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
                    </div>

                    <div class="col-span-2 py-4 pb-2">
                        <hr>
                    </div>

                    <div class="flex flex-col col-span-2">
                        <div class="flex flex-col gap-2 justify-center pb-2">
                            <div>
                                <p class="text-xl font-semibold py-2">Payment Status: 
                                @if ($booking->status == 'Pending')
                                <span class="font-bold text-yellow-400 rounded-lg">{{$booking->status}}  🤔   </span>
                                @elseif ($booking->status == 'Approved')
                                    <span class="font-bold text-green-600 rounded-lg">{{$booking->status}} 👍 </span>
                                @elseif ($booking->status == 'Payment made')
                                    <span class="font-bold text-blue-600 rounded-lg">{{$booking->status}} 💳</span>
                                @else
                                    <span class="font-bold text-red-600 rounded-lg">{{$booking->status}}</span>
                                @endif
                            </p>
                            </div>
                            
                            @if (!empty($booking->review))
                                <div class="flex relative group items-center">
                                    <div class="flex gap-1 rounded">
                                        <p class="text-l font-semibold">Review:</p>
                                        <p class="text-l font-base text-ellipsis overflow-hidden ">{{$booking->review}}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        @if ($booking->status == 'Pending')
                        <div class="flex justify-center pb-2">
                            <a href="{{ route('toyyibpay-create', ['bookingId' => $booking->id, 'totalPrice' => $totalPrice]) }}"target="_blank"class="font-base p-2 rounded-md shadow-md bg-green-300 text-green-600 hover:bg-green-400 hover:shadow-lg transition duration-300 ease-in-out">Make Payment</a>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <p class="text-xl font-semibold py-2">Pick-up & Drop-off</p>
                        </div>

                        <div class="flex justify-between bg-slate-100 border border-none rounded-md w-full py-2 px-3 ">
                            <div>
                                <p class="block text-gray-700 text-base font-light">Pickup Location: {{$booking->location}} </p>
                                <p class="block text-gray-700 text-base font-light">Pickup Date: {{ $pickupDateTime}} </p>
                                <p class="block text-gray-700 text-base font-light">Drop off Location: {{$booking->location}} </p>
                                <p class="block text-gray-700 text-base font-light">Drop off Date: {{$dropoffDateTime}} </p>
                            </div>

                            <div>
                                <div class="text-lg font-light">
                                    Total Price for {{ $dayDifference }} day(s)
                                </div>
                                <div class="text-sm font-light">
                                    Price of Package: RM <span id="packagePrice">{{ $packagePrice }}</span>
                                </div>
                                <div class="text-sm font-light">
                                    Price of Addons: RM <span id="addonsPrice">{{ $addonPrice }}</span>
                                </div>
                                <hr>
                                <div id="totalPrice" class="text-lg font-semibold">
                                    Total Price: RM {{ $totalPrice}}
                                </div>
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
@endsection