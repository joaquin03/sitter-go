<?php

/**
 * Created by PhpStorm.
 * User: joaquinanduano
 * Date: 8/20/16
 * Time: 6:56 PM
 */

use App\Models\Babysitter;

class BabysitterTest extends ApiTester
{

	public function test_the_list_of_babysitters()
	{
		$data = $this->getJson('/babysitter');

		//dd($data);
		$this->assertEquals(200, $this->response->getStatusCode());
	}

	public function test_show_babysitter()
	{
		$babysitter =  Babysitter::first();

		$data = $this->getJson('/babysitter/'.$babysitter->id);

		//dd($data);
		$this->assertEquals(200, $this->response->getStatusCode());
	}

	public function test_create_babysitter()
	{
		$data = [
			'name' => "Joaquin",
			'email' => "Janduano@gmail.com",
			'country' => "Uruguay",
			'city' => "Montevideo",
			'neighborhood' => "Cordon",
			'phone' => "0983328233",
			'birthday' => "03-11-1992",
		];
		//dd($data)
		$data = $this->postJson('/babysitter/', $data);

		$this->assertEquals(201, $this->response->getStatusCode());
	}

	public function test_create_babysitter_bad_request()
	{
		$data = [
			'email' => "Janduano",
			'country' => "Uruguay",
			'city' => "Montevideo",
			'neighborhood' => "Cordon",
			'phone' => "0983328233",
			'birthday' => "03-11-1992",
		];

		$data = $this->postJson('/babysitter/', $data);
		//dd($data);
		$this->assertEquals(422, $this->response->getStatusCode());

	}

	public function test_edit_babysitter()
	{
		$babysitter =  Babysitter::first();

		$data = [
			'name' => "Joaquin 2",
			'email' => "Janduano@gmail.com",
			'country' => "Uruguay",
			'city' => "Montevideo",
			'neighborhood' => "Cordon",
			'phone' => "0983328233",
			'birthday' => "03-11-1992",
		];

		$data = $this->putJson('/babysitter/'.$babysitter->id, $data);

		//dd($data);

		$this->assertEquals(200, $this->response->getStatusCode());
	}


	public function test_remove_babysitter()
	{
		$babysitter = $this->getBabysitterWithOutReviews();


		$data = $this->deleteJson('/babysitter/'.$babysitter->id);

		//dd($data);
		$this->notSeeInDatabase('babysitters', ['id' => $babysitter->id, 'deleted_at' => null]);
		$this->assertEquals(200, $this->response->getStatusCode());
	}
}