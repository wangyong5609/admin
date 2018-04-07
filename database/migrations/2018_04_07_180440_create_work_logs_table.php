<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('work_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('staff_id');
			$table->date('date');
			$table->string('status', 191);
			$table->boolean('disabled')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('work_logs');
	}

}
