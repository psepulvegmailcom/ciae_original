<?php 

class Publicaciones extends Objetos
{
	var $sourceTable =  'site_publicaciones'; 
	
	function Publicaciones()
	{  
		parent::Objetos();
		$this->dbKey 		= 'id_publicaciones'; 
	} 
} 

class PublicacionPersona extends Objetos//
{
	var $sourceTable =  'view_publicacion_persona';
	
	function PublicacionPersona()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_publicaciones';
	} 
} 

class ControlPublicaciones extends ControlObjetos
{ 
	function ControlPublicaciones()
	{
		parent::ControlObjetos();
		$this->obj 		= new Publicaciones();
		$this->order 	= 'agno DESC, id_publicaciones DESC, titulo ASC'; //id_publicaciones DESC,
		$this->where 	= " activo = 1 ";		
		parent::prepararObjeto();
	} 
	 
	function obtenerListadoHome()
	{ 
		$agno_anterior = date('Y') - 1;
		/** NO SE CONSULTAN LOS DE TIPO DOCUMENTOS, POR FORMATO */
		$this->where .= " AND  agno >= ".$agno_anterior."  AND id_tipo != 3 AND id_tipo != 8 " ; //  AND destacado = 1";
		$this->order = " RAND() ";
		return parent::obtenerListado();	
	} 
	
	function obtenerDocumentosHome()
	{ 
		/** NO SE CONSULTAN LOS DE TIPO DOCUMENTOS, POR FORMATO */
		$this->where .= " AND  id_tipo = 8 " ; //  AND destacado = 1";
		$this->order  = " agno DESC, mes_numero DESC, RAND()";
		$output = parent::obtenerListado();
		
		$mes_actual = date("n"); 
		if($output[0]['mes_numero'] < $mes_actual)
		{
			$this->order = " RAND(), agno DESC, mes_numero DESC";
			$output = parent::obtenerListado();	
		}
		return $output;
	} 
	
	function obtenerSQLPorTipo($id_tipo)
	{
		if(is_array($id_tipo))
		{
			$this->where .= "   AND (";
			for($i =0 ; $i < count($id_tipo); $i++)
			{
				if($i > 0)
				{
					$where .= " OR ";
				}
				$this->where .= " id_tipo = '".$id_tipo[$i]."' ";
			}
			$this->where .= "  )"; 
		}
		else
		{		
			$this->where .= "   AND id_tipo = ".$id_tipo;
		} 
	}
	
	function obtenerListadoPorTipo($id_tipo,$orden='',$agno='')
	{ 
		$this->obtenerSQLPorTipo($id_tipo); 
		if(trim($orden) != '')
		{
			$this->order = " ".$orden." ASC, ".$this->order;	
		} 
		return parent::obtenerListado();
	}  
	
	function obtenerListadoPorTipoAgno($id_tipo,$agno='Todo')
	{  
		$this->obtenerSQLPorTipo($id_tipo); 
		if($agno != 'Todo' && $agno != 'All' )
		{ 
			$this->where .= " AND agno = '".$agno."'";
		} 
		return  parent::obtenerListado();  
	} 
	
	function obtenerPersonas($id_publicaciones)
	{
		$PublicacionesPersona = new PublicacionesPersona();
		$Persona = new Persona();
		$sql = "SELECT DISTINCT per.*,  r.persona_nombre as nombre_extra , r.orden as orden_publicaciones, r.id_publicaciones
		FROM ".$this->sourceTable." as p, ".$Persona->sourceTable." as per, ".$PublicacionesPersona->sourceTable." as r 
		WHERE p.id_publicaciones = ".$id_publicaciones." AND p.id_publicaciones = r.id_publicaciones AND r.id_persona = per.id_persona
		ORDER BY r.orden, per.apellido_paterno,  per.apellido_materno, per.nombre ";  
		//echo $sql;
		return parent::getQuery($sql);	 
	}
	
	function obtenerAgnosTipoPublicaciones($tipo)
	{ 
		$this->obtenerSQLPorTipo($tipo);
		//$this->obtenerSQLPorTipo($tipo); 
		$sql = "SELECT DISTINCT  agno 
		FROM  site_publicaciones 
		WHERE  ".$this->where."
		ORDER BY agno DESC";  
		return parent::getQuery($sql);	 		
	} 
	
	function obtenerAgnosPublicaciones()
	{ 
		$this->obtenerSQLPorTipo($tipo);
		//$this->obtenerSQLPorTipo($tipo); 
		$sql = "SELECT DISTINCT  agno 
		FROM  site_publicaciones 
		WHERE  activo = 1
		ORDER BY agno DESC";  
		return parent::getQuery($sql);	 		
	}
	
	function obtenerListadoPorPersona($id_persona)
	{
		$PublicacionesPersona = new PublicacionesPersona();
		$sql =" SELECT   pub.*
		FROM ".$PublicacionesPersona->sourceTable." as per, ".$this->obj->sourceTable." as pub 
		WHERE pub.activo = 1 AND per.id_publicaciones = pub.id_publicaciones AND per.id_persona = ".$id_persona."
		ORDER BY pub.seleccionado DESC, pub.agno DESC LIMIT 3";

	 	return parent::getQuery($sql);
	}
	
	function obtenerListadoPorPublicacion($id_publicaciones)
	{ 
		$PublicacionesTipo = new PublicacionesTipo();
		$sql =" SELECT   pub.*,   tipopub.*
		FROM  ".$this->obj->sourceTable." as pub , ".$PublicacionesTipo->sourceTable." as tipopub
		WHERE pub.activo = 1 AND  pub.id_publicaciones = ".$id_publicaciones." AND tipopub.id_tipo = pub.id_tipo
		ORDER BY pub.agno DESC "; 
	 	return parent::getQuery($sql);
	}
	
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 
		$PublicacionPersona = new PublicacionPersona();
		if ($order=="") $order=" ORDER BY pub.fecha DESC, pub.agno DESC ";
		$sql =" SELECT   pub.*, $palabra  pubPer.*
		FROM  ".$this->obj->sourceTable." as pub , ".$PublicacionPersona->sourceTable." as pubPer
		WHERE pub.activo = 1 AND pub.id_publicaciones = pubPer.id_publicaciones 
		$condicion  group by pub.id_publicaciones $order $limite";

	 	return parent::getQuery($sql);
	}
			
	function obtenerListadoCompleto()
	{
		
		$PublicacionesTipo = new PublicacionesTipo();
		$sql =" SELECT   pub.*,   tipopub.*
		FROM  ".$this->obj->sourceTable." as pub , ".$PublicacionesTipo->sourceTable." as tipopub
		WHERE      tipopub.id_tipo = pub.id_tipo
		ORDER BY pub.agno DESC ";  
	 	return parent::getQuery($sql);					
		//$this->where 	= "  ";
//		$this->order 	= "  agno DESC, titulo ASC";
//		return parent::obtenerListado();
	}

	function obtenerLeyendaPorBusqueda($tok, $val, $tipo)
	{

		if ($tipo==1){
			if ($tok == "rangoNombre" and $val != ''){
				if ($val==1) $value=" BETWEEN 'A' AND 'D' ";
				if ($val==2) $value=" BETWEEN 'E' AND 'H' ";
				if ($val==3) $value=" BETWEEN 'I' AND 'L' ";
				if ($val==4) $value=" BETWEEN 'M' AND 'O' ";
				if ($val==5) $value=" BETWEEN 'P' AND 'S' ";
				if ($val==6) $value=" BETWEEN 'T' AND 'Z' ";
				$leyenda = "pubPer.apellido_paterno".$value;
				}else					
			if ($tok == "Autor" and $val != ''){					
				$leyenda = "pubPer.nombre_publicacion like ";
				}else
			if ($tok == "Anno" && $val != 'Anno'){
				$leyenda = "pub.agno like ";
				}else
			if ($tok == "Area" && $val!="Area"){
				$leyenda = "pub.id_area like ";
				}else
			if ($tok == "tipoDocumento" && $val!="Tipo de documento"){
				$leyenda = "pub.id_tipo like ";
				}else
			if ($tok == "palabra" && $val!=''){
				list($leyenda, $strQryRes)	= $this->obtenerLeyendaPalabraBusqueda($val);
				$trozos=explode(" ",$val);
				$numero=count($trozos);	
				$num = strlen($val);
				}else{
					$leyenda="";
					}
				
			}	
		return array($leyenda,$numero,$strQryRes);		
	}


		function obtenerLeyendaPalabraBusqueda($val,$tipo)
			{
			
				$trozos=explode(" ",$val);
						$numero=count($trozos);
						$num = strlen($val);
						if ($numero > 1) { 
						$strPalabra = $val."%' )";
						}else{
						$strPalabra = $val."%' )";
						}						

					 if ($num > 1){
											
						if ($numero == 1){
							$strP = " pub.titulo LIKE ('%";
							$strPRZ = " OR pub.resumen LIKE ('%";
							$strQryRes = "";
						}elseif ($numero > 1){
							$strPQ = " MATCH(pub.titulo, pub.resumen) AGAINST ('%";
							$strP = " MATCH(pub.titulo) AGAINST ('%";
							$strPRZ = "OR MATCH(pub.resumen) AGAINST ('%";
							$strQryRes = $strPQ.$strPalabra." as Score, ";
							}
							$strQry = " (".$strP.$strPalabra.$strPRZ.$strPalabra.")";
					 }		
														
					return array($strQry, $strQryRes);		
			}


}	

/** PUBLICACIONES PERSONAS **/ 
class PublicacionesPersona extends Objetos
{
	var $sourceTable =  'site_publicaciones_persona'; 

	function PublicacionesPersona()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_publicaciones'; 
	} 

	
	function eliminarObjetoPersona()
	{
		if(trim($this->id_persona) == 1)
		{
			$where = "id_persona = ".$this->id_persona." AND id_publicaciones = ".$this->id_publicaciones." AND orden = ".$this->orden." AND persona_nombre LIKE '%".$this->nombre_extra."%'"	;
		}
		else
		{
			$where = "id_persona = ".$this->id_persona." AND id_publicaciones = ".$this->id_publicaciones 	;			
		} 
		parent::destroyObject($where);
	}	
} 

class ControlPublicacionesPersona extends ControlObjetos
{
	
	function ControlPublicacionesPersona()
	{
		parent::ControlObjetos();
		$this->obj 		= new PublicacionesPersona();
		$this->order 	= 'orden';		
		parent::prepararObjeto();
	} 
	
	function obtenerListadoPorPublicacion($id_publicaciones)
	{ 
		$this->where = " id_publicaciones = ".$id_publicaciones;
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
		$Publicaciones = new Publicaciones();
		$sql =" SELECT per.nombre_publicacion,pub.persona_nombre , pub.*, per.nombre, per.apellido_paterno, per.apellido_materno
		FROM ".$Persona->sourceTable." as per, ".$this->obj->sourceTable." as pub , ".$Publicaciones->sourceTable." as pubr
		WHERE  pubr.id_publicaciones = pub.id_publicaciones AND per.id_persona = pub.id_persona 
		ORDER BY pub.id_publicaciones,pub.orden";
		$result = parent::getQuery($sql);
		 
		$autores = '';
		$id_publicacion = 0;
		$listado_autores = array(); 
		$i_listado_autores = 0;
		$total_result = count($result);
		if(is_array($result) && $total_result > 0)
		{			
			//Funciones::mostrarArreglo($result,true);
			for($i=0; $i < $total_result; $i++)
			{
				if($id_publicacion != $result[$i]['id_publicaciones'])
				{
					if($id_publicacion > 0)
					{
						$listado_autores[$id_publicacion] = $autores;
						$autores = ''; 
					}
					$id_publicacion = $result[$i]['id_publicaciones'];					
				}
				if(trim($autores) != '')
				{
					$autores .= "; ";
				}
				if($result[$i]['id_persona'] > 1)
				{
					if( trim($result[$i]['nombre_publicacion']) != '')
					{
						$autores .= $result[$i]['nombre_publicacion'];
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
	
	function obtenerListadoPersonas($id_publicaciones)
	{
		$Persona = new Persona();
		$ControladorHTML  = new ControladorHTML();
		$Publicaciones = new Publicaciones();
		$sql =" SELECT per.nombre_publicacion,pub.persona_nombre , pub.*, per.nombre, per.apellido_paterno, per.apellido_materno
		FROM ".$Persona->sourceTable." as per, ".$this->obj->sourceTable." as pub , ".$Publicaciones->sourceTable." as pubr
		WHERE pubr.activo = 1 AND pubr.id_publicaciones = pub.id_publicaciones AND per.id_persona = pub.id_persona AND pub.id_publicaciones = ".$id_publicaciones."
		ORDER BY pub.orden";
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
					if(trim($result[$i]['nombre_publicacion']) != '')
					{
						$aux .= trim($result[$i]['nombre_publicacion']); 
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
	
	function eliminarReemplazoPersonaPublicacion($id_persona,$nombre)
	{
		$sql = "UPDATE  ".$this->obj->sourceTable." SET id_persona = '1',
persona_nombre = '".$nombre."' WHERE    id_persona ='".$id_persona."'   		";
 		//Funciones::mostrarArreglo($sql,true);
	 	return parent::getQuery($sql);
	}	
}

/** PUBLICACIONES PROYECTOS **/


class PublicacionesProyectos extends Objetos
{
	var $sourceTable =  'site_publicaciones_proyecto';
	
	function PublicacionesProyectos()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_publicaciones';
	} 
}

class ControlPublicacionesProyectos extends ControlObjetos
{
	
	function ControlPublicacionesProyectos()
	{
		parent::ControlObjetos();
		$this->obj 		= new PublicacionesProyectos(); 		
		parent::prepararObjeto();
	} 
	
	function obtenerListadoPorPublicacion($id_publicaciones)
	{ 
		$this->where = " id_publicaciones = ".$id_publicaciones;
		return parent::obtenerListado();
	}
	
	function obtenerListadoPorProyecto($id_proyecto)
	{ 
		$this->where = " id_proyecto = ".$id_proyecto;
		return parent::obtenerListado();
	}
} 

class PublicacionesTipo extends Objetos
{
	var $sourceTable =  'site_tipo_publicaciones';
	
	function PublicacionesTipo()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_tipo';
	} 
} 
	
class ControlTipoPublicaciones extends ControlObjetos
{
	function ControlTipoPublicaciones()
	{
		parent::ControlObjetos();
		$this->obj 		= new PublicacionesTipo();
		$this->order	= 'orden ASC';		
		parent::prepararObjeto();
	}	
	
	function obtenerListadoPublico()
	{
		$this->where = " estado = 'publico' ";
		return parent::obtenerListado();
	}
} 
 
?>