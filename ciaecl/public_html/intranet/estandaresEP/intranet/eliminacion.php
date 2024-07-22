<?php
 session_start();	
 //echo "1->".$_SESSION['id_usuario']."<br>";
 //echo "2->".$_SESSION['per_usuario']."<br>";
// echo "3->".$_SESSION['nom_usuario']."<br>";

 include ("../conexion.php");
 include ("../rules.php");

 $id_tema = $_GET["id_tema"];
 $id_archivo  = $_GET["id_archivo"];
 $id_comentario  = $_GET["id_comentario"];
 $archivo = $_GET["archivo"];
 $id_usuario_del= $_GET["id_usuario_del"];
 $flag = $_GET["flag"];

 if($flag=="1"){
 if(isset($id_tema)){
   $funcionEliminacion = new rules();
   $sql = $funcionEliminacion->setDeleteTemaArchivos($conn, $id_tema, $ruta, $rutaImg);
   if($sql){ $msg= $sql;}
   else { $msg= "Se ha eliminado el tema y sus archivos con exito <br>";}
  
 } 
 else 
   $msg="Primero Autentifiquese";
}
else{
if($flag=="2"){
   $funcionEliminacion = new rules();
   $sql = $funcionEliminacion->DeleteFile($conn, $id_archivo, $ruta, $id_tema, $archivo);
   
   if($sql){ $msg= $sql;}
   else { $msg= "Se ha eliminado el archivo con exito <br>";}
 } 
 else {
  if($flag=="3"){
    $funcionEliminacion = new rules();
    $sql = $funcionEliminacion->DeleteComentario($conn, $id_comentario);
   
    if($sql){ $msg= $sql;}
    else { $msg= "Se ha eliminado el comentario con exito <br>";}
	 
  }else{
  if($flag=="4"){
    $funcionEliminacion = new rules();
    $sql = $funcionEliminacion->DeleteUsuario($conn, $id_usuario_del);
   
    if($sql){ $msg= $sql;}
    else { $msg= "Se ha eliminado el usuario con exito <br>";}

  }else{ 
   if($flag=="5"){
    $funcionEliminacion = new rules();
    $sql = $funcionEliminacion->DeleteComentarioTema($conn, $id_comentario);
   
    if($sql){ $msg= $sql;}
    else { $msg= "Se ha eliminado el comentario con exito <br>";}
   } 
  else
      $msg="Primero Autentifiquese";
  }
 }
 }  
} 
?>

<!-- Put IE into quirks mode -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Centro de Investigaci�n en Educaci�n / Un N�cleo de Iniciativa Cient�fica Milenio</title>
<link href="estilos/interior.css" rel="stylesheet" type="text/css" />
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
    var tday = new Array('domingo','dom','lunes','lun', 'martes','mar', 'mi�rcoles','mi�','jueves','jue','viernes','vie','s�bado','s�b');
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

<body onload="MM_preloadImages('images/botonera/home2.gif','images/bajada/volver2.gif','images/bajada/imprimir2.gif','images/bajada/subir2.gif','images/interior/icochico_doc2.gif','images/interior/icochico_articulos2.gif','images/interior/icochico_bdd2.gif','images/interior/icochico_otros2.gif','../images/bot_mas2.gif','images/bot_detalle2.gif')">
<div id="todo">
<div id="head">
<div id="hiddenModalContent" style="display:none">
<div id="acceso"><img src="images/acceso.gif" alt="Acceso al Sistema" />
    
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td scope="col">Usuario:</td>
              <td scope="col"><label>
                <input name="usuario" class="bloque" type="text" id="usuario" size="12" />
              </label></td>
              <td scope="col">&nbsp;</td>
            </tr>
            <tr>
              <td>Clave:</td>
              <td><input name="clave" class="bloque" type="password" id="clave" size="12" /></td>
              <td><label><a href="intranet/intranet.html"><img src="images/bot_ingresar.gif" alt="ingreso"  border="0"></a></label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><img src="images/bot_cancelar.gif" alt="Cancelar" width="69" height="17" border="0" onClick="tb_remove()"/></td>
            </tr>
        </table>
                  
      </div></div>
  <div id="navegacion">
    <img src="../images/1x1.gif" alt="nada" width="100" height="24" /><a href="../index.php?logout=logout"><img src="images/bot_cerrarsesion.gif" alt="cerrar" width="97" height="23" border="0" /></a>
    <div id="iconos">
    <a href="intranet.php"><img src="images/botonera/home1.gif" alt="home intranet" name="Image1" width="26" height="24" border="0" id="Image1" onmouseover="MM_swapImage('Image1','','images/botonera/home2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
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
      <li><a href="herramientas.php?id_tema=30">Herramientas para Publicar</a></li>
      <li><a href="recursos.php?id_tema=31">Hitos del Proyecto</a></li>
      <li><a href="recursos.html">Recursos</a></li>
      <li><a href="diario.php">Presentaci�n</a></li>      <li><a href="cuenta.php"><strong>
        <?php if(isset($_SESSION["nom_usuario"])) echo $_SESSION["nom_usuario"]; ?>
      </strong> ( Mi Cuenta )</a></li>
     </ul>
  </div>
</div>
</div><!--   fin de div head-->

<div id="foot">
  <div id="botsecundarios"><img src="images/bajada/01.gif" alt="bajada" width="224" height="36" /><a href="javascript:history.go(-1);"><img src="images/bajada/volver1.gif" alt="volver" width="60" height="36" border="0" id="Image5" onmouseover="MM_swapImage('Image5','','images/bajada/volver2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="#" onclick="window.print();return false"><img src="images/bajada/imprimir1.gif" alt="imprimir" width="76" height="36" border="0" id="Image6" onmouseover="MM_swapImage('Image6','','images/bajada/imprimir2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="#subir"><img src="images/bajada/subir1.gif" alt="subir" width="48" height="36" border="0" id="Image7" onmouseover="MM_swapImage('Image7','','images/bajada/subir2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><img src="images/bajada/02.gif" alt="bajada" width="546" height="36" /></div>
  <div id="colofon"><ul>
        <li>Un N�cleo de Iniciativa Cient�fica Milenio - Santiago - Chile</li>
        <li class="opcion"><a href="javascript:;">Pol�ticas de Contenido y Privacidad</a></li>
        </ul>
  </div>
</div>
<!--   fin de div foot-->

<div id="content"><a name="subir" id="subir"></a>
  <div id="contenedor">
<div id="lateral">

      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><a href='http://www.ciae.uchile.cl/' target='_blank'><img src="../images/logo.jpg" alt="logo" width="169"  border=0 /></a></p>

</div>
            
<div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero"><a href="intranet.php" target="_top">Portada Intranet</a></li>
        <li class="ultimo"> Herramientas para Publicar</li>
      </ul>
      </div><!-- fin ruta --> 
    <div class="clear"></div><img src="images/interior/ico_herramientas.gif" alt="foto" width="117" height="117" class="fotoDer1" />
      <h1>Herramientas para Publicar</h1>
      <p>&nbsp;</p>
    
         
        <ol id="toc">
	<?php     if($tema==30){?>
    <li class="current"><a href="herramientas.php?id_tema=30">Referencias Bibliogr�ficas</a></li>
	<? 
	 $img1 = "nuevo_ico_doc1-2.gif";
	 $img2 = "nuevo_ico_doc2.gif";
	} else {?>
	<li ><a href="herramientas.php?id_tema=30">Referencias Bibliogr�ficas</a></li>
	<? } ?> 
	<?php     if($tema==32){?>
    <li class="current"><a href="herramientas.php?id_tema=32">Art�culos</a></li>
	<? } else {?>
	<li ><a href="herramientas.php?id_tema=32">Art�culos</a></li>
	<? } ?>    
	<?php     if($tema==38){?>
    <li class="current"><a href="herramientas.php?id_tema=38">Bases de Datos</a></li>
	<? } else {?>
	<li ><a href="herramientas.php?id_tema=38">Bases de Datos</a></li>
	<? } ?>    
	<?php     if($tema==31){?>
    <li class="current"><a href="herramientas.php?id_tema=31">Hitos</a></li>
	<? } else {?>
	<li ><a href="herramientas.php?id_tema=31">Hitos</a></li>
	<? } ?>    
	<?php     if($tema==29){?>
    <li class="current"><a href="herramientas.php?id_tema=29">Publicaciones</a></li>
	<? } else {?>
	<li ><a href="herramientas.php?id_tema=29">Publicaciones</a></li>
	<? } ?>    
    <li><a href="herramientas_diario.php">Presentaci�n</a></li>
</ol>
      <div class="conte"></p>
        <table align="center" cellspacing="0" class="dato">
          <tbody>
            <tr>
              <th scope="col"><span class="mensaje"><?php echo $msg; ?></span></th>
            </tr>
            <!--tr>
              <th scope="col"><span class="mensaje">El RECURSO se encuentra publicado.</span></th>
            </tr>
            <tr>
              <th scope="col"><span class="mensaje">El RECURSO ha sido modificado.</span></th>
            </tr>
            <tr>
              <th scope="col"><span class="mensaje">El  RECURSO ha sido modificado.</span></th>
            </tr-->
            <tr>
              <th scope="col"><a href="javascript:history.go(-1);"><img src="images/generales/bot_volver.gif" alt="Cancelar" width="59" height="17" border="0" /></a></th>
            </tr>
          </tbody>
        </table>
      <p>&nbsp;</p>
</div>
<!-- fin contenido -->    
   
<div class="clear"></div>     
</div><!--   fin de div textos-->
</div>
<!--   fin de div content-->

</div><!--   fin de div todo-->

</body>
</html>
