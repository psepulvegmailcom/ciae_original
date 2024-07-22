<?php

	class GestionTipoSolicitudes extends Objetos
	{	
		var $sourceTable = 'site_tipo_solicitudes_estados';	
		 
		function GestionTipoSolicitudes()
		{
			parent::Objetos();
			$this->dbKey	= 'id_tipo_estado';
		} 
	}  
 
	class ControlGestionTipoSolicitudes extends ControlObjetos
	{
	 
		function ControlGestionTipoSolicitudes()
		{
			parent::ControlObjetos();
			$this->obj	    = new GestionTipoSolicitudes();
			parent::prepararObjeto();  
			$this->order	= 'funcionalidad ASC, orden';		
		}	 
		
		function obtenerResponsable($nuevo_estado)
		{
		 	$ControlVistaAuthPersona = new ControlVistaAuthPersona();
			$sql = "SELECT te.id_usuario_responsable ,	te.user_id_responsable, tp.email
			FROM ".$this->sourceTable." as  te, ".$ControlVistaAuthPersona->sourceTable." as tp
			WHERE te.user_id_responsable = tp.user_id AND te.id_tipo_estado = '".$nuevo_estado."'";

			return parent::getQuery($sql);
		} 
		
		function obtenerEstadoSiguiente($funcionalidad,$tipo_estado_actual,$resultado_simple=true)
		{ 			
			$sql = "SELECT *
			FROM ".$this->obj->sourceTable."
			WHERE funcionalidad LIKE '".$funcionalidad."'
			AND orden > (
			SELECT orden
			FROM ".$this->obj->sourceTable."
			WHERE id_tipo_estado LIKE '".$tipo_estado_actual."'
			AND funcionalidad LIKE '".$funcionalidad."' )
			ORDER BY orden ASC
			LIMIT 1";
			
			$output = parent::getQuery($sql);
			if($resultado_simple)
				return $output[0]['id_tipo_estado'];
			else		
				return $output[0];
		}
		
		function obtenerEstadoAnterior($funcionalidad,$tipo_estado_actual)
		{ 			
			$sql = "SELECT *
			FROM ".$this->obj->sourceTable."
			WHERE funcionalidad LIKE '".$funcionalidad."'
			AND orden < (
			SELECT orden
			FROM ".$this->obj->sourceTable."
			WHERE id_tipo_estado LIKE '".$tipo_estado_actual."'
			AND funcionalidad LIKE '".$funcionalidad."' )
			ORDER BY orden DESC
			LIMIT 1";
			
			$output = parent::getQuery($sql);
			return $output[0]['id_tipo_estado'];			
		}
		
		function obtenerEstadoDecisionEstado($funcionalidad,$tipo_estado_actual,$decision)
		{			
			$sql = "SELECT estado_siguiente_".$decision." as estado_siguiente
			FROM ".$this->obj->sourceTable."
			WHERE funcionalidad LIKE '".$funcionalidad."'
			AND id_tipo_estado = '".$tipo_estado_actual."' 
			LIMIT 1";
			
			$output = parent::getQuery($sql); 
			
			$sql = "SELECT *
			FROM ".$this->obj->sourceTable."
			WHERE id_tipo_estado = '".$output[0]['estado_siguiente']."'
			LIMIT 1";
			
			$output = parent::getQuery($sql);
			return $output[0];
		}
	}   
?>