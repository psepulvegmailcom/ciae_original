<?
 
	global $ControlHtml;  	
 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'invitados.tpl');    
	 
	 
	/* muestra invitados especiales */
	$ControlInvitados = new ControlInvitados();
	$invitado = $ControlInvitados->obtenerElementos();
	for($i=0; $i < count($invitado); $i++)
	{
		$e->addTemplate('bloque_invitados');
		foreach($invitado[$i] as $key => $value)
		{
			$e->setVariable($key,$value);
		}
	}
	
	 
	echo $e->toHtml();
?>	