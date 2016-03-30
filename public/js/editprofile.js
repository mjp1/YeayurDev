$(document).ready(function(){

	$('.edit-info-pic').click(function(){
		$('.edit-profile-pic').modal('show');
	});

	/*AJAX FORM SUBMISSION*/

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.btn-edit-profile-aboutme').click(function(e){
		e.preventDefault();

		var about = $('.about-text').val();

		$.ajax({
			type: "POST",
    		url: "/profile/edit/about",
    		data: {about_me:about},
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			console.log(errors);
    			var errors = errors.about_me[0];
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    			$(errorsAppend).insertAfter('.new-about').delay(2000).fadeOut();
    		},
    		success: function(){
    			location.reload();
    		}
		});
	});


	$('.edit-info-about').click(function(){
		$('.edit-profile-aboutme').modal('show');
	});

	$('.edit-info-post').click(function(){
		var postValue = $(this).parent().find('.message-content>span').text();
		$('#postbody').val(postValue);
		$('.edit-profile-post').modal('show');
	});

});

						