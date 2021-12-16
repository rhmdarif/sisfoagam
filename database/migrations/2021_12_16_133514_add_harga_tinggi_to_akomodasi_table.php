<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHargaTinggiToAkomodasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akomodasi', function (Blueprint $table) {
            //
            $table->bigInteger('harga_atas')->default(0)->after('harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('akomodasi', function (Blueprint $table) {
            //
            $table->dropColumn(['harga_atas']);
        });
    }
}
