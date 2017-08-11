$(document).ready(function(){

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
				   alert(data); // apple
				}
			});
		}
	});
	$("#email").keydown(function(e) {
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
		$(form + ": input").each(function(){

			$(this).val();
		});
	}
});