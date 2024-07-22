<?php

	global $ControlHtml; 
	$opcion = explode('_',$ControlHtml->lastActionArray[0]);
	unset($opcion[0]);
	unset($opcion[1]);
	$opcion 	= implode('_',$opcion); 
  	$valoresGet = VarSystem::getGet();  
  	$valores 	= VarSystem::getPost(); 
  	
  	
  	if(trim($valoresGet['email']) != '')
  	{
  		//&page=view_certificado_resolucion_problemas&form_email_get=danielacastro4k@gmail.com&form_id_certificado_get=resolucion_problemas
		$ControlHtml->lastActionArray[1] = 'generar';
		$valores['form_email'] 			 = $valoresGet['email'];
		$valores['form_id_certificado']  = $opcion;
	}
  	
	Funciones::mostrarArreglo($opcion);
	$version_generica = false;
	$archivo = VarSystem::getPathVariables('dir_template_web').'certificados/'.$opcion.'.tpl';
	if(!file_exists($archivo))
	{
		$archivo = VarSystem::getPathVariables('dir_template_web').'certificados/certficado_base.tpl';
		$version_generica = true;
	}
	
	$e = new miniTemplate($archivo);  
	 
	$e->setVariable('opcion_extra',$opcion);
	$EventosInforme = new EventosInforme();
	$EventosInforme->obtenerIDInscripcion($opcion);
	$e->setVariable('titulo_correo',str_replace('"','',$EventosInforme->nombre));
	$e->setVariable('fecha_correo',$EventosInforme->date_texto);
	if($version_generica)
	{ 		
		Funciones::mostrarArreglo($EventosInforme,false,'EventosInforme');
		$e->addTemplate('bloque_titulo_formulario_certificados');
		$e->setVariable('titulo',$EventosInforme->nombre);
	}
 
 	switch($ControlHtml->lastActionArray[1])
 	{
		case 'generar':

			if($version_generica)
			{
				$CertificadoDetalle = new Inscripcion();  
			}
			else
			{
				$CertificadoDetalle = new CertificadoDetalle();  
			} 
			$CertificadoDetalle->buscarCertificado($valores['form_id_certificado'],$valores['form_email']);
			Funciones::mostrarArreglo($CertificadoDetalle,false,'CertificadoDetalle');
			
			$Inscripcion = new Inscripcion();
			$Inscripcion->consultaInscripcion($valores['form_email'],$valores['form_id_certificado']);
			
			if($CertificadoDetalle->existeElemento())
			{
				/** EXISTE */
				$e->addTemplate('bloque_existe');				
				$nombrePersona = Funciones::textToTitle(trim($CertificadoDetalle->nombre).' '.trim($CertificadoDetalle->apellidos));
				$e->setVariable('tratamiento',$Inscripcion->tratamiento );
				$e->setVariable('nombre_completo',$nombrePersona);
				$ControlCreadorCertificado = new ControlCreadorCertificado();
				$pdf = $ControlCreadorCertificado->crearCertificado($nombrePersona,$valores['form_id_certificado'],trim($CertificadoDetalle->texto_extra),$valores['form_email'],$valores['form_id_certificado']);
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