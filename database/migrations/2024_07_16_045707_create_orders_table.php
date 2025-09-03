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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('phone_number');
            $table->string('email');
            $table->integer('room_id');
            $table->integer('number');
            $table->integer('people');
            $table->string('price');
            $table->string('sale');
            $table->string('total');
            $table->string('surcharge');
            $table->string('payment');
            $table->text('note');
            $table->datetime('check_in');
            $table->datetime('check_out');
            $table->tinyInteger('status');
            $table->integer('voucher');
            $table->string('vat');
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
        Schema::dropIfExists('orders');
    }
};
