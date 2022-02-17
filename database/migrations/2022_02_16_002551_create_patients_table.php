<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('patient_name');
            $table->date('patient_dob');
            $table->string('patient_email');
            $table->string('patient_address_1');
            $table->string('patient_address_2')->nullable();
            $table->string('patient_city');
            $table->string('patient_state');
            $table->string('patient_postcode');
            $table->string('patient_phone');
            $table->string('patient_diabetes_type');
            $table->integer('total_exchanged');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
