<?php 

class Contacto extends Objetos
{
	var $sourceTable =  'site_contacto';
	
	function Contacto()
	{ 
		parent::Objetos();
	} 
	
	function agregarObjeto()
	{
		$this->fecha = time();
		$this->saveObject();
	}
}

/**
 * EnvioWebmaster
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class EnvioWebmaster extends Objetos
{
	var $sourceTable =  'site_email_webmaster_envio';
	
	function EnvioWebmaster()
	{ 
		parent::Objetos();
	}  
	
	function agregarNuevoEnvio($email,$envio=2)
	{ 
		$fecha = date("Y-m-d");
		parent::loadObject(" fecha = '".$fecha."' AND email = '".$email."' ");
		$this->total = $this->total + $envio;
		$this->saveObject(" fecha = '".$fecha."' AND email = '".$email."' ");
	} 
	
	function agregarNuevoEmail($email,$orden)
	{
		$this->fecha = date("Y-m-d");
		$this->email = $email;
		$this->orden = $orden;
		$this->total = 0;
		$this->saveObject();
	}
}

/**
 * ControlEnvioWebmaster
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlEnvioWebmaster extends ControlObjetos
{ 
	function ControlEnvioWebmaster()
	{
		parent::ControlObjetos();
		$this->obj 		= new EnvioWebmaster(); 
		parent::prepararObjeto(); 
		$this->limite = 127;
	} 
	
	function limiteEnvioDiario()
	{		
		return $this->limite;
	}
	
	function entregaProximoEmail($orden)
	{
		$email = array('','webmaster@ciae.cl','webmaster2@ciae.cl','webmaster3@ciae.cl','webmaster4@ciae.cl','webmaster5@ciae.cl',
		'webmaster6@ciae.cl','webmaster7@ciae.cl','webmaster8@ciae.cl','webmaster9@ciae.cl','webmaster10@ciae.cl',
		'webmaster11@ciae.cl' ,'webmaster12@ciae.cl','webmaster13@ciae.cl','webmaster14@ciae.cl','webmaster15@ciae.cl',
		'webmaster16@ciae.cl','webmaster17@ciae.cl'); 
		$orden++; 
		if($orden > count($email))
		{
			$orden = 1;
		}
		return $email[$orden];
	}
	
	function emailParaEnvio()
	{
		$this->order = " fecha DESC , orden DESC LIMIT 1";
		$estado = parent::obtenerListado();
		$hoy = date("Y-m-d");
		if($estado[0]['fecha'] != $hoy)
		{
			$this->email_envio = $this->entregaProximoEmail(0); 
			$orden = 1;
			$EnvioWebmaster = new EnvioWebmaster(); 
			$EnvioWebmaster->agregarNuevoEmail($this->email_envio,$orden); 
		}
		else
		{
			if($estado[0]['total'] >= $this->limite)
			{ 
				$this->email_envio = $this->entregaProximoEmail($estado[0]['orden']); 
				$orden = $estado[0]['orden'] + 1;
				$EnvioWebmaster = new EnvioWebmaster(); 
				$EnvioWebmaster->agregarNuevoEmail($this->email_envio,$orden); 
			}
			else
			{
				$this->email_envio = $estado[0]['email'];
			} 	
		} 
		return $this->email_envio;
	}
	
	function agregarNuevoEnvio($email)
	{
		$this->obj->agregarNuevoEnvio($email);
	}
}  
?>