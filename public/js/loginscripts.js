$(document).ready(function(){

	$('.modal-cancel').on('click', function(){
		$('.modal-reg-input').val('');
		$('.forgot-pass-input').val('');
		$('.regsel').val('0');
		$('input:radio').removeAttr('checked');
		$('input:checkbox').removeAttr('checked');
	});
	
	//===================================================
	//		REGISTER MODAL - SUBMIT EVENT
	//===================================================

	$('.btn-reg-submit').on('click',function(){
		$(this).parent().parent().find('.modal-body').hide();
		$(this).parent().hide();
		$(this).parent().siblings('.reg-confirm-message').show();
	});
	
	$('.modal-confirm-close').on('click',function(){
		$(this).parent().parent().hide();
		$(this).parent().parent().siblings('.modal-body, .modal-footer').show();
	});
	
	//===================================================
	//		FORGOT PASSWORD MODAL - SUBMIT EVENT
	//===================================================

	$('.btn-forgotpass-submit').on('click',function(){
		$(this).parent().parent().find('.modal-body').hide();
		$(this).parent().hide();
		$(this).parent().parent().parent().find('.forgot-pass-message').show();
	});

	//===================================================
	//		SIGN IN BUTTON CLICK
	//===================================================

	$('.signin-btn').click(function(){
		$('.modal-signin').modal('show');
	});

	$('.main-streamer-post-pic, .streamer-post-id').click(function(){
		var username = $(this).parent().find('.streamer-post-name').text();
		var redirect = '<input type="hidden" name="redirect_url" value="'+username+'"/>';
		$('.modal-signin-redirect').modal('show');
		$('.redirect-url').append(redirect);

		
	});

});