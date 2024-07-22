<?php
include "pgsql.inc";  /* Incluir la interfaz de manejo de la Base de Datos */
include "oracle.inc";
include "mysql.inc"; 
include "Resultset.inc";

/**
* Logica de Base de Datos 
*
* Esta clase hace de interfaz de segunda capa entre el controlador de la base de datos
* y el objeto logico que representa la entidad de la base de datos.
*                                       
* Esta clase esta capacidata para trabajar con bases de datos posgreSQL y Oracle 8i
* 
*/

class dbLogic {
		
	/**
	* @var DBDriver 
	* #access private
	*/
	var $dbDriver;

	/**
	* @var string
	* #access private
	*/
	var $errorMessage;


	/**
	* Constructor 
	*
	* @param string host donde recide la base datos. Puede ser un IP o un nombre  
	* @param string nombre de la base de datos
	* @param string nombre de usuario usado para conectarse a la base de datos
	* @param string password del usuario para ingresar a la db 
	* @param string driver a utilizar: pgsql para postgreSQL, oci8 para Oracle 8i
	*/

	function dbLogic($host,$db,$user,$pass,$driver="xml") 
	{  
		$driver = VarConfig::bdtype;
		if ($driver=="pgsql" ) {
			$this->dbDriver = new dbDriver_pgsql($host,$db,$user,$pass);
		}
		if ($driver=="oracle" || $driver=="oci8") {
			$this->dbDriver = new dbDriver_oci($host,$db,$user,$pass);
		}
		if ($driver=="mysql" ) {
			$this->dbDriver = new dbDriver_mysql($host,$db,$user,$pass);
		} 
		if ($driver=="xml" ) {
			$this->dbDriver = new dbDriver_xml($db);
		} 
	}


	/**
	* Agrega un registro a la tabla indicada. 
	*
	* @param string nombre de la tabla
 	* @param array arreglo con los datos a ingresar a la tabla, este arreglo debe ser del tipo array("campo","valor").
	* por ejemplo en una tabla de 2 campos, c1 y c2, el arreglo a entregar a esta funcion debe ser:
 	* $data_array = array(array("c1","datos de c1"),array("c2","datos de c2"));
	* @return boolean 
	*/
	function addRecord($table,$data_array,$tipoSql='INSERT') {

		if ($this->dbDriver->connect()) 
		{ 
			$fields = "(";
			$values	= "(";

			for($i=0;$i<sizeof($data_array);$i++) 
			{ 

				$formated_data= $data_array[$i][1];

				if (is_date($data_array[$i][1])) {
					$formated_data="DATE '". datetostr($data_array[$i][1])."'";
				} else {
					if (is_string($data_array[$i][1])) {
						$fieldValue = " ";
						if ($data_array[$i][1]!="") {
							$fieldValue = $data_array[$i][1];
						}
						$formated_data="'".Funciones::cleanLastSql($fieldValue)."'";
					} 
				}
				if (trim($formated_data)!="") {
					$fields=$fields . $data_array[$i][0] . ",";
					$values=$values . $formated_data . ",";
				}
			}

			$fields	= substr($fields,0,strlen($fields)-1) . ")";
			$values	= substr($values,0,strlen($values)-1) . ")"; 

			$sqlToUpdate = $tipoSql." INTO $table $fields VALUES $values;";
			
			$sqlstatus   = $this->dbDriver->executeQuery($sqlToUpdate);
			$lastId      = $this->getNextId($table); //$this->dbDriver->getLastId($table);
			$lastId--;
					
			/***************************************************************************************/
			if(VarConfig::estadoDebugSQLModify)
			{
				Funciones::mostrarArreglo(" DEBUGSQL: ".$sqlToUpdate); 
			}
			Funciones::registroModificacionBase('sql-insert',$sqlToUpdate); 
			/***************************************************************************************/
				
			$this->dbDriver->close();

			if ($sqlstatus!=0) 
			{
				return($lastId);
			} else {
				$this->errorMessaje = "Error al Insertar Registro en la tabla ".$table.".";
				return(false);
			}
		} 
		else 
		{
			global $DBName;
			$this->errorMessaje =  "Problemas al conectarse a la Base de Datos ".VarConfig::dbname.".";
		}

	}

	/**
	* actualiza un registro a la tabla indicada. 
	*
	* @param string nombre de la tabla
 	* @param array arreglo con los datos a modificar en la tabla, este arreglo debe ser del tipo array("campo","valor").
	* por ejemplo en una tabla de 2 campos, c1 y c2, el arreglo a entregar a esta funcion debe ser:
 	* $data_array = array(array("c1","datos de c1"),array("c2","datos de c2"));
	* @param string condicion de busqueda de la forma campo='algo', esta condicion debe seleccionar los registros que se desean modificar
	* @return boolean 
	*/
	function updateRecord($table,$data_array,$where_string) {

		$updateString = "";	
		for($i=0;$i<sizeof($data_array);$i++) {
			
			$formated_data=$data_array[$i][1];
			if (is_date($data_array[$i][1])) {

				$formated_data="DATE '". datetostr($data_array[$i][1])."'";
			} else {

				if (is_string($data_array[$i][1])) {
					$formated_data="'". Funciones::cleanLastSql($data_array[$i][1] )."'"; 
				} 
			}

			if (trim($formated_data!="")) {
				$updateString=$updateString . $data_array[$i][0] . "=" . $formated_data . ",";
			}
		}

		
		$updateString	= substr($updateString,0,strlen($updateString)-1); 
		$sqlToUpdate	= "UPDATE $table SET $updateString WHERE $where_string;";
		
		/***************************************************************************************/
		if(VarConfig::estadoDebugSQLModify)
			Funciones::mostrarArreglo(" DEBUGSQL: ".$sqlToUpdate);  
		Funciones::registroModificacionBase('sql-update',$sqlToUpdate);  
		/***************************************************************************************/

		if ($this->dbDriver->connect())
		{
			if ($this->dbDriver->executeQuery($sqlToUpdate)) 
			{
				$this->dbDriver->close();
				return(true);
			} 
			else
			{
				$this->dbDriver->close();
				$this->errorMessaje =  "Error al Realizar el Update del Registro en la tabla ".$table.". <!-- $sqlToUpdate -->";
				//echo $this->errorMessaje;
				Funciones::showErrorMsg($this->errorMessaje);
				return(false);
			}
		} 
		else {
			$this->errorMessaje = "no se pudo conectar al motor de bases de datos";
				//echo $this->errorMessaje;
				Funciones::showErrorMsg($this->errorMessaje);
			return(false);
		}
	}

	/**
	* elimina un registro a la tabla indicada. 
	*
	* @param string nombre de la tabla
	* @param string condicion de busqueda de la forma campo='algo', esta condicion debe seleccionar los registros que se desean eliminar 
	* @return boolean 
	*/

	function deleteRecord($table,$strCondition) 
	{
		if ($this->dbDriver->connect()) 
		{
			$sql		= "DELETE FROM $table WHERE $strCondition;";		
			$sqlStatus	= $this->dbDriver->executeQuery($sql);

			if (($this->dbDriver->numAffectedRows())==0) 
			{
				$this->dbDriver->close();
				return(false);
			} 
			else
				Funciones::registroModificacionBase('sql-delete',$sql);
			$this->dbDriver->close();

			
			/***************************************************************************************/
			if(VarConfig::estadoDebugSQLModify)
				Funciones::mostrarArreglo(" DEBUGSQL: ".$sql);  			 
			/***************************************************************************************/ 
			return(true);
		}					
	}

	/**
	* Solo para tablas con sequencias autonumeradas (SERIAL) 
	* Entrega el siguiente id de la serie en sequencia definida.
	*
	* @param string nombre de la tabla
	* @return int 
	*/

	function getNextId($table,$nameid='id') 
	{
		$sql = "SHOW INDEX FROM $table";
		$resultSetTable = $this->query($sql);
		
		if ($resultSetTable!=0) 
		{
			$responseTable = $resultSetTable->getCurrentRow();
			$nameid = $responseTable["Column_name"];
		}	
		$sql = "SELECT max(LAST_INSERT_ID(".$nameid.")) as nextid FROM $table;";
		
		$resultSet = $this->query($sql);
		
		if ($resultSet != 0) 
		{
			$response = $resultSet->getCurrentRow();
			$nextid = $response["nextid"]+1;
			//Funciones::mostrarDebug("getNextId",array($sql,$nextid));
			return($nextid);
		} 	
		return("");
	}

	/**
	* Ejecuta una query o consulta sobre la Base de datos 
	*
	* @param string sentencia SQL donde se especifica la query a realizar. 
	* @return Resultset
	*/

	function query($sql)
	{		
		if ($this->dbDriver->connect()) 
		{
			Funciones::mostrarArreglo($sql,false);
			$this->dbDriver->executeQuery($sql);
			$queryResultSet = new Resultset($this->dbDriver);
			$this->dbDriver->close();
			return($queryResultSet);
		} 
		else
		{
			$this->errorMessaje = "dbLogic(query):".$this->dbDriver->errorMessaje;
			//echo $this->errorMessaje;
			Funciones::showErrorMsg($this->errorMessaje);
			$this->dbDriver->close();
			return(null);
		}
	}

	/**
	* Entrega un arreglo con los campos de la tabla especificada
	*
	* @param string nombre de la tabla
	* @return array
	*/

	function getFields($table) 
	{
		if ($this->dbDriver->connect()) 
		{
			if ($this->dbDriver->executeQuery("SELECT * FROM $table LIMIT 1")) {
				$fields = array();
				for($i=0;$i<$this->dbDriver->numFields();$i++) {
					$fields[] = array($this->dbDriver->fieldName($i),$this->dbDriver->fieldType($i));
				}
				$this->dbDriver->close();
				return($fields);
			} else {
				$this->errorMessaje = "dbLogic(getFields):".$this->dbDriver->errorMessaje;
				$this->dbDriver->close();
				return(0);
			}
		} 
		else 
		{
			$this->errorMessaje = "dbLogic(getFields):".$this->dbDriver->errorMessaje;;
			$this->dbDriver->close();
			return(0);
		}
	}

	function getPrimaryKey($table)
	{
		if ($this->dbDriver->connect()) 
		{ 
			if ($this->dbDriver->executeQuery("SHOW INDEX FROM $table ")) {
				$fields = array();
					Funciones::mostrarArreglo($this->dbDriver->fieldName);
				for($i=0;$i<$this->dbDriver->numFields();$i++) {
					$fields[] = array($this->dbDriver->fieldName($i),$this->dbDriver->fieldType($i));
				}
				$this->dbDriver->close();
				return($fields);
			} else {
				$this->errorMessaje = "dbLogic(getFields):".$this->dbDriver->errorMessaje;
				$this->dbDriver->close();
				return(0);
			}
		}
		else 
		{
			$this->errorMessaje = "dbLogic(getFields):".$this->dbDriver->errorMessaje;;
			$this->dbDriver->close();
			return(0);
		}
	}

}

?>
