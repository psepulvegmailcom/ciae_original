<?php
	class MenuPermiso extends PersistentObject {
		
		var $sourceTable = "menu_permiso";
		
		function MenuPermiso() {
			parent::PersistentObject();
		}
		
	}
	
	class Menu extends PersistentObject {
		
		var $sourceTable = "menu";
		
		function Menu() {
			parent::PersistentObject();
		}
		
		function setLastID()
		{
			$this->Id =  parent::getLastId('id_menu');
		}
		
		function setOpcion($opcion){
		
			parent::loadObject("opcion='".$opcion."'");
		}
		
		function setParent($id_parent){
			
			parent::loadObject("id=".$id_parent);
		}
		
		function destroyPermisosMenu()
		{			
			$permisoMenu = new MenuPermiso();
			$permisoMenu->destroyObject("id_menu= ".$this->Id."");			
		}

		function getHome() 	{
			parent::loadObject('home=1');
		}
		
		function getOpcion($opcion)  {
			parent::loadObject("opcion='".$opcion."'");
		}	
		
		function insertPermisoMenu($permiso)
		{
			$permisoMenu = new MenuPermiso();
			$permisoMenu->id_permiso = $permiso;
			$permisoMenu->id_menu    = $this->Id;
			$permisoMenu->newObject	 = true;
			$permisoMenu->saveObject();
		}		
	}
	
	class ControladorDeMenu extends ControladorDeObjetos
	{
		var $permiso;
		var $menuextras 	= '';
		var $menueditables;
		var $sourceTable 	= 'menu';		
		var $orderField 	= "orden";
		var $isLogin		= false;
		var $vista 			= "vista != 'interno'";	
		
		function ControladorDeMenu() {
			/* Contexto Global */
			
			parent::ControladorDeObjetos();
						
		
			$this->dbHost		= VarConfig::bdhost;
			$this->dbName		= VarConfig::dbname;
			$this->dbUser		= VarConfig::bduser;
			$this->dbPass		= VarConfig::bdpass;		
		}

		function setPermiso($permiso)
		{
			if(count($permiso) == 0)
			{
				$permiso = array();		
			}
			$this->permiso = array_merge(array(0=>1),$permiso); 
			

		}
				
		function setVista($isLogin) {
		
			$this->isLogin = $isLogin;
			if($isLogin) {
				$this->vista = "vista != 'only_externo'";
			}
		}
		
		function setMenuExtra($menus){

			$this->menuextras = '';
			if(count($menus) > 0)
			{			
				foreach($menus as $menu => $status)
				{
					if(trim($this->menuextras) != '')
					{
						$this->menuextras .= " OR ";
					}
					$this->menuextras .=  " opcion = '".trim($menu)."' ";
				}
			}
		}
		
		function setMenuEditable($menus) {
			if(count($menus) == 0)
				$menus = array();	
			$this->menueditables = $menus;		
		}
		
		function getPermisoEdicion()
		{
			return $this->menueditables;
		}
		
		function getMenus($id_menu=0) 	
		{		
			if(!is_numeric($id_menu) ||  $id_menu < 0 || trim($id_menu) == '')
				return array();
				
				
			$where = "menu_padre=".$id_menu." AND ".$this->vista." AND publicar=1 ";
			$menusRaices = parent::getIDList($where,$this->sourceTable,'id','orden'); 

			
			if(!$this->permiso['administrador'])
			{
				$menusRaices = $this->getRolMenu($menusRaices);
			}

			/* busca los menus extra despues de chequeo de permisos*/
			if(trim($this->menuextras) != '')
			{				
				$where = "menu_padre=".$id_menu." AND ".$this->vista." AND publicar=1 AND (".$this->menuextras.")";
				$menusRaicesExtra = parent::getIDList($where,$this->sourceTable,'id','orden');
						
				if(!is_array($menusRaices))
					$menusRaices = array();			
				if(is_array($menusRaicesExtra) && count($menusRaicesExtra) > 0)
				{		
					for($i=0; $i < count($menusRaicesExtra) ; $i++)
					{
						$menusRaices[] = $menusRaicesExtra[$i];
					}					
				}
			}						
			return $this->setMenuList($menusRaices);
		}	
		
		private function getRolMenu($menusRaices)
		{
			$whereIni = ''; 

			if(!is_array($menusRaices))
			{				
				return array();
			}
							
			foreach($menusRaices as $i => $menus)
			{	
				if($i > 0) 
					$whereIni .= ' OR ';
				$whereIni .= "(id_menu=".$menus['id']." AND id_permiso ='*') ";			
			}
			$menuPermiso = new MenuPermiso();
			
			$menu = array();
			$where = ''; 
			foreach($this->permiso as $rol => $estado)
			{
				if(!is_numeric($rol))
				{
					continue;
				}
				if((bool)$estado)
				{
					if(trim($where) != '')
					{
						$where .= ' OR ';
					}
					$where .=  str_replace("*",$rol,$whereIni);
				}				
			}		
			return parent::getIDList($where,$menuPermiso->sourceTable,'DISTINCT id_menu as id','id','');	
							
		}		

		private function setMenuList($menusRaices)
		{
			$where = ''; 
			if(!is_array($menusRaices) || count($menusRaices) == 0)
			{
				return array();
			}
				
			foreach($menusRaices as $i => $menus)
			{	
				if($i > 0) $where .= ' OR ';
				$where .= "id=".$menus['id'];			
			}
			return parent::getObjects('Menu',$where,$order='orden');			
		}
		
		function getMenu($conArreglo = false) 
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);

			if (trim($dbHandle->errorMessaje)!="") 
				return(false);			 
			else 
			{
				$query="SELECT DISTINCT m.* 
						FROM menu as m, menu_permiso as p
						WHERE ( m.publicar=1 AND m.menu_padre=0 AND m.id=p.id_menu AND  p.id_permiso='0' ) OR";	

				if(count($this->permiso) > 0)//logeado
				{
					foreach($this->permiso as $key => $estado)
					{
						if(is_numeric($key) && $this->permiso[$key])
						{
							$query.=" ( m.publicar=1 AND m.menu_padre=0  AND m.id=p.id_menu AND p.id_permiso='$key'  ) OR";
						}
					}	
					if($this->permiso['administrador'] == 1)
					{
						$query.=" ( m.publicar=1 AND m.menu_padre=0  AND m.id=p.id_menu AND p.id_permiso !='0'  ) OR";
					}
				}				
				$query.="DER BY orden ASC, menu ASC";
				
				$rs = $dbHandle->query($query);

				$losObjetos = array();
				if ($rs->numTuples != 0)
				{
					$im=-1;
					foreach($rs->toArray() as $r) 
					{		
						$im++;			
						$losObjetos[$im][0]['nombre']=$r['menu'];
						
						$losObjetos[$im][0]['id']=$r['id'];
						if($r['opcion']!='')
						{
							$losObjetos[$im][0]['opcion']="javascript:process('".$r['opcion']."',".$r['opcion_num'].")";
							$losObjetos[$im][0]['opcion_simple']	= $r['opcion'];
						}
						else
						{
							$losObjetos[$im][0]['opcion']			= "";
							$losObjetos[$im][0]['opcion_simple']	= "";
						}
							
						$losObjetos[$im][0]['mensaje']=$r['texto'];	
						
						/*consulta por hijos*/
						$query="SELECT DISTINCT m.* 
								FROM menu as m, menu_permiso as p
								WHERE ";						

						$query.=" ( m.publicar=1 AND m.menu_padre=".$r['id']."  AND m.id=p.id_menu AND  p.id_permiso='0'  ) OR";
						if(count($this->permiso) > 0) //logeado
						{
							foreach($this->permiso as $key => $estado)
							{
								if(is_numeric($key) && $this->permiso[$key])
								{
									$query.=" ( m.publicar=1 AND m.menu_padre=".$r['id']."  
									AND m.id=p.id_menu AND p.id_permiso='$key' ) OR";
								}
									
							}	

							if($this->permiso['administrador'] == 1)
							{
								$query.=" ( m.publicar=1 AND m.menu_padre=".$r['id']."  
									AND m.id=p.id_menu AND p.id_permiso!='0' ) OR";
							}							
						}						
						$query.="DER BY orden ASC, menu ASC"; 
						
						$rsh = $dbHandle->query($query);
						if ($rsh!=0)
						{
							$j=1;
							$arrayrsh=$rsh->toArray();
							for($l=0; $l < count($arrayrsh);$l++)
							{	
								$rh=$arrayrsh[$l];
							
								$losObjetos[$im][$j]['id'] = $rh['id'];
								$losObjetos[$im][$j]['nombre']=$rh['menu'];
								if(trim($rh['opcion'])!='')
								{
									$losObjetos[$im][$j]['opcion']="javascript:process('".$rh['opcion']."',".$rh['opcion_num'].")";
									$losObjetos[$im][$j]['opcion_simple']	= $rh['opcion'];
								}
								else
								{
									$losObjetos[$im][$j]['opcion']="";
									$losObjetos[$im][$j]['opcion_simple']	= "";
								}
									
								$losObjetos[$im][$j]['mensaje']=$rh['texto'];
							
								$j++;	
							}
						}			
						/*consulta por hijos*/ 											
					}
				}				
			}
			
			$arbol_menu 	= $losObjetos;
			$tree_string 	= '';

			if(!$conArreglo)
			{
				for($i=0; $i < count($arbol_menu) ; $i++)
				{
					$tree_string.='.|'.$arbol_menu[$i][0]['nombre'].'|'.$arbol_menu[$i][0]['opcion'].'|'.$arbol_menu[$i][0]['mensaje'].'
';
					for($j=1; $j < count($arbol_menu[$i]); $j++)
					{
						$tree_string.='..|'.$arbol_menu[$i][$j]['nombre'].'|'.$arbol_menu[$i][$j]['opcion'].'|'.$arbol_menu[$i][$j]['mensaje'].'
';
					}
				}	
			}
			else
				$tree_string = $arbol_menu;
				
			return $tree_string;	 
		}
		
		
		/*
		getArrayMenuSimple()
		$id_padre RECIBE EL ID DE UN MENUPADRE SI SE QUIEREN BUSCAR SUS HIJOS
		$solopadre FALSE => entrega todos los menus del sistema
		$solointerno FALSE => entrega solo los de tipo externo, TRUE entrega todos
		*/
		function getArrayMenuSimple($id_padre='',$solopadre=false,$solointerno=true)
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			$menus = array();
			if (trim($dbHandle->errorMessaje)!="") 
				return(false);			 
			else 
			{
				$selectComun  = "m.publicar, m.id, m.menu, m.opcion ";
				if($solointerno)
				{
					$query = "SELECT ".$selectComun.", ' ' AS padre, m.orden, CONCAT(m.menu , ' (menu raíz)') as nombre
							FROM menu AS m
							WHERE m.menu_padre = 0  ";
					if(!$solopadre)
					{
							$query.="	UNION 
							SELECT ".$selectComun.", p.menu AS padre, m.orden
									, CONCAT(m.menu , ' ( menu padre: ',p.menu,' )') as nombre
							FROM menu AS m, menu AS p
							WHERE p.id = m.menu_padre  ";
					}
					$query.=" ORDER BY   menu,orden"; 
				}
				else
				{
					if($id_padre > 0 )
						$query=" SELECT ".$selectComun.",m.*
							FROM menu AS m, menu AS p
							WHERE p.id = m.menu_padre AND m.menu_padre=".$id_padre." AND m.vista = 'externo' AND m.publicar = 1 ";
					else
						$query = "SELECT ".$selectComun.", ' ' AS padre, m.orden, CONCAT(m.menu , ' (menu raíz)') as nombre
							FROM menu AS m
							WHERE m.menu_padre = 0  AND m.vista = 'externo'  AND m.publicar = 1 ";
							
							
					$query .= " ORDER BY  m.menu,m.orden";
				}
				
				//echo $query."<br>";
				
				
				$rs = $dbHandle->query($query);
			
				$aux = array();
				if ($rs->numTuples!=0)
				{
					$aux = $rs->toArray();
					for($i=0; $i < count($aux) ; $i++)
					{
						$aux[$i]['nombre'] = str_replace('&nbsp;','',$aux[$i]['nombre']);
						$aux[$i]['menu']   = str_replace('&nbsp;','',$aux[$i]['menu']);
						$menus[$i] = $aux[$i];
					}
				}									
			}		
			return $menus;
		}
		
		
		
		function getPermisoMenu($id)
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			$permisos = array();
			if (trim($dbHandle->errorMessaje)!="") 
				return(false);			 
			else 
			{
				$query = "SELECT  	 id_permiso as permiso
						  FROM menu_permiso
						  WHERE id_menu =".$id;
				$rs = $dbHandle->query($query);
			
				$aux = array();
				if ($rs->numTuples!=0)
				{
					$aux = $rs->toArray();
					
					for($i=0; $i < count($aux) ; $i++)
						$permisos[$aux[$i]['permiso']] = 1;
					
				}							
			}
			return $permisos;
		}
		
		function getArchivosMenu()
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			$menus = array();
			if (trim($dbHandle->errorMessaje)!="") 
				return(false);			 
			else 
			{
				$query = "SELECT  m.menu, m.opcion, m.archivo,m.tipo_archivo,m.id ,m.body , m.texto
						FROM menu AS m";
				
				$rs = $dbHandle->query($query);
			
				$aux = array();
				if ($rs->numTuples!=0)
				{
					$aux = $rs->toArray();
					for($i=0; $i < count($aux) ; $i++)
					{

						$menus[$aux[$i]['opcion']]['opcion'] = $aux[$i]['opcion'];							
						if(trim($aux[$i]['opcion']) !='')
						{
							$menus[$aux[$i]['opcion']]['id'] 		= $aux[$i]['id'];
							$menus[$aux[$i]['opcion']]['body'] 		= $aux[$i]['body'];
							$menus[$aux[$i]['opcion']]['texto'] 		= $aux[$i]['texto'];
							$menus[$aux[$i]['opcion']]['archivo'] 	= $aux[$i]['archivo'];
							$menus[$aux[$i]['opcion']]['tipo'] 		= $aux[$i]['tipo_archivo'];
						}
						else
						{
							$menus[$aux[$i]['id']]['id'] = $aux[$i]['id'];
							$menus[$aux[$i]['id']]['body'] = $aux[$i]['body'];
							$menus[$aux[$i]['id']]['tipo'] = $aux[$i]['tipo_archivo'];						
						}
					}
				}									
			}		
			return $menus;		
		}
	}
?>