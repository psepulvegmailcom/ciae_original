<?

	global $ControlHtml;
	$siteTitle 			= $ControlHtml->siteTitle;
	$theSession 		= $ControlHtml->theSession; 
	$lastAction 		= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Mi Cuenta'); 
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
	 	$elUsuarioP->updatePassword(VarSystem::getVariable("new_password"));
		$ControlPersona->obj->nombre 			= VarSystem::getVariable("nombre_nombre");
		$ControlPersona->obj->apellido_paterno 	= VarSystem::getVariable("apellido_paterno");
		$ControlPersona->obj->apellido_materno 	= VarSystem::getVariable("apellido_materno");
		$ControlPersona->savePersona();
		
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
			}
		} 
	
		if($guardar_exito)
		{
			$e->addTemplate('mensaje_exito'); 	
			$e->refreshTemplate();
		}
			
		
		$email = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/email/olvido_password.tpl');
		$email->setVariable('email_sitio_nombre',$siteTitle['completo']); 
		$email->setVariable('email_persona_nombre',$ControlPersona->getNombreCompleto());
		$email->setVariable('email_persona_email',$ControlPersona->getEmail());
		$email->setVariable('email_persona_username',$elUsuarioP->username);				 
		$email->setVariable('email_persona_password',VarSystem::getVariable("new_password"));
		
		$email->addTemplate('edicion_password'); 
		$mensaje = $email->toHtml();	
		$asunto = "Edición de Datos de Usuario"; 
		Funciones::sendEmail($ControlPersona->getEmail(),$asunto,$mensaje);	 
		
	} 
	
	$e->setVariable('username',$elUsuarioP->username);
	$e->setVariable('nombre',$ControlPersona->obj->nombre);	
	$e->setVariable('apellido_paterno',$ControlPersona->obj->apellido_paterno);	
	$e->setVariable('apellido_materno',$ControlPersona->obj->apellido_materno);	
	$e->setVariable('email',$ControlPersona->obj->email);	
	 	
	echo $e->toHtml(); 
?>