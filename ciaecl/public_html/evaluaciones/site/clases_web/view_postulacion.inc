<?php

	global $ControlHtml; 
	$opcion = explode('_',$ControlHtml->lastActionArray[0]);
	unset($opcion[0]);
	unset($opcion[1]);
	$opcion = implode('_',$opcion); 
  	$valoresGet = VarSystem::getGet();  
 	$valores 	= VarSystem::getPost();
 	$archivos 	= VarSystem::getFile();
 	if(count($valores) == 0)
 	{
 		$valores = VarSystem::getGet(); 
 	} 
 	//Funciones::mostrarArreglo($valores);
 	
	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'postulacion/'.$opcion.'.tpl'); 
  
 	$e->setVariable('opcion_extra',$opcion); 	
 	$e->setVariable('page',$ControlHtml->lastActionArray[0]); 	
	
	switch($valores['guardar'])
	{
		default:
			$e->addTemplate('bloque_formulario');
		break;
		case 'guardar_carta':
			
			$e->addTemplate('bloque_formulario_carta');
			$Postulacion = new Postulacion();
			$Postulacion->buscarObjeto($valores['form_email']);
			$variable 		= get_object_vars($Postulacion); 
			foreach($variable as $var => $val)
			{ 
				$e->setVariable($var,$val);	
			}
			foreach($valores as $var => $val)
			{
				$aux = explode('_',$var);
				if($aux[0] == 'form')
				{
					unset($aux[0]);
					$var = implode('_',$aux);
					$Postulacion->$var = $val;
					$e->setVariable($var,$val);
				}
			}
			if(is_array($archivos) && count($archivos) > 0)
			{
				$path_doc  	= VarSystem::getPathVariables('dir_repositorio').'doc/postulacion/';	 
				foreach($archivos as $variable => $archivo_detalle)
				{  
					$archivos[$variable]['new_name'] = $valores['form_email'].'_'.$variable;
					$DocumentFile  = new DocumentFile($path_doc); 
					$DocumentFile->checkPath(); 
					$DocumentFile->setFileArray($archivos[$variable]); 
					if($DocumentFile->saveFile(false))
					{
						$nombre_archivo  = $DocumentFile->getFileName(); 
						$Postulacion->$variable = $nombre_archivo;	 
					} 				
				}
			}
			$Postulacion->guardarObjeto();	
			
			$e->addTemplate('bloque_formulario_carta_exito');	 
				
			$cartaInscripcion = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'postulacion/carta_recomendacion.tpl'); 
			$variable 		= get_object_vars($Postulacion); 
			foreach($variable as $var => $val)
			{ 
				$cartaInscripcion->setVariable($var,$val);	
			}  				
	 		$aux = 'carta'.$valores['numero'].'_nombre';	
			$carta_nombre_completo = 	$variable[$aux];
			$cartaInscripcion->setVariable('carta_nombre_completo',$carta_nombre_completo);	
			$asunto = 'Llamado a concurso: carta de recomendación / Call for proposals: recommendation letter '; 
	 		$aux = 'carta'.$valores['numero'].'_email';	  
	 		Funciones::sendEmail($Postulacion->email,$asunto,$cartaInscripcion->toHtml()); 	 
	 		Funciones::sendEmail($variable[$aux],$asunto,$cartaInscripcion->toHtml()); 

						
		break;
		case 'cartas': 
			$e->addTemplate('bloque_formulario_carta');
 			$e->setVariable('page',$ControlHtml->lastActionArray[0]); 	
			$Postulacion 	= new Postulacion();
			$Postulacion->buscarPorValor('email_md5',$valores['cs']);
			$variable 		= get_object_vars($Postulacion);
			$ultimo_numero	= 4;
			foreach($variable as $var => $val)
			{ 
				$e->setVariable($var,$val);				
				$aux 		= explode('_',$var);
				$numero 	= str_replace('carta','',$aux[0]); 
				$varcarta 	= 'carta'.$numero.'_nombre';
				if($var == $varcarta && trim($val) == '')
				{
					$ultimo_numero = $numero;
					break;
				}
			}  
			if($ultimo_numero == 4)
			{				
				$e->addTemplate('bloque_formulario_carta_completo');
			}
			else
			{
				$e->addTemplate('bloque_formulario_carta_detalle');
				$e->setVariable('numero',$numero);	
			}
			
			Funciones::mostrarArreglo($variable);		 
		break;
		case 'guardar':
			
			$e->addTemplate('bloque_formulario'); 
			$Postulacion = new Postulacion();
			$Postulacion->buscarObjeto($valores['form_email']);
			foreach($valores as $var => $val)
			{
				$aux = explode('_',$var);
				if($aux[0] == 'form')
				{
					unset($aux[0]);
					$var = implode('_',$aux);
					$Postulacion->$var = $val;
					$e->setVariable($var,$val);
				}
			}
			$Postulacion->email_md5 = md5($valores['form_email']); 
			if(is_array($archivos) && count($archivos) > 0)
			{
				$path_doc  	= VarSystem::getPathVariables('dir_repositorio').'doc/postulacion/';					
				$archivo_numero = 0; 
				foreach($archivos as $variable => $archivo_detalle)
				{  
					$archivos[$variable]['new_name'] = $valores['form_email'].'_'.$variable;
					$DocumentFile  = new DocumentFile($path_doc); 
					$DocumentFile->checkPath(); 
					$DocumentFile->setFileArray($archivos[$variable]); 
					if($DocumentFile->saveFile(false))
					{
						$nombre_archivo  = $DocumentFile->getFileName(); 
						$Postulacion->$variable = $nombre_archivo;	
						$archivo_numero++; 
					}
					//Funciones::mostrarArreglo($DocumentFile);					
				}
			}
			
			$e->refreshTemplate();
			if($archivo_numero < 3)
			{ 				 
				$e->addTemplate('bloque_mensaje_error');
			}
			else
			{
				$Postulacion->guardarObjeto();
				$e->addTemplate('bloque_mensaje_exito'); 
				$e->setVariable('email_md5',$Postulacion->email_md5);
				$e->addTemplate('bloque_formulario_cierre_exito');  
				
				$cartaInscripcion = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'postulacion/carta_postulante.tpl'); 
				$variable 		= get_object_vars($Postulacion); 
				foreach($variable as $var => $val)
				{ 
					$cartaInscripcion->setVariable($var,$val);	
				}  	
				$asunto = 'Llamado a concurso / Call for proposals ';	  
		 		Funciones::sendEmail($Postulacion->email,$asunto,$cartaInscripcion->toHtml()); 
				
			}			
			Funciones::mostrarArreglo($Postulacion);
		break;
	}
 	
	echo $e->toHtml();
?> 