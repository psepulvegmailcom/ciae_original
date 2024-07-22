<?php
 
/*******************************************************************************
					ESTRUCTURAS DE COLUMNAS
********************************************************************************/
class Invitados extends PersistentObject {

	var $sourceTable = "site_invitados";
	
	function Invitados() 
	{
		parent::PersistentObject();
	}	 

	function obtenerElemento($id_invitado)
	{
		parent::loadObject('id_invitado = '.$id_invitado);
	}	
}

class ControlInvitados extends ControladorDeObjetos 
{
	var $obj; 	  
	
	function ControlInvitados() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Invitados(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	} 
	
	function obtenerElementos()
	{
		$order = ' RAND()';
		$where = 'activo = 1';
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	}
} 

?>