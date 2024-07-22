<?php

if(trim($_SERVER['PHP_AUTH_USER']) == '')
{
	$_SERVER['PHP_AUTH_USER'] 	= $_GET['u']; 
}

if ($_SERVER['PHP_AUTH_USER'] != "e889760b9a85dc871b2052565fd1147c" )
{  
	echo 'Authorization Required To Server.';
	die();
}

include('conexion.php'); 
include('clases/smtp_mail/loadsmtp.php'); 
include('clases/include_intranet_varios.php'); 
include('/home/ciaecl/bases/site/clases_general/ControladorDeFunciones.php'); 


class envioEmail
{
	function obtenerUltimaFechaRevision()
	{
		$sql = "SELECT ultima_fecha FROM extra_ultima_vista ORDER BY ultima_fecha DESC Limit 1";
		$salida = envioEmail::hacerConsulta($sql);	
		echo $sql."<br>";
		return $salida[0]['ultima_fecha'];
	}  
	
	function obtenerListadoInactivosEnviarPHPList($indice=0,$maximo=10,$order='creacion_fecha ASC')
	{ 			 
		$sql = "SELECT * FROM view_bases_inactivos WHERE email NOT LIKE '%?%'  ORDER BY   ".$order." LIMIT ".$indice.",".$maximo;
		echo "<br>".$sql."<br>";
		$salida = envioEmail::hacerConsulta($sql);
		return $salida;		
	}
	
	function obtenerIndice($caso)
	{		
		$sql = "SELECT indice_".$caso." FROM extra_ultima_vista ";
		echo "<br>".$sql."<br>";
		$salida = envioEmail::hacerConsulta($sql);
		//print_r($salida);
		return $salida[0]["indice_".$caso];		
	}
	
	function editarIndice($caso,$indice_nuevo)
	{		
		$sql = "UPDATE  extra_ultima_vista SET indice_".$caso." = '$indice_nuevo' ;"; 				 
		echo "<br>".$sql."<br>";
		GeneralSQLQuery($sql,false,false);
		return $salida;		
	}
	
	function obtenerListadoActivosEnviarPHPList($indice=0,$maximo=10,$order='creacion_fecha ASC')
	{ 			 
		$sql = "SELECT * FROM view_bases_activos ORDER BY  ".$order." LIMIT ".$indice.",".$maximo;		
		echo "<br>".$sql."<br>";
		return envioEmail::hacerConsulta($sql);	
	}
	
	function obtenerListadoInactivos()
	{
		$fecha = envioEmail::obtenerUltimaFechaRevision();			
		$sql = "SELECT DISTINCT email FROM view_bases_inactivos WHERE fecha_actualizacion >= '".$fecha."'";
		//echo $sql."<br>";
		return envioEmail::hacerConsulta($sql);	
	}
	
	function obtenerNuevosCorreos()
	{
		$fecha = envioEmail::obtenerUltimaFechaRevision();
		$sql ="SELECT email FROM base_datos_email WHERE estado LIKE 'activo' 
		AND fecha_actualizacion >= '".$fecha."' AND email NOT LIKE '%@udec.cl'  AND email NOT LIKE '%@ucv.cl'";
		//echo $sql."<br>";
		return envioEmail::hacerConsulta($sql);	
	}
	
	function actualizarCreacionFecha()
	{		
		$sql ="SELECT email,fecha_actualizacion
				FROM base_datos_email
				WHERE creacion_fecha = '0000-00-00 00:00:00' "; 
		//echo $sql;
		$emails = envioEmail::hacerConsulta($sql);
		if(count($emails) > 0 && is_array($emails))
		{
			for($i=0; $i < count($emails);$i++)
			{
				$sql = "UPDATE  base_datos_email SET creacion_fecha = '".$emails[$i]['fecha_actualizacion']."' WHERE email = '".$emails[$i]['email']."'"; 
				//echo $sql.'<br>';
				GeneralSQLQuery($sql,false,false);
			}
		}
	}

	function obtenerCorreosUltimaActualizacion()
	{
		$fecha = envioEmail::obtenerUltimaFechaRevision();
		$sql ="SELECT email FROM base_datos_email WHERE  fecha_actualizacion >= '".$fecha."'  ";
		//echo $sql;
		return envioEmail::hacerConsulta($sql);	
	}
	
	function obtenerFiltroSeleccionTipo($tipo)
	{
		$selecciones = array();
		for($i=0; $i < count($tipo); $i++)
		{ 
			$aux = str_replace(array('ciae_','interesados_','general_','area_'),array('','','',''),$tipo[$i]['tipo_base']);
			/*$aux= explode('_',$aux);
			print_r($aux);*/
			//echo $aux."<br>";
		}
		
		
		
		$selecciones = array('magister','genero','mejoramiento','liderazgo','diplomados','cambio_climatico','calidad','general','lenguaje','escritura','docentes','estudiantes','modelamiento','tic','matematica','ciencias','quimica','fisica','basica','formacion_inicial','parvulos','parvularia','neurociencia','psicopedagogia','diferencial','stem','arpa','tadi','educacion_superior','primera_infancia','mejoramiento','reforma','formacion_docente','instituciones','nacional','ensenanza_aprendizaje','investigadores','politicas_publicas','politicas','educadores_tradicionales','jefe_carrera','pedagogias_carrera_basica','pedagogias_carrera','pedagogias_carrera_media','pedagogias','comunicaciones','biologia', 'musica','resolucion_problemas',"inicia","pedagogias_jefe_carrera","arte",'autoridades','universidades','alcaldes','colegios','directores','sostenedores','concejales','corporaciones_municipales','daem');
		return $selecciones;
	}
	
	function obtenerListadoTipos()
	{
		$sql = "SELECT   *  FROM view_bases_datos_tipo WHERE tipo_base NOT LIKE '%inscripcion%' AND tipo_base NOT LIKE '%invitacion%' AND tipo_base NOT LIKE '%inactivo%'  ORDER BY tipo_base; "; 
		return envioEmail::hacerConsulta($sql);
	}   
	
	function actualizacionFechaRevision()
	{
		$sql = "UPDATE extra_ultima_vista SET ultima_fecha = '".date('Y-m-d H:i:s',mktime(date("H")-1, date("i"), date("s"), date("m")  , date("d"), date("Y")))."'";	
		echo $sql;
		GeneralSQLQuery($sql,false,false);
	}
	
	function cuantosInactivo()
	{
		$sql = "SELECT count( * ) as total
				FROM  base_datos_email
				WHERE estado LIKE 'activo'
			 ";
		$result = envioEmail::hacerConsulta($sql);
		return $result[0]['total'];
	}
	
	
	function obtenerTotalTodos()
	{
		$sql = "SELECT estado , count(*) as total   FROM base_datos_email  GROUP BY estado";
		$result = envioEmail::hacerConsulta($sql); 

		return $result;		
	}
	
	function consultarEmailCompleto($email)
	{
		$sql = "SELECT * FROM base_datos_email WHERE email = '".trim($email)."'";	
		envioEmail::registrarLogsUrl('CONSULTA',"SQL-SELECT",$sql);	 
		$result = envioEmail::hacerConsulta($sql);  
		if(!is_array($result) || count($result)==0)
		{			
			$sql = "INSERT INTO base_datos_email (email,creacion_lista) VALUES ('".trim($email)."', 'ciae_general'); ";
			GeneralSQLQuery($sql,false,false);			
			$sql = "SELECT * FROM base_datos_email WHERE email = '".trim($email)."'"; 
			$result = envioEmail::hacerConsulta($sql); 
		} 
		
		$sql = "SELECT * FROM base_datos_email_tipo WHERE email = '".trim($email)."'";
		$result2 = envioEmail::hacerConsulta($sql);
		if(!is_array($result2) || count($result2)==0)
		{	 
			$sql = "INSERT INTO base_datos_email_tipo (email, tipo_base) VALUES ('".trim($email)."', 'ciae_general'); ";			
			GeneralSQLQuery($sql,false,false);
			$sql = "SELECT * FROM base_datos_email_tipo WHERE email = '".trim($email)."'";
			$result2 = envioEmail::hacerConsulta($sql);
		}

		$sql = "SELECT * FROM envio_email_destino WHERE email = '".trim($email)."'";
		$result3 = envioEmail::hacerConsulta($sql);
		
		
		$salida = array($result,$result2,$result3);
		//print_r($salida);
		 
		envioEmail::agregarPhplist($email);
		
		return $salida;
	}  
	
	function registrarLogsUrl($sitio,$action,$msg)
	{ 
		$post = print_r($_POST,true);
		$msg = str_replace("'","\'",$msg); 
		sleep(2);
		$sql = "INSERT INTO `ciaecl_correoweb`.`common_logs` (time_log,ip,ip_extra,sitio,username,action,msg,post) VALUES ('".time()."', '".SIDTOOLPost::cleanSqlInjection($_SERVER['REMOTE_ADDR'])."', '".SIDTOOLPost::cleanSqlInjection($_SERVER['SERVER_ADDR'])."','".$sitio."','mail_list','".strtoupper($action)."','".$msg."','".$post."'); ";
		
		// echo $sql;
		GeneralSQLQuery($sql,false,false);   
		 
		$sql = "INSERT INTO `ciaecl_correoweb`.`common_logs_url` (url,uri,browser,fecha,username,ip_address,ip_address_extra) VALUES ('".$_SERVER['SERVER_NAME']."','".Funciones::cleanSqlInjection($_SERVER['REQUEST_URI'],true)."','".SIDTOOLPost::cleanSqlInjection($_SERVER['HTTP_USER_AGENT'])."','".time()."','mail_list', '".SIDTOOLPost::cleanSqlInjection($_SERVER['REMOTE_ADDR'])."', '".SIDTOOLPost::cleanSqlInjection($_SERVER['SERVER_ADDR'])."'); ";
		 //echo $sql;
		GeneralSQLQuery($sql,false,false);   

	}
	
	function inactivarEmail($cond,$caso='inactivacion por rebote') 
	{ 
		if(trim($cond) != '')
		{
			//echo "--- ".$cond." --";
			$sql = "UPDATE  base_datos_email SET estado = 'inactivo', comentario = '".$caso."' WHERE  estado = 'activo' AND (".trim($cond).");";  
			$sql = "UPDATE  base_datos_email SET estado = 'inactivo', comentario = '".$caso."-".time()."' WHERE  (".trim($cond).");";  
			$salida = $sql."\n\n<br><br>" ;
			GeneralSQLQuery($sql,false,false);   
			envioEmail::registrarLogsUrl($caso,"SQL-UPDATE",$sql);	 


			$sql = "UPDATE IGNORE  base_datos_email_tipo SET tipo_base = 'ciae_0_inactivos' WHERE ".trim($cond).";"; 
			$salida .= $sql."\n\n<br><br>" ;
			GeneralSQLQuery($sql,false,false);  
			envioEmail::registrarLogsUrl($caso,"SQL-UPDATE",$sql);

			/*$sql = "DELETE FROM base_datos_email_tipo WHERE ".trim($cond)." AND tipo_base NOT lIKE 'ciae_0_inactivos';"; 
			$salida .= $sql."\n\n<br><br>" ;
			GeneralSQLQuery($sql,false,false);   */
			 
			$sql = "UPDATE envio_email_destino SET estado = 'rebote' WHERE estado != 'rebote' AND  ".trim($cond).";"; 
			$salida .= $sql."\n\n<br><br>" ;
			GeneralSQLQuery($sql,false,false); 
			envioEmail::registrarLogsUrl($caso,"SQL-UPDATE",$sql);
			
			
			$sql = "UPDATE envio_email_destino SET estado = 'rebote' WHERE estado != 'rebote' AND  ".trim($cond).";"; 
			$salida .= $sql."\n\n<br><br>" ;
			GeneralSQLQuery($sql,false,false); 
			envioEmail::registrarLogsUrl($caso,"SQL-UPDATE",$sql);
			
			
			
			$aux_cond =  trim(str_replace(array(" OR "," email = "),array(" ",");\nINSERT IGNORE INTO base_datos_email (estado,comentario,creacion_lista,email) VALUES ('inactivo','".$caso." nuevo','ciae_0_inactivos',"),$cond).");");
			$sql = substr($aux_cond,2);
			$aux_cond = $sql;
			$salida .= $sql."\n\n<br> " ; 
			
			
			
			
			
			$sql = "UPDATE  base_datos_email SET estado = 'inactivo', comentario = 'Inactivacion por eliminacion de suscripcion' WHERE  estado = 'inactivo' AND (".trim($cond).");";  
			$salida .= $sql."\n\n<br> " ; 
			
	 
			
			$sql = str_replace("INSERT IGNORE INTO base_datos_email (estado,comentario,creacion_lista,email) VALUES ('inactivo','inactivacion por rebote nuevo','ciae_0_inactivos',","INSERT IGNORE INTO base_datos_email_tipo (tipo_base,email) VALUES ('ciae_0_inactivos',",$aux_cond); 
			$salida .= $sql."\n\n<br> " ; 
			
			//envioEmail::eliminarPhplist(str_replace(array("email = '"," OR ","'"),array(" "," "," "),$cond));		
			
			return $salida;
		}
	}   
	
	function reemplazarEmail($email,$email_nuevo)
	{		  
		$sql = "UPDATE IGNORE base_datos_email SET email = '".trim($email_nuevo)."'  WHERE email = '".trim($email)."' "; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);
		
		envioEmail::registrarLogsUrl('REEMPLAZO',"SQL-UPDATE",$sql);
		
		$sql = "UPDATE IGNORE base_datos_email SET estado = 'inactivo' , comentario ='inactivacion por reemplazo' WHERE email = '".trim($email)."' "; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);
		
		$sql = "UPDATE IGNORE base_datos_email_tipo SET email = '".trim(strtolower($email_nuevo))."' WHERE email = '".trim($email)."'"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false); 
		
		$sql = "UPDATE IGNORE envio_email_destino SET email = '".trim(strtolower($email_nuevo))."' WHERE email = '".trim($email)."'"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false); 
		
		$sql = "INSERT  IGNORE  INTO  base_datos_email ( email , estado,comentario ) VALUES (  '".trim(strtolower($email))."', 'inactivo', 'inactivacion por reemplazo ".trim($email_nuevo)."' )"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);
		
		$sql = "INSERT  IGNORE  INTO  base_datos_email_tipo ( email , tipo_base ) VALUES (  '".trim(strtolower($email))."', 'ciae_0_inactivos'  )"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);
		 
		$sql = "INSERT  IGNORE  INTO  base_datos_email ( email , estado,comentario ) VALUES (  '".trim(strtolower($email_nuevo))."', 'activo', '' )"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false); 
		
		$sql = "INSERT IGNORE INTO envio_email_destino SELECT 
		caso_envio, fecha_estado,'pendiente' as estado, '".trim($email_nuevo)."' as email,'".md5(trim(strtolower($email_nuevo)))."' as email_md5,'0' as vistas, nombre, apellidos, tratamiento, '' as email_secundario,cargo ,'' as mensaje, '' as remitente FROM envio_email_destino  WHERE email = '".trim(strtolower($email))."'"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false); 

		$sql = "UPDATE IGNORE envio_email_destino SET estado = 'rebote' WHERE email = '".trim(strtolower($email))."'"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false); 
		
		
		//envioEmail::agregarPhplist($email_nuevo);
		
		
		//envioEmail::eliminarPhplist($email);
	}
	
	function eliminarPhplist($email)
	{	
		$archivo = "http://listasciae.uchile.cl/lists/uelt.php?u=e889760b9a85dc871b2052565fd1147c&email_eliminar=".trim(strtolower($email));
		// echo $archivo;
		return file_get_contents($archivo);		 			
	}
	
	function agregarPhplist($email)
	{ 
		return file_get_contents("http://listasciae.uchile.cl/lists/uelt.php?u=e889760b9a85dc871b2052565fd1147c&email_agregar=".trim(strtolower($email)));		
	}
	
	function agregarEmailSimple($email,$nombre,$apellidos)
	{
		$sql = "INSERT IGNORE INTO  base_datos_email (fecha_actualizacion, email,   nombre,apellidos ) VALUES ( '".date('Y-m-d H:i:s')."','".trim(strtolower($email))."',   '".trim($nombre)."', '".trim($apellidos)."');"; 
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);
		envioEmail::agregarPhplist($email);
		envioEmail::registrarLogsUrl('AGREGAR',"SQL-INSERT",$sql);	 
	}
 
	function agregarEmail($email,$nombre,$apellidos,$tipo_base,$institucion='',$cargo='',$telefono='',$actividad='')
	{
		$email = trim($email);
		$sql = "SELECT email FROM base_datos_email WHERE email = '".trim($email)."'";
		$result = envioEmail::hacerConsulta($sql);
		if(!is_array($tipo_base))
		{
			$tipo_base['0'] = 'ciae_general';
		}
		
		if(is_array($result) && count($result) > 0)
		{
			/* YA EXISTE Y NO SE INGRESA */
			//print_r($result);
			echo "Ya existe \n\n" ;
			$actualizar = false;
			
			$sql = "UPDATE IGNORE base_datos_email SET fecha_actualizacion = '".date('Y-m-d H:i:s')."' "; 
			if(trim($nombre) != '')
			{				
				$actualizar = true;
				$sql .= ", nombre =   '".trim($nombre)."' ";
			}
			
			if(trim($apellidos) != '')
			{				
				$actualizar = true;
				$sql .= ", apellidos =   '".trim($apellidos)."' ";
			}
			
			if(trim($actividad) != '')
			{				
				$actualizar = true;
				$sql .= ", actividad =   '".trim($actividad)."' ";
			}
			
			if(trim($institucion) != '')
			{				
				$actualizar = true;
				$sql .= ", institucion =   '".trim($institucion)."' ";
			}
			
			if(trim($cargo) != '')
			{				
				$actualizar = true;
				$sql .= ", cargo_posicion =   '".trim($cargo)."' ";
			}
			if(trim($telefono) != '')
			{				
				$actualizar = true;
				$sql .= ", telefono =   '".trim($telefono)."' ";
			}
			
			$sql .=  " WHERE email = '".trim($email)."';"; 
			if($actualizar)
			{
				echo $sql."\n\n" ;
				GeneralSQLQuery($sql,false,false); 
			}
		}
		else
		{ 
			$sql = "INSERT IGNORE INTO  base_datos_email (fecha_actualizacion,creacion_fecha, creacion_lista, email,   nombre,apellidos,institucion,cargo_posicion,telefono) VALUES ( '".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".$tipo_base['0']."','".trim(strtolower($email))."',   '".trim($nombre)."', '".trim($apellidos)."','".trim($institucion)."','".trim($cargo)."','".trim($telefono)."');"; 
			
			echo $sql."\n\n" ;
			GeneralSQLQuery($sql,false,false);
			envioEmail::registrarLogsUrl('AGREGAR',"SQL-INSERT",$sql);	
		} 
		
		if(is_array($tipo_base))
		{
			for($i=0; $i < count($tipo_base); $i++)
			{
				$sql = "REPLACE INTO  base_datos_email_tipo ( email,  tipo_base) VALUES ( '".trim($email)."',   '".$tipo_base[$i]."');"; 
				echo $sql."\n\n" ;
				GeneralSQLQuery($sql,false,false);
			} 	
		}  
		envioEmail::agregarPhplist($email);
		
	}	 
	 
	
	function listaEmailActivo($tipo_base)
	{
		$where_especial = '';
		for($i = 0; $i < count($tipo_base); $i++)
		{
			if($i > 0)
			{
				$where_especial .= ' OR ';
			}
			$where_especial .= "tipo_base = '".$tipo_base[$i]."'";
			 
		}	
		
		$sql = "SELECT DISTINCT email   
				FROM view_bases_datos_email	
				WHERE ".$where_especial."
				ORDER BY RAND();";  
		
		$sql = "SELECT DISTINCT email   
				FROM view_bases_datos_email	
				WHERE (".$where_especial.") AND email NOT LIKE '%@ciae.uchile.cl' AND email NOT LIKE '%@ciae.cl' 
				 
				ORDER BY RAND();";  
			 	// echo $sql;
		$output = envioEmail::hacerConsulta($sql);
		//array_unshift($output, array('email'=>"lista-seminarios@ciae.uchile.cl")); 
		return $output;  
	}
	  
	function hacerConsulta($sql)
	{
		$output = GeneralSQLQuery($sql);
		// echo $sql.'<br>'; 		print_r($output);
		return ($output);		
	} 
	
	function inactivarEmailGeneral()
	{
		return;
		$sql = "UPDATE  base_datos_email SET nombre = trim(nombre) WHERE estado = 'activo' ;";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
		$sql = "UPDATE base_datos_email SET apellidos = trim(apellidos) WHERE estado = 'activo'  ;";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);   
		$sql = "UPDATE base_datos_email SET email = LOWER(trim(email))   WHERE estado = 'activo' ;";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
		$sql = "UPDATE base_datos_email_tipo SET email = LOWER(trim(email))   ;";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
		//echo $sql."\n\n" ;
		$sql = "UPDATE base_datos_email SET estado = 'inactivo' , comentario = 'inactivacion por formato-".time()."' WHERE  (email NOT LIKE '%@%.%');";
		GeneralSQLQuery($sql,false,false);               
		//echo $sql."\n\n" ;
		$sql = "UPDATE base_datos_email SET estado = 'inactivo' , comentario = 'inactivacion por formato-".time()."' WHERE   (email LIKE '' OR email LIKE '%&%' OR email LIKE '@%' OR email LIKE '%:%' OR email LIKE '% %' OR email LIKE '.%' OR email LIKE '%.' OR email LIKE '%;%'  OR email LIKE '%&%'  OR email LIKE '%,%' OR email LIKE '%*%' OR email LIKE '*%');  ";
		GeneralSQLQuery($sql,false,false); 
		//echo $sql."\n\n" ; 
		
		$where_formato = "  email LIKE '%@%.ru' OR    email LIKE '%@%.google.com' OR  email LIKE '%@%.vcom' OR  email LIKE '%@google.com' OR email LIKE '%@hotmai.com'  OR  email LIKE '%@googlemail.com'   OR  email LIKE '%@%.hotmail.com'    OR email LIKE '%postmaster%' OR email LIKE '%.pdf'  OR email LIKE '%@webmail.ucv.cl'  OR email LIKE '%_cotizacion_%' OR email LIKE  '%.jpg%'  OR email LIKE  '%.gif%'  OR email LIKE  '%.png%' OR email LIKE '%@126.com'   OR email LIKE '%@homero%' OR email LIKE '%@163.com'  OR email LIKE '%@phx.gbl%'  OR email LIKE '%@insightly%'	OR email LIKE '%@email.amazonses.com'	OR email LIKE '%-%-%-%@gmail.com' OR email LIKE '%@sigma.inacap.cl' OR email LIKE  '%@%google.com'  OR email LIKE '%@mail.senegocia.com' OR email LIKE '%@%prod.outlook.com' OR email LIKE '%@%google.com' OR email LIKE 'part%@ubiobio.cl'OR email LIKE '%@%MAIL%.mineduc.cl'  OR email LIKE '%@amazonses.com'  OR email LIKE '%@%.info' OR email LIKE '%@googlegroups.com' OR email LIKE 'mailto%' OR email LIKE '%reply%' OR email LIKE '%@email.android.com' OR email LIKE '%github.com%' OR email LIKE '%.jpg%' OR email LIKE '%.JavaMail.%' OR email LIKE '%googlegroups%' OR email LIKE '%@%mail%yahoo.com'  OR email LIKE '%@ussdtcsrvexc33.uss.cl' OR email LIKE '%@phpmailer%' OR email LIKE '%@listasciae.uchile.cl' OR email LIKE '%@ie.uchile.cl'  OR email LIKE '%@udec.cl'  ";
		
		$sql = "UPDATE base_datos_email SET estado = 'inactivo' , comentario = 'inactivacion por formato-".time()."' WHERE   (email LIKE 'eliminar-%' OR email LIKE '@arpamat.cl' OR email LIKE '-%' OR email LIKE '.%'  OR email LIKE '%@bancoestado.cl' OR email LIKE  '%@tadi%' OR email LIKE '%@@%' OR email LIKE '%@ciae.uchile.cl'   OR email LIKE '%@ciae.cl'     OR   email LIKE '%@bounce.linkedin.com' OR email LIKE  '%@ciae%'  OR email LIKE  '%@listasciae%'  OR email LIKE '%@linkedin.com'  OR email LIKE '%@mejormatematica.cl' OR email LIKE  '%@godaddy.com' OR email LIKE 'tadi.cl@mail.%' OR email LIKE '%@mail.gmail.com' OR email LIKE '%[%'  OR email LIKE '@%' OR email LIKE '%@%surveymonkey.com' OR email LIKE '%@ivannunezprieto.cl' OR  email LIKE '%@www.ciae' OR email LIKE '%@ie.uchile.cl'  OR email LIKE '%@udec.cl'  OR email LIKE '%@arpamat.cl' OR email LIKE '%@twitter.com' OR email LIKE '%facebook%' OR  email LIKE '%contabilidad%' OR email LIKE '%.templatetenant%' OR email LIKE '%@fmail.cl' OR ".$where_formato.");";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false); 		
		$sql = "DELETE FROM  base_datos_email_tipo WHERE    ".$where_formato.";";
		//echo $sql."\n\n" ;
		//GeneralSQLQuery($sql,false,false);  
		$sql = "DELETE FROM  base_datos_email  WHERE estado = 'inactivo' AND (  ".$where_formato.");";
		//echo $sql."\n\n" ;
		//GeneralSQLQuery($sql,false,false); 
		$sql = "DELETE FROM  base_datos_email_tipo WHERE  email = '' ;";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
		$sql =  "DELETE FROM  base_datos_email WHERE  email = '' ;";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
		$sql = "UPDATE base_datos_email SET tratamiento = 'a'   WHERE genero = 'F' AND tratamiento LIKE '';";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
		$sql = "UPDATE base_datos_email SET tratamiento = 'o'   WHERE genero = 'M' AND tratamiento LIKE '';  ";
		//echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
		$sql = "INSERT IGNORE INTO base_datos_email_tipo   (email,tipo_base) 
		SELECT e.email,'ciae_general' as  tipo_base
		FROM (SELECT email FROM base_datos_email WHERE estado = 'activo')  as e LEFT JOIN base_datos_email_tipo as t  ON e.email = t.email
		WHERE t.tipo_base IS NULL ";
		echo $sql."\n\n" ;
		GeneralSQLQuery($sql,false,false);  
	}  
	
	
	function registroTxtVisitas()
	{ 
	
		$actual_fichero = print_r($_GET, true)."\n\n".print_r($_POST, true)."\n\n".print_r($_SERVER, true)."\n\n".print_r($_SESSION, true)."\n\n".print_r($_COOKIE, true);

		if($_SERVER[REMOTE_ADDR] != '200.89.68.134' && $_SERVER['PHP_SELF'] != '/mail_list/test.php')
		{
			/* no es la ip de la UChile*/
			 envioEmail::registrarLogsUrl($_SERVER['PHP_SELF'],"TXT-UPDATE",$actual_fichero); /*($sitio,$action,$msg)*/
	
		
			/* $fichero = '/home/ciaecl/public_html/mail_list/salida.txt'; 
			$actual = "";
			$actual = file_get_contents($fichero); 
			$actual .= "******************INICIO ".strtoupper($_SERVER['PHP_SELF'])."************************n\n".$mensaje_formulario."\n\n".$actual_fichero."*******************CIERRE ".strtoupper($_SERVER['PHP_SELF'])."***********************\n\n"; 
			file_put_contents($fichero, $actual);  */
		} 
	} 
} 


envioEmail::registroTxtVisitas();
?> 