<?php
	include ("config.cfg");
	$segundo_redirect = 15;
	$redireccionar = true;
	$ControlMuestraPersonaVista = new ControlMuestraPersonaVista();
	
	
	$ControlMuestra = new ControlMuestra();
	$listado = $ControlMuestra->buscarMuestraMaximo();
	$id_muestra_maximo = $listado['0']['id_muestra'];
	 
	$id_muestra = $_GET['id_muestra'];
	if(trim($id_muestra) == '')
	{
		$id_muestra = 1;		
	}
	$id_muestra_sig = $id_muestra + 1;
	echo "REVISANDO ID_MUESTRA ".$id_muestra."<BR>";
	
	
 	$listado_muestras = $ControlMuestraPersonaVista->buscarMuestra($id_muestra);
	$total = count($listado_muestras);
 	for($i=0; $i < $total; $i++)
 	{
 		$diff =  $listado_muestras[$i]['fecha_muestra_real_time'] - $listado_muestras[$i]['fecha_muestra_inicial_time'];
 		$listado_muestras[$i]['diferencia'] = $diff;
 	} 
 	Funciones::mostrarArreglo($listado_muestras,true);
	
	
	
	
	
	if($id_muestra <= $id_muestra_maximo && $redireccionar)
	{
		?>
		<meta HTTP-EQUIV="REFRESH" content="<?php echo $segundo_redirect;?>; url=03-conteo_ajuste.php?id_muestra=<?php echo $id_muestra_sig;?>">
		<?
	}
	else
	{
		echo "YA TERMINE!!!!!!!!!";
		echo "<br><a href='03-conteo_ajuste.php'>Refrescar</a>";
	}
	
		global $indexOutput;
					echo $indexOutput ;
?>