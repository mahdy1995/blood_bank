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
			$table->string('about_app');
			$table->string('facebook_url');
			$table->string('twitter_url');
			$table->string('youtube_url');
			$table->string('whatsapp_url');
			$table->string('instagram_url');
			$table->string('gmail_url');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
