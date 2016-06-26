@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Connecting Streamers and Viewers</h3>
	</div>
	<div class="main-posts-public">
		<h5 class="main-posts-header">Recent Activity</h5>
		<div class="post-grid">
			@if ($posts->count())
			    @foreach ($posts as $post)
				    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
				      <div class="thumbnail">
				        <div class="main-streamer-post-pic pic-responsive">
				          <a href="{{ route('profile', ['username' => $post->user->username]) }}">
				            @if ($post->user->getImagePath() === "")
				              <i class="fa fa-user-secret fa-3x"></i>
				            @else
				              <img src="{{ $post->user->getImagePath() }}" alt="{{ $post->user->username }}"/>
				            @endif
				          </a>
				        </div>
				        <div class="streamer-post-id">
				          <a href="{{ route('profile', ['username' => $post->user->username]) }}">
				            <h5 class="streamer-post-name">{{ $post->user->username }}</h5>
				          </a>
				          <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
				        </div>
				        <div class="streamer-post-message-main">
				          <div class="message-content">
				            <span>{{ $post->body }}</span>
				            <br>
							<img src="{{ $post->getImagePath() }}" class="img-responsive" />
				          </div>
				        </div>
				        <ul class="streamer-post-message-footer">
				        	<li class="streamer-followers">
								<i class="fa fa-users" title="Followers"></i>
								<span class="fan-count">{{ $post->user->followers()->count() }}</span>
							</li>
							<li class="streamer-post-like-count">
								<img src="{{ asset('images/logo_compact_black.png') }}" class="streamer-post-like-count-img" title="Likes" />
								<span class="like-count">{{ $post->likes->count() }}</span>
							</li>
						</ul>
						@if ($post->user->twitch_url)
							<a href="https://www.twitch.tv/{{ $post->user->twitch_url }}" target="_blank" class="external-link-twitch">
								<img src="{{ asset('images/twitch_oauth_logo.png') }}" class="img-responsive" /><i class="fa fa-external-link" aria-hidden="true"></i>
							</a>
						@elseif ($post->user->youtube_url)
							<a href="https://www.youtube.com/watch?v={{ $post->user->youtube_url }}" target="_blank" class="external-link-twitch">
								<img src="{{ asset('images/youtube_oauth_logo.png') }}" class="img-responsive" /><i class="fa fa-external-link" aria-hidden="true"></i>
							</a>
						@else
						@endif
				      </div>
				    </div>
			    @endforeach
			@endif
		</div>
	</div>

@include ('auth.signinmodal')

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