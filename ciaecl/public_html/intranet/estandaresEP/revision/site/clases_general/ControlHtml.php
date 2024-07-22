<?php

class ControlHtml 
{	
	
	function ControlHtml()
	{		
		$this->theSession 		= new AuthSessionIntranet();	
		$this->theSession->initSession();
		$this->elUsuarioP		= $this->theSession->userObject;
		$this->prefijoEstilo	= "version3_";
		
		$this->style 			= VarSystem::getPathVariables('path_css').$this->prefijoEstilo.'portal.css';  
		$this->template  		= $this->prefijoEstilo.'index.tpl';  
		$this->login_tpl  		= $this->prefijoEstilo.'login.tpl';  
		$this->footer_tpl  		= $this->prefijoEstilo.'footer.tpl';  
		$this->hidden_tpl  		= $this->prefijoEstilo.'hidden.tpl';  
		$this->laPagina 		= new Page();				
		$this->ControlLogs 		= new ControlLogs(); 
		$this->showMenuEstado 	= true;			  
		$this->indexPopup		= false; 
		$this->indexPopupSimple	= false;
		
		/*PERMISOS DEL USUARIO*/
		$Permiso = new Permiso();
		$Permiso->loadObject('id_permiso = '.$this->elUsuarioP->perms);
		$this->permiso_usuario = $Permiso->alias; 
		$permiso_usuario_general =  explode('_',$this->permiso_usuario);
		$this->permiso_usuario_general = $permiso_usuario_general[0];	 		
	}
	
	function noShowMenu()
	{
		$this->showMenuEstado 	= false;	
	}
	
	function setPopup()
	{
		$this->template  		= $this->prefijoEstilo.'indexPopup.tpl';
		$this->indexPopup		= true;
	}
	
	function setPopupAsistencia()
	{
		$this->template  		= $this->prefijoEstilo.'indexPopupAsistencia.tpl';
		$this->style			= 'http://www.asistenciatecnicaeducativa.cl/ofertasate.css';
		$this->indexPopup		= true;
		$this->indexPopupSimple	= true;
	}
	
	function prepareHtml($option='',$id_oferente='',$caso_revision='')
	{				 
		if(trim($option) != '')
		{
			$this->lastAction 		= $option;
		}				
		else
		{
			$this->lastAction 		= $this->laPagina->lastAction; 
		} 
			
		if(trim($this->lastAction) == '')
		{
			if((bool)$this->theSession->autenticate )
			{
				if($this->elUsuarioP->perms == 3)
					$this->lastAction	= 'mi_registro';
				else
					$this->lastAction	= 'home'; //postulaciones';
			}
			else
			{
				$this->lastAction  = 'home';
			}	
			$this->lastAction  = 'home'; /* caso genérico para que todos vean su  */
		}
		$this->lastActionArray 		= explode("|",trim($this->lastAction));  
		$this->id_oferente 			= $id_oferente;
		$this->caso_revision 		= $caso_revision; 
		$this->preparePage(); 
	}
	
	private function prepareOferente()
	{  
		if(trim($this->id_oferente) == '')
		{ 
			if($this->elUsuarioP->perms == 3)
			{ 
				$this->caso_revision 	= 'registro';
				$ControlPersona 		= new PersonaControl();
				$ControlPersona->setPersonaByUser($this->elUsuarioP);
				$ControlOferente 		= new ControlOferente();
				$ControlOferente->setOferenteByPersona($ControlPersona->getPersona());
				$this->id_oferente 		= $ControlOferente->obj->id_oferente; 
			} 
			else
			{
				$this->id_oferente 		 = VarSystem::getVariable("id_oferente"); 
				if($this->caso_revision == '')
				{
					$this->caso_revision = VarSystem::getVariable("caso_revision"); 
				}
			}
		}	   
		$this->pagina_sistema 			=  VarSystem::getVariable("pagina_sistema");
		$this->pagina_sistema_orden 	=  VarSystem::getVariable("pagina_sistema_orden");
		$this->pagina_sistema_direccion =  VarSystem::getVariable("pagina_sistema_direccion");
		if($this->pagina_sistema == 0)
		{
			$this->pagina_sistema 			= 1;
			$this->pagina_sistema_orden 	= '';
			$this->pagina_sistema_direccion = '';
		}			 
	}
	
	function setBarraNavegacion($barra)
	{			 
		$this->t->setVariable('barra_navegacion',$barra); 	 
	} 
	
	function setTituloModulo($titulo)
	{ 
		$FormGeneral = new FormGeneral();
		$this->t->addTemplate('bloque_titulo_modulo');
		$this->t->setVariable('bloque_titulo_modulo',$FormGeneral->showTituloModulo($titulo)); 	
		$this->t->refreshTemplate();
	}
	
	function showSelloCalidad()
	{	 
		$this->t->addTemplate('bloque_home_sello'); 
		$this->t->refreshTemplate();
	}

	private function showFooter()
	{
		$this->footer 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').$this->footer_tpl);
		$LogsVisit 		= new LogsVisit();
		$this->footer->setVariable('visit_counter',$LogsVisit->totalVisitas());		
		$this->t->setVariable('footer_page',$this->footer->toHtml());
		
		/*************************************************************************************
					VALORES HIDDEN
		**************************************************************************************/					
		
		$hiddentpl = new miniTemplate(VarSystem::getPathVariables('dir_template_general').$this->hidden_tpl);	
		$hiddentpl->setVariable('pagina_sistema', $this->pagina_sistema); 			 
		$hiddentpl->setVariable('pagina_sistema_orden',$this->pagina_sistema_orden);  
		$hiddentpl->setVariable('pagina_sistema_direccion',$this->pagina_sistema_direccion);
		
		$hiddentpl->setVariable('id_oferente', $this->id_oferente); 
		$hiddentpl->setVariable('caso_revision', $this->caso_revision); 
		$this->t->setVariable('hidden_page',$hiddentpl->toHtml());
	}
	
	private function preparePage()
	{
		$this->siteTitle 	= VarSystem::getInfoSystem('title');			
		$this->laPagina->setCss($this->style);
		
		$this->laPagina->setTitle($this->siteTitle['title'].VarConfig::versionSitio);		 
			
		/* CHECK LOGOUT */
		if(is_array($this->lastActionArray))
		{
			if (trim($this->lastActionArray[0]) == 'logout') 
			{   						 		
				$this->theSession->logout();					
				$this->ControlLogs->setLog('logout',$this->elUsuarioP->username);	 
				//header( 'location: http://'.$_SERVER["HTTP_HOST"]."".$_SERVER["REQUEST_URI"] );								 
				$this->lastAction  = 'ingreso';				
			} 	
		}	
		
		/*  INICIO DEL TEMPLATE */  
		$this->t = new miniTemplate(VarSystem::getPathVariables('dir_template_general').$this->template);
		$this->prepareOferente();  
		 
		$this->t->setVariable('tpl_email_contacto',VarSystem::getInfoSystem('email_contacto'));
		$this->t->setVariable('tpl_direccion_contacto',VarSystem::getInfoSystem('direccion'));
		$this->t->setVariable('tpl_telefono_contacto',VarSystem::getInfoSystem('telefono'));
		$this->t->setVariable('tpl_horario_contacto',VarSystem::getInfoSystem('horario'));
		 
		$this->t->setVariable('titulo_fecha','Fecha');	
		$this->t->setVariable('titulo_grande',$this->siteTitle[1]);
		$this->t->setVariable('titulo_chico',$this->siteTitle[0]."<br />".VarConfig::versionSitio);	
		$this->t->setVariable('id_menu',$this->id_menu);
		$this->t->setVariable('id_submenu',$this->id_submenu); 
		
		/*************** PRESENTACION DE USUARIO ***************/
		$this->showUserInfo();
					
		/******************** PRESENTACION NOTICIAS ********************/
		$this->showNoticias();
					
		/******************** PRESENTACION ESTRUCTURA DEL MENU ********************/
		$this->showMenu();
	
		/******************** PRESENTACION ESTRUCTURA BODY ********************/ 
		$this->showBody();  
		
		/******************** PRESENTACION ESTRUCTURA FAQ ********************/
		$this->showFAQ();	 
			
		/******************** MUESTRA MENSAJE DE POPUP DE ALERT ********************/
		$this->showMensajeAlert(); 
				
		/******************** PRESENTACION ESTRUCTURA LINK ********************/
		//$this->showLink(); 
		 
		/******************** REGISTRO DE LOG DEL USUARIOS ********************/ 	
		$guardar = VarSystem::getVariable('guardar_caso');
		if(trim($guardar) != '')
		{
			$guardar = "|".$guardar;
		}
		else
		{
			$guardar = ''; 
		}

		$msg_log = trim($this->lastAction.$guardar);
		$setNuevaVisita = false;
		if(($msg_log == 'home'  || $msg_log == 'ingreso' || $msg_log == 'ingreso|' || $msg_log == 'home|') || $this->elUsuarioP->username == 'unknown')
		{
			$valores 	= VarSystem::getPost();
			if(count($valores) == 0)
				$setNuevaVisita = true;
		}
		$this->ControlLogs->setLog('USER-USO',$this->elUsuarioP->username,$this->lastAction.$guardar,$setNuevaVisita);
		
		/*************** PRESENTACION DE FOOTER ***************/
		$this->showFooter();		
		if((bool)$this->theSession->autenticate)
		{ 
			$this->sessionMantencion();
		}		
		$this->laPagina->add(new HtmlText($this->t->toHtml())); 
	}
	
	function showMensajeGuardarDatos($caso,$mensaje='',$cerrar=true)
	{ 
		$f  = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'mensaje_guardar_datos.tpl');	
		$f->setVariable('caso_mensaje',$caso); 
		if($caso == 'error')
		{
			if(trim($mensaje) == '')
			{
			     $mensaje = 'Ocurrió un error al intentar guardar los datos';
            }
			$f->setVariable('mensaje_texto',$mensaje);
			if($cerrar)
			{
                $f->addTemplate('mensaje_mensaje_body_error');
            }
		}
		else
		{
			if(trim($mensaje) == '')
			{
                $mensaje = 'Los datos se guardaron exitosamente';
            }
			$f->setVariable('mensaje_texto',$mensaje); 
		}
		if($cerrar)
		{
			$f->addTemplate('mensaje_mensaje_body_cerrar');
		}
		$this->t->setVariable('mensaje_guardar_datos',$f->toHtml()); 
	}

	function enviarAlertaPostulaciones()
	{ 
		$LogsVisit 		= new LogsVisit();
		$alerta_ayer 	= $LogsVisit->estadoAlerta(false);
		$alerta 		= $LogsVisit->estadoAlerta(); 
     
		if($alerta == 0 && !VarConfig::estadoDebug)
		{
			if($alerta_ayer == 1)
			{		
			 
				$delay_msg 		= VarSystem::getInfoSystem('dia_alerta_msg');

				$detalle = array();
				$detalle['verificacion']['en_espera']['total']      	= 0;
				$detalle['verificacion']['en_revision']['total']      	= 0;
				$detalle['verificacion']['para_supervision']['total'] 	= 0;
				$detalle['validacion']['en_espera']['total']      		= 0;
				$detalle['validacion']['en_revision']['total']      	= 0;
				$detalle['validacion']['para_supervision']['total']   	= 0;

				/*******************************************************************************************
					TEMPORAL PARA QUE NO OCURRA EL ACCESO DE MAS DE UN USUARIO MIENTRAS
					EL OTRO ESTA TRABAJANDO Y NO ENVIE MUCHO MENSAJES A LA VEZ
				********************************************************************************************/
				$LogsVisit->agregarEstadoAlerta(-1); 

				$ControlOferente 		= new ControlOferente();		
				$output 				= $ControlOferente->obtenerTotalesOferentes(true);  
				$total 					= count($output ); 
				if(is_array($output) &&  $total > 0)
				{
					for($i=0; $i < $total; $i++)
					{  
						$buscar_info = array();
						switch($output[$i]['id_estado'])
						{
							default :	
								$buscar_info['buscar'] 		= false;
							break;
							case 'enviado':
								$buscar_info['buscar'] 		= true;
								$buscar_info['tipo'] 		= 'verificacion';
								$buscar_info['revisor'] 	= true;
								$buscar_info['supervisor'] 	= false;
								$buscar_info['caso'] 		= 'en_espera';		
								$buscar_info['estado'] 		= $output[$i]['id_estado']; 						
							break;
							case 'verificacion_revision':  
								$buscar_info['buscar'] 		= true;
								$buscar_info['tipo'] 		= 'verificacion';
								$buscar_info['revisor'] 	= true;
								$buscar_info['supervisor'] 	= false;
								$buscar_info['caso'] 		= 'en_revision';
								$buscar_info['estado'] 		= $output[$i]['id_estado']; 
							break;
							case 'verificacion_rechazo':  
								$buscar_info['buscar'] 		= true;
								$buscar_info['tipo'] 		= 'verificacion';
								$buscar_info['revisor'] 	= true;
								$buscar_info['supervisor'] 	= true;
								$buscar_info['caso'] 		= 'para_supervision';
								$buscar_info['estado'] 		= $output[$i]['id_estado']; 
							break;
							case 'verificacion_enviado':  
								$buscar_info['buscar'] 		= true;
								$buscar_info['tipo'] 		= 'validacion';
								$buscar_info['revisor'] 	= false;
								$buscar_info['supervisor'] 	= false;
								$buscar_info['caso'] 		= 'en_espera';
								$buscar_info['estado'] 		= $output[$i]['id_estado']; 
							break;
							case 'validacion_revision': 
								$buscar_info['buscar'] 		= true;
								$buscar_info['tipo'] 		= 'validacion';
								$buscar_info['revisor'] 	= true;
								$buscar_info['supervisor'] 	= false;
								$buscar_info['caso'] 		= 'en_revision'; 
								$buscar_info['estado'] 		= $output[$i]['id_estado']; 
							break;
							case 'validacion_rechazo': 
								$buscar_info['buscar'] 		= true;
								$buscar_info['tipo'] 		= 'validacion';
								$buscar_info['revisor'] 	= false;
								$buscar_info['supervisor'] 	= true;
								$buscar_info['caso'] 		= 'para_supervision'; 
								$buscar_info['estado'] 		= $output[$i]['id_estado']; 
							break;
						} 
						 
						if($buscar_info['buscar'])
						{
							$detalle[$buscar_info['tipo']][$buscar_info['caso']]['total'] = $output[$i]['total_estado']; 
							if($output[$i]['total_estado'] > 0)
							{
								$listado 		= $ControlOferente->getOferentesListado($output[$i]['id_estado']);  
								$total_tmp 		= count($listado); 
								if($total > 0 && is_array($listado))
								{
									for($j=0; $j < $total_tmp ; $j++)
									{
										$RevisionOferente 		= new RevisionOferente();
										$RevisionOferente->obtenerRevision($listado[$j]['id_oferente'],$buscar_info['tipo']); 
										if(isset($RevisionOferente->revision_usuario_revisor) && trim($RevisionOferente->revision_usuario_revisor) != '')
										{				
											if($buscar_info['revisor'])
												$detalle[$buscar_info['tipo']][$buscar_info['caso']][$RevisionOferente->revision_usuario_revisor]['total']++;
											if(trim($RevisionOferente->revision_usuario_supervisor) != '' && $buscar_info['supervisor'])
												$detalle[$buscar_info['tipo']][$buscar_info['caso']][$RevisionOferente->revision_usuario_supervisor]['total']++;

											$detalle[$buscar_info['tipo']][$buscar_info['caso']]['supervisor'] = (int)$buscar_info['supervisor'];
											$detalle[$buscar_info['tipo']][$buscar_info['caso']]['revisor'] = (int)$buscar_info['revisor'];
						
											$aux = ControladorFechas::resta_fechas(ControladorFechas::fechaActual(false),$listado[$j]['fecha_real']); 
											if($aux > VarSystem::getInfoSystem('dia_alerta'))
											{
												$detalle[$buscar_info['tipo']][$buscar_info['caso']][$RevisionOferente->revision_usuario_revisor]['rojo']++;
											}											 
										}					
									}
								}
							}
						}
					}
				}  

				$elControladorDeObjetos = new ControladorDeUsuarios();
				$tipos 					= array(2,5,4,6); /*verificacion y validacion*/
				$usuarios 				= $elControladorDeObjetos->getListadoUsuariosPersonas($tipos);	
				$total 					= count($usuarios); 
                
                
                $ControlAdministracionEdicion = new ControlAdministracionEdicion();
                $listado = $ControlAdministracionEdicion->obtenerListadoOferentes('verificacion');
                $total_actualizacion_verificacion = count($listado);		
                $listado = $ControlAdministracionEdicion->obtenerListadoOferentes('validacion');
                $total_actualizacion_validacion = count($listado);			 

				if(is_array($usuarios) &&  $total > 0)
				{
					for($i=0; $i < $total; $i++)
					{ 
						if($usuarios[$i]['activo'] == 0)
						{
							continue; 						
						}

						$usuario_nombre = $usuarios[$i]['nombre']." ".$usuarios[$i]['apellido_paterno']." ".$usuarios[$i]['apellido_materno']." <".$usuarios[$i]['email'].">"; 
						
						if($usuarios[$i]['perms'] == 6 || $usuarios[$i]['perms'] == 4)
						{										
							$caso = 'verificacion';
						}
						else
						{										
							$caso = 'validacion';
						}
						$asunto     = "Aviso de revisiones pendientes para ";
						$asunto     .= str_replace('on','ón',$caso); 
						$asunto     .= " del Registro ATE"; 
						$email_template =  new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/email/mensaje_revisores.tpl'); 
						
						$email_template->setVariable('caso_revision',str_replace('on','ón',$caso));
						$email_template->setVariable('en_espera',$detalle[$caso]['en_espera']['total']);
						$email_template->setVariable('en_revision',$detalle[$caso]['en_revision']['total'] );
						$email_template->setVariable('para_supervision',$detalle[$caso]['para_supervision']['total']);
						   
						foreach($detalle[$caso] as $etapa => $datos)
						{							
							foreach($datos as $username => $valores)
							{
								if($usuarios[$i]['perms'] == 2 || $usuarios[$i]['perms'] == 4)
								{
									if($username != $usuarios[$i]['username'])
										continue;
									if($etapa == 'para_supervision')
										continue;
								}
								if(!is_array($valores))
								{
									continue;
								}
								if(!isset($valores['total']))
								{
									continue; 
								}
								$email_template->addTemplate('bloque_detalle_'.$etapa);								
								$email_template->setVariable('revisor',$username);
								$email_template->setVariable('total_revisor',$valores['total']);
								if(isset($valores['rojo']))
								{										
									$email_template->addTemplate('bloque_detalle_'.$etapa.'_en_rojo');
									$email_template->setVariable('total_rojo_revisor',$valores['rojo']); 
								}
							}
						}	
						
						/* detalle actualizacion */
						if($usuarios[$i]['perms'] == 6)
						{							
							$email_template->addTemplate('bloque_detalle_para_actualizacion');
							$email_template->setVariable('para_actualizar',$total_actualizacion_verificacion);
							$email_template->setVariable('caso_revision',$caso);
						}
						if($usuarios[$i]['perms'] == 5)
						{							
							$email_template->addTemplate('bloque_detalle_para_actualizacion');
							$email_template->setVariable('para_actualizar',$total_actualizacion_validacion); 
							$email_template->setVariable('caso_revision',$caso);
						}						
						
						$mensaje 	= Funciones::TextoSimple("Estimado(a) usuario\n\n".$email_template->toHtml(),true);						   
                        /*echo '<!-- <br>-------------------------------------------<br>'.$usuario_nombre.'<br>'.$mensaje.'-->';*/
						Funciones::sendEmail($usuario_nombre,$asunto,$mensaje);						 
						/*echo "<br>".$usuario_nombre." ".$mensaje." <br><br>";*/
					} 
				}
				$nueva_alerta = $delay_msg;				
			}
			else
			{ 
				$nueva_alerta = $alerta_ayer - 1;	
				if($nueva_alerta < 0)	
				{
					$nueva_alerta = 0;
				}
			}
			if($nueva_alerta == 0)
			{
				$nueva_alerta++;
			}
			$LogsVisit->agregarEstadoAlerta($nueva_alerta);
			/* APROVECHAMOS DE LIMPIAR LOS ARCHIVOS TEMPORALES */
			$this->cleanTmpFile();

            /**
            * SE ENVIAN LOS EMAILS A LOS OFERENTES QUE A LOS CUALES LES HAN REVISADOS LAS ACTUALIZACIONES
            */
            //$ControlActualizacionATE = new ControlActualizacionATE();
            //$ControlActualizacionATE->sendEmailRevision();
			return true;
		}               
		return false;
	}
	
	private function showMensajeAlert()
	{  
		$Avisos = new Avisos();
		$Avisos->getPopup();  
		
		$valores 	= VarSystem::getPost(); 
		if(!(bool)$this->theSession->autenticate &&  count($valores) == 0 && $Avisos->popup == 1 && !$this->indexPopup)
		{
			$mensaje = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'mensaje_popup.tpl');
			echo $mensaje->toHtml();
		}
	}
	
	private function sessionMantencion()
	{
		if($this->elUsuarioP->perms!= 1)
		{
			if(VarConfig::estadoMantencion || (VarConfig::estadoMantencionAdmin && $this->elUsuarioP->perms!= 3 ))
			{ 
				Funciones::sesionCaducada('Disculpe las molestias, pero el sistema se encuentra en mantención, por favor inténtelo más tarde');
				die();
			}
		}
	}

	function cleanTmpFile()
	{
		$ahora 		= ControladorFechas::fechaActual(true,true,0,true);
		$limite   	= VarSystem::limiteTemporal();
		$archivos = Funciones::obtenerListaArchivos(VarSystem::getPathVariables('dir_repositorio_tmp')) ;
	
		$i = 0;
		
		foreach($archivos as $archivo => $tipo)
		{
			if($tipo == 1)
			{
				$archivo_real = VarSystem::getPathVariables('dir_repositorio_tmp').'/'.$archivo;
				$creacion = filectime($archivo_real);
				$resta = $ahora - $creacion; 
				if($resta > $limite)
				{
					@unlink($archivo_real); 
					$i++;
				}
			}
		}
		if($i > 0)
			$this->ControlLogs->setLog('tmp_clean',$this->elUsuarioP->username,$i);
	}
	
	function revisionSesion($no_oferente=false)
	{		
		if(!(bool)$this->theSession->autenticate)
		{ 
			Funciones::sesionCaducada();
			die();
		}   
		if($no_oferente && $this->permiso_usuario == 'oferentes')
		{  
			Funciones::sesionCaducada('No tiene permisos para acceder a esta opción');			
			die();
		} 
	}
	
	private function showUserInfo() 
	{		
		$username_form = VarSystem::getVariable("login_username");
		if((bool)$this->theSession->autenticate)
		{
			if((bool)$username_form && trim($username_form) != '') 
			{
				$this->ControlLogs->setLog('login-success',VarSystem::getVariable("login_username"));		 
			}	
			/********************PRESENTACION INFO USER*******************/
			
			$this->t->addTemplate('user_info');
			$this->t->setVariable('titulo_usuario','Usuario');
			$this->t->setVariable('nombre_usuario',$this->elUsuarioP->getNombreCompleto());		
			$this->t->setVariable('login_usuario',$this->elUsuarioP->username);
			$this->t->setVariable('fecha_usuario',ControladorFechas::fechaActual(false));			
			$this->t->refreshTemplate();  
		}
		else
		{
			/********************PRESENTACION FORM LOGIN*******************/  
			$f  = new miniTemplate(VarSystem::getPathVariables('dir_template_general').$this->login_tpl);	
			$f->setVariable('challenge',VarConfig::regkey_system); 
			if((bool)$username_form && trim($username_form) != '')
			{			
				global $sistema_error_logeo;
				$this->ControlLogs->setLog('login-failed',VarSystem::getVariable("login_username"),$sistema_error_logeo[$this->theSession->error_login]);					
				$f->setVariable('mensaje_login_error',"ERROR: ".$sistema_error_logeo[$this->theSession->error_login]);
			}
			else
			{
				$f->setVariable('mensaje_login_error',''); 
			}
			$login = $f->toHtml();		 
			//$this->t->setVariable('form_login',$login); 
		}
	} 
	
	function showMenuNoAutorizado($msg='',$titulo='')
	{		
		if(trim($msg) == '')
			$msg = 'Ud no tiene permisos para acceder a esta funcionalidad.'; 

		$msg = Funciones::TextoSimple($msg,true);
		if(trim($titulo) == '')
			$titulo = 'Acceso No Autorizado'; 	
		$this->setTituloModulo($titulo);  		

		$this->showMensajeGuardarDatos('error',$msg,false);
	}

	private function showNoticias()
	{		
		$ControlAvisos 		= new  ControlAvisos();	
		$ListaDeObjetos	 	= $ControlAvisos->getLista(); 
		$total 				= count($ListaDeObjetos);
		$max = 3;
		if($total > $max) 
			$total = $max;
		for($i=0; $i < $total; $i++)
		{ 
			$this->t->addTemplate('show_noticias');  
			$this->t->setVariable('fecha',$ListaDeObjetos[$i]['fecha']);
			$this->t->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
			$this->t->setVariable('id',$ListaDeObjetos[$i]['id_aviso']); 
			$this->t->addTemplate('show_noticias_lateral');  
			$this->t->setVariable('fecha',$ListaDeObjetos[$i]['fecha']);
			$this->t->setVariable('titulo',$ListaDeObjetos[$i]['titulo']); 
			$this->t->setVariable('id',$ListaDeObjetos[$i]['id_aviso']); 
		} 
	}

	private function _cleanShowMenu($menuRaiz,$menuSec,$menuObjRaiz)
	{		
		$totalmenuRaiz 					= count($menuRaiz);
		$ControladorPermisoParticular 	= new ControladorPermisoParticular();
		/*********************************************************************************************** 
				CASO ESPECIAL SOLO PARA LOS VALIDADOS PARA EVITAR QUE LOS DEMAS INGRESEN 
				A LOS MENUS DE EDICION DE DATOS Y DE GENERACIÓN DE CERTIFICADO DE PERTENENCIA
		***********************************************************************************************/
		if($this->elUsuarioP->perms == 3)
		{ 
			$Oferente = new Oferente();
			$Oferente->obtenerOferente($this->id_oferente);			
			$menuRaizAux = array();
			for($i=0; $i < $totalmenuRaiz; $i++)
			{ 
				if($Oferente->estaValidado())
				{ 
					if($menuRaiz[$i]->opcion == 'mi_registro|1')
					{
						continue;
					}
				}
				else
				{ 
					if($menuRaiz[$i]->opcion == 'view_certificado' || $menuRaiz[$i]->opcion == 'edicion')
					{
						continue;
					}
				} 
				$menuRaizAux[] = $menuRaiz[$i];				 
			}
			$menuRaiz 				= $menuRaizAux;  
		} 
		/**********************************VISTA DE VALIDACION***********************************/
		if($this->elUsuarioP->perms == 6)
		{		
			$totalmenuSec 			= count($menuSec); 
			if(!$ControladorPermisoParticular->tienePermiso($this->elUsuarioP->username,'edicion_revision'))
			{
				$menuSecAux = array();
				for($i=0; $i < $totalmenuSec; $i++)
				{
					if($menuSec[$i]->opcion != 'oferente_en_validacion')
					{
						$menuSecAux[] = $menuSec[$i];
					} 						
				}
				$menuSec = $menuSecAux; 
				$totalmenuSec 			= count($menuSec);
			}
		}
 
		/***********************************VISTA REPORTES***********************************/
		if($menuObjRaiz->opcion == 'reportes')
		{
			$totalmenuSec 			= count($menuSec);
			$menuSecAux = array();
			for($i=0; $i < $totalmenuSec; $i++)
			{		 
				if($menuSec[$i]->opcion == 'reportes_base' && $ControladorPermisoParticular->tienePermiso($this->elUsuarioP->username,'reporte_base'))
				{ 
					$menuSecAux[] = $menuSec[$i];
				} 			
				if($menuSec[$i]->opcion == 'reportes_revisores' && $ControladorPermisoParticular->tienePermiso($this->elUsuarioP->username,'reporte_revisores'))
				{ 
					$menuSecAux[] = $menuSec[$i];
				} 					
				if($menuSec[$i]->opcion == 'oferente_estadisticas')
				{
					$menuSecAux[] = $menuSec[$i];
				} 					 
			}
			$menuSec = $menuSecAux; 
			$totalmenuSec 			= count($menuSec);			 
		}
		return array($menuRaiz,$menuSec);
	}
	
	private function showMenu()
	{  		
		$menuObjActual 	= new Menu();
		$menuObjActual->setOpcion(trim($this->lastActionArray[0]));  
		$menuObjRaiz = new Menu();
		$menuObjRaiz->setParent($menuObjActual->menu_padre);
		
		if(trim($menuObjRaiz->menu) == '')
			$menuObjRaiz = $menuObjActual;  
			
		$controladorMenu 		= new ControladorDeMenu();	
		$controladorMenu->setPermiso($this->elUsuarioP->permisosUsuario); 	
		$controladorMenu->setVista((bool)$this->theSession->autenticate);		
		$opcionesEditables 		= $controladorMenu->getPermisoEdicion();
		$this->opcionesMenu 	= $controladorMenu->getArchivosMenu();  
		
		$menuRaiz          	 	= $controladorMenu->getMenus();
		$totalmenuRaiz 			= count($menuRaiz );
		$menuSec            	= $controladorMenu->getMenus($menuObjRaiz->id);

		$aux 					= $this->_cleanShowMenu($menuRaiz,$menuSec,$menuObjRaiz);
		$menuRaiz 				= $aux[0];
		$menuSec 				= $aux[1];  
		$totalmenuRaiz 			= count($menuRaiz );

		/***********************************CASO DE EDICION DEL MENU RAIZ***********************************/
		$menuLateral  = "";	  
		/*MUESTRA EL INICO DEL SITIO POR DEFECTO*/
		if((bool)$this->theSession->autenticate)
		{
			$this->t->addTemplate('show_lista_MENU');
			$this->t->addTemplate('menu_superior');	
			$this->t->setVariable('menu_name','Bienvenida');
			$this->t->setVariable('menu_opcion','home');	
			if($this->lastActionArray[0]=='home')
			{
				$this->t->setVariable('menu_selected','background:none;');
			}		
		}
		
		if($totalmenuRaiz > 0 && is_array($menuRaiz) && $this->showMenuEstado)
		{ 
			for($i = 0; $i < $totalmenuRaiz ; $i++)
			{
				$menu_li_class= '';
				$menu_editar = '';
				$menu_a_name = '';
				if(trim($optionRaiz) == trim($menuRaiz[$i]->opcion) || $this->id_menu == $menuRaiz[$i]->id)
				{
					$menu_a_name = 'selected';		
				}							
				$this->t->addTemplate('menu_superior');
				$this->t->setVariable('menu_id_menu',$menuRaiz[$i]->id);
				$this->t->setVariable('menu_id_padre',$menuRaiz[$i]->menu_padre);
				//$this->t->setVariable('menu_name',Funciones::cleanHtml(str_replace(' ','&nbsp;',$menuRaiz[$i]->menu)));
				$aux = $i+2;
				$this->t->setVariable('menu_name',Funciones::cleanHtml($menuRaiz[$i]->menu));
				$this->t->setVariable('menu_opcion',$menuRaiz[$i]->opcion);
				if($this->lastActionArray[0] == $menuRaiz[$i]->opcion)
				{
					$this->t->setVariable('menu_selected',' background:none;');
				}					
				$this->t->setVariable('menu_li_class',$menu_li_class);
				$this->t->setVariable('menu_a_class',$menu_a_name);
				$this->t->setVariable('menu_editar',$menu_editar);		
			}
		} 
		
		/*menu de salida en caso de salida del sitio*/
		if((bool)$this->theSession->autenticate)
		{
			$this->t->addTemplate('menu_superior');	
			$aux = $totalmenuRaiz+2;
			$this->t->setVariable('menu_name','Cerrar&nbsp;Sesión');
			$this->t->setVariable('menu_opcion','logout');				
		}
		$this->t->refreshTemplate();			
				
		/*********************************** menu lateral ***********************************/
		if(count($menuSec) > 0  && is_array($menuSec) && $this->showMenuEstado	)
		{
			$this->t->addTemplate('show_menu_inferior');
			for($i = 0; $i < count($menuSec) ; $i++)
			{
				$menu_editar = '';
				$menu_li_class= '';
				if(trim($menuLateral) == '')
				{		
					$menu_li_class= 'first';
				}
				$menu_a_name = '';
				if(trim($optionRaiz) == trim($menuSec[$i]->opcion))
				{
					$menu_a_name = 'submenusel';
				}
				$this->t->addTemplate('menu_inferior');
				$this->t->setVariable('menu_id_menu',$menuSec[$i]->id);
				$this->t->setVariable('menu_id_padre',$menuObjectoRaiz->id);
				$this->t->setVariable('menu_name',$menuSec[$i]->menu);
				$this->t->setVariable('menu_opcion',$menuSec[$i]->opcion);
				$this->t->setVariable('menu_li_class',$menu_li_class);
				$this->t->setVariable('menu_a_class',$menu_a_name);
				$this->t->setVariable('menu_editar',$menu_editar);		
			}
			$this->t->refreshTemplate();	
		}
	}
	
	private function showBody()
	{	
		if(VarConfig::exectestfile)
		{
			$archivoHtml = VarSystem::getPathVariables('dir_clases').'general/test_aplicacion.inc';
			$contentFrame = new HtmlFile($archivoHtml); 						
			$this->t->setVariable('contenido_sitio',$contentFrame->toHtml());
			return true;
		} 
		/*********************************** PRESENTACION BODY *******************************************/				
		$conLastAction = false; 		
		if ($this->lastActionArray[0] != "logout" && trim($this->lastActionArray[0]) != '')
		{
			$opcionHtml = $this->lastActionArray[0]; 
			if(trim($opcionHtml) !='')
			{				
				if(trim($this->opcionesMenu[$opcionHtml]['tipo']) == '' || trim($this->opcionesMenu[$opcionHtml]['tipo']) == '0' )
				{
					$archivoHtml = trim($this->opcionesMenu[$opcionHtml]['archivo']); 
				}
				else
				{
					if(trim($this->opcionesMenu[$opcionHtml]['archivo']) != '')
					{
						$dirHtml  =  VarSystem::getPathVariables('dir_clases').trim($this->opcionesMenu[$opcionHtml]['tipo'])."/";
						$archivoHtml = trim($dirHtml.$this->opcionesMenu[$opcionHtml]['archivo']); 
					}
					else
						$archivoHtml = '';
				}  	  
				if(!file_exists($archivoHtml) || trim($archivoHtml) == '')
				{
					if(trim($this->opcionesMenu[$opcionHtml]['body']) == '')
					{
						$this->t->setVariable('contenido_sitio',"ERROR : no se encuentra el archivo o tiene contenido asociado ");
					}
					else
					{
						//Funciones::mostrarArreglo($this->opcionesMenu);
					    $this->setTituloModulo($this->opcionesMenu[$opcionHtml]['texto']);
						$this->t->setVariable('contenido_sitio',Funciones::transformacionContenidoHtml($this->opcionesMenu[$opcionHtml]['body']));
					}
				}
				else 
				{		
					$contentFrame = new HtmlFile($archivoHtml); 						
					$this->t->setVariable('contenido_sitio',$contentFrame->toHtml());
				}
				$conLastAction	= true;
			}
		} 
		if(!$conLastAction)//muestra la imagen inicial
		{		
			if((bool)$this->theSession->autenticate)
			{
				$contentFrame = new HtmlFile(VarSystem::getPathVariables('dir_clases')."registro/registro_form.inc");
			}
			else
			{
				$contentFrame = new HtmlFile(VarSystem::getPathVariables('dir_clases')."general/home.inc");	
			}						
			$this->t->setVariable('contenido_sitio',$contentFrame->toHtml());		 
		}				
	}
	
	function showIndex() 
	{		 
		$output = $this->laPagina->showPage(false);	 
		echo $output;				
	}
	
	private function showLink()
	{ 
		$this->t->addTemplate('show_lista_LINK');
		/*********************PRESENTACION LINKS********************/
		$elControladorLink = new ControladorLink();	
		$ListaDeObjetos = $elControladorLink->getArray(false);
		
		for($i=0; $i < count($ListaDeObjetos); $i++)
		{
			$this->t->addTemplate('lista_link');
			if($i==0)
			{			
				$this->t->setVariable('class','first');
			} 
			else
			{
				$this->t->setVariable('class','');
			} 		
			$this->t->setVariable('url',$ListaDeObjetos[$i]['url']);
			$this->t->setVariable('name',$ListaDeObjetos[$i]['link']);
			$this->t->setVariable('description',$ListaDeObjetos[$i]['descripcion']);		
		}
		$this->t->refreshTemplate();		
	}
	
	private function showFAQ()
	{
		/*********************PRESENTACION FAQ********************/
		$ControlFAQs = new  ControlFAQs();	
		$ListaDeObjetos = $ControlFAQs->getLista();
		
		$this->t->addTemplate('show_lista_FAQ');
		for($i=0; $i < count($ListaDeObjetos); $i++)
		{
			$this->t->addTemplate('lista_FAQ');
			if($i==0)
				$this->t->setVariable('class','first');
			else
				$this->t->setVariable('class','');
					
			$this->t->setVariable('id_faq',$ListaDeObjetos[$i]['id_pregunta']); 
			$this->t->setVariable('faq_orden',$ListaDeObjetos[$i]['orden']); 	
			$this->t->setVariable('faq',$ListaDeObjetos[$i]['pregunta']); 	
		}
		$this->t->refreshTemplate();
	}		
	
	
    /**
     * ControlHtml::revisionPermisosUsuario()
     * la idea es que revise al usuario logeado si posee al menos uno de los permisos necesarios 
     * @param mixed $permiso, en relacion a los valores de la tabla de permiso_acceso
     * @return void
     */
      
    function revisionPermisosUsuario($permiso,$conMensaje=true)
    {
        $permisos_usuarios  = $this->elUsuarioP->permisosUsuario; 
        $total_permisos     = count($permiso);
        $tiene_permiso      = 0;
        for($i=0;$i < $total_permisos;$i++)
        {
            if((bool)$permisos_usuarios[$permiso[$i]])
            {
                $tiene_permiso++;
            }
        } 
        if($tiene_permiso == 0 )
        {
            if($conMensaje)
            {
                Funciones::showErrorMsg('No tiene permisos para acceder a esta opción');
            }
            return false;
        }
        return true;
    } 
}
?>