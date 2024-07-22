<?php


class InventarioLibrosLibros extends Objetos 
{		
	var $sourceTable = "site_gestion_inventario_libros_libros";
	
	function InventarioLibrosLibros() 
	{
		parent::Objetos();
        $this->dbKey = 'id_libro';
	} 
}  

class ControlInventarioLibrosLibros extends ControlObjetos
{
	var $obj; 	  
	
	function ControlInventarioLibrosLibros() 
	{			
		parent::ControlObjetos();
		$this->obj          = new InventarioLibrosLibros();
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'estado, fecha_ingreso_base DESC,titulo ASC, id_libro DESC';  
	}
	
	function eliminarVacias()
	{		
		$sql = "DELETE FROM ".$this->sourceTable." WHERE ".$this->obj->dbKey." = ''";
		parent::consultarEspecifica($sql);
	}  
	
	function obtenerLibrosActivos()
	{
		$this->where = 'estado ="activo"';
		return parent::obtenerListado();
	} 
	
	function obtenerLibrosActivosSolicitados()
	{
		$this->where = 'estado ="activo" OR estado ="solicitud"';
		$this->order = 'id_libro,'.$this->order;
		return parent::obtenerListado();
	} 
	
	function obtenerNuevoID()
	{
		$sql = "SELECT id_libro
		FROM ".$this->sourceTable."
		ORDER BY  id_libro  DESC  LIMIT 1";
		$output = parent::getQuery($sql);
		$nuevo = str_replace('CIAE0','',$output[0]['id_libro'])+1;
		return 'CIAE0'.$nuevo;	
	}
} 


class InventarioLibrosPrestamosDetalle extends Objetos 
{		
	var $sourceTable = "site_gestion_inventario_libros_prestamos_detalle";
	
	function InventarioLibrosPrestamosDetalle() 
	{
		parent::Objetos();
        $this->dbKey = 'id_prestamo';
	} 
}

class ControlInventarioLibrosPrestamosDetalle extends ControlObjetos
{
	var $obj; 	  
	
	function ControlInventarioLibrosPrestamosDetalle() 
	{			
		parent::ControlObjetos();
		$this->obj          = new InventarioLibrosPrestamosDetalle();
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= $this->obj->dbKey.', fecha_devolucion'; 
		$this->select 		= 'date_format(fecha_devolucion,"%d-%m-%Y") AS fecha_devolucion_html ';
	}  
	
	function devolverItemenes($id_prestamo,$fecha_devolucion)
	{
		$sql = "UPDATE ".$this->sourceTable." SET estado = 'devuelto', fecha_devolucion = '".$fecha_devolucion."' WHERE id_prestamo = '".$id_prestamo."'";
		parent::getQuery($sql);
	}
	
	function actualizarFechaDevolucionEstimada($id_prestamo,$fecha_devolucion_estimada)
	{ 
		$sql = "UPDATE ".$this->sourceTable." SET fecha_devolucion_estimada = '".$fecha_devolucion_estimada."' WHERE id_prestamo = '".$id_prestamo."' AND fecha_devolucion_estimada = '0000-00-00' ";
		parent::getQuery($sql);
	}
}  

class InventarioLibrosPrestamos extends Objetos 
{		
	var $sourceTable = "site_gestion_inventario_libros_prestamos";
	
	function InventarioLibrosPrestamos() 
	{
		parent::Objetos();
        $this->dbKey = 'id_prestamo';
	} 
	
	function buscarObjeto($id_prestamo)
	{ 
		parent::loadObject($this->dbKey.' = "'.$id_prestamo.'"');
	}
	
	function guardarObjeto($id_prestamo)
	{		         
		if($this->newObject)
		{
			parent::saveObject();
		}
		else
		{ 
			parent::saveObject($this->dbKey.' = "'.$id_prestamo.'"');
		}
	}
} 

class ControlInventarioLibrosPrestamos extends ControlObjetos
{
	var $obj; 	  
	
	function ControlInventarioLibrosPrestamos() 
	{			
		parent::ControlObjetos();
		$this->obj          = new InventarioLibrosPrestamos();
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'fecha_prestamo, fecha_devolucion,fecha_solicitud, id_libro DESC'; 
		$this->select 		= 'date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html, date_format(fecha_devolucion,"%d-%m-%Y") AS fecha_devolucion_html,  date_format(fecha_solicitud,"%d-%m-%Y") AS fecha_solicitud_html';
	}  
	
	function obtenerNuevoNumeroMemo()
	{
		$sql = "SELECT max(numero_memo)+1 as maximo FROM ".$this->sourceTable." LIMIT 1";
		$output = parent::getQuery($sql);
		return $output['0']['maximo'];	
	}
}  

class ControlVistaPrestamoLibrosUsuarioDetalle extends ControlVistas
{
	function ControlVistaPrestamoLibrosUsuarioDetalle()
	{
		parent::ControlVistas(); 			
		$this->key 			= 'id_prestamo';
		$this->sourceTable  = 'view_gestion_inventario_libros_prestamos_detalle';
		$this->order		= 'estado DESC,fecha_solicitud DESC,fecha_devolucion ASC,fecha_prestamo DESC';
		$this->select 		= 'date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html, date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html,  date_format(fecha_solicitud,"%d-%m-%Y") AS fecha_solicitud_html';
		parent::prepararObjecto();
	} 
	
	function buscarPrestamosLibro($id_libro)
	{ 
		$this->where = "id_libro = '".$id_libro."'";
		return parent::obtenerListado();
	}
	
	function buscarPrestamo($id_prestamo)
	{ 
		$this->where = "id_prestamo = '".$id_prestamo."'";
		return parent::obtenerListado();
	}
}

class ControlVistaPrestamoLibrosUsuario extends ControlVistas
{
	function ControlVistaPrestamoLibrosUsuario()
	{
		parent::ControlVistas(); 			
		$this->key 			= 'id_prestamo';
		$this->sourceTable  = 'view_gestion_inventario_libros_prestamos';
		$this->order		= 'estado DESC,fecha_solicitud DESC,fecha_devolucion ASC,fecha_prestamo DESC';
		$this->select 		= 'date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html, date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html,  date_format(fecha_solicitud,"%d-%m-%Y") AS fecha_solicitud_html';
		parent::prepararObjecto();
	} 
	
}
 

?>