@extends('owner.layout.layout')
@section('content')
<header>
    <div class=" w-full">
        <div class="flex flex-col gap-4"> 
            <div class="col-lg-12 margin-tb pb-1 flex justify-between">
                <div id="headerTitle">
                    <h2 class="text-2xl font-medium text-black">
                        {{ __('Notification settings') }}
                    </h2>
                </div>
            </div>
            <div class="group ml-auto">
                <button onclick="toggleTelegramScript()" class="px-4 py-2 items-center group  duration-300 rounded-lg border bg-white shadow-sm cursor-pointer" id="addNewBtn">
                    <div class="inline-flex justify-center items-center gap-2">
                        <span id="allowEditText" class="text-base text-black group duration-300 font-light">Allow edit</span> 
                    </div>
                </button>
            </div>
        </div>
    </div>
</header>
<div class="py-6">
    <form method="POST" action="" id="myForm" enctype="multipart/form-data">
        @csrf 
        <div class="space-y-4 p-2 rounded-lg shadow-sm sm:rounded-lg p-5 bg-white"> 
            <div class="border-b border-gray-900/10 pb-4">
                <div class="mt-2 flex flex-row gap-x-2 gap-y-1.5">
                    <div class="block"> 
                        <label for="issued" class="block text-base font-medium leading-6 text-gray-900">Telegram Username</label>
                        <div class="mt-2">
                            <div class="flex  gap-2  items-center bg-slate-100 border border-none rounded-md w-full py-2 px-2 " >
                               <p><span>@</span>{{auth()->user()->telegram_username}}</p>
                            </div>
                        </div>  
                    </div>
                    <div id="telegramScriptContainer" class="flex flex-col-reverse hidden duration-300">
                        <script async src="https://telegram.org/js/telegram-widget.js?22" 
                                data-telegram-login="NewTrackNotiBot" 
                                data-size="large" 
                                data-userpic="false" 
                                data-request-access="write"
                                data-auth-url="{{ url('/telegram-callback') }}">
                        </script>
                        <!-- <script type="text/javascript">
                            function onTelegramAuth(user) {
                                alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (user.username ? ', @' + user.username : '') + ')');
                            }
                        </script> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleTelegramScript() {
        var telegramScriptContainer = document.getElementById('telegramScriptContainer');
        var allowEditButton = document.getElementById('allowEditText');

        if (telegramScriptContainer.classList.contains('hidden')) {
            telegramScriptContainer.classList.remove('hidden');
            allowEditButton.textContent = 'Disable edit';
            document.getElementById('addNewBtn').style.backgroundColor = '#FE0000';
        } else {
            telegramScriptContainer.classList.add('hidden');
            allowEditButton.textContent = 'Allow edit';
            document.getElementById('addNewBtn').style.backgroundColor = 'white';
        }
    }

</script>

@endsection
