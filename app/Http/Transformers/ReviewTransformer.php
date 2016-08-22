<?php

namespace App\Http\Transformers;

use App\Models\Review;


class ReviewTransformer extends BaseTransformer
{

	public function transform(Review $review)
	{
		return [
			'id'            => $review->id,
			'description'	=> $review->description,
			'stars'			=> $review->stars,
			'created_at'    => (string) $review->created_at,

			'response' 		=> $this->transformResponse($review->response),

			'babysitter' 	=> $this->transformBabysitter($review->babysitter),
		];
	}


	private function transformResponse($response)
	{
		if ($response == null) {
			return new \stdClass();
		}
		$transformer  = new ReviewResponseTransformer();

		return $transformer->transform($response);
	}

	private function transformBabysitter($babysitter)
	{
		if ($babysitter == null) {
			return new \stdClass();
		}
		$transformer  = new BabysitterTransformer();

		return $transformer->transform($babysitter);
	}

}