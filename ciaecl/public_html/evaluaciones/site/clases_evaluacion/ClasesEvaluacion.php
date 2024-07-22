<?php
	
	/**
	 * ControlEvaluacionVistaRevisionesCompletasPromedio
	 *
	 * @package ciae_web
	 * @author 
	 * @copyright 2013
	 * @version $Id$
	 * @access public
	 */
	class ControlEvaluacionVistaRevisionesCompletasPromedio extends ControlObjetos
	{ 
	  /**
	   * ControlEvaluacionVistaRevisionesCompletasPromedio::ControlEvaluacionVistaRevisionesCompletasPromedio()
	   *
	   * @return void
	   */
		function ControlEvaluacionVistaRevisionesCompletasPromedio()
		{
			parent::ControlObjetos();
			$this->obj 		= new Objetos();  
			$this->sourceTable 	= 'view_evaluacion_completo_revision_promedio'; 
			$this->order		= 'promedio DESC';
		} 
	} 
	
	/**
	 * ControlEvaluacionVistaRevisores
	 *
	 * @package ciae_web
	 * @author 
	 * @copyright 2013
	 * @version $Id$
	 * @access public
	 */
	class ControlEvaluacionVistaRevisores extends ControlObjetos
	{
	  /**
	   * ControlEvaluacionVistaRevisores::ControlEvaluacionVistaRevisores()
	   *
	   * @return void
	   */
		function ControlEvaluacionVistaRevisores()
		{
			parent::ControlObjetos();
			$this->obj 		= new Objetos();  
			$this->sourceTable 	= 'view_auth_info_md5'; 
			$this->order		= 'apellidos ASC, nombre ASC';
		} 
	}
	
	/** **************************************************************************************
	 * EvaluacionEvaluacion
	 *  
	 * @package Evaluaciones
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEvaluacion extends Objetos
	{	
		var $sourceTable = 'site_evaluacion';
		
		function EvaluacionEvaluacion()
		{
			parent::Objetos();
			$this->dbKey 		= 'id_evaluacion';
		}  
		function buscarEvaluacionActivo($seminario)
		{  
			$sql = " seminario = '".$seminario."' AND estado = 'activo' 
			ORDER BY estado ASC, id_evaluacion DESC";
			parent::loadObject($sql);
		}		
	} 
	
	/** **************************************************************************************
	 * ControlEvaluacionEvaluacion
	 * 
	 * @package Evaluaciones
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEvaluacion extends ControlObjetos
	{
		function ControlEvaluacionEvaluacion()
		{
			parent::ControlObjetos();
			$this->obj 		= new EvaluacionEvaluacion();
			parent::prepararObjeto(); 
			$this->order		= 'descripcion ASC';	
		}
			
	  /**
	   * ControlEvaluacionEvaluacion::obtenerEvaluacionesActivas()
	   *
	   * @return
	   */
		function obtenerEvaluacionesActivas()
		{
			$this->where = "  estado = 'activo'"; 
			return parent::obtenerListado();
		}	 
	}   
	
	/** **************************************************************************************
	 *
	 * EvaluacionEvaluacionEtapa
	 *  
	 * @package CIAE Evaluación
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEvaluacionEtapa extends Objetos
	{	
		var $sourceTable = 'site_evaluacion_etapa';		
		function EvaluacionEvaluacionEtapa()
		{
			parent::Objetos();
			$this->dbKey	= 'id_etapa';
		} 
		
		function buscarEtapa($id_etapa,$id_evaluacion)
		{			
			parent::loadObject('id_etapa = "'.$id_etapa.'" AND id_evaluacion = "'.$id_evaluacion.'"'); 
		}
		
		function guardarEtapa($id_etapa,$id_evaluacion)
		{			 
			parent::saveObject('id_etapa = "'.$id_etapa.'" AND id_evaluacion = "'.$id_evaluacion.'"');
		}
	} 
	
	/** **************************************************************************************
	 *
	 * ControlEvaluacionEvaluacionEtapa
	 * 
	 * @package CIAE Evaluación
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEvaluacionEtapa extends ControlObjetos
	{
		function ControlEvaluacionEvaluacionEtapa()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionEvaluacionEtapa();
			parent::prepararObjeto(); 
			$this->order	= 'orden  ASC, id_etapa';	
		}	 
		
		function buscarEtapas($id_evaluacion)
		{
			$this->where = "  id_evaluacion = '".$id_evaluacion."'"; 
			return parent::obtenerListado();
		} 
	}
	
	/** **************************************************************************************
	 *
	 * EvaluacionEnvioActividad
	 *  
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEnvioActividad extends Objetos
	{	
		var $sourceTable = 'site_evaluacion_envio';		
		function EvaluacionEnvioActividad()
		{
			parent::Objetos();
			$this->dbKey	= 'id_envio';
		} 
	} 
	
	/** **************************************************************************************
	 *
	 * ControlEvaluacionEnvioActividad
	 * 
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEnvioActividad extends ControlObjetos
	{
	  /**
	   * ControlEvaluacionEnvioActividad::ControlEvaluacionEnvioActividad()
	   *
	   * @return void
	   */
		function ControlEvaluacionEnvioActividad()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionEnvioActividad();
			parent::prepararObjeto(); 
			$this->order	= 'fecha ASC';	
		}	 
			
	  /**
	   * ControlEvaluacionEnvioActividad::buscarEnvios()
	   *
	   * @param mixed $username
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @return
	   */
		function buscarEnvios($username,$id_evaluacion,$id_etapa)
		{
			$this->where = " username = '".$username."' AND id_evaluacion = '".$id_evaluacion."' AND id_etapa = '".$id_etapa."'";
			$this->select = " DATE_FORMAT(  FROM_UNIXTIME(fecha)  , '".ControladorFechas::formatoFechaSql()."'  ) AS fecha_html";
			return parent::obtenerListado(); 
		} 
	} 
	
	/** **************************************************************************************
	 *
	 * EvaluacionTipoEnvio
	 *  
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionTipoEnvio extends Objetos
	{	
		var $sourceTable = 'site_evaluacion_tipo_envio';		
		function EvaluacionTipoEnvio()
		{
			parent::Objetos();
			$this->dbKey	= 'id_tipo_envio';
		} 
	} 
	
	/** **************************************************************************************
	 *
	 * ControlEvaluacionTipoEnvio
	 * 
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionTipoEnvio extends ControlObjetos
	{
		function ControlEvaluacionTipoEnvio()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionTipoEnvio();
			parent::prepararObjeto(); 
			$this->order	= 'orden ASC';	
		}
		
		function obtenerTipoEnvioEvaluacion($id_evaluacion)
		{ 
			$this->where = "id_evaluacion = '".$id_evaluacion."'";
			return parent::obtenerListado();
		}	 
	}	 
	
	/** **************************************************************************************
	 *
	 * EvaluacionEnvioAsignacion
	 *  
	 * @package CIAE Evaluación
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEnvioAsignacion extends Objetos
	{	
		var $sourceTable = 'site_evaluacion_envio_asignacion';		
		function EvaluacionEnvioAsignacion()
		{
			parent::Objetos();
			$this->dbKey	= 'id_evaluacion';
		}
		    
	  /**
	   * EvaluacionEnvioAsignacion::guardarAsignacion()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisor
	   * @param mixed $username_revisado
	   * @return void
	   */
		function guardarAsignacion($id_evaluacion,$id_etapa,$username_revisor,$username_revisado,$grupo_control=1)
		{			
			$this->id_evaluacion 		= $id_evaluacion;
			$this->id_etapa 			= $id_etapa;
			$this->username_revisor		= $username_revisor;
			$this->username_revisado	= $username_revisado;
			$this->grupo_control		= $grupo_control;
			$this->fecha_asignacion		= time();
			parent::guardarObjeto(); 
		} 
			
	  /**
	   * EvaluacionEnvioAsignacion::buscarElemento()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisor
	   * @param mixed $username_revisado
	   * @return void
	   */
		function buscarElemento($id_evaluacion,$id_etapa,$username_revisor,$username_revisado)
		{
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username_revisor = '".$username_revisor."'  AND  username_revisado = '".$username_revisado."' ";
			parent::loadObject($sql);
		}
			
	  /**
	   * EvaluacionEnvioAsignacion::buscarElementePendiente()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisor
	   * @return void
	   */
		function buscarElementePendiente($id_evaluacion,$id_etapa,$username_revisor)
		{ 
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username_revisor = '".$username_revisor."'   AND estado = 'pendiente' ";
			parent::loadObject($sql);
		}
			
	  /**
	   * EvaluacionEnvioAsignacion::guardarElemento()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisor
	   * @param mixed $username_revisado
	   * @return void
	   */
		function guardarElemento($id_evaluacion,$id_etapa,$username_revisor,$username_revisado)
		{
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username_revisor = '".$username_revisor."'  AND  username_revisado = '".$username_revisado."' ";
			parent::saveObject($sql);
		}
	} 
	
	/** **************************************************************************************
	 *
	 * ControlEvaluacionEnvioAsignacion
	 * 
	 * @package CIAE Evaluación
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEnvioAsignacion extends ControlObjetos
	{
	  /**
	   * ControlEvaluacionEnvioAsignacion::ControlEvaluacionEnvioAsignacion()
	   *
	   * @return void
	   */
		function ControlEvaluacionEnvioAsignacion()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionEnvioAsignacion();
			parent::prepararObjeto(); 
			$this->order	= 'estado DESC,fecha_asignacion ASC,id_evaluacion ASC, id_etapa ASC';	
		} 
		
	  /**
	   * ControlEvaluacionEnvioAsignacion::buscarAsignaciones()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisor
	   * @return
	   */
		function buscarAsignaciones($id_evaluacion,$id_etapa,$username_revisor,$estado='')
		{    
			$this->where = "id_evaluacion = '".$id_evaluacion."' AND id_etapa = '".$id_etapa."' AND username_revisor = '".$username_revisor."'"; 
			if(trim($estado) != '')
			{
				$this->where .= " AND estado = '".$estado."' ";
			}
			$this->select = parent::getSqlDateTime('fecha_asignacion','fecha_asignacion_html'); 
			$this->select .= ", ".parent::getSqlDateTime('fecha_cierre','fecha_cierre_html');
			return parent::obtenerListado();			
		}  
	
	  /**
	   * ControlEvaluacionEnvioAsignacion::buscarRevisores()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisado
	   * @param string $estado
	   * @return
	   */
		function buscarRevisores($id_evaluacion,$id_etapa,$username_revisado,$estado='')
		{    
			$this->where = "id_evaluacion = '".$id_evaluacion."' AND id_etapa = '".$id_etapa."' AND username_revisado = '".$username_revisor."'"; 
			if(trim($estado) != '')
			{
				$this->where .= " AND estado = '".$estado."' ";
			}
			$this->select = parent::getSqlDateTime('fecha_asignacion','fecha_cierre_html'); 
			$this->select .= ", ".parent::getSqlDateTime('fecha_cierre','fecha_cierre_html');
			return parent::obtenerListado();			
		} 
	
	  /**
	   * ControlEvaluacionEnvioAsignacion::insertarRevisionesCruzadasEnvioRevision()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @return void
	   */
		function insertarRevisionesCruzadasEnvioRevision($id_evaluacion,$id_etapa_anterior,$id_etapa_actual)
		{
			$sql = "INSERT INTO ".$this->sourceTable." (id_evaluacion ,	id_etapa ,		username_revisado ,username_revisor ,	  estado ,	 fecha_asignacion )
				SELECT id_evaluacion , '".$id_etapa_actual."' as	id_etapa ,	username_revisor ,	username_revisado ,	'pendiente' as estado ,	'".time()."' as fecha_asignacion
				FROM ".$this->sourceTable."
				WHERE id_evaluacion =".$id_evaluacion."
				AND id_etapa = ".$id_etapa_anterior."
				AND estado = 'cerrado' ";
			
			$salida = parent::consultarEspecifica($sql); 
		}
				
	} 
	
	/** **************************************************************************************
	 *
	 * EvaluacionEstadoEtapaCompleto
	 *  
	 * @package CIAE Evaluación
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEstadoEtapaCompleto extends Objetos
	{	
		var $sourceTable = 'site_evaluacion_etapa_completo';
				
	  /**
	   * EvaluacionEstadoEtapaCompleto::EvaluacionEstadoEtapaCompleto()
	   *
	   * @return void
	   */
		function EvaluacionEstadoEtapaCompleto()
		{
			parent::Objetos();
			$this->dbKey	= 'id_evaluacion';
		} 
		
	  /**
	   * EvaluacionEstadoEtapaCompleto::buscarEstado()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username
	   * @return void
	   */
		function buscarEstado($id_evaluacion,$id_etapa,$username)
		{ 
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username = '".$username."'  ";
			parent::loadObject($sql);
		}
			
	  /**
	   * EvaluacionEstadoEtapaCompleto::guardarEstado()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username
	   * @return void
	   */
		function guardarEstado($id_evaluacion,$id_etapa,$username)
		{ 
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username = '".$username."' ";
			parent::saveObject($sql);
		}
			
	  /**
	   * EvaluacionEstadoEtapaCompleto::crearEstado()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username
	   * @return void
	   */
		function crearEstado($id_evaluacion,$id_etapa,$username)
		{  
			$this->id_evaluacion 	= $id_evaluacion;
			$this->username 		= $username;
			$this->id_etapa 		= $id_etapa;
			$this->fecha_cierre 	= '0';
			$this->completo 		= 'no';
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username = '".$username."' ";
			parent::saveObject($sql);
		} 
			
	  /**
	   * EvaluacionEstadoEtapaCompleto::completarEstado()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username
	   * @return void
	   */
		function completarEstado($id_evaluacion,$id_etapa,$username)
		{  
			$this->id_evaluacion 	= $id_evaluacion;
			$this->username 		= $username;
			$this->id_etapa 		= $id_etapa;
			if($this->fecha_cierre == '0')
			{
				$this->fecha_cierre 	= time();
			}
			$this->completo 		= 'si';
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username = '".$username."' ";
			parent::saveObject($sql);
		}
	} 
	
	/** **************************************************************************************
	 *
	 * ControlEvaluacionEstadoEtapaCompleto
	 * 
	 * @package CIAE Evaluación
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEstadoEtapaCompleto extends ControlObjetos
	{
	  /**
	   * ControlEvaluacionEstadoEtapaCompleto::ControlEvaluacionEstadoEtapaCompleto()
	   *
	   * @return void
	   */
		function ControlEvaluacionEstadoEtapaCompleto()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionEstadoEtapaCompleto();
			parent::prepararObjeto(); 
			$this->order	= 'id_evaluacion ASC, id_etapa ASC, username ASC';	
		}
		
	  /**
	   * ControlEvaluacionEstadoEtapaCompleto::obtenerEnviosCompletosEvaluacionEtapa()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @return
	   */
		function obtenerEnviosCompletosEvaluacionEtapa($id_evaluacion,$id_etapa)
		{
			$this->order = ' RAND()';
			$this->where = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND completo = 'si' ";
			return parent::obtenerListado();
		} 	
		
	  /**
	   * ControlEvaluacionEstadoEtapaCompleto::obtenerEnviosCompletosEvaluacionEtapaPromedio()
	   *
	   * @param mixed $id_evalucion
	   * @param mixed $id_etapa
	   * @return void
	   */
		function obtenerEnviosCompletosEvaluacionEtapaPromedio($id_evalucion,$id_etapa)
		{
			$ControlEvaluacionVistaRevisionesCompletasPromedio = new ControlEvaluacionVistaRevisionesCompletasPromedio();
			$sql = "
			SELECT a.username , b.promedio 
			FROM ".$this->sourceTable." as a, ".$ControlEvaluacionVistaRevisionesCompletasPromedio->sourceTable." as b 
			WHERE a.id_evaluacion = ".$id_evalucion." 
				AND a.id_evaluacion = b.id_evaluacion
				AND a.id_etapa = ".$id_etapa." 
				AND a.completo = 'si'
				AND a.username = b.username_revisado
			 ORDER BY RAND() ";
			return parent::consultarEspecifica($sql); 		
		}
			
	  /**
	   * ControlEvaluacionEstadoEtapaCompleto::obtenerEstadoUsuario()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $username
	   * @return void
	   */
		function obtenerEstadoUsuario($id_evaluacion,$username)
		{ 
			$this->select = parent::getSqlDateTime('fecha_cierre','fecha_cierre_html');
			$this->order = ' id_evaluacion, id_etapa ';
			$this->where = " id_evaluacion = '".$id_evaluacion."' AND  username = '".$username."' ";
			return parent::obtenerListado();
		} 
	} 
	
	/** **************************************************************************************
	 *
	 * EvaluacionEnvioAsignacionRevision
	 *  
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEnvioAsignacionRevision extends Objetos
	{	
		var $sourceTable = ' site_evaluacion_envio_asignacion_revision';	
		/**
		* EvaluacionEnvioAsignacionRevision::EvaluacionEnvioAsignacionRevision()
		*
		* @return void
		*/
		function EvaluacionEnvioAsignacionRevision()
		{
			parent::Objetos();
			$this->dbKey	= 'id_evaluacion';
		}  
		
	  /**
	   * EvaluacionEnvioAsignacionRevision::buscarElemento()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisor
	   * @param mixed $username_revision
	   * @param mixed $id_envio
	   * @return void
	   */
		function buscarElemento($id_evaluacion,$id_etapa,$username_revisor,$username_revisado,$id_envio,$id_pregunta)
		{ 
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username_revisor = '".$username_revisor."'  AND  username_revisado = '".$username_revisado."' AND id_envio = '".$id_envio."'  AND id_pregunta = '".$id_pregunta."'  ";
			parent::loadObject($sql);
		}
			
	  /**
	   * EvaluacionEnvioAsignacionRevision::guardarElemento()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisor
	   * @param mixed $username_revision
	   * @param mixed $id_envio
	   * @return void
	   */
		function guardarElemento($id_evaluacion,$id_etapa,$username_revisor,$username_revisado,$id_envio,$id_pregunta)
		{ 
			$sql = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' AND  username_revisor = '".$username_revisor."'  AND  username_revisado = '".$username_revisado."' AND id_envio = '".$id_envio."'  AND id_pregunta = '".$id_pregunta."' ";
			parent::saveObject($sql);
		} 
	} 
	
	/** **************************************************************************************
	 *
	 * ControlEvaluacionEnvioAsignacionRevision
	 * 
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEnvioAsignacionRevision extends ControlObjetos
	{
		/**
		* ControlEvaluacionEnvioAsignacionRevision::ControlEvaluacionEnvioAsignacionRevision()
		*
		* @return void
		*/	
		function ControlEvaluacionEnvioAsignacionRevision()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionEnvioAsignacionRevision();
			parent::prepararObjeto(); 
			$this->order	= 'id_evaluacion ASC';	
		}	 
		
	  /**
	   * ControlEvaluacionEnvioAsignacionRevision::insertarAsignacionRevisionBase()
	   *
	   * @param mixed $id_etapa_envio
	   * @return void
	   */
		function insertarAsignacionRevisionBase($id_etapa_anterior,$id_etapa_actual,$id_evaluacion)
		{
			$EvaluacionEnvioAsignacion 	= new EvaluacionEnvioAsignacion();
			$EvaluacionEnvioActividad 	= new EvaluacionEnvioActividad();
			$EvaluacionEvaluacionPregunta = new EvaluacionEvaluacionPregunta();
			$sql = " INSERT INTO ".$this->obj->sourceTable." (  id_evaluacion,  id_etapa ,  username_revisor,  username_revisado, id_envio, id_pregunta)
					SELECT a.id_evaluacion, '".$id_etapa_actual."' as id_etapa  , a.username_revisor, a.username_revisado, b.id_envio, c.id_pregunta
					FROM ".$EvaluacionEnvioAsignacion->sourceTable." AS a, ".$EvaluacionEnvioActividad->sourceTable." AS b, ".$EvaluacionEvaluacionPregunta->sourceTable." AS c
					WHERE 
					a.id_evaluacion = ".$id_evaluacion."
					AND a.username_revisado = b.username
					AND a.id_evaluacion = b.id_evaluacion
					AND a.id_evaluacion = c.id_evaluacion
					AND b.id_etapa = ".$id_etapa_anterior."
					AND c.id_etapa = ".$id_etapa_actual."
					AND a.id_etapa = ".$id_etapa_actual."
					ORDER BY a.username_revisor, b.id_envio,  c.id_pregunta";
				//echo $sql;
			$salida = parent::consultarEspecifica($sql);
		}    
	
	  /**
	   * ControlEvaluacionEnvioAsignacionRevision::insertarAsignacionRevisionBaseUsername()
	   *
	   * @param mixed $id_etapa_anterior
	   * @param mixed $id_etapa_actual
	   * @param mixed $username_revisor
	   * @return void
	   */
		function insertarAsignacionRevisionBaseUsername($id_etapa_anterior,$id_etapa_actual,$username_revisor,$username_revisado,$id_evaluacion)
		{
			$EvaluacionEnvioAsignacion 	= new EvaluacionEnvioAsignacion();
			$EvaluacionEnvioActividad 	= new EvaluacionEnvioActividad();
			$EvaluacionEvaluacionPregunta = new EvaluacionEvaluacionPregunta();
			 $sql = " INSERT INTO ".$this->obj->sourceTable." (  id_evaluacion,  id_etapa ,  username_revisor,  username_revisado, id_envio, id_pregunta) 		SELECT a.id_evaluacion, '".$id_etapa_actual."' as id_etapa  , a.username_revisor, a.username_revisado, b.id_envio, c.id_pregunta
					FROM ".$EvaluacionEnvioAsignacion->sourceTable." AS a, ".$EvaluacionEnvioActividad->sourceTable." AS b, ".$EvaluacionEvaluacionPregunta->sourceTable." AS c
					WHERE 
					a.id_evaluacion = ".$id_evaluacion."
					AND a.username_revisado = '".$username_revisado."' 
					AND a.username_revisor = '".$username_revisor."'
					AND a.username_revisado = b.username 
					AND a.id_evaluacion = b.id_evaluacion
					AND a.id_evaluacion = c.id_evaluacion
					AND b.id_etapa = ".$id_etapa_anterior."
					AND c.id_etapa = ".$id_etapa_actual."
					AND a.id_etapa = ".$id_etapa_actual."
					ORDER BY a.username_revisor, b.id_envio,  c.id_pregunta";
				//echo $sql.'<br>';
			$salida = parent::consultarEspecifica($sql);
		} 		
	
	  /**
	   * ControlEvaluacionEnvioAsignacionRevision::insertarAsignacionRevisionBaseSimple()
	   *
	   * @param mixed $id_etapa_envio
	   * @return void
	   */
		function insertarAsignacionRevisionBaseSimple($id_etapa_envio,$id_evaluacion)
		{
			$EvaluacionEnvioAsignacion 	= new EvaluacionEnvioAsignacion();
			$EvaluacionEnvioActividad 	= new EvaluacionEnvioActividad();
			$EvaluacionEvaluacionPregunta = new EvaluacionEvaluacionPregunta();
			$sql = " INSERT INTO ".$this->obj->sourceTable." (  id_evaluacion,  id_etapa ,  username_revisor,  username_revisado, id_envio, id_pregunta)
					SELECT a.id_evaluacion, a.id_etapa  , a.username_revisor, a.username_revisado, '0' as id_envio, c.id_pregunta
					FROM ".$EvaluacionEnvioAsignacion->sourceTable." AS a , ".$EvaluacionEvaluacionPregunta->sourceTable." AS c
					WHERE  
					a.id_evaluacion = ".$id_evaluacion."
					AND  a.id_evaluacion = c.id_evaluacion
					AND a.id_etapa = ".$id_etapa_envio."
					AND c.id_etapa = a.id_etapa ";
			$salida = parent::consultarEspecifica($sql);
		}		
			
	  /**
	   * ControlEvaluacionEnvioAsignacionRevision::buscarEnviosRevisionesAsignado()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisado
	   * @return void
	   */
		function  buscarEnviosRevisionesAsignado($id_evaluacion,$id_etapa,$username_revisado,$username_revisor)
		{ 
			$EvaluacionEnvioActividad = new EvaluacionEnvioActividad();
			$sql = "SELECT DISTINCT 
			a.id_evaluacion 	,a.id_etapa 	,a.username_revisor 	,a.username_revisado 	,a.id_envio, b.texto, b.texto2, ".parent::getSqlDateTime('b.fecha','fecha_envio_html')."
			FROM ".$this->sourceTable." as a, ".$EvaluacionEnvioActividad->sourceTable." as b 
			WHERE a.id_envio = b.id_envio AND a.id_evaluacion = '".$id_evaluacion."' AND a.id_etapa = '".$id_etapa."' AND a.username_revisado = '".$username_revisado."'  AND a.username_revisor = '".$username_revisor."'";
			
			return parent::consultarEspecifica($sql);
		} 
	
	   function  buscarEnviosRevisionesCompleta($id_evaluacion,$id_etapa,$username_revisado)
		{ 
			$EvaluacionEnvioActividad = new EvaluacionEnvioActividad();
			$EvaluacionEvaluacionPregunta = new EvaluacionEvaluacionPregunta();
			$sql = "SELECT DISTINCT 
			a.id_evaluacion, a.id_etapa, a.username_revisado, a.id_envio, a.nota, a.texto, a.id_pregunta, c.orden, c.pregunta, ".parent::getSqlDateTime('a.fecha_revision','fecha_envio_html')."
			FROM ".$this->sourceTable." as a, ".$EvaluacionEnvioActividad->sourceTable." as b, ".$EvaluacionEvaluacionPregunta->sourceTable." as c
			WHERE a.id_envio = b.id_envio AND a.id_evaluacion = '".$id_evaluacion."' AND a.id_etapa = '".$id_etapa."' AND a.username_revisado = '".$username_revisado."' AND a.id_pregunta = c.id_pregunta";
			
			return parent::consultarEspecifica($sql);
			
	
		} 


		function  buscarEnviosRevisionesCompletaRealizadas($id_evaluacion,$id_etapa,$username_revisor)
		{ 
			$EvaluacionEnvioActividad = new EvaluacionEnvioActividad();
			$EvaluacionEvaluacionPregunta = new EvaluacionEvaluacionPregunta();
			$sql = "SELECT DISTINCT 
			a.id_evaluacion, a.id_etapa, a.username_revisor, a.username_revisado, a.id_envio, a.nota, a.texto, a.id_pregunta, a.estado, c.orden, c.pregunta, ".parent::getSqlDateTime('a.fecha_revision','fecha_envio_html')."
			FROM ".$this->sourceTable." as a, ".$EvaluacionEnvioActividad->sourceTable." as b, ".$EvaluacionEvaluacionPregunta->sourceTable." as c
			WHERE a.id_envio = b.id_envio AND a.estado = 'cerrado' AND a.id_evaluacion = '".$id_evaluacion."' AND a.id_etapa = '".$id_etapa."' AND a.username_revisor = '".$username_revisor."' AND a.id_pregunta = c.id_pregunta";
			
			return parent::consultarEspecifica($sql);
			
	
		} 
	

	  /**
	   * ControlEvaluacionEnvioAsignacionRevision::buscarEnviosRevisionesEnviosAsignado()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $username_revisado
	   * @param mixed $username_revisor
	   * @return
	   */
		function  buscarEnviosRevisionesEnviosAsignado($id_evaluacion,$id_etapa,$username_revisado,$username_revisor)
		{ 
			$EvaluacionEnvioActividad = new EvaluacionEnvioActividad();
			$sql = "SELECT DISTINCT 
			a.id_evaluacion 	,a.id_etapa 	,a.username_revisor 	,a.username_revisado 	,a.id_envio 
			FROM ".$this->sourceTable." as a 
			WHERE   a.id_evaluacion = '".$id_evaluacion."' AND a.id_etapa = '".$id_etapa."' AND a.username_revisado = '".$username_revisado."'  AND a.username_revisor = '".$username_revisor."'";
			
			return parent::consultarEspecifica($sql);
		}	
			
	  /**
	   * ControlEvaluacionEnvioAsignacionRevision::buscarRevisionesRealizadasCompletas()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @param mixed $usuario_revisor
	   * @param mixed $usuario_revisado
	   * @return void
	   */
		function buscarRevisionesRealizadasCompletas($id_evaluacion,$id_etapa,$usuario_revisor,$usuario_revisado)
		{ 
			$EvaluacionEnvioAsignacionRevision 	= new EvaluacionEnvioAsignacionRevision();
			$EvaluacionEvaluacionPregunta 		= new EvaluacionEvaluacionPregunta();
			$sql = " SELECT a. * , b. *, ".parent::getSqlDateTime('a.fecha_revision','fecha_revision_html')."
					FROM ".$EvaluacionEnvioAsignacionRevision->sourceTable." AS a, ".$EvaluacionEvaluacionPregunta->sourceTable." AS b
					WHERE a.id_evaluacion = ".$id_evaluacion."
					AND a.id_etapa = ".$id_etapa."
					AND a.username_revisor LIKE '".$usuario_revisor."'
					AND a.username_revisado LIKE '".$usuario_revisado."'
					AND a.id_evaluacion = b.id_evaluacion
					AND a.id_etapa = b.id_etapa
					AND a.id_pregunta = b.id_pregunta
					ORDER BY b.orden";
			return parent::consultarEspecifica($sql);			
		}	
	} 


	/** **************************************************************************************
	 *
	 * EvaluacionEvaluacionPregunta
	 *  
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEvaluacionPregunta extends Objetos
	{	
		var $sourceTable = 'site_evaluacion_preguntas';	
		/**
		* EvaluacionEvaluacionPregunta::EvaluacionEvaluacionPregunta()
		*
		* @return void
		*/
		function EvaluacionEvaluacionPregunta()
		{
			parent::Objetos();
			$this->dbKey	= 'orden ASC';
		} 
	} 
	
	/** **************************************************************************************
	 *
	 * ControlEvaluacionEvaluacionPregunta
	 * 
	 * @package CIAE Evaluacion
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEvaluacionPregunta extends ControlObjetos
	{
		/**
		* ControlEvaluacionEvaluacionPregunta::ControlEvaluacionEvaluacionPregunta()
		*
		* @return void
		*/	
		function ControlEvaluacionEvaluacionPregunta()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionEvaluacionPregunta();
			parent::prepararObjeto(); 
			$this->order	= 'orden ASC';	
		}	
			
	  /**
	   * ControlEvaluacionEvaluacionPregunta::obtenerPreguntas()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $id_etapa
	   * @return
	   */
		function obtenerPreguntas($id_evaluacion,$id_etapa)
		{  
			$this->where = " id_evaluacion = '".$id_evaluacion."' AND  id_etapa = '".$id_etapa."' ";
			return parent::obtenerListado();
		} 
	} 
	
	/** **************************************************************************************
	 *
	 * EvaluacionEnvioFinal
	 *  
	 * @package CIAE 
	 * @author Paulina Sepúlveda - psepulve@gmail.com  
	 * @copyright 2013
	 * @version 1.0
	 * @access public 
	 *
	 ***************************************************************************************/
	class EvaluacionEnvioFinal extends Objetos
	{	
		var $sourceTable = 'site_evaluacion_envio_final';	
		/**
		* EvaluacionEnvioFinal::EvaluacionEnvioFinal()
		*
		* @return void
		*/
		function EvaluacionEnvioFinal()
		{
			parent::Objetos();
			$this->dbKey	= 'id_evaluacion';
		}  
			
	  /**
	   * EvaluacionEnvioFinal::buscarObjeto()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $username
	   * @return void
	   */
		function buscarObjeto($id_evaluacion,$username)
		{  
			parent::loadObject('id_evaluacion = "'.$id_evaluacion.'" AND username = "'.$username.'"');
		}
			
	  /**
	   * EvaluacionEnvioFinal::guardarObjeto()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $username
	   * @return void
	   */
		function guardarObjeto($id_evaluacion,$username)
		{  
			parent::saveObject('id_evaluacion = "'.$id_evaluacion.'" AND username = "'.$username.'"');
		}
	} 

	/** **************************************************************************************
	 *
	 * ControlEvaluacionEnvioFinal
	 * 
	 * @package CIAE 
	 * @author Paulina Sepúlveda - psepulve@gmail.com 
	 * @copyright 2013
	 * @version 1.0
	 * @access public
	 *
	 ***************************************************************************************/
	class ControlEvaluacionEnvioFinal extends ControlObjetos
	{
		/**
		* ControlEvaluacionEnvioFinal::ControlEvaluacionEnvioFinal()
		*
		* @return void
		*/	
		function ControlEvaluacionEnvioFinal()
		{
			parent::ControlObjetos();
			$this->obj	= new EvaluacionEnvioFinal();
			parent::prepararObjeto(); 
			$this->order	= 'id_evaluacion, fecha_cierre ASC';	
		}	  
			
	  /**
	   * ControlEvaluacionEnvioFinal::obtenerEvaluacion()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $username
	   * @return
	   */
		function obtenerEvaluacion($id_evaluacion,$username)
		{
			$this->where = " id_evaluacion = '".$id_evaluacion."' AND  username = '".$username."' ";
			return parent::obtenerListado();
		}
		
	  /**
	   * ControlEvaluacionEnvioFinal::revisionEvaluacionFinal()
	   *
	   * @param mixed $id_evaluacion
	   * @param mixed $username
	   * @return
	   */
		function revisionEvaluacionFinal($id_evaluacion,$username)
		{  
			$output = $this->obtenerEvaluacion($id_evaluacion,$username);
			if(is_array($output) && count($output) > 0)
			{
				return $output;
			}
			else
			{
				$this->obj->id_evaluacion = $id_evaluacion;
				$this->obj->username = $username;
				$this->obj->guardarObjeto($id_evaluacion,$username);
				return $this->obtenerEvaluacion($id_evaluacion,$username);			
			}
		} 		
	}


	class EvaluacionAdminGeneral extends Objetos
	{

		/**
	   * EvaluacionAdminGeneral::EvaluacionAdminGeneral()
	   *
	   * @return void
	   */

		var $sourceTable = 'site_evaluacion_etapa'; 

		function EvaluacionAdminGeneral()
		{
			parent::Objetos();
			$this->dbKey = 'id_etapa';
		} 

		/**
		* buscarEtapaParaActualizarFecha::buscarEtapaParaActualizarFecha()
		*
		* @param $id_evaluacion
		* @param $id_etapa
		* @return
		*/	
		function buscarEtapaParaActualizarFecha($id_evaluacion, $id_etapa)
		{

			parent::loadObject('id_etapa = "'.$id_etapa.'" AND id_evaluacion = "'.$id_evaluacion.'"');
			
			/*$et = $this->where = 'id_etapa = "'.$id_etapa.'" AND id_evaluacion = "'.$id_evaluacion.'"'; 	
			return parent::obtenerValoresArreglo();
			*/
				
		}	

		function guardarObjeto()
		{  
			parent::saveObject('id_etapa = "'.$this->id_etapa.'" AND id_evaluacion = "'.$this->id_evaluacion.'"');
		} 
			
	  
	}

	
?>
