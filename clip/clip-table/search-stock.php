<input class="w3-input custom-w3-animate-input" type="text" name="search_text" id="search_text" placeholder="Search Here" style="width:30%">
<br>
<script type="text/javascript">
	$(document).ready(function() {
	$('#search_text').keyup(function(){
		var txt = $(this).val();
		if (txt != '') {
			$.ajax({
				url:"../php/fetch_data-stock.php",
				method:"POST",
				data:{nm:txt},
				dataType:"text",
				success:function(data){
					$('#result').html(data);
					$('#result').fadeIn('slow');
				}
			});
		}else{
			$.ajax({
				url:"../php/fetch_data-stock.php",
				method:"POST",
				data:{nm:txt},
				dataType:"text",
				success:function(data){
					$('#result').html(data);
					$('#result').fadeIn('slow');	
				}			
			});
		}
	});
});
</script>