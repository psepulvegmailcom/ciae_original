<?php 
	
	include ("../include.php");
	include ("../config.cfg");
	$ControladorDeObjetos = new ControladorDeObjetos();
	
	
	$ControlPersonasMuestrasTiempos = new ControlPersonasMuestrasTiempos();
	//$listado = $ControlPersonasMuestrasTiempos->obtenerListado();
	
	$ControlPersonasCursoMuestraDetalle = new ControlPersonasCursoMuestraDetalle();
	$listadoMuestras = $ControlPersonasCursoMuestraDetalle->buscarMuestras('01');
	//Funciones::mostrarArreglo($listadoMuestras);
	$total = count($listadoMuestras);
	
	for($i=0; $i < $total; $i++)
	{
		$listadoTiempos = $ControlPersonasMuestrasTiempos->totalesPorRangoMuestra($listadoMuestras[$i]['id_muestra']);
		Funciones::mostrarArreglo($listadoTiempos);
	}
	
	
	include ("../include_close.php");
	
?>