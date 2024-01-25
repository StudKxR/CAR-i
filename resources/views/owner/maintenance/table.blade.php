@section('content')
<header>
<div class=" w-full">
    <div class="flex flex-col gap-4"> 
        <div class="col-lg-12 margin-tb pb-1 flex justify-between">
            <div id="headerTitle">
                <h2 class="text-2xl font-medium text-black ">
                    {{ __('Maintenance Schedule') }}
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
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('maintenanceTab', 'Maintenance Schedule')">Maintenance</button>
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('serviceCenterTab', 'Service Centre')">Service Center</button>
                </div>
            </div>
        </div>
        <div class="group ml-auto">
            <a href="{{ route('maintenance.create') }}"  class="px-4 py-2 items-center group rounded-lg border bg-white shadow-sm cursor-pointer" id="addNewBtn">
                <div class="inline-flex justify-center items-center gap-2">
                    <span class="text-base text-black group-hover:text-[#FE0000] duration-300 font-light">Add New</span> 
                </div>
            </a>
        </div>
        <!-- Service Center Form Popup -->
        <div class="fixed inset-0 bg-black bg-opacity-50 hidden transition-opacity duration-300" id="serviceCenterFormPopup" onclick="closeServiceCenterForm()">
            <div class="flex justify-center items-center h-screen">
                <div class="bg-white p-8 rounded-lg w-96 transition-transform duration-300 transform scale-0" id="serviceCenterFormContent" onclick="stopPropagation(event)">
                    <!-- Your Service Center Form Goes Here -->
                    <form method="POST" action="{{ route('service.store') }}" id="myForm">
                        @csrf
                        <h2 class="text-2xl font-medium text-black mb-4">Add Service Center</h2> <!-- Title added -->

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <!-- Contact Field -->
                        <div class="mb-4">
                            <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                            <input type="text" id="contact" name="contact" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <!-- Location Field -->
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" id="location" name="location" class="mt-1 p-2 w-full border rounded-md" list="locationSuggestions">
                            <datalist id="locationSuggestions"></datalist>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-sm font-light leading-6 text-gray-900 hover:underline" onclick="clearForm()">Clear</button>
                            <button type="submit" class="bg-[#FE0000] text-white text-sm font-light p-2 rounded-md">Submit</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</header>


<div id="maintenanceTab" class="tab-content">
    <div class="py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            @if ($maintenances->isEmpty())
            <div class="flex justify-center items-center">
                <p class="text-xl font-light justify-center">You have no schedules yet</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-sm ">
                    <thead>
                        <tr>
                            <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Car</th>
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Service Centre</th>
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800  text-left">Maintenance Date</th>
                            <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                        </tr>
                    </thead>
                    @foreach ($maintenances as $index => $maintenance)
                    <tbody class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <tr class="border border-gray-200">
                            <td class="p-4 pl-8 ">{{$maintenance->cars->name}}</td>
                            <td class="p-4">{{$maintenance->serviceProvider->name}}</td>
                            <td class="p-4 pr-8">
                                {!! $maintenance->service_date ? $maintenance->service_date : '<span class="text-yellow-400">Reply Pending</span>' !!}
                            </td>
                            <td class="p-4 pr-8">
                                    <div class="flex justify-around items-center space-x-2">
                                        <a href="{{ route('maintenance.show',$maintenance->id) }}" class="bg-sky-300 text-blue-600 font-medium rounded-md p-1 hover:bg-sky-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('maintenance.destroy',$maintenance->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-300 text-red-600 font-medium rounded-md p-1 hover:bg-red-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg></button>
                                        </form>
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

<div id="serviceCenterTab" class="hidden tab-content">
    <div class="py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            @if ($services->isEmpty())
            <div class="flex justify-center items-center">
                <p class="text-xl font-light justify-center">You have no service centre yet</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-sm ">
                    <thead>
                        <tr>
                            <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Name</th>
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800  text-left">Email</th>
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Phone</th>
                            <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Location</th>
                            <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                        </tr>
                    </thead>
                    @foreach ($services as $index => $service)
                    <tbody class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <tr class="border border-gray-200">
                            <td class="p-4 pl-8 ">{{$service->name}}</td>
                            <td class="p-4">{{$service->email}}</td>
                            <td class="p-4">{{ $service->phone }}</td>
                            <td class="p-4 pr-8">{{$service->location}}</td>
                            <td class="p-4 pr-8">
                                    <div class="flex justify-around items-center space-x-2">
                                        <a href="{{ route('service.show',$service->id) }}" class="bg-sky-300 text-blue-600 font-medium rounded-md p-1 hover:bg-sky-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>                            
                                        <form action="{{ route('service.destroy',$service->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-300 text-red-600 font-medium rounded-md p-1 hover:bg-red-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg></button>
                                        </form>
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






///////////////////      TABS          //////////////////////////////////


    function toggleTab(tabName) {
        const tabs = ['maintenanceTab', 'serviceCenterTab'];

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
        if (tab === 'maintenanceTab') {
            addNewBtn.href = "{{ route('maintenance.create') }}";
            addNewBtn.removeEventListener('click', openServiceCenterForm);
        } else if (tab === 'serviceCenterTab') {
            // Update the route and behavior for the service center tab
            addNewBtn.removeAttribute('href');
            addNewBtn.addEventListener('click', openServiceCenterForm);
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

    function openServiceCenterForm() {
            // Show the Service Center Form Popup
            var popup = document.getElementById("serviceCenterFormPopup");
            var content = document.getElementById("serviceCenterFormContent");
            
            popup.classList.remove("hidden");
            content.style.transform = "scale(1)";
        }

        function closeServiceCenterForm() {
            // Close the Service Center Form Popup
            var popup = document.getElementById("serviceCenterFormPopup");
            var content = document.getElementById("serviceCenterFormContent");

            content.style.transform = "scale(0)";
            setTimeout(function () {
                popup.classList.add("hidden");
            }, 300); // Match the duration of the transition
        }
        function stopPropagation(event) {
            // Prevent the click event from propagating to the parent (popup), which would trigger the close event
            event.stopPropagation();
        }




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