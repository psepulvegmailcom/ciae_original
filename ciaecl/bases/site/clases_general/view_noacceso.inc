<?php
 
	global $ControlHtml;
	$siteTitle 		= $ControlHtml->siteTitle;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Recuperaci&oacute;n de los Datos de Usuario'); 

	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'noacceso.tpl'); 
 
	if(trim($lastAction[1]) == 'envio_email')
	{ 
		$email_recover  = VarSystem::getVariable('email_recover');
		$captcha 		= VarSystem::getVariable("new_captcha"); 
		
		if(trim($captcha) != $_SESSION['tmp_captcha'])
		{
			$e->addTemplate('noimgenvio_noacceso'); 
			$e->addTemplate('formulario_noacceso');
			$e->setVariable('email',$email_recover); 
		}		
		else
		{
			$Usuario 		= new Usuario();
			if($Usuario->existeUsuarioByEmail($email_recover))
			{
				$e->addTemplate('envio_noacceso'); 
				$e->setVariable('email',$email_recover);
				$Persona 	= $Usuario->getPersonaByEmail($email_recover); 
				$Usuario->getUsuarioByPersona($Persona->obj); 			
				$password 	= Funciones::generarPassword();
				$Usuario->updatePassword($password);
				
				$PersonaControl = new PersonaControl();
				$PersonaControl->setPersona($Persona->obj->id_persona);
	
				$email = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/email/olvido_password.tpl');
				$email->setVariable('email_sitio_nombre',$siteTitle['completo']); 
				$email->setVariable('email_persona_nombre',$PersonaControl->getNombreCompleto());
				$email->setVariable('email_persona_email',$PersonaControl->getEmail());
				$email->setVariable('email_persona_username',$Usuario->username);				 
				$email->setVariable('email_persona_password',$password);
				
				$email->addTemplate('olvido_password'); 
				
				$mensaje = $email->toHtml();	
				$asunto = "Recuperaci&oacute;n de los Datos de Usuario "; 
				Funciones::sendEmail($PersonaControl->getEmail(),$asunto,$mensaje);	 
					
			}
			else
			{
				$e->addTemplate('noenvio_noacceso');
				$e->setVariable('email',$email_recover); 
				$e->addTemplate('formulario_noacceso');
			}
		}
	}
	else
	{
		$e->addTemplate('formulario_noacceso');
	}
	 
	
	echo $e->toHtml();
?>