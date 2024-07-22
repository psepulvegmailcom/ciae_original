<?php

 include ("header.php"); 
  $funcionDatosU = new rules(); 
  $datousua = $funcionDatosU->DetalleArchivo($conn, $_POST["id_archivo"]);
  //$datousua = mysql_fetch_array($datousu);

  $dir="../$ruta";
  $id_archivo = $_POST["id_archivo"];
  /*$titulo = $datousua["titulo"];
  $autor = $datousua["id_autor"];
  $pais = $datousua["pais"];
  $fecha = $datousua["fec_publicacion"];
  $estado = $datousua["estado"];*/
  $tipo_archivo = $datousua["id_tipoarchivo"];
  $archivo2 = $datousua["nom_archivo"];
  if($_POST["comentario"]==1) $comentario = 1; else $comentario=0;
  $bajada = $datousua["bajada"];
  $archivo = $HTTP_POST_FILES['archivo']['name'];
  $id_tema = $datousua["id_tema"];
 // $ids_temas = $datousua["temas2"];
  
	 $funcionDatos = new rules(); 
	 $datous = $funcionDatos->TraeUsuario($conn, $datousua["id_autor"]);
	 $datousuario = mysql_fetch_array($datous);
	 
if(isset($_POST["BTActualizar"])=="."){

  //$dir="$ruta";
  $id_archivo = $_POST["id_archivo"];
  $titulo = $_POST["titulo"];
  $autor_orig = $_POST["autor_orig"];
  $ano_re = $_POST["ano_re"];
  $autor = $datousua["id_autor"];
  $pais = $_POST["pais"];
  $fecha = $_POST["fecha"];
  if($_POST["radio"]=="si")
       $estado = $_POST["estado"];
  else	   
       $estado = "0";

  if($_POST["comentario"]==1) $comentario = 1; else $comentario=0;
  $bajada = $_POST["bajada"];
  $archivo = $HTTP_POST_FILES['archivo']['name'];
  $archivo2 = $_POST["archivo2"];
  $id_tema = $_POST["id_tema"];
  $ids_temas = $_POST["temas2"];

  if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) {

      if($HTTP_POST_FILES['archivo']['size'] <= $peso_max) {
         $funcionAgrega = new rules();
         $resp = $funcionAgrega->Editarchivo($conn,$id_archivo,$tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo,$ids_temas,$dir, $autor_orig, $ano_re);
         $file = "../$ruta/$archivo2";
		 
        unlink("$file");
		 copy($HTTP_POST_FILES['archivo']['tmp_name'], "$dir/".$HTTP_POST_FILES['archivo']['name']);
	   }
     else{
        $peso = $peso_max/1024;
	    echo $resp = "Lo siento, se permite maximo ".$peso."KB en los archivos a subir";
     }	   
	}
	else{
  $titulo = $_POST["titulo"];
  $autor_orig = $_POST["autor_orig"];
  $ano_re = $_POST["ano_re"];
  $autor = $_POST["id_autor"];
  $pais = $_POST["pais"];
  if($_POST["radio"]=="si")
       $estado = $_POST["estado"];
  else	   
       $estado = "0";
	   
	   
  $tipo_archivo = $datousua["id_tipoarchivo"];
  if($_POST["comentario"]==1) $comentario = 1; else $comentario=0;
  $bajada = $_POST["bajada"];
  $archivo = $HTTP_POST_FILES['archivo']['name'];
  $funcionAgrega = new rules();
  $resp = $funcionAgrega->Editarchivo($conn, $id_archivo,$tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo2,$ids_temas,$dir, $autor_orig, $ano_re);
 } 
  //header("Location:herramientas.php?id_tema=$tema_sel");	 
	          		?>
				<script>
				 var temax = <?echo $id_tema ?>;
				 pagina = "herramientas.php?id_tema="+temax;
					window.location = pagina;
				</script>
			<? 
  }
  
  
$e  = new miniTemplate('templates/body.tpl'); 
$e->setVariable('nombre_usuario',$_SESSION["nom_usuario"]);
echo $e->toHtml(); 
?>
 
            
<div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
        <li class="ultimo"><a href="herramientas.php" target="_top"> Documentos</a></li>
      </ul>
      </div><!-- fin ruta --> 
 
    
         
         <?php
		 
		 include ('herramientas_menu.php');
		 ?> 
      <div class="conte"></p>
	  <form name="feditaarchivo" target="_self" action="editar.php" method="post" onSubmit="return fValidaEditArchivo(this, '¿Esta seguro de modificar la información del Archivo?');" enctype="multipart/form-data"> 
        <table align="center" cellspacing="0" class="dato"> 
          <tbody>
            <tr>
              <th colspan="2" scope="col"> editar recurso</th>
              </tr>
           
            <tr>
              <td width="150" class="linea1">T&iacute;tulo:</td>
              <td nowrap="nowrap"><input name="titulo" type="text" class="bloque" id="titulo" value="<?php echo $datousua["titulo"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/>
            </tr>
						<tr>
			<td width="150" class="linea1">Autor:</td>
              <td nowrap="nowrap"><input name="autor_orig" type="text" class="bloque" id="autor_orig" value="<?php echo $datousua["autor_orig"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/>
            </tr>
									<tr>
			<td width="150" class="linea1">Año:</td>
              <td nowrap="nowrap"><input name="ano_re" type="text" class="bloque" id="ano_re" value="<?php echo $datousua["ano_re"]; ?>" size="4" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/>
            </tr>

			            <tr>
              <td width="150" class="linea1">Pa&iacute;s:</td>
              <td nowrap="nowrap">
			  <?        echo "<select name='pais' id='pais' class='celdas_tabla'>";
				$paises = file("paises.txt");
				$cuenta = count($paises);
				for($i=0; $i < $cuenta; $i++){
			?>
 <option value="<?php echo $paises[$i];?>" <?php if($paises[$i]==$datousua["pais"]) echo "selected";?> > <?php echo $paises[$i]; ?></option>
 <? }?>
			  <!--input name="pais" type="text" class="bloque" id="pais" value="<?php echo $datousua["pais"]; ?>" size="50" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/--></td>
            </tr>
            <tr>
              <td class="linea2" >Descripci&oacute;n:</td>
              <td nowrap="nowrap" class="fondopeso2"><textarea name="bajada" cols="70" rows="13" class="bloque" id="bajada" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"><?php echo $datousua["bajada"]; ?></textarea></td>
            </tr>
            <tr>
              <td class="linea1">Publicado por:</td>
              <td nowrap="nowrap"><input name="autor" type="text" class="bloque" id="autor" value="<?php echo $datousuario["firstname"]." ".$datousuario["lastname"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium;"  disabled="disabled"/ >
		            <input name="tema_sel" id="tema_sel" type="hidden" value="<?php echo $_POST["tema_sel"]; ?>">
		            <input name="temas2" id="temas2" type="hidden" value="<?php echo $datousua["id_tema"]; ?>">
		            <input name="id_autor" id="id_autor" type="hidden" value="<?php echo $datousua["id_autor"]; ?>">
			 </td>
            </tr>
            <tr>
              <td class="linea2" >Archivo Adjunto 1:</td>
              <td nowrap="nowrap" class="fondopeso2"><p><span class="arriba">Ubicaci&oacute;n:</span><span class="arriba"> <br />
                        <input name="archivo" type="file" class="bloque" id="archivo" value="" size="40" />
                        <br />
                        <span class="archivo"> <?php echo $datousua["nom_archivo"]; ?><input name="archivo2" id="archivo2" type="hidden" value="<?php echo $datousua["nom_archivo"]; ?>"><!--a href="javascript:;"><img src="images/generales/bot_eliminar2.gif" alt="eliminar" width="59" height="14" border="0" align="absmiddle" /></a--></span> <span class="chico"> Peso m&aacute;ximo 2 Mb.</span></span><br />
                  </p>
                </td>
            </tr>
            <tr>
              <td class="linea2" >Publicar:</td>
              <td nowrap="nowrap" class="fondopeso2"><span class="mapaAzul">
           <input type="radio" name="radio" id="radio" value="si" onClick="estado.disabled=false; " <?php if ($datousua["estado"]!= "0") echo "checked"; ?>/>
                Si&nbsp;&nbsp;
              <input type="radio" name="radio" id="radio" value="no" onClick="estado.disabled=true" <?php if ($datousua["estado"]== "0") echo "checked"; ?>/>
                No</span></td>
            </tr>
            <tr>
              <td class="linea2" >Estado:</td>
            <td><select name="estado" id="estado" <?php if ($datousua["estado"]== "0") echo "disabled"; ?>>
                <option value="1" <?php if ($datousua["estado"]== "1") echo "selected"; ?> >Publico</option>
                <option value="2" <?php if ($datousua["estado"]== "2") echo "selected"; ?> >Privado</option>
              </select></td>
                      </tr>
            <tr>
              <td class="linea1">Permitir Comentar:</td>
              <td nowrap="nowrap"><span class="mapaAzul"><input name="comentario" type="checkbox" id="comentario" value="1"<?php if($datousua["comentarios"]=="1") echo "checked"; ?>></span></td>
            </tr>
		
            <tr>
              <th scope="col">&nbsp;</th>
              <th nowrap="nowrap" scope="col"><input name="BTActualizar"  id="BTActualizar" class="botones"  type="submit" value="Guardar Cambios" style="width:150px" /> <input name="Cancelar" class="botones" value="Cancelar" onclick="javascript:history.go(-1);" type="button" />
					<p> <!--a href="#" onClick="document.forms.feditaarchivo.submit();return false"><img src="images/generales/bot_guardar.gif" alt="Guardar Cambios" width="103" height="17" border="0" /></a-->
			  <input name="id_tema" id="id_tema" type="hidden" value="<?php echo $datousua["id_tema"] ?>">
		            <input name="tema" id="tema" type="hidden" value="<?php echo $datousua["tema"]; ?>">
		            <input name="descripcion" id="descripcion" type="hidden" value="<?php echo $datousua["descripcion"]; ?>">
		            <!--input name="BTActualizar" id="BTActualizar" type="hidden" value="Actualizar"-->
		            <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $datousua["id_archivo"]; ?>">
					<!--<input name="BTActualizar"  id="BTActualizar" class="botones"  type="submit" value="Guardar Cambios" style="width:150px" />-->
					
					
				 
					
					 <!--input name="BTActualizar" type="submit" class="botones" id="BTActualizar" value="Guardar" /-->
					
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="javascript:history.go(-1);"><img src="images/generales/bot_cancelar.gif" alt="Cancelar" width="69" height="17" border="0" /></a>--></p></th>
            </tr> 
			</form>
          </tbody>
        </table>
        <p>&nbsp;</p>
	  <div id="lineahor"><img src="images/1x1.gif" alt="nada" /></div>
	<!--div id="paginacion">&lt;&lt; 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - 10 &gt;&gt;</div-->
      </div>
        <p class="titulos">&nbsp;</p>
      <p>&nbsp;</p>
</div>
 

<?php

$e  = new miniTemplate('templates/footer.tpl');  
echo $e->toHtml(); 

?>