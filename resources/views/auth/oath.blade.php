@extends('templates.default')

@section('content')
	<h1>Authorize Yeayur For Streaming</h1>

	<div class="col-sm-6 col-sm-offset-3">
		<div class="alert alert-info oath-info-alert" role="alert">
			<h5>For security purposes, please sign into at least one of the following streaming services below.</h5>
			<hr>
			<h6 class="text-center">We will only retrieve read-only information which allows Yeayur to show your stream.</h6>
		</div>
		<div class="alert alert-success oath-info-succcess">
			<h5 class="text-center">You have successfully registered Yeayur with your Twitch account!</h5>
		</div>
		<div class="oath-buttons">
			<div class="btn-twitch">
				<img src="http://ttv-api.s3.amazonaws.com/assets/connect_dark.png" class="twitch-connect" href="#" />
				<div class="twitch-status">
					<span class="twitch-status-msg">Twitch Connected!</span>
					<span class="glyphicon glyphicon-ok twitch-status-icon"></span>
				</div>
				
			</div>
			<div class="btn-youtube">

			</div>
		</div>
		<div class="gotoprofile">
			<a href="{{route('profile', ['username' => Auth::user()->username]) }}" class="btn btn-global">Go to profile</a>
		</div>
	</div>
<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>
<script src="{{ asset('js/oath/twitchoath.js') }}"></script>
<div id="oath_id" style="display:none;">{{ Auth::user()->id }}</div>
@stop