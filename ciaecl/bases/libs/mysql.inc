<?php

	/****************************************
	 * MySQL DataBase Driver                *
	 * Nobiembre,2000                       *
	 * Juan Carlos Maureira Bravo           *
	 * Universidad Catolica del Norte       *
	 * Chile                                *
	 *                                      *
	 * Email:jmaureir@disc.ucn.cl           *
	 *                                      *
	 * Version 2.0                          *
	 ***************************************/

	class dbDriver_mysql {

		var $dbName;
		var $dbHost;
		var $dbUser;
		var $dbPass;
		var $ConectionHandle;
		var $resultHandle;
		var $errorMessaje;
		var $isConected;

		var $lastId;

		/* Construtor */	
		function dbDriver_mysql($host,$db,$user,$pass) {
			$this->dbName		= $db;
			$this->dbHost		= $host;
			$this->dbUser		= $user;
			$this->dbPass		= $pass;
			$this->isConected	= false;
			$this->ConectionHandle	= 0;
		}

		/* Methods */

		function connect() {

			$this->ConectionHandle = @mysql_connect($this->dbHost,$this->dbUser,$this->dbPass);
			if ($this->ConectionHandle==0) {
				$this->isConected	= false;
				$this->errorMessaje	= "Problemas al Conectarse a la Base de Datos MySql";
		
				return(false);
			}
			@mysql_select_db($this->dbName) or die(" no se puede seleccionar la base de datos ".$this->dbName);
			$this->isConected = true;
			return(true);
		}

		function close() {
			@mysql_close($this->ConectionHandle);
	//		$this->ConectionHandle 	= 0;
			$this->isConected	= false;

		}

		function executeQuery($sqlString) 
		{			
			if ($this->isConected) 
			{
				if(VarConfig::estadoDebugSQL)
					Funciones::mostrarArreglo(" DEBUGSQL: ".$sqlString."<br><br>");  
	
				$this->resultHandle = @mysql_query($sqlString);

				if (!is_bool($this->resultHandle)) 
				{
					$this->lastId = mysql_insert_id();
					if (mysql_num_rows($this->resultHandle)>0) 
					{
						return ($this->resultHandle);
					}
				}
				return($this->resultHandle);
			} 
			else 
			{
				$this->errorMessaje	= "No se ha conectado a la base de datos cuando se trato de realizar una query";
				//echo $this->errorMessaje;
				Funciones::showErrorMsg($this->errorMessaje);
				return(null);
			}			
		}

		function getRows() {

			if ($this->resultHandle!=0) {
				$rows = array();
	
				for($i=0;$i< @mysql_num_rows($this->resultHandle);$i++) {
					$data[] = mysql_fetch_array($this->resultHandle,MYSQL_ASSOC);
				}
				return($data);
			} else {
				$this->errorMessaje	= "No existen registros en memoria para entregar";
				return(0);
			}
		}

		function numRows() {

			if ($this->resultHandle !=0) {
				return(@mysql_num_rows($this->resultHandle));

			} else {
				$this->errorMessaje	= "No existen registros en memoria para entregar";
				return(-1);
			}
		}

		function numAffectedRows() {
			return(@mysql_affected_rows());
		}

		function getLastId() {
			return($this->lastId);	
		}

		function numFields() {

			if ($this->resultHandle !=0) {
				return(mysql_num_fields($this->resultHandle));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}

		function fieldName($fieldnumber) {

			if ($this->resultHandle !=0) {
				return(mysql_field_name($this->resultHandle,$fieldnumber));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}

		function fieldType($fieldnumber) {

			if ($this->resultHandle !=0) {
					return(mysql_field_type($this->resultHandle,$fieldnumber));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}


	}

?>
