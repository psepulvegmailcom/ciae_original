<title>Tareas Sistema CIAE</title>
<form  enctype="multipart/form-data"  target="_self" action="tareas.php"   name="main" method="post">
Archivo: <input name="tareas" type="file" /><br /><br />
Clave : &nbsp;&nbsp;<input name="clave"  style=" width:300px"    type="text"/><br /><br />
Usuario: 
<select name="usuario">

<option ></option>
<option >jaime_rios</option>
<option>pablo_dartnell</option>
<option>paulina_sepulveda</option>
</select>
 <br /><br />

<input type="button" onclick="javascript:actualizar();"  value="actualizar"/>
</form>
<script>
function actualizar()
{
	if(document.main.tareas.value == '')
	{
		alert('Falta archivo ');
		return false;
	}
	
	if(document.main.clave.value == '')
	{
		alert('Falta clave ');
		return false;
	}
	if(document.main.usuario.value == '')
	{
		alert('Falta clave ');
		return false;
	}
	document.main.submit();
}
</script>
<br /><br />
<?php
include('../parvularias/clases/tools.php');
include('../parvularias/clases/ControladorDeFunciones.php');

$path = 'tareas/';

if(is_array($_POST) && count($_POST)>0)
{
	if($_POST['clave'] == 'ciae_admin_interno')
	{
		$_FILES['tareas']['path'] = $path;
		$_FILES['tareas']['name'] = date("YmdHis").'-'.$_POST['usuario'].'-'."TareasSistemas.xls"; 
		$SALIDA = SIDTOOLHtml::guardarArchivo($_FILES['tareas'],false); 
		$to = 'sistemas@ciae.uchile.cl'; 
		$subject = 'Actualización de documentos de tareas sistema CIAE';
		$body = $subject.'<br><a href="http://www.ciae.uchile.cl/intranet/sistema/tareas.php">Acceso</a>';
		$fromaddress = $to;
		$fromname = $_POST['usuario'];
		$bcc = 'pampli@gmail.com, contacto@sidwod.com';
	//	$bcc = 'dartnell@dim.uchile.cl,jrios@ciae.uchile.cl'; 
		SIDTOOLHtml::sendEmail($to, $body, $subject, $fromaddress, $fromname);
	}
	else
	{
		echo "NO TIENE PERMISO PARA ACTUALIZAR ARCHIVO DE TAREAS";
	}
} 
$archivos 	= SIDTOOLHtml::obtenerArchivos($path); 
rsort($archivos);
$total = count($archivos); 
for($i=0; $i < $total; $i++)
{
	echo "<br><a href='tareas/".$archivos[$i]."'>".$archivos[$i]."</a>";
}
?> 