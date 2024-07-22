<?php
	global $ControlHtml;  	 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'cursometaforas/curso.tpl');
 
  	$valoresGet = VarSystem::getGet();
  	$valores 	= VarSystem::getPost();   
  
  	$e->setVariable('opcion_extra','interesados_cursometaforas');
	$e->addTemplate('bloque_mostrar_div');
	if(trim($valoresGet['opcion']) == '')
	{
		$valoresGet['opcion'] = 'ficha_programa';
	}
	$e->setVariable('opcion',$valoresGet['opcion']);
	
	switch($valoresGet['opcion'])
	{
		case 'ficha_inscripcion':
		 	if(isset($valores['guardar']) && trim($valores['guardar']) == 'guardar')
		 	{
				$Inscripcion = new Inscripcion();
 				$Inscripcion->consultaInscripcion($valores['form_email'],$valores['form_tipo_inscripcion']);
 
 				foreach($valores as $var => $val)
 				{
 					$aux = explode('_',$var);
 					if($aux[0] == 'form')
 					{
 						unset($aux[0]);
						$var = implode('_',$aux);
 						$Inscripcion->$var = $val;
					}
 				}  		
				$Inscripcion->guardar(); 
				$e->addTemplate('bloque_envio_exito');
			}
		break;
		case 'ficha_fotos':
			$dir 		= VarSystem::getPathVariables('dir_repositorio')."image/otros/curso_metaforas/"; 
			$imagenes 	= Funciones::obtenerListaArchivos($dir);
		//	Funciones::mostrarArreglo($imagenes,true);
			if(is_array($imagenes) && count($imagenes)>0)
			{					
				$listar_fila = VarSystem::getTotalListarGaleria();
				$por_fila = 0;  
				foreach($imagenes as $var => $val)
				{  
					if($por_fila == 0 || $por_fila == $listar_fila)
					{
						$e->addTemplate('bloque_elemento_galeria_tr');
						$por_fila = 0;
					}
					$e->addTemplate('bloque_elemento_galeria_td');
					$e->setVariable('imagen',$var);
					$e->setVariable('id',$valoresGet['id']);
					$por_fila++;
				}
			}			
		break;
		case 'ficha_videos_13':
			$e->addTemplate('bloque_visualizacion_13');
			$e->setVariable('video',"Nota Canal 13");
			$e->setVariable('video',"curso_metaforas_canal13.flv");
			$path = 'otros/curso_metaforas/';
			$e->setVariable('path',$path);
		break;
		case 'ficha_videos':
			$dir = VarSystem::getPathVariables('dir_repositorio')."doc/otros/curso_metaforas_video/";
			$imagenes = Funciones::obtenerListaArchivos($dir);
			 
			if(is_array($imagenes) && count($imagenes)>0)
			{					
				$listar_fila = VarSystem::getTotalListarGaleria();
				$listar_fila = 1;
				$por_fila = 0;  
				foreach($imagenes as $var => $val)
				{  
					if($por_fila == 0 || $por_fila == $listar_fila)
					{
						$e->addTemplate('bloque_elemento_galeria_video_tr');
						$por_fila = 0;
					}
					$e->addTemplate('bloque_elemento_galeria_video_td');
					$e->setVariable('imagen',$var);
					$e->setVariable('id',$valoresGet['id']);
					$por_fila++;
				}
			}
			
			if(trim($valoresGet['video']) != '')
			{
				$e->addTemplate('bloque_visualizacion');
				$e->setVariable('video',$valoresGet['video']);
				$path = 'otros/curso_metaforas_video/';
				$e->setVariable('path',$path);
			}
		break;
	} 
	echo $e->toHtml();
?> 