<?php
$id_usuario = $_SERVER['REMOTE_ADDR'];
// Abre el fichero para obtener el contenido existente
$fichero = 'revision.txt'
$actual = file_get_contents($fichero);

// extraer la condicion que está escrita en el txt
$condicion_actual = intval($actual);
$condicion_nueva = $condicion_actual + 1;

// Añadir cambiar la version actual del archivo txt de revision 
// Escribe el contenido al fichero
//file_put_contents($fichero, strval($condicion_nueva));
file_put_contents($fichero, 'strval($condicion_nueva)');
?>    