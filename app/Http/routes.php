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

	/**
	 *   Registration Routes
	 */

		/**
		 *   Register for Yeayur
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

		/**
		 *   OAuth for Twitch and Youtube
		 */

		Route::get('/signup/external', [
			'uses' => '\Yeayurdev\Http\Controllers\AuthController@getExternal',
			'as' => 'auth.signupexternal',
			'middleware' => ['auth'],
		]);		


	/**
	 *   Sign In / Sign Out Routes
	 */

	Route::post('/', [
		'uses' => '\Yeayurdev\Http\Controllers\AuthController@postSignin',
		'as' => 'profile.signin',
		'middleware' => ['guest'],
	]);

		/**
		 *   Redirect to main page after sign in
		 */

		Route::get('/main', [
			'uses' => '\Yeayurdev\Http\Controllers\MainController@getMain',
			'as' => 'main',
			'middleware' => ['auth'],
		]);

		/**
		 *   Redirect to Incorrect Password view
		 */

		Route::get('/forgotlogin', [
			'uses' => '\Yeayurdev\Http\Controllers\AuthController@getForgotLogin',
			'as' => 'forgotlogin',
			'middleware' => ['guest'],
		]);

	Route::get('/signout', [
		'uses' => '\Yeayurdev\Http\Controllers\AuthController@getSignout',
		'as' => 'auth.signout',
	]);

/**
 *  Search for users
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

	/**
	 *   Edit user profile routes
	 */

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

/**
 *  Quit following user
 */

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

Route::post('/post/{postId}/reply', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postReply',
	'as' => 'post.reply',
	'middleware' => ['auth'],
]);

/**
 *  Forgot Password
 */

Route::get('password/email', 'PasswordController@getEmail');
Route::post('password/email', 'PasswordController@postEmail');

/**
 *   Password reset routes
 */

Route::get('password/reset/{token}', 'PasswordController@getReset');
Route::post('password/reset', 'PasswordController@postReset');

/**
 *  Support
 */

Route::get('/support', [
	'uses' => '\Yeayurdev\Http\Controllers\SupportController@getSupport',
	'as' => 'support',
]);