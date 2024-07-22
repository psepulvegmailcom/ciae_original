<?php

class envioCorreo
{	  
    public function __CONSTRUCT()
	{
        $this->con = new ConexionBaseDatos('DB_LOCAL');
        $this->pdo = $this->con->connect();		
		$this->funciones = new FuncionesGenerales(); 
    } 
	
	public function obtenerDatos($sql)
	{
		return $this->con->obtenerDatos($sql);  
	}
	
	public function ejecutarQuery($sql)
	{
		return $this->con->ejecutarQuery($sql); 
	}
	
	public function obtenerInformacionDetalle($caso_envio)
	{		
		$sql = "SELECT *
    	 FROM view_envio_detalle_informe
		 WHERE caso_envio = '".$caso_envio."'"; 
		$salida = $this->con->obtenerDatos($sql);  
		return $salida;
	} 
	
	function agregarListadoEmail($listado)
	{		
		echo "ACTIVAR<br>";
		print_r($listado);
		$sql = "";
		foreach ($listado as $email => $email2)
		{
			//echo "Agregando ".$email."<br>";
			$url = "http://listasciae.uchile.cl/lists/uelt.php?u=e889760b9a85dc871b2052565fd1147c&email_agregar=".trim(strtolower($email));
			//$out = file_get_contents($url);	 
			echo $url."\n";
			//$out =  file_get_contents($url);
			$sql .= "INSERT IGNORE INTO  base_datos_email (  creacion_lista, email,   nombre,apellidos,institucion,cargo_posicion,telefono) VALUES (  'ciae_general_contacto','".trim($email)."',   '', '','','','');";
			//$this->con->obtenerDatos($sql);  

			$sql .= "INSERT IGNORE  INTO   base_datos_email_tipo ( email,  tipo_base) VALUES ( '".trim($email)."',   'ciae_general_contacto');";
			//$this->con->obtenerDatos($sql);  
		}
		if(trim($sql) != '')
			$this->con->obtenerDatos($sql); 
	}
	
	function inactivarListadoEmail($listado,$mensaje='inactivacion por rebote')
	{ 
		echo "INACTIVAR<br>\n";
		print_r($listado);
		 $sql = "";
		 $fecha = date("Y-m-d H:i:s",mktime(date("H")-4, date("i"), date("s"), date("m")  , date("d"), date("Y")));
		foreach ($listado as $email => $email2)
		{
			//echo "eeeeee ".preg_match("/^([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$/", $email);
			if(preg_match("/^([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$/", $email))
			{	
				//echo "eliminando ".$email."<br>";
				$url = "http://listasciae.uchile.cl/lists/uelt.php?u=e889760b9a85dc871b2052565fd1147c&email_eliminar=".trim($email);
				echo $url."\n";
				//$out =  file_get_contents($url);
				
				
				
				$sql .= "INSERT IGNORE INTO  base_datos_email (  creacion_lista, email, fecha_actualizacion, estado,comentario) VALUES (  'ciae_0_inactivos','".trim($email)."', '".$fecha."',  'inactivo','".$mensaje."');";
				
				$sql .= "UPDATE base_datos_email SET estado = 'inactivo', comentario ='".$mensaje."-".time()."', fecha_actualizacion = '".date("Y-m-d H:i:s",mktime(date("H")-4, date("i"), date("s"), date("m")  , date("d"), date("Y")))."' WHERE   email LIKE '".trim($email)."' ;";
				//$sql .= "UPDATE base_datos_email SET estado = 'inactivo', comentario ='inactivacion por rebote', fecha_actualizacion = '".$fecha."' WHERE   email LIKE '".trim($email)."' AND estado = 'activo';";
				
				//$this->con->obtenerDatos($sql); 
				
				//$sql .= "INSERT IGNORE  INTO   base_datos_email ( email,  estado, comentario,creacion_lista) VALUES ( '".trim($email)."',   'inactivo','inactivacion por rebote',   'ciae_0_inactivos');";
				//$this->con->obtenerDatos($sql); 
				//echo $sql."<br>";
				$sql .= "UPDATE envio_email_destino SET estado = 'rebote' WHERE   email LIKE '".trim($email)."' AND estado != 'rebote';";
				//$this->con->obtenerDatos($sql); 
				//echo $sql."<br>";
				//$sql .= "INSERT IGNORE  INTO   envio_email_destino ( email,  estado,caso_envio) VALUES ( '".trim($email)."',   'rebote',   'ciae_0_inactivos');";
				//echo $sql."<br>";
				//$this->con->obtenerDatos($sql); 
				
				$sql .= "INSERT IGNORE  INTO   base_datos_email_tipo ( email,  tipo_base) VALUES ( '".trim($email)."',   'ciae_0_inactivos');";
				//$this->con->obtenerDatos($sql);   
			}
		}
		if(trim($sql) != '')
		{
			//echo $sql;
			$this->con->obtenerDatos($sql); 
		}
	}  


	public function obtenerTotalTodos()
	{
		$sql = "SELECT estado , count(*) as total   FROM base_datos_email  GROUP BY estado";
		return $this->con->obtenerDatos($sql);  
	}
	
	public function obtenerTodos($fecha_desde='')
	{
		$sql = "SELECT * FROM base_datos_email   ORDER BY `fecha_actualizacion` DESC";
		if(trim($fecha_desde) != '')
		{
			$sql = "SELECT * FROM base_datos_email WHERE `fecha_actualizacion` > '".$fecha_desde."' ORDER BY `fecha_actualizacion` DESC";
		}
		return $this->con->obtenerDatos($sql);  
	}
	
	public function obtenerContactoPorEnviar()
	{
		$sql = "INSERT IGNORE INTO  `ciaecl_correoweb`.`envio_email_destino` (caso_envio,estado,email,  email_md5,nombre,   mensaje ) 
	SELECT 'formulario_contacto' as caso_envio, 'no_enviado' as estado, email, md5(email) as email_md5, nombre, campo_extra1 as mensaje FROM `ciaecl_ciae`.
`site_inscripcion` WHERE `tipo_inscripcion` LIKE 'contacto_%' AND campo_extra1 != ''  ;";
		$this->con->ejecutarQuery($sql); 
		
		$sql = "SELECT * FROM `view_envio_contacto`    "; 
		return $this->con->obtenerDatos($sql);  
	}
	
	
	public function obtenerInactivosPorEnviar()
	{
		$sql = "SELECT * FROM `view_envio_estados_no_enviados_inactivos`    "; 
		return $this->con->obtenerDatos($sql);  
	}
	
	public function obtenerInactivos($fecha_desde='',$campos='*',$order='fecha_actualizacion DESC')
	{
		$sql = "SELECT ".$campos." FROM `view_bases_inactivos`   ORDER BY ".$order;
		if(trim($fecha_desde) != '')
		{
			$sql = "SELECT ".$campos." FROM `view_bases_inactivos` WHERE `fecha_actualizacion` > '".$fecha_desde."' ORDER BY ".$order;
		}
		//echo $sql;
		return $this->con->obtenerDatos($sql);  
	}
	 
	
	public function obtenerNuevosActivosInactivosGrupos()
	{		
		$fecha_creacion = date("Y-m-d  H:i:s",mktime(date("H")-1, date("i"), date("s"), date("m")  , date("d"), date("Y")));//." 00:00:00";
		$sql = "SELECT fecha_grupos_masivos FROM `ciaecl_correoweb`.`extra_ultima_vista`";
		$fechas = $this->con->obtenerDatos($sql); 
		$fecha = $fechas[0]['fecha_grupos_masivos'];
		
		$grupo = array("a_masivo_01","a_masivo_02","a_masivo_03","a_masivo_03","a_masivo_012","a_masivo_04","a_masivo_05","a_masivo_06","a_masivo_07","a_masivo_08","a_masivo_013","a_masivo_09","a_masivo_014","a_masivo_010","a_masivo_011","a_masivo_011");
		$filtro = array(" email REGEXP '^(a)' "," email REGEXP '^(b|d)' "," email REGEXP '^(ca)' "," email REGEXP '^(k)' ","   email REGEXP '^(c)' AND email NOT REGEXP '^(ca)' ","  email REGEXP '^(e|f)' AND email NOT REGEXP '^(es)' ","   email REGEXP '^(g|h|i)' ","    email REGEXP '^(j)' ","   email REGEXP '^(l|o|q|es)'  "," email REGEXP '^(ma)' "," email REGEXP '^(m)' AND email NOT REGEXP '^(ma)' ","  email REGEXP '^(n|r)'  ","  email REGEXP '^(p)'  ","   email REGEXP '^(s|t)' ","  email REGEXP '^(u|v|w|x|y|z)'  ","  email REGEXP '^[0-9]' ");
		
		$where_comun = " email NOT LIKE '%@ciae.uchile.cl' AND email LIKE '%@%.%' AND email NOT LIKE '% %'  AND email NOT LIKE '%?%' AND email NOT LIKE '%&%' AND  email NOT LIKE '%>%' AND  email NOT LIKE '%:%' AND  email NOT LIKE '%,%'  AND  email NOT LIKE '%@%@%'  AND  email NOT LIKE '%.'   AND  email NOT LIKE '%..%'  AND  email NOT LIKE '%	%'  AND    email NOT LIKE '%@.%'  AND     email NOT LIKE '%\%%'  AND `email` NOT LIKE '%\"%'  AND   ";
		
		$sql = "";
		$update = '';
		for($i=0; $i < count($grupo); $i++)
		{
			$update .=" UPDATE `ciaecl_correoweb`.`base_datos_email` SET  grupo_masivo= '".$grupo[$i]."@ciae.uchile.cl' 
			WHERE  ".$where_comun."   ".$filtro[$i]." AND grupo_masivo = '' ;
			"; 

			/*$sql .= "SELECT CONCAT('".$grupo[$i]."@ciae.uchile.cl,',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_activos` 
WHERE  ".$where_comun."   ".$filtro[$i]." AND fecha_actualizacion > '".$fecha."'  UNION \n";
			 $sql .= "SELECT CONCAT('".$grupo[$i]."@ciae.uchile.cl,',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`view_bases_inactivos` 
WHERE  ".$where_comun."   ".$filtro[$i]." AND fecha_actualizacion > '".$fecha."' AND creacion_fecha  < '".$fecha_creacion."' ";
		


			$sql .= "SELECT CONCAT(grupo_masivo,',',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`base_datos_email` 
WHERE  estado = 'activo' AND `grupo_masivo` != '' AND  fecha_actualizacion > '".$fecha."' 
UNION \n";
			$sql .= "SELECT CONCAT(grupo_masivo,',',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`base_datos_email` 
WHERE  estado = 'inactivo' AND   `grupo_masivo` != '' AND    fecha_actualizacion > '".$fecha."' AND creacion_fecha  < '".$fecha_creacion."' ";

			$aux = count($grupo)-1;
			if($i < $aux)
			{
				$sql .= "\n UNION \n";
			}*/
		} 
		$update .= "UPDATE `ciaecl_correoweb`.`base_datos_email` SET  grupo_masivo= 'sin_masivo@ciae.uchile.cl' 
			WHERE   grupo_masivo = ''  ";
		$sql = "SELECT CONCAT(grupo_masivo,',',email,',MEMBER,USER') as grupos FROM `ciaecl_correoweb`.`base_datos_email` 
WHERE  estado = 'activo' AND `grupo_masivo` != '' AND   grupo_masivo != 'sin_masivo@ciae.uchile.cl' AND  fecha_actualizacion > '".$fecha."' 
UNION \n";
		$sql .= "SELECT CONCAT(grupo_masivo,',',email,',MANAGER,USER') as grupos FROM `ciaecl_correoweb`.`base_datos_email` 
WHERE  estado = 'inactivo' AND   `grupo_masivo` != '' AND  grupo_masivo != 'sin_masivo@ciae.uchile.cl' AND  fecha_actualizacion > '".$fecha."'   ;";
		// echo $sql;
		$this->con->obtenerDatos($update); 
		 //echo $update;
		return $this->con->obtenerDatos($sql);  
	}
	
	
	public function obtenerActivos($fecha_desde='',$campos='*',$order='fecha_actualizacion DESC')
	{
		$sql = "SELECT ".$campos." FROM `view_bases_activos`   ORDER BY ".$order;
		if(trim($fecha_desde) != '')
		{
			$sql = "SELECT * FROM `view_bases_activos` WHERE `fecha_actualizacion` > '".$fecha_desde."' ORDER BY ".$order;
		}
		//echo $sql;
		return $this->con->obtenerDatos($sql);  
	}
 
	
	public function obtenerRemitentes($total)
	{
		$limit = "LIMIT 0, ".round($total);
		$limit = "";
		$sql = "SELECT * FROM view_envio_remitentes WHERE remitente != 'informaciones17@ciae.uchile.cl' AND remitente != 'informaciones25@ciae.uchile.cl'  AND remitente != 'informaciones32@ciae.uchile.cl'
		AND remitente != 'informaciones19@ciae.uchile.cl' AND remitente != 'informaciones21@ciae.uchile.cl' AND remitente != 'informaciones28@ciae.uchile.cl' AND remitente != 'informaciones16@ciae.uchile.cl' AND remitente != 'informaciones34@ciae.uchile.cl' AND remitente != 'informaciones14@ciae.uchile.cl'  AND remitente != 'informaciones37@ciae.uchile.cl'  AND remitente != 'informaciones36@ciae.uchile.cl' AND remitente != 'informaciones26@ciae.uchile.cl' AND remitente != 'informaciones11@ciae.uchile.cl' AND remitente != 'informaciones31@ciae.uchile.cl'   ORDER BY total ASC  ".$limit;
		 $sql = "SELECT * FROM view_envio_remitentes   ORDER BY total ASC LIMIT 0, ".round($total);
		// $sql = "SELECT * FROM view_envio_remitentes   ORDER BY RAND() ";
		
		$sql = "SELECT * FROM envio_email_remitentes WHERE estado = 'activo' ORDER BY total ASC LIMIT 0, ".round($total);
		$output = $this->con->obtenerDatos($sql); 
		$remitentes = array();
		for($i=0; $i < count($output);$i++)
		{
			$remitentes[$i] = $output[$i]['remitente'];
		}
		return $remitentes;
	}
 
 

    public function obtenerListadoDestinatarios($cantidad=2,$caso_envio='')
    {		
		/*PRIORIZAR CIAE */
    	$sql_ciae = "SELECT a.*, b.* 
    	 FROM envio_email_destino as b, envio_email_detalle as a 
		 WHERE a.caso_envio = b.caso_envio AND a.estado = 'activo' AND b.email LIKE '%@ciae.uchile.cl' AND ";
 
    	if(trim($caso_envio) != '')
		{
			$sql_ciae .= " b.caso_envio = '".$caso_envio."' AND ";
		}
		$sql_ciae .= " b.estado ='no_enviado' "; 
		$datos_alumno = $this->con->obtenerDatos($sql_ciae); 
		
		if(is_array($datos_alumno) && count($datos_alumno) > 0)
		{
			return $datos_alumno;
		}
		
		/*PRIORIZAR REGISTRO Y CONFIRMACIONES */
    	/*$sql_ciae = "SELECT a.*, b.* 
    	 FROM envio_email_destino as b, envio_email_detalle as a 
		 WHERE a.caso_envio = b.caso_envio AND a.estado = 'activo' AND (a.caso_envio LIKE '%_registro' OR a.caso_envio LIKE '%_confirmacion') AND ";
 
    	if(trim($caso_envio) != '')
		{
			$sql_ciae .= " b.caso_envio = '".$caso_envio."' AND ";
		}
		$sql_ciae .= " b.estado ='no_enviado' "; 
		$datos_alumno = $this->con->obtenerDatos($sql_ciae); 
		
		if(is_array($datos_alumno) && count($datos_alumno) > 0)
		{
			return $datos_alumno;
		}*/
		
		/*PRIORIZAR OTROS ENVIOS */
		
    	$sql = "SELECT a.*, b.* 
    	 FROM envio_email_destino as b, envio_email_detalle as a , base_datos_email as o
		 WHERE a.caso_envio = b.caso_envio AND a.estado = 'activo' AND o.email = b.email AND o.estado = 'activo' AND ";
 
    	if(trim($caso_envio) != '')
		{
			$sql .= " b.caso_envio = '".$caso_envio."' AND ";
		}
		$sql .= " b.estado ='no_enviado' 
		ORDER BY orden_envio ASC, RAND()  LIMIT  ".$cantidad;  

		$datos_alumno = $this->con->obtenerDatos($sql); 
		//print_r($datos_alumno);
		return $datos_alumno; 
    }
	
    public function marcarEnviadoCorreo($caso_envio,$email,$remitente='')
    {		
		$sql= "UPDATE  envio_email_remitentes SET total = total + 1 WHERE remitente= '".$remitente."' ;";    	
		//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);  
		
    	$sql= "UPDATE envio_email_destino SET email_md5 = '".md5($email)."', estado ='enviado' , remitente= '".$remitente."' WHERE caso_envio = '".$caso_envio."' AND email LIKE '".$email."'  ";
    	//echo "<br>".$sql;
		return $this->con->ejecutarQuery($sql);  		
    }
	
    public function obtenerEstadoEnviadoCorreo($caso_envio,$email)
    {
    	$sql= "SELECT * FROM envio_email_destino WHERE  caso_envio = '".$caso_envio."' AND email ='".$email."'  ";
    	//echo "<br>".$sql;
		return $this->con->obtenerDatos($sql);   
    }	
	
	public function activarEnvioFecha()
	{
		$sql= "UPDATE `envio_email_detalle` SET `estado` = 'activo' WHERE fecha_activar = '".date("Y-m-d")."' AND estado = 'inactivo'  ";
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);   
		$sql= "UPDATE `envio_email_destino` SET `estado`= 'enviado' WHERE `email` LIKE 'list%@ciae.uchile.cl'  ";
    	//echo "<br>".$sql;
		//$this->con->ejecutarQuery($sql);  
	}  
	
	public function desactivarEnvioFecha()
	{
		$sql= "UPDATE envio_email_detalle SET estado= 'inactivo' WHERE fecha_desactivar <= '".date("Y-m-d")."' AND estado = 'activo'  ";
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);    
	} 

    public function eliminarCasoPruebaTest()
    {  
		
		$update = "UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio AND a.estado LIKE 'activo' AND a.`caso_envio` LIKE '%registro'    SET  a.`fecha_desactivar` = DATE_ADD(b.inscripcion_fecha_cierre, INTERVAL -5 DAY);";
		$this->con->obtenerDatos($update);
		$update = "UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio AND  a.estado LIKE 'activo'  AND a.`caso_envio` LIKE '%registro'    SET  a.`fecha_activar` = DATE_ADD(a.fecha_creacion, INTERVAL 0 DAY);";
		$this->con->obtenerDatos($update); 
		$update = "UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio AND a.estado LIKE 'activo' AND a.`caso_envio` LIKE '%confirmacion'    SET  a.`fecha_desactivar` = DATE_ADD(b.inscripcion_fecha_cierre, INTERVAL 1 DAY);";
		$this->con->obtenerDatos($update);
		$update = "UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio AND a.estado LIKE 'activo' AND a.`caso_envio` LIKE '%confirmacion'    SET  a.`fecha_activar` = DATE_ADD(b.inscripcion_fecha_cierre, INTERVAL -5 DAY);";
		$this->con->obtenerDatos($update);
		$update = "UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio AND a.estado LIKE 'activo' AND a.`caso_envio` LIKE '%invitacion'    SET  a.`fecha_desactivar` = DATE_ADD(b.inscripcion_fecha_cierre, INTERVAL 1 DAY);";
		$this->con->obtenerDatos($update); 
		$update = "UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio AND a.`fecha_activar` IS NULL AND a.`caso_envio` LIKE '%invitacion'    SET  a.`fecha_activar` = DATE_ADD(a.fecha_creacion, INTERVAL 0 DAY);";
		$this->con->obtenerDatos($update); 
	
		$sql = "UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio AND a.estado LIKE 'activo' AND b.fecha_inicio< '".date("Y-m-d")."' AND b.caso_envio NOT LIKE '%_certificado'  AND b.caso_envio NOT LIKE '%_informacion'   SET  a.estado = 'inactivo' "; 
		///echo "<br>".$sql."<br>";
		//$this->con->ejecutarQuery($sql); 		
		
		$sql = "	UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio  AND  DATEDIFF(b.fecha_inicio , '".date("Y-m-d")."') = 1 AND b.caso_envio  LIKE '%_registro' AND a.estado LIKE 'activo' SET  a.estado = 'inactivo' 		"; 
		//echo "<br>".$sql."<br>";
		//$this->con->ejecutarQuery($sql); 
		 		
		$sql = "	UPDATE envio_email_detalle as  a INNER JOIN view_envio_detalle_informe as b ON a.caso_envio = b.caso_envio  AND  DATEDIFF(b.fecha_inicio , '".date("Y-m-d")."') = 1 AND b.caso_envio  LIKE '%_confirmacion' AND a.estado LIKE 'inactivo' SET  a.estado = 'activo' 		"; 
		//echo "<br>".$sql."<br>";
		//$this->con->ejecutarQuery($sql);  		 
	
		$sql = "UPDATE envio_email_destino SET  estado ='no_enviado' WHERE estado = 'pendiente'    "; 
		//echo "<br>".$sql."<br>";
		$this->con->ejecutarQuery($sql); 	 

    	$sql = "SELECT * FROM envio_email_detalle  WHERE  estado = 'activo'   ";  
		//$output = $this->con->obtenerDatos($sql);	 
		
		$sql = "UPDATE  `envio_email_detalle` SET `caso_envio_md5` = MD5(caso_envio) WHERE caso_envio_md5 = '' OR `caso_envio_md5` IS NULL ";
		$this->con->ejecutarQuery($sql); 	 
    }	
	
    public function casoPruebaTestCierre($caso_envio)
    {
    	$sql= "UPDATE envio_email_detalle SET estado ='inactivo' WHERE caso_envio = '".$caso_envio."'   ";
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql); 
	}
	
    public function casoPruebaTest($caso_envio)
    {
    	$sql= "UPDATE envio_email_detalle SET estado ='activo' WHERE caso_envio = '".$caso_envio."'   ";
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql); 
    	$sql= "UPDATE envio_email_destino SET estado ='no_enviado' WHERE caso_envio = '".$caso_envio."' AND email LIKE 'psepulve%'  ";
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);  
    	$sql= "UPDATE envio_email_destino SET estado ='pendiente' WHERE  estado ='no_enviado' AND email NOT LIKE 'psepulve%'   ";
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);  
    } 
	
	
	public function unificacionBasesLimpieza()  /* en caso de edición tambien actualizar \home\ciaecl\public_html\mail_list\email_conexion.php */
	{	
		/*	
		$sql_update = "	SELECT DISTINCT email  FROM envio_email_destino WHERE estado LIKE 'rebote' ORDER BY fecha_estado DESC";
		$sql_update = "SELECT   a.email, b.email  FROM envio_email_destino as a, base_datos_email as b WHERE a.email = b.email AND b.estado = 'activo' AND a.estado LIKE 'rebote' ";  
		
		$sql_update = "SELECT   a.email, b.email  FROM envio_email_destino as a, base_datos_email as b WHERE a.email = b.email AND b.estado = 'inactivo' AND a.estado !=  'rebote' ";  
		$sql_update = "	SELECT DISTINCT email  FROM base_datos_email WHERE estado LIKE 'inactivo' ORDER BY `fecha_actualizacion` DESC ";
		*/
		
		
		
		
    	$sql = "SELECT * FROM envio_email_detalle  WHERE  estado = 'activo'   ";  
		$output = $this->con->obtenerDatos($sql);	

		/*$sql= "UPDATE envio_email_detalle SET  orden_envio = '10'     "; 
		$this->con->ejecutarQuery($sql);*/
		if(is_array($output) && count($output)>0)
		{  
			for($i=0;$i < count($output);$i++)
			{   
				$aux = explode("_",$output[$i]['caso_envio']);
				//print_r($aux); 
				if(array_pop($aux) == 'registro')
				{ 
					$sql= "INSERT IGNORE  INTO  `ciaecl_correoweb`.`envio_email_destino` (caso_envio, email , nombre, apellidos, estado  ) 
					SELECT '".implode("_",$aux)."_registro' as `tipo_inscripcion`,`email`, `nombre`, `apellidos`, 'pendiente' as estado  
					FROM `ciaecl_ciae`.`site_inscripcion` 
					WHERE `tipo_inscripcion` LIKE '".implode("_",$aux)."'   ; ";  
					$this->con->ejecutarQuery($sql);
					
					$sql= "INSERT IGNORE INTO   `envio_email_destino` (caso_envio, email , nombre, apellidos, estado ) 
					SELECT '".implode("_",$aux)."_confirmacion' as caso_envio,`email`, `nombre`, `apellidos` ,'no_enviado' as   estado  
					FROM `envio_email_destino`  
					WHERE caso_envio LIKE '".implode("_",$aux)."_registro'   ; ";  
					$this->con->ejecutarQuery($sql);  
				} 
		 
			}
		}		

		/*$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'a' WHERE `tratamiento` IS NULL AND  nombre LIKE '%a' OR  nombre LIKE '%a %'  ;";
		$this->con->ejecutarQuery($sql);  
		$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'a',genero = 'F' WHERE   nombre LIKE 'Abelina%'   ;";
		$this->con->ejecutarQuery($sql);   

		$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'o' WHERE  `tratamiento` IS NULL AND  nombre LIKE '%o'  OR  nombre LIKE '%o %'  ;";
		$this->con->ejecutarQuery($sql);  
		$sql_update = "	UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `tratamiento` = 'o' WHERE  `tratamiento` IS NULL AND  nombre LIKE '%o' OR  nombre LIKE '%o %'  ;";
		$this->con->ejecutarQuery($sql);  */
		
		
		
		/*
		
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET genero = 'F',  `tratamiento` = 'a'  WHERE  nombre LIKE '%Alejandra%'   AND estado = 'activo'  ;
		
		
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET genero = 'M',  `tratamiento` = 'o'  WHERE  nombre LIKE '%Alejandra%'   AND estado = 'activo' ;
		
		SELECT *  FROM `base_datos_email` WHERE `estado` LIKE 'activo' AND `tratamiento` NOT IN ('a','o') AND `genero` NOT IN ('F','M') AND Nombre != '' AND nombre IS NOT NULL ORDER BY nombre ASC, `fecha_actualizacion` DESC;
		
		
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET genero = 'M' WHERE  `tratamiento` = 'o' AND (`genero` = '' OR genero IS NULL)  AND estado = 'activo';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET genero = 'F' WHERE  `tratamiento` = 'a' AND (`genero` = '' OR genero IS NULL) AND estado = 'activo' ;

		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'o' WHERE   `genero` = 'M' AND ( tratamiento = '' OR tratameinto IS NULL) AND estado = 'activo';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'a' WHERE`genero` = 'F' AND tratamiento = '' AND estado = 'activo' ;
		 
		*/

		$sql_update = "	UPDATE `base_datos_email` SET `comentario` = 'Inactivación por rebote-".time()."' WHERE `comentario` = '' AND estado = 'inactivo';";
		$this->con->ejecutarQuery($sql);  

		$sql_update = "	UPDATE `base_datos_email` SET `comentario` = 'Inactivación por rebote-".time()."' WHERE `comentario` = '' AND estado = 'inactivo';";
		//$this->con->ejecutarQuery($sql);  

		$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET genero = 'F' WHERE  `tratamiento` = 'a' AND (genero = '' or genero IS NULL) AND estado = 'activo'  ;";
		$this->con->ejecutarQuery($sql);  
 
		$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET genero = 'M' WHERE  `tratamiento` = 'o' AND (genero = '' or genero IS NULL)   AND estado = 'activo'  ;";
		$this->con->ejecutarQuery($sql);  
		
		$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'a' WHERE  genero = 'F' AND  (tratamiento = '' OR tratamiento IS NULL)  AND estado = 'activo'  ;";
		$this->con->ejecutarQuery($sql);  

		$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'o' WHERE    genero = 'M'   AND   (tratamiento = '' OR tratamiento IS NULL)  AND estado = 'activo'  ;";
		$this->con->ejecutarQuery($sql);  

		
		$sql_update = "	UPDATE `ciaecl_correoweb`.`base_datos_email` SET `tratamiento` = 'o/a' WHERE  (nombre = '' OR `nombre` IS NULL)   AND  (tratamiento = '' OR tratamiento IS NULL)  AND (genero = '' or genero IS NULL) AND estado = 'activo'  ;";
		$this->con->ejecutarQuery($sql);  
		 
		  
 

		
		$sql_update = "UPDATE IGNORE base_datos_email SET estado = 'activo' WHERE email  = 'psepulve@gmail.com' OR email = 'psepulveda@ciae.uchile.cl' OR email =  'enviopruebaemail@ciae.uchile.cl' OR email = 'lista-seminarios@ciae.uchile.cl' OR email = 'postgrado@ciae.uchile.cl' ;
		UPDATE IGNORE envio_email_destino SET estado = 'enviado' WHERE estado = 'rebote' AND (email  = 'psepulve@gmail.com' OR email = 'psepulveda@ciae.uchile.cl' OR email =  'enviopruebaemail@ciae.uchile.cl' OR email = 'lista-seminarios@ciae.uchile.cl' OR email = 'postgrado@ciae.uchile.cl') ;";
		$this->con->ejecutarQuery($sql_update);
		
		
		/* se actualizan inscripciones a base de datos */
		$sql = "INSERT IGNORE  INTO  `ciaecl_correoweb`.`base_datos_email` (creacion_lista,email,   nombre, apellidos, estado, creacion_fecha  ) 
SELECT concat('ciae_inscripciones_',trim(`tipo_inscripcion`)) as `tipo_inscripcion`,trim(`email`) as `email`, trim(`nombre`) as `nombre`, trim(`apellidos`) as `apellidos`, 'activo' as estado, fecha_actualizacion   FROM `ciaecl_ciae`.`site_inscripcion` ;"  ;
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);  
		
		$sql = "INSERT IGNORE  INTO  `ciaecl_correoweb`.`base_datos_email_tipo` (email,  tipo_base  ) 
SELECT trim(`email`) as `email`,concat('ciae_inscripciones_',trim(`tipo_inscripcion`)) as `tipo_inscripcion`   FROM `ciaecl_ciae`.`site_inscripcion` ;"  ;
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);  
		
		
		/* se actualizan tabla de envio personalizado a base de datos, con correo secundario */
		$sql = "INSERT IGNORE  INTO  `ciaecl_correoweb`.`base_datos_email` (creacion_lista,email,   nombre, apellidos, estado   ) 
SELECT concat('ciae_inscripciones_',trim(`caso_envio`)) as `creacion_lista`,trim(`email`) as `email`, trim(`nombre`) as `nombre`, trim(`apellidos`) as `apellidos`, 'activo' as estado  FROM `ciaecl_correoweb`.`envio_email_destino` ;"  ;
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);  
		
		$sql = "INSERT IGNORE  INTO  `ciaecl_correoweb`.`base_datos_email_tipo` (email,  tipo_base  ) 
		SELECT trim(`email`) as `email`,concat('ciae_inscripciones_',trim(`caso_envio`)) as `tipo_base`   
		FROM `ciaecl_correoweb`.`envio_email_destino` ;"   ;
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);   
		
		$sql = "DELETE FROM base_datos_email_tipo WHERE `tipo_base` = 'ciae_0_inactivos' OR `tipo_base` = 'ciae_inscripciones_' OR `tipo_base` = 'ciae_inscripcion' OR email = '' OR  `tipo_base` = '' OR email LIKE '% %' ;  ";  			
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql); 	
	
    	$sql= "INSERT IGNORE INTO  base_datos_email_tipo (email, tipo_base) 
		SELECT trim(`email`) as `email`, 'ciae_0_inactivos' as tipo_base FROM base_datos_email WHERE estado = 'inactivo';  ";
    	//echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);   
		/* limpieza general en tipo de bases  */
		
		
		$sql = "UPDATE `ciaecl_correoweb`.`envio_email_destino` SET apellidos = trim(apellidos)  WHERE apellidos != ''  ;";
		$sql .= "UPDATE `ciaecl_correoweb`.`envio_email_destino` SET nombre = trim(nombre)  WHERE nombre != ''  ;";
		$sql .= "UPDATE `ciaecl_correoweb`.`envio_email_destino` SET email = LOWER(trim(email))   ;";
		$sql .= "UPDATE `ciaecl_correoweb`.`base_datos_email` SET email = LOWER(trim(email))   WHERE estado = 'activo' ;";
		$sql .= "UPDATE `ciaecl_correoweb`.`base_datos_email_tipo` SET email = trim(email)    ;";
		$sql .= "UPDATE `ciaecl_correoweb`.`base_datos_email` SET email = trim(email)  WHERE estado = 'activo'  ;";
		$sql .= "UPDATE `ciaecl_correoweb`.`envio_email_destino` SET email = trim(email)    ;";
		$sql .= "UPDATE IGNORE `ciaecl_correoweb`.`base_datos_email_tipo` SET `tipo_base`= 'ciae_general' WHERE  `tipo_base`= '' ;"   ;  	
		$sql .= "UPDATE IGNORE `ciaecl_correoweb`.`base_datos_email_tipo` SET `tipo_base` = 'ciae_inscripciones' WHERE   `tipo_base` = 'ciae_inscripcion' OR   `tipo_base` = 'ciae_inscripciones_';"   ; 		
		$sql .= "DELETE FROM `ciaecl_correoweb`.`base_datos_email` WHERE  email = '';  ";  	
		$sql .= "DELETE FROM  `ciaecl_correoweb`.`envio_email_destino` WHERE  email = '';  ";  	  		
		$sql .= "DELETE FROM  `ciaecl_correoweb`.`base_datos_email_tipo` WHERE  `tipo_base` = '' OR  `tipo_base` = 'ciae_inscripcion' OR   `tipo_base` = 'ciae_inscripciones_';  ";  			
    	echo "<br>".$sql;
		$this->con->ejecutarQuery($sql);  
		
	}


	public function envioCorreoEmail($asunto,$to, $to_nombre)
	{
		 	 
	}
	
}


		/*
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `nombre` = REPLACE(nombre, 'ã©', 'é') WHERE    `nombre` LIKE '%ã©%';
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `apellidos` = REPLACE(apellidos, 'ã©', 'é') WHERE    `apellidos` LIKE '%ã©%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `nombre` = REPLACE(nombre, 'ã©', 'é') WHERE    `nombre` LIKE '%ã©%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `apellidos` = REPLACE(apellidos, 'ã©', 'é') WHERE    `apellidos` LIKE '%ã©%';
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `nombre` = REPLACE(nombre, 'ã©', 'é') WHERE `nombre` LIKE '%ã©%'  ;
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `apellidos` = REPLACE(`apellidos`, 'ã©', 'é') WHERE `apellidos` LIKE '%ã©%';
		
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `nombre` = REPLACE(nombre, 'ã¡', 'á') WHERE    `nombre` LIKE '%ã¡%';
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `apellidos` = REPLACE(apellidos, 'ã¡', 'á') WHERE    `apellidos` LIKE '%ã¡%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `nombre` = REPLACE(nombre, 'ã¡', 'á') WHERE    `nombre` LIKE '%ã¡%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `apellidos` = REPLACE(apellidos, 'ã¡', 'á') WHERE    `apellidos` LIKE '%ã¡%';
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `nombre` = REPLACE(nombre, 'ã¡', 'á') WHERE `nombre` LIKE '%ã¡%'  ;
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `apellidos` = REPLACE(`apellidos`, 'ã¡', 'á') WHERE `apellidos` LIKE '%ã¡%'; 
		
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `nombre` = REPLACE(nombre, 'ã', 'á') WHERE    `nombre` LIKE '%ã%';
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `apellidos` = REPLACE(apellidos, 'ã', 'á') WHERE    `apellidos` LIKE '%ã%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `nombre` = REPLACE(nombre, 'ã', 'á') WHERE    `nombre` LIKE '%ã%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `apellidos` = REPLACE(apellidos, 'ã', 'á') WHERE    `apellidos` LIKE '%ã%';
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `nombre` = REPLACE(nombre, 'ã', 'á') WHERE `nombre` LIKE '%ã%'  ;
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `apellidos` = REPLACE(`apellidos`, 'ã', 'á') WHERE `apellidos` LIKE '%ã%';
		
		
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `nombre` = REPLACE(nombre, 'ã³', 'ó') WHERE    `nombre` LIKE '%ã³%';
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `apellidos` = REPLACE(apellidos, 'ã³', 'ó') WHERE    `apellidos` LIKE '%ã³%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `nombre` = REPLACE(nombre, 'ã³', 'ó') WHERE    `nombre` LIKE '%ã³%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `apellidos` = REPLACE(apellidos, 'ã³', 'ó') WHERE    `apellidos` LIKE '%ã³%';
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `nombre` = REPLACE(nombre, 'ã³', 'ó') WHERE `nombre` LIKE '%ã³%'  ;
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `apellidos` = REPLACE(`apellidos`, 'ã³', 'ó') WHERE `apellidos` LIKE '%ã³%';
		
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `nombre` = REPLACE(nombre, 'ã±', 'ñ') WHERE    `nombre` LIKE '%ã±%';
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `apellidos` = REPLACE(apellidos, 'ã±', 'ñ') WHERE    `apellidos` LIKE '%ã±%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `nombre` = REPLACE(nombre, 'ã±', 'ñ') WHERE    `nombre` LIKE '%ã±%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `apellidos` = REPLACE(apellidos, 'ã±', 'ñ') WHERE    `apellidos` LIKE '%ã±%';
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `nombre` = REPLACE(nombre, 'ã±', 'ñ') WHERE `nombre` LIKE '%ã±%'  ;
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `apellidos` = REPLACE(`apellidos`, 'ã±', 'ñ') WHERE `apellidos` LIKE '%ã±%';
		
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `nombre` = REPLACE(nombre, 'ã­', 'í') WHERE    `nombre` LIKE '%ã­%';
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `apellidos` = REPLACE(apellidos, 'ã­', 'í') WHERE    `apellidos` LIKE '%ã­%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `nombre` = REPLACE(nombre, 'ã­', 'í') WHERE    `nombre` LIKE '%ã­%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `apellidos` = REPLACE(apellidos, 'ã­', 'í') WHERE    `apellidos` LIKE '%ã­%';
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `nombre` = REPLACE(nombre, 'ã­', 'í') WHERE `nombre` LIKE '%ã­%'  ;
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `apellidos` = REPLACE(`apellidos`, 'ã­', 'í') WHERE `apellidos` LIKE '%ã­%';
		
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `nombre` = REPLACE(nombre, 'ãº', 'ú') WHERE    `nombre` LIKE '%ãº%';
		UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `apellidos` = REPLACE(apellidos, 'ãº', 'ú') WHERE    `apellidos` LIKE '%ãº%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `nombre` = REPLACE(nombre, 'ãº', 'ú') WHERE    `nombre` LIKE '%ãº%';
		UPDATE `ciaecl_correoweb`.`base_datos_email` SET `apellidos` = REPLACE(apellidos, 'ãº', 'ú') WHERE    `apellidos` LIKE '%ãº%';
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `nombre` = REPLACE(nombre, 'ãº', 'ú') WHERE `nombre` LIKE '%ãº%'  ;
		UPDATE `ciaecl_ciae`.`site_inscripcion` SET `apellidos` = REPLACE(`apellidos`, 'ãº', 'ú') WHERE `apellidos` LIKE '%ãº%';
		
		
		SELECT * FROM `ciaecl_ciae`.`site_inscripcion` WHERE `nombre` LIKE '%ã%' OR apellidos LIKE '%ã%';
		SELECT * FROM `ciaecl_correoweb`.`base_datos_email` WHERE `nombre` LIKE '%ã%' OR apellidos LIKE '%ã%';
		SELECT * FROM `ciaecl_correoweb`.`envio_email_destino` WHERE `nombre` LIKE '%ã%' OR apellidos LIKE '%ã%';
		
		SELECT a.*,b.*, c.* FROM `ciaecl_ciae`.`common_logs_imagen` as a, `ciaecl_correoweb`.`envio_email_destino` as b, `ciaecl_correoweb`.`envio_email_detalle` as c WHERE  a.email = b.email_md5 AND a.caso_envio = c.caso_envio_md5 AND c.caso_envio = b.caso_envio
		
		
		*/ 
?>