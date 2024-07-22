<?php

	$id_oferente  		= VarSystem::getVariable('id_oferente'); 
	$id_tipo_nuevo		= VarSystem::getVariable('id_tipo_nuevo'); 
  
	global $ControlHtml;   
	 
	$Oferente = new Oferente();
	$Oferente->obtenerOferente($id_oferente);
	$Oferente->id_tipo = $id_tipo_nuevo;
	$Oferente->saveObject("id_oferente='".$id_oferente."'");	
	//Funciones::mostrarArrelgo($Oferente);
	
?>