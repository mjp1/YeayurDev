@extends('templates.default')

@section('content')

	<!-- Show signed up alert for new users -->
	@include('templates.partials.alerts')
	@include ('flash::message')

<!-------------------------------------------------->						
			<!-- TWITCH STREAM EMBED -->		
<!-------------------------------------------------->						

		<div class="stream-embed">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe id="player" type="text/html" src="http://www.twitch.tv/{{ $user->getUsername() }}/embed" target="_blank" frameborder="0"></iframe>
			</div>

			<!-- Will implement ratings at a later date -->

			<!--<div class="streamer-rate-click">
				<span class="rate-me">Rate Me!</span><span class="stream-rate"></span>
				<span class="rate-conf">Thanks for rating me!</span>
			</div>-->
			
		</div>

<!-------------------------------------------------->						
	<!-- MAIN STREAMER INFO AND FEED SECTION -->		
<!-------------------------------------------------->						

		<div class="info-body">
			<div class="streamer-info-main col-sm-4">
				<div class="streamer-info well">
					<div class="streamer-pic pic-responsive">
						@if ($user->getImagePath() === "")
						<i class="fa fa-user-secret fa-4x"></i>
						@else
						<img src="{{ asset('images/profiles') }}/{{ $user->getImagePath() }}" />
						@endif
					</div>
					<div class="streamer-id">
						<h4 class="streamer-name">{{ $user->getUsername() }}
							@if (Auth::user()->id === $user->id)
							@elseif (Auth::user()->isFollowing($user))
								<a href="{{ route('profile.remove', ['username' => $user->username]) }}" class="btn btn-default btn-remove" title="Quit following streamer"><span class="glyphicon glyphicon-minus"></span></a>
							@else
								<a href="{{ route('profile.add', ['username' => $user->username]) }}" class="btn btn-default btn-add" title="Become a fan!"><span class="glyphicon glyphicon-plus"></span></a>
							@endif
						</h4>
					</div>

					<!-- Will implement ratings at a later date -->

					<!-------------------------------------------------->						
								<!-- STREAMER RATING -->		
					<!-------------------------------------------------->						
					
					<!--<div class="stream-rate-read"></div><span class="rate-count">(3)</span>-->
					
					<!-------------------------------------------------->						
								<!-- STREAMER FANS -->		
					<!-------------------------------------------------->						
					<div class="streamer-conn">
						<i class="fa fa-users" title="Number of followers"></i>
						<span class="fan-count">{{ $user->followers()->count() }}</span>
					</div>
					<!-------------------------------------------------->						
								<!-- ABOUT ME SECTION -->		
					<!-------------------------------------------------->						

					<h5 class="about-me">About Me:</h5>
					@if ($user->getAboutMe() === "")
					<span class="aboutme-text-auto">I'm a riddle wrapped in a mystery inside an enigma.</span>
					@else
					<span class="aboutme-text">{{ $user->getAboutMe() }}</span>
					@endif
					
					<!-- STREAMER TOP VISITS SECTION -->

					@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
					<h5>Top Profile Visits:</h5>
					<div class="streamer-top-visits">
						@if (!$user->profileVisits->count())
						@else
							@foreach ($user->profileVisits as $topVisits)
								<div class="streamer-top-visits-box row">
									<div class="streamer-top-visits-box-img">
										@if ($topVisits->getImagePath() === "")
											<a href="{{route('profile', ['username' => $topVisits->username]) }}"><i class="fa fa-user-secret fa-2x" alt="{{ $topVisits->username }}"></i></a>
										@else
											<a href="{{route('profile', ['username' => $topVisits->username]) }}"><img src="{{ asset('images/profiles') }}/{{ $topVisits->getImagePath() }}" alt="{{ $topVisits->username }}"/></a>
										@endif
									</div>
									<a href="{{route('profile', ['username' => $topVisits->username]) }}" class="streamer-top-visits-box-a">{{ $topVisits->username }}</a>
								</div>
							@endforeach
						@endif
					</div>
					@else
					@endif
					<!-- Removing for now -->
					<!-- <h4>Streamer Style</h4>
					<div class="s-style-ul">
						<ul>
							<li></li>
							<li></li>
						</ul>
					</div> -->
				</div>

			</div>

			
<!-------------------------------------------------->						
			<!-- STREAMER FEED SECTION -->		
<!-------------------------------------------------->	
					
			<div class="streamer-feed col-sm-8 well">
			
<!-------------------------------------------------->						
			<!-- STREAMER FEED HEADER NAV -->		
<!-------------------------------------------------->						
		
				<div class="btn-bar">
					@if (Auth::user()->id !== $user->id)
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn-duo streamer-feed-header-nav-btn-feed" title="Profile Feed"><span class="glyphicon glyphicon-time"></span></button>
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn-duo streamer-feed-header-nav-btn-connections" title="Connections"><i class="fa fa-globe"></i></button>
					@else
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-feed" title="Profile Feed"><span class="glyphicon glyphicon-time"></span></button>
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-connections" title="Connections"><i class="fa fa-globe"></i></button>
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-followers" title="Followers"><i class="fa fa-users"></i></button>
					@endif
				</div>

<!-------------------------------------------------->						
			<!-- LIST OF FOLLOWING PANEL -->		
<!-------------------------------------------------->						
				
				<div class="container streamer-content-panel streamer-connections-panel">
					@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
						<h4 style="margin-top:0px;">Following</h4>
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
													<img src="{{ asset('images/profiles') }}/{{ $follower->getImagePath() }}" alt="{{ $follower->username }}"/>
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
						@else
						<h5>You must follow this user to view their connections.</h5>
					@endif
				</div>
				
				
<!-------------------------------------------------->						
			<!-- LIST OF FOLLOWERS PANEL -->		
<!-------------------------------------------------->						
			@if (Auth::user()->id !== $user->id)

			@else
				<div class="container streamer-content-panel streamer-followers-panel">
					@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
					<h4 style="margin-top:0px;">Followers</h4>
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
												<img src="{{ asset('images/profiles') }}/{{ $following->getImagePath() }}" alt="{{ $following->username }}"/>
											@endif
										</div>
										<div class="streamer-list-item-name"><a href="{{route('profile', ['username' => $following->username]) }}">{{ $following->getUsername() }}</a></div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
					@else
					<h5>You must follow this user to view their connections.</h5>
				@endif
				</div>
			@endif
				
			
<!-------------------------------------------------->						
			<!-- STREAMER FEED CONTENT PANEL -->		
<!-------------------------------------------------->						

				<div class="container streamer-content-panel streamer-feed-panel">
					@if (!Auth::user()->isFollowing($user) && Auth::user()->id !== $user->id)
						<h5>You must follow this user to view their feed.</h5>
					@endif
<!-------------------------------------------------->						
			<!-- FEED POST INPUTS SECTION -->		
<!-------------------------------------------------->		

					@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)				
						<form role="form" action="#" id="postForm">
							<div class="feed-post form-group{{ $errors->has('post') ? ' has-error' : ''}}">
								<textarea class="form-control feed-post-input" rows="2" id="postbody" name="post" placeholder="What's up?"></textarea>
								<div class="btn-bar btn-bar-post">
									<!-- <button type="button" class="btn btn-default btn-img btn-post" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button> -->
									<!-- <input type="file" id="img-upload" style="display:none"/> -->
									<button type="submit" class="btn btn-default btn-post" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>
								</div>
								@if ($errors->has('post'))
									<span class="help-block">{{ $errors->first('post') }}</span>
								@endif
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						</form>
					@else
					@endif
				
<!-------------------------------------------------->						
			<!-- FEED CONTENT SECTION -->		
<!-------------------------------------------------->	

				<!-- The following is for loading profile posts on new page refresh. -->	
						
				@if (!$posts->count())
					
				@elseif (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
					@foreach ($posts as $post)
						
					<div class="streamer-feed-post">
						<div class="streamer-post-pic pic-responsive">
							<a href="{{ route('profile', ['username' => $post->user->username]) }}">
								@if ($post->user->getImagePath() === "")
									<i class="fa fa-user-secret fa-3x"></i>
								@else
									<img src="{{ asset('images/profiles') }}/{{ $post->user->getImagePath() }}" alt="{{ $post->user->username }}"/>
								@endif
							</a>
						</div>
						<div class="streamer-post-id">
							<a href="{{ route('profile', ['username' => $post->user->username]) }}">
								<h4 class="streamer-post-name">{{ $post->user->username }}</h4>
							</a>
							<span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
						</div>
						<div class="streamer-post-message">
							<div class="message-content">
								<span>{{ $post->body }}</span>
							</div>
						</div>
						@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
						<div class="streamer-post-footer">
							<button class="btn btn-default btn-trigger-reply">Reply</button>
							<form method="post" action="{{ route('post.reply', ['postId' => $post->id]) }}">
								<div class="reply-form-group">
									<textarea class="form-control post-reply-text{{ $errors->has("reply-{$post->id}") ? ' has-error': '' }}" name="reply-{{ $post->id }}" rows="2" placeholder="Reply here..."></textarea>
									<div class="btn-bar btn-bar-reply">
										<button type="button" class="btn btn-default btn-cancel-reply" title="Cancel Reply"><span class="glyphicon glyphicon-remove"></span></button>
										<!-- <button type="button" class="btn btn-default btn-img-reply btn-post-reply" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button>
										<input type="file" id="img-upload" style="display:none"/> -->
										<button type="submit" class="btn btn-default btn-post-reply" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>
									</div>
								</div>
								@if ($errors->has("reply-{$post->id}"))
									<span class="help-block">{{ $errors->first("reply-{$post->id}") }}</span>
								@endif
								<input type="hidden" name="_token" value="{{ Session::token() }}"/>
							</form>
						</div>
						@else
						@endif
						
<!-------------------------------------------------->						
			<!-- FEED REPLY SECTION -->		
<!-------------------------------------------------->						
						
						@foreach ($post->replies as $reply)
							<div class="feed-reply-panel">
								<a href="{{ route('profile', ['username' => $reply->user->username]) }}" class="reply-panel-user-pic pic-responsive">
									@if ($reply->user->getImagePath() === "")
										<i class="fa fa-user-secret fa-3x"></i>
									@else
										<img src="{{ asset('images/profiles') }}/{{ $reply->user->getImagePath() }}" alt="{{ $reply->user->username }}"/>
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
						
					@endif
		
				

				</div>
			</div>
		</div>

		<script>
			$('#flash-overlay-modal').modal();
		</script>

		<!-- Markup for UserHasPostedMessage Event to display post when new post is submitted on this profile -->

		<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
		<script src="//cdn.jsdelivr.net/angular.pusher/latest/pusher-angular.min.js"></script>
		@if (!$posts->count())
		@else
	    <script>
	    	$(document).ready(function(){
	            var pusher = new Pusher('03fe3c261638a67dbce5');
	            var channel = pusher.subscribe('newMessage');
	          channel.bind('Yeayurdev\\Events\\UserHasPostedMessage', function(data) {
	          	
	          	$profileId = $('#user_id').text();

	          	if ($profileId == data.message.id) {

					var div = [
	'					<div class="streamer-feed-post">',
	'						<div class="streamer-post-pic pic-responsive">',
	'							<a href="/profile/'+data.message.name+'">',
									(data.message.image=="" ? '<i class="fa fa-user-secret fa-3x"></i>' : '<img src="/images/profiles/'+data.message.image+'" alt="#"/>'),
	'							</a>',
	'						</div>',
	'						<div class="streamer-post-id">',
	'							<a href="/profile/'+data.message.name+'">',
	'								<h4 class="streamer-post-name">'+data.message.name+'</h4>',
	'							</a>',
	'							<span class="post-time">'+data.message.time+'</span>',
	'						</div>',
	'						<div class="streamer-post-message">',
	'							<div class="message-content">',
	'								<span>'+data.message.body+'</span>',
	'							</div>',
	'						</div>',
	'						@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)',
	'						<div class="streamer-post-footer">',
	'							<button class="btn btn-default btn-trigger-reply">Reply</button>',
	'							<form method="post" action="{{ route("post.reply", ["postId" => $post->id]) }}">',
	'								<div class="reply-form-group">',
	'									<textarea class="form-control post-reply-text{{ $errors->has("reply-{$post->id}") ? " has-error": "" }}" name="reply-{{ $post->id }}" rows="2" placeholder="Reply here..."></textarea>',
	'									<div class="btn-bar btn-bar-reply">',
	'										<button type="button" class="btn btn-default btn-cancel-reply" title="Cancel Reply"><span class="glyphicon glyphicon-remove"></span></button>',
	'										<!-- <button type="button" class="btn btn-default btn-img-reply btn-post-reply" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button>',
	'										<input type="file" id="img-upload" style="display:none"/> -->',
	'										<button type="submit" class="btn btn-default btn-post-reply" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>',
	'									</div>',
	'								</div>',
	'								@if ($errors->has("reply-{$post->id}"))',
	'									<span class="help-block">{{ $errors->first("reply-{$post->id}") }}</span>',
	'								@endif',
	'								<input type="hidden" name="_token" value="{{ Session::token() }}"/>',
	'							</form>',
	'						</div>',
	'						@else',
	'						@endif							',
	'					</div>'
					].join('');
		          $(div).insertAfter('.feed-post');
	          	}
	          });

				/*Submit post when the 'Enter' key is clicked*/

				$('.feed-post-input').keypress(function(e){
					if (e.which === 13) {
						$('#postForm').submit();
						return false;
					}
				});

				/*Post form submission via AJAX*/

				$.ajaxSetup({
					headers: {
						'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
					}
				});		

				$('#postForm').submit(function(e){
					e.preventDefault();
					var body = $('#postbody').val();
					var profileId = $('#user_id').text();
                    
					/*Remove any existing error messages from previous post submissions.*/

                	$('.post-error-msg').hide();

                	/*Submit form via AJAX*/

                	$.ajax({
                		type: "POST",
                		url: "/post/"+profileId,
                		data: {post:body, profile_id:profileId},
                		error: function(data){
                			var errors = $.parseJSON(data.responseText);
                			var errors = errors.post[0];
                			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
                			$(errorsAppend).insertAfter('.btn-bar-post');
                			
                		}
        			});

                	$('#postbody').val('');
                });
			});
	    </script>
	  	@endif
	<div id="user_id" style="display:none;">{{$user->id}}</div>	
@stop