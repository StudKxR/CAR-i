<div class="flex flex-col w-screen h-screen">

    <!-- Navbar -->
    <div class="flex justify-between py-4 px-10 bg-white text-[#FE0000]">
        <span class="text-2xl font-bold">CAR-i</span>
        <div x-data="{ isShow: false }">
            <div class="relative inline-block mt-1" @click.away="isShow = false">
                <button @click="isShow = !isShow" class="inline-flex items-center gap-2">
                    <span class="text-[#FE0000] font-light">Login</span>
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
                    class="text-left absolute right-0 top-full mt-2">
                    <div class="w-40 bg-white rounded-md shadow-md">
                        <nav class="flex flex-col space-y-2 w-full py-4 px-4">
                            <a href="{{ route('login') }}" class="w-full rounded-lg text-left">
                                <div class="inline-flex items-center gap-2">
                                    <span class="hover:text-[#FE0000] font-light duration-200">As customer</span>
                                </div>
                            </a>
                            <a href="{{ route('login_owner') }}" class="w-full rounded-lg text-left">
                                <div class="inline-flex items-center gap-2">
                                    <span class="hover:text-[#FE0000] font-light duration-200">As owner</span>
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Up Column -->
    <div class="bg-white h-3/5 px-10 flex items-center justify-between">
        <div class="w-2/3 flex flex-col justify-start gap-10">
            <p class="text-6xl sm:text-l text-gray font-bold">Experience <span class="text-[#FE0000]">CAR-i</span></p>
            <p class="italic text-xl sm:text-sm text-gray-700 ">Tracking Excellence, Driving Confidence!</p>
            <div class="inline-flex items-center gap-4">          
                <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-[#FE0000] font-light border border-[#FE0000] rounded-full p-2">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-gray">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </span>Login as customer
                </a>
                <p class="text-light">or</p>
                <a href="{{ route('login_owner') }}" class="text-sm text-[#FE0000] font-light p-2 underline underline-offset-4">
                Login as car owner
                </a>
            </div>
         </div>
        <div class="1/3">
            <div class="bg-cover bg-center" style="background-image: url('{{ asset('storage/images/front_page.png') }}'); height: 300px; width: 400px;"></div>
        </div>
    </div>

    <!-- Down Column -->
    <div class="bg-white px-4 md:border-t-0 md:border-x-2 h-2/5 ">
        <div class="flex flex-col h-full justify-center items-center gap-2">
              {{$logo}}
              <br>
              {{$slot}}          
        </div>
    </div>
</div>
