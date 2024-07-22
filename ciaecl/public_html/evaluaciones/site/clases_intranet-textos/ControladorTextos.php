<?php 

/**
 * ControlVistaTextoExtendido
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlVistaTextoExtendido extends ControlObjetos
{
	var $obj; 	 
	 
	function ControlVistaTextoExtendido() 
	{			
		parent::ControlObjetos();
		$this->obj 			= new Objetos();  	
		$this->order		= 'tipo,RAND()';		
		$this->key 			= 'id_texto';
		$this->sourceTable 	= 'view_textos_extendido';  
	}
}



/**
 * ControlVistaCorreccionTiempos
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlVistaCorreccionTiempos extends ControlObjetos
{
	var $obj; 	 
	 
	function ControlVistaCorreccionTiempos() 
	{			
		parent::ControlObjetos();
		$this->obj 			= new Objetos();  	
		$this->order		= 'id_correccion, username, orden_tipo_texto';		
		$this->key 			= 'id_texto';
		$this->sourceTable 	= 'view_correccion_tiempos';  
	}
	
	function buscarPromedioTiempos()
	{
		$sql = "SELECT username,tipo_correccion, id_tipo_texto , count(username) as cantidad, ROUND(AVG(time_diferencia_minuto),3) as time_promedio_minuto, ROUND(AVG(time_diferencia_segundos),3) as time_promedio_segundo FROM ".$this->sourceTable."
		GROUP BY username,tipo_correccion, id_tipo_texto
		ORDER BY tipo_correccion, username,id_tipo_texto";
		return parent::consultarEspecifica($sql); 
	}
}

/**
 * ControlVistaCorreccionDefinitivo
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlVistaCorreccionDefinitivo extends ControlObjetos
{
	var $obj; 	 
	 
	function ControlVistaCorreccionDefinitivo() 
	{			
		parent::ControlObjetos();
		$this->obj 			= new Objetos();  	
		$this->order		= 'id_tipo_texto,id_texto';		
		$this->key 			= 'id_texto';
		$this->sourceTable 	= 'view_correccion_definitiva';  
	} 

	function obtenerListadoListadoOficial($prefijo='')
	{
		$where = "id_tipo_texto = 'cuento".$prefijo."' OR id_tipo_texto = 'carta".$prefijo."' OR id_tipo_texto = 'noticia".$prefijo."' "; 
		return parent::getArrayObjects($this->sourceTable,$where,$this->order); 
	}	
}
 
class ControlVistaCorreccionInconsistenciaMultiple extends ControlObjetos
{
	var $obj; 	 
	 
	function ControlVistaCorreccionInconsistenciaMultiple() 
	{			
		parent::ControlObjetos();
		$this->obj 			= new Objetos();  	
		$this->order		= 'id_texto,id_tipo_texto, 	criterio ';		
		$this->key 			= 'id_texto';
		$this->sourceTable 	= 'view_inconsistencias_multiple';  
	}  
 } 


/**
 * TipoTextos
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class TipoTextos extends Objetos
{
	var $sourceTable =  'site_textos_tipo';
	
	function TipoTextos()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_tipo_texto';
	} 
}

/**
 * ControlTipoTextos
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlTipoTextos extends ControlObjetos
{
	function ControlTipoTextos()
	{
		parent::ControlObjetos();
		$this->obj 		= new TipoTextos();
		$this->order	= 'orden ASC';		
		$this->key 		= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function buscarCaso($caso)
	{
		$this->where = "caso = '".$caso."'";
		return parent::obtenerListado();
	}
} 
 
/**
 * TextosCorreccion
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class TextosCorreccion extends Objetos
{	
	var $sourceTable = "site_textos";
	
	function TextosCorreccion()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_texto';
	} 
} 

/**
 * ControlTextosCorreccion
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlTextosCorreccion extends ControlObjetos
{
	function ControlTextosCorreccion()
	{
		parent::ControlObjetos();
		$this->obj 		= new TextosCorreccion();
		$this->order	= 'id_texto ASC';		
		$this->key 		= $this->obj->dbKey;		
		$this->sourceTable = $this->obj->sourceTable;
	}	
	
	function obtenerListadoTipo($tipo,$orden='simple')
	{
		$this->where = "id_tipo_texto = '".$tipo."'";
		if($orden == 'random')
		{
			$this->order = 'RAND()';
		}
		return parent::obtenerListado();
	}	
	
	function obtenerListadoPorcentaje($tipo,$cantidad)
	{
		$this->where = "id_tipo_texto = '".$tipo."'";
		$this->order = "RAND() LIMIT 0,".$cantidad;
		return parent::obtenerListado();
	}	
} 

/**
 * CriterioNivel
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class CriterioNivel extends Objetos
{	
	var $sourceTable = " site_criterio_nivel";
	
	function CriterioNivel()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_criterio';
	} 
} 

/**
 * ControlCriterioNivel
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlCriterioNivel extends ControlObjetos
{
	function ControlCriterioNivel()
	{
		parent::ControlObjetos();
		$this->obj 		= new CriterioNivel();
		$this->order	= 'id_nivel ASC';		
		$this->key 		= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	}	

	function obtenerNiveles($id_criterio,$id_tipo_texto)
	{ 
		$this->where .= " id_criterio = '".$id_criterio."' AND id_tipo_texto = '".$id_tipo_texto."'";
		return parent::obtenerListado();
	}
} 

/**
 * Criterio
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class Criterio extends Objetos
{	
	var $sourceTable = " site_criterio";
	
	function CriterioNivel()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_criterio';
	} 
} 

/**
 * ControlCriterio
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlCriterio extends ControlObjetos
{
	function ControlCriterio()
	{
		parent::ControlObjetos();
		$this->obj 		= new Criterio();
		$this->order	= 'id_criterio ASC';		
		$this->key 		= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	}	

	function obtenerCriterio($id_criterio,$id_tipo_texto)
	{ 
		$this->where .= " id_criterio = '".$id_criterio."' AND id_tipo_texto = '".$id_tipo_texto."'";
		return parent::obtenerListado();
	}
} 


/**
 * Correccion
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class Correccion extends Objetos
{	
	var $sourceTable = 'site_correccion';
	
	function Correccion()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_correccion';
	} 
	
	function buscarCorreccion($id_correccion)
	{
		parent::buscarObjetoGenerico("id_correccion = '".$id_correccion."'");
	}
	
	function guardarCorreccion($id_correccion)
	{
		parent::guardarObjetoGenerico("id_correccion = '".$id_correccion."'");
	}
} 

/**
 * ControlCorreccion
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class ControlCorreccion extends ControlObjetos
{
	function ControlCorreccion()
	{
		parent::ControlObjetos();
		$this->obj 			= new Correccion();
		$this->order		= 'id_correccion ASC';		
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}	
	
	function buscarCorreccionActiva($tipo_correccion)
	{
		$this->where = " estado = 'pendiente' AND tipo_correccion ='".$tipo_correccion."'";
		return parent::obtenerListado();
	}	 
}  
	
/**
 * CorreccionDefinitivo
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class CorreccionDefinitivo extends Objetos
{	
	var $sourceTable = 'site_correccion_definitivo';
	
	function CorreccionDefinitivo()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_texto';
	}
	
	function buscarObjeto($id_texto,$id_tipo_texto)
	{
		$where = "id_texto = '".$id_texto."' AND id_tipo_texto = '".$id_tipo_texto."' ";
		parent::loadObject($where);		
	}
	
	function guardarObjeto($id_texto,$id_tipo_texto) 
	{
		$where = "id_texto = '".$id_texto."' AND id_tipo_texto = '".$id_tipo_texto."' ";
		parent::saveObject($where);		
	}
} 

/**
 * ControlCorreccionDefinitivo
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class ControlCorreccionDefinitivo extends ControlObjetos
{
	function ControlCorreccionDefinitivo()
	{
		parent::ControlObjetos();
		$this->obj 			= new CorreccionDefinitivo();
		$this->order		= 'id_texto ASC';		
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}	 
	
	function guardarModificacionInconsistencia($id_texto,$id_tipo_texto,$criterio,$criterio_valor)
	{
		$sql = "UPDATE ".$this->sourceTable." SET ".$criterio." = '".$criterio_valor."' WHERE id_texto = '".$id_texto."' AND id_tipo_texto = '".$id_tipo_texto."'  ";
		parent::getQuery($sql); 
	}	 
	
	function guardarCierreInconsistencia($id_texto,$id_tipo_texto)
	{
		$sql = "UPDATE ".$this->sourceTable." SET  estado ='cerrado' 
		WHERE id_texto = '".$id_texto."' AND id_tipo_texto = '".$id_tipo_texto."'  ";
		parent::getQuery($sql); 
	}		
}

/**
 * CorreccionDia
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class CorreccionDia extends Objetos
{	
	var $sourceTable = 'site_correccion_dia';
	
	function CorreccionDia()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_correccion_dia';
	} 
	
	function buscarCorreccion($id_correccion,$id_tipo_texto,$id_correccion_dia)
	{
		parent::buscarObjetoGenerico("id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."' AND id_correccion_dia = '".$id_correccion_dia."'");
	}
	
	function guardarCorreccion($id_correccion,$id_tipo_texto,$id_correccion_dia)
	{
		parent::guardarObjetoGenerico("id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."' AND id_correccion_dia = '".$id_correccion_dia."'");
	}
} 

/**
 * ControlCorreccionDia
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class ControlCorreccionDia extends ControlObjetos
{
	function ControlCorreccionDia()
	{
		parent::ControlObjetos();
		$this->obj 			= new CorreccionDia();
		$this->order		= 'id_correccion_dia ASC';		
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}
	
	function obtenerMaximoDia($id_correccion)
	{
		$this->where = "id_correccion = '".$id_correccion."' ";
		$this->order = " id_correccion_dia DESC LIMIT 1";
		return parent::obtenerListado();
	}
	
	function obtenerDiaCorreccionActual($id_correccion)
	{
		$this->where = "id_correccion = '".$id_correccion."' AND estado = 'pendiente' ";
		$this->order = "orden_tipo_texto ASC, id_correccion_dia ASC LIMIT 1";
		return parent::obtenerListado();
	}
	
	function obtenerDiaCorreccion($id_correccion,$id_tipo_texto,$fecha)
	{ 
		$this->where = "id_correccion = '".$id_correccion."' AND estado = 'cerrado' AND fecha = '".$fecha."'";
		$this->order = "id_correccion_dia ASC LIMIT 1";
		$revision_anterior_hoy = parent::obtenerListado();
		
		if(is_array($revision_anterior_hoy) && count($revision_anterior_hoy) > 0)
		{
			/** QUIERE DECIR QUE HABIA REVISION DE HOY EN CUALQUIER TIPO DE TEXTO, DEVUELVE VACIO */
			return '';
		}
		else
		{
			$this->where = "id_correccion = '".$id_correccion."' AND estado = 'cerrado' AND id_tipo_texto = '".$id_tipo_texto."' AND fecha = '".$fecha."'";
			$this->order = "id_correccion_dia ASC LIMIT 1";
			$revision_anterior = parent::obtenerListado();
			
			if(is_array($revision_anterior) && count($revision_anterior) > 0)
			{
				/** QUIERE DECIR QUE HABIA REVISION DE HOY PARA YA SE ACABARON, DEVUELVE VACIO */
				return '';
			}
			else
			{
				/** CONSULTA SI HAY REVISION PARA HOY PENDIENTE O HAY QUE CREAR UNA NUEVA */
				$this->where = "id_correccion = '".$id_correccion."' AND estado = 'pendiente' AND id_tipo_texto = '".$id_tipo_texto."' AND fecha = '".$fecha."'";
				$this->order = "id_correccion_dia ASC LIMIT 1";
				$revision_hoy = parent::obtenerListado();
				if(is_array($revision_hoy) && count($revision_hoy) > 0)
				{
					/** HAY REVISION DE HOY PENDIENTE, SE ENTREGA*/
					return $revision_hoy;
				}
				else
				{
					/** SE BUSCA REVISION NUEVA Y SE LE AGREGA EL DÍA DE HOY */
					$this->where = "id_correccion = '".$id_correccion."' AND estado = 'pendiente' AND id_tipo_texto = '".$id_tipo_texto."' AND fecha = '0000-00-00'";
					$this->order = "id_correccion_dia ASC LIMIT 1";
					$revision_nueva = parent::obtenerListado(); 
					if(is_array($revision_nueva) && count($revision_nueva) > 0)
					{
						$this->obj->buscarCorreccion($revision_nueva[0]['id_correccion'],$revision_nueva[0]['id_tipo_texto'],$revision_nueva[0]['id_correccion_dia']); 
						$this->obj->fecha = $fecha;
						$this->obj->guardarCorreccion($revision_nueva[0]['id_correccion'],$revision_nueva[0]['id_tipo_texto'],$revision_nueva[0]['id_correccion_dia']); 
						$revision_nueva[0]['fecha'] = $fecha;
						return $revision_nueva;
					}
					else
					{
						/** NO HAY MAS DIAS SE RETORNA VACIO */
						return '';
					}
				} 
			}
		} 
	}	  
}  
	
/**
 * CorreccionUsuario
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class CorreccionUsuario extends Objetos
{	
	var $sourceTable = 'site_correccion_usuario';
	
	function CorreccionUsuario()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_correccion_dia';
	}   
	
	function obtenerCorreccionTextoSimple($id_correccion_dia,$id_correccion,$id_tipo_texto,$id_texto)
	{
		parent::buscarObjetoGenerico("id_correccion_dia = '".$id_correccion_dia."' AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."'   AND id_texto = '".$id_texto."' ");
	}
	
	function obtenerCorreccionTexto($id_correccion_dia,$id_correccion,$id_tipo_texto,$username,$id_texto)
	{
		parent::buscarObjetoGenerico("id_correccion_dia = '".$id_correccion_dia."' AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."' AND username = '".$username."' AND id_texto = '".$id_texto."' ");
	}	
	
	function guardarCorreccionTexto($id_correccion_dia,$id_correccion,$id_tipo_texto,$username,$id_texto)
	{
		parent::guardarObjetoGenerico("id_correccion_dia = '".$id_correccion_dia."' AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."' AND username = '".$username."' AND id_texto = '".$id_texto."' ");
	}	
	
	function revisionCompleto()
	{
		if($this->estado == 'cerrado' && trim($this->time_cierre) != '0')
		{
			return true;
		}
		
		if($this->criterio_1 != '0' && $this->criterio_2 != '0' && $this->criterio_3 != '0' &&  $this->criterio_4 != '0'    &&  $this->criterio_5_1 != '0'  &&  $this->criterio_5_2 != '0'  &&  $this->criterio_5_3 != '0'  &&  $this->criterio_5_4 != '0'  &&  $this->criterio_5_5 != '0'  &&   $this->criterio_6 != '0' )
		{
			/** REVISA SI TODOS LOS CRITERIOS ESTAN GUARDADOS, Y CIERRE EL PROCESO */
			$this->estado = 'cerrado';
			$this->time_cierre = time();
			return true;				
		}
		return false;
	}
	
	function buscarProximoCriterio() /** SE BUSCA EL CRITERIO PENDIENTE */
	{ 
		for($i=1; $i <= 6; $i++)
		{
			$aux = 'criterio_'.$i;
			if($i == 5)
			{
				for($j=1; $j <= 5; $j++)
				{
					$aux2 = $aux."_".$j;
					if(($this->$aux2) == '0')
					{
						return $i;
					}
				} 			
			}
			else
			{
				if(($this->$aux) == '0')
				{
					return $i;
				}	
			}
		}
	}
} 

/**
 * ControlCorreccionUsuario
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class ControlCorreccionUsuario extends ControlObjetos
{
	function ControlCorreccionUsuario()
	{
		parent::ControlObjetos();
		$this->obj 			= new CorreccionUsuario();
		$this->order		= 'id_texto ASC';		
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}
	
	function cambioAsignacionFinalPrincipio($id_correccion,$dia_maximo)
	{
		$dia_mas = $dia_maximo + 1;
		$sql = "UPDATE ".$this->sourceTable." SET id_correccion_dia = ".$dia_mas." WHERE id_correccion = ".$id_correccion." AND id_correccion_dia = ".$dia_maximo;
		parent::getQuery($sql); 
		
		$sql = "UPDATE ".$this->sourceTable." SET id_correccion_dia = ".$dia_maximo." WHERE id_correccion = ".$id_correccion." AND id_correccion_dia = 1";
		parent::getQuery($sql);
		
		$sql = "UPDATE ".$this->sourceTable." SET id_correccion_dia = 1 WHERE id_correccion = ".$id_correccion." AND id_correccion_dia = ".$dia_mas;
		parent::getQuery($sql);  
	}
	
	function obtenerListadoUsuarioDia($id_correccion_dia,$id_correccion,$id_tipo_texto,$username)
	{
		$this->where = "id_correccion_dia <= '".$id_correccion_dia."' AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."' AND username = '".$username."' AND estado = 'pendiente' ";
		$this->order = "id_correccion_dia, id_texto ASC  ";
		return parent::obtenerListado(); 
	}	
	
	function obtenerListadoDiaCompleto($id_correccion_dia,$id_correccion,$id_tipo_texto)
	{
		$this->where = "id_correccion_dia = '".$id_correccion_dia."' AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."'  AND estado = 'pendiente' ";
		$this->order = "id_texto ASC  ";
		return parent::obtenerListado(); 
	}	
	
	function obtenerCorreccionTexto($id_correccion_dia,$id_correccion,$id_tipo_texto,$username,$id_texto)
	{
		$this->where = "id_correccion_dia = '".$id_correccion_dia."' AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."' AND username = '".$username."' AND id_texto = '".$id_texto."' ";
		return parent::obtenerListado(); 
	}
	
	function revisionCorreccionDoble($id_correccion_dia,$id_correccion,$id_tipo_texto,$id_texto)
	{ 
		$this->where  = "id_correccion_dia = '".$id_correccion_dia."'  AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."'   AND id_texto = '".$id_texto."'  "; 
		return parent::obtenerListado(); 
	} 
	
	function revisionRevisionesCerradas($id_correccion_dia,$id_correccion,$id_tipo_texto,$id_texto)
	{ 
		$this->where  = "id_correccion_dia = '".$id_correccion_dia."'  AND id_correccion = '".$id_correccion."' AND id_tipo_texto = '".$id_tipo_texto."'   AND id_texto = '".$id_texto."' AND estado = 'cerrado'  "; 
		return parent::obtenerListado(); 
	}
	
	function buscarInconsistencias($id_correccion_dia,$id_correccion,$id_tipo_texto,$id_texto)
	{
		$sql = "SELECT DISTINCT id_correccion_dia ,	id_correccion 	,id_tipo_texto ,	id_texto ,	criterio_1 ,	criterio_2 ,	criterio_3 ,	criterio_4 ,	criterio_5_1 ,	criterio_5_2 ,	criterio_5_3 ,	criterio_5_4 ,	criterio_5_5 ,	criterio_6 , 	estado
		FROM ".$this->sourceTable."		
		WHERE id_correccion_dia = '".$id_correccion_dia."'  AND id_correccion = '".$id_correccion."'
			 AND id_tipo_texto = '".$id_tipo_texto."'   AND id_texto = '".$id_texto."'  AND estado = 'cerrado'
		ORDER BY ".$this->order;
		Funciones::mostrarArreglo($sql,true); 
		return parent::getQuery($sql);
	}
} 

	
/**
 * CorreccionInconsistencia
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class CorreccionInconsistencia extends Objetos
{	
	var $sourceTable = 'site_correccion_inconsistencia';
	
	function CorreccionInconsistencia()
	{
		parent::Objetos();
		$this->dbKey 		= 'id_texto';
	} 
} 

/**
 * ControlCorreccionInconsistencia
 *
 * @package ciae_web
 * @author Paulina Sepúlveda psepulve@gmail.com :: CIAE - Uchile
 * @copyright 2013
 * @version $
 * @access public
 */
class ControlCorreccionInconsistencia extends ControlObjetos
{
	function ControlCorreccionInconsistencia()
	{
		parent::ControlObjetos();
		$this->obj 			= new CorreccionInconsistencia();
		$this->order		= 'criterio ASC';		
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	} 
	
	function buscarEstadoInconsistencia($id_texto,$id_tipo_texto)
	{
		$where = "id_texto = '".$id_texto."' AND id_tipo_texto = '".$id_tipo_texto."' AND estado = 'pendiente'"; 
		return parent::getArrayObjects($this->sourceTable,$where); 
	}
	
	function guardarInconsistencia($id_texto,$id_tipo_texto,$criterio )
	{
		$sql = "REPLACE INTO ".$this->sourceTable." (id_texto, id_tipo_texto, criterio, estado) 
		VALUES ('".$id_texto."','".$id_tipo_texto."','".$criterio."','pendiente')";
		parent::getQuery($sql);
	} 
	
	function guardarInconsistenciaRevision($id_texto,$id_tipo_texto)
	{
		$sql = "UPDATE ".$this->sourceTable." SET estado = 'cerrado' WHERE id_texto = '".$id_texto."' AND id_tipo_texto = '".$id_tipo_texto."'";
		parent::getQuery($sql);
	} 
	
	function guardarCierreInconsistencia($id_texto,$id_tipo_texto,$criterio)
	{
		$sql = "UPDATE ".$this->sourceTable." SET estado = 'cerrado' WHERE id_texto = '".$id_texto."' AND id_tipo_texto = '".$id_tipo_texto."' AND criterio = '".$criterio."'";
		parent::getQuery($sql);
	}	
} 

class ControlGeneralCorreccion
{
	function ControlGeneralCorreccion()
	{
		
	}
	
	function asignacionDefinitiva($id_texto,$valores)
	{
		Funciones::mostrarArreglo(array($id_texto,$valores),true);
		$CorreccionDefinitivo = new CorreccionDefinitivo(); 
		$CorreccionDefinitivo->buscarObjeto($id_texto,$valores['id_tipo_texto']);
		
		if($CorreccionDefinitivo->estado == 'pendiente') /* PARA SOLO CAMBIAR AQUELLOS QUE ESTéN PENDIENTES */
		{  
			$CorreccionDefinitivo->criterio_1 	= $valores['criterio_1'];
			$CorreccionDefinitivo->criterio_2 	= $valores['criterio_2'];
			$CorreccionDefinitivo->criterio_3 	= $valores['criterio_3'];
			$CorreccionDefinitivo->criterio_4 	= $valores['criterio_4'];
			$CorreccionDefinitivo->criterio_5_1 = $valores['criterio_5_1'];
			$CorreccionDefinitivo->criterio_5_2 = $valores['criterio_5_2'];
			$CorreccionDefinitivo->criterio_5_3 = $valores['criterio_5_3'];
			$CorreccionDefinitivo->criterio_5_4 = $valores['criterio_5_4'];
			$CorreccionDefinitivo->criterio_5_5 = $valores['criterio_5_5'];
			$CorreccionDefinitivo->criterio_6 	= $valores['criterio_6']; 
			$CorreccionDefinitivo->estado 		= $valores['estado']; 
			$CorreccionDefinitivo->guardarObjeto($id_texto,$valores['id_tipo_texto']);
		}
		Funciones::mostrarArreglo($CorreccionDefinitivo,true);
		return $CorreccionDefinitivo;
	}
	
	function revisionInconsistenciaDoble($listado) /** REVISION INCONSISTENCIAS ORIGINAL */
	{
		$revision_1 = 0;
		$revision_2 = 1;
		$valores = array();
		$valores['estado'] 		= 'cerrado';
		$valores['id_texto'] 	= $listado[$revision_1]['id_texto'];
		
		for($i=1 ; $i <= 6; $i++)
		{
			$aux_criterio = 'criterio_'.$i;
			if($i != 5)
			{
				if( $listado[$revision_1][$aux_criterio] ==  $listado[$revision_2][$aux_criterio])
				{
					/** SON CASOS IGUALES */
					$valores[$aux_criterio] = $listado[$revision_1][$aux_criterio]; 
				}
				else
				{
					$diff = $listado[$revision_1][$aux_criterio] - $listado[$revision_2][$aux_criterio];
					if($diff < 0)
					{
						$diff = $diff * -1;
					}
					if($diff == 1)
					{
						if($listado[$revision_1][$aux_criterio] > $listado[$revision_2][$aux_criterio])
						{
							$valores[$aux_criterio] = $listado[$revision_1][$aux_criterio];
						}
						else
						{
							$valores[$aux_criterio] = $listado[$revision_2][$aux_criterio];
						}
					}
					else
					{
						/** INCONSISTENCIA POR DIFERENCIA MAYOR A 1 */
						$valores[$aux_criterio] = 'S/I';
						$CorreccionInconsistencia = new CorreccionInconsistencia();
						$CorreccionInconsistencia->id_texto = $listado[$revision_1]['id_texto'];
						$CorreccionInconsistencia->criterio = $aux_criterio;
						$CorreccionInconsistencia->evaluador_1 = $listado[$revision_1]['username'];
						$CorreccionInconsistencia->evaluador_2 = $listado[$revision_2]['username'];
						$CorreccionInconsistencia->valor_evaluador_1 = $listado[$revision_1][$aux_criterio];
						$CorreccionInconsistencia->valor_evaluador_2 = $listado[$revision_2][$aux_criterio];							
						$CorreccionInconsistencia->guardarObjeto();
						$valores['estado'] = 'inconsistencia';
					}
				}
			}
			else
			{
				for($j=1; $j <=5; $j++)
				{
					$aux_criterio_j = $aux_criterio.'_'.$j; 
					if( $listado[$revision_1][$aux_criterio_j] ==  $listado[$revision_2][$aux_criterio_j])
					{
						/** SON CASOS IGUALES */
						$valores[$aux_criterio_j] = $listado[$revision_1][$aux_criterio_j]; 
					}
					else
					{ 
						$valores[$aux_criterio_j] = 'S/I';
						$CorreccionInconsistencia = new CorreccionInconsistencia();
						$CorreccionInconsistencia->id_texto = $listado[$revision_1]['id_texto'];
						$CorreccionInconsistencia->criterio = $aux_criterio_j;
						$CorreccionInconsistencia->evaluador_1 = $listado[$revision_1]['username'];
						$CorreccionInconsistencia->evaluador_2 = $listado[$revision_2]['username'];
						$CorreccionInconsistencia->valor_evaluador_1 = $listado[$revision_1][$aux_criterio_j];
						$CorreccionInconsistencia->valor_evaluador_2 = $listado[$revision_2][$aux_criterio_j];
						$CorreccionInconsistencia->guardarObjeto();
						$valores['estado'] = 'inconsistencia'; 
					}
				}
			}			
		}
		//Funciones::mostrarArreglo($listado,true);
//		Funciones::mostrarArreglo($valores,true);  
		$this->asignacionDefinitiva($valores['id_texto'],$valores); 
	}
	
	function revisionInconsistencias($listado)
	{
		/** SE ASUME QUE ESTAN TODAS CERRADAS LAS CORRECCIONES PUES SE HIZO EL CHEQUEO PREVIAMENTE */ 
		Funciones::mostrarArreglo($listado,true);
		$total_listado 		= count($listado);
		
		foreach($listado[0] as $var => $val)
		{
			$aux = str_replace('criterio','',$var);
			if(trim($aux) == $var)
			{
				$valores_definitivos[$var] = $val;
			}
		} 
		
		/* REVISION CRITERIOS 5 QUE SON TEXTO*/
		for($i=1; $i <= 5; $i++)
		{			
			$criterio = 'criterio_5_'.$i; 
			$valor_criterio_anterior = '';
			$inconsistencia = false;
			for($j=0; $j < $total_listado; $j++)
			{
				$valor_criterio_actual = $listado[$j][$criterio]; 
				if(trim($valor_criterio_anterior) != '')
				{
					if($valor_criterio_anterior != $valor_criterio_actual)
					{
						/** INCONSISTENCIA */
						$ControlCorreccionInconsistencia = new ControlCorreccionInconsistencia();
						$ControlCorreccionInconsistencia->guardarInconsistencia($listado[$j]['id_texto'],$listado[$j]['id_tipo_texto'],$criterio); 
						$inconsistencia = true;
					}
				}
				$valor_criterio_anterior = $valor_criterio_actual;
			}
			if($inconsistencia)
			{
				$valores_definitivos[$criterio] = 'S/I';
				$valores_definitivos['estado'] = 'inconsistencia'; 
			}
			else
			{
				$valores_definitivos[$criterio] = $valor_criterio_actual;
			}
		}
		
		$total_criterios 	= 6;
		for($i=1; $i <= $total_criterios; $i++) /** REVISION CRITERIOS NUMERICOS */
		{
			if($i == 5)
			{
				continue;
			}
			$criterio = 'criterio_'.$i;
			$inconsistencia_criterio = false;
			$valor_criterio_anterior = '';
			$criterio_valor_maximo = 0;
			$criterio_valor_minimo = 100;
			
			if($listado[0][$criterio] == 'N/A')
			{
				$valores_definitivos[$criterio] = 'N/A';
				continue;
			}
			
			for($j=0; $j < $total_listado; $j++)
			{ 
				$valor_criterio_actual = $listado[$j][$criterio];  
				 
				if($valor_criterio_actual < $criterio_valor_minimo)
				{
					$criterio_valor_minimo = $valor_criterio_actual;
				}
				if($criterio_valor_maximo < $valor_criterio_actual )
				{
					$criterio_valor_maximo = $valor_criterio_actual;
				}				 
			}
			//echo $criterio_valor_maximo.' '.$criterio_valor_minimo.' '.$criterio.'<br>';
			$diferencia = $criterio_valor_maximo - $criterio_valor_minimo;
			if($diferencia < 2) /* SE SUBE AL SIGUIENTE VALOR*/
			{
				$valores_definitivos[$criterio] = $criterio_valor_maximo;
			}
			else
			{
				/* INCONSISTENCIA*/
				$valores_definitivos[$criterio] = 'S/I';
				$valores_definitivos['estado'] = 'inconsistencia';
				$ControlCorreccionInconsistencia = new ControlCorreccionInconsistencia();
				$ControlCorreccionInconsistencia->guardarInconsistencia($listado[0]['id_texto'],$listado[0]['id_tipo_texto'],$criterio); 				 
			}
		}
		Funciones::mostrarArreglo($valores_definitivos,true); 

		$this->asignacionDefinitiva($valores_definitivos['id_texto'],$valores_definitivos); 		
	}
	
	function guardarCorreccionDefinitiva($valores)
	{
		/** SE REVISA SI HAY MAS DE UNA REVISION POR TEXTO **/
		$ControlCorreccionUsuario = new ControlCorreccionUsuario();
		$listado = $ControlCorreccionUsuario->revisionCorreccionDoble($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['id_texto']); 
		//Funciones::mostrarArreglo($listado);
		//Funciones::mostrarArreglo(array('dddddddddddddd',$valores),true);
		$total = count($listado);
		
		if(is_array($listado) && $total > 0)
		{
			switch($total)
			{
				case '1':
					if($listado[0]['estado'] == 'cerrado')
					{
						/** SE GUARDA EL DEFINITVO PORQUE NO TIENE MAS DE UNA CORRECCION, FUE ASIGNADO SOLO UNA VEZ */ 
						$CorreccionDefinitivo = $this->asignacionDefinitiva($listado[0]['id_texto'],$listado[0]);					
						//Funciones::mostrarArreglo($CorreccionDefinitivo,true);	 	 
					} 
					else
					{
						// NO SE HACE NADA PUES FALTAN QUE SE CIERREN
					} 
				break;
				default:
					 
					$listado_cerrado = $ControlCorreccionUsuario->revisionRevisionesCerradas($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['id_texto']);
					//Funciones::mostrarArreglo($listado_cerrado);	 	 
					$total_cerradas = count($listado_cerrado);
					 
					if($total == $total_cerradas)
					{ 
						/** QUIERE DECIR QUE ESTÁN TODOS LOS TEXTOS CERRADOS Y HABRíA QUE REVISAR SI HAY INCONSISTENCIAS */ 
						$listado_revision = $ControlCorreccionUsuario->buscarInconsistencias($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['id_texto']);
						$total_revision = count($listado_revision);
						//Funciones::mostrarArreglo($listado_revision,true);
						if($total_revision > 1)
						{ 
							/* HAY INCONSISTENCIA Y HABRIA QUE REVISAR DE QUE TIPO SEGUN CLASIFICACION */
							$this->revisionInconsistencias($listado_revision);
						} 
						else
						{
							/* NO HAY INCONSISTENCIAS Y TODAS LA REVISIONES FUERON IGUALES Y HABRÍA QUE PASARLO A DEFINITIVO Y CERRARLO */
							$CorreccionDefinitivo = $this->asignacionDefinitiva($listado_revision[0]['id_texto'],$listado_revision[0]);		
						} 
					}
					else
					{  
						// NO SE HACE NADA PUES FALTAN QUE SE CIERREN
					} 
				break;
			}
		}
	}
	
	function revisionCierreProceso($valores)
	{
		/** SE TIENE QUE REVISAR SI EL PROCESO DEL DIA SE FINALIZA Y SI EL PROCESO DEL TIPO DE TEXTO FINALIZA */
		$ControlCorreccionUsuario = new ControlCorreccionUsuario();
		$pendientes = $ControlCorreccionUsuario->obtenerListadoDiaCompleto($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto']);
		//Funciones::mostrarArreglo($pendientes,true);
		if(!is_array($pendientes) || count($pendientes) == 0)
		{
			/** SE CIERRA EL PROCESO DEL DIA SI YA SE COMPLETO LA REVISIÓN */
			$CorreccionDia = new CorreccionDia();
			$CorreccionDia->buscarCorreccion($valores['id_correccion'],$valores['id_tipo_texto'],$valores['id_correccion_dia']); 
			$CorreccionDia->estado = 'cerrado';
			$CorreccionDia->guardarCorreccion($valores['id_correccion'],$valores['id_tipo_texto'],$valores['id_correccion_dia']);
			//Funciones::mostrarArreglo($CorreccionDia,true);  
			
			/** REVISAR QUE SE TENGA QUE CERRAR LA CORRECCION COMPLETA */
			$ControlCorreccionDia = new ControlCorreccionDia();
			$pendientes = $ControlCorreccionDia->obtenerDiaCorreccionActual($valores['id_correccion']);
			//Funciones::mostrarArreglo($pendientes,true);
			if(!is_array($pendientes) || count($pendientes) == 0)
			{
				$Correccion = new Correccion();
				$Correccion->buscarCorreccion($valores['id_correccion']);
				$Correccion->estado = 'cerrado';
				$Correccion->guardarCorreccion($valores['id_correccion']);
			} 
		}		
	}
	
	function mantenerAbiertoElemento($CorreccionUsuario)
	{
		/* SOLO PARA DESARROLLO*/
		$CorreccionUsuario->estado = 'pendiente';
		$CorreccionUsuario->time_cierre = '0';
		$CorreccionUsuario->criterio_6 = '0';
		$CorreccionUsuario->guardarCorreccionTexto($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['username'],$valores['id_texto']);
		return 'modificar';
	}
	
}
?>