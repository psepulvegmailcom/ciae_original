<?php

global $ControlHtml;
$ControlNoticias = new ControlNoticias();
$valoresGet = VarSystem::getGet();
$valores = VarSystem::getPost();

$id = $valoresGet['id'];
$tipo_curso = $valoresGet['tipo_curso'];

$path_admin = VarSystem::getPathVariables('dir_template');
$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);

$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'site/textos/transparencia.tpl');

$meses = array(
	'',
	'Enero',
	'Febrero',
	'Marzo',
	'Abril',
	'Mayo',
	'Junio',
	'Julio',
	'Agosto',
	'Septiembre',
	'Octubre',
	'Noviembre',
	'Diciembre'
);

$meses_num = array(
	'',
	'01',
	'02',
	'03',
	'04',
	'05',
	'06',
	'07',
	'08',
	'09',
	'10',
	'11',
	'12'
);

/* RESOLUCIONES */
$now = new DateTime('now');
// Solo se mostrarán los meses cerrados es decir el mes previo al actual (now).
$now->modify('previous month');
$agno_actual = $now->format('Y');
$mes_actual = $now->format('n');
$ControlResoluciones = new ControlResoluciones();
$mensaje_cero = "Este organismo no ha dictado actos y/o resoluciones que tengan efectos sobre terceros para periodo consultado";
for($agno = $agno_actual; $agno >= 2018; $agno--)
{
	for($i = 12; $i > 0; $i--)
	{
		if($agno == $agno_actual && $i > $mes_actual)
		{
			continue;
		}
		$elementos = $ControlResoluciones->obtenerResolucionesAgnoMes($agno, $meses_num[$i]);
		$e->addTemplate('bloque_transparencia_resoluciones_mes');
		$e->setVariable('agno', $agno);
		$e->setVariable('mesnum', $meses_num[$i]);
		$e->setVariable('mes', $meses[$i]);
		if(is_array($elementos) && count($elementos) > 0)
		{
			$e->setVariable('total', "Ver detalle de <b>".count($elementos)."</b> elementos");
			$e->addTemplate('bloque_transparencia_resoluciones_mes_con');
			for($j = 0; $j < count($elementos); $j++)
			{
				$e->addTemplate('bloque_transparencia_resoluciones_mes_con_item');
				$e->showDataSimple($elementos[$j]);
			}
		}
		else
		{
			$e->setVariable('total', $mensaje_cero);
			$e->addTemplate('bloque_transparencia_resoluciones_mes_sin');
		}
	}
}

/* ACTAS IE */
$ControlActasIE = new ControlActasIE();
$elementos = $ControlActasIE->obtenerActasIE();
if(is_array($elementos) && count($elementos)>0)
{
	for($j = 0; $j < count($elementos); $j++)
	{
		$e->addTemplate('bloque_transparencia_actas_ie');
		$e->showDataSimple($elementos[$j]);
	}
}
echo $e->toHtml();
?>