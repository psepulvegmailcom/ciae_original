<?php

class Areas extends Objetos
{
	var $sourceTable =  'site_areas';
	
	function Areas()
	{ 
		parent::Objetos();		
		$this->dbKey = 'id_area';
	} 
}

class ControlAreas extends ControlObjetos
{
	function ControlAreas()
	{
		parent::ControlObjetos();
		$this->obj = new Areas();
		$this->order = 'orden'; 
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	}
	
	function buscarClave($clave)
	{		   
		$this->where = "  clave = '".$clave."'"; 
		return parent::obtenerListado();
	}
	
	function obtenerListado()
	{
		$this->where = 'activo = 1';
		
		global $ControlHtml;  	     
		$this->select = "area_".VarSystem::obtenerIdiomaActual()." as area ";
		
		return parent::obtenerListado();
	}
}

class Proyectos extends Objetos
{
	var $sourceTable =  'site_proyectos';
	
	function Proyectos()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_proyecto';
	} 
} 


class TipoProyectos extends Objetos
{
	var $sourceTable =  'site_tipo_proyectos';
	
	function TipoProyectos()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_tipo';
	} 
}

class ControlTipoProyectos extends ControlObjetos
{
	function ControlTipoProyectos()
	{
		parent::ControlObjetos();
		$this->obj 		= new TipoProyectos();
		$this->order	= 'orden ASC';		
		$this->key 		= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	}	
} 

class ControlProyectos extends ControlObjetos
{
	function ControlProyectos()
	{
		parent::ControlObjetos();
		$this->obj 		= new Proyectos();
		$this->order 	= 'agno_inicio DESC, proyecto ASC';		
		parent::prepararObjeto(); 
	}
	
	function buscarPorArea($id_area)
	{		   
		$this->where = " id_area = '".$id_area."'"; 
		$this->order = " proyecto ";
		return parent::obtenerListado();
	}
	
	function obtenerListado($id='',$activo=1 )
	{ 
		$TipoProyectos = new TipoProyectos();
		$where = '';
		$activo_where = " ";
		if($activo != '1')
		{
			$activo_where = "AND  p.activo = 1 ";
		}
		if(trim($id) != '')
		{
			$where .= " AND p.id_proyecto = ".$id;
		}  
		$sql = "SELECT DISTINCT   p.*,  t.tipo as tipo_proyecto
		FROM ".$this->sourceTable." as p,    
		".$TipoProyectos->sourceTable." as t 
		WHERE  p.id_tipo = t.id_tipo    ".$where."  ".$activo_where."
		ORDER BY   p.agno_inicio DESC, p.proyecto ASC"; // t.orden,
		return parent::getQuery($sql);
	}
	
	function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 	
		$ProyectosPersonas = new ProyectosPersonas();
		$Persona = new Persona();	
		$sql =" SELECT   proy.*, $palabra  pers.*
		FROM ".$this->sourceTable." as proy, ".$Persona->sourceTable." as pers, ".$ProyectosPersonas->sourceTable." as r
		WHERE proy.activo = 1 AND proy.id_proyecto = r.id_proyecto AND r.id_persona = pers.id_persona	 
		$condicion  group by proy.id_proyecto $order $limite";
//echo $sql;

	 	return parent::getQuery($sql);
	}

	function obtenerListadoPorBusquedaPorArea($palabra, $condicion, $order, $limite)
	{ 	
		$AreasProyecto = new AreasProyecto();	
		$sql =" SELECT proy.* 
		FROM ".$AreasProyecto->sourceTable." as proArea,".$this->sourceTable." as proy 
		WHERE proArea.id_proyecto = proy.id_proyecto $condicion group by proy.id_proyecto $order $limite";
	//	echo $sql;
	 	return parent::getQuery($sql);
	}
		
	function obtenerPersonas($id,$sendsql=false)
	{
		$ProyectosPersonas = new ProyectosPersonas();
		$Persona = new Persona();
		$sql = "SELECT DISTINCT per.*, r.cargo as cargo_proyecto, r.nombre_extra , r.orden as orden_proyecto, r.id_proyecto
		FROM ".$this->sourceTable." as p, ".$Persona->sourceTable." as per, ".$ProyectosPersonas->sourceTable." as r 
		WHERE p.id_proyecto = ".$id." AND p.id_proyecto = r.id_proyecto AND r.id_persona = per.id_persona
		ORDER BY r.orden, per.apellido_paterno,  per.apellido_materno, per.nombre ";

		if($sendsql)
		{ 
			return $sql;	
		}
		else
		{ 
			return parent::getQuery($sql);	
		} 
	} 
	
	function obtenerListadoHome()
	{ 
		$agno_anterior = date('Y') - 1;
		$this->where .= " AND  agno_inicio >= ".$agno_anterior ; //  AND destacado = 1";
		$this->order = " RAND() ";
				
		$sql = "SELECT DISTINCT   p.* 
		FROM ".$this->sourceTable." as p    
		WHERE  p.activo=1  ".$this->where."  ".$activo_where."
		ORDER BY ".$this->order." LIMIT 2";
		//echo $sql;
		return parent::getQuery($sql);
	} 
	
}


class ProyectosPersonas extends Objetos
{
	var $sourceTable =  'site_proyectos_personas';
	
	function ProyectosPersonas()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_proyecto';
	} 
	
	function eliminarObjetoPersona()
	{
		if(trim($this->id_persona) == 1)
		{
			$where = "id_persona = ".$this->id_persona." AND id_proyecto = ".$this->id_proyecto." AND orden = ".$this->orden." AND nombre_extra LIKE '%".$this->nombre_extra."%'"	;
		}
		else
		{
			$where = "id_persona = ".$this->id_persona." AND id_proyecto = ".$this->id_proyecto 	;			
		} 
		parent::destroyObject($where);
	} 
}
 
class ControlProyectosPersonas extends ControlObjetos
{
	function ControlProyectosPersonas()
	{
		parent::ControlObjetos();
		$this->obj 		= new ProyectosPersonas();
		$this->order	= 'orden ASC';		
		parent::prepararObjeto();
	}
	
	function obtenerListadoPersonas($id_proyecto)
	{
		$this->where = "id_proyecto = ".$id_proyecto;
		return parent::getArrayObjects($this->sourceTable,$this->where,$this->order,$this->select); 
	}	 

	function obtenerListadoProyectos($id_persona)
	{
		$this->where = "id_persona = ".$id_persona;
		return parent::getArrayObjects($this->sourceTable,$this->where); 
	}	 
	
	function eliminarReemplazoPersonaProyecto($id_persona,$nombre)
	{
		$sql = "UPDATE  ".$this->obj->sourceTable." SET id_persona = '1',
nombre_extra = '".$nombre."' WHERE     id_persona ='".$id_persona."'   		";
 		//Funciones::mostrarArreglo($sql,true);
	 	return parent::getQuery($sql);
	}

	function obtenerListadoPersonasCompleto()
	{ 
		$Persona = new Persona(); 
		$Proyectos = new Proyectos();
		$sql =" SELECT per.nombre_publicacion,pub.nombre_extra , pub.*, per.nombre, per.apellido_paterno, per.apellido_materno
		FROM ".$Persona->sourceTable." as per, ".$this->obj->sourceTable." as pub , ".$Proyectos->sourceTable." as pubr
		WHERE   pubr.id_proyecto = pub.id_proyecto AND per.id_persona = pub.id_persona 
		ORDER BY pub.id_proyecto,pub.orden";
		$result = parent::getQuery($sql);
		  
		$autores = '';
		$id_proyectos = 0;
		$listado_autores = array(); 
		$i_listado_autores = 0;
		$total_result = count($result);
		if(is_array($result) && $total_result > 0)
		{			
			//Funciones::mostrarArreglo($result,true);
			for($i=0; $i < $total_result; $i++)
			{
				if($id_proyectos != $result[$i]['id_proyecto'])
				{
					if($id_proyectos > 0)
					{
						$listado_autores[$id_proyectos] = $autores;
						$autores = ''; 
					}
					$id_proyectos = $result[$i]['id_proyecto'];					
				}
				if(trim($autores) != '')
				{
					$autores .= "; ";
				}
				if($result[$i]['id_persona'] > 1)
				{
					if( trim($result[$i]['nombre_publicacion']) != '')
					{
						$autores .= trim($result[$i]['nombre_publicacion']);
					}	
					else
					{
						$autores .= trim($result[$i]['apellido_paterno']).', '.trim($result[$i]['nombre']);
					}	
					$autores .= trim($result[$i]['nombre_extra']);
				}
				else
				{
					$autores .= trim($result[$i]['nombre_extra']);					 
				}				 	
			}
			//Funciones::mostrarArreglo($listado_autores,true);
		}
		return $listado_autores;		
	}			
} 


class TipoAreaProyectos extends Objetos
{
	var $sourceTable =  'site_tipo_proyectos_area';
	
	function TipoAreaProyectos()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_tipo';
	} 
}


class AreasProyecto extends Objetos
{
	var $sourceTable =  'view_areas_proyecto';
	
	function view_areas_proyecto()
	{ 
		parent::Objetos();
		$this->dbKey 		= 'id_area';
	} 
}

class ControlTipoAreaProyectos extends ControlObjetos
{
	function ControlTipoAreaProyectos()
	{
		parent::ControlObjetos();
		$this->obj 		= new TipoAreaProyectos();
		$this->order	= 'orden ASC';			
		parent::prepararObjeto();
	}	
} 

?>