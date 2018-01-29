<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Mission_templates.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:34:32am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class MissionTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('mission_templates',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('name');
        
        $table->integer('post_id');
        
        $table->String('description');
        
        $table->integer('upper');
        
        $table->float('sustain');
        
        $table->integer('arithmetic');
        
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
        Schema::drop('mission_templates');
    }
}
