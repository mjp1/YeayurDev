@extends('templates.default')

@section('content')
	<h1>Authorize Yeayur For Streaming</h1>

	<div class="col-sm-8 col-sm-offset-2">
		<div class="alert alert-info oath-info-alert" role="alert">
			<h5 class="text-center">For security purposes, please sign in below.</h5>
			<hr>
			<h6 class="text-center">We will only retrieve read-only information which allows Yeayur to show your stream.</h6>
		</div>
		<hr>
		<div class="oauth-buttons">
			<a href="{{ route('oauth_twitch') }}"><img src="http://ttv-api.s3.amazonaws.com/assets/connect_dark.png"/></a>
		</div>
		
<!-- 		<div class="oauth-buttons">
			<a href="{{ route('oauth_youtube') }}"><img src="{{ asset('images/youtubeoauthbutton.jpg') }}"/></a>
		</div> -->
			

	</div>
@stop	