@extends('templates.default')

@section('content')
	<h1>Authorize Yeayur For Streaming</h1>

	<div class="col-sm-6 col-sm-offset-3">
		<div class="alert alert-info oath-info-alert" role="alert">
			<h5 class="text-center">For security purposes, please sign into your Twitch account below.</h5>
			<hr>
			<h6 class="text-center">We will only retrieve read-only information which allows Yeayur to show your stream.</h6>
		</div>
		<div class="oauth-buttons">
			<div class="oauth-buttons-item btn-twitch">
				<img src="http://ttv-api.s3.amazonaws.com/assets/connect_dark.png" class="twitch-connect" href="#" />
				<div class="twitch-status">
					<span class="twitch-status-msg">Twitch Connected!</span>
					<span class="glyphicon glyphicon-ok twitch-status-icon"></span>
				</div>
			</div>

			<!-- For simplicity purposes, we are only including Twitch at the moment. Will implement Youtube later. -->

			<!-- <div class="oauth-buttons-item btn-youtube">
				<a href="#"><img src="{{ asset('images/youtubeoauthbutton.jpg') }}"/></a>
			</div> -->
		</div>
		<div class="gotoprofile">
			<a href="{{route('profile', ['username' => Auth::user()->username]) }}" class="btn btn-global">Go to profile</a>
		</div>
	</div>
<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>
<script src="{{ asset('js/oath/twitchoath.js') }}"></script>
<div id="oath_id" style="display:none;">{{ Auth::user()->id }}</div>
@stop