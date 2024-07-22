<?php
	class MenuPermiso extends PersistentObject 
	{		
		var $sourceTable = "auth_menu_access";
		
		function MenuPermiso() 
		{
			parent::PersistentObject();
		}		
	}

	class ControlMenuPermiso extends ControladorDeObjetos
	{
		var $obj; 	 
		 
		function ControlMenuPermiso() 
		{			
			parent::ControladorDeObjetos();
			$this->obj 			= new MenuPermiso();   
			$this->sourceTable 	= $this->obj->sourceTable;
		}
		
		function obtenerListado($id_menu)
		{
			$where = "id = ".$id_menu;
			return parent::getArrayObjects($this->sourceTable,$where); 
		}
		
		function obtenerListadoEspecial($id_menu)
		{ 	 
			$where = "id = ".$id_menu;
			$listado = parent::getArrayObjects($this->sourceTable,$where);
			//Funciones::mostrarArreglo($listado,true);
			$permisos = array();
			for($i=0; $i < count($listado);$i++)
			{
				$permisos[$listado[$i]['permiso']] = 'ok';
			}
			//Funciones::mostrarArreglo($permisos,true);
			return $permisos;
		}
	}

	class MenuIdioma extends PersistentObject 
	{		
		var $sourceTable = "auth_menu_lang";
		
		function MenuIdioma() 
		{
			parent::PersistentObject();
		}		

		function obtenerMenu($id_menu,$idioma)
		{
			parent::loadObject("id_menu = '".$id_menu."' AND idioma = '".$idioma."'");
		}
	}
	
	class MenuAcceso extends PersistentObject 
	{	
		var $sourceTable = "auth_menu_access";
		
		function MenuAcceso() 
		{
			parent::PersistentObject();
		} 
	}
	
	class Menu extends PersistentObject 
	{		
		var $sourceTable = "auth_menu";
		
		function Menu() 
		{
			parent::PersistentObject();
		}
		
		function setLastID()
		{
			$this->Id =  parent::getLastId('id_menu');
		}
		
		function setOpcion($opcion)
		{		
			parent::loadObject("opcion='".$opcion."'");
		}
		
		function setOpcionSitio($opcion,$sitio)
		{		
			if(trim($opcion) == '')
				$opcion = 'home';
				//echo "opcion='".$opcion."' AND sitio='".$sitio."'";
			//	echo "opcion='".$opcion."' AND sitio='".$sitio."'";
			parent::loadObject("opcion='".$opcion."' AND sitio='".$sitio."'");
		}
		
		function setParent($id_parent)
		{			
			parent::loadObject("id=".$id_parent);
		} 	 

		function destroyContenidosMenu($Id)
		{
			$MenuIdioma = new MenuIdioma();			
			$MenuIdioma->destroyObject('id_menu='.$Id);
		}

		function getHome() 	
		{
			parent::loadObject('home=1');
		}
		
		function getOpcion($opcion)  
		{
			parent::loadObject("opcion='".$opcion."'");
		}	 	
	}
	
	class ControladorDeMenu extends ControladorDeObjetos
	{ 
		var $menueditables;
		var $orderField 	= "orden";
		var $isLogin		= false; 
		var $idioma 		= '';
		var $tipo_vista 	= 'principal'; 
		
		function ControladorDeMenu() 
		{
			/* Contexto Global */			 
			$this->obj				= new Menu();
			$this->obj_lang			= new MenuIdioma();
			$this->vista 			= " (m.acceso = 'publico')";
		 
			$this->idioma 			= "   "; 
			$this->sourceTable 		= $this->obj->sourceTable;	
			$this->sourceTable_lang = $this->obj_lang->sourceTable;	
			$this->sitio 			= " sitio LIKE '%' AND ";
			$this->idioma			= " AND (idioma = 'nn' OR idioma = '".VarSystem::obtenerIdiomaActual()."')";
			$this->permiso 			= " AND p.permiso = '0' ".$this->idioma;
			parent::ControladorDeObjetos();
		}
		
		function setPermiso($permiso) 
		{		
			if(trim($permiso) != '')
			{ 
				$this->permiso = " AND (p.permiso = '0' OR  p.permiso = '".$permiso."' ) "; 
			} 		
		}		
 				
		function setIdioma($langSite) 
		{		
			$this->idioma = " AND (l.idioma = '".$langSite."' OR l.idioma = 'nn') "; 			
		}	 				

		function setTipoVista($tipoVista) 
		{		
			$this->tipo_vista = $tipoVista; 			
		}	 

		function setVista($isLogin) 
		{		
			$this->isLogin = $isLogin;
			if($isLogin)
			{
				$this->vista = " ( m.acceso = 'privado' OR m.acceso = 'publico' )";
			}
		}	
		
		function setSitio($sitio)
		{ 
			$this->sitio = " sitio = '".$sitio."' AND ";
		}	
		
		function getIdiomas()
		{
			$sql = "  SELECT DISTINCT idioma
					FROM ".$this->sourceTable_lang." WHERE idioma != 'nn' "; 
			$result = parent::getQuery($sql); 
			return $result;
		} 
		
		function getMenuOpcion($opcion)
		{
			$sql = "  SELECT *
					FROM ".$this->sourceTable." WHERE opcion = '".$opcion."' "; 
			$result = parent::getQuery($sql); 
			return $result;
		} 

		function getMenus($id_padre=0,$id_menu=0) 	
		{		  
			$MenuAcceso = new MenuAcceso();
			$sql = "SELECT m. *  
					FROM   ".$this->sourceTable." AS m, ".$MenuAcceso->sourceTable." as p
					WHERE  ".$this->sitio." ".$this->vista." AND  m.tipo = '".$this->tipo_vista."'  AND m.menu_padre = ".$id_padre." AND m.id = p.id  ".$this->permiso."  ";
			
			if(trim($id_menu) > 0)
			{
				$sql .= " AND m.id = ".$id_menu; 
			}	
			elseif(trim($id_menu) == 0)
			{
				$sql .= " AND m.publicar=1 ";
			}
			$sql .= " ORDER BY m.acceso ASC, m.orden  "; 
		    
		     //Funciones::mostrarArreglo($sql);
			$result = parent::getQuery($sql); 
			//Funciones::mostrarArreglo($result);
			return $result;
		}	 
 
		function getAllMenus( ) 	
		{		
			$sql = "SELECT m. * , l. *
					FROM ".$this->sourceTable_lang ." AS l, ".$this->sourceTable." AS m
					WHERE m.id = l.id_menu   ".$this->idioma."    ";			 
			$sql .= " ORDER BY m.acceso ASC, m.tipo,m.menu_padre,m.orden, l.nombre "; 
			$sql = "SELECT m. *  
					FROM  ".$this->sourceTable." AS m
					WHERE   1  ".$this->idioma."    ";			 
			$sql .= " ORDER BY m.acceso ASC, m.tipo,m.menu_padre,m.orden  "; 
			// echo $sql."<br>";
			$result = parent::getQuery($sql); 
			return $result;
		}
		
		function obtenerCaminoMenu($id_padre)
		{
			if($id_padre =='0')
			{
				$where = " opcion = 'home' ";		 
			} 
			else
			{
				$where = " id = '".$id_padre."' ";
			}
			return parent::getArrayObjects($this->sourceTable,$where) ;	
					
		}	 
	}
?>