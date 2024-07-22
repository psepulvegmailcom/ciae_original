<?php

	global $ControlHtml;  
	$elUsuarioP = $ControlHtml->elUsuarioP;   
	 
	$rut 					= VarSystem::getVariable('rut'); 
	$ControlPersona 	= new PersonaControl();
	$ControlOferente 	= new ControlOferente(); 
	
	$id_oferente = VarSystem::getVariable('id_oferente');  
	$ControlOferente->setOferenteById($id_oferente);
	$ControlPersona->setPersona($this->ControlOferente->obj->id_persona); 
	


	$OfertaOferenteRecursos = new OfertaOferenteRecursos();
	if($OfertaOferenteRecursos->deleteRecursoOferta($ControlOferente->obj->id_oferente,$rut))
	{	
		echo "se elimino";
		$OferenteRecursoPrograma = new OferenteRecursoPrograma();
		$OferenteRecursoPrograma->cleanOferenteRecursoPrograma($ControlOferente->obj->id_oferente,$rut); 
		
		$OfertaOferenteRecursosPortafolio = new OfertaOferenteRecursosPortafolio();
		$OfertaOferenteRecursosPortafolio->deleteRecursoOferentePortafolios($ControlOferente->obj->id_oferente,$rut);
	 
		/* ELIMINACION DE EXPERIENCIA EN CASO DE REVISIONES ABIERTA Y SOLO LA QUE ESTE ABIERTA */
		if($ControlHtml->elUsuarioP->perms != 3)
		{
			$RevisionOferente			= new RevisionOferente();
			$RevisionOferente->obtenerRevision($this->ControlOferente->obj->id_oferente);
			if(isset($RevisionOferente->id_revision) && trim($RevisionOferente->id_revision) != '')
			{
				if(!$RevisionOferente->revisionCerrada())
				{ 
					$RevisionOferenteCapitalHumano  	= new RevisionOferenteCapitalHumano();
					$RevisionOferenteCapitalHumano->eliminarCapital($RevisionOferente->id_revision,$rut);
					$RevisionExperienciaOferente = new RevisionExperienciaOferente();
					$RevisionExperienciaOferente->eliminarExperienciasCapital($RevisionOferente->id_revision,$rut);
				} 
			}
		}
	}
	else	
	{
		$ActualizacionVariableCapital = new ActualizacionVariableCapital();
		$ActualizacionVariableCapital->setRecurso($ControlOferente->obj->id_oferente,$rut);
		if($ActualizacionVariableCapital->estado == 'activo')
		{
			$ActualizacionVariableCapital->eliminarRecurso($ControlOferente->obj->id_oferente,$rut); 
			echo "se elimino";
		}
		else
			echo "no se elimino";
	}
		
?>