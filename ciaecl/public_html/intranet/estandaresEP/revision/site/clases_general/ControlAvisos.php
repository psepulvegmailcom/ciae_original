<?php

/********************************************************************************************
			CLASES CONTROLADORES DE AVISO POPUP DE SITIO
********************************************************************************************/
class Avisos extends PersistentObject {
		
	var $sourceTable = "common_avisos";
	
	function Avisos() {
		parent::PersistentObject();
	}	
	
	function getPopup()
	{
		parent::loadObject('popup=1');
	}
	
	function saveData()
	{
		if(trim($this->id_aviso) == '')
		{
			$this->fecha = ControladorFechas::fechaActual(true,true,0,true);
			parent::saveObject();
		}
		else
		{
			parent::saveObject('id_aviso='.$this->id_aviso);
		}
	}
}

class ControlAvisos extends ControladorDeObjetos 
{
	var $obj; 	 
	
	function ControlAvisos() 
	{			
		parent::ControladorDeObjetos();
		$this->obj = new Avisos(); 	
		$this->sourceTable = $this->obj->sourceTable; 
		$this->maximo = 10;
		$this->filtrar = true;
	}
	
	function getNoticia($id)
	{
		$this->obj->loadObject('id_aviso='.$id);
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
		$this->obj->destroyObject("id_aviso='".$id."'");
	}
	
	function getLista($id=0)
	{				 
			// %H:%i:%s
		$sql = " SELECT  *, DATE_FORMAT(FROM_UNIXTIME(fecha), '%d-%m-%Y') as fecha 
				FROM ".$this->sourceTable." 
				WHERE ";
		
		if($id > 0)
		 	$sql .= " id_aviso=".$id; 		 
		else
		{
			if($this->filtrar)
				$sql .= " publicar = 1 ";
			else
				$sql .= " 1 ";
		}
			
		$sql .= " ORDER BY id_aviso DESC,fecha ASC";
		if(trim($this->maximo) != '')
			$sql .= " LIMIT 0,".$this->maximo;	
		// echo $sql;
		return(parent::getQuery($sql));		
	}
}


/********************************************************************************************
		CLASES CONTROLADORES DE PANTALLA DE INICIO DE USUARIOS
********************************************************************************************/
class Home extends Objetos 
{		
	var $sourceTable = "common_texto_inicial";
	var $dbKey		 = 'id_permiso';
	
	function Home() 
	{
		parent::Objetos();
	}	 
	
	function homeSitio()
	{
		parent::buscarObjeto(0);
	} 

	function obtenerHome($id_permiso)
	{
		parent::buscarObjeto($id_permiso);
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
	
	function getHome($id_permiso='')
	{				 
		$where='';
		if($id_permiso != '')
			$where = 'id_permiso = '.$id_permiso;

		$datos =  parent::getArrayObjects($this->sourceTable,$where); 
		
		$ControladorPermisos = new ControladorPermisos();
		$permisos = $ControladorPermisos->getArrayPermisos(); 
		$permisos = Funciones::transformarArreglo($permisos,'id_permiso'); 
		$permisos[0]['descripcion'] = 'Permiso por Defecto';

		$total = count($datos);
		for($i=0; $i < $total; $i++)
		{
			$datos[$i]['nombre_permiso'] = $permisos[$datos[$i]['id_permiso']]['descripcion'];
		} 
		return $datos;
	}
}
?>