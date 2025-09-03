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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('location_id')->nullable(false);
            $table->string('slug')->nullable(false);
            $table->string('address')->nullable(false);
            $table->text('video')->nullable();
            $table->char('price', 30)->nullable(false);
            $table->char('sale', 30)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('rate')->nullable();
            $table->text('stores')->nullable();
            $table->integer('room')->nullable();
            $table->integer('people')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('hotels');
    }
};
