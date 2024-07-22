<?php

	global $ControlHtml;  
	$elUsuarioP = $ControlHtml->elUsuarioP;  
	$nombre_documento = VarSystem::getVariable('nombre_documento');
	 
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona);
		
		
	$OferenteInfoDocumentos = new OferenteInfoDocumentos(); 	
	
 	$OferenteInfoDocumentos->setData($ControlOferente->obj->id_oferente,$nombre_documento);

	$DocumentFile 			= new DocumentFile(VarSystem::getPathVariables('dir_repositorio_ate_doc'));
	$DocumentFile->fileName = $OferenteInfoDocumentos->md5_documento;
	$sw = $OferenteInfoDocumentos->delData($ControlOferente->obj->id_oferente,$nombre_documento);
	if($DocumentFile->deleteFile())
		echo 'ok';
	else
	{
		if($sw)
			echo 'ok';
		else
			echo '';
	}	
?>