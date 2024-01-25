<div class="flex flex-col md:flex-row w-screen h-screen">
    <!-- Left Column -->
    <div class="md:w-1/2 bg-cover bg-white h-full">
        <div class="flex flex-col h-full justify-center items-center p-4 md:p-8">
            <span>
                <p class="text-4xl text-gray font-bold text-center">Experience <span class="text-[#FE0000]">CAR-i</span></p>
                <p class="italic text-xl text-gray-700 text-center">Tracking Excellence, Driving Confidence!</p>
            </span>
        </div>
    </div>

    <!-- Right Column -->
    <div class="md:w-1/2 bg-white p-4  border-solid border-t-2 md:border-t-0 md:border-x-2 border-[#FE0000]">
        <div class="flex flex-col h-full justify-center items-center">
            <span class="w-full md:w-1/2">
                <p class="text-2xl text-gray font-semibold">Welcome!</p>
                {{ $logo }}
                <br>
                {{ $slot }}
            </span>
        </div>
    </div>

</div>
