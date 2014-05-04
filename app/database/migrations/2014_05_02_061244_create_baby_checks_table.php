<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBabyChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('baby_checks', function($table) {
      $table->increments('id');
      $table->integer('baby_id');
      $table->date('date_of_visit');
      $table->decimal('weight_in_kg', 4, 2);
      $table->decimal('temperature', 4, 2);
      $table->decimal('height', 5, 2);
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
    Schema::drop('baby_checks');
	}

}
