<?php

/**
 * Created by PhpStorm.
 * User: joaquinanduano
 * Date: 8/20/16
 * Time: 6:45 PM
 */
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTester extends TestCase
{

	use DatabaseTransactions;

	private $apiUrl = '/api';

	protected function getJson($url, $params=[], $baseUrl='')
	{
		return $this->makeCall('GET', $url, $params, $baseUrl);
	}

	protected function postJson($url, $params=[], $baseUrl='')
	{
		return $this->makeCall('POST', $url, $params, $baseUrl);
	}

	protected function putJson($url, $prams=[], $baseUrl='')
	{
		return $this->makeCall('PUT', $url, $prams, $baseUrl);
	}

	protected function deleteJson($url, $prams=[], $baseUrl='')
	{
		return $this->makeCall('DELETE', $url, $prams, $baseUrl);
	}

	private function makeCall($method, $url, $params=[], $baseUrl='')
	{
		if ($baseUrl == '') {
			$baseUrl = $this->apiUrl;
		}
		return json_decode($this->call($method, $baseUrl.$url, $params)->getContent());
	}



	///Helpers
	protected function getBabysitterWithOutReviews()
	{
		$reviews = \App\Models\Review::get()->lists('babysitter_id');

		return \App\Models\Babysitter::where('deleted_at', null)
						->whereNotIn('id', $reviews)->first();
	}

	protected function getReviewWithOutResponse()
	{
		$response = \App\Models\ReviewResponse::get()->lists('review_id');

		return \App\Models\ReviewResponse::where('deleted_at', null)
			->whereNotIn('id', $response)->first();
	}
}