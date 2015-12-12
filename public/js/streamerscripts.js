$(document).ready(function(){

	// SHOW STREAMER FEED PANEL ON LOAD
	$('.streamer-feed-panel').show();

	//===================================================
	//		STREAMER FEED HEADER NAV CLICK EVENTS
	//===================================================

	$('.streamer-feed-header-nav-btn-feed').on('click',function(){
		$('.streamer-content-panel').hide();
		$('.streamer-feed-panel').show();
	});
	
	$('.streamer-feed-header-nav-btn-connections').on('click',function(){
		$('.streamer-content-panel').hide();
		$('.streamer-connections-panel').show();
	});
	
	$('.streamer-feed-header-nav-btn-followers').on('click',function(){
		$('.streamer-content-panel').hide();
		$('.streamer-followers-panel').show();
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
	//		RATY.JS PLUGIN FUNCTIONALITY
	//===================================================
	
	
	
	//===================================================
	//		RATY.JS PLUGIN FUNCTIONALITY
	//===================================================
	
	// Raty js plugin
	$('.stream-rate').on('click',function(){
		$('.rate-me,.stream-rate').hide();
		$('.rate-conf').fadeIn(800);
		$('.rate-conf').fadeOut(800);
	});
	
	$('.stream-rate-read').raty({
		readOnly:true,
		score:3
	});
	
	$('.stream-rate').raty({
		readOnly:false,
		
	});
	
		
	//===================================================
	//		        CHANGE PASSWORD MODAL 
	//===================================================
	
	$('.btn-password').on('click',function(){
		$('#editprofModal').modal('hide');
	});
	
	// Clear inputs if cancelled
	$('.pass-change-cancel').on('click',function(){
		$('.change-pass-input').val('');
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
	//		FAN BUTTON FUNCTIONALITY
	//===================================================
	
	// Fan added notification
	$('.btn-add').on('click',function(){
		$(this).hide();
		$('.btn-remove').show();
	});
	
	// Fan removed notification
	$('.btn-remove').on('click',function(){
		$(this).hide();
		$('.btn-add').show();
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
	
	$('.btn-img, .btn-img-reply').on('click',function(){
		$('#img-upload').trigger('click');
	});

	//===================================================
	//		REPLY ON FEED FUNCTIONALITY
	//===================================================
	
	// Feed section reply click event
	
	$('.post-reply,.post-reply-reply').on('click', function(){
		$(this).parent().find('textarea,.btn-bar-reply').show();
	});
	
	$('.btn-cancel-reply').on('click',function(){
		$(this).parent().parent().find('textarea, .btn-bar-reply').hide();
		$(this).parent().parent().find('textarea').val('');
	});
	
	//===================================================
	//		SHEPHERD TOUR PLUGIN
	//===================================================
	
	// Shepherd Tour initialize
	var tour = new Shepherd.Tour({
	  defaults: {
		classes: 'shepherd-theme-arrows',
		scrollTo: true
	  }
	});
	 
	tour.addStep('Stream', {
	  title: 'Stream',
	  text: 'Fans can view your Twitch stream right on your profile page!',
	  attachTo: '.stream-embed bottom',
	  classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
	buttons: [
		{
		  text: 'Next',
		  action: tour.next,
		  classes: 'shepherd-button-example-primary'
		},{
		  text: 'Exit',
		  classes: 'shepherd-button-secondary',
		  action: function() {
			return tour.hide();
		  }
		} 
	  ]});
	  
	  tour.addStep('Streamer-Info', {
	  title: 'About You',
	  text: 'Here is where we show your name, rating, number of fans, and bio. Tell your fans about yourself!',
	  attachTo: '.streamer-info top',
	  classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
	buttons: [
		{
		  text: 'Back',
		  action: tour.back,
		  classes: 'shepherd-button-example-primary'
		}, {
		  text: 'Next',
		  action: tour.next,
		  classes: 'shepherd-button-example-primary'
		},{
		  text: 'Exit',
		  classes: 'shepherd-button-secondary',
		  action: function() {
			return tour.hide();
		  }
		} 
	  ]});

	tour.addStep('Streamer-Feed', {
	  title: 'Feed Posts',
	  text: 'You and your fans can communicate by posting on your feed. Be sure to post content to stay in touch with your fans!',
	  attachTo: '.streamer-feed top',
	  classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
	buttons: [
		{
		  text: 'Back',
		  action: tour.back,
		  classes: 'shepherd-button-example-primary'
		}, {
		  text: 'Next',
		  action: tour.next,
		  classes: 'shepherd-button-example-primary'
		},{
		  text: 'Exit',
		  classes: 'shepherd-button-secondary',
		  action: function() {
			return tour.hide();
		  }
		} 
	  ]});
	  
	  tour.addStep('Edit-Profile', {
	  title: 'Edit Profile',
	  text: 'Access your edit profile screen to change certain elements on your profile! You can also moderate disrespectful fans if needed.',
	  attachTo: '.nav-settings bottom',
	  classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text shepherd-theme-dark',
	buttons: [
		{
		  text: 'Back',
		  action: tour.back,
		  classes: 'shepherd-button-example-primary'
		}, {
		  text: 'Next',
		  action: tour.next,
		  classes: 'shepherd-button-example-primary'
		},{
		  text: 'Exit',
		  classes: 'shepherd-button-secondary',
		  action: function() {
			return tour.hide();
		  }
		} 
	  ]});
	  
	  tour.addStep('Search', {
	  title: 'Search',
	  text: 'Search for other users and games or go to the main page and browse streams!',
	  attachTo: '.head-search bottom',
	  classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text shepherd-theme-dark',
	buttons: [
		{
		  text: 'Back',
		  action: tour.back,
		  classes: 'shepherd-button-example-primary'
		}, {
		  text: 'Next',
		  action: tour.next,
		  classes: 'shepherd-button-example-primary'
		},{
		  text: 'Exit',
		  classes: 'shepherd-button-secondary',
		  action: function() {
			return tour.hide();
		  }
		} 
	  ]});

	tour.addStep('Main-Return', {
	  title: 'Back To Main',
	  text: 'Click the Yeayur icon to head back to the main page and view other Streamers!',
	  attachTo: '.navbar-logo bottom',
	  classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
	buttons: [
		{
		  text: 'Back',
		  action: tour.back,
		  classes: 'shepherd-button-example-primary'
		}, {
		  text: 'Exit',
		  classes: 'shepherd-button-secondary',
		  action: function() {
			return tour.hide();
		  }
		} 
	  ]});
	
});