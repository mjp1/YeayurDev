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


	$('.edit-info-about').click(function(){
		$('.edit-profile-aboutme').modal('show');
	});

	$('.edit-info-post').click(function(){
		var postValue = $(this).parent().find('.message-content>span').text();
		$('#postbody').val(postValue);
		$('.edit-profile-post').modal('show');
	});

});

						