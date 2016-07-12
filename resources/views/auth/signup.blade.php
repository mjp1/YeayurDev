@extends('templates.default')

@section('content')
	<h1>Register For Yeayur</h1>
	<div class="alert alert-warning text-center col-sm-8 col-sm-offset-2" role="alert">
		We are currently still testing the website. Please feel free to <a href="{{ route('support.public') }}" target="_blank">contact us</a> with any issues or comments you have.
		<hr>
		<h5>You are registering for Yeayur. We use your basic information provided by Twitch to set up your profile. By registering, you accept our <a href="{{ route('terms') }}" target="_blank">Terms of Service</a>.</h5>
	</div>
	<h3 class="col-sm-8 col-sm-offset-2 text-center">You are registering as</h3>
	<h4 class="col-sm-8 col-sm-offset-2 text-center">{{ Session::get('twitchUsername') }}</h4>
	<div class="alert alert-warning text-center col-sm-8 col-sm-offset-2">If this is incorrect, sign out of Twitch and <a href="{{ route('index') }}">click here</a>.</div>
	<a href="{{ route('oauth_twitch.register') }}" class="btn btn-default twitch-oauth col-sm-8 col-sm-offset-2"><img src="{{ asset('images/twitch_logo_small.png') }}" /> Register with Twitch</a>
	
@stop