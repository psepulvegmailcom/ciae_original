<?php		
   
  	 $ip_visitante = explode('.',$_SERVER['REMOTE_ADDR']);
  	 //print_r($ip_visitante);
  	if(($ip_visitante[0] == '200' && $ip_visitante[1] == '89') || ($ip_visitante[0] == '127' && $ip_visitante[1] == '0') )
  	{
	  	include_once 'config/config_textos.cfg'; 
		include_once 'include.php';
		
		$ControlHtml = new ControlHtml();
		
		$ControlHtml->requiereLogin();
		$ControlHtml->templateIndex(VarConfig::sitio_www_sufijo);
		$ControlHtml->setSitio(VarConfig::sitio_www);  
		$ControlHtml->setLang('es');  
		//print_r($ControlHtml);
		$ControlHtml->prepareHtml(); 
		$ControlHtml->showIndex(); 	 
		
		include_once 'include_close.php';
	}
	else
	{
		echo "ERROR: No puede acceder a este sistema desde fuera de las dependencias del CIAE - Universidad de Chile";
	}  
?> 