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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('car')->cascadeOnDelete();

            $table->string('first_name')->default('booking');
            $table->string('last_name')->default('booking');
            $table->string('age')->nullable();

            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();

            $table->date('dropoff_date')->nullable();
            $table->time('dropoff_time')->nullable();

            $table->string('status')->default('Pending');
            $table->string('review')->nullable();

            $table->string('tracking')->default('off');
            $table->string('images')->nullable();
            
            $table->decimal('latitude', 10, 7)->nullable()->default('0.0');
            $table->decimal('longitude', 10, 7)->nullable()->default('0.0');
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
        Schema::dropIfExists('bookings');
    }
};

