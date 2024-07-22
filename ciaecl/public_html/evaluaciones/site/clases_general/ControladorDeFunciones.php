<?php
 
	class Funciones 
	{
		function generarTabla($output,$con_fila=true)
		{
			$total = count($output);
			$contenido = ''; 
			if(is_array($output) && $total > 0)
			{	   	 			
				$contenido = '<table border=1><tr>';
				if($con_fila)
				{
					$contenido .= "<td></td>";
				}				
				foreach($output[0] as $campo => $valor)
				{
					$contenido .= "<td><b>".$campo."</b></td>";
				}
				$contenido .= '</tr>';
				for($j=0; $j < $total; $j++)
				{
					$contenido .= "<tr>"; 
					$aux = $j + 1;
					if($con_fila)
					{
						$contenido .= "<td>".$aux."</td>";
					}
					foreach($output[$j] as $campo => $valor)
					{
						if(trim($valor) == '')
						{
							$valor = '&nbsp;';
						}
						$valor = strip_tags($valor);
						$contenido .= "<td>".$valor."</td>";
					}
					$contenido .= "</tr>";
				}
				$contenido .= "</table>";
			}
			return $contenido;
		}
		function redirect($u , $s = 0) 
		{
		    session_write_close();
		    if($s < 1)
		        header("Location: " . $u);
		    exit("
		        <meta http-equiv=\"refresh\"  content=\"{$s};url={$u}\"    >
		        <script>
		        function doRefresh() {
		            window.location = '{$u}';
		        }
		        doRefresh();
		        </script>
		    ");
		}	
		
		function getDV($r)
		{
			$s=1;
			for($m=0;$r!=0;$r/=10)
			{
				$s=($s+$r%10*(9-$m++%6))%11;
			}	
			return strtoupper(chr($s?$s+47:75));
		}
		
		function showErrorMsg($msg)
		{			
			global $ControlHtml; 	
			if(method_exists  ( $ControlHtml , 'showMensajeGuardarDatos'  ))
				$ControlHtml->showMensajeGuardarDatos('error',$msg); 
		}

		function generarKey($valor,$extenso=true)
		{
			$key = md5($valor.VarConfig::certkey_site);
			if(!$extenso)
			{
				$key = substr($key,0,VarSystem::largoKeygen());
			}
			return $key;
		} 

		function usuarioSinPermiso()
		{
			echo "<script>alert('No tiene permiso para acceder a este menú');</script>";  
		}

		function sesionCaducada($msg='Su sesión ha finalizado')
		{
			global $ControlHtml; 
			$url 	= VarConfig::path_site_www;
			$sitio	= VarConfig::sitio_www;
			$e 		= new miniTemplate(VarSystem::getPathVariables('dir_template').'general/sesioncaducada.tpl');
			$e->setVariable('mensaje_extra',$msg); 
			$e->setVariable('page_url_index', VarConfig::sitio_www_index);
			$e->setVariable('sitio',$sitio.'_admin'); 
			$e->setVariable('url',$url);   
			echo $e->toHtml();	 
			die();
		}
 
 		function formatoNumero($numero)
		{
			$numero = number_format($numero);
			$numero = str_replace(",",".",$numero);
			return $numero;
		} 
		
		function cleanHtml($input,$decode=false) 
		{ 
			if($decode)
			{ 
				$input = utf8_encode($input);				 
			} 
			$input = @htmlentities($input);    
			$input = str_replace(array("&lt;","&gt;",'&quot;','&amp;','&#039;'),array("<",">",'"','&',"'"),$input);
			$input = str_replace("<br>","<br />",$input);			
			return $input;
		}

		function br2nl($texto)
		{
			$texto = str_replace(array("<br>","<BR>","<BR />","<BR/>","<br/>"),array("<br />","<br />","<br />","<br />","<br />"),$texto);
			$texto = str_replace("<br />","\n",$texto);
			return $texto;
		}
		
		function LimpiarEspacios($texto)
		{
			$original   = array(" </strong>"," : "," ; "," , "," . "," ( "," ) "," ). ");
			$nuevo		= array("</strong> ",": ","; ",", ",". "," (",") ","). ");
			$texto = str_replace($original,$nuevo,$texto);
			return $texto;
		}
 
		function LimpiarSaltosLinea($texto,$exceso=false)
		{
			$texto = trim($texto);
			 
			$texto = str_replace(array("\t","\n","\n\r","\r","
",'
'),array(""," "," "," "," "," "),$texto);  
			 
			if($exceso)
			{
				$texto = str_replace("<br>","<br />",$texto);
				$texto = str_replace("<br /> ","<br />",$texto);
				$texto = str_replace("<br /><br />","<br />",$texto);
			}
			return trim($texto);
		}
		
		function textoSinHtml($str)
		{
			$str = html_entity_decode(strip_tags($str));
			return $str;			
		}
		
		function limpiarSaltoLinea($texto)
		{
			$texto = str_replace(array("\r","\n","
"),array(" "," "," "),$texto);
			return $texto;
		}

		function TextoSimple($texto,$html=false)
		{			  
			if(!is_array($texto))
			{
				$aux[0] = $texto;
			}	
			else
			{
				$aux = $texto; 
			}	
			for($i=0; $i < count($aux); $i++)
			{
				$texto 		= trim($aux[$i]);
				$texto 		= stripslashes($texto);
				$texto 		= str_replace('\\"','"',$texto); 
				$texto 		= str_replace('\"','"',$texto); 
				$texto 		= str_replace('\"','"',$texto); 
				//$texto 		= str_replace('\\','',$texto); 
				
				if($html)
				{ 
					$texto = Funciones::cleanHtml($texto);  
					$texto = str_replace(array("\n<br />","<br />\n","
<br/>","<br />
"),array("<br />","<br />","<br />","<br />"),$texto);
					 
					$texto = nl2br($texto); 				
				} 
				$texto = str_replace("><","> <",$texto);
				/*$texto = str_replace(array("\n","\n\r","\r","
",'
'),array(" "," "," "," "," "),$texto);*/ 
				$texto = trim($texto);
				$aux[$i] = $texto;
			}
			if(!is_array($texto))
			{
				$texto = $aux[0];
			}
			return $texto;	
		}  

		function send_mail($to, $body, $subject, $fromaddress, $fromname, $attachments=false)
		{
		  $eol="\r\n";
		  $mime_boundary = md5(time());

		  # Common Headers
		  $headers .= "From: ".$fromname."<".$fromaddress.">".$eol;
		  $headers .= "Reply-To: ".$fromname."<".$fromaddress.">".$eol;
		  $headers .= "Return-Path: ".$fromname."<".$fromaddress.">".$eol;    // these two to set reply address
		  $headers .= "Message-ID: <".time()."-".$fromaddress.">".$eol;
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

		function sendEmail($usuario,$asunto='',$mensaje,$bcc_send=false,$es_masivo=false,$bcc_extra='',$replay_to='')
		{		
			sleep(1);
			$email_webmaster 		= VarSystem::getInfoSystem('email_contacto');
			$email_webmaster_bcc 	= VarSystem::getInfoSystem('email_webmaster');
			$email_webmaster_bcc2 	= VarSystem::getInfoSystem('email_contacto_bcc');
			global $arroba_email ;
			$siteTitle = VarSystem::getInfoSystem('title'); 
 
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	 
			$cabeceras .= 'From: '.$siteTitle['firm'].VarConfig::versionSitio.' <'.$email_webmaster.'>' . "\r\n";
			if(trim($replay_to) == '')
			{
				$cabeceras .= 'Reply-To: '.$siteTitle['firm'].VarConfig::versionSitio.' <'.$email_webmaster.'>' . "\r\n";
			}
			else
			{
				$cabeceras .= 'Reply-To: '.$siteTitle['firm'].VarConfig::versionSitio.' <'.$replay_to.'>' . "\r\n";
			}
			$cabeceras .= "Message-ID: <".time()."-".$email_webmaster.">"."\r\n";
			$cabeceras .= "X-Mailer: PHP v".phpversion()."\r\n";
			$cabeceras .= 'Bcc: '.$email_webmaster_bcc;
			$bcc = $email_webmaster_bcc;
			if(trim($bcc_extra) != '')
			{
				$cabeceras .= ', '.$bcc_extra;
			}
			if($bcc_send)
			{
				$cabeceras .= ', '.$email_webmaster_bcc2;
				$cabeceras .= ', '.$email_webmaster;
				$bcc .= ', '.$email_webmaster_bcc2;
				$bcc .= ', '.$email_webmaster;					
			}
			$cabeceras .= "\r\n";	 
  
			$asunto 	= Funciones::TextoSimple(trim($asunto)." - ".$siteTitle['completo']);  
			
			$para 		= html_entity_decode(Funciones::TextoSimple($usuario));  
			
			$FormGeneral = new FormGeneral();
			$mensaje .= $FormGeneral->pieEmail($siteTitle['firm'],$siteTitle['completo'],VarConfig::path_site_www);
			 
			$mensaje = Funciones::TextoSimple($mensaje,true);
			$mensaje = str_replace(">",">\n\r",$mensaje); 
	 		$asunto  = html_entity_decode($asunto);
   
			if(!VarConfig::estadoDebug)
			{
				//@mail($para, $asunto, $mensaje, $cabeceras); 
				
				Funciones::sendEmialLogin( $para, $asunto, $mensaje);
				/* SOLO SE ENVIARÁ SI ES EL SITIO DE PRODUCCION*/
			}	
			else
			{
				//Funciones::sendEmialLogin( $para, $asunto, $mensaje);
				Funciones::mostrarArreglo(array($para, $asunto, $mensaje, $cabeceras));
			} 
		}
		
		function sendEmialLogin( $para, $asunto, $mensaje)
		{  
			/* REVISION DE ENVIO DESDE CUENTAS WEBMASTER */
			$ControlEnvioWebmaster = new ControlEnvioWebmaster();
			$email_webmaster_send	= $ControlEnvioWebmaster->emailParaEnvio(); //	VarConfig::site_email_send;  
			Funciones::mostrarArreglo($email_webmaster_send);
			require_once(VarSystem::getPathVariables('path_libs').'/PHPMailer-master/class.phpmailer.php');

			$phpmailer          = new PHPMailer(); 
			$to = $para; 
			$email_webmaster 		= VarSystem::getInfoSystem('email_contacto'); 
			$phpmailer->IsSMTP(); // telling the class to use SMTP
			$phpmailer->Host       = VarConfig::site_email_send_server; // SMTP server
			$phpmailer->SMTPAuth   = true;                  // enable SMTP authentication
			$phpmailer->Port       = VarConfig::site_email_send_port;          // set the SMTP port for the GMAIL server; 465 for ssl and 587 for tls
			$phpmailer->Username   = $email_webmaster_send; // Gmail account username
			$phpmailer->Password   = VarConfig::site_email_send_pass;        // Gmail account password
			$phpmailer->AddReplyTo($email_webmaster,   VarConfig::site_title);
			$phpmailer->AddBCC($email_webmaster, VarConfig::site_title); 
			//$phpmailer->AddBCC($email_webmaster_send, VarConfig::site_title); 
			$phpmailer->SetFrom($email_webmaster_send, VarConfig::site_title);  
			
			$phpmailer->AddAddress($to, $to);
			$phpmailer->Subject    = $asunto;
			$phpmailer->MsgHTML($mensaje);
			
			
			if(!$phpmailer->Send()) 
			{
 			  //echo "Mailer Error: " . $phpmailer->ErrorInfo;
 			  return false;
 			} 
			 else 
			{
				$ControlEnvioWebmaster->agregarNuevoEnvio($email_webmaster_send);		
 			  //echo "Message sent!";
 			  return true;
 			}
		}	

		function pie_email()
		{
			
		}

		function cleanLastSql($str)
		{
			$str = html_entity_decode($str);
			$str = addslashes($str);
			return $str;
		}
				
		function  cleanSqlInjection($str) 
		{	  
			$str = addslashes($str);
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
		 
		function cleanChar($str)
		{		
			$str 		= trim($str);
			$str 		= str_replace(' ','_',$str);
			$search 	= array(".","á","é","í","ó","ú","ñ","'",'"',"Á","É","Í","Ó","Ú","Ñ"); 
 			$replace 	= array("_","a","e","i","o","u","n","",'',"A","E","I","O","U","N");
			$str 		= str_replace($search,$replace,$str);
			return $str;		
		}  
		 
		function cleanCharURL($str)
		{		
			$str 		= trim($str); 
			$search 	= array("á","é","í","ó","ú","ñ","'",'"',"Á","É","Í","Ó","Ú","Ñ"); 
 			$replace 	= array("a","e","i","o","u","n","",'',"A","E","I","O","U","N");
			$str 		= str_replace($search,$replace,$str);
			$str 		= rawurlencode($str);
			return $str;		
		} 
		 
		function textToTitle($text)
		{		      
			return SIDTOOLHtml::textToTitle($text);
		} 
		
		function invertirCadena($str)
		{
			$nstr = '';
			for($i=0;$i<strlen($str);$i++)
			{
			   $char = substr($str,$i,1);
			  
			   $nstr = $char.$nstr;
			}
			return $nstr;			
		}
		
		function obtenerArregloHoras()
		{			
			$Horas=array();
			for($i=0 ; $i <= 23 ; $i++)
			{
				$prefijo='';
				if($i < 10)
					$prefijo='0';			
				$Horas[]['hora']=$prefijo.$i.':00';
				$Horas[]['hora']=$prefijo.$i.':15';
				$Horas[]['hora']=$prefijo.$i.':30';
				$Horas[]['hora']=$prefijo.$i.':45';
			}
			return $Horas;
		} 

		function registroModificacionBase($tipo,$sql)
		{
			$save_log 	= false;
			$aux 		= $sql;			
			$aux 		= str_replace('common_logs','',trim($sql)); 
 			
			if(trim($aux) == trim($sql)) 
			{
				if($tipo == 'sql-*')
				{
					$aux2 = explode(' ',$sql);
					$aux3 = strtoupper(trim($aux2));
					if($aux3 == 'SELECT')
					{
						return false;
					}
					else
					{
						$tipo = 'sql-'.strtolower($aux3);
					}
				}
				//echo "<br><br>".$tipo.' '.$sql."<br><br>"; 
				switch($tipo)
				{ 
					case 'sql-update':
						$aux = str_replace('UPDATE ate_','',trim($sql));
					break;
					case 'sql-delete':
						$aux = str_replace('DELETE FROM ate_','',trim($sql));
					break;  
					default:
						$aux = str_replace('INTO ate_','',trim($sql));
					break;
				} 
				if(trim($aux) != trim($sql))
				{	
					$ControlLogs 		= new ControlLogs();				
					$ControlLogs->setLog($tipo,$_SESSION['userName'],$sql);	
					if(VarConfig::estadoDebugSQLModify)
					{
						Funciones::mostrarArreglo(" DEBUGSQL: ".$sql); 
					}
				} 
			}
		}
		
		function mostrarArregloTitulo($arreglo,$titulo)
		{
			Funciones::mostrarArreglo($arreglo,false,$titulo);
		}
		 		
		function mostrarArreglo($arreglo,$imprimir=false,$titulo='')
		{	 	
			if(is_array($arreglo) || is_object($arreglo))
			{
				if(trim($titulo) != '')
				{
					$titulo = '-------------'.strtoupper($titulo).'---------------';
					$arreglo = array($titulo,$arreglo);
				}
				
				$salida = " 	<left><pre style='text-align:left;width:1500px' class='div_debug'>";
				$salida .= print_r($arreglo,true);
				$salida .= "</pre></left> ";	
			}
			else
			{
				$aux = explode('common_logs',$arreglo);
				if(count($aux) > 1)
				{
					return ;
				}	
				$arreglo = str_replace(array(",","	"),array(", "," "),$arreglo);
				$salida  = " <pre style='text-align:left;width:1500px' class='div_debug'>		 ";
				$salida .= print_r($arreglo,true);
				$salida .= " </pre> ";	 
			}   
		 	
			if($imprimir && VarConfig::estadoDebug)
			{
				echo $salida;	
			}
			else
			{
				global $indexOutput;
				$indexOutput .= $salida;
			} 
		}		
		
		function obtenerListaArchivos($dir,$p=true,$recursivo=true) 
		{
	        $d 	= dir($dir);
			$x	= array(); 
	        while (false !== ($r = $d->read())) 
			{
	            if($r!="." && $r!=".." && (($p==false&&is_dir($dir.$r))||$p==true) && $r != '.svn') 
				{
	                $x[$r] = (is_dir($dir.$r)?array():(is_file($dir.$r)?true:false));
	            }
	        }
	        foreach ($x as $key => $value) 
			{
	            if (is_dir($dir.$key."/") && $recursivo) 
				{
	                $x[$key] = Funciones::obtenerListaArchivos($dir.$key."/",$p);
	            }
	        }
	        ksort($x);
	        return $x;
		}

		function transformarArreglo($arreglo,$llave)
		{
			$nuevoArreglo = array();
			for($i=0; $i < count($arreglo) ; $i++)
				$nuevoArreglo[$arreglo[$i][$llave]] = $arreglo[$i];			
			return $nuevoArreglo;
		} 
		
		function transformacionContenidoHtml($contenido)
		{			
			$contents = "";
			if(trim($contenido)=='')
				return $contents;
			$body_contenido = str_replace('\"','"',$contenido);
			$aux = str_replace('<?','";',$body_contenido);
			if(trim($aux) != trim($body_contenido))
			{			
				$body_contenido = 'echo "'.$aux;	
				$body_contenido = str_replace('?>','echo "',$body_contenido);	
				$body_contenido = str_replace('\"','"',$body_contenido).'";';	
				ob_start();
				eval($body_contenido);
				$contents = ob_get_contents();
				ob_end_clean();				
			}
			else
				$contents = $body_contenido;
				
			return $contents;
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
	} 

	/************************************************************************************************
					CLASE DE GESTIÓN DE FECHAS Y HORAS
	************************************************************************************************/
	class ControladorFechas 
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

		function diasDiferencia($date1,$date2='')
		{
			if(trim($date2) == '')
			{
				$date2 = ControladorFechas::fechaActual(true,true,0,true);
			}
			/* SE ASUME QUE ESTAN EN FORMATO TIMESTAMP */
			if($date1 >= $date2)
				$resta = $date1 - $date2;
			else				
				$resta = $date2 - $date1;
			$dias	=	ceil($resta/3600/24); 
			//echo "$date1 $date2 resta: $resta dias $dias\n".$resta/3600/24;
			return $dias;
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
			$aux 	= explode($sep,$fecha);  
			$fecha	= $aux[2].$sep.$aux[1].$sep.$aux[0].$hora;  	 
			return $fecha;
		}
				
		function fechaActual($insert=true,$completa=true,$masXdias=0,$time=false)
		{ 
			$mkt = mktime(date("H")+ VarConfig::HoraDiffServ , date("i"), date("s"), date("m")  , date("d")+$masXdias, date("Y"));			
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
 
		/* EL FORMATO DE LA FECHA DEBE SER AAAA-MM-DD */
		function fecha2Time($fecha='',$masDia=0)
		{			
			if(trim($fecha)=='')
				$fecha = ControladorFechas::fechaActual();
			$aux = split(' ',$fecha);
			
			$hora 	= '0:0:0';
			if(count($aux) > 1)
			{
				$fecha 	= $aux[0];
				$hora 	= $aux[1];
			}
			
			$aux = split('-', $fecha);
			$tmp = split('-', $hora);
		/* 	int mktime  ([ int $hora  [, int $minuto  [, int $segundo  [, int $mes  [, int $dia  [, int $anyo  [, int $es_dst  ]]]]]]] ) */
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
			{
				$hora =" H:i:s";
			} 
			
			$mkt = mktime(date("H",$mkt)+ VarConfig::HoraDiffServ , date("i",$mkt), date("s",$mkt), date("m",$mkt)  , date("d",$mkt), date("Y",$mkt));										
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
		
		function entregarMes($id_mes,$lang='es')
		{
			$aux = $id_mes-1;
			if(trim($lang) == '')
			{
				$lang='es';
			}
			$espanol 	= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$ingles 	= array('January','February','March','April','May','June','July','August', 'September', 'October', 'November', 'December');
			if($lang == 'es')
			{
				return $espanol[$aux];
			}
			else
			{
				return $ingles[$aux];
			}
		}
		
		function entregarDia($fecha)
		{
				$Dia=explode(" ", $fecha);
				
				return $Dia[0];
		
		}
		
		function entregarMesAbrev($fecha,$lang='es')
		{
			$Mes=explode(" ", $fecha);
			$lang='es';
			if($lang == 'es')
			{
				if ($Mes[2]=='January') $Mes='Ene';
				if ($Mes[2]=='February') $Mes='Feb';
				if ($Mes[2]=='March') $Mes='Mar';
				if ($Mes[2]=='April') $Mes='Abr';
				if ($Mes[2]=='May') $Mes='May';
				if ($Mes[2]=='June') $Mes='Jun';
				if ($Mes[2]=='July') $Mes='Jul';
				if ($Mes[2]=='August') $Mes='Ago';
				if ($Mes[2]=='September') $Mes='Sep';
				if ($Mes[2]=='October') $Mes='Oct';
				if ($Mes[2]=='November') $Mes='Nov';
				if ($Mes[2]=='December') $Mes='Dic';
			}
			else
			{
				$Mes=$Mes[2];
			}
			return $Mes;
		}
		
		function traducirMes($texto,$traduccion='en-es')
		{ 
			if(VarSystem::obtenerIdiomaActual() == 'en')
			{
				return $texto;
			}
			Funciones::mostrarArreglo($texto);
			$espanol = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$ingles = array('January','February','March','April','May','June','July','August', 'September', 'October', 'November', 'December');
			if(is_array($texto))
			{
				$total = count($texto);
				for($i=0; $i < $total; $i++)
				{
					foreach($texto[$i] as $var => $val)
					{
						if($traduccion == 'es-en')
						{
							$texto[$i][$var] = str_replace($espanol,$ingles,$val); 
						}
						else
						{
							$texto[$i][$var] = str_replace($ingles,$espanol,$val);
						}
					}

				}
			}
			else
			{
				if($traduccion == 'es-en')
				{
					$texto = str_replace($espanol,$ingles,$texto);
				}
				else
				{
					$texto = str_replace($ingles,$espanol,$texto);
				}
			}
			Funciones::mostrarArreglo($texto);
			return $texto;
		}
	}
?>