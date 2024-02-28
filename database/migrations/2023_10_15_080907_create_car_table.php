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
        Schema::create('car', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->string('name');
            $table->string('plate');

            $table->string('category');
            $table->string('mode');

            $table->integer('seats');
            $table->string('aircond')->nullable();
            $table->integer('luggage')->nullable();

            $table->decimal('rental_price', 10, 2); // 10 digits in total, 2 decimal places
            $table->string('status')->nullable();

            $table->integer('mileage')->nullable();
            $table->date('last_maintenance')->nullable();
            
            $table->string('pickup')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->string('images')->nullable();
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
        Schema::dropIfExists('car');
    }
};
