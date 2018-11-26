<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('actors',  ['uses' => 'ActorController@showAllActors']);
    $router->get('actors/{id}', ['uses' => 'ActorController@showOneActor']);
    $router->post('actors', ['uses' => 'ActorController@create']);
    $router->delete('actors/{id}', ['uses' => 'ActorController@delete']);
    $router->put('actors/{id}', ['uses' => 'ActorController@update']);

    $router->get('movies',  ['uses' => 'MovieController@showAllMovies']);
    $router->get('movies/{id}', ['uses' => 'MovieController@showOneMovie']);
    $router->post('movies', ['uses' => 'MovieController@create']);
    $router->delete('movies/{id}', ['uses' => 'MovieController@delete']);
    $router->put('movies/{id}', ['uses' => 'MovieController@update']);

    $router->post('movies/{id}/actors', [
        'uses' => 'MovieController@addActor'
    ]);
    $router->delete('movies/{id}/actors', [
        'uses' => 'MovieController@removeActor'
    ]);
});