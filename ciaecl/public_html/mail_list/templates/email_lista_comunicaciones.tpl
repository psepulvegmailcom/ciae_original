<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Selección de lista de correo masivo de email</title>
<script languaje="javascript" src="http://www.ciae.uchile.cl/www/libjs/Function.js"></script>
</head>
<style>
td { vertical-align:top; padding:5px; padding-bottom:15px;  }
</style>
<body  > 
<a href='email_lista_comunicaciones.php?u=e889760b9a85dc871b2052565fd1147c'>Refrescar</a> <br><br>
<form name="main" method="post" action="email_lista_comunicaciones.php?u=e889760b9a85dc871b2052565fd1147c">
<table style="width:80%"  border="0">




<tr><td colspan="2" style=" text-align:center"><strong style="font-size:120%">Selección de lista de correo masivo de email CIAE - IE</strong></td></tr>
<tr><td colspan="2"  >
Listas Seleccionadas:<br>
<textarea style="  height:250px; width:900px; ">
<!-- START BLOCK : bloque_tipo_base_salida_tipo -->
{tipo} 
<!-- END BLOCK : bloque_tipo_base_salida_tipo -->
</textarea>
</td></tr>

<tr><td colspan="2" style="height:6px"></td></tr>
 <tr><td></td><td><input type="button" onclick="javascript:enviarEmail();" value="Obtener listas de correo" /></td></tr>
<tr><td></td><td   style="height:6px"><input name="selectAll" onclick="javascript:checkInputAll('tipo_base[]');document.main.selectAll.checked=true;document.main.unselectAll.checked=false;" type="checkbox"> Seleccionar Todo | 		<input name="unselectAll" onclick="javascript:uncheckInputAll('tipo_base[]');document.main.selectAll.checked=false;document.main.unselectAll.checked=true;" type="checkbox"> Deseleccionar Todo </td></tr>

<tr><td></td>
<td  ><strong>Selecciones particulares:</strong><br />
 <!-- START BLOCK : bloque_selecciones_tipo -->
 <!-- START BLOCK : bloque_selecciones_tipo_salto -->
 <br />
 <!-- END BLOCK : bloque_selecciones_tipo_salto -->
 
<input name="seleccion_{caso}" onclick="javascript:seleccionCasos('tipo_base[]','{caso}'); " type="checkbox">{caso}&nbsp;&nbsp;|&nbsp;&nbsp;


 <!-- END BLOCK : bloque_selecciones_tipo -->
</td>
</tr>

<tr><td><strong>Tipo base de datos</strong></td>
<td> 
<!-- START BLOCK : bloque_tipo_base -->
<small>({i})</small> <input type="checkbox" name="tipo_base[]"  value="{tipo_base}">{tipo_base} (total: {total}) <br />
<!-- END BLOCK : bloque_tipo_base --> 
<br />
  

</td></tr>

<tr><td></td><td><input type="button" onclick="javascript:enviarEmail();" value="Enviar Correos" /></td></tr>



 
</table> 
</form>

<ol>
<!-- START BLOCK : bloque_enviado_email -->
<li>{email} enviado </li>
<!-- END BLOCK : bloque_enviado_email -->
</ol>
<br><br><br> 
<script>

function seleccionCasos(name,caso)
{   
	var x = document.main.elements;	 
	for (var i=0 ; i < x.length ; i++)
	{		
		if(x[i].name == name )
		{
			var str = x[i].value;
			var pos = str.lastIndexOf(caso);
			if(pos >= 0)
			{
				x[i].checked = true;								
			} 
		}
	}	
}
function enviarEmail()
{ 
	var x 		= document.main.elements;	
	var seleccion_tipo = false;
	var name = 'tipo_base[]';
	for (var i=0 ; i < x.length ; i++)
	{		
		if(x[i].name == name && x[i].checked)
		{
			seleccion_tipo =  true;								
		}
	}
	if(!seleccion_tipo)
	{ 
		alert('Debe seleccionar al menos un tipo de base de datos a enviar su correo');
		return false;
	}
	
 	document.main.submit();
	 
}
</script>

</body>
</html>


