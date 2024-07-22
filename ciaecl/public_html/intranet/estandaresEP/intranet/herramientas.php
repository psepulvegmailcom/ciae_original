<?	 

 include ("header.php"); 

if(trim($_GET["id_tema"]) == '')
{
	$_GET["id_tema"] = 30;
}
 $funcionBusca = new rules();
 $tem=$funcionBusca->BuscaDetalleTema($conn, $_GET["id_tema"]);
 
 $id_tipo_tema = $tem['id_tipotema'];
 $subtem=  $_GET["subtema"] ;
 

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
	if(trim($tema) == '')
		$tema = 30;
 }
 
if((!isset($_POST["BTBuscar"]))&&(!isset($_GET["BTBuscar"]))){
//-------Listar por un tema especifico-------//
 $funcionBusca = new rules();
 $row=$funcionBusca->BuscaDetalleTema($conn, $tema);

 $autor_tema= $funcionBusqueda->BuscaAutortema($conn, $tema);
  $_SESSION["link_archivos"]= "archivos.php?id_tema=".$tema;
  $_SESSION["link_principal"]= $_SESSION["link_tem"];
  
  if (isset($_SESSION['id_usuario'])) 
  {
      $usuario = $_SESSION["id_usuario"];
      $perfil =  $_SESSION["per_usuario"];
      $nombre =  $_SESSION["nom_usuario"];
 
	  $sql = $funcionBusqueda->ListarArchivos($conn, $tema, $perfil, $usuario, $tipo, $subtem);	  
      $sql_com = $funcionBusqueda->ComentariosTema($conn, $tema, $perfil, $usuario);
	  	    	 
  }
  else
  { //usuario publico
     $sql = $funcionBusqueda->ListarArchivos($conn, $tema, "0", $usuario, $tipo);
     $sql_com = $funcionBusqueda->ComentariosTema($conn, $tema, "0", $usuario);
  }	 

 $comentarios=$row["comentarios"];
 $autor=$autor_tema;

	 
}else{
//-------------------------Listar segun Busqueda ------------------------------//
   if(isset($_POST["buscado"])) $buscado = $_POST["buscado"]; else $buscado = $_GET["buscado"]; //parametros principales
   if(isset($_POST["opcion"])) $opcion = $_POST["opcion"]; else $opcion = $_GET["opcion"]; //parametros principales

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

/* subtemas*/ 
$sqlSubtema = $funcionBusqueda->obtenerSubtema($conn,$tema); 


$sqlSubtemaActual = $funcionBusqueda->obtenerSubtema($conn,$tema,$subtem); 
 
 // GeneralPrint($_SESSION);
GeneralImprimirHeader('bloque_menu_herramientas');

?>
 
<script>
showId('subtema_div_<?php echo $_GET["id_tema"];?>'); 
</script>
            
		<a name="listasubtema"></a>
<div id="contenido"  style="	vertical-align:top">
    <div id="ubica" style="	vertical-align:top">
      <ul>
        <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
        
        <!--<li class="ultimo"><a href="herramientas.php" target="_top"> Referencias Bibliográficas</a></li>-->
        <?php
        	$qryBd 	= new qryBd();
			$output = $qryBd->obtenerTemas($_GET["id_tema"],$_GET["subtema"]);
			 //GeneralPrint($output);
			$total = count($output);
			if(is_array($output))
			{
				echo '<li class="ultimo"><a href="herramientas.php?id_tema='.$output[0]['id_tema'].'" target="_top"> '.$output[0]['tema'].'</a></li>';
				if(isset($_GET["subtema"]) && $_GET["subtema"] > 0)
				{
					echo '<li class="ultimo"><a href="herramientas.php?id_tema='.$output[0]['id_tema'].'&subtema='.$output[0]['id_subtema'].'" target="_top"> '.$output[0]['subtema'].'</a></li>';
				}
			} 
		?> 
      </ul>
      </div><!-- fin ruta --> 
    <div class="clear"></div>

    <?php
	include('herramientas_menu.php');
	?>
          
      <div class="conte"  style="	vertical-align:top" >
	<?php     if(($perfil=="1")||($perfil=="2"))
	{
		?>
	  <form name="fagregar" target="_self" action="editar.php" method="post">
	  	<input name="id_tema" id="id_tema" type="hidden" value="<?php echo $tema; ?>">
		  <!--input name="tema" id="tema" type="hidden" value="<?php //$_GET["tema"]; ?>"-->
		  <input name="id_autor" id="id_autor" type="hidden" value="<?php echo $usuario; ?>">
		  <input name="tipo_archivo" id="tipo_archivo" type="hidden" value="9">
		  <input name="BTcrear" id="BTcrear" type="hidden" value=".">
          <input name="autor" id="autor" type="hidden" value="<?php echo $nombre; ?>">		 
		  <input name="descripcion" id="descripcion" type="hidden" value="<?php echo $_GET["descripcion"]; ?>">
		  <!--<div  style="float:right; position:absolute;  width:117px; left:750px; height:" >-->
		  <div style="text-align:right;">
<a href="#" onclick="document.forms.fagregar.submit();return false"><img  title="Crear nuevo documento"  src="images/interior/icochico_doc2.gif" alt="nuevo"  height="50" border="0" id="Image2"   /></a> </div> 
	   	    <?php
	    }
	    ?>
        </form>
        </p>
		<!-- listado de subareas -->
		<div id='subareas' style="	vertical-align:top">
		<!--<ul>
		<?php
		 
			while ($subtemas = mysql_fetch_array($sqlSubtema)) 
			{  
				 echo "<li><a href='#subtema_".$subtemas['id_subtema']."'>".$subtemas['subtema']."</li>";
			} 
		?> 
		</ul>-->
		<!-- fin listado de subareas -->
		</div>
		 
		<div style="overflow:scroll; height:305px;vertical-align:top">
          <p class="titulos" style="	vertical-align:top" >
          <table align="center" cellspacing="0" class="dato" style="	vertical-align:top" >
            <tbody>
             
   <?php 
   if(mysql_num_rows($sql) == 0)
   {
   ?>
            
            <div align="justify">El tema seleccionado no posee archivos asociados.</div>
			<?php 
   }
   else
   
   	$id_subtema_prev = 0;
    while ($archivo = mysql_fetch_array($sql)) 
	{ 
		if($archivo['id_subtema'] != $id_subtema_prev)
		{ 
			?>
			 <tr>
                <th colspan="7" scope="col" style="text-align:left">
				<a name="subtema_<? echo $archivo['id_subtema'] ; ?>"></a> <? echo $archivo['subtema'] ; ?> 
				 </th>
              </tr>
 <tr>
                <th width="80" scope="col">Usuario</th>
                <th width="80" scope="col" style="font-size:8px"> Fecha Publicación </th>
                <th width="80" scope="col" style="font-size:8px"> Fecha Actualización </th>
                
				
					<th   scope="col"><? echo $tem["tema"]; ?></th> 
				 
                <th nowrap="nowrap" scope="col">Editar </th>
                <th nowrap="nowrap" scope="col">Eliminar</th>
				 
              </tr>			  
			<?
			$id_subtema_prev = $archivo['id_subtema'] ; 
		}
		
	  $texto = substr($archivo["bajada"], 0, 65);
	  $texto = $texto."...";
	  if (trim($archivo["dominio"]) != '')
	  {
	   	$archivo["dominio"] = $archivo["dominio"].'<br>'; 
	  }
   ?> 
   				<tr>
				<td class="linea1"><?php echo $archivo['firstname'].' '.$archivo['lastname'];?></td>
                <td class="linea1"><?php echo Formatofecha($archivo["fec_publicacion"]); ?></td>
                <td class="linea1"><?php echo Formatofecha($archivo["fecha_actualizacion"]); ?></td>
                <td><span class="negrillas"><a href="#" onClick="location.replace('<?php echo "detalle_documentos.php?id_archivo=".$archivo["id_archivo"]."&id_tema=".$_GET["id_tema"]; ?>')"><?php echo $archivo["dominio"].$archivo["titulo"];  ?></a> </span><br />
       			 <?php echo $texto; ?></td> 
				<?php     
				
				$responsablesU = $funcionBusqueda->listarUsuariosResponsableConsulta($conn,$archivo["id_archivo"]);    
				if(($perfil=="1")||(($perfil=="2")&&($archivo["id_autor"]==$usuario || isset($responsablesU[$usuario])  ) ) )
				{
		   		?>
                <td nowrap="nowrap">
				<form name="feditar" target="_self" action="editar.php" method="post">
  			        <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $archivo["id_archivo"] ?>">
                    <input name="BTEditar" type="submit" class="botones" value="Editar">
                    <!--a href="#" onclick="document.forms.feditar.submit();return false"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a-->
                </form>
				</td>
                <td nowrap="nowrap">
				<?php
				if($perfil=="1")
				{
				?>
				<form name="fborrar" target="fprincipal" action="borrar_tema.php">
					<input name="Submit32" type="button" class="botones" value="Borrar" onClick="if (confirm('¿Estas seguro de borrar el archivo?')){ document.location.href='<?php echo "eliminacion.php?id_archivo=".$archivo["id_archivo"]."&id_tema=".$archivo["id_tema"]."&flag=2"."&archivo=".$archivo["nom_archivo"]; ?>'}">
                  </form>
				  <?php
				  }
				  else
				  {
				  	echo '---';
				  }?>
				 </td> 
			  <?php } 
			   
		       else{ 
		       if( ($perfil=="2")&&($archivo["ar.id_autor"]!=$usuario) ){
		      ?>
              <!--td width="82%" scope="col"><div align="center" class="texto_libre"-->
                <td><div align="left">---</div></td>
				<td><div align="left">---</div></td>
              <!--/td-->
		      <?   
			    }//end if
		        } 
				}//end else
		      ?>
              </tr>
              <tr>
                <th colspan="6" scope="col"> <a href="#listasubtema" style="padding-left:70px; float: right" ><small>Subir</small></a></th>
              </tr>
            </tbody>
          </table>
		  </p></div>
          <p>&nbsp;</p>
	  <div id="lineahor"><img src="images/1x1.gif" alt="nada" /></div>
	<!--div id="paginacion">&lt;&lt; 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - 10 &gt;&gt;</div-->
      </div>
        <p class="titulos">&nbsp;</p>
      <p>&nbsp;</p>
</div>


<?php

GeneralImprimirFooter();

?>