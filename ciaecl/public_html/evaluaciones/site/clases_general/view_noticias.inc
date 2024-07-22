<?
echo 'view_noticias.incview_noticias.inc';

	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray;  
	$FormGeneral 	= new FormGeneral();

	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'noticias.tpl'); 	
	
	$id_elemento = VarSystem::getVariable('id_elemento','GET');  
	 
	$ControlAvisos 		= new  ControlAvisos();
	$ControlAvisos->setIdioma($ControlHtml->langSite);
	
	if($id_elemento != '' && is_finite($id_elemento))
	{
		$e->setVariable('tag_volver',$FormGeneral->showVolver('news'));
		$objetos 	= 	$ControlAvisos->getLista($id_elemento);
		$e->addTemplate('lista_item_select');   
		$e->setVariable('fecha',$objetos[0]['fecha']); 
		$e->setVariable('src_image',$objetos[0]['imagen_noticia']); 
		$e->setVariable('bajada',$objetos[0]['bajada_noticia']); 
		$e->setVariable('titulo',Funciones::TextoSimple($objetos[0]['titulo'])); 
		$e->setVariable('contenido', Funciones::TextoSimple($objetos[0]['noticia'],true)); 
	} 
	else
	{	
		$ListaDeObjetos	 	= $ControlAvisos->getLista(); 
		$total = count($ListaDeObjetos);
		if(is_array($ListaDeObjetos) && $total > 0)
		{
			for($i=0; $i < $total; $i++)
			{ 
				$e->addTemplate('lista_item');  
				$e->setVariable('fecha',$ListaDeObjetos[$i]['fecha']);
				$e->setVariable('lang',$ControlHtml->langSite); 			
				$e->setVariable('bajada',$ListaDeObjetos[$i]['bajada_home']); 
				$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
				$e->setVariable('src_image',$ListaDeObjetos[$i]['imagen_bajada']); 
				$e->setVariable('id',$ListaDeObjetos[$i]['id_noticia']); 
			}
		}
	}
	
	echo $e->toHtml();


?>
	