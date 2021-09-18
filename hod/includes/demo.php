<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
function myFunction(e=0,f=0){
	var t2=e;
	var t3=f;
    $.ajax({
	 url: "table.php",
	 type: "POST",
	 datatype:"json",
	 data:{col:t2,cols:t3},
	 success: function(data){
	    document.getElementById("t1").innerHTML = data;	       
	    }
	 		});
};   
myFunction();
$('#t2').click(function(){
  myFunction(1);
 });
$('#t3').click(function(){
  myFunction(0,1);
 });
	});
 </script>
<body>
	<div id="t1"></div>
	<button id="t2" onclick="myFunction(1)" >Click</button>
	<button id="t3" onclick="myFunction(1)" >Click</button>

</body>
</html>