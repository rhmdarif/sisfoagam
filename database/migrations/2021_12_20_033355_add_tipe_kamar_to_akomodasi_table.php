<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipeKamarToAkomodasiTable extends Migration
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
            $table->text('tipe_kamar')->after('keterangan')->nullable();
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
            $table->dropColumn(['tipe_kamar']);
        });
    }
}
