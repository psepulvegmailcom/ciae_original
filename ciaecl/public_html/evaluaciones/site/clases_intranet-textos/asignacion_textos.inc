<?php
 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	
	$theSession 	= $ControlHtml->theSession;
	$lastAction 	= $ControlHtml->lastActionArray;  
	$valores 		= VarSystem::getPost();  
	
	$path_admin		= VarSystem::getPathVariables('dir_template').'intranet_textos/asignacion/'; 
	$e = new miniTemplate($path_admin.'form.tpl');
	$e->setVariable('opcion_modulo',$lastAction[0]);

	if($lastAction[1] == 'guardar')
	{
		/** SE CREA LA CORRECCION NUEVA*/
 		$Correccion = new Correccion();
 		$Correccion->estado = 'pendiente';
 		$Correccion->descripcion = $valores['descripcion'];
 		$Correccion->tipo_correccion = $valores['tipo_usuario'];
 		$Correccion->guardarObjeto();
 		$id_correccion = $Correccion->id; 
 		
		/** BUSCO LISTADO DE USUARIOS */
		$ControladorPermisos = new ControladorPermisos();
		$permiso = $ControladorPermisos->getPermisoByAlias($valores['tipo_usuario']); 
		
		$ControladorDeUsuarios  = new ControladorDeUsuarios();
		$usuarios = $ControladorDeUsuarios->getArrayUsuariosActivosByPermiso($permiso);
		//Funciones::mostrarArreglo($usuarios,true);
		$total_usuarios = count($usuarios); 
		
 		/** SE ASIGNA UNA CORRECCION PARA CADA TIPO DE TEXTO*/
 		$ControlTipoTextos = new ControlTipoTextos();
 		$tipos = $ControlTipoTextos->buscarCaso($valores['tipo_usuario'].$valores['sufijo']);
 		//Funciones::mostrarArreglo($tipos,true);
 		$total = count($tipos);
 		for($i=0; $i < $total; $i++)
 		{ 			  
 			/** POR CADA TIPO DE TEXTO, BUSCO CANTIDAD Y DIVIDO EN CANTIDAD DE USUARIOS*/
 			$ControlTextosCorreccion = new ControlTextosCorreccion();
 			$listado_textos = $ControlTextosCorreccion->obtenerListadoTipo($tipos[$i]['id_tipo_texto']); //,'random'
 			//Funciones::mostrarArreglo($listado_textos,true);
 			$total_texto = count($listado_textos); 			
 			
			/** CALCULO DE CANTIDADES DIARIAS */
			$cantidades_diarios = array();
 			if($total_texto < $valores['asignacion_diaria']) //en caso que sean menos de asignacion diaria
 			{
 				$valores['asignacion_diaria'] = $total_texto; 
			}
			$cantidades_diarios['total_textos'] = $total_texto;
			$cantidades_diarios['porcentaje_doble_diario'] 	  = round($valores['asignacion_diaria']*($valores['doble_corregido']/100));
			$cantidades_diarios['diario_maximo'] 	= $valores['asignacion_diaria'];
			$cantidades_diarios['diario_simple'] 	= $cantidades_diarios['diario_maximo']-$cantidades_diarios['porcentaje_doble_diario'];
		 	$cantidades_diarios['diario_doble']   	= $cantidades_diarios['porcentaje_doble_diario'];
		 	
		 	$cantidades_diarios['dias_trabajo']		= round($cantidades_diarios['total_textos']*(($valores['doble_corregido']/100) + 1)/$total_usuarios/$valores['asignacion_diaria']);
		 	$cantidades_diarios['limite_sesion_diario']    = $cantidades_diarios['diario_maximo']; 
 			// Funciones::mostrarArreglo($cantidades_diarios,true);
 			/** ASIGNO LOS TEXTOS POR LOS USUARIOS ENCONTRADOS */
 			$id_correccion_dia = 0;  
			$j=0;
 			while($j < $total_texto)
 			{    
				$id_correccion_dia++; 
				$CorreccionDia 					 	= new CorreccionDia();					
 				$CorreccionDia->id_correccion_dia 	= $id_correccion_dia;
 				$CorreccionDia->id_correccion  	 	= $id_correccion;
 				$CorreccionDia->id_tipo_texto 	 	= $tipos[$i]['id_tipo_texto'];
 				$CorreccionDia->estado 			 	= 'pendiente';
				$CorreccionDia->orden_tipo_texto	= $tipos[$i]['orden'];
				$CorreccionDia->guardarObjeto(); 
				 
				// echo $id_correccion_dia.' '.$cantidades_diarios['dias_trabajo'].'<br>';
				if($id_correccion_dia == $cantidades_diarios['dias_trabajo'] ) 
				{
					$cantidades_diarios['diferencia']	= $total_texto - $j;
					$cantidades_diarios['limite_sesion_diario'] = ceil(($cantidades_diarios['diferencia'])/$total_usuarios)+ceil($cantidades_diarios['diario_doble']/2); 
					$cantidades_diarios['diario_doble'] = round($cantidades_diarios['diario_doble'] * 1.5);
				} 
				
				if($cantidades_diarios['dias_trabajo'] == 0 && $id_correccion_dia == 1)  
				{
					/** CASO CON ELEMENTOS MENORES */
					$cantidades_diarios['diferencia']	= $total_texto - $j;
					$cantidades_diarios['limite_sesion_diario'] = ceil(($cantidades_diarios['diferencia'])/$total_usuarios)+ceil($cantidades_diarios['diario_doble']/2); 
					$cantidades_diarios['diario_doble'] = round($cantidades_diarios['diario_doble'] * 1.3);
				 	//echo $total_texto.' '.$j.' ';  	Funciones::mostrarArreglo($cantidades_diarios,true);
				}
				 
				$id_usuario_k 		= 0;
				while($id_usuario_k < $total_usuarios)
				{
					$aux_diario_maximo 	= 0;
					
					while($aux_diario_maximo < $cantidades_diarios['limite_sesion_diario'])
					{
						$CorreccionUsuario = new CorreccionUsuario();
						$CorreccionUsuario->id_correccion_dia	= $id_correccion_dia;
						$CorreccionUsuario->id_correccion		= $id_correccion;
						$CorreccionUsuario->id_tipo_texto		= $tipos[$i]['id_tipo_texto'];
						$CorreccionUsuario->id_texto			= $listado_textos[$j]['id_texto'];
						$CorreccionUsuario->orden_tipo_texto	= $tipos[$i]['orden'];
						$CorreccionUsuario->username			= $usuarios[$id_usuario_k]['username'];
						$CorreccionUsuario->tipo_correccion		= $valores['tipo_usuario'];
						$CorreccionUsuario->guardarObjeto(); 
						if($aux_diario_maximo <= $cantidades_diarios['diario_doble'])
						{
							$aux_usuario = array_rand($usuarios,1 ); 
							$CorreccionUsuario->newObject	= true;
							$CorreccionUsuario->username	= $usuarios[$aux_usuario]['username'];
							$CorreccionUsuario->guardarObjeto();
							$aux_diario_maximo++;
						}
						$aux_diario_maximo++;
						$j++;
						if($j == $total_texto)
						{
							break;
						} 	
					}
					$id_usuario_k++; 
					if($j == $total_texto)
					{
						break;
					}
				} 
			} 			
		}
		/** CAMBIO DE ORDEN DE DíAS PARA QUE EL RESTANTE QUEDE PARA EL PRIMER DIA Y EL RESTO PARA EL ULTIMO **/
		
		$ControlCorreccionDia 					 	= new ControlCorreccionDia();
		$dia_maximo = $ControlCorreccionDia->obtenerMaximoDia($id_correccion);
		$dia_maximo = $dia_maximo[0]['id_correccion_dia'];
		$ControlCorreccionUsuario = new ControlCorreccionUsuario();
		$ControlCorreccionUsuario->cambioAsignacionFinalPrincipio($id_correccion,$dia_maximo);
		
		  
		/** FALTA RECORRER PARA LIMPIAR LOS NUMEROS DISTINTOS */  
	} 	 
	
	
	
	
	
	echo $e->toHtml();
	 
?>	