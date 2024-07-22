<?
 
	global $ControlHtml;  	
 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'contacto.tpl');  
	$valores = VarSystem::getPost();
	//Funciones::mostrarArreglo($valores); 
	 
	if(isset($valores['guardar']) && $valores['guardar'] == 'enviar')
	{
		$ControladorContacto = new ControladorContacto();
		$ControladorContacto->enviarContacto($valores);
		 
		$e->addTemplate('bloque_envio_exito');	 
	}
	echo $e->toHtml();
?>