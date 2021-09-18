<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
function myFunction(){
    $.ajax({
	 url: "table.php",
	 type: "POST",
	 datatype:"json",
	 success: function(data){
	    document.getElementById("t1").innerHTML = data;	       
	    }
	 		});
};   
myFunction();
	});
 </script>
<body>
	<div id="t1"></div>

</body>
</html>