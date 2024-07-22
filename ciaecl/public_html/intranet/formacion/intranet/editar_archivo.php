<?php
include ("../conexion.php");
include ("../rules.php");
session_start();

if(isset($_POST["BTActualizar"])){
  $dir="$ruta";
  $id_archivo = $_POST["id_archivo"];
  $titulo = $_POST["titulo"];
  $autor = $_POST["id_autor"];
  $pais = $_POST["pais"];
  $fecha = $_POST["fecha"];
  $estado = $_POST["estado"];
  $tipo_archivo=$_POST["tipo_archivo"];
  if($_POST["comentario"]==1) $comentario = 1; else $comentario=0;
  $bajada = $_POST["bajada"];
  $archivo = $HTTP_POST_FILES['archivo']['name'];
  $archivo2 = $_POST["archivo2"];
  $id_tema = $_POST["id_tema"];
  $ids_temas = $_POST["temas2"];

  if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) {
      if($HTTP_POST_FILES['archivo']['size'] <= $peso_max) {
         $funcionAgrega = new rules();
         $resp = $funcionAgrega->Editarchivo($conn,$id_archivo,$tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$ids_temas,$dir);
         $file = "$ruta/$archivo2";
         unlink($file);
		 copy($HTTP_POST_FILES['archivo']['tmp_name'], "$dir/".$HTTP_POST_FILES['archivo']['name']);
       }
     else{
        $peso = $peso_max/1024;
	    echo $resp = "Lo siento, se permite maximo ".$peso."KB en los archivos a subir";
     }	   
	}
	else{
      $funcionAgrega = new rules();
      $resp = $funcionAgrega->Editarchivo($conn,$id_archivo,$tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo2,$ids_temas,$dir);
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
    <th scope="col">
    <table width="431" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Informaci&oacute;n del Sistema </th>
      </tr>
      <tr>
        <td class="celdas_tabla"><div align="justify">
          <blockquote>
            <div align="justify"><?php echo $resp; ?></div>
          </blockquote>
        </div></td>
      </tr>
      <tr>
        <td ><table width="100%" height="20" border="0">
          <tr>
            <th width="29%" scope="col">&nbsp;</th>

              <th scope="col"><input name="BTcancelar2" type="button" class="botones" id="BTcancelar2" value="Volver" onclick="javascript:window.location='<?php echo $_SESSION["link_archivos"]; ?>'" ></th>
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
<?php
}else{
?>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../script.js"></script>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><div align="left"></div></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col"><form name="feditaarchivo" target="fprincipal" action="editar_archivo.php" method="post" onSubmit="return fValidaEditArchivo(this, '¿Esta seguro de modificar la información del Archivo?');" enctype="multipart/form-data">
	<table width="750" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Editar Archivo </th>
        </tr>
      <tr>
        <td class="celdas_tabla"><table width="100%" border="0">
          <tr>
            <th width="1%" scope="col">&nbsp;</th>
            <th width="23%" scope="col">&nbsp;</th>
            <th width="38%" scope="col">&nbsp;</th>
            <th width="4%" scope="col">&nbsp;</th>
            <th width="33%" scope="col">&nbsp;</th>
            <th width="1%" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Titulo</td>
            <td><label>
              <input name="titulo" type="text" id="titulo" value="<?php echo $_POST["titulo"]; ?>" size="42">
            </label></td>
            <td>&nbsp;</td>
            <td><span class="texto_libre">Temas Disponibles </span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Tipo de Archivo </td>
            <td><span class="titulos">
              <select name="tipo_archivo" id="tipo_archivo">
                <?php
			  $sql2 = mysql_query("select * from tipos_archivos",$conn);
			  while ($id = mysql_fetch_array($sql2)) { 
			 ?>
                <option value="<?php echo $id["id_tipoarchivo"];?>" <?php if($id["id_tipoarchivo"]==$_POST["id_tipoarchivo"]) echo "selected"; ?> > <?php echo $id["tipo_archivo"]; ?></option>
                <?php
			  }//end while
			  ?>
              </select>
            </span></td>
            <td rowspan="4">&nbsp;</td>
            <td rowspan="4"><?php  if($_SESSION["per_usuario"]=="1"){
			 $sql="select * from tema order by tema";
			?>
              <select name="temas1" id="temas1" size="5" style="width:230px" >
                <?php
			  $sql = mysql_query($sql,$conn);
			  while ($id = mysql_fetch_array($sql)) { 
			     $sql2="select * from archivos_temas where(id_tema=".$id["id_tema"].")and(id_archivo=".$_POST["id_archivo"].")";
			     $sql2 = mysql_query($sql2,$conn);
				 if(mysql_affected_rows()==0){
 		        ?>
                <option value="<?php echo $id["id_tema"];?>" > <?php echo $id["tema"]; ?></option>
                <?php
  			     }
				
				
			  }//end while
			  ?>
                </select>
              <?php
			 }else{
			?>
              <select name="temas1" id="temas1" size="5" style="width:230px" >
                <?php
			  $sql = mysql_query("select * from tema where(id_autor=".$_POST["id_autor"].") order by tema",$conn);
			  while ($id = mysql_fetch_array($sql)) { 
			     $sql2="select * from archivos_temas where(id_tema=".$id["id_tema"].")and(id_archivo=".$_POST["id_archivo"].")";
			     $sql2 = mysql_query($sql2,$conn);
				 if(mysql_affected_rows()==0){
			  
			 ?>
                <option value="<?php echo $id["id_tema"];?>" > <?php echo $id["tema"]; ?></option>
                <?php
				}
			  }//end while
			  ?>
                </select>
              <?php
			 }
			?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Autor</td>
            <td><label>
			<?php  if($_SESSION["per_usuario"]=="1"){
			?>
			<select name="id_autor" id="id_autor" >
             <?php
			  $sql = mysql_query("select * from usuarios",$conn);
			  while ($id = mysql_fetch_array($sql)) { 
			 ?>
			  <option value="<?php echo $id["id_usuario"];?>" <?php if($id["id_usuario"]==$_POST["id_autor"]) echo "selected";?> > <?php echo $id["firstname"]." ".$id["lastname"]; ?></option>
			  <?php
			  }//end while
			  ?>
            </select>
			<?php
			 }else{ //end if
			 ?>
			<select name="id_autor" id="id_autor" >
			  <option value="<?php echo $_POST["id_autor"]; ?>" selected > <?php echo $_POST["autor"]; ?></option>
            </select>
			 <?php
			 }
			?>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Pa&iacute;s</td>
            <td><input name="pais" type="text" id="pais" value="<?php echo $_POST["pais"]; ?>" size="42"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Fecha Publicaci&oacute;n </td>
            <td class="texto_libre"><?php echo Formatofecha($_POST["fecha"]); ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Estado </td>
            <td><select name="estado" id="estado" >
                <option value="0" <?php if ($_POST["estado"]== "0") echo "selected"; ?> >Desactivado</option>
                <option value="1" <?php if ($_POST["estado"]== "1") echo "selected"; ?> >Publico</option>
                <option value="2" <?php if ($_POST["estado"]== "2") echo "selected"; ?> >Privado</option>
              </select></td>
            <td>&nbsp;</td>
            <td><div align="center">
              <input name="BTAgregar" type="button" class="botones" id="BTAgregar"  value="Agregar" onclick="pasarEdit(feditaarchivo)"/>
            </div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Permitir Comentario </td>
            <td><label>
              <input name="comentario" type="checkbox" id="comentario" value="1" <?php if($_POST["comentarios"]=="1") echo "checked"; ?> >
            </label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td rowspan="4">&nbsp;</td>
            <td rowspan="4" class="texto_libre">Descripci&oacute;n(Bajada)</td>
            <td rowspan="4"><textarea name="bajada" cols="43" rows="15" id="bajada"><?php echo $_POST["bajada"]; ?></textarea></td>
            <td>&nbsp;</td>
            <td><span class="texto_libre">Temas Asociados al Archivo</span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td rowspan="3">&nbsp;</td>
            <td rowspan="3"><?php  {
			?>
             <select name="temas2[]" size="5" multiple="multiple" id="temas2" style="width:230px" >
            <?php
             $sql = mysql_query("select det.id_tema, det.id_archivo, tem.tema from archivos_temas as det inner join tema  as tem on(det.id_tema=tem.id_tema)     where(det.id_archivo=".$_POST["id_archivo"].") order by tema ",$conn);
			  while ($id = mysql_fetch_array($sql)) { 
			 ?>
                 <option value="<?php echo $id["id_tema"];?>" > <?php echo $id["tema"]; ?></option>
             <?php
			  }//end while
			  ?>
             </select>	
			<?php
			 }
			?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Archivo Actual </td>
            <td class="texto_libre"><a href="#" onClick="javascript:window.location='bajando.php?carpeta=<?php echo "dir".$_POST["id_tema"]."&archivo=".$_POST["nom_archivo"];?>';">
              <div align="left"><input name="archivo2" id="archivo2" type="hidden" value="<?php echo $_POST["nom_archivo"]; ?>"><?php echo $_POST["nom_archivo"]; ?></div></td>
            <td>&nbsp;</td>
            <td><div align="center">
              <input name="BTQuitar" type="button" class="botones" id="BTQuitar"  value="Quitar" onclick="pasarEdit2(feditaarchivo)"/>
            </div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Archivo Nuevo </td>
            <td><label>
              <input name="archivo" type="file" id="archivo" size="32">
            </label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td ><table width="100%" height="20" border="0">
          <tr>
            <th width="29%" scope="col">&nbsp;</th>
            <th width="23%" scope="col"><input name="id_tema" id="id_tema" type="hidden" value="<?php echo $_POST["id_tema"] ?>">
		            <input name="tema" id="tema" type="hidden" value="<?php echo $_POST["tema"]; ?>">
		            <input name="descripcion" id="descripcion" type="hidden" value="<?php echo $_POST["descripcion"]; ?>">
		            <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $_POST["id_archivo"]; ?>">
		            <input name="BTActualizar" type="submit" class="botones" id="BTActualizar" value="Actualizar Archivo" onclick="seleccionarEdit(feditaarchivo)" /></th>
            <th width="1%" scope="col">&nbsp;</th>
            <th width="24%" scope="col"><input name="BTcancelar22" type="button" class="botones" id="BTcancelar22" value="Volver" onclick="javascript:window.location='<?php echo $_SESSION["link_archivos"]; ?>'"></th>
            <th width="23%" scope="col">&nbsp;</th>
          </tr>
        </table></td>
      </tr>
    </table></form></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
</table>
<?php
}

?>