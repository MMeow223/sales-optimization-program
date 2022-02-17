<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // Can be used to display date and time
            $table->unsignedBigInteger('other_device_id');
            $table->unsignedBigInteger('our_device_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('pharmacy_id');
            $table->string('other_device_serial_no');
            $table->string('our_device_serial_no');
            $table->string('other_device_serial_no_image')->nullable();


            $table->foreign('other_device_id')->references('id')->on('devices');
            $table->foreign('our_device_id')->references('id')->on('devices');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_records');
    }
}
