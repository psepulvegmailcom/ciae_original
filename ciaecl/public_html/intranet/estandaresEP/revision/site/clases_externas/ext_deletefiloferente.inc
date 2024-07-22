<?php

	global $ControlHtml;  
	$elUsuarioP = $ControlHtml->elUsuarioP;  
	$nombre_documento = VarSystem::getVariable('nombre_documento');
	 
	$ControlPersona 		= new PersonaControl();
	$ControlPersona->setPersonaByUser($elUsuarioP);
	$ControlOferente 		= new ControlOferente();
	$ControlOferente->setOferenteByPersona($ControlPersona->getPersona());
	$OferenteInfoDocumentos = new OferenteInfoDocumentos(); 	
	
 	$OferenteInfoDocumentos->setData($ControlOferente->obj->id_oferente,$nombre_documento);

	$DocumentFile 			= new DocumentFile(VarSystem::getPathVariables('dir_repositorio_ate_doc'));
	$DocumentFile->fileName = $OferenteInfoDocumentos->md5_documento;
	if($DocumentFile->deleteFile() && $OferenteInfoDocumentos->delData($ControlOferente->obj->id_oferente,$nombre_documento))
		echo 'ok';
	else
		echo '';
?>