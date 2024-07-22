<?php

global $ControlHtml;
$ControlRecursos = new ControlRecursos();
$valoresGet = VarSystem::getGet();
$valores = VarSystem::getPost();

$path_admin = VarSystem::getPathVariables('dir_template');
$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);

$tipos = array(
    /* nuevos tipos 2023 */
    "Ideas",
    "Problemas",
    "@Libros",
    "Sets",
    /* legacy */
    /* legacy */
    "Didactico",
    "Documentos",
    "Dossier",
    "Foco",
    "Guias",
    "Libros@",
    "Multimedia",
    "Podcast"
);

/*
La consulta no especifica un ID.
Se mostrará lista de contenidos.
*/
if(!isset($valoresGet['id']))
{

    $e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_textos_biblioteca.tpl');
    $e->setVariable('page', $valoresGet["page"]);
    $e->setVariable('busca_flag', '5');

    $ControladorDeMenu = new ControladorDeMenu();
    $menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']);

    $_tipo = $valoresGet['buscador_tipo'];

    if(in_array($_tipo, $tipos)) 
	{
        $valores["busqueda_flag"] = 5;
        if ($valores["seteaTipo"] != 1) {
            $valores["busca_tipo"] = $_tipo;
        }
        if (!$valores["pagina"]) {
            $valores["pagina"] = "";
        }
        $e->setVariable('variableBuscador', 'site');
        $valores["buscador_tipo"] = $_tipo;
    } 
	else 
	{
        /** RECURSOS DESTACADOS HOME */
        if ($valores["busqueda_flag"] == '')
        {
            $e->setVariable('variableBuscador', 'home');
            $e->addTemplate('bloque_home_recursos_general');
            $e->addTemplate('bloque_home_recursos_general_pie');
        } else {
            $e->setVariable('variableBuscador', 'site');
        }
        if ($valores["seteaTipo"] != 1 && $valoresGet["busca_palabra"] == "")
        {
            $ControlRecursos = new ControlRecursos();
            $ControlBanner = new ControlBanner();
            //$banner = $ControlBanner->obtenerBannerActivo($idioma);
            // $e->showBlock('bloque_banner_home', $banner);
            $elementos = $ControlRecursos->obtenerRecursosHomeCIAE();
            if(is_array($elementos) && count($elementos) > 0)
            {
                $max_recursos = count($elementos);
                for($i = 0; $i < $max_recursos; $i++)
                {
                    $e->addTemplate('bloque_home_recursos');
                    if($i == 0) {
                        $e->addTemplate('bloque_home_recursos_uno');
                    } else if($i == 1 || $i == 6) {
                        $e->addTemplate('bloque_home_recursos_dos');
                    } else {
                        $e->addTemplate('bloque_home_recursos_generico');
                    }
                    if(trim($elementos[$i]['imagen']) == '')  {
                        $elementos[$i]['imagen'] = 'blanco.jpg';
                    }
                    $elementos[$i]['fecha_html_full'] = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
                    $e->showDataSimple($elementos[$i]);
                }
            }
        }
    }

    /*-----------------BUSCADOR ---------------*/
    if (($valores["busqueda_flag"] > 0) || ($valoresGet["busqueda_flag"] > 0))
    {
        if(!$valores && $valoresGet["busca_palabra"] != "") {
            $valores["busca_palabra"] = $valoresGet["busca_palabra"];
        }
        if($valoresGet["busca_Autor"] != "") {
            $valores["busca_Autor"] = $valoresGet["busca_Autor"];
        }
        if($valoresGet["busca_tipoPublica"] != "") {
            $valores["busca_tipoPublica"] = $valoresGet["busca_tipoPublica"];
        }
        if($valoresGet["busca_Autor_id"] != "") {
            $valores["busca_Autor_id"] = $valoresGet["busca_Autor_id"];
        }
        if($valores["busqueda_flag"] == "") {
            $valores["busqueda_flag"] = $valoresGet["busqueda_flag"];
        }
        $tipoBusqueda	= $valores["busqueda_flag"];
        $ControlRecursos = new ControlRecursos();

        $_buscador_tipo = $valores["buscador_tipo"];
        if(in_array($_buscador_tipo, $tipos)) {
            unset($valores["busca_tipo"]);
            $valores["busca_tipo_estructura_combinada"] = $valores["buscador_tipo"];
        }
        /* arrays $val_buscar y $val_qry_busca deben estar ordenados de forma correspondiente 1 a 1 */
        $val_buscar = array("Autor", "word|palabra", "simple|Autor_id", "tipo_estructura_combinada");
        /* campos de la base de datos */
        $val_qry_busca= array("autor", "palabra", "id_persona", "rec.tipo_estructura_combinada");
        $valoresBusqueda = array_combine($val_buscar, $val_qry_busca);
        /* valores que traemos de vuelta con el select */
        $valBusquedaPalabra = array("rec.titulo", "rec.bajada");
        list(
                $listado,
                $inicio,
                $final,
                $numPags
            ) = $ControlHtml->MantenedoresGeneral->buscardorGeneral(
                $valores,
                $ControlRecursos,
                $tipoBusqueda,
                0,
                $valoresBusqueda,
                $valBusquedaPalabra
            );
        foreach($valores as $var => $val)
        {
            $e->addTemplate('bloque_asignacion_valores_formulario');
            $e->setVariable('variable', $var);
            $e->setVariable('valor', $val);
        }
    }
    $total = count($listado);
    if(is_array($listado) && $total > 0)
    {
        $listado = ControladorFechas::traducirMes($listado, 'en-es');
        $listado = ControladorFechas::transformarFechaHTML($listado);
        if(is_array($listado) && $total > 0)
        {
            $e->addTemplate('bloque_elemento_general');
            if ($valores["buscador_tipo"] == "Dossier") 
			{
                $e->showBlock('bloque_elemento_dossier', $listado);
            } 
			else 
			{
                for($i = 0; $i < $total; $i++)
                {
                    if($listado[$i]['imagen'] != '') {
                        $e->addTemplate('bloque_imagen_listado_recurso');
                    } else {
                        $e->addTemplate('bloque_elemento');
                    }
                    $e->showDataSimple($listado[$i]);
                }
            }
        }
        /*---------  Paginacion   ---------------------*/
        $e->addTemplate('bloque_elemento_paginacion');
        $recurso = 'recurso';
        $e->setVariable(
            'enlacePie',
            $ControlHtml->FormGeneral->paginamientoListado(
                $pagina,
                $inicio,
                $final,
                $numPags,
                $recurso
            )
        );
        /*--------- Fin Paginacion   -----------------*/
        $e->addTemplate('bloque_valores_busqueda');
        if ($valores["buscador_tipo"] == 'Multimedia') {
            $valores["buscador_tipo"] = 'Video';
        }
        $e->setVariable('buscador_tipo', $valores["buscador_tipo"]);
        $e->setVariable('busca_palabra', $valores["busca_palabra"]);
    } else {
        if (($valores["busqueda_flag"] > 0) || ($valoresGet["busqueda_flag"] > 0)) {
            $e->addTemplate('bloque_no_elemento');
            $e->setVariable('langSite_general_no_hay_elementos','No se encontraron elementos');
        }
    }
} else {
    /** MOSTRAR ELEMENTOS */
    $e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'biblioteca_ficha.tpl');
    $e->setVariable('url_site', VarConfig::path_site_www);
    $e->setVariable('url_site_encode', Funciones::cleanCharURL(VarConfig::path_site_www));
    $e->setVariable('url_encode', Funciones::cleanCharURL('&'));
    $e->setVariable('page', $valoresGet["page"]);
    $e->setVariable('busca_flag', '5');

    $elemento = $ControlRecursos->obtenerRecurso($valoresGet['id']);
    $_elemento = current($elemento);

    Funciones::mostrarArreglo($_elemento,false,"elementos recurso");
    if(is_array($elemento) && count($elemento) > 0)
    {

        if ($_elemento['tipo'] == '@Libros'   || $_elemento['tipo'] == 'Libros@' || ($_elemento['tipo'] == 'Didactico' && $_elemento['libro_digital'] != ''))
        {

            $e->addTemplate('bloque_elemento_general_libro');
            $e->setVariable('div2', 'col-12 col-md-5 col-lg-3 mb-4 mb-md-0 img-libro');
             if(trim($_elemento['imagen']) != '')	{
                 $_elemento['imagen1'] = $_elemento['imagen'];
             }
        } else if ($_elemento['tipo'] == 'Multimedia' || ($_elemento['tipo'] == 'Didactico' && $_elemento['video'] != '') ) {
            if ($_elemento['video_lista'] != '') {
                $_elemento['video'] = $_elemento['video_lista'];
            }
            $e->addTemplate('bloque_elemento_general_multimedia');
        } else if ($_elemento['tipo'] == 'Didactico' && ($_elemento['iframe'] != '' || $_elemento['link_externo'] != '')) {
            $e->addTemplate('bloque_elemento_general_interactivo');
            $interactivo = 'true';
        } else if ($_elemento['tipo'] == 'Documentos' || ($_elemento['tipo'] == 'Didactico' && ($_elemento['iframe'] == '' || $_elemento['link_externo'] == ''))) {
            $_elemento['archivo2']=$_elemento['archivo'];
            $e->addTemplate('bloque_elemento_general_documento');
            $e->setVariable('div2','imagen-documento');
            if(trim($_elemento['imagen']) != '') {
                $_elemento['imagen2']	= $_elemento['imagen'];
            }
        } else if (in_array($_elemento['tipo'], array('Ideas', 'Foco', 'Problemas', 'Sets'))) {
            $e->addTemplate('bloque_elemento_general_foco');
            if(trim($_elemento['imagen']) != '') {
                $_elemento['foto3'] = $_elemento['imagen'];
            }
        } else if ($_elemento['tipo'] == 'Guias'){
            $e->addTemplate('bloque_elemento_general_guia');
            $e->setVariable('div2', 'imagen-documento');
            if(trim($_elemento['imagen']) != '') {
                $_elemento['foto4'] = $_elemento['imagen'];
            }
        }
        elseif($_elemento['tipo'] == 'Dossier')
        {
            $e->addTemplate('bloque_elemento_general_dossier');
            $e->setVariable('div2', 'col-12 col-md-5 col-lg-3 mb-4 mb-md-0 img-libro');
            if(trim($_elemento['imagen']) != '') {
                $_elemento['imagen1']	= $_elemento['imagen'];
            }
            if(trim($_elemento['imagen']) != '') {
                $_elemento['foto3']	= $_elemento['imagen'];
            }
            if(trim($_elemento['imagen']) != '') {
                $_elemento['foto4']	= $_elemento['imagen'];
            }
            if(trim($_elemento['imagen']) != '') {
                $_elemento['imagen2']	= $_elemento['imagen'];
            }
        }
        else{


            $e->addTemplate('bloque_elemento_general_documento');
        }



        $ControlHtml->laPagina->setTitleSite($_elemento['titulo']);
        $ControlHtml->laPagina->setDescriptionSite($_elemento['bajada']);
        $ControlHtml->laPagina->setImagenFondo('imageview.php?image=recursos/'.$_elemento['imagen']);
        $_elemento['titulo'] = Funciones::limpiarSaltoLinea($_elemento['titulo']);
        $_elemento['fecha_html_full'] = ControladorFechas::traducirMes($_elemento['fecha_html_full'],'en-es');
        $e->setVariable('title_encode', Funciones::cleanCharURL($_elemento['titulo']." :: ".VarConfig::site_title));
        $e->setVariable('titulo_encode', Funciones::cleanCharURL($_elemento['titulo'])); //." :: ".VarConfig::site_title));
        $e->setVariable('bajada_encode', Funciones::cleanCharURL($_elemento['bajada']));
        $e->setVariable('imagen_decode', Funciones::cleanCharURL($_elemento['imagen']));
        $e->showDataSimple($_elemento);
        if(trim($_elemento['bajada']) != '') {
            $e->addTemplate('bloque_elemento_bajada');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['url']) != '') {
            $e->addTemplate('bloque_elemento_principal');
        }
        if(trim($_elemento['url']) != '') {
            $e->addTemplate('bloque_elemento_principal');
            $e->addTemplate('bloque_elemento_url');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['archivo2']) != '') {
            $e->addTemplate('bloque_elemento_documentos');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['archivo']) != '') {
            $e->addTemplate('bloque_elemento_archivos');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['link_externo']) != '' && trim($_elemento['tipo']) == 'Didactico') {
            $e->addTemplate('bloque_elemento_link_interactivo');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['link_externo']) != '' && trim($_elemento['tipo']) == 'Guias') {
            $e->addTemplate('bloque_elemento_link_externo_guia');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['link_externo']) != '') {
            $e->addTemplate('bloque_elemento_link_externo');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['libro_digital']) != '') {
            $e->addTemplate('bloque_elemento_libro_digital');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['imagen1']) != '') {
            $e->addTemplate('bloque_elemento_imagen');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['imagen2']) != '') {
            $e->addTemplate('bloque_elemento_imagen2');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['foto3']) != '') {
            $e->addTemplate('bloque_elemento_imagen3');
            $e->showDataSimple($_elemento);
        }
        if(trim($_elemento['foto4']) != '') {
            $e->addTemplate('bloque_elemento_imagen4');
            $e->showDataSimple($_elemento);
        }
        $ControlNoticiasLink = new ControlNoticiasLink();
        $link = $ControlNoticiasLink->obtenerLinks($valoresGet['id']);
        $total = count($link);
        Funciones::mostrarArreglo($link);
        if(is_array($link) && $total > 0)
        {
            $e->addTemplate('bloque_elemento_principal');
            for($k = 0; $k < $total; $k++)
            {
                $aux = str_replace('http:', '', trim($link[$k]['link']));
                $aux2 = str_replace('https:', '', trim($link[$k]['link']));
                if($aux == trim($link[$k]['link']) && $aux2 == trim($link[$k]['link'])) {
                    $link[$k]['tipo'] = 'doc';
                }
                $e->addTemplate('bloque_elemento_'.$link[$k]['tipo']);
                $e->showDataSimple($link[$k]);
            }
        }
        if($_elemento['tiene_galeria'] == 1)
        {
            $dir = VarSystem::getPathVariables('dir_repositorio')."image/noticias/".$valoresGet['id'];
            if(is_dir($dir))
            {
                $imagenes = Funciones::obtenerListaArchivos($dir);
                if(is_array($imagenes) && count($imagenes) > 0)
                {
                    $listar_fila = VarSystem::getTotalListarGaleria();
                    $por_fila = 0;
                    $e->addTemplate('bloque_elemento_galeria');
                    foreach($imagenes as $var => $val)
                    {
                        if(trim($var) == '.svn' || trim($var) == 'index.php' || trim($var) == 'Thumbs.db') {
                            continue;
                        }
                        $e->addTemplate('bloque_elemento_galeria_td');
                        $e->setVariable('imagen', $var);
                        $e->setVariable('id', $valoresGet['id']);
                    }
                }
            }
        }
        if($_elemento['palabra_clave'] != '')
        {
            $e->addTemplate('bloque_palabra_clave_general');
            $valores = $_elemento['palabra_clave'];
            $valor = explode(',' ,$valores);
            for ($i = 0; $i < count($valor); $i++)
            {
                if($valor[$i]!='')
                {
                    $e->addTemplate('bloque_palabra_clave');
                    $e->setVariable('page',$valoresGet["page"]);
                    $e->setVariable('busca_flag', '2');
                    $e->setVariable('palabra',$valor[$i]);
                }
            }
        }
        $elementos = $ControlRecursos->obtenerRecursosRecientes();
        if(is_array($elementos) && count($elementos) > 0)
        {
            $e->addTemplate('bloque_noticia_reciente');
            $max_recursos = count($elementos);
            for($i = 0; $i < $max_recursos; $i++)
            {
                $e->addTemplate('bloque_noticia');
                if(trim($elementos[$i]['imagen']) == '') {
                    $elementos[$i]['imagen'] = 'blanco.jpg';
                }
                $elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
                $e->showDataSimple($elementos[$i]);
            }
        }
        /** SE GUARDA LA VISITA */
        $NoticiasVisitas = new NoticiasVisitas();
        $NoticiasVisitas->id_noticia = $valoresGet['id'];
        $NoticiasVisitas->tipo_visita = 'local';
        if(isset($valoresGet['externo']) && trim($valoresGet['externo']) != '') {
            $NoticiasVisitas->tipo_visita = $valoresGet['externo'];
        }
        $NoticiasVisitas->agregarVisita();
    }
    else
    {
        $e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'404.tpl');
    }
}

/* VIDEOS YOUTUBE */
/* el id tipo es propio del sitio */
$e = $ControlGeneralSitios->mostrarVideosRecursos($e);
$e = $ControlGeneralSitios->mostrarGifInformativoCIAE($e);

/** EVENTOS NOTICIAS */
$ControlNoticias = new ControlNoticias();
$elementos = $ControlNoticias->obtenerEventosHome('ASC');
$max_eventos = count($elementos);
if(is_array($elementos) && $max_eventos > 0)
{
    $e->addTemplate('bloque_home_palabras');
    $e->setVariable('page', $valoresGet["page"]);
    $e->setVariable('busca_flag', '2');
    //$e->addTemplate('bloque_home_eventos_general');
    $max = count($elementos);
    for($i = 0; $i < $max; $i++)
    {
      $e->addTemplate('bloque_home_eventos');
      $elementos[$i]['fecha_completa'] = ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
      $elementos[$i]['mes'] = ControladorFechas::entregarMesAbrev($elementos[$i]['fecha_html_full'],'en-es');
      $elementos[$i]['dia'] = ControladorFechas::entregarDia($elementos[$i]['fecha_html_full']);
      $e->showDataSimple($elementos[$i]);
    }
}
if(VarSystem::obtenerIdiomaActual() == 'es')
{
    /** PUBLICACIONES HOME */
    $ControlPublicaciones = new ControlPublicaciones();
    $ControlPublicacionesPersona = new ControlPublicacionesPersona();
    $publicaciones = $ControlPublicaciones->obtenerListadoHomeRecursos();
    if(is_array($publicaciones) && count($publicaciones) > 0)
    {
        $e->addTemplate('bloque_home_publicaciones_general');
        $max = count($publicaciones);
        for($i = 0; $i < $max; $i++)
        {
            $e->addTemplate('bloque_home_publicaciones');
            $e->showDataSimple($publicaciones[$i]);
        }
    }
}
$elementos = $ControlNoticias->obtenerNoticiasDestacadaForzada();
if(is_array($elementos) && count($elementos) > 0)
{
    $e->addTemplate('bloque_noticia_visitada');
    $max_noticias = count($elementos);
    for($i = 0; $i < $max_noticias; $i++)
    {
        $e->addTemplate('bloque_visitada');
        if(trim($elementos[$i]['imagen']) == '') {
            $elementos[$i]['imagen'] = 'blanco.jpg';
        }
        $elementos[$i]['fecha_html_full'] = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
        $e->showDataSimple($elementos[$i]);
    }
}
$e =  $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'noticias','2',$valoresGet["page"]);
echo $e->toHtml();
?>
