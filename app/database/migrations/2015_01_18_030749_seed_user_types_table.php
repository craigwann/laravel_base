<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUserTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('user_types')->insert(array(
            array('name' => 'Admin', 'level' => 10),
            array('name' => 'Manager', 'level' => 9),
            array('name' => 'Moderator', 'level' => 6),
            array('name' => 'Game Master', 'level' => 3),
            array('name' => 'Player', 'level' => 2),
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('user_types')->delete();
	}

}
