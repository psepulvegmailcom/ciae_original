<?php
	global $ControlHtml;  	  
  
	$ControlHtml->revisionSesion(); 
	
	$ControlVistaCorreccionDefinitivo = new ControlVistaCorreccionDefinitivo();
	
	$lastAction 	= $ControlHtml->lastActionArray; 
	
	switch($lastAction[0])
	{
		case 'view_reporte_inconsistencias': 
			$CorreccionInconsistencia = new CorreccionInconsistencia();
			$base = $CorreccionInconsistencia->sourceTable;			
		break;
		case 'view_reporte_revisiones_usuarios':  
			$base = 'view_correcciones_por_usuarios';			
		break;
	}	 
	
	  
	$ControlVistas = new ControlVistas($base);
	$listado = $ControlVistas->obtenerListado(); 
	
	
	$total 		= count($listado);

	$contenido = Funciones::generarTabla($listado);	
  
	
	$MantenedoresGeneral 	= new MantenedoresGeneral();
	//Funciones::mostrarArreglo($listado,true);
	
	$path_admin	= VarSystem::getPathVariables('dir_template').'intranet_textos/reportes/'; 
 
	 
	$path 		= VarSystem::getPathVariables('dir_repositorio_tmp');
	
	$archivo = SIDTOOLHtml::escribirExcelTabla($contenido,$path); 
	 
	$salida = new miniTemplate($path_admin.'generico.tpl');
	$salida->setVariable('archivo_tmp',$archivo);
	$salida->setVariable('reporte',$contenido);
	echo $salida->toHtml();
?>