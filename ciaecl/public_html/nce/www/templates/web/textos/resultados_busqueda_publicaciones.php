<?	
	session_start();
	//session_unset();
	include ("conexion.php");
	include ("qryBd.php");
	include ("busquedaFunciones.php");
	//include ("fecha.inc");

		
		if ($_POST["buscar_reset"]=="reset_variables"){
			$busqueda_res = 1;
			session_unset();
		}
		
		//echo $_GET["array"];
		function array_envia($array) {
			 $tmp = serialize($array);
			 $tmp = urlencode($tmp);
			 return $tmp;
			}

		function array_recibe($url_array) {
			$tmp = stripslashes($url_array);     
			$tmp = urldecode($tmp);     
			$tmp = unserialize($tmp);     
			return $tmp;
		}
		
		
		$array = $_GET["array"];
		$array = array_recibe($array); 
		
		$array2 = $_GET["array2"];
		$array2= array_recibe($array2);
		
		$array3 = $_GET["array3"];
		$array3= array_recibe($array3);
				
		$pagina = $_GET["pagina"];
		
	
		
		if ($pagina == "" && $array == ""){
		//echo "hola";
			$vars = $_POST;
			$selProgramaEntrada = $_POST["selPrograma"];
			$selSubsectorEntrada = $_POST["selSubsector"];
			session_destroy();
		}else{
			if ( $_SESSION["array"] == ""){
			$array = $_GET["array"];
			 }else{
			$array = $_SESSION["array"];
			 }
			$array = array_recibe($array); 
			$vars = $array;
			
			if ( $_SESSION["array2"] == ""){
			$array2 = $_GET["array2"];
			 }else{
			$array2 = $_SESSION["array2"];
			 }
			$array2 = array_recibe($array2); 
			$selProgramaEntrada = $array2;
						 
			if ( $_SESSION["array3"] == ""){
			$array3 = $_GET["array3"];
			 }else{
			$array3 = $_SESSION["array3"];
			 }
			$array3 = array_recibe($array3); 
			$selSubsectorEntrada = $array3;
			//echo $selProgramaEntrada;
			//echo "<br>";
			//$selSubsectorEntrada = $array3;
		//	echo $selSubsectorEntrada;	
		//	echo "<br>";		
		}
		
		$resultado = new busqueda();
		$funcionBusqueda = new busquedaFunciones();
		
		//echo var_dump($selSubsectorEntrada);

			 $sqlUno = $funcionBusqueda->preparaQry($conn, $vars, $selProgramaEntrada, $selSubsectorEntrada);
			 $result = $resultado->ejecutaSql($conn, $sqlUno);
			 
		
		$numeroRegistros = @mysql_num_rows($result);
			if(!isset($orden)){
				$orden = $orden." ate_oferente_info_general.nombre_fantasia, ";
				$orden = $orden." ate_oferente_info_oferta_programa_atencion_oferta.id_programa";
			}

			$tamPag = 10;
			
			if(!isset($_GET["pagina"])&&($_SESSION["pagina"]==""))
			{
			//echo "pagina1";
			   $pagina = 1;
			   $inicio = 1;
			   $final = $tamPag;
			}else{
			//echo "pagina2";
			   if ($_GET["pagina"]!=""){
			   $pagina = $_GET["pagina"];
			   }else{
			   $pagina = $_SESSION["pagina"];
			   }
			}

			$limitInf = ($pagina-1)*$tamPag;
		
			$numPags=ceil($numeroRegistros/$tamPag);
			
			if(!isset($pagina))
			{
			   $pagina = 1;
			   $inicio = 1;
			   $final = $tamPag;
			}else{
			//$pagina = $_GET["pagina"];
			   $seccionActual = intval(($pagina-1) / $tamPag);
			   $inicio = ($seccionActual * $tamPag)+1;
		
			   if($pagina < $numPags){
				  $final = $inicio+$tamPag-1;
			   }else{
				  $final = $numPags;
			   }
		
			   if ($final > $numPags){
				  $final = $numPags;
			   }
		
					
					 foreach ( $vars as $var => $value) {
					  $tok = strtok ($var,"|");
					   if (($tok =="exacta")){
							$exacta = 1;
							 }else {
							$exacta = 0;
							}
						}
					
					if (($var == "radioPalabra")){
						$vienePalabra = 1;
						//echo "holanda";
					}
					
			$time = date("s");
			
			if (($time == 1)||($time == 2)||($time == 3)||($time == 52)){
			 $agrupar = " ,id_oferta ASC"; }
			
			if (($time == 5)||($time == 6)||($time == 7)){
			 $agrupar = " ,id_oferta DESC"; }
			
			if (($time == 9)||($time == 10)||($time == 11)||($time == 32)){
			 $agrupar = " ,id_oferta"; }
			
		
			if (($time == 49)||($time == 50)||($time == 51)){
			 $agrupar = " ,id_oferente DESC"; }
			 					
			if (($time == 53)||($time == 54)||($time == 55)||($time == 56)){
			 $agrupar = " ,id_oferente ASC"; }
					
			if (($time == 57)||($time == 58)||($time == 59)||($time == 60)){
			 $agrupar = " ,id_oferente"; }
			 
			if (($time == 4)||($time == 8)||($time == 12)||($time == 48)){
			 $agrupar = " ,rut"; }
			 
			if (($time == 16)||($time == 20)||($time == 24)){
			 $agrupar = " ,rut ASC"; }
			 
			if (($time == 28)||($time == 32)||($time == 36)){
			 $agrupar = " ,rut DESC"; }
			 
			if (($time == 00)||($time == 0)){
			 $agrupar = " ,rut"; }
					
					if(($exacta == 0 && $vienePalabra == 1)||($busqueda_res==1 && $exacta == 0)){
					 $sql = $sqlUno . " ORDER BY  SCORE DESC, id_oferta ".$agrupar."  LIMIT ".$limitInf.",".$tamPag;
					 }else{
					 $orden = id_oferta;
					 $sql = $sqlUno . " ORDER BY  ".$orden." ASC ".$agrupar." LIMIT ".$limitInf.",".$tamPag;
					 }
						
					//echo $sql;

			if ($sql != ""){
				$result = $resultado->ejecutaSql($conn, $sql);
			}
		
			$array = $vars;
			$array2 = $selProgramaEntrada;
			$array3 = $selSubsectorEntrada;	
					
			$array = array_envia($array);
			$array2 = array_envia($array2);
			$array3 = array_envia($array3);	
					
			$_SESSION['variables'] = $array;
			$_SESSION['programa'] = $array2;
			$_SESSION['subsector'] = $array3;			
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="Description" CONTENT="asistencia, t&eacute;cnica, educativa, b&uacute;squeda, buscador, palabras" />
<meta name="verify-v1" content="N4l8Y+iUF/hQ59GstdS1KQCxFHZafNv5hzYOCGA61jU=" />
<title>Resultado de B&uacute;squeda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script src="mootools-1.2.1-core-yc.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->

var CampoAutoexplicativo = new Class({
	//implemento options para utilizar la clase Options que permite...
	//parametrizar las clases con valores opcionales  
	Implements: Options,
	
	//objeto con los valores por defecto que tomar&aacute;n los options
	options: {
		texto: 'Realice su b&uacute;squeda',
		colorExplicacion: '#99f',
		colorNormal: '#000'
	},
	
	//constructor, que recibe el id de un campo y un objeto con los valores opcionales
	initialize: function(campo, opciones){
		//cargo el elemento en la propiedad campo
		this.campo = $(campo);
		//doy de alta las opciones y las junto con los valores por defecto cuando no se indicaron
		this.setOptions(opciones);
		//llamo a un m&eacute;todo para mostrar la explicacion
		this.explicate();
		
		//creo un evento cuando se quita el foco de la aplicaci&Oacute;n de este campo
		this.campo.addEvent("blur", function(){
			this.explicate();
		}.bind(this));
		
		//creo un eventoi sobre el campo para cuando el usuario se situa en &eacute;l
		this.campo.addEvent("focus", function(){
			//compruebo si en el campo hab&iacute;a escrito la explicaci&Oacute;n
			if (this.campo.value==this.options.texto){
				//borro la explicaci&Oacute;n
				this.campo.value="";
				//coloco el color del texto para cuando no est&aacute; la explicacion
				this.campo.setStyle("color", this.options.colorNormal);
			}
		}.bind(this));
		
	},
	
	//m&eacute;todo para mostrar la explicaci&Oacute;n
	explicate: function(){
		//compruebo si en el campo no hay escrito nada, para no borrar el dato que pueda haber
		if (this.campo.value==""){
			//cargo la explicaci&Oacute;n en el value del campo
			this.campo.value = this.options.texto;
			//coloco el color del texto para la explicacion
			this.campo.setStyle("color", this.options.colorExplicacion);
		}
	}
});
 
window.addEvent("domready", function(){
	var campoExp1 = new CampoAutoexplicativo("palabra");
	//var campoExp2 = new CampoAutoexplicativo("campo2", {'texto': 'Tu edad', 'colorExplicacion': '#c00', colorNormal: '#0c0'});
});

</script>
</head>
<body onLoad="MM_preloadImages('imagenes/inicio_2.png','imagenes/sobre_2.png','imagenes/imprimir_2.png','imagenes/mapa-sitio_2.png','imagenes/ayuda_2.png','imagenes/pestanas_1-B.gif','imagenes/pestana_2-B-.gif','imagenes/pestana_3-B-.gif','imagenes/pestana_4-B-.gif','imagenes/boton_1-B.gif','imagenes/boton_2-B.gif','imagenes/boton_3-B.gif','imagenes/boton_4-B.gif','imagenes/boton_5-B.gif','imagenes/boton_6-B.gif','imagenes/boton_7-B.gif')">
<table border="0" width="1048" align="center" bgcolor="#FFFFFF">
  <tr>
    <td width="1042"><table width="1040" border="0" align="center" cellpadding="0" cellspacing="0">
      <!-- fwtable fwsrc="plantilla_cuerpo_sitio.png" fwpage="Pagina 1" fwbase="planilla_cuerpo_sitio.jpg" fwstyle="Dreamweaver" fwdocid = "2094646739" fwnested="0" -->
      
      <tr>
       <td colspan="5" align="center" valign="top" bgcolor="#FFFFFF"><table border="0" cellpadding="0" cellspacing="0" width="1040">
    
        </table>
          <map name="horizontal_superior_r2_c5MapMap" id="horizontal_superior_r2_c5MapMap">
            <area shape="rect" coords="4,4,120,155" href="http://www.mineduc.cl/index0.php?id_portal=1" target="_blank" alt="Ministerio de Educaci&Oacute;n" />
          </map>
          <table border="0" cellpadding="0" cellspacing="0" width="1040">
          
          </table></td>
    
      </tr>
      <tr>
     
        <td align="center" valign="top" bgcolor="#FFFFFF"><table border="0" align="center">
          <tr>
      
          </tr>
          <tr>
            <td><table width="600" border="0" align="left" cellpadding="0" cellspacing="0">
              <!-- fwtable fwsrc="resultado_BA_parte2.png" fwpage="Pagina 1" fwbase="resultado_BA_parte2.gif" fwstyle="Dreamweaver" fwdocid = "2058552996" fwnested="0" -->
              
              <tr>
                <td align="center" valign="middle">&nbsp;</td>
                <td colspan="9" align="left" valign="middle"><span class="texto_regi&Oacute;n">Usted busc&oacute; por: <?
				$encabezado = $funcionBusqueda->preparaQryEncabezado($conn, $vars, $selProgramaEntrada, $selSubsectorEntrada);
				echo $encabezado;
			?></span></td>
              </tr>
			 <tr>
                <td align="center" valign="middle">&nbsp;</td>
                <td colspan="9" align="left" valign="middle">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" valign="middle"><img src="imagenes/flecha_1.gif" alt="" width="12" height="19" /></td>
                <td colspan="9" align="left" valign="middle"><span class="texto_sub_menu">Su b&uacute;squeda arroj&Oacute;</span><span class="textos_azules_pque&ntilde;os"> <? echo $numeroRegistros; ?></span><span class="texto_sub_menu"> servicios</span></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><img src="imagenes/flecha_1.gif" alt="" width="12" height="19" /></td>
                <td colspan="9" align="left" valign="middle"><span class="texto_sub_menu">P&aacute;gina </span><span class="textos_azules_pque&ntilde;os"><? echo $pagina ?> </span><span class="texto_sub_menu">de</span> <span class="textos_azules_pque&ntilde;os"><? echo $numPags ?></span></td>
               
              </tr>
              <tr>
                <td align="center" valign="middle"><img src="imagenes/flecha_1.gif" alt="" width="12" height="19" /></td>
                <td align="center" valign="middle"><a href="prueba_xls.php?array=<? echo $array;?>&array2=<? echo $array2;?>" ><img src="imagenes/excel.gif" alt="" width="22" height="19" border="0"/></a></td>
                <td colspan="8" align="left" valign="middle"><span class="texto_sub_menu">Descargue el resultado de su b&uacute;squeda</span></td>
                
              </tr>
              <tr>
           
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>
						  <?	
		//$db_selected_1 = mysql_select_db($DB_1, $conn);
		$busqueda = new busqueda();
    	while($registro = mysql_fetch_array($result))
		{
			$descr = $registro["descripcion"];
			$texto = substr($descr, 0, 400);
			$oferta = $registro["id_oferta"];
			$rut 	= $registro["rut"];
			$tipo 	= $registro["id_tipo"];
			
			$db_selected_1 = mysql_select_db($DB_2, $conn2);
			$resultServicioEval = $funcionBusqueda->ServicioEvaluado($conn2, $oferta);
			$db_selected_1 = mysql_select_db($DB, $conn);
			$resultDatosNivel = $funcionBusqueda->datosLineaNivel($conn, $vars, $oferta);
			$resultDatosZona = $funcionBusqueda->datosLineaZona($conn, $vars, $oferta);
			$resultDatosServicio = $funcionBusqueda->datosLineaServicio($conn, $vars, $oferta);

		if ($tipo == "persona"){
				$resultDatosPersona = $funcionBusqueda->datosLineaPersona($conn, $vars, $rut);
				while ($resPer = @mysql_fetch_array($resultDatosPersona)){				
				$registro["razon_social"] = strtolower($resPer["nombre"])." ". strtolower($resPer["apellido_paterno"])." ". strtolower($resPer["apellido_materno"]);
			    $registro["razon_social"] = ucwords($registro["razon_social"]);
				}			
		}
    ?>
			<table border="0" cellpadding="0" cellspacing="0" width="768">
              <!-- fwtable fwsrc="resultado_BA_parte3.png" fwpage="Pagina 1" fwbase="resultado_AB_parte3.gif" fwstyle="Dreamweaver" fwdocid = "805085711" fwnested="0" -->
              
			  
              

              <tr>
                <td bgcolor="#EDF7F9"><img src="imagenes/flecha_2.gif" alt="" width="20" height="19" /></td>
                <td colspan="13" align="left" valign="middle" bgcolor="#EFF7F9"><span class="texto_busqueda-avanzada1"><a href='servicio_encontrado.php?oferta=<? echo $registro["id_oferta"]?>&programa=<? echo $registro["id_programa"] ?>&oferente=<? echo $registro["id_oferente"]?>&comuna=<? echo $registro["comuna_id"]?>&array=<? echo $array ?>&array2=<? echo $array2 ?>&array3=<? echo $array3 ?>&pagina=<? echo $pagina ?>'><? echo $registro["nombre"]; ?></a></span></td>
                
              </tr>
              <tr>
                <td colspan="14" align="left" valign="middle" bgcolor="#FFFFFF"><span class="texto_cuerpo"><? echo $texto."..."; ?></span></td>
            
              </tr>
              <tr>
                <td colspan="6" align="left" valign="middle" bgcolor="#FFFFFF"><span class="texto_institucion"><? echo strtoupper($registro["razon_social"]);?></span></td>
                <td colspan="8" align="left" valign="middle" bgcolor="#FFFFFF"><span class="texto_institucion"><? echo $registro["nombre_fantasia"]; ?></span></td>
            
              </tr>
      



         
          </table>
 			  <?
		}
		}
		?>

				<table border="0" cellpadding="0" cellspacing="0" width="768">
				
					<tr>
					<td  colspan="14" align="right" bgcolor="#FFFFFF"> <span class="texto_busqueda-avanzada1">P&aacute;gina					  <?
		$paginaActual = $_SERVER["PHP_SELF"];
		echo $enlacePie = $funcionBusqueda->linkPag($pagina, $paginaActual, $array, $array2, $array3, $numPags, $inicio, $final);
	?></span></td>
					</tr>
			  </table>	

 	</td>
          </tr>
		 
	 
		 
        </table>
		</td>
      
       
        
      </tr>
      <tr>
        
          <!-- fwtable fwsrc="pie_pagina.png" fwpage="Pagina 1" fwbase="pie_pagina.jpg" fwstyle="Dreamweaver" fwdocid = "1499032241" fwnested="0" -->
          
          
  
        </table></td>
      
      </tr>
      <tr>
        <td colspan="5" align="center" valign="middle"><table border="0" cellpadding="0" cellspacing="0" width="1040">
          <tr> </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-5497648-1");
pageTracker._trackPageview();
</script>
</body>
</html>
