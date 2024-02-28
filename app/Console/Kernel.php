<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Booking;
use App\Models\User;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $bookings = Booking::all();
    
            foreach ($bookings as $booking) {
                // Get the last updated timestamp for latitude and longitude
                $lastUpdated = $booking->updated_at;
    
                // Check if the difference between the last update and the current time is more than 1 minute
                if ($lastUpdated->diffInMinutes(now()) > 1 || $booking->tracking != 'On') {
                    // Send message to the owner
                    $owner = User::find($booking->car->user_id);
                    $ownerTelegramChatId = $owner->telegram_chat_id;
    
                    $message = "<---CAR TRACKING HAS STOPPED--->";
    
                    $messageController = new TelegramController;
                    $messageController->send($ownerTelegramChatId, $message, 'HTML');
    
                    // Update tracking status to 'On'
                    $booking->update(['tracking' => 'off']);
                }
            }
        })->everyMinute();
    }
     


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
