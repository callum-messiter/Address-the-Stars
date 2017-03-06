$(document).ready(
	function showResult(){
		$("#generate").click(function(event){
			event.preventDefault();
			$.get('scripts/generateSingle.php', function(result){   
				$('#generate').html(result);
		});
	});
});