<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Staffs.
 *
 * @author  The scaffold-interface created at 2018-01-20 09:30:44am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Staffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('staffs',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('name');
        

        $table->String('status')->nullable();

        $table->String('mission_status')->nullable();

        $table->String('description')->nullable();
        $table->String('mission_rt')->nullable();
        $table->string('phone')->nullable();


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
        Schema::drop('staffs');
    }
}
