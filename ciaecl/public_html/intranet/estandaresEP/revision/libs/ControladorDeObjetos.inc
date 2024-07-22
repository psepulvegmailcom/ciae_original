<?

	class ControladorDeObjetos 
	{

		var $sourceTable = "";
		var $orderField  = "";
		var $groupField  = "";	
		var $keyField    = 'id';
	
		function ControladorDeObjetos($source="",$order="") 
		{
			if (trim($source) != "") {
				$this->sourceTable = $source;
			}
			if (trim($order) !="") {
				$this->orderField  = $order;
			}

			$this->dateFormat = '%d-%m-%Y';
			/* Contexto Global */
					
			$this->dbHost		= VarConfig::bdhost;
			$this->dbName		= VarConfig::dbname;
			$this->dbUser		= VarConfig::bduser;
			$this->dbPass		= VarConfig::bdpass;
		}
	
		function deleteCollection($class,$where='') 
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			if ($dbHandle->errorMessaje!="") {
				return(false);
			} else {
				$dbHandle->deleteRecord($class,$where);
				return(true);
			}
			return(false);
		}

		function updateCollection($class,$set,$where='') 
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			if ($dbHandle->errorMessaje!="") {
				return(false);
			} else {

				$updateFields = array();

				$field = strtok($set,",");

				while ($field !== false) {

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
		
		function getArrayObjects($table='',$where='',$order='') 
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
				if (trim($where) != '') 
				{
					$where = "WHERE ".$where;
				} 
				$q = "SELECT * FROM ".$table." ".$where." ".$order." ;";
 				Funciones::mostrarArreglo($q,false);
				$rs = $dbHandle->query($q); 
				if ($rs!=0) 
				{
					return($rs->toArray());
				}
			}
			return(array());
		} 
		
		/*psepulve: le agregue los campos $sort y $group para casos especiales*/
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
			{
				$sort = "ORDER BY ".$sort." ";
			}	
			
			if(trim($group) == '' && trim($this->groupField) != "") 
			{
				$group = $this->groupField;
			}
 		
			if(trim($group) != '') 
			{
				$group = "GROUP BY ".$group." ";
			}		
			
			if ($dbHandle->errorMessaje!="")
			{
				echo $dbHandle->errorMessaje;
				return(false);
			} 
			else 
			{
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
		
		/*para hacer consultas complejas*/
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
			Funciones::mostrarArreglo($sql,false);
			//Funciones::mostrarArreglo($result,false);
			return $result ;
		}		
		
		function setDateFormat($formato_date)
		{
			$this->dateFormat = $formato_date;
		}
	}
?>
