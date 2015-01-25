<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTargetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('targets')->insert(array(
            array('name' => 'Single Enemy'),
            array('name' => 'Group of Enemies'),
            array('name' => 'Single Friendly'),
            array('name' => 'Group of Friendlies'),
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('targets')->delete();
	}

}
