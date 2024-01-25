<x-guest-layout>
    <x-auth-card-2>
        <x-slot name="logo">
           <span class="text-sm text-gray">New to CAR-i?&ensp;<a href="{{ route('register_owner') }}" class="text-sm text-[#FE0000] hover:underline">Register Here</a></span>
           <br>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600 ">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end my-4">
                <a class="underline text-sm text-[#FE0000] hover:text-gray-600 pr-4" href="javascript:history.back()">
                    {{ __('Go Back') }}
                </a>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-[#FE0000] hover:text-gray-600 " href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3 bg-[#8AF47C]">
                    {{ __('Log in') }}
                </x-button>

                
            </div>

            <!-- <script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-login="NewTrackNotiBot" data-size="large" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
                <script type="text/javascript">
                function onTelegramAuth(user) {
                    alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (user.username ? ', @' + user.username : '') + ')');
                }
                </script> -->
        </form>
    </x-auth-card-2>
</x-guest-layout>
