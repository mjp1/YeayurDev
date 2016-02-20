@extends('templates.default')

@section('content')
	<h1>Authorize Yeayur For Streaming</h1>

	<img src="http://ttv-api.s3.amazonaws.com/assets/connect_dark.png" class="twitch-connect" href="#" />

	<button class="btn btn-primary"></button>

	<div class="stream-key"></div>

	<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>

	<script>
		Twitch.init({clientId: 'ahzjn6ad7b5c44i7k83ow0321criih8'}, function(error, status) {
		// the sdk is now loaded

			if (error) {
				console.log(error);
			}

			if (status.authenticated) {
				// Already logged in, hide button
				$('.twitch-connect').hide()
			}

			$('.twitch-connect').click(function() {
				Twitch.login({
					scope: ['user_read', 'channel_read']
				});
			});

			$('.btn-primary').click(function(){
				Twitch.api({method: 'channel'}, function(error, channel) {
          			$('.stream-key').html(channel.stream_key);
          		});
			});

		});
	</script>
@stop