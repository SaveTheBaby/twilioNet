<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObserveRecordsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //
    Schema::create('observe_records', function($table) {
      $table->increments('id');
      $table->integer('who_id');
      $table->integer('type');
      $table->integer('height');
      $table->integer('body_weight');
      $table->integer('body_temperature');
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
    Schema::drop('observe_records');
  }

}
