<?php
 include ("conexion.php");
 include ("rules.php");
 session_start();	

if(isset($_POST["BTUsuarios"])|| isset($_GET["BTUsuarios"])){
 $id_usuario = $_SESSION["id_usuario"];
 $perfil = $_SESSION["per_usuario"];
 $usuario = $_SESSION["nom_usuario"];
 $funcionBusqueda = new rules();

if($perfil == "1")
  $condicion="";
else
   if(($perfil == "0")||($perfil == "2")    	)
      $condicion="where (id_usuario=$id_usuario)";


    $sql = $funcionBusqueda->ListarUsuarios($conn, $condicion);

?>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script.js"></script>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><div align="left" class="titulos">Usuarios del Sistema </div></th>
  </tr>
  
  <tr>
    <th scope="col"><table width="100%" border="0" align="center">
          <tr>
            <td class="texto_libre">&nbsp;</td>
        </tr>
        </table>
      <table width="100%" border="0" align="center">
          <tr>
            <th width="22%" class="titulo_tabla" scope="col"><div align="left">Nombre </div></th>
            <th width="12%" class="titulo_tabla" scope="col"><div align="center">Usuario</div></th>
            <th width="13%" class="titulo_tabla" scope="col"><div align="center">Tipo Usuario </div></th>
            <th width="18%" class="titulo_tabla" scope="col"><div align="center">Correo Electr&oacute;nico </div></th>
            <th colspan="2" class="titulo_tabla" scope="col"><div align="center">Ultimo Acceso </div></th>
            <th width="10%" class="titulo_tabla" scope="col">Estado</th>
            <th width="7%" class="titulo_tabla" scope="col"><div align="center">Opciones</div></th>
          </tr>
           <?php while ($row = mysql_fetch_array($sql)) { 
           ?> 
          <tr>
            <td class="celdas_tabla"><?php echo $row["firstname"]." ".$row["lastname"]; ?></td>
            <td class="celdas_tabla"><?php echo $row["username"]; ?></td>
            <td class="celdas_tabla"><?php echo $row["tipo_usuario"]; ?></td>
            <td class="celdas_tabla"><?php echo $row["email"]; ?></td>
            <td colspan="2" class="celdas_tabla"><?php if( $row["last_login"]!="--------------") echo FormatoFecha($row["last_login"]); else echo $row["last_login"];?></td>
            <td class="celdas_tabla"><?php if($row["estado_usu"]=="0") echo "Deshabilitado"; else echo "Activado"; ?></td>
            <td class="celdas_tabla"><table width="31%" height="16" border="0" align="center">
              <tr>
                <th width="6%">&nbsp;</th>
                <form name="feditar" target="fprincipal" action="editar_usuario.php" method="post">
                  <input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $row["id_usuario"] ?>">
                  <input name="nombre" id="nombre" type="hidden" value="<?php echo $row["firstname"] ?>">
                  <input name="apellido" id="apellido" type="hidden" value="<?php echo $row["lastname"] ?>">
                  <input name="correo" id="correo" type="hidden" value="<?php echo $row["email"]; ?>">
                  <input name="tipo" id="tipo" type="hidden" value="<?php echo $row["id_tipousuario"]; ?>">
                  <input name="estado" id="estado" type="hidden" value="<?php echo $row["estado_usu"]; ?>">
                  <input name="usuario" id="usuario" type="hidden" value="<?php echo $row["username"]; ?>">
                  <input name="pass" id="pass" type="hidden" value="<?php echo $row["passwd"]; ?>">
                  <th width="24%"> <input name="BTEditarUsuario" type="submit" class="botones" id="BTEditarUsuario" value="E"></th>
                </form>
                <form name="fborrar" target="fprincipal" action="borrar_usuario.php">
                  <?php
				   if($perfil=="1"){
				  ?>
				  <th width="21%"><input name="Submit32" type="button" class="botones" value="B" onClick="if (confirm('&iquest;Estas seguro de borrar el Usuario definitivamente?')){ document.location.href='<?php echo "eliminacion.php?id_usuario_del=".$row["id_usuario"]."&flag=4"; ?>'}"></th>
				  <?php
				   }
				  ?>
                </form>
                <th width="4%">&nbsp;</th>
              </tr>
            </table></td>
        </tr>
         <?php
		 }//end while
		 ?>
          <tr>
            <th scope="col">&nbsp;</th>
          </tr>
        </table>
      </th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col"><table width="100%" height="16" border="0">
      <tr>
        <th width="35%">&nbsp;</th>
        <?php
		   if($perfil=="1"){
  	    ?>

        <form name="fagregar" target="fprincipal" action="agregar_usuario.php" method="post">
          <th width="17%"><input name="BTAgregarUsuario" type="submit" class="botones" id="BTAgregarUsuario" value="Agregar Usuario"></th>
        </form>
        <?php
		   }
  	    ?>
        <th width="9%"><input name="BTcancelar" type="button" class="botones" id="BTcancelar" value="Volver" onClick="javascript:window.location='temas.php'" ></th>
        <th width="39%">&nbsp;</th>
      </tr>
    </table></th>
  </tr>
</table>
<?php
}
?>
