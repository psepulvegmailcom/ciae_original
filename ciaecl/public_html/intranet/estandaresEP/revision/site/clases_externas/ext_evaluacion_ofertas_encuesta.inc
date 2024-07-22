<?php 
	global $ControlHtml;   
	$id_oferente       = VarSystem::getVariable('id_oferente');
	$caso_formulario   = VarSystem::getVariable('caso_formulario');  
    $ControlEvaluacionATE = new ControlEvaluacionATE(); 
    $tpl = $ControlEvaluacionATE->mostrarEncuestaRegistro(VarSystem::getVariable('id_registro')); 
    echo Funciones::LimpiarSaltosLinea(Funciones::TextoSimple($tpl->toHtml() ) );    
?>