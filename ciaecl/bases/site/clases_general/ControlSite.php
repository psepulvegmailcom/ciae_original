<?php

class ActualizacionSitios extends Objetos
{		
	var $sourceTable = "site_fecha_actualizacion";
	
	function ActualizacionSitios() 
	{
		parent::Objetos();
	}
	
	function existeActualizacionSitio($id_site)
	{
		parent::loadObject(' fecha = "'.date('Y-m-d').'" AND id_site = '.$id_site);
		if(isset($this->fecha) && trim($this->fecha) != '')
			return true;
		else
			return false;
	}	
}


class Site extends Objetos
{		
	var $sourceTable = "site_site";
	
	function Site() 
	{
		parent::Objetos();
	}	
}

class ControlSite extends ControlObjetos
{
	function ControlSite()
	{
		parent::ControlObjetos();
		$this->obj = new Site(); 
		$this->key = 'id_site';
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function NombreSite($site)
	{
		$this->where = " nombre_site ='".$site."'" ;
		$this->select = " ";		
		return parent::obtenerListado();		
	}
	
	function NombreSiteId($id_site)
	{
		$this->where = " id_site ='".$id_site."'" ;
		$this->select = " ";		
		return parent::obtenerListado(); 
	} 

    function ListarSite()
	{	
		return parent::obtenerListado(); 
	}     
}

class ControlUsuarioSitio  extends ControlVistas
{
	function ControlUsuarioSitio()
	{
		parent::ControlVistas(); 			
		$this->key 			= 'id_site';
		$this->sourceTable  = 'view_auth_site';
		$this->order		= 'user_id, id_site';
		parent::prepararObjecto();		 
	}

	function obtenerSitiosUsuario($user_id)
	{				 
		$this->where = "user_id = '".$user_id."'"; 
		return parent::obtenerListado(); 
	}	
} 
?>