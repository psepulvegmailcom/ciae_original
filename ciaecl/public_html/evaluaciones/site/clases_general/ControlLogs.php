<?php

class Logs extends PersistentObject 
{		
	var $sourceTable = "common_logs";
	
	function Logs() 
	{
		parent::PersistentObject();
	}	
}

class LogsFile extends PersistentObject 
{		
	var $sourceTable = "common_log_download";
	
	function LogsFile() 
	{
		parent::PersistentObject();
	}
	
	function nuevaDescarga($documento,$caso)
	{ 
		$this->fecha = time();  
		$this->ip_address = $_SERVER['REMOTE_ADDR'];
		$this->documento 	= $documento;
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
		$this->ip 		= $_SERVER['REMOTE_ADDR'];
	}

	function setLogEmail($header,$to,$username,$msg,$asunto)
	{
		if(trim($username) == '')
			$username='system';
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
		if(trim($username) == '')
		{
			$username='unknown';
		}
			
		$this->obj->time_log 	= ControladorFechas::fechaActual(true,true,0,true);
		$this->obj->ip 			= $this->ip;		
		$this->obj->username 	= $username;	
		$this->obj->action 		= strtoupper($action);
		$this->obj->msg			= $msg;	
		$this->obj->post		= print_r($_POST, true);	
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
		$this->ip_address = $_SERVER['REMOTE_ADDR'];
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->url = $_SERVER['SERVER_NAME'];
		$this->browser = $_SERVER['HTTP_USER_AGENT'];
		$this->saveObject();
	}	
}

?>