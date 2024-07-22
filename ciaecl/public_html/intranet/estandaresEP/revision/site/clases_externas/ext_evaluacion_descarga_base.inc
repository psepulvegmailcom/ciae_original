<?php 
	global $ControlHtml;  
	$valores            = VarSystem::getPost();
	$archivoSalida      = '';
	$valores['lastAction'] = str_replace('||','|',$valores['lastAction']);
    $lastAction         = explode('|',$valores['lastAction']);   
    $opcion             = $lastAction[1]; 
    $ControlEvaluacionATE = new ControlEvaluacionATE(); 
    $tpl_html = ''; 
    if(isset($valores['busqueda_evaluacion_tipo_oferente']))
    {
        $valores['busqueda_evaluacion_tipo_oferente'] = explode('-',$valores['busqueda_evaluacion_tipo_oferente']);
        $aux = count($valores['busqueda_evaluacion_tipo_oferente'])-1;
        if($valores['busqueda_evaluacion_tipo_oferente'][$aux] == '')
            unset($valores['busqueda_evaluacion_tipo_oferente'][$aux]);
    } 
	if($lastAction[2] == 'descarga')
	{
		switch($opcion)
		{                
			case 'oferente':  
			  $tpl_html = $ControlEvaluacionATE->mostrarBusquedaPorOferente(true);
			  $tpl_html->setVariable('fecha_descarga',ControladorFechas::fechaActual());
              $tpl_html = $tpl_html->toHtml(); 
			break;
            case 'inscripcion': 
                $valores['descarga'] = true;
                $tpl = $ControlEvaluacionATE->mostrarResultadoPorInscripcion($valores); 
                
                foreach($valores as $var => $val)
                {
                    $aux = explode('_',$var);
                    if($aux[0] == 'busqueda' && $aux[1] == 'evaluacion')
                    {               
                        if(trim($val) != '')
                        {
                            $aux_extra = str_replace('busqueda_evaluacion_','',$var);
                            switch($aux_extra)
                            {
                                case 'caso_consulta':
                                    $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra.'_'.$val);
                                break;
                                case 'areas':                        
                                    $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra);
                                    $ControlOfertaAreaAtencion = new ControlOfertaAreaAtencion();
                                    $val = $ControlOfertaAreaAtencion->getAreaAtencion($val);  
                                    $tpl->setVariable('valor',$val[0]['area']); 
                                break;
                                case 'region':
                                    $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra);
                                    $ControlRegion = new ControlRegion();
                                    $val = $ControlRegion->getRegiones($val);  
                                    $tpl->setVariable('valor',$val[0]['region']);
                                break;
                                case 'comuna':
                                    $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra);
                                    $ControlComuna = new ControlComuna();
                                    $val = $ControlComuna->getCompletoComuna($val);  
                                    $tpl->setVariable('valor',$val[0]['comuna']);
                                break;    
                                case 'semaforo':
                                    $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra);  
                                    $colores = array('Rojo','Naranjo','Amarillo','Verde','Todos');
                                    $tpl->setVariable('valor',$colores[$val]);
                                break;     
                                case 'tipo_oferente':                            
                                    $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra);  
                                    for($j=0; $j < count($val); $j++)
                                    {
                                        $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra.'_tipo');
                                        $tpl->setVariable('valor',Funciones::textToTitle($val[$j]));
                                    } 
                                break;                    
                                default:
                                    $tpl->addTemplate('bloque_resultado_descarga_elemento_'.$aux_extra); 
                                    $tpl->setVariable('valor',Funciones::textToTitle($val));                    
                                break;
                            } 
                        }
                    }
                }   
                
                $tpl->addTemplate('bloque_resultado_descarga_elemento_fecha'); 
                $tpl->setVariable('valor',ControladorFechas::fechaActual());
                $tpl_html = $tpl->toHtml();  
            break;				
		}  
		$archivoSalida = $ControlEvaluacionATE->mostrarDescarga($tpl_html);  
	    echo $archivoSalida;
	}
?>