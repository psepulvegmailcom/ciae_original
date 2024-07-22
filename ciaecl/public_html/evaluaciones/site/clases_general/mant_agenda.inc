<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray;  	 
	 		 
	$FormGeneral 			= new FormGeneral(); 
	$id_item 	= VarSystem::getVariable("id_item");
	$accion 	= VarSystem::getVariable("accion");
 
	
	$ControlAgenda 		= new  ControlAgenda();	
	$ControlAgenda->setIdioma('*');
	$ControlAgenda->mostrarTodas(); 
 

	if($lastAction[1] == 'guardar')
	{
		/*GUARDAR LA MODIFICACION O INGRESO*/ 
		$item = $ControlAgenda->getAgenda($id_item); 
		$data = VarSystem::getPost();
		$item->setFields($data);  
		$item->fecha_inicio 	=  ControladorFechas::invertirFecha(VarSystem::getVariable("fecha_inicio")).':00'; 
		$item->fecha_termino	=  ControladorFechas::invertirFecha(VarSystem::getVariable("fecha_termino")).':00'; 
		$item->saveData(); 
		$lastAction[1] = '';
	}
	if($lastAction[1] == 'eliminar')
	{
		$ControlAgenda->eliminarAgenda($id_item);
		$lastAction[1] = '';
	} 
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/agenda/mant.tpl'); 
			$ListaDeObjetos	 	= $ControlAgenda->getLista();
				
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$e->showBlock('lista_item',$ListaDeObjetos);
			}  
		break;
		case 'modificar':
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/agenda/form.tpl');
			$e->setVariable('caso_form','Edición');			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$ListaDeObjetos	 	= $ControlAgenda->getLista($id_item);
			$i = 0;
			$e->showData($ListaDeObjetos[$i]);
			$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
			$e->setVariable('id_item',$ListaDeObjetos[$i]['id_item']);   						 
			if($ListaDeObjetos[$i]['publicar'] == 1)
				$e->setVariable('publicar_checked','checked');
			else
				$e->setVariable('no_publicar_checked','checked');
			if($ListaDeObjetos[$i]['home'] == 1)
				$e->setVariable('popup_checked','checked');
			else
				$e->setVariable('no_popup_checked','checked');
			$e->setVariable('select_idioma',$FormGeneral->showSelectIdiomas($ListaDeObjetos[$i]['idioma']));
			$ListaDeObjetos[$i]['contenido'] = Funciones::TextoSimple($ListaDeObjetos[$i]['contenido']); 
			$elEditor = new TextEditor('contenido',$ListaDeObjetos[$i]['contenido'],85,200);   
			$editorHtml =   $elEditor->toHtml(false);		
			$e->setVariable('contenido_text',$editorHtml); 			
		break;
		case 'ingresar':
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/agenda/form.tpl');
			$e->setVariable('caso_form','Ingresar');			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));	 
			$e->setVariable('select_idioma',$FormGeneral->showSelectIdiomas());
			$e->setVariable('publicar_checked','checked'); 
			$e->setVariable('popup_checked','checked');
			$elEditor = new TextEditor('contenido','',85,200);   
			$editorHtml =   $elEditor->toHtml(false);		
			$e->setVariable('contenido_text',$editorHtml); 
		break;
	} 
	
	echo $e->toHtml();
?>
