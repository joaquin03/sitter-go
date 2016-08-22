<?php

/**
 * Created by PhpStorm.
 * User: joaquinanduano
 * Date: 8/20/16
 * Time: 6:56 PM
 */

use App\Models\Review;

class ReviewTest extends ApiTester
{

	public function test_the_list_of_reviews()
	{
		$data = $this->getJson('/review');

		//dd($data);
		$this->assertEquals(200, $this->response->getStatusCode());
	}

	public function test_show_review()
	{
		$review =  Review::first();

		$data = $this->getJson('/review/'.$review->id);

		//dd($data);
		$this->assertEquals(200, $this->response->getStatusCode());
	}

	public function test_create_review()
	{
		$data = [
			'description' 	=> "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore",
			'creator_name' 	=> "Juan",
			'stars'			=> "5"
		];
		$babysitter = \App\Models\Babysitter::first();

		$data = $this->postJson('/babysitter/'.$babysitter->id.'/review/', $data);

		//dd($data);
		$this->assertEquals(201, $this->response->getStatusCode());
	}

	public function test_create_review_bad_request()
	{
		$data = [
			'description' 	=> "Joaquin",
			'creator_name' 	=> "Juan",
			'stars'			=> "54"
		];
		$babysitter = \App\Models\Babysitter::first();

		$data = $this->postJson('/babysitter/'.$babysitter->id.'/review/', $data);

		//dd($data);
		$this->assertEquals(422, $this->response->getStatusCode());

	}


	public function test_remove_review()
	{
		$review = $this->getReviewWithOutResponse();


		$data = $this->deleteJson('/review/'.$review->id);

		//dd($data);
		$this->notSeeInDatabase('reviews', ['id' => $review->id, 'deleted_at' => null]);
		$this->assertEquals(200, $this->response->getStatusCode());
	}
}