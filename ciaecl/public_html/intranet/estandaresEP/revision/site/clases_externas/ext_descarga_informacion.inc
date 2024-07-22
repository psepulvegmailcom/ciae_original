<?php
global $ControlHtml;   

$valores            = VarSystem::getPost();  
$contenido = $valores['contenido'];
$path = VarSystem::getPathVariables('dir_repositorio_tmp');
//$contenido = stripcslashes($contenido);

echo $contenido;
if($valores['tipo']== 'excel')
{ 
    $archivo = SIDTOOLHtml::escribirExcelTabla($contenido,$path);  
}
else
{
 
}
echo $archivo;
?>