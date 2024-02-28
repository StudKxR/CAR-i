<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'name' => 'Basic',
                'car_id' => 1,
                'fuel_description' => 'Full Tank',
                'mileage_policy' => 'Unlimited',
                'included_protection' => 'Theft Protection',
                'add_price' => 20.00,
                'cancellation_policy' => 'Free cancellation up to 48 hours before pick up',
            ],
            [
                'name' => 'Premium',
                'car_id' => 2,
                'fuel_description' => 'Full to Full',
                'mileage_policy' => 'Limited 1000 miles',
                'included_protection' => 'Collision Damage Waiver',
                'add_price' => 30.00,
                'cancellation_policy' => '50% refund for cancellations made less than 24 hours in advance',
            ],


            [
                'name' => 'Standard',
                'car_id' => 3,
                'fuel_description' => 'Half Tank',
                'mileage_policy' => 'Limited 500 miles',
                'included_protection' => 'Third Party Liability',
                'add_price' => 25.00,
                'cancellation_policy' => 'No refund for cancellations made less than 48 hours in advance',
            ],
            [
                'name' => 'Deluxe',
                'car_id' => 4,
                'fuel_description' => 'Empty to Empty',
                'mileage_policy' => 'Limited 200 miles',
                'included_protection' => 'Comprehensive Coverage',
                'add_price' => 40.00,
                'cancellation_policy' => 'Full refund for cancellations made at least 72 hours in advance',
            ],
            [
                'name' => 'Economy',
                'car_id' => 5,
                'fuel_description' => 'Full Tank',
                'mileage_policy' => 'Unlimited',
                'included_protection' => 'Personal Accident Insurance',
                'add_price' => 15.00,
                'cancellation_policy' => '25% refund for cancellations made less than 12 hours in advance',
            ],
            [
                'name' => 'Standard',
                'car_id' => 6,
                'fuel_description' => 'Half Tank',
                'mileage_policy' => 'Limited 500 miles',
                'included_protection' => 'Third Party Liability',
                'add_price' => 25.00,
                'cancellation_policy' => 'No refund for cancellations made less than 48 hours in advance',
            ],
            [
                'name' => 'Deluxe',
                'car_id' => 7,
                'fuel_description' => 'Empty to Empty',
                'mileage_policy' => 'Limited 200 miles',
                'included_protection' => 'Comprehensive Coverage',
                'add_price' => 40.00,
                'cancellation_policy' => 'Full refund for cancellations made at least 72 hours in advance',
            ],
            [
                'name' => 'Economy',
                'car_id' => 8,
                'fuel_description' => 'Full Tank',
                'mileage_policy' => 'Unlimited',
                'included_protection' => 'Personal Accident Insurance',
                'add_price' => 15.00,
                'cancellation_policy' => '25% refund for cancellations made less than 12 hours in advance',
            ],
            // Add more packages as needed
        ];


        // Insert data into the 'packages' table
        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
