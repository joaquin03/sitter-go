<?php

namespace App\Http\Transformers;

use App\Models\ReviewResponse;

class ReviewResponseTransformer extends BaseTransformer
{

	public function transform(ReviewResponse $response)
	{
		return [
			'id'            => $response->id,
			'creator_name'  => $response->creator_name,
			'description'	=> $response->description,
			'created_at'    => (string) $response->created_at
		];
	}

}