


	{tag_volver}
<div class="fieldset_title">Solicitud de cometido funcionario/comisi&oacute;n de servicio </div>
	
{mensaje_guardar}
		<fieldset id='formulario_admin'> 
        
        
        
        
        	<div class="fieldset_campos">
		<table style="width:99%">
        
        <tr>
        <td style="text-align:center"><strong>Si pertenece al CIAE</strong></td><td style="text-align:center"><strong>Si no pertenece al CIAE</strong></td>
        </tr>
        <tr>
        <td><input  type="radio" name="tipo_persona" > Planta</td>
                <td><input  type="radio" name="tipo_persona" > Invitado Nacional</td>
        </tr>
        <tr>
        <td><input  type="radio" name="tipo_persona" > Contrata</td>
                <td><input  type="radio" name="tipo_persona" > Invitado Extrajero</td>
        </tr>
        
        <tr>
        <td><input  type="radio" name="tipo_persona" > Honorarios</td>
                <td><input  type="radio" name="tipo_persona" > Invitado por CIAE al extranjero</td>
        </tr>
        </table>
	</div>
	<div class="fieldset_campos">
		<label>		Fecha </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10" style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div> 
	  <div class="fieldset_campos">
		<label>		Nombre </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
	  <div class="fieldset_campos">
		<label>		Email </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
    
	  <div class="fieldset_campos">
		<label>		Rut o Pasaporte </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
    
	  <div class="fieldset_campos">
		<label>		Cargo </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
    
	  <div class="fieldset_campos">
		<label>		Periodo </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
    
	  <div class="fieldset_campos">
		<label>		Origen </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
	  <div class="fieldset_campos">
		<label>		Destino </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10"   >
	</div>
    
	  <div class="fieldset_campos">
		<label>		Objetivo </label> 
		<textarea class="inputtext" type="text"   name="form_bajada"  id="form_bajada"  >{bajada}</textarea> 
	</div>
    
	  <div class="fieldset_campos">
		<label>		Detalle / Observaci&oacute;n  </label> 
		<textarea class="inputtext" type="text"   name="form_bajada"  id="form_bajada"  >{bajada}</textarea> 
	</div>
    
    
	  <div class="fieldset_campos">
		<label>		Vi&aacute;tico (indicar qui&eacute;n paga?) </label> 
		 <table style="width:99%">
                  <tr> 
         <td><input type="radio"  name="viatico_si" onClick="javascript:showtr('viatico_si_paga')"> Si</td>         <td><input type="radio"  name="viatico_si"  onClick="javascript:hidetr('viatico_si_paga')"> No</td>
         </tr>
         <tr id='viatico_si_paga'> 
         <td ><input type="radio" name="viatico_si_paga"> CIAE</td>         <td><input type="radio"  name="viatico_si_paga"> Externos</td>
         </tr>
         </table>
	</div>
    <script>
	hidetr('viatico_si_paga');
	</script>
    
	  <div class="fieldset_campos">
		<label>		Pago de Pasajes </label> 
		 <table style="width:99%">
                  <tr> 
         <td><input type="radio"  name="pasajes_si" onClick="javascript:showtr('pasajes_si_paga')"> Si</td>         <td><input type="radio"  name="pasajes_si"  onClick="javascript:hidetr('pasajes_si_paga')"> No</td>
         </tr>
         <tr id='pasajes_si_paga'> 
         <td ><input type="radio" name="pasajes_si_paga"> CIAE</td>         <td><input type="radio"  name="pasajes_si_paga"> Externos</td>
         </tr>
         </table>
	</div>
    <script>
	hidetr('pasajes_si_paga');
	</script>
    	  <div class="fieldset_campos">
		<label>		Inscripci&oacute;n a seminario</label> 
		 <table style="width:99%">
                  <tr> 
         <td><input type="radio"  name="pasajes_si" > Si</td>         <td><input type="radio"  name="pasajes_si"    > No</td>
         </tr>
         <tr id='pasajes_si_paga'> 
         <td  colspan="2">Monto <input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10" style="width:120px" > </td>         
         </tr>
         </table>
	</div>
    
    
    
        	  <div class="fieldset_campos">
		<label>		Motivo de viaje</label> 
		 <input name="motivo" type="radio"> Participaci&oacute;n en evento<br>
         <input name="motivo" type="radio"> Organizaci&oacute;n de evento<br>

		 <input name="motivo" type="radio"> Actividad de difusi&oacute;n<br>
         <input name="motivo" type="radio"> Estadia de investigaci&oacute;n<br>                 

		 <input name="motivo" type="radio"> Participaci&oacute;n en proyectos R&D dirigidos por otros grupos de investigaci&oacute;n<br>         
         
		 <input name="motivo" type="radio"> Colaboraci&oacute;n en el extranjero (especificar instituci&oacute;n de colaboraci&oacute;n) <br>
         <input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10" style="width:250px" > <br> 
		 <input name="motivo" type="radio"> Otros (especificar) <br>
         <input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10" style="width:250px" > <br>         
	</div>
    
    
        	  <div class="fieldset_campos">
		<label>		Tipo de actividad</label> 
		 <input name="actividad" type="radio"> Congreso Internacional<br>
         <input name="actividad" type="radio"> Congreso Nacional<br>

		 <input name="actividad" type="radio"> Taller<br>
         <input name="actividad" type="radio"> Foro<br>                 

		 <input name="actividad" type="radio"> Competencia<br>         
         
		 <input name="actividad" type="radio"> Exhibici&oacute;n  <br>    
         
		 <input name="actividad" type="radio"> Curso  <br>    
         
		 <input name="actividad" type="radio"> Conferencia  <br>    
         
		 <input name="actividad" type="radio"> Premiaci&oacute;n <br>
		 <input name="motivo" type="radio"> Otros (especificar) <br>
         <input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10" style="width:250px" > <br>  
	</div>
        	  <div class="fieldset_campos">
		<label>		P&Uacute;blico Objetivo</label> 
		 <input name="publico" type="checkbox"> Investigadores<br>
         <input name="publico" type="checkbox"> Estudiantes Postdoctorado<br>

		 <input name="publico" type="checkbox"> Estudiantes Pregrado<br>
         <input name="publico" type="checkbox"> Foro<br>                 

		 <input name="publico" type="checkbox"> Graduados / Licenciados<br>         
         
		 <input name="publico" type="checkbox"> Estudiantes educaci&oacute;n b&aacute;sica <br>    
         
		 <input name="publico" type="checkbox"> Estudiantes educaci&oacute;n secundaria <br>    
         
		 <input name="publico" type="checkbox"> Comunidad General  <br>    
         
		 <input name="publico" type="checkbox"> Compa&ntilde;ias, Industrias, Servicios <br> 
		 <input name="publico" type="checkbox"> Profesores de Colegio<br> 
		 <input name="publico" type="checkbox"> Gobierno<br> 
	</div>
    
    
    
    
    
    
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>


 



<input type="hidden" name="form_time_ingreso" value="{fecha_ingreso}" />
<input type="hidden" name="form_usuario" value="{usuario}" />

<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">
 
function editElement()
{     
	if(isEmpty(document.getElementById('form_titulo').value) || isEmpty(document.getElementById('form_noticia').value) || isEmpty(document.getElementById('form_fecha').value) || isEmpty(document.getElementById('form_autor').value))
	{
		alert('Debe los campos basicos del formulario (titulo, noticia, fecha y autor)'); 
		return false;
	}    
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}