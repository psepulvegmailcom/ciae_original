<?php
function ImprimirHeader()
{
	$e  = new miniTemplate('templates/header.tpl');  
	echo $e->toHtml(); 
}

function  ImprimirFooter()
{
	$e  = new miniTemplate('templates/footer.tpl');  
	echo $e->toHtml(); 
}
	
function sendEmail($para,$asunto,$mensaje,$bcc_extra='')
{		 
	$email_webmaster 		= 'webmaster@ciae.uchile.cl'; 
	$email_webmaster_bcc 	= 'ciae@uchile.cl'; 
	$siteTitle = 'CIAE - Centro de Investigación Avanzada en Educación de la Universidad de Chile'; 
	$bcc = $email_webmaster;
	if(trim($bcc_extra) != '')
	{
		$bcc .= ', '.$bcc_extra;
	}  
	sendEmailGenerico($para,$asunto,$mensaje,$bcc,$siteTitle,$email_webmaster_bcc);  
}	

function sendEmailGenerico($para,$asunto,$mensaje,$bcc_extra,$siteTitle,$email_webmaster_bcc)
{
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	 
	$cabeceras .= 'From: '.$siteTitle.' <'.$email_webmaster_bcc.'>' . "\r\n";
	$cabeceras .= 'Reply-To: '.$siteTitle.' <'.$email_webmaster_bcc.'>' . "\r\n";
	$cabeceras .= "Message-ID: <".time()."-".$email_webmaster_bcc.">"."\r\n";
	$cabeceras .= "X-Mailer: PHP v".phpversion()."\r\n";
	$cabeceras .= 'Bcc: '.$bcc_extra; 
	$cabeceras .= "\r\n";	  
	$asunto  = html_entity_decode($asunto);  
	@mail($email_webmaster_bcc, $asunto, $mensaje, $cabeceras);  
}
 
?>