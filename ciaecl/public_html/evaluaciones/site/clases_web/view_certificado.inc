<?php

	global $ControlHtml; 
	$opcion = explode('_',$ControlHtml->lastActionArray[0]);
	unset($opcion[0]);
	unset($opcion[1]);
	$opcion 	= implode('_',$opcion); 
  	$valoresGet = VarSystem::getGet();  
  	
  	$valores 	= VarSystem::getPost(); 
  	
  	
  	if(trim($valoresGet['form_email_get']) != '')
  	{
  		//&page=view_certificado_resolucion_problemas&form_email_get=danielacastro4k@gmail.com&form_id_certificado_get=resolucion_problemas
		$ControlHtml->lastActionArray[1] = 'generar';
		$valores['form_email'] 			 = $valoresGet['form_email_get'];
		$valores['form_id_certificado']  = $valoresGet['form_id_certificado_get'];
	}
  	
	Funciones::mostrarArreglo($opcion);
	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'certificados/'.$opcion.'.tpl'); 
	$e->setVariable('opcion_extra',$opcion);
 
 	switch($ControlHtml->lastActionArray[1])
 	{
		case 'generar':
			$CertificadoDetalle = new CertificadoDetalle();
			$CertificadoDetalle->buscarCertificado($valores['form_id_certificado'],$valores['form_email']);
			Funciones::mostrarArreglo($CertificadoDetalle);
			if($CertificadoDetalle->existeElemento())
			{
				/** EXISTE */
				$e->addTemplate('bloque_existe');				
				$nombrePersona = ucwords(strtolower(trim($CertificadoDetalle->nombre).' '.trim($CertificadoDetalle->apellidos)));
				$e->setVariable('nombre_completo',$nombrePersona);
				$ControlCreadorCertificado = new ControlCreadorCertificado();
				$pdf = $ControlCreadorCertificado->crearCertificado($nombrePersona,$valores['form_id_certificado'],trim($CertificadoDetalle->texto_extra),$valores['form_email']);
				$e->setVariable('pdf',$pdf);
			}
			else
			{
				$e->addTemplate('bloque_no_existe');
				$e->setVariable('email',$valores['form_email']);
				$e->addTemplate('bloque_formulario');
			}
		break;
		default:
			$e->addTemplate('bloque_formulario');
		break;
	}
  
	echo $e->toHtml();
?>