<?php
# datos de la consulta
$post_data = json_decode(file_get_contents('php://input'), true);
$name = "data/".$post_data['filename'].".json";
$data = $post_data['filedata'];
// write the file to disk
file_put_contents($name, $data);
?>