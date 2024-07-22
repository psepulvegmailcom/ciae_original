<?php
 
/*******************************************************************************
					ESTRUCTURAS DE COLUMNAS
********************************************************************************/
class columna extends PersistentObject {

	var $sourceTable = "site_columnas";
	
	function columna() {
		parent::PersistentObject();
	}	 

	function obtenerColumna($id_columna)
	{
		parent::loadObject('id_columna = '.$id_columna);
	}	
}

class ControlColumna extends ControladorDeObjetos 
{
	var $obj; 	  
	
	function ControlColumna() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Columna(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	} 
	
	function obtenerColumnas()
	{
		$order = 'id_columna DESC';
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	}
} 

?>