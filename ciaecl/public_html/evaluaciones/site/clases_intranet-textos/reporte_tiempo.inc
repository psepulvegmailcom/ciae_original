<?php
	global $ControlHtml;  	  
  
	$ControlHtml->revisionSesion(); 
	
	$ControlVistaCorreccionTiempos = new ControlVistaCorreccionTiempos();
	$listado = $ControlVistaCorreccionTiempos->buscarPromedioTiempos();
	$MantenedoresGeneral 	= new MantenedoresGeneral();
	//Funciones::mostrarArreglo($listado,true);
	
	$path_admin		= VarSystem::getPathVariables('dir_template').'intranet_textos/reportes/'; 
	$e = new miniTemplate($path_admin.'tiempos.tpl');
	 
	 
	$total = count($listado);  
	for($i=0; $i < $total; $i++)
	{
		$e->addTemplate('reporte_lista_item');
		$listado[$i]['fila'] = $i + 1;  
		foreach($listado[$i] as $var => $val)
		{
			if($var == 'time_promedio_minuto' || $var == 'time_promedio_segundo')
			{
				$val = str_replace('.',',',$val);
			}
			$e->setVariable($var,trim($val));
		}  
		$e->setVariable('class_color','fondo_claro');
		if($i%2 == 0)						
		{
			$e->setVariable('class_color','fondo_oscuro');
		}
	}


	
	$output = $e->toHtml();
	 
	$path 		= VarSystem::getPathVariables('dir_repositorio_tmp');
	
	$archivo = SIDTOOLHtml::escribirExcelTabla($output,$path);
	
	 
	$salida = new miniTemplate($path_admin.'generico.tpl');
	$salida->setVariable('archivo_tmp',$archivo);
	$salida->setVariable('reporte',$output);
	echo $salida->toHtml();
?>