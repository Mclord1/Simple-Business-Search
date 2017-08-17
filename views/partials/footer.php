
</div>
<script src="../public/js/jquery-2.1.4.min.js"></script>
<script src="../public/js/bootstrap.js"></script>
<script src="../public/js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.more').click(function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		$('#business_id').val(id);
		$('#view_business').submit();
	});
});
</script>
</body>
</html>
