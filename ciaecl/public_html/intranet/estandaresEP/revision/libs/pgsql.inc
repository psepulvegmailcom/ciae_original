<?php

	/****************************************
	 * PostgreSQL DataBase Driver           *
	 * Nobiembre,2000                       *
	 * Juan Carlos Maureira Bravo           *
	 * Universidad Catolica del Norte       *
	 * Chile                                *
	 *                                      *
	 * Email:jmaureir@disc.ucn.cl           *
	 *                                      *
	 * Version 2.0                          *
	 ***************************************/

	class dbDriver_pgsql {

		var $dbName;
		var $dbHost;
		var $dbUser;
		var $dbPass;
		var $ConectionHandle;
		var $resultHandle;
		var $errorMessaje;
		var $isConected;


		/* Construtor */	
		function dbDriver_pgsql($host,$db,$user,$pass) {
			
			$this->dbName		= $db;
			$this->dbHost		= $host;
			$this->dbUser		= $user;
			$this->dbPass		= $pass;
			$this->isConected	= false;
			$this->ConectionHandle	= 0;
		}

		/* Methods */

		function connect() {

			$this->ConectionHandle = pg_pconnect("host=$this->dbHost dbname=$this->dbName user=$this->dbUser password=$this->dbPass");
			if ($this->ConectionHandle==0) {
				$this->isConected	= false;
				$this->errorMessaje	= "Problemas al Conectarse a la Base de Datos PosgreSQL";
		
				return(false);
			}
			$this->isConected = true;
			return(true);
		}

		function close() {
			pg_close($this->ConectionHandle);
	//		$this->ConectionHandle 	= 0;
			$this->isConected	= false;

		}

		function executeQuery($sqlString) {
			
			if ($this->isConected) {

				echo $sqlString;
			
				$this->resultHandle = pg_exec($this->ConectionHandle,$sqlString);

				if ($this->resultHandle==0) {
					$this->$errorMessaje = "Error al ejecutar la Query";
					return(null);
				}
			} else {
				$this->errorMessaje	= "No se ha conectado a la base de datos cuando se trato de realizar una query";
				return(null);
			}
			return($this->resultHandle);
		}

		function getRows() {

			if ($this->resultHandle!=0) {
				$rows = array();
	
				for($i=0;$i<pg_numrows($this->resultHandle);$i++) {
					$data[] = pg_fetch_array($this->resultHandle,$i,1);
				}
				return($data);
			} else {
				$this->errorMessaje	= "No existen registros en memoria para entregar";
				return(0);
			}
		}

		function numRows() {

			if ($this->resultHandle !=0) {
				return(pg_numrows($this->resultHandle));

			} else {
				$this->errorMessaje	= "No existen registros en memoria para entregar";
				return(-1);
			}
		}

		function numAffectedRows() {
			if ($this->resultHandle!=0) {
				return(pg_cmdtuples($this->resultHandle));
			} else {
				$this->errorMessaje	= "No hay registros consultados, por lo tanto no hay registros afectados";
				return(-1);
			}
		}

		function numFields() {

			if ($this->resultHandle !=0) {
				return(pg_numFields($this->resultHandle));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}

		function fieldName($fieldnumber) {

			if ($this->resultHandle !=0) {
				return(pg_fieldname($this->resultHandle,$fieldnumber));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}

		function fieldType($fieldnumber) {

			if ($this->resultHandle !=0) {
				return(pg_fieldtype($this->resultHandle,$fieldnumber));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}


	}

?>
