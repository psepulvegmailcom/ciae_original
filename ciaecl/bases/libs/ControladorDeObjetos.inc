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
 		    		//Funciones::mostrarArreglo($q,true);
 				//echo $q;
				$rs = $dbHandle->query($q);
			//	Funciones::mostrarArreglo($rs,true);
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
				$rs = $dbHandle->query($sql);//echo $sql.'<br><br>';
				if ($rs!=0)
				{
					$result = $rs->toArray();
					if(!is_array($result))
					{
						$result = (bool)$rs->dbDriver->resultHandle;
					}
				}
			}
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

		function setLimit($limit)
		{
			$this->order .= $limit;
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

		function obtenerProximoID()
		{
			$sql = "SELECT max(".$this->key.")+1 as maximo FROM ".$this->sourceTable." LIMIT 1";
			$output = parent::getQuery($sql);
			return $output['0']['maximo'];
		}

		function getSqlDateTime($fecha_campo_in='fecha',$fecha_campo_out='fecha_html',$simple=false)
		{
			$sql = "DATE_FORMAT(  FROM_UNIXTIME(".$fecha_campo_in.")  , '".ControladorFechas::formatoFechaSql($simple)."'  ) AS ".$fecha_campo_out."";
			return $sql;
		}

		function getSqlDateHtml($fecha_campo_in='fecha',$fecha_campo_out='fecha_html',$simple=false)
		{
			$sql = "DATE_FORMAT(   ".$fecha_campo_in."   , '".ControladorFechas::formatoFechaSql($simple)."'  ) AS ".$fecha_campo_out."";
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
	   * ControlObjetos::obtenerTotalListado()
	   *
	   * @return
	   */
		function obtenerTotalListado()
		{
			$sql = "SELECT count( DISTINCT ".$this->key.") as total FROM ".$this->sourceTable;
			if(trim($this->where) != '')
			{
				$sql .= " WHERE ".$this->where;
			}
            //Funciones::mostrarArreglo($sql,true);
			$output = parent::getQuery($sql);
			//Funciones::mostrarArreglo($output,true);
			return $output[0]['total'];
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

 		function obtenerListadoGeneral()
		{
            return parent::getArrayObjects($this->sourceTable,$this->where,$this->order);
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
		function obtenerQryPorBusqueda(
			$valores,
			$tipo,
			$valoresBusqueda,
			$valBusquedaPalabra,
			$prefijo_campo = 'busca')
		{

			// Funciones::mostrarArreglo(array($valores, $tipo,$valoresBusqueda,$valBusquedaPalabra,$prefijo_campo),false,"buscaracar");

			foreach($valores as $var => $val)
			{
				$tok = strtok($val,"|");
				$aux = explode('_', $var);

				if($aux[0] == $prefijo_campo)
				{
					unset($aux[0]);
					$var = implode('_',$aux);
					$tok = $var;
					if ($tok != '' and $val != '0' and $val != "")
					{
                        $val = html_entity_decode($val);
						list($leyenda, $numero, $strQryRes) = $this->obtenerLeyendaPorBusqueda($tok, $val, $tipo, $valoresBusqueda, $valBusquedaPalabra);
                        if($valoresBusqueda["word|".$tok] != '' || $valoresBusqueda["nameRange|".$tok] != '')
						{
							$strQryAnd = $leyenda;
						}
                        elseif($valoresBusqueda["simple|".$tok]!='')
						{
							$strQryAnd = $leyenda."'".$val."'";
						}
						else
						{
							$strQryAnd = $leyenda."'%".$val."%'";
						}
						$strQry = $strQry." AND (".$strQryAnd.")";
					}
				}

				$tok = strtok ($var,"|");
			}
			if (($numero > 1 ))
			{
				$order = $sql." HAVING SCORE >=0 ORDER BY SCORE DESC ";
			}

			//Funciones::mostrarArreglo(array($strQryRes, $strQry, $order),false,"buscaracar2");

			return array($strQryRes, $strQry, $order);
		}

		/*
		FUNCION ESPECIFICA PARA GENERAR SELECT DE SQL
		DEBE SER DEFINIDO EN CADA CONTROLADOR DE OBJETO PARA EL TEMA ESPECIFICO
		*/
		function obtenerLeyendaPorBusqueda($tok, $val, $tipo, $valoresBusqueda, $valBusquedaPalabra)
		{
        	if ($valoresBusqueda["nameRange|".$tok]!='' && $val!='')
			{
				if ($val==1) $value=" BETWEEN 'A' AND 'DZ' ";
				if ($val==2) $value=" BETWEEN 'E' AND 'HZ' ";
				if ($val==3) $value=" BETWEEN 'I' AND 'LZ' ";
				if ($val==4) $value=" BETWEEN 'M' AND 'OZ' ";
				if ($val==5) $value=" BETWEEN 'P' AND 'SZ' ";
				if ($val==6) $value=" BETWEEN 'T' AND 'ZZ' ";

					$leyenda = $valoresBusqueda["nameRange|".$tok].$value;
			}else{
			 if ($val!='' && $val != $tok){
			     if ($valoresBusqueda["simple|".$tok]!=''){
                  $leyenda = $valoresBusqueda["simple|".$tok]." LIKE ";
                  }else {
                    $leyenda = $valoresBusqueda[$tok]." LIKE ";
                  }
              }
			}
			if ($valoresBusqueda["word|".$tok]!='')
			{
				list($leyenda, $strQryRes)	= $this->obtenerLeyendaPalabraBusqueda($val,$tipo,$valBusquedaPalabra);
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
		function obtenerLeyendaPalabraBusqueda($val,$tipo,$valBusquedaPalabra)
		{
			$trozos=explode(" ",$val);
			//	echo $val;
						$numero=count($trozos);
						$num = strlen($val);
						if ($numero > 1) {
						$strPalabra = $val."%')";
					    }else{
						$strPalabra = $val."%')";
						}

					 if ($num > 1){
						$total = count($valBusquedaPalabra);
						if ($numero == 1){

                          		for($i=0; $i < $total; $i++)
                            		{
                            			if ($i==0){
                            				$strP[0]= $valBusquedaPalabra[$i]." LIKE ('%";
                                            $strQry = " (".$strP[0].($strPalabra);
                        			       }else if($i>0){
                             				$strP[$i] = " OR ".$valBusquedaPalabra[$i]." LIKE ('%";
                                            $strQry =  $strQry.$strP[$i].($strPalabra);
                            			 }
                          			   }
                                        $strQry = $strQry.$strPC.")";
                                        $strQryRes = "";
						}elseif ($numero > 1){
						  	for($i=0; $i < $total; $i++)
                            		{
                           		    if ($i==0){

                            		  $strPQ = " MATCH(".$valBusquedaPalabra[0];
                                      $strQry = " MATCH(".$valBusquedaPalabra[0].") AGAINST ('%$strPalabra";
                                        }else if($i>0){
                                      $strPQ = $strPQ." ,".$valBusquedaPalabra[$i];
                                      $strQry = $strQry." OR MATCH(".$valBusquedaPalabra[$i].") AGAINST ('%$strPalabra";
                                      }
                            		}
                                    $strPQ = $strPQ.") AGAINST ('%";
                                    $strQry = $strQry.$strPC." ";

							$strQryRes = $strPQ.($strPalabra)." as Score, ";
							}

					 }

					return array($strQry, $strQryRes);
		}
	}
?>
