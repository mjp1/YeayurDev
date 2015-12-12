@extends('templates.default')

@section('content')
<!-------------------------------------------------->						
			<!-- TWITCH STREAM EMBED -->		
<!-------------------------------------------------->						

		<div class="stream-embed">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe id="player" type="text/html" src="http://www.twitch.tv/{{ $user->getUsername() }}/embed" target="_blank" frameborder="0"></iframe>
			</div>
			<div class="streamer-rate-click">
				<span class="rate-me">Rate Me!</span><span class="stream-rate"></span>
				<span class="rate-conf">Thanks for rating me!</span>
			</div>
			
		</div>

<!-------------------------------------------------->						
	<!-- MAIN STREAMER INFO AND FEED SECTION -->		
<!-------------------------------------------------->						

		<div class="info-body">
			<div class="col-sm-4">
				<div class="streamer-info well ">
					<div class="streamer-pic pic-responsive">
						<img src="{{ asset('images/profile-pic.jpg') }}" />
					</div>
					<div class="streamer-id">
						<h3 class="streamer-name">{{ $user->getUsername() }}
							<button class="btn btn-default btn-add" title="Become a fan!"><span class="glyphicon glyphicon-plus"></span></button>
							<button class="btn btn-default btn-remove" title="Quit following streamer"><span class="glyphicon glyphicon-minus"></span></button>
						</h3>
					</div>

					<!-------------------------------------------------->						
								<!-- STREAMER RATING -->		
					<!-------------------------------------------------->						
					
					<div class="stream-rate-read"></div><span class="rate-count">(3)</span>
					
					<!-------------------------------------------------->						
								<!-- STREAMER FANS -->		
					<!-------------------------------------------------->						
					<div class="streamer-conn">
						<i class="fa fa-heart" title="Number of fans"></i>
						<span class="fan-count">1,421</span>
					</div>
					<!-------------------------------------------------->						
								<!-- ABOUT ME SECTION -->		
					<!-------------------------------------------------->						

					<h4 class="about-me">About Me:</h4>
					<span class="aboutme-text">I am so awesome, you need to fan me! I stream all the time and constantly connect with my fans. My fans are everything!!! I really appreciate the support!</span>
					</br>
					<h4>Streamer Style</h4>
					<div class="s-style-ul">
						<ul>
							<li>Competitive</li>
							<li>Strategic</li>
						</ul>
					</div>

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
			<!-- LIST OF CONNECTIONS PANEL -->		
<!-------------------------------------------------->						
			
				<div class="container streamer-content-panel streamer-connections-panel">
					<h4 style="margin-top:0px;">Connections</h4>
					<div class="streamer-list">
						<div class="streamer-list-item-wrapper">
							<div class="streamer-list-item">
								<div class="streamer-list-item-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
								<div class="streamer-list-item-name"><a href="">MPierce486</a></div>
								<div class="dropdown navbar-right streamer-list-item-options">
									<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
									<ul class="dropdown-menu streamer-list-item-options-menu">
										</li>Remove</li>
									</ul>
								</div>
							</div>
							<div class="streamer-list-item">
								<div class="streamer-list-item-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
								<div class="streamer-list-item-name"><a href="">MPierce486</a></div>
								<div class="dropdown navbar-right streamer-list-item-options">
									<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
									<ul class="dropdown-menu streamer-list-item-options-menu">
										</li>Remove</li>
									</ul>
								</div>
							</div>
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
							<div class="streamer-list-item">
								<div class="streamer-list-item-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
								<div class="streamer-list-item-name"><a href="">MPierce486</a></div>
								<div class="dropdown navbar-right streamer-list-item-options">
									<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
									<ul class="dropdown-menu streamer-list-item-options-menu">
										</li>Remove</li>
									</ul>
								</div>
							</div>
							<div class="streamer-list-item">
								<div class="streamer-list-item-img"><img src="{{ asset('images/profile-pic.jpg') }}"/></div>
								<div class="streamer-list-item-name"><a href="">MPierce486</a></div>
								<div class="dropdown navbar-right streamer-list-item-options">
									<span class="glyphicon glyphicon-option-horizontal streamer-list-item-options dropdown-toggle" data-toggle="dropdown"></span>
									<ul class="dropdown-menu streamer-list-item-options-menu">
										</li>Remove</li>
									</ul>
								</div>
							</div>
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
				
					<div class="feed-post form-group" style="margin-top:50px;">
						<textarea class="form-control feed-post-input" rows="2" placeholder="Post something..."></textarea>
						<div class="btn-bar">
							<button type="button" class="btn btn-default btn-img btn-post" title="Attach an image"><span class="glyphicon glyphicon-picture"></span></button>
							<input type="file" id="img-upload" style="display:none"/>
							<button type="button" class="btn btn-default btn-post" title="Post your message"><span class="glyphicon glyphicon-ok"></span></button>
						</div>
					</div>
				
<!-------------------------------------------------->						
			<!-- FEED CONTENT SECTION -->		
<!-------------------------------------------------->						
				
					<!--Example array for angularJS implementation, will replace with php file-->
					<!--Won't run with above angularJS example, need to update-->
					<div ng-app="">
					
						<div class="streamer-feed-post" ng-repeat="x in posts">
							<div class="streamer-post-pic pic-responsive">
								<img src="{{ asset('images/profile-pic.jpg') }}" />
							</div>
							<div class="streamer-post-id">
								<h4 class="streamer-post-name"></h4>
								<span class="post-time"></span>
							</div>
							<div class="streamer-post-message">
								<div class="message-content">
									<span></span>
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
							
							<div class="feed-reply-panel">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@stop