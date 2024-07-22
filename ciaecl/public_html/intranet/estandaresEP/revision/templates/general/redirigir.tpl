<html>
<head> 
<link rel="stylesheet" href="style/version3_portal.css" media="all"></link>  
</head>
<body  >
 <center>
<div style="padding: 15px; text-align:center"  >

<br> 
<br> 
<form name="main" action="{url}" method="post">
<input type="hidden" name="lastAction" value="{opcion}">
</form>
<script>
alert(' {mensaje_extra}');
 
setTimeout("document.main.submit();",1000);
</script>
</div> </center></body>
</html> 