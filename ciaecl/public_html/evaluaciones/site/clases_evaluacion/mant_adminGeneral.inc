<?php 
		 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	  
	$theSession 	= $ControlHtml->theSession;   
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'evaluaciones/administracion/';   

	$MantenedoresGeneral 		= new MantenedoresGeneral();
	$ControlGeneralCorreccion 	= new ControlGeneralCorreccion($ControlHtml->theSession->userObject,$lastAction );
	
	$valores 					= VarSystem::getPost(); 	
	$user_permiso				= $ControlHtml->theSession->userObject->permiso;
	$username		 			= $ControlHtml->theSession->userObject->username;
 
 	$ControlGeneralEvaluaciones	= new ControlGeneralEvaluaciones($ControlHtml->theSession->userObject,$lastAction );

 	$e = new miniTemplate($path_admin.'mant.tpl'); 
	
 	$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);


//Funciones::mostrarArreglo($valores,true);
switch($lastAction[1])
{
	case 'guardarI1':
		$ControlGeneralEvaluaciones->guardarI1($valores);
		
	break;
	case 'guardarC1':
		$ControlGeneralEvaluaciones->guardarC1($valores);
		
	break;

	case 'guardarI2':
		$ControlGeneralEvaluaciones->guardarI2($valores);
		

	break;
	case 'guardarC2':
		$ControlGeneralEvaluaciones->guardarC2($valores);
		
	break;

	case 'guardarI3':
		$ControlGeneralEvaluaciones->guardarI3($valores);
		
	break;
	case 'guardarC3':
		$ControlGeneralEvaluaciones->guardarC3($valores);
		
	break;

	default:
	break;
	


}	


	
	$ControlGeneralEvaluaciones->revisionEstadoEtapas();
		
	$etapas = $ControlGeneralEvaluaciones->datos['etapas']['listado'];
	
	$total = count($etapas);
	

for($i=0; $i < $total; $i++)
	{
		$e->addTemplate('bloque_lista_item_admin'); 
		$fila = $i + 1;
		$etapas[$i]['fila'] = $fila;
		$etapas[$i]['estado_html'] = ucfirst($etapas[$i]['estado']); 
		$etapas[$i]['etapa_html']  = ucfirst($etapas[$i]['etapa']); 
		$e = $MantenedoresGeneral->mostrarElementoValores($e,$etapas[$i]);
		$e = $MantenedoresGeneral->colorFilaGenerico($e,$i);
		
		$salida = $ControlGeneralEvaluaciones->revisionEstadoCompletoActividad($etapas[$i]['id_etapa']); 
		$e 		= $MantenedoresGeneral->mostrarElementoValores($e,$salida);
		
		Funciones::mostrarArreglo($salida);	
	} 

for($i=0; $i < $total; $i++)
	{
		$e->addTemplate('bloque_lista_envios_actuales'); 
		$fila = $i + 1;
		$etapas[$i]['fila'] = $fila;
		$etapas[$i]['estado_html'] = ucfirst($etapas[$i]['estado']); 
		$etapas[$i]['etapa_html']  = ucfirst($etapas[$i]['etapa']); 
		$e = $MantenedoresGeneral->mostrarElementoValores($e,$etapas[$i]);
		$e = $MantenedoresGeneral->colorFilaGenerico($e,$i);
		
		$salida = $ControlGeneralEvaluaciones->revisionEstadoCompletoActividad($etapas[$i]['id_etapa']); 
		$e 		= $MantenedoresGeneral->mostrarElementoValores($e,$salida);
		
		Funciones::mostrarArreglo($salida);	
	} 

 	Funciones::mostrarArreglo($ControlGeneralEvaluaciones); 

	echo $e->toHtml(); 

?>