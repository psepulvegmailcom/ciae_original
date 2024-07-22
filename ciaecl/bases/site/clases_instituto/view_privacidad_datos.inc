<?php
/**/
	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost();  
	
	$id = $valoresGet['id'];
	$tipo_curso = $valoresGet['tipo_curso'];

	$path_admin				= VarSystem::getPathVariables('dir_template'); 
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);	 

	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'privacidad_datos.tpl');
	$ControlNoticias->sinFiltroIdioma(); 
	$e->setVariable('mt','mt-0');
	$e->setVariable('organizadores_evento','postgrado@ie.uchile.cl');


	echo $e->toHtml();
?>