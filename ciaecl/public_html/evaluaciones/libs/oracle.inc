<?php

	/** ***************************************
	 * Oracle 8i DataBase Driver            *
	 * Nobiembre,2001                       *
	 * Juan Carlos Maureira Bravo           *
	 * Universidad Catolica del Norte       *
	 * Chile                                *
	 *                                      *
	 * Email:jmaureir@disc.ucn.cl           *
	 *                                      *
	 * Version 1.0                          *
	 ***************************************/

	class dbDriver_oci {

		var $dbName;
		var $dbHost;
		var $dbUser;
		var $dbPass;
		var $ConectionHandle;
		var $resultHandle;
		var $errorMessaje;
		var $isConected;
		var $Oracle_Home;

		/**  Construtor */	
		function dbDriver_oci($host,$db,$user,$pass) {
			$this->dbName			= $db;
			$this->dbHost			= $host;
			$this->dbUser			= $user;
			$this->dbPass			= $pass;
			$this->isConected		= false;
			$this->ConectionHandle	= 0;
		
			$this->Oracle_Home		= "/usr/local/share/orasoft";
		
		}

		/**  Methods */

		function connect() {

			putenv("ORACLE_SID=".$this->dbName); 
			putenv("ORACLE_HOME=".$this->Oracle_Home); 

			$tnsString = $this->dbUser."@".$this->dbName;

			$this->ConectionHandle = ora_logon($tnsString,$this->dbPass);

			if ($this->ConectionHandle==0) {
				$this->isConected	= false;
				$this->errorMessaje	= "Problemas al Conectarse a la Base de Datos PosgreSQL";
	
				echo "drama!!";
	
				return(false);
			}

			ora_commitOn($this->ConectionHandle);
			
			$this->isConected = true;
			return(true);
		}

		function close() {
			ora_logoff($this->ConectionHandle);
	//		$this->ConectionHandle 	= 0;
			$this->isConected	= false;

		}

		function executeQuery($sqlString) {

			if ($this->isConected) {

				$this->resultHandle = ora_open($this->ConectionHandle);

				if ($this->resultHandle==0) {
					$this->errorMessaje = "Error al ejecutar la Query";
				}

				if (ora_parse($this->resultHandle,$sqlString,0)) {

					if (ora_exec($this->resultHandle)) {

						if (ora_fetch($this->resultHandle)) {
							return($this->resultHandle);
						}
						$this->errorMessaje = "No se pudo Hacer el Fetch";
						return($this->resultHandle);
					}
					$this->errorMessaje = "No se pudo ejecutar la query";
					return(null);

				}
				$this->errorMessaje = "error en el parseo de la query";
				return(null);

			} else {
				$this->errorMessaje	= "No se ha conectado a la base de datos cuando se trato de realizar una query";
				return(null);
			}
			return($this->resultHandle);
		}

		function getRows() {

			if ($this->resultHandle!=0) {
				$data = array(); 
				
				for($i=0;$i<$this->numRows();$i++) {

					$row = array();
					
					for($j=0;$j<$this->numFields();$j++) {
						$row[] = ora_getColumn($this->resultHandle,$j);
					}
					$data[] = $row;
				}
				return($data);
			} else {
				$this->errorMessaje	= "No existen registros en memoria para entregar";
				return(0);
			}
		}

		function numRows() {

			if ($this->resultHandle !=0) {
				return(ora_numrows($this->resultHandle));

			} else {
				$this->errorMessaje	= "No existen registros en memoria para entregar";
				return(-1);
			}
		}

		function numAffectedRows() {
			if ($this->resultHandle!=0) {
				return(ora_numrows($this->resultHandle));
			} else {
				$this->errorMessaje	= "No hay registros consultados, por lo tanto no hay registros afectados";
				return(-1);
			}
		}

		function numFields() {

			if ($this->resultHandle !=0) {
				return(ora_numcols($this->resultHandle));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}

		function fieldName($fieldnumber) {

			if ($this->resultHandle !=0) {
				return(ora_columnname($this->resultHandle,$fieldnumber));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}

		function fieldType($fieldnumber) {

			if ($this->resultHandle !=0) {
				return(ora_columntype($this->resultHandle,$fieldnumber));

			} else {
				$this->errorMessaje	= "No existe una query para obtener los campos";
				return(-1);
			}
		}


	}

?>