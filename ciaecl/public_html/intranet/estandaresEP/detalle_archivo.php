<?php
	include ("conexion.php");
	include ("rules.php");
	session_start();	
	
	$usuario = $_SESSION["id_usuario"];
	$perfil =  $_SESSION["per_usuario"];
	$nombre =  $_SESSION["nom_usuario"];
	if($_POST["BTAgregar"]=="Agregar Comentario")
	{
		$archivo= $_POST["id_archivo"];
		$fecha = date("Y-m-d");
		$funcionAgrega = new rules();
		$resp = $funcionAgrega->AgregaComentario($conn,$_POST["titulo"],$_POST["autor"],$_POST["correo"],$fecha, $_POST["comentario"], $archivo);
		$id_archivo=$archivo; 
	}
	else
	{
		$id_archivo=$_GET["id_archivo"];
		$_SESSION["link_detalle"]="detalle_archivo.php?id_archivo=".$_GET["id_archivo"]."&id_tema=".$_GET["id_tema"]."&descripcion=".$_GET["descripcion"]."&tema=".$_GET["tema"]; 
	}
	
	$funcionBusqueda = new rules();
	$row = $funcionBusqueda->DetalleArchivo($conn, $id_archivo); 
	$sql = $funcionBusqueda->ComentariosArchivo($conn, $id_archivo, $perfil, $usuario); 
	$comentarios=$row["comentarios"];
	$autor=$row["id_autor"];

?>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="script.js"></script>
<style type="text/css">
<!--
.Estilo1 {font-size: 10px}
-->
</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="35%" scope="col"><div align="left" class="titulos">Titulo Documento </div></th>
    <td width="28%" scope="col"><div align="left" class="texto_libre"><?php echo $row["titulo"]  ?></div></td>
    <th width="3%" class="titulos" scope="col">&nbsp;</th>
    <th width="34%" class="titulos" scope="col"><div align="left">Descripci&oacute;n</div>      <div align="left"></div></th>
  </tr>
  <tr>
    <td class="titulos">Autor</td>
    <td class="texto_libre"><span class="texto_libre"><?php echo $row["firstname"]." ".$row["lastname"];  ?></span></td>
    <td class="texto_libre">&nbsp;</td>
    <td class="texto_libre"><div align="justify"><?php echo $row["bajada"]  ?></div></td>
  </tr>
  <tr>
    <td><span class="titulos">Fecha Publicaci&oacute;n </span></td>
    <td><div align="left" class="texto_libre"> <?php echo Formatofecha($row["fec_publicacion"])  ?></div></td>
    <td class="texto_libre">&nbsp;</td>
    <td class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <th scope="col"><div align="left"><span class="titulos">Nombre del Archivo</span></div></th>
    <td class="texto_libre" scope="col"><div align="left"><span class="texto_libre"><?php echo $row["nom_archivo"]  ?></span></div></td>
    <td class="texto_libre">&nbsp;</td>
    <td class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <th scope="col"><div align="left" class="titulos">Pais</div></th>
    <td><div align="left" class="texto_libre"><?php echo $row["pais"]  ?></div></td>
    <td class="texto_libre">&nbsp;</td>
    <td class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="4" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="4" scope="col"><div align="right">
      <table width="250" border="0" align="center">
        <tr>
          <td width="51%"><div align="center">
            <input name="BTDescargar" type="button" class="botones" id="BTDescargar" value="Descargar Archivo" onclick="javascript:window.location='bajando.php?archivo=<?php echo $row["nom_archivo"];?>'"/>
          </div></td>
          <td width="6%">&nbsp;</td>
          <td width="43%"><div align="center">
            <input name="BTcancelar2222" type="button" class="botones" id="BTcancelar2222" value="Volver" onclick="javascript:window.location='<?php echo $_SESSION["link_archivos"]; ?>'" />
          </div></td>
        </tr>
      </table>
    </div>      <div align="left"></div></th>
  </tr>
  <tr>
    <td colspan="4" class="texto_libre" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" class="texto_libre" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" class="texto_libre" >&nbsp;</td>
  </tr>
  <?php 
   if(mysql_num_rows($sql) == 0){
     echo "<td colspan=\"4\" class=\"texto_libre\" >EL archivo no posee comentarios</td>";
  }else
  while ($com = mysql_fetch_array($sql)) { 
 ?> 
  
  <tr>
    <th colspan="4" scope="col"><table width="100%" border="0">
      <tr>
        <td width="82%" class="titulos"><?php echo $com["titulo_comentario"]  ?></td>
        <td colspan="2" rowspan="2">
		<?php
		if(($perfil=="1")||( ($perfil=="2")&&($autor==$usuario) ) ){
		?>
		<table width="100%" border="0">
          <tr>
            <td class="texto_libre"><strong class="texto_libre Estilo1">Opciones</strong></td>
            <td colspan="2" class="texto_libre"><div align="center"><?php if ($com["estado"]=="1") echo "Activado"; else echo "Desactivado";  ?></div></td>
            </tr>
          <tr>
            <form action="editar_comentario.php" method="post">
			                <input type="hidden" name="id_comentario" value="<?php echo $com["id_comentario"]; ?>" />
			                <input type="hidden" name="id_archivo" value="<?php echo $com["id_archivo"]; ?>" />
			                <input type="hidden" name="titulo" value="<?php echo $com["titulo_comentario"]; ?>" />
			                <input type="hidden" name="autor" value="<?php echo $com["autor_comentario"]; ?>" />
			                <input type="hidden" name="correo" value="<?php echo $com["correo"]; ?>" />
			                <input type="hidden" name="comentario" value="<?php echo $com["comentario"]; ?>" />
			                <input type="hidden" name="fecha" value="<?php echo Formatofecha($com["fec_comentario"]); ?>" />
			                <td width="30%"><input name="BTEditar" type="submit" class="botones" value="Editar" /></td>
							</form>
            <td width="39%"><input name="Submit3" type="button" class="botones" value="Activaci&oacute;n" onclick="if (confirm('&iquest;Estas seguro que cambiar el estado del comentario del archivo?')){ document.location.href='<?php echo "activacion.php?id_comentario=".$com["id_comentario"]."&estado=".$com["estado"]."&id_archivo=".$com["id_archivo"]."&flag=3";  ?>'}" /></td>
            <td width="31%"><input name="Submit32" type="button" class="botones" value="Borrar" onclick="if (confirm('&iquest;Estas seguro de borrar el comentario definitivamente?')){ document.location.href='<?php echo "eliminacion.php?id_comentario=".$com["id_comentario"]."&id_archivo=".$com["id_archivo"]."&flag=3";  ?>'}" /></td>
          </tr>
        </table>
		<?php
		}
		?>
		</td>
        </tr>
      <tr>
        <td height="20" class="texto_libre"><?php echo $com["autor_comentario"]  ?></td>
        </tr>
      <tr>
        <td class="texto_libre"><?php echo Formatofecha($com["fec_comentario"])  ?></td>
        <td width="2%" class="texto_libre">&nbsp;</td>
        <td width="16%" class="texto_libre">&nbsp;</td>
      </tr>
      
      
      <tr>
        <td colspan="3"><div align="justify"><span class="texto_libre Estilo1"><?php echo $com["comentario"]  ?></span></div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></th>
  </tr>
  <?php
   }//end while
  ?>
  
  <tr>
     <form name="fagregacomentario"  action="detalle_archivo.php" method="post" onSubmit="return fValidaInsertComentario(this, '¿Esta seguro de agregar el comentario al archivo seleccionado?');">
     <th colspan="4" scope="col"><table width="100%" border="0">
          <tr>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th width="6%" scope="col">&nbsp;</th>
            <th width="6%" scope="col">&nbsp;</th>
            <th width="77%" scope="col">
			<?php if($comentarios != "0") { ?>
			
			<table width="450" border="0" align="center">
              <tr>
                <th class="titulo_tabla" scope="col">Agregar Comentario </th>
              </tr>
              <tr>
                <td class="celdas_tabla"><table width="449" border="0">
                    <tr>
                      <th width="2%" scope="col">&nbsp;</th>
                      <th width="35%" scope="col">&nbsp;</th>
                      <th width="60%" scope="col">&nbsp;</th>
                      <th width="3%" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="texto_libre">Titulo Comentario </td>
                      <td><label>
                        <input name="titulo" type="text" id="titulo" size="44" />
                      </label></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="texto_libre">Autor</td>
                      <td><label>
                        <input name="autor" type="text" id="autor" size="44" />
                      </label></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="texto_libre">Correo Electr&oacute;nico </td>
                      <td><input name="correo" type="text" id="correo" size="44" /></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="texto_libre">Fecha Publicaci&oacute;n </td>
                      <td class="texto_libre"><?php echo date("d/m/Y"); ?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="texto_libre">Comentario</td>
                      <td><textarea name="comentario" cols="33" rows="3" wrap="virtual" id="comentario"></textarea></td>
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
                      <th width="40%" scope="col">&nbsp;</th>
                      <th width="15%" scope="col"><div align="right">
                        <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $id_archivo; ?>" />
                        <input name="BTAgregar" type="submit" class="botones" id="BTAgregar" value="Agregar Comentario"  >
                      </div></th>
                      <th width="1%" scope="col">&nbsp;</th>
                      <th width="10%" scope="col"><div align="left">
                        <input name="BTcancelar22222" type="button" class="botones" id="BTcancelar22222" value="Volver" onclick="javascript:window.location='<?php echo $_SESSION["link_archivos"]; ?>'" />
                      </div></th>
                      <th width="40%" scope="col">&nbsp;</th>
                    </tr>
                </table></td>
              </tr>
            </table>
			<?php
			}
			?>
			</th>
            <th width="7%" scope="col">&nbsp;</th>
            <th width="4%" scope="col">&nbsp;</th>
          </tr>
        </table></th>
    </form>
  </tr>
  <tr>
    <th colspan="4" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="4" scope="col">&nbsp;</th>
  </tr>
</table>
