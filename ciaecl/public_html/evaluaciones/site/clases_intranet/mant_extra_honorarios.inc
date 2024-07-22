<?php

	global $ControlHtml; 
	$opcion = explode('_',$ControlHtml->lastActionArray[0]);
	unset($opcion[0]);
	unset($opcion[1]);
	$opcion = implode('_',$opcion); 
  	$valoresGet = VarSystem::getGet();  
 
	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'honorarios/actualizacion_datos.tpl'); 
	$e->setVariable('opcion_extra',$opcion);
 	$valores = VarSystem::getPost();
 	$conPost = true;
 	// Funciones::mostrarArreglo($valores); 
 	if(count($valores) == 0)
 	{
 		$valores = VarSystem::getGet();
 		$conPost = false;
 	}  
 	$mostrarValores = false; 
 	$mostrarError  	= false; 
 	$mostrarExito 	= false;
 	$mensajeError  	= '';    


	$DocumentFile 			= new DocumentFile(VarSystem::getPathVariables('dir_repositorio').'doc/honorarios/'); 
	$valoresArchivos 		= VarSystem::getFile();   
	$cantidad_elementos = 10;

 	if(isset($valores['guardar']))
 	{
	 	$valores['form_email']		= strtolower(trim($valores['form_email']));
 		switch($valores['guardar'])
 		{
 			case 'guardar':
 			
	 			$Honorarios = new Honorarios(); 
	 			
				$Honorarios->consultaHonorariosRut($valores['form_rut']); 
	 			$email_original = ''; 
 				Funciones::mostrarArreglo($Honorarios,false,"sdsdsd");
			 	if($valores['form_comuna'] == 0)
			 	{
					$valores['form_comuna'] = 1;
				} 
				$valores['form_rut'] 		= str_replace(array('.','-',' '),array('','',''), $valores['form_rut']);	 
				$valores['form_nombre'] 	= ucwords(strtolower(trim($valores['form_nombre'])));
				$valores['form_apellidos'] 	= ucwords(strtolower(trim($valores['form_apellidos'])));
				
				if(trim($valoresArchivos['form_cv']['name']) != '')
				{
					$DocumentFile->setFileArray($valoresArchivos['form_cv']); 
					$DocumentFile->setNewName($valores['form_rut'].'-cv');
					if($DocumentFile->saveFile(false))
					{ 
						$Honorarios->archivo_cv	= $DocumentFile->getFileName();	 
					}
					else
					{
						//echo "no puedo guardar "; print_r($DocumentFile);
					}
				}
				else
				{
					$Honorarios->archivo_cv	= $valores['form_cv_original'];	 
				}
				
				if(trim($valoresArchivos['form_ci']['name']) != '')
				{
					$DocumentFile->setFileArray($valoresArchivos['form_ci']); 
					$DocumentFile->setNewName($valores['form_rut'].'-ci');
					if($DocumentFile->saveFile(false))
					{ 
						$Honorarios->archivo_ci = $DocumentFile->getFileName();	 
					}
					else
					{
						//echo "no puedo guardar "; print_r($DocumentFile);
					}
				}
				else
				{
					$Honorarios->archivo_ci	= $valores['form_ci_original'];	 
				} 
				 
				foreach($valores as $var => $val)
 				{
 					$aux = explode('_',$var);
 					if($aux[0] == 'form')
 					{
 						unset($aux[0]);
						$var = implode('_',$aux); 
						if($var == 'cv_original' || $var == 'ci_original')
						{
							continue;
						}
 						$Honorarios->$var = $val;
					}
 				}  		  
				$Honorarios->guardar($valores['form_rut']); 
				Funciones::mostrarArreglo($Honorarios); 
				
				$HonorariosTitulo = new HonorariosTitulo();
				$HonorariosTitulo->destroyObject('rut ="'.$valores['form_rut'].'"');
				for($k=1; $k < $cantidad_elementos; $k++)
				{
 					if(trim($valores['formtitulo_'.$k.'_tipo']) != '')
 					{
						$HonorariosTitulo = new HonorariosTitulo(); 

						$valor = $valoresArchivos['formtitulo_'.$k.'_archivo'];
						if(trim($valor['name']) != '')
						{
							$DocumentFile->setFileArray($valor); 
							$DocumentFile->setNewName($valores['form_rut'].'-titulo-'.$k);
							if($DocumentFile->saveFile(false))
							{
								$HonorariosTitulo->archivo	= $DocumentFile->getFileName();	 
							} 
							else
							{
								//echo "no puedo guardar "; print_r($DocumentFile);
							}
						}
						else
						{
							$HonorariosTitulo->archivo	= $valores['formtitulo_'.$k.'_archivo_original'];	 
						}
						
						foreach($valores as $var => $val)
		 				{
		 					$aux = explode('_',$var);
		 					if($aux[0] == 'formtitulo' && $aux[1] == $k)
		 					{
		 						unset($aux[0]);unset($aux[1]);
								$var = implode('_',$aux);
								if($var == 'formfecha')
								{
									$var = 'fecha';
								}
								if($var == 'dia' || $var == 'mes' || $var == 'agno' || $var == 'archivo_original')
								{
									continue;
								}
		 						$HonorariosTitulo->$var = $val;
							}
		 				}   
						$HonorariosTitulo->rut = $valores['form_rut'];
						$HonorariosTitulo->orden = $k; 
						$HonorariosTitulo->guardar($valores['form_rut'],$k); 
					}	
				}

				$HonorariosLabores = new HonorariosLabores();
				$HonorariosLabores->destroyObject('rut ="'.$valores['form_rut'].'"');
				for($k=1; $k < $cantidad_elementos; $k++)
				{
 					if(trim($valores['formlabores_'.$k.'_institucion']) != '')
 					{
						$HonorariosLabores = new HonorariosLabores();
						
						foreach($valores as $var => $val)
		 				{
		 					$aux = explode('_',$var);
		 					if($aux[0] == 'formlabores' && $aux[1] == $k)
		 					{
		 						unset($aux[0]);unset($aux[1]);
								$var = implode('_',$aux);
								if($var == 'formfecha')
								{
									$var = 'fecha';
								}
								if($var == 'dia' || $var == 'mes' || $var == 'agno')
								{
									continue;
								}
		 						$HonorariosLabores->$var = $val;
							}
		 				}   
						$HonorariosLabores->rut = $valores['form_rut'];
						$HonorariosLabores->orden = $k; 
						$HonorariosLabores->guardar($valores['form_rut'],$k); 
					}
				} 
				
				$mostrarValores = true; 				 
				$mostrarExito = true;  		 	 
		 		$cartaHonorarios 			= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/honorarios.tpl'); 
		 		//Funciones::MostrarArreglo($valores);		 	   
 			break;  
 			case 'consultaRut':
 				$Honorarios 				= new Honorarios();  
 				$Honorarios->consultaHonorariosRut(trim($valores['form_rut'])); 
 				if(isset($Honorarios->rut) && trim($Honorarios->rut) != '')
				{		
 					$mostrarValores = true;
				}
				$e->setVariable('email',$Honorarios->email); 
				$e->setVariable('rut',trim($valores['form_rut'])); 
 			break; 
 		} 
 	}  
	
	$ControlComuna = new ControlComuna();
	$comunas = $ControlComuna->getListadoCompleto();
	//Funciones::mostrarArreglo($comunas);
	for($i=0; $i < count($comunas); $i++)
	{
		$e->addTemplate('bloque_comuna');
		foreach($comunas[$i] as $var => $val)
		{
			$e->setVariable($var,$val);
		}
	}  
	
	$ControlPais = new ControlPais();
	$paises = $ControlPais->getPaises(); 
	for($i=0; $i < count($paises); $i++)
	{
		$e->addTemplate('bloque_pais');
		foreach($paises[$i] as $var => $val)
		{
			$e->setVariable($var,$val);
		}
	}    
 	$e->refreshTemplate(); 
	$e->setVariable('cantidad_elementos',$cantidad_elementos);
	
	$ControladorHonorariosTitulo = new ControladorHonorariosTitulo();
	$titulos = $ControladorHonorariosTitulo->obtenerTitulos($valores['form_rut']);
	Funciones::mostrarArreglo($titulos,false,'Mostrar Titulos'); 
	for($k=1; $k < $cantidad_elementos; $k++)
	{
		$e->addTemplate('bloque_titulos_profesionales');
		$template = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'inscripcion/formularios/campos/titulo_profesional.tpl');
		$template->setVariable('orden',$k); 
		$template->setVariable('variable_fecha','formtitulo_'.$k); 
		 
		for($i=0; $i < count($paises); $i++)
		{
			$template->addTemplate('bloque_pais');
			foreach($paises[$i] as $var => $val)
			{
				$template->setVariable($var,$val);
			}
		}   
		if($k <= 1 )
		{
			$template->addTemplate('bloque_mostrar_fila');
			$template->setVariable('orden',$k);
		}
		
		if($mostrarValores)
		{			
			$k_extra = $k - 1;
			
			if(isset($titulos[$k_extra]))
			{
				$template->refreshTemplate();
				foreach($titulos[$k_extra] as $var => $val)
				{ 
					//echo $var." ".$val."<br>";
					$template->setVariable($var,$val);  
				}   
				$template->setVariable('valor_fecha',$titulos[$k_extra]['fecha']);
				$template->addTemplate('bloque_mostrar_fila');
				$template->setVariable('orden',$k);
			}			
		}
		
		$e->setVariable('formulario_titulo_profesional',$template->toHtml());
		$e->addTemplate('bloque_validacion_titulo');
		$e->setVariable('orden',$k); 
	} 

	$ControladorHonorariosLabores = new ControladorHonorariosLabores();
	$labores = $ControladorHonorariosLabores->obtenerLabores($valores['form_rut']);	
	for($k=1; $k < $cantidad_elementos;$k++)
	{
		$template = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'inscripcion/formularios/campos/labores_instituciones_publicas.tpl');
		
		$template->setVariable('orden',$k); 
		if($k <= 1 )
		{
			$template->addTemplate('bloque_mostrar_fila');
			$template->setVariable('orden',$k);
		}
		
		if($mostrarValores)
		{			
			$k_extra = $k - 1;
			
			if(isset($labores[$k_extra]))
			{
				$template->refreshTemplate();
				foreach($labores[$k_extra] as $var => $val)
				{ 
					$template->setVariable($var,$val);  
				}    
				$template->addTemplate('bloque_mostrar_fila');
				$template->setVariable('orden',$k);
			}			
		}		
		
		$e->addTemplate('bloque_convenio_honorarios');
		$e->setVariable('formulario_bloque_convenio_honorarios',$template->toHtml()); 
		
		$e->addTemplate('bloque_validacion_labores');
		$e->setVariable('orden',$k);
	} 
 

 	/** SE MUESTRAN LOS VALORES EN EL FORMULARIO */
 	if($mostrarValores)
 	{ 	 
 		$e->refreshTemplate(); 
		$datos = get_object_vars($Honorarios); 
		foreach($datos as $var => $val)
		{
			$e->setVariable($var,$val);  
		}   
		$e->addTemplate('bloque_select_comuna');
 		$e->setVariable('comuna_id',$Honorarios->comuna);  
 
		foreach($datos as $var => $val)
		{   
			$e->addTemplate('bloque_extra_'.$var);
			$e->setVariable($var,$val);		
		} 		
 	}	
	
 	if($mostrarError)
 	{
 		$e->addTemplate('bloque_envio_error');
 		$e->setVariable('mensaje_error',$mensajeError); 
 	}
 	if($mostrarExito)
 	{
 		$Menu = new Menu();
 		$Menu->getOpcion($valores['lastAction']); 
 		
 		$cartaHonorarios->setVariable('evento',stripcslashes($Menu->titulo_es));
	 	if(is_object($cartaHonorarios))
		{
			$datos = get_object_vars($Honorarios);
			foreach($datos as $var => $val)
			{ 
				$cartaHonorarios->setVariable($var,$val);				 
			}  	
			$asunto = 'Registro datos personales';	 
		} 		 
 		$cartaHonorarios->setVariable('email',VarConfig::site_email_honorarios);
 		$e->addTemplate('bloque_envio_exito'); 
		$e->setVariable('email', $Honorarios->email);
 		Funciones::sendEmail($Honorarios->email,$asunto,$cartaHonorarios->toHtml());
		 
		$cartaHonorarios->setVariable('texto_extra','Rut: '.$valores['form_rut'].'<br>Email: '.$valores['form_email']); 
 		Funciones::sendEmail(VarConfig::site_email_honorarios,$asunto,$cartaHonorarios->toHtml()); 
 		 
 	 
 		//echo $cartaHonorarios->toHtml();
 	} 
	echo $e->toHtml();
?>