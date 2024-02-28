<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for cars
        $cars = [
            [
                'user_id' => 1,
                'name' => 'Car 1',
                'plate' => 'ABC123',
                'category' => 'Sedan',
                'mode' => 'Automatic',
                'seats' => 5,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'AC',
                'luggage' => 2,
                'rental_price' => 50.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car1.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'Car 2',
                'plate' => 'ABC456',
                'category' => 'Compact',
                'mode' => 'Manual',
                'seats' => 5,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'AC',
                'luggage' => 2,
                'rental_price' => 100.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car2.jpeg',
            ],

            [
                'user_id' => 1,
                'name' => 'Car 3',
                'plate' => 'ABC789',
                'category' => 'Economy',
                'mode' => 'Automatic',
                'seats' => 7,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'Heater',
                'luggage' => 4,
                'rental_price' => 250.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car4.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'Car 4',
                'plate' => 'ABC987',
                'category' => 'Sedan',
                'mode' => 'Automatic',
                'seats' => 5,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'AC',
                'luggage' => 2,
                'rental_price' => 150.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car1.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'Kereta 1',
                'plate' => 'ABC654',
                'category' => 'Sedan',
                'mode' => 'Automatic',
                'seats' => 5,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'AC',
                'luggage' => 2,
                'rental_price' => 110.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car1.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'Kereta 2',
                'plate' => 'ABC321',
                'category' => 'Convertible',
                'mode' => 'Automatic',
                'seats' => 5,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'AC',
                'luggage' => 3,
                'rental_price' => 120.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car4.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'Kereta 3',
                'plate' => 'ABC901',
                'category' => 'SUV',
                'mode' => 'Automatic',
                'seats' => 7,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'AC',
                'luggage' => 4,
                'rental_price' => 150.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car4.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'Kereta 4',
                'plate' => 'ABC109',
                'category' => 'Van',
                'mode' => 'Automatic',
                'seats' => 7,
                'pickup' => 'Jalan UITM, Jasin, Jasin District, Malacca, 77300, Malaysia',
                'latitude' => 2.22146,
                'longitude' => 102.45335,
                'aircond' => 'AC',
                'luggage' => 4,
                'rental_price' => 150.00,
                'status' => 'Available',
                'mileage' => 10000,
                'last_maintenance' => '2023-01-01',
                'images' => 'car4.jpg',
            ],
            // Add more cars as needed
        ];

        // Insert data into the 'car' table
        foreach ($cars as $car) {
            DB::table('car')->insert($car);
        }
    }
}

