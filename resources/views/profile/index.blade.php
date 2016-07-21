@extends('templates.default')

@section('content')

@if (Auth::check())
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
		<div class="streamer-conn" data-toggle="modal" data-target="#streamer-connections-modal">
			<i class="fa fa-users" title="Number of followers"></i>
			<span class="fan-count">{{ $user->followers()->count() }}</span>
		</div>
		<!-- ABOUT ME SECTION -->
		<a href="https://www.twitch.tv/{{ $user->username }}" target="_blank" class="streamer-twitch-link"><img src="{{ asset('images/twitch_oauth_logo.png') }}" /><i class="fa fa-external-link" aria-hidden="true"></i></a>		
		<span data-toggle="tooltip" data-placement="top" title="Reputation Points">Reputation: {{ $user->user_points }}</span>
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
		@elseif ($user->streamer_details && Auth::user()->id === $user->id)
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
		@elseif (!$user->streamer_details && Auth::user()->id !== $user->id)
			<h6>{{ $user->username }} has not entered any details here</h6>
		@endif
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
			<h6 class="videos-none">{{ $user->username }} has not recorded any videos</h6>
		@endif
	</ul>

	<!-- STREAMER TAGS SECTION -->

	<div class="streamer-tags well">
		<h5><strong>Streamer Tags</strong>
			<span class="streamer-tags-info" data-toggle="tooltip" data-placement="top" title="Add tags to describe {{ $user->username }} as a streamer. Each tag is a link so you can find other streamers with the same tags. {{ $user->username }} cannot edit these tags."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
			@if (Auth::user()->id !== $user->id)
			<span class="streamer-tags-edit"><i class="fa fa-pencil" aria-hidden="true"></i></span>
			@endif
		</h5>
		@if ($tags)
			<div class="streamer-tags-item-wrapper">
				@foreach($tags as $tag)
					<a href="/search/tags/{{ $tag }}" class="streamer-tags-item">{{ $tag }}</a>
				@endforeach
			</div>
		@endif
		@if (Auth::user()->id !== $user->id)
		<form role="form" id="streamer-tags-form" method="POST" action="{{ route('edit.tags', ['id' => $user->id]) }}">
			<input name="tags" id="mySingleFieldTags" value="{{ implode(',', $tags) }}" name="tags" />
			<ul id="streamer-tags">
			</ul>
			<button class="btn btn-default streamer-tags-form-cancel">Cancel</button>
			<button class="btn btn-global">Save</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}"/>
		</form>
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
			<span class="streamer-content-info" data-toggle="tooltip" data-placement="top" title="This is the Feedback Board. {{ $user->username }} cannot post here, only visitors. Ask a question, write a review, or leave helpful suggestions and feedback so {{ $user->username }} can become a better streamer."><i class="fa fa-info-circle" aria-hidden="true"></i></span>
		</h4>
		<hr>
		@if (Auth::user()->id !== $user->id)
		<h6>Ask a question, write a review, or leave feedback to help {{ $user->username }} become a better streamer</h6>
		<!-- FEED POST INPUTS SECTION -->		
			<form role="form" action="#" id="postForm">
				<div class="feed-post form-group">
					<span class="feedback-notice">Feedback should be constructive and helpful.</span>
					<textarea class="form-control input-global" rows="2" id="post" name="post"></textarea>
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
							<span><?php echo $post->body ?></span>
						</div>
						<form role="form" action="" id="editPostForm">
							<div class="feed-post form-group">
								<textarea class="form-control input-global" rows="2" id="edit-post-{{ $post->id }}" name="edit-post"></textarea>
								<button class="btn btn-default edit-cancel" title="Cancel">Cancel</button>
								<button type="submit" class="btn btn-global" title="Edit Post">Submit</button>
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						</form>
					</div>
					<div class="streamer-post-footer">
						<h6 class="post-reply-button">Reply</h6>
						<div class="dropdown post-menu-wrapper">
							<i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown"></i>
							<ul class="dropdown-menu post-menu" aria-labelledby="dLabel">
								@if ($post->user->id === Auth::user()->id)
								<li class="post-menu-edit">Edit</li>
								<li class="post-menu-delete">Delete</li>
								@else
								<li class="post-menu-report">Report</li>
								@endif
							</ul>
						</div>
						<div class="post-id hidden">{{ $post->id }}</div>
					</div>
					<div class="streamer-post-reply-input">
						<form role="form" method="post" id="replyForm" action="">
							<div class="form-group">
								<textarea class="form-control input-global" rows="2" id="replybody-{{ $post->id }}" name="reply-{{ $post->id }}" placeholder="Reply to this post"></textarea>
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
							<div class="reply-message-content">
								<span><?php echo $reply->body ?></span>
							</div>
							<form role="form" action="#" id="editReplyForm">
								<div class="feed-post form-group">
									<textarea class="form-control input-global" rows="2" id="edit-post-{{ $reply->id }}" name="edit-post"></textarea>
									<button class="btn btn-default edit-cancel" title="Cancel">Cancel</button>
									<button type="submit" class="btn btn-global" title="Edit Post">Submit</button>
								</div>
								<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
							</form>
						</div>
						<div class="streamer-post-footer">
							<h6 class="reply-reply-button">Reply</h6>
							<div class="dropdown post-menu-wrapper">
								<i class="fa fa-ellipsis-h" aria-hidden="true" data-toggle="dropdown"></i>
								<ul class="dropdown-menu post-menu" aria-labelledby="dLabel">
									@if ($reply->user->id === Auth::user()->id)
									<li class="reply-menu-edit">Edit</li>
									<li class="reply-menu-delete">Delete</li>
									@else
									<li class="reply-menu-report">Report</li>
									@endif
								</ul>
							</div>
							<div class="reply-id hidden">{{ $reply->id }}</div>
						</div>
						<div class="streamer-reply-reply-input">
							<form role="form" method="post" id="replyReplyForm" action="">
								<div class="form-group">
									<textarea class="form-control input-global" rows="2" id="replybody-{{ $reply->id }}" name="reply-{{ $reply->id }}" placeholder="Reply to this post"></textarea>
									<button type="submit" class="btn btn-global post-feedback-reply">Reply</button>
								</div>
								<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
							</form>
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
				@if ($user->fanPages->count())
				<li class="connections-modal-nav-fan-pages">Fan Pages ({{ $user->fanPages->count() }})</li>
				@endif
			</ul>
	        <!-- LIST OF FOLLOWING PANEL -->		
			<div class="connections-modal-body">
				<!-- LIST OF FAN PAGES FOLLOWED -->
				<div class="connections-fan-pages">
					<h4>Fan Pages Followed</h4>
					<div class="streamer-list">
						<div class="streamer-list-item-wrapper">
							@foreach ($user->fanPages as $fanPage)
							<div class="streamer-list-item">
								<div class="streamer-list-item-img">
									@if ($fanPage->logo_url === "")
									<i class="fa fa-user-secret fa-4x"></i>
									@else
									<img src="{{ $fanPage->logo_url }}" alt="{{ $fanPage->logo_url }}"/>
									@endif
								</div>
								<div class="streamer-list-item-name"><a href="{{route('fan', ['displayName' => $fanPage->getDisplayName()]) }}">{{ $fanPage->getDisplayName() }}</a></div>
							</div>
							@endforeach
						</div>	
					</div>
				</div>

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

			var body = tinymce.get('post').getContent();
			var profileId = "{{ $user->id }}";

			/*Remove any existing error messages from previous post submissions.*/

			$(this).find('.post-error-msg').remove();
			$('.feedback-notice').hide();

			/*Stop focus on the textarea.*/

			$('#post').blur();

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
					$(errorsAppend).insertAfter('#post').delay(2000).fadeOut();
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
    	plugins: "link",
    	link_assume_external_targets: true
	});
</script>
<script>
	tinymce.init({
		selector: '#post',
		menubar: false,
		force_br_newlines : false,
    	force_p_newlines : false,
    	forded_root_block: '',
    	remove_linebreaks : true,
    	plugins: "link",
    	link_assume_external_targets: true
	});
</script>

<script src="{{ asset('js/streamercategories.js') }}"></script>
<script src="{{ asset('js/editprofile.js') }}"></script>
<script src="{{ asset('js/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('js/sweet-alert.min.js') }}"></script>
<script>
$('#postbody').val();
</script>	    

@elseif (!Auth::check())
 @include('profile.public')
@endif

@stop
