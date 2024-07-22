<?php

/** BOLETIN ESPECIALES */
class BoletinesEspeciales extends Objetos
{
	var $sourceTable =  'site_boletin_especiales';
	
	function BoletinesEspeciales()
	{ 
		parent::Objetos();
	} 
}


class ControlBoletinesEspeciales extends ControlObjetos
{
	function ControlBoletinesEspeciales()
	{
		parent::ControlObjetos();
		$this->obj 		= new BoletinesEspeciales();
		$this->order 	= ' agno DESC, mes DESC, id_boletin DESC ';
		$this->key 		= 'id_boletin'; 
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	
	function setSitio($id_site)
	{
		$this->id_site = $id_site;
	} 
	
	
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 
		$aux = ' ';
		if(trim($this->id_site) != '')
		{
			$aux = ' AND id_site = '.$this->id_site.' ';
		}
		$sql =" SELECT   noti.*, $palabra noti.mes
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE noti.id_boletin > 0 ".$aux."
		$condicion  group by noti.id_boletin order by ".$this->order." $limite";	 
	 	return parent::getQuery($sql);
	}
	
	function obtenerUltimoBoletin($id_site)
	{
		$this->where = ' id_site = '.$id_site.' ';
		$this->order = " agno DESC, mes DESC LIMIT 0,1 ";
		return parent::obtenerListado();
	}
}
?>