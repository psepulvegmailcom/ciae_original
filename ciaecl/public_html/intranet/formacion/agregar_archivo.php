<?php
include ("conexion.php");
include ("rules.php");
session_start();

if($_POST["BTSubir"]){
  $dir="$ruta";
 
  if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) {
      if($HTTP_POST_FILES['archivo']['size'] <= $peso_max) {
         $titulo = $_POST["titulo"];
         $autor = $_POST["id_autor"];
         $pais = $_POST["pais"];
         $fecha = $_POST["fecha"];
         $estado = $_POST["estado"];
		 $tipo_archivo=$_POST["tipo_archivo"];
         if($_POST["comentario"]==1) $comentario = 1; else $comentario=0;
         $bajada = $_POST["bajada"];
         $archivo = $HTTP_POST_FILES['archivo']['name'];
         $ids_temas = $_POST["temas2"];
		 copy($HTTP_POST_FILES['archivo']['tmp_name'], "$dir/".$HTTP_POST_FILES['archivo']['name']);
         $funcionAgrega = new rules();
         $resp = $funcionAgrega->AgregaArchivo($conn,$titulo,$tipo_archivo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$ids_temas,$dir);
       }
     else{
        echo "paso";
        $peso = $peso_max/1024;
	    echo $resp = "Lo siento, se permite maximo ".$peso."KB en los archivos a subir";
     }	   
	}
	else{
	  $resp = "Lo siento, no se pudo subir el archivo";
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
}else
if($_POST["BTAgregar"]){
?>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script.js"></script>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><div align="left"></div></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col">
    <form name="fagregartema" target="fprincipal" action="agregar_archivo.php" method="post" onSubmit="return fValidaInsertArchivo(this, '¿Esta seguro de agregar el Nuevo archivo al Tema seleccionado?');" enctype="multipart/form-data" >	<table width="750" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Agregar Nuevo Archivo </th>
        </tr>
      <tr>
        <td class="celdas_tabla"><table width="100%" border="0">
          <tr>
            <th width="3%" scope="col">&nbsp;</th>
            <th width="21%" scope="col">&nbsp;</th>
            <th width="3%" scope="col">&nbsp;</th>
            <th width="35%" scope="col">&nbsp;</th>
            <th width="2%" scope="col">&nbsp;</th>
            <th width="33%" scope="col">&nbsp;</th>
            <th width="3%" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Titulo</td>
            <td>&nbsp;</td>
            <td><label>
              <input name="titulo" type="text" id="titulo" size="42">
            </label></td>
            <td>&nbsp;</td>
            <td><span class="texto_libre">Temas Disponibles </span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Tipo Documento </td>
            <td>&nbsp;</td>
            <td><span class="titulos">
              <select name="tipo_archivo" id="tipo_archivo">
               <?php
			  $sql2 = mysql_query("select * from tipos_archivos",$conn);
			  while ($id = mysql_fetch_array($sql2)) { 
			 ?>
                <option value="<?php echo $id["id_tipoarchivo"];?>" <?php if($id["id_tipoarchivo"]=="1") echo "selected"; ?> > <?php echo $id["tipo_archivo"]; ?></option>
                <?php
			  }//end while
			  ?>
              </select>
            </span></td>
            <td rowspan="4">&nbsp;</td>
            <td rowspan="4">
              <?php  if($_SESSION["per_usuario"]=="1"){
			?>
              <select name="temas1" id="temas1" size="5" style="width:230px" >
                <?php
			  $sql = mysql_query("select * from tema where(id_tema <> ".$_POST["id_tema"].") order by tema ",$conn);
			  while ($id = mysql_fetch_array($sql)) { 
			 ?>
                <option value="<?php echo $id["id_tema"];?>" > <?php echo $id["tema"]; ?></option>
                <?php
			  }//end while
			  ?>
                </select>
              <?php
			 }else{
			?>
              <select name="temas1" id="temas1" size="5" style="width:230px" >
                <?php
			  $sql = mysql_query("select * from tema where(id_autor=".$_POST["id_autor"].")and(id_tema <> ".$_POST["id_tema"].") order by tema",$conn);
			  while ($id = mysql_fetch_array($sql)) { 
			 ?>
                <option value="<?php echo $id["id_tema"];?>" > <?php echo $id["tema"]; ?></option>
                <?php
			  }//end while
			  ?>
                </select>
              <?php
			 }
			?>            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Autor</td>
            <td>&nbsp;</td>
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
            <td>&nbsp;</td>
            <td><input name="pais" type="text" id="pais" size="42"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Fecha Publicaci&oacute;n </td>
            <td>&nbsp;</td>
            <td><input name="fecha" type="hidden" id="fecha" size="10" maxlength="10" value="<?php echo date("Y-m-d"); ?>">
              <span class="texto_libre"><?php echo date("d/m/Y"); ?></span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Estado Inicial </td>
            <td>&nbsp;</td>
            <td><select name="estado" id="estado" >
              <option value="0" selected>Deshabilitado</option>
              <option value="1">Publico</option>
              <option value="2">Privado</option>
            </select></td>
            <td>&nbsp;</td>
            <td><div align="center">
              <input name="BTAgregar" type="button" class="botones" id="BTAgregar"  value="Agregar" onClick="pasarInsert(fagregartema)"/>
            </div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Permitir Comentario </td>
            <td>&nbsp;</td>
            <td><label>
              <input name="comentario" type="checkbox" id="comentario" value="1" checked>
            </label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td rowspan="4">&nbsp;</td>
            <td rowspan="4" class="texto_libre">Descripci&oacute;n(Bajada)</td>
            <td rowspan="4">&nbsp;</td>
            <td rowspan="4"><textarea name="bajada" cols="43" rows="15" id="bajada"></textarea></td>
            <td>&nbsp;</td>
            <td><span class="texto_libre">Temas Asociados al Archivo</span></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td rowspan="3">&nbsp;</td>
            <td rowspan="3"><select name="temas2[]" size="5" multiple="multiple" id="temas2" style="width:230px">
                <option value="<?php echo $_POST["id_tema"];  ?>" selected="selected">(Bloq) <?php echo $_POST["tema"];  ?></option>
              </select></td>
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
            <td class="texto_libre">Archivo</td>
            <td>&nbsp;</td>
            <td><label>
              <input name="archivo" type="file" id="archivo" size="32" >
            </label></td>
            <td>&nbsp;</td>
            <td><div align="center">
              <input name="BTQuitar" type="button" class="botones" id="BTQuitar"  value="Quitar" onClick="pasarInsert2(fagregartema)"/>
            </div></td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
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
            <th width="23%" scope="col">
   	        <input name="tema" id="tema" type="hidden" value="<?php echo $_POST["tema"]; ?>">
		    <input name="descripcion" id="descripcion" type="hidden" value="<?php echo $_POST["descripcion"]; ?>">
            <input name="id_tema" id="id_tema" type="hidden" value="<?php echo $_POST["id_tema"]; ?>">
            <input name="BTSubir" type="submit" class="botones" id="BTSubir" value="Agregar Archivo" onClick="seleccionarInsert(fagregartema)"></th>
            <th width="1%" scope="col">&nbsp;</th>
            <th width="24%" scope="col"><input name="BTcancelar22" type="button" class="botones" id="BTcancelar22" value="Volver" onclick="javascript:window.location='<?php echo $_SESSION["link_archivos"]; ?>'"></th>
            <th width="23%" scope="col">&nbsp;</th>
          </tr>
        </table></td>
      </tr>
    </table>
	</form>
	</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
</table>
<?php

} //fin if BTAgregar
?>