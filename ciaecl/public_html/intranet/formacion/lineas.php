<?php
include ("header.php");	 
$e  = new miniTemplate('template/body.tpl');
$contenido  = new miniTemplate('template/page/descripcion.tpl');
$e->setVariable('titulo_pagina', "Descripci�n");
$e->setVariable('contenido', $contenido->toHtml());
echo $e->toHtml(); 
?> 