<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventParawisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_parawisata', function (Blueprint $table) {
            $table->id();
            $table->string('slug_event_parawisata')->unique();
            $table->string('jenis_event');
            $table->date('start_at');
            $table->date('end_at');
            $table->text('keterangan');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_parawisata');
    }
}
