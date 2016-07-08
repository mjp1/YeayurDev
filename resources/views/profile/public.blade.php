<!-- THIS IS THE PROFILE VIEW FOR A VISITOR THAT IS NOT LOGGED IN -->

<!-- Show signed up alert for new users -->
@include('templates.partials.alerts')
@include ('flash::message')

<!-- STREAM WILL APPEAR AT TOP OF PAGE ON MOBILE -->

<div class="streamer-media visible-xs">
	<!-- TWITCH STREAM EMBED -->		
	<div class="stream-embed">
		<div class="embed-responsive embed-responsive-16by9">
			<iframe 
			src="https://player.twitch.tv/?channel={{ $user->getTwitchChannel() }}" 
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
			@if ($user->getImagePath() === "")
			<i class="fa fa-user-secret fa-4x img-circle"></i>
			@else
			<img src="{{ $user->getImagePath() }}" class="img-circle" />
			@endif
		</div>
		<div class="streamer-id">
			<h4 class="streamer-name">{{ $user->getUsername() }}
			</h4>
		</div>

		<!-- STREAMER FANS -->		
		<div class="streamer-conn" data-toggle="modal" data-target="#streamer-connections-modal">
			<i class="fa fa-users" title="Number of followers"></i>
			<span class="fan-count">{{ $user->followers()->count() }}</span>
		</div>
		<!-- ABOUT ME SECTION -->		

		<div class="about-me-wrapper">
			<h5 class="about-me"><strong>About Me</strong></h5>
			@if ($user->about_me)
				<h6 class="aboutme-text">{{ $user->about_me }}</h6>
			@else
				<h6>{{ $user->username }} has not provided a bio</h6>
			@endif
		</div>
	</div>

	<!-- STREAMER TOP VISITS SECTION -->

	@if ($user->profileVisits->count())
	<div class="streamer-top-visits well">
		<h5 class="streamer-top-visits-header"><strong>Top Profile Visits:</strong></h5>
		<div class="streamer-top-visits">
			@foreach ($user->profileVisits as $topVisits)
			<div class="streamer-top-visits-box row">
				<div class="streamer-top-visits-box-img">
					@if ($topVisits->getImagePath() === "")
					<a href="{{route('profile', ['username' => $topVisits->username]) }}"><i class="fa fa-user-secret fa-2x" alt="{{ $topVisits->username }}"></i></a>
					@else
					<a href="{{route('profile', ['username' => $topVisits->username]) }}"><img src="{{ $topVisits->getImagePath() }}" class="img-circle" alt="{{ $topVisits->username }}"/></a>
					@endif
				</div>
				<a href="{{route('profile', ['username' => $topVisits->username]) }}" class="streamer-top-visits-box-a">{{ $topVisits->username }}</a>
			</div>
			@endforeach
		</div>
	</div>
	@endif

	<!-- STREAMER DETAILS SECTION -->

	<div class="streamer-about-panel well">
		<h5><strong>What I Stream</strong></h5>
		<div class="streamer-details-content">
			<?php echo $user->streamer_details ?>
		</div>
		@if (!$user->streamer_details)
			<h6>{{ $user->username }} has not entered any details here</h6>
		@endif
	</div>

	<!-- STREAMER VIDEOS SECTION -->

	<ul class="videos well">
		<h5 class="videos-header"><strong>Videos</strong></h5>
		@if ($videos)
			@foreach ($videos as $video)
				<li>
					<img src="{{ $video['preview'] }}" class="video-img img-responsive" />
					<a href="{{ $video['url'] }}" target="_blank"><h5 class="video-title">{{ $video['title'] }}</h5></a>
					<span class="video-game">{{ $video['game'] }}</span>
					<span class="video-length"><?php echo gmdate("i:s", $video['length']) ?></span>
				</li>
			@endforeach
		@else
			<h6 class="videos-none">{{ $user->username }} has not recorded any videos</h6>
		@endif
	</ul>

	<!-- STREAMER TAGS SECTION -->

	<div class="streamer-tags well">
		<h5><strong>Streamer Tags</strong>
			<span class="streamer-tags-info" data-toggle="tooltip" data-placement="top" title="Add tags to describe {{ $user->username }} as a streamer. Each tag is a link so you can find other streamers with the same tags. {{ $user->username }} cannot edit these tags."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
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

<div class="streamer-media col-sm-7 hidden-xs">
	<!-- TWITCH STREAM EMBED -->		
	<div class="stream-embed">
		<div class="embed-responsive embed-responsive-16by9">
			<iframe 
			src="https://player.twitch.tv/?channel={{ $user->getTwitchChannel() }}" 
			frameborder="0" 
			scrolling="no"
			allowfullscreen="true">
			</iframe>
		</div>
	</div>
</div>

<!-- STREAMER FEED SECTION -->		

<div class="streamer-feed col-sm-7 well">

	<!-- STREAMER FEED CONTENT PANEL -->		

	<div class="streamer-content-panel streamer-feed-panel">
		<h4>{{ $user->username }}'s Feedback Board
			<span class="streamer-content-info" data-toggle="tooltip" data-placement="top" title="This is the Feedback Board. {{ $user->username }} cannot post here, only visitors. Ask a question or leave helpful suggestions and feedback so {{ $user->username }} can become a better streamer."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
		</h4>
		<hr>
		<h6>Ask a question or leave feedback to help {{ $user->username }} become a better streamer</h6>
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
					
					<div class="streamer-post-vote">
						You must be logged in to vote on posts
					</div>
					
					<div class="streamer-post-message">
						<div class="message-content">
							<span>{{ $post->body }}</span>
							<br>
							<img src="{{ $post->getImagePath() }}" class="img-responsive message-img" />
						</div>
					</div>
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
							<span>{{ $reply->body }}</span>
						</div>
					</div>
					@endforeach
				</div>
			@endforeach
		@endif
	</div>

	<div class="modal" id="streamer-connections-modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">{{ $user->username }}'s Connections</h4>
	      </div>
	      <div class="modal-body">
			<ul class="connections-modal-nav">
				<li class="connections-modal-nav-following">Following ({{ $user->following()->count() }})</li>
				<li class="connections-modal-nav-followers">Followers ({{ $user->followers()->count() }})</li>
			</ul>
	        <!-- LIST OF FOLLOWING PANEL -->		
			<div class="connections-modal-body">
				<div class="connections-following">
					<h4>Following</h4>
					<div class="streamer-list">
						@if ($user->following->count())
							<div class="streamer-list-item-wrapper">
								@foreach ($user->following as $follower)
								<div class="streamer-list-item">
									<div class="streamer-list-item-img">
										@if ($follower->getImagePath() === "")
										<i class="fa fa-user-secret fa-4x"></i>
										@else
										<img src="{{ $follower->getImagePath() }}" alt="{{ $follower->username }}"/>
										@endif
									</div>
									<div class="streamer-list-item-name"><a href="{{route('profile', ['username' => $follower->username]) }}">{{ $follower->getUsername() }}</a></div>
								</div>
								@endforeach
							</div>	
						@else
							<h5>{{ $user->username }} is not following anyone</h5>
						@endif
					</div>
				</div>

				<!-- LIST OF FOLLOWERS PANEL -->		
				<div class="connections-followers">
					<h4>Followers</h4>
					@if ($user->followers->count())
						<div class="streamer-list">
							<div class="streamer-list-item-wrapper">
								@foreach ($user->followers as $following)
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
						<h5>{{ $user->username }} has no followers</h5>
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




</div>
</div>

<script>
$('#flash-overlay-modal').modal();
</script>

<!-- Markup for UserHasPostedMessage Event to display post when new post is submitted on this profile -->

<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
<script src="//cdn.jsdelivr.net/angular.pusher/latest/pusher-angular.min.js"></script>
<script src="{{ asset('js/sweet-alert.min.js') }}"></script>
<script>
$('#postbody').val();
</script>	    

