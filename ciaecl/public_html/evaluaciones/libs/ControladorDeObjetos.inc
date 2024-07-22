<?php

	/**
	 * ControladorDeObjetos
	 *
	 * @package ciae_web
	 * @author 
	 * @copyright 2013
	 * @version $Id$
	 * @access public
	 */
	class ControladorDeObjetos 
	{
		var $sourceTable = "";
		var $orderField  = "";
		var $groupField  = "";	
		var $keyField    = 'id';
		
	  /**
	   * ControladorDeObjetos::ControladorDeObjetos()
	   *
	   * @param string $source
	   * @param string $order
	   * @return
	   */
		function ControladorDeObjetos($source="",$order="") 
		{
			if (trim($source) != "") 
			{
				$this->sourceTable = $source;
			}
			if (trim($order) !="") 
			{
				$this->orderField  = $order;
			}

			$this->lang 		= VarSystem::obtenerIdiomaActual(); 
			
			$this->dateFormat = '%d-%m-%Y';
			/** CONTEXTO GLOBAL */					
			$this->dbHost		= VarConfig::bdhost;
			$this->dbName		= VarConfig::dbname;
			$this->dbUser		= VarConfig::bduser;
			$this->dbPass		= VarConfig::bdpass;
		}
	
	  /**
	   * ControladorDeObjetos::deleteCollection()
	   *
	   * @param mixed $class
	   * @param string $where
	   * @return
	   */
		function deleteCollection($class,$where='') 
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			if ($dbHandle->errorMessaje!="") 
			{
				return(false);
			} 
			else
			{
				$dbHandle->deleteRecord($class,$where);
				return(true);
			}
			return(false);
		}
	
	  /**
	   * ControladorDeObjetos::updateCollection()
	   *
	   * @param mixed $class
	   * @param mixed $set
	   * @param string $where
	   * @return
	   */
		function updateCollection($class,$set,$where='') 
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			if ($dbHandle->errorMessaje!="") 
			{
				return(false);
			} 
			else 
			{
				$updateFields = array();
				$field = strtok($set,",");
				while ($field !== false) 
				{
					$name = strtok($field,"=");
					$val  = strtok("=");
					array_push($updateFields,array($name,$val));
					$field = strtok(",");
				}
				$dbHandle->updateRecord($class,$updateFields,$where);
				return(true);
			}
			return(false);
		} 
		
	  /**
	   * ControladorDeObjetos::getArrayObjects()
	   *
	   * @param string $table
	   * @param string $where
	   * @param string $order
	   * @param string $select
	   * @param string $group
	   * @return
	   */
		function getArrayObjects($table='',$where='',$order='',$select='',$group='') 
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			if ($dbHandle->errorMessaje!="") 
			{
				return(false);
			} 
			else 
			{
				if (trim($table) == "") 
				{
					$table = $this->sourceTable;	
				} 
				if (trim($order) != '') 
				{
					$order = "ORDER BY ".$order;
				} 
				if (trim($group) != '') 
				{
					$group = "GROUP BY ".$group;
				} 
				if (trim($where) != '') 
				{
					$where = "WHERE ".$where;
				}	
				if (trim($select) != '') 
				{
					$select = ", ".$select;
				}	
				
				$q = "SELECT * ".$select." FROM ".$table." ".$where." ".$group." ".$order." ;";
 				//Funciones::mostrarArreglo($q);
 				//echo $q;
				$rs = $dbHandle->query($q);
				
				if ($rs!=0) {
					return($rs->toArray());
				}
			}
			return(array());
		}
		
		/** PSEPULVE: LE AGREGUE LOS CAMPOS $SORT Y $GROUP PARA CASOS ESPECIALES */
	  /**
	   * ControladorDeObjetos::getIDList()
	   *
	   * @param string $where
	   * @param string $class
	   * @param string $what
	   * @param string $sort
	   * @param string $group
	   * @return
	   */
		function getIDList($where='',$class='',$what='',$sort='',$group='') 
		{
			if(trim($what) == '')
			{
				$what = $this->keyField;
			}
				
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			$table = $this->sourceTable;

			if ($class!="") 
			{
				$table = $class; 
			}
					
			if(trim($sort) == '' && trim($this->orderField) != "") 
			{
				$sort = $this->orderField;
			}
 			
			if(trim($sort) != '')
				$sort = "ORDER BY ".$sort." ";	
			
			if(trim($group) == '' && trim($this->groupField) != "") 
				$group = $this->groupField;
 		
			if(trim($group) != '') 
				$group = "GROUP BY ".$group." ";	
			
			if ($dbHandle->errorMessaje!="") {
				echo $dbHandle->errorMessaje;
				return(false);
			} else {
				$rs=0;
				if ($where=='') {
					$sql ="SELECT $what FROM $table $group $sort;";
				} else {
					$sql ="SELECT $what FROM $table WHERE $where $group $sort;";
				}
	
				//echo $sql."<br>";
				$rs = $dbHandle->query($sql);
				//Funciones::mostrarDebug('getIDList',$sql);
				
				if ($rs!=0) {
					return($rs->toArray());
				}
			}
			return(array());
		}
		
	  /**
	   * ControladorDeObjetos::deleteElement()
	   *
	   * @param mixed $condition
	   * @return
	   */
		function deleteElement($condition)
		{ 
			$sql = "DELETE FROM ".$this->sourceTable." WHERE ".$condition;
			return $this->getQuery($sql); 
		}
		
	  /**
	   * ControladorDeObjetos::getObjects()
	   *
	   * @param mixed $class
	   * @param string $where
	   * @param string $order
	   * @param string $group
	   * @return
	   */
		function getObjects($class,$where='',$order='',$group='') 
		{ 	
			if ($order!="") {
				$this->orderField = $order;
			}
			if ($group!="") {
				$this->groupField = $group;
			} 
			$ids = ControladorDeObjetos::getIDList($where);
 
			$theObjects = array();
			if (sizeof($ids)>0) 
			{
				foreach($ids as $i) {
					$phpcode = "\$obj = new $class(); \$obj->loadObject('".$this->keyField."=".$i[$this->keyField]."'); array_push(\$theObjects,\$obj);";
					//echo $phpcode;
					eval($phpcode);
				}		
				return($theObjects);	
			}
			return(array());
		}
		
		/** PARA HACER CONSULTAS COMPLEJAS */
	  /**
	   * ControladorDeObjetos::getQuery()
	   *
	   * @param mixed $sql
	   * @return
	   */
		function getQuery($sql)
		{ 
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			$result = array();
			if ($dbHandle->errorMessaje!="") {
				echo $dbHandle->errorMessaje;
				return $result;
			} 
			else 
			{
				$rs = $dbHandle->query($sql);		 
				if ($rs!=0) 
				{ 
					$result = $rs->toArray();
					if(!is_array($result))
					{
						$result = (bool)$rs->dbDriver->resultHandle;
					}
				}							
			}	
			//echo "<br><br>".$sql."<br><br>"; 
			return $result ;
		}		
		
	  /**
	   * ControladorDeObjetos::setDateFormat()
	   *
	   * @param mixed $formato_date
	   * @return
	   */
		function setDateFormat($formato_date)
		{
			$this->dateFormat = $formato_date;
		}  
	}
		
	/**
	 * ControlObjetos
	 *
	 * @package ciae_web
	 * @author 
	 * @copyright 2013
	 * @version $Id$
	 * @access public
	 */
	class ControlObjetos extends ControladorDeObjetos
	{
	  /**
	   * ControlObjetos::ControlObjetos()
	   *
	   * @return
	   */
		function ControlObjetos()
		{
			$this->obj 			= new Objetos();
			$this->where 		= '';
			$this->order 		= '';
			$this->select 		= '';
			$this->group		= '';
			$this->key 			= $this->obj->dbKey;
			$this->sourceTable 	= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}
		
		function getSqlDateTime($fecha_campo_in,$fecha_campo_out)
		{
			$sql = "DATE_FORMAT(  FROM_UNIXTIME(".$fecha_campo_in.")  , '".ControladorFechas::formatoFechaSql()."'  ) AS ".$fecha_campo_out."";
			return $sql;
		}
		
	  /**
	   * ControlObjetos::prepararObjeto()
	   *
	   * @return
	   */
		function prepararObjeto()
		{ 
			$this->key 			= $this->obj->dbKey;
			$this->sourceTable 	= $this->obj->sourceTable;
		}
		
	  /**
	   * ControlObjetos::obtenerListado()
	   *
	   * @return
	   */
		function obtenerListado()
		{
			return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
		}
		
	  /**
	   * ControlObjetos::obtenerElemento()
	   *
	   * @param mixed $id
	   * @return
	   */
		function obtenerElemento($id)
		{
			if(trim($this->where) =='')
			{
				$this->where = " 1 ";
			}
			$this->where .= " AND ".$this->key." = '".$id."'";
			return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select,$this->group); 
		}
		
	  /**
	   * ControlObjetos::eliminarElementos()
	   *
	   * @param mixed $id
	   * @return
	   */
		function eliminarElementos($id)
		{
			$condition = $this->key." = '".$id."'";
			return parent::deleteElement($condition);
		}
		
	  /**
	   * ControlObjetos::consultarEspecifica()
	   *
	   * @param mixed $sql
	   * @return
	   */
		function consultarEspecifica($sql)
		{
			return parent::getQuery($sql);
		}
		
		/*
		FUNCION GENERICA PARA REALIZAR BUSQUEDA ESPECIFICA EN OBJETOS
		*/
	  /**
	   * ControlObjetos::obtenerQryPorBusqueda()
	   *
	   * @param mixed $valores
	   * @param mixed $tipo
	   * @return
	   */
		function obtenerQryPorBusqueda($valores, $tipo)
		{
			
			foreach($valores as $var => $val) {	
										
				$tok = strtok ($var,"|"); 
				$aux = explode('_',$var);
 					if($aux[0] == 'busca')
 					{
 						unset($aux[0]);
						$var = implode('_',$aux);
 						$tok = $var;
						if ($tok != '' and $val != '0' and $val!="")
						{						  											
						  list($leyenda, $numero, $strQryRes) = $this->obtenerLeyendaPorBusqueda($tok, $val, $tipo);		 
						  if ($tok =='palabra' || $tok =='rangoNombre' || $val =='medios' || $tok =='Autor_id'){
							$strQryAnd = $leyenda;
							}else{
							$strQryAnd = $leyenda."'%".$val."%'";
							}						
							$strQry = $strQry." AND (".$strQryAnd.")";
						}
					}
																													
				  $tok = strtok ($var,"|");				  										
			  }
			   		if (($numero > 1 )){
						$order = $sql." HAVING SCORE >=0 ORDER BY SCORE DESC ";							
					} 
														
				return array($strQryRes, $strQry, $order);			
		}
		
		/*
		FUNCION ESPECIFICA PARA GENERAR SELECT DE SQL
		DEBE SER DEFINIDO EN CADA CONTROLADOR DE OBJETO PARA EL TEMA ESPECIFICO
		*/
		function obtenerLeyendaPorBusqueda($tok, $val, $tipo)
		{
			if ($tok == "rangoNombre" and $val != ''){
				if ($val==1) $value=" BETWEEN 'A' AND 'D' ";
				if ($val==2) $value=" BETWEEN 'E' AND 'H' ";
				if ($val==3) $value=" BETWEEN 'I' AND 'L' ";
				if ($val==4) $value=" BETWEEN 'M' AND 'O' ";
				if ($val==5) $value=" BETWEEN 'P' AND 'S' ";
				if ($val==6) $value=" BETWEEN 'T' AND 'Z' ";
				
				if ($tipo==1){	
				$leyenda = "pubPer.apellido_paterno".$value;
				}
				if ($tipo==3){	
				$leyenda = "pers.apellido_paterno".$value;
				}		
			}
				
		if ($tipo==1){					
			if ($tok == "Autor" and $val != ''){					
				$leyenda = "pubPer.nombre_publicacion like ";
				}else
			if ($tok == "Autor_id" and $val != ''){					
				$leyenda = "pubPer.id_persona = $val ";
				}else	
			if ($tok == "Anno" && $val != 'Anno'){
				$leyenda = "pub.agno like ";
				}else				
			if ($tok == "Area" && $val!="Area"){
				$leyenda = "pub.id_area like ";
				}else
			if ($tok == "tipoDocumento" && $val!="Tipo de documento") {
				$leyenda = "pub.id_tipo like ";
				}
								
			}else
							
		if ($tipo==2){					
			if ($tok == "Anno" && $val != 'Anno'){
				$leyenda = " year(noti.fecha) like ";
				}else
			if ($tok == "mes" && $val!="Mes"){				
				$leyenda = "month (noti.fecha) like ";
				}else
			if (($tok == "tipo" && $val!="Tipo de Noticia")&& ($val != "medios")){				
				$leyenda = " noti.tipo like ";
				}else
			if (($tok == "tipo" && $val!="Tipo de Noticia" && $val == "medios")){				
				$leyenda = " noti.id_prensa > 0 ";
				}
				
			}else
							
		if ($tipo==3){					
			if ($tok == "Anno" && $val != 'Anno'){
				$leyenda = " proy.agno_inicio like ";
				}else
			if ($tok == "areaProyecto" && $val!=''){
				$leyenda = " proArea.id_area like ";
				}else
			if ($tok == "Autor" && $val!=''){
				$leyenda = " pers.apellido_paterno like ";
				}
			if ($tok == "Autor_id" && $val!=''){
				$leyenda = " pers.id_persona = $val ";
				}										
			}else
							
		if ($tipo==4){					
			if ($tok == "Anno" && $val != 'Anno'){
				$leyenda = " noti.agno like ";
				}else
			if ($tok == "mes" && $val!='Mes'){
				$leyenda = " noti.mes like ";
				}									
			}		
				
			if ($tok == "palabra" && $val!=''){							
				list($leyenda, $strQryRes)	= $this->obtenerLeyendaPalabraBusqueda($val,$tipo);
				$trozos=explode(" ",$val);
				$numero=count($trozos);	
				$num = strlen($val);
				}
				
				
				
		return array($leyenda,$numero,$strQryRes);		
		}	
		/*
		FUNCION ESPECIFICA PARA GENERAR SELECT DE SQL
		DEBE SER DEFINIDO EN CADA CONTROLADOR DE OBJETO PARA EL TEMA ESPECIFICO
		*/
		function obtenerLeyendaPalabraBusqueda($val,$tipo)
		{
			$trozos=explode(" ",$val);
					

					$val = str_replace(array("&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;",
					"&aacute;","&eacute;","&iacute;","&Atilde;&sup3;","&Atilde;&ordm;","&ntilde;","&oacute;","&uacute;"), 
					array("Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú","ñ","ó","ú"), $val);
				
						$numero=count($trozos);
						$num = strlen($val);
						if ($numero > 1) { 
						$strPalabra = $val."%' )";
						}else{
						$strPalabra = $val."%' )";
						}						

					 if ($num > 1){
											
						if ($numero == 1){
							
							if ($tipo==1){
							$strP = " pub.titulo LIKE ('%";
							$strPRZ = " OR pub.resumen LIKE ('%";
							$strQryRes = "";
							}else
							if ($tipo==2){
							$strP = " noti.titulo LIKE ('%";
							$strPRZ = " OR noti.bajada LIKE ('%";
							$strQryRes = "";
							}else
							if ($tipo==3){
							$strP = " proy.proyecto LIKE ('%";
							$strPRZ = " OR proy.antecedentes LIKE ('%";
							$strPRZP = " OR proy.financiamiento LIKE ('%";
							$strQryRes = "";
							}
							
						}elseif ($numero > 1){
							if ($tipo==1){
							$strPQ = " MATCH(pub.titulo, pub.resumen) AGAINST ('%";
							$strP = " MATCH(pub.titulo) AGAINST ('%";
							$strPRZ = "OR MATCH(pub.resumen) AGAINST ('%";
							}else
							if ($tipo==2){
							$strPQ = " MATCH(noti.titulo, noti.bajada) AGAINST ('%";
							$strP = " MATCH(noti.titulo) AGAINST ('%";
							$strPRZ = "OR MATCH(noti.bajada) AGAINST ('%";
							}else
							if ($tipo==3){
							$strPQ = " MATCH(proy.proyecto, proy.antecedentes, proy.financiamiento) AGAINST ('%";
							$strP = " MATCH(proy.proyecto) AGAINST ('%";
							$strPRZ = "OR MATCH(proy.antecedentes) AGAINST ('%";
							$strPRZP = "OR MATCH(proy.financiamiento) AGAINST ('%";
							}
							
							$strQryRes = $strPQ.($strPalabra)." as Score, ";
							}
							if($tipo==3){
							$strQry = " (".$strP.($strPalabra).$strPRZ.($strPalabra).$strPRZP.$strPalabra.")";
							}else{
							$strQry = " (".$strP.($strPalabra).$strPRZ.($strPalabra).")";
							}
					 }		
														
					return array($strQry, $strQryRes);;	
		}
		
		
		
	}
?>