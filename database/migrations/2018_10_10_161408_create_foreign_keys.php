<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('blood_requests', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('blood_requests', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('notifcations', function(Blueprint $table) {
			$table->foreign('don_req_id')->references('id')->on('blood_requests')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('reports', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('contact', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('governorate_id')->references('id')->on('governorates')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('city_client', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('city_client', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('blood_type_client', function(Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_type')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('blood_type_client', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('blood_requests', function(Blueprint $table) {
			$table->dropForeign('blood_requests_client_id_foreign');
		});
		Schema::table('blood_requests', function(Blueprint $table) {
			$table->dropForeign('blood_requests_city_id_foreign');
		});
		Schema::table('notifcations', function(Blueprint $table) {
			$table->dropForeign('notifcations_don_req_id_foreign');
		});
		Schema::table('reports', function(Blueprint $table) {
			$table->dropForeign('reports_client_id_foreign');
		});
		Schema::table('contact', function(Blueprint $table) {
			$table->dropForeign('contact_client_id_foreign');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->dropForeign('articles_category_id_foreign');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_governorate_id_foreign');
		});
		Schema::table('city_client', function(Blueprint $table) {
			$table->dropForeign('city_client_city_id_foreign');
		});
		Schema::table('city_client', function(Blueprint $table) {
			$table->dropForeign('city_client_client_id_foreign');
		});
		Schema::table('blood_type_client', function(Blueprint $table) {
			$table->dropForeign('blood_type_client_blood_type_id_foreign');
		});
		Schema::table('blood_type_client', function(Blueprint $table) {
			$table->dropForeign('blood_type_client_client_id_foreign');
		});
	}
}