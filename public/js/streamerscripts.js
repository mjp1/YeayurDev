$(document).ready(function(){

	// ADD STYLING IF USER DOESN'T HAVE ANY VIDEO MENU UNDER STREAM
	if ($('.videos').length == 0)
	{
		$('.streamer-media').css('margin-bottom', '20px');
	}

	// MAKE POST FEEDBACK NOTICE VISIBLE WHEN TEXTAREA IS FOCUSED
	$(document).on('click', function() {
		if ($('#postbody').is(':focus'))
		{
			$('.feedback-notice').css('display', 'block');
		} else {
			$('.feedback-notice').css('display', 'none');
		}
	});

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

	// AJAX script to delete individual notification
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
	//		BOOTSTRAP TOOLTIP FUNCTIONALITY
	//===================================================

	$('[data-toggle="tooltip"]').tooltip();
		
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

	//===================================================
	//		TINYMCE EDITOR 
	//===================================================

	// Streamer Details Editor

	// show form if form has error
		if ($('#streamer-details-form').find('.help-block').length > 0)
		{
			$('#streamer-details-form').addClass('has-error');
			$('#streamer-details-form').show();
			$('.add-streamer-details').hide();
		}

		$('.add-streamer-details').click(function() {
			$(this).hide();
			$('.streamer-details-content').hide();
			$('#streamer-details-form').show();
		});

		// Show streamer-details-edit icon on hover
		$('.streamer-about-panel').hover(function() {
			$('.streamer-details-edit').show();
		}, function(){
			$('.streamer-details-edit').hide();
		});

		$('.streamer-details-edit').click(function() {
			tinymce.get('streamer-details-input').setContent($('.streamer-details-content').html());
			$(this).hide();
			$('.streamer-details-content').hide();
			$('#streamer-details-form').show();
		});

		$('.streamer-details-input-cancel').click(function(e) {
			e.preventDefault();
			$('#streamer-details-form').hide();
			$('.streamer-details-content').show();
			$('.add-streamer-details').show();
			$('.streamer-details-edit').show();
		});

	// Streamer Discussion Editor

		if ($('#fan-page-form').hasClass('has-error'))
		{
			$('.fan-page-body-content').hide();
			$('#fan-page-form').show();
		}

		$('.body-content-edit').click(function() {
			$('.fan-page-body-content').hide();
			$('#fan-page-form').fadeIn();

			var fanContent = $('.fan-page-body-content').html();
			tinymce.get('fan-page-input').setContent(fanContent);
		});

		$('.fan-page-form-btn-cancel').click(function() {
			$('#fan-page-form').hide();
			$('.fan-page-body-content').fadeIn();
		});

	//===================================================
	//		ABOUT ME EDIT BOX 
	//===================================================

		// show form if errors
		if ($('#streamer-about-me-form').find('.help-block').length > 0)
		{
			$('#streamer-about-me-form').addClass('has-error');
			$('#streamer-about-me-input').val($('.aboutme-text').text());
			$('#streamer-about-me-form').show();
		}

		$('.btn-add-bio').click(function() {
			$(this).hide();
			$('.edit-info-about').hide();
			$('#streamer-about-me-form').show();
		});

		$('.streamer-about-me-input-cancel').click(function(e) {
			e.preventDefault();
			$('#streamer-about-me-form').hide();
			$('.btn-add-bio').show();
			$('.edit-info-about').show();
			$('.aboutme-text').show();
		});

		$('.edit-info-about').click(function() {
			$(this).hide();
			$('.aboutme-text').hide();
			$('#streamer-about-me-input').val($('.aboutme-text').text());
			$('#streamer-about-me-form').show();
		});
	
	//===================================================
	//		REPLY TO POST FUNCTIONALITY
	//===================================================

	// SHOW REPLY FORM ON CLICK
	$('.post-reply-button').click(function() {
		$(this).parent().siblings('.streamer-post-reply-input').toggle();
	});

	$('#replyForm').submit(function(e) {
		e.preventDefault();

		var postId = $(this).parent().siblings().find('.post-id').text();
		var replyBody = $(this).find('#replybody').val();

		$.ajax({
			type: "POST",
			url: "/post/"+postId+"/reply",
			data: {postId:postId, replyBody:replyBody},
			error: function(data) {
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				var errors = errors.replyBody[0];
				var errorsAppend = '<p class="text-danger post-error-msg">'+errors+'</p>';
				/*Show error message then fadeout after 2 seconds.*/
				$(errorsAppend).insertAfter('#replybody').delay(2000).fadeOut();
			},
			success: function(data) {
				location.reload();
			}
		});
	});

	//===================================================
	//		VOTE ON POST FUNCTIONALITY
	//===================================================

	$('.vote-up').click(function(e) {
		e.preventDefault();

		var postId = $(this).parent().siblings('.streamer-post-footer').find('.post-id').text();

		$.ajax({
			type: "POST",
			url: "/post/"+postId+"/upvote",
			data: {postId:postId},
			error: function(data) {
				console.log(data);
			},
			success: function(data) {
				if (data == "You can only upvote once!")
				{
					var upVoteAlert = '<span class="vote-alert">You can only upvote once!</span>';

					$(upVoteAlert).insertAfter($('.post-id:contains('+postId+')').parent().siblings('.streamer-post-vote')).delay(1500);
					$('.vote-alert').fadeOut(function() {
						$('.vote-alert').remove();
					});
				} else {
					var voteCount = data.count;
					$('.post-id:contains('+postId+')').parent().siblings('.streamer-post-vote').find('.vote-count').text(voteCount);
				}
			}
		});
	});

	$('.vote-down').click(function(e) {
		e.preventDefault();

		var postId = $(this).parent().siblings('.streamer-post-footer').find('.post-id').text();

		$.ajax({
			type: "POST",
			url: "/post/"+postId+"/downvote",
			data: {postId:postId},
			error: function(data) {
				console.log(data);
			},
			success: function(data) {
				if (data == "You can only downvote once!")
				{
					var downVoteAlert = '<span class="vote-alert">You can only downvote once!</span>';

					$(downVoteAlert).insertAfter($('.post-id:contains('+postId+')').parent().siblings('.streamer-post-vote')).delay(1500);
					$('.vote-alert').fadeOut(function() {
						$('.vote-alert').remove();
					});
				} else {
					var voteCount = data.count;
					$('.post-id:contains('+postId+')').parent().siblings('.streamer-post-vote').find('.vote-count').text(voteCount);
				}
			}
		});
	});
});