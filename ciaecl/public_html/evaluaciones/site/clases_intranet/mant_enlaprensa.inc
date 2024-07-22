<?php

	global $ControlHtml;  	
	$theSession 	= $ControlHtml->theSession;   
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/enlaprensa/'; 
	 		 
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	
	$MantenedoresGeneral 		= new MantenedoresGeneral();
 	$MantenedoresGeneralObjeto 	= new MantenedoresGeneralObjeto(); 
	$FormGeneral  				= new FormGeneral(); 

	$ControlClase = new ControlEnLaPrensaObjeto(); 
	$ObjetoClase  = new EnLaPrensaObjeto();  
	
	switch($lastAction[1])
	{ 
		case 'guardar':
			Funciones::mostrarArreglo($valores);
			//Funciones::mostrarArreglo($archivos);
			$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores);  
			$ObjetoClase->buscarObjeto($ObjetoClase->id_prensa);
		break;
		case 'eliminar':
			$MantenedoresGeneralObjeto->eliminarObjetoSimple($ObjetoClase,$valores);
		break;
	}
	switch($lastAction[1])
	{	
		default:
			switch($lastAction[0])
			{
				case 'view_comunicaciones_enlaprensa_antiguas';
					$ControlClase->agnoHistorico();
				break;
				default:
					$ControlClase->agnoActual();
				break; 
			}
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerListado();
			 
			// Funciones::mostrarArreglo($ListaDeObjetos[1]);
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$e = $MantenedoresGeneral->mostrarListado($e,$ListaDeObjetos,$ObjetoClase->dbKey,$lastAction[0]);
			}		
		break;	
		case 'modificar':
			$e = new miniTemplate($path_admin.'form.tpl'); 

			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerElemento($valores['id_item']); 
			if(!is_array($ListaDeObjetos))
			{
				$ListaDeObjetos[0]['fecha_html'] = date("d-m-Y");
			}  			 
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$ObjetoClase->dbKey];
			$e = $MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);   
		break;
	} 
	echo $e->toHtml();
?>