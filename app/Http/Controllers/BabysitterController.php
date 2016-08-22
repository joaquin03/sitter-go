<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBabysitterRequest;
use App\Http\Transformers\BabysitterTransformer;
use App\Models\Babysitter;


class BabysitterController extends ApiController
{
	/**
	 * BabySitterController constructor.
	 */
	public function __construct(Babysitter $babysitter)
	{
		$this->babysitter = $babysitter;
	}

	public function index()
	{
		$babysitters = $this->babysitter->paginate(15);

		return $this->response()->paginator($babysitters, new BabysitterTransformer());
	}

	public function show($id)
	{
		$babysitters = $this->babysitter->findOrFailApi($id);

		return $this->response()->item($babysitters, new BabysitterTransformer());
	}

	public function create(CreateBabysitterRequest $request)
	{
		$babysitters = new Babysitter();

		$babysitters->fill($request->all());

		$babysitters->saveOrFailApi();

		return $this->response()
					->createdItem($babysitters, new BabysitterTransformer())
					->setMessage("The babysitter was added");

	}

	public function update(CreateBabysitterRequest $request, $id)
	{
		$babysitters = $this->babysitter->findOrFailApi($id);

		$babysitters->fill($request->all());

		$babysitters->saveOrFailApi();

		return $this->response()
					->item($babysitters, new BabysitterTransformer())
					->setMessage("The babysitter was edited");
	}

	public function destroy($id)
	{
		$babysitters = $this->babysitter->findOrFailApi($id);

		$babysitters->deleteOrFailApi();

		return $this->response()->successful()->setMessage("The babysitter was removed");
	}

	public function indexV2Test()
	{
		$message = "You are in V2";

		return $this->response()->successful()->setMessage($message);
	}


}
