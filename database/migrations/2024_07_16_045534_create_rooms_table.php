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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->tinyInteger('people')->nullable(false);
            $table->tinyInteger('bed')->nullable(false);
            $table->string('price')->nullable(false);
            $table->integer('sale')->nullable();
            $table->text('detail')->nullable();
            $table->integer('size')->nullable();
            $table->string('view')->nullable();
            $table->text('service')->nullable();
            $table->tinyInteger('surcharge')->nullable();
            $table->tinyInteger('cancel')->nullable();
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
        Schema::dropIfExists('rooms');
    }
};
