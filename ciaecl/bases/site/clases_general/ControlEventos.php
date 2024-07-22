<?php
/********************************************************************************************
			CLASES CONTROLADORES DE EVENTOS CIAE
********************************************************************************************/

class Evento extends EventosInforme
{
	function Evento()
	{
		parent::EventosInforme();
	}
}

class ControlEventoSite extends ControlVistas
{
	function ControlEventoSite()
	{
		parent::ControlVistas();
		$Evento = new Evento();
		$this->key = 'id_evento';
		$this->sourceTable = $Evento->sourceTable;
		$this->order = 'fecha_inicio DESC';
		parent::prepararObjecto();
	}
}

class ControlEvento extends ControlObjetos
{
	var $obj;
	var $idioma = '';
	function ControlEvento()
	{
		parent::ControlObjetos();
		$this->obj = new Evento();
        $this->key = $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
		$this->order = 'id_evento DESC';
	}

	function obtenerEvento($idioma = '', $site)
	{
		$this->order = ' id_evento DESC ';
		return parent::obtenerListado();
	}
}

class ControlGeneralEvento extends ControlGeneral
{
	function ControlGeneralEvento($path_admin, $ControlHtml)
	{
		parent::ControlGeneral($path_admin, $ControlHtml);
		$this->valores = VarSystem::getPost();
		$this->valoresGet = VarSystem::getGet();
		$this->ObjetoClase = new ControlEvento();
		$this->Objeto = new Evento();
		$this->ControlNoticias = new NoticiaObjeto();
		$this->ControlNoticiaSitio = new NoticiaSitio();
		$this->ControlNoticiaLink = new ControlNoticiasLink();
		$this->ControlClase = new ControlEventoSite();
		$this->ObjetoClase = new Evento();
	}
	var $obj;

	function eliminarObjeto()
	{
		$this->ObjetoClase->buscarObjeto($this->valores['id_item']);
		if(trim($this->ObjetoClase->imagen) != '' && file_exists(VarSystem::getPathVariables('dir_repositorio').'doc/noticias/'.$this->ObjetoClase->imagen))
		{
			@unlink(VarSystem::getPathVariables('dir_repositorio').'doc/noticias/'.$this->ObjetoClase->imagen);
		}
		$this->MantenedoresGeneralObjeto->eliminarObjetoSimple($this->ObjetoClase, $this->valores);
        $this->valores['id_item'] = $this->ObjetoClase->id_noticia;
        $this->MantenedoresGeneralObjeto->eliminarObjetoSimple($this->ControlNoticias, $this->valores);
        $this->MantenedoresGeneralObjeto->eliminarObjetoSimple($this->ControlNoticiaSitio, $this->valores);
        $this->ControlNoticiaLink->eliminarElementosNoticia($this->ObjetoClase->id_noticia);
        unlink(VarConfig::path_site_local."seminarios/".$this->ObjetoClase->id_inscripcion.".html");
	}

	function mostrarFormulario()
	{
		$e = new miniTemplate($this->path_admin.'formulario.tpl');
        $e->setVariable('tag_volver', $this->FormGeneral->showVolver($this->lastAction[0]));
        $e->setVariable('opcion_modulo', $this->lastAction[0]);
        $e->setVariable('path_archivo', 'doc/evento/');
        $e->setVariable('boletin_id', $this->valores['id_item']);
		$total_orden = 12;
		$total_agno = Date('Y');
		$listado = $this->ControlHtml->elUsuarioSitios;

		$e->setVariable('caso_form', 'Ingreso');
		if(trim($this->valores['id_item']) != '')
		{
			$e->setVariable('caso_form','Modificaci&oacute;n');
            $e->setVariable('form_evento_editor',$this->FormGeneral->showEditorHTML('evento_edicion'));
			$elemento = $this->ControlObjeto->obtenerElemento($this->valores['id_item']);
			$elemento[0]['fecha_inicio_html'] = ControladorFechas::invertirFecha($elemento[0]['fecha_inicio']);
            $elemento[0]['fecha_termino_html'] = ControladorFechas::invertirFecha($elemento[0]['fecha_termino']);
            $elemento[0]['inscripcion_fecha_cierre_html'] = ControladorFechas::invertirFecha($elemento[0]['inscripcion_fecha_cierre']);
           	$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$elemento[0]);
		}
		else
		{
			$e->setVariable('form_evento_editor',$this->FormGeneral->showEditorHTML('evento_edicion'));
			$elemento[0]['total_asistencia'] = 0;
			$elemento[0]['email'] = 'contacto@ciae.uchile.cl';
			//$elemento[0]['ubicacion'] = 'Centro de Investigaci&oacute;n Avanzada en Educaci&oacute;n, Universidad de Chile. Calle Periodista Jos&eacute; Carrasco Tapia 75, Santiago';
			$elemento[0]['ubicacion'] = 'Online';
			$e = $this->MantenedoresGeneral->mostrarElementoValores($e, $elemento[0]);

			$e->addTemplate('bloque_form_editor');
		}
        //$e->setVariable('programa','');
        //Funciones::mostrarArreglo($this,true);
		return $e;
	}

	function objetoGuardar()
	{
		/* Revision de ingreso de datos */
		// Funciones::mostrarArreglo($this->valores);

        if ($this->valores['id_item'] == '') /*elemento nuevo */
		{
			/* revision en caso de elemento nuevo*/

			$this->valores['form_id_inscripcion'] = trim(str_replace(array(".",",",";"," ","á","é","í","ó","ú","ñ"),array("","","","_","a","e","i","o","u","n"),strtolower($this->valores['form_id_inscripcion'])));

			if(!is_int(substr($this->valores['form_id_inscripcion'],0,1)))
			{
				/* no tiene prefijo de fecha */

				 $fecha_extra            = date("Ymd", strtotime($this->valores['form_fecha_inicio']));
				$this->valores['form_id_inscripcion'] = $fecha_extra."_".$this->valores['form_id_inscripcion'];
			}

			$Menu = new Menu();
			$Menu->getOpcion("view_inscripcion_".$this->valores['form_id_inscripcion']);
			if(isset($Menu->id) && trim($Menu->id) != '')
			{
				/* existe opcion como inscripcion original */
				 $fecha_extra            = date("Ymd", strtotime($this->valores['form_fecha_inicio']));
				 $this->valores['form_id_inscripcion'] = $fecha_extra."_".$this->valores['form_id_inscripcion'];
			}
			if(trim($this->valores['form_fecha_termino']) == '')
			{
				$this->valores['form_fecha_termino'] = $this->valores['form_fecha_inicio'];
			}
			if(trim($this->valores['form_inscripcion_cupos_maximo']) == '')
			{
				$this->valores['form_inscripcion_cupos_maximo'] = 50;
			}
			if(trim($this->valores['form_inscripcion_cupos_maximo']) == '')
			{
				$this->valores['form_inscripcion_cupos_maximo'] = 50;
			}
			if(trim($this->valores['form_total_asistencia']) == '')
			{
				$this->valores['form_total_asistencia'] = 0;
			}

			$this->valores['form_ubicacion_email'] = $this->valores['form_ubicacion'];
			$this->valores['form_date_texto_email'] = $this->valores['form_date_texto'];

			/* fin revision en caso de elemento nuevo*/

             $this->obj = new NoticiaObjeto();
             $this->obj->titulo = $this->valores['form_nombre'];
             $fecha_noticia = date("Y-m-d", strtotime($this->valores['form_fecha_inicio']));
             $this->obj->fecha = $fecha_noticia;
			 $this->obj->noticia = $this->valores['form_programa']."<p><strong>Fecha: </strong>".$this->valores['form_date_texto']."</p>
                                         <p><strong>Lugar: </strong>".$this->valores['form_ubicacion']."</p><p> ".$this->valores['form_costo_texto_extras']."</p><p><strong>Consultas o dudas:</strong>
                                          <a href='mailto:".$this->valores['form_mail']."?subject=Consulta ".$this->valores['form_nombre']."' target='_blank'>contacto@ciae.uchile.cl</a></p>";
             $this->obj->tipo = 'evento';
	         $this->obj->guardarObjeto();
             $id = $this->ControlNoticias->getLastId('id_noticia');

             $NoticiaSitio = new NoticiaSitio();
             $NoticiaSitio->id_noticia = $id;
             $NoticiaSitio->id_site = '100';
             $NoticiaSitio->activo = '0';
             $NoticiaSitio->destacado = '0';
             $NoticiaSitio->destacado_forzado = '0';
             $NoticiaSitio->guardarObjeto();

             $NoticiasLink = new NoticiasLink();
             $NoticiasLink->id_noticia = $id;
             $NoticiasLink->link = "https://www.ciae.uchile.cl/index.php?langSite=es&page=view_inscripcion_".$this->valores['form_id_inscripcion'];
             $NoticiasLink->texto = "Inscripci&oacute;n Aqu&iacute;";
             $NoticiasLink->orden = '1';
             $NoticiasLink->tipo = "url";
             $NoticiasLink->guardarObjeto();

             $Menu = new Menu();
             $Menu->opcion = "view_inscripcion_".$this->valores['form_id_inscripcion'];
             $Menu->tipo_menu = "modulo";
             $Menu->tipo_archivo = "web";
             $Menu->sitio = "ciae_web2.0";
             $Menu->archivo = "view_inscripcion.inc";
             $Menu->publicar = "0";
             $Menu->acceso = "publico";
             $Menu->tipo = "principal";
             $Menu->titulo_es = $this->valores['form_nombre'];
             $Menu->saveObject();
			  
			 $casos = array('online','presencial');
			 
			for($i=0; $i < count($casos);$i++)
			{
				$InscripcionDestinoDetalle = new InscripcionDestinoDetalle();
				$InscripcionDestinoDetalle->caso_envio = $this->valores['form_id_inscripcion']."_".$casos[$i]."_registro";
				$InscripcionDestinoDetalle->estado = 'activo';
				$InscripcionDestinoDetalle->orden_envio = '1';
				$InscripcionDestinoDetalle->asunto = "Registro inscripción ".strtoupper($casos[$i])." - ".$this->valores['form_nombre'];
				$InscripcionDestinoDetalle->tipo_remitente = 'CIAE-IE';
				$InscripcionDestinoDetalle->tipo = 'automatico';
				$InscripcionDestinoDetalle->contenido = '/home/ciae/public_html/correos/templates/generico_registro_'.$casos[$i].'.html';
				$InscripcionDestinoDetalle->reply = $this->valores['email'];
				$InscripcionDestinoDetalle->bcc_1 = 'webmaster@ciae.uchile.cl';
				$InscripcionDestinoDetalle->saveObject();
				$InscripcionDestinoInscripciones = new InscripcionDestinoInscripciones();
				$InscripcionDestinoInscripciones->caso_envio = $InscripcionDestinoDetalle->caso_envio;
				$InscripcionDestinoInscripciones->tipo_inscripcion = $this->valores['form_id_inscripcion'].'_'.$casos[$i];
				$InscripcionDestinoInscripciones->saveObject();
				
				$InscripcionDestinoDetalle = new InscripcionDestinoDetalle();
				$InscripcionDestinoDetalle->caso_envio = $this->valores['form_id_inscripcion']."_".$casos[$i]."_confirmacion";
				$InscripcionDestinoDetalle->estado = 'inactivo';
				$InscripcionDestinoDetalle->orden_envio = '1';
				$InscripcionDestinoDetalle->tipo = 'automatico';
				$InscripcionDestinoDetalle->asunto = "Confirmación participación ".strtoupper($casos[$i])." - ".$this->valores['form_nombre'];
				$InscripcionDestinoDetalle->reply = $this->valores['email'];
				$InscripcionDestinoDetalle->tipo_remitente = 'CIAE-IE';
				$InscripcionDestinoDetalle->bcc_1 = 'webmaster@ciae.uchile.cl';
				$InscripcionDestinoDetalle->contenido = '/home/ciae/public_html/correos/templates/generico_confirmacion_'.$casos[$i].'.html';
				$InscripcionDestinoDetalle->saveObject();
				$InscripcionDestinoInscripciones = new InscripcionDestinoInscripciones();
				$InscripcionDestinoInscripciones->caso_envio = $InscripcionDestinoDetalle->caso_envio;
				$InscripcionDestinoInscripciones->tipo_inscripcion = $this->valores['form_id_inscripcion'].'_'.$casos[$i];
				$InscripcionDestinoInscripciones->saveObject();		
				
				$InscripcionDestinoDetalle = new InscripcionDestinoDetalle();
				$InscripcionDestinoDetalle->caso_envio = $this->valores['form_id_inscripcion']."_".$casos[$i]."_invitacion";
				$InscripcionDestinoDetalle->estado = 'inactivo';
				$InscripcionDestinoDetalle->orden_envio = '3';
				$InscripcionDestinoDetalle->tipo = 'automatico';
				$InscripcionDestinoDetalle->asunto = "Invitación ".$this->valores['form_nombre'];
				$InscripcionDestinoDetalle->reply = $this->valores['email'];
				$InscripcionDestinoDetalle->tipo_remitente = 'CIAE-IE';
				$InscripcionDestinoDetalle->saveObject();
				$InscripcionDestinoInscripciones = new InscripcionDestinoInscripciones();
				$InscripcionDestinoInscripciones->caso_envio = $InscripcionDestinoDetalle->caso_envio;
				$InscripcionDestinoInscripciones->tipo_inscripcion = $this->valores['form_id_inscripcion'].'_'.$casos[$i];
				$InscripcionDestinoInscripciones->saveObject(); 
			}
			 
			 
			 			
			/*
			$InscripcionDestinoDetalle = new InscripcionDestinoDetalle();
			$InscripcionDestinoDetalle->caso_envio = $this->valores['form_id_inscripcion']."_".$casos[$i]."_informacion";
			$InscripcionDestinoDetalle->estado = 'inactivo';
			$InscripcionDestinoDetalle->orden_envio = '1';
			$InscripcionDestinoDetalle->tipo = 'automatico';
			$InscripcionDestinoDetalle->asunto = "Información - ".$this->valores['form_nombre'];
			$InscripcionDestinoDetalle->reply = $this->valores['email'];
			$InscripcionDestinoDetalle->tipo_remitente = 'CIAE-IE';
			$InscripcionDestinoDetalle->contenido = '/home/ciae/public_html/correos/templates/generico_informacion.html';
			$InscripcionDestinoDetalle->saveObject();
			$InscripcionDestinoInscripciones = new InscripcionDestinoInscripciones();
			$InscripcionDestinoInscripciones->caso_envio = $InscripcionDestinoDetalle->caso_envio;
			$InscripcionDestinoInscripciones->tipo_inscripcion = $this->valores['form_id_inscripcion'].'_'.$casos[$i];
			$InscripcionDestinoInscripciones->saveObject();	
			 $InscripcionDestinoDetalle = new InscripcionDestinoDetalle();
			 $InscripcionDestinoDetalle->caso_envio = $this->valores['form_id_inscripcion']."_certificado";
			 $InscripcionDestinoDetalle->estado = 'inactivo';
			 $InscripcionDestinoDetalle->orden_envio = '1';
			 $InscripcionDestinoDetalle->tipo = 'automatico';
			 $InscripcionDestinoDetalle->asunto = "Certificado Asistencia - ".$this->valores['form_nombre'];
			 $InscripcionDestinoDetalle->reply = $this->valores['email'];
			 $InscripcionDestinoDetalle->tipo_remitente = 'CIAE-IE';
			 $InscripcionDestinoDetalle->cc_1 = 'contacto@ciae.uchile.cl';
			 $InscripcionDestinoDetalle->contenido = '/home/ciae/public_html/correos/templates/generico_certificado.html';
             $InscripcionDestinoDetalle->saveObject();
			 $InscripcionDestinoInscripciones = new InscripcionDestinoInscripciones();
			 $InscripcionDestinoInscripciones->caso_envio = $InscripcionDestinoDetalle->caso_envio;
			 $InscripcionDestinoInscripciones->tipo_inscripcion = $this->valores['form_id_inscripcion'];
             $InscripcionDestinoInscripciones->saveObject();
			 */
			 
			 
			 
			 
             $ControlMenuPermiso = new ControlMenuPermiso();
             $ControlMenuPermiso->crearNuevoMenuPermiso($Menu->id, '0');
             $Menu = new Menu();
             $Menu->opcion = "view_inscripcion_".$this->valores['form_id_inscripcion'];
             $Menu->tipo_menu = "modulo";
             $Menu->tipo_archivo = "web";
             $Menu->sitio = "web_ie_uchile";
             $Menu->archivo = "view_inscripcion.inc";
             $Menu->publicar = "0";
             $Menu->acceso = "publico";
             $Menu->tipo = "principal";
             $Menu->titulo_es = $this->valores['form_nombre'];
             $Menu->saveObject();
             $ControlMenuPermiso = new ControlMenuPermiso();
             $ControlMenuPermiso->crearNuevoMenuPermiso($Menu->id, '0');
             $Menu = new Menu();
             $Menu->opcion = "view_inscripcion_".$this->valores['form_id_inscripcion'];
             $Menu->tipo_menu = "modulo";
             $Menu->tipo_archivo = "web";
             $Menu->sitio = "web_arpa_uchile";
             $Menu->archivo = "view_inscripcion.inc";
             $Menu->publicar = "0";
             $Menu->acceso = "publico";
             $Menu->tipo = "principal";
             $Menu->titulo_es = $this->valores['form_nombre'];
             $Menu->saveObject();
             $ControlMenuPermiso = new ControlMenuPermiso();
             $ControlMenuPermiso->crearNuevoMenuPermiso($Menu->id, '0');
             $Menu = new Menu();
             $Menu->opcion = "view_certificado_".$this->valores['form_id_inscripcion'];
             $Menu->tipo_menu = "modulo";
             $Menu->tipo_archivo = "web";
             $Menu->sitio = "ciae_web2.0";
             $Menu->archivo = "view_certificado.inc";
             $Menu->publicar = "0";
             $Menu->acceso = "publico";
             $Menu->tipo = "principal";
             $Menu->titulo_es = "Certificado de participaci&oacute;n ".$this->valores['form_nombre'];
             $Menu->saveObject();
             $ControlMenuPermiso = new ControlMenuPermiso();
             $ControlMenuPermiso->crearNuevoMenuPermiso($Menu->id, '0');
             $this->valores['id_item'] = $this->valores['id_evento'];
             $this->valores['form_id_noticia'] = $id;
			if(trim($this->valores['total_asistencia']) == '')
			{
				$this->valores['total_asistencia'] = '0';
			}
		}
		else
		{
			unlink(VarConfig::path_site_local."seminarios/".$this->ObjetoClase->id_inscripcion.".html");
			unlink(VarConfig::path_site_local."inscripcion/".$this->ObjetoClase->id_inscripcion.".html");
			unlink(VarConfig::path_site_local."certificados/".$this->ObjetoClase->id_inscripcion.".html");
			$ListaDeObjetos = $this->ObjetoClase->buscarObjeto($this->valores['id_item']);
			$id = $this->ObjetoClase->id_noticia;
			$NoticiaObjeto = new NoticiaObjeto();
			$NoticiaObjeto->id_noticia = $id;
			$NoticiaObjeto->titulo = $this->valores['form_nombre'];
			$fecha_noticia = date("Y-m-d", strtotime($this->valores['form_fecha_inicio']));
			$NoticiaObjeto->fecha = $fecha_noticia;
			$NoticiaObjeto->noticia = $this->valores['form_programa']."<p><strong>Fecha: </strong>".$this->valores['form_date_texto']."</p>
			                         <p><strong>Lugar: </strong>".$this->valores['form_ubicacion']."</p><p> ".$this->valores['form_costo_texto_extras']."</p><p><strong>Consultas o dudas:</strong>
			                         <a href='mailto:".$this->valores['form_mail']."?subject=Consultas ". $this->valores['form_nombre']."' target='_blank'>contacto@ciae.uchile.cl</a></p>";
			$NoticiaObjeto->newObject = false;
			$NoticiaObjeto->guardarObjeto($id);
			$NoticiaLink = $this->ControlNoticiaLink->obtenerLinks($id);
			$this->obj = new NoticiasLink();
			$id_link = $this->NoticiaLink->id_link;
			$this->obj->link = "https://www.ciae.uchile.cl/index.php?langSite=es&page=view_inscripcion_".$this->valores['form_id_inscripcion'];
			$this->obj->newObject = false;
			$this->obj->guardarObjeto($NoticiaLink[0]['id_link']);
		}
		$nuevoarchivo = fopen(VarConfig::path_site_local."seminarios/".$this->valores['form_id_inscripcion'].".html", "w+");
		fwrite($nuevoarchivo, " <meta HTTP-EQUIV='REFRESH' content='0; url=https://www.ciae.uchile.cl/index.php?page=view_inscripcion_".$this->valores['form_id_inscripcion']."&externo=maillist'>");
		fclose($nuevoarchivo);
		$nuevoarchivo = fopen(VarConfig::path_site_local."inscripcion/".$this->valores['form_id_inscripcion'].".html", "w+");
		fwrite($nuevoarchivo, " <meta HTTP-EQUIV='REFRESH' content='0; url=https://www.ciae.uchile.cl/index.php?page=view_inscripcion_".$this->valores['form_id_inscripcion']."&externo=maillist'>");
		fclose($nuevoarchivo);
		$nuevocertificado = fopen(VarConfig::path_site_local."certificados/".$this->valores['form_id_inscripcion'].".html", "w+");
		fwrite($nuevocertificado, " <meta HTTP-EQUIV='REFRESH' content='0; url=https://www.ciae.uchile.cl/index.php?page=view_certificado_".$this->valores['form_id_inscripcion']."'>");
		fclose($nuevocertificado);
		$this->valores['form_link_inscripcion']  = "https://www.ciae.uchile.cl/index.php?langSite=es&page=view_inscripcion_".$this->valores['form_id_inscripcion'];
		$this->valores['form_inscripcion_opcion_menu'] = "view_inscripcion_".$this->valores['form_id_inscripcion'];
        parent::objetoGuardar();
	}

	function mostrarListado()
	{
	    $this->busquedaMultiSitio = 0;
        $this->arregloCamposBusqueda = array(
			'nombre',
			'fecha_inicio',
			'tipo_evento'
		);
        $this->arregloCamposOrdenar = array(
			array(
				'nombre',
				'Nombre'
			),
			array(
				'fecha_inicio',
				'Fecha Inicio'
			),
			array(
				'tipo_evento',
				'Tipo Evento'
			)
		);
        return parent::mostrarListado();
	}
}
?>