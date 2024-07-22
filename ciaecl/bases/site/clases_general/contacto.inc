<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray;  	 
	 		  
	$FormGeneral = new FormGeneral();
	 
	$datos = VarSystem::getPost();
	$lastAction = explode('|',$datos['lastAction']);
	$datos['tag_volver'] 			= $FormGeneral->showVolver($lastAction[0]);
	$datos['titulo_nombre'] 		= $ControlHtml->ControlIdioma->obtenerVariable('general_nombre');
	$datos['titulo_direccion'] 		= $ControlHtml->ControlIdioma->obtenerVariable('general_direccion');
	$datos['titulo_ciudad'] 		= $ControlHtml->ControlIdioma->obtenerVariable('general_ciudad');
	$datos['titulo_pais'] 			= $ControlHtml->ControlIdioma->obtenerVariable('general_pais');
	$datos['titulo_profesion'] 		= $ControlHtml->ControlIdioma->obtenerVariable('general_profesion');
	$datos['titulo_actividad'] 		= $ControlHtml->ControlIdioma->obtenerVariable('general_actividad');
	$datos['titulo_telefono'] 		= $ControlHtml->ControlIdioma->obtenerVariable('general_telefono');
	$datos['titulo_fax'] 			= $ControlHtml->ControlIdioma->obtenerVariable('general_fax');
	$datos['titulo_email'] 			= $ControlHtml->ControlIdioma->obtenerVariable('general_email');
	$datos['titulo_comentario'] 	= $ControlHtml->ControlIdioma->obtenerVariable('general_comentario');
	$datos['titulo_enviar'] 		= $ControlHtml->ControlIdioma->obtenerVariable('contact_enviar');
	$datos['titulo_requiere_campo'] = $ControlHtml->ControlIdioma->obtenerVariable('contact_requiere');

	if($lastAction[1] == 'enviar')
	{  
		$siteTitle = VarSystem::getInfoSystem('title');
		$datos['contact_firma'] = $ControlHtml->ControlIdioma->obtenerVariable('contact_firma');
		$datos['nombre_sitio'] = $siteTitle['simple'];
		$datos['link_sitio'] = VarConfig::path_site_www; 
		$to = $datos['nombre'].' <'.$datos['email'].'>';
		$fromaddress = VarSystem::getInfoSystem('email_contacto');
		$fromname = $datos['nombre_sitio'];
		$subject = $ControlHtml->ControlIdioma->obtenerVariable('contact_email_subject').' - '.$datos['nombre_sitio'];
		$bcc = VarSystem::getInfoSystem('email_webmaster').', '.$fromaddress;
 
		$e 		= new miniTemplate(VarSystem::getPathVariables('dir_template').'general/contacto_email.tpl');	
		$e 		= SIDTOOLHtml::showTemplate($e,$datos);
		$body 	= $e->toHtml(); 
		 
		SIDTOOLHtml::sendEmail($to, $body, $subject, $fromaddress, $fromname,$bcc);
	} 
	  

	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'general/contacto.tpl');	
	$e = SIDTOOLHtml::showTemplate($e,$datos);

	echo $e->toHtml();
?>
