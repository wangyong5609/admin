<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionSwitchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_switches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mission_id');
            $table->dateTime('start_time');
            $table->dateTime('stop_time')->nullable();
            $table->float('consuming')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mission_switches');
    }
}
