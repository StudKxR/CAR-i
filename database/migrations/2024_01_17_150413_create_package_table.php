<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('car')->cascadeOnDelete();

            $table->string('name'); // e.g., "Basic Protection"

            $table->string('fuel_description'); // e.g., "Full to full"
            $table->string('mileage_policy'); // e.g., "Unlimited mileage"

            // $table->string('payment_option'); // e.g., "Pay now"
            $table->text('included_protection')->nullable(); // Detailed description of included protection
            $table->decimal('add_price', 10, 2);
            
            $table->text('cancellation_policy')->nullable(); // e.g., "Free cancellation up to 48 hour(s) before pick up"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package');
    }
};
