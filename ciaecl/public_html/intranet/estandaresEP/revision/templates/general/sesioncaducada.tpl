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
Esta página se redireccionará en 5 segundos a la página principal.</big>
<form name="main" action="{url}" method="post">
<input type="hidden" name="lastAction" value="logout">
</form>
<script>

setTimeout("document.main.submit();",5000);
</script>
</div> </center></body>
</html> 