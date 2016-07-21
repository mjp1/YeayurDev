<!-- THIS PAGE WILL BE USED IF NOT LOGGED IN -->

<h4 class="owner-notice" style="text-align:center;margin-bottom:20px;">Are you {{ $fan->getDisplayName() }}? If so, <a href="{{ route('oauth_twitch') }}">Authorize with Twitch</a> to turn this into your Yeayur profile page!</h4>

<!-- STREAM WILL APPEAR AT TOP OF PAGE ON MOBILE -->

<div class="streamer-media visible-xs">
	<!-- TWITCH STREAM EMBED -->		
	<div class="stream-embed">
		<div class="embed-responsive embed-responsive-16by9">
			<iframe 
			src="https://player.twitch.tv/?channel={{ $fan->getDisplayName() }}" 
			frameborder="0" 
			scrolling="no"
			allowfullscreen="true">
			</iframe>
		</div>
	</div>
</div>		
	
<!-- MAIN STREAMER INFO AND FEED SECTION -->		

	<div class="streamer-info-main col-sm-5">
		<div class="streamer-info well">
			<div class="streamer-pic pic-responsive">
				@if (!$fan->logo_url)
				<i class="fa fa-user-secret fa-4x img-circle"></i>
				@else
				<img src="{{ $fan->getLogoUrl() }}" class="img-circle" />
				@endif
			</div>
			<div class="streamer-id">
				<h4 class="streamer-name">{{ $fan->getDisplayName() }}
				</h4>
			</div>

<!-- STREAMER FANS -->		
			<div class="streamer-conn" data-toggle="modal" data-target="#fan-followers-modal">
				<i class="fa fa-users" title="Number of followers"></i>
				<span class="fan-count">{{ $fan->followers()->count() }}</span>
			</div>
<!-- ABOUT ME SECTION -->		
			<a href="https://www.twitch.tv/{{ $fan->getDisplayName() }}" target="_blank" class="streamer-twitch-link"><img src="{{ asset('images/twitch_oauth_logo.png') }}" /><i class="fa fa-external-link" aria-hidden="true"></i></a>		
			<div class="about-me-wrapper">
				<h5 class="about-me"><strong>About Me</strong></h5>
				@if ($fan->bio)
				<h6 class="aboutme-text">{{ $fan->getBio() }}</h6>
				@else
				<h6>{{ $fan->getDisplayName() }} has no bio</h6>
				@endif
			</div>
		</div>

		<!-- STREAMER VIDEOS SECTION -->

		<ul class="videos well">
			<h5 class="videos-header"><strong>Videos</strong></h5>
			@if ($videos)
				@foreach ($videos as $video)
					<li>
						<a href="{{ $video['url'] }}" target="_blank"><img src="{{ $video['preview'] }}" class="video-img img-responsive" /></a>
						<a href="{{ $video['url'] }}" target="_blank"><h5 class="video-title">{{ $video['title'] }}</h5></a>
						<span class="video-game">{{ $video['game'] }}</span>
						<span class="video-length"><?php echo gmdate("i:s", $video['length']) ?></span>
					</li>
				@endforeach
			@else
				<h6 class="videos-none">{{ $fan->getDisplayName() }} has not recorded any videos</h6>
			@endif
		</ul>

		<!-- STREAMER TAGS SECTION -->

		<div class="streamer-tags well">
			<h5><strong>Streamer Tags</strong>
				<span class="streamer-tags-info" data-toggle="tooltip" data-placement="top" title="Add tags to describe {{ $fan->getDisplayName() }} as a streamer. Each tag is a link so you can find other streamers with the same tags."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
			</h5>
			<h6>You must be logged in to edit tags.</h6>
			@if ($tags)
				<div class="streamer-tags-item-wrapper">
					@foreach($tags as $tag)
						<a href="/search/tags/{{ $tag }}" class="streamer-tags-item">{{ $tag }}</a>
					@endforeach
				</div>
			@endif
		</div>
	</div>

	<div class="col-sm-7" style="padding:0px;">
	<div class="streamer-media hidden-xs">
	<!-- TWITCH STREAM EMBED -->		
		<div class="stream-embed">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe 
				src="https://player.twitch.tv/?channel={{ $fan->getDisplayName() }}" 
				frameborder="0" 
				scrolling="no"
				allowfullscreen="true">
				</iframe>
			</div>
		</div>
	</div>

<!-- STREAMER FEED SECTION -->		
					
		<div class="fan-page-info well">
			@if ($fan->body)
			<div class="fan-page-body-content">
				<?php echo $fan->body ?>
			</div>
			@endif
			
			<div class="streamer-content-panel streamer-feed-panel">
				<h4>{{ $fan->getDisplayName() }}'s Feedback Board
					<span class="streamer-content-info" data-toggle="tooltip" data-placement="top" title="This is the Feedback Board. Ask a question, write a review, or leave helpful suggestions and feedback so {{ $fan->getDisplayName() }} can become a better streamer."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
				</h4>
				<hr>
				<h6>Ask a question, write a review, or leave feedback to help {{ $fan->getDisplayName() }} become a better streamer</h6>
				<!-- FEED POST INPUTS SECTION -->		
				<h6>You must be logged in to give feedback.</h6>
				<!-- FEED CONTENT SECTION -->		

				@if ($posts->count())
					@foreach ($posts as $post)
						<div class="streamer-feed-post">
							<div class="streamer-post-pic pic-responsive">
								<a href="{{ route('profile', ['username' => $post->user->username]) }}">
									@if ($post->user->getImagePath() === "")
									<i class="fa fa-user-secret fa-3x"></i>
									@else
									<img src="{{ $post->user->getImagePath() }}" class="img-circle" alt="{{ $post->user->username }}"/>
									@endif
								</a>
							</div>
							<div class="streamer-post-id">
								<a href="{{ route('profile', ['username' => $post->user->username]) }}">
									<h4 class="streamer-post-name">{{ $post->user->username }}</h4>
								</a>
								<span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
							</div>
							@if (Auth::check())
								<div class="streamer-post-vote">
									<span class="vote-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
									<span class="vote-count">{{ $post->votes() }}</span>
									<span class="vote-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
								</div>
							@endif
							<div class="streamer-post-message">
								<div class="message-content">
									<span><?php echo $post->body ?></span>
								</div>
							</div>
							<div class="streamer-post-footer-public" style="height:10px;"></div>
							@foreach ($post->replies as $reply)
							<div class="feed-reply-panel">
								<a href="{{ route('profile', ['username' => $reply->user->username]) }}" class="reply-panel-user-pic pic-responsive">
									@if ($reply->user->getImagePath() === "")
										<i class="fa fa-user-secret fa-3x"></i>
									@else
										<img src="{{ $reply->user->getImagePath() }}" class="img-circle" alt="{{ $reply->user->username }}"/>
									@endif
								</a>
								<div class="reply-userid">
									<a href="{{ route('profile', ['username' => $reply->user->username]) }}">
										<h5 class="reply-user-name">{{ $reply->user->username }}</h5>
									</a>
									<span class="reply-post-time">{{ $reply->created_at->diffForHumans() }}</span>
								</div>
								<div class="reply-message">
									<span><?php echo $reply->body ?></span>
								</div>
							</div>
							@endforeach
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>

	<div class="modal" id="fan-followers-modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">{{ $fan->getDisplayName() }}'s Connections</h4>
	      </div>
	      <div class="modal-body">
			<div class="connections-modal-body">
				<!-- LIST OF FOLLOWERS PANEL -->		
				<div class="connections-followers-fan">
					<h4>Followers</h4>
					@if ($fan->followers()->count())
						<div class="streamer-list">
							<div class="streamer-list-item-wrapper">
								@foreach ($fan->followers as $following)
								<div class="streamer-list-item">
									<div class="streamer-list-item-img">
										@if ($following->getImagePath() === "")
										<i class="fa fa-user-secret fa-4x"></i>
										@else
										<img src="{{ $following->getImagePath() }}" alt="{{ $following->username }}"/>
										@endif
									</div>
									<div class="streamer-list-item-name"><a href="{{route('profile', ['username' => $following->username]) }}">{{ $following->getUsername() }}</a></div>
								</div>
								@endforeach
							</div>
						</div>
					@else
						<h5>{{ $fan->getDisplayName() }} has no followers</h5>
					@endif
				</div>

			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-global" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

		<script>
			$('#flash-overlay-modal').modal();
		</script>

  
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
