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
        Schema::table('hotels', function (Blueprint $table) {
            $table->tinyInteger("people_min")->nullable(true)->after('people');
            $table->tinyInteger("bedroom")->nullable(true)->after('people_min');
            $table->tinyInteger("bed")->nullable(true)->after('bedroom');
            $table->tinyInteger("bathroom")->nullable(true)->after('bed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('people_min');
            $table->dropColumn('bedroom');
            $table->dropColumn('bed');
            $table->dropColumn('bathroom');
        });
    }
};
