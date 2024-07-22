<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml; 
	$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= explode('|',$ControlHtml->laPagina->lastAction); 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/inscripcion/'; 
	 		 
	$valores 		= VarSystem::getPost();  
	if($lastAction[2] == 'guardar')
	{
 
	}
	
	switch($lastAction[1])
	{	
		case 'modificar':
			$e = new miniTemplate($path_admin.'form.tpl');
			$e->setVariable('opcion',$ControlHtml->lastActionArray[0]);
			$ControladorInscripcion = new ControladorInscripcion();
			$ListaDeObjetos = $ControladorInscripcion->obtenerListadoActivo($valores['email']);
			$ListaDeObjetos[0]['fecha_html'] = ControladorFechas::fecha2Date($ListaDeObjetos[0]['fecha'],0,true); 
			//$ListaDeObjetos[0]['nombre'] 	 = ucwords(strtolower($ListaDeObjetos[0]['nombre']));
//			$ListaDeObjetos[0]['apellidos']  = ucwords(strtolower($ListaDeObjetos[0]['apellidos']));

			$ControlPais = new ControlPais();
 			$pais = $ControlPais->getPaises($ListaDeObjetos[0]['pais']);
 			$ListaDeObjetos[0]['pais_nombre'] = $pais[0]['pais'];  			
			foreach($ListaDeObjetos[0] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}   
			//Funciones::mostrarArreglo($ListaDeObjetos[0]);
			
			$ControladorAreasInscripcion = new ControladorAreasInscripcion();
			$areas = $ControladorAreasInscripcion->obtenerListadoCompleto($valores['email']);
			// Funciones::mostrarArreglo($areas);
			for($i=0; $i < count($areas); $i++)
			{
				$e->addTemplate('bloque_area');
				foreach($areas[$i] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}   
			}
			$ControladorDisciplinasInscripcion = new ControladorDisciplinasInscripcion();
			$disciplinas = $ControladorDisciplinasInscripcion->obtenerListadoCompleto($valores['email']);
			// Funciones::mostrarArreglo($areas);
			for($i=0; $i < count($disciplinas); $i++)
			{
				$e->addTemplate('bloque_disciplinas');
				foreach($disciplinas[$i] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}   
			}
			
		break;
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion',$ControlHtml->lastActionArray[0]);
			$ControladorInscripcion = new ControladorInscripcion();
			$ListaDeObjetos = $ControladorInscripcion->obtenerListadoActivo();
			// Funciones::mostrarArreglo($ListaDeObjetos[1]);
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$total = count($ListaDeObjetos); 
				$e->setVariable('total_inscritos',$total);
				for($i=0; $i < $total; $i++)
				{
					$e->addTemplate('lista_item');
					$ListaDeObjetos[$i]['fila'] = $i + 1;
					$ListaDeObjetos[$i]['fecha_html'] = ControladorFechas::fecha2Date($ListaDeObjetos[$i]['fecha'],0,true);  
					//$ListaDeObjetos[$i]['nombre'] = ucwords(strtolower($ListaDeObjetos[$i]['nombre']));
//					$ListaDeObjetos[$i]['apellidos'] = ucwords(strtolower($ListaDeObjetos[$i]['apellidos']));
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
	}
	echo $e->toHtml();
?>