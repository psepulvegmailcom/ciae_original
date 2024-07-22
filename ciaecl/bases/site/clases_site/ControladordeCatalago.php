<?php
class CategoriaCatalogo extends PersistentObject {

	var $sourceTable = "site_catalogo_categoria";
	
	function CategoriaCatalogo() {
		parent::PersistentObject();
	}	

	function obtenerCategoria($id_categoria)
	{
		parent::loadObject('id_categoria = '.$id_categoria);
	}
 
}

class ControlCategoriaCatalogo extends ControladorDeObjetos 
{
	var $obj; 	  
	
	function ControlCategoriaCatalogo() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new CategoriaCatalogo(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	}
	
	

	function obtenerCategoriaCatalogo($id_categoria=0)
	{			
		$where = 'categoria_id_padre = '.$id_categoria;
		$order = 'orden ASC';
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	}
}

/***************************************************************************************
	CLASES DE PRODUCTOS DEL CATALOGO
****************************************************************************************/
class ProductoCatalogo extends PersistentObject {

	var $sourceTable = "site_catalogo_productos";
	
	function ProductoCatalogo() {
		parent::PersistentObject();
	}	

	function obtenerProducto($id_producto)
	{
		parent::loadObject('id_categoria = '.$id_categoria);
	}
}

class ControlProductoCatalogo extends ControladorDeObjetos 
{
	var $obj; 	  
	
	function ControlProductoCatalogo() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new ProductoCatalogo(); 	
		$this->sourceTable = $this->obj->sourceTable; 
	}

	function obtenerProductosCatalogo($id_categoria=0)
	{			 
		$where = 'id_categoria = '.$id_categoria;
		$order = ' precio ASC ,  precio_extra ASC';
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	}

	function obtenerProducto($id_producto)
	{			
		$where = 'id_producto = '.$id_producto; 
		return parent::getArrayObjects($this->sourceTable,$where); 
	}

	function obtenerProductosCatalogoRaiz($id_categoria)
	{
		$sql = 'SELECT  p. *
FROM site_catalogo_categoria AS c, site_catalogo_productos AS p
WHERE c.categoria_id_padre = '.$id_categoria.'
AND p.id_categoria = c.id_categoria
ORDER BY p.precio ASC , p.precio_extra ASC';

			return parent::getQuery($sql);
	}
}
?>