@extends('owner.layout.layout')
@section('content')

<header>
<div class=" w-full">
    <div class="flex flex-col gap-4"> 
        <div class="col-lg-12 margin-tb pb-1 flex justify-between">
            <h2 class="text-2xl font-medium text-black ">
                {{ __('Extras') }}
            </h2>
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
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('addOnsTab', 'Add Ons')">Add Ons</button>
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('packageTab', 'Packages')">Packages</button>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<div class="w-full">
    <div class="pt-4">
        <div class="p-4 bg-white rounded-xl shadow-lg mb-4 ">  
            <div class=" grid grid-cols-2 h-1/3">
                <div class="col-span-2 py-4">
                    <p class="text-2xl font-bold truncate">{{$car->name}} - {{$car->plate}}</p>
                </div>
                <div class="col-span-2 py-2">
                    <div id="headerTitle">
                        <h2 class="text-2xl font-medium text-black ">
                            {{ __('Add Ons') }}
                        </h2>
                    </div>
                </div>
                <div class="col-span-2 py-2">


                    <div id="addOnsTab" class=" tab-content">
                        <table class="table-auto w-full text-sm ">
                            <thead>
                                <tr>
                                    <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Name</th>
                                    <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800  text-left">Description</th>
                                    <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Price</th>
                                    <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                                </tr>
                            </thead>
                            @foreach ($car->addOns as $addOn)
                            <tbody>
                                <tr>
                                    <td class="p-4 pl-8 ">{{ $addOn->name }}</td>
                                    <td class="p-4">{{ $addOn->description }}</td>
                                    <td class="p-4">{{ $addOn->price }}</td>
                                    <td class="p-4 pr-8">
                                            <div class="flex justify-around items-center space-x-2">
                                                <a onclick="openModal('{{ $addOn->id }}','{{ $addOn->name }}','{{ $addOn->description }}','{{ $addOn->price }}')" class="bg-yellow-300 text-yellow-600 font-medium rounded-md p-1 hover:bg-yellow-200 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </a>
                                                <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden"></div>
                                                <div id="editAddonModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                                    <div class="flex items-center justify-center min-h-screen">
                                                        <div class="bg-white w-1/3 p-6 rounded shadow-lg">
                                                            <!-- Your edit form can go here -->
                                                            <form id="editForm" method="POST" action="{{ route('package.update',$addOn->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Your form fields go here -->
                                                                <h2 class="text-2xl font-medium text-black mb-4">Edit Add on</h2> <!-- Title added -->

                                                                <!-- Name Field -->
                                                                <div class="mb-4">
                                                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                                                    <input type="text" id="editName" name="name" class="mt-1 p-2 w-full border rounded-md">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="name" class="block text-sm font-medium text-gray-700">Description</label>
                                                                    <input type="text" id="editDesc" name="description" class="mt-1 p-2 w-full border rounded-md">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="name" class="block text-sm font-medium text-gray-700">Price</label>
                                                                    <input type="text" id="editPrice" name="price" class="mt-1 p-2 w-full border rounded-md">
                                                                </div>
                                                                
                                                                
                                                                <!-- Add other fields as needed -->
                                                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                                                    <!-- Close modal button -->
                                                                    <button type="button" onclick="closeModal()" class="bg-gray-600 text-white text-sm font-light p-2 rounded-md">Close</button>
                                                                    <button type="submit" class="bg-[#FE0000] text-white text-sm font-light p-2 rounded-md">Submit</button>
                                                                </div>
                                                            </form>

                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('package.destroy',$addOn->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="type" value="addon">
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



                    <div id="packageTab" class="hidden tab-content">
                        <table class="table-auto w-full text-sm ">
                            <thead>
                                <tr>
                                    <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Name</th>
                                    <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Fuel Description</th>
                                    <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Milelage Policy</th>
                                    <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Included Protection</th>
                                    <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Cancellation Policy</th>
                                    <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800 text-left">Price</th>
                                    <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                                </tr>
                            </thead>
                            @foreach ($car->packages as $package)
                            <tbody>
                                <tr>
                                    <td class="p-4 pl-8 ">{{ $package->name }}</td>
                                    <td class="p-4">{{ $package->fuel_description }}</td>
                                    <td class="p-4">{{ $package->mileage_policy }}</td>
                                    <td class="p-4">{{ $package->included_protection }}</td>
                                    <td class="p-4">{{ $package->cancellation_policy }}</td>
                                    <td class="p-4">{{ $package->add_price}}</td>
                                    <td class="p-4 pr-8">
                                            <div class="flex justify-around items-center space-x-2">
                                                <a onclick="openPackageModal('{{ $package->id }}','{{ $package->name }}','{{ $package->fuel_description }}','{{ $package->mileage_policy }}','{{ $package->included_protection }}','{{ $package->cancellation_policy }}','{{ $package->add_price}}')" 
                                                    class="bg-yellow-300 text-yellow-600 font-medium rounded-md p-1 hover:bg-yellow-200 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </a>
                                                <div id="overlayPackage" class="fixed inset-0 bg-black opacity-50 hidden"></div>
                                                <div id="editPackageModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                                    <div class="flex items-center justify-center min-h-screen">
                                                        <div class="bg-white w-1/3 p-6 rounded shadow-lg">
                                                            <!-- Your edit form can go here -->
                                                            <form id="editPackForm" method="POST" action="{{ route('package.update',$package->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- Your form fields go here -->
                                                                <h2 class="text-2xl font-medium text-black mb-4">Edit Package</h2> <!-- Title added -->

                                                                <div class="flex flex-wrap -mx-2 mb-4">
                                                                    <!-- First Row -->
                                                                    <div class="w-1/2 px-2 mb-4">
                                                                        <label for="editPackName" class="block text-sm font-medium text-gray-700">Name</label>
                                                                        <input type="text" id="editPackName" name="package_name" class="mt-1 p-2 w-full border rounded-md">
                                                                    </div>
                                                                    <div class="w-1/2 px-2 mb-4">
                                                                        <label for="editFuel" class="block text-sm font-medium text-gray-700">Fuel Description</label>
                                                                        <input type="text" id="editFuel" name="fuel" class="mt-1 p-2 w-full border rounded-md">
                                                                    </div>

                                                                    <!-- Second Row -->
                                                                    <div class="w-1/2 px-2 mb-4">
                                                                        <label for="editMileage" class="block text-sm font-medium text-gray-700">Mileage Policy</label>
                                                                        <input type="text" id="editMileage" name="mileage" class="mt-1 p-2 w-full border rounded-md">
                                                                    </div>
                                                                    <div class="w-1/2 px-2 mb-4">
                                                                        <label for="editProtect" class="block text-sm font-medium text-gray-700">Included Protection</label>
                                                                        <input type="text" id="editProtect" name="protect" class="mt-1 p-2 w-full border rounded-md">
                                                                    </div>

                                                                    <!-- Third Row -->
                                                                    <div class="w-1/2 px-2 mb-4">
                                                                        <label for="editCancel" class="block text-sm font-medium text-gray-700">Cancellation Policy</label>
                                                                        <input type="text" id="editCancel" name="cancel" class="mt-1 p-2 w-full border rounded-md">
                                                                    </div>
                                                                    <div class="w-1/2 px-2 mb-4">
                                                                        <label for="editPackPrice" class="block text-sm font-medium text-gray-700">Price</label>
                                                                        <input type="text" id="editPackPrice" name="add_price" class="mt-1 p-2 w-full border rounded-md">
                                                                    </div>
                                                                </div>

                                                                <!-- Add other fields as needed -->
                                                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                                                    <!-- Close modal button -->
                                                                    <button type="button" onclick="closePackageModal()" class="bg-gray-600 text-white text-sm font-light p-2 rounded-md">Close</button>
                                                                    <button type="submit" class="bg-[#FE0000] text-white text-sm font-light p-2 rounded-md">Submit</button>
                                                                </div>
                                                            </form>                              
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('package.destroy',$package->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="type" value="package">
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
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
        </div>
    </div>
</div>


<script>
     function toggleTab(tabName) {
        const tabs = [ 'addOnsTab','packageTab'];

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








    function openModal(id,name,desc,price) {
        document.getElementById('editAddonModal').classList.remove('hidden');
        document.getElementById('overlay').classList.remove('hidden');
        // Set the form fields based on the data of the clicked row

        document.getElementById('editForm').action = "{{ url('package') }}/" + id;
        document.getElementById('editName').value = name;
        document.getElementById('editDesc').value = desc;
        document.getElementById('editPrice').value = price;
        // Add other fields as needed
    }

    function closeModal() {
        document.getElementById('overlay').classList.add('hidden');
        document.getElementById('editAddonModal').classList.add('hidden');
    }



    function openPackageModal(id,name,fuel,mile,protect,cancel,price) {
        document.getElementById('editPackageModal').classList.remove('hidden');
        document.getElementById('overlayPackage').classList.remove('hidden');
        // Set the form fields based on the data of the clicked row

        document.getElementById('editPackForm').action = "{{ url('package') }}/" + id;
        document.getElementById('editPackName').value = name;
        document.getElementById('editFuel').value = fuel;
        document.getElementById('editMileage').value = mile;
        document.getElementById('editProtect').value = protect;
        document.getElementById('editCancel').value = cancel;
        document.getElementById('editPackPrice').value = price;
        // Add other fields as needed
    }

    function closePackageModal() {
        document.getElementById('overlayPackage').classList.add('hidden');
        document.getElementById('editPackageModal').classList.add('hidden');
    }
</script>
@endsection