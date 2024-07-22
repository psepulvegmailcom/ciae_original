<?php
	global $ControlHtml;  	  
  
	$ControlHtml->revisionSesion(); 
	
	$ControlVistaCorreccionDefinitivo = new ControlVistaCorreccionDefinitivo();
	
	$lastAction 	= $ControlHtml->lastActionArray; 
	
	
	$prefijo = str_replace('view_reporte_definitvo','',$lastAction[0]);
	  
	$listado 	= $ControlVistaCorreccionDefinitivo->obtenerListadoListadoOficial($prefijo); 
	
	
	$total 		= count($listado);
	for($i=0; $i < $total; $i++)
	{
		for($j=1; $j < 6; $j++)
		{
			if($listado[$i]['criterio_5_'.$j] == 'no')
			{
				$listado[$i]['criterio_5_'.$j] = '0';
			} 	
			else
			{
				$listado[$i]['criterio_5_'.$j] = '1';
			}
		} 
		$listado[$i]['url'] = VarConfig::path_site_www; 
	}  
	
	$MantenedoresGeneral 	= new MantenedoresGeneral();
	//Funciones::mostrarArreglo($listado,true);
	
	$path_admin	= VarSystem::getPathVariables('dir_template').'intranet_textos/reportes/'; 
	$e 			= new miniTemplate($path_admin.'definitivo.tpl');
	
	$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$listado,'reporte_lista_item');
	$output = $e->toHtml();
	 
	$path 		= VarSystem::getPathVariables('dir_repositorio_tmp');
	
	$archivo = SIDTOOLHtml::escribirExcelTabla($output,$path); 
	 
	$salida = new miniTemplate($path_admin.'generico.tpl');
	$salida->setVariable('archivo_tmp',$archivo);
	$salida->setVariable('reporte',$output);
	echo $salida->toHtml();
?>