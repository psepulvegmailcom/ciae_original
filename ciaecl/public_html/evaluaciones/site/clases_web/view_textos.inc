<?php 
	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
	$ControlTextos = new ControlTextos();
  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']); 
  	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_textos_planos.tpl'); 
  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];
  	$e->setVariable('texto_contenido',$texto_contenido); 
  	$e->setVariable('caso',$valoresGet['page']); 
  	
  	
	$aux = explode('_',$ControlHtml->lastActionArray[0]);
	$clave = end($aux); 
	$e->setVariable('clave',$clave);
  	
  	
	echo $e->toHtml();
?>