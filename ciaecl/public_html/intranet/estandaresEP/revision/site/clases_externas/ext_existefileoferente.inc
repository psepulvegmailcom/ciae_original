<?php

	global $ControlHtml;  
	$elUsuarioP = $ControlHtml->elUsuarioP;  
	$nombre_documento = VarSystem::getVariable('nombre_documento');
	 
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona);
		
		
	$OferenteInfoDocumentos = new OferenteInfoDocumentos(); 		
 	$OferenteInfoDocumentos->setData($ControlOferente->obj->id_oferente,$nombre_documento);

	if(isset($OferenteInfoDocumentos->fecha_documento) && trim($OferenteInfoDocumentos->fecha_documento) != '')
		echo 'ok';
	else
		echo ''; 
?>