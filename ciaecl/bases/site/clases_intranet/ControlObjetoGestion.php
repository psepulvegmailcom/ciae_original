<?php

	
 	/** **************************************************************************************
	 *
	 * GestionSolicitudes
	 *   
	 * @author Paulina Sep&uacute;lveda - psepulve@gmail.com  
	 * @copyright 2016 
	 * @info objeto base de GestionSolicitudes
	 *
	 *****************************************************************************************/
	 
	class GestionSolicitudes extends Objetos
	{	
		var $sourceTable = 'site_gestion_solicitudes';	
		
		/**
		* GestionSolicitudes::GestionSolicitudes()		
		* @info inicializaci&oacute;n del objeto  
		* @return void
		*/
		function GestionSolicitudes()
		{
			parent::Objetos();
			$this->dbKey	= 'id_solicitud';
		} 
	} 

	/** **************************************************************************************
	 *
	 * ControlGestionSolicitudes
	 *  
	 * @author Paulina Sep&uacute;lveda - psepulve@gmail.com 
	 * @copyright 2016 
	 * @info Controlador de objeto base de GestionSolicitudes
	 *
	 *****************************************************************************************/
	 
	class ControlGestionSolicitudes extends ControlObjetos
	{
		/**
		* ControlGestionSolicitudes::ControlGestionSolicitudes()
		* @info inicializaci&oacute;n del objeto control
		* @return void
		*/	
		function ControlGestionSolicitudes()
		{
			parent::ControlObjetos();
			$this->obj	    = new GestionSolicitudes();
			parent::prepararObjeto();  
			$this->order	= 'id_solictud ASC';		
		}	 
		
		function obtenerSolicitante($id_solicitud)
		{
		 	$ControlVistaAuthPersona = new ControlVistaAuthPersona();
			$sql = "SELECT te.id_persona_solicitante ,   tp.email
			FROM ".$this->sourceTable." as  te, ".$ControlVistaAuthPersona->sourceTable." as tp
			WHERE te.id_persona_solicitante= tp.user_id AND te.id_solicitud = '".$id_solicitud."'";

			return parent::getQuery($sql);
		 
		}
	}
	
 	/** **************************************************************************************
	 *
	 * GestionSolicitudesViaticos
	 *   
	 * @author Paulina Sep&uacute;lveda - psepulve@gmail.com  
	 * @copyright 2016 
	 * @info objeto base de GestionSolicitudesViaticos
	 *
	 *****************************************************************************************/
	 
	class GestionSolicitudesViaticos extends Objetos
	{	
		var $sourceTable = 'site_gestion_solicitudes_viaticos';	
		
		/**
		* GestionSolicitudesViaticos::GestionSolicitudesViaticos()		
		* @info inicializaci&oacute;n del objeto  
		* @return void
		*/
		function GestionSolicitudesViaticos()
		{
			parent::Objetos();
			$this->dbKey	= 'id_solicitud';
		} 
	} 

	/** **************************************************************************************
	 *
	 * ControlGestionSolicitudesViaticos
	 *  
	 * @author Paulina Sep&uacute;lveda - psepulve@gmail.com 
	 * @copyright 2016 
	 * @info Controlador de objeto base de GestionSolicitudesViaticos
	 *
	 *****************************************************************************************/
	 
	class ControlGestionSolicitudesViaticos extends ControlObjetos
	{
		/**
		* ControlGestionSolicitudesViaticos::ControlGestionSolicitudesViaticos()
		* @info inicializaci&oacute;n del objeto control
		* @return void
		*/	
		function ControlGestionSolicitudesViaticos()
		{
			parent::ControlObjetos();
			$this->obj	    = new GestionSolicitudesViaticos();
			parent::prepararObjeto();  
			$this->order	= 'id_solicitud ASC';		
		}	 
		
		function obtenerDetalle($id_solicitud)
		{
			$this->where = "id_solicitud = ".$id_solicitud; 
			return parent::obtenerListado();
		}
	}	
	
 	/** **************************************************************************************
	 *
	 * GestionSolicitudesEstados
	 *   
	 * @author Paulina Sep&uacute;lveda - psepulve@gmail.com  
	 * @copyright 2016 
	 * @info objeto base de GestionSolicitudesEstados
	 *
	 *****************************************************************************************/
	 
	class GestionSolicitudesEstados extends Objetos
	{	
		var $sourceTable = 'site_gestion_solicitudes_estados';	
		
		/**
		* GestionSolicitudesEstados::GestionSolicitudesEstados()		
		* @info inicializaci&oacute;n del objeto  
		* @return void
		*/
		function GestionSolicitudesEstados()
		{
			parent::Objetos();
			$this->dbKey	= 'id_solicitud';
		} 
		
		function buscarElementoEstado($id_solicitud,$estado)
		{
			parent::loadObject(' id_solicitud = "'.$id_solicitud.'" AND id_solicitud_estado = "'.$estado.'" ORDER BY fecha DESC');
		}

		function guardarObjeto()
		{ 
			if($this->newObject)
			{
				parent::saveObject();
			}
			else
			{ 
				parent::saveObject( 'id_solicitud = "'.$this->id_solicitud.'" AND id_solicitud_estado = "'.$this->id_solicitud_estado.'"  AND fecha = "'.$this->fecha.'"');
			}
		} 		
	} 

	/** **************************************************************************************
	 *
	 * ControlGestionSolicitudesEstados
	 *  
	 * @author Paulina Sep&uacute;lveda - psepulve@gmail.com 
	 * @copyright 2016 
	 * @info Controlador de objeto base de GestionSolicitudesEstados
	 *
	 *****************************************************************************************/
	 
	class ControlGestionSolicitudesEstados extends ControlObjetos
	{
		/**
		* ControlGestionSolicitudesEstados::ControlGestionSolicitudesEstados()
		* @info inicializaci&oacute;n del objeto control
		* @return void
		*/	
		function ControlGestionSolicitudesEstados()
		{
			parent::ControlObjetos();
			$this->obj	    = new GestionSolicitudesEstados();
			parent::prepararObjeto();  
			$this->order	= 'id_solictud ASC';		
		}	 
	}
	 
	class GestionSolicitudesEstadosArchivos extends Objetos
	{	
		var $sourceTable = 'site_gestion_solicitudes_estados_archivos';	
		 
		function GestionSolicitudesEstadosArchivos()
		{
			parent::Objetos();
			$this->dbKey	= 'id_solicitud';
		} 


		function guardarObjeto()
		{ 
			if($this->newObject)
			{
				parent::saveObject();
			}
			else
			{ 
				parent::saveObject( 'id_solicitud = "'.$this->id_solicitud.'" AND id_solicitud_estado = "'.$this->id_solicitud_estado.'"  AND fecha = "'.$this->fecha.'"');
			}
		} 			
	} 

	class ControlGestionSolicitudesEstadosArchivos extends ControlObjetos
	{
	 
		function ControlGestionSolicitudesEstadosArchivos()
		{
			parent::ControlObjetos();
			$this->obj	    = new GestionSolicitudesEstadosArchivos();
			parent::prepararObjeto();  
			$this->order	= 'id_solicitud ,id_solicitud_estado ,fecha ,nombre';		
		}
		
		function obtenerArchivosEstado($id_solicitud,$id_solicitud_estado,$fecha)
		{
			$this->where = 'id_solicitud = "'.$id_solicitud.'" AND id_solicitud_estado = "'.$id_solicitud_estado.'"  AND fecha = "'.$fecha.'"';
			
			return parent::obtenerListado();
		}
		
		function obtenerArchivosCotizaciones($id_solicitud)
		{
			$this->where = 'id_solicitud = "'.$id_solicitud.'" AND id_solicitud_estado LIKE "cotizacion%" ';
			$this->order = 'fecha DESC ';
			return parent::obtenerListado();
		}
		
		function obtenerArchivos($id_solicitud)
		{
			$this->where = 'id_solicitud = "'.$id_solicitud.'"  ';
			$this->order = 'fecha DESC ';
			return parent::obtenerListado();
		}
	}	 

	class ControlGestionDestinos extends ControlVistas
	{
		function ControlGestionDestinos()
		{
			parent::ControlVistas(); 			
			$this->key 			= 'destino';
			$this->sourceTable  = 'view_gestion_destinos';
			$this->order		= 'destino ASC';
			parent::prepararObjecto();		 		
		} 
		
		function obtenerListadoSimple()
		{
			$sql = "SELECT  DISTINCT ".$this->key." FROM ".$this->sourceTable." WHERE ".$this->key." NOT LIKE ''  ORDER BY  ".$this->order;
			return parent::getQuery($sql);	
		}  
	}   
	
?>