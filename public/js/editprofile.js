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

	// Dropzone AJAX File Upload

	//Dropzone.js Options - Upload an image via AJAX.
	  Dropzone.options.myDropzone = {
	    uploadMultiple: false,
	    // previewTemplate: '',
	    addRemoveLinks: false,
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
	        this.removeFile(this.files[0]);
	      });
	      this.on("thumbnail", function(file, dataUrl) {
	        // console.log('thumbnail...');
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
	        var successAppend = '<span class="text-success post-success-msg">'+errors+'</span>';
			/*Show error message then fadeout after 2 seconds.*/
			$(successAppend).insertAfter('.dropzone').delay(2000).fadeOut();
			location.reload();
	      });
	    }
	  };
	  var myDropzone = new Dropzone("#my-dropzone");
	 
	  $('.upload-new-pic').on('click', function(e) {
	    e.preventDefault();
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

	$('.edit-info-post').click(function(){
		var postValue = $(this).parent().find('.message-content>span').text();
		$('#postbody').val(postValue);
		$('.edit-profile-post').modal('show');
	});

});

						