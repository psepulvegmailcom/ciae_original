<?php

	global $ControlHtml;  
	$elUsuarioP 			= $ControlHtml->elUsuarioP;   
	$id_programa 			= VarSystem::getVariable('id_programa');
	$id_oferente_recurso 	= VarSystem::getVariable('id_oferente_recurso');
	 
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona); 
	 
	$ControlOfertaOferenteRecursosPortafolio = new ControlOfertaOferenteRecursosPortafolio();
	$lista 			= $ControlOfertaOferenteRecursosPortafolio->getPortafolios($id_oferente_recurso);
	$totallista 	= count($lista);
	
	$ControlOfertaOferentePortafolio = new ControlOfertaOferentePortafolio();
	$OfertaPortafolio = new OfertaPortafolio();
	for($i=0; $i < $totallista; $i++)
	{
		$OfertaPortafolio = $ControlOfertaOferentePortafolio->getPortafolio($lista[$i]['id_portafolio']);
		$OfertaPortafolio->cleanOferenteOfertaPortafolio($lista[$i]['id_portafolio']);
	}
?>