<?php

	class Persona extends PersistentObject
	{	
		var $sourceTable = 'auth_user_info';
				
		function Persona() 
		{
			parent::PersistentObject();
		}		 	
	}
	
	
	class PersonaControl extends ControladorDeObjetos
	{	
		var $order       = "apellido_paterno";
		var $obj;
		
		function PersonaControl() 
		{
			parent::ControladorDeObjetos();
			$this->obj = new Persona();
			$this->sourceTable = $this->obj->sourceTable;
		}		
		
		function setPersona($id)
		{
			$this->obj->loadObject("id_persona=".$id);
		}
		
		function setPersonaByUser($obj)
		{
			$this->obj->loadObject("user_id='".$obj->user_id."'");
		} 
		 
		function datosCompletos()
		{
			/* REVISAR SI LOS DATOS DEL USUARIO ESTAN COMPLETOS */
			$valoresFormulario = array('nombre','apellido_paterno','apellido_materno','email','institucion','sexo','cargo','profesion','cargo_agno','nivel_conocimiento');
			 
			for($i=0; $i < count($valoresFormulario); $i++)
			{
				if(trim($this->$valoresFormulario[$i]) == '')
				{
					return false;
				}  
			}  
			return true;
		}
		
		function setPersonaByEmail($email){
			$this->obj->loadObject("email='".$email."'");
		}
		
		function getNombreCompleto()
		{			
			$resultado 	= $this->obj->nombre." ".$this->obj->apellido_paterno." ".$this->obj->apellido_materno;
			return $resultado;
		}
		
		function getRut()
		{			
			$resultado 	= number_format($this->obj->rut)." ".$this->obj->rut_dv;
			return $resultado;
		}
		
		function getEmail()
		{			
			$resultado 	= $this->obj->email;
			return $resultado;
		} 
		
		function getPersonaId()
		{			
			return $this->obj->id;
		}
		
		function getPersona()
		{
			return $this->obj;
		}
		
		function addNewPersona($datos)	
		{		
			$this->obj->nombre 				= Funciones::textToTitle($datos['nombre']);
			$this->obj->apellido_paterno 	= Funciones::textToTitle($datos['apellido_paterno']);
			$this->obj->apellido_materno 	= Funciones::textToTitle($datos['apellido_materno']);
			$this->obj->email 				= $datos['email'];
			$this->obj->user_id 			= $datos['user_id'];
			$this->obj->newObject 			= true;
			return $this->obj->saveObject();			
		}
		
		function savePersona()
		{
			return $this->obj->saveObject('id_persona='.$this->obj->id_persona);
		}
		
		function getLista()
		{
			$where = "";				 
			$order = 'apellido_paterno';		
			return parent::getArrayObjects($this->sourceTable,$where,$order);		
		}
	}
?>