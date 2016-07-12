@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Where the Streamer Meets the Viewer</h3>
	</div>

	<div class="main-content">
		<div class="main-new-users col-sm-12 row">
			<h4 class="section-title new-users row">NEW PROFILES</h4>
			<a href="{{ route('index.profiles') }}" class="view-more row"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			@if ($newUsers)
				@foreach ($newUsers as $user)
					<div class="new-users-item-wrapper col-sm-3 col-xs-6">
						<div class="new-users-item">
							<a href="{{ route('profile', ['username' => $user->username]) }}">
								@if (!$user->image_path)
									<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
								@else
									<img src="{{ $user->image_path }}" class="new-user-item-img img-responsive" />
								@endif
							</a>
							<a href="{{ route('profile', ['username' => $user->username]) }}"><span class="new-user-username" title="{{ $user->username }}">{{ $user->username }}</span></a>
							<div class="item-details">
								<span class="new-user-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $user->followers()->count() }}</span>
								<span class="new-user-views" title="Profile Views"><i class="fa fa-eye" aria-hidden="true"></i>{{ $user->myProfileViews() }}</span>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>

		<div class="main-new-fans col-sm-12 row">
			<h4 class="section-title top-contributors row">NEW FAN PAGES</h4>
			<a href="{{ route('index.fanpages') }}" class="view-more row"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			@if ($newFans)
				@foreach ($newFans as $fan)
					<div class="new-users-item-wrapper col-sm-3 col-xs-6">
						<div class="new-users-item">
							<a href="{{ route('fan', ['displayName' => $fan->display_name]) }}">
								@if (!$fan->logo_url)
									<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
								@else
									<img src="{{ $fan->logo_url }}" class="new-user-item-img img-responsive" />
								@endif
							</a>
							<a href="{{ route('fan', ['displayName' => $fan->display_name]) }}"><span class="new-user-username" title="{{ $fan->display_name }}">{{ $fan->display_name }}</span></a>
							<div class="item-details">
								<span class="new-user-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $fan->followers()->count() }}</span>
								<span class="new-user-views" title="Profile Views"><i class="fa fa-eye" aria-hidden="true"></i>{{ $fan->myProfileViews() }}</span>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>

		<div class="main-top-contributors col-sm-12 row">
			<h4 class="section-title top-contributors row">TOP CONTRIBUTORS</h4>
			<a href="{{ route('index.topcontributors') }}" class="view-more row"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			@if ($topContributors)
				@foreach ($topContributors as $contributor)
					<div class="new-users-item-wrapper col-sm-3 col-xs-6">
						<div class="new-users-item">
							<a href="{{ route('profile', ['username' => $contributor->username]) }}">
								@if (!$contributor->image_path)
									<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
								@else
									<img src="{{ $contributor->image_path }}" class="new-user-item-img img-responsive" />
								@endif
							</a>
							<a href="{{ route('profile', ['username' => $contributor->username]) }}"><span class="new-user-username" title="{{ $contributor->username }}">{{ $contributor->username }} <span title="Reputation Points">({{$contributor->user_points }})</span></span></a>
							<div class="item-details">
								<span class="new-user-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $contributor->followers()->count() }}</span>
								<span class="new-user-views" title="Profile Views"><i class="fa fa-eye" aria-hidden="true"></i>{{ $contributor->myProfileViews() }}</span>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>	
		
		<div class="main-recent-posts col-sm-12 row">
			<h4 class="section-title recent-posts row">RECENT POSTS</h4>
			<a href="{{ route('index.recentposts') }}" class="view-more row"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			<div class="recent-post-item-wrapper row">
				@if ($posts)
					@foreach ($posts as $post)
						<div class="recent-post-item">
							<div class="post-streamer-img-wrapper img-responsive">
								<a href="{{ route('profile', ['username' => $post->user->username]) }}">
									@if ($post->user->getImagePath() === "")
										<i class="fa fa-user-secret fa-4x post-streamer-img"></i>
									@else
										<img src="{{ $post->user->getImagePath() }}" class="post-streamer-img" alt="{{ $post->user->username }}" />
									@endif
								</a>
							</div>
							<a href="{{ route('profile', ['username' => $post->user->username]) }}" class="post-streamer-username"><h4>{{ $post->user->username }}</h4></a>
							<span class="recent-post-time">{{ $post->created_at->diffForHumans() }}</span>
							<span class="recent-post-user-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $post->user->followers()->count() }}</span>
							<div class="post-vote-count">Votes: {{ $post->votes() }}</div>
							<div class="post-body-wrapper">
								@if ($post->fan)
									<h5 class="post-details">Leaving post for <a href="{{ route('fan', ['displayName' => $post->fan->display_name]) }}">{{ $post->fan->display_name }}</a> (Fan Page)</h5>
								@else
									<h5 class="post-details">Leaving post for <a href="{{ route('profile', ['username' => $post->user->username]) }}">{{ $post->profile->username }}</a></h5>
								@endif
								<span class="post-body">{{ $post->body }}</span>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>			
	</div>

@stop