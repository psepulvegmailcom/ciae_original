<?php

	global $ControlHtml;  
	$elUsuarioP = $ControlHtml->elUsuarioP;  
	$experiencia = VarSystem::getVariable('experiencia');
	$id_programa = VarSystem::getVariable('id_programa');
	 
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona);
	
	$OfertaOferenteAtencionPrograma = new OfertaOferenteAtencionPrograma();
	$OfertaOferenteAtencionPrograma->id_oferente = $ControlOferente->obj->id_oferente;
	$OfertaOferenteAtencionPrograma->cleanOfertaOferenteAtencionPrograma($id_programa);
		 
	$OfertaOferenteAtencionPrograma->setOfertaOferenteAtencionPrograma($id_programa,$experiencia);
				
?>