<?php
 session_start();
 if($_GET["error"]){
   $cod_error=$_GET["error"];
   $url_principal="error.php?error=$cod_error"; 
   }
 else
   $url_principal="temas.php"; 


 if(($_POST["logout"]=="logout")||($_GET["logout"]=="logout")){
	session_destroy();  
	unset($_SESSION["id_usuario"]);
    unset($_SESSION["per_usuario"]);
    unset($_SESSION["nom_usuario"]);
	//echo "apreto cerrar sesion";
 }

 if(($_GET["login"])){
   $etiq_boton = "Cerrar Sesi�n";
   $url="index.php";
   $target="_parent";
   //echo "aprieto login";
   
 }else{
   if(isset($_SESSION['id_usuario']) ){
     $etiq_boton = "Cerrar Sesi�n";
     $url="index.php";
     $target="_parent";
     //echo "no aprieto login, pero todavia hay sesion";
   }else{
     $url="login.php";
     $etiq_boton = "Iniciar Sesi�n Investigadores";
     $target="fprincipal";
     //echo "no existe sesion";
    }
  } 
include ("../conexion.php");
 include ("../rules.php");
 $funcionBusqueda = new rules();
 $tipo = $_GET["tipo_tema"];
 if(! isset($tipo)) $tipo = "0";

 if (isset($_SESSION['id_usuario'])) {
      $usuario = $_SESSION["id_usuario"];
      $perfil =  $_SESSION["per_usuario"];
      $nombre =  $_SESSION["nom_usuario"];
	  $sql = $funcionBusqueda->ListarDiarios($conn, $perfil, $usuario, $tipo);	  
	  	    	 
 }else //usuario publico
    $sql = $funcionBusqueda->ListarDiarios($conn, "0", $usuario, $tipo);
	
?><!-- Put IE into quirks mode -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Centro de Investigaci�n en Educaci�n / Un N�cleo de Iniciativa Cient�fica Milenio</title>
<link href="estilos/intranet.css" rel="stylesheet" type="text/css" />
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
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body onload="MM_preloadImages('../images/botonera/investigadores2.gif','../images/bot_detalle2.gif','images/b_herramientas2.gif','images/b_hitos2.gif','images/b_recursos2.gif','images/b_micuenta2.gif')">
<div id="todo">
<div id="head">

  <div id="navegacion"><img src="../images/1x1.gif" alt="nada" width="100" height="24" /><a href="../index.php?logout=logout"><img src="images/bot_cerrarsesion.gif" alt="cerrar" width="97" height="23" border="0" /></a>
    <img src="../images/1x1.gif" alt="nada" width="100" height="24" /><a href="#TB_inline?height=155&amp;width=300&amp;inlineId=hiddenModalContent&amp;modal=true" class="thickbox" alt="zona privada" /></a>
    <div id="iconos"> <a href="intranet.php"><img src="images/botonera/home1.gif" alt="home" name="Image1" width="26" height="24" border="0" id="Image1" onmouseover="MM_swapImage('Image1','','images/botonera/home2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
        <p>
          <script type="text/javascript">
		  <!--
   document.write(doClock("D1","%20de%20","M0","%20de%20","Y0"));
   //-->
      </script>
        </p>
    </div>
  </div>
  <div id="botonera">
  <div class="nombre">
   
      <p>Bienvenido(a) <?php if(isset($_SESSION["nom_usuario"])) echo $_SESSION["nom_usuario"]; ?> </p>
  </div>
</div>
</div>
<!--   fin de div head-->



<div id="contenedor">
  <table width="954" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="623" valign="top"><p>
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','623','height','253','src','../images/frase','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','Transparent','movie','../images/frase' ); //end AC code
      </script>
        <noscript>
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="623" height="253">
            <param name="movie" value="../images/frase.swf" />
            <param name="quality" value="high" />
            <param name="WMode" value="Transparent" />
            <embed src="../images/frase.swf" width="623" height="253" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="Transparent"></embed>
          </object>
          </noscript>
      
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="125" valign="top"><div align="center"><a href="herramientas.php?id_tema=30"><img src="images/b_herramientas1.gif" width="120" height="119" border="0" id="Image2" onmouseover="MM_swapImage('Image2','','images/b_herramientas2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></div></td>
            <td height="125" valign="bottom"><div align="center"><a href="recursos.php?id_tema=31"><img src="images/b_hitos1.gif" width="119" height="119" border="0" id="Image3" onmouseover="MM_swapImage('Image3','','images/b_hitos2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></div></td>
            <td height="125" valign="bottom"><div align="center"><a href="recursos.html"><img src="images/b_recursos1.gif" width="118" height="119" border="0" id="Image4" onmouseover="MM_swapImage('Image4','','images/b_recursos2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></div></td>
            <td height="125" valign="top"><div align="center"><a href="cuenta.php"><img src="images/b_micuenta1.gif" width="122" height="119" border="0" id="Image6" onmouseover="MM_swapImage('Image6','','images/b_micuenta2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></div></td>
          </tr>
        </table>        
       </td>
      <td valign="top">
          
      <div id="destaca_portada"><span class="tit">&nbsp;&nbsp;</span><span class="investigador">&nbsp;Diario Mural</span><span class="tit">&nbsp;&nbsp;</span>&nbsp;
	  
	    	 <?php 
	 	$i = 0;
	 while ($tema = mysql_fetch_array($sql)) { 
	 	$i = $i + 1;
	  $texto = substr($tema["descripcion"], 0, 165);
	  $texto = $texto."...";

		if ($i < 3){
?>

        <div id="destaca_texto">
              <p><span class="nombre"><? echo $tema["fec_creacion"];?></span><span class="tit"><br />
<? echo $tema["tema"];?></span><br />
<? echo $texto;?></p>
        </div>
        <div class="clear"></div>
        <div id="fecha_mas">
              <div id="fecha"><a href="detalle_diario.php?id_tema=<? echo $tema["id_tema"];?>"><img src="../images/bot_detalle.gif" alt="detalle" name="Image5" width="80" height="17" border="0" id="Image5" onmouseover="MM_swapImage('Image5','','../images/bot_detalle2.gif',1)" onmouseout="MM_swapImgRestore()" /></a></div>
        </div>
      </div>   
      
      
      
  	<? 
		if ($i < 2){
		?>
      <div id="destaca_portada">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?
		}
	 } 
	}
	 ?>
    
      
      
        <!--div id="destaca_texto">
              <p> <span class="nombre"><br />
                05/11/2008</span><span class="tit"><br />
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis</span><br />
              ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. </p>
        </div>
        <div class="clear"></div>
        <div id="fecha_mas">
              <div id="fecha"><a href="diario.html"><img src="../images/bot_detalle.gif" alt="detalle" name="Image51" width="80" height="17" border="0" id="Image51" onmouseover="MM_swapImage('Image51','','../images/bot_detalle2.gif',1)" onmouseout="MM_swapImgRestore()" /></a> </div>
        </div>
      </div-->       
	  </td>
    </tr>
  </table>
  
<div id="foot">
    <div id="botsecundarios"></div>
    <div id="colofon">
      <ul>
        <li>Un N&uacute;cleo de Iniciativa Cient&iacute;fica Milenio - Santiago - Chile</li>
        <li class="opcion"><a href="javascript:;">Pol&iacute;ticas de Contenido y Privacidad</a></li>
      </ul>
    </div>
  </div></div>
<p>&nbsp;</p>
</div><!--   fin de div todo-->
</body>
</html>

