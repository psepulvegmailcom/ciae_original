<?php

	global $ControlHtml; 
	$opcion = explode('_',$ControlHtml->lastActionArray[0]);
	unset($opcion[0]);
	unset($opcion[1]);
	$opcion = implode('_',$opcion); 
  	$valoresGet = VarSystem::getGet();  
  	
  	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'inscripcion/validaciondeprueba2014_extra.tpl'); 
	$e->setVariable('opcion_extra',$opcion);
 	$valores = VarSystem::getPost();
 	
 	if(isset($valores['guardar']))
 	{ 
 		switch($valores['guardar'])
 		{
 			case 'guardar':
 				$Inscripcion 				= new Inscripcion();   
 				$Inscripcion->consultaInscripcionRut(trim($valores['form_rut']),'2014-ValidacionPruebaINICIA_junio%');
 				$Inscripcion->inicia_rendicion_sede = 'CIAE';
 				$Inscripcion->inicia_rendicion_fecha = trim($valores['form_inicia_rendicion_fecha']);
 				$Inscripcion->inicia_rendicion_fecha_extra = trim($valores['form_inicia_rendicion_fecha_extra']);
 				$Inscripcion->saveObject('email = "'.$Inscripcion->email.'" AND tipo_inscripcion = "'.$Inscripcion->tipo_inscripcion.'"');
 				
 				$e->addTemplate('bloque_consulta_resultado_final');
 				$e->setVariable('form_inicia_rendicion_fecha',$valores['form_inicia_rendicion_fecha']); 
 				if(trim($valores['form_inicia_rendicion_fecha_extra']) != '')
 				{
					$valores['form_inicia_rendicion_fecha_extra'] = ' y '.$valores['form_inicia_rendicion_fecha_extra'];
				}
 				$e->setVariable('form_inicia_rendicion_fecha_extra',$valores['form_inicia_rendicion_fecha_extra']);
			break;
		 	case 'consultaRut':
				$Inscripcion 				= new Inscripcion();   
 				$Inscripcion->consultaInscripcionRut(trim($valores['form_rut']),'2014-ValidacionPruebaINICIA_junio%');
 				//Funciones::mostrarArreglo($Inscripcion);
 				if(isset($Inscripcion->rut) && trim($Inscripcion->rut) != '')
 				{
 					$e->addTemplate('bloque_con_consultar');
 					$datos = get_object_vars($Inscripcion);
			 	  	Funciones::mostrarArreglo($datos,true);
					foreach($datos as $var => $val)
					{
						$e->setVariable($var,$val);  
					}
					
					$aux = explode(' ',$datos['inicia_rendicion_fecha']);
					$unica = end($aux);
					
					if($unica == 'unica')
					{
						$e->setVariable('checked_fecha_'.$aux[0],'checked');
					}    
					
					if($Inscripcion->tipo_inscripcion == '2014-ValidacionPruebaINICIA_junio_dobleparticipacion' || $Inscripcion->tipo_inscripcion == '2014-ValidacionPruebaINICIA_junio')
					{
						$e->addTemplate('bloque_postulacion_dos_fecha_informacion');
						$e->addTemplate('bloque_postulacion_dos_fecha_seleccion');
						$aux = explode(' ',$datos['inicia_rendicion_fecha_extra']);
						$unica = end($aux); 
						
						if($unica == 'unica')
						{
							$e->setVariable('checked_fecha_extra_'.$aux[0],'checked');
						} 
					}
					else
					{
						// simples
						$e->addTemplate('bloque_postulacion_una_fecha_informacion');
					}
					
					
				}
				else
				{
					$e->addTemplate('bloque_sin_consulta_resultado');
				}
		 	
		 	break;
		}	
 	}
 	else
 	{
		$e->addTemplate('bloque_sin_consultar');
	}
	
 	
 	echo $e->toHtml();
?>