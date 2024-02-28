<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
        <title>CAR-i</title>
        <link rel="icon" href="{{ asset('storage/images/favicon.ico') }}" type="image/x-icon">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

        {{-- Link Tailwind Components --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />

        {{-- Script Tailwind Components --}}
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- leaflet css  -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <!-- leaflet js  -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="http://www.openlayers.org/api/OpenLayers.js"></script>

        <!-- Bootstrap CSS and JS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T6A9vntO1pF1z9IbbDdQ4pHxMnb4n4N87pANge5GAPJtFf/3ARQNgiz6NHT3ZVqh" crossorigin="anonymous">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-X1C+ToIEzS/1DkUzd9N6KO4o7PpM1w/+9DD6rS6fVM1sU5AGDteZsmLeveNLf+32" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-nb2n2tWzPusqD6b4pdMyCU9M+A7vPv/8aXDLr1egFRFXE8Z8e0N9auWuX1d6py0F" crossorigin="anonymous"></script>

        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js"></script>
        <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
        @vite('resources/css/app.css')

        {{-- Script import --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        @notifyCss

    </head>


<body class="overflow-hidden overflow-y-auto">

    <div class="flex flex-col md:flex-row w-full min-h-screen bg-white">

    {{-- sidebar with nav links --}}
        <div class="w-full md:w-1/6 bg-white drop-shadow-md md:h-screen border-r border-slate-200 sticky top-0">
            <nav class="flex flex-col space-y-2 w-full py-4 px-4 ">
                <div class="flex justify-between items-center ">
                    <a href="{{ route('dashboard') }}" class="text-left text-[#FE0000] text-2xl pb-4 font-semibold">CAR-i</a>
                    <span class="text-3xl cursor-pointer mx-2 md:hidden block">
                        <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
                    </span>
                </div>
                <a class="text-left text-[#FE0000] text-xl pb-4 font-semibold">Owner Page</a>
                <div id="navbar" class="md:flex md:flex-col md:space-y-2 flex justify-between space-x-2 md:items-center z-[-1] md:z-auto md:static absolute bg-white w-full  left-0 md:w-auto md:py-0 py-4 md:pl-0 px-2 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-300">
                    {{-- Route dashboard --}}
                    <a href="{{ route('dashboard') }}" class="group w-full p-1 rounded-lg text-left hover:text-white  duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#FE0000] text-white' : 'hover:bg-[#FE0000] duration-300 text-black group' }}">
                        <div class="inline-flex items-center gap-2">
                            <span class="text-black hidden sm:block {{ request()->routeIs('dashboard') ? 'text-white' : 'group-hover:text-white duration-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            </span>
                            <span class="text-sm sm:text-base  font-light {{ request()->routeIs('dashboard') ? 'text-white' : 'hover:text-white'}}">Home</span>
                        </div>
                    </a>

                    <a href="{{ route('car.index') }}" class="group w-full p-1 rounded-lg text-left  hover:text-white  duration-200 {{ request()->routeIs('car.index') ? 'bg-[#FE0000] text-white' : 'hover:bg-[#FE0000] duration-300 text-black group' }}">
                        <div class="inline-flex items-center gap-2">
                            <span class="text-black hidden sm:block  {{ request()->routeIs('car.index') ? 'text-white' : 'group-hover:text-white duration-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </span> 
                            <span class="text-sm sm:text-base  font-light {{ request()->routeIs('car.index') ? 'text-white' : 'hover:text-white'}}">Rental cars</span>
                        </div>
                    </a>

                    <a href="{{ route('booking2.index') }}" class="group w-full p-1 rounded-lg text-left hover:text-white  duration-200 {{ request()->routeIs('booking2.index') ? 'bg-[#FE0000] text-white' : 'hover:bg-[#FE0000] duration-300 text-black group' }}">
                        <div class="inline-flex items-center gap-2">
                            <span class="text-black hidden sm:block {{ request()->routeIs('booking2.index') ? 'text-white' : 'group-hover:text-white duration-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                </svg>
                            </span> 
                            <span class="text-sm sm:text-base  font-light {{ request()->routeIs('booking2.index') ? 'text-white' : 'hover:text-white' }}">Bookings</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('maintenance.index') }}" class="group w-full p-1 rounded-lg text-left hover:text-white duration-200 {{ request()->routeIs('maintenance.index') ? 'bg-[#FE0000] text-white': ' hover:bg-[#FE0000] duration-200 text-black group' }}">
                        <div class="inline-flex items-center gap-2">
                            <span class="text-black hidden sm:block {{ request()->routeIs('maintenance.index') ? 'text-white' : 'group-hover:text-white duration-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                </svg>
                            </span> 
                            <span class="text-sm sm:text-base  font-light {{ request()->routeIs('maintenance.index') ? 'text-white' : 'hover:text-white' }}">Maintenance</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('settings.index') }}" class="group w-full p-1 rounded-lg text-left hover:text-white duration-200 {{ request()->routeIs('settings.index') ? 'bg-[#FE0000] text-white': ' hover:bg-[#FE0000] duration-200 text-black group' }}">
                        <div class="inline-flex items-center gap-2">
                            <span class="text-black  hidden sm:block {{ request()->routeIs('settings.index') ? 'text-white' : 'group-hover:text-white duration-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </span> 
                            <span class="text-sm sm:text-base font-light {{ request()->routeIs('settings.index') ? 'text-white' : 'hover:text-white' }}">Settings</span>
                        </div>
                    </a> 
                </div>
                                                  
            </nav>
        </div>
        
        {{-- Main content --}}
        <div class="flex-1 overflow-x-auto">
            <div class="w-full h-full bg-stone-100  pb-4">
                <div class="flex flex-row-reverse justify-between items-center bg-white py-2 drop-shadow-md">
                    <div class="inline-flex items-center justify-items-center gap-2 pr-6">                         
                        {{--User Profile--}}   
                        <div x-data="{isShow: false}">
                            <div class="relative inline-block" @click.away="isShow = false">
                                <button @click="isShow = !isShow" class="inline-flex items-center gap-2">
                                    <span class="text-black text-lg font-light">{{Auth::user()->name}}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-cloak x-show="isShow"
                                    x-transition:enter="transition ease-out origin-top-right duration-200"
                                    x-transition:enter-start="opacity-0 transform scale-90 translate-x-0"
                                    x-transition:enter-end="opacity-100 transform scale-100 translate-x-0"
                                    x-transition:leave="transition origin-top-right ease-in duration-100"
                                    x-transition:leave-start="opacity-100 transform scale-100 translate-x-0"
                                    x-transition:leave-end="opacity-0 transform scale-90 translate-x-0"
                                    class="text-left absolute right-0">
                                <div class="flex-shrink">
                                    <div class="w-40 bg-white rounded-md">
                                        <nav class="flex flex-col space-y-2 w-full py-4 px-4">
                                            <a href="{{ route('profile.edit') }}" class="group w-full rounded-lg text-left">
                                                <div class="inline-flex items-center gap-2">
                                                    <span class="group-hover:text-[#FE0000] font-light duration-200">Edit profile</span>
                                                </div>
                                            </a>
                                            {{-- Logout --}}
                                            <form method="POST" action="{{ route('logout') }}" class="group cursor-pointer">
                                                @csrf
                                                <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit(); " class="group-hover:text-[#FE0000] font-light duration-200">Logout</a>
                                            </form>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="px-4 py-6">
                    {{-- Content --}}
                    @include('notify::components.notify')
                    @yield('content')
                </div>
                
            </div>
        </div>
    </div>

    <script>
        function Menu(e) {
            let navbar = document.getElementById('navbar');
            e.name === 'menu' ?
                (e.name = "close", navbar.classList.add('top-[50px]', 'opacity-100', 'z-40')) :
                (e.name = "menu", navbar.classList.remove('top-[50px]', 'opacity-100', 'z-40'));
        }

    </script>

@notifyJs
</body>

</html>