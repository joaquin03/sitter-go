<?php

namespace App\Http\Transformers;

use App\Models\Babysitter;

class BabysitterTransformer extends BaseTransformer
{
	public function transform(Babysitter $babysitter)
	{
		return [
			'id'            => $babysitter->id,
			'name'			=> $babysitter->name,
			'birthday'		=> $babysitter->birthday,
			'country'		=> $babysitter->country,
			'neighborhood'	=> $babysitter->neighborhood,
			'rating'		=> $babysitter->getRating(),

			'created_at'    => (string) $babysitter->created_at,

		];
	}

}