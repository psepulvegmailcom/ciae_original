<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Noticias'); 

	
	$FormGeneral 			= new FormGeneral();

	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'noticias.tpl'); 
	
	$e->setVariable('tag_volver',$FormGeneral->showVolver());
	
	
	$siteTitle = VarSystem::getInfoSystem('title'); 
	$ControlAvisos 		= new  ControlAvisos();	
	
	if($lastAction[1] != '' && is_finite($lastAction[1]))
	{
		$objetos 	= 	$ControlAvisos->getLista($lastAction[1]);
		$e->addTemplate('lista_item_select');   
		$e->setVariable('fecha',$objetos[0]['fecha']); 
		$e->setVariable('titulo',Funciones::TextoSimple($objetos[0]['titulo'])); 
		$e->setVariable('contenido', Funciones::TextoSimple($objetos[0]['aviso'],true));
		$e->setVariable('firma',$siteTitle['firm']);
	} 
	
	
	$ListaDeObjetos	 	= $ControlAvisos->getLista();  
	for($i=0; $i < count($ListaDeObjetos); $i++)
	{ 
		$e->addTemplate('lista_item');  
		$e->setVariable('fecha',$ListaDeObjetos[$i]['fecha']);
		$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
		$e->setVariable('id',$ListaDeObjetos[$i]['id_aviso']); 
	}  
	
	
	echo $e->toHtml();


?>
	