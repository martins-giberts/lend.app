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

$app->get('/', function () use ($app) 
{
    return view('site.index');
});

$routes = require( base_path() . '/config/routes.php');

//$app->group(['prefix' => 'loans'], function ($app)
//{
//    $app->get('/', 'App\Http\Controllers\LoanController@index');
//    $app->get('/{loan}', 'App\Http\Controllers\LoanController@show');
//});

// TODO: Rework routes to better represent API purpose
foreach($routes as $route)
{
	$app->{$route['method']}($route['url'], [
		'as'=>$route['name'],
		'uses'=>$route['controller'].'@'.$route['action']
	]);
}
