<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Maintenance;
use App\Notifications\MaintenanceApproachingNotification;

class NotifyApproachingMaintenance extends Command
{
    protected $signature = 'notify:approaching-maintenance';
    protected $description = 'Send notifications for approaching maintenance dates';

    public function handle()
    {
        $this->info('Checking for approaching maintenance dates...');

        // Get the authenticated user (car owner)
        $user = auth()->user();

        // Check if user is authenticated and has cars
        if ($user && $user->cars->isNotEmpty()) {
            // Retrieve maintenance dates approaching within the next three days
            $approachingMaintenance = Maintenance::whereIn('car_id', $user->cars->pluck('id'))
                ->whereDate('service_date', '>=', now())
                ->whereDate('service_date', '<=', now()->addDays(3))
                ->get();

            if ($approachingMaintenance->isEmpty()) {
                $this->info('No approaching maintenance dates found.');
                return;
            }

            $this->sendNotifications(collect([$user]), 'car owner');

            $this->info('Notifications sent successfully.');
        } else {
            $this->info('No authenticated user or user has no cars.');
        }
    }

    protected function sendNotifications($users, $userType)
    {
        // Filter out null values from the collection
        $users = $users->filter();

        if ($users->isNotEmpty()) {
            $this->info("Sending notifications to $userType users...");

            foreach ($users as $user) {
                // Check if $user is not null before calling notify
                if ($user) {
                    $user->notify(new MaintenanceApproachingNotification($user->approachingMaintenances));
                }
            }
        } else {
            $this->info("No $userType users found for notifications.");
        }
    }
}
