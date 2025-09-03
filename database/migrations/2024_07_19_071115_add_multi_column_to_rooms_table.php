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
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->integer('surcharge_adult')->nullable()->after('surcharge');
            $table->integer('surcharge_child')->nullable()->after('surcharge_adult');
            $table->integer('surcharge_child2')->nullable()->after('surcharge_child');
            $table->integer('surcharge_child3')->nullable()->after('surcharge_child2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('surcharge_adult');
            $table->dropColumn('surcharge_child');
            $table->dropColumn('surcharge_child2');
            $table->dropColumn('surcharge_child3');
        });
    }
};
