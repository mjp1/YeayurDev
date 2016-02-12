<div class="search-results-list-wrapper">
	<div class="search-results-list-item">
		<div class="search-results-list-item-img">
			<a href="{{route('profile', ['username' => $user->username]) }}">
				@if ($user->getImagePath() === "")
					<i class="fa fa-user-secret fa-4x search-results-list-item-img-unknownimg" alt="{{ $user->username }}"></i>
				@else
					<img class="search-results-list-item-img-userimg" alt="{{ $user->getUsername() }}" src="{{ asset('images/profiles') }}/{{ $user->getImagePath() }}">
				@endif
			</a>
		</div>
		<div class="search-results-list-item-name">
			<a href="{{route('profile', ['username' => $user->username]) }}">{{ $user->getUsername() }}</a>
		</div>
		<div class="search-results-list-item-followers">
			<i class="fa fa-users" title="Number of followers"></i>
			<span class="search-results-list-item-followers-count">{{ $user->followers()->count() }}</span>
		</div>
	</div>
</div>
