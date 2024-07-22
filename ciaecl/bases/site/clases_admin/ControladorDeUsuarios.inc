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
		
		function buscarUsuarioPermisoParticular($permiso)
		{
			$Permiso = new Permiso();
			$Permiso->loadObject(' alias = "'.$permiso.'"');
			parent::loadObject("activo = 1 AND (perms LIKE '%".$Permiso->id_permiso."%' OR permisos_extras LIKE '%".$Permiso->id_permiso."%')");
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
			unset ($this->permiso);					
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
			//Funciones::mostrarArreglo($this,true);
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
			$permisos = explode(',',$permisos);
			return $permisos;
		}		
		
		function getPermisosExtras()
		{		 
			$permisos = $this->permisos_extras;
			$permisos = explode(',',$permisos);
			return $permisos;
		}	
		
		/** SET FUNCIONES PARA MANTENER ANTIGUEDAD */
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
			{
				$this->existeUsuario = false;
			}
			
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
		
		function getListadoCompleto($username='')
		{			  
			$Usuarios 	= new Usuarios();
			$Persona  	= new PersonaObjetos();
			$Permiso	= new Permiso();  
			
			$buscar_sql	= "";
			if(trim($username) != '')
			{
				$buscar_sql	= " AND ( u.username LIKE '%".$username."%') ";
			}

			$sql		= " SELECT u.activo,u.user_id , u.username, p.nombre, p.apellido_paterno , p.apellido_materno, p.email ,  e.*  ";			
			$sql 		.= "FROM ".$Usuarios->sourceTable." as u, ".$Persona->sourceTable." as p ,  ".$Permiso->sourceTable." as e   ";			
			$sql 		.= "WHERE     p.user_id = u.user_id AND u.perms = e.id_permiso  ".$buscar_sql." ";
			$sql 		.= "ORDER BY activo DESC,  p.apellido_paterno, u.username   ";
		 
			//echo $sql;
			$control = new ControladorDeObjetos();
			return $control->getQuery($sql);
		}
		
		function getArrayUsuariosActivosByPermiso($permiso)
		{ 
			$control = new ControladorDeObjetos();
			$where = 'perms = '.$permiso." AND activo = 1";
			$usuarios = $control->getArrayObjects('auth_user_md5',$where,$order='username');
			return $usuarios; 
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
			{
				$this->existeUsuario = false;
			}	 
			return $this->existeUsuario;
		}
		
		private function setPermisos()
		{
			$permisosAux		= $this->Usuario->getPermisos();
			$permisosAuxExtras	= $this->Usuario->getPermisosExtras();
			$losPermisos 		= $this->controlPermisos->getArrayObjects();					
			$losPermisosUser 	= array(); 			
			
			for($i=0; $i < count($losPermisos) ; $i++)
			{
				$losPermisosUser[$losPermisos[$i]['id_permiso']] = (int)false;
				$losPermisosUser[$losPermisos[$i]['alias']] = (int)false;		
			} 
			
			//Funciones::mostrarArreglo(array($this->Usuario,$permisosAuxExtras,$permisosAux,$losPermisos,$losPermisosUser),false,'permisos_array');
			$permisos_usuarios = array_merge($permisosAux,$permisosAuxExtras);	
			for($i=0; $i < count($permisos_usuarios) ; $i++)
			{									
				$aux = $permisos_usuarios[$i];				
				$losPermisosUser[$aux] 	= (int)true;
				$auxP = $this->controlPermisos->getArrayObjects('',"id_permiso='$aux'");
				 	
				$losPermisosUser[$auxP[0]['alias']] 		= (int)true;
				if($i == 0)
				{
					$this->Usuario->permiso = 	$auxP[0]['alias'];
				}
			}				
					
			$this->Usuario->setVariable('permisosUsuario',$losPermisosUser);	
			
			//Funciones::mostrarArreglo(array($this->Usuario,$permisosAuxExtras,$permisosAux,$losPermisos,$losPermisosUser),false,'permisos_array'); 	
			
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
	

	
	class UsuarioSite extends Objetos 
	{		
		var $sourceTable = "auth_user_md5_site";
		
		function UsuarioSite() 
		{
			parent::Objetos();
		}	 
	}
	
	class ControlUsuarioSite extends ControlObjetos
	{
		var $obj; 	  
		
		function ControlUsuarioSite() 
		{			
			parent::ControlObjetos();
			$this->obj = new UsuarioSite(); 	
			$this->sourceTable = $this->obj->sourceTable;  
		} 
		
		function obtenerSitiosUsuario($user_id,$permiso)
		{					
			$ControlSite = new ControlSite();
			if($permiso == 'superadministrador')
			{
				$sitios = $ControlSite->obtenerListado();				
			}
			else
			{
				$ControlUsuarioSitio = new ControlUsuarioSitio();
				$sitios = $ControlUsuarioSitio->obtenerSitiosUsuario($user_id);
				
				if(!is_array($sitios))
				{
					$sitios = $ControlSite->NombreSiteId(1);
				}
			}		
			return $sitios;
		}
	}
	
	class ControlVistaAuthPersona extends ControlVistas
	{
		function ControlVistaAuthPersona()
		{
			parent::ControlVistas(); 			
			$this->key 			= 'id_persona';
			$this->sourceTable  = 'view_auth_persona';
			$this->order		= 'apellido_paterno'; 
			parent::prepararObjecto();
		}  
		
		function buscarUsuarioPermisoParticular($permiso)
		{
			$Permiso = new Permiso();
			$Permiso->loadObject(' alias = "'.$permiso.'"');
			$this->where = "activo = 1 AND (perms LIKE '%".$Permiso->id_permiso."%' OR permisos_extras LIKE '%".$Permiso->id_permiso."%')";
			return parent::obtenerListado();
			
		}
		
	}
	 		
?>