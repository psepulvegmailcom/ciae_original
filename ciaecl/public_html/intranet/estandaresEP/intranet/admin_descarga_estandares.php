<?	

include ("header.php");

GeneralImprimirHeader();   
  
$tablas = array('version' =>'view_revision_version_version','dominio' =>'view_revision_version_dominio','estandar' => 'view_revision_version_estandar','ejemplo'=>'view_revision_version_ejemplo','indicador'=>'view_revision_version_indicador');
 
$e  = new miniTemplate('templates/herramientas/descarga_estandares.tpl'); 
$e = GeneralUbicacion($e,'Descargar versiones de estándares',array(array('url'=> 'administracion.php','link'=> 'Administración')));


$sql = "SELECT * FROM ".$tablas['version']." ORDER BY id_version";
$output = GeneralSQLQuery($sql); 

$e->showBlock('bloque_versiones',$output);

if(isset($_GET['id_version']) && is_numeric($_GET['id_version']))
{ 	 
	$fecha 	= date('YmdHis'); 
	$dirZIP 	= $dirTMP.$fecha;  
 	$zipfile = new zipfile(); 
	$zipfile->add_dir($fecha); 
	
	$id_version = $_GET['id_version'];
	$sql = "SELECT * FROM ".$tablas['version']." WHERE id_version= ".$id_version." ORDER BY id_version";
	$output = GeneralSQLQuery($sql);
	$version = $output[0]['version'];
	
	//DOMINIOS
	$sql = "SELECT * FROM ".$tablas['dominio']." WHERE id_version = ".$id_version;
	$output = GeneralSQLQuery($sql); 
	$contenido = GeneralGenerarTabla($output); 
  	$zipfile->add_file($contenido, $fecha.'/dominio.xls');
  	
  	//ESTANDARES
  	$sql = "SELECT  e.id_estandar, e.estandar	, e.descripcion	,e.orden as orden_estandar, e.id_dominio, d.dominio 
	FROM ".$tablas['dominio']." as d, ".$tablas['estandar']." as e
	WHERE d.id_version = ".$id_version." AND d.id_dominio = e.id_dominio 
	ORDER BY e.id_dominio,e.orden"; 
	$output = GeneralSQLQuery($sql);  
	$contenido = GeneralGenerarTabla($output); 
  	$zipfile->add_file($contenido, $fecha.'/estandar.xls'); 
  	
  	//INDICADORES
  	$sql = "SELECT i.id_indicador ,i.indicador ,i.orden as orden_indicador, i.id_estandar ,e.estandar, e.descripcion, e.orden as orden_estandar, d.dominio,e.id_dominio 	
	FROM ".$tablas['dominio']." as d, ".$tablas['estandar']." as e, ".$tablas['indicador']." as i
	WHERE d.id_version = ".$id_version." AND d.id_dominio = e.id_dominio  AND i.id_estandar = e.id_estandar
	ORDER BY e.id_dominio, e.orden, i.orden"; 
	$output = GeneralSQLQuery($sql);  
	$contenido = GeneralGenerarTabla($output); 
  	$zipfile->add_file($contenido, $fecha.'/indicadores.xls');
  	
  	//EJEMPLOS
  	$sql = "SELECT i.id_ejemplo ,i.ejemplo ,i.orden as orden_ejemplo, i.id_estandar ,e.estandar, e.descripcion,e.orden as orden_estandar, d.dominio,e.id_dominio 	
	FROM ".$tablas['dominio']." as d, ".$tablas['estandar']." as e, ".$tablas['ejemplo']." as i
	WHERE d.id_version = ".$id_version." AND d.id_dominio = e.id_dominio  AND i.id_estandar = e.id_estandar 
	ORDER BY e.id_dominio, e.orden, i.orden";  
	$output = GeneralSQLQuery($sql);  
	$contenido = GeneralGenerarTabla($output); 
  	$zipfile->add_file($contenido, $fecha.'/ejemplos.xls');
  	
  	/* CREACION DE ARCHIVO ZIP */
	$archivo_descarga = $fecha.'_version_'.$id_version.'.zip';
	SIDTOOLHtml::escribirArchivo($dirTMP.'/'.$archivo_descarga,$zipfile->file()); 
	
	$e->addTemplate('bloque_descarga');
	$e->setVariable('archivo',$archivo_descarga);
	 
}


echo $e->toHtml();

GeneralImprimirFooter();

?>