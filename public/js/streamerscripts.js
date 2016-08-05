$(document).ready(function(){

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

	$(document).on('mouseenter', '.notification', function() {
		$(this).find('.remove-notification').show();
	});

	$(document).on('mouseleave', '.notification', function() {
		$(this).find('.remove-notification').hide();
	});

	// AJAX script to delete individual notification
	$(document).on('click', '.remove-notification', function(e){
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
				element: ".streamer-info",
				title: "About Me",
				content: "This is where we display your username, picture, number of followers, and a quick bio. Hover over those sections to edit the content.",
				placement: "bottom",
			},
			{
				element: ".streamer-about-panel",
				title: "Streamer Details",
				content: "This is where you can add more detail about what you stream and when.",
				placement: "bottom",
			},
			{
				element: ".videos",
				title: "Videos",
				content: "We will show your 5 most recent videos saved to your Twitch profile. This helps users watch your stream when you are not live.",
				placement: "bottom",
			},
			{
				element: ".streamer-tags",
				title: "Streamer Tags",
				content: "Users can add tags to your profile which describe you as a streamer. You cannot add or edit your own tags.",
				placement: "top",
			},
			{
				element: ".streamer-feed",
				title: "Feedback Board",
				content: "This is where other users will post feedback for you. You are only able to reply to previous feedback left by other users.",
				placement: "bottom",
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
			$('#streamer-details-form').removeClass('has-error');
			$('#streamer-details-form').find('.help-block').remove();
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
			$('.btn-add-bio').hide();
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
			$('#streamer-about-me-form').removeClass('has-error');
			$('#streamer-about-me-form').find('.help-block').remove();
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
	//		FOLLOWING / FOLLOWERS MODAL 
	//===================================================

	// Make following tab be active when modal is activated
	$('.streamer-conn').click(function() {
		$('.connections-modal-nav-following').css({"background-color" : "#e6e6e6", "border-color" : "#adadad"});
	});

	$('.connections-modal-nav-following').click(function() {
		$('.connections-modal-nav-followers, .connections-modal-nav-fan-pages').css({"background-color" : "#fff", "border-color" : "#e3e3e3"});
		$(this).css({"background-color" : "#e6e6e6", "border-color" : "#adadad"});
		$('.connections-followers, .connections-fan-pages').hide();
		$('.connections-following').show();
	});

	$('.connections-modal-nav-followers').click(function() {
		$('.connections-modal-nav-following, .connections-modal-nav-fan-pages').css({"background-color" : "#fff", "border-color" : "#e3e3e3"});
		$(this).css({"background-color" : "#e6e6e6", "border-color" : "#adadad"});
		$('.connections-following, .connections-fan-pages').hide()
		$('.connections-followers').show();
	});

	$('.connections-modal-nav-fan-pages').click(function() {
		$('.connections-modal-nav-following, .connections-modal-nav-followers').css({"background-color" : "#fff", "border-color" : "#e3e3e3"});
		$(this).css({"background-color" : "#e6e6e6", "border-color" : "#adadad"});
		$('.connections-following, .connections-followers').hide()
		$('.connections-fan-pages').show();
	});

	// Adjust width of li elements depending on how many
	var width = (100 / $('.connections-modal-nav li').size());
	
	$('.connections-modal-nav li').css("width", width + "%");


	

	//===================================================
	//		REPLY TO POST FUNCTIONALITY
	//===================================================

	// SHOW REPLY FORM ON CLICK
	$('.post-reply-button').click(function() {
		$(this).parent().siblings('.streamer-post-reply-input').toggle();

		var replyId = $(this).parent().siblings('.streamer-post-reply-input').find('#replyForm').find('textarea').attr('id');

		tinymce.init({
			selector: '#'+replyId,
			menubar: false,
			force_br_newlines : false,
	    	force_p_newlines : false,
	    	forded_root_block: '',
	    	remove_linebreaks : true,
	    	plugins: "link",
	    	link_assume_external_targets: true,
		});
	});

	$('#replyForm').submit(function(e) {
		e.preventDefault();

		var postId = $(this).closest('.streamer-feed-post').find('.post-id').text();
		var replyBody = tinymce.get($(this).find('textarea').attr('id')).getContent();
		
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
	//		POST MENU OPTIONS
	//===================================================

	// Show or hide edit form
	$('.post-menu-edit').click(function() {

		$(this).closest('.streamer-feed-post').find('.message-content').hide();
		$(this).closest('.streamer-feed-post').find('#editPostForm').show();

		var textareaId = $(this).closest('.streamer-feed-post').find('#editPostForm').find('textarea').attr('id');

		tinymce.init({
			selector: '#'+textareaId,
			menubar: false,
			force_br_newlines : false,
	    	force_p_newlines : false,
	    	forded_root_block: '',
	    	remove_linebreaks : true,
	    	plugins: "link",
	    	link_assume_external_targets: true,
		});
		
		var message = $(this).closest('.streamer-feed-post').find('.message-content').html();
		tinymce.get(textareaId).setContent(message);
	});

	$('.edit-cancel').click(function(e) {
		e.preventDefault();

		$(this).closest('.streamer-feed-post').find('.message-content').show();
		$(this).closest('.streamer-feed-post').find('#editPostForm').hide();
	});

	// Edit post AJAX
	$('#editPostForm').submit(function(e) {
		e.preventDefault();

		var body = tinymce.get($(this).find('textarea').attr('id')).getContent();
		var postId = $(this).parent('.streamer-post-message').siblings('.streamer-post-footer').find('.post-id').text();
		
		/*Remove any existing error messages from previous post submissions.*/

		$(this).find('.post-error-msg').remove();

		/*Stop focus on the textarea.*/

		$('#editPostForm').blur();

		/*Submit form via AJAX*/

		$.ajax({
			type: "POST",
			url: "/post/edit/"+postId,
			data: {editpost:body, postId:postId},
			error: function(data){
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				var errors = errors.editpost[0];
				var errorsAppend = '<p class="text-danger post-error-msg">'+errors+'</p>';
				/*Show error message then fadeout after 2 seconds.*/
				$(errorsAppend).insertAfter('#editPostForm').delay(2000).fadeOut();
			},
			success: function(data) {
				location.reload();
			},
		});
	});


	// Delete post AJAX
	$('.post-menu-delete').click(function() {
		var postId = $(this).closest('.streamer-post-footer').find('.post-id').text();
		
		swal({
			title: "Are you sure you want to delete this post?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#cc3300",
			confirmButtonText: "Delete",
		},
		function(){
			$.ajax({
				type: "POST",
				url: "/post/delete/"+postId,
				data: {postId:postId},
				error: function(data){
					location.reload();
				},
				success: function(data) {
					location.reload();
				},
			});	
		});
	});

	$('.post-menu-report').click(function() {
		var postId = $(this).closest('.streamer-post-footer').find('.post-id').text();
		
		swal({
			title: "Are you sure you want to report this post?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#cc3300",
			confirmButtonText: "Delete",
		},
		function(){
			$.ajax({
				type: "POST",
				url: "/post/report/"+postId,
				data: {postId:postId},
				error: function(data){
					location.reload();
				},
				success: function(data) {
					location.reload();
				},
			});	
		});
	});

	//===================================================
	//		REPLY TO REPLY FUNCTIONALITY
	//===================================================

	// SHOW REPLY FORM ON CLICK
	$('.reply-reply-button').click(function() {
		$(this).parent().siblings('.streamer-reply-reply-input').toggle();

		var replyId = $(this).parent().siblings('.streamer-reply-reply-input').find('#replyReplyForm').find('textarea').attr('id');

		tinymce.init({
			selector: '#'+replyId,
			menubar: false,
			force_br_newlines : false,
	    	force_p_newlines : false,
	    	forded_root_block: '',
	    	remove_linebreaks : true,
	    	plugins: "link",
	    	link_assume_external_targets: true,
		});

		var replyUsername = $(this).closest('.feed-reply-panel').find('.reply-user-name').html();
		tinymce.get(replyId).setContent("@"+replyUsername);
	});

	$('.reply-feedback-reply').click(function(e) {
		e.preventDefault();

		// Replies to replies still post under the parent Post record, not the immediate reply it is regarding
		var postId = $(this).closest('.streamer-reply-reply-input').parent().parent().find('.post-id').text();
		var replyBody = tinymce.get($(this).closest('#replyReplyForm').find('textarea').attr('id')).getContent();

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/reply/"+postId+"/reply",
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
	//		REPLY MENU OPTIONS
	//===================================================

	// Show or hide edit form
	$('.reply-menu-edit').click(function() {

		$(this).closest('.feed-reply-panel').find('.reply-message-content').hide();
		$(this).closest('.feed-reply-panel').find('#editReplyForm').show();

		var textareaId = $(this).closest('.feed-reply-panel').find('#editReplyForm').find('textarea').attr('id');

		tinymce.init({
			selector: '#'+textareaId,
			menubar: false,
			force_br_newlines : false,
	    	force_p_newlines : false,
	    	forded_root_block: '',
	    	remove_linebreaks : true,
	    	plugins: "link",
	    	link_assume_external_targets: true,
		});
		
		var message = $(this).closest('.feed-reply-panel').find('.reply-message-content').html();
		tinymce.get(textareaId).setContent(message);
	});

	$('.edit-cancel').click(function(e) {
		e.preventDefault();

		$(this).closest('.feed-reply-panel').find('.reply-message-content').show();
		$(this).closest('.feed-reply-panel').find('#editReplyForm').hide();
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});

	// Edit reply AJAX
	$('.reply-edit-button').click(function(e) {
		e.preventDefault();

		var body = tinymce.get($(this).closest('#editReplyForm').find('textarea').attr('id')).getContent();
		var replyId = $(this).closest('.reply-message').siblings('.streamer-post-footer').find('.reply-id').text();
		
		/*Remove any existing error messages from previous post submissions.*/

		$(this).find('.post-error-msg').remove();

		/*Stop focus on the textarea.*/

		$('#editReplyForm').blur();

		/*Submit form via AJAX*/

		$.ajax({
			type: "POST",
			url: "/reply/edit/"+replyId,
			data: {editreply:body, replyId:replyId},
			error: function(data){
				/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
				var errors = errors.editpost[0];
				var errorsAppend = '<p class="text-danger post-error-msg">'+errors+'</p>';
				/*Show error message then fadeout after 2 seconds.*/
				$(errorsAppend).insertAfter('#editReplyForm').delay(2000).fadeOut();
			},
			success: function(data) {
				location.reload();
			},
		});
	});


	// Delete post AJAX
	$('.reply-menu-delete').click(function() {
		var replyId = $(this).closest('.streamer-post-footer').find('.reply-id').text();
		
		swal({
			title: "Are you sure you want to delete this post?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#cc3300",
			confirmButtonText: "Delete",
		},
		function(){
			$.ajax({
				type: "POST",
				url: "/reply/delete/"+replyId,
				data: {postId:replyId},
				error: function(data){
					location.reload();
				},
				success: function(data) {
					location.reload();
				},
			});	
		});
	});

	$('.reply-menu-report').click(function() {
		var replyId = $(this).closest('.streamer-post-footer').find('.reply-id').text();
		
		swal({
			title: "Are you sure you want to report this post?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#cc3300",
			confirmButtonText: "Delete",
		},
		function(){
			$.ajax({
				type: "POST",
				url: "/post/report/"+replyId,
				data: {postId:replyId},
				error: function(data){
					location.reload();
				},
				success: function(data) {
					location.reload();
				},
			});	
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
				} 

				else if (data == "You cannot vote on your own posts!")
				{
					var upVoteAlert = '<span class="vote-alert">You cannot vote on your own posts!</span>';

					$(upVoteAlert).insertAfter($('.post-id:contains('+postId+')').parent().siblings('.streamer-post-vote')).delay(1500);
					$('.vote-alert').fadeOut(function() {
						$('.vote-alert').remove();
					});
				}

				else {
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
				} 

				else if (data == "You cannot vote on your own posts!")
				{
					var upVoteAlert = '<span class="vote-alert">You cannot vote on your own posts!</span>';

					$(upVoteAlert).insertAfter($('.post-id:contains('+postId+')').parent().siblings('.streamer-post-vote')).delay(1500);
					$('.vote-alert').fadeOut(function() {
						$('.vote-alert').remove();
					});
				}
				
				else {
					var voteCount = data.count;
					$('.post-id:contains('+postId+')').parent().siblings('.streamer-post-vote').find('.vote-count').text(voteCount);
				}
			}
		});
	});

	//===================================================
	//		STREAMER TAGS FUNCTIONALITY
	//===================================================

	// Show tagit input on click
	$('.streamer-tags-edit').click(function() {
		$('.streamer-tags-item-wrapper').hide();
		$('#streamer-tags-form').show();
	});

	$('.streamer-tags-form-cancel').click(function(e) {
		e.preventDefault();
		$('.streamer-tags-item-wrapper').show();
		$('#streamer-tags-form').hide();
	});


	$('#mySingleFieldTags').tagit({
		fieldName: "tags",
		availableTags: [$('#available-tags').text()],
		autocomplete: ({
			minLength: 1,
			delay: 0,
			source: function(request, response) {
				$.ajax({
					method: "GET",
					url: "/profile/tags",
					dataType: "JSON",
					success: function(data) {
						response($.map(data, function(item) {
							return {
								label: item,
								value: item
							}
						}));
					},

				});
			}
		}),

	});

	//===================================================
	//		STREAMER POST NOTIFICATION SETTINGS
	//===================================================

	$('.streamer-post-options-menu>li').click(function() {
		var selection = $(this).find('.selection-text').text();

		$.ajax({
			method: "POST",
			url: "/post/notification",
			data: {selection:selection},
			error: function(data) {
				location.reload();
			},
			success: function(data) {
				var selectionDiv = $('.streamer-post-options-menu').find('.selection-text:contains("'+selection+'")');
				var checkmark = [
					'<span class="streamer-post-options-check"><i class="fa fa-check" aria-hidden="true"></i></span>'
				].join(''); 

				$('.streamer-post-options-check').remove(); // Remove existing checkmarks
				$(checkmark).insertAfter(selectionDiv);	// Add new checkmark to updated selection

			}
		});
	});

});