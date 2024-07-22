<?php

	$id_oferente  		= VarSystem::getVariable('id_oferente'); 
	$caso 				= VarSystem::getVariable('caso_revision'); 
  
	global $ControlHtml;  
	    
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/revision/listado_infotipooferente.tpl');

	$e->addTemplate('revision_vista_select');
	$e->setVariable('id_oferente',$id_oferente);


	$Oferente = new Oferente();
	$Oferente->obtenerOferente($id_oferente);

	$TipoOferente = new TipoOferente();
	$TipoOferente->obtenerTipoOferente($Oferente->id_tipo);

	$ControlTipoOferente = new ControlTipoOferente();
	$arreglo 				= $ControlTipoOferente->getTipoControl();	
	$total 					= count($arreglo);   
	if(is_array($arreglo) &&  $total > 0)
	{
		for($i=0; $i < $total; $i++)
		{ 
			$e->addTemplate('revision_vista_select_option');
			$e->setVariable('id_tipo_original',$Oferente->id_tipo);
			$e->setVariable('tipo_original',Funciones::TextoSimple($TipoOferente->tipo,true));
			$e->setVariable('id_tipo',$arreglo[$i]['id_tipo']);
			$e->setVariable('tipo_texto',Funciones::TextoSimple($arreglo[$i]['tipo'],true)); 
			$e->setVariable('id_oferente',$id_oferente);
			if($Oferente->id_tipo == $arreglo[$i]['id_tipo'])
				$e->setVariable('selected','selected');
		}
	}
	echo Funciones::TextoSimple($e->toHtml())."\n"; 

?>