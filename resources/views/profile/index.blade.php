@extends('templates.default')

@section('content')

	<!-- Show signed up alert for new users -->
	@include('templates.partials.alerts')
	@include ('flash::message')
	@include ('profile.modals.profilemodals')

<!-------------------------------------------------->						
			<!-- TWITCH STREAM EMBED -->		
<!-------------------------------------------------->						
		
		<div class="stream-embed">
			<div class="embed-responsive embed-responsive-16by9">
				@if (Auth::user()->getTwitchUsername())
				<iframe id="player" type="text/html" src="http://www.twitch.tv/{{ $user->getUsername() }}/embed" target="_blank" frameborder="0"></iframe>
				@elseif (Auth::user()->getYoutubeUsername())
				@endif
			</div>
		</div>

<!-------------------------------------------------->						
	<!-- MAIN STREAMER INFO AND FEED SECTION -->		
<!-------------------------------------------------->						

		<div class="info-body">
			<div class="streamer-info-main col-sm-4">
				<div class="streamer-info well">
					<div class="streamer-pic pic-responsive">
						@if ($user->id === Auth::user()->id)
							<span class="edit-info edit-info-pic"><i class="fa fa-pencil"></i></span>
						@endif
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
					
					<div class="about-me-wrapper">
						@if ($user->id === Auth::user()->id)
							<span class="edit-info edit-info-about"><i class="fa fa-pencil"></i></span>
						@endif
						<h5 class="about-me">About Me:</h5>
						@if (!$aboutMe)
						<span class="aboutme-text-auto">Who am I?</span>
						@else
						<span class="aboutme-text-auto">{{ $aboutMe }}</span>
						@endif
					</div>

					<!-- STREAMER TOP VISITS SECTION -->

					@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
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
					@if (Auth::user()->id === $user->id || Auth::user()->isFollowing($user))
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-feed" title="Profile Feed" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-time"></span></button>
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-about" title="About" data-toggle="tooltip" data-placement="top"><i class="fa fa-exclamation-circle"></i></button>
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-connections" title="Following" data-toggle="tooltip" data-placement="top"><i class="fa fa-globe"></i></button>
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn streamer-feed-header-nav-btn-followers" title="Followers" data-toggle="tooltip" data-placement="top"><i class="fa fa-users"></i></button>
					@else
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn-duo streamer-feed-header-nav-btn-about" title="About" data-toggle="tooltip" data-placement="top"><i class="fa fa-exclamation-circle"></i></button>
						<button type="button" class="btn btn-default streamer-feed-header-nav-btn-duo streamer-feed-header-nav-btn-connections" title="Following" data-toggle="tooltip" data-placement="top"><i class="fa fa-globe"></i></button>
					@endif
				</div>

<!-------------------------------------------------->						
			<!-- STREAMER FEED CONTENT PANEL -->		
<!-------------------------------------------------->	

				@if (Auth::user()->id === $user->id || Auth::user()->isFollowing($user))
				<div class="streamer-content-panel streamer-feed-panel">
				
<!-------------------------------------------------->						
			<!-- FEED POST INPUTS SECTION -->		
<!-------------------------------------------------->		

					@if (Auth::user()->id === $user->id)				
						<form role="form" action="#" id="postForm">
							<div class="feed-post form-group">
								<textarea class="form-control feed-post-input" rows="2" id="postbody" name="post" placeholder="What's up?"></textarea>
								<div class="btn-bar btn-bar-post">
									<!-- <button type="button" class="btn btn-default btn-img btn-post" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button> -->
									<!-- <input type="file" id="img-upload" style="display:none"/> -->
									<button type="submit" class="btn btn-default btn-post" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>
								</div>
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						</form>
					@else
					@endif
				
<!-------------------------------------------------->						
			<!-- FEED CONTENT SECTION -->		
<!-------------------------------------------------->	
						
					@if (!$posts->count())
						@if (Auth::user()->id !== $user->id)
						<h5>{{ $user->username }} has not posted anything yet.</h5>
						@endif
					@else	
						@foreach ($posts as $post)
							<div class="streamer-feed-post">
								@if ($user->id === Auth::user()->id)
									<span class="delete-post"><i class="fa fa-times-circle-o"></i></span>
								@endif
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
								<div class="streamer-post-footer">
									<div class="post-like-count">
										<span><i class="fa fa-smile-o post-like-count-img"></i>{{ $post->likes->count() }}</span>
									</div>
									@if ($post->user->id !== Auth::user()->id)
										<div class="post-like">
											<a href="{{ route('post.like', ['postId' => $post->id]) }}" class="post-like-a">Like</a>
										</div>
									@endif
									@if ($user->id === Auth::user()->id)
										<div class="edit-info edit-info-post">Edit Post</div>
									@endif
									<div id="post-id" class="hidden">{{ $post->id }}</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				@else
				@endif

<!-------------------------------------------------->						
			<!-- ABOUT PANEL -->		
<!-------------------------------------------------->	
				@if (Auth::user()->id === $user->id || Auth::user()->isFollowing($user))
				<div class="streamer-content-panel streamer-about-panel">
				@else
				<div class="streamer-content-panel streamer-about-panel panel-target">
				@endif
					<h4>About</h4>
					@if ($user->id === Auth::user()->id)
						<span class="edit-info edit-info-categories"><i class="fa fa-pencil"></i></span>
					@endif
					<div class="streamer-about-panel-wrapper">
						@include ('profile.partials.categories')
						<div class="streamer-about-item">
							@if (!$user->UserType->count())
								@if ($user->id === Auth::user()->id)
									<h5>Edit your information here. Everyone sees this when they look at your profile!</h5>
								@else
									<h5>We don't have a clue who this user is!</h5>
								@endif
							@else
								@if ($gameDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-games">
										<h5 class="streamer-about-item-heading">Games</h5>
										@if ($user->id === Auth::user()->id)
											<span class="streamer-about-item-edit about-item-edit-games"><i class="fa fa-pencil"></i></span>
										@endif
										<div class="streamer-about-item-content">
										@foreach ($gameDetails as $games)
											<p>{{ $games }}</p>
										@endforeach	
										</div>
									</div>
									<div class="streamer-details-item-edit about-item-games">
										<h5 class="streamer-about-item-heading-edit">Games</h5>
										<form class="streamer-details-item-edit-form">
											<div class="help-block">Here you can edit your game details</div>
											<div class="streamer-details-form-inputs">
												@foreach ($gameDetails as $games)
													<div class="input-group">
														<input type="text" name="editDetails[games]" value="{{ $games }}"class="form-control input-global"/>
														<span class="input-group-btn remove-input-group">
															<button class="btn btn-default" type="button">
																<span class="glyphicon glyphicon-remove"></span>
															</button>
														</span>
													</div>
												@endforeach	
												<div class="edit-add-more-games">
													<button type="button" class="btn btn-global edit-add-more-games-btn">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<span>Add more</span>
												</div>
											</div>
										</form>
										<div class="streamer-details-item-edit-footer">
											<button type="button" class="btn btn-default streamer-details-items-edit-games-cancel">Cancel</button>
										    <button type="button" class="btn btn-global streamer-details-items-edit-games-submit">Submit</button>
										</div>
									</div>				
								@endif
								@if ($artDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-art">
										<h5 class="streamer-about-item-heading">Art</h5>
										@if ($user->id === Auth::user()->id)
											<span class="streamer-about-item-edit about-item-edit-art"><i class="fa fa-pencil"></i></span>
										@endif
										<div class="streamer-about-item-content">
										@foreach ($artDetails as $art)
											<p>{{ $art }}</p>
										@endforeach	
										</div>
									</div>
									<div class="streamer-details-item-edit about-item-art">
										<h5 class="streamer-about-item-heading-edit">Art</h5>
										<form class="streamer-details-item-edit-form">
											<div class="help-block">Here you can edit your art details</div>
											<div class="streamer-details-form-inputs">
												@foreach ($artDetails as $art)
													<div class="input-group">
														<input type="text" name="editDetails[art]" value="{{ $art }}"class="form-control input-global"/>
														<span class="input-group-btn remove-input-group">
															<button class="btn btn-default" type="button">
																<span class="glyphicon glyphicon-remove"></span>
															</button>
														</span>
													</div>
												@endforeach	
												<div class="edit-add-more-art">
													<button type="button" class="btn btn-global edit-add-more-art-btn">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<span>Add more</span>
												</div>
											</div>
										</form>
										<div class="streamer-details-item-edit-footer">
											<button type="button" class="btn btn-default streamer-details-items-edit-art-cancel">Cancel</button>
										    <button type="button" class="btn btn-global streamer-details-items-edit-art-submit">Submit</button>
										</div>
									</div>				
								@endif
								@if ($musicDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-music">
										<h5 class="streamer-about-item-heading">Music</h5>
										@if ($user->id === Auth::user()->id)
											<span class="streamer-about-item-edit about-item-edit-music"><i class="fa fa-pencil"></i></span>
										@endif
										<div class="streamer-about-item-content">
										@foreach ($musicDetails as $music)
											<p>{{ $music }}</p>
										@endforeach	
										</div>
									</div>
									<div class="streamer-details-item-edit about-item-music">
										<h5 class="streamer-about-item-heading-edit">Music</h5>
										<form class="streamer-details-item-edit-form">
											<div class="help-block">Here you can edit your music details</div>
											<div class="streamer-details-form-inputs">
												@foreach ($musicDetails as $music)
													<div class="input-group">
														<input type="text" name="editDetails[music]" value="{{ $music }}"class="form-control input-global"/>
														<span class="input-group-btn remove-input-group">
															<button class="btn btn-default" type="button">
																<span class="glyphicon glyphicon-remove"></span>
															</button>
														</span>
													</div>
												@endforeach	
												<div class="edit-add-more-music">
													<button type="button" class="btn btn-global edit-add-more-music-btn">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<span>Add more</span>
												</div>
											</div>
										</form>
										<div class="streamer-details-item-edit-footer">
											<button type="button" class="btn btn-default streamer-details-items-edit-music-cancel">Cancel</button>
										    <button type="button" class="btn btn-global streamer-details-items-edit-music-submit">Submit</button>
										</div>
									</div>				
								@endif

								@if ($buildingStuffDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-buildingstuff">
										<h5 class="streamer-about-item-heading">Building Stuff</h5>
										@if ($user->id === Auth::user()->id)
											<span class="streamer-about-item-edit about-item-edit-buildingstuff"><i class="fa fa-pencil"></i></span>
										@endif
										<div class="streamer-about-item-content">
										@foreach ($buildingStuffDetails as $buildingStuff)
											<p>{{ $buildingStuff }}</p>
										@endforeach	
										</div>
									</div>
									<div class="streamer-details-item-edit about-item-buildingstuff">
										<h5 class="streamer-about-item-heading-edit">Building Stuff</h5>
										<form class="streamer-details-item-edit-form">
											<div class="help-block">Here you can edit what you build</div>
											<div class="streamer-details-form-inputs">
												@foreach ($buildingStuffDetails as $buildingStuff)
													<div class="input-group">
														<input type="text" name="editDetails[buildingstuff]" value="{{ $buildingStuff }}"class="form-control input-global"/>
														<span class="input-group-btn remove-input-group">
															<button class="btn btn-default" type="button">
																<span class="glyphicon glyphicon-remove"></span>
															</button>
														</span>
													</div>
												@endforeach	
												<div class="edit-add-more-buildingstuff">
													<button type="button" class="btn btn-global edit-add-more-buildingstuff-btn">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<span>Add more</span>
												</div>
											</div>
										</form>
										<div class="streamer-details-item-edit-footer">
											<button type="button" class="btn btn-default streamer-details-items-edit-buildingstuff-cancel">Cancel</button>
										    <button type="button" class="btn btn-global streamer-details-items-edit-buildingstuff-submit">Submit</button>
										</div>
									</div>				
								@endif

								@if ($educationalDetails)
									<div class="streamer-about-item-wrapper about-item-wrapper-educational">
										<h5 class="streamer-about-item-heading">Educational</h5>
										@if ($user->id === Auth::user()->id)
											<span class="streamer-about-item-edit about-item-edit-educational"><i class="fa fa-pencil"></i></span>
										@endif
										<div class="streamer-about-item-content">
										@foreach ($educationalDetails as $educational)
											<p>{{ $educational }}</p>
										@endforeach	
										</div>
									</div>
									<div class="streamer-details-item-edit about-item-educational">
										<h5 class="streamer-about-item-heading-edit">Educational</h5>
										<form class="streamer-details-item-edit-form">
											<div class="help-block">Here you can edit which topics you like</div>
											<div class="streamer-details-form-inputs">
												@foreach ($educationalDetails as $educational)
													<div class="input-group">
														<input type="text" name="editDetails[educational]" value="{{ $educational }}"class="form-control input-global"/>
														<span class="input-group-btn remove-input-group">
															<button class="btn btn-default" type="button">
																<span class="glyphicon glyphicon-remove"></span>
															</button>
														</span>
													</div>
												@endforeach	
												<div class="edit-add-more-educational">
													<button type="button" class="btn btn-global edit-add-more-educational-btn">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<span>Add more</span>
												</div>
											</div>
										</form>
										<div class="streamer-details-item-edit-footer">
											<button type="button" class="btn btn-default streamer-details-items-edit-educational-cancel">Cancel</button>
										    <button type="button" class="btn btn-global streamer-details-items-edit-educational-submit">Submit</button>
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



<!-------------------------------------------------->						
			<!-- LIST OF FOLLOWING PANEL -->		
<!-------------------------------------------------->						
				
				<div class="streamer-content-panel streamer-connections-panel">
					@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
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

				<div class="streamer-content-panel streamer-followers-panel">
					@if (Auth::user()->isFollowing($user) || Auth::user()->id === $user->id)
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
                var pusher = new Pusher('{{ getenv('PUSHER_KEY') }}', {
			      encrypted: true
			    });
	            var channel = pusher.subscribe('newMessage');
	          	channel.bind('Yeayurdev\\Events\\UserHasPostedMessage', function(data) {
	          	console.log(data);
	          	$profileId = $('#user_id').text();

	          	if ($profileId == data.message.id) {

					var div = [
	'					<div class="streamer-feed-post">',
	'						<span class="delete-post">',
	'							<i class="fa fa-times-circle-o"></i>',
	'						</span>',
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
	'						<div class="streamer-post-footer">',
	'							<div class="post-like-count">',
	'								<span><i class="fa fa-smile-o post-like-count-img"></i>0</span>',
	'							</div>',
	'							<div class="edit-info edit-info-post">Edit Post</div>',
	'							<div id="post-id" class="hidden">'+data.message.postid+'</div>',
	'						</div>',
	'					</div>'
					].join('');
		          $(div).insertAfter('.feed-post');
	          	}
	          });

				/*Submit post when the 'Enter' key is pressed.*/

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
					var body = $('.feed-post-input').val();
					var profileId = $('#user_id').text();
                    
					/*Remove any existing error messages from previous post submissions.*/

                	$(this).find('.post-error-msg').remove();

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
                			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
                			/*Show error message then fadeout after 2 seconds.*/
                			$(errorsAppend).insertAfter('.btn-bar-post').delay(2000).fadeOut();
                		}
        			});

        			/*Remove content in textarea after submission.*/

                	$('.feed-post-input').val('');
                });
			});
	    </script>
    <script src="{{ asset('js/streamercategories.js') }}"></script>
    <script src="{{ asset('js/editprofile.js') }}"></script>
    <script src="{{ asset('js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>
	<div id="user_id" style="display:none;">{{$user->id}}</div>	
@stop