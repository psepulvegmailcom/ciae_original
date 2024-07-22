<?php

	class Testimonios extends PersistentObject
	{	
		var $sourceTable = "site_testimonios";
		
		function Testimonios(){
			parent::PersistentObject();
		}
		
		function obtenerTestimonioAlumnos()
		{			 
			parent::loadObject("tipo='alumnos' AND home ='1' ORDER BY  RAND()");	 
		}
		
		function obtenerTestimonioProfesores()
		{			 
			parent::loadObject("tipo='profesores' AND home ='1' ORDER BY  RAND()");	 
		}
		
		function obtenerTestimonio()
		{			 
			parent::loadObject(" home ='1' ORDER BY  RAND()");	 
		}
	}
	
	class ControladorTestimonios  extends ControladorDeObjetos
	{  
		var $orderField  = "RAND()";		
		var $obj; 
		function ControladorTestimonios() 
		{ 
			/* coneccion interna*/	
			$this->obj 						= new Testimonios();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		} 
		
		function obtenerAlumnos()
		{ 
			$order = 'home DESC';
			$table = $this->obj->sourceTable;
			$where = " tipo='alumnos'  ";  
			return(parent::getArrayObjects($table,$where,$order));
		}
	}
	
/********************************* DOCTORADOS ***********************************/


	class Doctorados extends PersistentObject
	{	
		var $sourceTable = "site_doctorados";
		
		function Doctorados(){
			parent::PersistentObject();
		}
		 
	}
	class ControladorDoctorados  extends ControladorDeObjetos
	{  
		var $orderField  = "universidad";		
		var $obj; 
		function ControladorDoctorados() 
		{ 
			/* coneccion interna*/	
			$this->obj 						= new Doctorados();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		} 
		
		function obtenerDoctorados($tipo='%')
		{ 
			$order = 'universidad ASC';
			$table = $this->obj->sourceTable;
			$where = " tipo LIKE '".$tipo."'  ";  
			return(parent::getArrayObjects($table,$where,$order));
		}
	}
		
?>