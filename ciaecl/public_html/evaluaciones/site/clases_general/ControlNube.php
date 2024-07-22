<?php 

class Nube extends Objetos
{
	var $sourceTable =  'site_palabra_nube'; 
	
	function Nube()
	{  
		parent::Objetos();
	} 
} 

class ControlNube extends ControlObjetos
{
	function ControlNube()
	{
		parent::ControlObjetos();
		$this->obj = new Nube(); 
		$this->key = 'id_palabra_nube';
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerListadoPalabras()
	{
		$sql = "SELECT site_palabra_nube . * , count( id_palabra_nube ) AS total
		        FROM ".$this->obj->sourceTable."
				GROUP BY palabra
				ORDER BY total DESC
				LIMIT 8 ";
		echo $sql;
		return(parent::getQuery($sql));		
	}
}

?>