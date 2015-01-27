<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAttunementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('attunements')->insert(array(
            array('name' => 'Air'),
            array('name' => 'Death'),
            array('name' => 'Earth'),
            array('name' => 'Fire'),
            array('name' => 'Ice'),
            array('name' => 'Life'),
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('attunements')->delete();
	}

}
