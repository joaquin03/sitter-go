<?php


Route::get('/', function () {
    return view('welcome');
});

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api) {

	$api->group(['namespace' => 'App\Http\Controllers'], function($api) {

		$api->group(['prefix' => 'babysitter'], function($api) {

			$api->get('/', ['as' => 'babysitter.index', 'uses' => 'BabysitterController@index']);

			$api->get('/{id}', ['as' => 'babysitter.show', 'uses' => 'BabysitterController@show']);

			$api->post('/', ['as' => 'babysitter.create', 'uses' => 'BabysitterController@create']);

			$api->put('/{id}', ['as' => 'babysitter.update', 'uses' => 'BabysitterController@update']);

			$api->delete('/{id}', ['as' => 'babysitter.destroy', 'uses' => 'BabysitterController@destroy']);


			//
			$api->post('/{id}/review', ['as' => 'review.create', 'uses' => 'ReviewController@create']);


		});

		$api->group(['prefix' => 'review'], function($api) {

			$api->get('/', ['as' => 'review.index', 'uses' => 'ReviewController@index']);

			$api->get('/{id}', ['as' => 'review.show', 'uses' => 'ReviewController@show']);



			$api->delete('/{id}', ['as' => 'review.destroy', 'uses' => 'ReviewController@destroy']);


			$api->post('/{id}/response', ['as' => 'review.response.create', 'uses' => 'ReviewController@createResponse']);

		});


	});



});

$api->version('v2', function ($api) {

	$api->group(['namespace' => 'App\Http\Controllers'], function($api) {

		$api->group(['prefix' => 'babysitter'], function($api) {

			$api->get('/', ['as' => 'babysitter.index', 'uses' => 'BabysitterController@indexV2Test']);

		});
	});
});