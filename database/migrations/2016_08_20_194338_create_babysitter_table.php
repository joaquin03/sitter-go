<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBabysitterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('babysitters', function (Blueprint $table) {
			$table->increments('id');

			$table->string('name');
			$table->string('email');

			$table->string('country');
			$table->string('city');
			$table->string('neighborhood');

			$table->string('phone');

			$table->date('birthday');

			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('babysitters');
    }
}
