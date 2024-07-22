<?php

	
	global $ControlHtml;
	$ControlHtml->revisionSesion();	


	$sitios = array();
	$sitios['geologia']['sitio'] 	= "http://localhost/desarrollo/geologia/public/?/congreso/inscripcion";
	 $sitios['geologia']['sitio'] 	= "http://localhost/desarrollo/geologia/public/?/congreso/ingreso_abstract";
	$sitios['geologia']['admin'] 	= "http://localhost/desarrollo/geologia/private";
	$sitios['imat']['sitio'] 		= "http://localhost/desarrollo/imat/sitio/imat/index.php";
	$sitios['imat']['admin'] 		= "http://localhost/desarrollo/imat/sitio/private/?/auth/login"; 
	$sitios['academia']['sitio'] 	= "http://localhost/desarrollo/academia/html"; 
	$sitios['icdb']['sitio'] 		= "http://localhost/desarrollo/icdb/sitio/html"; 
	$sitios['icdb']['sitio_old'] 		= "http://www.icdb.uchile.cl/index_old.html"; 
	
	
	$sitios['geologia']['sitio'] 	= "http://localhost/desarrollo/geologia/public/?/congreso/inscripcion";
	$web = $sitios['geologia']['sitio'] ;	 
	
	 
/* 	$HTTPRequest 	= new HTTPRequest($web);
	$html 			= $HTTPRequest->DownloadToString();
	$aux 			= explode('content_data',$html);
	echo "\n<!-- content_data   ".$aux[1]."  content_data -->\n"; */
				  
	echo '		<div style="text-align:center">		<iframe src="'.$web.'" frameborder="0" height="370"  width="550" scrolling="yes">		</iframe></div>';


	print_r( unserialize('a:2:{s:2:"es";s:44:"Modelamiento numérico de procesos geológicos";s:2:"en";s:43:"Numerical Modelling of Geological Processes";}'));

	$aux['es'] = 'Salvador';
$aux['en'] = 'Salvadortore' ;
	echo serialize($aux);

































 
?>