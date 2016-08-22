<?php

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeed extends Seeder
{

	protected $faker;
	/**
	 * ReviewSeed constructor.
	 */
	public function __construct()
	{
		$this->faker = Faker\Factory::create();
	}

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for($i = 1; $i < 10; $i++) {
			if (! Review::where('id', $i)->exists()) {

				$this->create($i);
			}

		}
    }

    protected function create($id)
	{
		$faker = $this->faker;


		$review = new Review();
		$review->id = $id;
		$review->description = $faker->text();
		$review->stars = $faker->numberBetween(1, 5);
		$review->creator_name = $faker->name;
		$review->babysitter_id = $id;
		$review->save();
		if ($id % 2 == 0) {
			$this->createResponse($review);
		}
	}

	protected function createResponse(Review $review)
	{
		$data = [
			'description' => $this->faker->text()
		];

		$review->createResponse($data);
	}
}
