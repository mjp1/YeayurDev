$(document).ready(function(){

	$('.service-confirm-username-error').click(function(){

		swal({  
			title: "Wrong Account?", 
			text: "To change the linked account, sign out on the Twitch website before connecting again.",   
			type: "warning",   
			showCancelButton: true,
			confirmButtonText: "Reconnect",
			confirmButtonColor: "#ff3300", 
		},
		function(){   
			window.location.href = "/oauth_authorization";
		});

	});

	if ($('.twitch-error').length)
	{
		swal({  
			title: "Twitch Name Already Exists", 
			text: "We already have a record of the Twitch name. Make sure you haven't already registered or try logging out from Twitch first.",   
			type: "error",   
			confirmButtonText: "Go Back",
			confirmButtonColor: "#ff3300", 
		},
		function(){   
			history.back();
		});
	}

});


