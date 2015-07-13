<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('app');
});

Route::group(['before' => 'oauth'], function(){
	Route::resource('post', 'ApiController');
	Route::get('posts/paginate', 'ApiController@paginate');
});


Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

//kCassin@gmail.com