<?php
/**/
global $ControlHtml;
$ControlNoticias = new ControlNoticias();
$valoresGet = VarSystem::getGet();
$valores = VarSystem::getPost();
$id = $valoresGet['id'];
$tipo_curso = $valoresGet['tipo_curso'];
$path_admin = VarSystem::getPathVariables('dir_template');
$ControlGeneralSitios = new ControlGeneralSitios($path_admin, $ControlHtml);
$tpl = "preguntas_frecuentes.tpl";
if($valoresGet['id'] == '2605')
{
    $tpl = "preguntas_frecuentes_indagacion.tpl";
}
$tpl = "preguntas_frecuentes_indagacion.tpl";
$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').$tpl);
$ControlNoticias->sinFiltroIdioma();
$e->setVariable('mt', 'mt-0');
$e->setVariable('organizadores_evento', 'postgrado@ie.uchile.cl');
$tipo_noticia ='magister';
$elemento = $ControlNoticias->obtenerElemento($valoresGet['id']);
if(is_array($elemento) && count($elemento) > 0)
{
    $ControlHtml->laPagina->setTitleSite($elemento[0]['titulo']);
    $ControlHtml->laPagina->setDescriptionSite($elemento[0]['bajada']);
    $ControlHtml->laPagina->setImagenFondo('imageview.php?image=noticias/'.$elemento[0]['imagen']);
    $elemento[0]['titulo'] = Funciones::limpiarSaltoLinea($elemento[0]['titulo']);
    $elemento[0]['fecha_html_full']  = ControladorFechas::traducirMes($elemento[0]['fecha_html_full'],'en-es');
    $e->setVariable('title_encode',Funciones::cleanCharURL($elemento[0]['titulo']." :: ".VarConfig::site_title));
    $e->setVariable('titulo_encode' ,Funciones::cleanCharURL($elemento[0]['titulo']));
    $e->setVariable('bajada_encode' ,Funciones::cleanCharURL($elemento[0]['bajada']));
    $e->setVariable('imagen_decode',Funciones::cleanCharURL($elemento[0]['imagen']));
    $elemento[0]['descriptor'] = Funciones::cortar_palabras($elemento[0]['bajada']);
    $e->showDataSimple($elemento[0]);
    if(trim($elemento[0]['bajada']) != '')
    {
        $e->addTemplate('bloque_elemento_bajada');
        $e->showDataSimple($elemento[0]);
    }
    if(trim($elemento[0]['url']) != '')
    {
        $e->addTemplate('bloque_elemento_principal');
    }
    if(trim($elemento[0]['url']) != '')
    {
        $e->addTemplate('bloque_elemento_principal');
        $e->addTemplate('bloque_elemento_url');
        $e->showDataSimple($elemento[0]);
    }
    if(trim($elemento[0]['imagen']) != '' || trim($elemento[0]['imagen2']) != '' || trim($elemento[0]['imagen3']) != '')
    {
        $e->addTemplate('bloque_elemento_imagen');
        for($k = 1; $k < 2; $k++)
        {
            $aux = $k;
            if($aux == 1)
            {
                $aux = '';
            }
            if(trim($elemento[0]['imagen'.$aux]) != '')
            {
                $e->addTemplate('bloque_elemento_imagen_detalle');
                if(trim($elemento[0]['imagen'.$aux.'_bajada']) != '')
                {
                    $elemento[0]['imagen'.$aux.'_bajada'] = nl2br("\n\n".strip_tags($elemento[0]['imagen'.$aux.'_bajada']));
                }
                $e->setVariable('imagen_bajada',$elemento[0]['imagen'.$aux.'_bajada']);
                $e->setVariable('imagen',$elemento[0]['imagen'.$aux]);
            }
        }
    }
    $ControlNoticiasPersona = new ControlNoticiasPersona();
    $ControlPersonaObjeto = new ControlPersonaObjeto();
    $personas = $ControlNoticiasPersona->obtenerPersonas($valoresGet['id']);
    $total = count($personas);
    if(is_array($personas) && $total > 0)
    {
        $e->addTemplate('bloque_elemento_personas');
        for($i=0; $i <  $total; $i++)
        {
            $e->addTemplate('bloque_personas');
            if(trim($personas[$i]['imagen']) == '')
            {
                $personas[$i]['imagen'] = 'blanco.jpg';
            }
            $personasSitio = $ControlPersonaObjeto->obtenerDatosIdIE($personas[$i]['id_persona']);
            if($personasSitio[0]['id_site']=='6')
            {
                $personas[$i]['urlIE'] = 'ie';
            }
            else
            {
                $personas[$i]['urlIE'] ='ciae';
            }
            $e->showDataSimple($personas[$i]);
        }

    }
    $ControlNoticiasProfesor = new ControlNoticiasProfesor();
    $ControlProfesorObjeto = new ControlProfesorObjeto();
    $profesores = $ControlNoticiasProfesor->obtenerProfesores($valoresGet['id']);
    $total = count($profesores);
    if(is_array($profesores) && $total > 0)
    {
        $e->addTemplate('bloque_elemento_profesores');
        for($i=0; $i <  $total; $i++)
        {
            $e->addTemplate('bloque_profesores');
            if(trim($profesores[$i]['imagen']) == '')
            {
                $profesores[$i]['imagen'] = 'blanco.jpg';
            }
            $personasSitio = $ControlProfesorObjeto->obtenerDatosIdIE($profesores[$i]['id_persona']);
            if($personasSitio[0]['id_site'] == '6')
            {
                $profesores[$i]['urlIE'] = 'ie';
            }
            else
            {
                $profesores[$i]['urlIE'] ='ciae';
            }
            $e->showDataSimple($profesores[$i]);
        }
    }
    $ControlNoticiasLink = new ControlNoticiasLink();
    $link = $ControlNoticiasLink->obtenerLinks($valoresGet['id']);
    $total = count($link);
    if(is_array($link) && $total > 0)
    {
        $e->addTemplate('bloque_elemento_principal');
        for($k = 0; $k < $total; $k++)
        {
            $aux 	=  str_replace('http:','',trim($link[$k]['link']));
            $aux2 	=  str_replace('https:','',trim($link[$k]['link']));
            if($aux == trim($link[$k]['link']) && $aux2 == trim($link[$k]['link']))
            {
                $link[$k]['tipo'] = 'doc';
            }

            if ($link[$k]['tipo']=='url')
            {
                $link_ciae = substr($link[$k]['link'], 0, 25);
                if ($link_ciae=='http://www.ciae.uchile.cl' &&  ereg('view_inscripcion', $link[$k]['link']) && $link[$k]['id_noticia'] > '1300')
                {
                    $link_generico= substr($link[$k]['link'], 25);
                    $link[$k]['link_ie']='http://www.ie.uchile.cl'.$link_generico;
                }
                else
                {
                    $link[$k]['link_ie']=	$link[$k]['link'];
                }
            }
            $e->addTemplate('bloque_elemento_'.$link[$k]['tipo']);
            $e->showDataSimple($link[$k]);
        }
    }
    if($elemento[0]['tiene_galeria'] == 1)
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
                    if(trim($var) == '.svn' || trim($var) == 'index.php' || trim($var) == 'Thumbs.db')
                    {
                        continue;
                    }
                    $e->addTemplate('bloque_elemento_galeria_td');
                    $e->setVariable('imagen', $var);
                    $e->setVariable('id', $valoresGet['id']);
                }
            }
        }
    }
    if (($valoresGet['page'] == "view_detpostgrados"))
    {
        $e->addTemplate('bloque_elemento_lateral_postgrados_abajo');
        $e->addTemplate('bloque_elemento_lateral_postgrados');
        $e->setVariable('encargado', $elemento[0]['contacto_evento']);
        if($elemento[0]['organizadores_evento'] != '')
        {
            $e->setVariable('organizadores_evento', $elemento[0]['organizadores_evento']);
        }
        else
        {
            $e->setVariable('organizadores_evento', 'postgrado@ie.uchile.cl');
        }
        if($elemento[0]['certificado_evento'] != '')
        {
            $e->addTemplate('bloque_elemento_lateral_brochure');
            $e->setVariable('certificado_evento', $elemento[0]['certificado_evento']);
        }
    }
    else
    {
        $e->addTemplate('bloque_elemento_lateral_noticia');
    }
    if($elemento[0]['palabra_clave'] != '')
    {
        $e->addTemplate('bloque_palabra_clave_general');
        $valores = $elemento[0]['palabra_clave'];
        $valor = explode(',', $valores);
        for ($i=0; $i<6; $i++)
        {
            if($valor[$i]!='')
            {
                $e->addTemplate('bloque_palabra_clave');
                $e->setVariable('page',$valoresGet["page"]);
                $e->setVariable('busca_flag', '2');
                $e->setVariable('palabra', $valor[$i]);
            }
        }
    }
    $elementos = $ControlNoticias->obtenerNoticiasRecientes();
    if(is_array($elementos) && count($elementos) > 0)
    {
        $e->addTemplate('bloque_noticia_reciente');
        $max_noticias = count($elementos);
        for($i = 0; $i < $max_noticias; $i++)
        {
            $e->addTemplate('bloque_noticia');
            if(trim($elementos[$i]['imagen']) == '')
            {
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
    if(isset($valoresGet['externo']) && trim($valoresGet['externo']) != '')
    {
        $NoticiasVisitas->tipo_visita = $valoresGet['externo'];
    }
    $NoticiasVisitas->agregarVisita();
}
echo $e->toHtml();
?>
