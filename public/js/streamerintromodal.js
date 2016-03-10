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
		console.log(data);
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
				$('.modal-body-streamer-type').hide()
				$('.modal-footer-streamer-type').hide();

				$('.modal-body-streamer-type-details').fadeIn();
				$('.modal-footer-streamer-type-details').fadeIn();
    		}
		});

			});

});

						