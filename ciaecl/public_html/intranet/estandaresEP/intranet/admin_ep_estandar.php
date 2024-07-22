<?	

include ("header.php");  
GeneralImprimirHeader(); 

$e  = new miniTemplate('templates/estandar/mant_estandar.tpl');  
$link = array(array('url'=>'administracion.php','link'=>'Administración')); 
$e = GeneralUbicacion($e,'Administrar Estándares',$link);

$valores = $_POST;

$funcionBusqueda = new rules();

$version = $funcionBusqueda->EPversion();
print_r($valores);
$e->setVariable('id_version',$version[0]['id_version']);

$dominios = $funcionBusqueda->EPDominios($version[0]['id_version']);
print_r($dominios);

echo $e->toHtml();

GeneralImprimirFooter();

?>