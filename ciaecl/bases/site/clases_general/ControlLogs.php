<?php

class Logs extends PersistentObject 
{		
	var $sourceTable = "common_logs";
	
	function Logs() 
	{
		parent::PersistentObject();
	}	
}

class LogIPBlock extends PersistentObject 
{		
	var $sourceTable = "common_logs_ip_block";
	
	function LogIPBlock() 
	{
		parent::PersistentObject();
	}	
}

class LogsFile extends PersistentObject 
{		
	var $sourceTable = "common_logs_download";
	
	function LogsFile() 
	{
		parent::PersistentObject();
	}
	
	function nuevaDescarga($documento,$caso)
	{ 
		$this->fecha = time();  
		$this->ip_address 	=$_SERVER['REMOTE_ADDR'];
		$this->ip_address_extra  = $_SERVER['SERVER_ADDR'];
		$this->documento 	= Funciones::cleanSqlInjection($documento,true); 
		$this->sitio 		= $_SERVER['SERVER_NAME'];
		$this->estado 		= $caso;
		$this->newObject	= true; 
		parent::saveObject();
	}	
}

class LogsEmail extends PersistentObject 
{		
	var $sourceTable = "common_logs_email";
	
	function LogsEmail() 
	{
		parent::PersistentObject();
	}	
}

class LogsVisit extends PersistentObject 
{		
	var $sourceTable = "common_logs_history";
	
	function LogsVisit() {
		parent::PersistentObject();
	}	
	
	function nuevaVisita()
	{
		$fecha = ControladorFechas::fechaActual(true,true,0,true);
		$fecha = date('Ymd',$fecha);
		
		parent::loadObject(" fecha='".$fecha."'");
		$this->fecha = $fecha;
		$this->total = $this->total + 1;
		parent::saveObject(" fecha='".$fecha."'");
	}

	function estadoAlerta($hoy=true)
	{
		if($hoy)
			$fecha = ControladorFechas::fechaActual(true,true,0,true);
		else
			$fecha = ControladorFechas::fechaActual(true,true,-1,true);
		$fecha = date('Ymd',$fecha);
		
		parent::loadObject(" fecha='".$fecha."'");
		return $this->alerta;
	}

	function agregarEstadoAlerta($paso)
	{
		$fecha = ControladorFechas::fechaActual(true,true,0,true);
		$fecha = date('Ymd',$fecha);
		
		parent::loadObject(" fecha='".$fecha."'");
		$this->alerta		= $paso; 
		parent::saveObject(" fecha='".$this->fecha."'");
	}
	
	function totalVisitas()
	{
		$ControladorDeObjetos = new ControladorDeObjetos();
		$registro = " SELECT sum( total ) AS total
					  FROM  ".$this->sourceTable;
		$output = $ControladorDeObjetos->getQuery($registro);	 
		return $output[0]['total'];	 
	}
}

class ControlLogs extends ControladorDeObjetos 
{

	var $obj; 	
	var $ip;
	
	function ControlLogs() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Logs(); 	
		$this->sourceTable = $this->obj->sourceTable;
		$this->ip 		=$_SERVER['REMOTE_ADDR'];
	}
	
	function searchIPBlock()
	{
		$LogIPBlock = new LogIPBlock();
		$LogIPBlock->loadObject("ip = '".$this->ip."' ");
		if(isset($LogIPBlock->ip) && trim($LogIPBlock->ip) != '')
		{
			$LogIPBlock->bloqueado  = 'si';
			$LogIPBlock->fecha 		= ControladorFechas::fechaActual(true,true,0,false); 
			$LogIPBlock->url 		= Funciones::cleanSqlInjection($_SERVER['REQUEST_URI'],true);
			$LogIPBlock->sitio 		= $_SERVER['SERVER_NAME'];
			$LogIPBlock->saveObject("ip = '".$this->ip."'");
			return true;
		} 		
		else
		{
			$this->insercionIpBloqueoNuevas();
		}
		return false;
	}
	
	/**
		inserta automaticamente las ip que superan 6 consultas con sql injection
	*/
	function insercionIpBloqueoNuevas()
	{ 
		$LogIPBlock 	= new LogIPBlock();
		$LogsFile 		= new LogsFile();
		$LogsVisitUrl 	= new LogsVisitUrl();
		$minimo_consultas = 3;
	 	$sql = "	INSERT IGNORE INTO ".$LogIPBlock->sourceTable." (ip,bloqueado, url,sitio) 
		SELECT ip_address, 'si' as bloqueado, uri,sitio  FROM (SELECT DISTINCT ip_address, count(ip_address) as total, documento as uri,sitio
		FROM view_".$LogsFile->sourceTable."_fecha_error
		WHERE documento LIKE '%select%' OR documento LIKE '%char%' OR documento LIKE  '%where%' OR documento LIKE '% and %'  OR documento LIKE '%ftp://%'  OR documento LIKE '%union%' OR documento LIKE  '%BeNChMaRK%' OR documento LIKE '%etc/passwd%' OR documento LIKE '%download%'  OR documento LIKE '%index%' 
		GROUP BY ip_address 
		ORDER BY id_visit) as a
		WHERE total >= ".$minimo_consultas."
		UNION
		SELECT ip_address, 'si' as bloqueado, uri,sitio  FROM (SELECT DISTINCT ip_address, count(ip_address) as total, uri, url as sitio
		FROM view_".$LogsVisitUrl->sourceTable."_fecha_error
		WHERE uri LIKE '%select%' OR uri LIKE '%char%' OR uri LIKE  '%where%' OR uri LIKE  '%union%' OR uri LIKE  '%BeNChMaRK%' OR uri LIKE '%etc/passwd%'
		OR browser LIKE '%sqlmap%'
		GROUP BY ip_address
		ORDER BY id_visit) as a
		WHERE total >= ".$minimo_consultas; 
		 // echo $sql;
		parent::getQuery($sql);  
	} 
	

	function setLogEmail($header,$to,$username,$msg,$asunto)
	{
		if(trim($username) == '')
		{
			$username='system';
		}
		$objEmail = new  LogsEmail();
		$objEmail->time_log 	= ControladorFechas::fechaActual(true,true,0,true); 	
		$objEmail->username 	= $username;	 
		$objEmail->msg			= $msg;	
		$objEmail->header		= $header;	
		$objEmail->para			= $to;	
		$objEmail->asunto		= $asunto;
		$objEmail->newObject	= true;
	 	$objEmail->saveObject();
	}
	
	function ultimoUsuarioUso($username)
	{
		$sql = "SELECT DATE_FORMAT( FROM_UNIXTIME( time_log ) , '".ControladorFechas::formatoFechaSql()."' ) AS fecha_acceso, time_log , username
				FROM ".$this->sourceTable."
				WHERE username LIKE '".$username."' AND action = 'LOGIN-SUCCESS'
				ORDER BY time_log DESC 
				LIMIT 0 , 1";
		//echo $sql."<br>";
		
	 	$output = parent::getQuery($sql);
		return $output[0]['fecha_acceso']; 
	}
	
	function setLog($action,$username='unknown',$msg='',$nueva_visita=false)
	{		
		$msg = Funciones::cleanSqlInjection($msg,true);
		if(trim($username) == '')
		{
			$username='unknown';
		}  
		$this->obj->time_log 	= ControladorFechas::fechaActual(true,true,0,true);
		$this->obj->ip 			= $this->ip;		
		$this->obj->ip_extra 	= $_SERVER['SERVER_ADDR'];		
		$this->obj->username 	= $username;
		$this->obj->sitio 		= $_SERVER['SERVER_NAME'];
		$this->obj->action 		= strtoupper($action);
		$this->obj->msg			= Funciones::cleanSqlInjection($msg,true);
		$this->obj->post		= print_r(VarSystem::getPost(), true);	
		$this->obj->newObject	= true;
 		$this->obj->saveObject();
		  
	}	
} 

/** CLASE DE LOG DE VISITAS */

class LogsVisitUrl extends Objetos
{
	var $sourceTable =  'common_logs_url';
	
	function LogsVisitUrl()
	{ 
		parent::Objetos();
	}
	  
	function agregarVisita()
	{
		$this->fecha = time();  
		$this->ip_address 	=$_SERVER['REMOTE_ADDR'];
		$this->ip_address_extra 	= $_SERVER['SERVER_ADDR'];
		$this->uri 			= Funciones::cleanSqlInjection($_SERVER['REQUEST_URI'],true);
		$this->url 			= $_SERVER['SERVER_NAME'];
		$this->username		= $_SESSION['userName'];
		if(trim($this->username) == '')
		{
			$this->username = 'unknown';
		}
		$this->browser 		= $_SERVER['HTTP_USER_AGENT'];
		$this->saveObject();
	}	
}


/** 
** PERMITE ALMACENAR LA EMAIL ABIERTOS USANDO IMAGENES EN LOS CORREOS ENVIADOS
**/

class LogsImagenVisitas extends Objetos
{
	var $sourceTable =  'common_logs_imagen';
	
	function LogsImagenVisitas()
	{ 
		parent::Objetos();
	} 
	
	function agregarVisita()
	{
		$aux = explode("_",$this->tipo_visita);
		
		$this->caso_envio = array_pop($aux);
		
		$this->email = array_pop($aux);
		
		$this->fecha = time();  
		$this->ip_address 	= $_SERVER['REMOTE_ADDR'];		
		$this->sitio 		= $_SERVER['SERVER_NAME'];
		$this->url 			= $_SERVER['REQUEST_URI'];
		$this->saveObject();
	}
}

?>