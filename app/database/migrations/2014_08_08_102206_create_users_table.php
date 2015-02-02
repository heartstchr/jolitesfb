<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->tinyInteger('gender'); //1:men 2:women
            $table->tinyInteger('interested_in');//1:men 2:women 3:both
            $table->string('email');
            $table->string('password');
            $table->integer('profile_pic')->unsigned()->nullable();
            $table->tinyInteger('status')->default(1); //1:not-activated 2:activated 3:suspended
            $table->tinyInteger('lang')->default(1);
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
