<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugEventParawisataToEventParawisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_parawisata', function (Blueprint $table) {
            //
            $table->string('slug_event_parawisata', 255)->after('jadwal_pelaksanaan')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_parawisata', function (Blueprint $table) {
            //
            $table->dropColumn(['slug_event_parawisata']);
        });
    }
}
