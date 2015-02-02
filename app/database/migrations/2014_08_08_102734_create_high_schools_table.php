<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHighSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('high_schools', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('school_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->longText('desc')->nullable();
            $table->tinyInteger('graduated')->default(0);//0:no 1:yes
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->softDeletes();
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
		Schema::drop('high_schools');
	}

}
