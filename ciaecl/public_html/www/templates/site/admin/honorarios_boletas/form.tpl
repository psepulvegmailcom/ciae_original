


		<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->
		<script>
			changeTextId('fieldset_title_form','Importar datos');
</script>
	
 <!-- INCLUDE BLOCK : www/templates/site/admin/viajes/ficha_persona_honorario.tpl --> 
 
 <div  id='detalle_persona'>
        <fieldset id='formulario_admin_honorarios'> 
         
        <legend>Datos convenio </legend>
        
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		N&uacute;mero de convenio </label> 
				  <input  type="text" class='inputtext' name='formconvenio_investigador'>
	</div>
	
	<div class="fieldset_campos">
   <label>		Fecha de convenio </label> 
		<input  class="inputtext" type="text"   name="form_fecha_convenio"    {disable_input} title="" id="form_fecha_convenio"   maxlength="10" style="width:120px"  value="{fecha_convenio_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_convenio,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		N&uacute;mero de decreto </label> 
				  <input  type="text" class='inputtext' name='formconvenio_investigador'>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		N&uacute;mero de memo</label> 
				  <input  type="text" class='inputtext' name='formconvenio_investigador'>
	</div>
       	  
	<div class="fieldset_campos">
   <label>		Fecha de creaci&oacute;n </label> 
		<input  class="inputtext" type="text"   name="form_fecha_creacion"    {disable_input} title="" id="form_fecha_creacion"   maxlength="10" style="width:120px"  value="2017-11-14"> <A HREF="#" onClick="cal.select(document.main.form_fecha_creacion,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
	<div class="fieldset_campos">
   <label>		Fecha de t&eacute;rmino </label> 
		<input  class="inputtext" type="text"   name="form_fecha_termino"    {disable_input} title="" id="form_fecha_termino"   maxlength="10" style="width:120px"  value="{fecha_termino_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_termino,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
        	  <div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Labor  </label> 
				  <textarea class='inputtext' name="formconvenio_labor"></textarea>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Labor resumida </label> 
				  <textarea class='inputtext' name="formconvenio_labor_resumida" maxlength="70"></textarea>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Calidad </label> 
				  <select class='inputtext'  name="formconvenio_calidad">
					  <option></option>
					  <option value="profesional" >Profesional</option>
					  <option value="experto" >Experto</option>
					  <option value="experto-profesional" >Experto-Profesional</option>
		</select>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Investigador responsable </label> 
				  <select   class="inputtext" name="form_investigador_responsable" id="form_investigador_responsable"   >
			 <option></option>
			  <!-- START BLOCK : bloque_persona_responsable --> 
			 <option value="{id_persona}">{apellido_paterno}, {nombre}  ({email})</option>
			  <!-- END BLOCK : bloque_persona_responsable -->
			</select>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Texto para memos </label> 
				  <input  type="text" class='inputtext' name='formconvenio_para_memos'>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Texto para sistema honorarios </label> 
				  <input  type="text" class='inputtext' name='formconvenio_para_honorarios'>
	</div>
	
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Centro de costo </label> 
			
	<select name="form_id_centro_costo" id="form_id_centro_costo">
        <option value=""></option>
         <!-- START BLOCK : bloque_centros_costo -->
         <option value="{id_centro_costo}">{codigo} - {centro_costo} ({nombre} {apellido_paterno})</option>
         <!-- END BLOCK : bloque_centros_costo --> 
        
        
         </select>
			</div>
			
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Monto comprometido</label> 
				  <input  type="text" class='inputtext' name='formconvenio_monto'>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Horas jornadas</label> 
				  <input  type="text" class='inputtext' name='formconvenio_horas'>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Comentario Horas jornadas</label> 
				  <input  type="text" class='inputtext' name='formconvenio_comentario_horas_jornada'>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Glosa cl&aacute;usula</label> 
				  <input  type="text" class='inputtext' name='formconvenio_glosa_clausula'>
	</div>
	<div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		N&uacute;mero de cuotas</label> 
				  <select>
					  <option>1</option>
					  <option>2</option> 
					  <option>3</option> 
					  <option>4</option> 
					  <option>5</option> 
					  <option>6</option> 
					  <option>7</option> 
					  <option>8</option> 
					  <option>9</option> 
					  <option>10</option>
					  <option>11</option> 
					  <option>12</option> 
					  <option>13</option>   
		</select>
	</div>
	
	<div class="fieldset_campos">
   <label>		Fecha de inicio labor </label> 
		<input  class="inputtext" type="text"   name="form_fecha_termino"    {disable_input} title="" id="form_fecha_termino"   maxlength="10" style="width:120px"  value="{fecha_termino_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_termino,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
	 
	<div class="fieldset_campos">
   <label>		Fecha de fin labor </label> 
		<input  class="inputtext" type="text"   name="form_fecha_hasta"    {disable_input} title="" id="form_fecha_hasta"   maxlength="10" style="width:120px"  value="{fecha_hasta_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_hasta,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
			
	<div class="fieldset_campos">
   <label>		Fecha de firma </label> 
		<input  class="inputtext" type="text"   name="form_fecha_firma"    {disable_input} title="" id="form_fecha_firma"   maxlength="10" style="width:120px"  value="{fecha_firma_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_firma,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
			
	<div class="fieldset_campos">
   <label>		Documento firmado </label> 
		<input type="file" name="archivo_firma">
			</div>
			
	<div class="fieldset_campos">
   <label>		Fecha compromiso </label> 
		<input  class="inputtext" type="text"   name="form_fecha_compromiso"    {disable_input} title="" id="form_fecha_compromiso"   maxlength="10" style="width:120px"  value="{fecha_compromiso_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_compromiso,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
			
	<div class="fieldset_campos">
   <label>		Fecha de aprobaci&oacute;n </label> 
		<input  class="inputtext" type="text"   name="form_fecha_aprobacion"    {disable_input} title="" id="form_fecha_aprobacion"   maxlength="10" style="width:120px"  value="{fecha_aprobacion_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_aprobacion,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div>
			
			 <div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Observaciones  </label> 
				  <textarea class='inputtext' name="formconvenio_labor"></textarea>
	</div>
			 
			  
			    
	 </fieldset></div>
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	 


 
<input type="hidden" name="form_id_persona" value="{form_id_persona}" />
<input type="hidden" name="time_ingreso" value="{time_ingreso}" />
<input type="hidden" name="usuario" value="{usuario}" />

<script type="text/javascript">
document.main.id_item.value = '{id_item}';


	
function editElement()
{     
	<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/ficha_persona_honorario_validacion.tpl -->
	process('{opcion_modulo}|guardar',0);	  
}
</script>
{tag_volver}