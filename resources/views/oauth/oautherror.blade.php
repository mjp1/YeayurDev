@extends('templates.default')

@section('content')
	<h1>Authorize Yeayur For Streaming</h1>

	<div class="col-sm-8 col-sm-offset-2">
		<div class="alert alert-danger oath-info-alert" role="alert">
			<h4 class="text-center">Twitch Name Already Exists</h4>
			<hr>
			<h6 class="text-center">We already have a record of your Twitch name. Make sure you haven't already registered or try logging out from Twitch first and authenticate again.</h6>
			<hr>
			<h6 class="text-center">If you believe this is an error, <a href="{{ route('registration.support') }}" target="_blank">Contact Us</a>.</h6>
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