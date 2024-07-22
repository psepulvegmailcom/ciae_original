<?php


/** BOLETIN FOCO */
class BoletinesFoco extends Objetos
{
	var $sourceTable =  'site_boletin_foco';
	
	function BoletinesFoco()
	{ 
		parent::Objetos();
	} 
}


class ControlBoletinesFoco extends ControlObjetos
{
	function ControlBoletinesFoco()
	{
		parent::ControlObjetos();
		$this->obj 		= new BoletinesFoco();
		$this->order 	= 'id_boletin DESC, mes DESC, agno DESC';
		$this->key 		= 'id_boletin'; 
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 
		$sql =" SELECT   noti.*, $palabra noti.mes 
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE noti.id_boletin > 0 
		$condicion  group by noti.id_boletin order by ".$this->order." $limite";	 
	 	return parent::getQuery($sql);
	}
	
	function obtenerUltimoBoletin()
	{
		$this->order = " id_boletin DESC LIMIT 0,1";
		return parent::obtenerListado();
	}
}

?>