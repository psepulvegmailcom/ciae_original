<?

	global $ControlHtml;  	
	//$ControlHtml->enviarAlertaPostulaciones();
	$siteTitle 		= VarSystem::getInfoSystem('title');
	$theSession 	= $ControlHtml->theSession; 
	$elUsuarioP 	= $ControlHtml->elUsuarioP; 

	$Home 			= new Home(); 

	$ControlHtml->setTituloModulo('Bienvenida'); //$Home->titulo
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'home.tpl'); 
	$e->setVariable('texto_bienvenida',Funciones::TextoSimple($Home->texto),true); 	
	if((bool)$theSession->autenticate)
	{		
		$e->addTemplate('barra_pasos_up');
		$e->setVariable('destacado_home','barra_destacado');  
		$e->addTemplate('barra_pasos_down');
		$e->setVariable('destacado_home','barra_destacado');  
	}
	echo $e->toHtml();
?>	