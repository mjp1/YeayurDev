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

		var data = { 'streamerType[]' : []};
		
		$("input[name='streamerType[]']:checked").each(function() {
			data['streamerType[]'].push($(this).val());
		});	

		

		$.ajax({
			type: "POST",
			url: "/profile/setup/1",
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
    			$(errorsAppend).insertAfter('.modal-body-streamer-type').delay(2000).fadeOut();
    		},
    		success: function(){

    			/*Hide the select boxes to choose streamer type*/

				$('.modal-body-streamer-type').hide()
				$('.modal-footer-streamer-type').hide();

				/*Show the section to type in keywords for each streamer type selected in previous step*/

				$("input[name='streamerType[]']:checked").each(function() {

					var detailInput_1 = [
									'<div class="form-group detail-inputs detail-input-games">',
									'<h4>Let us know the games you like to play!</h4>',
									'<h6 class="help-block">(Use keywords to describe such as the game"s title or genre)</h6>',
									'<div class="form-group">',
									'<input type="text" name="typeDetails[games]" class="form-control input-global"/>',
									'</div>',
									'<div class="add-more">',
									'<button type="button" class="btn btn-global add-more-games">',
									'<span class="glyphicon glyphicon-plus"></span>',
									'</button>',
									'<span>Add more</span>',
									'</div> ',
									'</div>'
									].join('');

					var detailInput_2 = [
									'<div class="form-group detail-inputs detail-input-art">',
									'<h4>Let us know about your art!</h4>',
									'<h6 class="help-block">(Use keywords to describe such as drawing, painting, or the style)</h6>',
									'<div class="form-group">',
									'<input type="text" name="typeDetails[art]" class="form-control input-global"/>',
									'</div>',
									'<div class="add-more">',
									'<button type="button" class="btn btn-global add-more-art">',
									'<span class="glyphicon glyphicon-plus"></span>',
									'</button>',
									'<span>Add more</span>',
									'</div> ',
									'</div>'
									].join('');

					var detailInput = window['detailInput_' + $(this).val()];
					console.log(detailInput);

					/*$('.streamer-type-details-form').append(detailInput);*/
				});

				$('.modal-body-streamer-type-details').fadeIn();
				$('.modal-footer-streamer-type-details').fadeIn();
    		}
		});

	});

	$('.add-detail-input').focus(function(){
		$(this).siblings('.detail-input-remove').show();
	});

	/*Remove additional input boxes on the details step*/

	$(document).on('click', '.input-group-btn', function(){
		$(this).parent('.input-group').detach();
	});

	$(document).on('click', '.add-more-games', function(){
				var gameInput = [
						'<div class="input-group">',
						'<input type="text" name="typeDetails[games]" class="form-control input-global"/>',
						'<span class="input-group-btn">',
						'<button class="btn btn-default" type="button">',
						'<span class="glyphicon glyphicon-remove"></span>',
						'</button>',
						'</span>',
						'</div>'
						].join('');

		$(gameInput).insertBefore('.add-more-games');
	});	

	/*$('.input-group-btn').click(function(){
		$(this).parent('.input-group').detach();
	});*/

	$('.add-more-games').find('button').click(function(){
		var gameInput = [
						'<div class="input-group">',
						'<input type="text" name="typeDetails[games]" class="form-control input-global"/>',
						'<span class="input-group-btn">',
						'<button class="btn btn-default" type="button">',
						'<span class="glyphicon glyphicon-remove"></span>',
						'</button>',
						'</span>',
						'</div>'
						].join('');

		$(gameInput).insertBefore('.add-more-games');
	});

	$('.add-more-art').find('button').click(function(){
		var artInput = [
						'<div class="input-group">',
						'<input type="text" name="artInfo[]" class="form-control input-global"/>',
						'<span class="input-group-btn">',
						'<button class="btn btn-default" type="button">',
						'<span class="glyphicon glyphicon-remove"></span>',
						'</button>',
						'</span>',
						'</div>'
						].join('');

		$(artInput).insertBefore('.add-more-art');
	});

	$('.add-more-music').find('button').click(function(){
		var musicInput = [
						'<div class="input-group">',
						'<input type="text" name="musicInfo[]" class="form-control input-global"/>',
						'<span class="input-group-btn">',
						'<button class="btn btn-default" type="button">',
						'<span class="glyphicon glyphicon-remove"></span>',
						'</button>',
						'</span>',
						'</div>'				
						].join('');

		$(musicInput).insertBefore('.add-more-music');
	});

	$('.add-more-buildingstuff').find('button').click(function(){
		var buildingStuffInput = [
						'<div class="input-group">',
						'<input type="text" name="buildingStuffInfo[]" class="form-control input-global"/>',
						'<span class="input-group-btn">',
						'<button class="btn btn-default" type="button">',
						'<span class="glyphicon glyphicon-remove"></span>',
						'</button>',
						'</span>',
						'</div>'
						].join('');

		$(buildingStuffInput).insertBefore('.add-more-buildingstuff');
	});

	$('.add-more-educational').find('button').click(function(){
		var educationalInput = [
						'<div class="input-group">',
						'<input type="text" name="educationalInfo[]" class="form-control input-global"/>',
						'<span class="input-group-btn">',
						'<button class="btn btn-default" type="button">',
						'<span class="glyphicon glyphicon-remove"></span>',
						'</button>',
						'</span>',
						'</div>'
						].join('');

		$(educationalInput).insertBefore('.add-more-educational');
	});

	$('.modal-streamer-type-details-btn').click(function(e){
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

			console.log(data);

			$.ajax({
				type: "POST",
				url: "/profile/setup/2",
				data: data,
				error: function(data){
	    			/*Retrieve errors and append any error messages.*/
    				var errors = $.parseJSON(data.responseText);
	    			console.log(errors);
	    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('.modal-body-streamer-type').delay(2000).fadeOut();
	    		}

			});

		});

	});

						