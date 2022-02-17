<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pharmacy_account_no');
            $table->string('pharmacy_name');
            $table->string('pharmacy_address_1');
            $table->string('pharmacy_address_2')->nullable();
            $table->string('pharmacy_city');
            $table->string('pharmacy_state');
            $table->string('pharmacy_postcode');
            $table->string('pharmacy_pic');
            $table->string('pharmacy_phone');
            $table->boolean('is_active');
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
        Schema::dropIfExists('pharmacies');
    }
}
