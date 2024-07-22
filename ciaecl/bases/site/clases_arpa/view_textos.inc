<?php

global $ControlHtml;
$valoresGet = VarSystem::getGet();
$valores = VarSystem::getPost();

/*
die(print_r(array(
	'_get' => $valoresGet,
	'_post' => $valores,
)));
*/

$ControlTextos = new ControlTextos();
$textos = $ControlTextos->obtenerElemento($valoresGet['page']);
$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_textos_planos.tpl');
$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];

$opcion = explode('_', $valoresGet['page']);
unset($opcion[0]);
$opcion = implode('_', $opcion);

// die(print_r($opcion));

if(trim($texto_contenido) == '')
{
	$archivo_texto = VarSystem::getPathVariables('dir_template').'site/textos/'.$opcion.'.tpl';
	
	if(file_exists($archivo_texto))
	{
		$f = new miniTemplate($archivo_texto);
		$texto_contenido = $f->toHtml();
	}
}

$e->setVariable('texto_contenido', $texto_contenido);
$e->setVariable('caso', $valoresGet['page']);
$Menu = new Menu();
$Menu->getOpcion($valoresGet['page']);
$titulo = 'titulo_'.$ControlHtml->langSite;

$e->setVariable('descripcion', stripcslashes($Menu->$titulo));

$aux = explode('_', $ControlHtml->lastActionArray[0]);
$clave = end($aux);
$e->setVariable('clave', $clave);

$e->setVariable('variableMenu','pt-0');
$e->setVariable('descripcion', stripcslashes($Menu->$titulo));

$_page = $valoresGet['page'];

if (in_array($_page, array(
	"view_areas_arpa",
	"view_colaboradores_arpa",
	"view_descripcion" ,
	"view_quienes_arpa"
)))
{
	$e->addTemplate('bloque_banner_portada_quienes_ie');
	$e->setVariable('titulo', $Menu->titulo_es);
	$e->addTemplate('bloque_elemento_lateral_qs');
}
elseif (in_array($_page, array(
	"view_areas_arpa_ciencias_naturales",
	"view_areas_arpa_ciencias_sociales",
	"view_areas_arpa_lenguaje",
	"view_areas_arpa_matematicas"
)))
{
	$e->addTemplate('bloque_banner_portada_areas');
	$e->setVariable('titulo', $Menu->titulo_es);
	$e->setVariable('area_opcion', $opcion);
	$e->addTemplate('bloque_elemento_lateral_qs');
}
elseif (in_array($_page, array(
	"view_desarrollo_profesional",
	"view_diplomados_arpa",
	"view_propuestas_formativas",
	"view_propuestas_vinculacion"
)))
{
	$e->addTemplate('bloque_banner_portada_desarrollo');
	$e->setVariable('titulo', $Menu->titulo_es);
	$e->setVariable('area_opcion', $opcion);
	$e->addTemplate('bloque_elemento_lateral_desarrollo_profesional');
}
elseif (in_array($_page, array(
	"view_investigacion",
	"view_descripcion_investigacion",
	"view_proyectos_arpa",
	"view_publicaciones_arpa",
	"view_red_arpa"
)))
{
	$e->addTemplate('bloque_banner_portada_investigacion');
	$e->setVariable('titulo', $Menu->titulo_es);
	$e->setVariable('area_opcion', $opcion);
	$e->addTemplate('bloque_elemento_lateral_investigacion');
}
else
{
	$e->addTemplate('bloque_banner_simple');
	$e->addTemplate('bloque_elemento_lateral_qs');
}
echo $e->toHtml();
?>