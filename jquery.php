<script src="lib/jquery.min.js" type="text/javascript"></script>
<center><button id="load">Load</button></center>
<script>
	$(document).ready(function(){
		$("#load").click(function(){
			$("#content").load("index.");
		});
	});
</script>
<div id="content"></div>