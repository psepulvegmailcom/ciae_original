<?php

/**/

class NoticiaRelacionSitio extends Objetos 
{
	var $sourceTable = "view_noticias_site";

	function NoticiaRelacionSitio()
	{
		parent::Objetos();
		$this->dbKey = 'id_noticia';

	}
}

class NoticiaSitio extends Objetos 
{	
	var $sourceTable = "site_noticias_site";
	
	function NoticiaSitio() 
	{
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}
	
	function buscarObjeto($id_noticia,$id_site)
	{
		$where = "id_noticia = '".$id_noticia."' AND id_site = '".$id_site."' ";
		parent::loadObject($where);
	}

	function guardarObjeto($id_noticia,$id_site)
	{
		$where = "id_noticia = '".$id_noticia."' AND id_site = '".$id_site."' ";
		parent::saveObject($where);
	}
	
	function eliminarObjetoSite($id_noticia,$id_site) 
	{
		$where = "id_noticia = '".$id_noticia."' AND id_site = '".$id_site."' ";
		parent::destroyObject($where);
	}

}


class ControlNoticiaSitio extends ControlObjetos
{
	function ControlNoticiaSitio()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiaSitio();
		$this->order 	= 'id_noticia DESC, id_site ASC ';
		$this->key 		= 'id_noticia'; 
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function obtenerNoticiaSitio($id_noticia)
	{
		$this->where = "  id_noticia = '".$id_noticia."'  "; 
		return parent::obtenerListado();
	}	
}


class NoticiaObjeto extends Objetos 
{
	var $sourceTable = 'site_noticias';
			
	function NoticiaObjeto() 
	{
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}		 	
}

class ControlNoticiaSitioObjeto extends ControlObjetos
{
	function ControlNoticiaSitioObjeto()
	{
		parent::ControlObjetos();
		$this->obj 			= new NoticiaRelacionSitio();
		$ControlHtml 		= new ControlHtml();
		$this->order		= 'fecha DESC, id_noticia DESC, titulo ASC';
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
		$this->where_site = " AND id_site='".$ControlHtml->sitioUsuario()."'  ";
	}	
}

 
class NoticiasSimple extends Objetos
{
	var $sourceTable =  'site_noticias';
	
	function NoticiasSimple()
	{ 
		parent::Objetos();
	} 

} 

class ControladorNoticiasSimple  extends ControlObjetos
{ 
	var $order  = "fecha DESC";		
	var $obj; 
	var $key = 'id_noticia';
	function ControladorNoticiasSimple() 
	{ 
		/* CONEXION interna*/	
		$this->obj 				= new NoticiasSimple();
		$this->sourceTable 		= $this->obj->sourceTable;
		parent::ControladorDeObjetos();
	} 
	
	function eliminarVacias()
	{
		$sql = "DELETE FROM ".$this->sourceTable." WHERE titulo = ''";
		parent::consultarEspecifica($sql);
		
		$NoticiaRelacionSitio = new NoticiaRelacionSitio();
		$NoticiaSitio = new NoticiaSitio();
		$sql = "INSERT IGNORE INTO ".$NoticiaSitio->sourceTable."
		  SELECT n.id_noticia, '100' as id_site , '0' as 	activo 	, '0' as destacado , '0' as 	destacado_forzado  
		  FROM  ".$this->sourceTable." as n LEFT JOIN ".$NoticiaRelacionSitio->sourceTable." as ns ON n.id_noticia = ns.id_noticia   
		  WHERE ns.id_noticia IS NULL";
		parent::consultarEspecifica($sql);  
	} 
}

class Noticias extends Objetos
{
	var $sourceTable =  'view_noticias_site';
	
	function Noticias()
	{ 
		parent::Objetos();
	} 
} 

class ControlNoticias extends ControlObjetos
{
	function ControlNoticias()
	{
		parent::ControlObjetos();
		$this->obj 		= new Noticias();
		$this->order 	= 'fecha DESC, tipo, titulo';
		$this->key 		= 'id_noticia';
		$this->select   = VarSystem::formatoFechaSql('fecha');
		$this->where_idioma	= " AND (idioma = 'nn' OR idioma = '".VarSystem::obtenerIdiomaActual()."')   "; 
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function sinFiltroIdioma()
	{
		$this->where_idioma	= " ";
	} 
	
	function obtenerNoticiasHome()
	{ 
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."' AND destacado = 1 AND activo = 1 AND tipo = 'noticia' ".$this->where_idioma;
		return parent::obtenerListado();
	}

	function obtenerNoticiasHomeIE()
	{ 
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."' AND destacado = 1 AND activo = 1 AND tipo = 'noticia' AND investigaciones_ie = 0 AND (tipo_curso = '' OR tipo_curso = 0) ".$this->where_idioma;
		$this->order 	= " id_noticia DESC, titulo  LIMIT 3";
		return parent::obtenerListado();
	}	

	function obtenerNoticiasHomeVinc()
	{ 
		$this->select   = "";
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."' AND destacado = 1 AND activo = 1 AND tipo = 'noticia' AND investigaciones_ie = 0 AND (tipo_curso = '' OR tipo_curso = 0) ".$this->where_idioma;
		$this->order 	= " id_noticia DESC, titulo  LIMIT 4";
		return parent::obtenerListado();
	}

	function obtenerCursosHomeIE()
	{ 
		$this->select   = "";
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."' AND  cursos_ie = 1 AND activo= 1 AND (tipo_curso = 'diplomado' OR tipo_curso = 'magister') ".$this->where_idioma;
		
		$this->order 	= 'RAND(),'.$this->order;
		return parent::obtenerListado();
	}	

	function obtenerListadoPresentacionSitio()
	{ 
		$this->select   = "";
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."' AND  activo = 1 AND tipo = 'noticia' AND noticia_tipo='presentaciones' AND investigaciones_ie = 0 ".$this->where_idioma;
		$this->order 	= " fecha DESC, titulo LIMIT 4";
		return parent::obtenerListado();
	}
	    
	function obtenerNoticia($id_noticia)
	{ 
		$this->where = " id_noticia='".$id_noticia;
		return parent::obtenerListado();
	}

	function obtenerNoticiaSimple($id_noticia)
	{ 
		$this->select   = "";
        $this->where = " id_noticia=".$id_noticia;
        $this->order 	= "";
		return parent::obtenerListado();
	} 
	
	function obtenerNoticiasRecientes()
	{ 		
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 
		AND tipo = 'noticia' ".$this->where_idioma ;
		$this->order = 'fecha DESC, tipo, titulo  LIMIT 2';
		return parent::obtenerListado();
	}
	/** Investigaciones IE **/
	function obtenerInvestigacionesIeHome()
	{ 		
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND destacado = 1 AND activo = 1 AND tipo = 'noticia' AND investigaciones_ie = 1  ".$this->where_idioma ;
		$this->order = 'fecha DESC, tipo, titulo  LIMIT 3';
		return parent::obtenerListado();
	}
	
 	/** Investigaciones IE **/
	function obtenerInvestigacionesIEInvestigacion()
	{ 		
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND destacado = 1 AND activo = 1 AND tipo = 'noticia' AND investigaciones_ie = 1  ".$this->where_idioma ;
		$this->order = 'fecha DESC, tipo, titulo  LIMIT 10';
		return parent::obtenerListado();
	}   	
    
   	function obtenerListadoPorBusquedaTrabajo()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
		$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->order = 'fecha DESC, tipo, titulo ';
		$this->group = $this->key; 
		return parent::obtenerListado();
	}
	
   	function obtenerListadoPostgradosHome()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
	//	$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->where = "(tipo_curso = 'postgrado' OR tipo_curso='curso' OR tipo_curso= 'diplomado'   OR tipo_curso= 'magister') AND activo=1 ";
		$this->order = ' tipo_curso  DESC, fecha DESC, tipo, titulo ';
		$this->group = $this->key; 
		return parent::obtenerListado();
	}
	
   	function obtenerListadoPostgrados()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
	//	$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->where = "tipo_curso = 'postgrado' AND activo=1 ";
		$this->order = 'fecha DESC, tipo, titulo ';
		$this->group = $this->key; 
		return parent::obtenerListado();
	}
	function obtenerListadoCursosDiplomadosTotal()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
	//	$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
	    $this->where = "(tipo_curso = 'postgrado' OR tipo_curso='curso' OR tipo_curso= 'diplomado' OR tipo_curso= 'magister') AND activo = 1 ";
		$this->order = 'fecha DESC, tipo, titulo ';
		$this->group = $this->key; 
		return parent::obtenerListado();
	}		

	
   	function obtenerListadoCursos()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
	//	$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->where = "tipo_curso = 'curso' AND activo=1 ";
		$this->order = 'fecha DESC, tipo, titulo ';
		$this->group = $this->key; 
		return parent::obtenerListado();
	}		

   	function obtenerListadoDiplomados()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
	//	$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->where = "tipo_curso = 'diplomado' AND activo=1 ";
		$this->order = 'fecha DESC, tipo, titulo ';
		$this->group = $this->key; 
		return parent::obtenerListado();
	}

	/*funcion listar magister desde BD*/
	function obtenerListadoMagister()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
	//	$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->where = "tipo_curso = 'magister' AND activo=1    ";
		$this->order = 'fecha DESC, tipo, titulo ';
		$this->group = $this->key;
		return parent::obtenerListado();
	}


	function obtenerListadoDoctorado()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
	//	$this->where = " fecha >=$fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->where = "tipo_curso = 'doctorado' AND activo=1   ";
		$this->order = 'fecha DESC, tipo, titulo ';
		$this->group = $this->key;
		return parent::obtenerListado();
	}


    
    function obtenerListadoTrabajoCaducado()
	{ 	
	    $fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
		$this->where = " fecha < $fecha_hoy AND trabajo = '1' ".$this->where_idioma ;
		$this->order = 'fecha DESC, tipo, titulo limit 6';
		$this->group = $this->key; 
		return parent::obtenerListado();
	}
	
    function obtenerListadoTipoPostgrado($tipo)
	{ 	
	   if($tipo!='') {
		$fecha= getdate();
        $fecha_hoy= "'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";
		//$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND
		$this->where = " noticia_tipo = '".$tipo."' ".$this->where_idioma."   " ;
		$this->order = 'fecha DESC, tipo, titulo limit 6';
		$this->group = $this->key; 
		return parent::obtenerListado();
		}
	}
       	
           
    function obtenerNoticiasDestacadaForzada()
	{ 		
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'  AND activo = 1 AND destacado_forzado = 1 
		AND tipo = 'noticia' ".$this->where_idioma ;
		$this->order = 'fecha DESC, tipo, titulo  LIMIT 1';
		return parent::obtenerListado();
	}	
	
	function obtenerEventosHome($orden_fecha= 'DESC')
	{ 
		$this->where = " (destacado = 1 or destacado_forzado=1) AND  
		nombre_site='".VarSystem::getPathVariables('web_site')."' 
		AND activo = 1 AND tipo = 'evento' ".$this->where_idioma;		
		$this->order 	= 'fecha '.$orden_fecha.', tipo, titulo';
		// $ControlRecursos->$this->select;
		return parent::obtenerListado();
	}
	
	function obtenerEventosHomeIE($orden_fecha= 'DESC')
	{ 
		$this->where = " (destacado = 1 or destacado_forzado=1) AND  
		nombre_site='".VarSystem::getPathVariables('web_site')."' 
		AND activo = 1 AND tipo = 'evento' ".$this->where_idioma;		
		$this->order 	= 'fecha '.$orden_fecha.', tipo, titulo LIMIT 3';
		// $ControlRecursos->$this->select;
		return parent::obtenerListado();
	}			
	
	function obtenerEventos($agno='',$mes='')
	{
		$agno_actual = date('Y')+1;
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."' AND  fecha < '".$agno_actual."-01-01' ".$this->where = $this->sinFiltroAgnoMes($agno,$mes)." AND tipo = 'evento'   AND activo = 1 ".$this->where_idioma; 
		
		//echo $this->where;
		return parent::obtenerListado();
	} 
	
	function obtenerPasados($agno='',$mes='')
	{  
		$agno_actual = date('Y');
		$this->where = "  fecha < '".$agno_actual."-01-01' ".$this->where = $this->sinFiltroAgnoMes($agno,$mes)." AND  activo = 1 ".$this->where_idioma;return parent::obtenerListado();
	}   
	
	function obtenerNoticias($agno='',$mes='')
	{
		$this->where = "activo = 1 ".$this->sinFiltroAgnoMes($agno,$mes)."  AND tipo = 'noticia'  ".$this->where_idioma;
		return parent::obtenerListado();
	}
     
    function obtenerNoticiasBoletinFoco($agno='',$mes='')
	{
		$this->where = "  fecha > '2016-12-31' AND activo = 1 AND tipo = 'noticia' AND id_site=1  ".$this->where_idioma;
		return parent::obtenerListado();
	} 

    function obtenerNoticiasBoletinEspecial($agno='',$mes='')
	{
		$this->where = "  fecha > '2014-04-30' AND tipo = 'noticia' AND (id_site=1 OR id_site = 4)  ".$this->where_idioma;
		return parent::obtenerListado();
	}  
	
	function sinFiltroAgnoMes($agno,$mes='')
	{
		if( trim($agno) == 'All' || trim($agno) == 'Todo')
		{
			$where_filtro = '';
		}
		else
		{
			if(trim($agno) == '' )
			{
				$agno = date('Y');
			}
			if(trim($mes) == '')
			{
				$where_filtro = " AND fecha >= '".$agno."-01-01' AND fecha <= '".$agno."-12-31' ";
			}
			else
			{
				if($mes < 10)
				{
					$mes = '0'.$mes;
				}
				$where_filtro = " AND fecha <= '".$agno."-".$mes."-01' AND fecha >= '".$agno."-".$mes."-31' ";
			} 
		}
		$where_filtro = '';
		return $where_filtro;
	}
	
	function obtenerAgnosMesesNoticias()
	{  
		$sql = "SELECT DISTINCT DATE_FORMAT( fecha , '%Y' ) AS agno 
				FROM  ".$this->sourceTable."
				WHERE ".$this->where."
				ORDER BY fecha DESC " ;
				
		return parent::getQuery($sql); 
	}   
	
	function obtenerRss()
	{  
		$this->order 	= 'fecha DESC, titulo';
		$this->where 	= "   activo = 1 ".$this->where_idioma."AND 
		nombre_site='".VarSystem::getPathVariables('web_site')."' ";
		 
		return parent::obtenerListado(); 
	} 
	
	function publicarNoticias($fecha,$site )
	{
		$where_string = "fecha <= '".$fecha."' AND destacado = 1 AND activo = 0  AND id_site = '".$site."'  ";		
		$sql = "UPDATE ".$this->obj->sourceTable." SET  activo = 1 WHERE ".$where_string;		
		// echo $sql.'<br>';
		parent::getQuery($sql); 
	}
	
	/** SE DESPUBLICAN DEL HOME LAS NOTICIAS QUE SON MAS ANTIGUAS DE $DIAS */
	function caducarNoticias($fecha,$site,$tipo='all')
	{ 
		$where_string = "fecha < '".$fecha."' AND activo = 1 AND destacado = 1 AND destacado_forzado = 0  AND id_site = '".$site."' ";
		 
		if($tipo != 'all')
		{
			$where_string .= " AND tipo = '".$tipo."' ";
		}	 
		$sql = "UPDATE ".$this->obj->sourceTable." SET  destacado = 0 WHERE ".$where_string;
		//echo $sql.'<br>';
		parent::getQuery($sql); 
	} 
	
	function caducarNoticiasForzar($fecha,$site)
	{ 
		$where_string = "fecha < '".$fecha."' AND activo = 1 AND destacado = 1  AND destacado_forzado = 1  AND id_site = '".$site."' ";
		 
		$sql = "UPDATE ".$this->obj->sourceTable." SET  destacado = 0  , destacado_forzado = 0  WHERE ".$where_string;
		//echo $sql.'<br>';
		parent::getQuery($sql); 
	} 
	
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 
		$NoticiaRelacionSitio = new NoticiaRelacionSitio();
		if ($order=="") 
		{
			$order=" ORDER BY noti.fecha DESC, noti.id_noticia DESC ";
		}
		$sql =" SELECT   $palabra noti.*
		FROM  ".$NoticiaRelacionSitio->sourceTable." as noti  
		WHERE noti.activo = 1 AND 
		noti.nombre_site='".VarSystem::getPathVariables('web_site')."' 
		$condicion  
		GROUP BY  noti.id_noticia $order $limite";
		//echo $sql; 
	 	return parent::getQuery($sql);
	}
	
	function obtenerUltimaNoticiaConGaleria()
	{ 		
		$sql =" SELECT  noti.titulo, $palabra noti.bajada, noti.*
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE tiene_galeria = 1 AND 
		noti.nombre_site='".VarSystem::getPathVariables('web_site')."' 
		Order by fecha desc limit 1";	 
	 	return parent::getQuery($sql);
	}
		
}

class NoticiasPersona extends Objetos
{
	var $sourceTable =  'view_personas_noticias';
	function NoticiasLink()
	{ 
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}
}

class NoticiasComite extends Objetos
{
	// var $sourceTable =  'view_profesores_comite_noticias';
	var $sourceTable =  'view_personas_noticias';
	function NoticiasLink()
	{
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}

}

class NoticiasProfesor extends Objetos
{
	// var $sourceTable = 'view_profesores_noticias';
	var $sourceTable =  'view_personas_noticias';
	function NoticiasLink()
	{ 
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}
}

class NoticiasProfesorAcademico extends Objetos
{
	// var $sourceTable = 'view_profesores_academicos_noticias';
	var $sourceTable =  'view_personas_noticias';
	function NoticiasLink()
	{ 
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}
}

class NoticiasProfesorVisitante extends Objetos
{
	// var $sourceTable = 'view_profesores_visitantes_noticias';
	var $sourceTable =  'view_personas_noticias';
	function NoticiasLink()
	{ 
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}
}

class ControlNoticiasComite extends ControlObjetos
{
	function ControlNoticiasComite()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasComite();
		$this->order 	= 'orden ASC';
		$this->key 		= 'id_noticia';
		$this->select   = "   ";
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function obtenerComite($id_noticia)
	{
		// id_tipo_persona 53 (Comite)
		$this->where = "id_noticia = ".$id_noticia." AND id_tipo_persona = 53";
		return parent::obtenerListado();
	}

	function obtenerPersonas($id_noticia)
	{
		return $this->obtenerComite($id_noticia);
	}
	
	function eliminarElementosNoticia($id)
	{
		$condition =  "id_noticia = '".$id."'";
		return parent::deleteElement($condition);
	}
	
	function eliminarElementosNoticiaPersona($id)
	{
		$condition =  "id_persona = '".$id."'";
		return parent::deleteElement($condition);
	}
}

class ControlNoticiasProfesor extends ControlObjetos
{
	function ControlNoticiasProfesor()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasProfesor();
		$this->order 	= 'orden ASC';
		$this->key 		= 'id_noticia';
		$this->select   = "   ";
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function obtenerProfesores($id_noticia)
	{
		// id_tipo_persona 51 (Profesores)
		$this->where = "id_noticia = ".$id_noticia." AND id_tipo_persona = 51";
		return parent::obtenerListado();
	}

	function obtenerPersonas($id_noticia)
	{
		return $this->obtenerProfesores($id_noticia);
	}

	function eliminarElementosNoticia($id)
	{
		$condition =  "id_noticia = '".$id."'";
		return parent::deleteElement($condition);
	}
	
	function eliminarElementosNoticiaPersona($id)
	{
		$condition =  "id_persona = '".$id."'";
		return parent::deleteElement($condition);
	}
}

class ControlNoticiasProfesorAcademico extends ControlObjetos
{
	function ControlNoticiasProfesorAcademico()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasProfesorAcademico();
		$this->order 	= 'orden ASC';
		$this->key 		= 'id_noticia';
		$this->select   = "   ";
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerProfesoresAcademico($id_noticia)
	{
		// id_tipo_persona 52 (Académicos)
		$this->where = "id_noticia = ".$id_noticia." AND id_tipo_persona = 52";
		return parent::obtenerListado();
	}

	function obtenerPersonas($id_noticia)
	{
		return $this->obtenerProfesoresAcademico($id_noticia);
	}
	
	function eliminarElementosNoticia($id)
	{
		$condition =  "id_noticia = '".$id."'";
		return parent::deleteElement($condition);
	}
	
	function eliminarElementosNoticiaPersona($id)
	{
		$condition =  "id_persona = '".$id."'";
		return parent::deleteElement($condition);
	}
}

class ControlNoticiasProfesorVisitante extends ControlObjetos
{
	function ControlNoticiasProfesorVisitante()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasProfesorVisitante();
		$this->order 	= 'orden ASC';
		$this->key 		= 'id_noticia';
		$this->select   = "   ";
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerProfesores($id_noticia)
	{
		// id_tipo_persona 55 (Visitantes)
		$this->where = "id_noticia = ".$id_noticia." AND id_tipo_persona = 55";
		return parent::obtenerListado();
	}

	function obtenerPersonas($id_noticia)
	{
		return $this->obtenerProfesores($id_noticia);
	}
	
	function eliminarElementosNoticia($id)
	{
		$condition =  "id_noticia = '".$id."'";
		return parent::deleteElement($condition);
	}
	
	function eliminarElementosNoticiaPersona($id)
	{
		$condition =  "id_persona = '".$id."'";
		return parent::deleteElement($condition);
	}
}

class ControlNoticiasPersona extends ControlObjetos
{
	function ControlNoticiasPersona()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasPersona();
		$this->order 	= 'orden ASC, apellido_paterno ASC ';
		$this->key 		= 'id_noticia';
		$this->select   = "   ";
		$this->sourceTable = $this->obj->sourceTable;
	} 

	function obtenerPersonas($id_noticia)
	{
		$this->where = "id_noticia = ".$id_noticia;
		return parent::obtenerListado();
	}

	function eliminarElementosNoticia($id)
	{
		$condition =  "id_noticia = '".$id."'";
		return parent::deleteElement($condition);
	}

	function eliminarElementosNoticiaPersona($id)
	{
		$condition =  "id_persona = '".$id."'";
		return parent::deleteElement($condition);
	}	
}

class NoticiasLink extends Objetos
{
	var $sourceTable =  'site_noticias_link'; 
	
	function NoticiasLink()
	{ 
		parent::Objetos();
		$this->dbKey = 'id_link';
	} 
	
	function eliminarVacios()
	{		
		$condition =  "(link = '' AND texto = '') OR ( id_noticia = 0)";
		parent::destroyObject($condition);
	}
}
 
class ControlNoticiasLink extends ControlObjetos
{
	function ControlNoticiasLink()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasLink();
		$this->order 	= 'orden ASC';
		$this->key 		= 'id_link';
		$this->select   = "   ";
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerLinks($id_noticia)
	{
		$this->where = "id_noticia = ".$id_noticia;
		return parent::obtenerListado();
	}
	
	function eliminarElementosNoticia($id)
	{
		$condition =  "id_noticia = '".$id."'";
		return parent::deleteElement($condition);
	}
	
	function eliminarElementosNoticiaLink($id)
	{
		$condition =  "id_link = '".$id."'";
		return parent::deleteElement($condition);
	}	
}

/** 
** PERMITE ALMACENAR LA CANTIDAD DE VISITAS A LAS NOTICIAS DEPENDIENDO DEL ORIGEN DEL LINK 
**/

class NoticiasVisitas extends Objetos
{
	var $sourceTable =  'site_noticias_visita';
	
	function NoticiasVisitas()
	{ 
		parent::Objetos();
	} 
	
	function agregarVisita()
	{
		$this->fecha = time();  
		$this->ip_address = $_SERVER['REMOTE_ADDR'];		
		$this->sitio 		= $_SERVER['SERVER_NAME'];
		$this->url 			= $_SERVER['REQUEST_URI'];
		$this->saveObject();
	}
}


class ControladorNoticiasVisitas extends ControladorDeObjetos
{
	var $obj;
	function ControladorNoticiasVisitas()
	{
		/* CONEXION INTERNA */
		$this->obj = new NoticiasVisitas();
		$this->sourceTable = $this->obj->sourceTable;
		parent::ControladorDeObjetos(); 
	}
	
	function registrarVisitaNoticias($id,$externo)
	{		
		$NoticiasVisitas = new NoticiasVisitas();
		$NoticiasVisitas->id_noticia = $id;
		$NoticiasVisitas->tipo_visita = 'local'; 
		if(isset($externo) && trim($externo) != '')
		{		
			$aux = explode("_",$externo);
			//Funciones::mostrarArreglo($aux,false,"externos_externos");
			$NoticiasVisitas->tipo_visita = $aux[0];
		}
		$NoticiasVisitas->agregarVisita();
		if(isset($externo) && trim($externo) != '' && count($aux)>2)
		{
			//Funciones::mostrarArreglo($aux,false,"externos_externos");
			$caso_envio_md5 = array_pop($aux);
			$email_md5 = array_pop($aux);
			
			$caso_envio_md5 = $aux[2];
			$email_md5 = $aux[1];
			$ControladorInscripcionDestinoDetalle = new ControladorInscripcionDestinoDetalle();
			$ControladorInscripcionDestinoDetalle->agregarVisitaCorreo($caso_envio_md5);
			$ControladorInscripcionDestino = new ControladorInscripcionDestino();
			$ControladorInscripcionDestino->agregarVisitaCorreo($caso_envio_md5,$email_md5);
		}
	}
	 
} 
  


/** VISUALIZACION RSS DE LAS NOTICIAS */
class  ControlRss extends ControlObjetos
{
	function ControlRss()
	{
		parent::ControlObjetos();
		$this->obj 		= new Boletines();
		$this->order 	= 'id_boletin DESC, mes DESC, agno DESC';
		$this->key 		= 'id_boletin'; 
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerInformacion()
	{
		$ControlNoticias = new ControlNoticias();
		 
		$maximo = VarSystem::getTotalListarRss();
		$noticias = $ControlNoticias->obtenerRss();
		$output = array();
		$total = count($noticias);
		if($total >= $maximo)
		{
			$total = $maximo;
		}
		for($i=0; $i < $total; $i++)
		{
			$output[$i] = $noticias[$i];
		}
		return $output;	
					
	}
} 


/** PUBLICACIONES PERSONAS **/ 
class NoticiaPersona extends Objetos
{
	var $sourceTable =  'site_postgrado_persona'; 

	function NoticiaPersona()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_noticia'; 
	} 

	
	function eliminarObjetoPersona()
	{
		if(trim($this->id_persona) == 1)
		{
			$where = "id_persona = ".$this->id_persona." AND id_noticia = ".$this->id_publicaciones." AND orden = ".$this->orden." AND persona_nombre LIKE '%".$this->nombre_extra."%'"	;
		}
		else
		{
			$where = "id_persona = ".$this->id_persona." AND id_noticia = ".$this->id_publicaciones 	;			
		} 
		parent::destroyObject($where);
	}	
} 

class ControlNoticiaPersona extends ControlObjetos
{
	
	function ControlNoticiaPersona()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasPersona();
		$this->order 	= 'orden';		
		parent::prepararObjeto();
	} 
	
	function obtenerListadoPorNoticia($id_noticia)
	{ 
		$this->where = " id_noticia = ".$id_noticia;
		return parent::obtenerListado();
	}
	
	function obtenerListadoPorPersona($id_persona)
	{ 
		$this->where = " id_persona = ".$id_persona;
		return parent::obtenerListado();
	}
	
	function obtenerListadoPersonasCompleto()
	{
		$Persona = new Persona(); 
		$Noticias = new Publicaciones();
		$sql =" SELECT per.nombre_publicacion,pub.persona_nombre , pub.*, per.nombre, per.apellido_paterno, per.apellido_materno
		FROM ".$Persona->sourceTable." as per, ".$this->obj->sourceTable." as pub , ".$Noticias->sourceTable." as pubr
		WHERE  pubr.id_noticia = pub.id_noticia AND per.id_persona = pub.id_persona 
		ORDER BY pub.id_noticia,pub.orden";
		//echo $sql;
		$result = parent::getQuery($sql);
		 
		$autores = '';
		$id_noticia = 0;
		$listado_autores = array(); 
		$i_listado_autores = 0;
		$total_result = count($result);
		if(is_array($result) && $total_result > 0)
		{			
			//Funciones::mostrarArreglo($result,true);
			for($i=0; $i < $total_result; $i++)
			{
				if($id_noticia != $result[$i]['id_noticia'])
				{
					if($id_noticia > 0)
					{
						$listado_autores[$id_noticia] = $autores;
						$autores = ''; 
					}
					$id_noticia = $result[$i]['id_noticia'];					
				}
				if(trim($autores) != '')
				{
					$autores .= "; ";
				}
				if($result[$i]['id_persona'] > 1)
				{
					if( trim($result[$i]['titulo']) != '')
					{
						$autores .= $result[$i]['titulo'];
					}	
					else
					{
						$autores .= trim($result[$i]['apellido_paterno']).', '.trim($result[$i]['nombre']);
					}	
					$autores .= $result[$i]['persona_nombre'];
				}
				else
				{
					$autores .= $result[$i]['persona_nombre'];					 
				}				 	
			}
			//Funciones::mostrarArreglo($listado_autores,true);
		}	
		return $listado_autores;	
	}
	
	function obtenerListadoPersonas($id_noticia)
	{
		$Persona = new Persona();
		$ControladorHTML  = new ControladorHTML();
		$Noticias = new Noticias();
		$sql =" SELECT per.nombre_publicacion,pub.persona_nombre , pub.*, per.nombre, per.apellido_paterno, per.apellido_materno
		FROM ".$Persona->sourceTable." as per, ".$this->obj->sourceTable." as pub , ".$Noticias->sourceTable." as pubr
		WHERE pubr.activo = 1 AND pubr.id_noticia = pub.id_noticia AND per.id_persona = pub.id_persona AND pub.id_noticia = ".$id_noticia."

		 ORDER BY pub.orden";
		 //echo $sql;
		$result = parent::getQuery($sql);
		$autores = '';
		if(is_array($result) && count($result) > 0)
		{
			for($i=0; $i < count($result); $i++)
			{
				if($i > 0)
				{
					$autores = trim($autores).'; ';
				}
				if($result[$i]['id_persona'] == 1)
				{
					$autores .= trim($result[$i]['persona_nombre']); 
				}
				else
				{
					$aux = '';
					if(trim($result[$i]['titulo']) != '')
					{
						$aux .= trim($result[$i]['titulo']); 
					}
					else
					{						
						$aux .=  trim($result[$i]['apellido_paterno']).', '. strtoupper(substr(trim($result[$i]['nombre']),0,1)).'.';
					}
					if(trim($result[$i]['persona_nombre']) != '')
					{
						$aux .= ' '.trim($result[$i]['persona_nombre']);
					}  
					$autores .= $ControladorHTML->linkPersona($result[$i]['id_persona'],$aux);
				}	
			}
		}
		return trim($autores);
	} 
	
	function eliminarReemplazoPersonaNoticia($id_persona,$nombre)
	{
		$sql = "UPDATE  ".$this->obj->sourceTable." SET id_persona = '1',
persona_nombre = '".$nombre."' WHERE    id_persona ='".$id_persona."' ";
 		//Funciones::mostrarArreglo($sql,true);
	 	return parent::getQuery($sql);
	}	
}



?>