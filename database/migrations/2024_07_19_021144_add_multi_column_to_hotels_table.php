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
            $table->tinyInteger('breakfast')->default(0)->after('people');
            $table->string('type_room')->after('breakfast')->nullable();
            $table->integer('vat')->nullable()->default(0)->after('type_room');
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
            $table->dropColumn('breakfast');
            $table->dropColumn('type_room');
            $table->dropColumn('vat');
        });
    }
};
