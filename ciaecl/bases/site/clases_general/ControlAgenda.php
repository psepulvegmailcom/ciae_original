<?php

/********************************************************************************************
			CLASES CONTROLADORES DE AVISO POPUP DE SITIO
********************************************************************************************/
class Agenda extends PersistentObject {
		
	var $sourceTable = "site_agenda";
	
	function Agenda() {
		parent::PersistentObject();
	}	 

	function saveData()
	{
		if(trim($this->id_item) == '')
		{ 
			parent::saveObject();
		}
		else
		{
			parent::saveObject('id_item='.$this->id_item);
		}
	}
}

class ControlAgenda extends ControladorDeObjetos 
{
	var $obj; 	 
	var $idioma = '';
	
	function ControlAgenda() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Agenda(); 	
		$this->sourceTable = $this->obj->sourceTable; 
		$this->maximo = 10;
		$this->filtrar = true;
		$this->setIdioma();
	}

	function setIdioma($idioma='')
	{
		if(trim($idioma) == '')
		{
			$this->idioma = " idioma = 'nn' ";
		}
		else
		{
			if($idioma == '*')
				$this->idioma = " ( idioma = 'nn' OR  idioma != 'nn' ) ";
			else
			$this->idioma = " (idioma = 'nn' OR idioma = '".$idioma."') ";
		}
	}
	
	function getAgenda($id)
	{
		$this->obj->loadObject('id_item='.$id);
		return $this->obj;
	}

	function mostrarTodas()
	{
		$this->maximo = '';
		$this->filtrar = false;
	}
	
	function eliminarAgenda($id)
	{
		$this->getAgenda($id); 
		$this->obj->destroyObject("id_item='".$id."'");
	}

	function getMesesAgenda()
	{
		$sql = " SELECT    DATE_FORMAT(  fecha_inicio  , '%Y' ) AS agno, DATE_FORMAT(  fecha_inicio  , '%m' ) AS mes,  DATE_FORMAT(  fecha_inicio  , '%b' ) AS mes_nombre FROM ".$this->sourceTable." ORDER BY fecha_inicio";
		return(parent::getQuery($sql));		
	}
	
	function getLista($id=0,$dia_sel='')
	{				 
			// %H:%i:%s 
		$sql = " SELECT  *, DATE_FORMAT(  fecha_inicio  , '".$this->dateFormat." %H:%i' ) AS fecha_inicio_real, DATE_FORMAT(  fecha_termino  , '".$this->dateFormat." %H:%i' ) AS fecha_termino_real
				FROM ".$this->sourceTable." 
				WHERE ".$this->idioma." AND ";
		if($dia_sel != '')
		{
			$sql .= " fecha_inicio LIKE '".$dia_sel."%' AND ";
		}
		if($id > 0)
		 	$sql .= " id_item=".$id; 		 
		else
		{
			if($this->filtrar)
				$sql .= " publicar = 1 ";
			else
				$sql .= " 1 ";
		}
			
		$sql .= " ORDER BY fecha_inicio DESC";
		if(trim($this->maximo) != '')
			$sql .= " LIMIT 0,".$this->maximo;	
		//echo $sql.'<br>';
		return(parent::getQuery($sql));		
	}
}


?>