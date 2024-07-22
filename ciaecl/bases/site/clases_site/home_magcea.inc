<?php

	global $ControlHtml;
	$lastAction = $ControlHtml->lastActionArray; 
	$opcionHtml = VarSystem::getVariable('page','GET');
	
	if($opcionHtml == 'home' || trim($opcionHtml) == '')
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'home_magcea.tpl'); 
		 
	 	$TestimonioAlumno = new Testimonios(); 
	 	$TestimonioAlumno->obtenerTestimonio(); 
	 	 
		$e->setVariable('titulo_testimonio', $TestimonioAlumno->titulo); 
		$e->setVariable('texto_testimonio', $TestimonioAlumno->testimonio); 
		if(trim($TestimonioAlumno->imagen) == '')
			$TestimonioAlumno->imagen = 'blank.gif';
		$e->setVariable('imagen_testimonio', $TestimonioAlumno->imagen); 
	}
	else
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'placement.tpl');  
		
		$tipos = array('economia','otros','academia','privado','publico');
		$ControladorDoctorados = new ControladorDoctorados();
		foreach($tipos as $j => $tipo)
		{
			$itemes = $ControladorDoctorados->obtenerDoctorados($tipo);
			for($i=0; $i <count($itemes);$i++)
			{
				$e->addTemplate('bloque_doctorado_'.$tipo);
				$e->setVariable('universidad', $itemes[$i]['universidad']); 
				$e->setVariable('nombre', $itemes[$i]['nombre']);  
			}	
		}
 
	}
	echo $e->toHtml();
?>