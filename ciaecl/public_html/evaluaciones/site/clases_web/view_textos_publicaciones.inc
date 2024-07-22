<?php 

	global $ControlHtml;  
  	$valoresGet 		= VarSystem::getGet();
  	$valores 			= VarSystem::getPost(); 
	$ControlTextos 		= new ControlTextos();
	$idioma 			= VarSystem::obtenerIdiomaActual();
  	$textos 			= $ControlTextos->obtenerElemento($valoresGet['page']); 
  	$e 					= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'textos/publicacion_'.$idioma.'.tpl'); 
  	$texto_contenido 	= $textos[0]['texto_'.$ControlHtml->langSite];
  	$e->setVariable('texto_contenido',$texto_contenido); 
  	
  	$ControladorDeMenu 	= new ControladorDeMenu();
  	$menus 				= $ControladorDeMenu->getMenus(53);
  	$e->showBlock('bloque_listado_publicacion',$menus);
  	
	echo $e->toHtml();
?>