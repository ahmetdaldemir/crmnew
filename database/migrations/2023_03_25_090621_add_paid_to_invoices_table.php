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
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('safe_id');
            $table->foreign('safe_id')->references('id')->on('safes')->onDelete('cascade');

            $table->string('pay_to')->nullable();
            $table->string('number')->nullable()->change();


            $table->double('exchange',10,2)->nullable()->change();
            $table->double('tax',10,2)->nullable()->change();
            $table->string('file')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
        });
    }
};
