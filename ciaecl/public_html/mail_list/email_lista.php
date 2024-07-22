<?php
include('email_conexion.php'); 
$e = new miniTemplate('templates/email_lista.tpl');

$valores = $_POST; 
// print_r($valores);
 
 
 
if(count($valores)>0)
{   
	$salida = 	envioEmail::listaEmailActivo($valores['tipo_base']);
	
	$total = count($salida);
	
	$e->addTemplate('bloque_tipo_base_salida');
	$e->setVariable('total_email',$total);
	$tipo_base = $valores['tipo_base'];
	for($i = 0; $i < count($tipo_base); $i++)
	{ 		
		$e->addTemplate('bloque_tipo_base_salida_tipo');
		$e->setVariable('tipo',trim($tipo_base[$i])); 	 
	}	
	for($i=0; $i < $total; $i++)
	{
		$e->addTemplate('bloque_tipo_base_salida_email');
		$email = str_replace(array(";","	","\t","\r"," "),array("","","","",""),trim($salida[$i]['email']));
		$e->setVariable('email',trim($email));
	}
}   

$tipo = envioEmail::obtenerListadoTipos(); 
for($i=0; $i < count($tipo); $i++)
{ 
	
	$e->addTemplate('bloque_tipo_base');
	$e->setVariable('i',$i);
	foreach($tipo[$i] as $var => $val)
	{
		$e->setVariable($var,$val);
	}
}


$selecciones = envioEmail::obtenerFiltroSeleccionTipo($tipo);
sort($selecciones); 
for($i=0; $i < count($selecciones); $i++)
{
	$e->addTemplate('bloque_selecciones_tipo');
	$e->setVariable('caso',$selecciones[$i]);
	$aux = $i%5; 
	if($aux == 0)
	{
		$e->addTemplate('bloque_selecciones_tipo_salto');			
	}
}
echo $e->toHtml();

?>