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
			var games = "games";
		} else {
			var games = "";
		}

		if($('.checkbox-art').is(':checked'))
		{
			var art = "art";
		} else {
			var art = "";
		}

		if($('.checkbox-music').is(':checked'))
		{
			var music = music;
		} else {
			var music = "";
		}

		if($('.checkbox-building-stuff').is(':checked'))
		{
			var buildingStuff = "buildingstuff";
		} else {
			var buildingStuff = "";
		}

		if($('.checkbox-educational').is(':checked'))
		{
			var educational = "educational";
		} else {
			var educational = "";
		}		

		$.ajax({
			type: "POST",
			url: "/profile/setup/1",
			data: {games:games, art:art, music:music, buildingStuff:buildingStuff, educational:educational},
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