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
        Schema::table('comments', function (Blueprint $table) {
            $table->string('location')->after('rate')->nullable(true);
            $table->string('price')->after('location')->nullable(true);
            $table->string('staff')->after('price')->nullable(true);
            $table->string('wc')->after('staff')->nullable(true);
            $table->string('comfort')->after('wc')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('price');
            $table->dropColumn('staff');
            $table->dropColumn('wc');
            $table->dropColumn('comfort');
        });
    }
};
