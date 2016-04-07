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
		 *   Authentication Routes for Twitch and Google
		 */

		Route::get('/oauth_authorization', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@getOAuth',
			'as' => 'oauth.oauth',
			'middleware' => ['auth'],
		]);	

		Route::get('/oauth_authorization/error', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@getOAuthError',
			'as' => 'oauth.error',
			'middleware' => ['auth'],
		]);

		Route::get('/oauth_authorization/confirmation', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@getOAuthConfirmation',
			'as' => 'oauth.oauthconfirmation',
			'middleware' => ['auth'],
		]);	

		Route::get('/oauth_authorization/confirmation/redirect', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@getRouteOAuthToProfile',
			'as' => 'oauth.oauthconfirmation_redirect',
			'middleware' => ['auth'],
		]);

		Route::get('/oauth_authorization/twitch', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@redirectToTwitch',
			'as' => 'oauth_twitch',
			'middleware' => ['auth'],
		]);

		Route::get('/oauth_authorization/twitch/callback', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@handleTwitchCallback',
			'middleware' => ['auth'],
		]);	

		Route::get('/oauth_authorization/youtube', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@redirectToYoutube',
			'as' => 'oauth_youtube',
			'middleware' => ['auth'],
		]);

		Route::get('/oauth_authorization/youtube/callback', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@handleYoutubeCallback',
			'middleware' => ['auth'],
		]);

		/**
		 *   Post Route To Select Primary Provider
		 */

		Route::post('/oauth_authorization/primary_selection', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@postPrimarySelection',
			'as' => 'oauth_primarySelection',
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

		/*Not using a Main page right now. User is redirected to their profile after logging in.*/

		/*Route::get('/main', [
			'uses' => '\Yeayurdev\Http\Controllers\MainController@getMain',
			'as' => 'main',
			'middleware' => ['auth'],
		]);*/

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

Route::get('/{username}', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile',
	'middleware' => ['auth'],
]);

	/**
	 *   Routes for initial user profile setup from modal inputs
	 */

	Route::post('/profile/categories/1', [
		'uses' => '\Yeayurdev\Http\Controllers\UserProfileSetupController@postProfileSetup1',
		'middleware' => ['auth'],
	]);

	Route::post('/profile/categories/2', [
		'uses' => '\Yeayurdev\Http\Controllers\UserProfileSetupController@postProfileSetup2',
		'middleware' => ['auth'],
	]);

	Route::post('/profile/categories/3', [
		'uses' => '\Yeayurdev\Http\Controllers\UserProfileSetupController@postProfileSetup3',
		'middleware' => ['auth'],
	]);

	/**
	 *   Edit user profile routes
	 */

	Route::get('/profile/edit', [
		'uses' => '\Yeayurdev\Http\Controllers\ProfileController@getEdit',
		'as' => 'profile.edit',
		'middleware' => ['auth'],
		
	]);

	Route::post('/profile/edit', [
		'uses' => '\Yeayurdev\Http\Controllers\ProfileController@postEdit',
		'as' => 'profile.edit',
		'middleware' => ['auth'],
	]);

	Route::post('/profile/edit/profileimage', [
		'uses' => '\Yeayurdev\Http\Controllers\ProfileController@postEditPic',
		'as' => 'profile.edit.pic',
		'middleware' => ['auth'],
	]);

	Route::post('/profile/edit/about', [
		'uses' => '\Yeayurdev\Http\Controllers\ProfileController@postEditAbout',
		'as' => 'profile.edit.about',
		'middleware' => ['auth'],
	]);

		/**
		 *   Edit individual streamer category details
		 */

		Route::post('/profile/categories/edit', [
			'uses' => '\Yeayurdev\Http\Controllers\UserProfileSetupController@postEditCategories',
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

Route::post('/post/edit/{id}/{postid}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postEditMessage',
	'as' => 'post.message.edit',
	'middleware' => ['auth'],
]);

Route::post('/post/{postId}/reply', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postReply',
	'as' => 'post.reply',
	'middleware' => ['auth'],
]);

Route::get('/post/{postId}/like', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@getLike',
	'as' => 'post.like',
	'middleware' => ['auth'],
]);

/**
 *  Delete a post
 */

Route::post('/post/delete/{id}/{postid}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postDeleteMessage',
	'as' => 'post.message.delete',
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
	'middleware' => ['auth'],
]);

Route::post('/support', [
	'uses' => '\Yeayurdev\Http\Controllers\SupportController@postSupport',
	'as' => 'post.support',
	'middleware' => ['auth'],
]);

Route::get('/registration/support', [
	'uses' => '\Yeayurdev\Http\Controllers\SupportController@getRegistrationSupport',
	'as' => 'registration.support',
]);