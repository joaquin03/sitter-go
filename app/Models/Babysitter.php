<?php

namespace App\Models;


class Babysitter extends BaseApiModel
{
	protected $fillable = [
		'name', 'email', 'country', 'city', 'neighborhood', 'phone', 'birthday'
	];

	public function reviews()
	{
		return $this->hasMany('App\Models\Review', 'babysitter_id', 'id');
	}


	public function getRating()
	{
		return round($this->reviews()->avg('stars'), 1);
	}


}
