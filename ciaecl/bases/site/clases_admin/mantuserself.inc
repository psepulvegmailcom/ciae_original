<?php

	global $ControlHtml;
	$siteTitle 			= $ControlHtml->siteTitle;
	$theSession 		= $ControlHtml->theSession; 
	$lastAction 		= $ControlHtml->lastActionArray; 
    
	//$ControlHtml->setTituloModulo('Mi Cuenta'); 
	$ControlHtml->revisionSesion();		
	 
	$laPagina			= $ControlHtml->laPagina;
	$elUsuarioP 		= $ControlHtml->elUsuarioP;
	$lastAction 		= $ControlHtml->lastActionArray;
	$theSession 		= $ControlHtml->theSession;
	$ControlPersona 	= new PersonaControl();
	$ControlPersona->setPersonaByUser($elUsuarioP); 
	 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'cuenta_form.tpl'); 
	   
	$guardar_exito = true;
	if(trim($lastAction[1]) == 'guardar_datos')
	{ 
		
		$ControlPersona->obj->nombre 			= VarSystem::getVariable("nombre_nombre");
		$ControlPersona->obj->apellido_paterno 	= VarSystem::getVariable("apellido_paterno");
		$ControlPersona->obj->apellido_materno 	= VarSystem::getVariable("apellido_materno"); 
		$ControlPersona->savePersona();

		$PersonaObjetos = new PersonaObjetos();
		$PersonaObjetos->buscarUserId($ControlPersona->obj->user_id);  
		//Funciones::mostrarArreglo($PersonaObjetos,true);
		$PersonaObjetos->nombre 			= VarSystem::getVariable("nombre_nombre");
		$PersonaObjetos->apellido_paterno 	= VarSystem::getVariable("apellido_paterno");
		$PersonaObjetos->apellido_materno 	= VarSystem::getVariable("apellido_materno"); 
		$PersonaObjetos->guardarObjeto();
					
		$password = trim(VarSystem::getVariable("new_password"));
		$repassword = trim(VarSystem::getVariable("new_repassword"));
		$cambio_password = false;
		if($password == $repassword)
		{			
	 		$cambio_password = true;
		 	$elUsuarioP->updatePassword($password);
		}
		//Funciones::mostrarArreglo($ControlPersona,true);
		if(VarSystem::getVariable("email") != $ControlPersona->obj->email)
		{  
			if($elUsuarioP->existeUsuarioByEmail(VarSystem::getVariable("email")))
			{				
				$e->addTemplate('mensaje_error'); 	
				$guardar_exito = false;		
			}	
			else
			{
				$ControlPersona->obj->email 	= VarSystem::getVariable("email");
				$ControlPersona->savePersona();  	
				$PersonaObjetos->email			 	= VarSystem::getVariable("email"); 
				$PersonaObjetos->guardarObjeto();
			}
		} 
	
		if($guardar_exito)
		{
			$e->addTemplate('mensaje_exito'); 	
			$e->refreshTemplate();
		} 
		
	 	$email = new miniTemplate(VarSystem::getPathVariables('dir_template').'site/cartas/olvido_passowrd.tpl'); 
		$email->setVariable('email_persona_nombre',$ControlPersona->getNombreCompleto());
		$email->setVariable('email_persona_email',$ControlPersona->obj->email);
		$email->setVariable('email_persona_username',$elUsuarioP->username);				 
		$email->setVariable('email_persona_password',VarSystem::getVariable("new_password"));
		 
		$mensaje = $email->toHtml();	
		$asunto = "[INTRANET] Edici&oacute;n de datos de usuario intranet"; 
		Funciones::sendEmail($ControlPersona->getEmail(),$asunto,$mensaje);	  
	} 
	
	$e->setVariable('username',$elUsuarioP->username);
	$e->setVariable('nombre',$ControlPersona->obj->nombre);	
	$e->setVariable('apellido_paterno',$ControlPersona->obj->apellido_paterno);	
	$e->setVariable('apellido_materno',$ControlPersona->obj->apellido_materno);	
	$e->setVariable('email',$ControlPersona->obj->email);	
	 	
	echo $e->toHtml(); 
?>