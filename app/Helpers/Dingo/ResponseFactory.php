<?php

namespace App\Helpers\Dingo;

use App\Helpers\Dingo\Api\Http\CustomResponse;
use Dingo\Api\Http\Response\Factory;
use Dingo\Api\Http\Response;
use Dingo\Api\Transformer\Binding;
use Closure;

/**
 * Class ResponseFactory
 * @package App\Helpers\Dingo
 */
class ResponseFactory extends Factory
{

	/**
	 * Respond with a created response and associate a location if provided.
	 *
	 * @param null|string $location
	 * @param null|string $message
	 * @param null|array $content
	 *
	 * @return CustomResponse
	 */
	public function successful($location = null, array $content = [])
	{
		return $this->createSimpleResponse($location, $content, 200);
	}
	/**
	 * Respond with an accepted response and associate a location and/or content if provided.
	 *
	 * @param null|string $location
	 * @param mixed       $content
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function accepted($location = null, $content = null)
	{
		return $this->createSimpleResponse($location, $content, 202);
	}

	/**
	 * @param string $location
	 * @param string $message
	 * @param array $content
	 * @return CustomResponse
	 */
	protected function createSimpleResponse($location = null, $content, $statusCode)
	{
		$response = new CustomResponse($content);
		$response->setStatusCode($statusCode);

		if (! is_null($location)) {
			$response->header('Location', $location);
		}

		return $response;
	}


	/**
	 * Bind an item to a transformer and start building a response.
	 *
	 * @param object   $item
	 * @param object   $transformer
	 * @param array    $parameters
	 * @param \Closure $after
	 *
	 * @return CustomResponse
	 */
	public function item($item, $transformer, array $parameters = [], Closure $after = null)
	{
		return $this->buildItemResponse($item, $transformer, $parameters, $after, 200);
	}

	/**
	 * Bind an item to a transformer and start building a created response.
	 *
	 * @param object   $item
	 * @param object   $transformer
	 * @param array    $parameters
	 * @param \Closure $after
	 *
	 * @return CustomResponse
	 */
	public function createdItem($item, $transformer, array $parameters = [], Closure $after = null)
	{
		return $this->buildItemResponse($item, $transformer, $parameters, $after, 201);
	}


	/**
	 * Bind an item to a transformer and start building a response with the status code.
	 *
	 * @param object   $item
	 * @param object   $transformer
	 * @param array    $parameters
	 * @param \Closure $after
	 * @param int 	   $statusCode
	 *
	 * @return CustomResponse
	 */
	protected function buildItemResponse($item, $transformer, array $parameters = [], Closure $after = null, $statusCode)
	{
		$class = get_class($item);

		$binding = $this->transformer->register($class, $transformer, $parameters, $after);

		$itemData = $this->transformer->transform($item);

		$message = '';
		if (isset($parameters['message'])) {
			$message = $parameters['message'];
		}

		return $this->createSuccessItemResponse($itemData, $statusCode);
	}

	/**
	 * @param string $message
	 * @param array|null $content
	 * @param Binding $binding
	 * @return CustomResponse
	 */
	protected function createSuccessItemResponse(array $content = null, $statusCode = 200)
	{
		return new CustomResponse($content, $statusCode);
	}




	




}
