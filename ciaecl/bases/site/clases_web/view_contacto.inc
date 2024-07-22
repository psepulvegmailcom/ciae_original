<?php

	global $ControlHtml; 
  	$valoresGet = VarSystem::getGet();
  	$valores 	= VarSystem::getPost();

  	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'contacto_es.tpl');
	
	 
	$aux = explode('@',$valores['email']);
	
  	if(isset($valores['caso']) && trim($valores['caso']) == 'guardar' && trim($valores['email']) != '' && count($aux) > 1 && strlen(trim($valores['email'])) > 2)
  	{  
		$aux = explode('.',trim($valores['email']));
		$ext = array_pop($aux);
		  
			$ControladorContacto = new ControladorContacto();
			//$ControladorContacto->enviarContacto($valores);  
			$e->addTemplate('bloque_mensaje_enviado');
			$e->setVariable('langSite_contacto_mensaje_enviado','Hemos recibido su mensaje, responderemos lo mas pronto posible. Muchas gracias');

			if(isset($valores['suscripcion']))
			{    
				$ControladorInscripcionBase = new ControladorInscripcionBase();
			//	$ControladorInscripcionBase->insertarContacto($valores['nombre'],$valores['email'],'ciae_inscripcion_suscripcion_'.VarSystem::getPathVariables('web_site'));	  		
				$e->addTemplate('bloque_suscripcion_enviado');
			}	 
				
			$Inscripcion = new Inscripcion(); 
			//$Inscripcion->consultaEmail(trim($valores['email']));
			//unset($Inscripcion->fecha_actualizacion);
			$Inscripcion->tipo_inscripcion = 'contacto_'.time();
			$Inscripcion->nombre = $valores['nombre'];	
			$Inscripcion->email = trim($valores['email']);		
			$Inscripcion->campo_extra1 =  "Sitio ".$_SERVER['SERVER_NAME']."\n\n ".$valores['mensaje'];
			$Inscripcion->newObject = true;
			//print_r($valores);
			//print_r($Inscripcion);
			$Inscripcion->guardar();  
			$ControladorInscripcionBase = new ControladorInscripcionBase();
			$ControladorInscripcionBase->insertarNuevaInscripcion($Inscripcion); 
			
			$InscripcionDestino = new InscripcionDestino();	
			$InscripcionDestino->buscarObjeto(trim($valores['email']),$Inscripcion->tipo_inscripcion."_registro");		
			$InscripcionDestino->caso_envio = $Inscripcion->tipo_inscripcion."_registro";
			$InscripcionDestino->nombre = trim($valores['nombre']);			
			$InscripcionDestino->email = trim($valores['email']);			
			$InscripcionDestino->estado = 'enviado';
			$InscripcionDestino->mensaje  = $Inscripcion->campo_extra1;
			$InscripcionDestino->guardarObjeto(trim($valores['email']),$Inscripcion->tipo_inscripcion."_registro");	  
			
			$InscripcionDestino = new InscripcionDestino();	
			$InscripcionDestino->buscarObjeto(trim($valores['email']),$Inscripcion->tipo_inscripcion."_registro");				 
			$InscripcionDestino->estado = 'no_enviado'; 
			$InscripcionDestino->newObject = true;		
			$InscripcionDestino->caso_envio = "formulario_contacto";	
			$InscripcionDestino->guardarObjeto(trim($valores['email']),"formulario_contacto");		 
		 
	}
	
	if (VarSystem::getPathVariables('web_site')=='web_mejormatematica')
	{
		$ControlNoticias = new  ControlNoticias();
		$elementos = $ControlNoticias->obtenerNoticiasRecientes();
		if(is_array($elementos) && count($elementos)>0)
		{
			$e->addTemplate('bloque_noticia_reciente');   
			
			$max_noticias = count($elementos);
			for($i=0; $i <  $max_noticias;$i++)
			{
				$e->addTemplate('bloque_noticia');
				if(trim($elementos[$i]['imagen']) == '')
				{
					$elementos[$i]['imagen'] = 'blanco.jpg';
				}
				$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
				$e->showDataSimple($elementos[$i]);
			}
		} 
	}


	
	echo $e->toHtml();
?>