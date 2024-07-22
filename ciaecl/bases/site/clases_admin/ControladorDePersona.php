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
	
	class PersonaRelacionSitio extends Objetos 
	{	
		var $sourceTable = "view_personas_site";
		
		function PersonaRelacionSitio() 
		{
			parent::Objetos();
			$this->dbKey = 'id_persona'; 
		}	 
	}	

	class PersonaSitio extends Objetos 
	{	
		var $sourceTable = "site_personas_site";
		
		function PersonaSitio() 
		{
			parent::Objetos();
			$this->dbKey = 'id_persona';
			$this->dbKey = 'id_site'; 
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
				
		function PersonaObjetos() 
		{
			parent::Objetos();
			$this->dbKey = 'id_persona';
		}		
		
		function buscarUserId($user_id)
		{
			parent::buscarPorValor('user_id',$user_id);
		} 
		
		function obtenerEmail()
		{
			return $this->email;
		}	
	}  

	class PersonaTitulosObjeto extends Objetos 
	{	
		var $sourceTable = 'site_personas_titulos';
				
		function PersonaTitulosObjeto() 
		{
			parent::Objetos();
			$this->dbKey = 'id_titulo';
		}		 	
	}	

	class ControlPersonaTitulosObjetos extends ControlObjetos
	{
		function ControlPersonaTitulosObjetos()
		{
			parent::ControlObjetos();
			$this->obj 		= new PersonaTitulosObjetos();
			$this->order 	= 'fecha DESC, tipo_archivo, texto_archivo'; 
			$this->key 		= $this->obj->dbKey;
			$this->sourceTable = $this->obj->sourceTable;
		} 
	}
	
	class ControlGestionPersonasVista extends ControlVistas
	{
		function ControlGestionPersonasVista()
		{
			parent::ControlVistas(); 			
			$this->key 			= 'id_persona';
			$this->sourceTable  = 'view_personas';
			$this->order		= '	apellido_paterno ASC, nombre ASC, apellido_materno ASC';
			parent::prepararObjecto();		
		} 
		
		function obtenerUserId()
		{
			$this->where = "user_id != '' ";
			return parent::obtenerListado();
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
		
		function buscarRutEmail($rut,$email)
		{
			$where =  ' rut  = "'.$rut.'" OR email = "'.$email.'"'; 
			parent::loadObject($where);
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
	
	class ControlPersonaObjeto extends ControlObjetos
	{
		function ControlPersonaObjeto()
		{
			parent::ControlObjetos();
			$this->obj 		= new PersonaRelacionSitio();
			$ControlHtml 	= new ControlHtml();
			$this->order	= 'apellido_paterno ASC, apellido_materno ASC, nombre ASC';			
			$this->key 		= $this->obj->dbKey;
			$this->sourceTable = $this->obj->sourceTable;
			$this->where_site = " AND id_site=".$ControlHtml->sitioUsuario();
		
		}	
		
		function obtenerListado($excepcion='')
		{
			if(trim($excepcion) != '')
			{
				$this->where = " id_persona > 1 ".$this->where_site;
			}
				else
			{				
				$this->where = " id_persona > 0 AND id_site=1 ";
				
			}

			return parent::obtenerListado();
		}
		
		function obtenerDatosEmail($email)
		{
			$this->where = " email = '".$email."'";	
			return parent::obtenerListado();
		}	
		
		function obtenerDatosId($id_persona)
		{
			$this->where = " id_persona = '".$id_persona."'";	
			return parent::obtenerListado();
		}

		function obtenerDatosIdIE($id_persona)
		{
			$this->where = " id_site = 6 and id_persona = '".$id_persona."'";	
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
		
		function setPersonaUserId($user_id)
		{
			$this->obj->loadObject("user_id='".$user_id."'");
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
		
		function getListaEmailSimple()
		{
			$sql = "SELECT  DISTINCT email, id_persona, nombre, apellido_paterno, IF((rut <> _latin1''),FORMAT( rut , 0 ),'') as rut_html, IF((rut_dv <> _latin1''), CONCAT('-',rut_dv), '') as rut_dv, user_id
			FROM ".$this->sourceTable." 
			WHERE email NOT LIKE ''  AND id_persona > 1 
			ORDER BY apellido_paterno, nombre, email ;";
			return parent::getQuery($sql);	
		}  
		
		function getListaAnexos()
		{
			$where = "anexo = 'si' ";				 
			$order = 'apellido_paterno';		
			return parent::getArrayObjects($this->sourceTable,$where,$order);		
		} 
		
		function getPersonaFicha($id)
		{			
			$where = " id_persona = '".$id."' ";		
			return parent::getArrayObjects($this->sourceTable,$where,$order);
		}
		
		function obtenerListadoPersonasTipo($grupo,$rango,$id='')
		{  
			$TipoPersona = new TipoPersona();
			$PersonaRelacionTipo = new PersonaRelacionTipo();
			$PersonaRelacionSitio = new PersonaRelacionSitio();
			$Universidad = new Universidad(); 
			$where = "AND t.grupo LIKE '".$grupo."'";
			$orden = "";
			$from_extra = '';
			$select_extra = '';			
			if ($rango!=""){
				if ($rango==1) $value=" BETWEEN 'A' AND 'DZ' ";
				if ($rango==2) $value=" BETWEEN 'E' AND 'HZ' ";
				if ($rango==3) $value=" BETWEEN 'I' AND 'LZ' ";
				if ($rango==4) $value=" BETWEEN 'M' AND 'OZ' ";
				if ($rango==5) $value=" BETWEEN 'P' AND 'SZ' ";
				if ($rango==6) $value=" BETWEEN 'T' AND 'ZZ' ";
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
			
			$aux = explode('_',$grupo);  
			if($aux[0] == 'investigadores')
			{
				$orden .= ' orden_universidad,';
			} 
			$sql = "SELECT ps.*,".$select_extra."  u.universidad, u.orden as orden_universidad, t.tipo  as tipo_es,
			 t.descripcion  as descripcion_es, ps.cargo as cargo_es, t.mostrar_universidad, 
			IF('".$this->lang."' = 'en', t.tipo_en, t.tipo) as tipo , 
			IF('".$this->lang."' = 'en', t.descripcion_en, t.descripcion) as descripcion, 
			IF('".$this->lang."' = 'en', p.cargo_en, p.cargo) as cargo
			FROM ".$this->sourceTable." as p, ".$from_extra." ".$Universidad->sourceTable." as u, 
			".$PersonaRelacionSitio->sourceTable." as ps 
			WHERE p.id_universidad = u.id_universidad ".$where.$leyenda." and p.id_persona=ps.id_persona 
			and ps.nombre_site='".VarSystem::getPathVariables('web_site')."'  and ps.id_site=r.id_site 
			GROUP BY ps.id_persona 
			ORDER BY   ".$orden."  orden_site, ps.apellido_paterno, ps.apellido_materno, ps.nombre ";
			//Funciones::mostrarArreglo($sql,true,'control personas');
			//echo $PersonaRelacionSitio->$this->texto;
			//echo $sql;
			return parent::getQuery($sql);
		}  
		
		function obtenerProyecto($id)
		{
			$PersonaRelacionSitio = new PersonaRelacionSitio();
			$ProyectosPersonas 	= new ProyectosPersonas();
			$Proyectos 			= new Proyectos();
			$sql = "SELECT p.* 
			FROM ".$Proyectos->sourceTable." as p, ".$this->sourceTable." as per, ".$ProyectosPersonas->sourceTable." as r 
			WHERE per.id_persona = ".$id." AND p.id_proyecto = r.id_proyecto AND r.id_persona = per.id_persona 
			AND p.activo = 1 
			ORDER BY   p.seleccionado_area ASC, p.agno_inicio DESC, p.proyecto LIMIT 3";
		//	echo $sql;
			return parent::getQuery($sql);
			
		}
	}
?>