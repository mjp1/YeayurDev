@extends('templates.default')

@section('content')
	<h1>Authorize Yeayur For Streaming</h1>

	<div class="col-sm-6 col-sm-offset-3">
		<div class="alert alert-info oath-info-alert" role="alert">
			<h5>To connect your stream to your Yeayur profile, please sign in with one of the streaming services below.</h5>
			<hr>
			<h6>We will only retrieve read-only information which allows Yeayur to show your stream.</h6>
		</div>
		<div class="alert alert-success oath-info-succcess">
			<h5>You have successfully registered Yeayur with your Twitch account!</h5>
		</div>
		<div class="oath-buttons">
			<div class="btn-twitch">
				<img src="http://ttv-api.s3.amazonaws.com/assets/connect_dark.png" class="twitch-connect" href="#" />
			</div>
			<div class="btn-youtube">

			</div>
		</div>
		<div class="gotoprofile">
			<a href="{{route('profile', ['username' => Auth::user()->username]) }}" class="btn btn-global oath-btn">Go to profile</a>
		</div>
	</div>
<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>
<script src="{{ asset('js/oath/twitchoath.js') }}"></script>
@stop