<?	
 session_start();	

 include ("conexion.php");
 include ("rules.php");

 $funcionBusqueda = new rules();
 $tipo = $_GET["tipo_archivo"];
 if(! isset($tipo)) $tipo = "0";
 
 if($_POST["BTAgregar"]=="Agregar Comentario"){
   $tema= $_POST["tema"];
   $fecha = date("Y-m-d");
   $funcionAgrega = new rules();
   $resp = $funcionAgrega->AgregaComentarioTema($conn,$_POST["titulo"],$_POST["autor"],$_POST["correo"],$fecha, $_POST["comentario"], $tema);
 }else{
    $tema = $_GET["id_tema"];
 }
 
if((!isset($_POST["BTBuscar"]))&&(!isset($_GET["BTBuscar"]))){
//-------Listar por un tema especifico-------//
 $autor_tema= $funcionBusqueda->BuscaAutortema($conn, $tema);
  $_SESSION["link_archivos"]= "archivos.php?id_tema=".$tema."&tema= ".$_GET["tema"]."& descripcion=".$_GET["descripcion"]."&descripcion2=".$_GET["descripcion2"]."& descripcion3=".$_GET["descripcion3"]."&img1=".$_GET["img1"]."&img2=".$_GET["img2"]."&img3=".$_GET["img3"]."&comentarios=".$_GET["comentarios"];
  $_SESSION["link_principal"]= "temas.php";
  
  if (isset($_SESSION['id_usuario'])) {
      $usuario = $_SESSION["id_usuario"];
      $perfil =  $_SESSION["per_usuario"];
      $nombre =  $_SESSION["nom_usuario"];
	  $sql = $funcionBusqueda->ListarArchivos($conn, $tema, $perfil, $usuario, $tipo);	  
      $sql_com = $funcionBusqueda->ComentariosTema($conn, $tema, $perfil, $usuario);
	  	    	 
  }else{ //usuario publico
     $sql = $funcionBusqueda->ListarArchivos($conn, $tema, "0", $usuario, $tipo);
     $sql_com = $funcionBusqueda->ComentariosTema($conn, $tema, "0", $usuario);
  }	 

 $comentarios=$_GET["comentarios"];
 $autor=$autor_tema;

	 
}else{
//-------------------------Listar segun Busqueda ------------------------------//
   if(isset($_POST["buscado"])) $buscado = $_POST["buscado"]; else $buscado = $_GET["buscado"];
   if(isset($_POST["opcion"])) $opcion = $_POST["opcion"]; else $opcion = $_GET["opcion"];

   $_SESSION["link_archivos"]= "archivos.php?buscado=".$buscado."&opcion=".$opcion."&BTBuscar=Buscar Archivos" ;
   $_SESSION["link_principal"]= "busqueda_archivos.php?buscado=".$buscado."&opcion=".$opcion;

 if (isset($_SESSION['id_usuario'])) {
   $usuario = $_SESSION["id_usuario"];
   $perfil =  $_SESSION["per_usuario"];
   $nombre =  $_SESSION["nom_usuario"];
   $sql = $funcionBusqueda->ListarArchivosBusq($conn, $buscado, $usuario, $opcion, $perfil, $tipo);
	  	    	 
  }else //usuario publico
       $sql = $funcionBusqueda->ListarArchivosBusq($conn, $buscado, "-1", $opcion, "0", $tipo);
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración de Documentos</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script.js"></script>

<style type="text/css">
<!--
.Estilo1 {font-size: 10px}
-->
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php if((!isset($_POST["BTBuscar"]))&&(!isset($_GET["BTBuscar"]))){ 
?>
  
  <tr>
    <th width="55%" scope="col" ><div align="left" class="titulos"><?php echo $_GET["tema"] ?></div></th>
	<?php
    if( (isset($_GET["img1"]))||(isset($_GET["img2"]))||(isset($_GET["img3"]))   ){
	?>
<th width="45%" rowspan="11" scope="col"><table width="100%" border="0" align="center">
      <tr>
        <td width="6%" valign="top">&nbsp;</td>
        <?php
		if((isset($_GET["img1"]))&&($_GET["img1"]!="")){
		?>
		<td width="32%" height="200" valign="top"><div align="center"><img src="<?php echo $rutaImg."/dir".$tema."/".$_GET["img1"] ?>" width="150" height="150" class="celdas_tabla" ></div></td>
		<?php
		}
		if((isset($_GET["img2"]))&&($_GET["img2"]!="")){
		?>
		<td width="31%" height="200" valign="bottom"><div align="center"><img src="<?php echo $rutaImg."/dir".$tema."/".$_GET["img2"] ?>" width="150" height="150" class="celdas_tabla" ></div></td>
		<?php
		}
		if((isset($_GET["img3"]))&&($_GET["img3"]!="")){
		?>
		<td width="31%" height="200" valign="top"><div align="center"><img src="<?php echo $rutaImg."/dir".$tema."/".$_GET["img3"] ?>" width="150" height="150" class="celdas_tabla" ></div></td>
		<?php
		}
  	    ?>
      </tr>
      
    </table></th>    
	
	<?php
    }
   ?>	
  </tr>
  <tr>
    <td valign="top" class="texto_libre"><div align="justify"><?php echo $_GET["descripcion"] ?></div></td>
    <td width="0%" valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre"><div align="justify"><?php echo $_GET["descripcion2"] ?></div></td>
    <td width="0%" valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre"><div align="justify"><?php echo $_GET["descripcion3"] ?></div></td>
    <td width="0%" valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="texto_libre">&nbsp;</td>
    <td valign="top" class="texto_libre">&nbsp;</td>
  </tr>
  
  <tr>
    <th colspan="3" scope="col">&nbsp;</th>
  </tr>
 <?php
 } //fin de no busqueda
 ?> 
  
  
  <tr>
    <th colspan="3" scope="col"><div align="left" class="titulos">Documentos Disponibles </div> 
	<?php
   if((!isset($_POST["BTBuscar"]))&&(!isset($_GET["BTBuscar"]))){	
	?>
	<div align="right" class="titulos">Tipo de Archivo
        <select name="tipo_archivo" id="tipo_archivo"  onChange="location.href='archivos.php?<?php echo "id_tema=".$tema."&tema=".$_GET["tema"]."&descripcion=".$_GET["descripcion"]."&img1=".$_GET["img1"]."&img2=".$_GET["img2"]."&img3=".$_GET["img3"]."&comentarios=".$comentarios."&tipo_archivo='+this.value" ; ?>">
        <option value="0" <?php if($tipo=="0") echo "selected" ?> >Todos</option>
        <?php
			  $sql2 = mysql_query("select * from tipos_archivos",$conn);
			  while ($id = mysql_fetch_array($sql2)) { 
			 ?>
        <option value="<?php echo $id["id_tipoarchivo"];?>" <?php if($tipo==$id["id_tipoarchivo"]) echo "selected"; ?> > <?php echo $id["tipo_archivo"]; ?></option>
        <?php
			  }//end while
			  ?>
        </select></div>
	  <?php
	  }
	  ?>	
		
		</th>
  </tr>
  <tr>
    <th colspan="3" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="3" scope="col">
   <?php 
   if(mysql_num_rows($sql) == 0){
   ?>
<table width="100%" border="0" align="center">
      
      <tr>
        <td class="texto_libre"><div align="justify">
            <div align="justify">El tema seleccionado no posee archivos asociados. </div>
        </div></td>
      </tr>
    </table>
	<?php 
   }else
    while ($archivo = mysql_fetch_array($sql)) { 
	  
   ?> 
	<table width="100%" border="0" align="center">
      <tr>
        <th width="31%" class="titulo_tabla" scope="col"><div align="left">Titulo</div></th>
        <th width="13%" class="titulo_tabla" scope="col">Tipo Archivo </th>
        <th width="23%" class="titulo_tabla" scope="col">Autor</th>
        <th width="9%" class="titulo_tabla" scope="col">Pais</th>
        <th width="13%" class="titulo_tabla" scope="col">Fecha Publicaci&oacute;n </th>
        <th width="11%" colspan="2" class="titulo_tabla" scope="col"><div align="left">Estado</div></th>
      </tr>
      <tr>
        <td class="celdas_tabla"><a href="#" onClick="location.replace('<?php echo "detalle_archivo.php?id_archivo=".$archivo["id_archivo"]."&id_tema=".$_GET["id_tema"]."&descripcion=".$_GET["descripcion"]."&descripcion2=".$_GET["descripcion2"]."&descripcion3=".$_GET["descripcion3"]."&tema=".$_GET["tema"] ?>')"><?php echo $archivo["titulo"]; ?></a></td>
        <td class="celdas_tabla"><?php echo $archivo["tipo_archivo"]; ?></td>
        <td class="celdas_tabla"><?php echo $archivo["firstname"]." ".$archivo["lastname"]; ?></td>
        <td class="celdas_tabla"><?php echo $archivo["pais"]; ?></td>
        <td class="celdas_tabla"><div align="center"><?php echo Formatofecha($archivo["fec_publicacion"]); ?></div></td>
        <td colspan="2" class="celdas_tabla"><?php if($archivo["estado"]=='0') echo "Desactivado"; else if($archivo["estado"]=='1') echo "P&uacute;blico"; else if($archivo["estado"]=='2') echo "Privado"; ?></td>
      </tr>
      <?php  if(($perfil=="1")||($perfil=="2")) {
     ?>
      <tr>
        <td colspan="7" class="celdas_tabla"><table width="100%" border="0">
            <tr>
              <th width="9%" class="titulos" scope="col">Opciones</th>
             <th width="5%" scope="col">&nbsp;</th>
              <?php  
		         if(($perfil=="1")||( ($perfil=="2")&&($archivo["id_autor"]==$usuario) ) ){
		      ?>
			  <th width="82%" scope="col">
			  <table width="31%" height="16" border="0" align="left">
                <tr>
                  <th width="6%">&nbsp;</th>
                  <form name="feditar" target="fprincipal" action="editar_archivo.php" method="post">
  			        <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $archivo["id_archivo"] ?>">
  			        <input name="id_autor" id="id_autor" type="hidden" value="<?php echo $archivo["id_autor"] ?>">
  			        <input name="id_tema" id="id_tema" type="hidden" value="<?php echo $archivo["id_tema"] ?>">
		            <input name="tema" id="tema" type="hidden" value="<?php echo $_GET["tema"]; ?>">
		            <input name="descripcion" id="descripcion" type="hidden" value="<?php echo $_GET["descripcion"]; ?>">
  			        <input name="autor" id="autor" type="hidden" value="<?php echo $archivo["firstname"]." ".$archivo["lastname"] ?>">
  			        <input name="titulo" id="titulo" type="hidden" value="<?php echo $archivo["titulo"] ?>">
  			        <input name="bajada" id="bajada" type="hidden" value="<?php echo $archivo["bajada"] ?>">
  			        <input name="pais" id="pais" type="hidden" value="<?php echo $archivo["pais"] ?>">
  			        <input name="fecha" id="fecha" type="hidden" value="<?php echo $archivo["fec_publicacion"] ?>">
  			        <input name="nom_archivo" id="nom_archivo" type="hidden" value="<?php echo $archivo["nom_archivo"] ?>">
  			        <input name="estado" id="estado" type="hidden" value="<?php echo $archivo["estado"] ?>">
  			        <input name="comentarios" id="comentarios" type="hidden" value="<?php echo $archivo["comentarios"] ?>">
  			        <input name="id_tipoarchivo" id="id_tipoarchivo" type="hidden" value="<?php echo $archivo["id_tipoarchivo"] ?>">
                    <th width="24%"> <input name="BTEditar" type="submit" class="botones" value="Editar"></th>
                  </form>
            <form name="fdesactivar" target="fprincipal" action="desactivar_archivo.php" method="post"><th width="24%">
              <input name="Submit3" type="button" class="botones" value="Activaci&oacute;n" onClick="if (confirm('¿Estas seguro que cambiar el estado del archivo?')){ document.location.href='<?php echo "activacion.php?id_archivo=".$archivo["id_archivo"]."&estado=".$archivo["estado"]."&id_tema=".$archivo["id_tema"]."&tema=".$_GET["tema"]."&descripcion=".$_GET["descripcion"]."&flag=2";  ?>'}"></th> 
            </form>
                  <form name="fborrar" target="fprincipal" action="borrar_tema.php">
                    <th width="21%"><input name="Submit32" type="button" class="botones" value="Borrar" onClick="if (confirm('¿Estas seguro de borrar el archivo?')){ document.location.href='<?php echo "eliminacion.php?id_archivo=".$archivo["id_archivo"]."&id_tema=".$archivo["id_tema"]."&tema=".$_GET["tema"]."&descripcion=".$_GET["descripcion"]."&flag=2"."&archivo=".$archivo["nom_archivo"]; ?>'}"></th>
                  </form>
                  <th width="4%">&nbsp;</th>
                </tr>
              </table></th>
		      <?php }//end if
		       else{ 
		       if( ($perfil=="2")&&($archivo["ar.id_autor"]!=$usuario) ){
		      ?>
              <td width="82%" scope="col"><div align="center" class="texto_libre">
                <div align="left">Sin opciones</div>
              </div></td>
		      <?   
			    }//end if
		        } //end else
		      ?>
              <th width="4%" scope="col">&nbsp;</th>
            </tr>
        </table></td>
      </tr>
	 <?php
	 }//end if
    ?>  
   <tr>
    <th scope="col">&nbsp;</th>
   </tr>	  
    </table>
	<?php
     }	//end while
	?>	</th>
  </tr>
  <tr>
    <th colspan="3" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="3" scope="col"><table width="100%" height="16" border="0">
      <tr>
        <th width="35%">&nbsp;</th>
		<?php
        if((!isset($_POST["BTBuscar"]))&&(!isset($_GET["BTBuscar"]))){ 
		?>
        <form name="fagregar" target="fprincipal" action="agregar_archivo.php" method="post">
		<?php if(($perfil=="1")||( ($perfil=="2")&&($autor_tema==$usuario) ) ){
	    ?>
          <th width="17%"> 
		  <input name="id_tema" id="id_tema" type="hidden" value="<?php echo $tema; ?>">
		  <input name="tema" id="tema" type="hidden" value="<?php $_GET["tema"]; ?>">
		  <input name="id_autor" id="id_autor" type="hidden" value="<?php echo $autor_tema; ?>">
		  <input name="tema" id="tema" type="hidden" value="<?php echo $_GET["tema"]; ?>">
          <input name="autor" id="autor" type="hidden" value="<?php echo $nombre; ?>">		 
		  <input name="descripcion" id="descripcion" type="hidden" value="<?php echo $_GET["descripcion"]; ?>">
          <input name="BTAgregar" type="submit" class="botones" value="Agregar Nuevo Archivo"></th>
   	    <?php
	    }
	    ?>
        </form>
   	    <?php
	    }
	    ?>
        <th width="9%"><input name="BTcancelar" type="button" class="botones" id="BTcancelar" value="Volver" onClick="javascript:window.location='<?php echo $_SESSION["link_principal"]; ?>'" ></th>
        <th width="39%">&nbsp;</th>
      </tr>
    </table></th>
  </tr>
</table>
<?php if((!isset($_POST["BTBuscar"]))&&(!isset($_GET["BTBuscar"]))){ 
?>
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="texto_libre">
  <?php 
   if(mysql_num_rows($sql_com) == 0){
     echo "EL Tema no posee comentarios";
  }else
  while ($com = mysql_fetch_array($sql_com)) { 
 ?> 
	<table width="100%" border="0">
      <tr>
        <td width="82%" class="titulos"><?php echo $com["titulo_comentario"]  ?></td>
        <td colspan="2" rowspan="2"><?php
		if(($perfil=="1")||( ($perfil=="2")&&($autor==$usuario) ) ){
		?>
            <table width="100%" border="0">
              <tr>
                <td class="texto_libre"><strong class="texto_libre Estilo1">Opciones</strong></td>
                <td colspan="2" class="texto_libre"><div align="center">
                  <?php if ($com["estado"]=="1") echo "Activado"; else echo "Desactivado";  ?>
                </div></td>
              </tr>
              <tr>
                <form action="editar_comentario_tema.php" method="post">
                  <input type="hidden" name="id_comentario" value="<?php echo $com["id_comentario"]; ?>" />
                  <input type="hidden" name="id_tema" value="<?php echo $com["id_tema"]; ?>" />
                  <input type="hidden" name="titulo" value="<?php echo $com["titulo_comentario"]; ?>" />
                  <input type="hidden" name="autor" value="<?php echo $com["autor_comentario"]; ?>" />
                  <input type="hidden" name="correo" value="<?php echo $com["correo"]; ?>" />
                  <input type="hidden" name="comentario" value="<?php echo $com["comentario"]; ?>" />
                  <input type="hidden" name="fecha" value="<?php echo Formatofecha($com["fec_comentario"]); ?>" />
                  <td width="30%"><input name="BTEditar" type="submit" class="botones" value="Editar" /></td>
                </form>
                <td width="39%"><input name="Submit33" type="button" class="botones" value="Activaci&oacute;n" onClick="if (confirm('&iquest;Estas seguro que cambiar el estado del comentario del tema?')){ document.location.href='<?php echo "activacion.php?id_comentario=".$com["id_comentario"]."&estado=".$com["estado"]."&id_archivo=".$com["id_archivo"]."&flag=4";  ?>'}" /></td>
                <td width="31%"><input name="Submit322" type="button" class="botones" value="Borrar" onClick="if (confirm('&iquest;Estas seguro de borrar el comentario definitivamente?')){ document.location.href='<?php echo "eliminacion.php?id_comentario=".$com["id_comentario"]."&flag=5";  ?>'}" /></td>
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
    </table>
	<?php
	 }
	?>
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<?php if($comentarios != "0") { ?>
	<form name="fagregacomentario" target="fprincipal" action="archivos.php?<?php echo "tema= ".$_GET["tema"]."& descripcion=".$_GET["descripcion"]."&img1=".$_GET["img1"]."&img2=".$_GET["img2"]."&img3=".$_GET["img3"]."&comentarios=".$_GET["comentarios"];  ?>" method="post" onSubmit="return fValidaInsertComentario(this, '¿Esta seguro de agregar el comentario al tema seleccionado?');">
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
              <input name="titulo" type="text" id="titulo2" size="44" />
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="texto_libre">Autor</td>
              <td><label>
                <input name="autor" type="text" id="autor2" size="44" />
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
        </table>
     	</td>
      </tr>
      <tr>
        <td ><table width="100%" height="20" border="0">
            <tr>
              <th width="40%" scope="col">&nbsp;</th>
              <th width="15%" scope="col"><div align="right">
                  <input name="tema" id="tema" type="hidden" value="<?php echo $tema; ?>" />
                  <input name="BTAgregar" type="submit" class="botones" id="BTAgregar" value="Agregar Comentario"  >
              </div></th>
              <th width="1%" scope="col">&nbsp;</th>
              <th width="10%" scope="col"><div align="left">
                <input name="BTcancelar2" type="button" class="botones" id="BTcancelar2" value="Volver" onClick="javascript:window.location='<?php echo $_SESSION["link_principal"]; ?>'" >
              </div></th>
              <th width="40%" scope="col">&nbsp;</th>
            </tr>
        </table></td>
      </tr>
    </table>
	</form>
    <?php } ?>
	
	
	
	</td>
  </tr>
</table>
<?php
 } // fin de no busqueda
?>
</body>
