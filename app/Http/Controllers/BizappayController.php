<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BizappayController extends Controller
{
    //
    public function create(){

        $data = [
            'apiKey' => config('bizappay.key'),
            'category' => config('bizappay.category'),
            'name' => 'Create bill from APIV3',
            'amount' => '35.00',
            'payer_name' => 'ijaz Hazly',
            'payer_email' => 'contact@bizappay.my',
            'payer_phone' => '01234567898',
            'webreturn_url' => route('bizappay-status'),
            'callback_url' => route('bizappay-callback'),
            'ext_reference' => '',
            'bank_code' => 'BCBB0235'
        ];

        $url = 'https://bizappay.my/api/v3/bill/create';

        $response = Http::asForm()->post($url,$data);

        return redirect($response);
    }

    public function status(){

        $response = request()->all();
    }

    public function callback(){

        $response = request()->all(['billcode','billamount','billstatus','billtrans','billinvoice']);
        Log::info($response);
    }

}
