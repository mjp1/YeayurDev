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

Route::get('/', [
	'uses' => '\Yeayurdev\Http\Controllers\HomeController@index',
	'as' => 'home',
	'middleware' => ['guest'],
	
]);

/**
 *  Authentication
 */

Route::get('/signup', [
	'uses' => '\Yeayurdev\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup',
	'middleware' => ['guest'],
]);

Route::post('/signup', [
	'uses' => '\Yeayurdev\Http\Controllers\AuthController@postSignup',
	'middleware' => ['guest'],
]);

Route::post('/', [
	'uses' => '\Yeayurdev\Http\Controllers\AuthController@postSignin',
	'as' => 'profile.signin',
	'middleware' => ['guest'],
]);

Route::get('/main', [
	'uses' => '\Yeayurdev\Http\Controllers\MainController@getMain',
	'as' => 'main',
	'middleware' => ['auth'],
]);

Route::get('/signout', [
	'uses' => '\Yeayurdev\Http\Controllers\AuthController@getSignout',
	'as' => 'auth.signout',
]);

/**
 *  Search
 */

Route::get('/search', [
	'uses' => '\Yeayurdev\Http\Controllers\SearchController@getResults',
	'as' => 'search.results',
	'middleware' => ['auth'],
]);

/**
 *  User Profile
 */

Route::get('/profile/{username}', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile',
	'middleware' => ['auth'],
]);

Route::get('/profile-edit', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@getEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
	
]);

Route::post('/profile-edit', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@postEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
]);

/**
 *  Follow User
 */

Route::get('/profile/add/{username}', [
	'uses' => '\Yeayurdev\Http\Controllers\FriendController@getAddFollowing',
	'as' => 'profile.add',
	'middleware' => ['auth'],
]);

Route::get('/profile/remove/{username}', [
	'uses' => '\Yeayurdev\Http\Controllers\FriendController@getRemoveFollowing',
	'as' => 'profile.remove',
	'middleware' => ['auth'],
]);

/**
 *  Posts
 */

Route::post('/post/{id}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postMessage',
	'as' => 'post.message',
	'middleware' => ['auth'],
]);

/**
 *  Forgot Password
 */

Route::get('/forgotpassword', [
	'uses' => '\Yeayurdev\Http\Controllers\AuthController@getForgotPassword',
	'as' => 'forgotpassword',
	'middleware' => ['guest'],
]);

/**
 *  Support
 */

Route::get('/support', [
	'uses' => '\Yeayurdev\Http\Controllers\SupportController@getSupport',
	'as' => 'support',
]);