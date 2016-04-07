$(document).ready(function(){

	if ($(window).width() > 480) {
		$('.streamer-about-panel').hover(function() {
			$('.edit-info-categories').show();
		}, function() {
			$('.edit-info-categories').hide();
		});
	}

	$('.edit-info-categories').click(function(){
		$('.edit-info-categories').hide()
		$('.streamer-about-item').hide();
		$('.streamer-categories-input').fadeIn();
		$('.streamer-categories-setup-wrapper').fadeIn();
	});

	$('.streamer-categories-cancel').click(function() {
		$('.streamer-categories-setup-wrapper').hide();
		$('.streamer-categories-input').hide();
		$('.streamer-categories-details').hide();
		$('.streamer-categories-optional').hide();

		$('.streamer-about-item').fadeIn();
		$('.edit-info-categories').fadeIn();
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});	

	$('.streamer-categories-input-submit').click(function(e){
		e.preventDefault();

		var data = { 'streamerType[]' : []};
		
		$("input[name='streamerType[]']:checked").each(function() {
			data['streamerType[]'].push($(this).val());
		});	

		$.ajax({
			type: "POST",
			url: "/profile/categories/1",
			data: data,
			error: function(data){
    			/*Retrieve errors and append any error messages.*/

    			var errors = $.parseJSON(data.responseText);
    			
    			if (errors.streamerType)
    			{
    				errors = errors.streamerType;
    			} else {

    				if (errors['streamerType.0'])
    				{
    					errors = errors['streamerType.0'];
    				}
    			}
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    			$(errorsAppend).insertAfter('.streamer-categories-input-form').delay(2000).fadeOut();
    		},
    		success: function(){

    			/*Hide the select boxes to choose streamer type*/

				$('.streamer-categories-input').hide()

				/*Show the section to type in keywords for each streamer type selected in previous step*/

				$("input[name='streamerType[]']:checked").each(function() {

					/*Here we are assiging the variables for the following appending based on which checkbox the user clicks*/

					var detailGames = [
						'<div class="form-group detail-inputs detail-input-games">',
						'<h4>Let us know the games you like to play!</h4>',
						'<h6 class="help-block">(Use keywords to describe such as the game"s title or genre)</h6>',
						'<div class="form-group">',
						'<input type="text" name="typeDetails[games]" class="form-control input-global"/>',
						'</div>',
						'<div class="add-more-games">',
						'<button type="button" class="btn btn-global add-more-games-btn">',
						'<span class="glyphicon glyphicon-plus"></span>',
						'</button>',
						'<span>Add more</span>',
						'</div> ',
						'</div>'
					].join('');

					var detailArt = [
						'<div class="form-group detail-inputs detail-input-art">',
						'<h4>Let us know about your art!</h4>',
						'<h6 class="help-block">(Use keywords to describe such as drawing, painting, or the style)</h6>',
						'<div class="form-group">',
						'<input type="text" name="typeDetails[art]" class="form-control input-global"/>',
						'</div>',
						'<div class="add-more-art">',
						'<button type="button" class="btn btn-global add-more-art-btn">',
						'<span class="glyphicon glyphicon-plus"></span>',
						'</button>',
						'<span>Add more</span>',
						'</div> ',
						'</div>'
					].join('');

					var detailMusic = [
						'<div class="form-group detail-inputs detail-input-music">',
						'<h4>Let us know about the music you like!</h4>',
						'<h6 class="help-block">(Use keywords to describe such as the singer, group, or genre)</h6>',
						'<div class="form-group">',
						'<input type="text" name="typeDetails[music]" class="form-control input-global"/>',
						'</div>',
						'<div class="add-more-music">',
						'<button type="button" class="btn btn-global add-more-music-btn">',
						'<span class="glyphicon glyphicon-plus"></span>',
						'</button>',
						'<span>Add more</span>',
						'</div> ',
						'</div>'
					].join('');

					var detailBuildingStuff = [
						'<div class="form-group detail-inputs detail-input-buildingstuff">',
						'<h4>Let us know what you like to build!</h4>',
						'<h6 class="help-block">(Use keywords to describe models, PC building, or cosplay)</h6>',
						'<div class="form-group">',
						'<input type="text" name="typeDetails[buildingStuff]" class="form-control input-global"/>',
						'</div>',
						'<div class="add-more-buildingstuff">',
						'<button type="button" class="btn btn-global add-more-buildingstuff-btn">',
						'<span class="glyphicon glyphicon-plus"></span>',
						'</button>',
						'<span>Add more</span>',
						'</div> ',
						'</div>'
					].join('');

					var detailEducational = [
						'<div class="form-group detail-inputs detail-input-educational">',
						'<h4>Let us know about the topics you like to discuss!</h4>',
						'<h6 class="help-block">(Use keywords to describe such as the topic or subject matter)</h6>',
						'<div class="form-group">',
						'<input type="text" name="typeDetails[educational]" class="form-control input-global"/>',
						'</div>',
						'<div class="add-more-educational">',
						'<button type="button" class="btn btn-global add-more-educational-btn">',
						'<span class="glyphicon glyphicon-plus"></span>',
						'</button>',
						'<span>Add more</span>',
						'</div> ',
						'</div>'
					].join('');	

					/*Here we are checking to see if the value of the checkbox(s) the user clicked
					matches the values in the array to prevent the user from changing the markup in the 
					browser's dev tools. We are then appending to the streamer-type-details-form the markup 
					for the specific checkbox the user clicked.*/

					var detailArray = ["1", "2", "3", "4", "5"];
					
					if($.inArray($(this).val(), detailArray) !== -1 )
					{
						if ($(this).val() === '1')
						{
							$('.streamer-categories-details-form').append(detailGames);
						}

						if ($(this).val() === '2')
						{
							$('.streamer-categories-details-form').append(detailArt);
						}

						if ($(this).val() === '3')
						{
							$('.streamer-categories-details-form').append(detailMusic);
						}

						if ($(this).val() === '4')
						{
							$('.streamer-categories-details-form').append(detailBuildingStuff);
						}

						if ($(this).val() === '5')
						{
							$('.streamer-categories-details-form').append(detailEducational);
						}
					} else {
						// figure something out for error
					}
				});

				/*Fade in the div that holds the input markup for each streamer type*/

				$('.streamer-categories-details').fadeIn();
    		}
		});
	});

	/*Remove additional text inputs when the user clicks the "remove" button for the additional text inputs*/

	$(document).on('click', '.remove-input-group', function(){
		$(this).parent('.input-group').detach();
	});

	/*Add more text inputs when the user clicks the "add more" button*/

	$(document).on('click', '.add-more-games-btn', function(){
		
		var gameInput = [
			'<div class="input-group">',
			'<input type="text" name="typeDetails[games]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(gameInput).insertBefore('.add-more-games');
	});	

	$(document).on('click', '.add-more-art-btn', function(){
		
		var artInput = [
			'<div class="input-group">',
			'<input type="text" name="typeDetails[art]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(artInput).insertBefore('.add-more-art');
	});

	$(document).on('click', '.add-more-music-btn', function(){
		
		var musicInput = [
			'<div class="input-group">',
			'<input type="text" name="typeDetails[music]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(musicInput).insertBefore('.add-more-music');
	});

	$(document).on('click', '.add-more-buildingstuff-btn', function(){
		
		var buildingStuffInput = [
			'<div class="input-group">',
			'<input type="text" name="typeDetails[buildingStuff]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(buildingStuffInput).insertBefore('.add-more-buildingstuff');
	});

	$(document).on('click', '.add-more-educational-btn', function(){
		
		var educationalInput = [
			'<div class="input-group">',
			'<input type="text" name="typeDetails[educational]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(educationalInput).insertBefore('.add-more-educational');
	});

	/*AJAX script to assign text input values to their respective arrays and send to the controller*/

	$('.streamer-categories-details-submit').click(function(e){
		e.preventDefault();

		var data = { 'typeDetails[games]' : [], 'typeDetails[art]' : [], 'typeDetails[music]' : [], 'typeDetails[buildingStuff]' : [], 'typeDetails[educational]' : [] };
		
		$("input[name='typeDetails[games]']").each(function() {
			data['typeDetails[games]'].push($(this).val());
		});	

		$("input[name='typeDetails[art]']").each(function() {
			data['typeDetails[art]'].push($(this).val());
		});

		$("input[name='typeDetails[music]']").each(function() {
			data['typeDetails[music]'].push($(this).val());
		});

		$("input[name='typeDetails[buildingStuff]']").each(function() {
			data['typeDetails[buildingStuff]'].push($(this).val());
		});

		$("input[name='typeDetails[educational]']").each(function() {
			data['typeDetails[educational]'].push($(this).val());
		});

		$.ajax({
			type: "POST",
			url: "/profile/categories/2",
			data: data,
			error: function(data){
    			/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    			$(errorsAppend).insertAfter('.streamer-categories-details-form').delay(2000).fadeOut();
    		}, success: function(data){
    			$('.streamer-categories-details').hide();

    			$('.streamer-categories-optional').fadeIn();
    		}

		});

	});

	

	$('.streamer-categories-optional-submit').click(function(e){
		e.preventDefault();

		if ($('.system-specs').val())
		{
			var systemSpecs = $('.system-specs').val();
		}

		if ($('.stream-schedule').val())
		{
			var streamSchedule = $('.stream-schedule').val();
		}

		$.ajax({
			type: "POST",
			url: "/profile/categories/3",
			data: {systemSpecs:systemSpecs, streamSchedule:streamSchedule},
			error: function(data){
    			/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    			$(errorsAppend).insertAfter('.streamer-categories-optional-form').delay(2000).fadeOut();
    		}, success: function(data){
    			location.reload();
    		}

		});

		
	});

	/*Section to edit individual streamer category details*/

	$('.streamer-about-item-wrapper').hover(function() {
		$(this).find('.streamer-about-item-edit').show();
	}, function() {
		$(this).find('.streamer-about-item-edit').hide();
	});

	/*Games*/

	$('.about-item-edit-games').click(function() {
		$(this).parent().hide();
		$('.about-item-games').fadeIn();
	});

	$('.streamer-details-items-edit-games-cancel').click(function() {
		$(this).parent().parent().hide();
		$('.about-item-wrapper-games').fadeIn();
	});

	$(document).on('click', '.edit-add-more-games-btn', function(){
		
		var gameInput = [
			'<div class="input-group">',
			'<input type="text" name="editDetails[games]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(gameInput).insertBefore('.edit-add-more-games');
	}); 

	$('.streamer-details-items-edit-games-submit').click(function() {
		var editGames = { 'editDetails[games]' : [] }

		$("input[name='editDetails[games]']").each(function() {
			editGames['editDetails[games]'].push($(this).val());
		});

		$.ajax({
			type: "POST",
			url: "/profile/categories/edit",
			data: editGames,
			error: function(data){
    			/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    		}, success: function(data){
    			location.reload();
    		}

		});

	});

	/*Art*/

	$('.about-item-edit-art').click(function() {
		$(this).parent().hide();
		$('.about-item-art').fadeIn();
	});

	$('.streamer-details-items-edit-art-cancel').click(function() {
		$(this).parent().parent().hide();
		$('.about-item-wrapper-art').fadeIn();
	});

	$(document).on('click', '.edit-add-more-art-btn', function(){
		
		var artInput = [
			'<div class="input-group">',
			'<input type="text" name="editDetails[art]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(artInput).insertBefore('.edit-add-more-art');
	}); 

	$('.streamer-details-items-edit-art-submit').click(function() {
		var editArt = { 'editDetails[art]' : [] }

		$("input[name='editDetails[art]']").each(function() {
			editArt['editDetails[art]'].push($(this).val());
		});

		$.ajax({
			type: "POST",
			url: "/profile/categories/edit",
			data: editArt,
			error: function(data){
    			/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    		}, success: function(data){
    			location.reload();
    		}

		});

	});

	/*Music*/

	$('.about-item-edit-music').click(function() {
		$(this).parent().hide();
		$('.about-item-music').fadeIn();
	});

	$('.streamer-details-items-edit-music-cancel').click(function() {
		$(this).parent().parent().hide();
		$('.about-item-wrapper-music').fadeIn();
	});

	$(document).on('click', '.edit-add-more-music-btn', function(){
		
		var musicInput = [
			'<div class="input-group">',
			'<input type="text" name="editDetails[music]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(musicInput).insertBefore('.edit-add-more-music');
	}); 

	$('.streamer-details-items-edit-music-submit').click(function() {
		var editMusic = { 'editDetails[music]' : [] }

		$("input[name='editDetails[music]']").each(function() {
			editMusic['editDetails[music]'].push($(this).val());
		});

		$.ajax({
			type: "POST",
			url: "/profile/categories/edit",
			data: editMusic,
			error: function(data){
    			/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    		}, success: function(data){
    			location.reload();
    		}

		});

	});

	/*Building Stuff*/

	$('.about-item-edit-buildingstuff').click(function() {
		$(this).parent().hide();
		$('.about-item-buildingstuff').fadeIn();
	});

	$('.streamer-details-items-edit-buildingstuff-cancel').click(function() {
		$(this).parent().parent().hide();
		$('.about-item-wrapper-buildingstuff').fadeIn();
	});

	$(document).on('click', '.edit-add-more-buildingstuff-btn', function(){
		
		var buildingStuffInput = [
			'<div class="input-group">',
			'<input type="text" name="editDetails[buildingstuff]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(buildingStuffInput).insertBefore('.edit-add-more-buildingstuff');
	}); 

	$('.streamer-details-items-edit-buildingstuff-submit').click(function() {
		var editBuildingStuff = { 'editDetails[buildingstuff]' : [] }

		$("input[name='editDetails[buildingstuff]']").each(function() {
			editBuildingStuff['editDetails[buildingstuff]'].push($(this).val());
		});

		$.ajax({
			type: "POST",
			url: "/profile/categories/edit",
			data: editBuildingStuff,
			error: function(data){
    			/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    		}, success: function(data){
    			location.reload();
    		}

		});

	});

	/*Educational*/

	$('.about-item-edit-educational').click(function() {
		$(this).parent().hide();
		$('.about-item-educational').fadeIn();
	});

	$('.streamer-details-items-edit-educational-cancel').click(function() {
		$(this).parent().parent().hide();
		$('.about-item-wrapper-educational').fadeIn();
	});

	$(document).on('click', '.edit-add-more-educational-btn', function(){
		
		var educationalInput = [
			'<div class="input-group">',
			'<input type="text" name="editDetails[educational]" class="form-control input-global"/>',
			'<span class="input-group-btn remove-input-group">',
			'<button class="btn btn-default" type="button">',
			'<span class="glyphicon glyphicon-remove"></span>',
			'</button>',
			'</span>',
			'</div>'
		].join('');

		$(educationalInput).insertBefore('.edit-add-more-educational');
	}); 

	$('.streamer-details-items-edit-educational-submit').click(function() {
		var editEducational = { 'editDetails[educational]' : [] }

		$("input[name='editDetails[educational]']").each(function() {
			editEducational['editDetails[educational]'].push($(this).val());
		});

		$.ajax({
			type: "POST",
			url: "/profile/categories/edit",
			data: editEducational,
			error: function(data){
    			/*Retrieve errors and append any error messages.*/
				var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    		}, success: function(data){
    			location.reload();
    		}

		});

	});

});



						