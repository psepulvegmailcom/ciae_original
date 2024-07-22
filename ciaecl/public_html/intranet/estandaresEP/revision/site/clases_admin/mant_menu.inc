<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession;  
	$lastAction 	= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Mantenedor de Menú'); 	 
	
	$ControlHtml->revisionSesion(true);			 
	$FormGeneral 			= new FormGeneral(); 
	$id_item = VarSystem::getVariable("id_item");
	
	
	$elObjeto 				= new Menu();	
	$elControladorDeObjetos = new ControladorDeMenu(); 
	 
	if($lastAction[1] == 'guardar')
	{
		/*guardar la modificacion o ingreso*/ 

		$elObjeto->loadObject('id='.$id_item);
		$elObjeto->menu 		= VarSystem::getVariable("menu");
		$elObjeto->opcion 		= VarSystem::getVariable("opcion");
		$elObjeto->tipo_archivo = VarSystem::getVariable("tipo_archivo");
		$elObjeto->archivo 		= VarSystem::getVariable("archivo");
		$elObjeto->texto 		= VarSystem::getVariable("texto") ;
		$elObjeto->publicar 	= VarSystem::getVariable("publicar");
		$elObjeto->menu_padre 	= VarSystem::getVariable("menu_padre");
		$elObjeto->orden 		= VarSystem::getVariable("orden");
		$elObjeto->body 		= VarSystem::getVariable("body_contenido");
		$elObjeto->vista 		= VarSystem::getVariable("vista");
		$elObjeto->Id			= $id_item;

		$elObjeto->saveObject();
		 
		 
		if(trim($id_item) == '')
		{
			$elObjeto->Id = $elObjeto->id; 
		}		 
		
		$valores 				= VarSystem::getPost();
		$permisoSel 			= $valores['permisoSel'];
		$permisoSel[] = 1;   
		 
		$elObjeto->destroyPermisosMenu();
		
		for($i=0; $i < count($permisoSel); $i++)
		{
			$elObjeto->insertPermisoMenu($permisoSel[$i]);
		} 
		$lastAction[1] = '';
	}
	if($lastAction[1] == 'eliminar')
	{
		$elObjeto->loadObject('id='.$Id); 
		$elObjeto->destroyPermisosMenu();
		$elObjeto->destroyObject('id='.$id_item); 
		$lastAction[1] = '';
	}
	if($lastAction[1] == 'modificar' || $lastAction[1] == 'ingresar')
	{
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/menu/form.tpl');
		$e->setVariable('tag_volver',$FormGeneral->showVolver('mantmenu'));
		
		if($lastAction[1] == 'modificar')
		{		
			$e->setVariable('caso_form','Edición');
			 	
			$elObjeto->loadObject('id='.$id_item);	
			$e->setVariable('menu',$elObjeto->menu);
			$e->setVariable('opcion',$elObjeto->opcion);
			$e->setVariable('texto',$elObjeto->texto);
			$e->setVariable('archivo',$elObjeto->archivo);
			$e->setVariable('body_contenido',$elObjeto->body);
			$e->setVariable('id_item',$elObjeto->id);
			if($elObjeto->publicar == 1)
			{				
				$e->setVariable('publicar_checked','checked');	
			}
			else
			{
				$e->setVariable('no_publicar_checked','checked');
			} 
			
			$permisosMenu = $elControladorDeObjetos->getPermisoMenu($id_item);	 	
			if(is_array($permisosMenu) && count($permisosMenu) == 0)
			{
				$e->setVariable('list_todos_permisos_checked','checked'); 
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

		
		/*listado de orden */ 
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

		/*listado de padre */
		$ListaDeObjetosItem 	= $elControladorDeObjetos->getArrayMenuSimple('',true);
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_menu_padre_item');  
			$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['id']);
			$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['menu']); 
			if($elObjeto->menu_padre ==   $ListaDeObjetosItem[$i]['id'])
			{	
				$e->setVariable('list_item_selected','selected'); 		
			} 
		}
		
		/*listado de vista */
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
		/*listado de tipo menu */
		$ListaDeObjetosItem 	= VarSystem::getTipoArchivoMenu();
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_tipo_menu_item');  
			$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['id']);
			$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['tipo']); 
			if($elObjeto->tipo_archivo ==   $ListaDeObjetosItem[$i]['id'])
			{	
				$e->setVariable('list_item_selected','selected'); 		
			} 
		}
		
		/*listado de permiso usuarios */
		$elControladorDeUsuarios = new ControladorDeUsuarios();
		$ListaDeObjetosItem		 = $elControladorDeUsuarios->getArrayPermisos();
		 
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			$e->addTemplate('lista_permiso_item');  
			$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['id_permiso']);
			$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['descripcion']); 
			if((bool)$permisosMenu[$ListaDeObjetosItem[$i]['id_permiso']])
			{	
				$e->setVariable('list_item_checked','checked'); 		
			} 
			if($ListaDeObjetosItem[$i]['id_permiso'] == 1)
			{
				$e->setVariable('list_item_disabled','disabled'); 
				$e->setVariable('list_item_checked','checked');	
			}
		}
		 
	}	
	else
	{
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/menu/mant.tpl'); 
			
		$ListaDeObjetos 		= $elControladorDeObjetos->getArrayMenuSimple();
		 
		if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
		{
			$e->addTemplate('item_lista_nohay'); 
		}
		else
		{
			for($i=0; $i < count($ListaDeObjetos); $i++)
			{ 
				$e->addTemplate('lista_item');  
				$e->setVariable('orden',$ListaDeObjetos[$i]['orden']);
				$e->setVariable('titulo',$ListaDeObjetos[$i]['nombre']); 
				$e->setVariable('id_item',$ListaDeObjetos[$i]['id']);   
				if($ListaDeObjetos[$i]['publicar'] == 0)
					$e->setVariable('publicar_no','no_'); 
					
				if($i%2 == 0)						
					$e->setVariable('class_color','fondo_oscuro');
			}
		}  
	}
	
	 
	
	
	
	echo $e->toHtml();
?>
