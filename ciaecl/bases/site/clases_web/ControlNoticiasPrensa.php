<?php

/**/
class EnLaPrensaObjeto extends Objetos 
{	
	var $sourceTable = 'site_noticias_prensa';
			
	function EnLaPrensaObjeto() 
	{
		parent::Objetos();
		$this->dbKey = 'id_prensa';
	}		 	
}

class NoticiaPrensaRelacionSitio extends Objetos 
{	
	var $sourceTable = "view_noticias_prensa_site";
		
	function NoticiaPrensaRelacionSitio() 
	{
		parent::Objetos();
		$this->dbKey = 'id_prensa';

	}	 
}
	
	
class NoticiaPrensaSitio extends Objetos 
	{	
		var $sourceTable = "site_noticias_prensa_site";
		
		function NoticiaPrensaSitio() 
		{
			parent::Objetos();
			$this->dbKey = 'id_prensa';
		//	$this->dbKey = 'id_site';
		}			 
	}			

class ControlEnLaPrensaObjeto extends ControlObjetos
{
	function ControlEnLaPrensaObjeto()
	{
		parent::ControlObjetos();
		$this->obj 			= new NoticiaPrensaRelacionSitio();
		$ControlHtml 		= new ControlHtml();
		$this->order		= 'fecha DESC, id_prensa DESC, titulo ASC';			
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable 	= $this->obj->sourceTable;
		$this->group 		= $this->obj->dbKey;
		$this->where_site 	= " AND id_site='".$ControlHtml->sitioUsuario()."'  ";
	}
		
	function agnoActual()
	{
		$year = date("Y");
		$this->where = "  fecha <= '".$year."-12-31' AND fecha >= '".$year."-01-01'  ".$this->where_site;
	}
	
	function agnoHistorico()
	{
		$year = date("Y");
		$this->where = "  fecha < '".$year."-01-01'".$this->where_site;
	}
		 
}

/** 
** PERMITE CONSULTAR LAS NOTICIAS EN DISTINTOS MEDIOS DE COMUNICACION
**/

class NoticiasPrensa extends EnLaPrensaObjeto
{  
	function NoticiasPrensa()
	{ 
		parent::EnLaPrensaObjeto();
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
	
	
	function obtenerListadoPrensaSitio()
	{ 
		$NoticiaPrensaRelacionSitio = new NoticiaPrensaRelacionSitio();
		$order = " ORDER BY fecha_simple DESC,noti.id_prensa DESC ";
		$sql =" SELECT id_prensa, titulo, $palabra bajada, url, DATE_FORMAT(fecha, '%d-%M-%Y') AS fecha, fecha as fecha_simple, medio , pdf
		FROM  ".$NoticiaPrensaRelacionSitio->sourceTable." as noti 
		WHERE noti.id_prensa > 0  AND 
		noti.nombre_site='".VarSystem::getPathVariables('web_site')."' 
		$condicion  GROUP BY  noti.id_prensa $order $limite";
		//	echo $sql; 		 
	 	return parent::getQuery($sql);
	}
}

class ControlNoticiaPrensaSitio extends ControlObjetos
{
	function ControlNoticiaPrensaSitio()
	{
		parent::ControlObjetos();
		$this->obj 		= new NoticiaPrensaSitio();
		$this->order 	= 'id_prensa DESC, id_site ASC ';
		$this->key 		= 'id_prensa';  
		$this->sourceTable = $this->obj->sourceTable;
	}  
	
	function obtenerNoticiaSitio($id_prensa)
	{
		$this->where = "  id_prensa = '".$id_prensa."'  "; 
		return parent::obtenerListado();
	}	
	
	function eliminarVacias()
	{ 
		  $EnLaPrensaObjeto = new EnLaPrensaObjeto();
		  $sql = "INSERT IGNORE INTO ".$this->sourceTable."
		  SELECT n.id_prensa, '100' as id_site  
		  FROM ".$EnLaPrensaObjeto->sourceTable."  as n LEFT JOIN  ".$this->sourceTable." as ns ON n.id_prensa = ns.id_prensa  
		  WHERE ns.id_prensa IS NULL";
		  //echo $sql;
		  parent::consultarEspecifica($sql); 
	}
    
    function obtenerListadoPorBusqueda($palabra, $condicion, $order, $limite)
	{ 
		$NoticiaPrensaRelacionSitio = new NoticiaPrensaRelacionSitio();
		$order = " ORDER BY noti.id_prensa DESC ";
		$sql =" SELECT id_prensa, titulo, $palabra bajada, url, fecha, medio , pdf
		FROM  ".$NoticiaPrensaRelacionSitio->sourceTable." as noti 
		WHERE 
		noti.nombre_site='".VarSystem::getPathVariables('web_site')."' 
		$condicion  GROUP BY noti.id_prensa $order $limite";
	//	echo $sql; 		 
	 	return parent::getQuery($sql);
	}
}



?>