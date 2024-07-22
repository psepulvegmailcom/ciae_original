<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml; 
	$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= explode('|',$ControlHtml->laPagina->lastAction); 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/consultas/'; 
	 		 
	$valores 		= VarSystem::getPost();  
	if($lastAction[2] == 'guardar')
	{
		$Consultas = new Consultas();
		$Consultas->obtenerElemento($valores['id_consulta']);
		$Consultas->respuesta = $valores['respuesta'];
		$Consultas->respuesta_enviada = 1;
		$Consultas->guardarElemento();
		//Funciones::mostrarArreglo($Consultas);

		$cartaContacto	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/contacto.tpl');
		$cartaContacto->setVariable('email',$Consultas->email);
		$cartaContacto->setVariable('nombre',$Consultas->nombre);
		$cartaContacto->setVariable('comentario',nl2br($Consultas->consulta));
		$cartaContacto->addTemplate('bloque_respuesta'); 
		$cartaContacto->setVariable('respuesta',nl2br($Consultas->respuesta)); 
		Funciones::sendEmail($Consultas->email,'Respuesta a consulta',$cartaContacto->toHtml());
	}
	
	switch($lastAction[1])
	{	
		case 'modificar':
			$e = new miniTemplate($path_admin.'form.tpl');
			$e->setVariable('opcion',$ControlHtml->lastActionArray[0]);
			$ControladorConsultas = new ControladorConsultas();
			$ListaDeObjetos = $ControladorConsultas->obtenerListado($valores['id_consulta']);
			$ListaDeObjetos[0]['fecha_html'] = ControladorFechas::fecha2Date($ListaDeObjetos[0]['fecha'],0,true);
			$ListaDeObjetos[0]['consulta_html'] =  nl2br(trim($ListaDeObjetos[0]['consulta']));
			$ListaDeObjetos[0]['respuesta_html'] =  nl2br(trim($ListaDeObjetos[0]['respuesta']));
			//Funciones::mostrarArreglo($ListaDeObjetos[0]);
			foreach($ListaDeObjetos[0] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}  
			if($ListaDeObjetos[0]['respuesta_enviada'] == 1)
			{
				$e->addTemplate('bloque_respuesta_enviada');
				$e->setVariable('respuesta_html',$ListaDeObjetos[0]['respuesta_html']);
			}
			else
			{ 
				$e->addTemplate('bloque_respuesta_form');
			}
			
		break;
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion',$ControlHtml->lastActionArray[0]);
			$ControladorConsultas = new ControladorConsultas();
			$ListaDeObjetos = $ControladorConsultas->obtenerListado();
			//Funciones::mostrarArreglo($ListaDeObjetos[1]);
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$total = count($ListaDeObjetos); 
				for($i=0; $i < $total; $i++)
				{
					$e->addTemplate('lista_item');
					$ListaDeObjetos[$i]['fecha_html'] = ControladorFechas::fecha2Date($ListaDeObjetos[$i]['fecha'],0,true); 
					$ListaDeObjetos[$i]['pendiente'] = '<b>Pendiente</b>';
					if($ListaDeObjetos[$i]['respuesta_enviada'] == 1)
					{
						$ListaDeObjetos[$i]['pendiente'] = 'Completo';
					}
					foreach($ListaDeObjetos[$i] as $var => $val)
					{
						$e->setVariable($var,trim($val));
					}  
					if($i%2 == 0)						
					{
						$e->setVariable('class_color','fondo_oscuro');
					}
				}	
			}		
		break;
	}
	echo $e->toHtml();
?>