<?php
 

include('email_conexion.php'); 
$e  = new miniTemplate('templates/email_lista_comunicaciones.tpl');

$valores = $_POST; 
// print_r($valores);
 

 
if(count($valores)>0)
{    
	$tipo_base = $valores['tipo_base'];
	for($i = 0; $i < count($tipo_base); $i++)
	{ 		
		$e->addTemplate('bloque_tipo_base_salida_tipo');
		$e->setVariable('tipo',trim($tipo_base[$i])); 	 
	}	 
}   

$tipo = envioEmail::obtenerListadoTipos(); 

$selecciones = envioEmail::obtenerFiltroSeleccionTipo($tipo); 

for($i=0; $i < count($tipo); $i++)
{ 
	
	$e->addTemplate('bloque_tipo_base');
	$e->setVariable('i',$i);
	foreach($tipo[$i] as $var => $val)
	{
		$e->setVariable($var,$val);
	}
}

 
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