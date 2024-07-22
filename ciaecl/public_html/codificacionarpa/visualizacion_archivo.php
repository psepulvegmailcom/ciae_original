<html>
<body>

<?php

	$config = "../config.cfg";   
  	include $config;
	$archivo = $_GET['archivo'];  
	
	$c_autorizada = VarConfig::regkey_system; 
	$clave = $_GET['cs'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$aux = explode('.',$ip);
	$ip_cmm = $aux[0].'.'.$aux[1];
	
	$codificacion = $_GET['codificacion'];
	$codificadora = $_GET['codificadora'];
	if($clave == $c_autorizada)
	//if($clave == $c_autorizada && ($ip_cmm == '172.16' || $ip == '146.83.7.1' || $ip == '200.89.68.134' ))
	{
		$aux = explode('.',$archivo);
		$extension = $aux[1];
		 
		?>
		<a href="lectura_archivo.php?cs=d6dcb1c752ae7a7dcdc59978be2b7113&codificacion=<?php echo $codificacion;?>&codificadora=<?php echo $codificadora;?>"><< Volver a listado</a><br> <br><strong>Folio: <?php echo  $aux[0];?></strong><br><br>

	 	<?php
		if($extension == 'pdf')
		{
			$url = 'http://www.ciae.uchile.cl/download.php?file=codificacionarpa/'.$archivo;
		?>
	 	<iframe style="border:none" src="http://docs.google.com/viewer?url=<?php echo $url;?>&amp;embedded=true" width="600" height="650"></iframe>
		<?php
		}
		else
		{
			$url = 'http://www.ciae.uchile.cl/imageview.php?tipo=doc&file=codificacionarpa/'.$archivo;
		?>
	<br><a href="javascript:aumentarTamanoImagen();">Aumentar</a> || <a href="javascript:disminuirTamanoImagen();">Disminuir</a> <br><br>
			<img id="imagen" src="<?php echo $url;?>"  width="600" >
		<?php
		}

		echo   "<!-- ".$url." -->";
	}	
	else
	{
		echo "Sin acceso";
	}
	?>
	<script>
		function aumentarTamanoImagen()
		{
			logo = document.getElementById("imagen");
			  logo.width = logo.width + 100;
			  logo.height = logo.height + 100;
		}
		function disminuirTamanoImagen()
		{
			logo = document.getElementById("imagen");
			logo.width = logo.width - 100;
			logo.height = logo.height - 100;
		}
	</script>
</body>
</html>