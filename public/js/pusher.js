<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
<script>

	(function(){
		var pusher = new Pusher('03fe3c261638a67dbce5', {
      		encrypted: true
    	});

    	var channel = pusher.subscribe('newMessage');

    	channel.bind('Yeayurdev\\Events\\UserHasPostedMessage', function(data) {
	      console.log(data.message);
	    });
	})();
</script>