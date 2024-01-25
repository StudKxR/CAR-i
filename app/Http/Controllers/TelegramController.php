<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use pschocke\TelegramLoginWidget\Facades\TelegramLoginWidget;


class TelegramController extends Controller
{
    public function register(){
        return view('auth.telegram');
    }

    public function storeUser(Request $request){
        dd($request);
    }

    public function TelegramCallback(Request $request){
        // dd($request->all());

        if(!$telegramUser = TelegramLoginWidget::validate($request)){
            return 'Telegram Response not valid';
        }
        $Chat_Id = $telegramUser->get('id');
        $Username = $telegramUser->get('username');
        auth()->user()->update([
            'telegram_chat_id' => $Chat_Id,
            'telegram_username' => $Username,
        ]);
        
        notify()->success('Telegram chat id stored!');
        return back();
    }

    public function send( $message ){
         // Get the authenticated user
        $user = auth()->user();

        // Check if the user is authenticated and has a Telegram chat ID
        if ($user && $user->telegram_chat_id) {
            $chatId = $user->telegram_chat_id;

            // Use the obtained $chatId to send a message
            return $this->sendMessage($chatId, $message, '6637636549:AAEdg7sJmPXW07rTmWpxW6qWoc1EzzEvIvc');
        } else {
            // Handle the case where the user is not authenticated or doesn't have a Telegram chat ID
            return response()->json(['error' => 'User not authenticated or no Telegram chat ID']);
        }
    }

    private function sendMessage($chatID, $message, $token) {
    
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url . "&text=" . urlencode($message);
        $ch = curl_init();
        $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
