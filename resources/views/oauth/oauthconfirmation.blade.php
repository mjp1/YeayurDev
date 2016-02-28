@extends('templates.default')

@section('content')

	<div class="col-sm-4 col-sm-offset-4">

		@if (Auth::user()->getTwitchUsername())
			<div class="service-confirm">
				<img src="{{ asset('images/twitch_oauth_logo.png') }}" class="img-responsive">
				<h5>Twitch Connected</h5>
				<p>{{ Auth::user()->getTwitchUsername() }}</p>
				<span>Not you?</span>
			</div>
			<div class="gotoprofile">
				<a href="{{route('profile', ['username' => Auth::user()->getTwitchUsername()]) }}" class="btn btn-global">Go To Profile</a>
			</div>
		@endif

		@if (Auth::user()->getYoutubeUsername())
			<div class="service-confirm">
				<img src="{{ asset('images/youtube_oauth_logo.png') }}" class="img-responsive">
				<h5>YouTube Connected</h5>
				<p>{{ Auth::user()->getYoutubeUsername() }}</p>
				<span>Not you?</span>
			</div>
			<div class="gotoprofile">
				<a href="{{route('profile', ['username' => Auth::user()->getYoutubeUsername()]) }}" class="btn btn-global">Go To Profile</a>
			</div>		
		@endif

	</div>

<div id="oath_id" style="display:none;">{{ Auth::user()->id }}</div>

<script src="{{ asset('js/oauth/oauth.js') }}"></script>
@stop	