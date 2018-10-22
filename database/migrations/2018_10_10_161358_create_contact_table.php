<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactTable extends Migration {

	public function up()
	{
		Schema::create('contact', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->integer('client_id')->unsigned();
			$table->string('body', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contact');
	}
}