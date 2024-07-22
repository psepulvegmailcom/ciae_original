<?php

	global $ControlHtml;
	$lastAction = $ControlHtml->lastActionArray; 
	$opcionHtml = VarSystem::getVariable('page','GET');   
	
	$ControlColumna = new ControlColumna();
	$listado = $ControlColumna->obtenerColumnas();
	
	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'columnas.tpl');
 
	$total = count($listado); 
	//print_r($listado);
	for($i=0; $i < $total; $i++)
	{
		$e->addTemplate('bloque_columna');
		$aux = $i%2+1; 
		$e->setVariable('intercalado',$aux);		
		foreach($listado[$i] as $var => $val)
		{
			$e->setVariable($var,trim($val));
		} 
	}
	echo $e->toHtml(); 
?>	