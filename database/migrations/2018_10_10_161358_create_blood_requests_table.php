<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloodRequestsTable extends Migration {

	public function up()
	{
		Schema::create('blood_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->string('patient_name', 100);
			$table->string('patient_age', 3);
			$table->enum('blood_type', array('O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'));
			$table->string('bag_num', 3);
			$table->string('hospital_name', 100);
			$table->string('hospital_address', 255);
			$table->integer('city_id')->unsigned();
			$table->string('mobile', 20);
			$table->string('notes', 255);
			$table->double('latitude', 10,10)->nullable();
			$table->double('longitude', 10,10)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('blood_requests');
	}
}
