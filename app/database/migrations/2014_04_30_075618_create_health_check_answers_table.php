<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthCheckAnswersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('health_check_answers', function($table) {
      $table->increments('id');
      $table->integer('health_check_id');
      $table->integer('mother_id');
      $table->string('answer');
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
    Schema::drop('health_check_answers');
  }
}
