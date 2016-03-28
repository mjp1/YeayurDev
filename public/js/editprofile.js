$(document).ready(function(){

	$('.item-email').click(function(){
		$('.form-items').hide();
		$('.form-email').fadeIn();
	});

	$('.item-password').click(function(){
		$('.form-items').hide();
		$('.form-password').fadeIn();
	});

	$('.item-about').click(function(){
		$('.form-items').hide();
		$('.form-about').fadeIn();
	});

	$('.item-categories').click(function(){
		$('.form-items').hide();
		$('.form-categories').fadeIn();
	});

});