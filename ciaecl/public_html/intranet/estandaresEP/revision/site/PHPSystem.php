<?

	$publicarEstado = array(array('id'=>'1','tipo'=>'Publicar'),array('id'=>'0','tipo'=>'No publicar'));

	 
	//creditos 
	$agnoDev	= 2007;
	$agnoActual	= date("Y");
	$agno		= $agnoDev;
	if($agnoDev < $agnoActual)
		$agno.=" - ".$agnoActual;
	
	//texto de bienvenida	
	$siteTextoInicio	= "	";
	
	/**TEXTOS DE ERROR DE LOGEO**/
	$sistema_error_logeo = array(1 => 'Este usuario no esta registrado en el sistema',
								 2 => 'La contraseña es incorrecta',
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
			$variables['dir_template']          	= VarConfig::path_site."templates/";
			$variables['dir_template_general']  	= $variables['dir_template']."general/";
			$variables['dir_template_ate']  		= $variables['dir_template']."ate/"; 
			$variables['path_image_root']       	= "images/"; 
			$variables['path_image']            	= "images/images_portal/";
			$variables['path_libs']             	= VarConfig::path_site."libs/";
			$variables['path_libs_pdf']        		= $variables['path_libs']."pdfClasses009e/";
			$variables['path_css']              	= "style/";
			$variables['dir_repositorio']       	= VarConfig::path_site_repositorio."repositorio/";	
			$variables['dir_doc_public']        	= VarConfig::path_site_www_repositorio."repositorio/";
			$variables['dir_repositorio_ate_doc'] 	= $variables['dir_repositorio']."docs/ate_oferente_doc/";	
			$variables['dir_repositorio_general'] 	= $variables['dir_repositorio']."docs/general/";
			$variables['dir_repositorio_common'] 	= $variables['dir_repositorio']."docs/ate_common/";	
			$variables['dir_repositorio_tmp'] 		= $variables['dir_repositorio']."docs/ate_tmp/";	
			$variables['path_script']           	= "scripts/";	
			return $variables[$var];	
		}

		function limiteTemporal($diasFormato=false)
		{
			/* equivalente a dias trasformado en segundos */
			$dias 	= 3; 
			if($diasFormato)
				$tiempo = $dias;
			else
				$tiempo = 60*60*24*$dias;
			return $tiempo;
		}
		
		function getTotalListar()
		{
			return 20;
		}

		function getTotalPagina($total)
		{
			$aux = ceil($total/20);  
			return $aux;
		}
		
		function getTotalCertificados()
		{
			return 30000;
		}

		function largoKeygen()
		{
			return 12;
		}

		function angosVigenciaExperiencias()
		{
			return 5;
		}

		function getInfoSystem($case)
		{
			switch($case)
			{
				case 'title':				
					$siteTitle 				= array();
					$nombreSitio  			= VarConfig::versionSitio." | CIAE - UCHILE";
					$siteTitle[0] 			= "";
					$siteTitle[1] 			= "";					
					$siteTitle['completo'] 	= '';
					$siteTitle['title']     = '';
					$siteTitle['firm'] 		= $nombreSitio;
					return $siteTitle;
				break;
				case 'email_webmaster':
					$email_webmaster 		= "webmaster@ciae.cl";  
					return $email_webmaster;
				break;
				case 'email_contacto':
					$value  				= "estandaresEP@ciae.uchile.cl";  
					return $value ;
				break;
				case 'email_contacto_bcc':
					$value  				= "webmaster@ciae.uchile.cl";  
					return $value ;
				break;
				case 'direccion':
					$value  				= "";  
					return $value ;
				break;
				case 'telefono':
					$value   				= "02 &#8211; 9782537";  
					return $value ;
				break; 
				case 'horario':
					$value   				= "09:00-13:15&nbsp;/&nbsp;14:15-18:00";  
					return $value ;
				break; 
				case 'dia_verificacion':
					$value   				= 10;  /*días en que la revisión se coloca en rojo*/
					return $value ;
				break; 
				case 'dia_validacion':
					$value   				= 20;  /*días en que la revisión se coloca en rojo*/
					return $value ;
				break; 
				case 'dia_alerta':
					$value   				= 5;  /*días en que la revisión se coloca en rojo*/
					return $value ;
				break; 
				case 'dia_alerta_msg':
					$value   				= 2;  /* días de diferencia entre que se envia un mensaje a los revisores 
													con las estadísticas de tipo de revision pendiente*/
					return $value ;
				break;  
			}							
		}

		function totalFilasExtras()
		{
			return 4;
		}

		function colorFilaLista($fila)
		{
			if($fila%2 == 0)
				$color = "fondo_oscuro";				 
			else
				$color = "fondo_claro";	
			return $color;
		}
		
		function getTipoVistaMenu()
		{
			/*NO CAMBIAR DE LUGAR PUES ES OPCION POR DEFECTO*/	
			$tipoArchivoMenu = array(array('id'=>'interno','tipo'=>'Vista Interna'),
									 array('id'=>'externo','tipo'=>'Vista Externa'),
									 array('id'=>'only_externo','tipo'=>'Vista Externa Exclusiva') );		
			return $tipoArchivoMenu;
		}
		
		function getTipoArchivoMenu()
		{
			/*NO CAMBIAR DE LUGAR PUES ES OPCION POR DEFECTO*/	
			$tipoArchivoMenu = array(array('id'=>'admin','tipo'=>'Administraci&oacute;n Sistema'),
									 array('id'=>'general','tipo'=>'M&oacute;dulos Generales'),
									 array('id'=>'registro','tipo'=>'M&oacute;dulos ATE - Registro Oferentes'),
									 array('id'=>'edicion','tipo'=>'M&oacute;dulos ATE - Actualizaci&oacute;n Oferentes'),
								  	 array('id'=>'revision','tipo'=>'M&oacute;dulos ATE - Revisi&oacute;n Antecentes'),
								  	 array('id'=>'generalate','tipo'=>'M&oacute;dulos ATE - Información General'));		
			return $tipoArchivoMenu;
		}
		
		function addVariable($variable,$valor)
		{
			$_POST[$variable] = $valor;
		}

		function dropVariable($variable)
		{
			unset($_POST[$variable]);
		}
		
		function getVariable($variable)
		{			
			if(isset($_POST[$variable]))
			{ 
				$value 	= trim($_POST[$variable]);
				$value 	= Funciones::cleanHtml($value);
				$value 	= Funciones::cleanSqlInjection($value);			 
				return $value;
			}
			else
				return false;
		}	
		
		function getExtensionPermitidas()
		{
			return array('pdf','doc','docx','zip','jpg','gif','png','jpeg','rar'); //array('doc','pdf','jpg','gif','png','zip','rar','jpeg');
		}
		
		function getPost()
		{			
			$arreglo = $_POST; 
			foreach($arreglo as $key => $value)
			{
				if(!is_array($value))
				{
					$value 			= VarSystem::getVariable($key); 
					$arreglo[$key] 	= $value;					
				}
			}
			return $arreglo;
		}	
				
			
		function getGet()
		{
			$arreglo = $_GET; 
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
		
		function getFile()
		{
			return $_FILES;
		}		 
	}					

	/*ARCHIVOS DE ADMINISTRACION DEL SISTEMA*/ 
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDeMenu.php';	
	require_once VarSystem::getPathVariables('dir_clases_admin').'Usuario.inc';
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDeUsuarios.inc'; 
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControllerTemplate.php'; 
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDePermiso.inc';
	require_once VarSystem::getPathVariables('dir_clases_admin').'ControladorDePersona.php';
	
	/*ARCHIVOS ADMINISTRACION ENCUESTA */
	require_once VarSystem::getPathVariables('dir_clases').'encuesta/ControlRubrica.php';
	require_once VarSystem::getPathVariables('dir_clases').'encuesta/ClasesRubrica.php';
	/*ARCHIVOS ADMINISTRACION INTRANET*/
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlAvisos.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControladorDeFunciones.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlHtml.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlLink.php';		
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlComuna.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlLogs.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/DocumentFile.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlSeleccionMultiple.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlFAQ.php';
	require_once VarSystem::getPathVariables('dir_clases').'general/ControlHtmlRequest.php';
	 
	/* CLASES HTML PARTICULARES*/
	require_once VarSystem::getPathVariables('dir_clases').'html_general/ControlForm.php';
	
	/******************** ERRORES SISTEMA ***************************/
	define(error_ext_logeo,"ERROR 100: sesión caducada "); 
	/*SE INTENTO ACCEDER A SCRIPT AJAX SIN ESTAR LOGEADO Y REQUIERIENDOLO*/
	define(error_ext_unknow,"ERROR 101: error desconocido, inténtelo nuevamente o comuníquese con Mesa de Ayuda");
	/*SE INTENTO ACCEDER A SCRIPT AJAX CON LA DIRECCIÓN DIRECTA SIN VARIABLES POST*/
			
?>