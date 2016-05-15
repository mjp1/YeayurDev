<!-- THIS IS THE PROFILE VIEW FOR A VISITOR THAT IS NOT LOGGED IN -->

<!-- TWITCH STREAM EMBED -->		
	@if ($user->getTwitchChannel())
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
	@endif

	@if ($user->getYoutubeId())
		<div class="stream-embed">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe src="https://www.youtube.com/embed/{{ $user->getYoutubeId() }}" frameborder="0" allowfullscreen></iframe>	   
			</div>
		</div>	
	@endif
	
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
							<button class="btn btn-add public-btn-add" title="Follow"><span class="glyphicon glyphicon-plus"></span></a>
						</h4>
					</div>

<!-- STREAMER FANS -->		
					<div class="streamer-conn">
						<i class="fa fa-users" title="Number of followers"></i>
						<span class="fan-count">{{ $user->followers()->count() }}</span>
					</div>
<!-- ABOUT ME SECTION -->		
					
					<div class="about-me-wrapper">
						<h5 class="about-me">About Me</h5>
						<span class="aboutme-text">{{ $aboutMe }}</span>
					</div>

<!-- STREAMER TOP VISITS SECTION -->

					@if (!$user->profileVisits->count())
					@else
						<h5 class="streamer-top-visits-header">Top Profile Visits:</h5>
						<div class="streamer-top-visits">
						@foreach ($user->profileVisits as $topVisits)
							<div class="streamer-top-visits-box row">
								<div class="streamer-top-visits-box-img">
									@if ($topVisits->getImagePath() === "")
										<a href="{{route('profile', ['username' => $topVisits->username]) }}"><i class="fa fa-user-secret fa-2x" alt="{{ $topVisits->username }}"></i></a>
									@else
										<a href="{{route('profile', ['username' => $topVisits->username]) }}"><img src="{{ $topVisits->getImagePath() }}" alt="{{ $topVisits->username }}"/></a>
									@endif
								</div>
								<a href="{{route('profile', ['username' => $topVisits->username]) }}" class="streamer-top-visits-box-a">{{ $topVisits->username }}</a>
							</div>
						@endforeach
						</div>
					@endif
				</div>

				<div class="streamer-about-panel well">
					<h5>What I Stream</h5>
					<div class="streamer-about-panel-wrapper">
						<div class="streamer-about-item">
							@if (!$user->UserType->count())
								<h5>This user hasn't input any streaming details.</h5>
							@else
								@if ($gameDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-games">
										<h5 class="streamer-about-item-heading">Games</h5>
										<div class="streamer-about-item-content">
										@foreach ($gameDetails as $games)
											<p>{{ $games }}</p>
										@endforeach	
										</div>
									</div>
								@endif
								@if ($artDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-art">
										<h5 class="streamer-about-item-heading">Art</h5>
										<div class="streamer-about-item-content">
										@foreach ($artDetails as $art)
											<p>{{ $art }}</p>
										@endforeach	
										</div>
									</div>
								@endif
								@if ($musicDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-music">
										<h5 class="streamer-about-item-heading">Music</h5>
										<div class="streamer-about-item-content">
										@foreach ($musicDetails as $music)
											<p>{{ $music }}</p>
										@endforeach	
										</div>
									</div>
								@endif
								@if ($buildingStuffDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-buildingstuff">
										<h5 class="streamer-about-item-heading">Building Stuff</h5>
										<div class="streamer-about-item-content">
										@foreach ($buildingStuffDetails as $buildingStuff)
											<p>{{ $buildingStuff }}</p>
										@endforeach	
										</div>
									</div>
								@endif
								@if ($educationalDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-educational">
										<h5 class="streamer-about-item-heading">Educational</h5>
										<div class="streamer-about-item-content">
										@foreach ($educationalDetails as $educational)
											<p>{{ $educational }}</p>
										@endforeach	
										</div>
									</div>
								@endif
							@endif
						</div>
						@if ($systemSpecs)
						<div class="streamer-about-item">
							<h5 class="streamer-about-item-heading">System Specs</h5>
							<div class="streamer-about-item-content">
								<p>{{ $systemSpecs }}</p>
							</div>
						</div>
						@endif
						@if ($streamSchedule)
						<div class="streamer-about-item">
							<h5 class="streamer-about-item-heading">Stream Schedule</h5>
							<div class="streamer-about-item-content">
								<p>{{ $streamSchedule }}</p>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>

<!-- STREAMER FEED SECTION -->		
					
		<div class="streamer-feed col-sm-7 well">
			
<!-- STREAMER FEED HEADER NAV -->		
				
				<div class="streamer-feed-header-nav">
					<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-feed" title="Profile Feed" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-time"></span></button>
					<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-connections" title="Connections" data-toggle="tooltip" data-placement="top"><i class="fa fa-users"></i></button>
				</div>

<!-- STREAMER FEED CONTENT PANEL -->		

				<div class="streamer-content-panel streamer-feed-panel">
								
<!-- FEED CONTENT SECTION -->		
						
					@if (!$posts->count())
						<h5>{{ $user->username }} has not posted anything yet.</h5>
					@else	
						@foreach ($posts as $post)
							<div class="streamer-feed-post">
								<div class="streamer-post-pic pic-responsive">
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
										<h4 class="streamer-post-name">{{ $post->user->username }}</h4>
									</a>
									<span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
								</div>
								<div class="streamer-post-message">
									<div class="message-content">
										<span>{{ $post->body }}</span>
										<br>
										<img src="{{ $post->getImagePath() }}" class="img-responsive message-img" />
									</div>
								</div>
								<div class="streamer-post-footer">
									<div class="post-like-count">
										<i class="fa fa-smile-o post-like-count-img"></i>
										<span class="like-number">{{ $post->likes->count() }}</span>
									</div>
										<div class="post-like-public">
											<a href="#" class="post-like-a-public">Like</a>
										</div>
									<div class="post-id hidden">{{ $post->id }}</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>

<!-- LIST OF FOLLOWING PANEL -->		
				<div class="streamer-connections-panel streamer-content-panel">
					<div class="connections-following col-sm-6">
						<h4>Following</h4>
						<div class="streamer-list">
							<div class="streamer-list-item-wrapper">
								@if (!$user->following->count())
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
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
					<div class="connections-followers col-sm-6">
						<h4>Followers</h4>
						<div class="streamer-list">
							<div class="streamer-list-item-wrapper">
								@if (!$user->following->count())
									<h5>{{ $user->username }} has no followers.</h5>
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

    <div class="modal fade modal-signin" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Sign In</h4>
	      </div>
	      <div class="modal-body">
	      	<form role="form" method="post" action="{{ route('profile.signin.redirect') }}">
		        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		            <input type="email" class="form-control input-global input-lg" name="email" placeholder="Enter email" value="{{ Request::old('email') ?: '' }}"/>
		        </div>
		        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		            <input type="password" class="form-control input-global input-lg" name="password" placeholder="Password"/>
		        </div>
		        <button type="submit" class="btn btn-default btn-global login-btn">Login</button>
		        <div class="login-options">
		            <span class="login-chkbox"><input type="checkbox" name="remember" id="stay-login"/><label for="stay-login" class="chk-label"> Keep me logged in</label></span>
		        </br>
		            <a href="/password/email" class="login-forgot-cred">Forgot Password?</a>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}"/>
		    </form>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    <div class="modal fade modal-signin-redirect" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">You must sign in to perform this action</h4>
	      </div>
	      <div class="modal-body">
	      	<form role="form" method="post" action="{{ route('profile.signin.redirect') }}">
		        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		            <input type="email" class="form-control input-global input-lg" name="email" placeholder="Enter email" value="{{ Request::old('email') ?: '' }}"/>
		        </div>
		        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		            <input type="password" class="form-control input-global input-lg" name="password" placeholder="Password"/>
		        </div>
		        <button type="submit" class="btn btn-default btn-global login-btn">Login</button>
		        <div class="login-options">
		            <span class="login-chkbox"><input type="checkbox" name="remember" id="stay-login"/><label for="stay-login" class="chk-label"> Keep me logged in</label></span>
		        </br>
		            <a href="/password/email" class="login-forgot-cred">Forgot Password?</a>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}"/>
		    </form>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


		<script>
			$('#flash-overlay-modal').modal();
		</script>

<!-- Markup for UserHasPostedMessage Event to display post when new post is submitted on this profile -->

		<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
		<script src="//cdn.jsdelivr.net/angular.pusher/latest/pusher-angular.min.js"></script>
	    <script>
	    	$(document).ready(function(){
                var pusher = new Pusher('{{ getenv('PUSHER_KEY') }}', {
			      encrypted: true
			    });
	            var channel = pusher.subscribe('newMessage');
	          	channel.bind('Yeayurdev\\Events\\UserHasPostedMessage', function(data) {

	          	$profileId = "{{ $user->id }}";

	          	if ($profileId == data.message.id) {

					/*Emoji Rendering in Posts*/
					// Removing for now
					/*function entityForSymbolInContainer(selector) {
					    var code = data.message.body.codePointAt(0);
					    console.log(code);
					    var codeHex = code.toString(16);
					    console.log("codehex "+codeHex);
					    while (codeHex.length < 4) {
					        codeHex = "0" + codeHex;
					    }
					    
					    return codeHex;
					}*/

				// Do not have Pusher show update if user is on own profile -- page will reload and show new post instead
					var div = [
	'					<div class="streamer-feed-post">',
	'						<span class="delete-post">',
	'							<i class="fa fa-times-circle-o"></i>',
	'						</span>',
	'						<div class="streamer-post-pic pic-responsive">',
	'							<a href="/'+data.message.name+'">',
									(data.message.image=="" ? '<i class="fa fa-user-secret fa-3x"></i>' : '<img src="'+data.message.image+'" alt="#"/>'),
	'							</a>',
	'						</div>',
	'						<div class="streamer-post-id">',
	'							<a href="/'+data.message.name+'">',
	'								<h4 class="streamer-post-name">'+data.message.name+'</h4>',
	'							</a>',
	'							<span class="post-time">'+data.message.time+'</span>',
	'						</div>',
	'						<div class="streamer-post-message">',
	'							<div class="message-content">',
	'								<span>'+data.message.body+'</span>',
	'							</div>',
	'						</div>',
	'						<div class="streamer-post-footer">',
	'							<div class="post-like-count">',
	'								<i class="fa fa-smile-o post-like-count-img"></i>',
	'								<span class="like-number">0</span>',
	'							</div>',
	'							<div class="edit-info edit-info-post">Edit Post</div>',
	'							<div class="post-id hidden">'+data.message.postid+'</div>',
	'						</div>',
	'					</div>'
					].join('');
		          $(div).insertAfter('.feed-post').addClass('glow');
		          	setTimeout(function () { 
					    $('div').removeClass('glow');
					}, 1000);
	          	}
	          });

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
	});  

		 

	 
	    </script>
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>

