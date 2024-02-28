<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            $userId = rand(3, 4);
            $carId = rand(1, 10);
            $age = '18-25';
            $location = $faker->address;
            $phone = $faker->phoneNumber;
            $pickupDate = $faker->dateTimeBetween('2023-01-01', '2023-01-31')->format('Y-m-d');
            $pickupTime = $faker->time;
            $dropoffDate = $faker->dateTimeBetween($pickupDate, '2023-01-31')->format('Y-m-d');
            $dropoffTime = $faker->time;
            $status = 'Finished';
            $review = $faker->text;
            $tracking = 'off';
            $images = 'lesen.jpg';
            $latitude = $faker->latitude;
            $longitude = $faker->longitude;

            DB::table('bookings')->insert([
                'user_id' => $userId,
                'car_id' => $carId,
                'first_name' => 'booking',
                'last_name' => 'booking',
                'age' => $age,
                'location' => $location,
                'phone' => $phone,
                'pickup_date' => $pickupDate,
                'pickup_time' => $pickupTime,
                'dropoff_date' => $dropoffDate,
                'dropoff_time' => $dropoffTime,
                'status' => $status,
                'review' => $review,
                'tracking' => $tracking,
                'images' => $images,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
