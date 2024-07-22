<?php
// get the q parameter from URL
$q = $_REQUEST["q"];

$id_usuario = $_SERVER['REMOTE_ADDR'];

if ($q == "revision") {
    echo $id_usuario;
} else {
    echo "esto tambien funciona";
}
?> 