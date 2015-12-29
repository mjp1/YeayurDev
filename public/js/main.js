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

	// Infinite Scroll 

	$('.post-grid').infinitescroll({
		navSelector: '.pagination',
		nextSelector: '.pagination a:last',
		itemSelector: '.main-user-post',
		donetext: '',
		bufferPx: 100
	},

	// Use Masory appended method to add new elements to page

		function (newElements) {
			var $newElems = $( newElements);

			$('.post-grid').masonry('appended', $newElems);
		}
	);
});