<?php 
	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
	$ControlTextos = new ControlTextos();
  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']); 
  	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'textos/areas.tpl'); 
  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];
  	$e->setVariable('texto_contenido',$texto_contenido); 
	$idioma = VarSystem::obtenerIdiomaActual();
  	
  	//Funciones::mostrarArreglo($textos);
  	$ControlAreas = new ControlAreas();
  	$areas = $ControlAreas->obtenerListado();
  	for($i=0; $i < count($areas); $i++)
  	{
		$areas[$i]['area'] = $areas[$i]['area_'.$idioma];		
		$areas[$i]['langSite'] = $idioma;
	}
	Funciones::mostrarArreglo($areas,false,'AREAS LISTADO');
  	$e->showBlock('bloque_listado_areas',$areas);
  	
	echo $e->toHtml();
?>