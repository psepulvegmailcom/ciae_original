<?php

	global $ControlHtml;  
	$elUsuarioP = $ControlHtml->elUsuarioP;   
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona);
	
	$OfertaRecursos 		= new OfertaRecursos();
	$OfertaOferenteRecursos = new OfertaOferenteRecursos();

	$OfertaRecursos->nombre 				= VarSystem::getVariable('nombre');	
	$OfertaRecursos->apellido_paterno 		= VarSystem::getVariable('apellido_paterno');
	$OfertaRecursos->apellido_materno 		= VarSystem::getVariable('apellido_materno');
	$OfertaRecursos->rut 					= VarSystem::getVariable('rut');
	$OfertaRecursos->dv 					= strtoupper(VarSystem::getVariable('dv'));
	 
	
	$OfertaOferenteRecursos->rut 			= $OfertaRecursos->rut;  
	$OfertaOferenteRecursos->id_oferente 	= $ControlOferente->obj->id_oferente;
	if($OfertaOferenteRecursos->saveObject() && $OfertaRecursos->saveObject())
		echo $OfertaOferenteRecursos->rut;
	else
		echo '';
				
?>