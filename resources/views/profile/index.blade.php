@extends('templates.default')

@section('content')

<!-- Show signed up alert for new users -->
@include('templates.partials.alerts')
@include ('flash::message')
@include ('profile.modals.profilemodals')

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
			@if ($user->id === Auth::user()->id)
			<span class="edit-info edit-info-pic"><i class="fa fa-pencil"></i></span>
			@endif
			@if ($user->getImagePath() === "")
			<i class="fa fa-user-secret fa-4x img-circle"></i>
			@else
			<img src="{{ $user->getImagePath() }}" class="img-circle" />
			@endif
		</div>
		<div class="streamer-id">
			<h4 class="streamer-name">{{ $user->getUsername() }}
				@if (Auth::user()->id === $user->id)
				@elseif (Auth::user()->isFollowing($user))
				<a href="{{ route('profile.remove', ['username' => $user->username]) }}" class="btn btn-default btn-remove" title="Unfollow"><span class="glyphicon glyphicon-minus"></span></a>
				@else
				<a href="{{ route('profile.add', ['username' => $user->username]) }}" class="btn btn-default btn-add" title="Follow"><span class="glyphicon glyphicon-plus"></span></a>
				@endif
			</h4>
		</div>

		<!-- STREAMER FANS -->		
		<div class="streamer-conn">
			<i class="fa fa-users" title="Number of followers"></i>
			<span class="fan-count">{{ $user->followers()->count() }}</span>
		</div>
		<!-- ABOUT ME SECTION -->		

		<div class="about-me-wrapper">
			<h5 class="about-me"><strong>About Me</strong></h5>
			@if ($user->about_me)
				<h6 class="aboutme-text">{{ $user->about_me }}</h6>
				@if ($user->id === Auth::user()->id)
					<span class="edit-info edit-info-about"><i class="fa fa-pencil"></i></span>
					<form role="form" method="post" action="/profile/edit/about" id="streamer-about-me-form">
						<textarea class="form-control input-global" id="streamer-about-me-input" name="streamer-about-me-input" rows="2" placeholder="Add a short bio"></textarea>
						@if ($errors->has('streamer-about-me-input'))
							<span class="help-block">{{ $errors->first('streamer-about-me-input') }}</span>
						@endif
						<button class="btn btn-default streamer-about-me-input-cancel">Cancel</button>
						<button type="submit" class="btn btn-global">Save</button>
						<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
					</form>
				@endif
			@elseif (!$user->about_me && Auth::user()->id === $user->id)
				<button class="btn btn-global btn-add-bio">Add Bio</button>
				<form role="form" method="post" action="/profile/edit/about" id="streamer-about-me-form">
					<textarea class="form-control input-global" id="streamer-about-me-input" name="streamer-about-me-input" rows="2" placeholder="Add a short bio"></textarea>
					@if ($errors->has('streamer-about-me-input'))
						<span class="help-block">{{ $errors->first('streamer-about-me-input') }}</span>
					@endif
					<button class="btn btn-default streamer-about-me-input-cancel">Cancel</button>
					<button type="submit" class="btn btn-global">Save</button>
					<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				</form>
			@elseif (!$user->about_me && Auth::user()->id !== $user->id)
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
		@if (!$user->streamer_details && Auth::user()->id === $user->id)
			<button class="btn btn-global add-streamer-details">Add Stream Details</button>
			<form role="form" method="post" action="/profile/edit/streamer_details" id="streamer-details-form">
				<textarea class="form-control input-global" id="streamer-details-input" name="streamer-details-input" rows="2"></textarea>
				@if ($errors->has('streamer-details-input'))
					<span class="help-block">{{ $errors->first('streamer-details-input') }}</span>
				@endif
				<button class="btn btn-default streamer-details-input-cancel">Cancel</button>
				<button type="submit" class="btn btn-global">Save</button>
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			</form>
		@elseif (Auth::user()->id === $user->id)
			<span class="streamer-details-edit"><i class="fa fa-pencil" aria-hidden="true"></i></span>
			<form role="form" method="post" action="/profile/edit/streamer_details" id="streamer-details-form">
				<textarea class="form-control input-global" id="streamer-details-input" name="streamer-details-input" rows="2"></textarea>
				@if ($errors->has('streamer-details-input'))
					<span class="help-block">{{ $errors->first('streamer-details-input') }}</span>
				@endif
				<button class="btn btn-default streamer-details-input-cancel">Cancel</button>
				<button type="submit" class="btn btn-global">Save</button>
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			</form>
		@else
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
		<h5><strong>Streamer Tags</strong></h5>
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
		<h4>{{ $user->username }}'s Feedback Board</h4>
		<hr>
		@if (Auth::user()->id !== $user->id)
		<h5>Leave feedback to help {{ $user->username }} become a better streamer</h5>
		<!-- FEED POST INPUTS SECTION -->		
			<form role="form" action="#" id="postForm">
				<div class="feed-post form-group">
					<span class="feedback-notice">Feedback should be constructive and helpful.</span>
					<textarea class="form-control input-global" rows="2" id="postbody" name="post"></textarea>
					<button type="submit" class="btn btn-global post-feedback" title="Post your message">Post</button>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			</form>
		@endif

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
							<span>{{ $post->body }}</span>
							<br>
							<img src="{{ $post->getImagePath() }}" class="img-responsive message-img" />
						</div>
					</div>
					<div class="streamer-post-footer">
						<h6 class="post-reply-button">Reply</h6>
						<div class="post-id hidden">{{ $post->id }}</div>
					</div>
					<div class="streamer-post-reply-input">
						<form role="form" method="post" id="replyForm" action="{{ route('post.reply', ['postId' => $post->id ]) }}">
							<div class="form-group">
								<textarea class="form-control input-global" rows="2" id="replybody" name="reply-{{ $post->id }}" placeholder="Reply to this post"></textarea>
								<button type="submit" class="btn btn-global post-feedback-reply">Reply</button>
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						</form>
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
		@else
			@if (Auth::user()->id === $user->id)
				<h6>You have not yet received any feedback.</h6>
			@endif
		@endif
	</div>

<!-- LIST OF FOLLOWING PANEL -->		
<div class="streamer-connections-panel streamer-content-panel">
	<div class="connections-following col-sm-6">
		<h4>Following</h4>
		<div class="streamer-list">
			<div class="streamer-list-item-wrapper">
				@if (!$user->following->count() && Auth::user()->id === $user->id)
				<h5>You are not following anyone.</h5>
				@elseif (!$user->following->count())
				<h5>{{ $user->username }} is not following anyone.</h5>
				@else
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
					@if (Auth::user()->id === $user->id)
					<div class="dropdown navbar-right streamer-list-item-options">
						<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
						<ul class="dropdown-menu streamer-list-item-options-menu">
						</li><a href="{{ route('profile.remove', ['username' => $follower->username]) }}">Remove</a></li>
					</ul>
				</div>
				@else
				@endif
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>

<!-- LIST OF FOLLOWERS PANEL -->		

<div class="connections-followers col-sm-6">
	<h4>Followers</h4>
	<div class="streamer-list">
		<div class="streamer-list-item-wrapper">
			@if (!$user->followers->count() && Auth::user()->id === $user->id)
			<h5>You have no followers.</h5>
			@else
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
			@endif
		</div>
	</div>
</div>
</div>
</div>

<script>
$('#flash-overlay-modal').modal();
</script>

<!-- Markup for UserHasPostedMessage Event to display post when new post is submitted on this profile -->

<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
<script src="//cdn.jsdelivr.net/angular.pusher/latest/pusher-angular.min.js"></script>
<script>
	$(document).ready(function(){

		/*Post form submission via AJAX*/

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});		

		$('#postForm').submit(function(e){
			e.preventDefault();
			var body = $('#postbody').val();
			var profileId = "{{ $user->id }}";

			/*Remove any existing error messages from previous post submissions.*/

			$(this).find('.post-error-msg').remove();
			$('.feedback-notice').hide();

			/*Stop focus on the textarea.*/

			$('#postbody').blur();

			/*Submit form via AJAX*/

			$.ajax({
				type: "POST",
				url: "/post/"+profileId,
				data: {post:body, profile_id:profileId},
				error: function(data){
					/*Retrieve errors and append any error messages.*/
					var errors = $.parseJSON(data.responseText);
					var errors = errors.post[0];
					var errorsAppend = '<p class="text-danger post-error-msg">'+errors+'</p>';
					/*Show error message then fadeout after 2 seconds.*/
					$(errorsAppend).insertAfter('#postbody').delay(2000).fadeOut();
				},
				success: function(data) {
					location.reload();
				},
			});

			/*Remove content in textarea after submission.*/

			$('.feed-post-input').val('');
		});
	});
</script>
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
	tinymce.init({
		selector: '#streamer-details-input',
		menubar: false,
		force_br_newlines : false,
    	force_p_newlines : false,
    	forded_root_block: '',
    	remove_linebreaks : false,
	});
</script>
<script src="{{ asset('js/streamercategories.js') }}"></script>
<script src="{{ asset('js/editprofile.js') }}"></script>
<script src="{{ asset('js/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('js/sweet-alert.min.js') }}"></script>
<script>
$('#postbody').val();
</script>	    

@stop
