<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Transformers\ReviewTransformer;
use App\Models\Babysitter;
use App\Models\Review;

use App\Http\Requests\CreateReviewResponseRequest;

use App\Http\Transformers\ReviewResponseTransformer;
use App\Http\Transformers\ReviewListTransformer;


class ReviewController extends ApiController
{

	protected $review;
	protected $babysitter;

	/**
	 * ReviewController constructor.
	 */
	public function __construct(Review $review, Babysitter $babysitter)
	{
		$this->review = $review;
		$this->babysitter = $babysitter;
	}

	public function index()
	{
		$review = $this->review->with('response')->paginate(15);

		return $this->response()->paginator($review, new ReviewListTransformer());
	}

	public function show($id)
	{
		$review = $this->review->explicit()->findOrFailApi($id);

		return $this->response()->item($review, new ReviewTransformer());
	}

	public function create(CreateReviewRequest $request, $id)
	{
		$babysitter = $this->babysitter->findOrFailApi($id);

		$review = new Review();
		$review->babysitter_id = $babysitter->id;

		$review->fill($request->all());

		$review->saveOrFailApi();

		return $this->response()->createdItem($review, new ReviewListTransformer())
					->setMessage("The babysitter was added");

	}

	public function destroy($id)
	{
		$review = $this->review->findOrFailApi($id);

		$review->deleteOrFailApi();

		return $this->response()->successful()->setMessage("The babysitter was removed");
	}

	public function createResponse(CreateReviewResponseRequest $request, $id)
	{
		$review = $this->review->explicit()->findOrFailApi($id);

		$response = $review->createResponse($request->all());

		return $this->response()->createdItem($response, new ReviewResponseTransformer())
					->setMessage("The babysitter was removed");
	}

}
