<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMothersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //
    Schema::create('mothers', function($table) {
      $table->increments('id');
      $table->string('phone_number')->unique();
      $table->string('password', 4);
      $table->integer('sex');
      $table->date('birthday');
      $table->integer('blood');
      $table->integer('rh');
      $table->date('schedule');
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
    Schema::drop('mothers');
  }

}
