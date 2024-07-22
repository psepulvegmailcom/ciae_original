<?php

	class Honorarios extends PersistentObject
	{	
		var $sourceTable = "site_honorario_personas";
		
		function Honorarios()
		{
			parent::PersistentObject();
		}

		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("rut='".$this->rut."'");
			}
			else
			{				  
				$this->saveObject();
			}
		}	
		
		function consultaHonorariosRut($rut)
		{
			$this->loadObject("rut ='".$rut."'");
		}	 
	}
	
	class ControladorHonorarios  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorHonorarios() 
		{  	
			$this->obj 				= new Honorarios();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'rut';
			parent::ControladorDeObjetos();
		}     
	}  


	class HonorariosTitulo extends PersistentObject
	{	
		var $sourceTable = "site_honorario_personas_titulo";
		
		function HonorariosTitulo()
		{
			parent::PersistentObject();
		}  


		function consultaHonorariosRutOrden($rut,$orden)
		{
			$this->loadObject("rut ='".$rut."' AND orden ='".$orden."'");
		}	 	


		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("rut='".$this->rut."' AND orden = ".$this->orden );
			}
			else
			{				  
				$this->saveObject();
			}
		}				
	}	
	
	
	class ControladorHonorariosTitulo  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorHonorariosTitulo() 
		{  	
			$this->obj 				= new HonorariosTitulo();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'rut';
			parent::ControladorDeObjetos();
		}     
		
		function obtenerTitulos($rut)
		{
			$where = "rut = '".$rut."'"; 
			$order = 'orden';
			return parent::getArrayObjects($this->sourceTable,$where,$order) ;
			
		}
	} 

	class HonorariosLabores extends PersistentObject
	{	
		var $sourceTable = "site_honorario_personas_labores";
		
		function HonorariosLabores()
		{
			parent::PersistentObject();
		}  
		
		function consultaHonorariosRutOrden($rut,$orden)
		{
			$this->loadObject("rut ='".$rut."' AND orden ='".$orden."'");
		}	 	

		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("rut='".$this->rut."' AND orden = ".$this->orden );
			}
			else
			{				  
				$this->saveObject();
			}
		}
	}
	
	class ControladorHonorariosLabores  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorHonorariosLabores() 
		{  	
			$this->obj 				= new HonorariosLabores();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'rut';
			parent::ControladorDeObjetos();
		}     
		
		function obtenerLabores($rut)
		{
			$where = "rut = '".$rut."'"; 
			$order = 'orden';
			return parent::getArrayObjects($this->sourceTable,$where,$order) ;
			
		}
	} 	


?>