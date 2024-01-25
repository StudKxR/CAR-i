<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ToyyibpayController extends Controller
{

    public function createBill()
    {
        $option = array(
            'userSecretKey'=>config('toyyibpay.key'),
            'categoryCode'=>config('toyyibpay.category'),
            'billName'=>'Car Rental WXX123',
            'billDescription'=>'Car Rental Payment',
            'billPriceSetting'=> 1,
            'billPayorInfo'=> 1,
            'billAmount'=>1000,
            'billReturnUrl'=>route('toyyibpay-status'),
            'billCallbackUrl'=>route('toyyibpay-callback'),
            'billExternalReferenceNo' => 'Bill-0001',
            'billTo'=>'Afif',
            'billEmail'=>'afif@gmail.com',
            'billPhone'=>'0194342411',
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>'0',
            'billContentEmail'=>'Thank you!',
            'billChargeToCustomer'=>2,
            'billExpiryDate'=>'17-12-2020 17:00:00',
            'billExpiryDays'=>3
          );

          $url ='https://dev.toyyibpay.com/index.php/api/createBill';
          $response = Http::asForm()->post($url, $option);
          $billCode = $response[0]['BillCode'];
          return redirect('https://dev.toyyibpay.com/' . $billCode);

    }

    public function paymentStatus()
    {
        $response = request()->all(['status_id','billcode','order_id']);
        return $response;
    }

    public function callback()
    {
        $response = request()->all(['refno','status','reason','billcode','order_id','amount']);
        Log::info($response);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
