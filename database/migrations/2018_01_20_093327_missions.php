<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Missions.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:33:28am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Missions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('missions',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('name');
        
        $table->integer('post_id');
        
        $table->String('description')->nullable();
        
        $table->integer('status')->comment('任务状态');
        
        $table->date('start_time');
        
        $table->date('end_time');
        
        $table->date('complete_time')->nullable();
        
        $table->float('amount');
        
        $table->integer('staff_id')->nullable();
        
        $table->integer('upper');

        $table->float('sustain');

        $table->integer('arithmetic');

        $table->boolean('show')->default(true);

        $table->integer('parent_id')->nullable();

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
        Schema::drop('missions');
    }
}
