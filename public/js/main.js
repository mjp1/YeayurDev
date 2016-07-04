$(document).ready(function(){

	// Prevent global search bar default functionality
	$('.head-search').submit(function(e) {
		e.preventDefault();
	});
	
	$('.main-user-post').hover(function(){
		$(this).find('.main-btn-group').show();
	}, function(){
		$(this).find('.main-btn-group').hide();
	});

	var $grid = $('.post-grid').imagesLoaded( function() {
		$grid.masonry({
			  // options
			  itemSelector: '.main-user-post',
			  columnWidth: '.main-user-post'
		});
	});

	// Infinite Scroll 

	$('.post-grid').infinitescroll({

		

		navSelector: '.pagination',
		nextSelector: '.pagination a:last',
		itemSelector: '.main-user-post',
		bufferPx: 400
	},

	// Use Masonry appended method to add new elements to page

		function (newElements) {
			var $newElems = $( newElements);

			var $grid = $('.post-grid').imagesLoaded( function() {
				$('.post-grid').masonry('appended', $newElems);
			});
			
		}
	);

	/*Trigger bootstrap modal for streamer fan page*/
	$(document).on('click', '.no-results-fan-page-link', function() {
		$('#create-fan-page').modal('show');
	});

	/* AJAX form submit for create streamer fan page */

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#create-fan-page-form').submit(function(event) {
		event.preventDefault();
	});

	$('.create-streamer-fan-page').click(function(event) {
		event.preventDefault();

		var fanPageUrl = $('#fanpageurl').val();
		
		$.ajax({
    		type: "POST",
    		url: "/create/fan_page",
    		data: {fanpageurl:fanPageUrl},
    		error: function(data){
    			/*Retrieve errors and append any error messages.*/
    			var errors = $.parseJSON(data.responseText);
    			var errors = errors.fanpageurl[0];
    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
    			/*Show error message then fadeout after 2 seconds.*/
    			$(errorsAppend).insertAfter('#fanpageurl').delay(2000).fadeOut();
    		},
    		success: function(data) {
    			window.location = data;
    		}
		});

	});

});