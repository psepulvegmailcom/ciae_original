<?php

	global $ControlHtml;
	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'areas.tpl');
	$idioma 	= VarSystem::obtenerIdiomaActual();
	 
  	$valoresGet = VarSystem::getGet(); 
	
	$ControlAreas = new ControlAreas();
	$aux = explode('_',$ControlHtml->lastActionArray[0]);
	$clave = end($aux); 
	$e->setVariable('clave',$clave);
	$areas = $ControlAreas->buscarClave($clave);
	
	$areas[0]['area'] = $areas[0]['area_'.$idioma];
	Funciones::mostrarArreglo($areas,false,'AREAS LISTADO');
	$e->showDataSimple($areas[0]); 
	
	$areas = $ControlAreas->obtenerListado();
	for($i=0; $i < count($areas); $i++)
  	{
  		$areas[$i]['area_show'] = $areas[$i]['area_'.VarSystem::obtenerIdiomaActual()];
	  	$e->addTemplate('bloque_proyectos_filtro_area'); 
	  	$e->showDataSimple($areas[$i]); 
	  	$e->addTemplate('bloque_proyectos_filtro_area_lateral'); 
	  	$e->showDataSimple($areas[$i]);  
  	}
	
	$ControlTextos = new ControlTextos();
  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']);    
  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];
  	$e->setVariable('descripcion',$texto_contenido); 
	//	Funciones::mostrarArreglo($textos);
	
				$ControlProyectos = new  ControlProyectos();
				$condicion=" and seleccionado_area=".$areas[0]['id_area'];
				$order = " Order by id_proyecto DESC ";
				$limite=" Limit 4";
				
				$listado= $ControlProyectos->obtenerListadoPorBusquedaPorArea("",$condicion,$order,$limite);
				$total = count($listado);
				if(is_array($listado) && $total > 0)
				{
					for($i=0; $i < $total; $i++)
					{ 
					$e->addTemplate('bloque_listado_proyectos_area');
					$e->setVariable('id_proyecto',$listado[$i]['id_proyecto']); 
					$e->setVariable('proyecto',$listado[$i]['proyecto']); 	
					
					$e->showDataSimple($listado[$i]);
					}
				} 
 	/*$ControladorHTML  = new ControladorHTML();
 	$datos = array('caso'=>'area','id'=>$areas[0]['id_area'],'template'=>$e,'despliegue_completo'=>false);
 	$datos['template'] = $ControladorHTML->desplegarProyectos($datos);  
  	$datos['template'] = $ControladorHTML->desplegarPublicaciones($datos); 
  	$datos['template'] = $ControladorHTML->desplegarPersonas($datos); 
	$e = $datos['template'];*/
	echo $e->toHtml();
?>