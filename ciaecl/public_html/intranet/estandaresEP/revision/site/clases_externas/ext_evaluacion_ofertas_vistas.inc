<?php 
	global $ControlHtml;   
	
	$valores            = VarSystem::getPost(); 
	if(count($valores) == 0)
	{
	    $valores            = $_GET;

	}  
	      
//	  Funciones::mostrarArreglo($valores);
    $ControlEvaluacionATE = new ControlEvaluacionATE();
	
	switch($valores['opcion_vista'])
	{
		case 'evaluacion_ofertas_inscripcion':
			$tpl = $ControlEvaluacionATE->mostrarInscripcionOferta($valores['id_oferta']);
		break;
		case 'evaluacion_ofertas_satisfaccion':
			$tpl = $ControlEvaluacionATE->mostrarEvaluacionOferta($valores['id_oferta']);
		break;
		case 'evaluacion_ofertas_inscripcion_consolidada':
			$tpl = $ControlEvaluacionATE->mostrarInscripcionConsolidadaOferta($valores['id_oferta']);
		break;
		case 'evaluacion_ofertas_satisfaccion_consolidada':
			$tpl = $ControlEvaluacionATE->mostrarEvaluacionConsolidadaOferta($valores['id_oferta'],$valores['id_oferente']);
		break;
		case 'evaluacion_ofertas_resolucion':
			$tpl = $ControlEvaluacionATE->mostrarResolucionOferta($valores['id_oferta']);
		break;
		case 'evaluacion_ofertas_encuesta':
			$tpl = $ControlEvaluacionATE->mostrarEncuestaRegistro($valores['id_registro']); 
		break;
	}
    if(isset($tpl) && is_object($tpl))
	{
        $output = Funciones::LimpiarSaltosLinea($tpl->toHtml());
		echo Funciones::LimpiarSaltosLinea(Funciones::TextoSimple($output ) );    
	}
	
 
?>