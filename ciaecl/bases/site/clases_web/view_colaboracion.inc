<?php

	global $ControlHtml;
	
	$aux = explode('_',$ControlHtml->lastActionArray[0]);
	if(count($aux) == 2)
	{
		$e 	 = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'colaboracion/base.tpl'); 
		$ControlTextos = new ControlTextos();
		$textos = $ControlTextos->obtenerElemento($ControlHtml->lastActionArray[0]); 
		$e->setVariable('view_colaboracion',$textos[0]['texto_'.VarSystem::obtenerIdiomaActual()]); 
		$ControladorDeMenu = new ControladorDeMenu(); 
		$base = $ControladorDeMenu->getMenuOpcion($ControlHtml->lastActionArray[0]); 
		$listado = $ControladorDeMenu->getMenus($base[0]['id']); 
		
		for($i=0; $i < count($listado);$i++)
		{
			$ControlTextos = new ControlTextos();
			$textos = $ControlTextos->obtenerElemento($listado[$i]['opcion']);  
			$e->addTemplate('bloque_textos');
			$e->setVariable('opcion',$listado[$i]['opcion']); 
			$e->setVariable('titulo',$listado[$i]['titulo_'.VarSystem::obtenerIdiomaActual()]);
			$e->setVariable('langSite',VarSystem::obtenerIdiomaActual());
		} 
	}
	else
	{
		$e 	 = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'colaboracion/texto.tpl');  
		$e->setVariable('langSite',VarSystem::obtenerIdiomaActual());
		$ControlTextos = new ControlTextos();
		$textos = $ControlTextos->obtenerElemento($ControlHtml->lastActionArray[0]); 
		$e->setVariable('texto',$textos[0]['texto_'.VarSystem::obtenerIdiomaActual()]);
	}
	echo $e->toHtml();
?>