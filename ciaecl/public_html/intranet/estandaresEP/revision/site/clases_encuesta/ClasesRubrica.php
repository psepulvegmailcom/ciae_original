<?php

/********************************************************************************************
		CLASES CONTROLADORES DE AREAS RUBRICAS
********************************************************************************************/
class Area extends Objetos 
{		
	var $sourceTable = "rubrica_area";
	var $dbKey		 = 'id_area';
	
	function Area() 
	{
		parent::Objetos();
	}	 	   
} 

class ControlArea extends ControladorDeObjetos 
{
	var $obj; 	 
	
	function ControlArea() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Area(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  
	
	function getItem($id_item='')
	{				 
		$where='';
		if($id_item != '')
			$where = $this->obj->dbKey.' = '.$id_item;

		$datos =  parent::getArrayObjects($this->sourceTable,$where); 
		 
		return $datos;
	}
}


/********************************************************************************************
		CLASES CONTROLADORES DE COMPONENTES RUBRICAS
********************************************************************************************/
class Componente extends Objetos 
{		
	var $sourceTable = "rubrica_componente";
	var $dbKey		 = 'id_componente';
	
	function Componente() 
	{
		parent::Objetos();
	}	 	   
} 

class ControlComponente extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = 'componente, orden ASC';
	
	function ControlComponente() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Componente(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  
	
	function getItem($id_item='')
	{				 
		$where='';
		if($id_item != '')
			$where = $this->obj->dbKey.' = '.$id_item;

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 
		 
		return $datos;
	}
	
	function getComponentesPorArea($id_area='',$id_componente_no='')
	{				 
		$where='a.id_componente = b.id_componente ';
		if($id_area != '')
			$where .= ' AND a.id_area = '.$id_area;
		if(trim($id_componente_no) != '')
		{
			if(trim($where) != '')
			{
				$where .= " AND ";
			}
			$where .= " b.id_componente != ".$id_componente_no;
		} 
		//$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 		 
		
		$Elemento = new Elemento();
		
		$sql = "SELECT DISTINCT a.* FROM ".$this->sourceTable." as a, ".$Elemento->sourceTable." as b 
		WHERE   ".$where."  
		ORDER BY b.elemento, a.componente, a.orden ASC  ";
		//Funciones::mostrarArreglo($sql);
		$datos =  parent::getQuery($sql);  
		
		return $datos;
	}	
}  
/********************************************************************************************
		CLASES CONTROLADORES DE EJEMPLOS
********************************************************************************************/
class Ejemplo extends Objetos 
{		
	var $sourceTable = "rubrica_ejemplo";
	var $dbKey		 = 'id_ejemplo';
	
	function Elemento() 
	{
		parent::Objetos();
	}	 	   
}  

class ControlEjemplo extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = 'orden ASC';
	
	function ControlEjemplo() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Ejemplo(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}   
	
	function getEjemplosPorElemento($id_elemento='')
	{				 
		$where='';
		if($id_elemento != '')
		{
			$where = 'id_elemento = '.$id_elemento;
		}  
		return parent::getArrayObjects($this->sourceTable,$where,$this->orden);  
	}	 
}

class EjemploRespuestas extends Objetos 
{		
	var $sourceTable = "rubrica_ejemplo_respuesta";
	var $dbKey		 = 'id_ejemplo';
	
	function EjemploRespuestas() 
	{
		parent::Objetos();
	}
	
	function saveRespuesta($id,$respuesta,$usuario)
	{  
		parent::loadObject('id_ejemplo='.$id." AND usuario = '".$usuario."'");
		//Funciones::mostrarArreglo($this);
		$this->fecha = time();
		$this->respuesta = trim($respuesta);
		$this->id_ejemplo = $id;
		$this->usuario = $usuario;
		parent::saveObject($this->dbKey.'='.$id." AND usuario = '".$usuario."'");
	}	 	   
}  


class ControlEjemploRespuesta extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = '';
	
	function ControlEjemploRespuesta() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new EjemploRespuestas(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}   
	
	function getRespuestas($id_ejemplo='')
	{
		$where='';
		if($id_ejemplo != '')
		{
			$where = 'id_ejemplo = '.$id_ejemplo;
		}  
		return parent::getArrayObjects($this->sourceTable,$where,$this->orden);   
	} 
	
	function getRespuestaEjemplos($id_ejemplo, $usuario)
	{				 
		$where = " id_ejemplo = ".$id_ejemplo." AND usuario = '".$usuario."'"; 
		return parent::getArrayObjects($this->sourceTable,$where,$this->orden);  
	}	 
}

/********************************************************************************************
		CLASES CONTROLADORES DE INDICADORES
********************************************************************************************/
class Indicador extends Objetos 
{		
	var $sourceTable = "rubrica_indicador";
	var $dbKey		 = 'id_indicador';
	
	function Elemento() 
	{
		parent::Objetos();
	}	 	   
}  

class ControlIndicador extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = 'orden ASC';
	
	function ControlIndicador() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Indicador(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}   
	
	function getIndicadoresPorElemento($id_elemento='')
	{				 
		$where='';
		if($id_elemento != '')
		{
			$where = 'id_elemento = '.$id_elemento;
		}  
		return parent::getArrayObjects($this->sourceTable,$where,$this->orden);  
	}	 
}

class IndicadorRespuestas extends Objetos 
{		
	var $sourceTable = "rubrica_indicador_respuesta";
	var $dbKey		 = 'id_indicador';
	
	function IndicadorRespuestas() 
	{
		parent::Objetos();
	}	 	   
	
	function saveRespuesta($id,$respuesta,$usuario)
	{ 
		parent::loadObject('id_indicador='.$id." AND usuario = '".$usuario."'");
		$this->fecha = time();
		$this->respuesta = $respuesta;
		$this->usuario = $usuario;
		$this->id_indicador = $id;
		parent::saveObject($this->dbKey.'='.$id." AND usuario = '".$usuario."'");
	}	 	
}   

class ControlIndicadorRespuesta extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = 'fecha ASC';
	
	function ControlIndicadorRespuesta() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new IndicadorRespuestas(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}   
	
	function getRespuestas($id_indicador='')
	{
		$where='';
		if($id_indicador != '')
		{
			$where = 'id_indicador = '.$id_indicador;
		}  
		return parent::getArrayObjects($this->sourceTable,$where,$this->orden);   
	}
	
	function getRespuestaIndicadores($id_indicador, $usuario)
	{				 
		$where = " id_indicador = ".$id_indicador." AND usuario = '".$usuario."'"; 
		return parent::getArrayObjects($this->sourceTable,$where,$this->orden);  
	}	 
}

/********************************************************************************************
		CLASES CONTROLADORES DE ELEMENTOS RUBRICAS
********************************************************************************************/
class Elemento extends Objetos 
{		
	var $sourceTable = "rubrica_elemento";
	var $dbKey		 = 'id_elemento';
	
	function Elemento() 
	{
		parent::Objetos();
	}	 	   
} 

class ControlElemento extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = ' elemento ASC, orden ASC';
	
	function ControlElemento() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Elemento(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  
	
	function getItem($id_item='')
	{				 
		$where='';
		if($id_item != '')
			$where = $this->obj->dbKey.' = '.$id_item;

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 
		 
		return $datos;
	}
	
	function getElementosPorComponente($id_componente='')
	{				 
		$where='';
		if($id_componente != '')
		{
			$where = 'id_componente = '.$id_componente;
		}
		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden);		 
		return $datos;
	}	
	
	function obtenerElementoSiguiente($id_elemento)
	{
		return $this->obtenerElementoHermano($id_elemento,'siguiente');
	}
	
	function obtenerElementoAnterior($id_elemento)
	{
		return $this->obtenerElementoHermano($id_elemento,'anterior');
	}
	
	function obtenerElementoHermano($id_elemento,$tipo)
	{
		$where = " id_elemento = ".$id_elemento;
		$datos = parent::getArrayObjects($this->sourceTable,$where,$this->orden); 	 
		if($tipo == 'anterior')
			$aux   = $datos['0']['orden']-1;
		else			
			$aux   = $datos['0']['orden']+1;
		$where = " orden = ".$aux." AND id_componente=".$datos[0]['id_componente']; 
		$datos = parent::getArrayObjects($this->sourceTable,$where,$this->orden);  
		if(isset($datos[0]['id_elemento']))
			return $datos[0]['id_elemento'];
		else
			return 0;
	}	
}


/********************************************************************************************
		CLASES CONTROLADORES DE NIVELES RUBRICAS
********************************************************************************************/
class Nivel extends Objetos 
{		
	var $sourceTable = "rubrica_nivel";
	var $dbKey		 = 'id_nivel';
	
	function Nivel() 
	{
		parent::Objetos();
	}	 	   
} 

class ControlNivel extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = '';
	
	function ControlNivel() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Nivel(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  
	
	function getItem($id_item='')
	{				 
		$where='';
		if($id_item != '')
			$where = $this->obj->dbKey.' = '.$id_item;

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 
		 
		return $datos;
	}
	
	function getNivelesPorElemento($id_elemento='')
	{				 
		$where='';
		if($id_elemento != '')
			$where = 'id_elemento = '.$id_elemento;

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 
		 
		return $datos;
	}	
}



/********************************************************************************************
		CLASES CONTROLADORES DE RESPUESTAS RUBRICAS
********************************************************************************************/
class Repuesta extends Objetos 
{		
	var $sourceTable = "rubrica_repuesta";
	var $dbKey		 = 'id_repuesta';
	
	function Repuesta() 
	{
		parent::Objetos();
	}	 	   
} 

class ControlRepuesta extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = 'fecha_respuesta ASC';
	
	function ControlRepuesta() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Repuesta(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  
	
	function getItem($id_item='')
	{				 
		$where='';
		if($id_item != '')
			$where = $this->obj->dbKey.' = '.$id_item;

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 
		 
		return $datos;
	}
	
	function getRepuesta($usuario='',$id_elemento='')
	{				 
		$where='';
		if($usuario != '')
		{
			if(trim($where) != '')
				$where .= " AND ";
			$where .= 'usuario = '.$usuario;
		}
		if($id_nivel != '')
		{
			if(trim($where) != '')
				$where .= " AND ";
			$where .= 'id_nivel = '.$id_nivel;
		}

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 
		 
		return $datos;
	}	
}
/********************************************************************************************
		CLASES CONTROLADORES DE RESPUESTAS NIVELES
********************************************************************************************/
class RepuestaNivel extends Objetos 
{		
	var $sourceTable = "rubrica_respuesta_nivel";
	var $dbKey		 = 'usuario';
	
	function RepuestaNivel() 
	{
		parent::Objetos();
	}	 	   
} 

/************************************** REPUESTAS DE ÁREAS *************************************/
class AreaRespuesta extends PersistentObject
{		
	var $sourceTable = "rubrica_area_respuesta"; 
	
	function AreaRespuesta() 
	{
		parent::PersistentObject();
	}	 	  
	
	function setUsuario($usuario)
	{
		parent::loadObject(" usuario = '".$usuario."'");
	} 
	
	function eliminarAreas()
	{
		parent::destroyObject("usuario = '".$this->usuario."'");
	}
}

class ControlAreaRespuesta extends ControladorDeObjetos 
{
	function ControlAreaRespuesta()
	{
		$this->obj = new AreaRespuesta();
		$this->obj2 = new Area();
		parent::ControladorDeObjetos();
	}
	
	function obtenerAreasConponentesUsuario($usuario)
	{
		$Componente = new Componente();
		$query = " SELECT a.usuario ,	a.id_area 	,c.id_componente  
FROM  ".$this->obj->sourceTable." as a left  join  ".$Componente->sourceTable." as c on  a.id_area = c.id_area  
WHERE  a.usuario  = '".$usuario."'  ";
		//echo $query;
		return parent::getQuery($query);  
	}
	
	function obtenerAreasUsuario($usuario)
	{
		/*$sql = "SELECT a.*, r.*
		FROM ".$this->obj->sourceTable." as a, ".$this->obj2->sourceTable." as r
		WHERE a.id_area = r.id_area
		AND a.usuario = '".$usuario."'
		ORDER BY r.orden "; */
		
		$sql = "SELECT a.*, r.*
		FROM ".$this->obj->sourceTable." as a, ".$this->obj2->sourceTable." as r
		WHERE a.id_area = r.id_area		 
		ORDER BY r.id_area DESC
		Limit 1 "; 
		// echo $sql;
		return parent::getQuery($sql); 		
	}
}

/************************************** REPUESTAS DE ELEMENTOS *************************************/
class NivelRespuesta extends PersistentObject
{		
	var $sourceTable = "rubrica_nivel_respuesta"; 
	
	function NivelRespuesta() 
	{
		parent::PersistentObject();
	}	 	  
	
	function obtenerRespuesta($usuario, $id_elemento)
	{
		parent::loadObject(" usuario = '".$usuario."' AND id_elemento = ".$id_elemento);
		if(!isset($this->usuario))
		{
			$this->usuario = $usuario;
			$this->id_elemento = $id_elemento;
			$this->saveObject();
			parent::loadObject(" usuario = '".$usuario."' AND id_elemento = ".$id_elemento);
		}
	}   
	
	function guardarRespuesta()
	{
		$this->saveObject(" usuario = '".$this->usuario."' AND id_elemento = ".$this->id_elemento);
	}
}
/************************************** REPUESTAS DE ELEMENTOS ***********************************/
class ElementoRespuesta extends PersistentObject
{		
	var $sourceTable = "rubrica_elemento_respuesta"; 
	
	function ElementoRespuesta() 
	{
		parent::PersistentObject();
	}	 	 	  
	
	function obtenerRespuesta($usuario, $id_elemento)
	{
		parent::loadObject(" usuario = '".$usuario."' AND id_elemento = ".$id_elemento); 
		if(!isset($this->usuario))
		{
			$this->usuario = $usuario;
			$this->id_elemento = $id_elemento;
			$this->saveObject();
			parent::loadObject(" usuario = '".$usuario."' AND id_elemento = ".$id_elemento);
		}
	}   
	
	function guardarRespuesta()
	{
		$this->saveObject(" usuario = '".$this->usuario."' AND id_elemento = ".$this->id_elemento);
	}
}
class ControlElementoRespuesta extends ControladorDeObjetos 
{

	var $obj; 	 
	var $orden = 'fecha ASC';
	
	function ControlElementoRespuesta() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new ElementoRespuesta(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  	  
	
	function obtenerRespuestasElemento($id_elemento)
	{
		$where=" id_elemento = '".$id_elemento."' "; 
		return  parent::getArrayObjects($this->sourceTable,$where,$this->orden);  
	}
}


/************************************** REPUESTAS DE COMPONENTES ***********************************/
class ComponenteRespuesta extends PersistentObject
{		
	var $sourceTable = "rubrica_componente_respuesta"; 
	
	function ComponenteRespuesta() 
	{
		parent::PersistentObject();
	}	 	 	  
	
	function obtenerRespuesta($usuario, $id_componente)
	{
		parent::loadObject(" usuario = '".$usuario."' AND id_componente = ".$id_componente);
		if(!isset($this->usuario))
		{
			$this->usuario = $usuario;
			$this->id_componente = $id_componente;
			$this->saveObject();
			parent::loadObject(" usuario = '".$usuario."' AND id_componente = ".$id_componente);
		}
	}   
	
	function guardarRespuesta()
	{
		$this->saveObject(" usuario = '".$this->usuario."' AND id_componente = ".$this->id_componente);
	}
}

class ControlComponenteRespuesta extends ControladorDeObjetos 
{

	var $obj; 	 
	var $orden = 'fecha ASC';
	
	function ControlComponenteRespuesta() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new ComponenteRespuesta(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  	 
	
	function obtenerRespuestasUsuario($usuario)
	{
		$where=" usuario = '".$usuario."'"; 
		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 		 
		return $datos;
	}
	
	function obtenerRespuestasComponente($id_componente)
	{
		$where=" id_componente = '".$id_componente."' "; 
		return  parent::getArrayObjects($this->sourceTable,$where,$this->orden);  
	}
}



/********************************************************************************************
		CLASES CONTROLADORES DE EVIDENCIAS DE ELEMENTOS 
********************************************************************************************/
class ElementoEvidencia extends Objetos 
{		
	var $sourceTable = "rubrica_elemento_evidencias";
	var $dbKey		 = 'id_evidencia';
	
	function ElementoEvidencia() 
	{
		parent::Objetos();
	}	 	   
} 

class ControlElementoEvidencia extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = 'orden';
	
	function ControlElementoEvidencia() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new ElementoEvidencia(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  	 
	
	function getEvidenciasPorElemento($id_elemento='')
	{				 
		$where='';
		if($id_elemento != '')
			$where = 'id_elemento = '.$id_elemento;

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 		 
		return $datos;
	}	
}

/********************************************************************************************
		CLASES CONTROLADORES DE MEDIOS DE ELEMENTOS 
********************************************************************************************/
class ElementoMedio extends Objetos 
{		
	var $sourceTable = "rubrica_elemento_medio";
	var $dbKey		 = 'id_medio';
	
	function ElementoMedio() 
	{
		parent::Objetos();
	}	 	   
} 

class ControlElementoMedio extends ControladorDeObjetos 
{
	var $obj; 	 
	var $orden = 'orden';
	
	function ControlElementoMedio() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new ElementoMedio(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  	 
	
	function getMediosPorElemento($id_elemento='')
	{				 
		$where='';
		if($id_elemento != '')
			$where = 'id_elemento = '.$id_elemento;

		$datos =  parent::getArrayObjects($this->sourceTable,$where,$this->orden); 		 
		return $datos;
	}	
}
?>