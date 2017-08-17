$(document).ready(function(){
	$('select[multiple]').multiselect();

	$('.image_delete').click(function(){
		var del = confirm('You want to unlink this image from this business?');
		if(del == true){
			var image_id = $(this).attr('id');
			var path = $(this).siblings('img').attr('src');
			$.ajax({
	            type: "POST",
	            url: '/admin/images/delete',
	            data: {file_id : image_id, file_path: path },
				success: function(data) {
				   	location.reload();
				},
				fail: function() {
			    	alert("error");
			  	}
			});
		}
		else{
			return false;
		}
			
	});
	$('.perm_delete').click(function(){
		var image_id = $(this).attr('id');
		var path = $(this).siblings('img').attr('src');
		$.ajax({
            type: "POST",
            url: '/admin/images/delete',
            data: {imag_id : image_id, delete_path: path },
			success: function(data) {
			   	alert(data);
			   	location.reload();
			},
			fail: function() {
		    	alert("error");
		  	}
		});
	});

	$('form.ajax-form').submit(function(e){
		e.preventDefault();
		if($(this).valid())
			return true;
		else
			return false;
	});
	$('#ajax-save-btn').click(function(){
		var form = $(this).parents('form.ajax-form');
		if(form.valid()){
			$.ajax({
                type: "POST",
                url: $(form).attr('action'),
                data: $(form).serializeArray(),
				success: function(data) {
				   alert(data);
				}
			});
			clearInput();

		}
	});
	$("#website").keydown(function(e) {
		var oldvalue=$(this).val();
		var field = this;
		setTimeout(function () {
		    if(field.value.indexOf('http://') !== 0) {
		        $(field).val(oldvalue);
		    } 
		}, 1);
	});


	$('.delete-btn').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var del = confirm('Are you sure you want to delete this business?');
		if (del == true) {
		    window.location.href = url;
		} else {
		    return false;
		}

	});

	function clearInput(){
		$('form.ajax-form').find('input:text').each(function(){
			$(this).val('');
		});
	}
	$('form#save-business').submit(function(e){
		e.preventDefault();
		if($(this).valid())
			return true;
		else
			return false;
	});
});