<?php

	$oferentes  		= VarSystem::getVariable('oferentes');  
	$oferentes 			= explode('-',$oferentes);  
 
	$total 				= count($oferentes);
	$caso 				= VarSystem::getVariable('caso_revision'); 
	global $ControlHtml;  
	    
	for($i=0; $i < $total; $i++)
	{
		if(trim($oferentes[$i]) == '')
			continue;

		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/revision/listado_infotipooferente.tpl');
		
		$e->addTemplate('vista_simple');
		$e->setVariable('id_oferente',$oferentes[$i]);
		
		echo Funciones::TextoSimple($e->toHtml())."\n"; 
	}	 

?>