$(document).ready(function(){

	$('.dropdown-menu>li>a').on('click', function(event){
		event.preventDefault();
		var text = $(this).text();
		$('.dropdown-toggle').text(text);
	});
	
});