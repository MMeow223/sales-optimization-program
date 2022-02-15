<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('serial_no');
            $table->string('serial_no_image');
            $table->timestamps(); // Can be used to display date and time
            $table->string('exchange_model');
            $table->string('exchange_serial_no');
            $table->string('patient_name');
            $table->date('patient_dob');
            $table->string('patient_phone_no');
            $table->string('patient_email');
            $table->string('patient_addr_1');
            $table->string('patient_addr_2')->nullable();
            $table->string('patient_city');
            $table->string('patient_state');
            $table->string('patient_zipcode');
            $table->string('patient_diabetes');
            $table->string('pharmacy_name');
            $table->string('pharmacy_account_no');
            $table->string('pharmacy_addr_1');
            $table->string('pharmacy_addr_2')->nullable();
            $table->string('pharmacy_city');
            $table->string('pharmacy_state');
            $table->string('pharmacy_zipcode');
            $table->string('pharmacy_pic');
            $table->string('pharmacy_contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
