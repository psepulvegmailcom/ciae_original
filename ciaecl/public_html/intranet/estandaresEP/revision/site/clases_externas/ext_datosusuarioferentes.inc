<?php
	$id_oferente  = VarSystem::getVariable('id_oferente'); 
 
	$ControlOferente 	= new ControlOferente();    
	$ControlOferente->setOferenteById($id_oferente); 
	$ControlPersona 	= new PersonaControl();
	$ControlPersona->setPersona($ControlOferente->obj->id_persona);   

	$Usuario = new Usuario();
	$Usuario->getUsuarioByPersona($ControlPersona->obj); 

	$OferenteInfoGeneral 		= new OferenteInfoGeneral();
	$OferenteInfoGeneral->setData($id_oferente);

	$nombre_oferente = Funciones::TextoSimple($OferenteInfoGeneral->razon_social.' - '.$OferenteInfoGeneral->nombre_fantasia);
	if(trim($nombre_oferente) == '-')
	{
		$nombre_oferente = $ControlPersona->getNombreCompleto();
	}
	$rut_oferente = Funciones::formatoNumero($OferenteInfoGeneral->rut).'-'.strtoupper($OferenteInfoGeneral->dv);
	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'ate/general/datos_usuario.tpl');
	$e->setVariable('nombre_usuario',$ControlPersona->getNombreCompleto()); 
	$e->setVariable('username',$Usuario->username);
	$e->setVariable('email',$ControlPersona->getEmail()); 
	$e->setVariable('fecha_registro',ControladorFechas::fecha2Date($ControlOferente->obj->fecha_creacion,0,true));
	
	$e->setVariable('rut_oferente',$rut_oferente);
	$e->setVariable('nombre_oferente',$nombre_oferente);
	$ControlLogs = new ControlLogs();
	$e->setVariable('fecha_ultimo_ingreso', $ControlLogs->ultimoUsuarioUso($Usuario->username)); 
	if($ControlOferente->obj->id_estado == 'validacion_enviado')
	{
	   $e->addTemplate('bloque_fecha_validacion');
	   
	   $e->setVariable('fecha_validacion',ControladorFechas::fecha2Date($ControlOferente->obj->fecha_registro,0,true));
	 
	}
	
	echo Funciones::TextoSimple($e->toHtml(),true);
?>