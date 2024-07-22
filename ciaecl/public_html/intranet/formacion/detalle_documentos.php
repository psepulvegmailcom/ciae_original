<?php
 include ("conexion.php");
 include ("rules.php");
 session_start();	

 $usuario = $_SESSION["id_usuario"];
 $perfil =  $_SESSION["per_usuario"];
 $nombre =  $_SESSION["nom_usuario"];
  if($_POST["BTAgregar"]=="."){
   $archivo= $_POST["id_archivo"];
   $fecha = date("Y-m-d");
   $funcionAgrega = new rules();
   $resp = $funcionAgrega->AgregaComentario($conn,$_POST["titulo"],$_POST["autor"],$_POST["correo"],$fecha, $_POST["comentario"], $archivo);
   $id_archivo=$archivo;
  
 }else{
    $id_archivo=$_GET["id_archivo"];
	 $_SESSION["link_detalle"]="detalle_archivo.php?id_archivo=".$_GET["id_archivo"]."&id_tema=".$_GET["id_tema"]."&descripcion=".$_GET["descripcion"]."&tema=".$_GET["tema"]; 
 }
 $funcionBusqueda = new rules();
 $row = $funcionBusqueda->DetalleArchivo($conn, $id_archivo);
 
 $sql = $funcionBusqueda->ComentariosArchivo($conn, $id_archivo, $perfil, $usuario);
	 
 $comentarios=$row["comentarios"];
 $autor=$row["id_autor"];

	$enlace = $ruta."/".$row["nom_archivo"];
	 
	$tam = filesize("$enlace");
	$kas=$tam/1024;
	$final=round($kas,0); //*
	
		$icono="";
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
	   
?>

<!-- Put IE into quirks mode -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<style type="text/css" media="all">
#BTAgregar { background:url('images/bot_comentar.gif') no-repeat; border:none; width:85; heigh:17; position:fixed }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>prueba</title>
<link href="estilos/interior.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="script.js"></script>
<script src="Scripts/jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="Scripts/thickbox-compressed.js" type="text/javascript"></script>
<script src="Scripts/global.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
<!--
function mostrar( numTabla ) {
	for( t = 1; t <= 4; t++ )
		fnG.obtElem( 'tabla' + t ).style.display = 'none';
	fnG.obtElem( 'tabla' + numTabla ).style.display = 'inline';
}
//-->
</script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
//-->
</script>
<script type="text/javascript">
<!--
function doClock() {
    // By Paul Davis - www.kaosweaver.com;
    var t = new Date(), a = doClock.arguments, str = "", i, a1, lang = "5";
    var month = new Array('Enero','enero', 'Febrero','feb', 'Marzo','marzo', 'Abril','abr', 'Mayo','mayo', 'Junio','jun', 'Julio','jul', 'Agosto','agosto', 'Septiembre','sept', 'Octubre','oct', 'Noviembre','nov', 'Diciembre','dic');
    var tday = new Array('domingo','dom','lunes','lun', 'martes','mar', 'miércoles','mié','jueves','jue','viernes','vie','sábado','sáb');
    for (i = 0; i < a.length; i++) {
        a1 = a[i].charAt(1);
        switch (a[i].charAt(0)) {
          case "M":
            if ((Number(a1) == 3) && ((t.getMonth() + 1) < 10)) {
                str += "0";
            }
            str += (a1 == "2") ? t.getMonth() + 1 : month[t.getMonth() * 2 + Number(a1)];
            break;
          case "D":
            if ((Number(a1) == 1) && (t.getDate() < 10)) {
                str += "0";
            }
            str += t.getDate();
            break;
          case "Y":
            str += (a1 == "0") ? t.getFullYear() : t.getFullYear().toString().substring(2);
            break;
          case "W":
            str += tday[t.getDay() * 2 + Number(a1)];
            break;
          default:
            str += unescape(a[i]);
        }
    }
    return str;
}
function flvS3(v1){//v1.2
var v2=MM_findObj(v1);if (!v2){this.x=this.y=this.h=this.w=0;return;}var v3,v4,v5,v6,v7=(document.layers)?v2:v2.style;v3=isNaN(parseInt(v7.left))?v2.offsetLeft:parseInt(v7.left);v4=isNaN(parseInt(v7.top))?v4=v2.offsetTop:parseInt(v7.top);if (v2.offsetHeight){v5=v2.offsetHeight;v6=v2.offsetWidth;}else if (document.layers){v5=v7.clip.height;v6=v7.clip.width;}else {v5=v6=0;}this.x=parseInt(v3);this.y=parseInt(v4);this.h=parseInt(v5);this.w=parseInt(v6);}

function flvS8(v1,v2,v3){//v1.0
var v4=(document.layers)?v1:v1.style;var v5=flvS5();eval("v4.left='"+v2+v5+"'");eval("v4.top='"+v3+v5+"'");}

function flvS5(){//v1.0
var v1=((parseInt(navigator.appVersion)>4||navigator.userAgent.indexOf("MSIE")>-1)&&(!window.opera))?"px":"";return v1;}

function flvXAS1(){
var v1=arguments,v2=v1.length,v3='AutoScrollContainer',v4='AutoScrollContent';var v5=MM_findObj(v3),v6=MM_findObj(v4);if (!v5){return;}if (v5.XAS1!=null){clearTimeout(v5.XAS1);}var v7=(v2>0)?parseInt(v1[0]):1;if (v7){var v8=(v2>1)?parseInt(v1[1]):1,v9=(v2>2)?parseInt(v1[2]):50,v10=(v2>3)?parseInt(v1[3]):1;var v11=new flvS3(v3),v12=new flvS3(v4);var v13=v12.x,v14=v12.y,v15=0,v16=0;if (v10==1){var v17=-1*v12.h;v15=v12.x;if (v14>=v17){v16=v12.y-v8;}else {v16=v11.h;}}else {var v18=-1*v12.w;v16=v12.y;if (v13>=v18){v15=v12.x-v8;}else {v15=v11.w;}}flvS8(v6,v15,v16);v5.XAS1=setTimeout("flvXAS1("+v7+","+v8+","+v9+","+v10+")",v9);}}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/botonera/home2.gif','images/botonera/correo2.gif','images/botonera/mapa2.gif','images/botonera/investigadores2.gif','images/bajada/volver2.gif','images/bajada/imprimir2.gif','images/bajada/subir2.gif')">
<div id="todo">
<div id="head">
<div id="hiddenModalContent" style="display:none">
<div id="acceso"><img src="images/acceso.gif" alt="Acceso al Sistema" />
    
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <form name="fagregartema"  target="_parent" action="sesion.php" method="post" >
			<tr>
              <td scope="col">Usuario:</td>
              <td scope="col"><label>
                <input name="usuario" class="bloque" type="text" id="usuario" size="12" />
              </label></td>
              <td scope="col">&nbsp;</td>
            </tr>
            <tr>
              <td>Clave:</td>
              <td><input name="contrasena" class="bloque" type="password" id="contrasena" size="12" /></td>
              <td><label>
			  <a class="enlace" href="#" onclick="document.forms.fagregartema.submit();return false">
      			<img src="images/bot_ingresar.gif" border="0" alt="ingreso">
    		  </a></label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><img src="images/bot_cancelar.gif" alt="Cancelar" width="69" height="17" border="0" onClick="tb_remove()"/></td>
            </tr>
			</form>
        </table>
                  
      </div></div>
  <div id="navegacion">
    <img src="images/1x1.gif" alt="nada" width="100" height="24" /><a href="#TB_inline?height=155&amp;width=300&amp;inlineId=hiddenModalContent&amp;modal=true" class="thickbox" alt="zona privada" /><img src="images/botonera/investigadores1.gif" alt="investigadores" name="Image4" width="123" height="24" border="0" id="Image4" onmouseover="MM_swapImage('Image4','','images/botonera/investigadores2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
    <div id="iconos">
    <a href="index.html"><img src="images/botonera/home1.gif" alt="home" name="Image1" width="26" height="24" border="0" id="Image1" onmouseover="MM_swapImage('Image1','','images/botonera/home2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="contacto.html"><img src="images/botonera/correo1.gif" alt="contacto" name="Image2" width="30" height="24" border="0" id="Image2" onmouseover="MM_swapImage('Image2','','images/botonera/correo2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="mapa.html"><img src="images/botonera/mapa1.gif" alt="mapa de navegacion" name="Image3" width="26" height="24" border="0" id="Image3" onmouseover="MM_swapImage('Image3','','images/botonera/mapa2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
      <p><script type="text/javascript">
		  <!--
   document.write(doClock("D1","%20de%20","M0","%20de%20","Y0"));
   //-->
  </script></p>
  </div>
  </div>
  <div id="botonera">
  <div class="t-tabs">
    <ul class="tabs">
      <li><a href="descripcion.html">Descripci&oacute;n&nbsp;del&nbsp;Proyecto</a></li>
      <li><a href="lineas.html">L&iacute;neas&nbsp;de&nbsp;Trabajo</a></li>
      <li><a href="equipo.html">Equipo&nbsp;de&nbsp;Investigadores</a></li>
      <li><a href="actividades.php">Actividades</a></li>
      <li><a href="recursos.html">Recursos</a></li>
      <li><a href="investigadores.html">Investigadores&nbsp;Asociados&nbsp;</a></li>
     </ul>
  </div>
</div>
</div><!--   fin de div head-->

<div id="foot">
  <div id="botsecundarios"><img src="images/bajada/01.gif" alt="bajada" width="224" height="36" /><a href="javascript:history.go(-1);"><img src="images/bajada/volver1.gif" alt="volver" width="60" height="36" border="0" id="Image5" onmouseover="MM_swapImage('Image5','','images/bajada/volver2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="#" onclick="window.print();return false"><img src="images/bajada/imprimir1.gif" alt="imprimir" width="76" height="36" border="0" id="Image6" onmouseover="MM_swapImage('Image6','','images/bajada/imprimir2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="#subir"><img src="images/bajada/subir1.gif" alt="subir" width="48" height="36" border="0" id="Image7" onmouseover="MM_swapImage('Image7','','images/bajada/subir2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><img src="images/bajada/02.gif" alt="bajada" width="546" height="36" /></div>
  <div id="colofon"><ul>
        <li>Un Núcleo de Iniciativa Científica Milenio - Santiago - Chile</li>
        <li class="opcion"><a href="javascript:;">Políticas de Contenido y Privacidad</a></li>
        </ul>
  </div>
</div>
<!--   fin de div foot-->

<div id="content"><a name="subir" id="subir"></a>
  <div id="contenedor">
<div id="lateral">
      <p><img src="images/logo.gif" alt="logo" width="169" height="102" /></p>
</div>
            
<div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero"><a href="index.html" target="_top">Portada</a></li>
        <li class="normal"><a href="recursos.html" target="_top">Recursos</a></li>
        <li class="normal"><a href="documentos.php?id_tema=30&tema= Documentos& descripcion=&img1=&img2=&img3=&comentarios=1" target="_top">Documentos</a></li>
        <li class="ultimo">Detalle</li>
      </ul>
      </div><!-- fin ruta --> 
    <div class="clear"></div>
    <img src="images/interior/ico_doc.gif" alt="foto" width="198" height="204" class="fotoDer1" />        
    <h1>Documento</h1>
          <h2><?php echo $row["titulo"]  ?></h2>
          <p>&nbsp;</p>
          <p><span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Autor:</span><?php echo $row["autor_orig"];  ?><br /><span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Año:</span><?php echo $row["ano_re"]; ?>
          <br />
          <span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Pa&iacute;s:</span><?php echo $row["pais"]  ?></p>		  
          <p><span class="negrillas"><img src="images/bullet_lateral.gif" alt="flecha" width="7" height="7" /> Publicado por: </span><?php echo $row["firstname"]." ".$row["lastname"];  ?></p>
          <div class="listado pin">
      <p class="fecha"><?php echo Formatofecha($row["fec_publicacion"])  ?></p>
      <!--p class="titulo">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</p-->
      <p> <?php echo $row["bajada"]  ?></p>

      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table align="center" cellspacing="0" class="dato">
        <tfoot>
        </tfoot>
        <tbody>
          <tr>
            <th scope="col">&nbsp;</th>
            <th nowrap="nowrap" scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td class="linea1"><a href="bajando.php?archivo=<?php echo $row["nom_archivo"];?>"><?php echo $row["nom_archivo"]  ?></a></td>
            <td width="115" nowrap="nowrap"><a href="bajando.php?archivo=<?php echo $row["nom_archivo"];?>'"><img src="images/<? echo $icono_; ?>" alt="<? echo $partes_ruta;?>" width="34" height="18" border="0" /></a><? echo $final;?> kb </td>
          </tr>
        </tbody>
      </table>
     
       
      <p>&nbsp;</p>
      <div id="lineahor"><img src="images/1x1.gif" alt="nada" /></div>
	  			
  <?php 
   if(mysql_num_rows($sql) == 0){
     echo "<td colspan=\"4\" class=\"texto_libre\" >EL archivo no posee comentarios</td>";
  }else
  while ($com = mysql_fetch_array($sql)) { 
 ?> 

	<p class="titulos">Comentarios</p>
	<p><span class="fecha"><?php echo Formatofecha($com["fec_comentario"])  ?> -</span> <span class="epigrafe"> <span class="negrillas"><?php echo $com["autor_comentario"]  ?></span> <?php echo $com["comentario"]  ?></span></p>
	<? } ?>

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
            <input name="autor" id="autor" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium" size="70" maxlength="200" />
          </font></td>
        </tr>
		<tr>
		          <td class="linea1"><a href="javascript:;">E-mail: </a></td>
          <td nowrap="nowrap"><font face="Arial" size="1">
            <input name="correo" id="correo" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium" size="40" maxlength="100" />
          </font></td>
		</tr>
        
        
        <tr>
          <td class="linea1"><a href="javascript:;">Mensaje: </a></td>
          <td nowrap="nowrap"><font face="Arial" size="1">
            <textarea name="comentario" cols="71" rows="4" id="comentario" style="font-family: Arial; font-size: 11; background-color: rgb(224,231,235); border: medium"></textarea>
          </font></td>
        </tr>
        <tr>
          <td nowrap="nowrap" class="fondopeso2">&nbsp;</td>
          <td nowrap="nowrap" class="fondopeso2"> 
          <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $id_archivo; ?>" />
		  <!--img src="images/bot_comentar.gif" width="85" height="17" border="0" /--><input name="BTAgregar" type="submit"  id="BTAgregar" value="." ></td>
        </tr>
      </tbody>
    </table>
	</form>
	<p>&nbsp;</p>
        </div>
</div> 
        
            <!-- fin contenido -->    
</div> 

<div class="clear"></div>     
</div><!--   fin de div textos-->
</div>
<!--   fin de div content-->

</div><!--   fin de div todo-->
</body>
</html>

