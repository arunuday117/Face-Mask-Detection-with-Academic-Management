<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script src="../vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $.ajax({
	 url: "table.php",
	 type: "POST",
	 datatype:"json",
	 success: function(data){
	    document.getElementById("t1").innerHTML = data;	       
	    }
	 		});

	});
 </script>
<body>
	<div id="t1"></div>

</body>
</html>