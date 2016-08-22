<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('reviews', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('babysitter_id')->unsigned();
			$table->foreign('babysitter_id')->references('id')->on('babysitters');

			$table->string('creator_name');

			$table->string('description');
			$table->integer('stars');

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('reviews_responses', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('review_id')->unsigned();
			$table->foreign('review_id')->references('id')->on('reviews');

			$table->string('description');

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
		Schema::drop('reviews_responses');
		Schema::drop('reviews');
    }
}
