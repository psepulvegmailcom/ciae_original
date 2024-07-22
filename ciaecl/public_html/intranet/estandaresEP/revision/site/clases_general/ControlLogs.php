<?php

class Logs extends PersistentObject 
{		
	var $sourceTable = "common_logs";
	
	function Logs() 
	{
		parent::PersistentObject();
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
	
	function ControlLogs() {			
		parent::ControladorDeObjetos();
		$this->obj = new Logs(); 	
		$this->sourceTable = $this->obj->sourceTable;
		$this->ip 		= $_SERVER['REMOTE_ADDR'];
	}

	function setLogSimple($caso,$contenido)
	{
		$nombre_archivo = VarSystem::getPathVariables('dir_repositorio').strtolower($caso).'.log';
		$contenido = "FECHA:".ControladorFechas::fechaActual(false,true)."|IP:".$_SERVER['REMOTE_ADDR']."|CASO:".$caso."|MENSAJE:".$contenido;
		$contenido = str_replace("\n"," ",$contenido)."\n";
		 
		if (!$gestor = fopen($nombre_archivo, 'a+')) 
		{
			 echo "No se puede abrir el archivo ($nombre_archivo)";
			 exit;
		}
		else
		{
			if (fwrite($gestor, $contenido) === FALSE) {
				echo "No se puede escribir al archivo ($nombre_archivo)";
				exit;
			}
			fclose($gestor);
		}  
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
				FROM view_ultimo_ingreso
				WHERE username LIKE '".$username."'  
				ORDER BY time_log DESC 
				LIMIT 0 , 1";
		
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
		
		if($nueva_visita)
		{
			$LogsVisit = new LogsVisit();
			$LogsVisit->nuevaVisita();
		}
	}	
} 
?>