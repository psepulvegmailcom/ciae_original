<?php

	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession;  
	$lastAction 	= $ControlHtml->lastActionArray; 
	  
	$ControlHtml->revisionSesion();		
 
	switch($lastAction[0])
	{		
		case 'mant_email_mesa':
			$ControlHtml->setTituloModulo('Mensaje Mesa de Ayuda'); 
		break;
		case 'mant_email_externo':
			$ControlHtml->setTituloModulo('Mensaje desde Mesa de Ayuda'); 
		break;
		case 'mant_email':
			$ControlHtml->setTituloModulo('Envio Email Masivo'); 
		break;
	}
	$path_template 	= VarSystem::getPathVariables('dir_template').'admin/email/';
	
	if($lastAction[1] == 'guardar')
	{ 
		$valores 				= VarSystem::getPost();	 	
		switch($lastAction[0])
		{		
			case 'mant_email_mesa':
				$ControlPersona 	= new PersonaControl();
				$ControlPersona->setPersonaByUser($ControlHtml->elUsuarioP);  
				$usuario_nombre = $ControlPersona->obj->nombre." ".$ControlPersona->obj->apellido_paterno." ".$ControlPersona->obj->apellido_materno." <".$ControlPersona->obj->email.">"; 
			 
				$mailto = VarSystem::getInfoSystem('email_contacto'); 
				$tmp = new miniTemplate($path_template.'datos.tpl');
				
				$asunto = $valores['asunto'];
				$mensaje_usuario = "Estimados  \n\n".$valores['email'];
				
				$tmp->setVariable('usuario_nombre',$ControlPersona->obj->nombre." ".$ControlPersona->obj->apellido_paterno." ".$ControlPersona->obj->apellido_materno);
				$tmp->setVariable('usuario_email',$ControlPersona->obj->email);
				$tmp->setVariable('usuario_username',$ControlHtml->elUsuarioP->username);
				
				$mensaje = $mensaje_usuario.$tmp->toHtml(); 
				 
				Funciones::sendEmail($usuario_nombre,$asunto,Funciones::TextoSimple($mensaje,true),true); 
				
				$tmp->addTemplate('bloque_tipo_usuario');
				$tmp->setVariable('usuario_tipo_usuario',$ControlHtml->permiso_usuario);
				
				if($ControlHtml->elUsuarioP->perms == 3)
				{ 
					$id_oferente 		= $ControlHtml->id_oferente;   
					$ControlOferente 	= new ControlOferente();
					$ControlOferente->setOferenteById($id_oferente);	 
					$tmp->addTemplate('bloque_tipo_oferente');
					$tmp->setVariable('usuario_tipo_oferente',$ControlOferente->obj->id_tipo); 
				} 
				
				$mensaje = $mensaje_usuario.$tmp->toHtml();  
				Funciones::sendEmail($mailto,$asunto,Funciones::TextoSimple($mensaje,true));
				$ControlHtml->showMensajeGuardarDatos('exito','El mensaje fue enviado exitosamente a la Mesa de ayuda y un copia a su correo ');
			break;
			case 'mant_email':
				$elControladorDeObjetos = new ControladorDeUsuarios();
				$tipos 		= $valores['usuarios'];
				$usuarios 	= $elControladorDeObjetos->getListadoUsuariosPersonas($tipos);	
				$total 		= count($usuarios); 
				$total_aux 	= 0;
				if(is_array($usuarios) &&  $total > 0)
				{
					for($i=0; $i < $total; $i++)
					{
						if($usuarios[$i]['activo'] == 0)
							continue;
						$total_aux++;
						$usuario_nombre = $usuarios[$i]['nombre']." ".$usuarios[$i]['apellido_paterno']." ".$usuarios[$i]['apellido_materno']." <".$usuarios[$i]['email'].">";
						$asunto 	= $valores['asunto'];
						/*$mensaje 	= Funciones::TextoSimple("Estimado(a) ".trim($usuarios[$i]['nombre'])." ".trim($usuarios[$i]['apellido_paterno'])." ".trim($usuarios[$i]['apellido_materno'])."\n\n".$valores['email'],true);*/
						
						$mensaje 	= Funciones::TextoSimple("Estimado(a) usuario\n\n".$valores['email'],true);
						Funciones::sendEmail($usuario_nombre,$asunto,$mensaje);
					}
					$ControlHtml->showMensajeGuardarDatos('exito','El mensaje fue enviado exitosamente a '.$total_aux.' usuarios');
				}
			break;
			case 'mant_email_externo':  
				
				Funciones::sendEmail($valores['to'],$valores['asunto'],Funciones::TextoSimple($valores['email'],true),true);
				$ControlHtml->showMensajeGuardarDatos('exito','El mensaje fue enviado exitosamente a '.$valores['to'].' ');
			break;
		}
	} 
	
	$e = new miniTemplate($path_template.'form.tpl');
	 
	 
	if($lastAction[0] != 'mant_email_mesa')
	{
		if($lastAction[0] == 'mant_email')
		{
			$e->setVariable('explicacion_mensaje','No agregue el encabezado ni firma, el sistema lo hará automáticamente. Recuerde que el mensaje es personalizado, por lo que debe ser escrito de la misma forma o especificar que es un mensaje masivo');
			$e->setVariable('asunto_mensaje','Mensaje para los usuarios del Registro ATE');		
			$e->addTemplate('bloque_masivo_usuarios');
			$elControladorDeUsuarios = new ControladorDeUsuarios();
			$ListaDeObjetosItem		 = $elControladorDeUsuarios->getArrayPermisos(); 
				 
			$totalLista = count($ListaDeObjetosItem);
			for($i=0; $i < $totalLista; $i++)
			{ 
				if($ListaDeObjetosItem[$i]['alias'] == 'administrador')
				{
					continue;
				}
				$e->addTemplate('lista_permiso_item');  
				$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['id_permiso']);
				$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['descripcion']);  
			}
		}
		else
		{
			$e->setVariable('explicacion_mensaje','Este mensaje no reconocerá ni el usuario y tampoco irá personalizados');
			$e->setVariable('asunto_mensaje','Información Registro ATE');
			$e->addTemplate('bloque_masivo_usuarios_to');
		}
	}
	else
	{ 
		$e->setVariable('asunto_mensaje','Mensaje Mesa de Ayuda'); 
		$e->setVariable('explicacion_mensaje','No agregue el detalle de su usuario el sistema lo hará automáticamente.'); 
	} 
	echo $e->toHtml();
?>