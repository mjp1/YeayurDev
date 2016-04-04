$(document).ready(function(){

	$('.edit-info-pic').click(function(){
		$('.edit-profile-pic').modal('show');
	});

	$('.streamer-pic').hover(function() {
		$('.edit-info-pic').show();
	}, function(){
		$('.edit-info-pic').hide();
	});

	$('.about-me-wrapper').hover(function() {
		$('.edit-info-about').show();
	}, function(){
		$('.edit-info-about').hide();
	});

	/*AJAX FORM SUBMISSION*/

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});

	// Dropzone AJAX File Upload

	//Dropzone.js Options - Upload an image via AJAX.
	  

	  Dropzone.options.myDropzone = {
	    uploadMultiple: false,
	    // previewTemplate: '',
	    addRemoveLinks: true,
	    autoProcessQueue: false,
	    maxFilesize: 5,
	    maxFiles: 1,
	    headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
	    // maxFiles: 1,
	    dictDefaultMessage: '',
	    init: function() {
	      this.on("addedfile", function(file) {
	      	if (this.files.length > 1)
	      	{
	      		this.removeFile(this.files[0]);
	      	}
	      });

	      	this.on("sending", function(file) {
			  // Show the total progress bar when upload starts
			  $('.progress-spinner').show();
			});

	      this.on("error", function(file, data, msg) {
	      	var errors = data.file[0];
	      	var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
			/*Show error message then fadeout after 2 seconds.*/
			$(errorsAppend).insertAfter('.dropzone').delay(2000).fadeOut();
			console.log(file);
			console.log(data);
			console.log(msg);
	      });
	      this.on("success", function(file, res) {
			location.reload();
	      });
	    }
	  };

	  var myDropzone = new Dropzone("#my-dropzone");
	 
	  $('.upload-new-pic').on('click', function(e) {
	    e.preventDefault();
	    // Remove previously selected image

	    //trigger file upload select
	    $("#my-dropzone").trigger('click');
	  });

	  $('.btn-edit-profile-pic').on('click', function(e) {
	  	myDropzone.processQueue();
	  });

	  Dropzone.autoDiscover = false;




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

	// Edit post

	$(document).on('click', '.edit-info-post', function() {
		var postvalue = $(this).closest('.streamer-feed-post').find('.message-content>span').text();
		$('#editpostbody').val(postvalue);
		$('.edit-profile-post').modal('show');
		var postid = $(this).parent().find('#post-id').text();

		$('.btn-edit-profile-post').click(function() {
			var editpost = $('#editpostbody').val();
			var profileId = $('#user_id').text();

			$.ajax({
	    		type: "POST",
	    		url: "/post/edit/"+profileId+"/"+postid,
	    		data: {editpost:editpost, profile_id:profileId, postid:postid},
	    		error: function(data){
	    			/*Retrieve errors and append any error messages.*/
	    			var errors = $.parseJSON(data.responseText);
	    			console.log(errors);
	    			var errors = errors.editpost[0];
	    			var errorsAppend = '<span class="text-danger post-error-msg">'+errors+'</span>';
	    			/*Show error message then fadeout after 2 seconds.*/
	    			$(errorsAppend).insertAfter('.post-like-count').delay(2000).fadeOut();
	    		},
	    		success: function(data) {
	    			location.reload();
	    		}
			});

		});	
	});


});

						