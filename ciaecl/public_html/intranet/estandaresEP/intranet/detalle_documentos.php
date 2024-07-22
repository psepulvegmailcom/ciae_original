<?php

 include ("header.php");    

 $usuario = $_SESSION["id_usuario"];
 $perfil =  $_SESSION["per_usuario"];
 $nombre =  $_SESSION["nom_usuario"];
  
 $funcionBusca = new rules();
   
 $id_tema = $_GET["id_tema"];
 if(trim($id_tema) == '')
 {
 	 $tema = $funcionBusca->getTemaArchivo($conn, $_POST['id_archivo']);
	  $id_tema = $tema[0]['id_tema']; 
 }
 
 $tem = $funcionBusca->BuscaDetalleTema($conn, $id_tema); 
 
 $id_tipo_tema = $tem['id_tipotema'];
 
$funcionDatos = new rules(); 
$datous = $funcionDatos->TraeUsuario($conn, $_SESSION["id_usuario"]);
$datousuario = mysql_fetch_array($datous); 
 
 
  if($_POST["BTAgregar"]=="Guardar")
  {
   $archivo = $_POST["id_archivo"];
   $id_archivo = $_POST["id_archivo"];
   $fecha = date("Y-m-d H:i:s");
   $funcionAgrega = new rules(); 
   $resp = $funcionAgrega->AgregaComentario($conn,$_POST["titulo"],$_POST["autor"],$_POST["correo"],$fecha, $_POST["comentario"], $archivo,$_POST['tipo_comentario']);
   $id_archivo=$archivo;
  
 }
 else
 {
    $id_archivo=$_GET["id_archivo"];
	 $_SESSION["link_detalle"]="detalle_archivo.php?id_archivo=".$_GET["id_archivo"]."&id_tema=".$_GET["id_tema"]."&descripcion=".$_GET["descripcion"]."&tema=".$_GET["tema"]; 
 } 
 $funcionBusqueda = new rules();
 $row = $funcionBusqueda->DetalleArchivo($conn, $id_archivo); 
  
 $responsablesU = $funcionBusqueda->listarUsuariosResponsableConsulta($conn,$id_archivo);   
 
 $sql = $funcionBusqueda->ComentariosArchivo($conn, $id_archivo, $perfil, $usuario);
	 
 $comentarios=$row["comentarios"];
 $autor=$row["id_autor"];
 
 	$enlace = "../".$ruta."/".$row["nom_archivo"];
	 
	$tam = @filesize("$enlace");
	$kas=$tam/1024;
	$final=round($kas,0); //*
	
 	$enlace = "../".$ruta."/".$row["nom_archivo_2"]; 
	$tam = @filesize("$enlace");
	$kas=$tam/1024;
	$final_2=round($kas,0); //*
 	$enlace = "../".$ruta."/".$row["nom_archivo_3"]; 
	$tam = @filesize("$enlace");
	$kas=$tam/1024;
	$final_3=round($kas,0); //*
	
 $ext = $row["nom_archivo"];
 $partes = pathinfo($ext);
 $partes_ruta = $partes['extension'];
	 if ($partes_ruta=="pdf"){
	   $icono_="icono_pdf.gif";
	   }else
	   if ($partes_ruta=="ppt" || $partes_ruta=="pps" || $partes_ruta=="pptx" ){
	   $icono_="icono_ppt.gif";
	   }else
	   if ($partes_ruta=="xls" || $partes_ruta=="xlsx" ){
	   $icono_="icono_excel.gif";
	   }else
	   if ($partes_ruta=="doc" || $partes_ruta=="docx" ){
	   $icono_="icono_word.gif";
	   }else
	   if ($partes_ruta=="zip" || $partes_ruta=="rar" ){
	   $icono_="icono_zip.gif";
	   }else {
	   	$icono_="icono_pdf.gif";
	   } 

GeneralImprimirHeader('bloque_menu_herramientas');


?>
 <script>
showId('subtema_div_<?php echo $_GET["id_tema"];?>'); 
</script>
            
<div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
        <li class="ultimo"><a href="herramientas.php?id_tema=<? echo $row["id_tema"]; ?>" target="_top"> <? echo $tem['tema'];?></a></li> 
        <li class="ultimo">Detalle</li>
      </ul>
      </div><!-- fin ruta --> 
    <div class="clear"></div>
		<!--<div  style="float:right; position:absolute;  width:117px; left:800px">
    <img src="images/interior/ico_doc.gif" alt="foto" width="198" height="204" class="fotoDer1" /> </div>  -->     
    <!--<h1>Documento</h1>-->
          <h2 style="  "><?php echo $row["titulo"]  ?></h2> 
		  
		  <? if ($id_tipo_tema == 2) {?>
		  
          <p><span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Autor:&nbsp;</span><?php   echo $row["autor_orig"];  ?><br />		  
          <span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Año:&nbsp;</span><?php echo $row["ano_re"]; ?>
          <br />  
          <!--<span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Cita APA:&nbsp;</span><?php echo $row["cita_apa"]; ?>-->
          
		  <span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Pa&iacute;s:&nbsp;</span><?php echo $row["pais"]  ?>
		  
		  <? } ?>
		  
		  
		  </p>		            <p><span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Publicado por:&nbsp;</span><?php echo $row["firstname"]." ".$row["lastname"];  ?><br /><span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" />
		  Fecha:</span> <?php echo Formatofecha($row["fec_publicacion"])  ?></p>
					<br />

          <div class="listado pin">
     <!-- <p class="fecha"><?php echo Formatofecha($row["fec_publicacion"])  ?></p>-->
      <!--p class="titulo">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</p-->
      <p> <?php echo $row["bajada"];  ?></p>
      <!--p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.</p-->
      
      <p>&nbsp;</p>
      <table align="center" cellspacing="0" class="dato">
        <tfoot>
        </tfoot>
        <tbody>
	<?
	if($id_tipo_tema == 3 )
	{ 
		$funcionDatosU = new rules(); 
		$indicadores 	= $funcionDatosU->EPIndicadores($id_archivo);
		$ejemplos 		= $funcionDatosU->EPEjemplos($id_archivo);
		?>
		  <tr>
            <th scope="col">Indicadores</th> 
          </tr>
          <tr>
          <?
		  if(count($indicadores) > 0)
		  { 
		  	for($j=0; $j < count($indicadores); $j++)
		  	{
		  		$k = $j +1;
		  	?>
			  <tr><td>
			  <? echo $k.'.- '.$indicadores[$j]['indicador'];?>
			  </td><tr>
			  <?
		  }
		  }
		  ?>
          </tr>
		  <tr>
            <th scope="col">Ejemplos</th>
             
          </tr> <tr>
          <?
		  if(count($ejemplos) > 0)
		  { 
		  	for($j=0; $j < count($ejemplos); $j++)
		  	{
		  		$k = $j +1;
		  	?>
			  <tr><td>
			  <? echo $k.'.- '.$ejemplos[$j]['ejemplo'];?>
			  </td><tr>
			  <?
		  }
		  }
		  ?>
          </tr>
		<?
	}
	else
	{?>

          <tr>
            <th scope="col">&nbsp;</th>
            <th nowrap="nowrap" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td class="linea1"> <?php echo $row["nom_archivo"]  ?> </td>
            <td width="115" nowrap="nowrap"><a href="bajando.php?archivo=<?php echo $row["nom_archivo"];?>"><img src="images/<? echo $icono_;?>" alt="pdf" width="34" height="18" border="0" /></a><? echo $final;?> kb </td>
          </tr>
          <tr>
            <td class="linea1"> <?php echo $row["nom_archivo_2"]  ?> </td>
            <td width="115" nowrap="nowrap"><a href="bajando.php?archivo=<?php echo $row["nom_archivo_2"];?>"><img src="images/<? echo $icono_;?>" alt="pdf" width="34" height="18" border="0" /></a><? echo $final_2;?> kb </td>
          </tr>
		  <? if ($id_tipo_tema == 3) {?>
          <tr>
            <td class="linea1"> <?php echo $row["nom_archivo_3"]  ?> </td>
            <td width="115" nowrap="nowrap"><a href="bajando.php?archivo=<?php echo $row["nom_archivo_3"];?>"><img src="images/<? echo $icono_;?>" alt="pdf" width="34" height="18" border="0" /></a><? echo $final_3;?> kb </td>
          </tr>
		  <? }  
		  
		   } ?>
       
        </tbody>
      </table>
      <p>&nbsp;</p>
      <div id="lineahor"><img src="images/1x1.gif" alt="nada" /></div>
	  			
  <?php 
   if(mysql_num_rows($sql) == 0){
     echo "<td colspan=\"4\" class=\"texto_libre\" >EL archivo no posee comentarios</td>";
  }else
  {
  ?>
  
	<p class="titulos">Comentarios</p>
	<div style="overflow:scroll; height:300px;">
  <?php
  while ($com = mysql_fetch_array($sql)) { 
  	 
 ?> 

	<p><span class="fecha"><?php echo  $com["fec_comentario"]  ?> - </span> <span class="epigrafe"> <span class="negrillas"><?php echo $com["autor_comentario"]  ?>:</span> 
	<?php echo " (".$com["tipo_comentario"].")  ".$com["comentario"]  ?></span>
	           <!-- <input name="Submit32" type="button" class="botones" value="Borrar" onclick="if (confirm('&iquest;Estas seguro de borrar el comentario definitivamente?')){ document.location.href='<?php echo "eliminacion.php?id_comentario=".$com["id_comentario"]."&id_archivo=".$com["id_archivo"]."&flag=3";  ?>'}" />--></p>
	<? }} ?>
	</div>
		<?php if($comentarios != "0"   ) 
		{ 
		
		  ?>
	     <form name="fagregacomentario" target="_self" action="detalle_documentos.php" method="post" onSubmit="return fValidaInsertComentario(this, '¿Esta seguro de agregar el comentario al archivo seleccionado?');">
		 
	<table align="center" cellspacing="0" class="dato">
      <tbody>
        <tr>
          <th width="100" nowrap="nowrap" scope="col">&nbsp;</th>
          <th nowrap="nowrap" scope="col">&nbsp;</th>
        </tr>
        <tr>
          <td class="linea1"><a href="javascript:;">Nombre: </a></td>
          <td nowrap="nowrap"><font face="Arial" size="1">
		  <input name="titulo" type="hidden" id="titulo" size="44" value="comentario" />
            <input name="autor" id="autor"  readonly="readonly" value="<?php echo $datousuario['firstname'].' '.$datousuario['lastname'];?>" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium" size="70" maxlength="200" />
          </font></td>
        </tr>
		<tr>
		          <td class="linea1"><a href="javascript:;">E-mail: </a></td>
          <td nowrap="nowrap"><font face="Arial" size="1">
            <input name="correo" id="correo"  readonly="readonly" value="<?php echo $datousuario['email'];?>"style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium" size="40" maxlength="100" />
          </font></td>
		</tr>
        
        <?
		if($id_tipo_tema == 3 ) //&& (isset($responsablesU[$usuario]) || $perfil == 1)
		{?>
		
		<tr>
          <td class="linea1"><a href="javascript:;">Tipo comentario: </a></td>
		  <td nowrap="nowrap"><select name="tipo_comentario">
		  <option  value="Estándar">Estándar</option>
		  <option value="Indicadores">Indicadores</option>
		  <option value="Ejemplos">Ejemplos</option>
		  </select>
		  </td>
		  </tr> 
		<? }
		else
		
		{?>
			<input type="hidden" name="tipo_comentario" value="" />
		<?
		}
		 ?>
		
		?>
        <tr>
          <td class="linea1"><a href="javascript:;">Mensaje: </a></td>
          <td nowrap="nowrap"><font face="Arial" size="1">
            <textarea name="comentario" cols="71" rows="4" id="comentario" style="font-family: Arial; font-size: 9; background-color: rgb(224,231,235); border: medium"></textarea>
          </font></td>
        </tr>
        <tr>
          <td nowrap="nowrap" class="fondopeso2">&nbsp;</td>
          <td nowrap="nowrap" class="fondopeso2"> 
          <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $id_archivo; ?>" />
		  <!--img src="images/bot_comentar.gif" width="85" height="17" border="0" /--><input name="BTAgregar" type="submit"  id="BTAgregar" value="Guardar" ></td>
        </tr>
      </tbody>
    </table>
	</form>
	  
	
	<? }?>
	<p>&nbsp;</p>
        </div>
</div> 
        
            <!-- fin contenido -->    
</div> 

 

<?php

GeneralImprimirFooter();

?>