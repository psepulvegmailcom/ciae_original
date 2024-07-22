<?php

	global $ControlHtml;
	$lastAction = $ControlHtml->lastActionArray; 
	$opcionHtml = VarSystem::getVariable('page','GET');
	$id = VarSystem::getVariable('id','GET');
	
	$ControlAcademico = new ControlAcademico();
	if(trim($id) != '')
	{		
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'academicos_ficha.tpl');
		$listado = $ControlAcademico->obtenerAcademicos($id);
		if(trim($listado[0]['tipo_academico']) == '')
		{
			$listado[0]['tipo_academico'] = 'Acad&eacute;mico';
		}
		foreach($listado[0] as $var => $val)
		{
			$e->setVariable($var,$val);
		}
		if(trim($listado[0]['archivo_cv']) != '')
		{
			$e->setVariable('cv_texto','Curriculum Vitae');
		}
		if(trim($listado[0]['especialidad']) != '')
		{
			$e->setVariable('especializacion','Especializaci&oacute;n:');
		} 
	}
	else
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'academicos.tpl');
	 	$listado = $ControlAcademico->obtenerAcademicos();
		//print_r($listado);
		$id_tipo_anterior = 0;
		$j=0;
		
		$total = count($listado);
		for($i=0; $i < $total; $i++)
		{
			if($id_tipo_anterior´!= $listado[$i]['id_tipo'])
			{
				$id_tipo_anterior´= $listado[$i]['id_tipo'];
				$e->addTemplate('bloque_academicos_titulo');
				$e->setVariable('tipo_academico',$listado[$i]['tipo']);
				$j=0;
			}
			if($j==3)
			{
				$j=0;
			}
			if($j==0)
			{				
				$e->addTemplate('bloque_academicos_fila');
			}
			$e->addTemplate('bloque_academicos_columna');
			$e->setVariable('page',$opcionHtml);
			foreach($listado[$i] as $var => $val)
			{
				$e->setVariable($var,$val);
			}
			$j++;
		}
	} 
	echo $e->toHtml();
?>