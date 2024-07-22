<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray; 
			$ControlHtml->setTituloModulo('Preguntas Frecuentes'); 


	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'faq.tpl'); 
	$ControlFAQs 		= new  ControlFAQs();	
	$ListaDeObjetos	 	= $ControlFAQs->getLista(); 
	
	
	$objetos 	= 	$ControlFAQs->getLista($lastAction[1]);  
	$e->setVariable('faq_selected',$objetos[0]['pregunta']); 
	$e->setVariable('respuesta_selected',$objetos[0]['respuesta']); 
	$e->setVariable('orden_selected',$objetos[0]['orden']);
	
	for($i=0; $i < count($ListaDeObjetos); $i++)
	{ 
		$e->addTemplate('lista_item_FAQ');  
		$e->setVariable('faq_orden',$ListaDeObjetos[$i]['orden']);
		$e->setVariable('faq',$ListaDeObjetos[$i]['pregunta']); 
		$e->setVariable('id_faq',$ListaDeObjetos[$i]['id_pregunta']); 
	}  
	
	
	echo $e->toHtml();


?>
	