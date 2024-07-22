<?php

/**/
class ControladorHTML extends ControladorDeObjetos
{ 
	function ControladorHTML() 
	{  
		$this->dirtemplate = VarSystem::getPathVariables('dir_template_web').'bloques/';
		$this->maxlistar = VarSystem::getTotalListarBloque();
		global $ControlHtml;  	    
		$this->ControlIdioma 	= $ControlHtml->ControlIdioma;	
		$this->idioma 			= VarSystem::obtenerIdiomaActual();	
		parent::ControladorDeObjetos();
	}  
	
	function desplegarListado($datos,$listado)
	{  
		if(!isset($datos['despliegue_completo']))
		{
			$datos['despliegue_completo'] = false; 
		}
		$datos['variable_template'] = 'listado_'.$datos['caso_template']; 
		
		$template_original = $datos['template']; 
		$e = new miniTemplate($this->dirtemplate.'bloque_redondeado.tpl');
		$total 	= count($listado);  
		$time 	= rand(0,1000000);
		if(is_array($listado) && $total > 0)
		{  
			//Funciones::mostrarArreglo($datos,false,'DATOS BLOQUES');
			$e->setVariable('titulo_bloque',$datos['titulo_template']);
			if($datos['caso_template'] == 'proyectos' || $datos['caso_template'] == 'publicaciones')
			{
				$e->addTemplate('bloque_titulo_traduccion');
			} 
			$aux = 1; 
			for($i=0; $i < $total; $i++)
			{
				$e->addTemplate('bloque_redondeado_'.$datos['caso_template']);
				$e->setVariable('fila',$aux);
				$e->setVariable('caso',$datos['caso_template'].$time); 

				if($datos['caso_template'] == 'personas')
				{
					$e->addTemplate('bloque_redondeado_'.$datos['caso_template'].'_li');
					$e->showDataSimple($listado[$i]);
					for($j=1; $j < VarSystem::getTotalListarBloqueVertical(); $j++)
					{
						$i++;
						if($i < $total)
						{
							$e->addTemplate('bloque_redondeado_'.$datos['caso_template'].'_li'); 
							$e->showDataSimple($listado[$i]);
						}
					} 
				}
				else
				{
					$e->showDataSimple($listado[$i]); 
					if($datos['caso_template'] == 'publicaciones')
					{
						//Funciones::mostrarArreglo($listado);
						if(trim($listado[$i]['ver_detalle']) == '1')
						{
							$e->addTemplate('bloque_elemento_ver_detalle');
							$e->showDataSimple($listado[$i]);
						}
						else
						{
							if(trim($listado[$i]['documento']) != '')
							{
								$e->addTemplate('bloque_elemento_documento'); 
								$e->showDataSimple($listado[$i]);
							}
							if(trim($listado[$i]['link']) != '')
							{
								$e->addTemplate('bloque_elemento_link');
								$e->showDataSimple($listado[$i]);
							}	
						}
					}
				}  
				$aux++;
			}	  
			if($total > $this->maxlistar)
			{  
				$e->addTemplate('bloque_redondeado_'.$datos['caso_template'].'_oculto_inicio_superior');
				$e->setVariable('caso',$datos['caso_template'].$time);
				$e->setVariable('caso_extra',"_superior");
				$e->setVariable('maximo',$this->maxlistar);
				$e->addTemplate('bloque_redondeado_'.$datos['caso_template'].'_oculto_inicio');
				$e->setVariable('caso',$datos['caso_template'].$time);
				$e->setVariable('maximo',$this->maxlistar); 
				$e->addTemplate('bloque_redondeado_'.$datos['caso_template'].'_oculto_cierre');
				$e->setVariable('caso',$datos['caso_template'].$time);
				$e->setVariable('maximo',$this->maxlistar);  
			}
			$template_original->setVariable($datos['variable_template'],$e->toHtml());
		} 
		//Funciones::mostrarArreglo($datos); 
		return $template_original;
	} 
	
	function desplegarAreas($datos)
	{ 
		if(trim($datos['titulo_template']) == '')
		{
		//	$datos['titulo_template'] = $this->ControlIdioma->obtenerVariable('bloques_areas'); 
		} 
		$datos['caso_template'] = 'areas';
		$listado = $this->buscarListadoAreas($datos); 
		return $this->desplegarListado($datos,$listado);
	}
	
	function desplegarPublicaciones($datos)
	{  
		if(trim($datos['titulo_template']) == '')
		{
			$datos['titulo_template'] = $this->ControlIdioma->obtenerVariable('bloques_publicaciones'); 
		} 
		$datos['caso_template'] = 'publicaciones';
		$listado = $this->buscarListadoPublicaciones($datos);  
		return $this->desplegarListado( $datos,$listado);
	}
	
		function desplegarPublicacionesPersona($datos)
	{  		
		Funciones::mostrarArreglo(array('DATOS_PUBLICACIONES_PERSONA',$datos));
		if(trim($datos['titulo_template']) == '')
		{
			$datos['titulo_template'] = "<h4>".$this->ControlIdioma->obtenerVariable('bloques_publicaciones')." Recientes </h4>"; 		
		} 

		$datos['caso_template'] = 'publicaciones';
		$listado = $this->buscarListadoPublicacionesPersona($datos); 

		
		return $this->desplegarListado( $datos,$listado);
	}
	
	function desplegarPersonas($datos)
	{  
		if(trim($datos['titulo_template']) == '')
		{
			$datos['titulo_template'] = $this->ControlIdioma->obtenerVariable('bloques_personas'); 
		}  
		$datos['caso_template'] = 'personas';
	 	$listado = $this->buscarListadoPersonas($datos); 
		return $this->desplegarListado( $datos,$listado);
	}
	
	function desplegarProyectos($datos)
	{  
		if(trim($datos['titulo_template']) == '')
		{
			$datos['titulo_template'] = $this->ControlIdioma->obtenerVariable('bloques_proyectos'); 
		}  
		$datos['caso_template'] = 'proyectos';
		$listado = $this->buscarListadoProyectos($datos); 
		return $this->desplegarListado($datos,$listado);
	}
	
		function desplegarProyectosPersona($datos)
	{  
		if(trim($datos['titulo_template']) == '')
		{
			$datos['titulo_template'] = "<h4>".$this->ControlIdioma->obtenerVariable('bloques_proyectos')." Destacados </h4>"; 
		}  
		$datos['caso_template'] = 'proyectos';
		$listado = $this->buscarListadoProyectosPersona($datos); 
		return $this->desplegarListado($datos,$listado);
	}
	
	function buscarListadoAreas($datos)
	{
		$Areas = new Areas();
		$ProyectosPersonas = new ProyectosPersonas();
		$PersonaRelacionArea = new PersonaRelacionArea();
		$listado = array();
		switch($datos['caso'])
		{ 
			case 'personas';
				$sql = "SELECT DISTINCT a.*,  area_".$this->idioma." as area
				FROM  ".$PersonaRelacionArea->sourceTable." as per ,".$Areas->sourceTable." as a
				WHERE per.id_persona = ".$datos['id']." AND per.id_area = a.id_area AND a.activo = 1
				ORDER BY a.orden";  			
			break; 
			case 'proyectos';  
				$sql = "SELECT DISTINCT a.*,  area_".$this->idioma." as area
				FROM  ".$ProyectosPersonas->sourceTable." as proper, ".$PersonaRelacionArea->sourceTable." as per ,".$Areas->sourceTable." as a
				WHERE proper.id_proyecto = ".$datos['id']." AND proper.id_persona = per.id_persona AND per.id_area = a.id_area AND a.activo = 1
				ORDER BY a.orden";  	
			break; 
		}
		$listado = parent::getQuery($sql); 
		Funciones::mostrarArreglo($listado);
		return $listado;
	}
	
	function buscarListadoProyectos($datos)
	{
		$Proyectos 				= new Proyectos();
		$TipoProyectos 			= new TipoProyectos();
		$ProyectosPersonas 		= new ProyectosPersonas();
		$PersonaRelacionArea 	= new PersonaRelacionArea();
		$listado = array();
		switch($datos['caso'])
		{
			case 'area';
				$sql = "SELECT DISTINCT pro.*,    t.*
				FROM ".$Proyectos->sourceTable." as pro, ".$ProyectosPersonas->sourceTable." as proper, ".$PersonaRelacionArea->sourceTable." as per ,".$TipoProyectos->sourceTable." as t
				WHERE t.id_tipo = pro.id_tipo AND pro.id_proyecto = proper.id_proyecto AND proper.id_persona = per.id_persona 
				      AND per.id_area =".$datos['id']." AND pro.activo = 1 and pro.nombre_site='".VarSystem::getPathVariables('web_site')."'   
				ORDER BY  pro.agno_inicio DESC, pro.proyecto";  
			break;
			case 'personas';
				$sql = "SELECT DISTINCT pro.*,    t.*
				FROM ".$Proyectos->sourceTable." as pro, ".$ProyectosPersonas->sourceTable." as proper,  ".$TipoProyectos->sourceTable." as t
				WHERE t.id_tipo = pro.id_tipo AND pro.id_proyecto = proper.id_proyecto 
						AND proper.id_persona = ".$datos['id']." AND pro.activo = 1 and pro.nombre_site='".VarSystem::getPathVariables('web_site')."'    
				ORDER BY   pro.agno_inicio DESC, pro.proyecto"; 
			break; 
		//	echo $sql;
		}
		$listado = parent::getQuery($sql);
		Funciones::mostrarArreglo($listado, false, 'LISTADO DE PROYECTOS');
		return $listado;
	} 
	
	function buscarListadoProyectosPersona($datos)
	{
		$Proyectos 				= new ProyectoRelacionSitio();
		$TipoProyectos 			= new TipoProyectos();
		$ProyectosPersonas 		= new ProyectosPersonas();
		$PersonaRelacionArea 	= new PersonaRelacionArea();
		$listado = array();
		switch($datos['caso'])
		{
			case 'area';
				$sql = "SELECT DISTINCT pro.*,    t.*
				FROM ".$Proyectos->sourceTable." as pro, ".$ProyectosPersonas->sourceTable." as proper, ".$PersonaRelacionArea->sourceTable." as per ,".$TipoProyectos->sourceTable." as t
				WHERE t.id_tipo = pro.id_tipo AND pro.id_proyecto = proper.id_proyecto AND proper.id_persona = per.id_persona 
				      AND per.id_area =".$datos['id']." AND pro.activo = 1 and pro.nombre_site='".VarSystem::getPathVariables('web_site')."'  
				ORDER BY  pro.agno_inicio DESC, pro.proyecto limit 3";  
			break;
			case 'personas';
				$sql = "SELECT DISTINCT pro.*,    t.*
				FROM ".$Proyectos->sourceTable." as pro, ".$ProyectosPersonas->sourceTable." as proper,  ".$TipoProyectos->sourceTable." as t
				WHERE t.id_tipo = pro.id_tipo AND pro.id_proyecto = proper.id_proyecto 
						AND proper.id_persona = ".$datos['id']." AND pro.activo = 1  and pro.nombre_site='".VarSystem::getPathVariables('web_site')."'  
				ORDER BY   proper.destacado DESC, pro.agno_inicio DESC, pro.id_proyecto DESC limit 3"; 
			break; 
		}
		//echo $sql;
		$listado = parent::getQuery($sql);
		Funciones::mostrarArreglo($listado, false, 'LISTADO DE PROYECTOS');
		return $listado;
	} 
	
	function buscarListadoPublicaciones($datos)
	{ 
		$Publicaciones 			= new Publicaciones();
		$PublicacionesTipo 		= new PublicacionesTipo();
		$PublicacionesPersona 	= new PublicacionesPersona();
		$PublicacionesProyectos = new PublicacionesProyectos();
		$Persona = new Persona();
		$listado = array();
		switch($datos['caso'])
		{
			case 'area';  
				$PersonaRelacionArea = new PersonaRelacionArea();
				$sql = "SELECT DISTINCT pub.*, t.* 
				FROM ".$Publicaciones->sourceTable." as pub, ".$PublicacionesPersona->sourceTable." as pubper,  ".$PersonaRelacionArea->sourceTable." as per,".$PublicacionesTipo->sourceTable." as t 
				WHERE  pub.activo = 1 AND  t.id_tipo = pub.id_tipo AND pub.id_publicaciones = pubper.id_publicaciones AND pubper.id_persona = per.id_persona AND per.id_area = ".$datos['id']." and pub.nombre_site='".VarSystem::getPathVariables('web_site')."'  
				ORDER BY pub.agno DESC, pub.id_publicaciones, t.orden";
			break;
			case 'personas';
				$sql = "SELECT DISTINCT pub.*
				FROM ".$Publicaciones->sourceTable." as pub,   ".$PublicacionesPersona->sourceTable." as pubper
				WHERE pub.activo = 1 AND pub.id_publicaciones = pubper.id_publicaciones AND pubper.id_persona =  ".$datos['id']." and pub.nombre_site='".VarSystem::getPathVariables('web_site')."'   
				ORDER BY pub.agno DESC, pub.id_publicaciones";			
			break; 
			case 'proyectos';
				$sql = "SELECT DISTINCT pub.*
				FROM ".$Publicaciones->sourceTable." as pub,   ".$PublicacionesProyectos->sourceTable." as pubpro
				WHERE  pub.activo = 1 AND pub.id_publicaciones = pubpro.id_publicaciones AND pubpro.id_proyecto =  ".$datos['id']." and pub.nombre_site='".VarSystem::getPathVariables('web_site')."'  
				ORDER BY  pub.agno DESC, pub.id_publicaciones";
			break; 
		}
		$listado = parent::getQuery($sql); 
		$total   = count($listado);
		if(is_array($listado) && $total>0)
		{
			$ControlPublicacionesPersona = new ControlPublicacionesPersona();   
			for($i=0; $i < $total; $i++)
			{
				$autores = $ControlPublicacionesPersona->obtenerListadoPersonas($listado[$i]['id_publicaciones']);
				$listado[$i]['autores'] = $autores;
			}
		}  
		Funciones::mostrarArreglo($listado);
		return $listado;
	}
	
		function buscarListadoPublicacionesPersona($datos)
	{ 
		$Publicaciones 			= new PublicacionRelacionSitio();
		$PublicacionesTipo 		= new PublicacionesTipo();
		$PublicacionesPersona 	= new PublicacionesPersona();
		$PublicacionesProyectos = new PublicacionesProyectos();
		$Persona = new Persona();
		$listado = array();
	
		switch($datos['caso'])
		{
			case 'area';  
				$PersonaRelacionArea = new PersonaRelacionArea();
				$sql = "SELECT DISTINCT pub.*, t.* 
				FROM ".$Publicaciones->sourceTable." as pub, ".$PublicacionesPersona->sourceTable." as pubper,  ".$PersonaRelacionArea->sourceTable." as per,".$PublicacionesTipo->sourceTable." as t 
				WHERE  pub.activo = 1 AND  t.id_tipo = pub.id_tipo AND pub.id_publicaciones = pubper.id_publicaciones AND pubper.id_persona = per.id_persona AND per.id_area = ".$datos['id']." and p.nombre_site='".VarSystem::getPathVariables('web_site')."'  
				ORDER BY pub.agno DESC, pub.id_publicaciones, t.orden";
			break;
			case 'personas';
		//	if ($datos['id']!='3'){											
				$sql = "SELECT DISTINCT pub.*
				FROM ".$Publicaciones->sourceTable." as pub,   ".$PublicacionesPersona->sourceTable." as pubper
				WHERE pub.activo = 1 AND pub.id_publicaciones = pubper.id_publicaciones AND pubper.id_persona =  ".$datos['id']."  				   and pub.nombre_site='".VarSystem::getPathVariables('web_site')."'  
				ORDER BY pubper.destacado DESC, pub.agno DESC, pub.id_publicaciones DESC limit 3";
			//	}						
			break; 
			case 'proyectos';
				$sql = "SELECT DISTINCT pub.*
				FROM ".$Publicaciones->sourceTable." as pub,   ".$PublicacionesProyectos->sourceTable." as pubpro
				WHERE  pub.activo = 1 AND pub.id_publicaciones = pubpro.id_publicaciones AND pubpro.id_proyecto =  ".$datos['id']." and pub.nombre_site='".VarSystem::getPathVariables('web_site')."'  
				ORDER BY  pub.agno DESC, pub.id_publicaciones limit 3";				
			break; 
	
		}
		$listado = parent::getQuery($sql); 
		$total   = count($listado);
		if(is_array($listado) && $total>0)
		{
			$ControlPublicacionesPersona = new ControlPublicacionesPersona(); 
								
			  
			for($i=0; $i < $total; $i++)
			{
				$autores = $ControlPublicacionesPersona->obtenerListadoPersonas($listado[$i]['id_publicaciones']);
				$listado[$i]['autores'] = $autores;
			}
		
		}  

		return $listado;
	}		
	
	function linkPersona($id_persona,$nombre)
	{ 
		$e = new miniTemplate($this->dirtemplate.'formato_persona.tpl');
		$e->setVariable('id_persona',$id_persona);
		$e->setVariable('nombre_persona',$nombre);
		//	Funciones::mostrarArreglo($e);
		//	Funciones::mostrarArreglo($id_persona,$nombre);
		return $e->toHtml();
	}
	
	function buscarListadoPersonas($datos)
	{ 	
		$Persona = new Persona();
		$PersonaRelacionArea = new PersonaRelacionArea();
		$PersonaRelacionTipo = new PersonaRelacionTipo();
		$listado = array(); 
		switch($datos['caso'])
		{
			case 'area';  
				$sql = "SELECT DISTINCT  per.* , CONCAT(per.nombre,' ',per.apellido_paterno,' ',per.apellido_materno) as nombre_persona
				FROM ".$PersonaRelacionArea->sourceTable." as pera, ".$Persona->sourceTable." as per, ".$PersonaRelacionTipo->sourceTable." as pert
				WHERE per.id_persona = pera.id_persona AND pera.id_area = ".$datos['id']." AND pert.id_persona = per.id_persona 
				ORDER BY per.apellido_paterno, per.apellido_materno, per.nombre";
			break;  
			case 'proyectos';
				$ControlProyectos = new ControlProyectos();
				$sql = $ControlProyectos->obtenerPersonas($datos['id'],true);
				
				$sql = str_replace('SELECT DISTINCT ',"SELECT DISTINCT  CONCAT(per.nombre,' ',per.apellido_paterno,' ',per.apellido_materno) as nombre_persona,  ",$sql);
				$sql = str_replace('r.nombre_extra','CONCAT(r.nombre_extra,"<br>",r.cargo) as cargo_proyecto',$sql);
				
			break;
			default;
			break;
			
		}  
		$listado = parent::getQuery($sql); 
	 	Funciones::mostrarArreglo($listado);
		return $listado;
	}	
}
?>