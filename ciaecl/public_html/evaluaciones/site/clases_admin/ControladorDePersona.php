<?php
	class TipoPersona extends Objetos 
	{	
		var $sourceTable = "site_tipo_personas";
		
		function TipoPersona() 
		{
			$this->dbKey 		= 'id_tipo';
			parent::Objetos();
		}	 
	}  
	
	class ControlTipoPersona extends ControlObjetos
	{
		function ControlTipoPersona()
		{
			parent::ControlObjetos();
			$this->obj 		= new TipoPersona();
			$this->order	= 'orden ASC';
			$this->key 		= 'id_tipo';
			$this->sourceTable = $this->obj->sourceTable;
		}	
	} 
	
	class PersonaRelacionTipo extends Objetos 
	{	
		var $sourceTable = "site_personas_tipo";
		
		function PersonaRelacionTipo() 
		{
			parent::Objetos();
			$this->dbKey = 'id_persona';
		}	 
	} 
	
	class ControlPersonaRelacionTipo extends ControlObjetos
	{
		function ControlPersonaRelacionTipo()
		{
			parent::ControlObjetos();
			$this->obj 		= new PersonaRelacionTipo();
			$this->order 	= 'id_tipo'; 
			$this->key 		= $this->obj->dbKey;
			$this->sourceTable = $this->obj->sourceTable;
		} 
	}	
	
	class PersonaRelacionArea extends Objetos 
	{	
		var $sourceTable = "site_personas_areas";
		
		function PersonaRelacionArea() 
		{
			parent::Objetos();
			$this->dbKey = 'id_persona';
		}	 
	}	
	
	class ControlPersonaRelacionArea extends ControlObjetos
	{
		function ControlPersonaRelacionArea()
		{
			parent::ControlObjetos();
			$this->obj 		= new PersonaRelacionArea();
			$this->order 	= 'id_area'; 
			$this->key 		= $this->obj->dbKey;
			$this->sourceTable = $this->obj->sourceTable;
		} 
	}

	class Persona extends PersistentObject
	{	
		var $sourceTable = 'site_personas';
				
		function Persona() 
		{
			parent::PersistentObject();
		}		 	
	}
	class PersonaObjetos extends Objetos 
	{	
		var $sourceTable = 'auth_user_info';
				
		function PersonaObjeto() 
		{
			parent::Objetos();
			$this->dbKey = 'id_persona';
		}		 	
	}	


	class ControlPersonaObjetos extends ControlObjetos
	{
		function ControlPersonaObjetos()
		{
			parent::ControlObjetos();
			$this->obj 		= new PersonaObjetos();
			$this->order 	= 'apellido_paterno'; 
			$this->key 		= $this->obj->dbKey;
			$this->sourceTable = $this->obj->sourceTable;
		} 
		
		function obtenerPersona($user_id)
		{ 
			$this->where = " user_id = '".$user_id."'";
			$output = parent::obtenerListado();
			return $output[0]; 
		}
	}	

	class PersonaObjeto extends Objetos 
	{	
		var $sourceTable = 'site_personas';
				
		function PersonaObjeto() 
		{
			parent::Objetos();
			$this->dbKey = 'id_persona';
		}		 	
	}
	class ControlPersonaObjeto extends ControlObjetos
	{
		function ControlPersonaObjeto()
		{
			parent::ControlObjetos();
			$this->obj 		= new PersonaObjeto();
			$this->order	= 'apellido_paterno ASC, apellido_materno ASC, nombre ASC';			
			$this->key 		= $this->obj->dbKey;
			$this->sourceTable = $this->obj->sourceTable;
		}	
		
		function obtenerListado($excepcion='')
		{
			if(trim($excepcion) != '')
			{
				$this->where = " id_persona > 1";
			}
			return parent::obtenerListado();
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
			$this->obj->nombre 				= $datos['nombre'];
			$this->obj->apellido_paterno 	= $datos['apellido_paterno'];
			$this->obj->apellido_materno 	= $datos['apellido_materno'];
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
		
		function getListaAnexos()
		{
			$where = "anexo = 'si' ";				 
			$order = 'apellido_paterno';		
			return parent::getArrayObjects($this->sourceTable,$where,$order);		
		} 
		
		function obtenerListadoPersonasTipo($grupo,$rango,$id='')
		{  
			$TipoPersona = new TipoPersona();
			$PersonaRelacionTipo = new PersonaRelacionTipo();
			$Universidad = new Universidad(); 
			$where = "AND t.grupo = '".$grupo."'";
			$orden = "";
			$from_extra = '';
			$select_extra = '';			
			if ($rango!=""){
				if ($rango==1) $value=" BETWEEN 'A' AND 'DU' ";
				if ($rango==2) $value=" BETWEEN 'E' AND 'HU' ";
				if ($rango==3) $value=" BETWEEN 'I' AND 'LU' ";
				if ($rango==4) $value=" BETWEEN 'M' AND 'OU' ";
				if ($rango==5) $value=" BETWEEN 'P' AND 'SU' ";
				if ($rango==6) $value=" BETWEEN 'T' AND 'ZU' ";
				$leyenda = " AND p.apellido_paterno".$value;	
			}
			if(trim($id) != '')
			{
				$where = " AND p.id_persona=".$id."  AND  p.id_persona = r.id_persona   AND  r.id_tipo = t.id_tipo ";
				$from_extra = " ".$TipoPersona->sourceTable." as t,".$PersonaRelacionTipo->sourceTable." as r, ";
			}
			else
			{
				$where .= " AND  p.id_persona = r.id_persona   AND  r.id_tipo = t.id_tipo ";
				$from_extra = " ".$TipoPersona->sourceTable." as t,".$PersonaRelacionTipo->sourceTable." as r, ";
				$select_extra = 't.*,r.*, t.orden as orden_tipo, ';
				$orden = " orden_tipo, ";
			}
			if($grupo == 'investigadores')
			{
				$orden .= ' orden_universidad,';
			} 
			$sql = "SELECT p.*,".$select_extra."  u.universidad, u.orden as orden_universidad, t.tipo  as tipo_es,
			 t.descripcion  as descripcion_es, p.cargo as cargo_es,
			IF('".$this->lang."' = 'en', t.tipo_en, t.tipo) as tipo , 
			IF('".$this->lang."' = 'en', t.descripcion_en, t.descripcion) as descripcion, 
			IF('".$this->lang."' = 'en', p.cargo_en, p.cargo) as cargo
			FROM ".$this->sourceTable." as p, ".$from_extra." ".$Universidad->sourceTable." as u
			WHERE p.id_universidad = u.id_universidad ".$where.$leyenda." 
			ORDER BY  ".$orden." p.apellido_paterno, p.apellido_materno, p.nombre ";
			//Funciones::mostrarArreglo($sql,true,'control personas');
			return parent::getQuery($sql);
		}  
		
		function obtenerProyecto($id)
		{
			$ProyectosPersonas 	= new ProyectosPersonas();
			$Proyectos 			= new Proyectos();
			$sql = "SELECT p.* 
			FROM ".$Proyectos->sourceTable." as p, ".$this->sourceTable." as per, ".$ProyectosPersonas->sourceTable." as r 
			WHERE per.id_persona = ".$id." AND p.id_proyecto = r.id_proyecto AND r.id_persona = per.id_persona AND p.activo = 1
			ORDER BY   p.seleccionado ASC, p.agno_inicio DESC, p.proyecto LIMIT 3";

			return parent::getQuery($sql);
			
		}
	}



?>