<?	
 session_start();	
 include ("conexion.php");
 include ("rules.php");
 $funcionBusqueda = new rules();
 $tipo = $_GET["tipo_tema"];
 if(! isset($tipo)) $tipo = "0";


 if (isset($_SESSION['id_usuario'])) {
      $usuario = $_SESSION["id_usuario"];
      $perfil =  $_SESSION["per_usuario"];
      $nombre =  $_SESSION["nom_usuario"];
	  $sql = $funcionBusqueda->ListarTemas($conn, $perfil, $usuario, $tipo);	  
	  	    	 
 }else //usuario publico
    $sql = $funcionBusqueda->ListarTemas($conn, "0", $usuario, $tipo);
	
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración de Documentos</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="43%" class="titulos" scope="col"><div align="left">Temas de Investigaci&oacute;n
    </div></th>
    <th width="57%" class="titulos" scope="col">
      <div align="right">Tipo de Documentos del Area Tem&aacute;tica
			  <select name="tipo_tema" id="tipo_tema" onChange="location.href='temas.php?tipo_tema='+this.value">
			    <option value="0"  <?php if($tipo=="0") echo "selected" ?> >Todos</option>
			    <?php
			  $sql2 = mysql_query("select * from tipos_temas",$conn);
			  while ($id = mysql_fetch_array($sql2)) { 
			 ?>
			    <option value="<?php echo $id["id_tipotema"];?>" <?php if($tipo==$id["id_tipotema"]) echo selected ?> > <?php echo $id["tipo_tema"]; ?></option>
			    <?php
			  }//end while
			  ?>
		      </select>
      </div></th>
  </tr>
  <tr>
    <th colspan="2" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="2" scope="col"><table width="100%" border="0" align="center">
      <tr>
        <th width="31%" class="titulo_tabla" scope="col"><div align="left">Area Tem&aacute;tica </div></th>
        <th width="14%" class="titulo_tabla" scope="col">Tipo de Documentos </th>
        <th width="20%" class="titulo_tabla" scope="col"><div align="left">Autor</div></th>
        <th width="10%" class="titulo_tabla" scope="col"><div align="left">Estado</div></th>
		<?php  if(($perfil=="1")||($perfil=="2")) {
		?>
        <th width="20%" class="titulo_tabla" scope="col">Opciones</th>
		<?php }
		?>
      </tr>

 <?php while ($tema = mysql_fetch_array($sql)) { 
    $_SESSION["link_des"]= "archivos.php?id_tema=".$tema["id_tema"]."&tema= ".$tema["tema"]."&descripcion=".$tema["descripcion"]."&descripcion2=".$tema["descripcion2"]."&descripcion3=".$tema["descripcion3"]."&img1=".$tema["img1"]."&img2=".$tema["img2"]."&img3=".$tema["img3"]."&comentarios=".$tema["comentarios"];
 ?> 
	  <tr>
        <td class="celdas_tabla" ><a href="#" onClick="location.replace('<?php echo $_SESSION["link_des"]; ?>');"><?php echo $tema["tema"] ?></a></td>
        <td class="celdas_tabla" ><?php echo $tema["tipo_tema"]; ?></td>
        <td class="celdas_tabla" ><div align="left"><?php echo $tema["firstname"]." ".$tema["lastname"]; ?></div></td>
        <td class="celdas_tabla"><?php if($tema["estado"]=='0') echo "Desactivado"; else if($tema["estado"]=='1') echo "Público"; else if($tema["estado"]=='2') echo "Privado"; ?></td>
		<?php  
		  if(($perfil=="1")||( ($perfil=="2")&&($tema["id_autor"]==$usuario) ) ){
		?>
        <td class="celdas_tabla">
		  <table width="100%" height="16" border="0">
          <tr>
            <th width="6%">&nbsp;</th>
            <form name="fagregar" target="fprincipal" action="agregar_tema.php">
            </form>
            <form name="feditar" target="fprincipal" action="editar_tema.php" method="post">
			<input name="id_tema" id="id_tema" type="hidden" value="<?php echo $tema["id_tema"]; ?>">
			<input name="tema" id="tema" type="hidden" value="<?php echo $tema["tema"]; ?>">
			<input name="descripcion" id="descripcion" type="hidden" value="<?php echo $tema["descripcion"]; ?>">
			<input name="descripcion2" id="descripcion2" type="hidden" value="<?php echo $tema["descripcion2"]; ?>">
			<input name="descripcion3" id="descripcion3" type="hidden" value="<?php echo $tema["descripcion3"]; ?>">
			<input name="estado" id="estado" type="hidden" value="<?php echo $tema["estado"]; ?>">
			<input name="id_autor" id="id_autor" type="hidden" value="<?php echo $tema["id_autor"]; ?>">
			<input name="id_tipotema" id="id_tipotema" type="hidden" value="<?php echo $tema["id_tipotema"]; ?>">
			<input name="autor" id="autor" type="hidden" value="<?php echo $tema["firstname"]." ".$tema["lastname"]; ?>">
			<input name="img1" id="img1" type="hidden" value="<?php echo $tema["img1"]; ?>">
			<input name="img2" id="img2" type="hidden" value="<?php echo $tema["img2"]; ?>">
			<input name="img3" id="img3" type="hidden" value="<?php echo $tema["img3"]; ?>">
			<input name="comentarios" id="comentarios" type="hidden" value="<?php echo $tema["comentarios"]; ?>">
			<th width="24%"><input name="Submit2" type="submit" class="botones" value="Editar"></th>
            </form>
            <form name="fdesactivar" target="fprincipal" action="desactivar_tema.php" method="post"><th width="21%">
              <input name="Submit3" type="button" class="botones" value="Activaci&oacute;n" onClick="if (confirm('¿Estas seguro que cambiar el estado al tema?')){ document.location.href='<?php echo "activacion.php?id_tema=".$tema["id_tema"]."&estado=".$tema["estado"]."&flag=1";  ?>'  }"></th> 
            </form>
            <form name="fborrar" target="fprincipal" action="borrar_tema.php" method="post"><th width="21%">
              <input name="Submit3" type="button" class="botones" value="Borrar" onClick="if (confirm('¿Esta seguro de eliminar el tema y sus archivos definitivamente?')){ document.location.href='<?php echo "eliminacion.php?id_tema=".$tema["id_tema"]."&flag=1";  ?>'  }"></th>
            </form>
            <th width="4%">&nbsp;</th>
          </tr>
        </table>		</td>
		<?php }//end if
		   else{ 
		    if( ($perfil=="2")&&($tema["id_autor"]!=$usuario) ){
		 ?>
        <td width="5%" class="celdas_tabla"><div align="center">Sin opciones</div></td>
		 <?   
			}//end if
		   } //end else
		?>
		</tr>
		<?php } //end while
		?>
		
		<tr>
              <td colspan="5" ><table width="100%" height="16" border="0">
                <tr>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
				<?php  if(($perfil=="1")||($perfil=="2")) {
		        ?>
                <tr>
                  <th width="6%">&nbsp;</th>
                  <form name="fagregar" target="fprincipal" action="agregar_tema.php" method="post">
			             <input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $usuario; ?>">
                    <th> <input name="Submit5" type="submit" class="botones" value="Agregar Nuevo Tema"></th>
                  </form>
                  <th width="4%">&nbsp;</th>
                </tr>
				<?php }
				?>
              </table></td>
        </table></th>
  </tr>
</table>
</body>
