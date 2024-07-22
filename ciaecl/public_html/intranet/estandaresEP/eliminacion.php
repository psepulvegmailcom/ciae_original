<?php
 session_start();	
 //echo "1->".$_SESSION['id_usuario']."<br>";
 //echo "2->".$_SESSION['per_usuario']."<br>";
// echo "3->".$_SESSION['nom_usuario']."<br>";

 include ("conexion.php");
 include ("rules.php");

 $id_tema = $_GET["id_tema"];
 $id_archivo  = $_GET["id_archivo"];
 $id_comentario  = $_GET["id_comentario"];
 $archivo = $_GET["archivo"];
 $id_usuario_del= $_GET["id_usuario_del"];
 $flag = $_GET["flag"];

 if($flag=="1"){
 if(isset($id_tema)){
   $funcionEliminacion = new rules();
   $sql = $funcionEliminacion->setDeleteTemaArchivos($conn, $id_tema, $ruta, $rutaImg);
   if($sql){ $msg= $sql;}
   else { $msg= "Se ha eliminado el tema y sus archivos con exito <br>";}
  
 } 
 else 
   $msg="Primero Autentifiquese";
}
else{
if($flag=="2"){
   $funcionEliminacion = new rules();
   $sql = $funcionEliminacion->DeleteFile($conn, $id_archivo, $ruta, $id_tema, $archivo);
   
   if($sql){ $msg= $sql;}
   else { $msg= "Se ha eliminado el archivo con exito <br>";}
 } 
 else {
  if($flag=="3"){
    $funcionEliminacion = new rules();
    $sql = $funcionEliminacion->DeleteComentario($conn, $id_comentario);
   
    if($sql){ $msg= $sql;}
    else { $msg= "Se ha eliminado el comentario con exito <br>";}
	 
  }else{
  if($flag=="4"){
    $funcionEliminacion = new rules();
    $sql = $funcionEliminacion->DeleteUsuario($conn, $id_usuario_del);
   
    if($sql){ $msg= $sql;}
    else { $msg= "Se ha eliminado el usuario con exito <br>";}

  }else{ 
   if($flag=="5"){
    $funcionEliminacion = new rules();
    $sql = $funcionEliminacion->DeleteComentarioTema($conn, $id_comentario);
   
    if($sql){ $msg= $sql;}
    else { $msg= "Se ha eliminado el comentario con exito <br>";}
   } 
  else
      $msg="Primero Autentifiquese";
  }
 }
 }  
} 
?>
<link href="estilo.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><div align="left"></div></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col"><table width="431" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Informaci&oacute;n del Sistema </th>
      </tr>
      <tr>
        <td class="celdas_tabla"><div align="justify">
          <blockquote>
            <div align="justify"><?php echo $msg; ?></div>
          </blockquote>
        </div></td>
      </tr>
      <tr>
        <td ><table width="100%" height="20" border="0">
          <tr>
            <th width="29%" scope="col">&nbsp;</th>
                <th scope="col"><input name="BTcancelar" type="button" class="botones" id="BTcancelar" value="Volver"  onclick="document.location.href='<?php if($flag=="1") echo "temas.php"; else if(($flag=="2")||($flag=="5")) echo $_SESSION["link_archivos"]; else if($flag=="3") echo $_SESSION["link_detalle"]; else if($flag=="4") echo "usuarios.php?BTUsuarios=B";  ?>'" /></th>
            <th width="23%" scope="col">&nbsp;</th>
          </tr>
        </table></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
</table>
