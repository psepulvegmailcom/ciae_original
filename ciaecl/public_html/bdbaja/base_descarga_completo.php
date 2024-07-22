<?php

	$config = "../config.cfg";   
  	include $config;   
  	 
  	$valores = VarSystem::getGet(); 

	if(!isset($valores['caso']) || trim($valores['caso']) == '' || !isset($valores['c']) || trim($valores['c']) == '')
	{
		$contenido = "ERROR 1: debe indicar url correcto";	
	}
	else
	{
		$c_autorizada = substr(VarConfig::regkey_system,0,6);
		if(trim($valores['c']) != $c_autorizada)
		{
			$contenido = "ERROR 2: debe indicar url correcto";	
		}
		else
		{			
			$base 	= 'view_tmp_'.$valores['caso'];
			$ControlVistas = new ControlVistas($base);
			$output = $ControlVistas->obtenerListado(); 
			$autores = array();
			switch($valores['caso'])
			{
				case 'proy_ciae_extra':					
					$ControlClasePersonas = new ControlProyectosPersonas();	
					$autores = $ControlClasePersonas->obtenerListadoPersonasCompleto();
				break;
				case 'pub_ciae_extra':					
					$ControlClasePersonas = new ControlPublicacionesPersona(); 
					$autores = $ControlClasePersonas->obtenerListadoPersonasCompleto();
				break;
			}
			//Funciones::mostrarArreglo($autores,true);
			//Funciones::mostrarArreglo($output,true);
			if(is_array($autores) && count($autores)>0)
			{
				for($i=0; $i < count($output);$i++)
				{
					$output[$i]['autores'] = $autores[$output[$i]['id_publicaciones']];
				}	
			}		
			if(is_array($output) && count($output)>0)
			{
				$contenido = Funciones::generarTabla($output,false);
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition:  filename=".date("Ymd")."-".$base."-".str_replace(" ","",VarConfig::site_title).".xls;");
				$contenido = stripcslashes($contenido);	
			}
			else
			{
				$contenido = "ERROR 3: tabla no existe o no tiene contenido";	
			}
		}
	}

	echo $contenido;
?>