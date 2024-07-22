<?php
global $ControlHtml;
$opcion = explode("_", $ControlHtml->lastActionArray[0]);
 //Funciones::mostrarArreglomostrarArreglo($opcion,"OPCIONES");
unset($opcion[0]);
unset($opcion[1]);
$opcion = implode("_", $opcion);
$valoresGet = VarSystem::getGet();
if(file_exists(VarSystem::getPathVariables("dir_template_web")."inscripcion/".$opcion.".tpl"))
{
	$e = new miniTemplate(VarSystem::getPathVariables("dir_template_web")."inscripcion/".$opcion.".tpl");
}
else
{ 
	/* INSCRIPCIONES SIMPLES Y COMUNES, PARA AQUELLAS MAS COMPLEJAS, SE DEBE HACER EL PROCESO ORIGINAL CON LA CREACION DE LOS TEMPLATES ASOCIADOS*/
	$e = new miniTemplate(VarSystem::getPathVariables("dir_template_web")."inscripcion/inscripcion_base.tpl");
}

$ControladorEventosInforme = new ControladorEventosInforme();
$datos_inscripcion = $ControladorEventosInforme->obtenerOpcionMenuId(trim($opcion));
foreach($datos_inscripcion[0] as $var => $val)
{
	$e->setVariable("datos_inscripcion_".$var, $val);
}

$aux = explode("|", $datos_inscripcion[0]["listas"]);
if(is_array($aux) && count($aux) > 0)
{
	for($i=0; $i < count($aux); $i++)
	{
		$e->addTemplate("bloque_bd_extras");
		$e->setVariable("listas", $aux[$i]);
	}
}
$aux = explode("|", trim($datos_inscripcion[0]["logos"]));
if(is_array($aux) && count($aux) > 0 && trim($aux[0]) != "")
{
	for($i=0; $i < count($aux); $i++)
	{
		$e->addTemplate("bloque_imagenes_logos_extras");
		$e->setVariable("logos", $aux[$i]);
	}
}
$e->setVariable("opcion_extra", $opcion);
$valores = VarSystem::getPost();
$archivos = VarSystem::getFile();
$conPost = true;
if(count($valores) == 0)
{
	$valores = VarSystem::getGet();
	$conPost = false;
}
$mostrarValores = false;
$mostrarError = false;
$mostrarExito = false;
$conRefresh = false;
$mensajeError  	= '';
$e->setVariable("clave_explicacion", "Ingrese clave para su registro");
$e->setVariable("titulo_extra", "Inscripción");
$prefijo_carta = "";
$prefijo_asunto = "";
switch($ControlHtml->lastActionArray[0])
{
	case 'view_inscripcion_mineduc_modelamiento2013':
		$prefijo_carta = 'pre_modelamiento_';
		$prefijo_asunto = 'Pre';
	break;
	case 'view_inscripcion_mineduc_lenguaje2013':
		$prefijo_carta = 'pre_modelamiento_';
		$prefijo_asunto = 'Pre';
	break;
	case 'view_inscripcion_mineduc_musica2013':
		$prefijo_carta = 'pre_modelamiento_';
		$prefijo_asunto = 'Pre';
	break;
	case 'view_inscripcion_mineduc_matematicas2013':
		$prefijo_carta = 'pre_modelamiento_';
		$prefijo_asunto = 'Pre';
	break;
	default;
		$prefijo_carta = '';
		$prefijo_asunto = '';
	break;
}
if(isset($valores['guardar']))
{
	$valores['form_email'] = str_replace(" ", "", strtolower(trim($valores['form_email'])));
	switch($valores['guardar'])
	{
		case "guardar":
			$Inscripcion = new Inscripcion();
			$email_original = "";
			if(trim($valores["form_rut"]) != "")
			{
				$Inscripcion->consultaInscripcionRut($valores['form_rut'], $valores['form_tipo_inscripcion']);
				$email_original = $Inscripcion->email;
			}
			else
			{
				$Inscripcion->consultaInscripcion($valores['form_email'], $valores['form_tipo_inscripcion']);
			}
			if($valores['form_comuna'] == 0)
			{
				$valores['form_comuna'] = 1;
			}
			$valores['form_rut'] = str_replace(array('.', '-', ' '), array('', '', ''), $valores['form_rut']);
			$valores['form_nombre'] = Funciones::textToTitle($valores['form_nombre']);
			$valores['form_apellidos'] = Funciones::textToTitle($valores['form_apellidos']);
			foreach($valores as $var => $val)
			{
				$aux = explode('_', $var);
				if($aux[0] == 'form')
				{
					if(is_array($valores[$var]))
					{
						$val = "";
						foreach($valores[$var] as $varextra => $valextra)
						{
							$val .= $valextra." | ";
						}
					}
					unset($aux[0]);
					$var = implode('_', $aux);
					$Inscripcion->$var = $val;
				}
			}
			if(trim($email_original) != '')
			{
				$Inscripcion->email = $email_original;
			}
			switch($valores['tipo_formulario_cuestionario'])
			{
				case 'cuestionario_multiple':
					$cuestionario = '';
					foreach($valores as $var => $val)
					{
						$aux = explode('_', $var);
						if($aux[0] == 'campo' && $aux[1] == 'extra2')
						{
							foreach($valores[$var] as $pregunta => $valorp)
							{
								$cuestionario .= ''.$valorp.";";
							}
						}
					}
					$Inscripcion->campo_extra2 = $cuestionario;
				break;
			}
			if(is_array($archivos) && count($archivos) > 0)
			{
				$path_doc  	= VarSystem::getPathVariables('dir_repositorio').'doc/inscripciones/';
				$archivo_numero = 1;
				foreach($archivos as $variable => $archivo_detalle)
				{
					$archivos[$variable]['new_name'] = $valores['form_email'].'_'.$variable;
					$DocumentFile  = new DocumentFile($path_doc);
					$DocumentFile->checkPath();
					$DocumentFile->setFileArray($archivos[$variable]);
					if($DocumentFile->saveFile(false))
					{
						$nombre_archivo = $DocumentFile->getFileName();
						$aux = 'archivo_extra'.$archivo_numero;
						$Inscripcion->$aux = $nombre_archivo;
						$archivo_numero++;
					}
				}
			}
			$Inscripcion->guardar($valores['form_email']);

			/* SE COPIA CANTIDAD DE INSCRIPCIONES EN INFORME DE EVENTOS */
			$ControladorEventosInforme = new ControladorEventosInforme();
			$aux = str_replace('view_inscripcion_', '', $ControlHtml->lastActionArray[0]);
			$ControladorEventosInforme->actualizarTotalInscritos($aux, $valores['form_tipo_inscripcion']);
			$aux_caso = explode("_", $valores['form_tipo_inscripcion']);
			$caso = end($aux_caso);
			if($caso == 'presencial' || $caso == 'online')
			{
				$caso_inscripcion = $caso;
			}
			else
			{
				$caso_inscripcion = 'presencial';
			}
			if($caso == 'online_simple')
			{
				$caso_inscripcion = 'online';
			}
			$mostrarExito = true;
			$cartaInscripcion = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/'.$prefijo_carta.'inscripcion.tpl');
			$asunto_extra = '';
			if($valores['tipo_formulario_confirmacion'] == 'online' && $caso_inscripcion == 'presencial')
			{
				$valores['tipo_formulario_confirmacion'] = 'simple';
			}
			switch($valores['tipo_formulario_confirmacion'])
			{
				case 'online':
					$cartaInscripcion->addTemplate('bloque_envio_no_confirmacion_online');
				break;
				case 'confirmacion':
					$cartaInscripcion->addTemplate('bloque_envio_confirmacion');
				break;
				case 'requisitos':
					$cartaInscripcion->addTemplate('bloque_envio_requisitos');
				break;
				case 'postulacion':
					$cartaInscripcion->addTemplate('bloque_envio_postulacion');
					$asunto_extra = 'Registro';
				break;
				case 'inicia':
					$cartaInscripcion  = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/inicia_inscripcion.tpl');
					$valores['bd_lista_extra'][] = 'pedagogias_carrera_'.$valores['form_inicia_situacion_academica_carrera'].'_'.$valores['form_inicia_situacion_academica'];
					$asunto_extra = 'Registro';
				break;
				case 'con_pago':
					$cartaInscripcion->addTemplate('bloque_envio_con_pago');
				break;
				case 'sile2016_envio':
					$cartaInscripcion  = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/sile2016_envio.tpl');
					$asunto_extra = 'Presentaci&oacute;n de trabajos | Submissions of communications - SILE2016';
				break;
				default:
					$cartaInscripcion->addTemplate('bloque_envio_no_confirmacion');
				break;
			}
			$cartaInscripcion->refreshTemplate();
			$cartaInscripcion->setVariable('inscripcion', $valores['form_tipo_inscripcion']);
			$ControladorInscripcionBase = new ControladorInscripcionBase();
			// Por algún motivo estaba llamando a la funcion insertarNuevaInscripcion 2 veces.
			$ControladorInscripcionBase->insertarNuevaInscripcion($Inscripcion);
			$ControladorInscripcionBase->insertarNuevaInscripcion($Inscripcion, $valores['bd_lista_extra']);
		break;
		case 'validarEmail':
			$cartaValidacion = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/validacion_email.tpl');
			$email = trim($valores['form_email']);
			$md5 = md5(trim($valores['form_email']));
			$cartaValidacion->setVariable('email', $email);
			$cartaValidacion->setVariable('codigo', $md5);
			$e->setVariable('email_codigo', $md5);
			$e->setVariable('email', $email);
			$asunto = "C&oacute;digo de validaci&oacute;n email para inscripci&oacute;n";
			Funciones::sendEmail($email, $asunto, $cartaValidacion->toHtml());
			$Inscripcion = new Inscripcion();
			$Inscripcion->consultaInscripcion($valores['form_email'], $valores['form_tipo_inscripcion']);
			if(isset($Inscripcion->email))
			{
				$mostrarValores = true;
			}
			$e->setVariable('email', $valores['form_email']);
		break;
		case 'consultaRut':
			$Inscripcion = new Inscripcion();
			if($valores['form_tipo_inscripcion'] == '2016-ValidacionPruebaINICIA')
			{
				$Inscripcion->consultaInscripcionSoloRut(trim($valores['form_rut']));
			}
			else
			{
				$Inscripcion->consultaInscripcionRut(trim($valores['form_rut']), $valores['form_tipo_inscripcion']);
			}
			if(isset($Inscripcion->rut) && trim($Inscripcion->rut) != '')
			{
				$mostrarValores = true;
				$conRefresh = true;
			}
			$e->setVariable('email', $Inscripcion->email);
			$e->setVariable('rut', trim($valores['form_rut']));
			$e->setVariable('fecha_dia_actual', date("Y-m-d"));
			$e->setVariable('fecha_dia_futura', date("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")+1, date("Y"))));
			$e->setVariable('fecha_hora_actual', date("H:i:s"));
		break;
		case 'consultaEmail':
			$Inscripcion = new Inscripcion();
			$Inscripcion->consultaEmail($valores['form_email']);
			$mostrarValores = true;
			$conRefresh = true;
			$e->setVariable('email', $valores['form_email']);
			$Inscripcion->email = $valores['form_email'];
		break;
		case 'consultaEmailInicia':
			$Inscripcion = new Inscripcion();
			$inscripciones = array(
				'201212-ValidacionPrueba',
				'201212-ValidacionPruebaEstudiantes',
				'201212-ValidacionPruebaMide',
				'201212-ValidacionPrueba_Rendicion_Estudiante',
				'201212-ValidacionPrueba_Rendicion_Profesor'
			);
			$Inscripcion->consultaInscripciones($valores['form_email'],$inscripciones);
			if(isset($Inscripcion->email))
			{
				$mostrarValores = true;
			}
			$e->setVariable('email', $valores['form_email']);
		break;
	}
}
$ControladorEventosInforme = new ControladorEventosInforme();
$opcionMenuCaso = $ControladorEventosInforme->obtenerOpcionMenu($ControlHtml->lastActionArray[0]);
 
if(is_array($opcionMenuCaso) && count($opcionMenuCaso) > 0)
{ 
	// Suma 3.600 segundos (una hora)
	$minuto_extra = time() + 3600;
	$ahora = date("Y-m-d", $minuto_extra);
	$estado_inscripcion = 'abierto';
	
	/* INSCRIPCION SE ENCUENTRA ABIERTA */
	if($ahora <= $opcionMenuCaso[0]['inscripcion_fecha_cierre'] && $opcionMenuCaso[0]['total_inscritos_presencial'] < $opcionMenuCaso[0]['inscripcion_cupos_maximo'])
	{
		$estado_inscripcion = 'abierto';
	}
	else
	{
		if($ahora <= $opcionMenuCaso[0]['inscripcion_fecha_cierre'] && $opcionMenuCaso[0]['total_inscritos_presencial'] >= $opcionMenuCaso[0]['inscripcion_cupos_maximo'])
		{

			/* INSCRIPCION ESTA CERRADA POR CUPOS */
			$e->addTemplate('bloque_formulario_cierre_cupo');
			$estado_inscripcion = 'cierre_cupo';
			if($datos_inscripcion[0]['tipo_formulario_confirmacion'] == 'online')
			{
				$estado_inscripcion = 'cierre_cupo_online';
			}
		}
		else
		{

			/* INSCRIPCION ESTA CERRADA POR FECHA  */
			$e->addTemplate('bloque_formulario_cierre');
			$estado_inscripcion = 'cierre_fecha';
		}
		$e->addTemplate('bloque_formulario_cierre_extra');
		$e->addTemplate('bloque_formulario_cierre_extra2');
	}
}

/** SE MUESTRAN LOS VALORES EN EL FORMULARIO */
	 
if($estado_inscripcion == 'cierre_cupo_online' || $estado_inscripcion == 'abierto' || $mostrarValores)
{
	$e->addTemplate('bloque_formulario');
	$e->setVariable('email', $valores['form_email']);
	if($mostrarValores)
	{
		$datos = get_object_vars($Inscripcion);
		foreach($datos as $var => $val)
		{
			$e->setVariable($var,$val);
		}
		$e->addTemplate('bloque_select_comuna');
		$e->setVariable('comuna_id', $Inscripcion->comuna);
		foreach($datos as $var => $val)
		{
			$e->addTemplate('bloque_extra_'.$var);
			$e->setVariable($var, $val);
		}
	}
	$_tipo_formulario_confirmacion = $datos_inscripcion[0]['tipo_formulario_confirmacion'];
	switch ($_tipo_formulario_confirmacion) {
		case "online":
			if($estado_inscripcion == 'cierre_cupo_online')
			{
				$e->addTemplate('bloque_tipo_inscripcion_online_solo');
			}
			else
			{
				$e->addTemplate('bloque_tipo_inscripcion_online');
			}
		break;
		case "hibrido":
			$e->addTemplate('bloque_tipo_inscripcion_hibrido');
		break;
		default:
			$e->addTemplate('bloque_tipo_inscripcion_presencial');
		break;
	}
	$e->setVariable('datos_inscripcion_id_inscripcion', $datos_inscripcion[0]['id_inscripcion']);
}
$ControlComuna = new ControlComuna();
$comunas = $ControlComuna->getListadoCompleto();
for($i=0; $i < count($comunas); $i++)
{
	$e->addTemplate('bloque_comuna');
	foreach($comunas[$i] as $var => $val)
	{
		$e->setVariable($var, $val);
	}
}
$ControlPais = new ControlPais();
$paises = $ControlPais->getPaises();
for($i=0; $i < count($paises); $i++)
{
	$e->addTemplate('bloque_pais');
	foreach($paises[$i] as $var => $val)
	{
		$e->setVariable($var, $val);
	}
}
$ControlRegion = new ControlRegion();
$regiones = $ControlRegion->getRegiones();
for($i=0; $i < count($regiones); $i++)
{
	$e->addTemplate('bloque_region');
	foreach($regiones[$i] as $var => $val)
	{
		$e->setVariable($var, $val);
	}
}
$anno_minimo = 1950;
$anno_actual = date('Y');
for($i = $anno_actual; $i >= $anno_minimo; $i--)
{
	$e->addTemplate('bloque_agno1');
	$e->setVariable('agno', $i);
	$e->addTemplate('bloque_agno2');
	$e->setVariable('agno', $i);
	$e->addTemplate('bloque_agno3');
	$e->setVariable('agno', $i);
}
if($mostrarError)
{
	$e->addTemplate('bloque_envio_error');
	$e->setVariable('mensaje_error', $mensajeError);
}
if($mostrarExito)
{
	$Menu = new Menu();
	$Menu->getOpcion($valores['lastAction']);
	$cartaInscripcion->setVariable('evento', stripcslashes($Menu->titulo_es));
	$cartaInscripcion->setVariable('opcion_evento', trim($Menu->opcion));
	if(is_object($cartaInscripcion))
	{
		$datos = get_object_vars($Inscripcion);
		foreach($datos as $var => $val)
		{
			if($var == "inicia_rendicion_fecha" && trim($val) != "")
			{
				$val = str_replace(
					array(
						"jornada",
						"tarde",
						"extra",
						"20160519-",
						"20160520-",
						"|",
						"_"
					),
					array(
						" en Jornada",
						"de tarde, de <b>17:00 a 20:00 hrs.</b> (puede llegar m&aacute;ximo hasta las 18:30 hrs.)",
						"",
						"<b>Jueves 19 de mayo de 2016</b>",
						"<b>Viernes 20 de mayo de 2016</b>",
						"<br>",
						" "
					),
					$val
				);
			}
			$cartaInscripcion->setVariable($var,$val);
		}
		if(trim($asunto_extra) == '')
		{
			$asunto = 'Registro '.$prefijo_asunto.' Inscripci&oacute;n';
		}
		else
		{
			$asunto = $asunto_extra;
		}
	}
	$e->addTemplate('bloque_envio_exito');
	$e->setVariable('email', $Inscripcion->email);
	Funciones::send_mail(
		$Inscripcion->email,
		$cartaInscripcion->toHtml(),
		$asunto,
		VarSystem::getInfoSystem('email_webmaster'),
		VarSystem::getInfoSystem('email_webmaster')
	);
}
echo $e->toHtml();
?>