<?php
include ("header.php");	 
$e  = new miniTemplate('template/body.tpl');
$contenido  = new miniTemplate('template/page/actividades.tpl');
$e->setVariable('titulo_pagina', "Actividades");
$e->setVariable('contenido', $contenido->toHtml());
echo $e->toHtml(); 
?> 