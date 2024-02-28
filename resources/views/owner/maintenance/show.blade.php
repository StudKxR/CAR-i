@extends('owner.layout.layout')
@section('content')
<div class="flex justify-center">
    <div class="rounded-lg shadow-sm sm:rounded-lg bg-white w-full  p-5">
        <div class="grid grid-cols-3 gap-4"> 
            <div class="flex flex-col col-span-2">
                <div class="grid grid-cols-3 gap-4 border-b border-gray-200">
                    <img class="h-60 object-scale-down rounded-t-xl" src="{{ asset('storage/images/' . $maintenances->cars->images) }}" />
                    <div class="col-span-2 grid grid-cols-2 h-1/3">
                        <div class="col-span-2 py-2">
                            <h1 class="text-xl font-bold truncate">{{$maintenances->cars->name}} - {{$maintenances->cars->plate}}</h1>
                        </div>
                        <div class="flex flex-col gap-4">
                            <div class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                <p>{{$maintenances->cars->seats}} seats</p>
                            </div>
                            <div class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                                </svg>
                                <p>{{$maintenances->cars->mode}}</p>
                            </div>
                            <div class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                                <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z"/>
                                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z"/>
                                </svg>
                                <p>{{$maintenances->cars->category}}</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <div class="m-0">
                                <p class="text-l font-bold">Mileage:</p>
                                <p>{{$maintenances->cars->mileage}}</p>
                            </div>
                            <div class=" m-0">
                                <p class="text-l font-bold">Last maintenance:</p>
                                <p>{{$maintenances->cars->last_maintenance}}</p>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                        <div class="py-6">
                            <p class="text-xl font-semibold">Overview:</p>
                        </div>
                        <div class="flex flex-row justify-around">
                            <div>
                                <p class="font-semibold">Service provider: <br> <span class="font-normal">{{$maintenances->serviceProvider->name}}</span></p>
                                <p class="font-semibold">Maintenance recommended: <br> <span class="font-normal">{!!$maintenances->maintenance_needed ? $maintenances->maintenance_needed : '<span class="text-yellow-400">Reply Pending</span>' !!}</span></p>
                            </div>
                            <div>
                                <p class="font-semibold">Maintenance Date: <br> <span class="font-normal">{!! $maintenances->service_date ? $maintenances->service_date : '<span class="text-yellow-400">Reply Pending</span>' !!}</span></p>
                                <p class="font-semibold">Maintenance Status: <br>   
                                @if ($maintenances->status == 'Progressing')
                                    <span class="font-bold text-yellow-400 rounded-lg">{{$maintenances->status}}</span>
                                @elseif ($maintenances->status == 'Done')
                                    <span class="font-bold text-green-600 rounded-lg">{{$maintenances->status}}</span>
                                @else
                                    <span class="font-bold  rounded-lg">{{$maintenances->status}}</span>
                                @endif
                                </p>
                            </div>
                        </div>
                </div>
            </div>
            <div class="p-4 border-l border-gray-200 flex flex-col gap-8 justify-between">
                <div>
                    <p class="font-bold text-lg">Issued by</p>
                    <p>{{$user->name}}</p>
                    <p>{{$user->email}}</p>
                    <br>
                    <p class="font-bold text-lg">Email sent to</p>
                    <p>{{$maintenances->serviceProvider->email}}</p>
                </div>
                <div class="flex flex-col gap-2">    
                    @if($maintenances->status !== 'Done')
                        <form action="{{ route('mark_as_done', ['maintenance' => $maintenances->id]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-white w-full">
                                <div class="flex  justify-center items-center rounded-md bg-green-500 p-2">
                                    Mark as Done
                                </div>
                            </button>
                        </form>
                    @endif
                    @if($maintenances->status === 'Done')
                        <a href="{{ route('export_pdf', ['maintenance' => $maintenances->id]) }}" target="_blank" class="text-white">
                            <div class="flex justify-center items-center rounded-md bg-indigo-800 p-2">
                                Display PDF
                            </div>
                        </a>
                    @endif
                </div>
            </div>            
        </div>
    </div>
</div>
<div class="flex justify-center pt-4">
    <a href="javascript:window.history.back()" class="text-sm font-semibold leading-6 text-gray-900 hover:underline focus:outline-none focus-visible:outline-indigo">Back</a>
</div>                

@endsection