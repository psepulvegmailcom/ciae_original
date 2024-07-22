<?php

	class GestionCentroCostos extends Objetos
	{
		var $sourceTable =  'site_tipo_centro_costos';
		
		function GestionCentroCostos()
		{ 
			parent::Objetos();
			$this->dbKey 		= 'id_centro_costo';
		} 
	} 	
	
	class ControlGestionCentroCostos extends ControlObjetos
	{
		function ControlGestionCentroCostos()
		{
			parent::ControlObjetos();
			$this->obj 		= new GestionCentroCostos();
			$this->order 	= 'proyecto';		 
			parent::prepararObjeto(); 
		} 
	} 

	class ControlVistaCentroCostosResponsable extends ControlVistas
	{  
		function ControlVistaCentroCostosResponsable()
		{
			parent::ControlVistas(); 		
			$this->sourceTable 	= 'view_gestion_centro_costo_responsable'; 
			$this->order		= 'activo DESC,codigo ASC, centro_costo ASC, id_centro_costo ASC';
			$this->key 			= 'id_centro_costo'; 
			parent::prepararObjecto();		 
		}
		
		function buscarProyectosResponsable($id_usuario_responsable)
		{
			$this->where = " usuario = '".$id_usuario_responsable."'";  
			return parent::obtenerListado();			
		}		
		
		function buscarProyectosAdministracion($activo='1')
		{    
			if(trim($activo) == '1')
			{
				$this->where = " activo = 1";	
			} 	
			return parent::obtenerListado();			
		} 
		
		function obtenerListadoPorId()
		{
			$output = parent::obtenerListado();
			
			//Funciones::mostrarArreglo($output,true); 
			$salida = array();
			for($i=0; $i < count($output);$i++)
			{
				$salida[$output[$i]['id_centro_costo']] = $output[$i];
			}
			return $salida;
		}
	} 		 
?>