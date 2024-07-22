<?php
	$config = "../../config.cfg";   
  	include $config;
  	
  	$id_elemento = $_GET['id_elemento'];
  	$id_nivel 	 = $_GET['id_nivel'];
  	$ancho 	 = $_GET['ancho'];
  	if(trim($ancho) == '')
  	{
  		$ancho = 14;
  	}
  	
  	$ControlNivel = new ControlNivel();
  	$niveles = $ControlNivel->getNivelesPorElemento($id_elemento);
  	
  	$ControlElemento = new ControlElemento();
  	$elemento = $ControlElemento->getItem($id_elemento);
  	$ControlComponente = new ControlComponente();
  	$componente = $ControlComponente->getItem($elemento[0]['id_componente']);
  	$ControlArea = new ControlArea();
  	$area = $ControlArea->getItem($componente[0]['id_area']);
   	//Funciones::mostrarArreglo($area);
//  	echo $niveles[0]['nivel_'.$id_nivel];
  	
  	$marca = true;
	Funciones::ImageText($niveles[0]['nivel_'.$id_nivel],$marca,$ancho,$area[0]['color']) ;
?>