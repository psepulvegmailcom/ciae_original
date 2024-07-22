<?	
 session_start();	

 include ("../conexion.php");
 include ("../rules.php");

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
  $_SESSION["link_archivos"]= "herramientas_articulos.php?id_tema=".$tema."&tema=".$_GET["tema"]."&descripcion=".$_GET["descripcion"]."&descripcion2=".$_GET["descripcion2"]."&descripcion3=".$_GET["descripcion3"]."&img1=".$_GET["img1"]."&img2=".$_GET["img2"]."&img3=".$_GET["img3"]."&comentarios=".$_GET["comentarios"];
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

   $_SESSION["link_archivos"]= "herramientas_articulos.php?buscado=".$buscado."&opcion=".$opcion."&BTBuscar=Buscar Archivos" ;
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

<!-- Put IE into quirks mode -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Centro de Investigaci�n en Educaci�n / Un N�cleo de Iniciativa Cient�fica Milenio</title>
<link href="estilos/interior.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script.js"></script>
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

<body onload="MM_preloadImages('images/botonera/home2.gif','images/bajada/volver2.gif','images/bajada/imprimir2.gif','images/bajada/subir2.gif','images/interior/icochico_doc2.gif','images/interior/icochico_articulos2.gif','images/interior/icochico_bdd2.gif','images/interior/icochico_otros2.gif','../images/bot_mas2.gif','images/bot_detalle2.gif','images/interior/nuevo_ico_articulo2.gif')">
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
    <img src="../images/1x1.gif" alt="nada" width="100" height="24" /><a href="javascript:;"><img src="images/bot_cerrarsesion.gif" alt="cerrar" width="97" height="23" border="0" /></a>
    <div id="iconos">
    <a href="intranet.php"><img src="images/botonera/home1.gif" alt="home" name="Image1" width="26" height="24" border="0" id="Image1" onmouseover="MM_swapImage('Image1','','images/botonera/home2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
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
      <li><a href="herramientas.php?id_tema=30&tema= Documentos&descripcion=&descripcion2=&descripcion3=&img1=&img2=&img3=&comentarios=1">Herramientas para Publicar</a></li>
      <li><a href="hitos.html">Hitos del Proyecto</a></li>
      <li><a href="recursos.html">Recursos</a></li>
      <li><a href="diario.html">Diario Mural</a></li>      <li><a href="cuenta.html">Mi Cuenta</a></li>
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
      <p><img src="../images/logo.gif" alt="logo" width="169" height="102" /></p>

</div>
            
<div id="contenido">
    <div id="ubica">
      <ul>
        <li class="primero"><a href="intranet.html" target="_top">Portada</a></li>
        <li class="ultimo"> Herramientas para Publicar</li>
      </ul>
      </div><!-- fin ruta --> 
    <div class="clear"></div><img src="images/interior/ico_herramientas.gif" alt="foto" width="117" height="117" class="fotoDer1" />
      <h1>Herramientas para Publicar</h1>
      <p>&nbsp;</p>
    
         
        <ol id="toc">
    <li><a href="herramientas.php?id_tema=30&tema= Documentos&descripcion=&descripcion2=&descripcion3=&img1=&img2=&img3=&comentarios=1">Documentos</a></li>
    <li class="current"><a href="herramientas_articulos.php?id_tema=32&tema= Art&descripcion=Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ul&descripcion2=comentario prueba 2&descripcion3=comentario prueba 3&img1=&img2=&img3=&comentarios=1">Art�culos</a></li>
    <li><a href="herramientas_basesdedatos.php?id_tema=38&tema= Bases de datos&descripcion=La exigencia de creaci&descripcion2=&descripcion3=&img1=&img2=&img3=&comentarios=1">Bases de Datos</a></li>
    <li><a href="#">Otros</a></li>
    <li><a href="herramientas_publicaciones.php?id_tema=29&tema= Publicaciones&descripcion=Probando el Tema 3&descripcion2=&descripcion3=&img1=&img2=&img3=&comentarios=1">Publicaciones</a></li>
    <li><a href="#">Diario Mural</a></li>
</ol>
      <div class="conte"><a href="nuevo.html"><img src="images/interior/nuevo_ico_articulo1.gif" alt="nuevo" width="117" height="117" border="0" id="Image2" onmouseover="MM_swapImage('Image2','','images/interior/nuevo_ico_articulo2.gif',1)" onmouseout="MM_swapImgRestore()" /></a>
        </p>
          <p class="titulos">
          <table align="center" cellspacing="0" class="dato">
            <tbody>
              <tr>
                <th width="150" scope="col">Fecha</th>
                <th nowrap="nowrap" scope="col">articulos</th>
                <th nowrap="nowrap" scope="col">Editar </th>
                <th nowrap="nowrap" scope="col">Eliminar</th>
              </tr>
   <?php 
   if(mysql_num_rows($sql) == 0){
   ?>
            
            <div align="justify">El tema seleccionado no posee archivos asociados. </div>
			<?php 
   }else
    while ($archivo = mysql_fetch_array($sql)) { 
	  $texto = substr($archivo["bajada"], 0, 65);
	  $texto = $texto."..."
	    
   ?> <tr>
                <td class="linea1"><?php echo Formatofecha($archivo["fec_publicacion"]); ?></td>
                <td><span class="negrillas"><a href="#" onClick="location.replace('<?php echo "detalle_documentos.php?id_archivo=".$archivo["id_archivo"]."&id_tema=".$_GET["id_tema"]."&descripcion=".$_GET["descripcion"]."&descripcion2=".$_GET["descripcion2"]."&descripcion3=".$_GET["descripcion3"]."&tema=".$_GET["tema"] ?>')"><?php echo $archivo["titulo"]; ?></a> </span><br />
       			 <?php echo $texto; ?></td>
                <td nowrap="nowrap">
				<?php     if(($perfil=="1")||( ($perfil=="2")&&($archivo["id_autor"]==$usuario) ) ){
		   		?>
				<form name="feditar" target="_self" action="editar.php" method="post">
  			        <input name="id_archivo" id="id_archivo" type="hidden" value="<?php echo $archivo["id_archivo"] ?>">
                    <!--input name="BTEditar" type="submit" class="botones" value="Editar"-->
                    <a href="#" onclick="document.forms.feditar.submit();return false"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a>
                </form>
				</td>
                <td nowrap="nowrap">
				<form name="fborrar" target="fprincipal" action="borrar_tema.php">
                    <a href="onClick=if (confirm('�Estas seguro de borrar el archivo?')){ document.location.href='<?php echo "eliminacion.php?id_archivo=".$archivo["id_archivo"]."&id_tema=".$archivo["id_tema"]."&tema=".$_GET["tema"]."&descripcion=".$_GET["descripcion"]."&flag=2"."&archivo=".$archivo["nom_archivo"]; ?>'}"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a>
                    </form>
              </tr>
			  <?php } }?> 
              <!--tr>
                <td class="linea2" >20/01/2008</td>
                <td class="fondopeso2"><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap" class="fondopeso2"><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap" class="fondopeso2"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea1">20/01/2008</td>
                <td><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap"><a href="editar.html"></a><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea2" >20/01/2008</td>
                <td class="fondopeso2"><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap" class="fondopeso2"><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap" class="fondopeso2"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea1">20/01/2008</td>
                <td><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap"><a href="editar.html"></a><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea2" >20/01/2008</td>
                <td class="fondopeso2"><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap" class="fondopeso2"><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap" class="fondopeso2"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea1">20/01/2008</td>
                <td><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap"><a href="editar.html"></a><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea2" >20/01/2008</td>
                <td class="fondopeso2"><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap" class="fondopeso2"><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap" class="fondopeso2"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea1">20/01/2008</td>
                <td><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap"><a href="editar.html"></a><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr>
              <tr>
                <td class="linea2" >20/01/2008</td>
                <td class="fondopeso2"><span class="negrillas">Titulo texto simulado </span><br />
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem.</td>
                <td nowrap="nowrap" class="fondopeso2"><a href="editar.html"><img src="images/generales/bot_editar.gif" alt="Editar" border="0" /></a></td>
                <td nowrap="nowrap" class="fondopeso2"><a href="javascript:;"><img src="images/generales/bot_eliminar.gif" alt="Eliminar" border="0" /></a></td>
              </tr-->
              <tr>
                <th colspan="4" scope="col"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></th>
              </tr>
            </tbody>
          </table>
          <p>&nbsp;</p>
	  <div id="lineahor"><img src="images/1x1.gif" alt="nada" /></div>
	<!--div id="paginacion">&lt;&lt; 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - 10 &gt;&gt;</div-->
      </div>
        <p class="titulos">&nbsp;</p>
      <p>&nbsp;</p>
</div>
<!-- fin contenido -->    
   
<div class="clear"></div>     
</div><!--   fin de div textos-->
</div>
<!--   fin de div content-->

</div><!--   fin de div todo-->
script type="text/javascript" charset="utf-8">
		window.addEvent('load', function () {
			myTabs = new SlidingTabs('buttons', 'panes');
			
			// this sets up the previous/next buttons, if you want them
			$('previous').addEvent('click', myTabs.previous.bind(myTabs));
			$('next').addEvent('click', myTabs.next.bind(myTabs));
			
			// this sets it up to work even if it's width isn't a set amount of pixels
			window.addEvent('resize', myTabs.recalcWidths.bind(myTabs));
		});
	</script>
</body>
</html>

