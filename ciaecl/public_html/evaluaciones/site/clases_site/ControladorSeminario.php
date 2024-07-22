<?php
 
/*******************************************************************************
					ESTRUCTURAS DE SEMINARIOS
********************************************************************************/
class Seminario extends PersistentObject {

	var $sourceTable = "site_seminario";
	
	function Seminario() {
		parent::PersistentObject();
	}	 

	function obtenerSeminario($id_Seminario)
	{
		parent::loadObject('id_seminario = '.$id_seminario);
	}	
}

class ControlSeminario extends ControladorDeObjetos 
{
	var $obj; 	  
	
	function ControlSeminario() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Seminario(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	} 
	
	function obtenerSeminarios($agno='',$caso='=')
	{	 
		$where = '';
		if(trim($agno) != '')
		{
			$where = 'agno   '.$caso.$agno;
		}		
		
		if($agno < 2009)
			$order = 'id_seminario ASC';
		else
			$order = 'id_seminario DESC';
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	}
} 
?>