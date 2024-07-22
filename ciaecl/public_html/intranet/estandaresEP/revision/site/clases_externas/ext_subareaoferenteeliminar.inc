<?php

	global $ControlHtml;  
	$elUsuarioP = $ControlHtml->elUsuarioP;   
	$id_programa = VarSystem::getVariable('id_programa');
	 
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona); 
		  
	$ControlOferenteOfertaPortafolio = new ControlOferenteOfertaPortafolio();
	$ControlOferenteOfertaPortafolio->deletePortafolioPrograma($ControlOferente->obj->id_oferente,$id_programa); 
?>