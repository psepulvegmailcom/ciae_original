<?php 

	class InscripcionTotal extends PersistentObject
	{
		var $sourceTable = "site_inscripcion_total";
		function InscripcionTotal()
		{
			parent::PersistentObject();
		} 
	}
	
	class InscripcionBaseTipo extends Objetos
	{
		var $sourceTable = "`ciaecl_correoweb`.`base_datos_email_tipo`";
		function InscripcionBaseTipo()
		{
			parent::Objetos();
			$this->dbKey = 'email';
		} 			  	 
	} 
	
	class InscripcionBase extends Objetos
	{
		var $sourceTable = "`ciaecl_correoweb`.`base_datos_email`";
		function InscripcionBase()
		{
			parent::Objetos();
			$this->dbKey = 'email';
		} 			  	 
	} 

	class ControladorInscripcionBase  extends ControladorDeObjetos
	{
		var $obj; 
		function ControladorInscripcionBase() 
		{ 
			/* CONECCION INTERNA */	
			$this->obj 				= new InscripcionBase();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}  
		
		function insertarContacto($nombre,$email)
		{ 
			$this->obj->buscarObjeto($email);
			$this->obj->email 			= $email;
			$aux = explode(" ",ucwords(strtolower($nombre)));
			$this->obj->nombre 			= $aux[0];
			unset($aux[0]);
			$apellidos = implode(' ',$aux);
			$this->obj->apellidos			= $apellidos;
			$this->obj->guardarObjeto($email);
			
			$InscripcionBaseTipo = new InscripcionBaseTipo();
			$InscripcionBaseTipo->email = $email;
			$InscripcionBaseTipo->tipo_base = 'ciae_general_contacto';
			$InscripcionBaseTipo->guardarObjeto(); 
		}
		
		function insertarNuevaInscripcion($Inscripcion,$lista=array())
		{
			$Inscripcion->email = trim($Inscripcion->email);
			$this->obj->buscarObjeto($Inscripcion->email);

			if($this->obj->newObject)
			{
				$this->obj->creacion_fecha = date('Y-m-d H:i:s');
				$this->obj->creacion_lista = 'ciae_inscripciones_'.$Inscripcion->tipo_inscripcion;
			}  

			$this->obj->email 			= trim($Inscripcion->email);
			$this->obj->nombre 			= $Inscripcion->nombre;
			$this->obj->apellidos 		= $Inscripcion->apellidos;
			$this->obj->genero	 		= $Inscripcion->genero;
			$this->obj->rut				= $Inscripcion->rut;
			$this->obj->rut_dv			= $Inscripcion->rut_dv;
			$this->obj->cargo_posicion	= $Inscripcion->cargo;
			$this->obj->actividad		= $Inscripcion->actividad;
			$this->obj->institucion		= $Inscripcion->institucion;
			$this->obj->direccion		= $Inscripcion->direccion;
			$this->obj->comuna			= $Inscripcion->comuna;
			$this->obj->region			= $Inscripcion->region;
			$this->obj->ciudad			= $Inscripcion->ciudad; 
			$this->obj->pais_id			= $Inscripcion->pais;
			$this->obj->tratamiento		= $Inscripcion->tratamiento;
			$this->obj->telefono		= $Inscripcion->telefono_movil;
			$this->obj->telefono2		= $Inscripcion->telefono;		
			$this->obj->guardarObjeto($this->obj->email); 
			
			$InscripcionBaseTipo = new InscripcionBaseTipo();
			$InscripcionBaseTipo->email = $this->obj->email;
			
			$InscripcionBaseTipo->tipo_base = 'ciae_inscripciones_'.$Inscripcion->tipo_inscripcion;
			$InscripcionBaseTipo->guardarObjeto();
			
			if(count($lista) > 0)
			{
				for($i=0; $i < count($lista);$i++)
				{
					$InscripcionBaseTipo = new InscripcionBaseTipo();
					$InscripcionBaseTipo->email = $this->obj->email;
					$InscripcionBaseTipo->tipo_base = $lista[$i];
					$InscripcionBaseTipo->guardarObjeto();					
				}
			}
		}
	}	
	
	class EventosInforme extends PersistentObject
	{
		var $sourceTable = "site_eventos_informe";
		function EventosInforme()
		{
			parent::PersistentObject();
		} 
		
		function obtenerOpcion($opcion)
		{
			parent::loadObject("inscripcion_opcion_menu = '".$opcion."'"); 
		}		
		
		function guardarOpcion($opcion)
		{
			parent::saveObject("inscripcion_opcion_menu = '".$opcion."'"); 
		}		
	}
	

	
	/* CONTROLADOR DE EVENTOS INFORME */
	class ControladorEventosInforme  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorEventosInforme() 
		{ 
			/* coneccion interna*/	
			$this->obj 				= new EventosInforme();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}  
		
		function obtenerOpcionMenu($opcion)
		{
			$this->where = " inscripcion_opcion_menu = '".$opcion."' ";
			return parent::getArrayObjects($this->sourceTable,$this->where);
		}
		
		function actualizarTotalInscritos($opcion,$tipo_inscripcion)
		{			
			$aux_caso 	= explode("_",$tipo_inscripcion);
			$caso 		= end($aux_caso); 
			$tipo_inscripcion_aux = $tipo_inscripcion;
			
			//echo $caso.'<br>';
			if($caso == 'presencial' || $caso == 'online')
			{
				$tipo_inscripcion = str_replace('_'.$caso,'',$tipo_inscripcion); 
			}
			else
			{
				$caso = 'presencial';
			}				 
			// echo $caso.' '.$opcion.' '.$tipo_inscripcion.'<br>';
			$InscripcionTotal = new InscripcionTotal();
			$sql = "UPDATE ".$this->sourceTable." SET total_inscritos_".$caso." = 
						(SELECT total
						FROM ".$InscripcionTotal->sourceTable."
						WHERE tipo_inscripcion = '".$tipo_inscripcion_aux."') 
					WHERE inscripcion_opcion_menu = 'view_inscripcion_".$opcion."' AND id_inscripcion = '".$tipo_inscripcion."'";	
			//echo "<!-- ".$sql." -->";	
			return parent::getQuery($sql); 					
		}
	}
	
	
	/** INSCRIPCION */
	class Inscripcion extends PersistentObject
	{	
		var $sourceTable = "site_inscripcion";
		
		function Inscripcion()
		{
			parent::PersistentObject();
		}

		function guardar($email_nuevo='')
		{
			if(!$this->newObject)
			{ 
				$email = $this->email;
				if(trim($email_nuevo) != '')
				{
					$this->email = $email_nuevo;
				}
				$this->saveObject("email='".$email."'  AND tipo_inscripcion = '".$this->tipo_inscripcion."'");
			}
			else
			{				 
				$this->fecha = time();
				$this->saveObject();
			}
		}	
		
		function consultaEmail($email)
		{
			$this->loadObject("email ='".$email."' ORDER BY fecha_actualizacion DESC");
		}	 
		
		function consultaInscripcion($email,$inscripcion)
		{
			$this->loadObject("email ='".$email."' AND tipo_inscripcion = '".$inscripcion."'");
		}	 
		
		function consultaInscripcionRut($rut,$inscripcion)
		{
			$this->loadObject("rut ='".$rut."' AND tipo_inscripcion LIKE '".$inscripcion."' ORDER BY inicia_rendicion_estado_asistencia");
		}	 
		
		function consultaInscripcionSoloRut($rut)
		{
			$this->loadObject("rut ='".$rut."'  ORDER BY fecha_actualizacion DESC");
		}	 
		
		function consultaInscripciones($email,$inscripciones)
		{
			$where = "email ='".$email."' AND (";
			for($i=0; $i < count($inscripciones); $i++)
			{
				if($i > 0)
				{
					$where .= " OR ";
				}
				$where .= " tipo_inscripcion = '".$inscripciones[$i]."'" ;
			}
			$where .= ") ORDER BY fecha DESC ";
			$this->loadObject($where);
		}	
		
		function confirmarParticipacion()
		{
			$this->confirmacion = 'confirmado';	
			$this->guardar();
		}
	}
	 
	
	class EnvioInscripcion extends Inscripcion
	{
		var $sourceTable = "site_inscripcion_envio";
		
		function EnvioInscripcion()
		{
			parent::Inscripcion();
		} 
		function obtenerEnvio($id_envio)
		{
			$this->loadObject("id_envio ='".$id_envio."'");
		}	
		function guardarEnvio()
		{
			if(!$this->newObject)
			{ 
				$this->saveObject("id_envio='".$this->id_envio."'");
			}
			else
			{				  
				$this->saveObject();
			}
		}				
	} 

	class ControladorEnvioInscripcion  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorEnvioInscripcion() 
		{ 
			/* CONECCION INTERNA*/	
			$this->obj 				= new EnvioInscripcion();
			$this->sourceTable 		= $this->obj->sourceTable;
			$this->key 				= 'id_envio';
			parent::ControladorDeObjetos();
		}    
		
		function obtenerListado($id_envio=0,$id_area='')
		{	 
			$Inscripcion = new Inscripcion();
			$Areas = new Areas(); 
			
			if($id_envio != 0)
			{
				$where = ' AND e.'.$this->key.' 	 = '.$id_envio;
			}	
			if(trim($id_area) != '')
			{
				$where .= ' AND e.estado = "activo" AND a.id_area = '.$id_area;
			}
			$query = 'SELECT  i. *, i.comentario as comentario_autor, e.*, e.comentario as comentario_interno,  DATE_FORMAT( FROM_UNIXTIME( e.fecha ) , "%d-%m-%Y %H:%i:%s" ) as fecha_envio ,a. *  
					FROM '.$this->sourceTable.' AS e, '.$Inscripcion->sourceTable.' AS i, '.$Areas->sourceTable.' as a   
					WHERE   i.email = e.email AND a.id_area= e.area '.$where.'
					ORDER BY  e.estado ASC, e.titulo ASC, i.apellidos asc, i.nombre ASC,e.estado ASC,e.fecha ASC';
			// Funciones::mostrarArreglo($query);		
			return parent::getQuery($query); 
		}
	} 	

	/* CONTROLADOR DE INSCRIPCION */
	class ControladorInscripcion  extends ControladorDeObjetos
	{  
		var $obj; 
		function ControladorInscripcion() 
		{ 
			/* coneccion interna*/	
			$this->obj 				= new Inscripcion();
			$this->sourceTable 		= $this->obj->sourceTable;
			parent::ControladorDeObjetos();
		}   
		
		function InscripcionEspecialSistemaTareaPares($nombre,$apellido,$email,$seminario)
		{
			$email = trim($email);
			$PersonaObjetos = new PersonaObjetos();
			$Usuario = new Usuario();
			$UsuarioSeminario = new UsuarioSeminario();
			/* INSERCION ESPECIAL PARA QUE SE INGRESEN AL SISTEMA DE LENGUAJE DE SEMINARIO MINEDUC-CIAE */
			$sql = "REPLACE INTO `ciaecl_eval`.`".$PersonaObjetos->sourceTable."` 
			(  `user_id`, `nombre`, `apellido_paterno`,   `email`)  
			VALUES ('".md5($email)."', '".$nombre."', '".$apellido."',   '".$email."'); ";
 			parent::getQuery($sql);
		//	echo $sql.'<br>'; 
			$sql = "REPLACE INTO `ciaecl_eval`.`".$Usuario->sourceTable."` 
			(`user_id`, `username`, `password`, `perms`, `activo`) 
			VALUES ('".md5($email)."', '".$email."', '".md5($email)."', '3', 1); ";
			parent::getQuery($sql); 
			//echo $sql.'<br>';
			$sql = "REPLACE INTO `ciaecl_eval`.`".$UsuarioSeminario->sourceTable."` 
			(`user_id`,    `seminario`) 
			VALUES ('".md5($email)."', '".$seminario."'); ";
			//echo $sql.'<br>';
			parent::getQuery($sql); 
		}  

		function obtenerListadoActivo($email='')
		{
			$order = ' fecha ASC, apellidos, nombre'; 
			$where = " activo = 1  ";  	 
			if(trim($email) != '')
			{
				$where .= "AND email = '".$email."'";
			} 
			return(parent::getArrayObjects($this->sourceTable,$where,$order));
		}		
		
		function obtenerListadoCompleto($tipo='')
		{
			$Region = new Region();
			$Comuna = new Comuna();
			$Pais	= new Pais();
			$where = '';
			if(trim($tipo) != '')
			{
				$where = " AND i.tipo_inscripcion = '".$tipo."' ";
			}
			$sql = " SELECT i.email 	,i.nombre 	,i.apellidos 	,i.rut, i.institucion 	,i.cargo 	,i.cargo_otro 	,i.telefono 	,i.telefono_movil 	,i.direccion 		 ,c.comuna, r.region,p.pais , i.ciudad, campo_extra1,campo_extra2,i.comentario,DATE_FORMAT( FROM_UNIXTIME( i.fecha ) , '%d-%m-%Y %H:%i:%s' ) as fecha_inscripcion 
			FROM ".$this->sourceTable." as i, ".$Comuna->sourceTable." as c, ".$Region->sourceTable." as r, ".$Pais->sourceTable." as p
			WHERE i.activo = 1 AND i.comuna = c.comuna_id AND c.region_id = r.region_id AND i.pais = pais_id ".$where."
			ORDER BY  i.fecha";
		   //echo $sql;
			return parent::getQuery($sql); 
		} 
		
		function obtenerListadoCompletoWeb($tipo='',$nombre_campos=array())
		{
			
			$Region = new Region();
			$Comuna = new Comuna();
			$Pais	= new Pais();
			$where = '';
			if(trim($tipo) != '')
			{
				$where = " AND i.tipo_inscripcion = '".$tipo."' ";
			}
			$select_campos_extras = "i.campo_extra1,i.campo_extra2, i.campo_extra3, i.campo_extra4, i.campo_extra5,i.campo_extra6,";
			if(is_array($nombre_campos) && count($nombre_campos) >0)
			{
				$select_campos_extras = "i.campo_extra1 as ".$nombre_campos['campo_extra1'].",i.campo_extra2 as ".$nombre_campos['campo_extra2'].", i.campo_extra3 as ".$nombre_campos['campo_extra3'].", i.campo_extra4 as ".$nombre_campos['campo_extra4'].", i.campo_extra5 as ".$nombre_campos['campo_extra5'].",i.campo_extra6 as ".$nombre_campos['campo_extra6'].",";
			}
			
			$sql = " SELECT i.email 	,i.nombre 	,i.apellidos 	,i.rut, i.rut_dv, i.institucion 	,i.cargo 	,i.cargo_otro 	,i.telefono 	,i.telefono_movil 	,i.ciudad,c.comuna, r.region,p.pais , ".$select_campos_extras."  i.rbd, i.rbd_dv, i.comentario,DATE_FORMAT( FROM_UNIXTIME( i.fecha ) , '%d-%m-%Y %H:%i:%s' ) as fecha_inscripcion 
			FROM ".$this->sourceTable." as i, ".$Comuna->sourceTable." as c, ".$Region->sourceTable." as r, ".$Pais->sourceTable." as p
			WHERE i.activo = 1 AND i.comuna = c.comuna_id AND c.region_id = r.region_id AND i.pais = pais_id ".$where."
			ORDER BY  i.fecha";
		   //echo $sql;
			return parent::getQuery($sql); 
		}


		function obtenerListadoSimple($tipo)
		{ 
			$where = '';
			if(trim($tipo) != '')
			{
				$where = " AND i.tipo_inscripcion = '".$tipo."' ";
			} 
			
			$sql = " SELECT i.email 	,i.nombre 	,i.apellidos 	   ,i.institucion,i.cargo,i.telefono,i.telefono_movil, i.comentario,DATE_FORMAT( FROM_UNIXTIME( i.fecha ) , '%d-%m-%Y %H:%i:%s' ) as fecha_inscripcion 
			FROM ".$this->sourceTable." as i 
			WHERE i.activo = 1 ".$where."
			ORDER BY  i.fecha";
			//echo $sql;
			return parent::getQuery($sql); 
		}			  	
	}
	
	class ControlInscripcionDescarga
	{
		function ControlInscripcionDescarga()
		{
			
		}
		
		function descargaListado($caso)
		{
			$ControladorInscripcion 		= new ControladorInscripcion(); 
		
			switch($caso)
			{
				case 'diplomado_modelamiento_2013';
					$nombre_campos = array('campo_extra1' => 'tipo_de_pago',
										   'campo_extra2' => 'estado_inscripcion',
										   'campo_extra3' => 'instiucion_educacional',
										   'campo_extra4' => 'direccion_institucion',
										   'campo_extra5' => 'responsable_institucion',
										   'campo_extra6' => 'telefono_responsable_institucion');
				break;
				default:
					$nombre_campos = array();
				break;
			}
			 
			$output = $ControladorInscripcion->obtenerListadoCompletoWeb($caso,$nombre_campos); 	
			return $output;		
		}
		
		function descargaSimple($caso)
		{
			$ControladorInscripcion 		= new ControladorInscripcion(); 
			return $ControladorInscripcion->obtenerListadoSimple($caso); 	
		}
	}  
 
?>