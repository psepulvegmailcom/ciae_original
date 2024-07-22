<?php
/**/
	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost();  

	$path_admin				= VarSystem::getPathVariables('dir_template'); 
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);	 

	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'trabajo.tpl');


	$e->setVariable('variableMenu','pt-0');
	$e->setVariable('mt','');
	$e->addTemplate('bloque_banner_simple');	

				
	$ControlNoticias->sinFiltroIdioma(); 

    $elementos = $ControlNoticias->obtenerListadoPorBusquedaTrabajo();
	if(is_array($elementos) && count($elementos)>0)
	{							
		//$e->addTemplate('bloque_elemento_trabajo']);   						
		$max_recursos = count($elementos);						
		for($i=0; $i <  $max_recursos;$i++)
		{
			$e->addTemplate('bloque_elemento_trabajo');
			if(trim($elementos[$i]['imagen']) == '')
			{
				$elementos[$i]['imagen'] = 'blanco.jpg';
			}
			$elementos[$i]['bajada']= substr($elementos[$i]['bajada'], 0, 230)."..."; 
			$elementos[$i]['fecha_html_full']  = 
			ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
			$elementos[$i]['tituloAca'] = $elementos[$i]['titulo'];
			$e->showDataSimple($elementos[$i]);
			
		}
	} 

    $elementos = $ControlNoticias->obtenerListadoTrabajoCaducado();
	if(is_array($elementos) && count($elementos)>0)
	{							
		//$e->addTemplate('bloque_elemento_trabajo']);   						
		$max_recursos = count($elementos);						
		for($i=0; $i <  $max_recursos;$i++)
		{
			$e->addTemplate('bloque_elemento_trabajo_caducado');
			if(trim($elementos[$i]['imagen']) == '')
			{
				$elementos[$i]['imagen'] = 'blanco.jpg';
			}
			$elementos[$i]['bajada']= substr($elementos[$i]['bajada'], 0, 230)."..."; 
			$elementos[$i]['fecha_html_full']  = 
			ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
			$elementos[$i]['tituloAca'] = $elementos[$i]['titulo'];
			$e->showDataSimple($elementos[$i]);
			
		}
	} 

	echo $e->toHtml();
?>