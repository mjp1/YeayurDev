<nav class="navbar navbar-default navbar-fixed-bottom">
	<div class="container">
		<ul class="list-inline">
			@if (Auth::check())
				<li><a href="{{ route('support') }}">Contact</a></li>
			@else
				<li><a href="{{ route('support.public') }}" target="_blank">Contact</a></li>
			@endif
			<li><a href="{{ route('terms') }}" target="_blank">Terms of Service</a></li>
			<li><a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a></li>
		</ul>
	</div>

</nav>
