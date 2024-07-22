<?php

class RecursoLinkObjeto extends Objetos
    {
    	var $sourceTable = 'view_recursos_link_site';

    	function RecursoLinkObjeto()
    	{
    		parent::Objetos();
    		$this->dbKey = 'id_link';
    	}
    }

class RecursoRelacionSitio extends Objetos
	{
		var $sourceTable = "view_recursos_site";

		function RecursoRelacionSitio()
		{
			parent::Objetos();
			$this->dbKey = 'id_recurso';

		}
	}

class RecursoLinkRelacionSitio extends Objetos
{
	var $sourceTable = "view_recursos_link_site";

	function RecursoLinkRelacionSitio()
	{
		parent::Objetos();
		$this->dbKey = 'id_link';

	}
}

class RecursoSitio extends Objetos
{
	var $sourceTable = "site_recursos_site";

	function RecursoSitio()
	{
		parent::Objetos();
	}

	function buscarObjeto($id_recurso,$id_site)
	{
		$where = " id_recurso = '".$id_recurso."' AND id_site = '".$id_site."' ";
		parent::loadObject($where);
	}

	function guardarObjeto($id_recurso,$id_site)
	{
		$where = " id_recurso = '".$id_recurso."' AND id_site = '".$id_site."' ";
		parent::saveObject($where);
	}


	function eliminarObjetoSite($id_recurso,$id_site)
	{
		$where = " id_recurso = '".$id_recurso."' AND id_site = '".$id_site."' ";
		parent::destroyObject($where);
	}

	function eliminarObjeto($id_recurso)
	{
		$where = " id_recurso = '".$id_recurso."' ";
		parent::destroyObject($where);
	}

}


class ControlRecursoSitio extends ControlObjetos
{
	function ControlRecursoSitio()
	{
		parent::ControlObjetos();
		$this->obj 			= new RecursoSitio();
		$this->order		= 'id_recurso DESC, id_site ASC';
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}


	function obtenerRecursosSitio($id_recurso)
	{
		$this->where = "  id_recurso = '".$id_recurso."'  ";
		return parent::obtenerListado();
	}
}


class ControlRecursoLinkObjeto extends ControlObjetos
{
	function ControlRecursoLinkObjeto()
	{
		parent::ControlObjetos();
		$this->obj 			= new RecursoLinkObjeto();
		$this->order		= 'fecha DESC, id_link DESC, titulo ASC';
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}

	function agnoActual()
	{
		$year = date("Y");
		$this->where = "  fecha <= '".$year."-12-31' AND fecha >= '".$year."-01-01'  ";
	}

	function agnoHistorico()
	{
		$year = date("Y");
		$this->where = "  fecha < '".$year."-01-01'  ";
	}
}

class RecursosObjeto extends Objetos
{
	var $sourceTable = 'site_recursos';

	function RecursosObjeto()
	{
		parent::Objetos();
		$this->dbKey = 'id_recurso';
	}
}


class ControlRecursosSitioObjeto extends ControlObjetos
{
	function ControlRecursosSitioObjeto()
	{
		parent::ControlObjetos();
		$this->obj 			= new RecursoRelacionSitio();
		$this->order		= 'fecha DESC, id_recurso DESC, titulo ASC';
		$this->select		= 'fecha  , id_recurso  , titulo ';
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}

	function eliminarVacias()
	{
		$RecursoSitio 	= new RecursoSitio();
		$RecursosObjeto = new RecursosObjeto();
		$llave = $RecursosObjeto->dbKey;

		$sql = "DELETE FROM ".$RecursosObjeto->sourceTable." WHERE titulo = ''";
		parent::consultarEspecifica($sql);

		$sql = "DELETE FROM ".$RecursoSitio->sourceTable." WHERE ".$llave." IN ( SELECT * FROM (
		  SELECT n.".$llave." 
		  FROM  ".$RecursoSitio->sourceTable." as n LEFT JOIN ".$RecursosObjeto->sourceTable." as ns ON n.".$llave." = ns.".$llave."   
		  WHERE ns.".$llave." IS NULL) as t )";
		  //echo $sql;
		parent::consultarEspecifica($sql);
	}
}


class Recursos extends Objetos
{
	var $sourceTable =  'view_recursos_site';

	function Recursos()
	{
		parent::Objetos();
	}
}


class TipoRecursosEstructura extends Objetos
{
	var $sourceTable =  'site_tipo_recursos_estructura';

	function TipoRecursosEstructura()
	{
		parent::Objetos();
		$this->dbKey = 'id_tipo_estructura';
	}
    function buscarObjeto($opcion)
	{
        $ControlSite = new ControlSite;
		$site = $ControlSite->NombreSite(VarSystem::getPathVariables('web_site'));
		$this->site_id = $site[0]['id_site'];
		$where = "opcion_site = '".$opcion."' AND id_site = '".$this->site_id."'  ";
		parent::loadObject($where);
    }
}


class ControlTipoRecursosEstructura extends ControlObjetos
{
	function ControlTipoRecursosEstructura()
	{
		parent::ControlObjetos();
		$this->obj = new TipoRecursosEstructura();
        $this->select		= 'tipo_estructura  , opcion_site';
		$this->order 		= 'orden';
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}

	function obtenerListado($id_site=array())
	{
		if (is_array($id_site) && count($id_site))
		{
			$this->where = '';
			foreach($id_site as $var => $val)
			{
				$this->where .= " rt.id_site ='".$val['id_site']."' OR";
			}
			$this->where = mb_strcut($this->where,0,(strlen($this->where)-2));
		}
		else
		{

			if(is_numeric($id_site))
			{
				$this->where =  " rt.id_site ='".$id_site."' ";
			}else{
                $this->where = 1;
			}
		}


		$Site = new Site();
		$sql = "SELECT rt.*, ss.*
		FROM ".$this->sourceTable." as rt,  ".$Site->sourceTable." as ss
		WHERE rt.id_site = ss.id_site AND (".$this->where.")
		ORDER BY rt.id_site, rt.orden";

		return parent::getQuery($sql);
		//return parent::obtenerListado();
	}

}

class TipoRecursos extends Objetos
{
	var $sourceTable =  'site_tipo_recursos';

	function TipoRecursos()
	{
		parent::Objetos();
		$this->dbKey = 'id_tipo';
	}
}

class ControlTipoRecursos extends ControlObjetos
{
	function ControlTipoRecursos()
	{
		parent::ControlObjetos();
		$this->obj = new TipoRecursos();
		$this->order = 'orden';
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	}

	function obtenerListado($id_site=array())
	{
		if (is_array($id_site) && count($id_site))
		{
			$this->where = '';
			foreach($id_site as $var => $val)
			{
				$this->where .= " rt.id_site ='".$val['id_site']."' OR";
			}
			$this->where = mb_strcut($this->where,0,(strlen($this->where)-2));
		}
		else
		{

			if(is_numeric($id_site))
			{
				$this->where =  " rt.id_site ='".$id_site."' ";
			}else{
                $this->where = 1;
			}
		}
		$Site = new Site();
		$sql = "SELECT rt.*, ss.*
		FROM ".$this->sourceTable." as rt,  ".$Site->sourceTable." as ss
		WHERE rt.id_site = ss.id_site AND (".$this->where.")
		ORDER BY rt.id_site, rt.orden";
		return parent::getQuery($sql);
		//return parent::obtenerListado();
        //Funciones::mostrarArreglo($sql,true);
	}

	function obtenerNombreTipo($id_tipo)
	{
		$this->where = "id_tipo = ".$id_tipo;
		return parent::obtenerListado();
	}
}


class ControlRecursos extends ControlObjetos
{
	function ControlRecursos()
	{
		parent::ControlObjetos();
		$this->obj 		= new Recursos();
		$this->order 	= 'rand() ';
		$this->key 		= 'id_recurso';
		$this->select   = VarSystem::formatoFechaSql('fecha');
		$this->where_idioma	= " AND (idioma = 'nn' OR idioma = '".VarSystem::obtenerIdiomaActual()."')   ";
		$this->sourceTable = $this->obj->sourceTable;
	}

	function sinFiltroIdioma()
	{
		$this->where_idioma	= " ";
	}

	function obtenerRecursosHome()
	{
		$this->where = " destacado = 1  AND activo = 1 AND 
		nombre_site='".VarSystem::getPathVariables('web_site')."'  ".$this->where_idioma;
		$this->order 	= ' rand() limit 3 ';
		return parent::obtenerListado();
	}

	function obtenerRecursosHomeCIAE()
	{
		$this->where = " destacado = 1  AND activo = 1 AND 
		nombre_site='".VarSystem::getPathVariables('web_site')."'  ".$this->where_idioma;
		$this->order 	= ' fecha DESC limit 7 ';
		return parent::obtenerListado();
	}

	function obtenerVideosHome()
	{
		$this->where = " destacado = 1  and destacado_forzado = 1 AND activo = 1 AND id_tipo = 3 AND 
		 nombre_site='".VarSystem::getPathVariables('web_site')."'  ".$this->where_idioma;
		$this->order 	= 'fecha rand limit 1 ';
		return parent::obtenerListado();
	}

 	function obtenerVideosMejorMatematica()
	{
		$this->where = " destacado = 1  AND activo = 1 AND id_tipo = 9 AND 
		 nombre_site='".VarSystem::getPathVariables('web_site')."'  ".$this->where_idioma;
		$this->order 	= 'fecha desc limit 1 ';
		return parent::obtenerListado();
	}

	function obtenerLinksHome()
	{
		$this->where = " destacado = 1 AND activo = 1 AND id_tipo = 2 ".$this->where_idioma;
		return parent::obtenerListado();
	}

	function obtenerArchivosHome()
	{
		$this->where = " destacado = 1 AND activo = 1 AND id_tipo = 1 ".$this->where_idioma;
		return parent::obtenerListado();
	}

	function obtenerVideos($agno='',$mes='')
	{
		$agno_actual = date('Y')+1;
		$this->where = "  fecha < '".$agno_actual."-01-01' ".$this->where = $this->sinFiltroAgnoMes($agno,$mes)." 
		AND id_tipo = 3   AND activo = 1 ".$this->where_idioma;

		//echo $this->where;
		return parent::obtenerListado();
	}

	function obtenerPasados($agno='',$mes='')
	{
		$agno_actual = date('Y');
		$this->where = "  fecha < '".$agno_actual."-01-01' ".$this->where = $this->sinFiltroAgnoMes($agno,$mes)." AND  activo = 1 ".$this->where_idioma;return parent::obtenerListado();
	}

	function obtenerRecursos($agno='',$mes='')
	{
		$this->where = "activo = 1 ".$this->sinFiltroAgnoMes($agno,$mes)." ".$this->where_idioma;
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
		$this->where 	= "   activo = 1 ".$this->where_idioma;
		return parent::obtenerListado();
	}

	/** SE DESPUBLICAN DEL HOME LAS NOTICIAS QUE SON MAS ANTIGUAS DE $DIAS */
	function caducarRecursos($fecha)
	{
		$where_string = "fecha < '".$fecha."' AND destacado = 1 AND destacado_forzado = 0 ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET destacado = 0, destacado_forzado = 0 WHERE ".$where_string;
		parent::getQuery($sql);
		$where_string = "fecha >= '".$fecha."'   ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET destacado = 1 WHERE ".$where_string;
		return parent::getQuery($sql);
	}

	function caducarRecursosForzar($fecha)
	{
		$where_string = "fecha < '".$fecha."' AND destacado_forzado = 1 ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET destacado = 0  , destacado_forzado = 0  WHERE ".$where_string;
		parent::getQuery($sql);
	}

	/*Busqueda generica*/
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{
		if (strpos($condicion, 'link') == true) {
		    $RecursoRelacionSitio = new RecursoLinkRelacionSitio();
		} else {
		    $RecursoRelacionSitio = new RecursoRelacionSitio();
		}
		if (empty($order)) {
            $order = " ORDER BY fecha DESC ,rec.id_recurso DESC ";
        }
		if ($tipo_recurso > '0') {
            $tipo_recurso = " rec.id_tipo = ";
        }
		$sql = "SELECT rec.titulo, ";
		$sql .= trim($palabra);
		$sql .= " rec.bajada, rec.* FROM ";
        $sql .= trim($this->obj->sourceTable);
        $sql .= " AS rec WHERE rec.activo = 1 ";
        // $sql .= "AND rec.nombre_site = '" . VarSystem::getPathVariables('web_site') . "' ";
        $sql .= trim($condicion);
		$sql .= " GROUP BY rec.id_recurso ";
		$sql .= trim($order) . " ";
		$sql .= trim($limite);
	 	return parent::getQuery($sql);

	}

 	function obtenerRecursosRecientes()
	{
		$this->where = " nombre_site='".VarSystem::getPathVariables('web_site')."'
		AND tipo.id_site=s.id_site AND tipo.id_tipo='".$tipo."' ".$this->where_idioma ;
		$this->order = 'fecha DESC, tipo, titulo  LIMIT 5';
		return parent::obtenerListado();
	}

	function obtenerUltimaNoticiaConGaleria()
	{
		$sql =" SELECT  rec.titulo, $palabra rec.bajada, rec.*
		FROM  ".$this->obj->sourceTable." as rec
		WHERE tiene_galeria = 1
		Order by fecha desc limit 1";
	 	return parent::getQuery($sql);
	}

	function obtenerRecursosSitio($tipo)
	{
		$sql =" SELECT   distinct (id_tipo),rec.* $palabra
		FROM  ".$this->obj->sourceTable." as rec
		WHERE rec.activo = 1 AND palabras_clave like '%".$tipo."%'
		AND rec.nombre_site='".VarSystem::getPathVariables('web_site')."'
		group by rec.id_tipo order by rand()";
	//echo $sql;
		return parent::getQuery($sql);
	}

    function obtenerRecursosEstructuraSitio($tipo)
	{
		/*$sql =" SELECT   distinct (id_tipo),rec.* $palabra
		FROM  ".$this->obj->sourceTable." as rec
		WHERE rec.activo = 1 AND opcion_site = '".$tipo."'
		AND rec.nombre_site='".VarSystem::getPathVariables('web_site')."'
		GROUP BY rec.id_tipo
		ORDER BY rand()";*/


		$sql ="SELECT distinct (id_tipo),rec.* FROM ( SELECT   rec.* $palabra
		FROM  ".$this->obj->sourceTable." as rec
		WHERE rec.activo = 1 AND opcion_site = '".$tipo."'
		AND rec.nombre_site='".VarSystem::getPathVariables('web_site')."'
		ORDER BY rand() ) as rec
		GROUP BY rec.id_tipo";
      //  echo $sql;
		return parent::getQuery($sql);
	}

	function obtenerRecursosLink()
	{
		$RecursoLinkObjeto = new RecursoLinkObjeto();
		$sql =" SELECT  rec.*
		FROM
		" .$RecursoLinkObjeto->sourceTable." as rec
		WHERE rec.activo = 1 AND id_tipo=2 AND destacado=1 AND
		rec.nombre_site='".VarSystem::getPathVariables('web_site')."'
		group by rec.id_recurso order by rand() limit 2";
	//echo $sql;
	//	return parent::getQuery($sql);
	}


	function obtenerRecursosPorTipo($tipo)
	{

		$sql =" SELECT   rec.titulo, $palabra rec.bajada, rec.*
		FROM  ".$this->obj->sourceTable." as rec
		WHERE rec.activo = 1 AND
		rec.nombre_site='".VarSystem::getPathVariables('web_site')."'
		AND rec.id_tipo='".$tipo."'
		group by rec.id_recurso order by rand() limit 4";
	//echo $sql;
		return parent::getQuery($sql);
	}


	function obtenerTipoRecurso($tipo)
	{
		$Site = new Site();
		$TipoRecursos = new TipoRecursos();
		$sql =" SELECT  tipo
		FROM
		".$TipoRecursos->sourceTable." as tipo, ".$Site->sourceTable." as s
		WHERE
		s.nombre_site='".VarSystem::getPathVariables('web_site')."'
		AND tipo.id_site=s.id_site AND tipo.id_tipo='".$tipo."' ";
		//	echo $sql;
		return parent::getQuery($sql);

	}


	function obtenerRecursosPublicacion()
	{
		$ControlPublicaciones = new ControlPublicaciones();
		$sql =" SELECT  pub.*
		FROM
		" .$ControlPublicaciones->sourceTable." as pub
		WHERE pub.activo = 1 AND
		pub.nombre_site='".VarSystem::getPathVariables('web_site')."'
		group by pub.id_publicaciones $order limit 2";
//echo $sql;
		//return parent::getQuery($sql);
	}


	function obtenerRecursosVideo()
	{
		$RecursoLinkObjeto = new RecursoLinkObjeto();
		$sql =" SELECT  rec.*
		FROM
		" .$RecursoLinkObjeto->sourceTable." as rec
		WHERE rec.activo = 1 AND id_tipo=3 AND
		rec.nombre_site='".VarSystem::getPathVariables('web_site')."'
		GROUP BY rec.id_recurso $order $limite";
		//echo $sql;
		return parent::getQuery($sql);
	}

	function obtenerRecurso($id_recurso)
	{
		$sql = "SELECT rec.* FROM ";
		$sql .= $this->obj->sourceTable;
		$sql .= " AS rec WHERE rec.activo = 1 AND id_recurso = ";
		$sql .= $id_recurso;
		// $sql .= " AND rec.nombre_site = '" . VarSystem::getPathVariables('web_site') . "'";
		$sql .= " GROUP BY rec.id_recurso ";
		// $sql .= $order . " ";
		// $sql .= $limite . " ";
		return parent::getQuery($sql);
	}
}

class RecursosLink extends Objetos
{
	var $sourceTable =  'site_recursos_link';

	function RecursosLink()
	{
		parent::Objetos();
	}
}


class ControlRecursosLink extends ControlObjetos
{
	function ControlRecursosLink()
	{
		parent::ControlObjetos();
		$this->obj 		= new RecursosLink();
		$this->order 	= 'orden ASC';
		$this->key 		= 'id_link';
		$this->select   = "   ";
		$this->sourceTable = $this->obj->sourceTable;
	}

	function obtenerLinks($id_recurso)
	{
		$this->where = "id_recurso = ".$id_recurso;
		return parent::obtenerListado();
	}

	function eliminarElementosRecurso($id)
	{
		$condition =  "id_recurso = '".$id."'";
		return parent::deleteElement($condition);
	}
}

class ControlRecursosObjetoView extends ControlVistas
{
	function ControlRecursosObjetoView()
	{
		parent::ControlVistas();
		$this->key 			= 'id_recurso';
		$this->sourceTable  = 'view_recursos_site';
		$this->order		= 'id_recurso';
		parent::prepararObjecto();
	}

	function obtenerRecursosTipoTexto($tipo,$id_site,$orden='')
	{

		if(trim($this->where) != '')
		{
			$this->where .= ' AND ';
		}
		$this->where .= "  tipo = '".$tipo."' AND id_site = '".$id_site."'";
		if(trim($orden) != '')
		{
			$this->order = $orden;
		}
		return parent::obtenerListado();
	}

	function obtenerListadoEstructuraTipo($id_site)
	{
		$sql = "SELECT DISTINCT id_tipo, tipo, tipo_orden, id_tipo_estructura, tipo_estructura, tipo_estructura_orden, tipo_estructura_opcion_site
		FROM ".$this->sourceTable."
		WHERE id_site = ".$id_site."
		ORDER BY tipo_estructura_orden, tipo_estructura, tipo_orden, tipo";
		return parent::getQuery($sql);
	}
}

?>
