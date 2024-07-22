<?php

	global $ControlHtml;
	$ControlNoticiasPrensa = new ControlNoticiasPrensa();
  	$valoresGet = VarSystem::getGet();
	$valores = VarSystem::getPost();  	
	$valores["prensa"]="prensa";
	$valores["busqueda_flag"]="4";
	if (!$valores["pagina"]) $valores["pagina"]="";		
	//$listado = $ControlNoticiasPrensa->obtenerListado();
  	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias_prensa.tpl'); 
	
		/*-----------------Buscador ---------------*/
													
			if (($valores["busqueda_flag"]>0))
				{					
				$tipoBusqueda	= $valores["busqueda_flag"];			
				$ControlNoticias = new ControlNoticiasPrensa();
						   
				list($listado,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlNoticias, $tipoBusqueda);
										  
				foreach($valores as $var => $val)
					{   
					$e->addTemplate('bloque_asignacion_valores_formulario');
					$e->setVariable('variable',$var);
					$e->setVariable('valor',$val);		
					} 
				  
				}  
		/*-----------------Fin Buscador---------------------*/
	$total = count($listado);
	if(is_array($listado) && $total > 0)
	{
		$elementos  = ControladorFechas::traducirMes($listado,'en-es');
		$max = count($elementos); 
		for($i=0; $i <  $max;$i++)
		{
			$elementos[$i]['url'] = str_replace(';','',$elementos[$i]['url']); 
			$e->addTemplate('bloque_elemento');   
			$e->showDataSimple($elementos[$i]);
		} 
		//$e->showBlock('bloque_elemento',$listado);
		/*---------  Paginación   ---------------------*/	
			$e->addTemplate('bloque_elemento_paginacion');				
			$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
		/*--------- Fin Paginación   -----------------*/
	}	
	else
	{
		$e->addTemplate('bloque_no_elemento');
	}  	
	echo $e->toHtml();
	    	
?>
