@extends('owner.layout.layout')
@section('content')

<header>
<div class=" w-full">
    <div class="flex flex-col gap-4"> 
        <div class="col-lg-12 margin-tb pb-1 flex justify-between">
            <div id="headerTitle">
                <h2 class="text-2xl font-medium text-black ">
                    {{ __('Add Ons') }}
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
                        <span class="text-base text-black font-light">Select Form</span> 
                    </div>
                </button>

                <!-- Dropdown Content -->
                <div class="absolute hidden bg-white border rounded-lg shadow-sm mt-2 right-5"id="dropdownContent">
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('addTab', 'Add Ons')">Add Ons</button>
                    <button class="w-full block px-4 py-2 text-base font-light hover:bg-gray-200 transition duration-300 ease-in-out" onclick="updateRouteAndToggleTab('packageTab', 'Packages')">Packages</button>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<div class="p-4 bg-white  rounded-lg shadow-xl">
    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2 grid grid-cols-2 h-1/3">
            <div class="col-span-2 py-2">
                <h1 class="text-2xl font-bold truncate">{{$car->name}} ({{$car->plate}})</h1>
            </div>
        </div>
    </div>
</div><hr>
<!-- FORM -->
<form method="POST" action="{{ route('package.store', $car->id) }}" id="myForm" enctype="multipart/form-data">
    @csrf 
    <div class="rounded-lg space-y-4 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white">
        <div id="addTab" class="tab-content">
            <div class="border-b border-gray-900/10 pb-4"> 
                <div class="grid grid-cols-2 gap-x-2 gap-y-1.5">
                    <div class="sm:col-span-2 flex justify-between">
                        <p class="text-xl font-bold leading-6 text-gray-900 pb-4">Add On</p>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-xl leading-6 text-gray-900">Item</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="name" placeholder="Item name" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="price" class="block text-xl leading-6 text-gray-900">Price</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="price" placeholder="Item price" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-xl leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="4" cols="50" class="rounded-md w-full"></textarea>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="packageTab" class="hidden tab-content">
            <div class="border-b border-gray-900/10 pb-4"> 
                <div class="grid grid-cols-2 gap-x-2 gap-y-1.5">
                    <div class="sm:col-span-2 flex justify-between">
                        <p class="text-xl font-bold leading-6 text-gray-900 pb-4 ">Package</p>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-xl leading-6 text-gray-900">Package name</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="package_name" placeholder="e.g Basic Protection" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-xl leading-6 text-gray-900">Fuel Description</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="fuel" placeholder="e.g Full to Full" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-xl leading-6 text-gray-900">Mileage Policy</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="mileage" placeholder="e.g Unlimited Mileage" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-xl leading-6 text-gray-900">Included Protection</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="protect" placeholder="e.g Theft Protection" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="name" class="block text-xl leading-6 text-gray-900">Cancellation Policy</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="cancel" placeholder="e.g Free cancellation up to 48 hour(s) before pick up" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="price" class="block text-xl leading-6 text-gray-900">Additional Price</label>
                        <div class="mt-2">
                            <x-input class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="add_price" placeholder="Additional price" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </div>
</form>

<script>

function toggleTab(tabName) {
        const tabs = ['addTab','packageTab'];

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
</script>



@endsection