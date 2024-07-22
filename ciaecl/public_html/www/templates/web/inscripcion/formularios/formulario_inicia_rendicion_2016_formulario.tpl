 
  
 	<input type="hidden" name="tipo_inscripcion_actual" value="{tipo_inscripcion}">
    <input type="hidden" name="asistencia_anterior" value="{inicia_rendicion_estado_asistencia}">
    <input type="hidden" name="form_tipo_inscripcion" value="2016-ValidacionPruebaINICIA">
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
 
	 <input type="hidden" name="inicia_rendicion_estado_asistencia" value="{inicia_rendicion_estado_asistencia}">
	 <input type="hidden" name="inicia_rendicion_estado_inscripcion_anterior" value="{tipo_inscripcion}">
   	<tr><td colspan="2"><strong style=" text-decoration:underline; font-size:110% ">Datos personales</strong></td></tr>
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_sin_texto.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta_sin_comentario.tpl --> 
    <tr> <td colspan="2"    > 
     <p><small><strong>Ingrese su email correctamente, ya que la confirmaci&oacute;n de su participaci&oacute;n ser&aacute; v&iacute;a correo eletr&oacute;nico.</strong></small></p></td></tr>
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_nacimiento.tpl -->  
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/region.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
   	<tr><td colspan="2"><strong style=" text-decoration:underline; font-size:110% ">Datos acad&eacute;micos</strong></td></tr>
	<tr>
	  <td colspan="2"    style="color: #FF3333; font-weight:bold; font-size:12px;" id='mensaje_clausulas_general'> Los requisitos para participar de este estudio son <strong>estrictos</strong>, debe ser:
	    <ul>
	    <li>Profesionales de Pedagog&iacute;a en Educaci&oacute;n Parvularia, Educaci&oacute;n Diferencial o Especial y Pedagog&iacute;a en Educaci&oacute;n Media&nbsp;en las siguientes disciplinas: Lenguaje y Comunicaci&oacute;n, Matem&aacute;ticas, Historia, Geograf&iacute;a y Ciencias Sociales, Biolog&iacute;a, Qu&iacute;mica, F&iacute;sica, M&uacute;sica y Artes Visuales, TITULADOS entre las a&ntilde;os <strong>2012 y 2015</strong>, </li>
	    <li> Estudiantes de Pedagog&iacute;a en Educaci&oacute;n Parvularia,  Educaci&oacute;n Diferencial o Especial y Pedagog&iacute;a en Educaci&oacute;n Media&nbsp;en las siguientes disciplinas: Lenguaje y Comunicaci&oacute;n, Matem&aacute;ticas, Historia, Geograf&iacute;a y Ciencias Sociales, Biolog&iacute;a, Qu&iacute;mica, F&iacute;sica, M&uacute;sica y Artes Visuales, que est&eacute;n cursando su PEN&Uacute;LTIMO A&Ntilde;O DE CARRERA, esto significa que su proceso de egreso se realizar&aacute; el a&ntilde;o 2017.</li>
      </ul>
	  <strong>Si ud no cumple con estos requisitos, <strong style="text-transform:uppercase">por favor no se inscriba</strong>, De NO cumplir con estos requisitos NO podr&aacute; participar de esta actividad. Los datos del registro ser&aacute;n verificados internamente. Todos los participantes deber&aacute;n firmar un consentimiento informado, por lo que en el caso de no cumplir estos requisitos se puede exponer a sanciones. </strong></td>
  </tr>
	 <tr  id="form_inicia_situacion_academica">
    <td>
		<a name="form_inicia_situacion_academica_a" id='form_inicia_situacion_academica_a'></a>
	<strong>Situaci&oacute;n acad&eacute;mica (*) </strong></td>
    <td style="text-transform:uppercase; font-weight:bold;">
        <input type="radio" name="form_inicia_situacion_academica" value="estudiantes"   onClick="javascript:mostrarAgnoTitulo();revisionClausulasInscripcion();"    >
        Estudiantes <strong>SOLO</strong> pen&Uacute;ltimo a&Ntilde;o de carrera
<br> 
		<input type="radio" name="form_inicia_situacion_academica" value="docentes" onClick="javascript:mostrarAgnoTitulo();revisionClausulasInscripcion();"> 
		Titulado entre los a&Ntilde;os <strong>2012 y 2015</strong> </td>
  </tr>
  <script>
  checkedValue('form_inicia_situacion_academica','{inicia_situacion_academica}');
  
  </script>
  
  	<tr id='form_inicia_situacion_academica_carrera'>
    <td>
		<a name="form_inicia_situacion_academica_carrera_a" id='form_inicia_situacion_academica_carrera_a'></a>
		<strong>Carrera de estudio (*) </strong></td>
    <td>
	
		<select name="form_inicia_situacion_academica_carrera" id='form_inicia_situacion_academica_carrera' onclick="javascript:revisionClausulasInscripcion();"> 
		<option value=""></option>
		<option value="media_lenguaje">Pedagog&iacute;a en Ense&ntilde;anza Media en Lenguaje y Comunicaci&oacute;n </option>
		<option value="media_historia">Pedagog&iacute;a en Ense&ntilde;anza Media en Historia, Geograf&iacute;a y Ciencias Sociales</option>
		<option value="media_matematica">Pedagog&iacute;a en Ense&ntilde;anza Media en Matem&aacute;tica</option> 
		<option value="media_matematica_fisica">Pedagog&iacute;a en Ense&ntilde;anza Media en Matem&aacute;tica y F&iacute;sica</option>  
		<option value="media_fisica">Pedagog&iacute;a en Ense&ntilde;anza Media en F&iacute;sica</option>
		<option value="media_quimica">Pedagog&iacute;a en Ense&ntilde;anza Media en Qu&iacute;mica</option> 
		<option value="media_biologia">Pedagog&iacute;a en Ense&ntilde;anza Media en Biolog&iacute;a</option>
		<option value="media_biologia_quimica">Pedagog&iacute;a en Ense&ntilde;anza Media en Biolog&iacute;a y Qu&iacute;mica</option>
		<option value="media_musica">Pedagog&iacute;a en Ense&ntilde;anza Media en M&uacute;sica</option>
		<option value="media_artes_visuales">Pedagog&iacute;a en Ense&ntilde;anza Media en Artes Visuales</option>
		<option value="educacion_parvularia">Pedagog&iacute;a en Educaci&oacute;n Parvularia</option>
		<option value="educacion_diferencial">Pedagog&iacute;a en Educaci&oacute;n Diferencial o Especial</option>
		<!--<option value="basica_general">Pedagog&iacute;a en Educaci&oacute;n B&aacute;sica</option>-->
		</select>   
	  </td>
  </tr>
  <script>
  selectValue('form_inicia_situacion_academica_carrera','{inicia_situacion_academica_carrera}');
  var academica_carrera_base = '{inicia_situacion_academica_carrera}';
  </script>
	 <tr id='form_inicia_situacion_academica_institucion'>
    <td>
		<a name="form_inicia_situacion_academica_institucion_a" id='form_inicia_situacion_academica_institucion_a'></a>
		<strong>Instituci&oacute;n acad&eacute;mica de estudio (*) </strong></td>
    <td>
        <input  type="text" name="form_inicia_situacion_academica_institucion" style="width:100% "  maxlength="255" value="{inicia_situacion_academica_institucion}"> 
	   </td>
  </tr>
	 
	 
	 <tr id='form_inicia_situacion_academica_agno_titulo' >
    <td>
		<a name="form_inicia_situacion_academica_agno_titulo_a" id='form_inicia_situacion_academica_agno_titulo_a'></a>
		<strong>A&ntilde;o titulaci&oacute;n de instituci&oacute;n acad&eacute;mica  </strong></td>
    <td>
	<select name="form_inicia_situacion_academica_agno_titulo"> 
	<option value="" selected></option>  
	<option value="2012">2012</option> 
	<option value="2013">2013</option> 
	<option value="2014">2014</option>
	<option value="2015">2015</option>  
	</select> 
	   </td>
  </tr>
  <script>
  selectValue('form_inicia_situacion_academica_agno_titulo','{inicia_situacion_academica_agno_titulo}');
  </script>
  
  <tr><td colspan="2" id="mensaje_clausulas" style="color:#FF3333; text-decoration:underline; font-weight:bold; font-size:110%"></td></tr>
  
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
  
   	<tr><td colspan="2"><strong style=" text-decoration:underline; font-size:110% ">Datos laborales</strong></td></tr>
	 <tr id='form_inicia_situacion_laboral'>
    <td>
		<a name="form_inicia_situacion_laboral_a" id='form_inicia_situacion_laboral_a'></a>
		<strong>Trabaja actualmente como profesor (*) </strong></td>
    <td>
        <input type="radio" name="form_inicia_situacion_laboral" value="si-trabaja"> Si<br>
		<input type="radio" name="form_inicia_situacion_laboral" value="no-trabaja"> No
	   </td>
  </tr>
  <script>
  checkedValue('form_inicia_situacion_laboral','{inicia_situacion_laboral}-trabaja');
  </script>
 
 <tr><td colspan="2"></td></tr>
  <tr id='form_inicia_situacion_laboral_colegio_tipo'>
    <td>
		<a name="form_inicia_situacion_laboral_colegio_a" id='form_inicia_situacion_laboral_colegio_a'></a>
		<strong>Tipo de colegio  </strong></td>
    <td>
        <input type="radio" name="form_inicia_situacion_laboral_colegio_tipo" value="Municipal"> Municipal<br>
		<input type="radio" name="form_inicia_situacion_laboral_colegio_tipo" value="Subvencionado"> Subvencionado<br>
		<input type="radio" name="form_inicia_situacion_laboral_colegio_tipo" value="Particular"> Particular
	</td>
  </tr>
  <script>
  checkedValue('form_inicia_situacion_laboral_colegio_tipo','{inicia_situacion_laboral_colegio_tipo}');
  </script>
	   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
  <tr><td colspan="2"></td></tr>
    <tr><td colspan="2"><strong style=" text-decoration:underline; font-size:110% ">Fecha de rendici&oacute;n </strong></td></tr>
  	<tr id='form_inicia_rendicion_sede'>
    <td>
		<a name="form_inicia_rendicion_sede_a" id='form_inicia_rendicion_sede_a'></a>
		<strong>Sede  (*) </strong><br><small>Seleccione la sede donde desee rendir la prueba</small></td>
    <td>
	 
	    
	<!--<input type="radio" name="form_inicia_rendicion_sede"  onclick="javascript:revisionClausulasInscripcion();" value="vina_del_mar"> <strong>Vi&ntilde;a de Mar.</strong> Colegio Rep&uacute;blica de Colombia, 11 Norte 985.
  <br> -->
	 <input type="radio" name="form_inicia_rendicion_sede"  onclick="javascript:revisionClausulasInscripcion();" value="providencia"> <strong>Providencia.</strong> Liceo Polivalente Arturo Alessandri Palma, Avda. Bustamante 443.  
 <br>  
	 
	<!--<input type="radio" name="form_inicia_rendicion_sede" onclick="javascript:revisionClausulasInscripcion();"  value="concepcion"> <strong>Concepci&oacute;n.</strong> Liceo Experimental Lucila Godoy, Rengo 65.
   
  <br>  --> 
	</td>
	</tr>
    
  <script>
  checkedValue('form_inicia_rendicion_sede','{inicia_rendicion_sede}');
  </script> 
      <tr><td colspan="2"></td></tr>
		<tr id='form_inicia_rendicion_fecha'>
    <td>
		<a name="form_inicia_rendicion_fecha_a" id='form_inicia_rendicion_fecha_a'></a>
		<strong>Fecha  (*) </strong><br><small>Seleccione la fecha cuando desee rendir la prueba.</small>
	<a name="form_inicia_rendicion_fecha_a" id="form_inicia_rendicion_fecha_a"></a>
   
	</td>
    <td>  
	 
	<input type="radio" name="form_inicia_rendicion_fecha"  onclick="javascript:revisionClausulasInscripcion();"   value="20160423-jornada_completa">	<strong> 23 de abril de 2016, d&iacute;a completo </strong>(09:00 a 12:00 y 14:00 a 17:00 horas)<br>
	<input type="radio" name="form_inicia_rendicion_fecha"  onclick="javascript:revisionClausulasInscripcion();"    value="20160423-jornada_manana"> 
	<strong>23 de abril de 2016, jornada ma&ntilde;ana</strong> (09:00 a 12:00 horas) <br>
	<input type="radio" name="form_inicia_rendicion_fecha" onclick="javascript:revisionClausulasInscripcion();"    value="20160423-jornada_tarde"> 
	<strong>23 de abril de 2016, jornada tarde </strong> (14:00 a 17:00 horas)<br>
	</td>
	</tr>
	 <input type="hidden" name="fecha_original" value="'{inicia_rendicion_fecha}'">
 
  <script>
  checkedValue('form_inicia_rendicion_fecha','{inicia_rendicion_fecha}');
  </script>
	
	
	
	   
	 
  
  
  <tr>
  <td colspan="2" style="text-align:center">
 
  </td></tr>
   <input type="hidden"  name="tipo_formulario_confirmacion" value='inicia'> 
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">


 <script type="text/javascript">  
	
 	 hidetr('form_inicia_situacion_academica_agno_titulo');
	 function mostrarAgnoTitulo()
	 {
		caso_form = 'form_inicia_situacion_academica'; 
		var seleccion_situacion = emptyCheckValue(caso_form); 
		if(seleccion_situacion == 'docentes')
		{  
			showtr('form_inicia_situacion_academica_agno_titulo');
		}
		else
		{
			 hidetr('form_inicia_situacion_academica_agno_titulo');
		}
	 } 
	 mostrarAgnoTitulo(); 
	 
	 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_inicia_rendicion_2016_revision_clausulas.tpl --> 
	 
	function enviarFormulario()
	{ 
		 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_inicia_rendicion_2016_revision.tpl --> 
		 if(confirm( 'Si ud no cumple con estos requisitos, por favor no se inscriba, porque no podra participar del estudio. Los datos del registro seran verificados. Ud cumple con estos requisitos?'))
		 {
			 enviarFormularioBase();
		 }
	}
	
	 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_inicia_rendicion_2014_completar.tpls --> 
	 </script>

 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->