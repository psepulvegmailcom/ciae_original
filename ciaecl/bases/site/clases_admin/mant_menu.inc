<?php

	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml; 
	$lastAction 	= $ControlHtml->lastActionArray;  
	//$ControlHtml->setTituloModulo('Mantenedor de Menu'); 	 
	
	//$ControlHtml->revisionSesion(true);			 
	$FormGeneral 			= new FormGeneral(); 
	$id_item = VarSystem::getVariable("id_item"); 
	
	$elObjeto 				= new Menu();	
	$elControladorDeObjetos = new ControladorDeMenu(); 
	 
	if($lastAction[1] == 'guardar') 
	{
		//Funciones::mostrarArreglo($_POST);
		/*GUARDAR LA MODIFICACION O INGRESO*/ 
		$elObjeto->loadObject('id='.$id_item); 
		$elObjeto->opcion 		= VarSystem::getVariable("opcion");  
		$elObjeto->publicar 	= VarSystem::getVariable("publicar");
		$elObjeto->menu_padre 	= VarSystem::getVariable("menu_padre");
		$elObjeto->orden 		= VarSystem::getVariable("orden");
		$elObjeto->acceso 		= VarSystem::getVariable("acceso");
		$elObjeto->tipo 		= VarSystem::getVariable("tipo_archivo");
		$elObjeto->titulo_es		= htmlentities(VarSystem::getVariable("titulo_es"));
		$elObjeto->contenido_es		= htmlentities(VarSystem::getVariable("contenido_es"));
		$elObjeto->titulo_en		= htmlentities(VarSystem::getVariable("titulo_en"));
		$elObjeto->contenido_en		= htmlentities(VarSystem::getVariable("contenido_en"));
		if($elObjeto->archivo == '')
			$elObjeto->tipo_archivo = 'texto';
		$elObjeto->Id			= $id_item;
 		//Funciones::mostrarArreglo($elObjeto);
		$elObjeto->saveObject(); 
		if(trim($id_item) == '')
		{
			$elObjeto->Id = $elObjeto->id; 
		}		 		

		 
	}

	if($lastAction[1] == 'eliminar')
	{
		$elObjeto->loadObject('id='.$id_item); 
		$elObjeto->destroyContenidosMenu($id_item);
		$elObjeto->destroyObject('id='.$id_item); 
		$lastAction[1] = '';
	}

	if($lastAction[1] == 'modificar' || $lastAction[1] == 'ingresar')
	{
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/menu/form.tpl');
		$e->setVariable('tag_volver',$FormGeneral->showVolver('mantmenu'));
		
		if($lastAction[1] == 'modificar')
		{		
			$e->setVariable('caso_form','Edici&oacute;n');
			 	
			$elObjeto->loadObject('id='.$id_item);	
			$e->setVariable('menu',$elObjeto->menu);
			$e->setVariable('opcion',$elObjeto->opcion);
			$e->setVariable('texto',$elObjeto->texto); 
			$e->setVariable('id_item',$elObjeto->id);
			if($elObjeto->publicar == 1)
			{				
				$e->setVariable('publicar_checked','checked');	
			}
			else
			{
				$e->setVariable('no_publicar_checked','checked');
			} 			 
		}
		else
		{
			if($lastAction[1] == 'ingresar')
			{
				$e->setVariable('publicar_checked','checked');
				$e->setVariable('caso_form','Ingresar');
			}
		}	 
		
		/*LISTADO DE ORDEN */ 
		$totalLista = 35;
		for($i=1; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_orden_item');  
			$e->setVariable('list_item_valor',$i);
			$e->setVariable('list_item_texto',$i); 
			if($elObjeto->orden ==   $i)
			{	
				$e->setVariable('list_item_selected','selected'); 		
			} 
		}		

		/*LISTADO DE PADRE */
		$ListaDeObjetosItem 	=   		  $elControladorDeObjetos->getMenus(0,-1); 
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_menu_padre_item');  
			$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['id']);
			$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['nombre']); 
			if($elObjeto->menu_padre ==   $ListaDeObjetosItem[$i]['id'])
			{	
				$e->setVariable('list_item_selected','selected'); 		
			} 
		}
		
		/*LISTADO DE VISTA */
		$ListaDeObjetosItem 	= VarSystem::getTipoVistaMenu();
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_vista_item');  
			$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['id']);
			$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['tipo']); 
			if($elObjeto->vista ==   $ListaDeObjetosItem[$i]['id'])
			{	
				$e->setVariable('list_item_selected','selected'); 		
			} 
		}
		/*LISTADO DE TIPO MENU */  
		$ListaDeObjetosItem = array(array('id'=>'secundario','tipo'=>'Menu Superior'),array('id'=>'principal','tipo'=>'Menu Principal'),array('id'=>'inferior','tipo'=>'Menu Inferior'));
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_tipo_menu_item');  
			$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['id']);
			$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['tipo']); 
			if($elObjeto->tipo ==   $ListaDeObjetosItem[$i]['id'])
			{	
				$e->setVariable('list_item_selected','selected'); 		
			} 
		}
		
		/*LISTADO DE IDIOMAS*/ 
		$ListaDeObjetosItem		 	= VarSystem::getIdiomasPermitidos(); 
		$ListaDeObjetosItem = array('es');
		$totalLista 				= count($ListaDeObjetosItem); 
 
 		 
		for($i=0; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_contenido_menu_idioma_script');  
			$e->setVariable('menu_lang',$ListaDeObjetosItem[$i]);
			$e->addTemplate('lista_contenido_menu_idioma');  
			$e->setVariable('menu_lang',$ListaDeObjetosItem[$i]);  
			//$e->setVariable('nombre',$elObjeto->titulo_es);
			$aux = 'titulo_'.$ListaDeObjetosItem[$i];
			$e->setVariable('titulo',$elObjeto->$aux); 
			$e->setVariable('link_site',VarConfig::path_site_www); 
			
			$aux = 'contenido_'.$ListaDeObjetosItem[$i];
			$elEditor = new TextEditor('contenido_'.$ListaDeObjetosItem[$i],SIDTOOLHtml::cleanHtml($elObjeto->$aux),85,320);   
			$editorHtml =   $elEditor->toHtml(false); 
			$e->setVariable('texto',$editorHtml);   
		} 
	}	
	else
	{
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/menu/mant.tpl'); 
			
		$ListaDeObjetos 		= $elControladorDeObjetos->getAllMenus();
		// Funciones::mostrarArreglo($ListaDeObjetos);
		if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
		{
			$e->addTemplate('item_lista_nohay'); 
		}
		else
		{
			for($i=0; $i < count($ListaDeObjetos); $i++)
			{ 
				if($ListaDeObjetos[$i]['acceso'] == 'privado')
					continue;
				$e->addTemplate('lista_item');  
				$e->setVariable('orden',$ListaDeObjetos[$i]['orden']);
				$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo_es']); 
				$e->setVariable('opcion',$ListaDeObjetos[$i]['opcion']); 
				$e->setVariable('id_item',$ListaDeObjetos[$i]['id']); 
				$e->setVariable('tipo',$ListaDeObjetos[$i]['tipo']); 
				$e->setVariable('menu_lang',$ListaDeObjetos[$i]['idioma']); 
				if($ListaDeObjetos[$i]['publicar'] == 0)
					$e->setVariable('publicar_no','no_'); 
					
				if($i%2 == 0)						
					$e->setVariable('class_color','fondo_oscuro');
			}
		}  
	}  
	echo $e->toHtml();
?>
