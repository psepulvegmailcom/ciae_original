<table style="width:900px ">
<tr><td> 
<?php
	include ("config.cfg");
	$ControladorDeObjetos = new ControladorDeObjetos();
	
	 
	$directorio 	= VarConfig::path_extraccion_imagenes;
	$archivos_dir 	= Funciones::obtenerListaArchivos($directorio,false); 
	//Funciones::mostrarArreglo($archivos_dir,true);  
	$aplicacion 	= VarConfig::path_extraccion_exiftool;
	
	foreach($archivos_dir as $dias => $archivos)
	{
		$aux = explode('_',$dias);
		$datos['fecha'] = $aux[0];
		$datos['curso'] = $aux[1];
		$datos['alumno'] = $aux[2];  
		
		foreach($archivos as $clip => $imagenes)
		{ 
			$aux = explode('_',$clip);
			$datos['clase'] = $aux[0];			
			$datos['clip'] 	= $aux[1]; 
			$directorio_revisar = $directorio."".$dias."/".$clip."/";
			if(!is_dir($directorio_revisar))
			{
				continue;
			}
			$aux 	= '"'.$aplicacion.'" -o %d%f.xmp  '.$directorio_revisar;
			$salida = $aux.' <br><br><br>';
			$salida = str_replace("/","\\",$salida);
			echo $salida; 
		//print_r($datos);
		}
	}
?>
 
</td></tr>
</table>