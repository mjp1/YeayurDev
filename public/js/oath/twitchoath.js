$(document).ready(function(){

	<!-- Twitch Javascript SDK -->
	
	Twitch.init({clientId: 'ahzjn6ad7b5c44i7k83ow0321criih8'}, function(error, status) {
	// the sdk is now loaded

		if (error) {
			console.log(error);
		}

		if (status.authenticated) {
			// Already logged in, hide button
			$('.twitch-connect').hide()

			$('.oath-info-alert').hide();
			$('.oath-info-success').show();
			$('gotoprofile').show()
		}

		$('.twitch-connect').click(function() {
			Twitch.login({
				scope: ['user_read', 'channel_read']
			});
		});
	});
});


