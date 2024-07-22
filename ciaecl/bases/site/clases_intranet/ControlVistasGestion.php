<?php

	class ControlVistaGestionDatosEncargados extends ControlVistas
	{
		function ControlVistaGestionDatosEncargados()
		{
			parent::ControlVistas(); 			
			$this->key 			= 'user_id_responsable';
			$this->sourceTable  = 'view_gestion_solicitudes_encargados';
			$this->order		= 'id_usuario_responsable ASC';	
			parent::prepararObjecto();		 	
		}		
		
		function obtenerEmailEstado($estado)
		{			
			$this->where = "id_tipo_estado = '".$estado."' ";
			$output = parent::obtenerListado();
			return $output[0]['email'];
		}
	}

 	class ControlVistaGestionSolicitudesEstados extends ControlVistas
	{		
		function ControlVistaGestionSolicitudesEstados()
		{
			parent::ControlVistas(); 			
			$this->key 			= 'id_solicitud';
			$this->sourceTable  = 'view_gestion_solicitudes_estados';
			$this->order		= 'fecha_solicitud ASC,orden ASC';
			parent::prepararObjecto();			 					
		}	
		
		function obtenerSolicitud($id_solicitud)
		{
			$this->where = "id_solicitud = ".$id_solicitud;
			return parent::obtenerListado();
		}	
		
		function obtenerListadoPendienteUsuario($usuario)
		{
			$this->where = "user_id_responsable = '".$usuario."'  OR ( id_persona_solicitante = '".$usuario."' AND  id_tipo_estado LIKE 'solicitud%' )";
			return parent::obtenerListado();
		}
		
		function obtenerListadoSolicitudNoPendienteUsuario($usuario,$administracion=false)
		{
			if($administracion)
			{
				$this->where = "user_id_responsable NOT LIKE '".$usuario."'  ";
			}
			else
			{
				$this->where = "  id_persona_solicitante = '".$usuario."' AND id_tipo_estado NOT LIKE 'solicitud%'  ";				
			}
			return parent::obtenerListado();
		}
		
		function obtenerSolicitudInvestigador($usuario)
		{			
			$this->where = " id_persona_solicitante = '".$usuario."'";  
			return parent::obtenerListado();
		}
		
		function obtenerSolicitudUsuarioResponsable($usuario)
		{
			$this->where = " user_id_responsable = '".$usuario."' OR ( id_persona_solicitante = '".$usuario."' )";  
			return parent::obtenerListado(); 
		}
	}	 

	class ControlGestionSolicitudesEstadosHistorialVista extends ControlVistas
	{ 	
		function ControlGestionSolicitudesEstadosHistorialVista()
		{
			parent::ControlVistas(); 			
			$this->key 			= 'id_solicitud';
			$this->sourceTable  = 'view_gestion_solicitudes_estados_historial';
			$this->order		= 'fecha DESC, orden';
			parent::prepararObjecto();		 		
		}
		
		function obtenerHistorial($id_solicitud)
		{
			$this->where = "id_solicitud = ".$id_solicitud;
			$this->order = 'fecha ASC, orden';	
			return parent::obtenerListado();			
		}	 
	}	
?>