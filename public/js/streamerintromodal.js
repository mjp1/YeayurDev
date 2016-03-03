$(document).ready(function(){

	$('.modal-intro-btn').click(function(){
		$('.modal-body-intro').hide()
		$('.modal-footer-intro').hide();

		$('.modal-body-streamer-type').fadeIn();
		$('.modal-footer-streamer-type').fadeIn();
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});	

	$('.modal-streamer-type-btn').click(function(e){
		e.preventDefault();

		if($('.checkbox-games').is(':checked'))
		{
			var games = 1;
		}

		var games = 0;

		if($('.checkbox-art').is(':checked'))
		{
			var art = 1;
		}
		
		var art = 0

		if($('.checkbox-music').is(':checked'))
		{
			var music = 1;
		}
		
		var music = 0

		if($('.checkbox-building-stuff').is(':checked'))
		{
			var buildingStuff = 1;
		}
		
		var buildingStuff = 0

		$.ajax({
			type: "POST",
			url: "/profile/setup/1",
			data: {games:games, art:art, music:music, building_stuff:buildingStuff},
			error: function(data){
				console.log(data);
			},
			success: function(data){
				console.log(data);
				
			}
		});


		$('.modal-body-streamer-type').hide()
		$('.modal-footer-streamer-type').hide();

		$('.modal-body-streamer-type-details').fadeIn();
		$('.modal-footer-streamer-type-details').fadeIn();
	});

});