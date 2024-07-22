<?
	$e 				= new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/registro/form_registro_sedes.tpl');
	$fila 			= VarSystem::getVariable('fila');	
	$fila_mas 		= $fila+1;	 

	$ControlEdicionATE = new ControlEdicionATE();

	$e->setVariable('numero_div',$fila);
	$e->setVariable('numero_div_mas',$fila_mas);  

	$e->setVariable('ate_sede_original','no');
	
	$FormGeneral 	= new FormGeneral(); 
	$e->setVariable('ate_sede_region',$FormGeneral->showRegion('',"showComuna('ate_nosede_".$fila."_region_id','ate_sede_".$fila."_comuna_id')"));	
	
	$ControlAyuda 	= new ControlAyuda();
	$Ayudas 		= $ControlAyuda->getAyudaTipo('registro_paso1_sede'); 
	$totalAyudas = count($Ayudas);
	for($i=0; $i < $totalAyudas; $i++)
	{						
		$e->setVariable('ayuda_'.$Ayudas[$i]['id_ayuda'],$FormGeneral->showHelpForm($Ayudas[$i]['titulo'],$Ayudas[$i]['ayuda'],$Ayudas[$i]['id_ayuda']) );		
	}		

	/* CASO EN QUE SEA UNA SEDE DE INGRESO VIA ACTUALIZACION */
	$ControlActualizacionVariableSede   = new ControlActualizacionVariableSede();
	$sedes_actualizadas 				= $ControlActualizacionVariableSede->elementosActivos(VarSystem::getVariable('id_oferente'));
	$total = count($sedes_actualizadas);
	if($total > 0 && is_array($sedes_actualizadas))
	{
		for($i=0; $i < $total ; $i++)
		{
			if($sedes_actualizadas[$i]['orden'] == $fila_mas && $sedes_actualizadas[$i]['tipo_actualizacion'] == 'ingreso')
			{
				$e->setVariable('ate_sede_direccion',$sedes_actualizadas[$i]['direccion']);
				$e->setVariable('ate_sede_email',$sedes_actualizadas[$i]['email']);
				$e->setVariable('ate_sede_telefono_codigo',$sedes_actualizadas[$i]['telefono_codigo']);
				$e->setVariable('selected_codigo_area_option_'.$sedes_actualizadas[$i]['telefono_codigo'],'selected');
				$e->setVariable('ate_sede_telefono',$sedes_actualizadas[$i]['telefono']);
				$e->setVariable('sede_estado',$ControlEdicionATE->mostrarTextoTipoActualizacion('ingreso'));
				$ControlComuna = new ControlComuna();
				$id_region = $ControlComuna->getRegionByComuna($sedes_actualizadas[$i]['comuna_id']);
				$region_template = $FormGeneral->showRegion($id_region,"showComuna('ate_noinstitucion_region_id','ate_institucion_comuna_id')");  
				$e->setVariable('ate_sede_region',$region_template);
				$comuna_template = $FormGeneral->showComunaByRegion($id_region,$sedes_actualizadas[$i]['comuna_id']);
				$e->setVariable('ate_sede_comuna',$comuna_template);
				break;
			}
		}
	}
	echo $e->toHtml();
?>