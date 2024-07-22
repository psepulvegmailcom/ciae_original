<?php

	include_once "dblogic.inc";
	
	class PersistentObject
	{
		var $id;
		var $newObject;
		var $sourceRecord;
		var $sourceTable;

		function PersistentObject() 
		{ 
			/* Contexto Global para conectarse al postgresql */			
			$this->dbHost		= VarConfig::bdhost;
			$this->dbName		= VarConfig::dbname;
			$this->dbUser		= VarConfig::bduser;
			$this->dbPass		= VarConfig::bdpass; 
			/* Datos propios del objeto */
			$this->newObject	= true; 
		}
 
		function setFields($data=array())
		{
			$fields = $this->getFields();
			$count = count($fields);
			for($i=0; $i < $count; $i++)
			{ 
				if(count($data) > 0)
					$this->$fields[$i][0] = $data[$fields[$i][0]];
				else
					$this->$fields[$i][0] = '';
			}  
		}		 
		 
		function saveObject($condition="") 
		{
			/* obtencion de los campos de la clase*/			
			$fieldsNames	= array_keys(get_object_vars($this));
			$fieldsValues	= get_object_vars($this);
			$fieldArray		= array();

			for($i=0;$i<sizeof($fieldsNames);$i++) 
			{
				if (!is_array($fieldsValues[$fieldsNames[$i]])) {				
					if ($fieldsNames[$i]!="dbHost" && $fieldsNames[$i]!="dbName" && $fieldsNames[$i]!="dbUser" && $fieldsNames[$i]!="dbPass" && $fieldsNames[$i]!="newObject" && $fieldsNames[$i]!="sourceTable" && $fieldsNames[$i]!="Id" && $fieldsNames[$i]!="id"  && $fieldsNames[$i]!="dbKey" ) 
					{ 
						$fieldArray[] = array($fieldsNames[$i],$fieldsValues[$fieldsNames[$i]]);
					}
				}
			}

			/* verificar si hay que agregar a actualizar */ 
			if ($this->newObject)
			{
				$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
				if ($dbHandle->errorMessaje!="") 
				{
					return(false);
				} 
				else 
				{
					$newID = $dbHandle->addRecord($this->sourceTable,$fieldArray);
					if ($newID) 
					{
							$this->id = $newID;
							$this->newObject = false;
							return(true);	
					} 
				}
				return(false);
			} 
			else 
			{
				$fieldsNames	= array_keys(get_object_vars($this));
				$fieldsValues	= get_object_vars($this); 
				$fieldArray		= array(); 
				for($i=0;$i<sizeof($fieldsNames);$i++) 
				{	
					if (!is_array($fieldsValues[$fieldsNames[$i]])) 
					{				
						if ($fieldsNames[$i]!="dbHost" && $fieldsNames[$i]!="dbName" && $fieldsNames[$i]!="dbUser" && $fieldsNames[$i]!="dbPass" &&
							$fieldsNames[$i]!="newObject" && $fieldsNames[$i]!="sourceTable" && $fieldsNames[$i]!="Id" && $fieldsNames[$i]!="id"  && $fieldsNames[$i]!="dbKey") 
						{		
							$fieldArray[] = array($fieldsNames[$i],$fieldsValues[$fieldsNames[$i]]);
						}
					}
				}

				$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass); 
				if ($dbHandle->errorMessaje!="") 
				{
					return(false);
				}
				else
				{
					if ($condition=="") 
					{
						if ($dbHandle->updateRecord($this->sourceTable,$fieldArray,"id='".$this->id."'")) 
						{
							return(true);
						}
					} 
					else 
					{
						if ($dbHandle->updateRecord($this->sourceTable,$fieldArray,$condition)) 
						{
							return(true);
						}
					}
				}
			}
			return(false); 
		} 

		function getPrimaryKey()
		{ 
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			return $dbHandle->getPrimaryKey($this->sourceTable);
		}

		function getFields()
		{ 
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			return $dbHandle->getFields($this->sourceTable);
		}

		function loadObject($queryString,$ociQueryString="") 
		{ 
			if ($this->sourceTable!="") {
				$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);

				if ($dbHandle->errorMessaje!="") 
				{ 
					echo $dbHandle->errorMessaje; 
					return(false);
				} 
				else 
				{	
					$sql = "SELECT * FROM ".$this->sourceTable." WHERE ".$queryString.";";
					// Funciones::mostrarDebug("LoadObject",$sql);
					$rsObject = $dbHandle->query($sql);

					if ($rsObject!=0) {
	
						if ($rsObject->rowCount()>0) {

							$arrayObject = $rsObject->getCurrentRow();
							
							$arrayFields = array_keys($arrayObject);
							
							$this->id = $arrayObject['id'];
							
							for($i=0;$i<sizeof($arrayFields);$i++) {
								$phpCodeAddAttribute = "\$this->".strtolower($arrayFields[$i])." = '".addslashes($arrayObject[$arrayFields[$i]])."';";
								eval($phpCodeAddAttribute);
							}

							$this->newObject		= false;
							
							return(true);	
						}
					}
				}
			}
			return(false);
		}

		function destroyObject($condition="") 
		{
			/* levantar la logica de base de datos */
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);

			if ($dbHandle->errorMessaje!="") 
			{
				//echo "BD ERROR: ".$dbHandle->errorMessaje;
				return(false);
			} 
			else 
			{
				/* Logica creada, proceder a elimiar el registro y su cuenta de acceso */
				if ($condition=="") 
				{
					if ($dbHandle->deleteRecord($this->sourceTable,"id = '".$this->id."'")) 
					{
						return(true);
					}	
				} 
				else 
				{
					if ($dbHandle->deleteRecord($this->sourceTable,$condition)) 
					{
						return(true);
					}
				}
			}
			return(false);
		}
		
		function getLastId($nameid='id')
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);

			if ($dbHandle->errorMessaje!="") 
				return -1;			
			else 
			{
				$lastId = $dbHandle->getNextId($this->sourceTable,$nameid);
				return $lastId - 1;
			}
		}
	}


	class Objetos extends PersistentObject
	{
		function Objetos()
		{
			parent::PersistentObject();
		}

		function buscarObjeto($id)
		{ 
			parent::loadObject($this->dbKey.' = "'.$id.'"');
		}
		
		function guardarObjeto($id='')
		{ 
			if($this->newObject)
				parent::saveObject();
			else
				parent::saveObject($this->dbKey.' = "'.$id.'"');
		} 
  
		function eliminarObjeto($id)
		{ 
			parent::destroyObject($this->dbKey.' = "'.$id.'"');
		} 

		function agregarValores($valores,$prefijo='')
		{	 
			$campos 		= parent::getFields(); 
			$total_campos 	= count($campos);
			for($i=0; $i < $total_campos ; $i++) 
			{
				$aux = $prefijo.$campos[$i][0]; 
				if(isset($valores[$aux]))
				{   
					$this->$campos[$i][0] = Funciones::cleanHtml($valores[$aux]);
				} 
			}  			 
		}
	}	
?>
