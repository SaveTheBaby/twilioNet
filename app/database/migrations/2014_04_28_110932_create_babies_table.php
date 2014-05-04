<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBabiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('babies', function($table) {
      $table->increments('id');
      $table->integer('mother_id');
      $table->integer('sex');
      $table->date('birthday');
      $table->integer('blood');
      $table->integer('rh');
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
    Schema::drop('babies');
  }

}
