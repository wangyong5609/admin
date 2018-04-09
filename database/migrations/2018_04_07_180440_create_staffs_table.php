<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staffs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
            $table->string('phone', 11)->nullable();
			$table->string('status', 191)->nullable();
			$table->string('mission_status', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->string('mission_rt', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('staffs');
	}

}
