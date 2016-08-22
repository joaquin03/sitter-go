<?php

namespace App\Http\Controllers;

use Dingo\Api\Contract\Http\Request;


class UserController extends ApiController
{
    public function show($id)
	{
		return $this->response()->item();
	}
}
