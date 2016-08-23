$(document).ready(function() {

	// List Modal Form Toggle
	$('.create-new-list').click(function() {
		$('#newList').slideToggle();
	});

	// Add additional list items
	$('.user-list-add').click(function() {
		var listItem = [
			'<div class="input-group">',
			'<input type="text" class="form-control input-global" id="listItem" name="userListItem[]" placeholder="Streamer Name">',
			'<span class="input-group-addon newList-inputs-addon"><i class="fa fa-times" aria-hidden="true"></i></span>',
			'</div>'
		].join('');

		$(listItem).insertBefore($(this));
	});

	// Remove input item from DOM when clicked
	$(document).on('click', '.newList-inputs-addon', function() {
		$(this).parent().remove();
	});

	// Submit user lists form
	$('#newList-submit').click(function() {
		var userListItem = [];

		$("input[name='userListItem[]']").each(function() {
			if ($(this).val().length > 0)
			{
				userListItem.push($(this).val());
			}
			
		});

		var name = $('#listName').val();

		console.log(name);
		console.log(userListItem);

		

		$.ajax({
			type: "POST",
			url: "list/create",
			data: {name:name, listItem:userListItem},
			error: function(data) {
				console.log(data);
			},
			success: function(data) {
				console.log(data);
			}
		});
	});
});