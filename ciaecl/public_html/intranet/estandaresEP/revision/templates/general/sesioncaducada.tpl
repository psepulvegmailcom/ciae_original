<html>
<head> 
<link rel="stylesheet" href="style/version3_portal.css" media="all"></link>  
</head>
<body  >
 <center>
<div style="padding: 15px; text-align:center"  >

<br> 
<br>
<big><strong> {mensaje_extra}</strong><br /><br />
Esta p�gina se redireccionar� en 5 segundos a la p�gina principal.</big>
<form name="main" action="{url}" method="post">
<input type="hidden" name="lastAction" value="logout">
</form>
<script>

setTimeout("document.main.submit();",5000);
</script>
</div> </center></body>
</html> 