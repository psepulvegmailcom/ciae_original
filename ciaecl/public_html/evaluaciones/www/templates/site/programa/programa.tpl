<style>
ol, ul, li {text-align:left; padding-left:20px;   }
li { padding-bottom:5px; padding-left:0px;}
.fila_programa { width: 950px; background-color:#FFFFFF; }
.fila_programa td { text-align:center; border: 1px solid #333333; padding: 10px 5px 10px 5px;}
.style2 {color: #FFFFFF}
.fila_programa_invitados, .bloque_conferencia { background-color:#06518A; color:#FFFFFF;text-align:center; }
.titulo_dia {text-align:center; font-size:18px;  padding:25px; color:#06518A; font-weight:bold}
.bloque_comun, .bloque_vacio, .bloque_trabajo {width: 217px;}
.bloque_horario { font-weight:bold; font-size:10px;  width: 80px; }
.bloque_general { background-color:#E9E9E9;}
.radio_confirmacion { height: auto}
.confirmacion {padding:5px 5px 8px 5px; margin:3px; border:1px solid #333333; color: #444444; background-color:#F2F2F2}
</style>

<input type="hidden" value="view_inscripcion"  name="opcion" />
 <!-- INCLUDE BLOCK : www/templates/site/www/ocultar_menu.tpl -->  
<div style="text-align:right"><a  href="index.php">&raquo; Volver </a>

<br />
<br /> 
<a href="download.php?file=programaCIIE2012.pdf" target="_blank"><img src="www/images/filetypes/pdf.gif" border="0"> Programa PDF</a>
</div>


<div style="text-align:left">
<!-- START BLOCK : bloque_formulario_inicio -->
<br /><br />
<font style="font-size:110%; font-weight:bold">
Esta inscripción por sesión es meramente indicativa, para que el Comité Organizador pueda dimensionar la concurrencia a cada una. Le solicitamos ingresar su email (el mismo utilizado para su inscripción). <br /> <br />
Una vez confirmado su email, aparecerá el Programa del Congreso donde ud debe marcar las sesiones a las cuales tiene intención de asistir y posteriormente enviar su confirmación.</font>
<br /><br />
<!-- END BLOCK : bloque_formulario_inicio -->


<!-- START BLOCK : bloque_formulario_inicio_indicaciones -->
<font style="font-size:90%;  "> &nbsp;</font>
<!-- END BLOCK : bloque_formulario_inicio_indicaciones -->
</div>
<!-- START BLOCK : bloque_formulario_email -->

<br /><br />
<table width="95%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%"><strong>Email (*)</strong> </td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:60%" maxlength="255" value="{email}" onchange="javascript:consultarPorEmail();"> 
		
		<button type="button" name="submit_enviar"  value="submit_enviar" tabindex="28" onclick="javascript:consultarPorEmail();" id="submit-submit_enviar">
Confirmar Email</button> 
		</td>
  </tr>
  </table>

<!-- END BLOCK : bloque_formulario_email -->

<!-- START BLOCK : bloque_formulario_error_inscrito -->

<font style="font-size:110%; color:#FF0000; font-weight:bold">El email {email} no se encuentra inscrito en la base del Congreso.</font><br />
Para inscribirse, por favor complete el formulario de inscripción <a href="?page=view_inscripcion">aquí</a> y posteriormente confirme su participación. <br />
De antemano le agradecemos su interés y participación
<!-- END BLOCK : bloque_formulario_error_inscrito -->

<!-- START BLOCK : bloque_formulario_inscrito_exito -->  
 <!-- INCLUDE BLOCK : www/templates/site/cartas/inscripcion_seccion_detalle.tpl -->  
 
 <br /><br />
 Si desea editar su inscripción ingrese <a href="?page=view_confirmacion&form_email={email}&guardar=consultaEmail">aquí</a>
<!-- END BLOCK : bloque_formulario_inscrito_exito -->


<!-- START BLOCK : bloque_formulario_inscrito -->
<input type="hidden" name="form_email" value="{email}" />
<table width="95%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%"><strong>Email  </strong> </td>
    <td style="width:70%"> 
        {email}
		</td>
  </tr>
  <tr>
    <td style=" width:30%"><strong>Nombre  </strong> </td>
    <td style="width:70%"> 
        {nombre} {apellidos}
		</td>
  </tr>
  
  <!-- START BLOCK : bloque_formulario_inscrito_seccion -->
  <tr>
  <td colspan="2">Ud se ha inscrito en las siguientes sesiones:</td>
  </tr>
  <tr>
	  <ul>
	  <!-- START BLOCK : bloque_formulario_inscrito_seccion_detalle -->
	  <li>{titulo}</li>
	  <!-- END BLOCK : bloque_formulario_inscrito_seccion_detalle -->
	  <ul>
  </tr>
  <!-- END BLOCK : bloque_formulario_inscrito_seccion -->
  </table>
<!-- END BLOCK : bloque_formulario_inscrito -->

<!-- START BLOCK : bloque_titulo_dia -->
 <div  class="titulo_dia">

 {dia} </div>

<table border="0" class="fila_programa" cellspacing="0" cellpadding="0"  >
 
<!-- START BLOCK : bloque_fila_seccion -->
  <tr>
    <td  class="bloque_horario"  > 
	
			<!-- START BLOCK : bloque_confirmacion_no --> 
			<!-- INCLUDE BLOCK : www/templates/site/programa/no_asistencia.tpl -->
		<!-- END BLOCK : bloque_confirmacion_no -->
  <strong> <small>{horario}</small></strong> 
		</td>
	<!-- START BLOCK : bloque_comun -->
	
		<td   nowrap colspan="4"  class="bloque_{tipo}"  valign="top"> 
		
		<!-- START BLOCK : bloque_confirmacion_1 --> 
			<!-- INCLUDE BLOCK : www/templates/site/programa/confirmacion_asistencia.tpl -->
		<!-- END BLOCK : bloque_confirmacion_1 -->
		<strong>&nbsp;{titulo}&nbsp;</strong> <br />{texto}</td>
	
	<!-- END BLOCK : bloque_comun -->

	<!-- START BLOCK : bloque_compartido --> 
		<td  valign="top"    class="bloque_{tipo}">
		
		<!-- START BLOCK : bloque_confirmacion_3 -->
			<!-- INCLUDE BLOCK : www/templates/site/programa/confirmacion_asistencia.tpl -->
		<!-- END BLOCK : bloque_confirmacion_3 -->
		<!-- START BLOCK : bloque_compartido_conferencia -->  
		
		<strong>&nbsp;INVITADO&nbsp;INTERNACIONAL&nbsp;</strong><br>
		 
		<!-- END BLOCK : bloque_compartido_conferencia -->
		
		<strong>&nbsp;{titulo}&nbsp;</strong><br><br>{texto}
		</td> 
	<!-- END BLOCK : bloque_compartido -->
	
  </tr>
<!-- END BLOCK : bloque_fila_seccion -->
</table>


<!-- END BLOCK : bloque_titulo_dia -->
<!-- START BLOCK : bloque_formulario_fin -->
 
<br /><br />
<table width="95%" border="0" cellpadding="3">
  <tr>
    <td colspan="2" align="center"> 
	<button type="button" name="submit_enviar"  value="submit_enviar" tabindex="28" onclick="javascript:enviarInscripcion();" id="submit-submit_enviar">
Enviar confirmación asistencia</button> </td>
  </tr>
</table>
<!-- END BLOCK : bloque_formulario_fin -->

<div id='test'></div>
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">
 <script>
	function enviarInscripcion()
	{ 
		var enviar = false;
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{			     
			if(x[i].checked && x[i].value != '')
			{
				enviar = true;
			}
		}
	
		if(enviar)
		{
			document.main.guardar.value = 'guardarConfirmacion';
			document.main.page.value = document.main.opcion.value;
			document.main.submit();
		}
		else
		{
			alert('Debe marcar al menos una sesion a la cual tenga intencion de asistir');
		}
	}
	function consultarPorEmail()
	{
		if(document.main.form_email.value == '')
		{
			alert('Debe ingresar email');
			document.main.form_email.focus();
			return false;
		} 
		document.main.guardar.value = 'consultaEmail';
		document.main.page.value = document.main.opcion.value;
		document.main.submit();
	}
 </script>