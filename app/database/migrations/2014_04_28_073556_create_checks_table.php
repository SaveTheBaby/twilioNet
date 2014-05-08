<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('checks', function($table) {
      $table->increments('id');
      $table->integer('mother_id');
      $table->date('date_of_visit');
      $table->decimal('weight_in_kg', 5, 2);
      $table->decimal('blood_pressur', 5, 2);
      $table->decimal('temperature', 4, 2);
      $table->decimal('height_of_abdomen', 5, 2);
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
		//
    Schema::drop('checks');
  }

}
