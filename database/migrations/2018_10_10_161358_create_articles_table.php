<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->text('body');
			$table->timestamps();
			$table->integer('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}