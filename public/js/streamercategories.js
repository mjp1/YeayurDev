$(document).ready(function(){

	

	
	


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

	



	

	

	

});



						