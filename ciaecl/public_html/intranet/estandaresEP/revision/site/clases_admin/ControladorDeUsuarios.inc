<?php
	
	class Usuario extends PersistentObject
	{
		private $perms_md5;
		var $sourceTable = 'auth_user_md5';			
			
		function Usuario() 
		{
			parent::PersistentObject();
		}
			
		function getNombreCompleto()
		{
			$PersonaControl = new PersonaControl();
			$PersonaControl->setPersonaByUser($this);
			return $PersonaControl->getNombreCompleto();
		}
			
		function borrarUsuario($id_item)
		{			 
			parent::loadObject("user_id = '".$id_item."'");
			$this->activo = 0; 
			parent::saveObject("user_id = '".$id_item."'");
		}
		
		function getEmail()
		{
			$PersonaControl = new PersonaControl();
			$PersonaControl->setPersonaByUser($this);
			return $PersonaControl->getEmail();
		}		
					
		function existeUsuarioByUsername($username)
		{		
			$this->getUsuarioByUsername($username);
			if(trim($this->user_id) != '')
				return true;
			else
				return false;
		}
		
		function getUsuarioByUsername($username)
		{
			$this->username = $username;
			parent::loadObject("username = '".$this->username."'");		
		} 

		function getUsuarioByUserid($user_id)
		{
			$this->user_id = $user_id;
			parent::loadObject("user_id = '".$this->user_id."'");		
		} 
				
		function getUsuarioByPersona($Persona)
		{ 
			$this->user_id = $Persona->user_id;
			parent::loadObject("user_id= '".$Persona->user_id."'");		
		} 
		
		function existeUsuarioByEmail($email)
		{		
			$PersonaControl = new PersonaControl();
			$PersonaControl->setPersonaByEmail($email);
			  
			if(trim($PersonaControl->obj->user_id) != '')
				return true;
			else
				return false;
		}	
		
		function updatePassword($password)
		{		
			$this->password  	 = md5($password);  
			$this->newObject 	 = false;
			$this->saveObject("user_id ='".$this->user_id."'");
		}
		 
		function saveUsuario()
		{		 
			$this->saveObject("user_id ='".$this->user_id."'");
		}		 
		
		function getPersonaByEmail($email)
		{		
			$PersonaControl = new PersonaControl();
			$PersonaControl->setPersonaByEmail($email);
			  
			if(trim($PersonaControl->obj->user_id) != '')
				return $PersonaControl;
			else
				return false;
		}			
		
		function getUsuarioByLogin($username,$password)
		{
			$this->username = $username;
			$this->password = $password;
			parent::loadObject("username = '".$this->username."' AND password = '".$this->password ."'");					
		}
			
		function addNewUsuario($data)
		{						
			$ControladorPermisos = new ControladorPermisos();
			$this->perms  	 	 = $ControladorPermisos->getPermisoByAlias($data['permiso']);
			
			$this->password  	 = md5(trim($data['password']));
			$this->user_id   	 = md5(trim($data['username']).time().time()); 
			$this->username   	 = trim($data['username']);			
			$this->newObject 	 = true;
			$this->saveObject();
			
			$this->getUsuarioByUsername($data['username']);
			if(trim($this->user_id) != '')
				return true;
			else
				return false;
		}			
		
		function cambiarPermiso($permiso)
		{			
			$this->perms = $permiso;
			return $this->saveObject("id_egresados=".$this->id_egresados);
		}			
			
		function getPermisos()
		{		
			$permisos = $this->perms;
			$permisos = split(',',$permisos);
			return $permisos;
		}		
		
		/*set funcitones para mantener antiguedad*/
		function setVariable($variable,$value)
		{
			$this->$variable = $value;
		}
		
		function addVariable($variable,$value,$key='')
		{
			if(trim($key) == '')
				array_push($this->$variable,$value);
			else
				$this->$variable[$key] = $value;		
		}
		
		function delVariable($variable,$key)
		{
			if(is_array($this->$variable))
				unset($this->$variable[$key]);
		}
	
		function getValue($variable,$key='')
		{
			if(is_array($this->$variable))
				return $this->$variable[$key];
			else
				return $this->$variable;
		}		
	} 	
	
	class ControladorDeUsuarios 
	{
		var $username;
		private $Usuario;
		private $ControlLdap;
		private $existeUsuario;
		private $objetoLdap ;
		private $controlPermisos;
		
		function ControladorDeUsuarios()
		{		
			$this->existeUsuario 	= false;
			$this->objetoLdap		= false;	
			$this->Usuario			= new Usuario();			
			$this->controlPermisos	= new ControladorPermisos();
		}	
		
		function getUsuario()
		{			
			if($this->existeUsuario)
				return $this->Usuario;
			else	
				return $this->existeUsuario;
		}
				
		function setUsuarioByUsername($username)
		{
			$this->Usuario->getUsuarioByUsername($username);
			if(isset($this->Usuario->user_id) && trim($this->Usuario->user_id) != '')
			{					
				$this->setPermisos();		
				$this->existeUsuario = true;	
			}
			else
				$this->existeUsuario = false;
			
			return $this->existeUsuario;
		}
		
		function isUsuarioActivo()
		{
			return (bool)$this->Usuario->activo;
		}
		
		function getUsername()
		{
			return $this->Usuario->username; 
		} 

		function getArrayUsuarios($filtro='')
		{		
			$control = new ControladorDeObjetos();			 
			$usuarios = $control->getArrayObjects('auth_user_md5',$where,$order='username');
			return $usuarios; 
		}	

		function getListadoUsuariosPersonas($filtro=array())
		{
			$Usuarios 	= new Usuarios();
			$Persona  	= new Persona(); 

			$con_estado 	= false;
			$filtro_permiso = array();
			$filtro_estado  = array();
			for($i=0; $i < count($filtro);$i++)
			{
				if(is_numeric($filtro[$i]))
					$filtro_permiso[] = $filtro[$i];
				else
				{
					$filtro_estado[] = $filtro[$i];
					$con_estado = true;
				}
			}
			$filtro_sql = implode(" OR u.perms =",$filtro_permiso);  

			if(trim($filtro_sql) != '')
			{
				$filtro_sql = " AND (  u.perms =".$filtro_sql.") ";
			}
			$select		= " SELECT  u.user_id , u.username, p.nombre, p.apellido_paterno ,u.activo, p.apellido_materno, p.email ,u.perms  ";
			$sql 		= $select;
			$from 		= "FROM ".$Usuarios->sourceTable." as u, ".$Persona->sourceTable." as p  "; 
			$sql 		.= $from;
			$where 		= "WHERE     p.user_id = u.user_id  "; 
			$sql 		.= $where.' '.$filtro_sql." ";
			$order 		= "ORDER BY perms ASC";

			if($con_estado) /* DEBE INCLUIR LOS TIPOS DE USUARIOS */
			{
				$filtro_sql = implode("' OR o.id_estado ='",$filtro_estado);  
				if(trim($filtro_sql) != '')
				{
					$filtro_sql = " AND (   o.id_estado ='".$filtro_sql."') ";
				}
				$Oferente  	= new Oferente();
				$sql = "(".$sql.") UNION (".$select;
				$from = $from.",  ".$Oferente->sourceTable." as o  ";
				$sql 		.= $from;
				$where 		= $where." AND o.id_persona = p.id_persona  "; 
				$sql 		.= $where.' '.$filtro_sql." ) ";
			}
			$sql 		.= $order;
			$control 	= new ControladorDeObjetos();
			   // echo $sql;
			$usuarios 	= $control->getQuery($sql);
			return $usuarios;
		}		
				
		function getListadoNoOferentesCompleto($orden,$buscar='' )
		{			 
			$ControlLogs = new ControlLogs();
			$Usuarios 	= new Usuarios();
			$Persona  	= new Persona();
			$Permiso	= new Permiso(); 

			
			$buscar_sql	= "";
			if(trim($buscar) != '')
			{
				$buscar_sql	= " AND ( u.username LIKE '%".$buscar."%' OR p.nombre  LIKE '%".$buscar."%' OR 	p.apellido_paterno  LIKE '%".$buscar."%' OR 	p.apellido_materno  LIKE '%".$buscar."%' OR  p.email LIKE '%".$buscar."%' ) ";
			}

			$sql		= " SELECT u.activo,u.user_id , u.username, p.nombre, p.apellido_paterno , p.apellido_materno, p.email ,  e.*  ";			
			$sql 		.= "FROM ".$Usuarios->sourceTable." as u, ".$Persona->sourceTable." as p ,  ".$Permiso->sourceTable." as e   ";			
			$sql 		.= "WHERE   u.perms != 3 AND p.user_id = u.user_id AND u.perms = e.id_permiso  ".$buscar_sql." ";
			$sql 		.= "ORDER BY activo DESC, ";
			$sql 		.= implode(",",$orden);
			$sql 		.= " , p.apellido_paterno, u.username   ";
		 
			//echo $sql;
			$control = new ControladorDeObjetos();
			return $control->getQuery($sql);
		}		
		 	
		
		function getListadoOferentesCompleto($orden ,$buscar='')
		{
			$Usuarios 	= new Usuarios();
			$Persona  	= new Persona();
			$Oferente 	= new Oferente();
			$TipoOferente = new TipoOferente();
			$EstadoOferente = new EstadoOferente();


			$buscar_sql	= "";
			if(trim($buscar) != '')
			{
				$buscar_sql	= " AND ( u.username LIKE '%".$buscar."%' OR p.nombre  LIKE '%".$buscar."%' OR 	p.apellido_paterno  LIKE '%".$buscar."%' OR 	p.apellido_materno  LIKE '%".$buscar."%' OR  p.email LIKE '%".$buscar."%' ) ";
			}
			$sql		= " SELECT u.activo,u.user_id , u.username, p.nombre, p.apellido_paterno , p.apellido_materno, p.email , o.*,t.*,e.*  ";
			
			$sql 		.= "FROM ".$Usuarios->sourceTable." as u, ".$Persona->sourceTable." as p , ".$Oferente->sourceTable." as o , ".$TipoOferente->sourceTable." as t ,".$EstadoOferente->sourceTable." as e ";
			
			$sql 		.= "WHERE   u.perms= 3 AND p.user_id = u.user_id AND p.id_persona = o.id_persona AND o.id_tipo = t.id_tipo  AND o.id_estado = e.id_estado  ".$buscar_sql." ";
			$sql 		.= "ORDER BY  ";
			$sql 		.= implode(",",$orden);
			$sql 		.= " , p.apellido_paterno, u.username   ";
			
			//echo $sql;
			 $control = new ControladorDeObjetos();
			return $control->getQuery($sql);
		}
		
		function setUsuarioByLogin($username,$password)
		{		
			$this->Usuario->getUsuarioByLogin($username,$password);
			if(isset($this->Usuario->user_id) && trim($this->Usuario->user_id) != '')
			{					
				$this->setPermisos();		
				$this->existeUsuario = true;	
			}
			else
				$this->existeUsuario = false;
			
			return $this->existeUsuario;
		}
		
		private function setPermisos()
		{
			$permisosAux		= $this->Usuario->getPermisos();
			$losPermisos 		= $this->controlPermisos->getArrayObjects();					
			$losPermisosUser 	= array();
			
			for($i=0; $i < count($losPermisos) ; $i++)
			{
				$losPermisosUser[$losPermisos[$i]['id_permiso']] = (int)false;
				$losPermisosUser[$losPermisos[$i]['alias']] = (int)false;		
			}
						
			
			for($i=0; $i < count($permisosAux) ; $i++)
			{									
				$aux = $permisosAux[$i];				
				$losPermisosUser[$aux] 	= (int)true;
				$auxP = $this->controlPermisos->getArrayObjects('',"id_permiso='$aux'");	
				$losPermisosUser[$auxP[0]['alias']] 		= (int)true;	
			}		
			$this->Usuario->setVariable('permisosUsuario',$losPermisosUser);	
			
			//falta setear menuaccesso  									
		}	 
		
		function ExisteUsuario()
		{
			return (bool)$this->existeUsuario;	
		}
		
		function getArrayPermisos($alias='')
		{
			return $this->controlPermisos->getArrayPermisos($alias);
		}
	}	
?>