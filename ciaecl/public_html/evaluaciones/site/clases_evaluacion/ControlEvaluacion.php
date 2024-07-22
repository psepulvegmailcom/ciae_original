<?php

/**
 * ControlGeneralEvaluaciones
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class ControlGeneralEvaluaciones 
{
  /**
   * ControlGeneralEvaluaciones::ControlGeneralEvaluaciones()
   *
   * @param mixed $usuario
   * @return void
   */
	function ControlGeneralEvaluaciones($usuario,$lastAction)
	{  		
		$this->lastAction 	= $lastAction;
		$this->setSeminarioUsuarioBase();
		$this->iniciarControl($usuario);
	}
	
	function setSeminarioUsuarioBase()
	{  
		if(isset($_SESSION['seminario']) && trim($_SESSION['seminario']) != '')
		{
			$this->seminario = $_SESSION['seminario'];
		}
		else
		{			
			$valores = VarSystem::getPost(); 
			if(trim($valores['seminario']) != '')
			{
				$this->seminario = $valores['seminario'];
			}
		}
	}

	function setSeminarioUsuario($e )
	{ 
		$this->setSeminarioUsuarioBase();
		if(trim($this->seminario) == '' )
		{
			/* SOLO EN EL CASO DEL SISTEMA DE EVALUACION */
			$ControlUsuarioSeminario = new ControlUsuarioSeminario();
			$output = $ControlUsuarioSeminario->obtenerSeminarioActivo($this->datos['usuario']['user_id']);
			Funciones::mostrarArreglo(array('SEMINARIO',$output));
			if(is_array($output) && count($output) > 0)
			{
				/* SI TIENE UNA EVALUACION ES DIRECTA SINO DEFINIR CUAL QUIERE REVISAR */
				if(count($output) == 1)
				{
					$this->seminario = $output[0]['seminario'];
					$_SESSION['seminario'] = $this->seminario;
				}
				else
				{		 
					$ControlEvaluacionEvaluacion = new ControlEvaluacionEvaluacion();
					$activos = $ControlEvaluacionEvaluacion->obtenerEvaluacionesActivas(); 
					Funciones::mostrarArreglo($activos);  
					$MantenedoresGeneral 		= new MantenedoresGeneral();
					$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$activos,'bloque_bloque_eleccion_seminario');  
					$e->addTemplate('bloque_bloque_eleccion_seminario_abrir'); 
				}
			}
			else
			{
				/* NO TIENE DEFINIDO NINGUNA EVALUACION => PARA AFUERA */

				$MantenedoresGeneral 		= new MantenedoresGeneral(); 
				$e->addTemplate('bloque_bloque_eleccion_seminario_nohay_abrir'); 				
			}
		}
		return $e; 
	}	
	
  /**
   * ControlGeneralEvaluaciones::iniciarControl()
   *
   * @param mixed $usuario
   * @return void
   */
	function iniciarControl($usuario)
	{		 
		$this->datos['evaluacion']['seminario'] = $this->seminario; 
		$this->datos['usuario']['seminario'] 	= $this->seminario; 
		$this->datos['usuario']['username']		= $usuario->username;
		$this->datos['usuario']['user_id'] 		= $usuario->user_id;
		$this->datos['usuario']['permiso'] 		= $usuario->permiso;
		
		$EvaluacionEvaluacion = new EvaluacionEvaluacion();
		$EvaluacionEvaluacion->buscarEvaluacionActivo($this->datos['usuario']['seminario']); 
		 
		$this->datos['evaluacion'] 						= $EvaluacionEvaluacion->obtenerValoresArreglo(); 
		$this->datos['evaluacion']['fecha_actual']		= ControladorFechas::fechaActual();     
		
		$this->obtenerEtapasEvaluacion();		
		$this->revisarAsignacionRevisores(); 
				
		$this->datos['evaluacion']['fecha_inicio'] 		= $this->datos['etapas']['activo']['fecha_inicio']; 
		$this->datos['evaluacion']['fecha_cierre'] 		= $this->datos['etapas']['activo']['fecha_cierre']; 
		$this->datos['evaluacion']['fecha_inicio_html'] = ControladorFechas::invertirFecha($this->datos['evaluacion']['fecha_inicio']);
		$this->datos['evaluacion']['fecha_cierre_html'] = ControladorFechas::invertirFecha($this->datos['evaluacion']['fecha_cierre']);  
	}   
	
  /**
   * ControlGeneralEvaluaciones::revisionEstadoEtapas()
   *
   * SE REVISA EL ESTADO DE LAS ETAPAS PARA EVITAR PROBLEMAS DE COMPLETITUD, Y SE VUELVE A RECARGAR LAS ETAPAS
   *
   * @return void
   */
	function revisionEstadoEtapas()
	{
		if($this->datos['etapas']['activo']['estado'] == 'activo')
		{
			
			/******************* CONSULTA ESTADO ETAPA  ANTERIOR *********************/
			$EvaluacionEstadoEtapaCompletoAnterior = new EvaluacionEstadoEtapaCompleto();
			$id_etapa_anterior = $this->datos['etapas']['activo']['id_etapa'] - 1;
			$EvaluacionEstadoEtapaCompletoAnterior->buscarEstado($this->datos['etapas']['activo']['id_evaluacion'],$id_etapa_anterior,$this->datos['usuario']['user_id']);
			/******************* CONSULTA ESTADO ETAPA ACTUAL *********************/
			$EvaluacionEstadoEtapaCompleto = new EvaluacionEstadoEtapaCompleto();
			$EvaluacionEstadoEtapaCompleto->buscarEstado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
			
			/*********** REVISION DE REVISIONES COMPLETADAS ************/
			$estados_completitud['revision_completo'] = true;
			$EvaluacionEnvioAsignacion = new EvaluacionEnvioAsignacion();
			$EvaluacionEnvioAsignacion->buscarElementePendiente($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
			if(isset($EvaluacionEnvioAsignacion->estado) && trim($EvaluacionEnvioAsignacion->estado) != '')
			{
				$estados_completitud['revision_completo'] = false;
			}  
			 
			Funciones::mostrarArregloTitulo($EvaluacionEnvioAsignacion,'Evaluacion Envio Asignacion'); 
			
			/*************** REVISION QUE SE HAYAN ENVIADO LOS ARCHIVOS SOLICITADOS *********************************/		
			$estados_completitud['envio_completo'] = false;
			$ControlEvaluacionEnvioActividad = new ControlEvaluacionEnvioActividad();
			$envios = $ControlEvaluacionEnvioActividad->buscarEnvios($this->datos['usuario']['user_id'],$this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa']);
			if(is_array($envios) && count($envios) >= $this->datos['evaluacion']['envios_permitidos'])
			{
				$estados_completitud['envio_completo'] = true;
			}		
			
			/*************************REVISION DE EVALUACION FINAL *****************************/
			$estados_completitud['revision_final_completo'] = false;		
			$EvaluacionEnvioFinal = new EvaluacionEnvioFinal();
			$EvaluacionEnvioFinal->buscarObjeto($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['usuario']['user_id']);
			if(isset($EvaluacionEnvioFinal->estado) && $EvaluacionEnvioFinal->estado == 'cerrado')
			{
				$estados_completitud['revision_final_completo'] = true;
			}
			
			if($this->datos['etapas']['activo']['etapa_ultima'] == 'si' )
			{ 
				if($estados_completitud['revision_final_completo'] && $estados_completitud['revision_completo'])
				{ 
					if($EvaluacionEstadoEtapaCompletoAnterior->completo == 'si') 
					{
						$EvaluacionEstadoEtapaCompleto->completarEstado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
					}
				}
				else
				{ 
					$EvaluacionEstadoEtapaCompleto->crearEstado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);					
				} 	
			}
			else
			{
				if($this->datos['etapas']['activo']['etapa'] == 'envio')
				{
					if($this->datos['etapas']['activo']['estado_particular_envio'] == 'envio')
					{					
						if($estados_completitud['envio_completo'])
						{
							if($EvaluacionEstadoEtapaCompletoAnterior->completo == 'si') 
							{
								$EvaluacionEstadoEtapaCompleto->completarEstado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
							}
						}
					}
	
					if($this->datos['etapas']['activo']['estado_particular_envio'] == 'envio_revision')
					{					
						if($estados_completitud['envio_completo'] && $estados_completitud['revision_completo'])
						{
							if($EvaluacionEstadoEtapaCompletoAnterior->completo == 'si') 
							{
								$EvaluacionEstadoEtapaCompleto->completarEstado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
							}
						}
					}				
				}
				if($this->datos['etapas']['activo']['etapa'] == 'revision')
				{
					if($estados_completitud['revision_completo'])
					{
						if($EvaluacionEstadoEtapaCompletoAnterior->completo == 'si') 
						{
							$EvaluacionEstadoEtapaCompleto->completarEstado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
						}
					} 
				}
			} 
			
			if($EvaluacionEstadoEtapaCompletoAnterior->completo == 'no' && $EvaluacionEstadoEtapaCompletoAnterior->completo == 'si') 
			{
				$EvaluacionEstadoEtapaCompleto->crearEstado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
			} 
			$this->obtenerEtapasEvaluacion();
		}	
	}
	
  /**
   * ControlGeneralEvaluaciones::baseValoresTemplate()
   *
   * @param mixed $e
   * @return
   */
	function baseValoresTemplate($e,$mostrarSeminario=true)
	{  
		if($mostrarSeminario)
		{
			$e = $this->setSeminarioUsuario($e);
		} 
		
		$e->setVariable('opcion_modulo',$this->lastAction[0]);
		$e->setVariable('seminario',$this->datos['evaluacion']['seminario']);
		$e->setVariable('nombre_etapa',$this->datos['etapas']['activo']['nombre_etapa']);
		$e->setVariable('orden',$this->datos['etapas']['activo']['orden']);
		$e->setVariable('descripcion',$this->datos['evaluacion']['descripcion']);		
		//$e->setVariable('indicaciones_'.$this->datos['etapas']['activo']['etapa'],$this->datos['etapas']['activo']['indicaciones']);
		$e->setVariable('indicaciones',$this->datos['etapas']['activo']['indicaciones']);
		$e->setVariable('id_etapa',$this->datos['etapas']['activo']['id_etapa']);
		$e->setVariable('id_evaluacion',$this->datos['etapas']['activo']['id_evaluacion']);
		
		$valores 		   = VarSystem::getPost();
		$e->setVariable('username_revisado',$valores['username_revisado']); 
		
		return $e;
	}	
	
  /**
   * ControlGeneralEvaluaciones::obtenerEtapasEvaluacion()
   *
   * @return void
   */
	function obtenerEtapasEvaluacion()
	{ 
		$ControlEvaluacionEvaluacionEtapa = new ControlEvaluacionEvaluacionEtapa();
		$etapas = $ControlEvaluacionEvaluacionEtapa->buscarEtapas($this->datos['evaluacion']['id_evaluacion']); 
		 
		$total = count($etapas);
		$salida = array();
		for($i=0; $i < $total; $i++)
		{
			$etapas[$i]['fecha_inicio_html'] = ControladorFechas::invertirFecha($etapas[$i]['fecha_inicio']);
			$etapas[$i]['fecha_cierre_html'] = ControladorFechas::invertirFecha($etapas[$i]['fecha_cierre']);
			
			/* REVISION DE ESTADOS*/
			$estado_requerido = ''; 
			if($etapas[$i]['fecha_inicio'] > $this->datos['evaluacion']['fecha_actual'])
			{
				if($etapas[$i]['estado'] != 'pendiente')
				{
					$estado_requerido = 'pendiente';
				}
			}
			if($etapas[$i]['fecha_inicio'] <= $this->datos['evaluacion']['fecha_actual'] && $etapas[$i]['fecha_cierre'] >= $this->datos['evaluacion']['fecha_actual'])
			{
				if($etapas[$i]['estado'] != 'activo')
				{
					$estado_requerido = 'activo';
				}
			}
			
			if($etapas[$i]['fecha_cierre'] < $this->datos['evaluacion']['fecha_actual'])
			{
				if($etapas[$i]['estado'] != 'cerrado')
				{
					$estado_requerido = 'cerrado';
				}
			}
			
			if(trim($estado_requerido) != '')
			{				
				$EvaluacionEvaluacionEtapa 	= new EvaluacionEvaluacionEtapa();
				$EvaluacionEvaluacionEtapa->buscarEtapa($etapas[$i]['id_etapa'],$etapas[$i]['id_evaluacion']);
				$EvaluacionEvaluacionEtapa->estado	= $estado_requerido;
				$etapas[$i]['estado'] 				= $estado_requerido;
				$EvaluacionEvaluacionEtapa->guardarEtapa($etapas[$i]['id_etapa'],$etapas[$i]['id_evaluacion']);
			} 
			$salida['listado'][] = $etapas[$i];			
			if($etapas[$i]['estado'] == 'activo')
			{
				$etapas[$i]['i'] = $i;
				$etapas[$i]['maximo_nota_revision_html'] = $etapas[$i]['maximo_nota_revision'] + 1;
				$salida['activo'] = $etapas[$i];
			}
		} 
		
		$this->datos['etapas'] = $salida;
		/* CHEQUEO ESTADO EVALUACION GENERAL */
		$EvaluacionEvaluacion = new EvaluacionEvaluacion();
		$EvaluacionEvaluacion->buscarObjeto($this->datos['evaluacion']['id_evaluacion']);
		if($EvaluacionEvaluacion->estado == 'activo')
		{
			$total = count($this->datos['etapas']['listado']);
			$cerrado_total = 0;
			for($i=0; $i < $total; $i++)
			{
				if($this->datos['etapas']['listado'][$i]['estado'] == 'cerrado')
				{
					$cerrado_total++;
				}
			}
			//echo $total.' '.$cerrado_total;
			if($total == $cerrado_total)
			{
				$EvaluacionEvaluacion->estado = 'cerrado';
				$EvaluacionEvaluacion->guardarObjeto($this->datos['evaluacion']['id_evaluacion']);
			}
		}  
	}
	
  /**
   * ControlGeneralEvaluaciones::revisarAsignacionRevisoresSimple()
   *
   * @return void
   */
	function revisarAsignacionRevisoresSimple()
	{ 
		$id_etapa_envio = $this->obtenerEtapaEnvio();		
		$total_por_grupo = $this->datos['etapas']['activo']['grupo_asignacion'];
		/* NO SE HAN ASIGNADO, ASI QUE HAY QUE ASIGNARLOS, 
		CON CRITERIO DE GRUPOS DE CANTIDADES DEFINIDAS POR LA EVALUACION */
		//$this->datos['evaluacion']['cantidad_por_grupo']
		$ControlEvaluacionEstadoEtapaCompleto = new ControlEvaluacionEstadoEtapaCompleto();
		
		$usuarios = $ControlEvaluacionEstadoEtapaCompleto->obtenerEnviosCompletosEvaluacionEtapa($this->datos['evaluacion']['id_evaluacion'],$id_etapa_envio);	
		$total = count($usuarios);
		Funciones::mostrarArreglo($usuarios);
		
		if(is_array($usuarios) && $total > 0)
		{
			$fila = 0;
			$arreglo_aux = array();
			$arreglo_aux_anterior = array();
			for($i=0; $i < $total; $i++)
			{
				$arreglo_aux[] = $usuarios[$i]['username']; 
				$fila++;	
				if($fila == $total_por_grupo)
				{ 				
					$this->ingresarAsignacionRevisores($arreglo_aux);
					$arreglo_aux_anterior = $arreglo_aux;		
					$fila = 0;
					$arreglo_aux = array();
				} 
			}
			//Funciones::mostrarArreglo($arreglo_aux);
			//Funciones::mostrarArreglo($arreglo_aux_anterior);
			if(count($arreglo_aux) <= 2)
			{
				$arreglo_aux = array_merge($arreglo_aux,$arreglo_aux_anterior);
			}
			$this->ingresarAsignacionRevisores($arreglo_aux);
		}	 
	}
	
  /**
   * ControlGeneralEvaluaciones::revisarAsignacionRevisoresComplejo()
   *
   * @return void
   */
	function revisarAsignacionRevisoresComplejo()
	{ 
		$id_etapa_envio 	= $this->obtenerEtapaEnvio();		
		$total_por_grupo 	= $this->datos['etapas']['activo']['grupo_asignacion']; 
		$ControlEvaluacionEstadoEtapaCompleto = new ControlEvaluacionEstadoEtapaCompleto(); 
		$usuarios 			= $ControlEvaluacionEstadoEtapaCompleto->obtenerEnviosCompletosEvaluacionEtapaPromedio($this->datos['evaluacion']['id_evaluacion'],$id_etapa_envio);	
		$total 				= count($usuarios);  

		//Funciones::mostrarArreglo($usuarios);
		if(is_array($usuarios) && $total > 0)
		{
			$mitad 	= round($total/2);			
			
			/* ASIGNACION DE LA PRIMERA MITAD RANDOM */
			$fila 	= 0;
			$arreglo_aux = array();
			$arreglo_aux_anterior = array();
			$usuarios_restantes = array();
			for($i=0; $i < $total; $i++)
			{
				if($i < $mitad)
				{
					$arreglo_aux[] = $usuarios[$i]['username']; 
					$fila++;	
					if($fila == $total_por_grupo)
					{ 				
						$this->ingresarAsignacionRevisores($arreglo_aux);
						$arreglo_aux_anterior = $arreglo_aux;		
						$fila = 0;
						$arreglo_aux = array();
					}
				}
				else
				{
					$usuarios_restantes[] = $usuarios[$i];
				} 
			} 
			if(count($arreglo_aux) <= 2)
			{
				$arreglo_aux = array_merge($arreglo_aux,$arreglo_aux_anterior);
			}
			$this->ingresarAsignacionRevisores($arreglo_aux);
			 
			/**************************** ASIGNACION DE LA SEGUNDA  MITAD **************************************/
			/**************************** ASIGNACIÓN RESTANTE DE MEJORES CON PEORES ***************************/
			$usuarios = $usuarios_restantes;
			foreach ($usuarios as $key => $row) 
			{
			    $username[$key]  = $row['username'];
			    $promedio[$key]  = $row['promedio'];
			} 
			array_multisort($promedio,  SORT_DESC, $username, SORT_DESC, $usuarios);
			$usuarios_mejores = $usuarios;
			array_multisort($promedio,  SORT_ASC, $username, SORT_DESC, $usuarios);
			$usuarios_peores = $usuarios;
			Funciones::mostrarArreglo(array('USUARIOS MEJORES',$usuarios_mejores));
			Funciones::mostrarArreglo(array('USUARIOS PEORES', $usuarios_peores));
			
			$total_por_grupo = $total_por_grupo - 1; // son 3 por grupo
			$total_por_grupo_mitad = floor($total_por_grupo/2);
			$total 	= count($usuarios);
			$mitad 	= floor($total/2);  
			
			for($i=0; $i < $total; $i++)
			{    
				$fila = $i - $total_por_grupo_mitad;
				if($fila < 0)
				{
					$fila = 0;
				} 
				$j = 0;
				for($j = 0; $j < $total_por_grupo; $j++)
				{					
					if($fila >= $total || ($i < $mitad && $fila >= $mitad))
					{	 
						/* CASOS DE CORTE, SI SE SE LEE MAS DEL TOTAL DEL ARREGLO 
						Y REVISAR QUE LOS PEORES SE REVISEN ENTRE SI*/ 
						continue;
					}
					
					$EvaluacionEnvioAsignacion = new EvaluacionEnvioAsignacion();
					if($usuarios_mejores[$i]['username'] == $usuarios_peores[$fila]['username'])
					{
						Funciones::mostrarArreglo(array('SON IGUALES!!!!!!!!!!!!!!!!',array('i' => $i,'fila' => $fila, 'j' => $j,'mejor' =>$usuarios_mejores[$i]['username'] , 'peor' => $usuarios_peores[$fila]['username'])));  
						
						$fila++;
						
						Funciones::mostrarArreglo(array('YA NO SON IGUALES!!!!!!!!!!!!!!!!',array('i' => $i,'fila' => $fila, 'j' => $j,'mejor' =>$usuarios_mejores[$i]['username'] , 'peor' => $usuarios_peores[$fila]['username']))); 
					} 
					
					$EvaluacionEnvioAsignacion->guardarAsignacion($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$usuarios_mejores[$i]['username'],$usuarios_peores[$fila]['username'],2); 
					
					Funciones::mostrarArreglo(array('USUARIOS INSERTANDO 2 GRUPO',array('i' => $i,'fila' => $fila, 'j' => $j)));  
					$fila++;  
				} 
			}  
		} 
	}
	
	 
  /**
   * ControlGeneralEvaluaciones::revisarAsignacionRevisores()
   *
   * @return void
   */
	function revisarAsignacionRevisores()
	{
		if($this->etapaRevisionEstaActiva())
		{ 
			$id_etapa_envio = $this->obtenerEtapaEnvio();
			/* SE REVISA SOLO SI LA ETAPA ACTIVA ES REVISION */ 
			if($this->datos['etapas']['activo']['estado_asignacion'] == 'no_asignado')
			{
				switch($this->datos['etapas']['activo']['tipo_asignacion'])
				{
					case 'complejo':
						$this->revisarAsignacionRevisoresComplejo();
					break;
					default:
						$this->revisarAsignacionRevisoresSimple();
					break;
				} 

				/* SE ASIGNA LA ETAPA */
				$EvaluacionEvaluacionEtapa = new EvaluacionEvaluacionEtapa();
				$EvaluacionEvaluacionEtapa->buscarEtapa($this->datos['etapas']['activo']['id_etapa'],$this->datos['etapas']['activo']['id_evaluacion']);
				$EvaluacionEvaluacionEtapa->estado_asignacion = 'asignado';
				$EvaluacionEvaluacionEtapa->guardarEtapa($this->datos['etapas']['activo']['id_etapa'],$this->datos['etapas']['activo']['id_evaluacion']);	
				
				/* SE INSERTAN LAS REVISIONES BASE DE LAS ASIGNACIONES */
				$ControlEvaluacionEnvioAsignacionRevision = new ControlEvaluacionEnvioAsignacionRevision();
				$ControlEvaluacionEnvioAsignacionRevision->insertarAsignacionRevisionBase($id_etapa_envio,$this->datos['etapas']['activo']['id_etapa'],$this->datos['etapas']['activo']['id_evaluacion']);  				
			}
		} 
	}
	
  /**
   * ControlGeneralEvaluaciones::ajusteAsignacionRevision()
   *
   * @return void
   */
	function ajusteAsignacionRevision()
	{ 
		$id_etapa_envio = $this->obtenerEtapaEnvio();
		$ControlEvaluacionEnvioAsignacionRevision = new ControlEvaluacionEnvioAsignacionRevision();
		$listado = $this->obtenerAsignacionesRevision();
		$total = count($listado);
		for($i=0; $i < $total; $i++)
		{
			$ControlEvaluacionEnvioAsignacionRevision->insertarAsignacionRevisionBaseUsername($id_etapa_envio,$this->datos['etapas']['activo']['id_etapa'],$listado[$i]['username_revisor'],$listado[$i]['username_revisado'],$this->datos['etapas']['activo']['id_evaluacion']);
		}
	}
	
  /**
   * ControlGeneralEvaluaciones::ingresarAsignacionRevisores()
   *
   * @param mixed $listado
   * @return void
   */
	function ingresarAsignacionRevisores($listado,$grupo_control=1)
	{ 
		$total = count($listado);
		Funciones::mostrarArreglo($listado);
		for($i=0; $i < $total; $i++)
		{
			$username_revisor = $listado[$i]; 
			for($j=0; $j < $total;$j++)
			{
				$username_revisado = $listado[$j]; 
				if($username_revisor == $username_revisado)
				{
					continue;
				}
				$EvaluacionEnvioAsignacion = new EvaluacionEnvioAsignacion();
				$EvaluacionEnvioAsignacion->guardarAsignacion($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$username_revisor,$username_revisado,$grupo_control); 
			}
		}
	}
	
	
  /**
   * ControlGeneralEvaluaciones::sePuedeEnviarMasTrabajos()
   *
   * @return
   */
	function sePuedeEnviarMasTrabajos()
	{ 
		$EvaluacionEstadoEtapaCompleto = new EvaluacionEstadoEtapaCompleto();
		$EvaluacionEstadoEtapaCompleto->buscarEstado($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
		if(!$EvaluacionEstadoEtapaCompleto->existeElemento())		
		{ 
			$EvaluacionEstadoEtapaCompleto->crearEstado($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']); 
		} 
		 
		/* REVISION DE ENVIO DE ARCHIVOS */ 
		if( is_array($this->datos['envio']['listado']) && $this->datos['envio']['total_enviados'] < $this->datos['evaluacion']['envios_permitidos'] && $this->datos['envio']['total_enviados'] >= 0 )
		{
			if($EvaluacionEstadoEtapaCompleto->completo == 'si')
			{ 				
				$EvaluacionEstadoEtapaCompleto->crearEstado($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']); 
			}
			return true;
		}
		else
		{ 
			if($this->datos['etapas']['activo']['estado_particular_envio'] == 'envio')
			{
				$EvaluacionEstadoEtapaCompleto->completarEstado($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);
			} 
			return false;
		}
	}
	
  /**
   * ControlGeneralEvaluaciones::etapaEnvioEstaActiva()
   *
   * @return
   */
	function etapaEnvioEstaActiva()
	{ 
		if($this->datos['etapas']['activo']['etapa'] == 'envio' && $this->datos['etapas']['activo']['estado'] == 'activo')
		{ 
			return true;			
		}
		else
		{  
			//return true;
			return false;
		}
	}  
	
  /**
   * ControlGeneralEvaluaciones::etapaRevisionEstaActiva()
   *
   * @return
   */
	function etapaRevisionEstaActiva()
	{ 
		if($this->datos['etapas']['activo']['etapa'] == 'revision' && $this->datos['etapas']['activo']['estado'] == 'activo')
		{ 
			return true;			
		}
		else
		{ 
			return false;
		}
	}
	
  /**
   * ControlGeneralEvaluaciones::guardarEnviosParticipante()
   *
   * @param mixed $nombre_archivo_documento
   * @param mixed $valores
   * @return void
   */
	function guardarEnviosParticipante($user_id,$valores)
	{ 
		$path_doc  	= VarSystem::getPathVariables('dir_repositorio').'doc/envios/'.$this->datos['evaluacion']['id_evaluacion']."/";
		$archivos 	= VarSystem::getFile(); 
		$archivos['archivo']['new_name'] = $this->datos['evaluacion']['id_evaluacion'].'-'.$this->datos['etapas']['activo']['id_etapa'].'-'.$user_id.'-'.$valores['id_tipo_envio']; 
		$DocumentFile  = new DocumentFile($path_doc); 
		$DocumentFile->checkPath(); 
		$DocumentFile->setFileArray($archivos['archivo']); 
		if($DocumentFile->saveFile(false))
		{
			$nombre_archivo  = $DocumentFile->getFileName();	 
		}		
		
		$EvaluacionEnvioActividad = new EvaluacionEnvioActividad();
		$EvaluacionEnvioActividad->id_evaluacion 	= $this->datos['evaluacion']['id_evaluacion'];
		$EvaluacionEnvioActividad->username 		= $this->datos['usuario']['user_id'];
		$EvaluacionEnvioActividad->archivo	 		= $nombre_archivo;
		$EvaluacionEnvioActividad->id_tipo_envio	= 'tarea';
		$EvaluacionEnvioActividad->id_etapa			= $valores['id_etapa'];

		$EvaluacionEnvioActividad->texto			= $valores['texto'];

		$EvaluacionEnvioActividad->texto2		= $valores['texto2'];

		$EvaluacionEnvioActividad->fecha			= time(); 
		$EvaluacionEnvioActividad->guardarObjeto();
	}
	
  /**
   * ControlGeneralEvaluaciones::obtenerEtapaEnvio()
   *
   * @return
   */
	function obtenerEtapaEnvio()
	{
		$id_etapa = $this->obtenerEtapaContrariaAnterior('revision','envio');
		return $id_etapa;	
	}
  /**
   * ControlGeneralEvaluaciones::obtenerEtapaRevision()
   *
   * @return
   */
	function obtenerEtapaRevision()
	{
		$id_etapa = $this->obtenerEtapaContrariaAnterior('envio','revision');
		return $id_etapa;	
	}
 
  /**
   * ControlGeneralEvaluaciones::obtenerEtapaContrariaAnterior()
   *
   * @param mixed $etapa_actual
   * @param mixed $etapa_anterior
   * @return
   */
	function obtenerEtapaContrariaAnterior($etapa_actual,$etapa_anterior)
	{
		$id_etapa = $this->datos['etapas']['activo']['id_etapa'];
		if($this->datos['etapas']['activo']['etapa'] == $etapa_actual)
		{
			$i = $this->datos['etapas']['activo']['i'] - 1; 
			while($i >= 0)
			{ 
				if($this->datos['etapas']['listado'][$i]['etapa'] == $etapa_anterior)
				{ 
					$id_etapa = $this->datos['etapas']['listado'][$i]['id_etapa'];
					break;
				}	
				$i--;
			} 
		}  
		return $id_etapa;	
	}	

  /**
   * ControlGeneralEvaluaciones::obtenerEtapaEnvioAnterior()
   *
   * @return
   */
	function obtenerEtapaEnvioAnterior()
	{
		$id_etapa = $this->datos['etapas']['activo']['id_etapa'];
  
		if($this->datos['etapas']['activo']['etapa'] == 'envio')
		{
			$i = $this->datos['etapas']['activo']['i'] - 1; 
			while($i >= 0)
			{ 
				if($this->datos['etapas']['listado'][$i]['etapa'] == 'envio')
				{ 
					$id_etapa = $this->datos['etapas']['listado'][$i]['id_etapa'];
					break;
				}	
				$i--;
			} 
		} 
	 
		return $id_etapa;	
	}	
	
  /**
   * ControlGeneralEvaluaciones::obtenerEnviosParticipante()
   *
   * @return
   */
	function obtenerEnviosParticipante($id_etapa='')
	{
		/* SE BUSCAN LOS DE LA EVALUACION EN CURSO */
		$ControlEvaluacionEnvioActividad = new ControlEvaluacionEnvioActividad();
		
		if(trim($id_etapa) == '')
		{
			$id_etapa = $this->obtenerEtapaEnvio();	
		}		 
		
		$this->datos['envio']['listado'] = $ControlEvaluacionEnvioActividad->buscarEnvios($this->datos['usuario']['user_id'],$this->datos['evaluacion']['id_evaluacion'],$id_etapa);
		
		if(is_array($this->datos['envio']['listado']))
		{
			$this->datos['envio']['total_enviados'] = count($this->datos['envio']['listado']);
		}		
		else
		{
			$this->datos['envio']['total_enviados'] = 0;
			$this->datos['envio']['listado'] 		= array();
		}
		return $this->datos['envio']['listado'];		
	}
	
  /**
   * ControlGeneralEvaluaciones::revisionEstadoCompletoActividad()
   *
   * @param mixed $id_etapa
   * @return void
   */
	function revisionEstadoCompletoActividad($id_etapa)
	{ 
		$EvaluacionEstadoEtapaCompleto = new EvaluacionEstadoEtapaCompleto();
		$EvaluacionEstadoEtapaCompleto->buscarEstado($this->datos['evaluacion']['id_evaluacion'],$id_etapa,$this->datos['usuario']['user_id']);
		$salida = array('estado_completo' => '','fecha_cierre_completo_html' => '');
		switch($EvaluacionEstadoEtapaCompleto->completo)
		{
			case 'si':
				$fecha =  ControladorFechas::fecha2Date($EvaluacionEstadoEtapaCompleto->fecha_cierre,0,TRUE)  ;
				$salida = array('estado_completo' => 'si','fecha_cierre_completo_html' => $fecha);
			break;
			case 'no':
				$salida = array('estado_completo' => 'no','fecha_cierre_completo_html' => '');
			break;
			default:				
				$EvaluacionEstadoEtapaCompleto->crearEstado($this->datos['evaluacion']['id_evaluacion'],$id_etapa,$this->datos['usuario']['user_id']);
				$salida = array('estado_completo' => 'no','fecha_cierre_completo_html' => '');
			break;
		} 
		Funciones::mostrarArreglo($EvaluacionEstadoEtapaCompleto);
		Funciones::mostrarArreglo($salida);	
		return $salida;	
	}
	
  /**
   * ControlGeneralEvaluaciones::completarEtapas()
   *
   * @return void
   */
	function completarEtapas($id_etapa)
	{
		$EvaluacionEstadoEtapaCompleto = new EvaluacionEstadoEtapaCompleto();
		$EvaluacionEstadoEtapaCompleto->buscarEstado($this->datos['evaluacion']['id_evaluacion'],$id_etapa,$this->datos['usuario']['user_id']);			
		switch($this->datos['etapas']['activo']['etapa'])
		{
			case 'envio':
			
				$completo = true;
				if($this->datos['etapas']['activo']['estado_particular_envio'] != 'revision' )
				{			
					$ControlEvaluacionEnvioActividad = new ControlEvaluacionEnvioActividad();
					$envios = $ControlEvaluacionEnvioActividad->buscarEnvios($this->datos['usuario']['user_id'],$this->datos['etapas']['activo']['id_evaluacion'],$id_etapa);
					Funciones::mostrarArreglo(array('ENVIOS COMPLETAR',$envios));
					$total_envio = count($envios);
					if(is_array($envios) && $total_envio > 0)
					{
						if($total_envio < $this->datos['evaluacion']['envios_permitidos'])
						{
							$completo = false;
						}
					}
					else
					{
						$completo = false;
					}
				}
				
				if($this->datos['etapas']['activo']['estado_particular_envio'] != 'envio' )
				{
					if($this->datos['etapas']['activo']['estado_asignacion'] !=  'no_aplica')
					{
						$ControlEvaluacionEnvioAsignacion = new ControlEvaluacionEnvioAsignacion();
						$listado = $ControlEvaluacionEnvioAsignacion->buscarAsignaciones($this->datos['etapas']['activo']['id_evaluacion'],$id_etapa,$this->datos['usuario']['user_id'],'pendiente');
						if(is_array($listado) && count($listado) > 0)
						{
							$completo = false;
						}					
					}	
				}	 
			break;
			case 'revision':
				$ControlEvaluacionEnvioAsignacion = new ControlEvaluacionEnvioAsignacion();
				$listado = $ControlEvaluacionEnvioAsignacion->buscarAsignaciones($this->datos['etapas']['activo']['id_evaluacion'],$id_etapa,$this->datos['usuario']['user_id'],'pendiente');
				$completo = true;				
				if(is_array($listado) && count($listado) > 0)
				{
					$completo = false;
				}
			break; 
		}
		if($completo)
		{
			if($EvaluacionEstadoEtapaCompleto->completo == 'no')
			{
				$EvaluacionEstadoEtapaCompleto->completarEstado($this->datos['evaluacion']['id_evaluacion'],$id_etapa,$this->datos['usuario']['user_id']);
			}			
		}	
		else
		{
			if($EvaluacionEstadoEtapaCompleto->completo == 'si')
			{
				$EvaluacionEstadoEtapaCompleto->crearEstado($this->datos['evaluacion']['id_evaluacion'],$id_etapa,$this->datos['usuario']['user_id']);	
			}	
		}	
	} 
	
  /**
   * ControlGeneralEvaluaciones::revisarEstadoCierreRevisiones()
   *
   * @param mixed $pendientes
   * @param mixed $cerrados
   * @return void
   */
	function revisarEstadoCierreRevisiones($pendientes,$cerrados)
	{
		$EvaluacionEstadoEtapaCompleto = new EvaluacionEstadoEtapaCompleto();
		$EvaluacionEstadoEtapaCompleto->buscarEstado($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']);		 
		if(!is_array($pendientes) && is_array($cerrados) && count($cerrados)) 
		{ 
			$EvaluacionEstadoEtapaCompleto->completarEstado($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']); 			
		}
		else
		{
			if(trim($EvaluacionEstadoEtapaCompleto->completo) == '' || !isset($EvaluacionEstadoEtapaCompleto->completo))
			{ 
				$EvaluacionEstadoEtapaCompleto->crearEstado($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id']); 	
			} 
		}
		Funciones::mostrarArreglo($EvaluacionEstadoEtapaCompleto);
	}
	
  /**
   * ControlGeneralEvaluaciones::obtenerAsignacionesRevision()
   *
   * @return void
   */
	function obtenerAsignacionesRevision($estado='')
	{ 		
		$ControlEvaluacionEnvioAsignacion = new ControlEvaluacionEnvioAsignacion();
		$this->datos['asignaciones']['listado']  = $ControlEvaluacionEnvioAsignacion->buscarAsignaciones($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id'],$estado);
		return $this->datos['asignaciones']['listado'];
	} 

	function buscarRetroalimentacionUsuario($id_evaluacion,$id_etapa,$username_revisado)
	{
		$ControlEvaluacionEnvioAsignacionRevision = new ControlEvaluacionEnvioAsignacionRevision();
		return $ControlEvaluacionEnvioAsignacionRevision->buscarEnviosRevisionesCompleta($id_evaluacion,$id_etapa,$username_revisado);

	}

	function buscarRetroalimentacionesRealizadasUsuario($id_evaluacion,$id_etapa,$username_revisor)
	{
		$ControlEvaluacionEnvioAsignacionRevision = new ControlEvaluacionEnvioAsignacionRevision();
		return $ControlEvaluacionEnvioAsignacionRevision->buscarEnviosRevisionesCompletaRealizadas($id_evaluacion,$id_etapa,$username_revisor);

	}

  /**
   * ControlGeneralEvaluaciones::obtenerAsignacionesRevisados()
   *
   * @param string $estado
   * @return
   */
	function asignarRevisionesAnterioresEnvio()
	{ 		
		if($this->datos['etapas']['activo']['etapa'] == 'envio' && $this->datos['etapas']['activo']['estado_asignacion'] == 'no_asignado')
		{
			$ControlEvaluacionEnvioAsignacion = new ControlEvaluacionEnvioAsignacion();
			$this->datos['asignaciones']['listado']  = $ControlEvaluacionEnvioAsignacion->buscarRevisores($this->datos['evaluacion']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$this->datos['usuario']['user_id'],$estado);
			
			$id_etapa_revision_anterior = $this->obtenerEtapaRevision();
			 
			$ControlEvaluacionEnvioAsignacion = new ControlEvaluacionEnvioAsignacion();
			$ControlEvaluacionEnvioAsignacion->insertarRevisionesCruzadasEnvioRevision($this->datos['etapas']['activo']['id_evaluacion'],$id_etapa_revision_anterior,$this->datos['etapas']['activo']['id_etapa']);
			
			$ControlEvaluacionEnvioAsignacionRevision = new ControlEvaluacionEnvioAsignacionRevision();
			$ControlEvaluacionEnvioAsignacionRevision->insertarAsignacionRevisionBaseSimple($this->datos['etapas']['activo']['id_etapa'],$this->datos['etapas']['activo']['id_evaluacion']);
			
			$EvaluacionEvaluacionEtapa = new EvaluacionEvaluacionEtapa();
			$EvaluacionEvaluacionEtapa->buscarEtapa($this->datos['etapas']['activo']['id_etapa'],$this->datos['etapas']['activo']['id_evaluacion']);
			$EvaluacionEvaluacionEtapa->estado_asignacion = 'asignado';
			$EvaluacionEvaluacionEtapa->guardarEtapa($this->datos['etapas']['activo']['id_etapa'],$this->datos['etapas']['activo']['id_evaluacion']); 
			$this->datos['etapas']['activo']['estado_asignacion'] == 'asignado';
			$this->obtenerEtapasEvaluacion();
		}
	}	
	
  /**
   * ControlGeneralEvaluaciones::guardarRevisiones()
   *
   * @param mixed $valores
   * @return void
   */
	function guardarRevisiones($valores)
	{
		foreach($valores as $var => $val)
		{
			$aux = explode('_',$var);
			if(trim($aux[4]) == '')
			{
				$aux[4] = '0';
			}
			if($aux[0] == 'revision')
			{
				$id_envio = $aux[4];
				$id_etapa = $aux[3];
				$id_evaluacion = $aux[2];
				//$datos[$aux[2]][$aux[3]][$aux[4]][$aux[5]][$aux[1]]
				$datos[$aux[4]][$aux[5]][$aux[1]] = array('id_evaluacion' => $aux[2],'id_etapa' => $aux[3],'id_envio' => $aux[4],'id_pregunta' => $aux[5],'respuesta' => $val,'username_revisado' => $valores['username_revisado'],'username_revisor' => $this->datos['usuario']['user_id'],'tipo_respuesta' => $aux[1]);
			}
		}	  
		Funciones::mostrarArreglo($datos);
		foreach($datos as $id_envio => $aux1)
		{
			foreach($aux1 as $id_pregunta => $aux2)
			{				
				Funciones::mostrarArreglo($aux2);
				$EvaluacionEnvioAsignacionRevision = new EvaluacionEnvioAsignacionRevision();
				$EvaluacionEnvioAsignacionRevision->buscarElemento($id_evaluacion,$id_etapa,$this->datos['usuario']['user_id'],$valores['username_revisado'],$id_envio,$id_pregunta);
				$EvaluacionEnvioAsignacionRevision->nota = $aux2['nota']['respuesta'].''; 
				$EvaluacionEnvioAsignacionRevision->texto = $aux2['texto']['respuesta'].'';
				$EvaluacionEnvioAsignacionRevision->fecha_revision = time();
				$EvaluacionEnvioAsignacionRevision->estado = 'cerrado'; 
				$EvaluacionEnvioAsignacionRevision->guardarElemento($id_evaluacion,$id_etapa,$this->datos['usuario']['user_id'],$valores['username_revisado'],$id_envio,$id_pregunta);
				Funciones::mostrarArreglo($EvaluacionEnvioAsignacionRevision);
			}	
		}		
		$EvaluacionEnvioAsignacion = new EvaluacionEnvioAsignacion();
		$EvaluacionEnvioAsignacion->buscarElemento($id_evaluacion,$id_etapa,$this->datos['usuario']['user_id'],$valores['username_revisado']);
		$EvaluacionEnvioAsignacion->estado = 'cerrado';
		$EvaluacionEnvioAsignacion->fecha_cierre = time();
		$EvaluacionEnvioAsignacion->guardarElemento($id_evaluacion,$id_etapa,$this->datos['usuario']['user_id'],$valores['username_revisado']);			 
	}
	
  /**
   * ControlGeneralEvaluaciones::revisionSiPuedeSeguirEtapas()
   *
   * @return
   */
	function revisionSiPuedeSeguirEtapas()
	{
		/* SE DEBE CHEQUEAR QUE TENGA CUMPLIDAS LAS ETAPAS ANTERIORES PARA PODER SEGUIR ADELANTE */
		$ControlEvaluacionEstadoEtapaCompleto = new ControlEvaluacionEstadoEtapaCompleto();
		$estado = $ControlEvaluacionEstadoEtapaCompleto->obtenerEstadoUsuario($this->datos['evaluacion']['id_evaluacion'],$this->datos['usuario']['user_id']);
		$cumplio = true;
		$total = count($estado);
		for($i=0; $i < $total; $i++)
		{
			if($estado[$i]['id_etapa'] == $this->datos['etapas']['activo']['id_etapa'])
			{
				break;
			}
			if($estado[$i]['completo'] == 'no')
			{
				//$cumplio = false;
			}
		}
		//Funciones::mostrarArreglo($estado);
		return $cumplio;
	}
	
  /**
   * ControlGeneralEvaluaciones::mostrarFormularioGenericoRevision()
   *
   * @param mixed $e
   * @return
   */
	function mostrarFormularioGenericoRevision($e,$caso)
	{ 
		$valores 					= VarSystem::getPost();
		
		$MantenedoresGeneral 		= new MantenedoresGeneral();		 	
		$e = $this->baseValoresTemplate($e);  
		
		$ControlEvaluacionEnvioAsignacionRevision = new ControlEvaluacionEnvioAsignacionRevision();
			 
		switch($caso)
		{
			case 'revision': 
				$envios = $ControlEvaluacionEnvioAsignacionRevision-> buscarEnviosRevisionesAsignado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$valores['username_revisado'],$this->datos['usuario']['user_id']);		
			break;
			case 'envio':
				$envios = $ControlEvaluacionEnvioAsignacionRevision-> buscarEnviosRevisionesEnviosAsignado($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa'],$valores['username_revisado'],$this->datos['usuario']['user_id']);
			break;
		}
		$total_envios = count($envios);  
		
		$ControlEvaluacionEvaluacionPregunta = new ControlEvaluacionEvaluacionPregunta();
		$preguntas = $ControlEvaluacionEvaluacionPregunta->obtenerPreguntas($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['etapas']['activo']['id_etapa']);
		$total_preguntas = count($preguntas);
		Funciones::mostrarArreglo(array('PREGUNTAS-ENVIOS',$envios,$preguntas));
		
		for($i=0; $i < $total_envios; $i++)
		{
			$e->addTemplate('bloque_lista_envio');

			$e = $this->baseValoresTemplate($e);  			
			$e = $MantenedoresGeneral->mostrarElementoValores($e,$envios[$i]); 
			$e = $MantenedoresGeneral->mostrarElementoValores($e,$this->datos['etapas']['activo']);						  
			for($j=0;$j < $total_preguntas; $j++)
			{
				$e->addTemplate('bloque_lista_envio_pregunta'); 
				$fila = $j + 1;
				$e->setVariable('fila_pregunta',$fila);
				$e = $MantenedoresGeneral->mostrarElementoValores($e,$this->datos['etapas']['activo']);
				$e = $MantenedoresGeneral->mostrarElementoValores($e,$envios[$i]); 
				$e = $MantenedoresGeneral->mostrarElementoValores($e,$preguntas[$j]);
					
				if($this->datos['etapas']['activo']['tipo_respuesta'] == 'texto' || $this->datos['etapas']['activo']['tipo_respuesta'] == 'texto_nota')
				{
					$e->addTemplate('bloque_lista_envio_pregunta_texto');
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$this->datos['etapas']['activo']); 
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$envios[$i]); 
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$preguntas[$j]);
					$e->addTemplate('bloque_lista_envio_pregunta_texto_revision'); 
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$envios[$i]); 
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$preguntas[$j]);
				}
				
				if($this->datos['etapas']['activo']['tipo_respuesta'] == 'nota' || $this->datos['etapas']['activo']['tipo_respuesta'] == 'texto_nota' || $this->datos['etapas']['activo']['tipo_respuesta'] == 'bloque_nota')
				{
					$e->addTemplate('bloque_lista_envio_pregunta_fila_nota');
					
					$e->setVariable('fila_pregunta',$fila);
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$this->datos['etapas']['activo']); 
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$envios[$i]); 
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$preguntas[$j]); 
					for($k = 1; $k <= $this->datos['etapas']['activo']['maximo_nota_revision'];$k++)
					{
						$e->addTemplate('bloque_lista_envio_pregunta_nota');
						$e->setVariable('valor_nota',$k); 
						$e = $MantenedoresGeneral->mostrarElementoValores($e,$envios[$i]); 
						$e = $MantenedoresGeneral->mostrarElementoValores($e,$preguntas[$j]); 
						if($k==1)
						{
							$e->addTemplate('bloque_lista_envio_pregunta_nota_revision');
							$e->setVariable('valor_nota',$k);  
							$e = $MantenedoresGeneral->mostrarElementoValores($e,$envios[$i]); 
							$e = $MantenedoresGeneral->mostrarElementoValores($e,$preguntas[$j]);
						} 
					}	
				}
			} 
		}	
		return $e;
	}
	
  /**
   * ControlGeneralEvaluaciones::cierreEvaluacionFinal()
   *
   * @return void
   */
	function cierreEvaluacionFinal()
	{
		$valores 					= VarSystem::getPost(); 
		$EvaluacionEnvioFinal = new EvaluacionEnvioFinal();
		$EvaluacionEnvioFinal->buscarObjeto($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['usuario']['user_id']);
		$EvaluacionEnvioFinal->fecha_cierre = time();
		$EvaluacionEnvioFinal->estado = 'cerrado'; 
		
		$EvaluacionEnvioFinal->valor_1_1 = $valores['evaluacion_final_1_1'];
		$EvaluacionEnvioFinal->valor_1_2 = $valores['evaluacion_final_1_2'];
		$EvaluacionEnvioFinal->valor_1_3 = $valores['evaluacion_final_1_3'];
		$EvaluacionEnvioFinal->valor_2_1 = $valores['evaluacion_final_2_1'];
		$EvaluacionEnvioFinal->valor_3_1 = $valores['evaluacion_final_3_1'];
		$EvaluacionEnvioFinal->valor_4_1 = $valores['evaluacion_final_4_1'];
		
		$EvaluacionEnvioFinal->guardarObjeto($this->datos['etapas']['activo']['id_evaluacion'],$this->datos['usuario']['user_id']);
	}
	
  /**
   * ControlGeneralEvaluaciones::cierreFormularioEvaluacionFinal()
   *
   * @param mixed $e
   * @return
   */
	function cierreFormularioEvaluacionFinal()
	{ 
		$path_admin					= VarSystem::getPathVariables('dir_template').'evaluaciones/envio/';   
		$e = new miniTemplate($path_admin.'evaluacion_sistema.tpl'); 		 	
		$e = $this->baseValoresTemplate($e);  
		return $e;
	}
	
  /**
   * ControlGeneralEvaluaciones::mostrarRevisionesEnvioAnterior()
   *
   * @param mixed $e
   * @return
   */
	function mostrarRevisionesEnvioAnterior($e)
	{ 	
		$valores 		   = VarSystem::getPost();
		
		$id_etapa_revision = $this->obtenerEtapaRevision();
	  
		$MantenedoresGeneral 		= new MantenedoresGeneral();
		
		$ControlEvaluacionEnvioAsignacionRevision = new ControlEvaluacionEnvioAsignacionRevision();

		$revision = $ControlEvaluacionEnvioAsignacionRevision->buscarRevisionesRealizadasCompletas($this->datos['etapas']['activo']['id_evaluacion'],$id_etapa_revision,$valores['username_revisado'],$this->datos['usuario']['user_id']);
		
		Funciones::mostrarArreglo(array('revision-anterior',$revision,$valores));
		
		$total = count($revision);
		
		if(is_array($revision) && $total > 0)
		{
			$e->addTemplate('bloque_lista_envio_revision');
			$e = $this->baseValoresTemplate($e);  
			$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$revision,'bloque_lista_envio_revision_pregunta');
		}

		return $e;
	}

	function guardarI1($valores)
	{
		$evAdmin = new EvaluacionAdminGeneral();
		
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],1);
		
		$evAdmin->fecha_inicio = str_replace('T',' ',$valores['dtInicio_1']).':00';
		
		$evAdmin->guardarObjeto();
		
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],1);

		/*Funciones::mostrarArreglo($evAdmin,true,"jmrueuertrarreglo4");*/

	}

		function guardarC1($valores)
	{
		$evAdmin = new EvaluacionAdminGeneral();

		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],1);
		$evAdmin->fecha_cierre = str_replace('T',' ',$valores['dtCierre_1']).':00';
		$evAdmin->guardarObjeto();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],1);

		/*Funciones::mostrarArreglo($evAdmin,true,"jmrueuertrarreglo4");*/

	}

		function guardarI2($valores)
	{
		$evAdmin = new EvaluacionAdminGeneral();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],2);
		$evAdmin->fecha_inicio = str_replace('T',' ',$valores['dtInicio_2']).':00';
		$evAdmin->guardarObjeto();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],2);

/*		Funciones::mostrarArreglo($evAdmin,true,"jmrueuertrarreglo4");*/

	}

		function guardarC2($valores)
	{
		$evAdmin = new EvaluacionAdminGeneral();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],2);
		$evAdmin->fecha_cierre = str_replace('T',' ',$valores['dtCierre_2']).':00';
		$evAdmin->guardarObjeto();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],2);

/*		Funciones::mostrarArreglo($evAdmin,true,"jmrueuertrarreglo4");*/

	}

		function guardarI3($valores)
	{
		$evAdmin = new EvaluacionAdminGeneral();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],3);
		$evAdmin->fecha_inicio = str_replace('T',' ',$valores['dtInicio_3']).':00';
		$evAdmin->guardarObjeto();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],3);

/*		Funciones::mostrarArreglo($evAdmin,true,"jmrueuertrarreglo4");*/

	}

		function guardarC3($valores)
	{
		$evAdmin = new EvaluacionAdminGeneral();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],3);
		$evAdmin->fecha_cierre = str_replace('T',' ',$valores['dtCierre_3']).':00';
		$evAdmin->guardarObjeto();
		$evAdmin->buscarEtapaParaActualizarFecha($valores['id_evaluacion'],3);

/*		Funciones::mostrarArreglo($evAdmin,true,"jmrueuertrarreglo4");*/

	}
}

?>