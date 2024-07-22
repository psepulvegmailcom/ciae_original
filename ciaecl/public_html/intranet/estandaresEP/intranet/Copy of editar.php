<?php

	include ("header.php");  
	
	//GeneralPrint($_FILES);
	
	$funcionDatosU = new rules(); 
	if(isset($_POST["id_archivo"]) && $_POST["id_archivo"] > 0)
	{		
		$datousua = $funcionDatosU->DetalleArchivo($conn, $_POST["id_archivo"]);
	} 
	else
	{
		if(isset($_POST["BTActualizar"])==".")
		{
			$funcionDatosU->AgregaArchivo($conn,'','9',$_POST['id_autor'],$pais,date("Y-m-d"),'1','','','',$_POST["id_tema"],'','','');
			$_POST["id_archivo"] = $funcionDatosU->obtenerUltimoArchivoIngresado($conn); 
			$funcionDatosU->AgregarUsuariosResponsables($conn, $_POST["id_archivo"],$_POST["usuarios"]);  
			$datousua 	= $funcionDatosU->DetalleArchivo($conn, $_POST["id_archivo"]);
		}
		$datousua["id_autor"] = $_POST['id_autor']; 
	}
	//GeneralPrint($_POST); 
	//GeneralPrint($datousua); 

	$dir			= "../$ruta";
	$id_archivo 	= $_POST["id_archivo"]; 
	$tipo_archivo 	= $datousua["id_tipoarchivo"];
	$archivo2 		= $datousua["nom_archivo"]; 
	$bajada 		= $datousua["bajada"];
	$archivo 		= $_FILES['archivo']['name'];
	$id_tema 		= $datousua["id_tema"]; 
	
	$funcionDatos 	= new rules(); 
	$datous 		= $funcionDatos->TraeUsuario($conn, $datousua["id_autor"]);
	$datousuario 	= mysql_fetch_array($datous); 
	 
	if(isset($_POST["BTActualizar"])==".")
	{  
		$otros 			= array();
		$autor 			= $datousua["id_autor"];
		$id_archivo 	= $_POST["id_archivo"];
		$titulo 		= $_POST["titulo"];
		$autor_orig 	= $_POST["autor_orig"];
		$ano_re 		= $_POST["ano_re"];
		$pais 			= $_POST["pais"];
		$fecha 			= $_POST["fecha"];
		if($_POST["radio"]=="si")
		{
			$estado = $_POST["estado"];
			$otros["estado"] = $_POST["estado"];
		}
		else	   
		{
			$estado = "0";
			$otros["estado"] = 0;
		}    
		
		if($_POST["comentario"]==1) 
		{
			$otros["comentarios"] = 1;
			$comentario = 1; 
		}
		else
		{
			$comentario=0;
			$otros["comentarios"] = 0;
		}
		$bajada 	= $_POST["bajada"];
		$archivo 	= $_FILES['archivo']['name'];
		$archivo2 	= $_POST["archivo2"];
		$id_tema 	= $_POST["id_tema"];
		$ids_temas 	= $_POST["temas2"];   
		$archivos_upload = array('archivo','archivo_2','archivo_3');
		for($j=0;$j < count($archivos_upload); $j++)
		{
			if(trim($_FILES[$archivos_upload[$j]]['name']) != '')
			{
				$_FILES[$archivos_upload[$j]]['path'] = $dir.'/';
				$SALIDA = SIDTOOLHtml::guardarArchivo($_FILES[$archivos_upload[$j]],false); 
				$otros['nom_'.$archivos_upload[$j]] = $SALIDA['nombre_final'];
			}
		} 
		
		$titulo 		= $_POST["titulo"];
		$autor_orig 	= $_POST["autor_orig"];
		$ano_re 		= $_POST["ano_re"];
		$autor 			= $_POST["id_autor"];
		$pais 			= $_POST["pais"]; 
		$bajada 		= $_POST["bajada"]; 
		$tipo_archivo 	= $datousua["id_tipoarchivo"]; 
		 
		$otros['titulo'] 			= $_POST["titulo"];
		$otros['bajada'] 			= $_POST["bajada"];
		$otros['pais'] 				= $_POST["pais"];   
		$otros['comentarios'] 		= $_POST["comentarios"]; 
		$otros['autor_orig'] 		= $_POST["autor_orig"];
		$otros['ano_re'] 			= $_POST["ano_re"]; 
		$otros['id_tipoarchivo'] 	= $datousua["id_tipoarchivo"];
		if(trim($otros['nom_archivo']) == '')
		{
			$otros['nom_archivo'] 			= $_POST["archivo_anterior"];
		} 
		if(trim($otros['nom_archivo_2']) == '')
		{
			$otros['nom_archivo_2'] 			= $_POST["archivo_anterior_2"];
		}  
		if(trim($otros['nom_archivo_3']) == '')
		{
			$otros['nom_archivo_3'] 			= $_POST["archivo_anterior_3"];
		}  
		 
		$funcionAgrega = new rules();
		$resp = $funcionAgrega->Editarchivo($conn, $id_archivo,$tipo_archivo, $titulo,$autor,$pais,$fecha,$estado,$comentario,$bajada,$archivo2,$ids_temas,$dir, $autor_orig, $ano_re,$otros);
		
		$funcionAgrega->AgregarUsuariosResponsables($conn, $id_archivo,$_POST["usuarios"]); 
	 	 
		$datousua = $funcionDatosU->DetalleArchivo($conn, $_POST["id_archivo"]);
		
		if(false)
		{
			?>
			<script>
			var temax = <?echo $id_tema ?>;
			pagina = "herramientas.php?id_tema="+temax;
			window.location = pagina;
			</script>
			<? 
		}
	}   
   
   	$datousua["path"] = $dir;
   	$datousua["form_titulo"] = 'Editar Documento';
	// GeneralPrint($datousua);	
	
		 
	if(isset($_POST['BTcrear']) && $_POST['BTcrear'] == '.')
	{
		$datousua['id_tipoarchivo'] = $_POST["tipo_archivo"];
		$datousua['id_tema'] 		= $_POST['id_tema'];
		$datousua['id_autor'] 		= $_POST['id_autor']; 
   		$datousua["form_titulo"] 	= 'Nuevo Documento';
	}  
	foreach($datousua as $var => $val)
	{
		$datousua[$var] = htmlentities($val);
	}
	GeneralImprimirHeader('bloque_menu_herramientas');
 
 $funcionBusca = new rules();
 $tem=$funcionBusca->BuscaDetalleTema($conn, $datousua["id_tema"]); 
 $id_tipo_tema = $tem['id_tipotema'];
 $titulos_archivo = array();
 switch($id_tipo_tema)
 {
 	case 2:
		$titulos_archivo[1] = 'Archivo Adjunto 1 (PPT):';
		$titulos_archivo[2] = 'Archivo Adjunto 2 (WORD):';	 		
	break;
 	case 3:
		$titulos_archivo[1] = 'Estándar:';
		$titulos_archivo[2] = 'Indicadores:';		
		$titulos_archivo[3] = 'Ejemplos:';		
	break;
 }
?>
 
            
<div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
      <li class="ultimo"><a href="herramientas.php?id_tema=<? echo $row["id_tema"]; ?>" target="_top"> <? echo $tem['tema'];?></a></li> </ul>
      </div><!-- fin ruta --> 
 
    
         
         <?php
		 
		 include ('herramientas_menu.php');
		 ?> 
      <div class="conte"></p>
	  
			<script>
				var hay_responsables = false;
			</script>
	  <form name="feditaarchivo" target="_self" action="editar.php" method="post" onSubmit="return fValidaEditArchivo(this, '¿Esta seguro de modificar la información del Archivo?');" enctype="multipart/form-data"> 
        <table align="center" cellspacing="0" class="dato" >   
          <tbody>
            <tr>
              <th colspan="2" scope="col"> <?php echo $datousua["form_titulo"];?></th>
              </tr>
           
            <tr>
              <td width="150" class="linea1">T&iacute;tulo:</td>
              <td nowrap="nowrap"><input name="titulo" type="text" class="bloque" id="titulo" value="<?php echo $datousua["titulo"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/>
            </tr>
			 <? if ($id_tipo_tema == 2) {?>
						<tr id='fila_autor'>
			<td width="150" class="linea1">Autor:</td>
              <td nowrap="nowrap"><input name="autor_orig" type="text" class="bloque" id="autor_orig" value="<?php echo $datousua["autor_orig"]; ?>" size="70" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/>
            </tr>
									<tr id='fila_agno'>
			<td width="150" class="linea1">Año:</td>
              <td nowrap="nowrap"><input name="ano_re" type="text" class="bloque" id="ano_re" value="<?php echo $datousua["ano_re"]; ?>" size="4" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"/>
            </tr>

			            <tr id='fila_pais'>
              <td width="150" class="linea1">Pa&iacute;s:</td>
              <td nowrap="nowrap">
			  <select name='pais' id='pais' class='celdas_tabla'>
			  <option value=""></option>
			  <?        
				$paises = file("paises.txt");
				$cuenta = count($paises);
				for($i=0; $i < $cuenta; $i++){
			?>
 <option value="<?php echo $paises[$i];?>" <?php if(trim($paises[$i]) == trim($datousua["pais"])) echo "selected";?> > <?php echo $paises[$i]; ?></option>
 <? }?>
 </select>
			   </td>
            </tr>
			<? }  else { ?>
			<input name="autor_orig" type="hidden" id="autor_orig" value="sistema"  />
			 <input type="hidden" name="pais" value="Chile" />
			 <input name="ano_re" type="hidden"  id="ano_re" value="2010"  />
			<? } ?>
            <tr>
              <td class="linea2" >Descripci&oacute;n:</td>
              <td nowrap="nowrap" class="fondopeso2"><textarea name="bajada" cols="70" rows="13" class="bloque" id="bajada" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium; height:100px"><?php echo $datousua["bajada"]; ?></textarea></td>
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
              <td class="linea2" ><? echo $titulos_archivo[1];?></td>
              <td nowrap="nowrap" class="fondopeso2"> <span class="arriba">Ubicaci&oacute;n:</span><span class="arriba"> <br />
                        <input name="archivo" type="file" class="bloque" id="archivo" value=""   />
                        <br />
                        <span class="archivo"> <a href="bajando.php?archivo=<?php echo  $datousua["nom_archivo"]; ?>" target="_blank"><?php  echo $datousua["nom_archivo"]; ?></a><input name="archivo_anterior" id="archivo_anterior" type="hidden" value="<?php echo $datousua["nom_archivo"]; ?>"> </span> <span class="chico"> Peso m&aacute;ximo 6 Mb.</span></span> 
                   
                </td>
            </tr>
            <tr>
              <td   class="linea1"><? echo $titulos_archivo[2];?></td>
              <td nowrap="nowrap"  > <span class="arriba">Ubicaci&oacute;n:</span><span class="arriba"> <br />
                        <input name="archivo_2" type="file" class="bloque" id="archivo_2" value=""   />
                        <br />
                        <span class="archivo"> <a href="bajando.php?archivo=<?php echo  $datousua["nom_archivo_2"]; ?>" target="_blank"><?php  echo $datousua["nom_archivo_2"]; ?></a><input name="archivo_anterior_2" id="archivo_anterior_2" type="hidden" value="<?php echo $datousua["nom_archivo_2"]; ?>"> </span> <span class="chico"> Peso m&aacute;ximo 6 Mb.</span></span> 
                   
                </td>
            </tr>		
			
			 <? if ($id_tipo_tema == 3) {?>
            <tr>
              <td class="linea2" ><? echo $titulos_archivo[3];?></td>
              <td nowrap="nowrap" class="fondopeso2"> <span class="arriba">Ubicaci&oacute;n:</span><span class="arriba"> <br />
                        <input name="archivo_3" type="file" class="bloque" id="archivo_3" value=""   />
                        <br />
                        <span class="archivo"> <a href="bajando.php?archivo=<?php echo  $datousua["nom_archivo_3"]; ?>" target="_blank"><?php  echo $datousua["nom_archivo_3"]; ?></a><input name="archivo_anterior_3" id="archivo_anterior_3" type="hidden" value="<?php echo $datousua["nom_archivo_3"]; ?>"> </span> <span class="chico"> Peso m&aacute;ximo 6 Mb.</span></span> 
                   
                </td>
            </tr>				 
			 <? } ?>
			
				
            <tr>
              <td   class="linea1">Publicar:</td>
              <td nowrap="nowrap" ><span class="mapaAzul">
           <input type="radio" name="radio" id="radio" value="si" onClick="estado.disabled=false; " <?php if ($datousua["estado"]!= "0") echo "checked"; ?>/>
                Si&nbsp;&nbsp;
              <input type="radio" name="radio" id="radio" value="no" onClick="estado.disabled=true" <?php if ($datousua["estado"]== "0") echo "checked"; ?>/>
                No</span></td>
            </tr>
            <tr>
              <td class="linea2" >Estado:</td>
            <td  class="linea2" ><select name="estado" id="estado" <?php if ($datousua["estado"]== "0") echo "disabled"; ?>>
                <option value="1" <?php if ($datousua["estado"]== "1") echo "selected"; ?> >Publico</option>
                <option value="2" <?php if ($datousua["estado"]== "2") echo "selected"; ?> >Privado</option>
              </select></td>
                      </tr>
                      			
			<? if ($perfil==1) 
			{	?>
            <tr>
              <td class="linea1">Permitir Comentar:</td>
              <td nowrap="nowrap"><span class="mapaAzul"><input name="comentarios" type="checkbox" id="comentarios" value="1"<?php if($datousua["comentarios"]=="1") echo "checked"; ?></span></td>
            </tr>
			<? } ?>
			<? if ($id_tipo_tema == 3 && $perfil==1)
			 { 
				$funcionBusqueda = new rules(); 
	 			$usuarios = $funcionBusqueda->ListarUsuariosResponsable($conn,$datousua["id_archivo"]);  
			?>
			<script>
				 hay_responsables = true;
			</script>
			<tr>
              <td class="linea2">Usuarios Responsable:</td>
              <td class="linea2" nowrap="nowrap"> 
			  <?
			  	for($i=0; $i < count($usuarios);$i++)
			  	{
			  		?>
			  			<input type="checkbox" name="usuarios[]" value="<? echo $usuarios[$i]['id_usuario'];?>" <? if(trim($usuarios[$i]['id_archivo']) != '') echo "checked";?> /> <? echo $usuarios[$i]['firstname'].' '.$usuarios[$i]['lastname'];?><br />
			  		<?
			  	}
			  ?>
			  </td>
			</tr>
			<? } ?>
            
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