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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('car')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->date('service_date')->nullable();
            $table->integer('mileage')->nullable(); // Mileage-based rules
            $table->unsignedBigInteger('service_centre_id')->nullable();
            $table->foreign('service_centre_id')->references('id')->on('service_centre')->cascadeOnDelete();
            $table->string('maintenance_needed')->nullable(); // Additional details
            $table->string('status')->default('Progressing');
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
        Schema::dropIfExists('maintenance');
    }
};