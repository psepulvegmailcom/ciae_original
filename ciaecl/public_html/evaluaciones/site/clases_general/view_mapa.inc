<?php 
	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
  	
	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'mapa_'.$ControlHtml->langSite.'.tpl');
	 
	$controladorMenu 		= new ControladorDeMenu();	  	
	$controladorMenu->setSitio($ControlHtml->sitio);
	$controladorMenu->setIdioma($ControlHtml->langSite);
	
	$menuRaiz = $controladorMenu->getMenus();
	$total = count($menuRaiz); 
	//Funciones::mostrarArreglo($menuRaiz,true);
	$total_mitad = round($total/2);
	
	for($i=0; $i < $total; $i++)
	{
		if($i ==0 || $i == $total_mitad)
		{
			$e->addTemplate('bloque_elemento_mapa_columna');
			if($i == 0)
			{
				$e->addTemplate('bloque_elemento_mapa_columna_extra');
			}
		}
		$e->addTemplate('bloque_elemento_mapa_padre');
		$e->showDataSimple($menuRaiz[$i]);
		$e->setVariable('langsite',$ControlHtml->langSite);
		
		$menuHijos = $controladorMenu->getMenus($menuRaiz[$i]['id']);
		if(is_array($menuHijos) && count($menuHijos) > 0)
		{
			$e->showBlock('bloque_elemento_mapa_hijo',$menuHijos);
		}
	}  
  	Funciones::mostrarArreglo($menuRaiz);
	echo $e->toHtml();
?>