<?php 

class Nube extends Objetos
{
	var $sourceTable =  'site_palabra_clave'; 
	var $dbKey 		 = 'id_palabra_clave';
	
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
		$this->dbKey = 'id_palabra_clave';
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerListadoPalabras($id_sitio,$tipo,$total)
	{
		$ControlSite = new ControlSite(); 
		$this->where = " tipo_palabra='".$tipo."' AND desactivar=0 AND id_site='".$id_sitio."'" ;	
		$this->order = "  suma DESC ,rand() LIMIT ".$total." ";
		return parent::obtenerListado(); 
	}
	
	function agregarNuevaPalabraNube($palabra,$id_sitio,$tipo)
	{
		$palabras = explode(",",$palabra);
		$total = count($palabras); 
		for($i=0; $i < $total; $i++)
		{  
			$palabras[$i] = trim($palabras[$i]);
			if($palabras[$i] == '')
			{
				continue;
			}
			$this->obj = new Nube(); 
			$this->obj->loadObject("MATCH(palabra_clave) AGAINST ('%".$palabras[$i]."%' )  AND  tipo_palabra = '".$tipo."' AND id_site = '".$id_sitio."'");
			if($this->obj->newObject)
			{ 
				$this->obj->palabra_clave = $palabras[$i]; 
				$this->obj->tipo_palabra = $tipo; 
				$this->obj->id_site = $id_sitio;  
			}
			else
			{
				$this->obj->suma = $this->obj->suma + 1;
			}
			$this->obj->guardarObjeto();
		}
	} 
}

 
?>