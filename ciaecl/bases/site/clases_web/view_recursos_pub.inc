<?php
	 
	global $ControlHtml;
	$ControlRecursos = new ControlRecursos();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost(); 
	$ControlGeneralSitios = new ControlGeneralSitios();


	if(!isset($valoresGet['id']))
	{		 
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'publicaciones_nce.tpl');
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','5');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']); 
		$ControlRecursos->sinFiltroIdioma();
			
		if($valoresGet['page']=='view_recursos')	
		{
           $valores["busqueda_flag"]=5;
			if (!$valores["pagina"])
			{ 
				$valores["pagina"]="";
			}
		}
		
	}

		
					
					

	 
	$e =  $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'recursos','5',$valoresGet["page"],'8'); 


	echo $e->toHtml();
?>