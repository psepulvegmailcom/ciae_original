<?php 
	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores 	= VarSystem::getPost(); 
  	$PersonaControl = new PersonaControl(); 
  	$personas = $PersonaControl->getListaAnexos(); 
  	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'anexos.tpl');
	
	for($i=0; $i < count($personas); $i++)
	{
		$e->addTemplate('bloque_anexos_listado'); 
		$e->showDataSimple($personas[$i]);
	} 
	
	echo $e->toHtml();
?>