<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>CAR-i</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,400&display=swap"
        rel="stylesheet">

    {{-- Link Tailwind Components --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />

    {{-- Script Tailwind Components --}}
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js"></script>
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    @vite('resources/css/app.css')

    {{-- Script import --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="overflow-hidden">
    <div class="flex flex-row w-full h-full bg-white ">
        {{-- Main content --}}
        <div class="flex-1 w-4/6 overflow-x-auto px-4">
            <div class="w-full h-screen bg-white  py-4">
                <div class="flex flex-row-reverse justify-between items-center">
                    <div class="inline-flex items-center justify-items-center gap-2">                            
                    {{--User Profile--}} 
            <div x-data="{ isShow: false }">
                <div class="relative inline-block" @click.away="isShow = false">
                    <button @click="isShow = !isShow" class="inline-flex text-xl font-light hover:text-[#FE0000] duration-200 mx-4 my-6 md:my-0">Profile</button>
                    <div x-cloak x-show="isShow"
                        x-transition:enter="transition ease-out origin-top-right duration-200"
                        x-transition:enter-start="opacity-0 transform scale-90 translate-x-0"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-x-0"
                        x-transition:leave="transition origin-top-right ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-x-0"
                        x-transition:leave-end="opacity-0 transform scale-90 translate-x-0"
                        class="text-left absolute right-0">
                        <div class="flex-shrink">
                            <div class="w-40 bg-white border drop-shadow-xl rounded-md">
                                <nav class="flex flex-col space-y-2 w-full py-4 px-4">
                                    <a href="{{ route('profile.edit') }}" class="w-full rounded-lg text-left">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="hover:text-[#FE0000] font-light duration-200">Edit profile</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('settings.index') }}" class="w-full rounded-lg text-left">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="hover:text-[#FE0000] font-light duration-200">Settings</span>
                                        </div>
                                    </a>
                                    {{-- Logout --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit(); " class="hover:text-[#FE0000] font-light duration-200">Logout</a>
                                    </form>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
            <h2 class=""></h2>
                    </div>
                    <a href="{{route('dashboard')}}" class="text-center text-[#FE0000] text-3xl pb-4 font-semibold">CAR-i</a>  

                </div>
                <br>
                {{-- Content --}}
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Profile') }}
                    </h2>
                </x-slot>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white border border-[#FE0000] shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white border border-[#FE0000] shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white border border-[#FE0000] shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
</body>

</html>

