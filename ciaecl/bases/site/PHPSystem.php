<?php


	$publicarEstado = array(array('id'=>'1','tipo'=>'Publicar'),array('id'=>'0','tipo'=>'No publicar')); 
	
	//creditos 
	$agnoDev	= 2009;
	$agnoActual	= date("Y");
	$agno		= $agnoDev;
	if($agnoDev < $agnoActual)
		$agno.=" - ".$agnoActual;
	
	//texto de bienvenida	
	$siteTextoInicio	= "	";
	
	/** TEXTOS DE ERROR DE LOGEO**/
	$sistema_error_logeo = array(1 => 'Este usuario no esta registrado en el sistema',
								 2 => 'La contrase&ntilde;a es incorrecta',
								 4 => 'Esta cuenta de usuario esta inactiva',
								 3 => 'El c&oacute;digo de seguridad no coincide'); 
					
	class VarSystem
	{		
		function getPathVariables($var)
		{
			$variables = array(); 
			$variables['dir_clases_admin'] 			= VarConfig::path_site.'site/clases_admin/';
			$variables['dir_clases'] 				= VarConfig::path_site.'site/clases_'; 
			$variables['dir_html'] 					= VarConfig::path_site.'html/'; 
			$variables['path_lang'] 				= VarConfig::path_site.'lang/'; 
			$variables['dir_template']          	= VarConfig::path_template;
			$variables['dir_template_general']  	= $variables['dir_template']."general/"; 
			$variables['dir_template_sitio']  		= $variables['dir_template']."site/"; 
			$variables['dir_template_admin']  		= $variables['dir_template']."admin/"; 
			$variables['dir_template_web']  		= $variables['dir_template']."web/"; 
			$variables['dir_web_public']			= VarConfig::path_site_www;
			$variables['web_site']					= VarConfig::site_www;
			$variables['path_image_root']       	= "images/"; 
			$variables['path_image']            	= "images/images_portal/";
			$variables['path_libs']             	= VarConfig::path_site."libs/";
			$variables['path_libs_pdf']        		= $variables['path_libs']."pdfClasses009e/";
			$variables['path_css']              	= "style/";
			$variables['dir_repositorio']       	= VarConfig::path_site_repositorio; 
			$variables['dir_repositorio_tmp']       = $variables['dir_repositorio'].'tmp/'; 
			$variables['dir_doc_public']        	= VarConfig::path_site_www_repositorio;  
			$variables['path_xml']       			= $variables['dir_repositorio'].'xml/'; 
			$variables['path_script']           	= "scripts/";	
			return $variables[$var];	
		}
		
		function formatoFechaSql($campo,$lang='es')
		{
			$lang = VarSystem::obtenerIdiomaActual();
			if($lang == 'es')
			{
				$formato = '%d de %M de %Y';
			}
			else
			{
				$formato = '%M %d, %Y';
			}
			$str = " DATE_FORMAT(  ".$campo."  , '%d-%m-%Y' ) AS ".$campo."_html,DATE_FORMAT(  ".$campo."  , '".$formato."' ) AS ".$campo."_html_full ";
			return $str;
		}

		function limiteTemporal()
		{
			/** EQUIVALENTE A DIAS TRASFORMADO EN SEGUNDOS */
			$dias 	= 3; 
			$tiempo = 60*60*24*$dias;
			return $tiempo;
		} 
		
		function getTotalListarRss()
		{
			return 10;
		}  
		
		function getTotalListarBloqueVertical()
		{
			return 4;
		}  
				
		function getTotalListarNoticiasCambio() 
		{
			/** TOTAL DE NOTICIAS PREVIO AL CAMBIO DE 'EN LOS MEDIO' A OTRA COLUMNA */
			return 4;
		}  
		
		function getTotalDiasCorreosConfirmacion()
		{
			return 3;
		}
		
		function getTotalCorreosConfirmacion()
		{
			return 3;
		}
		
		function getDiasCaducidad($caso='simple')
		{
			$limite = 10;
			if(VarConfig::sitio_www == 'ciae_web2.0')
			{
				$limite = 5;
			}
			$dias 	= $limite;
			/** SI CORRESPONDE AL MES DE FEBRERO DEL A&ntilde;O DEBEN SER M&Aacute;S D&iacute;AS PARA QUE EL SITIO NO SE VEA PELADO */
			$mes = date('n');
			if($mes == 2)
			{
				$dias = date('j'); 
				$dias = $limite + $dias ;
			}
			if($caso == 'extendido')
			{
				$dias = $dias + (30*6);
				if(VarConfig::sitio_www == 'ciae_web2.0')
				{
					$dias = $dias + 45;
				}
			}
			return $dias;
		}  
		
		function getTotalListarBloque()
		{
			return 5;
		}  
		
		function getTotalListarGaleria()
		{
			return 4;
		} 		
		
		function getTotalListar()
		{
			return 10;
		} 
		
		function getTotalListarHome()
		{
			return 2;
		}
		function getTotalListarCovid()
		{
			return 10;
		}				
		function getTotalListarBloqueSimple()
		{
			return 3;
		}

		function getTotalPagina($total)
		{
			$aux = ceil($total/9);  
			return $aux;
		}

		function getInfoSystem($case)
		{
			$webmail = VarConfig::site_email;  
			switch($case)
			{
				case 'title':				
					$siteTitle 				= array();
					$nombreSitio  			= VarConfig::site_title;  
					$siteTitle[0] 			= "".$nombreSitio;
					$siteTitle[1] 			= "";					
					$siteTitle['completo'] 	= $siteTitle[0]." ".$siteTitle[1];
					$siteTitle['simple'] 	= VarConfig::site_title;
					$siteTitle['title']     = $siteTitle[1]."   ".$siteTitle[0];
					$siteTitle['firm'] 		= "".$siteTitle[1];
					return $siteTitle;
				break;
				case 'email_webmaster':
					$email_webmaster 		= $webmail;  
					return $email_webmaster;
				break;
				case 'email_bcc_extra': 
					$email_extra 			= VarConfig::site_email_bcc_extra;   
					return $email_extra;
				break;
				case 'email_contacto':
					$value  				= VarConfig::site_email;  
					return $value ;
				break;
				case 'email_contacto_bcc':
					$value  				= $webmail;  
					return $value ;
				break;  
			}							
		}

		function getIdiomasPermitidos()
		{
			$idiomas = array('es','en');
			return $idiomas;
		}

		function getIdiomasPermitidosCompleto()
		{
			$idiomas = array('nn' => 'Neutro','es' => 'Espa&ntilde;ol','en' => 'Ingl&eacute;s');
			return $idiomas;
		}
		
		function getTipoVistaMenu()
		{
			/** NO CAMBIAR DE LUGAR PUES ES OPCION POR DEFECTO*/	
			$tipoArchivoMenu = array(array('id'=>'interno','tipo'=>'Vista Interna'),
									 array('id'=>'externo','tipo'=>'Vista Externa'),
									 array('id'=>'only_externo','tipo'=>'Vista Externa Exclusiva') );		
			return $tipoArchivoMenu;
		}
		
		function getTipoArchivoMenu()
		{
			/** NO CAMBIAR DE LUGAR PUES ES OPCION POR DEFECTO*/	
			$tipoArchivoMenu = array(array('id'=>'admin','tipo'=>'Administraci&oacute;n Sistema'), 
									array('id'=>'general','tipo'=>'M&oacute;dulos Generales'));		
			return $tipoArchivoMenu;
		}
		
		function addVariable($variable,$valor)
		{
			$_POST[$variable] = $valor;
		}
		
		function obtenerIdiomaActual()
		{
			if(isset($_POST['langSite']) && $_POST['langSite'] != '')
			{
				$_POST['langSite'] = filter_input_array($_POST['langSite'], FILTER_SANITIZE_STRING);
				return $_POST['langSite'];
			}
			else
			{
				if(isset($_GET['langSite']) && $_GET['langSite'] != '')
				{
					$_GET['langSite'] = filter_input_array($_GET['langSite'], FILTER_SANITIZE_STRING);
					return $_GET['langSite'];
				}
				else
				{
					return 'es';
				}
			}
		}
		
		function getVariable($variable,$case='POST')
		{ 
			if($case == 'POST')
				$arreglo = $_POST;
			else
				$arreglo = $_GET; 
		
			if(isset($arreglo[$variable]))
			{ 
				$value 	= trim($arreglo[$variable]);
				$value 	= VarSystem::cleanValue($value,true); 		 
				return $value;
			}
			else
				return false;
		}	

		function cleanValue($value)
		{
			//$value 	= utf8_decode($value);
			$value = htmlspecialchars($value, ENT_QUOTES);
			$value 	= Funciones::cleanHtml($value);
			$value 	= Funciones::cleanSqlInjection($value);			 
			return $value;
		}
		
		function getExtensionPermitidas()
		{
			return array('pdf','doc','zip','jpg','gif','png','jpeg','rar'); //array('doc','pdf','jpg','gif','png','zip','rar','jpeg');
		}
		
		function getPost()
		{
			$arreglo = $_POST; 
			foreach($arreglo as $key => $value)
			{
				if(!is_array($value))
				{
					$value 			= VarSystem::cleanValue($value); 
					$arreglo[$key] 	= $value;					 
				}
			} 
			return $arreglo;
		}	
		
		function getUrl()
		{
			$url = VarConfig::path_site_www.'index.php?'.$_SERVER['QUERY_STRING'];
			//$url =  'http://www.ciae.uchile.cl/index.php?'.$_SERVER['QUERY_STRING'];
			return $url;
		}		
				
		function getGet()
		{
			$arreglo = $_GET; 
			foreach($arreglo as $key => $value)
			{
				if(!is_array($value))
				{
					$value = htmlspecialchars($value, ENT_QUOTES);
					$value 			= VarSystem::cleanValue($value); 
					$arreglo[$key] 	= $value;					 
				}
			} 
			return $arreglo;
		}	
		
		function getFile()
		{
			return $_FILES;
		}		 
	}				

	
	/** ARCHIVOS DE ADMINISTRACION DEL SISTEMA*/ 
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlVistas.php';	
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDeMenu.php';	
	require_once VarSystem::getPathVariables('dir_clases_admin').'Usuario.inc';
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDeUsuarios.inc'; 
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDePermiso.inc';
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDePersona.php';
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDeProfesor.php';
	
	/** CLASES HTML PARTICULARES*/
	require_once VarSystem::getPathVariables('dir_clases').'html_general/ControlForm.php'; 
	require_once VarSystem::getPathVariables('dir_clases').'html_general/ControlGeneral.php'; 
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranet.php'; 
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranetEnLaPrensa.php'; 
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranetNoticias.php';
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranetPublicaciones.php'; 
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranetRecursos.php';
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranetTipos.php';
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlHonorarios.php';
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranetHonorarios.php';
    require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlInventarioLibros.php';	 
    require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralIntranetInventarioLibros.php';
	
	/** ARCHIVOS ADMINISTRACION INTRANET*/
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlSite.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControladorDeFunciones.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/tools.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlAvisos.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlAgenda.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlHtml.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlLink.php';		
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlComuna.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlLogs.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlIdioma.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/DocumentFile.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlSeleccionMultiple.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlFAQ.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlHtmlRequest.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlBanner.php';
    require_once VarSystem::getPathVariables('dir_clases').'general/ControlBoletin.php';
    require_once VarSystem::getPathVariables('dir_clases').'general/ControlBoletinFoco.php';
    require_once VarSystem::getPathVariables('dir_clases').'general/ControlBoletinEspeciales.php';

	/** CLASES PROPIAS DEL WEB */ 
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladorNoticias.php'; 
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladoresSite.php'; 
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladordeCatalago.php'; 
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladorAcademico.php'; 
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladorSeminario.php';
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladorColumna.php';
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladorDocumentos.php'; 
	//require_once VarSystem::getPathVariables('dir_clases').'site/ControladorInvitado.php'; 
	
	/** INCLUSION EXTRACCION  */	
	//require_once VarSystem::getPathVariables('dir_clases').'extraccion/ControladorExtraccion.php';
	//require_once VarSystem::getPathVariables('dir_clases').'extraccion/ControladorMatrices.php';
	
	/** INCLUSION CORRECCION TEXTOS  */
	//require_once VarSystem::getPathVariables('dir_clases').'intranet-textos/ControladorTextos.php'; 

	/** CLASES PROPIAS DEL WEB */  
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlProyectos.php';
	require_once VarSystem::getPathVariables('dir_clases').'site/ControladorContacto.php';
	require_once VarSystem::getPathVariables('dir_clases').'site/ControladorGeneral.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlTipos.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControladorPostulacion.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlNoticia.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlNoticiasPrensa.php';  
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlBoletinFoco.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlBoletinesEspeciales.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlBoletin.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlPublicaciones.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlContacto.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControladorInscripcion.php';
    require_once VarSystem::getPathVariables('dir_clases').'general/ControlEventos.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlTexto.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlNube.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControladorHTML.php';
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlRecurso.php';	
	require_once VarSystem::getPathVariables('dir_clases').'web/ControladorCertificado.php';
	
	/** INCLUSION TADI  */	
	require_once VarSystem::getPathVariables('dir_clases').'web/ControlTadi.php';
	
	/** INCLUSION INSTITUTO  */	
	require_once VarSystem::getPathVariables('dir_clases').'instituto/ControladorTransparencia.php';
	
	/** INCLUSION GESTION */	
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlGeneralGestion.php';
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlObjetoGestion.php';
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlObjetoGestionCentroCosto.php';
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlObjetoGestionTipoSolicitudes.php';	
	require_once VarSystem::getPathVariables('dir_clases').'intranet/ControlVistasGestion.php';	
    require_once VarSystem::getPathVariables('dir_clases').'general/documentosWord.php';
	
	/** ****************** ERRORES SISTEMA ***************************/
	//define(error_ext_logeo,"ERROR 100: sesi&oacute;n caducada "); /** se intento acceder a script ajax sin estar logeado y requieriendolo*/
	//define(error_ext_404,"ERROR 404: direcci&oacute;n no encontrada "); /** la url que se solicita no se encuentra */
	//define(error_ext_unknow,"ERROR 101: error desconocido, int&eacute;ntelo nuevamente o comun&iacute;quese con Mesa de Ayuda"); 
	/** se intento acceder a script ajax con la direcci&oacute;n directa sin variables POST*/
?>