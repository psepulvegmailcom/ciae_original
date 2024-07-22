<?php
class FAQ extends PersistentObject {
		
	var $sourceTable = "common_pregunta_frecuente";
	
	function FAQ() {
		parent::PersistentObject();
	}	
}

class ControlFAQs extends ControladorDeObjetos {

	var $obj; 	 
	
	function ControlFAQs() {			
		parent::ControladorDeObjetos();
		$this->obj = new FAQ(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	}
	

	function getLista($id=0){		
		$order = "orden";
		if($id > 0)
			$where = "id_pregunta=".$id;			
		return(parent::getArrayObjects($this->sourceTable,$where,$order));
	}
}

class Ayuda extends PersistentObject {
		
	var $sourceTable = "common_ayuda_form";
	
	function Ayuda() {
		parent::PersistentObject();
	}	
}

class ControlAyuda extends ControladorDeObjetos {

	var $obj; 	 
	
	function ControlAyuda() {			
		parent::ControladorDeObjetos();
		$this->obj = new Ayuda(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	}
	
	function getAyudaTexto($tipo,$id_ayuda){
		$where = "  tipo='".$tipo."' AND  id_ayuda='".$id_ayuda."' ";	 
		$output = parent::getArrayObjects($this->sourceTable,$where,$order); 
		return $output['0']['ayuda'];
	}
	
	function getAyudaTipo($tipo){
		$where = "  tipo='".$tipo."' AND publicar=1";	 
		return(parent::getArrayObjects($this->sourceTable,$where,$order)); 
	}

	function getAyuda($id,$tipo=''){		 
		$where = "id_ayuda='".$id."'";			
		if(trim($tipo) != '')
		{
			$where .= "AND tipo='".$tipo."'";	
		} 
		$this->obj->loadObject($where); 
		return $this->obj;
	}
}

?>