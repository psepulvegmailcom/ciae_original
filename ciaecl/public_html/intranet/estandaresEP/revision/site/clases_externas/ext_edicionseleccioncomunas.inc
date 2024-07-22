<?php 
	$id_oferente  	= VarSystem::getVariable('id_oferente'); 

	$ControlOferenteOfertaCobertura = new ControlOferenteOfertaCobertura();
	$comunasOferente = $ControlOferenteOfertaCobertura->getComunasCobertura($id_oferente);
 	  
	$total = 0;
	if(is_array($comunasOferente))
		$total = count($comunasOferente);

	echo $total;
?>