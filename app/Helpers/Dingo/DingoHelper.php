<?php

/**
 * Created by PhpStorm.
 * User: joaquinanduano
 * Date: 8/20/16
 * Time: 8:23 PM
 */

namespace App\Helpers\Dingo;

use Dingo\Api\Routing\Helpers;

trait DingoHelper
{
	use Helpers;


	/**
	 * Get the response factory instance.
	 *
	 * @return ResponseFactory
	 */

	protected function response()
	{
		return app('App\Helpers\Dingo\ResponseFactory');
	}
}