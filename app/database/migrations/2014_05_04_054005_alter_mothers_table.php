<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMothersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::table('mothers', function($table) {
      $table->boolean('active');
      $table->text('memo1');
      $table->text('memo2');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::table('mothers', function($table)
    {
      $table->dropColumn('active', 'memo1', 'memo2');
    });
	}

}
