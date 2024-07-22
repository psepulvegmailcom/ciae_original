<?php

/**
 * ControlHtmlBasic
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlHtmlBasic
{		
  /**
   * ControlHtmlBasic::ControlHtmlBasic()
   *
   * @param bool $esindex
   * @return void
   */
	function ControlHtmlBasic($esindex=false)
	{		
		$this->theSession 		= new AuthSessionIntranet();	
		$this->theSession->initSession();
		$this->elUsuarioP		= $this->theSession->userObject;
		$ControlPersonaObjetos  = new ControlPersonaObjetos(); 
		$this->elUsuarioPersona = $ControlPersonaObjetos->obtenerPersona($this->theSession->userId);
		$this->prefijoEstilo	= "version_";
		
		$this->style 			= $this->prefijoEstilo.'portal.css';  
		$this->template  		= $this->prefijoEstilo.'indexPopup.tpl';  
		$this->template  		= $this->prefijoEstilo.'index.tpl'; 
		$this->login_tpl  		= $this->prefijoEstilo.'login.tpl';  
		$this->footer_tpl  		= $this->prefijoEstilo.'footer.tpl';  
		$this->hidden_tpl  		= $this->prefijoEstilo.'hidden.tpl';  
		$this->laPagina 		= new Page();				
		$this->ControlLogs 		= new ControlLogs();  
		$this->FormGeneral 		= new FormGeneral();
		$this->MantenedoresGeneral = new MantenedoresGeneral();
		$this->MantenedoresGeneralObjeto = new MantenedoresGeneralObjeto();
		$this->ControlObjetos = new ControlObjetos();
		$this->showMenuEstado 	= true;			  
		
		/** PERMISOS DEL USUARIO */
		$Permiso = new Permiso();
		$Permiso->loadObject('id_permiso = '.$this->elUsuarioP->perms);
		$this->permiso_usuario 			= $Permiso->alias; 
		$permiso_usuario_general 		=  explode('_',$this->permiso_usuario);
		$this->permiso_usuario_general 	= $permiso_usuario_general[0];	 
		$this->vistaprivada 			= $esindex;

		$this->pagina_sistema 			=  VarSystem::getVariable("pagina_sistema");
		$this->pagina_sistema_orden 	=  VarSystem::getVariable("pagina_sistema_orden");
		$this->pagina_sistema_direccion =  VarSystem::getVariable("pagina_sistema_direccion");	
		if(trim($this->pagina_sistema) == '' || $this->pagina_sistema == 0)
		{
			$this->pagina_sistema 			= 1;
			$this->pagina_sistema_orden 	= 'precio';
			$this->pagina_sistema_direccion = '';
		}	
		$this->admin = false;
	}
	
  /**
   * ControlHtmlBasic::setLang()
   *
   * @param mixed $lang
   * @return void
   */
	function setLang($lang)
	{
		$this->langSite	= $lang;
		if(trim($this->langSite) == '')
		{
			$this->langSite = 'es';
		}
	}
	
  /**
   * ControlHtmlBasic::setSitio()
   *
   * @param mixed $sitio
   * @return void
   */
	function setSitio($sitio)
	{ 
		$this->sitio = $sitio;  
	}
	
  /**
   * ControlHtmlBasic::requiereLogin()
   *
   * @return void
   */
	function requiereLogin()
	{		
		$this->admin = true;
	}
	
  /**
   * ControlHtmlBasic::templateIndex()
   *
   * @param mixed $index
   * @return void
   */
	function templateIndex($index)
	{ 
		$this->template  		= $this->prefijoEstilo.'index_'.$index.'.tpl'; 
	}
	
  /**
   * ControlHtmlBasic::esAdmin()
   *
   * @return void
   */
	function esAdmin()
	{
		$this->admin = true;
		$this->template  		= $this->prefijoEstilo.'index_admin.tpl'; 
	}
	
  /**
   * ControlHtmlBasic::noShowMenu()
   *
   * @return void
   */
	function noShowMenu()
	{
		$this->showMenuEstado 	= false;	
	}
	
  /**
   * ControlHtmlBasic::setPopup()
   *
   * @return void
   */
	function setPopup()
	{
		$this->template  		= $this->prefijoEstilo.'indexPopup.tpl';  
	}
	
  /**
   * ControlHtmlBasic::prepareHtml()
   *
   * @param string $option
   * @param string $id_oferente
   * @param string $caso_revision
   * @return void
   */
	function prepareHtml($option='',$id_oferente='',$caso_revision='')
	{   
		$this->cleanTmpFile();
		if(trim($option) != '')
		{
			$this->lastAction 		= $option;
		}				
		else
		{
			$this->lastAction 		= $this->laPagina->lastAction; 
		}   
		$lang = VarSystem::getVariable('langSite','POST'); 
		if(trim($lang) == '')
		{
			$lang = VarSystem::getVariable('langSite','GET');
		}
		$this->setLang($lang);
		
		//echo $this->langSite;
		
		
 		$page = VarSystem::getVariable('page','GET'); 
		if(trim($this->lastAction) == '' && trim($page) == '')
		{
			$this->lastAction  = 'home';  
		}
		else
		{			
			if(trim($this->lastAction) == '')
			{
				$this->lastAction   = VarSystem::getVariable('page','GET');
			}
		}    
		/** INCLUIR ARCHIVO LENGUAJE*/
		
		$this->ControlIdioma 	= new ControlIdioma($this->langSite); 
		$this->lastActionArray 	= explode("|",trim($this->lastAction));  
		$this->preparePage();    
	} 
 
  /**
   * ControlHtmlBasic::setBarraNavegacion()
   *
   * @param mixed $barra
   * @return void
   */
	function setBarraNavegacion($barra)
	{			 
		$this->t->setVariable('barra_navegacion',$barra); 	 
	} 
	
  /**
   * ControlHtmlBasic::setTituloModulo()
   *
   * @param mixed $titulo
   * @return void
   */
	function setTituloModulo($titulo)
	{   
		$this->t->addTemplate('bloque_titulo_modulo');
		$this->t->setVariable('titulo_modulo',$this->FormGeneral->showTituloModulo($titulo)); 	
		$this->t->refreshTemplate();
	} 

  /**
   * ControlHtmlBasic::showFooter()
   *
   * @return void
   */
	private function showFooter()
	{
		$this->footer 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').$this->footer_tpl);
		
		$LogsVisit 		= new LogsVisit(); 
		$this->footer->setVariable('page_url_root', VarConfig::path_site_www_root);
		$this->footer->setVariable('page_email', VarConfig::site_email);
		$this->footer->setVariable('visit_counter',$LogsVisit->totalVisitas() ); 
		$this->footer->setVariable('design_by',$this->ControlIdioma->obtenerVariable('home_design_by'));
		$this->footer->setVariable('footer_rights',$this->ControlIdioma->obtenerVariable('home_rights')); 
		$this->t->setVariable('footer_page',$this->footer->toHtml()); 
	}	
	
  /**
   * ControlHtmlBasic::showHidden()
   *
   * @return void
   */
	private function showHidden()
	{
		/** ***********************************************************************************
					VALORES HIDDEN
		**************************************************************************************/					
		$hiddentpl = new miniTemplate(VarSystem::getPathVariables('dir_template_general').$this->hidden_tpl); 
		$hiddentpl->setVariable('pagina_sistema', $this->pagina_sistema); 			 
		$hiddentpl->setVariable('pagina_sistema_orden',$this->pagina_sistema_orden);  
		$hiddentpl->setVariable('pagina_sistema_direccion',$this->pagina_sistema_direccion);
		$hiddentpl->setVariable('pagina_lang',$this->langSite);
		$hiddentpl->setVariable('pagina_sitio',$this->sitio); 
		if($this->langSite == 'es')
		{
			$title_lang 		= 'English';
			$title_lang_opcion 	= 'en';
			$title_lang_img 	= 'ingles';
		}
		else
		{
			$title_lang 		= 'Español';
			$title_lang_opcion 	= 'es';
			$title_lang_img 	= 'espanol';
		}				
		$this->t->setVariable('title_lang',$title_lang);
		$this->t->setVariable('title_lang_opcion',$title_lang_opcion);
		$this->t->setVariable('title_lang_img',$title_lang_img);
		$this->t->setVariable('hidden_page',$hiddentpl->toHtml());
	}
	
  /**
   * ControlHtmlBasic::logoutUser()
   *
   * @return void
   */
	function logoutUser()
	{
		//Funciones::mostrarArreglo($this->theSession,true);  
		if((bool)$this->theSession->autenticate)
		{   
			$this->theSession->logout(); 
		}
		$this->gotoHome();
	}
	
  /**
   * ControlHtmlBasic::gotoHome()
   *
   * @return void
   */
	private function gotoHome($index='admin')
	{ 
		$this->lastAction  = 'home';	
		$this->lastActionArray[0] = $this->lastAction;
		if($index == 'admin') 	
			Funciones::redirect(VarConfig::sitio_www_index.'?page=home');
		else
			Funciones::redirect(VarConfig::sitio_www_index.'?page=home');
	}
	
  /**
   * ControlHtmlBasic::preparePage()
   *
   * @return void
   */
	private function preparePage()
	{ 
		$this->siteTitle  = VarSystem::getInfoSystem('title');			
		$this->laPagina->setCss(VarSystem::getPathVariables('path_css').$this->style); 
		$this->laPagina->setTitle($this->siteTitle['title'].VarConfig::versionSitio); 
			 
		$this->laPagina->setEmail(VarConfig::site_email);	
		$this->laPagina->setUrlRoot(VarConfig::path_site_www_root);			 
		/** CHECK LOGOUT */     
		if(is_array($this->lastActionArray))
		{
			if (trim($this->lastActionArray[0]) == 'logout') 
			{   			 
				$this->logoutUser();	
			} 	
		}	  
		//Funciones::mostrarArreglo($this->theSession);
		/**  INICIO DEL TEMPLATE */  
		$this->t = new miniTemplate(VarSystem::getPathVariables('dir_template_general').$this->template);  
		
		$this->t = $this->setVariablesGlobales($this->t);
		
		$this->t->setVariable('page_url_root', VarConfig::path_site_www_root);
		$this->t->setVariable('page_email', VarConfig::site_email); 
		$this->t->setVariable('page_title_simple', trim(VarConfig::site_title));
		$this->t->setVariable('page_lang_simple', $this->langSite);
		$this->t->setVariable('page_opcion_simple', $this->lastActionArray[0]);
		$this->t->setVariable('page_url', str_replace('http://','',VarConfig::path_site_www));
		$this->t->setVariable('page_url_index', VarConfig::sitio_www_index); 
		$this->t->setVariable('page_contact_email', VarConfig::site_email); 
		$this->t->setVariable('page_lastAction',$this->lastAction);
		$this->t->setVariable('page_registered',rawurlencode(serialize($laPagina->registered))); 		
		/** *************** PRESENTACION DE USUARIO ***************/
		$this->showUserInfo();  
		/** ****************** PRESENTACION ESTRUCTURA DEL MENU ********************/
		$this->showMenu(); 
		/** ****************** PRESENTACION ESTRUCTURA BODY ********************/ 
		$this->showBody();      
		/** ****************** REGISTRO DE LOG DEL USUARIOS ********************/ 	
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
			{
				$setNuevaVisita = true;
			}
		} 
		$this->ControlLogs->setLog('USER-USO',$this->elUsuarioP->username,$this->lastAction.$guardar,$setNuevaVisita); 
		/** ************* PRESENTACION DE FOOTER Y HIDDEN  ***************/
		$this->showFooter();
		$this->showHidden();  
		//Funciones::mostrarArreglo($this->theSession);
		if((bool)$this->theSession->autenticate)
		{			
			$this->t->addTemplate('bloque_logout_user'); 
			$this->t->setVariable('username',$this->theSession->userName);			 
		}
		else
		{
			$this->t->addTemplate('bloque_login_user');
		} 
		if((bool)$this->theSession->autenticate)
		{ 
			$this->sessionMantencion();
		} 
		$this->laPagina->add(new HtmlText($this->t->toHtml())); 
	} 
	
  /**
   * ControlHtmlBasic::showMensajeGuardarDatos()
   *
   * @param mixed $caso
   * @param string $mensaje
   * @param bool $cerrar
   * @return void
   */
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
				$mensaje = 'Los datos se guardaron exitosamente';
			$f->setVariable('mensaje_texto',$mensaje); 
		}

		if($cerrar)
		{
			$f->addTemplate('mensaje_mensaje_body_cerrar');
		}
		if(is_object($this->t))
		{
			$this->t->setVariable('mensaje_guardar_datos',$f->toHtml());
		} 
	} 
	
  /**
   * ControlHtmlBasic::sessionMantencion()
   *
   * @return void
   */
	private function sessionMantencion()
	{
		if($this->elUsuarioP->perms!= 1)
		{
			if(VarConfig::estadoMantencion || (VarConfig::estadoMantencionAdmin && $this->elUsuarioP->perms == 1 ))
			{ 
				Funciones::sesionCaducada($this->ControlIdioma->obtenerVariable('general_mantencion'));
				die();
			}
		}
	}

  /**
   * ControlHtmlBasic::cleanTmpFile()
   *
   * @return void
   */
	function cleanTmpFile()
	{
		$ahora 		= ControladorFechas::fechaActual(true,true,0,true);
		$limite   	= VarSystem::limiteTemporal(); 
		$i = 0; 
		
		$archivosTMP 		= VarSystem::getPathVariables('dir_repositorio_tmp') ;
		$archivosPDF 		= VarSystem::getPathVariables('dir_repositorio_tmp').'certificados/' ;
		$archivosEXTRACCION	= VarSystem::getPathVariables('dir_repositorio_tmp').'extraccion/' ;
		$carpetas 		= array($archivosTMP,$archivosPDF);
		$carpetas 		= array($archivosPDF,$archivosEXTRACCION);
		Funciones::mostrarArreglo($carpetas);
		for($j=0; $j < count($carpetas); $j++)
		{
			if(!is_dir($carpetas[$j]))
			{
				continue;
			}
			$archivos = Funciones::obtenerListaArchivos($carpetas[$j]) ; 
			foreach($archivos as $archivo => $tipo)
			{				
				if($archivo == 'index.php')
				{ 
					continue;
				}
				if($tipo == 1)
				{
					$archivo_real = $carpetas[$j].$archivo;
					//echo $archivo_real.'<br>';
					$creacion = filectime($archivo_real);
					$resta = $ahora - $creacion; 
					if($resta > $limite)
					{
						@unlink($archivo_real); 
						$i++;
					}
				}
			}
		} 

		if($i > 0)
		{
			$this->ControlLogs->setLog('tmp_clean',$this->elUsuarioP->username,$i);
		}
	}
	
  /**
   * ControlHtmlBasic::revisionPermisoUsuario()
   *
   * @return void
   */
	function revisionPermisoUsuario()
	{ 
		$permiso_usuario 	= $this->theSession->userObject->permiso;
		
		$menuObjActual 	= new Menu();
		$menuObjActual->setOpcionSitio($this->lastActionArray[0],$this->sitio); 
		//Funciones::mostrarArreglo($menuObjActual,true); 
	 	$ControlMenuPermiso = new ControlMenuPermiso();
	 	$permisos = $ControlMenuPermiso->obtenerListadoEspecial($menuObjActual->id);
	 	//Funciones::mostrarArreglo($this->permisosMenuActual,true); 
		 
		$permiso_neutro 	= 0; 
		//Funciones::mostrarArreglo($permisos);
		
		if (!array_key_exists($permiso_neutro, $permisos))  /** si no es neutro */
		{
			if (!array_key_exists($permiso_usuario, $permisos))
			{
				Funciones::usuarioSinPermiso();	
				$this->gotoHome();						
			}
		} 
	}
	
  /**
   * ControlHtmlBasic::revisionSesion()
   *
   * @return void
   */
	function revisionSesion()
	{	 		
		if(!(bool)$this->theSession->autenticate)
		{ 	
			if(VarConfig::sitio_www == 'ciae_intranet_textos') 
			{
				return ;
			}
			$this->logoutUser();		
			$this->lastAction  = 'home'; 			
		} 		
		else
		{			 
			/** REVISA SI EL USUARIO TIENE PERMISO A ACCEDER AL MENU */
			$this->revisionPermisoUsuario(); 
		}
	}
	
  /**
   * ControlHtmlBasic::showUserInfo()
   *
   * @return void
   */
	private function showUserInfo() 
	{		
		$username_form = VarSystem::getVariable("login_username");
		if((bool)$this->theSession->autenticate && is_object($this->elUsuarioP))
		{
			if((bool)$username_form && trim($username_form) != '') 
			{
				$this->ControlLogs->setLog('login-success',VarSystem::getVariable("login_username"));		 
			}	
			/** ******************PRESENTACION INFO USER*******************/			
			$this->t->addTemplate('user_info');
			$this->t->setVariable('titulo_usuario','Usuario');
			$this->t->setVariable('nombre_usuario',$this->elUsuarioP->getNombreCompleto());		
			$this->t->setVariable('login_usuario',$this->elUsuarioP->username);
			$this->t->setVariable('fecha_usuario',ControladorFechas::fechaActual(false));			
			$this->t->refreshTemplate();  
		}
		else
		{
			/** ******************PRESENTACION FORM LOGIN*******************/  
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
			
			$this->t->setVariable('form_login',$login); 
		}
	}
	
  /**
   * ControlHtmlBasic::showMenuNoAutorizado()
   *
   * @param string $msg
   * @param string $titulo
   * @return void
   */
	function showMenuNoAutorizado($msg='',$titulo='')
	{		
		if(trim($msg) == '')
		{
			$msg = $this->ControlIdioma->obtenerVariable('general_no_permiso_menu'); 
		} 
		$msg = Funciones::TextoSimple($msg,true);
		if(trim($titulo) == '')
		{
			$titulo = $this->ControlIdioma->obtenerVariable('general_no_permiso_acceso');
		} 	
		$this->setTituloModulo($titulo);
		$this->showMensajeGuardarDatos('error',$msg,false);
	}  
	
  /**
   * ControlHtmlBasic::showMenuCamino()
   * 
   * @param mixed $menuObjeto 
   * @return void
   */
 
	private function showMenuCamino($menuObjActual)
	{		 
		$menus_camino[] = get_object_vars($menuObjActual);
		//Funciones::mostrarArreglo($menus_camino,true);
		$ControladorDeMenu = new ControladorDeMenu();
		while(true)
		{
			$aux = $ControladorDeMenu->obtenerCaminoMenu($menus_camino[0]['menu_padre']);
			array_unshift($menus_camino,$aux[0]);	
			
			if($menus_camino[0]['menu_padre'] == 0 )
			{				
				if($menus_camino[0]['opcion'] != 'home')
				{
					$aux = $ControladorDeMenu->obtenerCaminoMenu($menus_camino[0]['menu_padre']);
					array_unshift($menus_camino,$aux[0]);
				}
				break;
			}	 
		}
		Funciones::mostrarArreglo($menus_camino,false,'menu camino');
		//Funciones::mostrarArreglo($this,false,'cominininin');
		$total = count($menus_camino);
		for($i=0; $i < $total; $i++)
		{
			$this->t->addTemplate('bloque_contenido_menu_camino_item');
			$menus_camino[$i]['menu_lang'] = $this->langSite;
			$menus_camino[$i]['menu_name'] = $menus_camino[$i]['titulo_'.$this->langSite];
			$this->t->showDataSimple($menus_camino[$i]);
		}
		
	}
 
	
  /**
   * ControlHtmlBasic::showMenuCaminoSimple()
   *
   * @param string $bloque
   * @param mixed $datos
   * @param string $caso
   * @return void
   */
	private function showMenuCaminoSimple($bloque='bloque_contenido_menu_camino',$datos,$caso='2')
	{
		$this->t->addTemplate($bloque.'_item_'.$caso); 
		$this->t->setVariable('menu_lang',$this->langSite); 	
		$this->t->setVariable('menu_option',$datos['opcion']);  
		$this->t->setVariable('menu_lang',$this->langSite);
		$this->t->setVariable('menu_name',$datos['nombre']);
		$this->t->setVariable('url_extra',$datos['url_extra']); 
	} 

  /**
   * ControlHtmlBasic::showMenuTemplate()
   *
   * @param mixed $menus
   * @param mixed $bloque
   * @param mixed $menusSec
   * @param string $optionSec
   * @param string $controladorMenu
   * @return void
   */
	private function showMenuTemplate($menus,$bloque,$menusSec=array(),$optionSec='',$controladorMenu='')
	{
		$totalMenu 			= count($menus); 
		$controladorMenu 	= new ControladorDeMenu(); 
		if($totalMenu > 0 && is_array($menus))
		{   		
			for($i = 0; $i < $totalMenu; $i++)
			{ 			 
				//echo $this->langSite;
				//Funciones::mostrarArreglo($menus[$i],true);
 			 	 //Funciones::mostrarArreglo($menusSec,true); 
				$this->t->addTemplate($bloque);
				$this->t->setVariable('menu_lang',$this->langSite); 	
				$this->t->setVariable('menu_option',$menus[$i]['opcion']); 
				$this->t->setVariable('menu_id',$menus[$i]['id']); 
				$this->t->setVariable('ubicacion_id',$i); 
				$this->t->setVariable('menu_padre',$menus[$i]['menu_padre']); 
				$aux = $menus[$i]['titulo_'.$this->langSite];
				//$aux = str_replace(' ','&nbsp;',$aux);
				$this->t->setVariable('menu_name',$aux);    
			 
				if($this->admin || $this->theSession->autenticate)
				{
					$controladorMenu->setPermiso($this->theSession->userObject->permiso);	
				} 					
				$menuHijos = $controladorMenu->getMenus($menus[$i]['id']);
				//echo $menus[$i]['id'].;
				if(is_array($menuHijos) && count($menuHijos)>0)
				{ 
					$e_aux = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'menu_lateral_despliegue.tpl');
					$this->t->setVariable('menu_despliegue',$e_aux->toHtml());
					
					//echo $bloque.'_sub'.'<br>';echo $bloque.'_sub_item'.'<br>';						
					//Funciones::mostrarArreglo($menuHijos,true);
					$this->t->addTemplate($bloque.'_sub'); 
					$this->t->setVariable('ubicacion_id',$i); 
					$this->showMenuTemplate($menuHijos,$bloque.'_sub_item'); 			
				}
				 				
			}
		} 
		$this->t->refreshTemplate();
	}  


  /**
   * ControlHtmlBasic::showMenu()
   *
   * @return
   */
	private function showMenu()
	{  	   
		if($this->admin && !$this->theSession->autenticate)
		{
			return false;
		}
		$this->t->refreshTemplate();  
 
		/** COLUMNAS DESTACADAS */ 
		$menuObjActual 	= new Menu();
		$menuObjActual->setOpcionSitio($this->lastActionArray[0],$this->sitio);  
	 	//  Funciones::mostrarArreglo($menuObjActual,true);
	 	  
	 	$ControlMenuPermiso = new ControlMenuPermiso();
	 	$this->permisosMenuActual = $ControlMenuPermiso->obtenerListadoEspecial($menuObjActual->id);
	 	Funciones::mostrarArreglo($this->permisosMenuActual); 
 		 //Funciones::mostrarArreglo($this->lastActionArray[0],true);
		 
		$this->menuObjPadre 	= new Menu();  	
		if($menuObjActual->menu_padre > 0)
		{
			$this->menuObjPadre->setParent($menuObjActual->menu_padre);
		}
		else
		{
		 	$this->menuObjPadre = $menuObjActual;	
		}
		
		//Funciones::mostrarArreglo($menuObjActual,true); 
		$menuObjRaiz = new Menu();
		$menuObjRaiz->setParent($menuObjActual->menu_padre);  
		if(!isset($menuObjRaiz->id))
		{
			$menuObjRaiz = $menuObjActual; 
		}	  
		$controladorMenu 		= new ControladorDeMenu();	  	
		$controladorMenu->setSitio($this->sitio);
		$controladorMenu->setIdioma($this->langSite);
		if($this->admin || $this->theSession->autenticate)
		{
			$controladorMenu->setPermiso($this->theSession->userObject->permiso);	
		} 
		$controladorMenu->setTipoVista('secundario') ;
		$menuRaizSecundario = $controladorMenu->getMenus(); 
		//Funciones::mostrarArreglo($menuRaizSecundario,false);   
		$this->showMenuTemplate($menuRaizSecundario,'bloque_menu_secundario');   
		$controladorMenu->setTipoVista('principal') ;	
		$menuRaiz 	= $controladorMenu->getMenus();  
		$menuSec 	= $controladorMenu->getMenus($menuObjRaiz->id); 
		//Funciones::mostrarArreglo($menuSec,true);
		Funciones::mostrarArreglo($menuRaiz,false,"Menu pricipal"); 
		
		$this->showMenuTemplate($menuRaiz ,'bloque_menu_principal',$menuSec,$menuObjRaiz->opcion,$controladorMenu );  
		$controladorMenu->setTipoVista('inferior') ;
		$menuRaizSecundario = $controladorMenu->getMenus(); 
		$this->showMenuTemplate($menuRaizSecundario,'bloque_menu_inferior');  
		Funciones::mostrarArreglo($menuRaiz,false,"Menu pricipal");
		
		/** CAMINO */ 
		//Funciones::mostrarArreglo(array('valores',$this->lastAction));
		if($this->lastAction != 'home')
		{  
			$bloque = 'bloque_contenido_menu_camino';
			$this->t->addTemplate($bloque);
			$this->showMenuCamino($menuObjActual);
			//Funciones::mostrarArreglo($menuObjActual);
		}  
	}
	 
	
  /**
   * ControlHtmlBasic::showBodyText()
   *
   * @param mixed $opcionHtml
   * @param mixed $menuRaiz
   * @return void
   */
	function showBodyText($opcionHtml,$menuRaiz)
	{   
		if($opcionHtml == 'home')
		{
			$this->t->addTemplate('bloque_contenido_modulo_home');
		}
		else
		{
			$this->t->addTemplate('bloque_contenido_modulo');
		} 
		$this->t->setVariable('titulo_sitio',Funciones::transformacionContenidoHtml($menuRaiz['texto'],true));
		if($opcionHtml == 'home')
		{ 
			$this->t->setVariable('bloque_lang',$this->langSite);
			$this->t->setVariable('titulo_publicaciones',$this->ControlIdioma->obtenerVariable('home_publicaciones_titulo'));
			$this->t->setVariable('titulo_eventos',$this->ControlIdioma->obtenerVariable('home_eventos_titulo'));
			$this->t->setVariable('titulo_noticias',$this->ControlIdioma->obtenerVariable('home_noticias_titulo')); 
		} 
		if(trim($menuRaiz['titulo']) != '')
		{
			$this->setTituloModulo(Funciones::transformacionContenidoHtml($menuRaiz['titulo'])); 
		}	
	} 
	
  /**
   * ControlHtmlBasic::showBody()
   *
   * @return void
   */
	private function showBody()
	{	    
		if(VarConfig::configSaveLogUrl)
		{
			$LogsVisitUrl = new LogsVisitUrl();
			$LogsVisitUrl->agregarVisita();
		}
		
		$opcionHtml = VarSystem::getVariable('page','GET');
		if(trim($opcionHtml) == '')
		{
			$opcionHtml = 'home';
		}	
		$menuObjActual 	= new Menu(); 
		$menuObjActual->setOpcionSitio($opcionHtml,$this->sitio);
		 //Funciones::mostrarArreglo($menuObjActual,true,'ddddd');

		$controladorMenu 		= new ControladorDeMenu(); 
		$controladorMenu->setVista($this->vistaprivada);
		$controladorMenu->setTipoVista($menuObjActual->tipo) ;
		$controladorMenu->setIdioma($this->langSite); 	
		$controladorMenu->setSitio($this->sitio); 
		if($this->admin || $this->theSession->autenticate) 
		{ 
			$controladorMenu->setPermiso($this->theSession->userObject->permiso);	
		}  
		$menuRaiz         	 	= $controladorMenu->getMenus($menuObjActual->menu_padre,$menuObjActual->id);
	    //Funciones::mostrarArreglo($controladorMenu,true,'menu');
	 	if(trim($opcionHtml) != 'home' && !is_array($menuRaiz) && $this->admin)
	 	{
			/** CHEQUEO POR OPCION DEL MENU **/
	 		$this->revisionSesion(true);
	 	}
		$menuRaiz				= $menuRaiz[0];     
		$this->laPagina->setImagenFondo($menuRaiz['imagen_fondo']);
		/*********************************** PRESENTACION BODY *******************************************/	 
		$conLastAction = false; 
		
		if($menuRaiz['acceso'] == 'privado' &&  !(bool)$this->theSession->autenticate)
		{
			$menuRaiz =  $controladorMenu->getMenuOpcion('login');
			$menuRaiz				= $menuRaiz[0];  
		}		
		if ($this->lastActionArray[0] != "logout" && trim($this->lastActionArray[0]) != '')
		{     
			if($this->langSite == 'es')
			{ 
				$titulo = $menuRaiz['titulo_es'];
			}	
			else
			{ 
				$titulo = $menuRaiz['titulo_en'];
			}	
			 Funciones::mostrarArreglo($menuRaiz);
			switch($menuRaiz['tipo_menu'])
			{
				case 'texto':
					$this->t->addTemplate('bloque_contenido_modulo');
					if(trim($menuRaiz['contenido_es']) != '' || trim($menuRaiz['contenido_en']) != '')
					{
						if($this->langSite == 'es')
						{
							$contenido 	= $menuRaiz['contenido_es'];
							$titulo 	= $menuRaiz['titulo_es'];
						}	
						else
						{
							$contenido 	= $menuRaiz['contenido_en'];
							$titulo 	= $menuRaiz['titulo_en'];
						}	
						$this->t->setVariable('contenido_sitio',$contenido);
						$this->t->setVariable('titulo_sitio',$titulo);
					}
				break;
				case 'modulo':
					$dirHtml  =  VarSystem::getPathVariables('dir_clases').trim($menuRaiz['tipo_archivo'])."/";
					//echo $dirHtml; 
					$archivoHtml = trim($dirHtml.$menuRaiz['archivo']); 
					if(!file_exists($archivoHtml))
					{
						$this->t->setVariable('contenido_sitio',"ERROR : no se encuentra el archivo o tiene contenido asociado");
					}
					else
					{ 
						//echo $archivoHtml;
						$contentFrame = new HtmlFile($archivoHtml); 
						//Funciones::mostrarArreglo($contentFrame,true);
						//$this->t->addTemplate('bloque_contenido_modulo_home'); 
						  								
						$this->t->addTemplate('bloque_contenido_modulo');
						$this->t->setVariable('titulo_sitio',Funciones::transformacionContenidoHtml($menuRaiz['titulo_es'],true));		
						  					
						$this->t->setVariable('contenido_sitio',$contentFrame->toHtml()); 
					}	
					$this->t->setVariable('titulo_sitio',$titulo);				 
				break;
				case 'link':
					Funciones::redirect($menuRaiz['link']);
				break;
				default:
					$dirHtml  		=  VarSystem::getPathVariables('dir_clases')."general/";
					$archivoHtml 	= 'home.inc'; 
					$contentFrame 	= new HtmlFile($archivoHtml); 
					$this->t->addTemplate('bloque_contenido_modulo');						
					$this->t->setVariable('contenido_sitio',$contentFrame->toHtml());
				break;
			} 
			//echo $opcionHtml;
			if(trim($opcionHtml) == 'home')
			{
				$this->t->addTemplate('bloque_contenido_flash_home');
				$this->t->addTemplate('bloque_contenido_lateral_home'); 									
				$menu = new Menu();
				$menu->setOpcionSitio('news_reciente',$this->sitio); 
				if($this->langSite == 'es')
				{
					$this->t->setVariable('noticias_recientes_lateral',str_replace('\"','"', $menu->contenido_es));
				}
				else
				{
					$this->t->setVariable('noticias_recientes_lateral', str_replace('\"','"', $menu->contenido_en));				
				} 
			}  
			else
			{
				$this->t->addTemplate('bloque_contenido_flash_nohome');	
				if($this->langSite == 'es')
				{
					$titulo = $menuRaiz['titulo_es'];
				}	
				else
				{
					$titulo = $menuRaiz['titulo_en'];
				}	
				$this->t->setVariable('titulo',$titulo);
				$foto_cabecera = round(rand(1,5),0);
				$this->t->setVariable('foto_cabecera',$foto_cabecera);	
				$this->t->addTemplate('bloque_contenido_lateral_nohome');  
			}
		}  				
	}
	
  /**
   * ControlHtmlBasic::showIndex()
   *
   * @return void
   */
	function showIndex() 
	{		 
		$output = $this->laPagina->showPage(false);	 
		echo $output;				
	}
	 
  /**
   * ControlHtmlBasic::setVariablesGlobales()
   *
   * @param mixed $e
   * @return
   */
	function setVariablesGlobales($e)
	{ 
		$e->setVariable('page_url_root', VarConfig::path_site_www_root);
		$e->setVariable('page_email', VarConfig::site_email);
		$e->setVariable('page_title_simple', trim(VarConfig::site_title));
		$e->setVariable('page_lang_simple', $this->langSite);
		$e->setVariable('page_opcion_simple', $this->lastActionArray[0]);
		return $e;
	}  
	
  /**
   * ControlHtmlBasic::setSeminarioUsuario()
   *
   * @return void
   */
	function setSeminarioUsuario()
	{  
		$valores = VarSystem::getPost(); 
		if(trim($valores['seminario']) != '')
		{
			$_SESSION['seminario'] = $valores['seminario'];
		} 
	}
	 	
}

/**
 * ControlHtml
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlHtml  extends  ControlHtmlBasic
{
  /**
   * ControlHtml::ControlHtml()
   *
   * @return void
   */
	function ControlHtml()
	{
		parent::ControlHtmlBasic();
	}
}

/**
 * ControlHtmlIntranet
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlHtmlIntranet  extends  ControlHtmlBasic
{
  /**
   * ControlHtmlIntranet::ControlHtmlIntranet()
   *
   * @return void
   */
	function ControlHtmlIntranet()
	{
		parent::ControlHtmlBasic(); 
		$this->template  		= $this->prefijoEstilo.'intranet_index.tpl'; 		
	}
	
}
?>
