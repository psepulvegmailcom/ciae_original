<?php

/********************************************************************************************
			CLASES CONTROLADORES DE ELEMENTOS DE TRANSPARENCIA
********************************************************************************************/

/********************************************************************************************
			CLASES CONTROLADORES DE ACTAS IE DE TRANSPARENCIA
********************************************************************************************/

class ActasIE extends Objetos 
{		
	var $sourceTable = "site_gestion_actas_ie";
	
	function ActasIE() 
	{
		parent::Objetos();
        $this->dbKey = 'id_acta';
	} 
	
	function obtenerUltimoResolucionSitio($id_site)
	{
		parent::loadObject(' id_site = "'.$id_site.'" ORDER BY '.$this->dbKey.' DESC');
	}	          
} 

class ControlActasIE extends ControlObjetos
{
	var $obj; 	  
	
	function ControlActasIE() 
	{			
		parent::ControlObjetos();
		$this->obj          = new ActasIE();
		$this->select		= "date_format(fecha, '%d-%m-%Y') as fecha_html  ";
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'fecha DESC, id_acta DESC, tipo';  
	} 
	
	function obtenerElemento($id_acta)
	{ 
		$this->where .= "id_acta = '".$id_acta."' ";
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
	} 
	
	function obtenerActasIE()
	{ 
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
	}
}



/********************************************************************************************
			CLASES CONTROLADORES DE RESOLUCION DE TRANSPARENCIA
********************************************************************************************/

class Resolucion extends Objetos 
{		
	var $sourceTable = "site_gestion_resoluciones";
	
	function Resolucion() 
	{
		parent::Objetos();
        $this->dbKey = 'id_resolucion';
	}         
} 

class ControlResoluciones extends ControlObjetos
{
	var $obj; 	  
	
	function ControlResoluciones() 
	{			
		parent::ControlObjetos();
		$this->obj          = new Resolucion();
		$this->select		= "date_format(fecha_resolucion, '%d-%m-%Y') as fecha_resolucion_html,date_format(fecha_resolucion,  '%M') as fecha_resolucion_mes,date_format(fecha_resolucion,  '%m') as fecha_resolucion_mesnum ";
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'fecha_resolucion ASC, id_resolucion ASC';  
	} 
	
	function obtenerElemento($id_resolucion)
	{ 
		$this->where .= "id_resolucion = '".$id_resolucion."' ";
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
	} 
	
	function obtenerResoluciones()
	{ 
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
	}
	 
	function obtenerResolucionesAgno($agno)
	{ 
		$this->where = "  agno = '".$agno."'  ";
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
	}
	 
	function obtenerResolucionesAgnoMes($agno,$mes)
	{ 
		$this->where = "  agno = '".$agno."' AND fecha_resolucion  LIKE '".$agno."-".$mes."%'    ";
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
	}
	
	
	
}

?>