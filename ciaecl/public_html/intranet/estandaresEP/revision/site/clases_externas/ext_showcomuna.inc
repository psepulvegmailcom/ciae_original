<?php
	global $ControlHtml; 
	$laPagina		= $ControlHtml->laPagina;
	$elUsuarioP 	= $ControlHtml->elUsuarioP;  
	$FormGeneral 	= new FormGeneral();  
	 
	$comunas 		= VarSystem::getVariable('comunas'); 
	$caso_revision 	= VarSystem::getVariable('caso_revision'); 
	 
	if(trim($comunas) == '')
	{  
		$ControlPersona 	= new PersonaControl();
		$ControlOferente 	= new ControlOferente(); 
		
		$id_oferente 		= VarSystem::getVariable('id_oferente');  
		$ControlOferente->setOferenteById($id_oferente);
		$ControlPersona->setPersona($this->ControlOferente->obj->id_persona);  
	   
		$ControlOferenteOfertaCobertura 		= new ControlOferenteOfertaCobertura();
		$OferenteOfertaCobertura 				= new OferenteOfertaCobertura();
		$OferenteOfertaCobertura->id_oferente 	= $ControlOferente->obj->id_oferente;
		$comunas = $ControlOferenteOfertaCobertura->getComunasCobertura($ControlOferente->obj->id_oferente); 
		if($caso_revision == 'edicion')
		{
			$ControlOferenteOfertaCobertura 		= new ControlActualizacionVariableComunasCobertura();
			$comunasOferente = $ControlOferenteOfertaCobertura->getComunasCobertura($ControlOferente->obj->id_oferente);
			if(is_array($comunasOferente ) && count($comunasOferente ) > 0)
			{
				$comunas = $comunasOferente;
			}
		}

	}
	else
	{
		$comunas = explode('-',$comunas); 
	} 
	   
	echo  $FormGeneral->showComunasSeleccionadas($comunas); 	
?>