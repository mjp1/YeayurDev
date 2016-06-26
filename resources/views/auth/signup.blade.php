@extends('templates.default')

@section('content')
	<h1>Register For Yeayur</h1>
	<div class="alert alert-warning text-center col-sm-8 col-sm-offset-2" role="alert">
		We are currently still testing the website. Please feel free to <a href="{{ route('support.public') }}" target="_blank">contact us</a> with any issues or comments you have.
	</div>
	<a href="{{ route('oauth_twitch') }}" class="btn btn-default twitch-oauth col-sm-8 col-sm-offset-2"><img src="{{ asset('images/twitch_logo_small.png') }}" />Register with Twitch</a>
	

@include ('auth.signinmodal')

@stop