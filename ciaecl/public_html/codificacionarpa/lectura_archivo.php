<html>
<body> 
<table style="width: 90%">
<?php

	$config = "../config.cfg";   
  	include $config; 
	
	$c_autorizada = VarConfig::regkey_system; 
	$clave = $_GET['cs'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$aux = explode('.',$ip);
	$ip_cmm = $aux[0].'.'.$aux[1];
	$caso = $_GET['caso'];
	if(trim($caso) == '')
	{
		$caso = 'directorio';
	}
	$codificacion = $_GET['codificacion'];
	$codificadora = $_GET['codificadora'];
	if($clave == $c_autorizada)
	//if($clave == $c_autorizada && ($ip_cmm == '172.16' || $ip == '146.83.7.1' || $ip == '200.89.68.134' ))
	{	
		if(trim($codificacion) != '' && trim($codificadora) != '')
		{
			$archivo_filtrados 		= "codificacion".$codificacion."_".$codificadora."_filtrados.txt";
			$archivo_codificados 	= "codificacion".$codificacion."_".$codificadora."_codificados.txt";
			if($caso == 'eliminacion')
			{				
				$archivo_escritura = $_GET['archivo'];
				if($archivo = fopen($archivo_codificados, "a"))
				{
					if(fwrite($archivo,$archivo_escritura. "\n"))
					{
						echo "El archivo ".$archivo_escritura." se registró como codificado<br>";
					}
					else
					{						
						echo "ERROR: El archivo ".$archivo_escritura." no se registró como codificado<br>";
					}
					fclose($archivo);
				}
			}
			$codificados 	= file_get_contents($archivo_codificados);
			$filtrados 		= file_get_contents($archivo_filtrados);
			$salida = trim($codificados)."\n".trim($filtrados);
			$salida_arreglo = explode("\n",trim($salida));
			$total = count($salida_arreglo);
			for($i=0; $i < $total; $i++)
			{
				$salida_revision[strtoupper(trim($salida_arreglo[$i])).'.pdf'] = 1;
				$salida_revision[strtoupper(trim($salida_arreglo[$i])).'.jgp'] = 1;
				$salida_revision[strtoupper(trim($salida_arreglo[$i]))] = 1;
				$salida_revision[trim($salida_arreglo[$i])] = 1;
			}
			 //print_r($salida_revision); 
			
			$directorio = VarConfig::path_site_repositorio.'doc/codificacionarpa/';  
			if(is_dir($directorio))
			{
				$archivos = Funciones::obtenerListaArchivos($directorio) ; 
				ksort($archivos);
				// print_r($archivos); 
				foreach($archivos as $archivo => $caso)
				{ 
					$aux = explode(' ',$archivo);
					if(count($aux)>1 || $archivo == 'index.php')
					{
						continue;
					}
					echo $archivo.'<br>';
					if(!isset($salida_revision[$archivo]))
					{   
						echo "<tr>";
						echo "<td><a href='visualizacion_archivo.php?cs=d6dcb1c752ae7a7dcdc59978be2b7113&archivo=".$archivo."&codificacion=".$codificacion."&codificadora=".$codificadora."'>".$archivo.'</a></td>';
						 echo "<td><a href=lectura_archivo.php?cs=d6dcb1c752ae7a7dcdc59978be2b7113&caso=eliminacion&archivo=".$archivo."&codificacion=".$codificacion."&codificadora=".$codificadora.">Marcar ".$archivo." como revisado codificadora ".$codificadora."</a></td>";
						echo "<tr>";
					}
				} 
			} 
		}
	}
	else
	{
		echo "Sin acceso";
	}
?> 
	</table>
</body>
</html>