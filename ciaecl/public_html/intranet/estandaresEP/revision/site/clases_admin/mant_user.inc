<?
	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml;
	$theSession 	= $ControlHtml->theSession;  
	$lastAction 	= $ControlHtml->lastActionArray; 
	  
	if($lastAction[0] != 'crear_cuenta')
	{
		$ControlHtml->revisionSesion(true);
		$ControlHtml->setTituloModulo('Mantenedor de Usuarios');
	}		
	else
	{
		if(trim($lastAction[1]) == '')
		{
			$lastAction[1] = 'ingresar';
		}
		$ControlHtml->setTituloModulo('Creación Cuenta Usuario');
	}
	 
	$FormGeneral 	= new FormGeneral(); 
	$id_item 		= VarSystem::getVariable("id_item");
	$path_template 	= VarSystem::getPathVariables('dir_template').'admin/usuario/';
	$opcion_modulo 	= 'mantuser';
	    
		
	$elObjeto 				= new Usuario();
	$elControladorDeObjetos = new ControladorDeUsuarios();
	$ControladorPermisos 	= new ControladorPermisos(); 
	$PersonaControl 		= new PersonaControl();  
	$Permiso 				= new Permiso();
	$Persona 				= new Persona(); 

	$oferente_inactivo 		= false;
	$oferente_activo 		= false;
	$guardar_exito 		    = true;
    

	$e = new miniTemplate($path_template.'form.tpl');
	if($lastAction[2] == 'desactivar')
	{ 
        $oferente_inactivo 		= true; 
	    $guardar_exito 		    = true;
		$elObjeto->loadObject("user_id='".$id_item."'");
        $elObjeto->activo       = '0';  
        $elObjeto->saveUsuario(); 
		$PersonaControl->setPersonaByUser($elObjeto);
    	$asunto = "Edición de Usuario";   
       	  
	}
	if($lastAction[1] == 'guardar')
	{  
		if($lastAction[2] != 'desactivar')
    	{
    		if(trim($id_item) != '')
    		{ 
    		  	$lastAction[1] = 'modificar';
    		  //	echo $lastAction[1];
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
                 
    		 
    			$elObjeto->activo			= $estado_activo;
    			$elObjeto->saveObject("user_id='".$id_item."'");
    			 
    			if(VarSystem::getVariable("new_password") != '')
    			{
    			     $elObjeto->updatePassword(VarSystem::getVariable("new_password"));
    			}	
    				
    			$PersonaControl->obj->nombre 			= Funciones::textToTitle(VarSystem::getVariable("nombre"));
    			$PersonaControl->obj->apellido_paterno 	= Funciones::textToTitle(VarSystem::getVariable("apellido_paterno"));
    			$PersonaControl->obj->apellido_materno 	= Funciones::textToTitle(VarSystem::getVariable("apellido_materno"));
	            $PersonaControl->obj->institucion = VarSystem::getVariable("guardar_valor_institucion");
	            $PersonaControl->obj->sexo = VarSystem::getVariable("guardar_valor_sexo");
	            $PersonaControl->obj->cargo = VarSystem::getVariable("guardar_valor_cargo");
	            $PersonaControl->obj->profesion = VarSystem::getVariable("guardar_valor_profesion"); 
	            $PersonaControl->obj->cargo_agno = VarSystem::getVariable("guardar_valor_cargo_agno");  
	            $PersonaControl->obj->nivel_conocimiento = VarSystem::getVariable("guardar_valor_nivel_conocimiento");
	            $PersonaControl->obj->cargo_mes = 0; 
				$PersonaControl->obj->servicio_mes = 0; 
				$PersonaControl->obj->servicio_agno = 0; 
    			
    			$PersonaControl->savePersona();
    			
    			//Funciones::mostrarArreglo($PersonaControl); 
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
    		  	//echo $lastAction[1];
    			/* caso ingreso nuevo usuario*/
    			$datos['username']			= VarSystem::getVariable('new_username');
    			$datos['password'] 			= VarSystem::getVariable('new_password'); 
    			$datos['permiso'] 			= VarSystem::getVariable('perms');
    			$datos['activo'] 			= VarSystem::getVariable('activo');
    			$datos['email'] 			= VarSystem::getVariable('email');
    			$datos['apellido_materno'] 	= Funciones::textToTitle(VarSystem::getVariable('apellido_materno'));
    			$datos['apellido_paterno'] 	= Funciones::textToTitle(VarSystem::getVariable('apellido_paterno'));
    			$datos['nombre'] 			= Funciones::textToTitle(VarSystem::getVariable('nombre'));
    			 
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
    				$PersonaControl->obj->id_persona = $PersonaControl->obj->id;
					//Funciones::mostrarArreglo($PersonaControl);
					
		            $PersonaControl->obj->institucion = VarSystem::getVariable("guardar_valor_institucion");
		            $PersonaControl->obj->sexo = VarSystem::getVariable("guardar_valor_sexo");
		            $PersonaControl->obj->cargo = VarSystem::getVariable("guardar_valor_cargo");
		            $PersonaControl->obj->profesion = VarSystem::getVariable("guardar_valor_profesion"); 
		            $PersonaControl->obj->cargo_agno = VarSystem::getVariable("guardar_valor_cargo_agno");  
		            $PersonaControl->obj->nivel_conocimiento = VarSystem::getVariable("guardar_valor_nivel_conocimiento");
		            $PersonaControl->obj->cargo_mes = 0; 
					$PersonaControl->obj->servicio_mes = 0; 
					$PersonaControl->obj->servicio_agno = 0; 
	    			
	    			$PersonaControl->savePersona();  
    				$asunto = "Creación de Usuario";    
    			} 
    			else
    			{ 
    				$e->setVariable('nombre',VarSystem::getVariable('nombre'));
    				$e->setVariable('apellido_paterno',VarSystem::getVariable('apellido_paterno'));
    				$e->setVariable('apellido_materno',VarSystem::getVariable('apellido_materno')); 
    			}
    		}
		}
		if($guardar_exito)
		{ 
			$ControlHtml->showMensajeGuardarDatos('exito');
			if(VarSystem::getVariable('cambios_excluyentes') == 1)
			{
				$email = new miniTemplate($path_template.'email_usuario.tpl'); 
				$email->setVariable('sitio_nombre',$siteTitle['completo']);  
				$email->setVariable('nombre',trim($PersonaControl->obj->nombre." ".$PersonaControl->obj->apellido_paterno." ".$PersonaControl->obj->apellido_materno));
				$email->setVariable('email',$PersonaControl->obj->email);
				$email->setVariable('username',$elObjeto->username);	 
				
				$email->setVariable('url',VarConfig::path_site_www);
				$estado_activo = 'Activo';
				if($elObjeto->activo == 0)
				{
					$estado_activo = 'Inactivo';
				}	
				$email->setVariable('activo',$estado_activo);	
					 
				if(trim(VarSystem::getVariable("new_password")) != '')
				{
					//$email->addTemplate('password_usuario');
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
                //echo "envio email ".$mensaje; 
				Funciones::sendEmail($PersonaControl->getEmail(),$asunto,$mensaje);	
			}
			$lastAction[1] = '';
		}  
		
		if($lastAction[0] == 'crear_cuenta')
		{
			Funciones::redirigirPagina('La nueva cuenta ha sido creada exitosamente','home');
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
			{
				$activo_aux = 'no_activo_checked'; 
			}	 
			$ControlPersona 	= new PersonaControl();
			$ControlPersona->setPersonaByUser($elObjeto);
			//Funciones::mostrarArreglo($ControlPersona);
			foreach($ControlPersona->obj as $key => $valor)
			{ 
				$e->setVariable($key,$valor);	
			} 
			$e->setVariable('mes_valor_cargo',$ControlPersona->obj->cargo_mes);
			$e->setVariable('agno_valor_cargo',$ControlPersona->obj->cargo_agno);
			$e->setVariable('mes_valor_servicio',$ControlPersona->obj->servicio_mes);
			$e->setVariable('agno_valor_servicio',$ControlPersona->obj->servicio_agno);	 
			
			if(trim($ControlPersona->obj->profesion) != '')
			{
				$e->addTemplate('profesion_seleccionada');
				$e->setVariable('profesion',$ControlPersona->obj->profesion);	
			} 	
			if(trim($ControlPersona->obj->cargo) != '')
			{
				$e->addTemplate('cargo_seleccionada');
				$e->setVariable('cargo',$ControlPersona->obj->cargo);	
			} 		 
		}  
		else
		{
			$activo_aux = 'activo_checked'; 
			$e->setVariable('new_password',Funciones::generarPassword());
		}  
		
		/** LISTADO DE PERMISO USUARIOS */
		
		$e->setVariable($activo_aux,'checked'); 
		$e->addTemplate('bloque_admin_user'); 
		$elControladorDeUsuarios = new ControladorDeUsuarios(); 
		$ListaDeObjetosItem		 = $elControladorDeUsuarios->getArrayPermisos(); 
		// Funciones::mostrarArreglo($ListaDeObjetosItem);
		if($lastAction[0] == 'crear_cuenta')
		{
			$ListaDeObjetosItem		 = $elControladorDeUsuarios->getArrayPermisos('visitante'); 
		}
		$totalLista = count($ListaDeObjetosItem);
		for($i=0; $i < $totalLista; $i++)
		{ 
			if($ListaDeObjetosItem[$i]['alias'] == 'administrador' )
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
			if($lastAction[0] == 'crear_cuenta')
			{ 
				$e->setVariable('list_item_checked','checked'); 
			}
		}
		
		if($lastAction[0] == 'crear_cuenta')
		{
			$e->addTemplate('bloque_nueva_cuenta');
		}
	}	
	else
	{  
		$buscar = VarSystem::getVariable('buscar_user');
		$e = new miniTemplate($path_template.'mant.tpl');  
		$orden = $ControlHtml->pagina_sistema_orden." ".$ControlHtml->pagina_sistema_direccion;
		 
		if(trim($orden) == '')
		{
			$orden = array('alias','username');
		}
		else
		{
			$orden = array($orden);
		}
		$e->setVariable('opcion_modulo',$opcion_modulo); 
		$orden_opcion	= array('username' => 'Nombre usuario','apellido_paterno' => 'Apellido paterno','alias' =>  'Tipo usuario','activo' =>  'Activo');
		$ListaDeObjetos = $elControladorDeObjetos->getListadoNoOferentesCompleto($orden,$buscar );  
		$e->setVariable('caso_columna_acceso','Último Acceso'); 
		$e->setVariable('caso_columna','Tipo Usuario');  
		$e->setVariable('caso_columna_orden','alias'); 
		$e->addTemplate('item_ingresar'); 
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
			    // Funciones::mostrarArreglo($ListaDeObjetos[$i]);
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
				 
				 
				 $fecha_acceso = $ControlLogs->ultimoUsuarioUso($ListaDeObjetos[$i]['username']);
                 if(trim($fecha_acceso) == '')
                 {
                    $fecha_acceso = ControladorFechas::fecha2Date($ListaDeObjetos[$i]['fecha_creacion'],0,true);
                 }  
				$e->setVariable('acceso',$fecha_acceso);  
				$e->setVariable('nombre',$ListaDeObjetos[$i]['nombre'].' '.$ListaDeObjetos[$i]['apellido_paterno']." ".$ListaDeObjetos[$i]['apellido_materno']); 
				$e->setVariable('id_item',$ListaDeObjetos[$i]['user_id']);
				if($i%2 == 0)						
				{
					$e->setVariable('class_color','fondo_oscuro');
				}
			}
		}  
	}
	 
	echo $e->toHtml();
?>
