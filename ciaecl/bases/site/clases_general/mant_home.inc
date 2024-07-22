<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Mantenedor de P&Aacute;ginas de Inicio'); 	 
	$template_path = 'admin/home/';
	
	$ControlHtml->revisionSesion(true);		 
	$FormGeneral 			= new FormGeneral(); 
	$id_noticia = VarSystem::getVariable("id_permiso");
	
	$ControlHome 		= new ControlHome();	 
	$Home				= new Home();
	if($lastAction[1] == 'guardar')
	{
		/*guardar la modificacion o ingreso*/ 
		$noticia = $Home->obtenerHome($id_permiso);
		$noticia->titulo 		= VarSystem::getVariable("titulo");
		$noticia->texto  		= Funciones::TextoSimple(VarSystem::getVariable("texto"),true); 
		$noticia->id_permiso 	= VarSystem::getVariable("id_permiso");
		$noticia->saveData();
		
		$lastAction[1] = '';
	}
	if($lastAction[1] == 'eliminar')
	{
		$ControlHome->eliminarNoticia($id_noticia);
		$lastAction[1] = '';
	}
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').$template_path.'mant.tpl'); 
			$ListaDeObjetos	 	= $ControlHome->getHome();
				
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
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').$template_path.'form.tpl');
			$e->setVariable('caso_form','Edici&oacute;n');
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$ListaDeObjetos	 	= $ControlHome->getLista($id_noticia);
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
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').$template_path.'form.tpl');
			$e->setVariable('caso_form','Ingresar');
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			 			
			$e->setVariable('fecha', ControladorFechas::fechaActual(false,false));
			$e->setVariable('publicar_checked','checked');
		break;
	} 
	
	echo $e->toHtml();
?>
