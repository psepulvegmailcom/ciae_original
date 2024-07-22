<?php

	
	global $ControlHtml;
	$ControlHtml->revisionSesion();	


	$data = array('RUT' => $rut,'DV'=> $dv);
	$data = http_build_query($data);

	$url 			= "https://zeus.sii.cl/cvc_cgi/stc/getstc";
	$URI 			= "http://localhost/desarrollo/local/test/curl/index.php"; 

 
?>