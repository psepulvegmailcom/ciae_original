<?php
 session_start();
 if(($_POST["logout"]=="logout")||($_GET["logout"]=="logout")){
	session_destroy();  
	unset($_SESSION["id_usuario"]);
    unset($_SESSION["per_usuario"]);
    unset($_SESSION["nom_usuario"]);
	
 }

?>
<!-- Put IE into quirks mode -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Centro de Investigaci�n en Educaci�n / Un N�cleo de Iniciativa Cient�fica Milenio</title>
<link href="estilos/portada.css" rel="stylesheet" type="text/css" />
<script src="Scripts/jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="Scripts/thickbox-compressed.js" type="text/javascript"></script>
<script src="Scripts/global.js" type="text/javascript"></script>
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
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body onload="MM_preloadImages('images/botonera/home2.gif','images/botonera/correo2.gif','images/botonera/mapa2.gif','images/botonera/investigadores2.gif','images/bot_mas2.gif')">
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
   			  <img src="images/bot_ingresar.gif" border="0" alt="ingreso">    		  </a></label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><img src="images/bot_cancelar.gif" alt="Cancelar" width="69" height="17" border="0" onClick="tb_remove()"/></td>
            </tr>
			</form>
        </table>
      </div></div>
  <!--<div id="navegacion">
    <img src="images/1x1.gif" alt="nada" width="100" height="24" /><a href="#TB_inline?height=155&amp;width=300&amp;inlineId=hiddenModalContent&amp;modal=true" class="thickbox" alt="zona privada" /><img src="images/botonera/investigadores1.gif" alt="investigadores" name="Image4" width="147" height="24" border="0" id="Image4" onmouseover="MM_swapImage('Image4','','images/botonera/investigadores2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
    <div id="iconos">
    <a href="index.html"><img src="images/botonera/home1.gif" alt="home" name="Image1" width="26" height="24" border="0" id="Image1" onmouseover="MM_swapImage('Image1','','images/botonera/home2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="contacto.html"><img src="images/botonera/correo1.gif" alt="contacto" name="Image2" width="30" height="24" border="0" id="Image2" onmouseover="MM_swapImage('Image2','','images/botonera/correo2.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="mapa.html"><img src="images/botonera/mapa1.gif" alt="mapa de navegacion" name="Image3" width="26" height="24" border="0" id="Image3" onmouseover="MM_swapImage('Image3','','images/botonera/mapa2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
      <p><script type="text/javascript">
		  <!--
   document.write(doClock("D1","%20de%20","M0","%20de%20","Y0"));
   //-->
  </script></p>
  </div>
  </div>-->
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
</div>
<!--   fin de div head-->



<div id="contenedor">
  <table width="954" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="623" valign="top"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','623','height','253','src','images/frase','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','Transparent','movie','images/frase' ); //end AC code
    </script>
          <noscript>
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="623" height="253">
            <param name="movie" value="images/frase.swf" />
            <param name="quality" value="high" />
            <param name="WMode" value="Transparent" />
            <embed src="images/frase.swf" width="623" height="253" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="Transparent"></embed>
          </object>
          </noscript>
          <div id="destaca_portada"><img src="images/tit_destacado.gif" alt="destacados" width="90" height="16" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 22/08/2008
            <div id="foto_destacado"><img src="images/destacados/foto.gif" alt="foto" width="94" height="94" /></div>
            <div id="destaca_texto">
                <p><span class="tit">Ley de Subvenci&oacute;n Escolar Prefencial .</span><br />
                  <a href="http://www.mineduc.cl/index0.php?id_portal=29" target="_blank">Con m&aacute;s equidad, un gran salto a la calidad.</a> </p>
            </div>
            <div class="clear"></div>
            <div id="fecha_mas">
                <div id="fecha"> <!--a href="anteriores.html"><< anteriores</a--> <!--a href="noticia.html"><img src="images/bot_mas.gif" alt="detalle" name="Image5" width="52" height="14" border="0" id="Image5" onmouseover="MM_swapImage('Image5','','images/bot_mas2.gif',1)" onmouseout="MM_swapImgRestore()" /></a--> </div>
            </div>
        </div></td>
      <td valign="top"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','331','height','475','src','images/foto_home','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','Transparent','movie','images/foto_home' ); //end AC code
</script>
          <noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="331" height="475">
            <param name="movie" value="images/foto_home.swf" />
            <param name="quality" value="high" />
            <param name="WMode" value="Transparent" />
            <embed src="images/foto_home.swf" width="331" height="475" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="Transparent"></embed>
          </object>
        </noscript></td>
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

