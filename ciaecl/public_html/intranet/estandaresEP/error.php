<?php
if($_GET["error"]=="1") $msg = "El usuario o contraseña ingresados no son válidos o no se encuentran registrados en el sistema.";
else $msg="Ha ocurrido un error en el sistema, por favor contactese con el Administrador.";

?>
<link href="estilo.css" rel="stylesheet" type="text/css" />
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
        <th class="titulo_tabla" scope="col">Error en el Sistema </th>
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
            <form name="fagregartema" target="fprincipal" action="archivos_encontrados.php">
              <th scope="col"><input name="BTcancelar" type="button" class="botones" id="BTcancelar" onClick="history.back();" value="Volver"></th>
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
