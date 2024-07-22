<?php

	$oferentes  		= VarSystem::getVariable('oferentes');  
	$oferentes 			= explode('-',$oferentes);  
	$total 				= count($oferentes);

	global $ControlHtml;  
	$ControlLogs 		= new ControlLogs();
 

	for($i=0; $i < $total; $i++)
	{
		if(trim($oferentes[$i]) == '')
			continue; 

		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/revision/listado_agregarinfooferente.tpl');		

		$Usuario = new  Usuario();
		$ControlOferente 	= new ControlOferente();
		$ControlPersona		= new PersonaControl();
		$ControlOferente->setOferenteById($oferentes[$i]);
		$ControlPersona->setPersona($ControlOferente->obj->id_persona);
		$Usuario->getUsuarioByPersona($ControlPersona->obj); 

		$e->setVariable('div_info_oferente','info_oferente_'.$oferentes[$i]);
		$e->setVariable('div_info_oferente_dato',$ControlLogs->ultimoUsuarioUso($Usuario->username));
		 
		echo Funciones::TextoSimple($e->toHtml())."\n";		
	}	

	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/revision/listado_agregarinfooferente.tpl');

	$e->setVariable('div_info_oferente','titulo_info_alternativo');
	$e->setVariable('div_info_oferente_dato',Funciones::TextoSimple('Fecha Último Ingreso',true));

	echo Funciones::TextoSimple($e->toHtml())."\n";		
 
?>