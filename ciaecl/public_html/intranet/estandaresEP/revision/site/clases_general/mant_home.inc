<?
	global $ControlHtml;
	$ControlHtml->revisionSesion(true);		

	$siteTitle 		= VarSystem::getInfoSystem('title');
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray; 
	$ControlHtml->setTituloModulo('Mantenedor de Páginas de Inicio'); 	 
	$template_path 	= 'admin/home/';
	$prefijo_form 	= 'form_';
	 
	$FormGeneral 	= new FormGeneral(); 
	$id_objeto 		= VarSystem::getVariable("id_permiso");
	$valores		= VarSystem::getPost(); 

	$ControlObjeto 		= new ControlHome();	 
	$Objeto				= new Home();
	if(trim($lastAction[1]) == 'guardar')
	{
		/* GUARDAR LA MODIFICACION O INGRESO */ 
		$id_objeto 		= VarSystem::getVariable($prefijo_form."id_permiso");
		$valores[$prefijo_form.'texto']	= Funciones::TextoSimple($valores[$prefijo_form.'texto'],true); 
		$Objeto->buscarObjeto($id_objeto);   
		$Objeto->agregarValores($valores,$prefijo_form); 
		$Objeto->guardarObjeto($id_objeto);		
		$lastAction[1] = '';
	}
	if(trim($lastAction[1]) == 'eliminar')
	{ 
		$Objeto->eliminarObjeto($id_objeto);
		$lastAction[1] = '';
	}	 

	if(trim($lastAction[1]) == 'modificar'  || trim($lastAction[1]) == 'ingresar')
	{	 
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').$template_path.'form.tpl');
		$e->setVariable('prefijo_form',$prefijo_form);		 
		$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
	
		if(trim($lastAction[1]) == 'modificar')
		{
			$e->setVariable('caso_form','Edición');
			if($id_objeto == 0)
				$e->setVariable('disabled','disabled');
			$ListaDeObjetos		= $ControlObjeto->getHome($id_objeto);  
			$ListaDeObjetos[0]['texto'] = Funciones::br2nl($ListaDeObjetos[0]['texto']);
			$selected			= array('selected' => $id_objeto);
			$FormGeneral->showRowDataTemplate($e,$ListaDeObjetos);
		}
		else
		{	
			$e->setVariable('caso_form','Ingresar');	
			$selected	= array();
		}	 
		$ControladorPermisos = new ControladorPermisos();
		$permisos = $ControladorPermisos->getArrayPermisos();
		$FormGeneral->showRowDataTemplate($e,$permisos,'lista_select_permiso',$selected);	
	}
	else
	{		
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').$template_path.'mant.tpl'); 
		$ListaDeObjetos	= $ControlObjeto->getHome();
			
		if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
		{
			$e->addTemplate('item_lista_nohay'); 
		}
		else
		{ 
			$FormGeneral->showRowDataTemplate($e,$ListaDeObjetos,'lista_item');
		}  
	}
	
	echo $e->toHtml();
?>