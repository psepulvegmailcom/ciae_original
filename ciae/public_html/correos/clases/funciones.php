<?php


class FuncionesGenerales
{
	function outputDebugAlerta($texto='',$titulo='',$caso='alerta')
	{
		$this->outputDebug($texto,$titulo,$caso);
	}
	
	
	function retrasarEjecucion($segundos=3)
	{		
		$this->outputDebug("retraso de ".$segundos." segundos","retraso ejecución",'alerta');
		sleep($segundos);
	}
	 
	function outputDebug($texto='',$titulo='',$caso='normal')
	{
		$color ="#ECECEC";
		if($caso == 'alerta')
		{
			$titulo = "REVISON-IMPORTANTE: ".$titulo;
			$color = "#EC222C";
			
		}
		echo "\n<pre>\n<div style=\"background-color: ".$color."; padding: 15px 30px 15px 30px;margin:5px 30px 5px 30px; \">\n\n";
		//echo "************************************************************************<br />";
		if(trim($titulo) != '')
		{
			echo "\n\n<b>**********************************".strtoupper($titulo)."**********************************</b>\n\n";
			
		}
		if(is_array($texto))
		{				
			print_r($texto);
		}
		else
		{
			if(is_string($texto) && trim($texto) != "")
			{					 			
				$texto = str_replace("
	","  ",$texto);
				$texto = str_replace("  "," ",$texto);
				$texto = wordwrap($texto, 220, "\n"); 
				echo "\n\n".htmlentities($texto)."\n\n"; 
			}
		}
		debug_print_backtrace(3,10);
		//debug_print_backtrace();
		echo "\n</div>\n</pre>\n";
	} 


	public function limpiezaTextoCorreo($texto)
	{
		$buscar = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ","'"," ");
		$reemplazar = array("a","e","i","o","u","n","A","E","I","O","U","N","_","_");
		$texto = str_replace($buscar,$reemplazar,$texto);
		//$texto = utf8_encode($texto);
		$texto = trim($texto);
		$texto = strtolower($texto);
		return $texto;
	}	 
	 
	
	public function limpiezaTexto($texto)
	{
		$texto = trim($texto);
		$buscar = array("=
	","=3D","=C3=A1","=C3=AD","=C3=A9","=C3=B3","=C3=BA","=C2=BF","=C3=B1","=?UTF-8?Q?","?=","_=C3=81","=C3=A4","=C3=93","=C3=8D","_");
		$reemplazar = array("","=","a","í","é","ó","ú","¿","ñ","","","Á","ä","Ó","Í"," ");
		$texto = str_replace($buscar,$reemplazar,$texto);
		return $texto;
	}	
	
	public function limpiezaTextoInsert($texto,$under="_")
	{		 
		$texto = $this->limpiezaTexto($texto);
		$texto = strip_tags(addslashes($texto)); 
		$antiguo = array('"',"_");
		$nuevo = array('',$under);
		$texto = str_replace($antiguo,$nuevo,$texto);
		if($under == " ")
		{
			$texto = strtoupper($texto);
		}
		return $texto;
	}	 
	
	public function limpiezaEmailIncorrectos($email)
	{
		$original = array("gmai.com","gmail.coom","gmail.cl","gmail.coom","gmail.ocm","gnail.com","ume.cl");
		$nuevo = array("gmail.com","gmail.com","gmail.com","gmail.com","gmail.com","gmail.com","umce.cl");
		$email = str_replace($original,$nuevo,$email);
		return $email;
	}
	
	public function emailValido($email,$dominio)
	{
		$revisar = 1;
		$email_no_validos = array('aranceles@umce.cl','ayuda.ucampus@umce.cl','Banco_Security@security.cl','basica@umce.cl','biblioteca@umce.cl','CLAUDIO.MARTINEZ@umce.cl','castellano@umce.cl','comprobantes.info@scotiabank.cl','consulta_online@umce.cl','contacto@umce.cl','contactos@bancochile.cl','correo+umce@ucampus.cl','correo@umce.cl');
		if (in_array($email, $email_no_validos) || in_array($dominio, $email_no_validos))
		{
			$revisar = 0;
		}
		return $revisar;
	}
	
	public function redirigirGet($url,$segundo_defecto)
	{ 
		$minutos  = $segundo_defecto/60;
		$desfase = time() - HORA_DESFASE;
		$fecha = date("m-d-Y H:i:s",$desfase);
		
		echo '<meta http-equiv="refresh" content="'.$segundo_defecto.'; url='.$url.'">';
		echo "\n<pre>\n<div style=\"background-color: #ECECEC; padding: 15px 30px 15px 30px;margin:5px 30px 5px 30px; \">\n\n";
		echo $fecha." se reiniciará en ".$minutos." minuto(s)  \n";
		echo "\n\n</div>\n</pre>";		
	} 
		
	public function refrescarPaginaSegundos($segundo_defecto='') 
	{ 
		if(trim($segundo_defecto) == '')
			$segundos = REFRESH_TIME;
		else
			$segundos = $segundo_defecto;
		
		$segundos = $segundos * 1000;
		$minutos  = ($segundos/ 1000)/60;
		$hora     = $minutos/60;
		$desfase = time() - HORA_DESFASE;
		$fecha = date("m-d-Y H:i:s",$desfase);
		
		echo "<script type=\"text/javascript\">\nfunction actualizar(){location.reload(true);}\nsetInterval(\"actualizar()\",".$segundos.");\n</script>\n\n ";
		echo "\n<pre>\n<div style=\"background-color: #ECECEC; padding: 15px 30px 15px 30px;margin:5px 30px 5px 30px; \">\n\n";
		echo $fecha." se reiniciará en ".$minutos." minuto(s) - ".$hora." hora(s)  \n";
		echo "\n\n</div>\n</pre>";
	}
	
	public function leerArchivoCSV($archivo)
	{
		$lineas = file($archivo);
		print_r($lineas); 
		//$lineas = file('http://www.example.com/');

		// Recorrer nuestro array, mostrar el código fuente HTML como tal y mostrar tambíen los números de linea.
		foreach ($lineas as $num_linea => $linea) {
			echo "linea #<b>{$num_linea}</b> : " . htmlspecialchars($linea) . "<br />\n";
		} 
	}
	
	public function guardarArchivo($archivo_original,$archivo_nuevo)
	{
		 $arrContextOptions=array(
		    "ssl"=>array(
		        "verify_peer"=>false,
		        "verify_peer_name"=>false,
		    ),
		);  
		// Abre el fichero para obtener el contenido existente
		$actual = file_get_contents($archivo_original, false, stream_context_create($arrContextOptions)); 
		//$this->outputDebug("<br>ARCHIVO DESCARGADO ".$archivo_original." => ".$archivo_nuevo."<br><br>"); 
		$aux = explode("\\",$archivo_nuevo);
		//print_r($aux);
		if(is_array($aux) && count($aux)>0)
		{			
			$largo = count($aux)-1;
			unset($aux[$largo]);
			$carpeta = implode("\\",$aux);
			//echo "nueva ".$carpeta;
		}
		else
		{			
			$aux = explode("/",$archivo_nuevo);
			$largo = count($aux)-1;
			unset($aux[$largo]);
			$carpeta = implode("/",$aux);
		}

		$aux = explode("\\",$carpeta);
		$carpeta_aux = $aux[0];
		for($k=1;$k < count($aux);$k++)
		{
			$carpeta_aux = $carpeta_aux."\\".$aux[$k]."\\";
			if(!is_dir($carpeta_aux))
			{
				//echo $carpeta_aux." crear <br>";
				mkdir($carpeta_aux,0700);
			} 
		}
		//print_r($aux);
		 //echo "CARPETA ".$carpeta."<BR>";

		file_put_contents($archivo_nuevo, $actual);
		
		$this->outputDebug("<br>ARCHIVO DESCARGADO ".$archivo_original." => ".$archivo_nuevo."<br><br>"); 
		//echo "<br>ARCHIVO DESCARGADO ".$archivo_original." => ".$archivo_nuevo."<br><br>";	
		return filesize($archivo_nuevo);
		
		
	}
	
	public function enviarEmail($correos,$asunto,$contenido,$archivos=array(),$username= USERNAME_EMAIL,$password= PASSWORD_EMAIL)
	{
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $username;
		$mail->Password = $password;  
		
		if($username == USERNAME_EMAIL || $username == USERNAME_EMAIL_MATRICULA)
		{	 
			$mail->setFrom(USERNAME_EMAIL, 'MATRICULA ALUMNOS UMCE'); 
			$mail->addReplyTo(USERNAME_EMAIL_REPLAYTO_MATRICULA, 'MATRICULA ALUMNOS UMCE'); 
			$mail->addBCC(USERNAME_EMAIL_REPLAYTO_MATRICULA, 'MATRICULA ALUMNOS UMCE'); 			 
		}
		else
		{			
			$mail->setFrom('centro.acompanamiento@umce.cl', 'CENTRO DE ACOMPANAMIENTO AL APRENDIZAJE'); 
			//$mail->setFrom(USERNAME_EMAIL, 'CENTRO DE ACOMPANAMIENTO AL APRENDIZAJE'); 
			//$mail->setFrom(USERNAME_EMAIL, 'UMCE'); 
			
			$usernames = explode(',',$username);
			for($i=0; $i < count($usernames); $i++)
			{
				$mail->addReplyTo($usernames[$i], $usernames[$i]); 
			}
			
			 
			$mail->addBCC(USERNAME_EMAIL_REPLAYTO_MATRICULA, 'MATRICULA ALUMNOS UMCE'); 
			//$mail->addCC('psepulve@gmail.com', 'MATRICULA ALUMNOS UMCE'); 	
			
			$aux = rand(1,20);
			
			
			if($aux%2 == 0)
			{
				//echo $aux." USER ";
				$mail->Username = USERNAME_EMAIL;
				$mail->Password = PASSWORD_EMAIL; 
			}
			else
			{	
				//echo $aux." USER 2021";
				$mail->Username = USERNAME_EMAIL_MATRICULA;
				$mail->Password = PASSWORD_EMAIL_MATRICULA; 
			}
		}
		
		$mail->addBCC('consulta_online@umce.cl', 'UMCE'); 	
				
		foreach($correos as $tipo => $valores)
		{
			switch($tipo)
			{
				case 'to':
					for($i=0;$i< count($correos[$tipo]);$i++)
					{
						$mail->addAddress($correos[$tipo][$i]['email'],htmlentities($correos[$tipo][$i]['nombre']));
						//echo "to ".$correos[$tipo][$i]['email']." ".$correos[$tipo][$i]['nombre']."<br>";
					} 
				break;
				case 'cc':
					for($i=0;$i< count($correos[$tipo]);$i++)
					{
						$mail->addCC($correos[$tipo][$i]['email'],htmlentities($correos[$tipo][$i]['nombre']));
					} 
				break;
				case 'bcc':
					for($i=0;$i< count($correos[$tipo]);$i++)
					{
						$mail->addBCC($correos[$tipo][$i]['email'], htmlentities($correos[$tipo][$i]['nombre']));
					} 
				break;
				case 'from': 					
						$mail->setFrom($correos[$tipo][0]['email'],htmlentities($correos[$tipo][0]['nombre'])); 
				break;
				case 'replayto': 
						$mail->addReplyTo($correos[$tipo][0]['email'],htmlentities($correos[$tipo][0]['nombre']));
				break;
			}
		} 
		//$this->outputDebug($correos," correos send emial "); 
		
		$mail->Subject = utf8_decode(html_entity_decode ($asunto));
		$mail->msgHTML($contenido, dirname(__FILE__)); 

		if(count($archivos) > 0 && is_array($archivos))
		{
			for($i=0; $i < count($archivos);$i++)
			{
				try 
				{	 
					$tamano = filesize($archivos[$i]);
					if($tamano <= MAX_SIZE_ATTACH) //mayor a 10MB no se adjuntará									
					{
						$mail->addAttachment($archivos[$i]);							
					}
				}
				catch (Exception $e) 
				{ 
					$this->outputDebug(var_export($e->getMessage()));	
				} 	
			}
		}

		//send the message, check for errors

		if(SEND_EMAIL_EXECUTION)
		{
			 
			if (!$mail->send()) 
			{ 
				$this->outputDebugAlerta("Mailer Error: " . $mail->ErrorInfo,"NUEVO CORREO NO ENVIADO"); 
			} 
			else 
			{
				$this->outputDebugAlerta("Message sent!","NUEVO CORREO ENVIADO"); 
			} 	
			return $mail;
			//$this->outputDebug(var_export($mail));
		}
	}
		
}
?>