<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('mobile', 20);
			$table->string('email');
			$table->string('about_us');
			$table->string('facebook');
			$table->string('twitter');
			$table->string('youtube');
			$table->string('whatsapp');
			$table->string('instagram');
			$table->string('gmail');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
