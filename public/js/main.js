$(document).ready(function(){
	$('.main-user-post').hover(function(){
		$(this).find('.main-btn-group').show();
	}, function(){
		$(this).find('.main-btn-group').hide();
	});

	$('.post-grid').masonry({
	  // options
	  itemSelector: '.main-user-post',
	  columnWidth: '.main-user-post'
	});
});