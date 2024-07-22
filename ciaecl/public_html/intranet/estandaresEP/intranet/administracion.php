<?	

include ("header.php");  
GeneralImprimirHeader(); 

$e  = new miniTemplate('templates/herramientas/administracion.tpl'); 
$e = GeneralUbicacion($e,'Administración');
echo $e->toHtml();

GeneralImprimirFooter();

?>