<?php

	global $ControlHtml;  
	
	$elUsuarioP 		= $ControlHtml->elUsuarioP;    
	$id_titulo 			= VarSystem::getVariable('id_titulo'); 
	$tipo	 			= VarSystem::getVariable('id_titulo'); 
	$rut 				= VarSystem::getVariable('rut'); 
 	 
	if(VarSystem::getVariable('caso_revision') == 'registro')
	{
		$OfertaRecursos 			= new OfertaRecursos();    
		$OfertaRecursos->setRecurso($rut); 
		$aux = $tipo."_extension";
		$OfertaRecursos->$aux = '';   	
		$aux = $tipo."_archivo";
		$nombre_documento = $OfertaRecursos->$aux;
		$OfertaRecursos->$aux = ''; 		
		$sw = $OfertaRecursos->saveObject();
	}
	else
	{
		$OferenteInfoTitulos 			= new OferenteInfoTitulos();    
		$OferenteInfoTitulos->setData($id_titulo);
		$nombre_documento 	= $OferenteInfoTitulos->md5_documento;
		$OferenteInfoTitulos->eliminarDocumento(); 
	} 


	 
	$DocumentFile 			= new DocumentFile(VarSystem::getPathVariables('dir_repositorio_ate_doc'));
	$DocumentFile->fileName = $nombre_documento;
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