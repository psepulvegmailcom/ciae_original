<?php

	global $ControlHtml;
	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'areas.tpl');
	$idioma 	= VarSystem::obtenerIdiomaActual();
	 
  	$valoresGet = VarSystem::getGet(); 
	
	$ControlAreas = new ControlAreas();
	$aux = explode('_',$ControlHtml->lastActionArray[0]);
	$clave = end($aux); 
	$e->setVariable('clave',$clave);
	
	$ControlTextos = new ControlTextos();
  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']);    
  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];  	
  	$e->setVariable('descripcion',$texto_contenido); 

	$areas = $ControlAreas->buscarClave($clave);

	$areas[0]['area'] = $areas[0]['area_'.$idioma];
	$areas[0]['area_en'] = $areas[0]['area_'.'en'];
	//Funciones::mostrarArreglo($areas,false,'AREAS LISTADO');
	
switch ($valoresGet['page']) {
    case "view_area_inicial":
        $id_area= '7';
        break;
    case "view_area_politica":
        $id_area= '1';
        break;
    case "view_area_docentes":
        $id_area= '2';
        break;
    case "view_area_ensenanza":
        $id_area= '3';
        break;  
    case "view_area_congnitivas":
        $id_area= '4';
        break;
    case "view_area_tecnologia":
        $id_area= '5';
        break;				     
}
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
		
				$ControlProyectos = new  ControlProyectos();
				$condicion=" and seleccionado_area=".$id_area;
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