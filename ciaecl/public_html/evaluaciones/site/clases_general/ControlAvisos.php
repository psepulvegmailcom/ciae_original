<?php

/********************************************************************************************
			CLASES CONTROLADORES DE AVISO POPUP DE SITIO
********************************************************************************************/
class Avisos extends PersistentObject {
		
	var $sourceTable = "site_noticias";
	
	function Avisos() {
		parent::PersistentObject();
	}	
	
	function getPopup()
	{
		parent::loadObject('popup=1');
	}
	
	function saveData()
	{
		if(trim($this->id_noticia) == '')
		{
			$this->fecha = ControladorFechas::fechaActual(true,true,0,true);
			parent::saveObject();
		}
		else
		{
			parent::saveObject('id_noticia='.$this->id_noticia);
		}
	}
}

class ControlAvisos extends ControladorDeObjetos 
{
	var $obj; 	 
	var $idioma = '';
	
	function ControlAvisos() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Avisos(); 	
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
	
	function getNoticia($id)
	{
		$this->obj->loadObject('id_noticia='.$id);
		return $this->obj;
	}

	function mostrarTodas()
	{
		$this->maximo = '';
		$this->filtrar = false;
	}
	
	function eliminarNoticia($id)
	{
		$this->getNoticia($id); 
		$this->obj->destroyObject("id_noticia='".$id."'");
	}
	
	function getLista($id=0)
	{				 
			// %H:%i:%s
		$sql = " SELECT  *
				FROM ".$this->sourceTable." 
				WHERE ".$this->idioma." AND ";
		
		if($id > 0)
		 	$sql .= " id_noticia=".$id; 		 
		else
		{
			if($this->filtrar)
				$sql .= " publicar = 1 ";
			else
				$sql .= " 1 ";
		}
			
		$sql .= " ORDER BY fecha DESC";
		if(trim($this->maximo) != '')
			$sql .= " LIMIT 0,".$this->maximo;	
		//echo $sql;
		return(parent::getQuery($sql));		
	}
}


/********************************************************************************************
		CLASES CONTROLADORES DE PANTALLA DE INICIO DE USUARIOS
********************************************************************************************/
class Home extends PersistentObject {
		
	var $sourceTable = "common_texto_inicial";
	
	function Home() 
	{
		parent::PersistentObject();
	}	 
	
	function homeSitio()
	{
		parent::loadObject('id_permiso = 0');
	}

	function eliminarHome($id_permiso)
	{
		return parent::destroyObject('id_permiso = '.$id_permiso);
	}

	function obtenerHome($id_permiso)
	{
		parent::loadObject('id_permiso = '.$id_permiso);
		if(!isset($this->id_permiso))
		{
			$this->homeSitio();
		}
	}
}

class ControlHome extends ControladorDeObjetos 
{
	var $obj; 	 
	
	function ControlHome() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Home(); 	
		$this->sourceTable = $this->obj->sourceTable;  
	}  
	
	function getHome($id_permiso=0)
	{				 
		$where='';
		if($id_permiso != 0)
			$where = 'id_permiso = '.$id_permiso;

		return parent::getArrayObjects($this->sourceTable,$where); 
	}
}
?>