<?php
//session_start();
//session_destroy(); 
?><head>
<script language="javascript" src="script.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración de Documentos</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><div align="left"></div></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col">
	<form name="fbuscaarchivos" target="fprincipal" action="archivos.php" method="post" onSubmit="return fValidaBuscar(this);">
	<table width="70%" border="0" align="center">
      <tr>
        <th class="titulo_tabla" scope="col">Busqueda de Documentos </th>
        </tr>
      <tr>
        <td class="celdas_tabla"><table width="100%" border="0">
          <tr>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th colspan="4" scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th width="1%" scope="col">&nbsp;</th>
            <td width="34%" class="texto_libre" scope="col">Frase o palabra a buscar </td>
            <th colspan="4" scope="col"><div align="left">
              <input name="buscado" type="text" id="buscado" value="<?php if(isset($_GET["buscado"])) echo $_GET["buscado"]; else echo "Ingresar la palabra clave a buscar";   ?>" size="45" onFocus="this.select(); this.value=''; ">
            </div></th>
            <th width="1%" scope="col">&nbsp;</th>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td class="texto_libre">Buscar por </td>
            <td width="13%" class="texto_libre">
            <input name="opcion" type="radio" id="opcion" value="titulo" <?php if(isset($_GET["opcion"])){ if($_GET["opcion"]=="titulo") echo "checked";}else echo "checked";   ?>>
            titulo</td>
            <td width="12%" class="texto_libre"><input name="opcion" type="radio" id="opcion" value="autor"<?php if(isset($_GET["opcion"])){ if($_GET["opcion"]=="autor") echo "checked";}?>>
              autor</td>
            <td width="12%" class="texto_libre"><input name="opcion" type="radio" id="opcion" value="pais" <?php if(isset($_GET["opcion"])){ if($_GET["opcion"]=="pais") echo "checked";}?> >
              pais</td>
            <td width="27%" class="texto_libre"><input name="opcion" type="radio" id="opcion" value="descripcion" <?php if(isset($_GET["opcion"])){ if($_GET["opcion"]=="descripcion") echo "checked";}?> >
              descripci&oacute;n</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="Estilo1">&nbsp;</td>
            <td colspan="4">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
        </table></td>
        </tr>
      <tr>
        <td ><table width="100%" height="20" border="0">
          <tr>
            <th width="29%" scope="col">&nbsp;</th>
            <th width="23%" scope="col"><input name="BTBuscar" type="submit" class="botones" id="BTBuscar" value="Buscar Archivos" ></th>
            <th width="1%" scope="col">&nbsp;</th>
            <th width="24%" scope="col"><input name="BTlimpiar" type="button" class="botones" id="BTlimpiar" value="Limpiar" onclick="javascript:window.location='busqueda_archivos.php'" /></th>
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
</body>
