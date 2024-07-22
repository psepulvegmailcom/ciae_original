<?php

	/****************************************
	 * XML DataBase Driver                *
	 * Octubre,2008                       * 
	 * Paulina Sepúlveda                       *
	 * Version 1.0                          *
	 ***************************************/

	class dbDriver_xml {

		var $dbName;
		var $dbPath;
		var $ConectionHandle;
		var $resultHandle;
		var $errorMessaje;
		var $isConected;

		var $lastId;

		/* Construtor */	
		function dbDriver_xml($db)
		{
			$this->dbName			= $db; 
			$this->dbPath 			= VarSystem::getPathVariables('path_xml').'/'.$db.'/';
			$this->isConected		= false;
			$this->ConectionHandle	= 0;
		}

		/* Methods */

		function connect() 
		{
			if(file_exists($this->dbPath) && is_dir($this->dbPath))
			{
				$this->isConected = true;
				return(true);
			}
			else 
			{
				$this->isConected	= false;
				$this->errorMessaje	= "Problemas al Conectarse a la Base de Datos XML";		
				return(false);
			} 
		}

		function close() 
		{ 
			$this->isConected	= false;
		} 

		function getXMLObject($xmlfile)
		{
			$this->xmlfile = $xmlfile;
			if (file_exists($this->xmlfile)) 
			{
				$xml = simplexml_load_file($this->dbPath.$this->xmlfile);
				return $xml;
			}
			else
			{
				$this->errorMessaje	= "XML : No se encuentra el archivo solicitado";
				//echo $this->errorMessaje;
				Funciones::showErrorMsg($this->errorMessaje);
				return(null);
			} 
		}

		function executeQuery()
		{

		}

		function getRows()
		{

		}
		function numRows() 
		{

		}
	}

?>
