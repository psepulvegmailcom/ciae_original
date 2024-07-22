<?	

include ("header.php");  
 
if(isset($_GET['descarga']))
{
	$funcionBusqueda = new rules();
 	switch($_GET['descarga'])
 	{
 		case 'listado_documentos':
			$tema 	= 30; 
			$sql = $funcionBusqueda->ListarArchivos($conn, $tema, $perfil, $usuario, 0);
 			//print_r($sql);
			$output = mysql_fetch_full_result_array($sql);
			$campos = array('titulo' => 'Documento','bajada' => 'Descripci�n','pais'=>'Pa�s','nom_archivo'=>'Archivo 1','nom_archivo_2'=>'Archivo 2','autor_orig'=>'Autor','ano_re'=>'A�o','firstname'=>'Nombre usuario','lastname'=>'Apellido usuario', 'fec_publicacion'=>'Fecha creaci�n','fecha_actualizacion'=> 'Fecha actualizaci�n'); 
 		break;
 		case 'listado_estandares':
			$tema 	= 35; 
			$sql = $funcionBusqueda->ListarArchivos($conn, $tema, $perfil, $usuario, 0);
 			//print_r($sql);
			$output = mysql_fetch_full_result_array($sql);
			$campos = array('dominio'=> 'Dominio','titulo' => 'N�mero de Est�ndar','bajada' => 'Descripci�n de Est�ndar','definicion' => 'Definici�n de Est�ndar', 'autor_orig'=>'Autor','ano_re'=>'A�o','firstname'=>'Nombre usuario','lastname'=>'Apellido usuario', 'fec_publicacion'=>'Fecha creaci�n','fecha_actualizacion'=> 'Fecha actualizaci�n'); 
 		break; 
 		case 'listado_usuarios':
 			$sql = $funcionBusqueda->ListarUsuariosCompleto($conn); 
			$output = mysql_fetch_full_result_array($sql); 
			$campos = array('id_usuario' =>'id_usuario'	,'firstname'=> 'Nombre','lastname' => 'Apellido','username' => 'Nombre de usuario','email' => 'email', 'last_login'=> 'ultima fecha de ingreso' ); 
 		break;
 		case 'listado_indicadores':
 			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_estandar_indicador');
			$output = mysql_fetch_full_result_array($sql); 
			$campos = array('dominio'=> 'Dominio','titulo' => 'N�mero de Est�ndar','bajada' => 'Descripci�n de Est�ndar', 'indicador'=> 'Indicador' ); 
 		break;
 		case 'listado_ejemplos':
 			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_estandar_ejemplo');
			$output = mysql_fetch_full_result_array($sql); 
			$campos = array('dominio'=> 'Dominio','titulo' => 'N�mero de Est�ndar','bajada' => 'Descripci�n de Est�ndar', 'ejemplo'=> 'Ejemplo' ); 
 		break; 
 		case 'listado_comentarios':
 			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_archivos_comentarios');
			$output = mysql_fetch_full_result_array($sql); 
			$campos = array('documento' => 'Documento','titulo_comentario' => 'Comentario',	'autor_comentario' => 'Autor' ,  	'fecha_comentario' => 'Fecha Comentario'   	 ); 
 		break;
 		case 'listado_historial':
 			$sql = $funcionBusqueda->listarTablaGeneral($conn,'historial');
			$output = mysql_fetch_full_result_array($sql); 
			$campos = array('fecha' => 'Fecha','usuario' => 'Usuario', 'tipo_elemento' => 'Tipo Modificacion',	'texto_original' => 'Texto Original' ,  	'texto_modificado' => 'Texto Modificado'   	 ); 
 		break;
 		case 'listado_comentarios_estandar':
 			$sql = $funcionBusqueda->listarTablaGeneral($conn,'view_archivos_comentarios_estandar');
			$output = mysql_fetch_full_result_array($sql); 
			$campos = array('documento' => 'Documento','tipo_comentario' => 'Tipo comentario', 'titulo_comentario' => 'Comentario',	'autor_comentario' => 'Autor' ,  	'fecha_comentario' => 'Fecha Comentario'   	 ); 
 		break;
 	} 
 	$archivo = GeneralEscribirTablaExcel($output,$campos,$dir); 
}

$casos = array('listado_documentos' => 'listado de documentos', 
'listado_comentarios' => 'listado de comentarios de documentos',
'listado_usuarios' => 'listado de estado usuarios',
'listado_estandares' => 'listado est�ndares',
'listado_indicadores' => 'listado de indicadores de est�ndares',
'listado_ejemplos' => 'listado de ejemplos de est�ndares',
'listado_comentarios_estandar' => 'listado de comentarios de est�ndares, indicadores y ejemplos',
'listado_historial' => 'Historial Cambios');
GeneralImprimirHeader(); 
 
?>
   
<div id="contenido"  >
  <div id="ubica" >
    <ul>
      <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
      <li class="ultimo"><a href="administracion.php" target="_top">Administraci�n</a></li>
      <li class="ultimo">Descargar de reportes sistema de definici�n</li>
    </ul>
  </div>
  <!-- fin ruta -->
  <div class="clear"></div>
  <h1>Descargar de reportes sistema de definici�n</h1>
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