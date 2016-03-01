@extends('templates.default')

@section('content')

	<div class="col-sm-4 col-sm-offset-4">

		@if (Auth::user()->getTwitchUsername())
			<div class="service-confirm">
				<div class="service-confirm-brand-img row">
					<img src="{{ asset('images/twitch_oauth_logo.png') }}" class="img-responsive">
				</div>
				<hr>
				<div class="service-confirm-content row">
					<div class="service-confirm-name">
						<h4 class="service-confirm-username-msg text-center">Connected as <h3>{{ Auth::user()->getTwitchUsername() }} </h3><span class="service-confirm-username-error">not you?</span></h4>
					</div>
				</div>
				<hr>
			</div>		
			<div class="gotoprofile">
				<a href="{{route('profile', ['username' => Auth::user()->getTwitchUsername()]) }}" class="btn btn-global">Go To Profile</a>
			</div>
		@endif

	</div>

<div id="oath_id" style="display:none;">{{ Auth::user()->id }}</div>

<script src="{{ asset('js/oauth/oauth.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
@stop	