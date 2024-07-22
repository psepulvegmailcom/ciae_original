<?php
 

class Comuna extends PersistentObject {
		
	var $sourceTable = "common_comuna";
	
	function Comuna() {
		parent::PersistentObject();
	}	
}

class ControlComuna extends ControladorDeObjetos {

	var $obj; 
	
	
	function ControlComuna() {			
		parent::ControladorDeObjetos();
		$this->obj = new Comuna(); 	
		$this->sourceTable = $this->obj->sourceTable;
		$this->sourceTableCompleta = 'view_bd_'.$this->sourceTable;
	}
 	
	function getCompletoComuna($id){		
		$order = "comuna";
		$where = "comuna_id=".$id;			
		return(parent::getArrayObjects($this->sourceTableCompleta,$where,$order));
	}
	
	function getComunasByRegion($objRegion){		
		$order = "comuna";
		$where = "region_id=".$objRegion->region_id;			
		return(parent::getArrayObjects($this->sourceTable,$where,$order));
	}
	
	function getComunasByIdComuna($id){		
		$order = "comuna";
		$where = "comuna_id=".$id;			
		return(parent::getArrayObjects($this->sourceTable,$where,$order));
	}	
	
	function getComunasByIdRegion($id){		
		$order = "comuna";
		$where = "region_id=".$id;			
		return(parent::getArrayObjects($this->sourceTable,$where,$order));
	}	
	
	function getComunas($order='')
	{					
		return(parent::getArrayObjects($this->sourceTable,$where,$order));
	}	
	
	function getRegionByComuna($id){
	
		$order = "comuna";
		$where = "comuna_id=".$id;			
		$result = parent::getArrayObjects($this->sourceTable,$where,$order);
		return $result[0]['region_id'];
	}
}

class Region extends PersistentObject 
{
		
	var $sourceTable = "common_region";
	
	function Region() {
		parent::PersistentObject();
	}	
}

class ControlRegion extends ControladorDeObjetos {

	var $obj; 	
	var $keyField = 'region_id';
	
	function ControlRegion() {			
		parent::ControladorDeObjetos();
		$this->obj = new Region(); 	
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function getRegiones($id=0){	
		if($id > 0)
			$where = $this->keyField."=".$id;	
		else
			$where = ''; 
		$order = '  orden ASC';
	 	return(parent::getArrayObjects($this->sourceTable,$where,$order));	
	}		
}
?>