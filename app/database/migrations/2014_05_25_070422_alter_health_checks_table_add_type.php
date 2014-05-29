<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHealthChecksTableAddType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('health_checks', function(Blueprint $table)
		{
      $table->integer('type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('health_checks', function(Blueprint $table)
		{
      $table->dropColumn('type');
		});
	}

}
