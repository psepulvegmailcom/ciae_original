<?php

	class TipoSesion extends PersistentObject
	{
		var $sourceTable = "site_tipo_sesion";
		
		function TipoSesion()
		{
			parent::PersistentObject();
		}
		
		function obtenerCupo($id_tipo_sesion)
		{
			parent::loadObject('id_tipo_sesion= '.$id_tipo_sesion);
		}
	} 

	class AreasSesion extends PersistentObject
	{
		var $sourceTable = "site_areas_sesion";
		
		function AreasSesion()
		{
			parent::PersistentObject();
		} 
		
		function obtenerSesion($id_sesion)
		{
			parent::loadObject('id_sesion='.$id_sesion);
		}
		
		function guardarSesion()
		{
			parent::saveObject('id_sesion='.$this->id_sesion);
		}
	}
	
	class ControladorAreasSesion  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorAreasSesion() 
		{ 
			/* coneccion interna*/	
			$this->obj 				= new AreasSesion();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_sesion';
			parent::ControladorDeObjetos();
		} 
		
		function obtenerSesionesArea($id_area='',$id_sesion='')
		{
			$TipoSesion = new TipoSesion();
			$Areas = new Areas();
			$query = "SELECT ase.*, a.*, ts.*
			FROM ".$this->sourceTable." as ase, ".$Areas->sourceTable." as a, ".$TipoSesion->sourceTable." as ts 
			WHERE ase.id_area = a.id_area AND ase.id_tipo_sesion = ts.id_tipo_sesion ";
			if(trim($id_area)!= '')
			{
				$query .= "AND ase.id_area = ".$id_area;
			}
			if(trim($id_sesion)!= '')
			{
				$query .= "AND ase.id_sesion = ".$id_sesion;
			}			
			$query .= "	ORDER BY ase.id_sesion ";
			 //  Funciones::mostrarArreglo($query);		
			return parent::getQuery($query); 
		}
	}
	
	/* INSCRIPCION */
	class Inscripcion extends PersistentObject
	{	
		var $sourceTable = "site_inscripcion";
		
		function Inscripcion()
		{
			parent::PersistentObject();
		}

		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("email='".$this->email."'");
			}
			else
			{				 
				$this->fecha = time();
				$this->saveObject();
			}
		}	
		
		function consultaEmail($email)
		{
			$this->loadObject("email ='".$email."'");
		}	
	}
	 
	
	class EnvioInscripcion extends Inscripcion
	{
		var $sourceTable = "site_inscripcion_envio";
		
		function EnvioInscripcion()
		{
			parent::Inscripcion();
		} 
		function obtenerEnvio($id_envio)
		{
			$this->loadObject("id_envio ='".$id_envio."'");
		}	
		function guardarEnvio()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("id_envio='".$this->id_envio."'");
			}
			else
			{				  
				$this->saveObject();
			}
		}				
	} 

	class ControladorEnvioInscripcion  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorEnvioInscripcion() 
		{ 
			/* coneccion interna*/	
			$this->obj 				= new EnvioInscripcion();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_envio';
			parent::ControladorDeObjetos();
		}    
		
		function obtenerListado($id_envio=0,$id_area='')
		{	 
			$Inscripcion = new Inscripcion();
			$Areas = new Areas(); 
			
			if($id_envio != 0)
			{
				$where = ' AND e.'.$this->key.' 	 = '.$id_envio;
			}	
			if(trim($id_area) != '')
			{
				$where .= ' AND e.estado = "activo" AND a.id_area = '.$id_area;
			}
			$query = 'SELECT  i. *, i.comentario as comentario_autor, e.*, e.comentario as comentario_interno,  DATE_FORMAT( FROM_UNIXTIME( e.fecha ) , "%d-%m-%Y %H:%i:%s" ) as fecha_envio ,a. *  
					FROM '.$this->sourceTable.' AS e, '.$Inscripcion->sourceTable.' AS i, '.$Areas->sourceTable.' as a   
					WHERE   i.email = e.email AND a.id_area= e.area '.$where.'
					ORDER BY  e.estado ASC, e.titulo ASC, i.apellidos asc, i.nombre ASC,e.estado ASC,e.fecha ASC';
			// Funciones::mostrarArreglo($query);		
			return parent::getQuery($query); 
		}
	} 	

	/** CONTROLADOR DE INSCRIPCION */
	class ControladorInscripcion  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorInscripcion() 
		{ 
			/* coneccion interna*/	
			$this->obj 				= new Inscripcion();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}    

		function obtenerListadoActivo($email='')
		{
			$order = ' fecha ASC, apellidos, nombre'; 
			$where = " activo = 1  ";  	 
			if(trim($email) != '')
			{
				$where .= "AND email = '".$email."'";
			} 
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}		
	} 
	
	/** AREAS Y DISCIPLINAS DEFINICIONES */
	
	class Areas extends PersistentObject
	{	
		var $sourceTable = "site_areas";
		
		function Areas()
		{
			parent::PersistentObject();
		} 
	}

	class ControladorAreas  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorAreas() 
		{ 
			/** CONECCION INTERNA */	
			$this->obj 						= new Areas();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function obtenerListado($id_area='')
		{
			$order = '  orden ASC'; 
			$where = "area_".VarSystem::obtenerIdiomaActual()." LIKE '%'    ";  	 
			if(trim($id_area) != '')
			{
				$where = " AND id_area = ".$id_area;
			}
			
			global $ControlHtml;  	     
			$select = "area_".VarSystem::obtenerIdiomaActual()." as area ";
			return(parent::getArrayObjects($this->sourceTable,$where,$order,$select));
		}    
	}	
	
	class Disciplinas extends PersistentObject
	{	
		var $sourceTable = "site_disciplina";
		
		function Disciplinas()
		{
			parent::PersistentObject();
		} 
	}

	class ControladorDisciplinas  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorDisciplinas() 
		{ 
			/* coneccion interna*/	
			$this->obj 						= new Disciplinas();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function obtenerListado()
		{
			$order = '  orden ASC'; 
			$where = "  ";  	 
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}    
	}	
	
	/* AREAS Y DISCIPLINAS DE LA INSCRIPCION */
	
	class AreasInscripcion extends PersistentObject
	{	
		var $sourceTable = "site_inscripcion_areas";
		
		function AreasInscripcion()
		{
			parent::PersistentObject();
		}
		
		function eliminarElementos($email)
		{
			$this->destroyObject("email= '".$email."'");
		}
		
		function guardarElemento($email,$id_areas)
		{
			$this->email = $email;
			$this->id_areas = $id_areas;
			$this->saveObject();
		}
	}

	class ControladorAreasInscripcion  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorAreasInscripcion() 
		{ 
			/* coneccion interna*/	
			$this->obj 						= new AreasInscripcion();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function obtenerListado($email)
		{
			$order = '  '; 
			$where = " email = '".$email."'  ";  	 
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}    
		
		function obtenerListadoCompleto($email)
		{
			$Areas = new Areas();
			$query = "SELECT i.*, a.*
			FROM ".$this->sourceTable." as i, ".$Areas->sourceTable." as a
			WHERE i.id_areas = a.id_area AND  i.email = '".$email."'
			ORDER BY a.orden";
			//   Funciones::mostrarArreglo($query);		
			return parent::getQuery($query); 
		}  
	}	
	
	class DisciplinasInscripcion extends PersistentObject
	{	
		var $sourceTable = "site_inscripcion_disciplina";
		
		function DisciplinasInscripcion()
		{
			parent::PersistentObject();
		}
		
		function eliminarElementos($email)
		{
			$this->destroyObject("email= '".$email."'");
		}
		
		function guardarElemento($email,$id_disciplina)
		{
			$this->email = $email;
			$this->id_disciplina = $id_disciplina;
			$this->saveObject();
		}
	}

	class ControladorDisciplinasInscripcion  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorDisciplinasInscripcion() 
		{ 
			/* coneccion interna*/	
			$this->obj 						= new DisciplinasInscripcion();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function obtenerListado($email)
		{
			$order = ' '; 
			$where = " email = '".$email."'  ";  	 
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}     

		function obtenerListadoCompleto($email)
		{
			$Disciplinas = new Disciplinas();
			$query = "SELECT i.*, a.*
			FROM ".$this->sourceTable." as i, ".$Disciplinas->sourceTable." as a
			WHERE i.id_disciplina = a.id_disciplina AND  i.email = '".$email."'
			ORDER BY a.orden";
			//   Funciones::mostrarArreglo($query);		
			return parent::getQuery($query); 
		}  		
	}
	 
	 
	class AreasUsuario extends PersistentObject
	{	
		var $sourceTable = "site_usuario_area";
		
		function AreasUsuario()
		{
			parent::PersistentObject();
		}
	}	 

	class ControladorAreasUsuario  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorAreasUsuario() 
		{ 
			/* coneccion interna*/	
			$this->obj 						= new AreasUsuario();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function obtenerListado($username)
		{
			$order = ' '; 
			$where = " username = '".$username."'  ";  	 
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}    
	} 
	
	class RevisionEnvio extends PersistentObject
	{	
		var $sourceTable = "site_inscripcion_envio_revision";
		
		function RevisionEnvio()
		{
			parent::PersistentObject();
		} 
	}	  
	
	class ControladorRevisionEnvio  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorRevisionEnvio() 
		{ 
			/* CONECCION INTERNA */	
			$this->obj 				= new RevisionEnvio();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function obtenerListado($id_envio)
		{
			$order = 'tipo_revision ASC, fecha '; 
			$where = " id_envio = '".$id_envio."'  ";  	 
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}   
		
		function obtenerListados($id_area='')
		{
			$EnvioInscripcion = new EnvioInscripcion();
			$Inscripcion = new Inscripcion();
			$Areas = new Areas();
			$query = "SELECT i.*, e.*, c.*, DATE_FORMAT( FROM_UNIXTIME( c.fecha ) , '%d-%m-%Y %H:%i:%s' ) as fecha_html, a.area as area_nombre
			FROM ".$EnvioInscripcion->sourceTable." as e,
			 ".$this->sourceTable." as c, 
			 ".$Inscripcion->sourceTable." as i,
			 ".$Areas->sourceTable." as a
			WHERE i.email = e.email AND e.id_envio = c.id_envio AND e.area = a.id_area ";
			if(trim($id_area) != '')
			{
				$query .= " AND e.area =".$id_area." ";
			}
			$query .= " ORDER BY c.id_envio, c.tipo_revision DESC,c.fecha"; 
		 	//Funciones::mostrarArreglo($query);		
			return parent::getQuery($query); 
		}  
		 
	}  
?>