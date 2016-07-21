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
	'uses' => '\Yeayurdev\Http\Controllers\MainController@getIndex',
	'as' => 'index',
]);

Route::get('/profiles', [
	'uses' => '\Yeayurdev\Http\Controllers\MainController@getProfilesPage',
	'as' => 'index.profiles',
]);

Route::get('/fan_pages', [
	'uses' => '\Yeayurdev\Http\Controllers\MainController@getFanPages',
	'as' => 'index.fanpages',
]);

Route::get('/top_contributors', [
	'uses' => '\Yeayurdev\Http\Controllers\MainController@getTopContributorsPage',
	'as' => 'index.topcontributors',
]);

Route::get('/recent_posts', [
	'uses' => '\Yeayurdev\Http\Controllers\MainController@getRecentPostsPage',
	'as' => 'index.recentposts',
]);

/**
 *  Support
 */

Route::get('/support', [
	'uses' => 'SupportController@getSupport',
	'as' => 'support',
	'middleware' => ['auth'],
]);

Route::post('/support', [
	'uses' => '\Yeayurdev\Http\Controllers\SupportController@postSupport',
	'as' => 'post.support',
	'middleware' => ['auth'],
]);
	/**
	 * Support routes when not logged in
	 */

	Route::get('/support/public', [
		'uses' => 'SupportController@getPublicSupport',
		'as' => 'support.public',
	]);

	Route::post('/support/public', [
		'uses' => 'SupportController@postPublicSupport',
		'as' => 'post.support.public',
	]);

Route::get('/registration/support', [
	'uses' => '\Yeayurdev\Http\Controllers\SupportController@getRegistrationSupport',
	'as' => 'registration.support',
]);

/**
 * Terms of service and privacy policy
 */

Route::get('/terms_of_service', [
	'uses' => 'MiscController@getTermsofService',
	'as' => 'terms',
]);

Route::get('/privacy_policy', [
	'uses' => 'MiscController@getPrivacypolicy',
	'as' => 'privacy',
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

		Route::get('/signup/convert', [
			'uses' => '\Yeayurdev\Http\Controllers\AuthController@getSignupConvert',
			'as' => 'auth.convert',
			'middleware' => ['guest'],
		]);

		/**
		 *   Authentication Routes for Twitch and Google
		 */

		Route::get('/oauth_authorization/error', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@getOAuthError',
			'as' => 'oauth.error',
			'middleware' => ['guest'],
		]);

		Route::get('/oauth_authorization/twitch', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@redirectToTwitch',
			'as' => 'oauth_twitch',
			'middleware' => ['guest'],
		]);

		Route::get('/oauth_authorization/twitch/register', [
			'uses' => '\Yeayurdev\Http\Controllers\AuthController@registerWithTwitch',
			'as' => 'oauth_twitch.register',
			'middleware' => ['guest'],
		]);

		Route::get('/oauth_authorization/twitch/register/convert', [
			'uses' => '\Yeayurdev\Http\Controllers\AuthController@registerWithTwitchConvert',
			'as' => 'oauth_twitch.register.convert',
			'middleware' => ['guest'],
		]);

		Route::get('/oauth_authorization/twitch/callback', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@handleTwitchCallback',
			'middleware' => ['guest'],
		]);	

		/*Route::get('/oauth_authorization/youtube', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@redirectToYoutube',
			'as' => 'oauth_youtube',
			'middleware' => ['auth'],
		]);

		Route::get('/oauth_authorization/youtube/callback', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@handleYoutubeCallback',
			'middleware' => ['auth'],
		]);*/

		/**
		 *   Post Route To Select Primary Provider
		 */

		/*Route::post('/oauth_authorization/primary_selection', [
			'uses' => '\Yeayurdev\Http\Controllers\OAuthController@postPrimarySelection',
			'as' => 'oauth_primarySelection',
			'middleware' => ['auth'],
		]);
*/

	/**
	 *   Sign In / Sign Out Routes
	 */

	Route::post('/', [
		'uses' => '\Yeayurdev\Http\Controllers\AuthController@postSignin',
		'as' => 'profile.signin',
		'middleware' => ['guest'],
	]);

	Route::post('/signin/redirect', [
		'uses' => '\Yeayurdev\Http\Controllers\AuthController@postRedirectSignin',
		'as' => 'profile.signin.redirect',
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
]);

	// Search for tags

	Route::get('/search/tags/{tag}', [
		'uses' => '\Yeayurdev\Http\Controllers\SearchController@getTagsResults',
		'as' => 'search.tags',
	]);

	Route::get('/search/tags/{tag}', [
		'uses' => '\Yeayurdev\Http\Controllers\SearchController@getTagsResults',
		'as' => 'search.tags',
	]);

/**
 *  User Profile
 */

Route::get('/{username}', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile',
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
		'middleware' => ['auth'],
	]);

	Route::post('/profile/edit/streamer_details', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@postEditStreamerDetails',
	'middleware' => ['auth'],
	]);

	Route::post('/profile/edit/tags/{id}', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@postEditStreamerTags',
	'as' => 'edit.tags',
	'middleware' => ['auth'],
	]);

	Route::get('/profile/tags', [
	'uses' => '\Yeayurdev\Http\Controllers\ProfileController@getStreamerTags',
	'middleware' => ['auth'],
	]);

/**
 *  Route for fan page
 */

Route::get('/fan/{displayName}', [
	'uses' => '\Yeayurdev\Http\Controllers\FanPageController@getFanPage',
	'as' => 'fan',
]);

Route::post('/create/fan_page', [
	'uses' => '\Yeayurdev\Http\Controllers\FanPageController@postCreate',
	'middleware' => ['auth'],
]);

Route::post('/fan/{id}', [
	'uses' => '\Yeayurdev\Http\Controllers\FanPageController@postFanPageContent',
	'middleware' => ['auth'],
]);

Route::get('/fan/add/{fan}', [
	'uses' => '\Yeayurdev\Http\Controllers\FanPageController@addFollowFanPage',
	'as' => 'fan.add',
	'middleware' => ['auth'],
]);

Route::get('/fan/remove/{fan}', [
	'uses' => '\Yeayurdev\Http\Controllers\FanPageController@removeFollowFanPage',
	'as' => 'fan.remove',
	'middleware' => ['auth'],
]);

Route::post('/fan/edit/tags/{id}', [
	'uses' => '\Yeayurdev\Http\Controllers\FanPageController@postEditFanTags',
	'as' => 'edit.fan.tags',
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

Route::post('/post/fan/{id}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postFanMessage',
	'as' => 'post.fan.message',
	'middleware' => ['auth'],
]);

Route::post('/post/edit/{postId}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postEditMessage',
	'as' => 'post.message.edit',
	'middleware' => ['auth'],
]);

Route::post('/post/{postId}/reply', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postReplyMessage',
	'as' => 'post.reply',
	'middleware' => ['auth'],
]);

Route::post('/post/{postId}/like', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postLike',
	'as' => 'post.like',
	'middleware' => ['auth'],
]);

Route::post('/post/{postId}/unlike', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postUnlike',
	'as' => 'post.unlike',
	'middleware' => ['auth'],
]);

Route::post('/post/{postId}/upvote', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postUpvote',
	'middleware' => ['auth'],
]);

Route::post('/post/{postId}/downvote', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postDownvote',
	'middleware' => ['auth'],
]);


/**
 *  Delete a post
 */

Route::post('/post/delete/{postid}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postDeleteMessage',
	'as' => 'post.message.delete',
	'middleware' => ['auth'],
]);

/**
 *  Report a post
 */

Route::post('/post/report/{postId}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postReportMessage',
	'middleware' => ['auth'],
]);

/**
 *  Replies
 */

Route::post('/reply/edit/{replyId}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postEditReply',
	'middleware' => ['auth'],
]);

Route::post('/reply/delete/{replyId}', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postDeleteReply',
	'middleware' => ['auth'],
]);

/**
 *  Routes for user notifications
 */

Route::post('/{username}/notifications/confirm', [
	'uses' => '\Yeayurdev\Http\Controllers\NotificationController@postConfirmNotifications',
	'middleware' => ['auth'],
]);

Route::post('/{username}/notifications/delete/{notificationId}', [
	'uses' => '\Yeayurdev\Http\Controllers\NotificationController@postDeleteNotification',
	'middleware' => ['auth'],
]);

Route::post('/notifications/delete/all', [
	'uses' => '\Yeayurdev\Http\Controllers\NotificationController@postDeleteNotificationAll',
	'middleware' => ['auth'],
]);

/**
 *   Request streamer route
 */

Route::post('/request/streamer', [
	'uses' => '\Yeayurdev\Http\Controllers\PostController@postRequestStreamer',
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



