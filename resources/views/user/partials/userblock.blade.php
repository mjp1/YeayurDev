<div class="media">
	<a class="pull-left" href="{{route('profile', ['username' => $user->username]) }}">
		<img class="media-object" alt="{{ $user->getUsername() }}" src="">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="{{route('profile', ['username' => $user->username]) }}">{{ $user->getUsername() }}</a></h4>
	</div>
</div>