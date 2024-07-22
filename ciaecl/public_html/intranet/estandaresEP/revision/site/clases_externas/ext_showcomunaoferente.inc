<?php
	global $ControlHtml; 
	$laPagina	= $ControlHtml->laPagina;
	$elUsuarioP = $ControlHtml->elUsuarioP;  
	 
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona); 
   
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/general/comuna_multiple_show.tpl');
	
	$ControlOferenteOfertaCobertura 		= new ControlOferenteOfertaCobertura();
	$OferenteOfertaCobertura 				= new OferenteOfertaCobertura();
	$OferenteOfertaCobertura->id_oferente 	= $ControlOferente->obj->id_oferente;
	$comunasOferente = $ControlOferenteOfertaCobertura->getComunasCobertura($ControlOferente->obj->id_oferente);
	$total = count($comunasOferente);
	$comunasSeleccionadas = array();
	for($i=0; $i < $total;$i++)
	{
		$comunasSeleccionadas[$comunasOferente[$i]['comuna_id']] = true;
	}
	$ControlRegion 	= new ControlRegion(); 
	$ControlComuna 	= new ControlComuna();
	$regiones 		= $ControlRegion->getRegiones();
	$total_regiones = count($regiones); 
	for($i=0; $i <$total_regiones; $i++)
	{   
		$comunas 	= $ControlComuna->getComunasByIdRegion($regiones[$i]['region_id']);		 
		$moduloComuna = '';
				$hay = 0;
		for($j=0; $j < count($comunas); $j++)
		{ 
			if((bool)$comunasSeleccionadas[$comunas[$j]['comuna_id']])
			{
				if($hay == 0)
				{								
					$e->addTemplate('bloque_show_region');
					$e->setVariable('nombre_region',Funciones::cleanHtml($regiones[$i]['region']));  
				}
				$hay = 1;
				$e->addTemplate('bloque_show_comuna'); 
				$e->setVariable('nombre_comuna',Funciones::cleanHtml($comunas[$j]['comuna']));  
			}
		} 
		$e->refreshTemplate();	
	}  
	  
	$modulo = $e->toHtml();	
	echo $modulo; 	
?>