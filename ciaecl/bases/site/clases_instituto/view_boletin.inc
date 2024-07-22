<?php 


	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
  	$ControlBoletines = new ControlBoletines();
  	
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);	
  	
  	$ControlBoletines->setSitio($ControlGeneralSitios->site_id);
	//Funciones::mostrarArreglo($ControlGeneralSitios);	
  	$boletines = $ControlBoletines->obtenerListado();
	$valores["busqueda_flag"]="4";
	$valores["boletin"]="boletin";
	if (!$valores["pagina"]) 
	{
		$valores["pagina"]="";
	}
  	  
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'boletin.tpl');
	$e->addTemplate('bloque_banner_vinculacion');
	$e->addTemplate('bloque_home_boletin_ie');
	$total = count($boletines);
	Funciones::mostrarArreglo($boletines);
	if($total >0 && is_array($boletines))
	{			
		for($i=0; $i < count($boletines); $i++)
		{
			$e->addTemplate('bloque_elemento_boletin_ie');
			$boletines[$i]['mes_html'] = ControladorFechas::entregarMes($boletines[$i]['mes'],$ControlHtml->langSite);
			//Funciones::mostrarArreglo($boletines);
			$e->showDataSimple($boletines[$i]);
		}
	} 
	else
	{
		$e->addTemplate('bloque_no_elemento');
	}
	 
	echo $e->toHtml();
?>