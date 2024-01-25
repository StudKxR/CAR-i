@extends('owner.layout.layout')
@section('content')


<form method="POST" action="{{ route('maintenance.details') }}" id="myForm" enctype="multipart/form-data">
    @csrf 
    <div class="space-y-4 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white"> 
        <div class="border-b border-gray-900/10 pb-4"> 
            <div class="mt-2 grid grid-cols-2 gap-x-2 gap-y-1.5">
                <div class="sm:col-span-1"> 
                    <label for="id" class="block text-xl font-medium leading-6 text-gray-900">Car Name <span class="text-red-500">*</span></label>
                    <div class="mt-2"> 
                        <select id="id" name="id"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>Choose car</option>
                            @foreach ($cars as $car)
                            <option value="{{$car->id}}">{{$car->name}} ({{$car->plate}})</option>
                            @endforeach
                        </select>  
                    </div> 
                </div> 
                <!-- <div class="sm:col-span-1"> 
                    <label for="type" class="block text-xl font-medium leading-6 text-gray-900">Maintenance Type <span class="text-red-500">*</span></label>
                    <div class=" mt-2">
                        <select id="type" name="type"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>Choose maintenance type</option>
                            <option value="Milage-Based">Milage-Based</option>
                            <option value="Time Interval-Based">Time Interval-Based</option>
                            <option value="Specific Event-Based">Specific Event-Based</option>
                        </select>    
                    </div>
                </div> -->
                <div class="sm:col-span-1">
                    <label for="service" class="block text-xl font-medium leading-6 text-gray-900">Assigned to <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select id="service" name="service"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>Choose service centre</option>
                            @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="issued" class="block text-xl font-medium leading-6 text-gray-900">Issued By</label>
                    <div class="mt-2">
                        <x-input readonly id="issued" class="block py-1.5 pl-1 flex-1 text-gray-900 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="issued" value="{{auth()->user()->name}}" /> 
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="date" class="block text-xl font-medium leading-6 text-gray-900">Issue Date</label>
                    <div class="mt-2">                       
                        <x-input readonly id="date" class="block py-1.5 pl-1 flex-1 text-gray-900 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="date" value="{{ date('Y-m-d') }}" /> 
                    </div>
                </div>
            </div>
        </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="javascript:window.history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900 hover:underline" onclick="clearForm()">Clear</button>
        <button type="submit" onclick="submitFormAndRedirect()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next</button>
    </div>
</form>

<script>
    function clearForm() {
        document.getElementById('myForm').reset();
    }

    
</script>
@endsection