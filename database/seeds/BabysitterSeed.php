<?php

use Illuminate\Database\Seeder;
use App\Models\Babysitter;

class BabysitterSeed extends Seeder
{


	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 21; $i++) {
        	if (! Babysitter::where('id', $i)->exists()) {

        		$this->create($i);
			}

		}
    }

	/**
	 * @param $i
	 * @param $faker
	 */
	public function create($i)
	{
		$faker = Faker\Factory::create();

		$babysitter = new Babysitter();
		$babysitter->id = $i;
		$babysitter->name = $faker->name;
		$babysitter->email = $faker->email;

		$babysitter->country = "Uruguay";
		$babysitter->city = "Montevideo";
		$items = ['Cordon', "Pocitos", "Parque Rodó"];
		$babysitter->neighborhood = $items[$faker->numberBetween(0,2)];


		$babysitter->phone = $faker->phoneNumber;

		$babysitter->birthday = $faker->dateTimeBetween('-28 years', '-19 years');

		$babysitter->save();
	}


}
