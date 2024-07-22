<?php  
	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
	$ControlTextos = new ControlTextos();
  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']); 
  	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template').'site/textos/version_textos_IE.tpl'); 
  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];
  	$e->setVariable('texto_contenido',$texto_contenido);  
  	$e->setVariable('caso',$valoresGet['page']); 
  	$Menu = new Menu();
	$Menu->getOpcion($valoresGet['page']); 

	$titulo = 'titulo_'.$ControlHtml->langSite;

	$e->setVariable('descripcion',stripcslashes($Menu->$titulo)); 
  	
  	
	$aux = explode('_',$ControlHtml->lastActionArray[0]);
	$clave = end($aux); 
	$e->setVariable('clave',$clave);
	
	
	if ($valoresGet['page']=="view_investigacion"){
		$e->setVariable('variableMenu','pt-0');
		$e->setVariable('descripcion',stripcslashes($Menu->$titulo)); 
		$e->addTemplate('bloque_elemento_investigacionbanner');	
	}
	
	if(trim($textos[0]['imagen']) != '')
	{
		$e->addTemplate('bloque_texto_imagen');
		$e->setVariable('imagen',$textos[0]['imagen']);
	} 

	$e->addTemplate('bloque_elemento_investigacionbanner');
  	 
  	$ControlGeneralSitios = new ControlGeneralSitios();
  	$e = $ControlGeneralSitios->mostrarNoticiasDestacadasHome($e);
  	
      	/** EVENTOS NOTICIAS */ 
	$ControlNoticias = new ControlNoticias();
	$elementos = $ControlNoticias->obtenerEventosHome('ASC');
	$max_eventos = count($elementos);
	if(is_array($elementos) && $max_eventos > 0)
	{
		$e->addTemplate('bloque_home_palabras');
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','2'); 
		//$e->addTemplate('bloque_home_eventos_general');
		$max = count($elementos);
		for($i=0; $i <  $max;$i++)
		{
		  $e->addTemplate('bloque_home_eventos');
          $elementos[$i]['fecha_completa']= 
		  ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es'); 	
		  $elementos[$i]['mes']= 
		  ControladorFechas::entregarMesAbrev($elementos[$i]['fecha_html_full'],'en-es'); 
		  $elementos[$i]['dia']= 
		  ControladorFechas::entregarDia($elementos[$i]['fecha_html_full']);
		  $e->showDataSimple($elementos[$i]);
		}
	}  	
  	
  	
  	
  	
	echo $e->toHtml();
?>