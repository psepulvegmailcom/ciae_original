<?php
	class LinkObjeto extends PersistentObject 
	{
		
		var $sourceTable = "common_link";
		
		function LinkObjeto(){
			parent::PersistentObject();
		}
		
		function setLastID(){
			
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			$this->Id =  $dbHandle->getNextId($this->sourceTable)-1;
		}		

		function destroyLink()
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);

			if (trim($dbHandle->errorMessaje)!="") 
				return(false);			 
			else 
				return $dbHandle->deleteRecord($this->sourceTable,"id= '".$this->id."'");			
		}		
	}
	
	class ControladorLink 
	{
		
		var $sourceTable = "common_link";
		
		function ControladorLink() {
			/* Contexto Global */
		
			$this->dbHost		= VarConfig::bdhost;
			$this->dbName		= VarConfig::dbname;
			$this->dbUser		= VarConfig::bduser;
			$this->dbPass		= VarConfig::bdpass;						
		}


		function getArray($todo=true) 
		{
			$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);
			$datos = array();
			if (trim($dbHandle->errorMessaje)!="") 
				return(false);			 
			else 
			{
				$query="SELECT *
						FROM ".$this->sourceTable;
				if(!$todo)
					$query .= "	WHERE publicar=1 ";
				
				$query .= " ORDER BY orden ASC";				
				//echo $query;
				$rs = $dbHandle->query($query);	
				if ($rs->numTuples!=0)
					$datos = $rs->toArray();					
			}
			return $datos;
		}		
	}
?>
