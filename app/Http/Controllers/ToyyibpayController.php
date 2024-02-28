<?php

namespace App\Http\Controllers;
use App\Models\RentalCar;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\TelegramController;


class ToyyibpayController extends Controller
{

    public function createBill($bookingId, $totalPrice)
    {
        $booking = Booking::find($bookingId);
            if ($booking) {
                $booking->status = 'Payment made'; // Update the status to 'Payment made' or any other appropriate status
                $booking->save(); // Save the changes to the database

                $cust = User::find($booking->user_id);
                $custTelegramChatId = $cust->telegram_chat_id;

                $message = new TelegramController;
                // Send the message only if the location has changed
                $message = "Booking Payment Made!!!\n\n" .
                "Booking name: " . $booking->first_name . " " . $booking->last_name . "\n".
                "Phone Number: " . $booking->phone . "\n\n" .
                "################################\n\n" .
                "Pickup Date: " . $booking->pickup_date . "\n" .
                "Pickup Time: " . $booking->pickup_time . "\n\n" .
                "################################\n\n" .
                "Dropoff Date: " . $booking->dropoff_date . "\n" .
                "Dropoff Time: " . $booking->dropoff_time;
        
                // Send the message only if the location has changed
                $messageController = new TelegramController;
                $messageController->send($custTelegramChatId,$message, 'HTML');


                $this->sendTelegramMessage($booking);
            } else {
                // Handle the case when the booking is not found
            }


           
            
            
        $option = array(
            'userSecretKey'=>config('toyyibpay.key'),
            'categoryCode'=>config('toyyibpay.category'),
            'billName' => $booking->first_name . ' ' . $booking->last_name,
            'billDescription'=>'Car Rental Payment',
            'billPriceSetting'=> 1,
            'billPayorInfo'=> 1,
            'billAmount'=>$totalPrice* 100,
            'billReturnUrl'=>route('toyyibpay-status'),
            'billCallbackUrl'=>route('toyyibpay-callback'),
            'billExternalReferenceNo' => 'Bill-0001',
            'billTo'=>$booking->first_name . ' ' . $booking->last_name,
            'billEmail'=>$booking->owner->email,
            'billPhone'=>'0194342411',
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>'0',
            'billContentEmail'=>'Thank you!',
            'billChargeToCustomer'=>2,
            'billExpiryDate'=>'17-2-2024 17:00:00',
            'billExpiryDays'=>3
          );

          $url ='https://dev.toyyibpay.com/index.php/api/createBill';
          $response = Http::asForm()->post($url, $option);
          $billCode = $response[0]['BillCode'];
          return redirect('https://dev.toyyibpay.com/' . $billCode);


          

    }

    private function sendTelegramMessage($booking)
    {
        // Retrieve the rental car associated with the booking
        $car = RentalCar::find($booking->car_id);

        // Retrieve the owner associated with the rental car
        $owner = User::find($car->user_id);

        if ($owner) {
            // Retrieve the owner's Telegram chat ID
            $ownerTelegramChatId = $owner->telegram_chat_id;

            // Compose message for Telegram
            $message = $this->composeTelegramMessage($booking);

            // Send message to Telegram
            $telegramController = new TelegramController;
            $telegramController->send($ownerTelegramChatId, $message);
        } else {
            // Handle the case when the owner is not found
        }
    }

    private function composeTelegramMessage($booking)
    {
        // Compose the message with booking details
        $message =  "New Booking Details:\n" .
                    "Booking name: " . $booking->first_name . " " . $booking->last_name . "\n".
                    "Car: " . $booking->cars->name . "\n".
                    "Phone Number: " . $booking->phone . "\n\n" .
                    "################################\n\n" .
                    "Pickup Date: " . $booking->pickup_date . "\n" .
                    "Pickup Time: " . $booking->pickup_time . "\n\n" .
                    "################################\n\n" .
                    "Dropoff Date: " . $booking->dropoff_date . "\n" .
                    "Dropoff Time: " . $booking->dropoff_time;

        return $message;
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
