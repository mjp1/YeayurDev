<nav class="navbar navbar-default navbar-fixed-bottom">
	<div class="container">
		<ul class="list-inline">
			@if (Auth::check())
				<li><a href="{{ route('support') }}">Contact</a></li>
			@else
				<li><a href="{{ route('support.public') }}" target="_blank">Contact</a></li>
			@endif
			<li><a href="{{ route('terms') }}" target="_blank">Terms of Service</a></li>
			<li><a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a></li>
		</ul>
	</div>

	@if (Auth::check())
		<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
		<script src="//cdn.jsdelivr.net/angular.pusher/latest/pusher-angular.min.js"></script>
	    <script>
	        var pusher = new Pusher('{{ getenv('PUSHER_KEY') }}', {
		     	encrypted: true
		    });	    
	    </script>

	    <!-- Subscribe to channels of everyone Auth user is following -->

	    @if (Auth::user()->followingId())
		    @foreach (Auth::user()->followingId() as $followingId)
		    	<script>
		    		var channel = pusher.subscribe('notification.{{ $followingId }}');
		    	</script>
	    	@endforeach
		    <script>
	            channel.bind('Yeayurdev\\Events\\UserNotificationPost', function(data) {
	            	// Don't create realtime notification for Auth user performing the action that creates the notification
	            	if (data.message.username !== "{{ Auth::user()->username }}")
	            	{
	            		var post = [
		            		'<li class="user-notification-item">',
							'<div class="notification">',
							'<span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>',
							'<div class="notification-image">',
							(data.message.image=="" ? '<i class="fa fa-user-secret fa-2x img-circle"></i>' : '<img src="'+data.message.image+'" class="img-circle" alt="#"/>'),
							'</div>',
							'<div class="notification-content"><a href="/'+data.message.username+'">'+data.message.username+'</a> posted new content on <a href="/'+data.message.profile+'">'+data.message.profile+'</a>\'s profile.</div>',
							'<span class="notification-time">'+data.message.time+'</span>',
							'</div>',
							'</li>'
							].join('');

						/*Hide the "No Notifications" status message*/
						$('.no-notifications').hide();

						$(post).insertAfter('.notification-header');

						// Check the number of unviewed notifications and add 1
						var notificationCount = $('#user-notifications-count').text();
						var notificationCount = parseInt(notificationCount)+1;
						$('#user-notifications-count').text(notificationCount);
	            	}
          		});
          		
		    </script>
		    
	    @endif

	    <!-- Subscribe to channels of all fan pages Auth user follows -->

	    @if (Auth::user()->fanPagesId())
		    @foreach (Auth::user()->fanPagesId() as $fanPageId)
		    	<script>
		    		var channel = pusher.subscribe('fanPage.{{ $fanPageId }}');
		    	</script>
	    	@endforeach
		    <script>
	            channel.bind('Yeayurdev\\Events\\FanNotificationPost', function(data) {
	            	if (data.message.username !== "{{ Auth::user()->username }}")
	            	{
	            		var post = [
		            		'<li class="user-notification-item">',
							'<div class="notification">',
							'<span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>',
							'<div class="notification-image">',
							(data.message.image=="" ? '<i class="fa fa-user-secret fa-2x img-circle"></i>' : '<img src="'+data.message.image+'" alt="#"/>'),
							'</div>',
							'<div class="notification-content"><a href="/'+data.message.username+'">'+data.message.username+'</a> posted new content on <a href="/'+data.message.fanPage+'">'+data.message.fanPage+'</a>\'s profile.</div>',
							'<span class="notification-time">'+data.message.time+'</span>',
							'</div>',
							'</li>'
							].join('');

						/*Hide the "No Notifications" status message*/
						$('.no-notifications').hide();

						$(post).insertAfter('.notification-header');

						// Check the number of unviewed notifications and add 1
						var notificationCount = $('#user-notifications-count').text();
						var notificationCount = parseInt(notificationCount)+1;
						$('#user-notifications-count').text(notificationCount);
	            	}
          		});
          		
		    </script>
		    
	    @endif

	    <!-- Subscribe to own channel -->
	    <script>
            var channel = pusher.subscribe('notification.{{ Auth::user()->id }}');

            /*Receive notification when someone follows Auth user*/
            channel.bind('Yeayurdev\\Events\\UserNotificationFollow', function(data) {

            	var follow = [
            		'<li class="user-notification-item">',
					'<div class="notification">',
					'<span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>',
					'<div class="notification-image">',
					(data.message.image=="" ? '<i class="fa fa-user-secret fa-2x img-circle"></i>' : '<img src="'+data.message.image+'" alt="#"/>'),
					'</div>',
					'<div class="notification-content"><a href="/'+data.message.username+'">'+data.message.username+'</a> is following you.</div>',
					'<span class="notification-time">'+data.message.time+'</span>',
					'</div>',
					'</li>'
					].join('');

				/*Hide the "No Notifications" status message*/
				$('.no-notifications').hide();

				$(follow).insertAfter('.notification-header');

				// Check the number of unviewed notifications and add 1
				var notificationCount = $('#user-notifications-count').text();
				var notificationCount = parseInt(notificationCount)+1;
				$('#user-notifications-count').text(notificationCount);
      		});

	    </script>

		<!-- Subscribe to channel of profile Auth user is currently viewing -->

	    @if (Route::current()->getName() === 'profile' && Auth::user()->id !== $user->id)
		    <script>
	            var channel = pusher.subscribe('newMessage.{{ $user->id }}');

	            /*Receive notification when someone posts new message*/
	            channel.bind('Yeayurdev\\Events\\UserHasPostedMessage', function(data) {
	            	console.log(data.message.name);

	            	var authUser = "{{ Auth::user()->username }}";
	            	// Do not show "new post" message for the user that posts the feedback
	            	if (authUser !== data.message.name)
	            	{
						var messageNotice = '<span class="message-notification">New Post</span>';
						// Remove any previous new message notifications
						$('.message-notification').remove();
						// Insert new message notification
						$(messageNotice).insertAfter('#postForm');
	            	}
	      		});
	            // Reload page to view new post
	      		$(document).on('click', '.message-notification', function() {
	      			location.reload();
	      		});

	      		$(document).scroll(function() {
	      			if ($(document).scrollTop() >= 600)
	      			{
	      				$('.message-notification').css({"position": "fixed", "right": "50%", "top": "90px", "left": "auto"});
	      			} else {
	      				$('.message-notification').css({"position": "absolute", "right": "auto", "top": "185px", "left": "45%"});
	      			}
	      		})
			</script>
		@endif

	    @if (Route::current()->getName() === 'fan')
		    <script>
	            var channel = pusher.subscribe('newMessage.{{ $fan->id }}');

	            /*Receive notification when someone posts new message*/
	            channel.bind('Yeayurdev\\Events\\UserHasPostedMessage', function(data) {
	            	console.log(data.message.name);

	            	var authUser = "{{ Auth::user()->username }}";
	            	// Do not show "new post" message for the user that posts the feedback
	            	if (authUser !== data.message.name)
	            	{
						var messageNotice = '<span class="message-notification">New Post</span>';
						// Remove any previous new message notifications
						$('.message-notification').remove();
						// Insert new message notification
						$(messageNotice).insertAfter('#postForm');
	            	}
	      		});
	            // Reload page to view new post
	      		$(document).on('click', '.message-notification', function() {
	      			location.reload();
	      		});

	      		$(document).scroll(function() {
	      			if ($(document).scrollTop() >= 650)
	      			{
	      				$('.message-notification').css({"position": "fixed", "right": "50%", "top": "90px", "left": "auto"});
	      			} else {
	      				$('.message-notification').css({"position": "absolute", "right": "auto", "top": "185px", "left": "45%"});
	      			}
	      		})
			</script>
		@endif		

    @endif


</nav>
