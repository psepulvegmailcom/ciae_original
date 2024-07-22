<?php

	
	class PersistentObjectXML 
	{

		var $id;
		var $newObject;
		var $xml;
		var $sourceTable = 'empty';

		function PersistentObjectXML($sourceTable='') 
		{ 			
			/* Datos propios del objeto */
			$this->newObject	= true; 			 
			if(trim($sourceTable) != '')
				$this->sourceTable = $sourceTable;
			$this->sourceTable .= '.xml';
			$this->dbPath 			= VarSystem::getPathVariables('path_xml').VarConfig::dbname.'/'; 
			$this->setFile();			
		} 

		private function setFile()
		{
			if (file_exists($this->dbPath.$this->sourceTable)) 
			{
				$this->xml = simplexml_load_file($this->dbPath.$this->sourceTable);
				return true;
			}
			else
			{
				$this->errorMessaje	= "XML : No se encuentra el archivo solicitado";
				//echo $this->errorMessaje;
				Funciones::showErrorMsg($this->errorMessaje);
				return(null);
			}
		}

		function getNameObject()
		{
			$child = $this->xml->children();
			return $child->getName();
		}

		function saveObject($condition="") 
		{
			/* OBTENCION DE LOS CAMPOS DE LA CLASE*/			
			$fieldsNames	= array_keys(get_object_vars($this));
			$fieldsValues	= get_object_vars($this);
			$fieldArray		= array();

			$element = $this->xml->addChild($this->getNameObject());

			for($i=0;$i<sizeof($fieldsNames);$i++) 
			{
				if (!is_array($fieldsValues[$fieldsNames[$i]])) {				
					if ($fieldsNames[$i]!="xml" && $fieldsNames[$i]!="newObject" && $fieldsNames[$i]!="sourceTable" && $fieldsNames[$i]!="Id" && $fieldsNames[$i]!="id") 
					{  
						$element->addChild($fieldsNames[$i],$fieldsValues[$fieldsNames[$i]]); 
					}
				}
			} 
			$this->saveXML();
		} 

		function saveXML()
		{
			$nombre_archivo = $this->dbPath.$this->sourceTable;
			if (is_writable($nombre_archivo)) 
			{
			    if (!$gestor = fopen($nombre_archivo, 'w')) {
			         echo "No se puede abrir el archivo ($nombre_archivo)";
			         exit;
			    }

			    // Escribir $contenido a nuestro arcivo abierto.
			    if (fwrite($gestor, $this->xml->asXML()) === FALSE) {
			        echo "No se puede escribir al archivo ($nombre_archivo)";
			        exit;
			    }
 
			    fclose($gestor);

				} 
				else {
							    echo "No se puede escribir sobre el archivo $nombre_archivo";
				}
		}
 

		function loadObject($queryString,$ociQueryString="") {

			if ($this->sourceTable!="") {
				$dbHandle = new dbLogic($this->dbHost,$this->dbName,$this->dbUser,$this->dbPass);

				if ($dbHandle->errorMessaje!="") {
	
					echo $dbHandle->errorMessaje;
	
					return(false);
				} 
				else 
				{	
					$sql = "SELECT * FROM ".$this->sourceTable." WHERE ".$queryString.";";
					//Funciones::mostrarDebug("LoadObject",$sql);
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
	}
?>
