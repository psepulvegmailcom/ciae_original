<?php
	
	$config = "../../config.cfg";   
  	include $config;  
  	
  	
	$ControladorDeObjetos 		= new ControladorDeObjetos(); 
	$sql = "SELECT id_persona , nombre , apellido_paterno , apellido_materno
FROM auth_user_info ";


	$output 			= $ControladorDeObjetos->getQuery($sql);
	$total 				= count($output); 
	for($j=0; $j < $total; $j++)
	{
	   $sql2 = " UPDATE auth_user_info SET nombre = '".addslashes(Funciones::textToTitle($output[$j]['nombre']))."' , apellido_paterno = '".addslashes(Funciones::textToTitle($output[$j]['apellido_paterno']))."' , apellido_materno = '".addslashes(Funciones::textToTitle($output[$j]['apellido_materno']))."' WHERE id_persona = ".$output[$j]['id_persona'].";";
	   
	   echo $sql2.'<br><br>';
	}
	
		$sql = "SELECT id_oferente , nombre , apellido_paterno , apellido_materno
FROM ate_oferente_info_responsable ";


	$output 			= $ControladorDeObjetos->getQuery($sql);
	$total 				= count($output); 
	for($j=0; $j < $total; $j++)
	{
	   $sql2 = " UPDATE ate_oferente_info_responsable SET nombre = '".addslashes(Funciones::textToTitle($output[$j]['nombre']))."' , apellido_paterno = '".addslashes(Funciones::textToTitle($output[$j]['apellido_paterno']))."' , apellido_materno = '".addslashes(Funciones::textToTitle($output[$j]['apellido_materno']))."' WHERE id_oferente = ".$output[$j]['id_oferente'].";";
	   
	   echo $sql2.'<br><br>';
	}
?>