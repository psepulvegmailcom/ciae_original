<?
 
	global $ControlHtml;
	$theSession 		= $ControlHtml->theSession; 
	$lastAction 		= $ControlHtml->lastActionArray;  	 
	 		 
	$FormGeneral 		= new FormGeneral();  

	$valoresArchivos 	= VarSystem::getFile();
	$opcionHtml 		= VarSystem::getVariable('page','GET'); 

	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'admin/file/mant.tpl'); 
	if($opcionHtml == 'mantfile')
	{
		$path  = VarSystem::getPathVariables('dir_repositorio').'doc/docs/';
		$e->setVariable('titulo_form','Archivos');
	}
	else
	{
		$path  = VarSystem::getPathVariables('dir_repositorio').'imagenes/others/'; 
		$e->setVariable('titulo_form','Imagen');
	}

		//echo $path;
	if(is_array($valoresArchivos))
	{
		$DocumentFile 			= new DocumentFile($path); 
		 
		$error_save = false; 
		foreach($valoresArchivos as $key => $valor)
		{
			$DocumentFile->setFileArray($valor); 
			if(!$DocumentFile->saveFile())
			{
				if(trim($DocumentFile->getOriginalName()) != '')
				{
					$msg = "El archivo ".$DocumentFile->getOriginalName()." no se pudo guardar porque ";
					if($DocumentFile->isErrorExtension())
						$msg .= " no pertenece a los archivos permitidos";
					else
						$msg .= " ocurri&oacute; un error al intentar guardarlo, por favor intentelo nuevamente o comuniquese con la administraci&oacute;n del sistema"; 
					$this->ControlHtml->showMensajeGuardarDatos('error',$msg);
					$error_save = true;
				}
			}
			else
			{
				$aux = $DocumentFile->getFileName();			
				$new = str_replace('/','',$aux);
				//if($opcionHtml == 'mantfile')
					$new = $DocumentFile->getOriginalName().'_'.time().'.'.$DocumentFile->getFileExtension();
				copy($path.$aux,$path.$new);
				$DocumentFile->deleteFile(); 
				$largo 		= strlen($DocumentFile->folderName);
				while($largo > 0)
				{					
					$carpetas 	= substr($DocumentFile->folderName,0,$largo);
					rmdir($path.$carpetas); 
					$largo 		= $largo-2;
				}
			}
		}
	} 

	$archivos 	= SIDTOOLHtml::obtenerArchivos($path); 
	$total 		= count($archivos);
	for($i=0; $i < $total; $i++)
	{ 	
		if($opcionHtml == 'mantfile')
		{
			$e->addTemplate('lista_item_file'); 
			$e->setVariable('file',$archivos[$i]);
			$extension         = strtolower(trim(array_pop(explode('.',$archivos[$i]))));
			$e->setVariable('extension',$extension);
		}
		else
		{			
			$e->addTemplate('lista_item_img'); 
			$e->setVariable('imagen_file',$archivos[$i]);
		}
		if($i%2 == 0)						
			$e->setVariable('class_color','fondo_oscuro');
	}
	echo $e->toHtml(); 
?>