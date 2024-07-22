<?php

/********************************************************************************************
			CLASES CONTROLADORES DE BANNER DEL HOME
********************************************************************************************/
class Banner extends Objetos {
		
	var $sourceTable = "site_banner";
	
	function Banner() 
	{
		parent::Objetos();
	}	 
}

class ControlBanner extends ControlObjetos
{
	var $obj; 	 
	var $idioma = '';
	
	function ControlBanner() 
	{			
		parent::ControlObjetos();
		$this->obj = new Banner(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	} 
	
	function obtenerBannerPie($idioma='')
	{
		$this->where = 'activo=1 and tipo="pie"';
		if(trim($idioma) != '')
		{
			$this->where .= " AND (idioma = 'nn' OR idioma = '".$idioma."') ";
		}
		$this->order = 'orden ASC, rand()  ';
		$this->select = " '' as active";
		return parent::obtenerListado();
	}
	
	function obtenerBanner($idioma='')
	{
		$this->where = 'activo=1 and tipo="principal"';
		if(trim($idioma) != '')
		{
			$this->where .= " AND (idioma = 'nn' OR idioma = '".$idioma."') ";
		}
		$this->order = 'orden ASC, rand() ';
		$this->select = " '' as active";
		return parent::obtenerListado();
	} 
	
	function caducarBanner($fecha)
	{
		$where_string = "fecha_caducidad < '".$fecha."' AND activo = 1 AND fecha_caducidad > '0000-00-00' ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET activo = 0     WHERE ".$where_string;
		parent::getQuery($sql); 
	}
}

?>