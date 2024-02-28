@section('content')
<header>
<div class=" w-full">
    <div class="flex flex-col gap-4"> 
        <div class="col-lg-12 margin-tb pb-1 flex justify-between">
            <div id="headerTitle">
                <h2 class="text-2xl font-medium text-black ">
                    {{ __('Rental Cars') }}
                </h2>
            </div>
            <div class="dropdown group ml-auto">
                <button class="px-4 items-center group rounded-lg border bg-white shadow-sm" id="dropdownBtn">
                    <div class="inline-flex justify-center items-center gap-2">
                        <span class="text-black"> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span> 
                        <span class="text-base text-black font-light">Select Table</span> 
                    </div>
                </button>

                <!-- Dropdown Content -->
                <div class="absolute hidden bg-white border rounded-lg shadow-sm mt-2 right-5"id="dropdownContent">
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('carTab', 'Rental Cars')">Rental Cars</button>
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('addOnsTab', 'Extras')">Extras</button>
                </div>
            </div>
        </div>
        <div class="group ml-auto">
            <a href="{{ route('car.create') }}"  class="px-4 py-2 items-center group rounded-lg border bg-white shadow-sm cursor-pointer" id="addNewBtn">
                <div class="inline-flex justify-center items-center gap-2">
                    <span class="text-base text-black group-hover:text-[#FE0000] duration-300 font-light">Add New</span> 
                </div>
            </a>
        </div>
    </div>
</div>
</header>


<div id="carTab" class="tab-content">
    <div class="py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if ($cars->isEmpty())
                <div class="flex justify-center items-center">
                    <p class="text-xl font-light justify-center">You have no rental cars yet</p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="table-auto w-full text-sm ">
                        <thead>
                            <tr>
                                <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Car name</th>
                                <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800  text-left">Plate number</th>
                                <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Car category</th>
                                <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Mode</th>
                                <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Status</th>
                                <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Packages</th>
                                <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                            </tr>
                        </thead>
                        @foreach ($cars as $index => $car)
                        <tbody class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                            <tr>
                                <td class="p-4 pl-8 ">{{$car->name}}</td>
                                <td class="p-4">{{$car->plate}}</td>
                                <td class="p-4">{{$car->category}}</td>
                                <td class="p-4">{{$car->mode}}</td>
                                <td class="p-4 pr-8">
                                    @if ($car->status == 'Not available')
                                        <span class="font-bold text-red-600 rounded-lg">{{$car->status}}</span>
                                    @elseif ($car->status == 'Available')
                                        <span class="font-bold text-green-600 rounded-lg">{{$car->status}}</span>
                                    @else
                                        <span class="font-bold rounded-lg">{{$car->status}}</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($car->packages->isNotEmpty())
                                        Yes
                                    @else
                                        None
                                    @endif
                                </td>
                                <td class="p-4 pr-8">
                                    
                                        <div class="flex justify-around items-center space-x-2">
                                            <a class="bg-sky-300 text-blue-600 font-medium rounded-md p-1 hover:bg-sky-200"
                                                href="{{ route('car.show',$car->id) }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </a>
                                            <a class="bg-yellow-300 text-yellow-600 font-medium rounded-md p-1 hover:bg-yellow-200 "
                                                href="{{ route('car.edit',$car->id) }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                            <form id="deleteForm" action="{{  route('car.destroy',$car->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="bg-red-300 text-red-600 font-medium rounded-md p-1 hover:bg-red-200 m-auto block" onclick="confirmDelete()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="addOnsTab" class="hidden tab-content">
    <div class="py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            @if ($cars->isEmpty())
            <div class="flex justify-center items-center">
                <p class="text-xl font-light justify-center">You have no car add ons yet</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-sm ">
                    <thead>
                        <tr>
                            <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Name</th>
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800  text-left">Add Ons</th>
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Packages</th>
                            <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                        </tr>
                    </thead>
                    @foreach ($cars as $index => $car)
                    <tbody class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <tr>
                            <td class="p-4 pl-8 ">{{$car->name}}</td>
                            <td class="p-4">
                                @if ($car->addOns->isNotEmpty())
                                    @foreach ($car->addOns as $addOn)
                                        {{ $addOn->name }}<br>
                                    @endforeach
                                @else
                                    No add-ons yet
                                @endif
                            </td>

                            <td class="p-4">
                                @if ($car->packages->isNotEmpty())
                                    @foreach ($car->packages as $package)
                                        {{ $package->name }}<br>
                                    @endforeach
                                @else
                                    No package yet
                                @endif
                            </td>

                            <td class="p-4 pr-8">
                                    <div class="flex justify-around items-center space-x-2">
                                        <a class="bg-green-300 text-green-600 font-medium rounded-md p-1 hover:bg-green-200 " href="{{ route('package.create',$car->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('package.show',$car->id) }}" class="bg-sky-300 text-blue-600 font-medium rounded-md p-1 hover:bg-sky-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>         
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            @endif
            </div>
        </div>
    </div>
</div>




<!-- ///////////////////////////////////////// -->
<script>

///////////////////////////          FORM          /////////////////////////////
    function clearForm() {
        document.getElementById('myForm').reset();
    }


    function confirmDelete() {
        // Show the confirmation dialog
        if (confirm('Are you sure you want to delete this car?')) {
            // If confirmed, submit the form
            document.getElementById('deleteForm').submit();
        }
    }



///////////////////      TABS          //////////////////////////////////


    function toggleTab(tabName) {
        const tabs = ['carTab', 'addOnsTab','packageTab'];

        tabs.forEach(tab => {
            const tabElement = document.getElementById(tab);
            if (tab === tabName) {
                tabElement.classList.remove('hidden');
            } else {
                tabElement.classList.add('hidden');
            }
        });
    }

    function updateRouteAndToggleTab(tab, title) {

        // Update the header title based on the selected tab
        document.getElementById('headerTitle').innerHTML = `<h2 class="text-2xl font-medium text-black">${title}</h2>`;

        // Update route based on the selected tab
        var addNewBtn = document.getElementById('addNewBtn');
        if (tab === 'carTab') {
            addNewBtn.classList.remove('hidden');
            addNewBtn.href = "{{ route('car.create') }}";
            // addNewBtn.removeEventListener('click', openServiceCenterForm);
        } else if (tab === 'addOnsTab') {
            // Update the route and behavior for the service center tab
            addNewBtn.classList.add('hidden');
        }

        // Toggle the tab
        toggleTab(tab);
    }


    document.addEventListener("DOMContentLoaded", function () {
        // Get the button and dropdown content
        var dropdownBtn = document.getElementById("dropdownBtn");
        var dropdownContent = document.getElementById("dropdownContent");

        // Toggle the 'hidden' class on dropdown content when the button or its child elements are clicked
        dropdownBtn.addEventListener("click", function (event) {
            if (event.target === dropdownBtn || dropdownBtn.contains(event.target)) {
                dropdownContent.classList.toggle("hidden");
            } else {
                dropdownContent.classList.add("hidden");
            }
        });

        // Close the dropdown if the user clicks outside of it
        document.addEventListener("click", function (event) {
            if (!event.target.matches("#dropdownBtn") && !dropdownBtn.contains(event.target)) {
                dropdownContent.classList.add("hidden");
            }
        });
    });




        //////////////////////           LOCATION                 ////////////////////////////////






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
</script>

@endsection