<?php

$webmaster_sidwod_email = "webmaster@sidwod.com";

function sidtool_sendMailAlert($site,$case)
{
	SIDTOOLHtml::sendMailAlert($site,$case);
}


/************************************ FUNCIONES MANEJO HMTL ***********************************/ 
class SIDTOOLHtml
{	
	function guardarArchivo($datos,$md5=true)
	{
		/******************************************************
	            [name]  
	            [type]  
	            [tmp_name]  
	            [error]  
	            [size]  
	            [path]   
		********************************************************/ 
		$aux 	= explode('.',$datos['name']); 
		$ultimo = count($aux)-1; 
		$datos['extension'] = strtolower($aux[$ultimo]);
		unset($aux[$ultimo]);
		$datos['name_no_extension'] = implode($aux); 
		$datos['md5'] = md5(time().$datos['name']);
		if(!isset($datos['nombre_final']))
		{
			$datos['nombre_final'] = $datos['md5'];
		} 
		$datos['nombre_final'] = $datos['md5'].'.'.$datos['extension'];
		if(!$md5)
		{
			if(isset($datos['nombre_extra']))
			{
				$datos['nombre_final'] = SIDTOOLHtml::cleanChar($datos['nombre_extra']).'.'.$datos['extension'];
			}
			else
			{
				$datos['nombre_final'] = SIDTOOLHtml::cleanChar($datos['name_no_extension']).'.'.$datos['extension'];
			}
		} 
		if ( ! @copy($datos['tmp_name'],$datos['path'].$datos['nombre_final']))
		{
			echo "Error upload file ".$datos['name'];
		}
	 	// GeneralPrint($datos);
		return $datos;
	}

	function cleanHtmlEditor($input,$complete = false)
	{  
		$input = trim($input); 
		if($complete)
		{     
			$input = str_replace("<br","-br",$input);
			//$input = str_replace("<br />"," -br- ",$input); echo htmlentities($input);
			$input = strip_tags($input);  
			$input = str_replace("-br","<br",$input);			
		}
		else
		{
			$input = htmlentities($input); 
			$input = html_entity_decode($input);  

			$tags = array("o:p","div","td","tr","tbody","table","strong","br","li","ul","ol", "p","span","font");
			$tagscount = count($tags);
			for($i=0; $i < $tagscount;$i++) 
			{
				$input 	= SIDTOOLHtml::stripIniTags($tags[$i], $input);  
			}

		    $regExp = "<!--[^>]*-->";
		    $input = ereg_replace($regExp, "", $input); 
			$input 	= str_replace($replace,$replace_to, $input); 	 
		}		
		  //$input = htmlentities($input);
		return $input;
	}

	function stripIniTags($tag, $string) 
	{ 
		$tag_lower = strtolower($tag);		
	    $regExp = "<" . "$tag_lower" . "[^>]*>";
	    $string = ereg_replace($regExp, "<$tag_lower>", $string);
		$tag = strtoupper($tag);
	    $regExp = "<" . "$tag" . "[^>]*>";
	    $string = ereg_replace($regExp, "<$tag_lower>", $string);
		$string 	= str_replace("</$tag>","</$tag_lower>", $string);
	    return $string;   
	}

	function transformarArreglo($arreglo,$llave)
	{
		$nuevoArreglo = array();
		for($i=0; $i < count($arreglo) ; $i++)
		{
			$nuevoArreglo[$arreglo[$i][$llave]] = $arreglo[$i];
		}			
		return $nuevoArreglo;
	} 

	function escribirExcelTabla($contenido,$path,$extension='xls',$file='' )
	{
		$contenido = str_replace('<table', '<table border="1" ',$contenido); 
		if($file == '')
		{
			$file = date('YmdHis');
		}	
		$file = $file.'.'.$extension;
		$nombre_archivo = $path.$file;	 
		SIDTOOLHtml::limpiarArchivosTemporales($path);
		SIDTOOLHtml::escribirArchivo($path.$file,$contenido);
		return $file;
	}

	function limpiarArchivosTemporales($path)
	{
		$ahora 		= SIDTOOLDate::fechaActual(true,true,0,true);
		$limite   	= 432000; /* segundos => 5 días*/
		$archivos 	= SIDTOOLHtml::obtenerArchivos($path); 
		
		 foreach($archivos as $tipo => $archivo)
		{ 
			$archivo_real = $path.$archivo;
			$creacion = filectime($archivo_real);
			$resta = $ahora - $creacion; 
			if($resta > $limite)
			{
				@unlink($archivo_real);  
			}			 
		}  
	}

	function escribirArchivo($archivo,$contenido)
	{ 		 
		if (!$gestor = fopen($archivo, 'x')) 
		{
			 echo "No se puede abrir el archivo ($nombre_archivo)";
			 exit;
		}

		if (fwrite($gestor, $contenido) === FALSE) {
			echo "No se puede escribir al archivo ($nombre_archivo)";
			exit;
		}
		fclose($gestor);		 
	}	

	function sendMailAlert($site,$case,$msg='')
	{
		$webmaster_sidwod_email = "webmaster@sidwod.com";
		$headers = 'From: '.$webmaster_sidwod_email . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		$msg =  $msg."\n\n";
		$msg .=  "Date : ".date('d-m-Y H:i:s')."\n";
		$msg .= "IP   : ".$_SERVER['REMOTE_ADDR']."\n";
		$msg .= "Link : http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		mail($webmaster_sidwod_email, '['.strtoupper($site).'] '.$case, $msg,$headers);
	}

	function showAlert($msg)
	{
		echo "<script>alert('".$msg."');</script>";
	}

	function cleanChar($str)
	{		
		$str = trim($str);
		$str = str_replace(' ','_',$str);
		$search 	= array(".","á","é","í","ó","ú","ñ","'",'"',"Á","É","Í","Ó","Ú","Ñ"); 
		$replace 	= array("_","a","e","i","o","u","n","",'',"A","E","I","O","U","N");
		$str = str_replace($search,$replace,$str);
		return $str;		
	}  
	
	function mostrarArreglo($arreglo)
	{ 
		echo " 	<div class='div_debug'>		 ";
		if(is_array($arreglo) || is_object($arreglo))
		{
			echo " 	<left>		<pre>";print_r($arreglo);echo "</pre></left> ";	
		}  
		else
		{
			$arreglo = str_replace(",",", ",$arreglo);
			print_r($arreglo);		
		} 
		echo " </div> ";			 
	}		

	function generarPassword($largo_max = 7)
	{
		$str = "ABCDEFGHJKLMNPQRTWXYZabcdefghijkmnpqrstwxyz2346789";
		$cad = "";
		$largo = 100; 
		for($i=0;$i < $largo ;$i++) {
			if(strlen($cad) == $largo_max)
				break;
			$cad .= substr($str,rand(0,60),1);
		}
		return $cad;
	}	  

	function textToTitle($text)
	{
		return ucwords(strtolower($text));
	} 

	function cleanHtml($input,$decode=false) 
	{ 
		if($decode)
		{ 
			$input = utf8_encode($input);				 
		} 
		$input 		= htmlentities($input);  
		$input 		= stripslashes($input); 
		$input 		= str_replace('\\"','"',$input); 
		$input 		= str_replace('\"','"',$input);  
		$input = str_replace(array("&lt;","&gt;",'&quot;','&amp;','&#039;'),array("<",">",'"','&',"'"),$input);
		$input = str_replace("<br>","<br />",$input);
		return $input;
	}

	function obtenerArchivos($ruta,$onlyfile=true)
	{
		$lista = array();
		if (is_dir($ruta)) 
		{
			if ($dh = opendir($ruta)) 
			{
				while (($file = readdir($dh)) !== false) 
				{
					if($file != '..' && $file != '.')
					{ 
						if (is_dir($ruta . $file))
						{ 
							if(!$onlyfile)
								$lista[] = $file;
						}
						else
						{							
							$lista[] = $file;
						}
					} 
					else
						continue;				 
				}
				closedir($dh);			 
			}
		}
		return $lista;
	}

	function sendEmail($to, $body, $subject, $fromaddress, $fromname,$bcc='')
	{		 
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	 
		$cabeceras .= 'From: '.$fromname.' <'.$fromaddress.'>' . "\r\n";
		$cabeceras .= 'Reply-To: '.$fromname.' <'.$fromaddress.'>' . "\r\n";
		$cabeceras .= "Message-ID: <".time()."-".$fromaddress.">"."\r\n";
		$cabeceras .= "X-Mailer: PHP v".phpversion()."\r\n";
		if(trim($bcc) != '')
			$cabeceras .= 'Bcc: '.$bcc."\r\n";

		$asunto 	= $subject;  
		$para 		= $to;  
		$mensaje = $body;

		$asunto  = html_entity_decode($asunto);
		@mail($para, $asunto, $mensaje, $cabeceras);

	}	

	function send_mail($to, $body, $subject, $fromaddress, $fromname,$bcc='', $attachments=false)
	{
	  $eol="\r\n";
	  $mime_boundary = md5(time());

	  # Common Headers
	  $headers .= "From: ".$fromname."<".$fromaddress.">".$eol;
	  $headers .= "Reply-To: ".$fromname."<".$fromaddress.">".$eol;
	  $headers .= "Return-Path: ".$fromname."<".$fromaddress.">".$eol;    // these two to set reply address
	  $headers .= "Message-ID: <".time()."-".$fromaddress.">".$eol;
	  if(trim($bcc) != '')
		$headers .= "BCC: ".$bcc."".$eol;
	  $headers .= "X-Mailer: PHP v".phpversion().$eol;          // These two to help avoid spam-filters

	  # Boundry for marking the split & Multitype Headers
	  $headers .= 'MIME-Version: 1.0'.$eol.$eol;
	  $headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\"".$eol.$eol;

	  # Open the first part of the mail
	  $msg = "--".$mime_boundary.$eol;
	 
	  $htmlalt_mime_boundary = $mime_boundary."_htmlalt"; //we must define a different MIME boundary for this section
	  # Setup for text OR html -
	  $msg .= "Content-Type: multipart/alternative; boundary=\"".$htmlalt_mime_boundary."\"".$eol.$eol;

	  # Text Version
	  $msg .= "--".$htmlalt_mime_boundary.$eol;
	  $msg .= "Content-Type: text/plain; charset=iso-8859-1".$eol;
	  $msg .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
	  $msg .= strip_tags(str_replace("<br>", "\n", substr($body, (strpos($body, "<body>")+6)))).$eol.$eol;

	  # HTML Version
	  $msg .= "--".$htmlalt_mime_boundary.$eol;
	  $msg .= "Content-Type: text/html; charset=iso-8859-1".$eol;
	  $msg .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
	  $msg .= $body.$eol.$eol;

	  //close the html/plain text alternate portion
	  $msg .= "--".$htmlalt_mime_boundary."--".$eol.$eol;

	  if ($attachments !== false)
	  {
		for($i=0; $i < count($attachments); $i++)
		{
		  if (is_file($attachments[$i]["file"]))
		  {  
			# File for Attachment
			$file_name = substr($attachments[$i]["file"], (strrpos($attachments[$i]["file"], "/")+1));
		   
			$handle=fopen($attachments[$i]["file"], 'rb');
			$f_contents=fread($handle, filesize($attachments[$i]["file"]));
			$f_contents=chunk_split(base64_encode($f_contents));    //Encode The Data For Transition using base64_encode();
			$f_type=filetype($attachments[$i]["file"]);
			fclose($handle);
		   
			# Attachment
			$msg .= "--".$mime_boundary.$eol;
			$msg .= "Content-Type: ".$attachments[$i]["content_type"]."; name=\"".$file_name."\"".$eol;  // sometimes i have to send MS Word, use 'msword' instead of 'pdf'
			$msg .= "Content-Transfer-Encoding: base64".$eol;
			$msg .= "Content-Description: ".$file_name.$eol;
			$msg .= "Content-Disposition: attachment; filename=\"".$file_name."\"".$eol.$eol; // !! This line needs TWO end of lines !! IMPORTANT !!
			$msg .= $f_contents.$eol.$eol;
		  }
		}
	  }

	  # Finished
	  $msg .= "--".$mime_boundary."--".$eol.$eol;  // finish with two eol's for better security. see Injection.
	 
	  # SEND THE EMAIL
	  ini_set(sendmail_from,$fromaddress);  // the INI lines are to force the From Address to be used !
	  $mail_sent = mail($to, $subject, $msg, $headers);
	 
	  ini_restore(sendmail_from);
	 
	  return $mail_sent;
	}
 
} 
 
 

/************************************ FUNCIONES GENERACION DE SQL ***********************************/
class SIDTOOLSql
{
	function createConexion($server, $user, $pwd, $base)
	{
		$g_link = mysql_connect( $server, $user, $pwd) or die('Could not connect to mysql server.' );
		mysql_select_db($base, $g_link) or die('Could not select database.');
		return $g_link;
	}

	function consultarQuery($link,$query)
	{ 
		$result = array();  
		$objRS = mysql_query($query, $link);

		if(DATABASE_DEBUG_PRINT)
		{ 
		    SIDTOOLHtml::mostrarArreglo( $query);
        }
		while ($row = @mysql_fetch_array(	$objRS)) {
		  $result[] = $row;
		}
		return $result;
	} 

	function ejecutarQuery($link,$query)
	{
		$result = array();  
		if(DATABASE_DEBUG_PRINT)
		{ 
		    SIDTOOLHtml::mostrarArreglo( $query);
        }
		return mysql_query($query, $link);
	}

	function createSelect($what,$from,$where,$order)
	{
		if($where != '')
			$where = " WHERE ".$where;
		$sql = "SELECT ".$what." FROM ".$from."  ".$where." ORDER BY ".$order;
		return $sql;
	}

	function  obtenerUltimoId($link,$table,$variable)
	{ 	
		$query = "SELECT MAX(".$variable.") as ultimo FROM ".$table;  
		$output = SIDTOOLSql::consultarQuery($link,$query);
		
		return $output[0]['ultimo'];
	}

	function createInsert($table,$values,$type='INSERT')
	{ 
		$vars = '';
		$vals = ''; 
		foreach($values as $var => $val)
		{
			if(trim($vars) != '')
				$vars .= ", ";
			$vars .= $var;
			if(trim($vals) != '')
				$vals .= "', '";
			$vals .= $val;
		}
		$sql = $type." INTO ".$table." (".$vars.") VALUES ('".$vals."')";
		//echo $sql.'<br><br>';
		return $sql;
	}
	
	function createDelete($table,$values)
	{
		$where = '';
		  
		foreach($values as $var => $val)
		{
			if(trim($where) != '')
				$where .= " , ";
			$where .= $var." ='".$val."'";  
		}
		 
		$sql =  "DELETE FROM  ".$table." WHERE ".$where;
		//echo $sql.'<br><br>';
		return $sql;
	}

	function createUpdate($table,$values,$where)
	{  
		$what = '';		  
		foreach($values as $var => $val)
		{
			if(trim($what) != '')
				$what .= " , ";
			$what .= $var." ='".$val."'";  
		}		 
		$sql =  "UPDATE  ".$table." SET ".$what." WHERE ".$where;
		//echo $sql.'<br><br>';
		return $sql;
	}
}


/************************************ FUNCIONES OBTENCION DE VARIABLES POST ***********************************/
class SIDTOOLPost
{
	function getPost()
	{
		$arreglo = $_POST; 
		foreach($arreglo as $key => $value)
		{
			if(!is_array($value))
			{
				$value 			= SIDTOOLPost::getPostVariable($key); 
				$arreglo[$key] 	= $value;					
			}
		}
		return $arreglo;
	}	

	function getPostVariable($variable)
	{			
		if(isset($_POST[$variable]))
		{ 
			$value 	= trim($_POST[$variable]);
			$value 	= SIDTOOLPost::cleanHtml($value);
			$value 	= SIDTOOLPost::cleanSqlInjection($value);			 
			return $value;
		}
		else
			return false;
	}	

	function cleanHtml($input,$decode=false) 
	{  
		return SIDTOOLHtml::cleanHtml($input,$decode) ;
	}

	function getVariablePost($variable,$tipo='_POST')
	{			
		if(isset($_POST[$variable]))
		{ 
			$value 	= trim($_POST[$variable]);
			$value 	= SIDTOOLPost::cleanHtml($value);
			$value 	= SIDTOOLPost::cleanSqlInjection($value);			 
			return $value;
		}
		else
			return false;
	}	

	function getVariablesPost()
	{ 
		$arreglo = $_POST;  
		if(is_array($arreglo) && count($arreglo) > 0)
		{
			foreach($arreglo as $key => $value)
			{
				if(!is_array($value))
				{
					$value 			= SIDTOOLPost::getVariablePost($key); 
					$arreglo[$key] 	= $value;					
				}
			}
		}
		return $arreglo;
	}

	function  cleanSqlInjection($str) 
	{	 
		$str = preg_replace('/\0+/', '', $str);
		$str = preg_replace('/(\\\\0)+/', '', $str);

		$str = preg_replace('#(&\#?[0-9a-z]+)[\x00-\x20]*;?#i', "\\1;", $str);
		
		
		$str = preg_replace('#(&\#x?)([0-9A-F]+);?#i',"\\1\\2;",$str);

		$str = preg_replace("/(%20)+/", '9u3iovBnRThju941s89rKozm', $str);
		$str = preg_replace("/%u0([a-z0-9]{3})/i", "&#x\\1;", $str);
		$str = preg_replace("/%([a-z0-9]{2})/i", "&#x\\1;", $str); 
		$str = str_replace('9u3iovBnRThju941s89rKozm', "%20", $str);						
		
		$str = @preg_replace_callback("/[a-z]+=([\'\"]).*?\\1/si", array($this, '_attribute_conversion'), $str);			 
		$str = @preg_replace_callback("/<([\w]+)[^>]*>/si", array($this, '_html_entity_decode_callback'), $str);			 
		$str = str_replace("\t", " ", $str);
		
		$bad = array(
						'document.cookie'	=> '[removed]',
						'document.write'	=> '[removed]',
						'.parentNode'		=> '[removed]',
						'.innerHTML'		=> '[removed]',
						'window.location'	=> '[removed]',
						'-moz-binding'		=> '[removed]',
						'<!--'				=> '&lt;!--',
						'-->'				=> '--&gt;',
						'<!CDATA['			=> '&lt;![CDATA['
					);

		foreach ($bad as $key => $val)
		{
			$str = str_replace($key, $val, $str);   
		}

		$bad = array(
						"javascript\s*:"	=> '[removed]',
						"expression\s*\("	=> '[removed]', // CSS and IE
						"Redirect\s+302"	=> '[removed]'
					);
					
		foreach ($bad as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);   
		}

		$str = str_replace(array('<?php', '<?PHP', '<?', '?'.'>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);


		$words = array('javascript', 'expression', 'vbscript', 'script', 'applet', 'alert', 'document', 'write', 'cookie', 'window');
		foreach ($words as $word)
		{
			$temp = '';
			for ($i = 0; $i < strlen($word); $i++)
			{
				$temp .= substr($word, $i, 1)."\s*";
			}
			
			$str = preg_replace('#('.substr($temp, 0, -3).')(\W)#ise', "preg_replace('/\s+/s', '', '\\1').'\\2'", $str);
		}		

		do
		{
			$original = $str;
			
			if ((version_compare(PHP_VERSION, '5.0', '>=') === TRUE && stripos($str, '</a>') !== FALSE) OR 
				 preg_match("/<\/a>/i", $str))
			{
				$str = @preg_replace_callback("#<a.*?</a>#si", array($this, '_js_link_removal'), $str);
			}
			
			if ((version_compare(PHP_VERSION, '5.0', '>=') === TRUE && stripos($str, '<img') !== FALSE) OR 
				 preg_match("/img/i", $str))
			{
				$str = @preg_replace_callback("#<img.*?".">#si", array($this, '_js_img_removal'), $str);
			}
			
			if ((version_compare(PHP_VERSION, '5.0', '>=') === TRUE && (stripos($str, 'script') !== FALSE OR stripos($str, 'xss') !== FALSE)) OR
				 preg_match("/(script|xss)/i", $str))
			{
				$str = preg_replace("#</*(script|xss).*?\>#si", "", $str);
			}
		}
		while($original != $str);
		
		unset($original);

		
		$event_handlers = array('onblur','onchange','onclick','onfocus','onload','onmouseover','onmouseup','onmousedown','onselect','onsubmit','onunload','onkeypress','onkeydown','onkeyup','onresize', 'xmlns');
		$str = preg_replace("#<([^>]+)(".implode('|', $event_handlers).")([^>]*)>#iU", "&lt;\\1\\2\\3&gt;", $str);		

		$str = preg_replace('#<(/*\s*)(alert|applet|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|layer|link|meta|object|plaintext|style|script|textarea|title|xml|xss)([^>]*)>#is', "&lt;\\1\\2\\3&gt;", $str);
		
		$str = preg_replace('#(alert|cmd|passthru|eval|exec|expression|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', "\\1\\2&#40;\\3&#41;", $str);							

		$bad = array(
						'document.cookie'	=> '[removed]',
						'document.write'	=> '[removed]',
						'.parentNode'		=> '[removed]',
						'.innerHTML'		=> '[removed]',
						'window.location'	=> '[removed]',
						'-moz-binding'		=> '[removed]',
						'<!--'				=> '&lt;!--',
						'-->'				=> '--&gt;',
						'<!CDATA['			=> '&lt;![CDATA['
					);

		foreach ($bad as $key => $val)
		{
			$str = str_replace($key, $val, $str);   
		}

		$bad = array(
						"javascript\s*:"	=> '[removed]',
						"expression\s*\("	=> '[removed]', // CSS and IE
						"Redirect\s+302"	=> '[removed]'
					);
					
		foreach ($bad as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);   
		}
		
		return $str;
	} 
}

/************************************************************************************************
				CLASE DE GESTIÓN DE FECHAS Y HORAS
************************************************************************************************/
class SIDTOOLDate 
{		
	/* FUNCIONES DE ADMINISTRACION DE FECHAS */
	function formatoFechaSql()
	{
		$output = '%d-%m-%Y %H:%i:%s';
		return $output;
	}	

	function time2Diff($dif)
	{
		$diff = floor($dif/(24*60*60));
		return $diff;
	}
	
	function resta_fechas($fecha1,$fecha2)
	{
		$fecha1 = explode(' ',$fecha1);
		$fecha2 = explode(' ',$fecha2);
		$fecha1 = str_replace('-','/',$fecha1[0]);        
		$fecha2 = str_replace('-','/',$fecha2[0]);    

		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
			list($dia1,$mes1,$ao1)=split("/",$fecha1);
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
			list($dia2,$mes2,$ao2)=split("/",$fecha2);		            

		$dif = mktime(0,0,0,$mes1,$dia1,$ao1) - mktime(0,0,0,$mes2,$dia2,$ao2);
		$ndias = ControladorFechas::time2Diff($dif);
		
		return($ndias);
	}	 
	
	function invertirFecha($fecha,$sep='-')
	{
		if(trim($fecha) == '')
			return $fecha;
		$hora='';
		$auxh=split(' ',$fecha);
		if(count($auxh) > 1)
		{
			$fecha = $auxh[0];
			$hora = " ".trim($auxh[1]);
		}			
		$aux = explode($sep,$fecha); 
		$fecha = $aux[2].$sep.$aux[1].$sep.$aux[0].$hora;  
 
		return $fecha;
	}
			
	function fechaActual($insert=true,$completa=true,$masXdias=0,$time=false)
	{
		global $HoraDiffServ; 
		$mkt = mktime(date("H")+ $HoraDiffServ , date("i"), date("s"), date("m")  , date("d")+$masXdias, date("Y"));
		
		if($time)
			return $mkt; 
		
		//si se solicita solo la fecha actual
		$hora ="";
		if($completa)
			$hora =" H:i:s"; 
			
		if($insert)
			$fecha = date('Y-m-d'.$hora,$mkt);
		else
			$fecha = date('d-m-Y'.$hora,$mkt);
		return $fecha;
	} 
	
	function obtenerFecha($fecha,$masXdias,$insert=true)
	{
		/* SI ES INSERT=TRUE EL FORMATO DE FECHA AAAA-MM-DD, SINO DD-MM-AAAA,
		POR LO Q SE DEBE INVERTIR, EL FORMATO DE SALIDA ES IGUAL AL DE ENTREDA, SEGUN EL CASO */
		
		if(!$insert)
			$fecha = ControladorFechas::invertirFecha($fecha);
			 
		$aux = split('-',$tmp[0]);  
		
		$mkt = mktime(0 , 0, 0, $aux[1]  , $aux[2]+$masXdias, $aux[0]);
		
		$nuevaFecha = date('Y-m-d',$mkt);
		 
		if(!$insert)
			$nuevaFecha = ControladorFechas::invertirFecha($nuevaFecha); 
			
		return $nuevaFecha;
	} 
	
	function obtenerDiaFecha($mkt)
	{
		return ControladorFechas::obtenerNombreDia(date('D',$mkt));
	}

	function fecha2Time($fecha='',$masDia=0)
	{			
		if(trim($fecha)=='')
			$fecha = ControladorFechas::fechaActual();

		$aux = split(' ',$fecha);
		
		$hora 	= '0:0:0';
		if(count($aux) > 1)
		{
			$fecha = $aux[0];
			$hora 	= $aux[1];
		}
		
		$aux = split('-', $fecha);
		$tmp = split('-', $hora);
		$time = mktime($tmp[0],$tmp[1],$tmp[2], $aux[1] , $aux[2]+$masDia, $aux[0]);
		//echo " ---- ".$fecha." ".$time." ---- ";
		return $time;
	}
	
	function fecha2Date($mkt,$masDia=0,$completa=false)
	{
		if($masDia != 0)
			$masDia = (24*60*60)*1.4;
					
		//echo " ".$masDia." ".$mkt." ";
		$mkt = $mkt + $masDia;
		//echo $mkt." ".date('Y-m-d h:m',$mkt)." ***** ";
		$hora = '';
		if($completa)
			$hora =" H:i:s";							
		return date('d-m-Y'.$hora,$mkt);
	}		
	
	function obtenerNombreDia($diaIngles)
	{
		switch ( $diaIngles)
		{
			case 'Tue':
				$dia = "Mar";
			break;
			case 'Wed':
				$dia = "Mie";
			break;
			case 'Thu':
				$dia = "Jue";
			break;
			case 'Fri':
				$dia = "Vie";
			break;
			case 'Sat':
				$dia = "Sab";
			break;
			case 'Sun':
				$dia = "Dom";
			break;
			case 'Mon':
				$dia = "Lun";
			break;			
		}
		return $dia;
	}
}
?>