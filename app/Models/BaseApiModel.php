<?php
/**
 * Created by PhpStorm.
 * User: joaquinanduano
 * Date: 8/20/16
 * Time: 6:26 PM
 */

namespace App\Models;

use Dingo\Api\Exception\ResourceException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseApiModel extends Model
{


	/**
	 * @param $id
	 * @return self
	 *
	 *  @throws ResourceException
	 */
	public function scopeFindOrFailApi($query, $id)
	{
		try{
			return $query->findOrFail($id);
		} catch(\Exception $e) {
			Log::error($e);
			throw new NotFoundHttpException('Error, the resource cannot be found');
		}
	}

	/**
	 * Save the model to the database using transaction.
	 *
	 * @param  array  $options
	 * @return bool
	 *
	 * @throws ResourceException
	 */
	public function saveOrFailApi(array $options = [])
	{
		try{
			return $this->saveOrFail($options);
		} catch(\Exception $e) {
			Log::error($e);
			throw new ResourceException('Error saving the element');
		}

	}

	/**
	 * Delete the model from the database.
	 *
	 * @return bool|null
	 *
	 * @throws ResourceException
	 */
	public function deleteOrFailApi()
	{
		try{
			return $this->delete();
		} catch(\Exception $e) {
			Log::error($e);
			throw new ResourceException('Error removing the element');
		}

	}


}