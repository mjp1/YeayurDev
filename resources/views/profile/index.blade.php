@extends('templates.default')

@section('content')

	<!-- Show signed up alert for new users -->
	@include('templates.partials.alerts')


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
						<img src="images/profile-pic.jpg" />
					</div>
					<div class="streamer-id">
						<h3 class="streamer-name">{{ $user->getUsername() }}
							@if (Auth::user()->id === $user->id)
							@elseif (Auth::user()->isFollowing($user))
								<a href="{{ route('profile.remove', ['username' => $user->username]) }}" class="btn btn-default btn-remove" title="Quit following streamer"><span class="glyphicon glyphicon-minus"></span></a>
							@else
								<a href="{{ route('profile.add', ['username' => $user->username]) }}" class="btn btn-default btn-add" title="Become a fan!"><span class="glyphicon glyphicon-plus"></span></a>
							@endif
						</h3>
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
						<i class="fa fa-heart" title="Number of fans"></i>
						<span class="fan-count"></span>
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

<!-------------------------------------------------->						
			<!-- STREAMER UPDATES SECTION -->		
<!-------------------------------------------------->			

				<!-- USE AJAX TO CONNECT TO DATABASE -->
					
				</div>
				<div class="streamer-updates well">
					<h5 class="notif-head">UPDATES</h5>
					<span class="notif-head-clearall">Clear All</span>
					<span class="streamer-updates-none">No updates at this time</span>
					<div class="notif-updates">
						<div class="notif-updates-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
						<div class="notif-updates-streamer"><a href="">MPierce486</a></div>
						<div class="notif-updates-time">2 Hours Ago</div>
						<span class="glyphicon glyphicon-remove-circle streamer-update-remove"></span>
					</div>
					<div class="notif-updates">
						<div class="notif-updates-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
						<div class="notif-updates-streamer"><a href="">Mpierce123</a></div>
						<div class="notif-updates-time">2 Hours Ago</div>
						<span class="glyphicon glyphicon-remove-circle streamer-update-remove"></span>
					</div>
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
					<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-feed" title="Profile Feed"><span class="glyphicon glyphicon-time"></span></button>
					<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-connections" title="Connections"><i class="fa fa-globe"></i></button>
					<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-followers" title="Followers"><i class="fa fa-users"></i></button>
				</div>

<!-------------------------------------------------->						
			<!-- LIST OF FOLLOWING PANEL -->		
<!-------------------------------------------------->						
			
				<div class="container streamer-content-panel streamer-connections-panel">
					<h4 style="margin-top:0px;">Following</h4>
					<div class="streamer-list">
						<div class="streamer-list-item-wrapper">
							@if (!$user->following->count())
								<h5>You are not following anyone.</h5>
							@else
								@foreach ($user->following as $follower)
									<div class="streamer-list-item">
										<div class="streamer-list-item-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
										<div class="streamer-list-item-name"><a href="{{route('profile', ['username' => $follower->username]) }}">{{ $follower->getUsername() }}</a></div>
										<div class="dropdown navbar-right streamer-list-item-options">
											<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
											<ul class="dropdown-menu streamer-list-item-options-menu">
												</li>Remove</li>
											</ul>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				
<!-------------------------------------------------->						
			<!-- LIST OF FOLLOWERS PANEL -->		
<!-------------------------------------------------->						
			
				<div class="container streamer-content-panel streamer-followers-panel">
					<h4 style="margin-top:0px;">Followers</h4>
					<div class="streamer-list">
						<div class="streamer-list-item-wrapper">
							@if (!$user->followers->count())
								<h5>You have no followers.</h5>
							@else
								@foreach ($user->followers as $following)
									<div class="streamer-list-item">
										<div class="streamer-list-item-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
										<div class="streamer-list-item-name"><a href="{{route('profile', ['username' => $following->username]) }}">{{ $following->getUsername() }}</a></div>
										<div class="dropdown navbar-right streamer-list-item-options">
											<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
											<ul class="dropdown-menu streamer-list-item-options-menu">
												</li>Remove</li>
											</ul>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			
<!-------------------------------------------------->						
			<!-- STREAMER FEED CONTENT PANEL -->		
<!-------------------------------------------------->						

				<div class="streamer-content-panel streamer-feed-panel">
				
<!-------------------------------------------------->						
			<!-- FEED POST INPUTS SECTION -->		
<!-------------------------------------------------->						
					<form role="form" action="{{ route('post.message', ['id' => $user->id]) }}" method="post">
						<div class="feed-post form-group{{ $errors->has('post') ? ' has-error' : ''}}" style="margin-top:50px;">
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
				
<!-------------------------------------------------->						
			<!-- FEED CONTENT SECTION -->		
<!-------------------------------------------------->						
						
				@if (!$posts->count())
					
				@else
					@foreach ($posts as $post)
						
					<div class="streamer-feed-post">
						<div class="streamer-post-pic pic-responsive">
							<a href="{{ route('profile', ['username' => $post->user->username]) }}">
								<img src="{{ asset('images/profile-pic.jpg') }}" />
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
						<div class="streamer-post-footer">
							<span class="post-reply"><i class="fa fa-reply"></i>Reply</span>
							<textarea class="form-control post-reply-text" rows="2" placeholder="Reply here..."></textarea>
							<div class="btn-bar btn-bar-reply">
								<button type="button" class="btn btn-default btn-cancel-reply" title="Cancel Reply"><span class="glyphicon glyphicon-remove"></span></button>
								<button type="button" class="btn btn-default btn-img-reply btn-post-reply" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button>
								<input type="file" id="img-upload" style="display:none"/>
								<button type="button" class="btn btn-default btn-post-reply" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>
							</div>
						</div>
						
<!-------------------------------------------------->						
			<!-- FEED REPLY SECTION -->		
<!-------------------------------------------------->						
						
<!-- 						<div class="feed-reply-panel">
							<div class="reply-panel-user-pic pic-responsive">
								<img src="{{ asset('images/profile-pic.jpg') }}" />
							</div>
							<div class="reply-userid">
								<h5 class="reply-user-name">Matt</h5>
								<span class="reply-post-time">July 5, 2015</span>
							</div>
							<div class="reply-message">
								<span>Hey man, what's up?</span>
							</div>
							<div class="reply-post-footer">
								<span class="post-reply-reply"><i class="fa fa-reply"></i>Reply</span>
								<textarea class="form-control post-reply-text" rows="2" placeholder="Reply here..."></textarea>
								<div class="btn-bar btn-bar-reply">
									<button type="button" class="btn btn-default btn-cancel-reply" title="Cancel Reply"><span class="glyphicon glyphicon-remove"></span></button>
									<button type="button" class="btn btn-default btn-img-reply btn-post-reply" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button>
									<input type="file" id="img-upload" style="display:none"/>
									<button type="button" class="btn btn-default btn-post-reply" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>
								</div>
							</div>
						</div> -->
					</div>


					@endforeach
				@endif
		
				

				</div>
			</div>
		</div>
@stop