<?php


	class PermisoParticulares extends PersistentObject 
	{		
		var $sourceTable = "auth_rol_permisos_particulares";
		
		function PermisoParticulares() {
			parent::PersistentObject();
		}	
	}
	class ControladorPermisosParticulares  extends ControladorDeObjetos
	{	 
		var $order       = "permiso";
		
		function ControladorPermisosParticulares() 
		{
			$PermisoParticulares = new PermisoParticulares();
			$this->sourceTable = $PermisoParticulares->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function PermisoHabilitadoModuloPermisoParticular($permiso,$modulo,$permiso_particular)
		{
			$where = "permiso = '".$permiso."' AND modulo = '".$modulo."' AND permiso_especifico = '".$permiso_particular."'  ";
			$permiso = parent::getArrayObjects($this->sourceTable,$where,$this->order);
			//Funciones::mostrarArreglo($permiso,true);
			if(is_array($permiso) && count($permiso) > 0)
			{  
				return true;
			}
			else
			{
				return false;
			}
		}			
	}	
	
	class Permiso extends PersistentObject 
	{		
		var $sourceTable = "auth_rol";
		
		function Permiso() {
			parent::PersistentObject();
		}	
	}
	
	class ControladorPermisos  extends ControladorDeObjetos
	{	 
		var $order       = "alias";
		
		function ControladorPermisos() {
			$Permiso = new Permiso();
			$this->sourceTable = $Permiso->sourceTable;
			parent::ControladorDeObjetos();
		}	
		
		function getArrayPermisos($alias='') 
		{
			$where = "";
			if(trim($alias) != '')
				$where = "alias = '".$alias."'";
			
			$order = "id_permiso,descripcion";			
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}	
		
		function getPermisoBase()
		{
			$where = "base=1";	
			$permiso = parent::getArrayObjects($this->sourceTable,$where,$this->order);	
			return $permiso[0]['alias'];
		}

		function getPermisoAdmin()
		{
			$where = "base=2";	
			$permiso = parent::getArrayObjects($this->sourceTable,$where,$this->order);	
			return $permiso[0]['alias'];
		}			
		
		function getPermisoByAlias($alias)
		{
			$where = "alias='".$alias."'";	
			$permiso = parent::getArrayObjects($this->sourceTable,$where,$this->order);	
			
			return $permiso[0]['id_permiso'];		
		}
	}	
	

	/************************************************************************************
					OTROS PERMISOS PARTICULARES POR USUARIO
	************************************************************************************/

	class PermisoParticular extends PersistentObject 
	{		
		var $sourceTable = "auth_user_ate_permiso";
		
		function PermisoParticular() {
			parent::PersistentObject();
		}	
	}
	
	class ControladorPermisoParticular  extends ControladorDeObjetos
	{	 
		var $order       = "";
		
		function ControladorPermisoParticular()
		{
			$this->PermisoParticular = new PermisoParticular();
			$this->sourceTable = $this->PermisoParticular->sourceTable;
			parent::ControladorDeObjetos();
		}	
		
		function obtenerPermisosUsuario($username) 
		{
			$where = " username ='".$username."' "; 			
			$order = "permiso";			
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}	

		function tienePermiso($username,$permiso)
		{
			$this->PermisoParticular->loadObject("username ='".$username."' AND permiso = '".$permiso."'"); 
			if(isset($this->PermisoParticular->permiso))
				return true;
			else
				return false;
		}
	}		
	
?>