<?php


	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession;  
	$lastAction 	= $ControlHtml->lastActionArray; 
	  
	$ControlHtml->revisionSesion();			
	 
	$FormGeneral 	= new FormGeneral(); 
	$id_item 		= VarSystem::getVariable("id_item");
	$path_template 	= VarSystem::getPathVariables('dir_template').'admin/usuario/';
	$opcion_modulo 	= $lastAction[0];
	  
	$ControlHtml->setTituloModulo('Mantenedor de Usuarios');  
		
	$elObjeto 				= new Usuario();
	$elControladorDeObjetos = new ControladorDeUsuarios();
	$ControladorPermisos 	= new ControladorPermisos(); 
	$PersonaControl 		= new PersonaControl();  
	$Permiso 				= new Permiso();
	$Persona 				= new Persona(); 

	$oferente_inactivo 		= false;
	$oferente_activo 		= false;


	$e = new miniTemplate($path_template.'form.tpl');
	if($lastAction[1] == 'guardar')
	{ 
		$guardar_exito 		= true;
		if(trim($id_item) != '')
		{ 
			$lastAction[1] = 'modificar';
			$elObjeto->loadObject("user_id='".$id_item."'"); 			
			$PersonaControl->setPersonaByUser($elObjeto);
			
			$elObjeto->perms = $ControladorPermisos->getPermisoByAlias(VarSystem::getVariable("perms"));
			if(VarSystem::getVariable("username") != $elObjecto->username)	
			{
				$elObjectoAux = new Usuario();
				$elObjectoAux->getUsuarioByUsername(VarSystem::getVariable("username"));
				if(trim($elObjectoAux->username) != '')
				{				  
					$ControlHtml->showMensajeGuardarDatos('error','El nombre de usuario esta siendo utilizado por otro usuario, no se pudo modificar');
					$guardar_exito = false;
				}	
				else
				{
					$elObjecto->username 	= VarSystem::getVariable("username"); 
				}
			}	
		 
			$estado_activo 				= VarSystem::getVariable('activo'); 

			if($elObjeto->activo != $estado_activo)
			{	
				$ControlOferente->setOferenteByPersona($PersonaControl->obj);
				if(isset($ControlOferente->obj->id_oferente) && $ControlOferente->obj->id_oferente > 0)
				{   
					if($estado_activo == 0)
					{
						$ControlOferente->obj->cambiarEstado($ControlOferente->obj->id_oferente, 'eliminado','Oferente y usuario inactivo');	
						$oferente_inactivo = true;
					}
					else
					{
						/*$ControlOferenteEstados = new ControlOferenteEstados();
						$estados 				= $ControlOferenteEstados->obtenerEstados($ControlOferente->obj->id_oferente,'','eliminado');
						$aux 					= array_pop($estados); 
						$aux 					= array_pop($estados);   */
						$ControlOferente->obj->cambiarEstado($ControlOferente->obj->id_oferente, 'iniciado','Usuario y oferente activo');						
						$oferente_activo = true;
					}
				}
			}
			$elObjeto->activo			= $estado_activo;
			$elObjeto->saveObject("user_id='".$id_item."'");
			 
			if(VarSystem::getVariable("new_password") != '')
				$elObjeto->updatePassword(VarSystem::getVariable("new_password"));
				
			$PersonaControl->obj->nombre 			= VarSystem::getVariable("nombre");
			$PersonaControl->obj->apellido_paterno 	= VarSystem::getVariable("apellido_paterno");
			$PersonaControl->obj->apellido_materno 	= VarSystem::getVariable("apellido_materno");
			$PersonaControl->savePersona();
			
			if(VarSystem::getVariable("email") != $PersonaControl->obj->email)
			{  
				if($elObjeto->existeUsuarioByEmail(VarSystem::getVariable("email")))
				{				 
					$ControlHtml->showMensajeGuardarDatos('error','El email esta siendo utilizado por otro usuario, no se pudo modificar');
					$guardar_exito = false;		
				}	
				else
				{
					$PersonaControl->obj->email 	= VarSystem::getVariable("email");
					$PersonaControl->savePersona();  	
				}
			} 		 
			$Permiso->loadObject('id_permiso='.$datos['permiso']);

			$asunto = "Edición de Usuario";  
		}
		else
		{ 
			$lastAction[1] = 'ingresar';
			/* caso ingreso nuevo usuario*/
			$datos['username']			= VarSystem::getVariable('new_username');
			$datos['password'] 			= VarSystem::getVariable('new_password'); 
			$datos['permiso'] 			= VarSystem::getVariable('perms');
			$datos['activo'] 			= VarSystem::getVariable('activo');
			$datos['email'] 			= VarSystem::getVariable('email');
			$datos['apellido_materno'] 	= VarSystem::getVariable('apellido_materno');
			$datos['apellido_paterno'] 	= VarSystem::getVariable('apellido_paterno');
			$datos['nombre'] 			= VarSystem::getVariable('nombre');
			 
			$elObjectoAux = new Usuario();
			$elObjectoAux->getUsuarioByUsername(VarSystem::getVariable("username"));
			
			if(trim($elObjectoAux->username) != '')
			{				  
				$ControlHtml->showMensajeGuardarDatos('error','El nombre de usuario esta siendo utilizado por otro usuario, no se pudo crear el usuario'); 
				$guardar_exito = false;
			}
			if($elObjectoAux->existeUsuarioByEmail(VarSystem::getVariable("email")))
			{				  
				$ControlHtml->showMensajeGuardarDatos('error','El email esta siendo utilizado por otro usuario, no se pudo crear el usuario');
				$guardar_exito = false;		
			}
			if($guardar_exito)
			{ 
				$elObjeto->addNewUsuario($datos); 
				$datos['user_id'] 			= $elObjeto->user_id;
				$PersonaControl->addNewPersona($datos); 
				
				$asunto = "Creación de Usuario";    
			} 
			else
			{ 
				$e->setVariable('nombre',VarSystem::getVariable('nombre'));
				$e->setVariable('apellido_paterno',VarSystem::getVariable('apellido_paterno'));
				$e->setVariable('apellido_materno',VarSystem::getVariable('apellido_materno')); 
			}
		}
		if($guardar_exito)
		{ 
			$ControlHtml->showMensajeGuardarDatos('exito');
			if(VarSystem::getVariable('cambios_excluyentes') == 1)
			{
				$email = new miniTemplate($path_template.'email_usuario.tpl');
				if(!$oferente_inactivo && !$oferente_activo)
					$email = new miniTemplate($path_template.'email_usuario.tpl');
				else
				{
					if($oferente_inactivo)
						$email = new miniTemplate($path_template.'email_usuario_oferente_inactivo.tpl');
					else
						$email = new miniTemplate($path_template.'email_usuario.tpl');
				}
				$email->setVariable('sitio_nombre',$siteTitle['completo']);  
				$email->setVariable('nombre',trim($PersonaControl->obj->nombre." ".$PersonaControl->obj->apellido_paterno." ".$PersonaControl->obj->apellido_materno));
				$email->setVariable('email',$PersonaControl->obj->email);
				$email->setVariable('username',$elObjeto->username);	 
				
				$estado_activo = 'Activo';
				if($elObjeto->activo == 0)
					$estado_activo = 'Inactivo';
				$email->setVariable('activo',$estado_activo);	
							
				if(trim(VarSystem::getVariable("new_password")) != '')
				{
					$email->addTemplate('password_usuario');
					$email->setVariable('password',VarSystem::getVariable("new_password"));
				}
				  
				if($lastAction[1] == 'ingresar')
				{  
					$email->addTemplate('nuevo_usuario'); 
				}
				else
				{ 
					$email->addTemplate('edicion_usuario'); 
				}
				$mensaje = $email->toHtml();  
				Funciones::sendEmail($PersonaControl->getEmail(),$asunto,$mensaje);	
			}
			$lastAction[1] = '';
		}   
	}  
	
	if($lastAction[1] == 'modificar' || $lastAction[1] == 'ingresar')
	{
		$e->setVariable('opcion_modulo',$opcion_modulo);
		$e->setVariable('tag_volver',$FormGeneral->showVolver($opcion_modulo));
		
		if($lastAction[1] == 'modificar')
		{		
			$e->setVariable('caso_form','Edición');
			 	
			$elObjeto->loadObject("user_id='".$id_item."'");
			$Permiso->loadObject('id_permiso='.$elObjeto->perms);
			$Persona->loadObject("user_id='".$elObjeto->user_id."'"); 
		

			$e->setVariable('nombre',strip_tags($Persona->nombre));
			$e->setVariable('apellido_paterno',strip_tags($Persona->apellido_paterno));
			$e->setVariable('apellido_materno',strip_tags($Persona->apellido_materno));
			$e->setVariable('email',$Persona->email);
			$e->setVariable('username',strip_tags($elObjeto->username)); 
			$e->setVariable('id_item',$elObjeto->user_id); 
			
			$activo_aux = 'activo_checked';
			if($elObjeto->activo == 0)
				$activo_aux = 'no_activo_checked';
			$e->setVariable($activo_aux,'checked');  

			$ControlOferente->setOferenteByPersona($Persona); 
			if(isset($ControlOferente->obj->fecha_creacion))
			{					
				$e->addTemplate('fecha_creacion');
				$e->setVariable('fecha_creacion', ControladorFechas::fecha2Date($ControlOferente->obj->fecha_creacion,0,true));
			}
		}  
		else
		{
			$e->setVariable('activo_checked','checked'); 
			$e->setVariable('new_password',Funciones::generarPassword());
		} 
		
		/** listado de permiso usuarios */
		$elControladorDeUsuarios = new ControladorDeUsuarios();
	 
			$ListaDeObjetosItem		 = $elControladorDeUsuarios->getArrayPermisos();
		 
		 
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			if($ListaDeObjetosItem[$i]['alias'] == 'oferentes' && $opcion_modulo == 'mantuser')
			{
				continue;
			}
			$e->addTemplate('lista_permiso_item');  
			$e->setVariable('list_item_valor',$ListaDeObjetosItem[$i]['alias']);
			$e->setVariable('list_item_texto',$ListaDeObjetosItem[$i]['descripcion']); 
			if($elObjeto->perms == $ListaDeObjetosItem[$i]['id_permiso'])
			{	
				$e->setVariable('list_item_checked','checked'); 		
			}  
			if($ListaDeObjetosItem[$i]['alias'] == 'usuario' && trim($elObjeto->perms) == '')
			{ 
				$e->setVariable('list_item_checked','checked'); 
			}
		}
	}	
	else
	{  
		 $e = new miniTemplate($path_template.'mant.tpl'); 
		 
		 
		$e->setVariable('opcion_modulo',$opcion_modulo);
		  
		$ListaDeObjetos = $elControladorDeObjetos->getListadoCompleto();  
		Funciones::mostrarArreglo($ListaDeObjetos);
		$e->refreshTemplate(); 
		 
		if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
		{
			$e->addTemplate('item_lista_nohay'); 
		}
		else
		{
			$ControlLogs 	= new ControlLogs();
			$total 			= count($ListaDeObjetos); 
			
			$e->setVariable('paginamiento_orden',$FormGeneral->showPaginamientoOrden($orden_opcion));
			$e->setVariable('paginamiento',$FormGeneral->showPaginamiento($total));
			$valores_paginamiento 		= $FormGeneral->getValoresPaginamiento( $total);
			
			for($i = $valores_paginamiento['inicio']; $i < $valores_paginamiento['fin']; $i++)
			{  
				$e->addTemplate('lista_item'); 		
				$fila = $i + 1;
				$e->setVariable('fila',$fila);  
				$e->setVariable('username',$ListaDeObjetos[$i]['username']);
				if($opcion_modulo == 'mantuser')
				{
					$e->setVariable('tipo',$ListaDeObjetos[$i]['descripcion']); 
				}
				else
				{ 
					$e->setVariable('tipo',$ListaDeObjetos[$i]['estado']); 
				}
				if($ListaDeObjetos[$i]['activo'] == 1)
					$e->setVariable('activo','lista');
				if($opcion_modulo == 'mantuser')
				{
					$e->setVariable('acceso',$ControlLogs->ultimoUsuarioUso($ListaDeObjetos[$i]['username'])); 			
				} 

				$e->setVariable('nombre',$ListaDeObjetos[$i]['apellido_paterno']." ".$ListaDeObjetos[$i]['apellido_materno'].", ".$ListaDeObjetos[$i]['nombre']); 
				$e->setVariable('id_item',$ListaDeObjetos[$i]['user_id']);
				if($i%2 == 0)						
					$e->setVariable('class_color','fondo_oscuro');
			}
		}  
	}
	 
	echo $e->toHtml();
?>
