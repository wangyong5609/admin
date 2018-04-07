<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('missions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->integer('post_id')->nullable();
			$table->string('description', 191)->nullable();
			$table->integer('status')->nullable()->comment('任务状态');
			$table->dateTime('start_time')->nullable();
			$table->dateTime('end_time')->nullable();
			$table->dateTime('plan_end_time')->nullable();
			$table->dateTime('complete_time')->nullable();
			$table->float('amount')->nullable();
			$table->integer('staff_id')->nullable();
			$table->integer('upper');
			$table->float('sustain');
			$table->integer('life')->nullable();
			$table->boolean('is_template')->default(0);
			$table->boolean('show')->default(1);
			$table->boolean('priority')->nullable();
			$table->string('file_uuid')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('remark', 191)->nullable();
			$table->integer('device_id')->nullable();
			$table->boolean('is_special')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('missions');
	}

}
