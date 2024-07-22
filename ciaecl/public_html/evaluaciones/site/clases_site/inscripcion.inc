<?php

	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'inscripcion.tpl'); 
 	$valores = VarSystem::getPost();
 	$conPost = true;
 	if(count($valores) == 0)
 	{
 		$valores = VarSystem::getGet();
 		$conPost = false;
 	} 
 	$mostrarValores = false; 
 	$mostrarError  	= false; 
 	$mostrarExito 	= false;
 	$mensajeError  	= ''; 
 	$e->setVariable('clave_explicacion','Ingrese clave para su registro');

 	if(isset($valores['guardar']))
 	{
 		switch($valores['guardar'])
 		{
 			case 'guardar':
	 			$Inscripcion = new Inscripcion();
 				$Inscripcion->consultaEmail($valores['form_email']);
 				//Funciones::mostrarArreglo($Inscripcion);
 				if($Inscripcion->clave == $valores['form_clave'] || !isset($Inscripcion->email))
 				{
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
					$mostrarExito = true;
					
					$DisciplinasInscripcion = new DisciplinasInscripcion();
					$DisciplinasInscripcion->eliminarElementos($Inscripcion->email);
					for($i=0; $i < count($valores['form_disciplina']); $i++)
					{
						$DisciplinasInscripcion = new DisciplinasInscripcion();
						$DisciplinasInscripcion->guardarElemento($Inscripcion->email,$valores['form_disciplina'][$i]);	
					}
					$AreasInscripcion = new AreasInscripcion();
					$AreasInscripcion->eliminarElementos($Inscripcion->email);
					for($i=0; $i < count($valores['form_areas']); $i++)
					{
						$AreasInscripcion = new AreasInscripcion();
						$AreasInscripcion->guardarElemento($Inscripcion->email,$valores['form_areas'][$i]);	
					}
			 		if($valores['page'] == 'view_envio')
			 		{
			 			$DocumentFile 			= new DocumentFile(VarSystem::getPathVariables('dir_repositorio').'envios/');
			 			$valoresArchivos 	= VarSystem::getFile();
			 			$DocumentFile->setFileArray($valoresArchivos['archivo_trabajo']); 
			 			
						if(!$DocumentFile->saveFile() || ($DocumentFile->getFileExtension() != 'doc' && $DocumentFile->getFileExtension() != 'docx' && $DocumentFile->getFileExtension() != 'pdf'  ))
						{
							$mostrarError 	= true;
							$mostrarValores = true;
			 				$mostrarExito 	= false; 
							$mensajeError 	= 'No se puedo guardar el archivo, por favor inténtelo nuevamente. <br>Recuerde que debe tener extensión doc o docx.';
						}
						else
						{
				 			$EnvioInscripcion 			= new EnvioInscripcion();
				 			$EnvioInscripcion->email 	= $valores['form_email'];
				 			$EnvioInscripcion->titulo 	= $valores['titulo_trabajo'];
				 			$EnvioInscripcion->archivo	= $DocumentFile->getFileName(); 
				 			$EnvioInscripcion->area 	= $valores['area_trabajo'];
				 			$EnvioInscripcion->fecha 	= time();
				 			$EnvioInscripcion->saveObject();  
			 				$mostrarExito = true; 
						} 
			 		}
			 		$cartaInscripcion 			= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/inscripcion.tpl');
 				}
 				else
 				{
 					$e->setVariable('error_clave','Debe ingresar la clave correcta para poder completar el formulario');
 					$mostrarValores = true;
 				}
 			break;
 			case 'consultaEmail':
 				$Inscripcion 				= new Inscripcion();
 				$Inscripcion->consultaEmail($valores['form_email']); 
 				if(isset($Inscripcion->email))
				{		
 					$mostrarValores = true;
				}
				$e->setVariable('email',$valores['form_email']);
 			break;
 			case 'olvidoEmail':
 				$Inscripcion 				= new Inscripcion();
 				$Inscripcion->consultaEmail($valores['form_email']); 
 				if(isset($Inscripcion->email))
				{		
 					$mostrarValores = true;
 					$carta 			= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/olvidoClave.tpl');
 					$carta->setVariable('email',$Inscripcion->email);
 					$carta->setVariable('clave',$Inscripcion->clave); 
 					Funciones::sendEmail($Inscripcion->email,'Olvido Clave',$carta->toHtml());	
				}
 			break;
 		} 
 	}
 	
 	/** SE MUESTRAN LOS VALORES EN EL FORMULARIO*/
 	if($mostrarValores)
 	{ 	 
 		//Funciones::mostrarArreglo($Inscripcion);
		$datos = get_object_vars($Inscripcion);
		foreach($datos as $var => $val)
		{
			$e->setVariable($var,$val); 
		}  
		$e->setVariable('clave_explicacion','Ingrese la clave de su registro');	
		$e->setVariable('clave',''); 
		$e->addTemplate('bloque_consulta_email');
		$e->setVariable('pais',$Inscripcion->pais); 
		$aux = explode(', ',$Inscripcion->areas);
		foreach($aux as $key => $val)
		{			
			$e->addTemplate('bloque_select');
			$e->setVariable('valor',html_entity_decode($val)); 
			$e->setVariable('form','form_areas'); 
		}
		$aux = explode(', ',$Inscripcion->disciplina);
		foreach($aux as $key => $val)
		{			
			$e->addTemplate('bloque_select');
			$e->setVariable('valor',html_entity_decode($val)); 
			$e->setVariable('form','form_disciplina'); 
		}
		$e->addTemplate('bloque_olvido_clave');
 	} 
 	
	$areasLista = array();
	if(isset($Inscripcion->email))
	{
		$ControladorAreasInscripcion = new ControladorAreasInscripcion();
		$aux = $ControladorAreasInscripcion->obtenerListado($Inscripcion->email); 
		for($i=0; $i < count($aux);$i++)
		{
			$areasLista[$aux[$i]['id_areas']] = 1;
		}
		$ControladorDisciplinasInscripcion = new ControladorDisciplinasInscripcion();
		$aux = $ControladorDisciplinasInscripcion->obtenerListado($Inscripcion->email); 
		for($i=0; $i < count($aux);$i++)
		{
			$disciplinasLista[$aux[$i]['id_disciplina']] = 1;
		}  				
	}
 	
 	$ControladorAreas = new ControladorAreas();
 	$areas = $ControladorAreas->obtenerListado();
 	for($i=0; $i < count($areas); $i++)
 	{
 		$e->addTemplate('bloque_inscripcion_areas');
 		$e->setVariable('valor',$areas[$i]['id_area']); 
 		$e->setVariable('texto',$areas[$i]['area']); 
 		if(isset($areasLista[$areas[$i]['id_area']]) && $mostrarValores)
 		{ 
 			$e->setVariable('checked','checked');
 		}
 		$e->addTemplate('bloque_inscripcion_areas_envio');
 		$e->setVariable('valor',$areas[$i]['id_area']); 
 		$e->setVariable('texto',$areas[$i]['area']); 
 	}
 	
 	$ControladorDisciplinas = new ControladorDisciplinas();
 	$disciplinas = 	$ControladorDisciplinas->obtenerListado();
 	for($i=0; $i < count($disciplinas); $i++)
 	{
 		$e->addTemplate('bloque_inscripcion_disciplina');
 		$e->setVariable('valor',$disciplinas[$i]['id_disciplina']); 
 		$e->setVariable('texto',$disciplinas[$i]['disciplina']); 
 		if(isset($disciplinasLista[$disciplinas[$i]['id_disciplina']]) && $mostrarValores)
 		{ 
 			$e->setVariable('checked','checked');
 		}
 	} 
 	$ControlPais = new ControlPais();
 	$pais = $ControlPais->getPaises();
 	//Funciones::mostrarArreglo($pais);
 	for($i=0; $i < count($pais); $i++)
 	{
 		$e->addTemplate('bloque_inscripcion_pais');
 		$e->setVariable('valor',$pais[$i]['pais_id']); 
 		$e->setVariable('texto',$pais[$i]['pais']);  
 	} 
 	
 	if($valores['page'] == 'view_envio')
 	{
 		$e->addTemplate('bloque_envio_archivo');
	 	for($i=0; $i < count($areas); $i++)
	 	{
	 		$e->addTemplate('bloque_inscripcion_areas_envio');
	 		$e->setVariable('valor',$areas[$i]['id_area']); 
	 		$e->setVariable('texto',$areas[$i]['area']); 
	 	}  
 	}
 	if($mostrarError)
 	{
 		$e->addTemplate('bloque_envio_error');
 		$e->setVariable('mensaje_error',$mensajeError); 
 	}
 	if($mostrarExito)
 	{
	 	if(is_object($cartaInscripcion))
		{
			$datos = get_object_vars($Inscripcion);
			foreach($datos as $var => $val)
			{ 
				$cartaInscripcion->setVariable($var,$val);				 
			}  	
			$asunto = 'Registro Congreso';	
			if($valores['page'] == 'view_envio')
			{	
				$asunto = 'Registro Envio Congreso';
				$cartaInscripcion->addTemplate('bloque_envio_archivo');
				$cartaInscripcion->setVariable('id_envio',$EnvioInscripcion->id);
				$cartaInscripcion->setVariable('titulo',$valores['titulo_trabajo']);
			 	$ControladorAreas = new ControladorAreas();
			 	$areas = $ControladorAreas->obtenerListado($EnvioInscripcion->area);	
				$cartaInscripcion->setVariable('area',$areas[0]['area']);			
			}
		} 		
 		$e->addTemplate('bloque_envio_exito'); 
 		Funciones::sendEmail($Inscripcion->email,$asunto,$cartaInscripcion->toHtml());
 	} 
	echo $e->toHtml();
?>