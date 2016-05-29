$(document).ready(function(){

	/*Show panel with "panel-target" class*/
	$('.panel-target').show();

	//===================================================
	//		AJAX REQUEST TO CONFIRM/DELETE NOTIFICATIONS
	//===================================================

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});	

	// AJAX script to confirm all notifications were viewed
	$('.user-notifications-bell').click(function(e){
		e.preventDefault();
		//Change notification count back to zero
		$('#user-notifications-count').html("0");
		$userUsername = $('.user-username').text();
		$.ajax({
    		type: "POST",
    		url: "/"+$userUsername+"/notifications/confirm",
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    		}
		});
	});

	$('.notification').mouseenter(function(){
		$(this).find('.remove-notification').show();
	});

	$('.notification').mouseleave(function(){
		$(this).find('.remove-notification').hide();
	});

	// AJAX script to delete individual notification from table
	$('.remove-notification').click(function(e){
		e.preventDefault();
		$userUsername = $('.user-username').text();
		$notificationId = $(this).parent().siblings('.notification-id').text();
		$.ajax({
    		type: "POST",
    		url: "/"+$userUsername+"/notifications/delete/"+$notificationId,
    		data: $notificationId,
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    		},
    		success: function(data){
				/*Remove notification from DOM. Check to see if there is only 1 notification and add
				  status message if there is. Otherwise, just remove the notification from the DOM.*/
				if ($('.user-notification-item').size() == 1)
				{
					$('.notification-id:contains("'+$notificationId+'")').parent().fadeOut("fast", function(){
						$(this).remove();
						$('.user-notifications-list').append('<li class="no-notifications">You have no notifications</li>');
					});	
					
				} else {
					$('.notification-id:contains("'+$notificationId+'")').parent().fadeOut("fast", function(){
						$(this).remove();
					});
				}


				
    		}
		});
	});

	//AJAX script to delete all notifications for Auth user
	$('.clear-notifications').click(function(e){
		e.preventDefault();

		$.ajax({
    		type: "POST",
    		url: "/notifications/delete/all",
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    		},
    		success: function(data){
    			$('.user-notification-item').fadeOut("fast", function(){
					$('.user-notification-item').remove();
					
				});

				if ($('.user-notification-item').size() > 0)
				{
					$('.user-notifications-list').delay(3000).append('<li class="no-notifications">You have no notifications</li>');	
				}
    		}
		});
	});

	//===================================================
	//		MENU TO IMPORT STREAM
	//===================================================

	// Show or hide menu

	$('.setup-box-header').click(function() {
		if ($('.setup-box-body').hasClass('show'))
		{
			$('.setup-box-body').slideUp();
			$('.setup-box-body').removeClass('show');
		} else {
			$('.setup-box-body').slideToggle();
		}

		if ($('.box-minimize').hasClass('fa-rotate-180'))
		{
			$('.box-minimize').removeClass('fa-rotate-180');
		} else {
			$('.box-minimize').addClass('fa-rotate-180');
		}
	});

	// Add input box when "Embed Stream" button clicked

	$('.embed-stream').click(function(){
		$('.embed-stream-form').slideToggle();
	});

	//===================================================
	//		COMMENT BOX SLIDE FUNCTIONALITY
	//===================================================

	$('.comment-box-tab').on('click', function() {
		$('.comment-box').toggleClass('slider');
	});

	// SHOW STREAMER FEED PANEL ON LOAD
	$('.streamer-feed-panel').show();

	//===================================================
	//		BOOTSTRAP TOOLTIP FUNCTIONALITY
	//===================================================

	$('[data-toggle="tooltip"]').tooltip();

	//===================================================
	//		STREAMER FEED HEADER NAV CLICK EVENTS
	//===================================================

	$('.streamer-feed-header-nav-btn-feed').on('click',function($e){
		$e.preventDefault();
		$('.streamer-content-panel').hide();
		$('.streamer-feed-panel').show();
	});
	
	$('.streamer-feed-header-nav-btn-connections').on('click',function($e){
		$e.preventDefault();
		$('.streamer-content-panel').hide();
		$('.streamer-connections-panel').show();
		$('.post-error-msg').remove();
	});
		
	//===================================================
	//		STREAMER LIST ITEMS HOVER EVENT
	//===================================================

	$('.streamer-list-item').mouseenter(function(){
		$(this).find('.streamer-list-item-options').show();
	});
	
	$('.streamer-list-item').mouseleave(function(){
		$(this).find('.streamer-list-item-options').hide();
	});
	
	
		
	//===================================================
	//		AJAX SCRIPT TO LIKE POSTS
	//===================================================
	
		$(document).on('click', '.post-like', function(e){
			e.preventDefault();

			var postId = $(this).parent().find('.post-id').text();

			$.ajax({
	    		type: "POST",
	    		url: "/post/"+postId+"/like",
	    		data: postId,
	    		error: function(data){
	    			/*Retrieve errors and append any error messages.*/
	    			var errors = $.parseJSON(data.responseText);
	    			console.log(errors);
	    		},
	    		success: function(data) {
	    			var unlike = [
	    				'<div class="post-unlike">',
	    					'<a href="#" class="post-unlike-a">Unlike</a>',
    					'</div>'
					].join('');

    				$('.post-id:contains('+postId+')').parent().find('.post-like').remove();

	    			var likes = $('.post-id:contains('+postId+')').parent().find('.like-number').text();
	    			var likes = parseInt(likes)+1;

	    			$('.post-id:contains('+postId+')').parent().find('.like-number').text(likes);

	    			$(unlike).fadeIn(function(){
						$(unlike).insertAfter($('.post-id:contains('+postId+')').parent().find('.post-like-count'));
	    			});
	    			
	    		}
			});
		});

	//===================================================
	//		AJAX SCRIPT TO UNLIKE POSTS
	//===================================================
	
		$(document).on('click', '.post-unlike', function(e){
			e.preventDefault();

			var postId = $(this).parent().find('.post-id').text();

			$.ajax({
	    		type: "POST",
	    		url: "/post/"+postId+"/unlike",
	    		data: postId,
	    		error: function(data){
	    			/*Retrieve errors and append any error messages.*/
	    			var errors = $.parseJSON(data.responseText);
	    			console.log(errors);
	    		},
	    		success: function(data) {
	    			var like = [
	    				'<div class="post-like">',
	    					'<a href="#" class="post-like-a">Like</a>',
    					'</div>'
					].join('');

    				$('.post-id:contains('+postId+')').parent().find('.post-unlike').remove();

	    			var likes = $('.post-id:contains('+postId+')').parent().find('.like-number').text();
	    			var likes = parseInt(likes)-1;

	    			$('.post-id:contains('+postId+')').parent().find('.like-number').text(likes);

	    			$(like).fadeIn(function(){
						$(like).insertAfter($('.post-id:contains('+postId+')').parent().find('.post-like-count'));
	    			});
	    			
	    		}
			});
		});
	
	//===================================================
	//		EDIT PROFILE INPUTS VALUE RESET
	//===================================================
	
	// Clear edit profile modal content when not submitted
	$('.btn-close').on('click', function(){
		$('.input-email').val('');
		$('.input-password').val('');
		$('.about-text').val('');
		$('.input-pic').val('');
	});
	
	//===================================================
	//		WELCOME MODAL FOR NEW USERS
	//===================================================
	
	// Welcome modal for new users
	
	$('#welcomeModal').modal('show');
	
	$('.wM-btn-gotoprof').on('click',function(){
		$('#welcomeModal').modal('hide');
		$('#profsetupModal').modal('show');
	});
	
	$('.btn-begin-tour').on('click',function(){
		$('#welcomeModal').modal('hide');
		tour.start();
	});
	
	//===================================================
	//		STREAMER UPDATE CLEAR FUNCTIONALITY
	//===================================================
	
	// Remove all streamer updates
	$('.notif-head-clearall').on('click',function(){
		$('.streamer-updates').find('.notif-updates').remove();
		$('.streamer-updates-none').show();
	});
	
	// Show X button on hover event
	$('.notif-updates').mouseenter(function(){
		$(this).find('.streamer-update-remove').show();
	});
	
	$('.notif-updates').mouseleave(function(){
		$(this).find('.streamer-update-remove').hide();
	});
	
	// Remove individual streamer update block
	$('.streamer-update-remove').on('click',function(){
		$(this).parent().remove();
		
		// Display no update message if all are cleared
		if ($('.notif-updates').length == 0) {
			$('.streamer-updates-none').show();
		}	
		return false;
	});
	
	//===================================================
	//		UPLOAD IMAGE TO FEED FUNCTIONALITY
	//===================================================
	
	// Trigger event for imaging post in feed section
	
	$('.btn-img').on('click',function(){
		$('#img-upload').val('');
		$('#img-upload').trigger('click');
	});

	//===================================================
	//		BOOTSTRAP TOUR PLUGIN
	//===================================================
	
	// Instance the tour
	var tour = new Tour({
		steps: [
			{
				element: ".setup-box",
				title: "Embed Stream",
				content: "Select this menu to embed your stream from Twitch or YouTube!",
				placement: "bottom",
			},
			{
				element: ".streamer-info",
				title: "About Me",
				content: "This is where we display your username, picture, number of followers, and a quick bio. Hover over those sections to edit the content!",
				placement: "bottom",
			},
			{
				element: ".streamer-feed",
				title: "Activity Feed",
				content: "This is where you can post content to notify other users what you're up to. For example, let everyone know when your stream goes live!",
				placement: "bottom",
			},
			{
				element: ".btn-bar",
				title: "Activity Tabs",
				content: "Each of these tabs shows different information. Such as your activity feed, extra details about yourself, your followers and who you're following.",
				placement: "bottom",
				onShown: function(tour) {
				    $('.tour-tour-3').css("top", "175px");
				},
			},
			{
				element: ".head-search-input",
				title: "Search",
				content: "Search for other users in the Yeayur community or click the Yeayur icon to go back to the main page.",
				placement: "bottom",
				onShown: function(tour) {
				    $('.tour-step-backdrop').closest(".nav").addClass("tour-step-backdrop-parent").css("z-index", "1101");
				    $('.tour-step-backdrop').closest(".navbar").addClass("tour-step-backdrop-parent").css("z-index", "1101");
				},
				onHidden: function(tour) {
					$('.tour-step-backdrop-parent').removeClass("tour-step-backdrop-parent").css("z-index", "");
				},
				    
			},
			{
				element: ".navbar-right-name",
				title: "Menu Options",
				content: "These icons are available no matter where you're at. You can go back to your profile, contact us with any questions, or edit your account details.",
				placement: "left",
				onShown: function(tour) {
				    $('.tour-step-backdrop').closest(".nav").addClass("tour-step-backdrop-parent").css("z-index", "1101");
				    $('.tour-step-backdrop').closest(".navbar").addClass("tour-step-backdrop-parent").css("z-index", "1101");
				    $('.tour-step-backdrop').css("position", "absolute");
				},
				onHidden: function(tour) {
					$('.tour-step-backdrop-parent').removeClass("tour-step-backdrop-parent").css("z-index", "");
				},
			}
		],
		backdrop: true,
		
		storage: false,
	});

	// Initialize the tour
	tour.init();

	$('.begin-tour').click(function() {
		// Start the tour
		tour.start();
	});
	
	$('.public-btn-add, .post-like-public').click(function(){
		$('.modal-signin-redirect').modal('show');
	});

	
	
});