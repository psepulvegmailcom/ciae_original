<?php


class EnLaPrensaObjeto extends Objetos 
{	
	var $sourceTable = 'site_noticias_prensa';
			
	function EnLaPrensaObjeto() 
	{
		parent::Objetos();
		$this->dbKey = 'id_prensa';
	}		 	
}

class ControlEnLaPrensaObjeto extends ControlObjetos
{
	function ControlEnLaPrensaObjeto()
	{
		parent::ControlObjetos();
		$this->obj 			= new EnLaPrensaObjeto();
		$this->order		= 'fecha DESC, id_prensa DESC, titulo ASC';			
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

class NoticiaObjeto extends Objetos 
{	
	var $sourceTable = 'site_noticias';
			
	function NoticiaObjeto() 
	{
		parent::Objetos();
		$this->dbKey = 'id_noticia';
	}		 	
}

class ControlNoticiaObjeto extends ControlObjetos
{
	function ControlNoticiaObjeto()
	{
		parent::ControlObjetos();
		$this->obj 			= new NoticiaObjeto();
		$this->order		= 'fecha DESC, id_noticia DESC, titulo ASC';			
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
	}	
	
	function agnoActual()
	{
		$year = date("Y");
		$this->where = "  fecha >= '".$year."-01-01'  "; /*  fecha <= '".$year."-12-31' AND */
	}
	
	function agnoHistorico()
	{
		$year = date("Y");
		$this->where = "  fecha < '".$year."-01-01'  ";
	}
}

class Noticias extends Objetos
{
	var $sourceTable =  'site_noticias';
	
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
		$this->where = " destacado = 1 AND activo = 1 AND tipo = 'noticia' ".$this->where_idioma;
		return parent::obtenerListado();
	}
	
	function obtenerEventosHome()
	{ 
		$this->where = " destacado = 1 AND activo = 1 AND tipo = 'evento' ".$this->where_idioma;
		return parent::obtenerListado();
	}
	
	function obtenerEventos($agno='',$mes='')
	{
		$agno_actual = date('Y')+1;
		$this->where = "  fecha < '".$agno_actual."-01-01' ".$this->where = $this->sinFiltroAgnoMes($agno,$mes)." AND tipo = 'evento'   AND activo = 1 ".$this->where_idioma; 
		
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
	function caducarNoticias($fecha)
	{ 
		$where_string = "fecha < '".$fecha."' AND destacado = 1 AND destacado_forzado = 0 ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET destacado = 0, destacado_forzado = 0 WHERE ".$where_string;
		parent::getQuery($sql); 
		$where_string = "fecha >= '".$fecha."'   ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET destacado = 1 WHERE ".$where_string; 
		//return parent::getQuery($sql); 
	}
	
	function caducarNoticiasForzar($fecha)
	{ 
		$where_string = "fecha < '".$fecha."' AND destacado_forzado = 1 ";
		$sql = "UPDATE ".$this->obj->sourceTable." SET destacado = 0  , destacado_forzado = 0  WHERE ".$where_string;
		parent::getQuery($sql); 
	} 
	
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 
		if ($order=="") $order=" Order by noti.id_noticia DESC ";
		$sql =" SELECT   noti.titulo, $palabra noti.bajada, noti.*
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE noti.activo = 1 
		$condicion  group by noti.id_noticia $order $limite";
		 
	 	return parent::getQuery($sql);
	}
	
		function obtenerUltimaNoticiaConGaleria()
	{ 		
		$sql =" SELECT  noti.titulo, $palabra noti.bajada, noti.*
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE tiene_galeria = 1 
		Order by fecha desc limit 1";	 
	 	return parent::getQuery($sql);
	}
	
	
}
 
class NoticiasLink extends Objetos
{
	var $sourceTable =  'site_noticias_link';
	
	function NoticiasLink()
	{ 
		parent::Objetos();
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
		$this->saveObject();
	}
}

/** 
** PERMITE CONSULTAR LAS NOTICIAS EN DISTINTOS MEDIOS DE COMUNICACION
**/

class NoticiasPrensa extends Objetos
{
	var $sourceTable =  'site_noticias_prensa';
	
	function NoticiasPrensa()
	{ 
		parent::Objetos();
	}  
}

class ControlNoticiasPrensa extends ControlObjetos
{
	function ControlNoticiasPrensa()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiasPrensa();
		$this->order 	= 'fecha DESC, RAND()';
		$this->key 		= 'id_prensa';
		$this->select   = VarSystem::formatoFechaSql('fecha'); 
		$this->sourceTable = $this->obj->sourceTable;
	}   
	
	function obtenerRss()
	{  
		$this->order 	= 'fecha DESC,   titulo'; 
		return parent::obtenerListado(); 
	} 
	
	function obtenerListadoPorBusquedaPrensa($palabra, $condicion, $order, $limite)
	{ 
		$order = " Order by noti.id_prensa DESC ";
		$sql =" SELECT id_prensa, titulo, $palabra bajada, url, fecha, medio , pdf
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE noti.id_prensa > 0  
		$condicion  group by noti.id_prensa $order $limite";
		//echo $sql; 		 
	 	return parent::getQuery($sql);
	}
}

/** BOLETIN */
class Boletines extends Objetos
{
	var $sourceTable =  'site_boletin';
	
	function Boletines()
	{ 
		parent::Objetos();
	} 
}


class ControlBoletines extends ControlObjetos
{
	function ControlBoletines()
	{
		parent::ControlObjetos();
		$this->obj 		= new Boletines();
		$this->order 	= 'id_boletin DESC, mes DESC, agno DESC';
		$this->key 		= 'id_boletin'; 
		$this->sourceTable = $this->obj->sourceTable;
	} 
	
	function obtenerListadoPorBusquedaBoletin($palabra, $condicion, $order, $limite)
	{ 
		$sql =" SELECT   noti.agno, $palabra noti.mes, noti.archivo, noti.id_boletin
		FROM  ".$this->obj->sourceTable." as noti 
		WHERE noti.id_boletin > 0 
		$condicion  group by noti.id_boletin order by ".$this->order." $limite";	 
	 	return parent::getQuery($sql);
	}
	
	function obtenerUltimoBoletin()
	{
		$this->order = " id_boletin DESC LIMIT 0,1";
		return parent::obtenerListado();
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


?>