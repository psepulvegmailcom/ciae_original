<?	

 include ("header.php"); 
 $funcionBusqueda = new rules();
 $tipo = $_GET["tipo_tema"];
 if(! isset($tipo)) $tipo = "0";


 if (isset($_SESSION['id_usuario'])) {
      $usuario = $_SESSION["id_usuario"];
      $perfil =  $_SESSION["per_usuario"];
      $nombre =  $_SESSION["nom_usuario"];
	  $sql = $funcionBusqueda->ListarDiarios($conn, $perfil, $usuario, $tipo);	  
	  	    	 
 }else //usuario publico
   {
    $sql = $funcionBusqueda->ListarDiarios($conn, "0", $usuario, $tipo);
	}
	

GeneralImprimirHeader();
	
?>
   
<div id="contenido"  >
  <div id="ubica" >
    <ul>
      <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
      <li class="ultimo">Presentación</li>
    </ul>
  </div>
  <!-- fin ruta -->
  <div class="clear"></div>
  <h1>Presentación</h1>
  <p>&nbsp;</p>
  <h3>Presentación. </h3>
  <p>Este es un sitio especialmente creado para cargar los archivos  correspondientes al proyecto <strong>&ldquo;Elaboraci&oacute;n de est&aacute;ndares para orientar  la formaci&oacute;n inicial de educadora/es de p&aacute;rvulos, en los &aacute;mbitos de  formaci&oacute;n personal y social, comunicaci&oacute;n, y relaci&oacute;n con el medio  natural y cultural, para ni&ntilde;os y ni&ntilde;as entre 0 a 6 a&ntilde;os de edad&rdquo;</strong>.  </p><p>Dir&iacute;jase a la opci&oacute;n <a href="herramientas.php"><strong>&ldquo;Referencias bibliogr&aacute;ficas&rdquo;</strong></a> ubicada al costado  superior izquierdo, haga click y luego ubique en el listado que se  desplegar&aacute;, el texto que le correspondi&oacute; fichar. Haga click sobre la  opci&oacute;n Editar, complete los datos que se solicitan y &ldquo;cargue&rdquo; los  archivos.  </p>
  <p>Dir&iacute;jase a opci&oacute;n <a href="herramientas.php?id_tema=35"><strong>&quot;Est&aacute;ndares&quot;</strong></a> para editar o comentar est&aacute;ndares e indicadores</p>
  <p>&nbsp;</p>
  <div id='destacados'>
	 <?php 
	 	$i = 0;
	 while ($tema = mysql_fetch_array($sql)) { 
	 	$i = $i+1;
?>
      <div class='primeros'>
      <p class='fecha'><img src='images/interior/ico_otros.gif' alt='ford62x62.jpg' width="68" height="69" class='fotonoti' /></p>
      <p class='epigrafe'><?php echo $tema["tema"] ?></p>
      <p class='titulo'><?php echo $tema["descripcion"] ?> </p>
      <p class='titulo'><!--a href="detalle_diario.html" onmouseover="MM_swapImage('Image21','','images/bot_detalle2.gif',1)" onmouseout="MM_swapImgRestore()"--><a href="#" onClick="location.replace('detalle_diario.php?id_tema=<?php echo $tema["id_tema"]; ?>');"><img src="images/bot_detalle.gif" name="Image21" width="80" height="17" border="0" id="Image21" /></a></p>
      <p class='titulo'>&nbsp;</p>
    </div>
	<? 
		if ( ($i > 1)&&($i % 2) == 0){
		?>
		    <div class="clear"></div>
    <div id="lineahor"><img src="../images/1x1.gif" alt="nada" /></div>
		<?
		}
	 } ?>
</div></div>
   

<?php

GeneralImprimirFooter();

?>