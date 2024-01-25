<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-login="NewTrackNotiBot" data-size="large" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
            <script type="text/javascript">
                function onTelegramAuth(user) {
                    // Create a form dynamically
                    var form = document.createElement('form');
                    form.action = '{{ route('storeTelegramUser') }}';
                    form.method = 'post';
                    form.style.display = 'none';

                      // Add CSRF token input
                    var csrfTokenInput = document.createElement('input');
                    csrfTokenInput.type = 'hidden';
                    csrfTokenInput.name = '_token';
                    csrfTokenInput.value = '{{ csrf_token() }}'; // Laravel function to get the CSRF token

                    // Create an input field for the Telegram user data
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'telegramUser';
                    input.value = JSON.stringify(user);

                    // Append the input field to the form
                    form.appendChild(input);

                    // Append the form to the document body
                    document.body.appendChild(form);

                    // Submit the form
                    form.submit();
                }
            </script>

        <a class="underline text-sm text-[#FE0000] hover:text-gray-600" href="{{ route('login') }}">
            {{ __('Cancel') }}
        </a>
    </x-auth-card>
</x-guest-layout>
