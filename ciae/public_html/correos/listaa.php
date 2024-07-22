<title>SQL varios</title>

<!--<META HTTP-EQUIV="REFRESH" CONTENT="3600;URL=https://www.ciae.cl/correos/listaa.php?u=e889760b9a85dc871b2052565fd1147c"> -->

<script> 
setTimeout("window.close()",1000000);
</script>
<pre style='    white-space: pre-wrap; font-family: Verdana, "Bitstream Vera Sans", Geneva, sans-serif; font-size:12px; '>
<?php 
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
$mostrar_inactivos 				= FALSE;
$mostrar_activos 				= FALSE;
$mostrar_union 					= FALSE;
$mostrar_inclusion_grupos 		= TRUE;
$mostrar_inactivos_porenviar 	= TRUE;
$mostrar_contacto_porenviar 	= TRUE;
$mostrar_envios_masivos 		= FALSE;
$mostrar_limpieza_full 			= TRUE; 
$fecha 							= '2023-05-20 00:00:00';
$envioCorreo = new envioCorreo();
//$envioCorreo->eliminarCasoPruebaTest();
  

 
   
$mostrar_limpieza = FALSE;
 //$mostrar_limpieza = TRUE;

if($mostrar_limpieza)
{
	$total_rebote = 0;
	 echo '<textarea  style="width:90%"; " rows="17"  >';
	 $email = '';
	for($i=1; $i <= 14; $i++)
	{
		$file = '/home/ciae/public_html/correos/tmp/a_masivo_0'.$i.'.csv';
		if(file_exists($file))
		{
			$cvs_limpieza = trim(file_get_contents($file));
			$cvs_limpieza = explode("\n",$cvs_limpieza);
			//print_r($cvs_limpieza);
			for($j=2;$j < count($cvs_limpieza);$j++)
			{
				if(trim($cvs_limpieza[$j]) == '')
				{
					continue;
				}
				 $aux = explode(",",$cvs_limpieza[$j]);
				//print_r($aux);
				if($aux[3] == 'rebotada' && trim($aux[0]) != '')
				{
					$email .= $aux[0]."\n";
					$total_rebote++;
					echo "
UPDATE  base_datos_email SET estado = 'inactivo', comentario = 'inactivacion por rebote-".time()."' WHERE    (email LIKE '".$aux[0]."'); 

UPDATE IGNORE  base_datos_email_tipo SET tipo_base = 'ciae_0_inactivos' WHERE email = '".$aux[0]."'; 

UPDATE envio_email_destino SET estado = 'rebote' WHERE estado != 'rebote' AND  email = '".$aux[0]."';

INSERT IGNORE INTO base_datos_email (estado,comentario,creacion_lista,email) VALUES ('inactivo','inactivacion por rebote nuevo','ciae_0_inactivos','".$aux[0]."' );
					
					";				 
				}
			}
		}		
	}
	echo $email;
	echo "</textarea>";
	echo "<br>".$total_rebote." Total a rebotar";
	
	die();
}
 

if($mostrar_limpieza_full)
{ 
	 /*limpieza de correos */
	$exclusion = "    `email` LIKE '%@gmai.com' OR `email` LIKE '%í%' OR   `email` LIKE '%­%' OR       `email` LIKE '%reply%' OR    `email` LIKE '%.pdf%' OR  `email` LIKE '%.jpeg%' OR  `email` LIKE '%.jpg%' OR `email` LIKE '%*%' OR  `email` LIKE '%.gif%' OR  `email` LIKE '%.emz%' OR  `email` LIKE '%.png%' OR  `email` LIKE '%=%' OR   `email` LIKE '%ã%' OR `email` LIKE '%â%' OR `email` LIKE '%ƒ%' OR `email` LIKE '%æ%' OR `email` LIKE '%@ie.uchile.cl%' OR  `email` LIKE '%?%' OR `email` LIKE '.%' OR `email` LIKE '%.uchile' OR `email` LIKE '%.uc' OR `email` LIKE '%.c' OR `email` LIKE '%$%'  OR `email` LIKE '%.con' OR `email` LIKE '%.ru' OR `email` LIKE  'noreply%'  OR `email` LIKE  '%.cu'   OR `email` LIKE  '%xyz' OR `email` LIKE '%bounces%'  OR `email` LIKE '%%'  OR `email` LIKE '%@%tracking%' OR `email` LIKE '%@gmail.co' OR `email` LIKE '%@%facebook%'   OR `email` LIKE '%@%zendesk%'   OR `email` LIKE '%$%'   OR `email` LIKE '%:%'   OR `email` LIKE '%>%'   OR `email` LIKE '%&%'   OR `email` LIKE '%ñ%'    OR `email` LIKE '%,%'     OR `email` LIKE '%..%'   OR `email` LIKE '%±%'     OR `email` LIKE '%uch'   OR `email` LIKE '%uchi'  OR `email` LIKE '%uchil'  OR `email` LIKE '%uchile' OR `email` LIKE '%@.%'    OR `email` LIKE '%\"%'   OR `email` LIKE '% %' OR  email  LIKE '%\%%'   OR  email  LIKE '%@email.apple.com'  OR `email` LIKE '%@adobe.com' OR  `email` LIKE '%@%apple%'   OR  `email` LIKE '%@jahoo%'  OR  `email` LIKE '%noreplay%' OR `email` LIKE '%@tormentofilms.cl%' OR `email` LIKE '%.c'  OR `email` LIKE '%.u'  OR `email` LIKE '%.uchile'  OR `email` LIKE '.%' OR email LIKE '%@bounce%' OR email LIKE '%google%' OR email LIKE '%exchangelabs%'   OR email LIKE '%generated%' OR email LIKE '%conicyt.cl.mail%'  OR email LIKE '%;%'  OR email LIKE '%,%'   OR email LIKE '%www%'   OR email LIKE '%smtp%'   OR email LIKE '%spamcloud%'   OR email LIKE '%@%@%'  OR email LIKE '%-%-%-%'   OR email LIKE '-%'   OR email LIKE '%@hola.tendenciahome.cl%'  OR email LIKE '%@fees.cl%'  OR email LIKE '%@fedesoft.org%'  OR email LIKE '%divinecash%'  OR email LIKE '%brightdata.com%' ";
	$query = "
	UPDATE envio_email_destino SET `estado` = 'rebote' WHERE  `estado` != 'rebote'  AND (".$exclusion.");
	UPDATE  IGNORE `base_datos_email` SET `estado` = 'inactivo', comentario = 'Inactivacion por eliminacion limpieza formato-".time()."' WHERE  `estado` = 'activo' AND ( ".$exclusion." ) ;
	UPDATE  IGNORE `base_datos_email` SET `estado` = 'inactivo', comentario = 'Inactivacion por eliminacion limpieza formato' WHERE  `estado` = 'activo' AND `email` NOT LIKE '%@%'   ;
	
	UPDATE  IGNORE `base_datos_email` SET grupo_masivo = 'sin_masivo@ciae.uchile.cl' WHERE   grupo_masivo != 'sin_masivo@ciae.uchile.cl'  AND ( ".$exclusion." ) ;
	
	INSERT  IGNORE INTO  `base_datos_email` (email)  
	SELECT DISTINCT a.email FROM `envio_email_destino` AS a LEFT JOIN   `base_datos_email` AS b ON a.email = b.email WHERE   b.email IS NULL;
	

	UPDATE  IGNORE `base_datos_email` SET email = TRIM(email) WHERE `email` IS NOT NULL ; 
	UPDATE IGNORE  `envio_email_destino` SET email = TRIM(email) WHERE `email` IS NOT NULL ; 
	UPDATE IGNORE  `envio_email_destino` SET nombre = TRIM(nombre) WHERE `nombre` IS NOT NULL ; 
	UPDATE  IGNORE `base_datos_email` SET `estado` = 'inactivo', comentario = 'Inactivacion por eliminacion limpieza formato' WHERE  `estado` = 'activo' AND `email`   LIKE '% '   ;
	UPDATE  IGNORE `base_datos_email` SET `estado` = 'inactivo', comentario = 'Inactivacion por eliminacion limpieza formato' WHERE  `estado` = 'activo' AND `email`   LIKE ' %'   ;

	UPDATE IGNORE `base_datos_email_tipo` SET `tipo_base` = 'ciae_general' WHERE   `base_datos_email_tipo`.`tipo_base` = ' ';
	DELETE FROM base_datos_email_tipo WHERE   `base_datos_email_tipo`.`tipo_base` = ' ';

	DELETE FROM base_datos_email_tipo WHERE   `base_datos_email_tipo`.`email` = '';

	UPDATE `base_datos_email` SET `tratamiento` = 'o/a' WHERE (`tratamiento` IS NULL OR  `tratamiento` = '')  AND estado = 'activo';


	UPDATE `ciaecl_correoweb`.`envio_email_detalle` SET   bcc_2= 'webmaster@ciae.uchile.cl' WHERE   `estado` LIKE 'activo'  ;
	
	UPDATE `ciaecl_correoweb`.`base_datos_email` SET  grupo_masivo= 'sin_masivo@ciae.uchile.cl' 
			WHERE   ( ".$exclusion." ) 
	
	
	";

	$envioCorreo->ejecutarQuery($query);
	
	
	
}

if($mostrar_inactivos_porenviar)
{
	echo "\n\n**********************INACTIVOS POR ENVIAR*************************\n\n";
	$emails = $envioCorreo->obtenerInactivosPorEnviar(); 
	if(count($emails) > 0)
	{		 
		$sql = "";
		 print_r($emails);
		 echo '<textarea  style="width:90%"; " rows="17"  >';
		 for($i=0; $i < count($emails);$i++)
		{			
			$query = "UPDATE `base_datos_email` SET `estado` = 'activo', `comentario` = '' WHERE `base_datos_email`.`email` = '".trim($emails[$i]['email'])."';";
			$envioCorreo->ejecutarQuery($query);
			$sql .= $query;
			$query = "UPDATE `envio_email_destino` SET `estado` = 'enviado' WHERE   `envio_email_destino`.`email` = '".trim($emails[$i]['email'])."' AND `estado` = 'rebote';";
			$sql .= $query;
			
			echo $query."\n\n"; 
		}
		echo "</textarea>";
		$envioCorreo->ejecutarQuery($sql);
	}
	

	echo "\n\n**********************VOLVER A INACTIVOS*************************\n\n";
	$emails = $envioCorreo->obtenerInactivosPorEnviar(); 
	if(count($emails) > 0)
	{		 
		 //print_r($emails);
		 echo '<textarea  style="width:90%"; " rows="17"  >';
		 for($i=0; $i < count($emails);$i++)
		{			 
			$query = "UPDATE `envio_email_destino` SET `estado` = 'rebote' WHERE   `envio_email_destino`.`email` = '".trim($emails[$i]['email'])."' ;";
			echo $query."\n\n"; 
		}
		echo "</textarea>";
	}	
} 

if($mostrar_contacto_porenviar)
{
	echo "\n\n**********************CONTACTO POR ENVIAR*************************\n\n";
	echo "\n\nUPDATE  IGNORE `envio_email_detalle` SET `estado` = 'activo' WHERE `envio_email_detalle`.`caso_envio` = 'formulario_contacto';\n\n";
	echo "\n\nUPDATE  IGNORE `envio_email_detalle` SET `estado` = 'inactivo' WHERE `envio_email_detalle`.`caso_envio` = 'formulario_contacto';\n\n";
	$emails = $envioCorreo->obtenerContactoPorEnviar(); 
	$sql = "";
	if(count($emails) > 0)
	{		 
		 print_r($emails);
		 echo '<textarea  style="width:90%"; " rows="17"  >';
		 for($i=0; $i < count($emails);$i++)
		{				
			$query = "INSERT IGNORE INTO `base_datos_email` (`estado` ,comentario , email) VALUES ( 'inactivo', 'inactivacion por rebote', '".trim($emails[$i]['email'])."');";
			if(trim($emails[$i]['mensaje']) == '')
			{
				$sql .= $query; 
			}
			echo $query."\n\n";
			$query = "UPDATE IGNORE  `base_datos_email` SET `estado` = 'inactivo', `comentario` = 'inactivacion por rebote' WHERE `base_datos_email`.`email` = '".trim($emails[$i]['email'])."';";
			if(trim($emails[$i]['mensaje']) == '')
			{
				$sql .= $query; 
			}	
			echo $query."\n\n";
			$query = "UPDATE IGNORE  `envio_email_destino` SET `estado` = 'rebote' WHERE   `envio_email_destino`.`email` = '".trim($emails[$i]['email'])."' AND `estado` != 'rebote';";
			if(trim($emails[$i]['mensaje']) == '')
			{
				$sql .= $query;
			}
			echo $query."\n\n"; 
		}		 
		echo "</textarea>";
		if(trim($sql) != '')
		{
			$envioCorreo->ejecutarQuery($sql);
		}
	}
}
if($mostrar_inactivos)
{
	echo "\n\n**********************INACTIVOS*************************\n\n";
	$emails = $envioCorreo->obtenerInactivos($fecha,'email'); 
	if(count($emails) > 0)
	{
		 //print_r(json_encode($emails));
		 echo '<textarea  style="width:90%"; " rows="17"  >';
		 for($i=0; $i < count($emails);$i++)
		{
			$query = "REPLACE  INTO phplist_user_user (  email  , confirmed , blacklisted , optedin , bouncecount , entered , modified , uniqid  , htmlemail ,    password , passwordchanged , disabled  ) VALUE ('".trim($emails[$i]['email'])."',1,1,0,0,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".md5(date('Y-m-d H:i:s').trim($emails[$i]['email']))."',1,'','".date('Y-m-d')."','0') ; ";
			echo $query."\n\n";
		}
		echo "</textarea>";
	}
}
if($mostrar_inclusion_grupos)
{
	echo "\n\n**********************MOSTRAR_INCLUSION_GRUPOS*************************\n\n";
	$emails = $envioCorreo->obtenerNuevosActivosInactivosGrupos(); 
	if(count($emails) > 0)
	{ 
		echo '<textarea  style="width:90%"; " rows="17"  >';
		echo "\nGroup Email [Required],Member Email,Member Role,Member Type\n";
		for($i=0; $i < count($emails);$i++)
		{
			echo $emails[$i]['grupos']."\n";
		}
		echo "</textarea>";
		echo "\n\n\n\n\nUPDATE `extra_ultima_vista` SET `fecha_grupos_masivos` = (SELECT fecha_actualizacion FROM `base_datos_email`  
ORDER BY `base_datos_email`.`fecha_actualizacion` DESC limit 1)  ;\n\n\n\n\n";
	}
}
if($mostrar_activos)
{
	echo "\n\n**********************ACTIVOS*************************\n\n";
	$emails = $envioCorreo->obtenerActivos($fecha,'email'); 
	if(count($emails) > 0)
	{
		 //print_r(json_encode($emails));
		 echo '<textarea  style="width:90%"; " rows="17"  >';
		 for($i=0; $i < count($emails);$i++)
		{
			$query = "REPLACE  INTO phplist_user_user (  email  , confirmed , blacklisted , optedin , bouncecount , entered , modified , uniqid  , htmlemail ,    password , passwordchanged , disabled  ) VALUE ('".trim($emails[$i]['email'])."',1,0,0,0,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".md5(date('Y-m-d H:i:s').trim($emails[$i]['email']))."',1,'','".date('Y-m-d')."','0') ; ";
			echo $query."\n\n";
		}
		echo "</textarea>";
	}
} 

if($mostrar_envios_masivos)
{
	echo "\n\n**********************ENVIOS MASIVOS*************************\n\n";
	$caso_envio = '202306_04_boletin_ciae';
	 //print_r(json_encode($emails));
	 echo '<textarea  style="width:90%"; " rows="17"  >';
	 for($i=1; $i < 12;$i++)
	{
		$query = "
			INSERT IGNORE INTO `ciaecl_correoweb`.`base_datos_email` (  `email`,estado ) VALUES (  'informaciones@ciae.uchile.cl' , 'activo' ); 
			UPDATE IGNORE  `ciaecl_correoweb`.`base_datos_email` SET `estado` = 'activo' WHERE  `email` = 'informaciones@ciae.uchile.cl'; 
			INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`,nombre, apellidos ) VALUES ('".$caso_envio."', CURRENT_TIMESTAMP, 'no_enviado', 'informaciones@ciae.uchile.cl' , '', ''); 
			UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `estado` = 'no_enviado' WHERE  `email` = 'informaciones@ciae.uchile.cl' AND caso_envio = '".$caso_envio."'; 
			UPDATE `envio_email_detalle` SET `bcc_1` = 'a_masivo_0".$i."@ciae.uchile.cl', estado = 'activo' WHERE `envio_email_detalle`.`caso_envio` = '".$caso_envio."';
			";
		echo $query."\n\n";
	}
	 echo "SELECT * FROM `view_envio_estados_no_enviados`;\n";
	echo "</textarea>";
}

if($mostrar_union)
{
	?>
	************************UNIFICACION****************************************
	<textarea  style="width:90%"; " rows="17"  >
	UPDATE phplist_user_user SET confirmed = '1'   ;
	DELETE FROM phplist_user_blacklist;
	DELETE FROM phplist_user_blacklist_data;
	REPLACE INTO phplist_user_blacklist_data (email,name, data) SELECT  email , 'reason' as name, 'Eliminado suscripcion' as data FROM phplist_user_user where blacklisted = 1;
	REPLACE INTO phplist_user_blacklist (email,added) SELECT  email , '2023-05-25 21:06:55' as added FROM phplist_user_user where blacklisted = 1;
	UPDATE phplist_user_user SET  blacklisted = '0' where email LIKE '%lista-seminarios@ciae.uchile.cl%' OR   email LIKE '%informaciones@ciae.uchile.cl%' OR   email LIKE '%enviopruebaemail@ciae.uchile.cl%' OR   email LIKE '%boletin_ie_ciae@ciae.uchile.cl%';
	INSERT INTO phplist_listuser (userid  , listid ,  entered , modified) 
	SELECT a.id, '9' as listid, '2023-05-25 21:06:57' as entered, '2023-05-25 21:06:57' as modified from phplist_user_user as a LEFT JOIN phplist_listuser AS b on a.id = b.userid WHERE b.userid IS NULL;
	INSERT IGNORE INTO phplist_usermessage (messageid , userid , entered   ,viewed              , status ) SELECT (SELECT  id     FROM phplist_message WHERE (status = 'inprocess' OR status = 'submitted') ORDER BY id DESC LIMIT 1) as messageid,id as userid, '2023-05-25 21:06:58' as entered ,    NULL as viewed              ,'sent' as status   FROM phplist_user_user WHERE ( email  LIKE '%@uc.cl'  OR email LIKE '%@santotomas.cl' OR email  LIKE '%@gmail.com'    OR email LIKE '%@udec.cl' OR  email LIKE '%uchile.cl'  OR  email LIKE '%@uahurtado.cl' OR email LIKE '%@unab.cl' OR email   LIKE '%@hotmail%' OR email   LIKE '%@msn%'  OR email   LIKE '%@live%'  OR email   LIKE '%@outlook.%') AND   blacklisted = '0'  ;
	INSERT IGNORE INTO phplist_usermessage (messageid , userid , entered   ,viewed              , status ) SELECT (SELECT  id     FROM phplist_message WHERE (status = 'inprocess' OR status = 'submitted') ORDER BY id ASC LIMIT 1) as messageid,id as userid, '2023-05-25 21:07:02' as entered ,    NULL as viewed              ,'sent' as status   FROM phplist_user_user WHERE ( email  LIKE '%@uc.cl' OR email LIKE '%@santotomas.cl' OR email  LIKE '%@gmail.com'    OR email LIKE '%@udec.cl' OR  email LIKE '%uchile.cl'  OR  email LIKE '%@uahurtado.cl' OR email LIKE '%@unab.cl' OR email   LIKE '%@hotmail%' OR email   LIKE '%@msn%'  OR email   LIKE '%@live%'  OR email   LIKE '%@outlook.%') AND   blacklisted = '0'  ;
	UPDATE phplist_message as  a INNER JOIN view_phplist_usermessage_total as b ON a.id = b.messageid  AND (a.status = 'inprocess' OR a.status = 'submitted') SET a.processed   = b.total, a.astextandhtml = b.total;
	</textarea>
	<?php 
}

 
 

 ?>
 </pre>