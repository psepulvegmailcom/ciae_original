<?
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'site/admin/viajes/fila_itenerario.tpl');
	$fila 			= VarSystem::getVariable('fila');
	$fila_siguiente = $fila + 1;
	
	$e->setVariable('fila_siguiente',$fila_siguiente );
	$e->setVariable('fila',$fila); 
				 
	$e->addTemplate('bloque_fila_itinerario_nuevo');
	$e->setVariable('fila_siguiente',$fila_siguiente );
	$e->setVariable('fila',$fila);
					 
	
	echo $e->toHtml();
?>