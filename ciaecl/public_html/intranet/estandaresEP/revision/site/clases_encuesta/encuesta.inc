<?php

	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession;  
	$lastAction 	= $ControlHtml->lastActionArray; 
 	$ControlEncuesta = new ControlEncuesta($ControlHtml->elUsuarioP->username); 
 	$ControlEncuesta->setUsuario($ControlHtml->elUsuarioP);
 	$ControlHtml->revisionSesion();	
 	
	$PersonaControl 		= new PersonaControl();  
	$PersonaControl->setPersonaByUser($ControlHtml->elUsuarioP); 
 	//if(!$PersonaControl->datosCompletos() && $ControlHtml->elUsuarioP->perms == 5)
// 	{
//		Funciones::redirigirPagina('Antes de revisar los estándares debe completar los datos de inscripción, gracias','mantuserself');
//	}
 	
	$valores 	 	= VarSystem::getPost();	
    //Funciones::mostrarArreglo($valores);	 
  	switch($lastAction[0])
  	{
	  	case 'encuesta':
			$ControlHtml->setTituloModulo("Revisión Estándares");
		 	switch($lastAction[1])
		 	{
		 		case 'componentes':
		 			$e = $ControlEncuesta->mostrarComponentes();
		 		break;
		 		case 'elementos':
		 			$e = $ControlEncuesta->mostrarElementos();
		 		break;
		 		case 'pregunta':		 			 
		 			$e = $ControlEncuesta->mostrarPregunta();
		 		break; 
		 		case 'guardar_area':
		 			$ControlEncuesta->guardarAreas($valores); 
		 			$e = $ControlEncuesta->mostrarAreas();
				break; 		 		
		 		default: 
		 			//$e = $ControlEncuesta->mostrarAreas();
		 			$e = $ControlEncuesta->mostrarComponentes();
		 		break;
		 	}
	 	break;
 		case 'glosario':
			$ControlHtml->setTituloModulo("7 Glosario"); 
 			$e = $ControlEncuesta->mostrarGlosario();
 		break;
	 	case 'encuesta_envio':	 	
			$ControlHtml->setTituloModulo("6 Envio Cuestionarios");
			if($lastAction[1] == 'guardar_encuesta') 
			{
				$ControlEncuesta->enviarEncuesta();
			}
			$e = $ControlEncuesta->mostrarEnvio();	
		break;
	 	case 'encuesta_propuesta':
			$ControlHtml->setTituloModulo("4 Propuesta de Estándares"); 
			$e = $ControlEncuesta->mostrarPropuestas();	
	 	break;
	 	case 'encuesta_ayuda':
			$ControlHtml->setTituloModulo("2 Ayuda"); 
			$e = $ControlEncuesta->mostrarAyuda();	
	 	break;
 		case 'encuesta_medio': 		 
			$ControlHtml->setTituloModulo("6 Cuestionario Medios de Verificación"); 
			$e = $ControlEncuesta->mostrarMediosVerificacion();		
	 	break;
 	}
 	
 	if(is_object($e))
 	{
 		$e->showData($valores); 
 		$e->setVariable('encuesta_enviada',(int)$ControlEncuesta->encuesta_enviada); 
 		$e->setVariable('destacado_'.$lastAction[0],'barra_destacado');
 		echo $e->toHtml();
	}	
?>