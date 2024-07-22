<?php

	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'home.tpl'); 
	 $ControladorNoticias = new ControladorNoticias();
	 $listado = $ControladorNoticias->getListaNoticias(); 
	 for($i=0; $i < 1; $i++)
	 {	 			
		foreach($listado[$i] as $var => $val)
		{
			$e->setVariable('noticia_'.$var,trim($val));
		} 
	 }
	 $ControlSeminario = new ControlSeminario();
	 $listado = $ControlSeminario->obtenerSeminarios('2009'); 
	 for($i=0; $i < 1; $i++)
	 {	 			
		foreach($listado[$i] as $var => $val)
		{
			$e->setVariable('seminario_'.$var,trim($val));
		} 
	 }
	$ControlDocumentos = new ControlDocumentos(1);
	$e = $ControlDocumentos->obtenerListadoDocumentos($e);
	echo $e->toHtml();
?>