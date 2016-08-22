<?php

namespace App\Http\Transformers;

use App\Models\User;

class UserTransformer extends BaseTransformer
{
	public function transform(User $user)
	{
		return [
			'id'            => $user->id_string,
			'username'		=> '',
			'created_at'    => (string) $user->created_at,
			'updated_at'    => (string) $user->updated_at
		];
	}

}