<?php

require_once('../../libs/nusoaplib/nusoap.php');	
			
$oSoapClient = new nusoap_client( 'http://localhost/desarrollo/ate/html/webservices/percepcionATE.php?wsdl', true); 
 
if ($sError = $oSoapClient->getError()) { 

	echo "No se pudo realizar la operación [" . $sError . "]"; 
	die(); 
}
 
	   
$aParametros = array("nombre" => "Paul" ,'apellido' => 'sep'); 
 
$aRespuesta = $oSoapClient->call("hola", $aParametros ); // Existe alguna falla en el servicio? 

if ($oSoapClient->fault) { // Si 
echo "No se pudo completar la operaci&oacute;n"; 
die(); 
} else { // No 
$sError = $oSoapClient->getError(); 
// Hay algun error ? 
if ($sError) { // Si 
echo "Error:" . $sError; 
die(); 
} 
} 
print_r($aRespuesta);/* 
$simple = $aRespuesta["getLoginReturn"];
$xml = new SimpleXMLElement($simple);
$res = $xml->login[0];
echo $res; */
?>