<? 
/****************************************************************************\
* Chile Compra Interno Sidwod Ltda                                          *
* Version: 0.1	                                                            *
* Author: psepulve <psepulve@gmail.com>                                     *
*****************************************************************************/
include '_common.php';
$pPageIsPublic = false;
include PRJ_INCLUDE_PATH.'html/header.php';


/*psepulve*/
include PRJ_CLASS_PATH.'pkg_sid_chilecompra.php';
include PRJ_CLASS_PATH.'pkg_sid_chilecompra_info.php';


$mostrarLasNo = TRUE;
$linkChileCompra = 'http://www.mercadopublico.cl/Procurement/Modules/RFB/DetailsAcquisition.aspx?';

$datos = new ChileCompra();
					
if(isset($_POST['ingresar']) && trim($_POST['ingresar']))
{
	$insert = create_insert_chilecompra($_POST['url'],$_POST['revisar']);
	//echo $insert;
	$datos->insertPropuesta($insert);
}
if(isset($_GET['ocultar']) && $_GET['ocultar'] > 0)
{
	$datos->ocultarPropuesta($_GET['ocultar']);
} 
if(isset($_GET['publicar']) && $_GET['publicar'] > 0)
{
	$datos->publicarPropuesta($_GET['publicar']);
} 

$visibles = true;
if(isset($_GET['verTodo']) && $_GET['verTodo'] == 'yes')
{
	$visibles = false;
} 

$propuestas   = $datos->getPropuestas(true,$visibles);
$propuestasNO = $datos->getPropuestas(false,$visibles);
							
?>		
<br><br>
<form name="main" action="sid_chilecompra.php" method="post">

<table cellspacing="1" cellpadding="2" border="0" width="60%" align="center" >

<tr><td></td><td><strong>Ingresar nueva :</strong></td></tr>
<tr><td width="10%"><strong>Url:</strong> </td>
<td width="90%"><input name="url" value=""   type="text" style="width:100%"/> </td></tr>
<tr><td><strong>Revisar:</strong></td>
<td> <select name="revisar">
<option value="0">Revisar</option>
<option value="1">No Revisar</option>
</select>
</td></tr>
<tr><td></td><td><input type="submit" name="ingresar" value="Ingresar" /></td></tr>

</table>
</form><br><br>
<a href="?verTodo=yes">Ver Todo (publicas y ocultas)</a>&nbsp;&nbsp;
<a href="?">Ver P&uacute;blicas</a><br><br>
<b>Propuestas que deber&iacute;amos revisar</b><br><br>
<div id="content">
<table cellspacing="1" cellpadding="2" border="0" width="100%" class="sheet">
		<thead>
			<tr align="left">
				<th width="1%" ></th>
<th width="8%" class="act"  colspan="2"><b>Fecha Postulaci&oacute;n</b></th> 
<th width="8%" class="act"><b>N&uacute;mero Adquisici&oacute;n</b></th> 
<th width="10%" class="act"><b>Instituci&oacute;n </b></th>
<th width="10%" class="act"><b>Proyecto </b></th> 
<th width="20%" class="act"><b>Descripci&oacute;n </b></th> 
<th width="8%" class="act"><b>Requiere estar en ChileProveedores </b></th> 
<th width="8%" class="act"><b>Presupuesto Estimado</b></th> 
<th width="8%" class="act"><b>Link</b></th>			
	<th width="5%" class="act"><b>Ocultar</b></th>	
				
				
			</tr>
		</thead>
		<tbody>
	<?				
mostrarDatos($propuestas);
echo "</table><br>";

	if($mostrarLasNo)
	{
	?>		
	<br><br><b>Propuestas interesante pero creo que nos quedan grande </b><br><br>
	<div id="content">
	<table cellspacing="1" cellpadding="2" border="0" width="100%" class="sheet">
			<thead>
				<tr align="left">
				<th width="1px"></th>
	<th width="8%" class="act" colspan="2"><b>Fecha Postulaci&oacute;n</b></th> 
	<th width="8%" class="act"><b>N&uacute;mero Adquisici&oacute;n</b></th> 
	<th width="10%" class="act"><b>Instituci&oacute;n </b></th>
	<th width="10%" class="act"><b>Proyecto </b></th> 
	<th width="20%" class="act"><b>Descripci&oacute;n </b></th> 
	<th width="8%" class="act"><b>Requiere estar en ChileProveedores </b></th> 
	<th width="8%" class="act"><b>Presupuesto Estimado</b></th> 
	<th width="8%" class="act"><b>Link</b></th>			
	<th width="5%" class="act"><b>Ocultar</b></th>		
					
				
				</tr>
			</thead>
			<tbody> 
		<?		 	
	mostrarDatos($propuestasNO);
	echo "</table><br><br><br><br>";
	}


function mostrarDatos($arreglo)
{

	$link = "http://www.chilecompra.cl/AmbientePublico/AP_Busquedaavanzada.aspx?TP=Invitado&NumeroLC=";
	$i = 1;
	foreach($arreglo as $caso => $datos)
	{
		echo "<tr>";	
		echo "<td>".$i."</td>"; $i++;
		//$date_diff = mktime() - strtotime($datos['fecha'])
		$date_diff = round(( strtotime($datos['fecha'])-mktime()) / 3600, 0 );		
		$hora_diff = $date_diff%24;
		$dia_diff  = floor($date_diff/24);
			
		
		$fecha = "<font ";
			$color = "";
		if($dia_diff < 8 )
			$color = "color=orange";
		if($dia_diff < 4 )
			$color = "color=red";
			
		$fecha.= $color."><b>".$datos['fecha']."</b><br>quedan ".$dia_diff." d&iacute;a(s) y ".$hora_diff."  horas</font >";


		$date_diff = round( abs(strtotime(date('y-m-d'))-strtotime($datos['fecha_creacion'])) / 86400, 0 );		
		
		if($date_diff < 2)
			echo  "<td valign=top align=center><font color=blue>Nuevo</font></td> "." <td valign=top align=center>".$fecha."</td>"; 
		else
			echo " <td valign=top colspan=2 align=center>".$fecha."</td>";  
		
		echo " <td valign=top align=center>".htmlentities($datos['numero'])."</td>";
		echo " <td valign=top>".htmlentities($datos['institucion'])."</td>";
		echo " <td valign=top>".htmlentities($datos['propuesta'])."</td>";
		echo " <td valign=top>".htmlentities($datos['descripcion'])."</td>";
		echo " <td valign=top>".htmlentities($datos['chileproveedores'])."</td>";
		echo " <td valign=top>".htmlentities($datos['presupuesto'])."</td>";
//		echo " <td valign=top align=center><a href='".$link.trim($datos['numero'])."' target=blank>Ver</a></td>";
		echo " <td valign=top align=center><a href='".$datos['link']."' target=blank>Ver</a></td>";
		if($datos['publicar'] == 0)
			echo " <td valign=top align=center><a href='?publicar=".$datos['id']."'>Publicar</a></td>";
		else
			echo " <td valign=top align=center><a href='?ocultar=".$datos['id']."'>Ocultar</a></td>";
		echo "</tr>";
	}
}
?>		
 </div >
		
