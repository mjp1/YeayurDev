@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="{{ asset('images/logo_full.png') }}" class="welcome-logo" />
		<h3 class="main-mission">Connecting Streamers and Viewers</h3>
	</div>
	<div class="main-posts-nav">
		<ul class="main-posts-nav-list">
			<li><a href="{{ route('discover.community') }}" class="main-posts-nav-tab visible">Community</a></li>
			<li><a href="{{ route('discover.connections') }}" class="main-posts-nav-tab">My Connections</a></li>
		</ul>
	</div>
	<div class="main-posts community">
		<h5 class="main-posts-header">Recent Activity</h5>
		<div class="post-grid">
			@if ($communityPosts->count())
			    @foreach ($communityPosts as $Posts)
				    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
				      <div class="thumbnail">
				        <div class="main-streamer-post-pic pic-responsive">
				          <a href="{{ route('profile', ['username' => $Posts->user->username]) }}">
				            @if ($Posts->user->getImagePath() === "")
				              <i class="fa fa-user-secret fa-3x"></i>
				            @else
				              <img src="{{ $Posts->user->getImagePath() }}" alt="{{ $Posts->user->username }}"/>
				            @endif
				          </a>
				        </div>
				        <div class="streamer-post-id">
				          <a href="{{ route('profile', ['username' => $Posts->user->username]) }}">
				            <h5 class="streamer-post-name">{{ $Posts->user->username }}</h5>
				          </a>
				          <span class="post-time">{{ $Posts->created_at->diffForHumans() }}</span>
				        </div>
				        <div class="streamer-post-message-main">
				          <div class="message-content">
				            <span>{{ $Posts->body }}</span>
				            <br>
							<img src="{{ $Posts->getImagePath() }}" class="img-responsive" />
				          </div>
				        </div>
				        <ul class="streamer-post-message-footer">
				        	<li class="streamer-followers">
								<i class="fa fa-users" title="Followers"></i>
								<span class="fan-count">{{ $Posts->user->followers()->count() }}</span>
							</li>
							<li class="streamer-post-like-count">
								<img src="{{ asset('images/logo_compact_black.png') }}" class="streamer-post-like-count-img" title="Likes" />
								<span class="like-count">{{ $Posts->likes->count() }}</span>
							</li>
						</ul>	
						@if ($Posts->user->twitch_url)
							<a href="https://www.twitch.tv/{{ $Posts->user->twitch_url }}" target="_blank" class="external-link-twitch">
								<img src="{{ asset('images/twitch_oauth_logo.png') }}" class="img-responsive" /><i class="fa fa-external-link" aria-hidden="true"></i>
							</a>
						@elseif ($Posts->user->youtube_url)
							<a href="https://www.youtube.com/watch?v={{ $Posts->user->youtube_url }}" target="_blank" class="external-link-twitch">
								<img src="{{ asset('images/youtube_oauth_logo.png') }}" class="img-responsive" /><i class="fa fa-external-link" aria-hidden="true"></i>
							</a>
						@else
						@endif																																		
				      </div>
				    </div>
			    @endforeach
			    {!! $communityPosts->render() !!}
			@endif
		</div>
	</div>
	<script>
		//===================================================
		//		TWITTER EMOJI PLUGIN
		//===================================================
		
		

		twemoji.parse(document.body, {
		    folder: 'svg',
		    ext: '.svg',
		    callback: function(icon, options, variant) {
		        switch ( icon ) {
		            case 'a9':      // © copyright
		            case 'ae':      // ® registered trademark
		            case '2122':    // ™ trademark
		                return false;
		        }
		        return ''.concat(options.base, options.size, '/', icon, options.ext);
		    }
		});
		  

	</script>


@stop