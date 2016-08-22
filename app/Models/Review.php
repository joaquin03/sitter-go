<?php

namespace App\Models;

use Dingo\Api\Exception\StoreResourceFailedException;

class Review extends BaseApiModel
{
	protected $fillable = [
		'description', 'stars', 'creator_name'
	];

	public function babysitter()
	{
		return $this->belongsTo('App\Models\Babysitter', 'id');
	}

	public function response()
	{
		return $this->hasOne('App\Models\ReviewResponse', 'review_id', 'id');
	}

	//Query Scope
	public function scopeExplicit($query)
	{
		return $query->with('response')->with('babysitter');
	}


	public function createResponse($responseData)
	{
		if ($this->response != null) {
			throw new StoreResourceFailedException("You can't create another response");
		}

		$response = new ReviewResponse();
		$response->review_id = $this->id;
		$response->fill($responseData);

		$response->saveOrFailApi();

		return $response;
	}


}
