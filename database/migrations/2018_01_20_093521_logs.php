<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Logs.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:35:21am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Logs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('logs',function (Blueprint $table){

        $table->increments('id');
        
        $table->integer('mission_id');
        
        $table->String('project');
        
        $table->String('original');
        
        $table->String('modification');
        
        /**
         * Foreignkeys section
         */
        
        
        $table->timestamps();
        
        
        $table->softDeletes();
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('logs');
    }
}
