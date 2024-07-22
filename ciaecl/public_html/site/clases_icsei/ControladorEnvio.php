<?PHP

	/**  InscripcionEnvioDecision */
	class InscripcionEnvioDecision extends PersistentObject
	{	
		var $sourceTable = "site_envio_decision";
		
		function InscripcionEnvioDecision()
		{
			parent::PersistentObject();
		} 	 
	}

	/** INSCRIPCION ENVIO */
	class InscripcionEnvio extends PersistentObject
	{	
		var $sourceTable = "site_envio";
		
		function InscripcionEnvio()
		{
			parent::PersistentObject();
		}

		function guardar()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("id_envio='".$this->id_envio."'");
			}
			else
			{				 
				$this->fecha = time();
				$this->saveObject();
			}
		}	 
	}	 

	class InscripcionEnvioAutor extends PersistentObject
	{	
		var $sourceTable = "site_envio_autores";
		
		function InscripcionEnvioAutor()
		{
			parent::PersistentObject();
		}  	 
	}		
	
	class EnviosEvaluador extends PersistentObject
	{
		var $sourceTable = "site_usuario_envio";
		
		function EnviosEvaluador()
		{
			parent::PersistentObject();
		} 
	} 	 
	
	class ControladorEnviosEvaluador extends ControladorDeObjetos
	{
		function ControladorEnviosEvaluador() 
		{ 
			/** CONECCION INTERNA*/		
			$this->obj 				= new EnviosEvaluador();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_envio';
			parent::ControladorDeObjetos();
		}
		
		function obtenerListado($id_envio)
		{
			$table = $this->sourceTable;
			$where = "id_envio = ".$id_envio;
			$order = "username";
			return parent::getArrayObjects($table,$where,$order) ;
		}
	}

	class ControladorInscripcionEnvioAutores extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorInscripcionEnvioAutores() 
		{ 
			/** CONECCION INTERNA*/		
			$this->obj 				= new InscripcionEnvioAutor();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_envio';
			parent::ControladorDeObjetos();
		}  
		
		function obtenerListado($id_envio=0)
		{	        
			$Pais = new Pais();
			$where = ' WHERE  e.pais = p.pais_id ';
			if($id_envio != 0)
			{
				$where  = ' WHERE     e.id_envio =   "'.$id_envio.'" ';
			}
			$query = 'SELECT    e.*, p.pais_en as pais     
					FROM '.$this->sourceTable.' AS e   LEFT JOIN  '.$Pais->sourceTable.' as p ON  e.pais = p.pais_id 
					'.$where.'
					ORDER BY  e.id_envio ASC'; //, e.apellido ASC
			return parent::getQuery($query); 
		} 		
	}	
	
	class ControladorInscripcionEnvioDecision extends ControladorDeObjetos
	{
		var $obj; 
		function ControladorInscripcionEnvioDecision() 
		{ 
			/** CONECCION INTERNA*/	
			$this->obj 				= new InscripcionEnvioDecision();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_envio';
			parent::ControladorDeObjetos();
		} 
	}
	
	class ControladorInscripcionEnvio extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorInscripcionEnvio() 
		{ 
			/** CONECCION INTERNA*/	
			$this->obj 				= new InscripcionEnvio();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_envio';
			parent::ControladorDeObjetos();
		}  
		
		function obtenerListado($id_envio=0,$estado='',$usuario='')
		{	     
			$EnvioBloqueAsignacion = new EnvioBloqueAsignacion(); 
			
			$where = '';
			if($id_envio != 0)
			{
				$where = ' AND e.'.$this->key.' = '.$id_envio;
			}
			if(trim($estado) != '')
			{
				$where .= " AND e.estado = '".$estado."'";
			}	 
			if(trim($where) != '')
			{
				$where = " AND ".$where;
			}
			$InscripcionEnvioDecision = new InscripcionEnvioDecision();
			$query = '
			SELECT a.*, b.tipo_bloque as estado_programa
			FROM (
					SELECT    e.* ,  DATE_FORMAT( FROM_UNIXTIME( e.fecha ) , "%Y-%m-%d %H:%i:%s" ) as fecha_envio   , a.decision_estado
					FROM '.$this->sourceTable.' AS e  , '.$InscripcionEnvioDecision->sourceTable.' as a 
					WHERE a.id_envio = e.id_envio '.$where.') as a LEFT JOIN '.$EnvioBloqueAsignacion->sourceTable.'  as b  ON a.id_envio = b.id_envio  
					ORDER BY  a.estado ASC,  a.fecha ASC'; 
					
			//echo $query;
			return parent::getQuery($query); 
		} 	 
		
		function obtenerListadoEvaluador($usuario)
		{	       
			$EnviosEvaluador = new EnviosEvaluador();
			$query = 'SELECT    e.* ,  DATE_FORMAT( FROM_UNIXTIME( e.fecha ) , "%d-%m-%Y %H:%i:%s" ) as fecha_envio   
					FROM '.$this->sourceTable.' AS e   , '.$EnviosEvaluador->sourceTable.' as a
					WHERE   e.id_envio = a.id_envio AND e.estado = "active"  AND a.username = "'.$usuario.'"
					ORDER BY  e.estado ASC,  e.fecha ASC'; 
			return parent::getQuery($query); 
		} 
	}	 
	
	class ControladorConsultasGeneral  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorConsultasGeneral() 
		{ 
			/** CONECCION INTERNA*/	
			$this->obj 				= new PersistentObject();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_envio';
			parent::ControladorDeObjetos();
		}  
		
		function obtenerEnvios($estado='')
		{
			$InscripcionEnvio = new InscripcionEnvio();
			$sql = "  SELECT *
				FROM ".$InscripcionEnvio->sourceTable;
			if(trim($estado) != '')	
				$sql .= "	WHERE `estado` =   '".$estado."'  ";
			$sql .= " ORDER BY estado"; 
			$result = parent::getQuery($sql); 
			return $result; 
		}  
		
		function obtenerEnvio($id)
		{
			$InscripcionEnvio = new InscripcionEnvio();
			$sql = "  SELECT *
				FROM ".$InscripcionEnvio->sourceTable."
				WHERE id_envio = ".$id." "; 
			$result = parent::getQuery($sql); 
			return $result;
		} 
		
		function revisoresEnvios()
		{
			$InscripcionEnvio 	= new InscripcionEnvio();
			$EnviosEvaluador	= new EnviosEvaluador();
			$sql = " SELECT  DISTINCT  a.id_envio, b.username
				FROM ".$InscripcionEnvio->sourceTable." as a  LEFT JOIN ".$EnviosEvaluador->sourceTable." as b ON a.id_envio = b.id_envio
				WHERE a.estado = 'active'  
				ORDER BY a.id_envio"; 
			$result = parent::getQuery($sql); 
			return $result;	
		}
	}
?>