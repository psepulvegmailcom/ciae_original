<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession; 
	$lastAction 	= $ControlHtml->lastActionArray;  	 
	 		 
	$FormGeneral 			= new FormGeneral(); 
	$id_noticia = VarSystem::getVariable("id_noticia");
	$accion 	= VarSystem::getVariable("accion");
 
	
	$ControlAvisos 		= new  ControlAvisos();	
	$ControlAvisos->setIdioma('*');
	$ControlAvisos->mostrarTodas(); 
	if($lastAction[1] == 'guardar')
	{
		/*GUARDAR LA MODIFICACION O INGRESO*/ 
		$noticia = $ControlAvisos->getNoticia($id_noticia); 

		$DocumentFile 			= new DocumentFile(VarSystem::getPathVariables('dir_repositorio').'images/news/'); 
		$valoresArchivos 			= VarSystem::getFile(); 
		$error_save = false; 
		foreach($valoresArchivos as $key => $valor)
		{
			$DocumentFile->setFileArray($valor); 
			if($DocumentFile->saveFile())
			{
				$noticia->$key 							= $DocumentFile->getFileName();	 
			}
			else
			{ 
				if(trim($DocumentFile->getOriginalName()) != '')
				{
					$msg = "El archivo ".$DocumentFile->getOriginalName()." no se pudo guardar porque ";
					if($DocumentFile->isErrorExtension())
						$msg .= " no pertenece a los archivos permitidos";
					else
						$msg .= " ocurrió un error al intentar guardarlo, por favor intentelo nuevamente o comuniquese con la administración del sistema"; 
					$this->ControlHtml->showMensajeGuardarDatos('error',$msg);
					$error_save = true;
				}
			}
		}

		$noticia->titulo 			= VarSystem::getVariable("titulo");
		$noticia->noticia  			= Funciones::TextoSimple(VarSystem::getVariable("noticia"),true);
		$noticia->publicar 			= VarSystem::getVariable("publicar");
		$noticia->fecha 			=  ControladorFechas::invertirFecha(VarSystem::getVariable("fecha"));
		$noticia->idioma 			= VarSystem::getVariable("idioma");
		$noticia->bajada_home		= VarSystem::getVariable("bajada_home");
		$noticia->bajada_noticia	= VarSystem::getVariable("bajada_noticia");
		$noticia->home 				= VarSystem::getVariable("home");
		$noticia->saveData(); 
		$lastAction[1] = '';
	}
	if($lastAction[1] == 'eliminar')
	{
		$ControlAvisos->eliminarNoticia($id_noticia);
		$lastAction[1] = '';
	}
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/noticias/mant.tpl'); 
			$ListaDeObjetos	 	= $ControlAvisos->getLista();
				
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{
				for($i=0; $i < count($ListaDeObjetos); $i++)
				{ 
					$e->addTemplate('lista_item');  
					$e->setVariable('fecha',ControladorFechas::invertirFecha($ListaDeObjetos[$i]['fecha']));
					$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo']);
					$e->setVariable('elem_lang',$ListaDeObjetos[$i]['idioma']);
					$e->setVariable('id_noticia',$ListaDeObjetos[$i]['id_noticia']); 
					if($ListaDeObjetos[$i]['publicar'] == 0)
						$e->setVariable('publicar_no','no_');
					if($ListaDeObjetos[$i]['home'] == 0)
						$e->setVariable('popup_no','no_');
						
					if($i%2 == 0)						
						$e->setVariable('class_color','fondo_oscuro');
				}
			}  
		break;
		case 'modificar':
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/noticias/form.tpl');
			$e->setVariable('caso_form','Edición');
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$ListaDeObjetos	 	= $ControlAvisos->getLista($id_noticia);
			$i = 0;
			$e->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
			$e->setVariable('id_noticia',$ListaDeObjetos[$i]['id_noticia']);  
			$e->setVariable('bajada_home',$ListaDeObjetos[$i]['bajada_home']);  
			$e->setVariable('bajada_noticia',$ListaDeObjetos[$i]['bajada_noticia']); 
			$e->setVariable('imagen_bajada',$ListaDeObjetos[$i]['imagen_bajada']);  
			$e->setVariable('imagen_noticia',$ListaDeObjetos[$i]['imagen_noticia']); 						
			$e->setVariable('fecha',ControladorFechas::invertirFecha($ListaDeObjetos[$i]['fecha']));
			if($ListaDeObjetos[$i]['publicar'] == 1)
				$e->setVariable('publicar_checked','checked');
			else
				$e->setVariable('no_publicar_checked','checked');
			if($ListaDeObjetos[$i]['home'] == 1)
				$e->setVariable('popup_checked','checked');
			else
				$e->setVariable('no_popup_checked','checked');
			$e->setVariable('select_idioma',$FormGeneral->showSelectIdiomas($ListaDeObjetos[$i]['idioma'])); 

			$ListaDeObjetos[$i]['noticia'] = Funciones::TextoSimple($ListaDeObjetos[$i]['noticia']); 
			$elEditor = new TextEditor('noticia',$ListaDeObjetos[$i]['noticia'],85,200);   
			$editorHtml =   $elEditor->toHtml(false);		
			$e->setVariable('noticia_text',$editorHtml); 
			
		break;
		case 'ingresar':
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/noticias/form.tpl');
			$e->setVariable('caso_form','Ingresar');
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			 			
			$e->setVariable('fecha', ControladorFechas::fechaActual(false,false));
			$e->setVariable('publicar_checked','checked'); 
			$elEditor = new TextEditor('noticia','',85,200);   
			$editorHtml =   $elEditor->toHtml(false);		
			$e->setVariable('noticia_text',$editorHtml); 
		break;
	} 
	
	echo $e->toHtml();
?>
