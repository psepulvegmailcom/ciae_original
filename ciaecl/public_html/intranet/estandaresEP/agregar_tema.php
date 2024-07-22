<?php
 include ("conexion.php");
 include ("rules.php");
 if($_POST["BTAgregar"]=="Agregar"){
   $usuario= $_POST["id_usuario"];
   $funcionAgrega = new rules();
   $img1=$HTTP_POST_FILES['img1']['name'];
   $img2=$HTTP_POST_FILES['img2']['name'];
   $img3=$HTTP_POST_FILES['img3']['name'];
   if($_POST["comentario"]==1) $comentario = 1; else $comentario=0;
   
   $msg="El tema se pudo agregar a la Base de Datos. ";   
 
  if((isset($img1)) && ($img1 !="")){
   $extension = explode(".",$img1);
   $num = count($extension)-1;
   if(($extension[$num] != "jpg")&&($extension[$num] != "jpeg")&&($extension[$num] != "gif")&&($extension[$num] != "png")){
     $img1="";
     $msg.="La imagen N° 1 no se pudo agregar, ya que no es de formato jpg, jpeg, png o gif. ";	
	} 
   }else $img1="";



  if((isset($img2)) && ($img2 !="")){
   $extension = explode(".",$img2);
   $num = count($extension)-1;
    if(($extension[$num] != "jpg")&&($extension[$num] != "jpeg")&&($extension[$num] != "gif")&&($extension[$num] != "png")){
     $img2="";
     $msg.="La imagen N° 2 no se pudo agregar, ya que no es de formato jpg, jpeg, png o gif. ";	
   }	 
   }else $img2="";

  if((isset($img3)) && ($img3 !="")){
    $extension = explode(".",$img3);
    $num = count($extension)-1;
    if(($extension[$num] != "jpg")&&($extension[$num] != "jpeg")&&($extension[$num] != "gif")&&($extension[$num] != "png")){
      $img3="";
      $msg.="La imagen N° 3 no se pudo agregar, ya que no es de formato jpg, jpeg, png o gif. ";	
	}  
   }else $img3="";


    $resp = $funcionAgrega->AgregaTema($conn,$_POST["area"],$_POST["estado"],$_POST["descripcion"],$_POST["descripcion2"],$_POST["descripcion3"],$_POST["tipo_tema"], $usuario, $ruta, $rutaImg, $img1, $img2, $img3, $comentario);	

    if($img1 != "") copy($HTTP_POST_FILES['img1']['tmp_name'], "$rutaImg/dir$resp/".$img1);
    if($img2 != "") copy($HTTP_POST_FILES['img2']['tmp_name'], "$rutaImg/dir$resp/".$img2);
    if($img3 != "") copy($HTTP_POST_FILES['img3']['tmp_name'], "$rutaImg/dir$resp/".$img3);
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
            <form name="feditar" target="fprincipal" action="temas.php">
              <th scope="col"><input name="BTcancelar" type="submit" class="botones" id="BTcancelar" value="Volver"></th>
            </form>
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
	<form name="fagregartema" target="fprincipal" action="agregar_tema.php" method="post" onSubmit="return fValidaEditTema(this,'¿Esta seguro de Agregar el nuevo Tema?');"  enctype="multipart/form-data" >
	<table width="80%" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Agregar Nuevo Tema </th>
        </tr>
      <tr>
        <td class="celdas_tabla"><table width="102%" border="0">
          <tr>
            <th width="3%" scope="col">&nbsp;</th>
            <th width="41%" scope="col">&nbsp;</th>
            <th width="53%" scope="col">&nbsp;</th>
            <th width="3%" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">&Aacute;rea Tematica </td>
            <td><label>
              <input name="area" type="text" id="area" size="47">
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
			    <option value="<?php echo $id["id_tipotema"];?>" <?php if($id["id_tipotema"]==1) echo selected ?> >  <?php echo $id["tipo_tema"]; ?></option>
			    <?php
			  }//end while
			  ?>
		      </select></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Estado</td>
            <td><label>
              <select name="estado" id="estado" >
                <option value="0" selected>Deshabilitado</option>
                <option value="1">Publico</option>
                <option value="2">Privado</option>
              </select>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Permitir Comentario </td>
            <td><input name="comentario" type="checkbox" id="comentario" value="1" checked="checked" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Texto 1</td>
            <td><label>
            <textarea name="descripcion" cols="74" rows="5" id="descripcion"></textarea>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
		            <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Texto 2</td>
            <td><label>
            <textarea name="descripcion2" cols="74" rows="5" id="descripcion"></textarea>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Texto 3</td>
            <td><label>
            <textarea name="descripcion3" cols="74" rows="5" id="descripcion"></textarea>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>

            <td>&nbsp;</td>
            <td class="texto_libre">Imagen N&uacute;mero 1 </td>
            <td><input name="img1" type="file" id="img1" size="32"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Imagen N&uacute;mero 2 </td>
            <td><input name="img2" type="file" id="img2" size="32"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Imagen N&uacute;mero 3 </td>
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
            <th width="23%" scope="col"><input name="BTAgregar" type="submit" class="botones" id="BTAgregar" value="Agregar">
            <input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $_POST["id_usuario"]; ?>">
            </th>
            <th width="1%" scope="col">&nbsp;</th>
            <th width="24%" scope="col"><input name="BTcancelar" type="button" class="botones" id="BTcancelar" onClick="history.back();" value="Cancelar"></th>
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