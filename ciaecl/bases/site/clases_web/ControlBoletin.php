<?php


/** BOLETIN */
class Boletines extends Objetos
{
	var $sourceTable =  'site_boletin';
	
	function Boletines()
	{ 
		parent::Objetos();
	} 
}


class ControlBoletines extends ControlObjetos
{
	function ControlBoletines()
	{
		parent::ControlObjetos();
		$this->obj 		= new Boletines();
		$this->order 	= 'id_boletin DESC, mes DESC, agno DESC';
		$this->key 		= 'id_boletin'; 
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function setSitio($id_site)
	{
		$this->id_site = $id_site;
		if(trim($this->where) == '')
			$this->where = " id_site = ".$this->id_site;
		else
			$this->where .= " AND id_site = ".$this->id_site;
	}  
	
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 
 		if(trim($this->id_site) != '')
		{
			$aux = " id_site = '".$this->id_site."'";
			if(trim($condicion) != '')
			{
				$condicion = $condicion." AND ".$aux;
			}
			else
			{
				$condicion = " AND ".$aux;
			} 
		} 
		$sql =" SELECT   noti.agno, $palabra noti.mes, noti.archivo, noti.id_boletin
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE noti.id_boletin > 0 
		$condicion  
		GROUP BY noti.id_boletin 
		ORDER BY ".$this->order." $limite";	 
	 	return parent::getQuery($sql);
	}
	
	function obtenerUltimoBoletin()
	{
		$this->order = " id_boletin DESC LIMIT 0,1";
		return parent::obtenerListado();
	}
	
	function obtenerUltimoBoletinSitio($id_site)
	{
		$this->where = " id_site =".$id_site;
		$this->order = " id_boletin DESC LIMIT 0,1";
		return parent::obtenerListado();
	}
	
}
?>