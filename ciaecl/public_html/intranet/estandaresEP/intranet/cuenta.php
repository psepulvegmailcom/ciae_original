<?php

 include ("header.php"); 

	$dir="../$ruta";
  $funcionTrae = new rules();
  $trae = $funcionTrae->TraeUsuario($conn, $_SESSION["id_usuario"]);
  $user = mysql_fetch_array($trae);  
  //GeneralPrint($_FILES);
  //GeneralPrint($_POST); 
 if($_POST["BTEditar"]=="Guardar")
 {
	$archivos_upload = array('curriculo');
	for($j=0;$j < count($archivos_upload); $j++)
	{
		if(trim($_FILES[$archivos_upload[$j]]['name']) != '')
		{
			$_FILES[$archivos_upload[$j]]['path'] = $dir.'/';
			$SALIDA = SIDTOOLHtml::guardarArchivo($_FILES[$archivos_upload[$j]],false); 
			$_POST["curriculo_anterior"] = $SALIDA['nombre_final'];
		}
	} 
   	$user["path"] = $dir;
 
   $funcionAgrega = new rules();
   $resp = $funcionAgrega->EditaUsuario($conn,$_POST["id_usuario"], $_POST["nombre"],$_POST["apellido"],$_POST["correo"],$_POST["tipo"],$_POST["estado"],$_POST["usuario"],$_POST["pass"], "last_login",$_POST["perfil_pro"],$_POST["curriculo_anterior"],$_POST["publicaciones"] );
   if($resp != "1"){
      $msg=$resp;
	}  
   else{
	 $msg="Se han agregado los datos correctamente"; 
   } 
    //echo $msg;
 
 }  
 
  
 
 
GeneralImprimirHeader();
?>
 
  
            
<div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
        <li class="ultimo"> Mi Cuenta</li>
      </ul>
      </div><!-- fin ruta --> 
    <div class="clear"></div>
    <h1>Mi Cuenta</h1>
      <table align="center" cellspacing="0" class="dato">
        <tbody>
          <tr>
            <th colspan="2" scope="col">datos personales</th>
            </tr>
				<form name="fagregartema" target="_self" action="cuenta.php" method="post" onSubmit="return fValidaAgregaUsuario(this,'�Esta seguro de Editar el Usuario Seleccionado?');" enctype="multipart/form-data">
          <tr>
            <td width="150" class="linea1">Nombre:</td>
            <td nowrap="nowrap"><input name="nombre" type="text" class="bloque" id="nombre" value="<?php echo $user["firstname"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/></td>
          </tr>
          <tr>
            <td class="linea2" >Apellido:</td>
            <td nowrap="nowrap" class="fondopeso2"><input name="apellido" type="text" class="bloque" id="apellido" value="<?php echo $user["lastname"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/></td>
          </tr>
          <tr>
            <td class="linea1">Correo:</td>
            <td nowrap="nowrap"><input name="correo" type="text" class="bloque" id="correo" value="<?php echo $user["email"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/></td>
          </tr>
          <tr>
            <td class="linea2" >Usuario:</td>
            <td nowrap="nowrap" class="fondopeso2"><input name="titulo5" type="text" class="bloque" id="titulo5" value="<?php echo $user["username"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium" disabled="disabled"/></td>
          </tr>
          <tr>
            <td class="linea1">Contrase&ntilde;a:</td>
            <td nowrap="nowrap"><input name="pass" type="password" id="pass" size="70" maxlength="10" class="bloque" value="<?php echo $user["passwd"]; ?>" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/></td>
          </tr>
          <tr>
            <td class="linea2" >Repetir Contrase&ntilde;a</td>
            <td nowrap="nowrap" class="fondopeso2"><input name="pass2" type="password" id="pass2" size="70" maxlength="10" class="bloque" value="<?php echo $user["passwd"]; ?>" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/></td>			
			<input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $user["id_usuario"] ?>">
			<input name="usuario" id="usuario" type="hidden" value="<?php echo $user["username"]; ?>">

          </tr>
          <tr>
            <th colspan="2" scope="col">editar ficha</th>
            </tr>
          <tr>
            <td class="linea1">Perfil:</td>
            <td nowrap="nowrap"><input name="perfil_pro" type="text" class="bloque" id="perfil_pro" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium" value="<?php echo $user["perfil_pro"]; ?>"/></td>
          </tr>
          <tr>
            <td class="linea2" >Curriculo:</td>
            <td nowrap="nowrap" class="fondopeso2"><input name="curriculo" type="file" class="bloque" id="curriculo" value=""   />
                        <br />
                        <span class="archivo"> <a href="bajando.php?archivo=<?php echo  $user["curriculo"]; ?>" target="_blank"><strong><?php  echo $user["curriculo"]; ?></strong></a>&nbsp;<input name="curriculo_anterior" id="curriculo_anterior" type="hidden" value="<?php echo $user["curriculo"]; ?>"> </span> <br /><span class="chico"> Peso m&aacute;ximo 6 Mb.</span></span> </td>
          </tr>
         
          <!--tr>
            <td class="linea2" >Foto:<br />
              (200 x 150 px)</td>
            <td nowrap="nowrap" class="fondopeso2"><span class="arriba">Ubicaci&oacute;n:</span><span class="arriba"> <br />
                  <input name="file" type="file" class="bloque" id="file6" value="" size="40" />
                  <br />
                  <span class="archivo"> (jpg, gif)<a href="javascript:;"><img src="images/generales/bot_eliminar2.gif" alt="eliminar" width="59" height="14" border="0" align="absmiddle" /></a></span> <span class="chico"> Peso m&aacute;ximo 2 Mb.</span></span>
                </p>            </td>
          </tr-->
          <tr>
            <th scope="col">&nbsp;</th>
            <th nowrap="nowrap" scope="col"><p> <input name="BTEditar" type="submit" class="botones" id="BTEditar" value="Guardar"><!--a href="respuesta.html"><img src="images/generales/bot_guardar.gif" alt="Guardar Cambios" width="103" height="17" border="0" /></a-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="intranet.php"><img src="images/generales/bot_cancelar.gif" alt="Cancelar" width="69" height="17" border="0" /></a></p>              </th>
          </tr>
		  </form>
        </tbody>
      </table>
      <p>&nbsp;</p>
</div>
<?php
  

?>

<?php

GeneralImprimirFooter();

?>

