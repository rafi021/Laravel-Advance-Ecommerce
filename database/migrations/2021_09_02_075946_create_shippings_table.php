<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');

            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')->references('id')->on('ship_divisions');

            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('ship_districts');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('ship_states');

            $table->string('shipping_name');
            $table->string('shipping_email');
            $table->string('shipping_phone');
            $table->string('shipping_postCode');
            $table->longText('shipping_address');
            $table->longText('shipping_notes')->nullable();

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
        Schema::dropIfExists('shippings');
    }
}
