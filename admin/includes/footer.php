
<footer class="text-center">&copy; 1998-2018 National Institute of Medical Science(NIMS). All rights reserved.</footer>
<script type="text/javascript "src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
 
	<script type='text/javascript'>
	$(document).ready(function(){
	$("#search_results").slideUp();
	$("#button_find").click(function(event){
	event.preventDefault();
	search_ajax_way();
	});
	$("#search_query").keyup(function(event){
	event.preventDefault();
	search_ajax_way();
	});
	 
	});
	 
	function search_ajax_way(){
	$("#search_results").show();
	var search_this=$("#search_query").val();
	$.post("search.php", {searchit : search_this}, function(data){
	$("#display_results").html(data);
	 
	})
	}

	

	</script>
</body>
</html>