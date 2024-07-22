<?php
	//Ejemplo:<a href="download.php?tipo=envios&file=000144.pdf">Bajar Aqui</a>
	//directorio de los archivos 

	$ControlHtml		= new ControlHtml(); 
	$ControlHtml->ControlLogs->setLog('DOC-DOWNLOAD','',$_SERVER['REQUEST_URI']); 

	$tipo			= VarSystem::getVariable('tipo','GET');
	if(trim($tipo) == '')
	{
		$tipo = 'doc';
	}  
	$path        		= VarSystem::getPathVariables('dir_repositorio').$tipo."/";  

	$errorFile   	= false;
	$errorTexto  	= ''; 
	$file 			= VarSystem::getVariable('file','GET');

	$LogsFile = new LogsFile(); 
	/*$aux = explode('/',$file); 
	if(trim($aux[0]) == 'solicitudes_gestion')
	{ 
		if(!(bool)$ControlHtml->theSession->autenticate)
		{
			echo "El documento no puede mostrarse si ud no se encuentra logeado";
			$LogsFile->nuevaDescarga($file,'ERROR: SIN PERMISO'); 
			die();
		} 
	}*/
	$file 			= str_replace(array('..','.cfg','.php','='),array('','','',''),$file);
	$nombrefile 	= $_GET['nombre'];
	$filename_id 	= $file; 


	$fullPath    = $path.$file;  
	if(!file_exists($fullPath))
	{
		$errorFile   = true;
		$errorTexto  = 'Archivo no existe '.$filename;
		$LogsFile->nuevaDescarga($file,'ERROR: NO EXISTE');
		echo $errorTexto;
		die();  
	}

	$ControlHtml->checkIPBlock();


	//abro el archivo
	if ($fd = fopen ($fullPath, "r"))
	{ 
		
		$LogsFile->nuevaDescarga($file,'OK');
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
		header('Content-Disposition: attachment; filename="'.$file.'"');
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