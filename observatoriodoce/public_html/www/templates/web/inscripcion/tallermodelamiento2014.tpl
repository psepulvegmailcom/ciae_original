<a name="formulario"></a>
 <div class="contenido_titulo_separador">	Inscripci&oacute;n al Taller para Futuros Profesores: "El modelamiento y la matem&aacute;tica escolar"
</div>

 
<table class="tabla_simple" border="0">
 <input type="hidden"  name="form_tipo_inscripcion" value="20140530_tallermodelamiento2014_felmer">
<tr>
<td style="width:380px ">
<div id='inscripcion_ficha'> 
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_mensaje.tpls -->
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_tallermodelamiento2014.tpls -->  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/cerradas.tpl -->
 
 
 </div>
 <div id='inscripcion_programa'>  
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/tallermodelamiento2014_programa.tpl --> 
 
 
 </div>
  
 
  
 
  
</td>
<td style=" width:250px ">
 
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_header.tpl -->  
 
   
 
 <li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_ficha');"><strong>Inscripci&oacute;n </strong> </a></li>
<li class="lateral_inscripcion" style="font-size:13px; " ><a href="javascript:mostrarDiv('inscripcion_programa');"><strong>Ver programa</strong>  </a></li>
  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Fecha :</strong><br> 30 de mayo de 2014 14:30 - 19:00 <br>
31 de mayo de 2014 09:30 - 18:00<br>
<strong>Registro y recepci&oacute;n de material es <br>30 minutos antes de la hora de <br>inicio del taller.</strong>
 </li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Dirigido a: </strong><br> Estudiantes de Pedagog&Iacute;a en <br>matem&aacute;tica de ense&ntilde;anza media, <br>Estudiantes de Pedagog&Iacute;a en <br>educaci&oacute;n b&aacute;sica con menci&oacute;n matem&aacute;tica, Estudiantes de <br>Pedagog&Iacute;a en educaci&oacute;n b&aacute;sica <br>sin menci&oacute;n. </li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Lugar presencial: </strong><br>
    Centro de Investigaci&oacute;n Avanzada en <br>Educaci&oacute;n (CIAE). Periodista Jos&eacute; <br>Carrasco Tapia Nº 75, Santiago, Chile</li>  
	
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Organiza: </strong><br>    Centro de Investigaci&oacute;n Avanzada en <br>Educaci&oacute;n (CIAE) y Centro de <br>Modelamiento Matem&aacute;tico (CMM)<br> de la Universidad de Chile  </li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> La inscripci&oacute;n permanecer&aacute; abierta <br>hasta el mi&eacute;rcoles 21 de mayo. Los estudiantes seleccionados ser&aacute;n <br>confirmados por email durante el fin de semana del 24 de mayo.</strong>  </li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Costo: </strong><br>  sin costo (seminario no incluye <br>almuerzo)</li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Cupos:  </strong><br>limitados. 21 cupos por secci&oacute;n  </li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong>Certificados: </strong><br>Certificado de Participaci&oacute;n  </li>  
    <li  class="lateral_inscripcion" style="font-size:13px; " ><strong> Consultas o dudas: </strong><br><a href="mailto:capacitaciones@ciae.uchile.cl" >capacitaciones@ciae.uchile.cl</a> </li>   
  
    
<!-- INCLUDE BLOCK : www/templates/web/bloque_redondeado_footer.tpl --> 
 <br />

 <p> 
 </p>
</td>
 </tr> 
 <tr>
 <td colspan="2">  <div style="text-align:center ">
 <table  style="width:100%">
 <tr>
 <td style="vertical-align:middle; text-align:center"> <img src="imageview.php?image=noticias/logo-cmm.jpg" width="150px"> </td>  
  <td style="vertical-align:middle; text-align:center"> <img src="imageview.php?image=noticias/LOGO2011.jpg" width="150px"></td> 
 </tr>
</table>

<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
function ocultarDiv()
{
	hiddenId('inscripcion_ficha');   
	hiddenId('inscripcion_programa');
}

function mostrarDiv(id)
{ 
	ocultarDiv();
	showId(id);
}
ocultarDiv();

mostrarDiv('inscripcion_ficha');
if(trim(document.main.rut_consultado.value) == '')
{ 
	mostrarDiv('inscripcion_programa');
} 

</script>
<div id='test'></div>
<script type="text/javascript">  

function enviarFormulario()
{   
	var x 		= document.main.elements;	 
	var situacion_academica = false;
	var radio_anterior = '';
	var seleccion_encuesta = false;
	for (var i=0 ; i < x.length ; i++)
	{		
		if(x[i].name == 'form_campo_extra1' && x[i].checked )
		{
			situacion_academica = true;	
		}
		if(x[i].type == 'radio' && x[i].name != 'form_campo_extra1'  )
		{
			if(radio_anterior == '' || radio_anterior != x[i].name)
			{
				if(!seleccion_encuesta && radio_anterior != '')
				{ 
					showAlert('Debe contestar todas las preguntas de la encuesta');
					return false;
				} 				
				seleccion_encuesta = false;
				radio_anterior = x[i].name;	 
			} 	
			if(x[i].checked)
			{
				seleccion_encuesta = true; 
			}	
		}	
	}  
	
	if(!seleccion_encuesta)
	{ 
		showAlert('Debe contestar todas las preguntas de la encuesta');
		return false;
	}	
		
	if(!situacion_academica)
	{
		showAlert('Debe seleccionar situacion academica');
		return false;
	}
	 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut_simple.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/celular.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/region.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->
	
	if(trim(document.main.form_institucion.value) == '')
	{
		showAlert('Debe ingresar la universidad donde estudia');
		return false;
	}	 
	
	if(!checkSelectedMultiple('form_campo_extra3'))
	{ 
		showAlert('Debe seleccionar el curso actual');
		return false;
	}
	if(trim(document.main.form_campo_extra4.value) == '')
	{
		showAlert('Debe ingresar su motivacion');
		return false;
	}	 	

	enviarFormularioBase();
} 
function ocultarFormularioSituacion()
{
	hidetr('cuestionario_estudiantes');
	hidetr('formulario_especifico_situacion_estudiante'); 
}
ocultarFormularioSituacion();
function mostrarFormularioSituacionAcademica()
{ 
	showtr('cuestionario_estudiantes'); 
	showtr('formulario_especifico_situacion_estudiante');
}
mostrarFormularioSituacionAcademica();
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->