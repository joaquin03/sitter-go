<?php

namespace App\Helpers\Dingo\Api\Http;
/**
 * Created by PhpStorm.
 * User: joaquinanduano
 * Date: 8/21/16
 * Time: 10:01 PM
 */
use Dingo\Api\Http\Response;
use Dingo\Api\Transformer\Binding;

class CustomResponse extends Response
{


	public function __construct($content, $status = 200, $headers = [], Binding $binding = null, $message = null)
	{
		parent::__construct($content, $status, $headers, $binding);

		$this->setMessage($message);
	}

	public function setMessage($message)
	{
		if (! is_null($message))  {

			$content = json_decode($this->content, true);

			if (is_array($content)) {
				$data = array_merge($content, ['message'=>$message]);
			} else {
				$data = ['message'=>$message];
			}


			$this->setContent(json_encode($data, true));
		}

		return $this;

	}


}