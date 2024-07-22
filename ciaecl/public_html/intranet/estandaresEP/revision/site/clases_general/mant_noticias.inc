<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Mantenedor de Noticias'); 	 
	
	$ControlHtml->revisionSesion(true);		 
	$FormGeneral 			= new FormGeneral(); 
	$id_noticia = VarSystem::getVariable("id_noticia");
	
	$ControlAvisos 		= new  ControlAvisos();	
	$ControlAvisos->mostrarTodas(); 
	if($lastAction[1] == 'guardar')
	{
		/*guardar la modificacion o ingreso*/ 
		$noticia = $ControlAvisos->getNoticia($id_noticia);
		$noticia->titulo 	= VarSystem::getVariable("titulo");
		$noticia->aviso  	= Funciones::TextoSimple(VarSystem::getVariable("aviso"),true);
		$noticia->publicar 	= VarSystem::getVariable("publicar");
		$noticia->popup 	= VarSystem::getVariable("popup");
		$noticia->user_id 	= $theSession->userObject->user_id;
		$noticia->saveData();
		
		$lastAction[1] = '';
	}
	if($lastAction[1] == 'eliminar')
	{
		$ControlAvisos->eliminarNoticia($id_noticia);
		$lastAction[1] = '';
	}
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/noticias/mant.tpl'); 
			$ListaDeObjetos	 	= $ControlAvisos->getLista();
				
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{
				for($i=0; $i < count($ListaDeObjetos); $i++)
				{ 
					$e->addTemplate('lista_item');  
					$e->setVariable('fecha',$ListaDeObjetos[$i]['fecha']);
					$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
					$e->setVariable('id_noticia',$ListaDeObjetos[$i]['id_aviso']); 
					$e->setVariable('aviso',Funciones::TextoSimple($ListaDeObjetos[$i]['aviso'],true)); 
					if($ListaDeObjetos[$i]['publicar'] == 0)
						$e->setVariable('publicar_no','no_');
					if($ListaDeObjetos[$i]['popup'] == 0)
						$e->setVariable('popup_no','no_');
						
					if($i%2 == 0)						
						$e->setVariable('class_color','fondo_oscuro');
				}
			}  
		break;
		case 'modificar':
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/noticias/form.tpl');
			$e->setVariable('caso_form','Edición');
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$ListaDeObjetos	 	= $ControlAvisos->getLista($id_noticia);
			$i = 0;
			$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
			$e->setVariable('id_noticia',$ListaDeObjetos[$i]['id_aviso']); 
			$ListaDeObjetos[$i]['aviso'] = $ListaDeObjetos[$i]['aviso'];
			$ListaDeObjetos[$i]['aviso'] = $ListaDeObjetos[$i]['aviso'];			
			$e->setVariable('aviso',  Funciones::TextoSimple($ListaDeObjetos[$i]['aviso'])); 			
			$e->setVariable('fecha',$ListaDeObjetos[$i]['fecha']);
			if($ListaDeObjetos[$i]['publicar'] == 1)
				$e->setVariable('publicar_checked','checked');
			else
				$e->setVariable('no_publicar_checked','checked');
			if($ListaDeObjetos[$i]['popup'] == 1)
				$e->setVariable('popup_checked','checked');
			else
				$e->setVariable('no_popup_checked','checked');
			
		break;
		case 'eliminar':
			eliminarNoticia($id);
		break;
		case 'ingresar':
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/noticias/form.tpl');
			$e->setVariable('caso_form','Ingresar');
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			 			
			$e->setVariable('fecha', ControladorFechas::fechaActual(false,false));
			$e->setVariable('publicar_checked','checked');
		break;
	} 
	
	echo $e->toHtml();
?>
