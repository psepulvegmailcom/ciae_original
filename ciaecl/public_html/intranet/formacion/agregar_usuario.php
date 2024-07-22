<?php
 include ("conexion.php");
 include ("rules.php");
 session_start();	
 if($_POST["BTAgregar"]=="Agregar"){
   $funcionAgrega = new rules();
   $resp = $funcionAgrega->AgregaUsuario($conn,$_POST["nombre"],$_POST["apellido"],$_POST["correo"],$_POST["tipo"],$_POST["estado"],$_POST["usuario"],$_POST["pass"]);
   if($resp != "1"){
      $msg=$resp;
	}  
   else{
	 $msg="Se han agregado los datos correctamente"; 
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
            <form name="feditar" target="fprincipal" action="usuarios.php">
              <th scope="col"><input name="BTcancelar" type="button" class="botones" id="BTcancelar" value="Volver" onClick="document.location ='usuarios.php?BTUsuarios=Usuarios'"></th>
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
  if($_POST["BTAgregarUsuario"]=="Agregar Usuario"){
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
	<form name="fagregartema" target="fprincipal" action="agregar_usuario.php" method="post" onSubmit="return fValidaAgregaUsuario(this,'¿Esta seguro de Agregar el nuevo Usuario?');">
	<table width="70%" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Agregar Nuevo Usuario </th>
        </tr>
      <tr>
        <td class="celdas_tabla"><table width="100%" border="0">
          <tr>
            <th width="7%" scope="col">&nbsp;</th>
            <th width="55%" scope="col">&nbsp;</th>
            <th width="31%" scope="col">&nbsp;</th>
            <th width="7%" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Nombre</td>
            <td><label>
              <input name="nombre" type="text" id="nombre" size="43">
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Apellido</td>
            <td><label>
              <input name="apellido" type="text" id="apellido" size="43" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Correo Electr&oacute;nico </td>
            <td><input name="correo" type="text" id="correo" size="43" /></td>
            <td>&nbsp;</td>
          </tr>
			<?php  if($_SESSION["per_usuario"]=="1"){
			?>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Tipo Usuario </td>
            <td>
			<select name="tipo" id="tipo" >
             <?php
			  $sql = mysql_query("select * from tipo_usuario",$conn);
			  while ($id = mysql_fetch_array($sql)) { 
			 ?>
			  <option value="<?php echo $id["id_tipousuario"];?>" <?php if($id["id_tipousuario"]=="0") echo "selected";?> > <?php echo $id["tipo_usuario"]; ?></option>
			  <?php
			  }//end while
			  ?>
            </select>
            </td>
            <td>&nbsp;</td>
          </tr>
			<?php
			 } //end if
			 ?>		  
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Estado</td>
            <td><select name="estado" id="estado" >
              <option value="0">Deshabilitado</option>
              <option value="1" selected="selected">Activado</option>
            </select></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Usuario</td>
            <td><input name="usuario" type="text" id="usuario" size="15" maxlength="10" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Contrase&ntilde;a</td>
            <td><input name="pass" type="password" id="pass" size="15" maxlength="10" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Repite Contrase&ntilde;a </td>
            <td><input name="pass2" type="password" id="pass2" size="15" maxlength="10" /></td>
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
            <th width="23%" scope="col"><input name="BTAgregar" type="submit" class="botones" id="BTAgregar" value="Agregar"></th>
            <th width="1%" scope="col">&nbsp;</th>
            <th width="24%" scope="col">
			<input name="Submit" type="button" class="botones" value="Cancelar" onClick="document.location ='usuarios.php?BTUsuarios=Usuarios'"/>
			</th>
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
}
?>