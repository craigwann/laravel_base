<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedRangesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('ranges')->insert(array(
            array('name' => 'Close', 'distance' => 1),
            array('name' => 'Medium', 'distance' => 10),
            array('name' => 'Far', 'distance' => 20)
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
