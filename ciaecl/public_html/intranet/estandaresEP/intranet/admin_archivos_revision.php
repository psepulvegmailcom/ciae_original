<?	

include ("header.php");
  
 
if(isset($_GET['descarga']))
{
	$funcionBusqueda = new rules();
 	switch($_GET['descarga'])
 	{ 
		case 'listado_usuarios':
			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_revision_usuarios');
			$output = mysql_fetch_full_result_array($sql); 
		break; 
		case  'listado_comentarios_dominio':
			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_revision_comentarios_dominio');
			$output = mysql_fetch_full_result_array($sql); 
		break;
		case 'listado_comentarios_estandar':
			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_revision_comentarios_estandar');
			$output = mysql_fetch_full_result_array($sql); 
		break; 
		case  'listado_comentarios_indicador':
			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_revision_comentarios_indicador');
			$output = mysql_fetch_full_result_array($sql); 
		break; 
		case  'listado_comentarios_ejemplo':
			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_revision_comentarios_ejemplo');
			$output = mysql_fetch_full_result_array($sql); 
		break; 
		case  'listado_comentarios_usuarios':
			$sql = "SELECT 'dominio' AS caso, id_dominio AS id_elemento_caso, dominio as elemento_caso, usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_dominio
UNION SELECT 'estandar' AS caso, id_estandar AS id_elemento_caso, estandar as elemento_caso, usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_estandar
UNION SELECT 'ejemplo' AS caso, id_ejemplo AS id_elemento_caso,ejemplo as elemento_caso, usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_ejemplo
UNION SELECT 'indicador' AS caso, id_indicador AS id_elemento_caso,indicador as elemento_caso, usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_indicador";
			$output = GeneralSQLQuery($sql);
		break; 
		case  'listado_estadisticas' :
			$sql = "SELECT count( id_elemento_caso ) AS total_comentarios, caso, elemento_caso,id_elemento_caso
FROM (

SELECT 'dominio' AS caso, id_dominio AS id_elemento_caso, dominio as elemento_caso, usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_dominio
UNION SELECT 'estandar' AS caso, id_estandar AS id_elemento_caso,estandar as elemento_caso,usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_estandar
UNION SELECT 'ejemplo' AS caso, id_ejemplo AS id_elemento_caso,ejemplo as elemento_caso, usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_ejemplo
UNION SELECT 'indicador' AS caso, id_indicador AS id_elemento_caso,indicador as elemento_caso, usuario, respuesta, fecha_respuesta
FROM view_revision_comentarios_indicador
) AS a
GROUP BY id_elemento_caso, caso ";
		$output = GeneralSQLQuery($sql);
		break;  
 		
 	} 
 	$archivo = GeneralEscribirTablaExcel($output,$campos,$dir); 
}
 

$casos = array('listado_usuarios' => 'Datos ingresados por usuarios', 
'listado_comentarios_dominio' => 'Comentarios por dominios', 
'listado_comentarios_estandar' => 'Comentarios por estándares', 
'listado_comentarios_indicador' => 'Comentarios por indicador', 
'listado_comentarios_ejemplo' => 'Comentarios por ejemplos', 
'listado_comentarios_usuarios' => 'Comentarios por usuarios', 
'listado_estadisticas' => 'Estadística cantidad de comentarios para cada dominio, estandar, indicador y ejemplo');



GeneralImprimirHeader(); 
 
?>
   
<div id="contenido"  >
  <div id="ubica" >
    <ul>
      <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
      <li class="ultimo"><a href="administracion.php" target="_top">Administración</a></li>
      <li class="ultimo">Descargar de reportes sistema de revisión</li>
    </ul>
  </div>
  <!-- fin ruta -->
  <div class="clear"></div>
  <h1>Descargar de reportes sistema de revisión</h1>
    <p>
  <?
  if(trim($archivo) != '')
  {
  	echo "<br><br><a href='bajando.php?archivo=tmp/".$archivo."'><b>DESCARGAR ARCHIVO</b></a><br>";
  }
  ?>
  
  </p>
  <p>&nbsp;</p> 
  <? foreach( $casos as $opcion => $valor)
  {
  	echo '<p><a href="?descarga='.$opcion.'"  >Descargar '.$valor.'</a>&nbsp;&nbsp;</p>';
  }?>
   

  <p>&nbsp;</p>
   
   

<?php 

GeneralImprimirFooter();

?>