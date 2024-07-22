<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Preguntas Frecuentes'); 


	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'faq.tpl'); 
	$ControlFAQs 		= new  ControlFAQs();	
	$ListaDeObjetos	 	= $ControlFAQs->getLista();  
	if(is_numeric($lastAction[1]))
	{
		$e->addTemplate('lista_item_FAQ_seleccionada');  
		$objetos 	= 	$ControlFAQs->getLista($lastAction[1]);  
		$e->setVariable('faq_selected',$objetos[0]['pregunta']);  
		$e->setVariable('faq_id_selected',$lastAction[1]); 
		$e->setVariable('respuesta_selected',$objetos[0]['respuesta']); 
		$e->setVariable('orden_selected',$objetos[0]['orden']);
	}
	else
	{		
		$e->addTemplate('lista_item_FAQ_no_seleccionada');  
	}
	$tema_anterior = $ListaDeObjetos[0]['tema'];
	for($i=0; $i < count($ListaDeObjetos); $i++)
	{ 
		if($tema_anterior != $ListaDeObjetos[$i]['tema'] || $i==0)
		{
			$e->addTemplate('lista_item_FAQ_tema');  
			$e->setVariable('tema',$ListaDeObjetos[$i]['tema']);

			$e->setVariable('tema_prefijo', strtolower(substr($ListaDeObjetos[$i]['tema'],0,5)));
			$tema_anterior = $ListaDeObjetos[$i]['tema'];
		}
		$e->addTemplate('lista_item_FAQ');  
		$e->setVariable('faq_orden',$ListaDeObjetos[$i]['orden']);
		$e->setVariable('faq',$ListaDeObjetos[$i]['pregunta']); 
		$e->setVariable('id_faq',$ListaDeObjetos[$i]['id_pregunta']); 
	}  
	
	
	echo $e->toHtml();


?>
	