<?php

 
	$rut   			= VarSystem::getVariable('rut');
	$dv 			= strtoupper(VarSystem::getVariable('dv'));

	global $ControlHtml;  
 
 
	$data = array('RUT' => $rut,'DV'=> $dv,'PRG' => 'STC');
	$data = http_build_query($data);

	$url 			= "https://zeus.sii.cl/cvc_cgi/stc/getstc";


	$HTTPCallRequest = new HTTPCallRequest($url,$data);
	$html = $HTTPCallRequest->httpResponse('post');

	$aux = explode('</head>',$html);
	$html = $aux[1]; 

	$found = '</center>';
	$aux = explode($found ,$html); 
	$html = $aux[1].$found.$aux[2].$found.$aux[3].$found; 
	 
	 
	echo $html; 

?>