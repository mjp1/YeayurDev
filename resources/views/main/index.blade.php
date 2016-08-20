@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Where the Streamer Meets the Viewer</h3>
	</div>

	<div class="main-content">
		<div class="main-new-users">
			<div class="header-row">
				<h4 class="section-title new-users">NEW PROFILES</h4>
				<a href="{{ route('index.profiles') }}" class="view-more"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			</div>
			<div class="owl-carousel">
			@if ($newUsers)
			@foreach ($newUsers as $user)
				<div class="new-users-item">
					@if (!$user->image_path)
						<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
					@else
						<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					@endif
					<div class="item-details-top">
						<h4 class="item-details-top-username">{{ $user->username }}</h4>
						<h5 class="new-users-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $user->followers()->count() }}</h5>
					</div>
					<div class="item-details-bottom">
						<h4><a href="{{ route('profile', ['username' => $user->username]) }}" class="bottom-profile">Profile</a></h4>
						<h4><a href="https://www.twitch.tv/{{ $user->username }}" target="_blank" class="bottom-twitch">Twitch <i class="fa fa-external-link" aria-hidden="true"></i></a></h4>
					</div>
					<div class="item-overlay"></div>
				</div>
			@endforeach
			@endif
			</div>
		</div>

		<div class="main-new-fans">
			<div class="header-row">
				<h4 class="section-title top-contributors">NEW FAN PAGES</h4>
				<a href="{{ route('index.fanpages') }}" class="view-more"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			</div>
			<div class="owl-carousel">
			@if ($newFans)
			@foreach ($newFans as $fan)
			<div class="new-users-item">
				@if (!$fan->logo_url)
					<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
				@else
					<img src="{{ $fan->logo_url }}" class="new-user-item-img img-responsive" />
				@endif
				<div class="item-details-top">
					<h4 class="item-details-top-username">{{ $fan->display_name }}</h4>
					<h5 class="new-users-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $fan->followers()->count() }}</h5>
				</div>
				<div class="item-details-bottom">
					<h4><a href="{{ route('fan', ['displayName' => $fan->display_name]) }}" class="bottom-profile">Fan Page</a></h4>
					<h4><a href="https://www.twitch.tv/{{ $fan->display_name }}" target="_blank" class="bottom-twitch">Twitch <i class="fa fa-external-link" aria-hidden="true"></i></a></h4>
				</div>
				<div class="item-overlay"></div>
			</div>
			@endforeach
			@endif
			</div>
		</div>

		<div class="main-top-contributors">
			<div class="header-row">
				<h4 class="section-title top-contributors">TOP CONTRIBUTORS</h4>
				<a href="{{ route('index.topcontributors') }}" class="view-more"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			</div>
			<div class="owl-carousel">
			@if ($topContributors)
			@foreach ($topContributors as $contributor)
				<div class="new-users-item">
					@if (!$contributor->image_path)
						<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
					@else
						<img src="{{ $contributor->getImagePath() }}" class="new-user-item-img img-responsive" />
					@endif
					<div class="item-details-top">
						<h4 class="item-details-top-username">{{ $contributor->username }} ({{$contributor->user_points }})</h4>
						<h5 class="new-users-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $contributor->followers()->count() }}</h5>
					</div>
					<div class="item-details-bottom">
						<h4><a href="{{ route('profile', ['username' => $contributor->username]) }}" class="bottom-profile">Profile</a></h4>
						<h4><a href="https://www.twitch.tv/{{ $contributor->username }}" target="_blank" class="bottom-twitch">Twitch <i class="fa fa-external-link" aria-hidden="true"></i></a></h4>
					</div>
					<div class="item-overlay"></div>
				</div>
			@endforeach
			@endif
			</div>
		</div>

		<div class="main-recent-posts">
			<div class="header-row">
				<h4 class="section-title recent-posts">RECENT POSTS</h4>
				<a href="{{ route('index.recentposts') }}" class="view-more"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			</div>
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
									<h5 class="post-details">Leaving post for <a href="{{ route('profile', ['username' => $post->profile->username]) }}">{{ $post->profile->username }}</a></h5>
								@endif
								<span class="post-body"><?php echo $post->body ?></span>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>

	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script>
	$(document).ready(function() {
		$('.owl-carousel').owlCarousel({
			items : 6, //10 items above 1000px browser width
			itemsDesktop : [1000,5], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,4], // betweem 900px and 601px
			itemsTablet: [600,2], //2 items between 600 and 0
			itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
		});
	});
</script>
@stop