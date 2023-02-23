<?php

use App\Models\Company;
use App\Models\Seller;
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
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('id_companies');
            $table->foreign(Company::getForeignKeyStatic())->references(Company::getKeyNameStatic())->on(Company::getTableStatic());

            $table->unsignedBigInteger('id_seller');
            $table->foreign(Seller::getForeignKeyStatic())->references(Seller::getKeyNameStatic())->on(Seller::getTableStatic());

            $table->boolean('is_statu')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
