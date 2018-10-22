<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 32);
			$table->string('email', 190)->unique();
			$table->date('birth_date');
			$table->enum('blood_type', array('O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'));
			$table->integer('city_id');
			$table->string('mobile', 20)->unique();
			$table->string('password', 64);
			$table->date('last_don_date');
			$table->boolean('is_active');
			$table->string('api_token', 60)->unique()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
