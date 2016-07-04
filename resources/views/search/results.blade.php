@extends('templates.default')

@section('content')
	<h3>Your search for "{{ Request::input('query') }}"</h3>
	@if (!$users->count() && !$fans->count())
		<p>No results found.</p>
	@endif
	@if ($users->count())
		<h4>Profiles</h4>
		<div class="search-results-list">	
			@foreach ($users as $user)
				<div class="search-results-list-wrapper">
					<div class="search-results-list-item">
						<div class="search-results-list-item-img">
							<a href="{{route('profile', ['username' => $user->username]) }}">
								@if ($user->getImagePath() === "")
									<i class="fa fa-user-secret fa-4x search-results-list-item-img-unknownimg" alt="{{ $user->username }}"></i>
								@else
									<img class="search-results-list-item-img-userimg" alt="{{ $user->getUsername() }}" src="{{ $user->getImagePath() }}">
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
			@endforeach
		</div>
	@endif
	@if ($fans->count())
		<h4>Fan Pages</h4>
		<div class="search-results-list">	
			@foreach ($fans as $fan)
				<div class="search-results-list-wrapper">
					<div class="search-results-list-item">
						<div class="search-results-list-item-img">
							<a href="{{ route('fan', ['displayName' => $fan->display_name]) }}">
								@if ($fan->logo_url === "")
									<i class="fa fa-user-secret fa-4x search-results-list-item-img-unknownimg" alt="{{ $fan->display_name }}"></i>
								@else
									<img class="search-results-list-item-img-userimg" alt="{{ $fan->display_name }}" src="{{ $fan->logo_url }}">
								@endif
							</a>
						</div>
						<div class="search-results-list-item-name">
							<a href="{{ route('fan', ['displayName' => $fan->display_name]) }}">{{ $fan->display_name }}</a>
						</div>
						<div class="search-results-list-item-followers">
							<i class="fa fa-users" title="Number of followers"></i>
							<span class="search-results-list-item-followers-count">{{ $fan->followers()->count() }}</span>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	@endif
@stop