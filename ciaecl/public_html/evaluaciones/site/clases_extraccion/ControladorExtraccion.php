<?php


class Muestra extends Objetos
{
	var $sourceTable = "ext_muestra";
	var $dbKey		 = 'id_muestra';  
  
	function Muestra() 
	{
		parent::Objetos();
	}
} 

class ControlMuestra extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlMuestra() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Muestra();  	
		$this->sourceTable = $this->obj->sourceTable;  
	}
	
	function buscarMuestraMaximo()
	{ 
		$order = "id_muestra DESC   "; 
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	} 
}

class Curso extends Objetos 
{		
	var $sourceTable = "ext_curso";
	var $dbKey		 = 'id_curso';  
  
	function Curso() 
	{
		parent::Objetos();
	}		
}

class ControlCurso extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlCurso() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Curso();  	
		$this->sourceTable = $this->obj->sourceTable;  
	}
}


class MuestraPersonaVista extends Objetos
{
	var $sourceTable = "ext_muestra_persona_vista";
	var $dbKey		 = 'id_muestra_persona';  
  
	function MuestraPersonaVista() 
	{
		parent::Objetos();
	}
} 

class ControlMuestraPersonaVista extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlMuestraPersonaVista() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new MuestraPersonaVista();  	
		$this->sourceTable = $this->obj->sourceTable;  
	} 
	
	function buscarMuestraMaximo()
	{ 
		$order = "fk_id_muestra DESC   "; 
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	} 
	
	function buscarMuestra($id_muestra)
	{
		$where = "fk_id_muestra = '".$id_muestra."'";
		$order = "id_muestra_persona ASC   "; 
		return parent::getArrayObjects($this->sourceTable,$where,$order);  
	} 
}

class Personas extends Objetos 
{		
	var $sourceTable = "ext_persona";
	var $dbKey		 = 'id_persona';  
  
	function Personas() 
	{
		parent::Objetos();
	}		
}

class ControlPersonas extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlPersonas() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Personas();  	
		$this->sourceTable = $this->obj->sourceTable;  
	}
}

class ControlPersonasCurso extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlPersonasCurso() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Objetos();  	
		$this->sourceTable = 'view_personas_cursos';  
	} 
	
	function buscarCursosDisponibles()
	{
		$sql = "SELECT DISTINCT id_curso , curso , colegio , agno
				FROM ".$this->sourceTable ; 
		return parent::getQuery($sql); 
	}

	function buscarListaCurso($id_curso,$agno)
	{
		$where = "id_curso = '".$id_curso."' AND agno = '".$agno."'";
		$order = "relacion DESC, apellido, nombre   "; 
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	} 
}




class ControlPersonasCursoMuestra extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlPersonasCursoMuestra() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Objetos();  	
		$this->sourceTable = 'view_personas_cursos_muestra';  
	} 
}

class ControlPersonasCursoMuestraDetalle extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlPersonasCursoMuestraDetalle() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Objetos();  	
		$this->sourceTable = 'view_personas_cursos_muestra_detalle';  
	}
	
	function buscarAlumnosCursoAgno($id_curso,$agno,$tipo_orden)
	{
		$where = "id_curso = '".$id_curso."' AND agno = '".$agno."'";
		
		$order = " apellido, nombre, fecha, clase, clip ";
		switch($tipo_orden)
		{
			case 'nombre': 
				$order = " agno,apellido, nombre, fecha, clase, clip ";
			break;
			case 'fecha':
				$order = " agno, fecha, clase, clip , apellido, nombre";
			break;
			case 'clase':
				$order = " agno,clase, clip , fecha,apellido, nombre  ";
			break; 
		}
		return parent::getArrayObjects($this->sourceTable,$where,$order); 
	}
	
	function buscarFechaCurso($id_curso)
	{
		$Muestra = new Muestra();
		$sql = "SELECT DISTINCT fecha FROM ".$Muestra->sourceTable." WHERE fk_id_curso = ".$id_curso; 
		return parent::getQuery($sql);
	}
	 
	function buscarMuestras($id_curso)
	{
		$Muestra = new Muestra();
		$sql = "SELECT DISTINCT id_muestra FROM ".$Muestra->sourceTable." WHERE fk_id_curso = ".$id_curso; 
		return parent::getQuery($sql);
	}
}

class ControlPersonasMuestraTotales extends ControladorDeObjetos 
{
	var $obj; 	 
	 
	function ControlPersonasMuestraTotales() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Objetos();  	
		$this->sourceTable = 'view_personas_muestra_totales';  
	} 
	
	function totalesPorMuestra($id_muestras)
	{
		$where = "";
		for($i=0; $i < count($id_muestras); $i++)
		{
			if(trim($where) != '')
			{
				$where .= " OR ";
			}
			$where .= "  	fk_id_muestra = ".$id_muestras[$i];
		} 
		$sql = "SELECT id_persona_observadora , fk_id_persona_observada , SUM(total_nomalizado_ampliado) as total 
		FROM  ".$this->sourceTable."
		WHERE ".$where."
		GROUP BY id_persona_observadora , fk_id_persona_observada";
	 	//echo "<br>".$sql."<br>"; 
		return parent::getQuery($sql); 
	}
}

class ControlPersonasMuestrasTiempos extends ControlObjetos
{
	var $obj; 	 
	 
	function ControlPersonasMuestrasTiempos() 
	{			
		parent::ControlObjetos();
		$this->obj = new Objetos();  	
		$this->sourceTable = 'view_personas_cursos_muestra_tiempos';  
	} 	
	
	function totalesPorRango($fecha,$time_inicio,$time_fin)
	{
		$sql = "SELECT fk_id_persona as id_persona_observadora , fk_id_persona_observada as id_persona_observada, fecha_muestra_real_time as tiempo 
		FROM  ".$this->sourceTable."
		WHERE  fecha = '".$fecha."' AND fecha_muestra_real_time >= ".$time_inicio." AND fecha_muestra_real_time <= ".$time_fin."
		GROUP BY fecha_muestra_real_time ";
	 	// echo "<br>".$sql."<br>"; 
		return parent::consultarEspecifica($sql); 
	}
	
	
	
	function totalesPorRangoMuestra($id_muestra)
	{
		$this->where = "id_muestra = '".$id_muestra."'   ";
		 
		return parent::obtenerListado();  
	}
	
	
}

?>