<?php 
	global $ControlHtml;
	if(false)
	{
		$palabras = 'palabra_clave';
		$tipo = 'noticias';
		$Control = new ControlNoticias(); 
		$Control->where = $palabras." NOT LIKE ''";
		$listado = $Control->obtenerListado();
		// Funciones::mostrarArreglo($listado,true);
		$total = count($listado);
		
		for($i=0; $i < $total; $i++)
		{
			$ControlNube = new ControlNube();  
			$ControlNube->agregarNuevaPalabraNube($listado[$i][$palabras],$listado[$i]['id_site'],$tipo);
			echo $listado[$i][$palabras].' '.$listado[$i]['id_site'].' '.$tipo.'<br>';
		} 
		
		$palabras = 'palabras_clave';
		$tipo = 'recursos';
		$Control = new ControlRecursosSitioObjeto();
		
		$Control->where = $palabras." NOT LIKE ''";
		$listado = $Control->obtenerListado(); 
		$total = count($listado);
		
		for($i=0; $i < $total; $i++)
		{
			$ControlNube = new ControlNube();  
			$ControlNube->agregarNuevaPalabraNube($listado[$i][$palabras],$listado[$i]['id_site'],$tipo);
			echo $listado[$i][$palabras].' '.$listado[$i]['id_site'].' '.$tipo.'<br>';
		} 
		
		$palabras = 'palabras_clave';
		$tipo = 'en_la_prensa';
		$Control = new ControlEnLaPrensaObjeto();
		
		$Control->where = $palabras." NOT LIKE ''";
		$listado = $Control->obtenerListado(); 
		$total = count($listado);
		
		for($i=0; $i < $total; $i++)
		{
			$ControlNube = new ControlNube();  
			$ControlNube->agregarNuevaPalabraNube($listado[$i][$palabras],$listado[$i]['id_site'],$tipo);
			echo $listado[$i][$palabras].' '.$listado[$i]['id_site'].' '.$tipo.'<br>';
		}
	} 
	else
	{
		$ControlHtml->gotoHome('index');
	}
?>