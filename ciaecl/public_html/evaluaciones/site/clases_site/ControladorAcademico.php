<?php
class TipoAcademico extends PersistentObject {

	var $sourceTable = "site_academicos_tipo";
	
	function TipoAcademico() {
		parent::PersistentObject();
	}	 
}

class ControlTipoAcademico extends ControladorDeObjetos 
{
	var $obj; 	  
	
	function ControlTipoAcademico() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new TipoAcademico(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	} 
	
	function obtenerTipoAcademico($id_tipo=0)
	{			
		$where = '';
		if($id_tipo != 0)
			$where = 'id_tipo 	 = '.$id_tipo;
		$order = 'orden ASC';
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	}
}
/*******************************************************************************
					ESTRUCTURA DE ACADÉMICOS
********************************************************************************/
class Academico extends PersistentObject {

	var $sourceTable = "site_academicos";
	
	function Academico() {
		parent::PersistentObject();
	}	 

	function obtenerAcademico($id_academico)
	{
		parent::loadObject('id_academico = '.$id_academico);
	}	
}

class ControlAcademico extends ControladorDeObjetos 
{
	var $obj; 	  
	
	function ControlAcademico() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Academico(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	} 
	
	function obtenerAcademicos($id_academico=0)
	{			
		$where = '';
		
		if($id_academico != 0)
			$where = ' AND id_academico 	 = '.$id_academico;
		$query = 'SELECT a. * , t. *
				FROM site_academicos AS a, site_academicos_tipo AS t
				WHERE t.id_tipo = a.id_tipo '.$where.'
				ORDER BY t.orden ASC, a.apellido asc'; 
		return parent::getQuery($query); 
	}
} 
?>