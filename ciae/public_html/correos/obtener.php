<p><a href="https://www.ciae.cl/correos/salida.txt" target="_blank">https://www.ciae.cl/correos/salida.txt</a></p>
<pre>
<?php 


 //die();
  
$_GET['u'] = "e889760b9a85dc871b2052565fd1147c";

if(trim($_GET['caso']) == '')
{
	$_GET['caso'] = 'RI';
	$_GET['caso'] = 'R';
	// $_GET['caso'] = 'C';
}
if(trim($_SERVER['PHP_AUTH_USER']) == '')
{
  $_SERVER['PHP_AUTH_USER']   = $_GET['u']; 
}

if ($_SERVER['PHP_AUTH_USER'] != "e889760b9a85dc871b2052565fd1147c" )
{  
  echo 'Authorization Required To Server.';
  die();
}
 

require_once("config/conexion.php");  
 

$envioCorreo = new envioCorreo();
 
$to_correos = array();

$inactivar = array();
$activar = array();
$caso_obtener = 'NO_LEIDOS';
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';


$username = USERNAME_REMITENTE0;//$username = USERNAME_REMITENTE1;
$password = PASSWORD_REMITENTE;

 
if($_GET['caso'] == 'R')
{
	$hostname = '{imap.gmail.com:993/imap/ssl}@.rebotes'; 
	$caso_obtener = 'REBOTES';
}	
elseif($_GET['caso'] == 'C')
{
	$hostname = '{imap.gmail.com:993/imap/ssl}@contacto'; 
	
	$hostname = '{imap.gmail.com:993/imap/ssl}INBOX'; 
	
	$caso_obtener = 'CONTACTO';
} 
 
 if($_GET['caso'] == 'RI')
{
	$hostname = '{imap.gmail.com:993/imap/ssl}[Gmail]/Spam'; 	
	//	$hostname = '{imap.gmail.com:993/imap/ssl}'; 	
	$caso_obtener = 'REBOTES';
	$username = USERNAME_REMITENTE40;
}	

if($caso_obtener == 'NO_LEIDOS')
{
	echo "EXIT";
	die(); /* no se hace nada*/
}



  
$antes = array(",","@ciae.","@ie.",".png","listasciae","@computrabajo.com","@DC-PMG05.wpe.cl","@host","anaconda","@ciae.uchile.cl","@2x.png","@arpamate.cl","@cl1.fidelizador.org","wght@0","09@media","&","<",">","*","=3D","/","=","webmaster@ci",'"',"webmaster@institutodeeducacion.cl","@listasciae.uchile.cl","webmaster@ciae.uchile.cl",">","","�",":","
","\n","<","mailto:",")","(",";","ARPASANTIAGO+unsubscribe@","jpg@","<",">","mail.gmail.com","@www.ciae.uchile.cl","@listasdircom.uchile.cl","]","@mx.google.com","@explore.pinterest.com","@mail.yahoo.com","@www.ie.uchile.cl","@ciae.cl","mail.ru","@inspire.pinterest.com","@explore.pinterest.com","@googlemail.com","Received","@www.ciae.cl","@listasciae.uchile.cl","List-Help","From","@ciae.uchile.cl","postmaster@","@mx.google.com","Precedence","Remote","'","@CIAE.UCHILE.CL","microsoft-com@uc.cl","@google.com","@ciae.cl","@notifications.google.com","@localhost",">","<","[","]","{","}","�","","","#","$");
$despues = array(" "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," > "," < "," "," "," "," "," "," "," "," "," ");


//$antes = array("&","<",">","*",'"',":",";",")","mailto:");
//$despues = array(" "," "," "," "," "," "," "," "," ");

 /*
$cnx = '{imap.gmail.com:993/imap/ssl}';
$mbox = imap_open($cnx, $username, $password) or die('Ha fallado la conexión1: ' . imap_last_error());
$folders = imap_listmailbox($mbox, $cnx, '*');
print_r($folders);
 
imap_close($mbox);

Array
(
    [0] => {imap.gmail.com:993/imap/ssl}@.envios
    [1] => {imap.gmail.com:993/imap/ssl}@.envios/@certificados
    [2] => {imap.gmail.com:993/imap/ssl}@.envios/@confirmaciones
    [3] => {imap.gmail.com:993/imap/ssl}@.envios/@masivos
    [4] => {imap.gmail.com:993/imap/ssl}@.envios/@registros
    [5] => {imap.gmail.com:993/imap/ssl}@.rebotes
    [6] => {imap.gmail.com:993/imap/ssl}@contacto
    [7] => {imap.gmail.com:993/imap/ssl}@contacto/@postulacion.postgrado
    [8] => {imap.gmail.com:993/imap/ssl}@contacto/@postulaciones
    [9] => {imap.gmail.com:993/imap/ssl}@.eliminados
    [10] => {imap.gmail.com:993/imap/ssl}INBOX
    [11] => {imap.gmail.com:993/imap/ssl}[Gmail]/Enviados
    [12] => {imap.gmail.com:993/imap/ssl}[Gmail]/Papelera
    [13] => {imap.gmail.com:993/imap/ssl}[Gmail]/Todos
)
*/

echo "correos de ".$username."\n\n";

$tiempo_refresh = 60; //si no hay nada


$inbox = imap_open($hostname,$username,$password) or die('Ha fallado la conexión: ' . imap_last_error());
if($caso_obtener == 'REBOTES')
{
	$emails = imap_search($inbox,'ALL'); 
}
else
	$emails = imap_search($inbox,'UNSEEN');  



 //para que obtenga de mas nuevos a mas antiguos
//print_r($emails);
$mostrar_detalle = FALSE ;
 
$solo_salida =  FALSE ;

//$total = 10;
$total = 5;
$total = 3;

$total = rand(5,8);
//$total = rand(9,12);
$total = 5;


if($solo_salida)
{
	$total = 20;
}

if($emails && count($emails) > 0) 
{
	$correos_obtenidos = array();
	$emails = array_reverse($emails);
	if($caso_obtener == 'REBOTES')
	{ 
		if(count($emails) > 5)
		 	$emails = array_rand($emails,5); 
	}
	
	
    $contenido_extra = "";
    //print_r($emails);
    $i=0;
	foreach($emails as $email_number) 
	{    
		$tiempo_refresh = 35; //si hay correos
		if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************INICIO FOR*************************************************<br>\n<br>\n<br>\n";
			print_r($emails);
		}
		
		if($i == $total)
		{
			escribirSalida($envioCorreo,$correos_obtenidos,$solo_salida,$caso_obtener  ) ;
			  
			 
			?>
			  <META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $tiempo_refresh;?>;URL=obtener.php?u=e889760b9a85dc871b2052565fd1147c&caso=<?php echo $_GET['caso'];?>">   
  
			<?php
			return;
		}
		$overview = imap_fetch_overview($inbox,$email_number,0); 
		
		
		if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************OVERVIEW*************************************************<br>\n<br>\n<br>\n";
			print_r($overview);
		}
		
		$correo_to = str_replace(array('"',">"),array("",""),trim($overview[0]->to));

		$aux = explode("<",$correo_to);
	 
		if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************OVERVIEW 2*************************************************<br>\n<br>\n<br>\n";
			print_r($aux); 
		}		
		if(count($aux) == 1)
			$correo_to = $aux[0];	
		else
			$correo_to = $aux[1];	
		
		$correo_from = str_replace(array('"',">"),array("",""),trim($overview[0]->from)); 
		$aux = explode("<",$correo_from);
		//print_r($aux);
		if(count($aux) == 1)
			$correo_from = $aux[0];	
		else
			$correo_from = $aux[1];	
		//echo "to ".$correo_to." FROM ".$correo_from."<br>\n";
			
		$contenido_extra .= $correo_from." ";
		$contenido_extra .= $correo_to." "; 
		 
		 if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************CONTENIDO_EXTRA*************************************************<br>\n<br>\n<br>\n";
			print_r($contenido_extra);
		}
					
		/*if( || trim($correo_to) == "encuestas.pandemia@ciae.uchile.cl" || trim($correo_to) == "comunicaciones@ciae.uchile.cl" || trim($correo_to) == "contacto@ciae.uchile.cl" || trim($correo_to) == "contacto@ie.uchile.cl" || trim($correo_to) == "postulacion.postgrado@ciae.uchile.cl" ||  trim($correo_to) == "postulacion.postgrado@ie.uchile.cl" ||trim($correo_to) == "arpa@ciae.uchile.cl" || trim($correo_to) == "contacto@arpamate.cl")*/
		
		
		$header = imap_fetchheader($inbox,$email_number,0); 
		$contenido = imap_fetchbody($inbox,$email_number,1);
		$contenido_plano = imap_fetchbody($inbox,$email_number,3);
		$contenido = $contenido.' '.base64_decode($contenido);
		 

		if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************HEADER*************************************************<br>\n<br>\n<br>\n";
			echo $header;
		} 	
		$header = str_replace(array("<",">"),array(" "," "),$header);
		
		if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************HEADER EDITADO*************************************************<br>\n<br>\n<br>\n";
			echo $header;
			echo "<br>\n<br>\n<br>\n*********************ECHO CONTENIDO*************************************************<br>\n<br>\n<br>\n";
			echo htmlentities($contenido);
			echo "<br>\n<br>\n<br>\n*********************ECHO CONTENIDO*************************************************<br>\n<br>\n<br>\n";
			echo $contenido;
			echo "<br>\n<br>\n<br>\n*********************ECHO CONTENIDO BASE64_DECODE*************************************************<br>\n<br>\n<br>\n";
			echo base64_decode($contenido);
			echo "<br>\n<br>\n<br>\n*********************PRINT CONTENIDO*************************************************<br>\n<br>\n<br>\n";
			print_r($contenido);	
			echo "<br>\n<br>\n<br>\n*********************CONTENIDO_PLANO*************************************************<br>\n<br>\n<br>\n";
			print_r($contenido_plano);
			echo "<br>\n<br>\n<br>\n*********************CONTENIDO*************************************************<br>\n<br>\n<br>\n";
			print_r($contenido);
			echo "<br>\n<br>\n<br>\n*********************HEADER *************************************************<br>\n<br>\n<br>\n";
			print_r($header ); 
			echo "<br>\n<br>\n<br>\n*********************ECHO CONTENIDO PLANO*************************************************<br>\n<br>\n<br>\n";
			echo htmlentities($contenido);
			echo "<br>\n<br>\n<br>\n*********************ECHO CONTENIDO PLANO*************************************************<br>\n<br>\n<br>\n";
			echo $contenido;
			echo "<br>\n<br>\n<br>\n*********************PRINT CONTENIDO PLANO*************************************************<br>\n<br>\n<br>\n";
			print_r($contenido);
		}  
		$contenido = $contenido." ".$header." ".$contenido_extra." ".$contenido_plano;
		if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************ECHO CONTENIDO COMBINADO SIN EDICION*************************************************<br>\n<br>\n<br>\n";
			echo $contenido; 
		} 
		$contenido = str_replace($antes,$despues,$contenido); 
		$contenido = str_replace($antes,$despues,$contenido); 
		echo "largo contenido ".strlen($contenido)."\n";
		$aux = explode(" ", $contenido); 
		if($mostrar_detalle)
		{
			echo "<br>\n<br>\n<br>\n*********************ECHO CONTENIDO COMBINADO  EDITADO*************************************************<br>\n<br>\n<br>\n";
			echo $contenido; 
			echo "<br>\n<br>\n<br>\n*********************CONTENIDO AUX************************************************<br>\n<br>\n<br>\n";
			print_r($aux);
		}   
		for($j=0;$j<count($aux);$j++)
		{
			$aux[$j] = trim($aux[$j]);
			if(strlen($aux[$j]) == 0)
			{
				continue;
			}

			$ultimo = substr($aux[$j],-1);
			if($ultimo == '.' || $ultimo == '@')
			{
				continue;
			}
			$aux_split = array();
			$aux_split = explode("@",$aux[$j]); 
			//print_r($aux_split);
			if($mostrar_detalle)
			{
				echo "<br>\n<br>\n<br>\n*********************CONTENIDO AUX SPLIT************************************************<br>\n<br>\n<br>\n";
				print_r($aux_split);
			}
			
			if(count($aux_split) > 1 && is_array($aux_split))
			{
				if($mostrar_detalle)
				{ 
					echo "<br>\n<br>\n<br>\n*********************CONTENIDO AUX SPLIT ENCONTRADO************************************************<br>\n<br>\n<br>\n";
					print_r($aux_split);
				}				
				$aux_split[1] = trim($aux_split[1]);
				$aux_split[0] = trim($aux_split[0]);
				$aux_split_punto = explode(".",$aux_split[1]); 
				
				$aux_split_guion = explode("-",$aux_split[0]); 
				if($mostrar_detalle)
				{ 
					echo "<br>\n<br>\n<br>\n*********************CONTENIDO AUX_SPLIT_PUNTO************************************************<br>\n<br>\n<br>\n";
					print_r($aux_split_punto);
				}		
				if(count($aux_split_punto) > 1 && count($aux_split_punto) < 5 && count($aux_split_guion) < 5 && strlen(trim($aux_split[1])) < 40 && strlen(trim($aux_split[0])) < 40 && strlen($aux_split[1]) > 0 && strlen(trim($aux_split[0])) > 0) 
				{
					$correos_obtenidos[trim($aux[$j])] = trim($aux[$j]);
				} 
					
			} 
		}
		
			
		if($caso_obtener == 'REBOTES')	
		{ 
			//imap_mail_copy($inbox,$email_number,'@.rebotes');
			//imap_mail_copy($inbox,$email_number,'@.eliminados');
			//imap_mail_copy($inbox,$email_number,'[Gmail]/Papelera');

			//imap_mail_copy($inbox,$email_number,'@.rebotes');
			imap_mail_copy($inbox,$email_number,'@.eliminados');
			//imap_delete($inbox,$email_number);
			//imap_delete($inbox,$email_number);
		}							
		$i++;
	}
	 
	echo "<br>\n<br>\n<br>\n*********************CORREOS_OBTENIDOS************************************************<br>\n<br>\n<br>\n";
	print_r($correos_obtenidos);
	
	escribirSalida($envioCorreo,$correos_obtenidos,$solo_salida,$caso_obtener  );
	 
}    


//imap_expunge($inbox);

imap_close($inbox );


function escribirSalida($envioCorreo,$correos_obtenidos,$solo_salida,$caso_obtener )
{
	
	$fichero = '/home/ciae/public_html/correos/output/'.date("Ymd").'/'.date("Ymd_His",mktime(date("H")-4, date("i"), date("s"), date("m")  , date("d"), date("Y"))).'_output_rebotes_salida.txt'; 
	
	$actual = "\n\n\n\n";
	$actual .= file_get_contents($fichero);  
	if($solo_salida)
	{
		echo $actual."\n";
	}
	file_put_contents($fichero, $actual);
			 
	if($caso_obtener == 'CONTACTO')		 
		$envioCorreo->agregarListadoEmail($correos_obtenidos);	

	if($caso_obtener == 'REBOTES' && !$solo_salida)		 
	{
		$envioCorreo->inactivarListadoEmail($correos_obtenidos,'Inactivacion por eliminacion de suscripcion');	 				  
	}

}
?>
</pre>


<!-- <META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $tiempo_refresh;?>;URL=obtener.php?u=e889760b9a85dc871b2052565fd1147c&caso=<?php echo $_GET['caso'];?>"> -->   
  

<script> 
setTimeout("window.close()",30000);
</script>