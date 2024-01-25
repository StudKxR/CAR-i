@extends('owner.layout.layout')
@section('content')
<div class=" w-full">
    <div class="flex flex-col gap-4"> 
        <div class="col-lg-12 margin-tb pb-1 flex justify-between">
            <div id="headerTitle">
                <h2 class="text-2xl font-medium text-black ">
                    {{ __('Edit Rental Car') }}
                </h2>
            </div>
        </div>
    </div>
</div>
</header>
<form method="POST" action="{{ route('car.update',$car->id) }}" id="myForm" enctype="multipart/form-data">
    @csrf 
    @method('PUT')
    <div class="rounded-lg space-y-4 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white"> 
        <div class="border-b border-gray-900/10 pb-4"> 
            <div class="mt-2 grid grid-cols-2 gap-x-2 gap-y-1.5">
                <div class="sm:col-span-1"> 
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Car name</label>
                    <div class="mt-2"> 
                        <x-input id="name" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0 placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="name" placeholder="{{$car->name}}" /> 
                    </div> 
                </div> 
                <div class="sm:col-span-1"> 
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Car plate number</label>
                    <div class=" mt-2">
                        <x-input id="plate" class="block bg-transparent py-1.5 pl-1 flex-1 text-gray-900 focus:ring-0
                        placeholder:text-gray-400 mt-1 w-full sm:text-sm sm:leading-6" type="text" name="plate"
                        placeholder="{{$car->plate}}" />
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Car category</label>
                    <div class="mt-2">
                        <select id="category" name="category"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>{{$car->category}}</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Economy">Economy</option>
                            <option value="Compact ">Compact </option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Car color</label>
                    <div class="mt-2">
                        <select id="color" name="color"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>{{$car->color}}</option>
                            <option value="Green">Green</option>
                            <option value="Red">Red</option>
                            <option value="Blue">Blue</option>
                            <option value="Silver">Silver</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label for="name" class="block text-xl font-medium leading-6 text-gray-900">Status</label>
                    <div class="mt-2">
                        <select id="status" name="status"
                            class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>{{$car->status}}</option>
                            <option value="Available">Available</option>
                            <option value="Not available">Not available</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-full">
                    <label for="cover-photo" class="block text-xl font-medium leading-6 text-gray-900">Car photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-2 py-2">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="flex text-sm leading-6 text-gray-600">

                                <label for="images"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-red-600 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="images" name="images" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
</form>
<script>
</script>
@endsection