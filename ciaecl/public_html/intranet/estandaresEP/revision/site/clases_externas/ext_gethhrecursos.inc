<?php

	$rut   			= VarSystem::getVariable('rut');
 	$OferenteInfoGeneral = new OferenteInfoGeneral();

	/*JORNADAS de TRABAJO*/
	
	$ControlJornadaTrabajo 	= new ControlJornadaTrabajo();
	$listado 				= $ControlJornadaTrabajo->getLista();
	$listado 				= Funciones::transformarArreglo($listado,'id_jornada'); 
	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/revision/ext_hh_recursos.tpl');
	$total_horas = 0;
	/* personas naturales registradas con este rut */
	$OfertaOferenteRecursos 	= new OfertaOferenteRecursos();
	$ControlOferenteInfoGeneral = new ControlOferenteInfoGeneral();
	$personas 					= $ControlOferenteInfoGeneral->obtenerOferentesRut($rut); 
 
	$total_personas = count($personas);
	if(is_array($personas) &&  $total_personas > 0)
	{
		for($i=0; $i < $total_personas; $i++)
		{			
			$ControlOferente 	= new ControlOferente();    
			$ControlOferente->setOferenteById($personas[$i]['id_oferente']);
			if(!$ControlOferente->OferenteEstaActivo())
				continue; 
	
			$e->addTemplate('bloque_persona_natural');
			$OfertaOferenteRecursos->setRecurso($personas[$i]['id_oferente'],$rut);  
			$e->setVariable('recurso_nombre',Funciones::cleanHtml($personas[$i]['nombre']." ".$personas[$i]['apellido_paterno']." ".$personas[$i]['apellido_materno']));

			$e->setVariable('recurso_estado', Funciones::cleanHtml($ControlOferente->getEstadoDescripcionOferente()));
			$e->setVariable('hh_recurso',$OfertaOferenteRecursos->horas_disponibles);  
			$total_horas = $total_horas + $OfertaOferenteRecursos->horas_disponibles;
		}
	}
	else
	{
		$e->addTemplate('bloque_persona_natural_no');
	}
	
	$ControlOfertaOferentePortafolio = new ControlOfertaOferentePortafolio();
	$personas = $ControlOfertaOferentePortafolio->getPortafoliosRecursosRut($rut); 

	$total_personas = count($personas);
	$hay = false;
	if(is_array($personas) &&  $total_personas > 0)
	{
		for($i=0; $i < $total_personas; $i++)
		{			
			$OfertaOferenteRecursos->setRecurso($personas[$i]['id_oferente'],$rut); 
			$OferenteInfoGeneral->setData($personas[$i]['id_oferente']);
			if($OferenteInfoGeneral->rut != $rut)
			{
				$ControlOferente 	= new ControlOferente();    
				$ControlOferente->setOferenteById($OferenteInfoGeneral->id_oferente);
 
				if(!$ControlOferente->OferenteEstaActivo())
					continue;  

				$hay = true;
				$e->addTemplate('bloque_capital_humano'); 
				$e->setVariable('recurso_nombre', Funciones::cleanHtml($OferenteInfoGeneral->razon_social));
				$e->setVariable('recurso_estado', Funciones::cleanHtml($ControlOferente->getEstadoDescripcionOferente()));
				$e->setVariable('hh_recurso',$OfertaOferenteRecursos->horas_disponibles); 
				$e->setVariable('jornada_recurso',Funciones::cleanHtml($listado[$OfertaOferenteRecursos->disponibilidad]['jornada']));  
				$total_horas = $total_horas + $OfertaOferenteRecursos->horas_disponibles;
			}
		}
	}	
	if(!$hay)
	{
		$e->addTemplate('bloque_capital_humano_no');
	}
	
	$e->refreshTemplate();
	$e->setVariable('total_horas',$total_horas); 
	echo $e->toHtml();
?>