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
        Schema::table('stock_card_movements', function (Blueprint $table) {
            $table->string('imei')->nullable();
            $table->boolean('assigned')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_card_movements', function (Blueprint $table) {
            $table->dropColumn('imei');
        });
    }
};
