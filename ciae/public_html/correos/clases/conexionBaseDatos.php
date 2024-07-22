<?php


	class ConexionBaseDatos 
	{
		private $pdo;  
		private $funciones;
		private $host;
		private $db;
		private $userdb;
		private $passdb;	
		private $caso;

		public function __CONSTRUCT($caso='')
		{ 		
			$this->funciones = new FuncionesGenerales();
			$this->caso = $caso;
			$this->casosConexion();
			try{
				$this->pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->userdb, $this->passdb); 	 
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
				$this->funciones->outputDebug("[DEBUG] conectada base de datos");
			}
			catch(Exception $e){ 
				$this->funciones->outputDebug("[ERRROR] NO conectada base de datos.");
				die($e->getMessage());
			} 
		}  
		
		public function casosConexion()
		{	  				
			$this->host 	= HOST; 
			$this->db 		= DB_LOCAL;
			$this->userdb 	= USERDB;
			$this->passdb 	= PASSDB;				 
			 
		}

		public function connect()
		{
			return $this->pdo;
		}  

		public function ejecutarQuery($sql)
		{ 
			if($this->caso == 'DB_LOCAL')
			{
				$this->funciones->outputDebug($sql);	
				try
				{				
					$count = $this->pdo->exec($sql);
					$this->funciones->outputDebug("[Ejecución SQL] ".$sql." | Filas ".$count." afectadas");	
					return true;			
				} 
				catch (PDOException $pdoException)
				{
					$this->funciones->outputDebug(var_export($pdoException->getMessage()));	
					$this->funciones->outputDebug(var_export($pdoException->getTraceAsString()));	
					return false;
				} 
			}
			else
			{				
				$this->funciones->outputDebug("[ERROR bloqueado edición BD remotas] ".$this->caso);
			}
		} 

		public function obtenerDatos($sql, $debug=false)
		{
			$output = array();
			//$this->funciones->outputDebug($sql);	
			try
			{  
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute(); 
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				// and somewhere later:
				foreach ($data as $row) {
					$output[] = $row;
				}
				$this->funciones->outputDebug("[Consulta SQL] ".$sql,"[CONSULATonsulta SQL]");
				if($debug)
					$this->funciones->outputDebug($output);				
			} 
			catch (PDOException $pdoException)
			{
				$this->funciones->outputDebug(var_export($pdoException->getMessage()));	
				$this->funciones->outputDebug(var_export($pdoException->getTraceAsString()));	
			}			
			return $output;
		} 

		public function vaciarTabla($tabla)
		{ 
			if($this->caso == 'DB_LOCAL')
			{				
				$sql = "TRUNCATE ".$tabla;
				$this->ejecutarQuery($sql);
			}
			else
			{				
				$this->funciones->outputDebug("[ERROR Truncate bloqueado BD remotas] ".$this->caso);
			}
		} 		 
	}
?>