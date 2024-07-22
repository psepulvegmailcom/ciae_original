<?php

	global $ControlHtml;
	$lastAction = $ControlHtml->lastActionArray; 
	$opcionHtml = VarSystem::getVariable('page','GET'); 
	$agno 		= VarSystem::getVariable('agno','GET');
	$agno_actual = date('Y');
	$caso = '=';
	if(trim($agno) == '')
	{
		$agno = $agno_actual;
	}
	if(trim($agno) == 'old')
	{
		$agno = $agno_actual-2;
		$caso = '<';
	}
	
	$ControlSeminario = new ControlSeminario();
	$listado = $ControlSeminario->obtenerSeminarios($agno,$caso);
	
	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'seminarios.tpl');
	$aux = $agno_actual-2;
	$e->setVariable('agno_anterior_anterior',$aux);
	$aux = $agno_actual-1;
	$e->setVariable('agno_anterior',$aux);
	$total = count($listado);
	//print_r($listado);
	for($i=0; $i < $total; $i++)
	{
		$e->addTemplate('bloque_seminario');
		$aux = $i%2+1; 
		$e->setVariable('intercalado',$aux);		
		foreach($listado[$i] as $var => $val)
		{
			$e->setVariable($var,trim($val));
		}
		if(trim($listado[$i]['archivo']) != '')
		{
			$e->addTemplate('bloque_seminario_archivo');
			$e->setVariable('archivo',$listado[$i]['archivo']);
		}
	}
	echo $e->toHtml();
		
?>	