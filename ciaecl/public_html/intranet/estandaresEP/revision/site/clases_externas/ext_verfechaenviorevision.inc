<?php

	$oferentes  		= VarSystem::getVariable('oferentes');  
	$oferentes 			= explode('-',$oferentes);  
 
	$total 				= count($oferentes);
	$caso 				= VarSystem::getVariable('caso_revision'); 
	global $ControlHtml;  
	    
	$ControlOferenteEstados = new ControlOferenteEstados(); 
	for($i=0; $i < $total; $i++)
	{
		if(trim($oferentes[$i]) == '')
			continue;

		$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/revision/listado_verfechaenviorevision.tpl');
		 
		$OferenteEstados = new OferenteEstados();
		$OferenteEstados->fechaEnviado($oferentes[$i]); 
 
		$e->setVariable('id_oferente',$oferentes[$i]);
		$fecha = ControladorFechas::fecha2Date($OferenteEstados->fecha_estado);
 
		//$fecha .= ControladorFechas::fecha2Date($estado_actual['fecha_estado']);

		//$aux = ControladorFechas::resta_fechas(ControladorFechas::fechaActual(false),$fecha);
		
		$aux = ControladorFechas::diasDiferencia($OferenteEstados->fecha_estado);
		$dias_pasado = $aux;
 

		$OferenteEstados->fechaUltimoEstado($oferentes[$i]);
		$aux_estado = explode('_',$OferenteEstados->id_estado);
		$max_dias = VarSystem::getInfoSystem('dia_verificacion');
		if($aux_estado[0] == 'validacion')
		{
			$max_dias = $max_dias+VarSystem::getInfoSystem('dia_validacion' );
		} 
		$e->setVariable('fecha_envio',$fecha);
		$e->setVariable('dia_diff_envio',$dias_pasado);
		$e->setVariable('fecha_estado_actual',ControladorFechas::fecha2Date($OferenteEstados->fecha_estado));

		$aux = $max_dias - $aux;
		if($aux < 0)
		{
			/* significa que ya se paso del tiempo */
			$aux = -1*($dias_pasado - $max_dias);
			$e->setVariable('clase_atencion','clase_atencion');
		}
		else
		{
			if($aux < VarSystem::getInfoSystem('dia_alerta'))
			{
				$e->setVariable('clase_atencion','clase_atencion');
			}
		}
		$e->setVariable('dia_diff',$aux);
		$e->setVariable('caso',$caso);

		
		echo Funciones::TextoSimple($e->toHtml())."\n"; 
	}	 

?>