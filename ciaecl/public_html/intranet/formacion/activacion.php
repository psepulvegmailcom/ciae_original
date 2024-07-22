<?php
 session_start();	

 include ("conexion.php");
 include ("rules.php");
 
$id_tema = $_GET["id_tema"];
$id_archivo = $_GET["id_archivo"];
$id_comentario = $_GET["id_comentario"];
$estado = $_GET["estado"];
$flag = $_GET["flag"];

if(isset($id_tema)&& isset($estado)&&($flag==1)){
   $funcionActivacion = new rules();
   if($estado==0){  //cambiar a desactivado
     $sql = $funcionActivacion->setActivacion($conn, "1", $id_tema);
	 if($sql){ $msg= $sql;}
	 else { $msg= "Se ha cambiado el estado del Tema a 'Público'";}
   }
   else{  //cambiar a publico
     $sql = $funcionActivacion->setActivacion($conn, "0", $id_tema);
	 if($sql){ $msg= $sql;}
	 else { $msg= "Se ha cambiado el estado del Tema a 'Desactivado'";}
   }
} 
else {
 if(isset($id_archivo)&& isset($estado)&&($flag==2)){

   $funcionActivacion = new rules();
   if($estado==0){  //cambiar a desactivado
     $sql = $funcionActivacion->setActivacionFile($conn, "1", $id_archivo);
	 if($sql){ $msg= $sql;}
	 else { $msg= "Se ha cambiado el estado del archivo a 'Público'";}
   }
   else{  //cambiar a publico
     $sql = $funcionActivacion->setActivacionFile($conn, "0", $id_archivo);
	 if($sql){ $msg= $sql;}
	 else { $msg= "Se ha cambiado el estado del archivo a 'Desactivado'";}
   }

 }else{
   if($flag==3){
     $funcionActivacion = new rules();
     if($estado==0){  //cambiar a desactivado
       $sql = $funcionActivacion->setActivacionComentario($conn, "1", $id_comentario); 
 	   if($sql){ $msg= $sql;}
	   else { $msg= "Se ha cambiado el estado del comentario a 'Público'";}
     }
     else{  //cambiar a publico
       $sql = $funcionActivacion->setActivacionComentario($conn, "0", $id_comentario);
	   if($sql){ $msg= $sql;}
	   else { $msg= "Se ha cambiado el estado del comentario a 'Desactivado'";}
     }


  }else{
   if($flag==4){
     $funcionActivacion = new rules();
     if($estado==0){  //cambiar a desactivado
       $sql = $funcionActivacion->setActivacionComentarioTema($conn, "1", $id_comentario); 
 	   if($sql){ $msg= $sql;}
	   else { $msg= "Se ha cambiado el estado del comentario a 'Público'";}
     }
     else{  //cambiar a publico
       $sql = $funcionActivacion->setActivacionComentarioTema($conn, "0", $id_comentario);
	   if($sql){ $msg= $sql;}
	   else { $msg= "Se ha cambiado el estado del comentario a 'Desactivado'";}
     }


  }
  else{
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
              <th scope="col"><input name="BTcancelar" type="button" class="botones" id="BTcancelar" value="Volver"  onclick="javascript:window.location='<?php if($flag=="1") echo "temas.php"; else if(($flag=="2")||($flag=="4")) echo $_SESSION["link_archivos"]; else if($flag=="3") echo $_SESSION["link_detalle"];   ?>'"></th>
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