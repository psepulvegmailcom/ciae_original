<?php

	global $ControlHtml;  	
	$theSession 	= $ControlHtml->theSession;   
	$theSessionPersona = $ControlHtml->elUsuarioPersona;
	$lastAction 	= $ControlHtml->lastActionArray; 
	//   Funciones::mostrarArreglo($ControlHtml);
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/noticias/'; 
	 		 
	$filas_externas = 10;
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	
	$MantenedoresGeneral 		= new MantenedoresGeneral();
 	$MantenedoresGeneralObjeto 	= new MantenedoresGeneralObjeto(); 
	$FormGeneral  				= new FormGeneral(); 

	$ControlClase = new ControlNoticiaObjeto(); 
	$ObjetoClase  = new NoticiaObjeto(); 

	
	switch($lastAction[1])
	{ 
		case 'eliminar':
			$MantenedoresGeneralObjeto->eliminarObjetoSimple($ObjetoClase,$valores);
		break;
		case 'publicar':
			$MantenedoresGeneralObjeto->activarObjetoSimple($ObjetoClase,$valores,'activo');
		break;
		case 'destacar_home':
			$MantenedoresGeneralObjeto->activarObjetoSimple($ObjetoClase,$valores,'destacado');
		break;
		case 'guardar':
			//Funciones::mostrarArreglo($valores);
			//Funciones::mostrarArreglo($archivos);
			$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores);
			if(!isset($ObjetoClase->id_noticia))
			{
				$ObjetoClase->id_noticia = $ObjetoClase->id;
			}  
			$ObjetoClase->buscarObjeto($ObjetoClase->id_noticia);
			//Funciones::mostrarArreglo($ObjetoClase,true);
			
			$path_doc  		= VarSystem::getPathVariables('dir_repositorio').'image/noticias/';
			
			$formimagen_elimnar = $valores['formimagen_elimnar'];
			if(is_array($formimagen_elimnar) && count($formimagen_elimnar) > 0)
			{  
				for($i=0; $i < count($formimagen_elimnar); $i++)
				{
					$ObjetoClase->$formimagen_elimnar[$i] = '';
				}
				$ObjetoClase->guardarObjeto($ObjetoClase->id_noticia);
			} 
			
			$archivosFile	= VarSystem::getFile();  
			//Funciones::mostrarArreglo($archivosFile,true);
			//Funciones::mostrarArreglo($path_doc,true);
			$archivos 		= array('form_imagen','form_imagen2','form_imagen3'); 
			for($i=0; $i < count($archivos); $i++)
			{ 
				if($archivosFile[$archivos[$i]]['error'] == '0' )
				{
					$DocumentFile  	= new DocumentFile($path_doc); 
					$DocumentFile->setFileArray($archivosFile[$archivos[$i]]);
					//$archivosFile[$archivos[$i]]['new_name'] = $ObjetoClase->id_noticia.'_'.Funciones::cleanChar($archivosFile[$archivos[$i]]['name']); 
					$archivosFile[$archivos[$i]]['new_name'] = $ObjetoClase->id_noticia.'-'; 
					$DocumentFile->setFileArray($archivosFile[$archivos[$i]]); 
					//Funciones::mostrarArreglo($DocumentFile,true);	
					//Funciones::mostrarArreglo($archivosFile[$archivos[$i]],true);	
					if($DocumentFile->saveFile(false))
					{
						//Funciones::mostrarArreglo($DocumentFile,true);	
						$aux = str_replace('form_','',$archivos[$i]);
						$ObjetoClase->$aux  = $DocumentFile->getFileName(); 
						//Funciones::mostrarArreglo($ObjetoClase,true);
					}			 				
				} 
			}  
			
			$path_doc  = VarSystem::getPathVariables('dir_repositorio').'image/noticias/'.$ObjetoClase->id_noticia.'/';			
			$formimagengaleria_eliminar = $valores['formimagengaleria_eliminar'];
			if(is_array($formimagengaleria_eliminar) && count($formimagengaleria_eliminar) > 0)
			{
				for($i=0; $i < count($formimagengaleria_eliminar); $i++)
				{
					unlink($path_doc.$formimagengaleria_eliminar[$i]);
				}
			}
			

			for($i=0; $i < $filas_externas; $i++)
			{ 
				$fila = $i + 1;
				if($archivosFile['form_galeria_'.$fila]['error'] == '0' )
				{
					$DocumentFile  	= new DocumentFile($path_doc); 
					$DocumentFile->checkPath(); 
					$DocumentFile->setFileArray($archivosFile['form_galeria_'.$fila]);
					//$archivosFile['form_galeria_'.$fila]['new_name'] = $ObjetoClase->id_noticia.'_'.Funciones::cleanChar($archivosFile['form_galeria_'.$fila]['name']); 
					$archivosFile['form_galeria_'.$fila]['new_name'] = $ObjetoClase->id_noticia.'-'; 
					$DocumentFile->setFileArray($archivosFile['form_galeria_'.$fila]);  
					if($DocumentFile->saveFile(false))
					{ 
						$ObjetoClase->tiene_galeria  = '1';  
					}			 				
				}
			}
			$ObjetoClase->guardarObjeto($ObjetoClase->id_noticia); 
			
			
			$ControlNoticiasLink = new ControlNoticiasLink();
			$ControlNoticiasLink->eliminarElementosNoticia($ObjetoClase->id_noticia);
			
			$links = $valores['formlink'];
			$path_doc  		= VarSystem::getPathVariables('dir_repositorio').'doc/noticias/';
			for($i=0; $i <= $filas_externas; $i++)
			{
				if(trim($links['url'][$i]) != '')
				{
					$links['tipo'][$i] = 'url';
				}
				if($archivosFile['formlink_file_'.$i]['error'] == '0' )
				{
					$DocumentFile  	= new DocumentFile($path_doc); 
					$DocumentFile->checkPath(); 
					$DocumentFile->setFileArray($archivosFile[$archivos[$i]]);
					$archivosFile['formlink_file_'.$i]['new_name'] = $ObjetoClase->id_noticia.'_'.Funciones::cleanChar($archivosFile[$archivos[$i]]['name']); 
					$DocumentFile->setFileArray($archivosFile['formlink_file_'.$i]);  
					if($DocumentFile->saveFile(false))
					{ 
						$links['tipo'][$i] = 'doc';
						$links['url'][$i]	= $DocumentFile->getFileName(); 
					}			 				
				}
				if(trim($links['url'][$i]) == '')
				{
					continue;
				}
				$NoticiasLink = new NoticiasLink();
				$NoticiasLink->link 		= $links['url'][$i];
				$NoticiasLink->tipo 		= $links['tipo'][$i];
				$NoticiasLink->texto 		= $links['texto'][$i];
				$NoticiasLink->orden 		= $links['orden'][$i];
				$NoticiasLink->id_noticia 	= $ObjetoClase->id_noticia;
				$NoticiasLink->guardarObjeto();
			}
			//Funciones::mostrarArreglo($links,true); 
		break;
	}

	switch($lastAction[1])
	{	
		default:
			switch($lastAction[0])
			{
				case 'view_comunicaciones_noticias_antiguas';
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

			$e = $FormGeneral->showHeaderForm($e,$lastAction,$valores); 
			$ListaDeObjetos = $ControlClase->obtenerElemento($valores['id_item']); 
			if(!is_array($ListaDeObjetos))
			{
				$ListaDeObjetos[0]['autor'] = $theSessionPersona['nombre'].' '.$theSessionPersona['apellido_paterno'].' - Comunicaciones CIAE';
				$ListaDeObjetos[0]['fecha_html'] = date("d-m-Y");
				$ListaDeObjetos[0]['idioma'] = 'es';
				$ListaDeObjetos[0]['activo'] = '1';
				$ListaDeObjetos[0]['tipo'] = 'noticia';
				$ListaDeObjetos[0]['noticia'] = '....';
				$ListaDeObjetos[0]['destacado'] = '1';
				$ListaDeObjetos[0]['destacado_forzado'] = '0';
			} 
			$ListaDeObjetos[0]['usuario'] = $theSession->userId;
			$ListaDeObjetos[0]['fecha_ingreso'] = time();
  			//Funciones::mostrarArreglo($ListaDeObjetos,true);
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$ObjetoClase->dbKey];
			$e = $MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);  
    	
			$e->setVariable('form_noticia_editor',$FormGeneral->showEditorHTML('form_noticia'));
			
			/** MUESTRA DE IMAGENES EN CASO DE HABERLAS **/
			if(is_array($ListaDeObjetos) && isset($ListaDeObjetos[0]['id_item']))
			{
				for($i=1; $i <= 3; $i++)
				{
					$aux = 'imagen';
					if($i > 1)
					{
						$aux = $aux.$i;
					}
					 
					if(isset($ListaDeObjetos[0][$aux]) && trim($ListaDeObjetos[0][$aux]) != '')
					{
						$e->addTemplate('bloque_'.$aux.'_lateral');
						$e->setVariable('imagen',$ListaDeObjetos[0][$aux]);
					}
				} 
			}
			/** BUSCAR ARCHIVOS DE GALERIA DE FOTOS **/
			if($ListaDeObjetos[0]['tiene_galeria'] == '1')
			{
				$path_galeria  = VarSystem::getPathVariables('dir_repositorio').'image/noticias/'.$ListaDeObjetos[0]['id_item'].'/';
				$imagenes_galeria 	= SIDTOOLHtml::obtenerArchivos($path_galeria);  
			}
			/** BUSCAR LINK EXTERNOS **/
			$ControlNoticiasLink = new ControlNoticiasLink();
			$links = $ControlNoticiasLink->obtenerLinks($ListaDeObjetos[0]['id_item']);
			
			
			for($i=0; $i < $filas_externas; $i++)
			{
				$fila = $i + 1;
				$e->addTemplate('bloque_galeria_archivo');  
				$e->setVariable('fila',$fila);
				if(is_array($imagenes_galeria) && isset($imagenes_galeria[$i]) )
				{
					if($imagenes_galeria[$i] != 'index.php')
					{
						$e->addTemplate('bloque_galeria_archivo_imagen'); 
						$e->setVariable('imagen',$imagenes_galeria[$i]);
						$e->setVariable('id_item',$ListaDeObjetos[0]['id_item']);		
					} 
				}
				
				$e->addTemplate('bloque_noticia_link');
				if(is_array($links)  && isset($links[$i]) && trim($links[$i]['texto']) != '')
				{ 
					//Funciones::mostrarArreglo($links[$i],true);
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$links[$i]);
					
					$e->addTemplate('bloque_noticia_link_eliminar'); 
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$links[$i]); 
				} 
				else
				{
					$e->setVariable('fila',$fila);
				}
			}  
		break;
	} 
	echo $e->toHtml();
?>