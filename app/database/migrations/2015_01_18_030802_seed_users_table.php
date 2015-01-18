<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('users')->insert(array(
            array('first_name' => 'Craig', 'last_name' => 'Wann', 'email' => 'craigwann1@gmail.com', 'username' => 'incraigulous', 'user_type_id' => 1, 'password' => Hash::make('password'))
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('users')->delete();
	}

}
