<?	

include ("header.php");  
GeneralImprimirHeader(); 

$e  = new miniTemplate('templates/herramientas/administracion.tpl'); 
$e = GeneralUbicacion($e,'Administraci�n');
echo $e->toHtml();

GeneralImprimirFooter();

?>