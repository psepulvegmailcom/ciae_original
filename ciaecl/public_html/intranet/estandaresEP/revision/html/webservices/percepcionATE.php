<?php

// Incluir NuSoap
require_once('../../libs/nusoaplib/nusoap.php');
require_once('../../config.cfg');	

// Crear una instancia del soap server
$server = new soap_server();
$server->decode_utf8 = false;
// Inicializar el soporte para WSDL 
$server->configureWSDL('consultarPercepcionwsdl', 'urn:consultarPercepcionwsdl');

 
$server->register('consultarPercepcion',               // nombre método
    array('rbd' => 'xsd:integer','rdbDv' => 'xsd:string','rut' => 'xsd:string','fecha' => 'xsd:integer','codigo' => 'xsd:string'),    // parámetros de entrada
    array('return' => 'xsd:string'),    // parámetros de salida
    'urn:consultarPercepcionwsdl',                     // namespace
    'urn:consultarPercepcion#consultarPercepcion',                // soapaction
    'rpc',                              // estilo
    'encoded',                          // uso
    'Consultar Percepcion  rbd (formato: ddddd), rdbDv (formato: d), rut (formato: dddddddd-s), fecha  (formato: ddmmaaaa), codigo  (formato: dddddd-dddddd)'          // documentación
);
// Definir el método como una función PHP
/**
 * Saludar a una persona
 *
 * @param string $nombre
 * @return string
 */

function consultarPercepcion($rbd,$rdbDv,$rut,$fecha,$codigo)
{	 
	$ControlPercepcion 	= new ControlPercepcion();
	$ControlPercepcion->registrarValores($rbd,$rdbDv,$rut,$fecha,$codigo);
	$output 			= $ControlPercepcion->consultarRegistroPercepcion();	 

	
	$ControlLogs = new ControlLogs();
	$ControlLogs->setLogSimple('webservice-percepcion',"rbd ($rbd-$rdbDv) rut ($rut) fecha ($fecha) codigo ($codigo) output ($output)");
	return $output ;
}

	 
 

// Usar la petición (en caso de existir) para invocar al servicio
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($HTTP_RAW_POST_DATA);

?>