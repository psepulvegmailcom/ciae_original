<title>Envio Correos personalizados</title>
<pre>
<?php

  //die();

$tiempo_refresh = 300; /*segundos refresh   */
$tiempo_con_envio  = 3; /*segundos refresh para reenviar en caso de que hayan pendientes  */
$total_enviar = 2; /* destinatarios por vez */
  
  

 
$total_enviar = 5;
$total_enviar = rand(10,15);
$total_enviar = rand(15,20);
$total_enviar = rand(25,30);
//$total_enviar = 5;
$con_certificado = FALSE;
require_once("config/conexion.php");  
 
 

$funciones = new FuncionesGenerales();    


$envioCorreo = new envioCorreo();

$envioCorreo->activarEnvioFecha();
$envioCorreo->desactivarEnvioFecha();

if(ESTADO_PRUEBA)
{
    $envioCorreo->casoPruebaTest(ESTADO_PRUEBA_CASO);	 
} 
 
$destinatarios = $envioCorreo->obtenerListadoDestinatarios($total_enviar); 


$remitentes = $envioCorreo->obtenerRemitentes($total_enviar);
print_r($remitentes);
 //INICIO BLOQUE ENVIO

if(is_array($destinatarios) && count($destinatarios)>0)
{ 	
	$tiempo_refresh = $tiempo_con_envio;
	echo "TOTAL_ENVIAR ".$total_enviar."<br>";

	
    print_r($destinatarios);
	
	$i = 0;
	
	for($i=0; $i < count($destinatarios);$i++)
	{	
	
		echo "\n$i ENVIAR-01 ".date('h:i:s') . "\n";

		// sleep for 10 seconds
		//sleep(2);
 
		
		/**
		 * This example shows settings to use when sending via Google's Gmail servers.
		 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
		 */

		//SMTP needs accurate times, and the PHP time zone MUST be set
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('Etc/UTC');

		//require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';

		//Create a new PHPMailer instance
		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		//$mail->Host = 'smtp.gmail.com';
		$mail->Host = HOST_REMITENTE;
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		switch($destinatarios[$i]['tipo_remitente'])
		{
			case 'POSTGRADO':			
				$mail->Username = USERNAME_REMITENTE_POSTGRADO;
				$mail->Password = PASSWORD_REMITENTE_POSTGRADO;
				$nombre_remitente = NOMBRE_REMITENTE_POSTGRADO;			
			break;
			case 'LAB':			
				$mail->Username = USERNAME_REMITENTE_LAB;
				$mail->Password = PASSWORD_REMITENTE_LAB;
				$nombre_remitente = NOMBRE_REMITENTE_LAB;			
			break;
			default:
				//Username to use for SMTP authentication - use full email address for gmail
				//$remitentes_random = rand(1,2);				

				/*$remitentes = array(USERNAME_REMITENTE1,USERNAME_REMITENTE2,USERNAME_REMITENTE3,USERNAME_REMITENTE4,USERNAME_REMITENTE5,USERNAME_REMITENTE6,USERNAME_REMITENTE7,USERNAME_REMITENTE8,USERNAME_REMITENTE9,USERNAME_REMITENTE10,USERNAME_REMITENTE11,USERNAME_REMITENTE12,USERNAME_REMITENTE13,USERNAME_REMITENTE14,USERNAME_REMITENTE15,USERNAME_REMITENTE16,USERNAME_REMITENTE17,USERNAME_REMITENTE18,USERNAME_REMITENTE19,USERNAME_REMITENTE20,USERNAME_REMITENTE21,USERNAME_REMITENTE22,USERNAME_REMITENTE23,USERNAME_REMITENTE24,USERNAME_REMITENTE25,USERNAME_REMITENTE26,USERNAME_REMITENTE27,USERNAME_REMITENTE28,USERNAME_REMITENTE29,USERNAME_REMITENTE30,USERNAME_REMITENTE31,USERNAME_REMITENTE32,USERNAME_REMITENTE33,USERNAME_REMITENTE34,USERNAME_REMITENTE35,USERNAME_REMITENTE36,USERNAME_REMITENTE37,USERNAME_REMITENTE38,USERNAME_REMITENTE39,USERNAME_REMITENTE40);  
				
				$remitentes_extra = $remitentes;
				  
				$remitentes = array_merge($remitentes, $remitentes_extra);*/				
								
								
				$remitentes_random = rand(0,count($remitentes)-1); //incluye infor2
				$remitentes_random = rand(0,count($remitentes)-1); //incluye infor2
				
				$mail->Username = $remitentes[$remitentes_random];
				echo "\n\n\nREMITENTE ".$remitentes[$remitentes_random]." ".$remitentes_random."\n\n\n";
				$mail->Password = PASSWORD_REMITENTE;
				$nombre_remitente = NOMBRE_REMITENTE;
				switch($destinatarios[$i]['tipo_remitente'])
				{
					case 'CIAE':
						$nombre_remitente = NOMBRE_REMITENTE_CIAE;
					break;
					case 'IE':
						$nombre_remitente = NOMBRE_REMITENTE_IE;
					break;
					default:
						$nombre_remitente = NOMBRE_REMITENTE;        
					break;
				}
			break;
		}
		
		
		if(trim($destinatarios[$i]['adjunto']) != '')
		{
			$dir = "/home/ciae/public_html/correos/adjuntos/";
			$aux = explode('|',trim($destinatarios[$i]['adjunto']));
			print_r($aux);
			for($j=0;$j < count($aux);$j++)
			{
				if(file_exists($dir.$aux[$j]))
				{
					$mail->addAttachment($dir.$aux[$j],$aux[$j]);
				}
			}
		}

		$destinatarios[$i]['remitente'] = $mail->Username;
		//Set who the message is to be sent from 
		$mail->setFrom( $mail->Username, $nombre_remitente);

		//Set an alternative reply-to address
		$mail->addReplyTo($destinatarios[$i]['reply'], $destinatarios[$i]['reply']);
	   // $mail->addReplyTo(USERNAME_REPLYTO_2, NOMBRE_REPLYTO_2);

		//Set who the message is to be sent to
		//$mail->addAddress('paulina.sepulveda@ciae.uchile.cl', 'John Doe');
		$mail->addAddress($destinatarios[$i]['email'], utf8_decode($destinatarios[$i]['nombre']." ".$destinatarios[$i]['apellidos'])); 
		
		
		if(trim($destinatarios[$i]['email_secundario']) != '')
		{ 
			$mail->addCc($destinatarios[$i]['email_secundario'], utf8_decode($destinatarios[$i]['nombre']." ".$destinatarios[$i]['apellidos']));
		}   

		//$mail->addAddress('psepulve@gmail.com', 'John Doe');

		if(!ESTADO_PRUEBA)
		{
			if(trim($destinatarios[$i]['bcc_2']) != '')
			{ 
				$mail->addBcc($destinatarios[$i]['bcc_2'], $destinatarios[$i]['bcc_2']);
			}
			if(trim($destinatarios[$i]['bcc_1']) != '')
			{ 
				$mail->addBcc($destinatarios[$i]['bcc_1'], $destinatarios[$i]['bcc_1']);
			}
			if(trim($destinatarios[$i]['cc_1']) != '')
			{ 
				$mail->addCc($destinatarios[$i]['cc_1'], $destinatarios[$i]['cc_1']);
			}   
			if(trim($destinatarios[$i]['cc_2']) != '')
			{ 
				$mail->addCc($destinatarios[$i]['cc_2'], $destinatarios[$i]['cc_2']);
			}   
		}


		 //$mail->addCc(USERNAME_REPLYTO_2, NOMBRE_REPLYTO_2);

		//Set the subject line

		if(ESTADO_PRUEBA)
		{
			$destinatarios[$i]['asunto'] = "[MODO TEST][PARA VB] ".$destinatarios[$i]['asunto'];
		}
		//$mail->Subject = $destinatarios[$i]['asunto'];
		$mail->Subject = utf8_decode($destinatarios[$i]['asunto']);

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		// 
		
		if(trim($destinatarios[$i]['contenido']) == '')
		{
			$body = file_get_contents('templates/'.$destinatarios[$i]['caso_envio'].'.html');
			
			
			
			
		}
		else
		{  
			$body = $destinatarios[$i]['contenido'];
			
			
			
			$aux_body = file_get_contents($destinatarios[$i]['contenido']);
			
			if(trim($aux_body) != '')
			{
				$body = trim($aux_body);
				
				/* 
				$id_correo_file = array_pop(str_replace(".html","",explode("/",$destinatarios[$i]['contenido']))); 
				$registro = ' <img 1="" src="https://www.ciae.uchile.cl/imageview.php?externo=vistas_'.$id_correo_file.'_{id_md5}&ci={id_md5}&cs=imagen&cm='.$destinatarios[$i]['caso_envio'].'&image=noticias/blanco.jpg" width="1 height=" /> </span></p>';
				$body = str_replace(array( '<img 1="" src="https://www.ciae.uchile.cl/imageview.php?externo=vistas','&image=noticias/blanco.jpg" width="1 height=" /> </span></p>'),array( '<!-- <img 1="" src="https://www.ciae.uchile.cl/imageview.php?externo=vistas','&image=noticias/blanco.jpg" width="1 height=" /> </span></p> -->'.$registro),$body);
				*/
				
				
				
			} 
		}		
		
		$header_file = 'templates/header-'.$destinatarios[$i]['tipo_remitente'].'.html';
		$header_html = '';
		if(file_exists($header_file))
		{
			$header_html = file_get_contents($header_file);
		}
		
		$header_html = str_replace("{correo_md5}",md5($destinatarios[$i]['email']),$header_html);	 
		$header_html = str_replace("{id_md5}",md5($destinatarios[$i]['caso_envio']),$header_html);
		$body = str_replace("{header_texto}",$header_html,$body); 
		
		$pie_file = 'templates/pie-'.$destinatarios[$i]['tipo_remitente'].'.html';
		$pie_ie = '';
		echo $pie_file;
		if(file_exists($pie_file))
		{
			$pie_ie = file_get_contents($pie_file);
		}
		$pie_ie = str_replace("{email}",$destinatarios[$i]['email'],$pie_ie);	
		
		if($destinatarios[$i]['tipo'] == 'automatico')
		{
			$datos_genericos =  $envioCorreo->obtenerInformacionDetalle($destinatarios[$i]['caso_envio']);
			//print_r($datos_genericos); 
			$datos_genericos[0]['nombre'] = stripslashes($datos_genericos[0]['nombre']);
			$datos_genericos[0]['nombre'] = str_replace('\\"','"',$datos_genericos[0]['nombre']);
			$body = str_replace("{asunto}",htmlentities(html_entity_decode($datos_genericos[0]['nombre'])),$body);
			$body = str_replace("{date_texto}",htmlentities($datos_genericos[0]['date_texto']),$body);
			$body = str_replace("{date_texto_email}",utf8_decode(html_entity_decode(htmlentities(trim($datos_genericos[0]['date_texto_email'])))),$body);
			$body = str_replace("{id_noticia}",$datos_genericos[0]['id_noticia'],$body); 
			$body = str_replace("{certificado_fec}",htmlentities($datos_genericos[0]['certificado_fec']),$body); 
			$body = str_replace("{ubicacion}", utf8_decode(html_entity_decode(htmlentities(trim($datos_genericos[0]['ubicacion'])))),$body); 
			$body = str_replace("{ubicacion_email}",  utf8_decode(html_entity_decode(htmlentities(trim(str_replace('\"','"',$datos_genericos[0]['ubicacion_email']))))),$body);	
			$body = str_replace("{ubicacion_email_online}",  utf8_decode(html_entity_decode(htmlentities(trim(str_replace('\"','"',$datos_genericos[0]['ubicacion_email_online']))))),$body);			
			$body = str_replace("{mensaje_extra_notificacion}",$datos_genericos[0]['mensaje_extra_notificacion'],$body);			
		}
		
		$aux_caso_envio =  explode("_",$destinatarios[$i]['caso_envio']); 
		if(array_pop($aux_caso_envio) == 'certificado')
		{ 
			$generarCertificado = new generarCertificado();
			$archivo_certificado = $generarCertificado->generarCertificadoPDF($destinatarios[$i]['nombre']." ".$destinatarios[$i]['apellidos'],$destinatarios[$i]['email'],$destinatarios[$i]['caso_envio'],$datos_genericos[0]['nombre'],$datos_genericos[0]['certificado_fec'],REPOSITORIO_CERTIFICADOS);
			$con_certificado = TRUE;
			$mail->addAttachment($archivo_certificado);			
		}
		
		if(trim($destinatarios[$i]['tratamiento']) == '')
		{
			$destinatarios[$i]['tratamiento'] = 'o/a';
		}
		//echo 'templates/pie-'.$destinatarios[$i]['tipo_remitente'].'.html'.$pie_ie."piepie";
		//$body = str_replace("{pie_texto}",$pie_ie,$body);
		$body = str_replace("{pie_texto}",'',$body);
		//$destinatarios[$i]['nombre'] = utf8_decode($destinatarios[$i]['nombre']);
		//$destinatarios[$i]['apellidos'] = utf8_decode($destinatarios[$i]['apellidos']);
		$body = str_replace("{nombre}",htmlentities($destinatarios[$i]['nombre']),$body);
		$body = str_replace("{apellido}",htmlentities($destinatarios[$i]['apellidos']),$body);
		$body = str_replace("{nombre_limpio}",trim(str_replace(" ","+",$destinatarios[$i]['nombre'])),$body);
		$body = str_replace("{apellidos_limpio}",trim(str_replace(" ","+",$destinatarios[$i]['apellidos'])),$body);
		$body = str_replace("{tratamiento}",$destinatarios[$i]['tratamiento'],$body);
		$body = str_replace("{email}",$destinatarios[$i]['email'],$body);	  
		$body = str_replace("{email_md5}",md5(trim($destinatarios[$i]['email'])),$body);	  
		$body = str_replace("{cargo}",htmlentities($destinatarios[$i]['cargo']),$body);
		$body = str_replace("{mensaje}",htmlentities($destinatarios[$i]['mensaje']),$body); 
		
		$body = str_replace("Estimado(a) <strong></strong>","Estimado(a) <strong>".htmlentities($destinatarios[$i]['nombre'])." ".htmlentities($destinatarios[$i]['apellidos'])."</strong>",$body);
		  	 	  	 
		$body = str_replace("externo=email_registro","externo=registro_{correo_md5}_{id_md5}",$body); 
		$body = str_replace("externo=email_confirmacion","&externo=confirmacion&",$body);	 
		$body = str_replace("externo=email","externo=email_{correo_md5}_{id_md5}",$body);		
		$body = str_replace("externo=vistas","externo=vistas_{correo_md5}_{id_md5}",$body);		
		$body = str_replace("externo=incidencia","externo=incidencia_{correo_md5}_{id_md5}",$body);	
		$body = str_replace('externo=boletin','externo=boletin_{correo_md5}_{id_md5}',$body);		 
		$body = str_replace("externo=maillist","externo=maillist_{correo_md5}_{id_md5}",$body); 
		$body = str_replace("externo=boletinenfoco","externo=boletinenfoco_{correo_md5}_{id_md5}",$body); 
		$body = str_replace("externo=boletinofd","externo=boletinofd_{correo_md5}_{id_md5}",$body); 
		$body = str_replace("{correo_md5}",md5($destinatarios[$i]['email']),$body);	 
		$body = str_replace("{id_md5}",md5($destinatarios[$i]['caso_envio']),$body);			 
		 
		$pie_ie = str_replace("{correo_md5}",md5($destinatarios[$i]['email']),$pie_ie);	 
		$pie_ie = str_replace("{id_md5}",md5($destinatarios[$i]['caso_envio']),$pie_ie);
		
		  
		$body = $body.$pie_ie ;
		
		$mail->msgHTML($body, dirname(__FILE__));

		//Replace the plain text body with one created manually
		$mail->AltBody = 'Correo informativo';

		//Attach an image file
		//$mail->addAttachment('salida.txt');

		//send the message, check for errors
		echo "\n$i ENVIAR-02 ".date('h:i:s') . "\n";
		if (!$mail->send()) 
		{
			
			$fichero = '/home/ciae/public_html/correos/output_failed.txt'; 
			$actual = "\n\nFailed ".$destinatarios[$i]['remitente']." ".date('Y-m-d h:i:s');
			$actual .= "\nMailer Error: " . $mail->ErrorInfo;
			
			$actual .= file_get_contents($fichero);  
			file_put_contents($fichero, $actual);
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
			echo "Message sent!";

			//$actual = "\n\nSend ".$destinatarios[$i]['remitente']." ".date('Y-m-d h:i:s'); 
			$envio_estado_salida = true;
			$veces = 0;
			while($envio_estado_salida)
			{ 
				if($veces > 5)
				{
					die();
				}
				if($envioCorreo->marcarEnviadoCorreo($destinatarios[$i]['caso_envio'],$destinatarios[$i]['email'],$destinatarios[$i]['remitente']))				
				{
					//se envio y guardo en BD
					$envio_estado_salida = false;
					echo "\n\n*****CORRECTO UPDATE DE ENVIO ".$veces." ".$destinatarios[$i]['caso_envio']." ".$destinatarios[$i]['email']." ".$destinatarios[$i]['remitente']."\n\n\n";	
				}
				else
				{
					/* caso de no guardar cambio*/
					echo "\n\n*****ERROR UPDATE DE ENVIO ".$veces." ".$destinatarios[$i]['caso_envio']." ".$destinatarios[$i]['email']." ".$destinatarios[$i]['remitente']."\n\n\n";	
					$veces++;					
				}
				/*$estado_salida = $envioCorreo->obtenerEstadoEnviadoCorreo($destinatarios[$i]['caso_envio'],$destinatarios[$i]['email']);
				print_r($estado_salida);
				if($estado_salida[0]['estado'] == 'no_enviado') */
				
			}
			
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
	}
} //CIERRE BLOQUE ENVIO

if(ESTADO_PRUEBA)
{
    $envioCorreo->casoPruebaTestCierre(ESTADO_PRUEBA_CASO); 
	$envioCorreo->unificacionBasesLimpieza();	
	$tiempo_refresh = 1200;
}

			
					
$caso_limpieza_aleatorio = rand(0,100);
if($caso_limpieza_aleatorio%2 == 0)
{
	/*SE EJECUTA ALEATORIMENTE */
	$envioCorreo->eliminarCasoPruebaTest();
	
	$hora = date("G");
	//echo $hora."jjjsjsjsj";
	if($hora > 2 && $hora < 3) /* para que se ejecute en horario no habiles*/
	{
		echo "\n ejecucion limpieza hora ".$hora." \n";
		$envioCorreo->unificacionBasesLimpieza();
	}
	
	// 
}

?>
</pre> 


  <META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $tiempo_refresh;?>;URL=envioCorreo.php?u=e889760b9a85dc871b2052565fd1147c"></META>  