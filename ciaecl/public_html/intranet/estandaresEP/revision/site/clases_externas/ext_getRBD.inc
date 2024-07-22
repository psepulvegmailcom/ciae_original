<?php

 
	$rbd   			= VarSystem::getVariable('rbd'); 
	/*$url = "http://w3app.mineduc.cl/site/servlet/NavigationServlet?page=ficha_establecimiento&id_establecimiento=".$rbd;
	$HTTPRequest 	= new HTTPRequest($url);	
	$html 			= $HTTPRequest->getHTMLClean();
	$html 			= str_replace(" :",":",$html);
	$html 			= str_replace(": ",":",$html);
	$html 			= str_replace("\n"," ",$html);
	
	$aux 			= split('Nombre del Establecimiento:',$html);
	$aux 			= split('RBD:',$aux[1]);
	//echo  trim($aux[0]) ; */
	
	$RegistrosRBD = new RegistrosRBD();
	$RegistrosRBD->loadObject("rbd='".$rbd."'");
	if($RegistrosRBD->num_esta == 0 )
		$RegistrosRBD->num_esta = '';
	echo  trim($RegistrosRBD->nom_esta." ".$RegistrosRBD->let_esta." ".$RegistrosRBD->num_esta); 	
	 
	


?>