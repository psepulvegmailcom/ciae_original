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
		}
		
		function getComunasByRegion($objRegion){		
			$order = "orden, comuna";
			$where = "region_id=".$objRegion->region_id;			
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}
		
		function getComunasByIdComuna($id){		
			$order = "orden, comuna";
			$where = "comuna_id=".$id;			
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}	
		
		function getComunasByIdRegion($id){		
			$order = "orden, comuna";
			$where = "region_id=".$id;			
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}	
		
		function getComunas($order='')
		{					
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}	
		
		function getRegionByComuna($id){
		
			$order = "orden, comuna";
			$where = "comuna_id=".$id;			
			$result = parent::getArrayObjects($this->sourceTable,$where,$order);
			return $result[0]['region_id'];
		}
		
		function getListadoCompleto()
		{
			$Region = new Region();
			$sql = "SELECT c.*, r.* 
			FROM ".$this->sourceTable." as c, ".$Region->sourceTable." as r
			WHERE c.region_id = r.region_id 
			ORDER BY c.orden,  c.comuna, r.orden"; 
			return parent::getQuery($sql);
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
	
	class Pais extends PersistentObject 
	{		
		var $sourceTable = "common_paises";
		
		function Pais() {
			parent::PersistentObject();
		}	
	}
	
	class ControlPais extends ControladorDeObjetos {
	
		var $obj; 	
		var $keyField = 'pais_id';
		
		function ControlPais() 
		{			
			parent::ControladorDeObjetos();
			$this->obj = new Pais(); 	
			$this->sourceTable = $this->obj->sourceTable;
		}
		
		function getPaises($id=0){	
			if($id > 0)
				$where = $this->keyField."=".$id;	
			else
				$where = ''; 
			$order = '  orden ASC, pais ASC';
		 	return(parent::getArrayObjects($this->sourceTable,$where,$order));	
		}		
	} 
	
	class ControlRegionComunas extends ControlVistas
	{
		function ControlRegionComunas()
		{
			parent::ControlVistas(); 			
			$this->key 			= 'comuna_id';
			$this->sourceTable  = 'view_regiones_comunas';
			$this->order		= '	orden_region ASC, orden_comuna ASC';
			parent::prepararObjecto();		 		
		} 
	}
?>