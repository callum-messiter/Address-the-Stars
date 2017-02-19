$(document).ready(
	function showResult(){
		$("#generate").click(function(event){
			event.preventDefault();
			$.get('scripts/generate.php', function(result){   
				$('#result').html(result);
		});
	});
});