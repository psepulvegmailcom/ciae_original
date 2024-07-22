<?php
include ("conexion.php");
include ("rules.php");
session_start();

if($_POST["BTEditar"]=="Editar Comentario"){
   $tema= $_POST["id_tema"];
   $fecha = date("Y-m-d");
   $funcionAgrega = new rules();
   $resp = $funcionAgrega->EditaComentarioTema($conn,$_POST["id_comentario"],$_POST["titulo"],$_POST["autor"],$_POST["correo"],$_POST["comentario"]);
   if($resp != "1"){
      $msg=$resp;
	}  
   else{
	 $msg="Se han editado los datos correctamente"; 
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

              <th scope="col"><input name="BTcancelar222" type="button" class="botones" id="BTcancelar222" value="Volver" onclick="javascript:window.location='<?php echo $_SESSION["link_archivos"]; ?>'"></th>
              <th width="23%" scope="col">&nbsp;</th>
          </tr>
        </table></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
</table><?php
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
    <th scope="col"><form name="fagregartema" target="fprincipal" action="editar_comentario_tema.php" method="post" onSubmit="return fValidaInsertComentario(this, '¿Esta seguro de editar el comentario al tema seleccionado?');"><table width="70%" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Editar Comentario </th>
        </tr>
      <tr>
        <td class="celdas_tabla"><table width="100%" border="0">
          <tr>
            <th width="7%" scope="col">&nbsp;</th>
            <th width="39%" scope="col">&nbsp;</th>
            <th width="47%" scope="col">&nbsp;</th>
            <th width="7%" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Titulo Comentario </td>
            <td><label>
              <input name="titulo" type="text" id="titulo" size="43" value="<?php echo $_POST["titulo"]; ?>">
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Autor</td>
            <td><label>
              <input name="autor" type="text" id="autor" size="43" value="<?php echo $_POST["autor"]; ?>">
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Correo Electr&oacute;nico </td>
            <td><input name="correo" type="text" id="correo" size="43" value="<?php echo $_POST["correo"]; ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Fecha Publicaci&oacute;n </td>
            <td class="texto_libre"><?php echo $_POST["fecha"]; ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Comentario</td>
            <td><textarea name="comentario" cols="40" rows="5" id="comentario" ><?php echo $_POST["comentario"]; ?></textarea></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="Estilo1">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
        </table></td>
        </tr>
      <tr>
        <td ><table width="100%" height="20" border="0">
          <tr>
            <th width="29%" scope="col">&nbsp;</th>
<th width="23%" scope="col"><input name="id_comentario" id="id_comentario" type="hidden" value="<?php echo $_POST["id_comentario"]; ?>"><input name="id_tema" id="id_tema" type="hidden" value="<?php echo $_POST["id_tema"]; ?>"><input name="BTEditar" type="submit" class="botones" id="BTEditar" value="Editar Comentario" ></th>
            <th width="1%" scope="col"><input name="BTcancelar2222" type="button" class="botones" id="BTcancelar2222" value="Volver" onclick="javascript:window.location='<?php echo $_SESSION["link_archivos"]; ?>'"></th>
            <th width="23%" scope="col"></th>
            <th width="24%" scope="col">&nbsp;</th>
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