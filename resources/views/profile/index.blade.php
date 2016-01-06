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
			<div class="col-sm-4">
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
						<i class="fa fa-users" title="Number of fans"></i>
						<span class="fan-count">{{ $user->followers()->count() }}</span>
					</div>
					<!-------------------------------------------------->						
								<!-- ABOUT ME SECTION -->		
					<!-------------------------------------------------->						

					<h4 class="about-me">About Me:</h4>
					<span class="aboutme-text">{{ $user->getAboutMe() }}</span>
					</br>

					<!-- Removing for now -->
					<!-- <h4>Streamer Style</h4>
					<div class="s-style-ul">
						<ul>
							<li></li>
							<li></li>
						</ul>
					</div> -->
				</div>

<!-------------------------------------------------->						
			<!-- STREAMER UPDATES SECTION -->		
<!-------------------------------------------------->			

			
	<!-- 			<div class="streamer-updates well">
					<h5 class="notif-head">UPDATES</h5>
					<span class="notif-head-clearall">Clear All</span>
					<span class="streamer-updates-none">No updates at this time</span>
					<div class="notif-updates">
						<div class="notif-updates-img"><img src="{{ asset('images/profile-pic.JPG') }}"/></div>
						<div class="notif-updates-streamer"><a href="">MPierce486</a></div>
						<div class="notif-updates-time">2 Hours Ago</div>
						<span class="glyphicon glyphicon-remove-circle streamer-update-remove"></span>
					</div>
					<div class="notif-updates">
						<div class="notif-updates-img"><img src="{{ asset('images/profile-pic.JPG') }}"/></div>
						<div class="notif-updates-streamer"><a href="">Mpierce123</a></div>
						<div class="notif-updates-time">2 Hours Ago</div>
						<span class="glyphicon glyphicon-remove-circle streamer-update-remove"></span>
					</div>
				</div> -->
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
											<div class="streamer-list-item-img"><img src="{{ asset('images/profiles') }}/{{ $follower->getImagePath() }}" alt="{{ $follower->username }}"/></div>
											<div class="streamer-list-item-name"><a href="{{route('profile', ['username' => $follower->username]) }}">{{ $follower->getUsername() }}</a></div>
											<div class="dropdown navbar-right streamer-list-item-options">
												<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
												<ul class="dropdown-menu streamer-list-item-options-menu">
													</li><a href="{{ route('profile.remove', ['username' => $follower->username]) }}">Remove</a></li>
												</ul>
											</div>
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
										<div class="streamer-list-item-img"><img src="{{ asset('images/profiles') }}/{{ $following->getImagePath() }}" alt="{{ $following->username }}"/></div>
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
					<form role="form" action="{{ route('post.message', ['id' => $user->id]) }}" method="post">
						<div class="feed-post form-group{{ $errors->has('post') ? ' has-error' : ''}}">
							<textarea class="form-control feed-post-input" rows="2" name="post" placeholder="What's up?"></textarea>
							<div class="btn-bar">
								<!-- <button type="button" class="btn btn-default btn-img btn-post" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button> -->
								<!-- <input type="file" id="img-upload" style="display:none"/> -->
								<button type="submit" class="btn btn-default btn-post" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>
							</div>
							@if ($errors->has('post'))
								<span class="help-block">{{ $errors->first('post') }}</span>
							@endif
						</div>
						<input type="hidden" name="_token" value="{{ Session::token() }}">
					</form>
					@else
					@endif
				
<!-------------------------------------------------->						
			<!-- FEED CONTENT SECTION -->		
<!-------------------------------------------------->						
						
				@if (!$posts->count())
					
				@elseif (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
					@foreach ($posts as $post)
						
					<div class="streamer-feed-post">
						<div class="streamer-post-pic pic-responsive">
							<a href="{{ route('profile', ['username' => $post->user->username]) }}">
								<img src="{{ asset('images/profiles') }}/{{ $post->user->getImagePath() }}" alt="{{ $post->user->username }}"/>
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
									<img src="{{ asset('images/profiles') }}/{{ $reply->user->getImagePath() }}" alt="{{ $reply->user->username }}"/>
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
@stop