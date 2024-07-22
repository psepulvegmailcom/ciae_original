<?php
//Ejemplo:<a href="download.php?file=algo.pdf&caso=caso_particular">Bajar Aqui</a>
	//directorio de los archivos

	include ("../config.cfg");


	$ControlHtml		= new ControlHtml(); 

	$path        		= VarSystem::getPathVariables('dir_repositorio_ate_doc');
	$ControlLogs 		= new ControlLogs();  
	 
	$theSession			= $ControlHtml->theSession;
	$elUsuarioP			= $ControlHtml->elUsuarioP;
	
	$username 			= 'unknown';
	if((bool)$theSession->autenticate)  
	{
		$username = $elUsuarioP->username;
	}

	$errorFile   	= false;
	$errorTexto  	= '';
	$caso 			= $_GET['caso']; 
	$file 			= $_GET['file'];
	$nombrefile 	= $_GET['nombre'];
	$filename_id 	= $file;
 


	if (trim($filename_id) == '')
	{
		$errorFile   = true;
		$errorTexto  = 'Input file incorrecto vacio';
	}
   
	switch($caso)
	{ 
		case 'oferente_documento':

			if(!(bool)$theSession->autenticate)  
			{
				$errorFile   = true;
				$errorTexto  = 'ERROR 100: Debe haber ingresado como usuario para obtener este documento'; 
				$ControlLogs->setLog('DOWNLOAD-FILE-FAILED',$username,$errorTexto); 		
				echo $errorTexto;
				exit();
			} 
			$path        	= VarSystem::getPathVariables('dir_repositorio_ate_doc'); 
			 	
			$ControlOferenteInfoDocumentos  = new ControlOferenteInfoDocumentos();
			$archivo 						= $ControlOferenteInfoDocumentos->getDocumento($_GET['id_oferente'],$file);
			 
			$ControlActualizacionVariableDocumento = new ControlActualizacionVariableDocumento();
			$archivo_actualizado = $ControlActualizacionVariableDocumento->documentosOferente($_GET['id_oferente'],$file);

			if(is_array($archivo_actualizado) && count($archivo_actualizado) >0)
				$archivo = $archivo_actualizado;

			$filename 		= $archivo[0]['md5_documento'];
			$extension      = $archivo[0]['extension_documento'];
			$fileRealName	= $archivo[0]['original_documento'].".".$archivo[0]['extension_documento'];
		break;	
		case 'tmp':
			$path        		= VarSystem::getPathVariables('dir_repositorio_tmp');
			$aux 				= explode(".",$file);
			$extension 			= end($aux);
			$filename 			= $file ;
			$fileRealName 		= $nombrefile.'.'.$extension;
		break;
		case 'certificado':
			if(isset($_GET['folio']) && trim($_GET['folio']) != '')
			{
				$path        		= VarSystem::getPathVariables('dir_repositorio_tmp');
				$aux 				= explode(".",$file);
				$extension 			= end($aux);
				$filename 			=  $file;
				$fileRealName 		= $nombrefile.'.'.$extension; 
			}
		break;
		case 'general':
			$path        		= VarSystem::getPathVariables('dir_repositorio_common');
			$aux 				= explode(".",$file);
			$extension 			= end($aux);
			$filename 			= $file ;
			$fileRealName 		= $filename;
		break;
		case 'oferente_documento_file':
			if(!(bool)$theSession->autenticate)  
			{
				$errorFile   = true;
				$errorTexto  = 'ERROR 100: Debe haber ingresado como usuario para obtener este documento'; 
				$ControlLogs->setLog('DOWNLOAD-FILE-FAILED',$username,$errorTexto); 		
				echo $errorTexto;
				exit();
			} 
			$path        		= VarSystem::getPathVariables('dir_repositorio_ate_doc');
			$aux 				= explode(".",$file);
			$extension 			= end($aux);
			$filename 			= $file ;
			$fileRealName 		= $nombrefile;//$filename;
		break;
	}
	 


	$fullPath    = $path.$filename; 

	if(!file_exists($fullPath))
	{
		$errorFile   = true;
		$errorTexto  = 'Archivo no existe '.$filename;
	}


	if($errorFile)
	{ 
		$ControlLogs->setLog('DOWNLOAD-FILE-FAILED',$username,$errorTexto);  
		echo $errorTexto;
		exit();
	}

	//abro el archivo
	if ($fd = fopen ($fullPath, "r"))
	{
		$msg 		= "[FILE:".$filename."][NAME:".$fileRealName."]";
		$ControlLogs->setLog('DOWNLOAD-FILE-SUCCESFUL',$username,$msg); 
		$fsize 		= filesize($fullPath);
		$path_parts = pathinfo($fullPath);
		//seteo el default si el mime no se encuentra
		if ( ! isset($mimes[$extension]))
		{
			$mime = 'application/octet-stream';
		}
		else
		{
			$mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
		}


		//genero el header del server

		header('Content-Type: "'.$mime.'"');
		header('Content-Disposition: attachment; filename="'.$fileRealName.'"');
		if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
		{
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-Transfer-Encoding: binary");
			header('Pragma: public');
		}
		else
		{
			header("Content-Transfer-Encoding: binary");
			header('Expires: 0');
			header('Pragma: no-cache');
		}

		//envio el archivo
		header("Content-length: $fsize");
		header("Cache-control: private"); //abro el archivo directamente
		while(!feof($fd)) {
			$buffer = fread($fd, 2048);
			echo $buffer;
		}
	}

fclose ($fd);
exit;

// cargar los mime types
$mimes = array(	'hqx'	=>	'application/mac-binhex40',
				'cpt'	=>	'application/mac-compactpro',
				'csv'	=>	array('text/x-comma-separated-values', 'application/vnd.ms-excel'),
				'bin'	=>	'application/macbinary',
				'dms'	=>	'application/octet-stream',
				'lha'	=>	'application/octet-stream',
				'lzh'	=>	'application/octet-stream',
				'exe'	=>	'application/octet-stream',
				'class'	=>	'application/octet-stream',
				'psd'	=>	'application/x-photoshop',
				'so'	=>	'application/octet-stream',
				'sea'	=>	'application/octet-stream',
				'dll'	=>	'application/octet-stream',
				'oda'	=>	'application/oda',
				'pdf'	=>	array('application/pdf', 'application/x-download'),
				'ai'	=>	'application/postscript',
				'eps'	=>	'application/postscript',
				'ps'	=>	'application/postscript',
				'smi'	=>	'application/smil',
				'smil'	=>	'application/smil',
				'mif'	=>	'application/vnd.mif',
				'xls'	=>	array('application/excel', 'application/vnd.ms-excel'),
				'ppt'	=>	'application/powerpoint',
				'wbxml'	=>	'application/wbxml',
				'wmlc'	=>	'application/wmlc',
				'dcr'	=>	'application/x-director',
				'dir'	=>	'application/x-director',
				'dxr'	=>	'application/x-director',
				'dvi'	=>	'application/x-dvi',
				'gtar'	=>	'application/x-gtar',
				'gz'	=>	'application/x-gzip',
				'php'	=>	'application/x-httpd-php',
				'php4'	=>	'application/x-httpd-php',
				'php3'	=>	'application/x-httpd-php',
				'phtml'	=>	'application/x-httpd-php',
				'phps'	=>	'application/x-httpd-php-source',
				'js'	=>	'application/x-javascript',
				'swf'	=>	'application/x-shockwave-flash',
				'sit'	=>	'application/x-stuffit',
				'tar'	=>	'application/x-tar',
				'tgz'	=>	'application/x-tar',
				'xhtml'	=>	'application/xhtml+xml',
				'xht'	=>	'application/xhtml+xml',
				'zip'	=> array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
				'mid'	=>	'audio/midi',
				'midi'	=>	'audio/midi',
				'mpga'	=>	'audio/mpeg',
				'mp2'	=>	'audio/mpeg',
				'mp3'	=>	'audio/mpeg',
				'aif'	=>	'audio/x-aiff',
				'aiff'	=>	'audio/x-aiff',
				'aifc'	=>	'audio/x-aiff',
				'ram'	=>	'audio/x-pn-realaudio',
				'rm'	=>	'audio/x-pn-realaudio',
				'rpm'	=>	'audio/x-pn-realaudio-plugin',
				'ra'	=>	'audio/x-realaudio',
				'rv'	=>	'video/vnd.rn-realvideo',
				'wav'	=>	'audio/x-wav',
				'bmp'	=>	'image/bmp',
				'gif'	=>	'image/gif',
				'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
				'png'	=>	array('image/png',  'image/x-png'),
				'tiff'	=>	'image/tiff',
				'tif'	=>	'image/tiff',
				'css'	=>	'text/css',
				'html'	=>	'text/html',
				'htm'	=>	'text/html',
				'shtml'	=>	'text/html',
				'txt'	=>	'text/plain',
				'text'	=>	'text/plain',
				'log'	=>	array('text/plain', 'text/x-log'),
				'rtx'	=>	'text/richtext',
				'rtf'	=>	'text/rtf',
				'xml'	=>	'text/xml',
				'xsl'	=>	'text/xml',
				'mpeg'	=>	'video/mpeg',
				'mpg'	=>	'video/mpeg',
				'mpe'	=>	'video/mpeg',
				'qt'	=>	'video/quicktime',
				'mov'	=>	'video/quicktime',
				'avi'	=>	'video/x-msvideo',
				'movie'	=>	'video/x-sgi-movie',
				'doc'	=>	'application/msword',
				'word'	=>	array('application/msword', 'application/octet-stream'),
				'xl'	=>	'application/excel',
				'eml'	=>	'message/rfc822'
			);

			function stripslashes2($string) {
			   $string = str_replace("\\\"", "\"", $string);
			   $string = str_replace("\\'", "'", $string);
			   $string = str_replace("\\\\", "\\", $string);
			   return $string;
			}

			function _clean_input_keys($str)
			{
				$str = trim($str);
				$str = stripslashes($str);
				$str = stripslashes2($str);
				$str = preg_replace('/\s\s+/', ' ', $str);
				$str1 = str_replace('./', '', $str);
				$str2 = str_replace('..', '', $str1);

				if ( ! get_magic_quotes_gpc())
				{
				   return addslashes($str2);
				}

				return $str2;
			}

 
?>