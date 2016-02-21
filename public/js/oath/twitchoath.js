$(document).ready(function(){



	<!-- Twitch Javascript SDK -->
	
	Twitch.init({clientId: 'ahzjn6ad7b5c44i7k83ow0321criih8'}, function(error, status) {
	// the sdk is now loaded

		if (error) {
			console.log(error);
		}

		if (status.authenticated) {

			$('.oath-info-alert').hide();
			$('.twitch-status').fadeIn();
			$('gotoprofile').show()
		}

		$('.twitch-connect').click(function() {
			Twitch.login({
				scope: ['user_read', 'channel_read']
			});
		});
	
		/*Retrieve username from the Twitch API and update the user table*/

		$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				}
		});	

		if ($('.twitch-status').css('display') == 'block')
		{
			Twitch.api({method: 'user'}, function(error, user) {

				var userId = $('.oath_id').text();	
				var username = user.display_name;

				$.ajax({

					type: "POST",
					url: "/oath_authorization/"+username,
					data: {username: username},
					error: function(data){
						console.log(data);
					}
				});

				/*CHANGE THIS FOR PRODUCTION*/
				$('.gotoprofile>a').attr('href', 'http://yeayur.com/profile/'+username);


			});
		}
	});
});


