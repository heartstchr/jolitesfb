<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConversationRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conversation_replies', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('conversation_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->longText('message');
            $table->tinyInteger('status')->default(0); //0:unseen 1:seen
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
		Schema::drop('conversation_replies');
	}

}
