@section('content')
<header>
<div class=" w-full">
    <div class="row">
        <div class="col-lg-12 margin-tb pb-1 justify-between">
            <div>
            <h2 class="text-2xl font-medium text-black ">
                {{ __('Bookings') }}
                </h2>
            </div>
        </div>
    </div>
</div>
</header>
<div class=" rounded-lg shadow-xl border border-[#FE0000] p-5 bg-slate-200">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table-auto w-full text-sm ">
                <thead>
                    <tr>
                        <th class="border-b font-bold p-4 pl-8 pt-0 pb-3 text-slate-800 text-left">Booking name</th>
                        <th class="border-b font-bold p-4 pt-0 pb-3 text-slate-800  text-left">Date</th>
                        <th class="border-b font-bold p-4 pr-8 pt-0 pb-3 text-slate-800 ">Action</th>
                    </tr>
                </thead>
                @foreach ($customers as $index => $customer)
                <tbody class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                    <tr class="border border-gray-200">
                        <td class="p-4 pl-8 ">{{$customer->name}}</td>
                        <td class="p-4">{{$customer->email}}</td>
                        <td class="p-4 pr-8">
                            <form action="{{ route('customer.destroy',$customer->id) }}" method="POST">
                                <div class="items-center justify-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-300 text-red-600 font-medium rounded-md p-1 hover:bg-red-200 m-auto block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
    </div>
@endsection