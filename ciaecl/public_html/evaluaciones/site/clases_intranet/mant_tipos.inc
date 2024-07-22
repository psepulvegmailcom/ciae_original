<?
	 
	global $ControlHtml; 
	//$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/tipos/'; 
	 		 
	$valores 		= VarSystem::getPost(); 
	$ControlClase	= new ControlObjetos();
	$form_especial	= '';
	switch($lastAction[0])
	{
		case 'view_tipos_proyecto':
			$ControlClase = new ControlTipoProyectos(); 
			$ObjetoClase  = new TipoProyectos();
		break;
		case 'view_tipos_proyecto_area':
			$ControlClase = new ControlTipoAreaProyectos(); 
			$ObjetoClase  = new TipoAreaProyectos();
		break;
		case 'view_tipos_publicaciones':
			$ControlClase = new ControlTipoPublicaciones(); 
			$ObjetoClase  = new PublicacionesTipo();
			$form_especial= '_publicaciones';
		break;
		case 'view_tipos_personas':
			$ControlClase = new ControlTipoPersona(); 
			$ObjetoClase  = new TipoPersona();
			$form_especial= '_personas';
		break;
		case 'view_tipos_universidad':
			$ControlClase = new ControlUniversidad(); 
			$ObjetoClase  = new Universidad();
			$form_especial= '_universidad';
		break;
		case 'view_tipos_area':
			$ControlClase = new ControlAreas(); 
			$ObjetoClase  = new Areas();
			$form_especial= '_area';
		break;
	}
	 
	if($lastAction[1] == 'guardar')
	{
 		if(trim($valores['id_item']) != '')
 		{
			/** edición elemento */
			$ObjetoClase->buscarObjeto($valores['id_item']);
		}
		foreach($valores as $var => $val)
		{
			$aux = explode('_',$var);
			if($aux[0] == 'form')
			{
				$ObjetoClase->$aux[1] = $val;
			}
		} 
		if(trim($valores['id_item']) != '')
 		{
			/** edición elemento */
			$ObjetoClase->guardarObjeto($valores['id_item']);
		}
		else
		{
			$ObjetoClase->guardarObjeto();
		}
	}
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate($path_admin.'mant'.$form_especial.'.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerListado();
			 
			// Funciones::mostrarArreglo($ListaDeObjetos[1]);
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$total = count($ListaDeObjetos);  
				for($i=0; $i < $total; $i++)
				{
					$e->addTemplate('lista_item');
					$ListaDeObjetos[$i]['fila'] = $i + 1; 
					$ListaDeObjetos[$i]['id_item'] = $ListaDeObjetos[$i][$ObjetoClase->dbKey];
					$e->setVariable('opcion_modulo',$lastAction[0]);
					foreach($ListaDeObjetos[$i] as $var => $val)
					{
						$e->setVariable($var,trim($val));
					}  
					if($i%2 == 0)						
					{
						$e->setVariable('class_color','fondo_oscuro');
					}
				}	
			}		
		break;		
		case 'modificar':
			$e = new miniTemplate($path_admin.'form'.$form_especial.'.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerElemento($valores['id_item']); 
  			
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$ObjetoClase->dbKey];
			$ListaDeObjetos[0]['activo_html'] = 'No activo';
			if($ListaDeObjetos[0]['activo'] == '1')
			{
				$ListaDeObjetos[0]['activo_html'] = 'Activo';
			}
			foreach($ListaDeObjetos[0] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}   
			for($i=1; $i  < 30 ; $i++)
			{
				$e->addTemplate('bloque_form_orden');
				$e->setVariable('orden',$i); 
				if($i == $ListaDeObjetos[0]['orden'])
				{
					$e->setVariable('selected','selected');
				}
			} 
		break;  
	}
	echo $e->toHtml();
?>