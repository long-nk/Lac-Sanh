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
        Schema::table('page_infos', function (Blueprint $table) {
            $table->string('card')->nullable();
            $table->string('bank')->nullable();
            $table->string('account')->nullable();
            $table->string('qr_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_infos', function (Blueprint $table) {
            $table->dropColumn('card');
            $table->dropColumn('bank');
            $table->dropColumn('account');
            $table->dropColumn('qr_code');
        });
    }
};
