<?php
 
	$config = "config.cfg";   
  	include $config; 
  	
  	 
	$ControlRss = new ControlRss();
	$listado = $ControlRss->obtenerInformacion(); 

 
 //Funciones::mostrarArreglo($listado,true); 


	$e 	 = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'rss.tpl');
	$e->setVariable('url_site',VarConfig::path_site_www);
	$e->setVariable('sitio_nombre',VarConfig::site_title);
	for($i=0; $i < count($listado);$i++)
	{
		$e->addTemplate('bloque_elemento');
		$e->setVariable('url_site',VarConfig::path_site_www);
		$e->setVariable('sitio_nombre',VarConfig::site_title);
		
		$listado[$i]['fecha_update'] = date("D, d M Y H:i:s O",$listado[$i]['fecha_ingreso']);
		$aux = explode('-',$listado[$i]['fecha_html']);
		$listado[$i]['fecha_update'] = date("D, d M Y H:i:s O",mktime(0, 0, 0, $aux[1], $aux[0], $aux[2])); 
		foreach($listado[$i] as $var => $val)
		{  
			$e->setVariable($var,Funciones::textoSinHtml($val)); 
		}	 
	} 
	echo html_entity_decode($e->toHtml());
?>