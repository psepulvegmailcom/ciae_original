<?php
 include ("conexion.php");
 include ("rules.php");
 session_start();
 if($_POST["BTActualizar"]=="Actualizar"){
    $funcionActualiza = new rules();

   $img1=$HTTP_POST_FILES['img1']['name'];
   $img2=$HTTP_POST_FILES['img2']['name'];
   $img3=$HTTP_POST_FILES['img3']['name'];
   if($_POST["comentario"]==1) $comentario = 1; else $comentario=0;
     
   $msg="El tema se pudo modificar en la Base de Datos. ";   

  if((isset($img1)) && ($img1 !="")){
   $extension = explode(".",$img1);
   $num = count($extension)-1;
   if(($extension[$num] != "jpg")&&($extension[$num] != "jpeg")&&($extension[$num] != "gif")&&($extension[$num] != "png")){
     $img1a="img1";
     $msg.="La imagen N° 1 no se pudo actualizar, ya que no es de formato jpg, jpeg, png o gif. ";	
	} else $img1a="'".$img1."'";
   }else $img1a="img1";


  if((isset($img2)) && ($img2 !="")){
   $extension = explode(".",$img2);
   $num = count($extension)-1;
    if(($extension[$num] != "jpg")&&($extension[$num] != "jpeg")&&($extension[$num] != "gif")&&($extension[$num] != "png")){
     $img2a="img2";
     $msg.="La imagen N° 2 no se pudo actualizar, ya que no es de formato jpg, jpeg, png o gif. ";	
	} else $img2a="'".$img2."'";
   }else $img2a="img2";


  if((isset($img3)) && ($img3 !="")){
    $extension = explode(".",$img3);
    $num = count($extension)-1;
    if(($extension[$num] != "jpg")&&($extension[$num] != "jpeg")&&($extension[$num] != "gif")&&($extension[$num] != "png")){
      $img3a="img3";
      $msg.="La imagen N° 3 no se pudo actualizar, ya que no es de formato jpg, jpeg, png o gif. ";	
	} else $img3a="'".$img3."'";
   }else $img3a="img3";

if(isset($_POST["borraimg1"])) $img1a="''";
if(isset($_POST["borraimg2"])) $img2a="''";
if(isset($_POST["borraimg3"])) $img3a="''";

 $resp = $funcionActualiza->ActualizaTema($conn,$_POST["id_tema"], $_POST["tipo_tema"], $_POST["area"],$_POST["estado"]-1, $_POST["descripcion"],$_POST["descripcion2"],$_POST["descripcion3"], $_POST["id_autor"], $img1a, $img2a, $img3a, $comentario);

    if($img1a != "img1") copy($HTTP_POST_FILES['img1']['tmp_name'], "$rutaImg/dir".$_POST["id_tema"]."/".$img1);
    if($img2a != "img2") copy($HTTP_POST_FILES['img2']['tmp_name'], "$rutaImg/dir".$_POST["id_tema"]."/".$img2);
    if($img3a != "img3") copy($HTTP_POST_FILES['img3']['tmp_name'], "$rutaImg/dir".$_POST["id_tema"]."/".$img3);






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
        <th class="titulo_tabla" scope="col">Informaci&oacute;n del Sistema  </th>
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
              <th scope="col"><input name="BTcancelar2222" type="button" class="botones" id="BTcancelar2222" value="Volver" onclick="javascript:window.location='<?php echo "temas.php"; ?>'"></th>
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
	
	<form name="fagregartema" target="fprincipal" action="editar_tema.php" method="post" onSubmit="return fValidaEditTema(this, '¿Esta seguro de modificar la información del Tema?');"  enctype="multipart/form-data">
	<table width="580" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Editar Tema</th>
        </tr>
      <tr>
        <td class="celdas_tabla">
		<table width="100%" border="0">
          <tr>
            <th width="2%" scope="col">&nbsp;</th>
            <th width="48%" scope="col">&nbsp;</th>
            <th width="49%" scope="col">&nbsp;</th>
            <th width="1%" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">&Aacute;rea Tematica </td>
            <td><label>
              <input name="area" type="text" id="area" value="<?php echo $_POST["tema"]; ?>" size="48">
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Tipo Documentos del &Aacute;rea </td>
            <td><select name="tipo_tema" id="tipo_tema">
			    <?php
			  $sql2 = mysql_query("select * from tipos_temas",$conn);
			  while ($id = mysql_fetch_array($sql2)) { 
			 ?>
			    <option value="<?php echo $id["id_tipotema"];?>" <?php if($id["id_tipotema"]==$_POST["id_tipotema"]) echo "selected"; ?> >  <?php echo $id["tipo_tema"]; ?></option>
			    <?php
			  }//end while
			  ?>
		      </select></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Autor </td>
            <td>
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
			?>			</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Estado</td>
            <td><label>
              <select name="estado" id="estado" >
                <option value="1" <?php if ($_POST["estado"]== "0") echo "selected"; ?> >Desactivado</option>
                <option value="2" <?php if ($_POST["estado"]== "1") echo "selected"; ?> >Publico</option>
                <option value="3" <?php if ($_POST["estado"]== "2") echo "selected"; ?> >Privado</option>
              </select>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Permitir Comentario</td>
            <td><input name="comentario" type="checkbox" id="comentario" value="1" <?php if($_POST["comentarios"]=="1") echo "checked"; ?> /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Descripci&oacute;n</td>
            <td><label>
              <textarea name="descripcion" cols="68" rows="8" id="descripcion"><?php echo $_POST["descripcion"]; ?></textarea>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Descripci&oacute;n2</td>
            <td><label>
              <textarea name="descripcion2" cols="68" rows="8" id="descripcion2"><?php echo $_POST["descripcion2"]; ?></textarea>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Descripci&oacute;n3</td>
            <td><label>
              <textarea name="descripcion3" cols="68" rows="8" id="descripcion3"><?php echo $_POST["descripcion3"]; ?></textarea>
            </label></td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td class="texto_libre">Quitar las Imagenes (Opcional) </td>
		    <td class="texto_libre"><label>
		      <input name="borraimg1" type="checkbox" id="borraimg1" value="1" onChange="document.fagregartema.img1.disabled = !document.fagregartema.img1.disabled; document.fagregartema.img1.value=''}" />
		      Imagen N&deg;1
		    </label></td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td class="texto_libre"><input name="borraimg2" type="checkbox" id="borraimg2" value="checkbox" onChange="document.fagregartema.img2.disabled = !document.fagregartema.img2.disabled;document.fagregartema.img2.value=''}" />
Imagen N&deg;2</td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td class="texto_libre"><input name="borraimg3" type="checkbox" id="borraimg3" value="checkbox" onChange="document.fagregartema.img3.disabled = !document.fagregartema.img3.disabled;document.fagregartema.img3.value=''}"/>
Imagen N&deg;3</td>
		    <td>&nbsp;</td>
		    </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Actualizar Imagen N&uacute;mero 1 (Opcional) </td>
            <td><input name="img1" type="file" id="img1" size="32"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Actualizar Imagen N&uacute;mero 2 (Opcional) </td>
            <td><input name="img2" type="file" id="img2" size="32"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Actualizar Imagen N&uacute;mero 3 (Opcional) </td>
            <td><input name="img3" type="file" id="img3" size="32"></td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
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
			<input name="id_tema" id="id_tema" type="hidden" value="<?php echo $_POST["id_tema"]; ?>">
			<input name="BTActualizar" type="submit" class="botones" id="BTActualizar" value="Actualizar"></th>
            <th width="1%" scope="col">&nbsp;</th>
            <th width="24%" scope="col"><input name="BTcancelar222" type="button" class="botones" id="BTcancelar222" value="Volver" onclick="javascript:window.location='temas.php'"></th>
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
}
?>