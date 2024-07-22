<?php
// id del usuario
$id_usuario = $_SERVER['REMOTE_ADDR'];
// Otros id que podrían ser utiles
//$_SERVER['REMOTE_HOST'];
//$_SERVER['REMOTE_PORT'];

// Abre el fichero para obtener el contenido existente
$fichero = 'gente.txt';
$actual = file_get_contents($fichero);

$actual.= ($id_usuario.'***');

// Añadir data $actual al fichero y respuesta con el numero del participante en 
// el archivo consultas.txt 
//$actual .= 'a';
// Escribe el contenido al fichero
file_put_contents($fichero, $actual);
?>      
