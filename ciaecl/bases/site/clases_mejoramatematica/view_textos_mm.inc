<?php 
	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
	$ControlTextos = new ControlTextos();
  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']); 
  	if(ereg('view_recursos_', $valoresGet['page']))
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_textos_planos_mm.tpl');	
	}
	else
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_textos_planos_mm_lt.tpl');
	}	 
  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];
  	$e->setVariable('texto_contenido',$texto_contenido);  
  	$e->setVariable('caso',$valoresGet['page']); 
  	$Menu = new Menu();
	$Menu->getOpcion($valoresGet['page']); 
	
	$titulo = 'titulo_'.$ControlHtml->langSite;
	$e->setVariable('descripcion',stripcslashes($Menu->$titulo)); 
  	
  	
	$aux = explode('_',$ControlHtml->lastActionArray[0]);
	$clave = end($aux); 
	$e->setVariable('clave',$clave);
  	
	if (VarSystem::getPathVariables('web_site') == 'web_mejormatematica')
	{ 
	  	$ControlGeneralSitios = new ControlGeneralSitios();
	  	$e = $ControlGeneralSitios->mostrarNoticiasDestacadasHome($e);
			
		$ControladorDeMenu = new  ControladorDeMenu();
		$page = $valoresGet['page'];
		$id = $ControladorDeMenu->getMenuOpcion($page);
		if(is_array($id) && count($id)>0)
		{
			$idsitio = $id[0]['id'];	
			$elementos = $ControladorDeMenu->setMenuLateralMM($idsitio);
			if(is_array($elementos) && count($elementos)>0)
			{				
				$e->addTemplate('bloque_menu_lateral');   				
				$max_recursos = count($elementos);
				for($i=0; $i <  $max_recursos;$i++)
				{
					$e->addTemplate('bloque_menu_lateral_opcion');
					$e->showDataSimple($elementos[$i]);
				}
			} 
		}	
	}
	
	if(trim($textos[0]['imagen']) != '')
	{
		$e->addTemplate('bloque_texto_imagen');
		$e->setVariable('imagen',$textos[0]['imagen']);
	} 
	echo $e->toHtml();
?>