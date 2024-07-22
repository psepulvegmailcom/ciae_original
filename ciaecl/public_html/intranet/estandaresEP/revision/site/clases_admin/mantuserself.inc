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
	
	/* bloques de meses y agnos */
	$e->setVariable('mes_valor_cargo',0);
	$e->setVariable('agno_valor_cargo',0);
	$e->setVariable('mes_valor_servicio',0);
	$e->setVariable('agno_valor_servicio',0);
	for($i=1; $i <= 80; $i++)
	{
		if($i <= 12)
		{
			$e->addTemplate('bloque_meses_cargo');
			$e->setVariable('mes_valor',$i);
			$e->addTemplate('bloque_meses_servicio');
			$e->setVariable('mes_valor',$i);
		}
		$e->addTemplate('bloque_agnos_cargo');
		$e->setVariable('agno_valor',$i);
		$e->addTemplate('bloque_agnos_servicio');
		$e->setVariable('agno_valor',$i);		
	}
	$e->refreshTemplate();
	  
	$guardar_exito = true;
	if(trim($lastAction[1]) == 'guardar_datos')
	{ 		
		$valores 					= VarSystem::getPost();
	 	foreach($valores as $key => $valor)
		{
			$aux = str_replace('guardar_valor_','',$key);
			if(trim($aux) != trim($key))
			{ 
				$ControlPersona->obj->$aux = $valor;	
			}
		}
		$ControlPersona->savePersona();
 		//Funciones::mostrarArreglo($valores);
		//Funciones::mostrarArreglo($ControlPersona->obj);
		
		if(trim($valores['new_password']) != '')
	 	{
	 		$elUsuarioP->updatePassword(VarSystem::getVariable("new_password"));
	 	}	
		
		if(VarSystem::getVariable("guardar_valor_email") != $ControlPersona->obj->email)
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
	//Funciones::mostrarArreglo($ControlPersona->obj);
	foreach($ControlPersona->obj as $key => $valor)
	{ 
		$e->setVariable($key,$valor);	
	}

	$e->setVariable('mes_valor_cargo',$ControlPersona->obj->cargo_mes);
	$e->setVariable('agno_valor_cargo',$ControlPersona->obj->cargo_agno);
	$e->setVariable('mes_valor_servicio',$ControlPersona->obj->servicio_mes);
	$e->setVariable('agno_valor_servicio',$ControlPersona->obj->servicio_agno);	
	
	$e->setVariable('username',$elUsuarioP->username); 	 	
 	$e->setVariable('destacado_mantuserself','barra_destacado');
	
	if(trim($ControlPersona->obj->profesion) != '')
	{
		$e->addTemplate('profesion_seleccionada');
		$e->setVariable('profesion',$ControlPersona->obj->profesion);	
	} 	
	if(trim($ControlPersona->obj->cargo) != '')
	{
		$e->addTemplate('cargo_seleccionada');
		$e->setVariable('cargo',$ControlPersona->obj->cargo);	
	} 	
	echo $e->toHtml(); 
?>