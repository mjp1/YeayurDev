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
    			var errors = errors.streamerType;
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
					$('.detail-input-'+$(this).val()).show();
				});

				$('.modal-body-streamer-type-details').fadeIn();
				$('.modal-footer-streamer-type-details').fadeIn();
    		}
		});

	});

	$('.add-detail-input').focus(function(){
		$(this).siblings('.detail-input-remove').show();
	});

	$('.input-group-btn').click(function(){
		$(this).parent('.input-group').detach();
	});

	$('.add-more-games').find('button').click(function(){
		var gameInput = [
						'<div class="input-group">',
						'<input type="text" name="gameInfo[]" class="form-control input-global"/>',
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



});

						