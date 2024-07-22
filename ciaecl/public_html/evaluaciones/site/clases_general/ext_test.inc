<?php

	global $ControlHtml;
	$laPagina	= $ControlHtml->laPagina;
	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'test/consultasExternas.tpl');
			
		
	echo $e->toHtml();
	$data = array('RUT' => $rut,'DV'=> $dv);
	$data = http_build_query($data);

	$url 			= "https://zeus.sii.cl/cvc_cgi/stc/getstc";


	 function do_post_request($url, $data, $optional_headers = null)
	 {
	    $params = array('https' => array(
	                 'method' => 'POST',
	                 'content' => $data
	              ));
	    if ($optional_headers !== null) {
	       $params['http']['header'] = $optional_headers;
	    }
	    $ctx = stream_context_create($params);
	    $fp = @fopen($url, 'rb', false, $ctx);
	    if (!$fp) {
	       throw new Exception("Problem with $url, $php_errormsg");
	    }
	    $response = @stream_get_contents($fp);
	    if ($response === false) {
	       throw new Exception("Problem reading data from $url, $php_errormsg");
	    }
	    return $response;
	 }

do_post_request($url, $data);

?>