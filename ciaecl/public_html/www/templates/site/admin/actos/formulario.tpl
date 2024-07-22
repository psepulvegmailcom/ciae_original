
	<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->
		<fieldset id='formulario_admin'> 	 	 
	<div class="fieldset_campos">
		<label>		Evento </label><br  />
		<input  class="inputtext" type="text"   name="form_nombre"  id="form_nombre"  value='{nombre}' maxlength="250"  > 
	</div>	
	<div>
		<label>		Tipo de Evento  </label><br  />
		<select  class="inputtext"   name='form_tipo_evento'> 
		 <option value="taller"  >taller</option> 
		 <option value="lanzamiento"  >lanzamiento</option>
         <option value="charla"  >charla</option>  
		 <option value="seminario"  >seminario</option> 
         <option value="congreso"  >congreso</option>
         <option value="diplomado"  >diplomado</option>
         <option value="magister"  >magister</option>
		 <option value="{tipo_evento}"  selected > {tipo_evento} </option>		
		</select>
		
	</div>
	<div>
		<label>		Informacion Completa  </label><br  />
		<select  class="inputtext"   name='form_info_completa'> 
		 <option value="si"  >si</option> 
		 <option value="no"  >no</option>
		 <option value="{info_completa}"  selected > {info_completa} </option>		
		</select>
		
	</div>
    	<div class="fieldset_campos">
		<label>		 Fecha Inicio </label> <br  />
	  		<input  class="inputtext" type="text"   name="form_fecha_inicio"  id="form_fecha_inicio"  value="{fecha_inicio_html}" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha_inicio,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div>


    <div class="fieldset_campos">
	  <label>		Fecha T&eacute;rmino </label>
	  <br  />
	  		<input  class="inputtext" type="text"   name="form_fecha_termino"  id="form_fecha_termino"  value="{fecha_termino_html}" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha_termino,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div> 
   
  <div class="fieldset_campos">
	  <label>		Total inscritos   </label> 
	  <br><strong>Inscritos presencial:</strong> {total_inscritos_presencial}
	  <br><strong>Inscritos online:</strong> {total_inscritos_online}
	  <br  />
	  <a href="https://www.ciae.uchile.cl/bdbaja/base_descarga_generico.php?caso={id_inscripcion}&c=d6dcb1&dtipo=simple&caso_extra=listado_inscripcion" target="_blank">Ver listado de inscripcion interno</a><br>
	  <a href="https://www.ciae.uchile.cl/bdbaja/base_descarga_generico.php?caso={id_inscripcion}&c=d6dcb1&dtipo=simple&caso_extra=inscripcion" target="_blank">Ver listado de inscripcion publico</a><br>
	  <a href="https://www.ciae.uchile.cl/bdbaja/base_descarga_generico.php?caso={id_inscripcion}&c=d6dcb1&dtipo=simple&caso_extra=listado_inscripcion_imprimir" target="_blank">Ver listado de inscripcion publico para impresion</a><br>
	</div>  
<div class="fieldset_campos">
	  <label>		Total Asistencia </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_total_asistencia"  id="form_total_asistencia"  value="{total_asistencia}" > 
	</div>
    
<div class="fieldset_campos">
	  <label>		Instituci&oacute;n Co-Organizadora </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_institucion_co_organizadora"  id="form_institucion_co_organizadora"  value="{institucion_co_organizadora}" > 
	</div>    
    
 <div class="fieldset_campos">
	  <label>		Id Inscripci&oacute;n </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_id_inscripcion"  id="form_id_inscripcion"  value="{id_inscripcion}" > 
	</div> 
    <div class="fieldset_campos">
	  <label>		Inscripci&oacute;n fecha Cierre </label>
	  <br  />
	  		<input  class="inputtext" type="text"   name="form_inscripcion_fecha_cierre"  id="form_inscripcion_fecha_cierre"  value="{inscripcion_fecha_cierre_html}" maxlength="10" readonly style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_inscripcion_fecha_cierre,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div> 
<div class="fieldset_campos">
	  <label>		Inscripci&oacute;n Cupo M&aacute;ximo </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_inscripcion_cupos_maximo"  id="form_inscripcion_cupos_maximo"  value="{inscripcion_cupos_maximo}" > 
	</div>                

<div class="fieldset_campos">
	  <label>		Email </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_email"  id="form_email"  value="{email}" > 
	</div> 
<div class="fieldset_campos">
	  <label>		Ubicaci&oacute;n </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_ubicacion"  id="form_ubicacion"  value="{ubicacion}" > 
	</div> 
    
<div class="fieldset_campos">
	  <label>		Fecha Texto </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_date_texto"  id="form_date_texto"  value="{date_texto}" > 
	</div>     

    <div class="label_fieldset">

    <label>		Programa  </label><p></p><br  />

    {form_evento_editor}
    <textarea class="evento_edicion"  type="text"   name="form_programa"  id="form_programa"  style="height:200px " >{programa} </textarea> 
    </div> 
    <div class="label_fieldset">
    <label>		Costo, Texto Extra  </label><p></p><br  />

    <textarea class="evento_edicion"  type="text"   name="form_costo_texto_extras"  id="form_costo_texto_extras"  style="height:200px " >{costo_texto_extras} </textarea> 
    </div>
    <div class="label_fieldset">
    <label>		Mensaje extra notificaciones  </label>( solo en caso de querer notificar algo extra, como streming, cierre inscripcion, cancelacion, etc)<p></p><br  />

    <textarea class="evento_edicion"  type="text"   name="form_mensaje_extra_notificacion"  id="form_mensaje_extra_notificacion"  style="height:200px " >{mensaje_extra_notificacion} </textarea> 
    </div>
    <!-- START BLOCK : bloque_form_editor -->
     <script type="text/javascript">
	 tinymce.init({
  		selector: 'textarea',  
	 });
	 </script>
    <!-- END BLOCK : bloque_form_editor -->
<div class="fieldset_campos">
	  <label>	Link Online </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_link_online"  id="form_link_online"  value="{link_online}" > 
	</div>     
    
<div class="fieldset_campos">
	  <label>	Listas </label>
	  <br  />
	<textarea   class="inputtext"  name="form_listas"  id="form_listas" >{listas}</textarea> 
	</div>   

<div class="fieldset_campos">
	  <label>		Logos </label>
	  <br  />
	<textarea   class="inputtext"    name="form_logos"  id="form_logos" >{logos}</textarea>
	</div>  	 

 	<div>
		<label>		Tipo Formulario Confirmacion  </label><br  />
		<select  class="inputtext"   name='form_tipo_formulario_confirmacion'> 
		 <option value="simple"  >simple</option> 
		 <option value="confirmacion"  >confirmaci&oacute;n</option>
         <option value="online"  >online</option>
		 <option value="{tipo_formulario_confirmacion}"  selected > {tipo_formulario_confirmacion} </option>		
		</select>		
	</div> 

  <div class="fieldset_campos">
	  <label>		Certificado Encabezado fecha </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_certificado_encabezado_fech"  id="form_certificado_encabezado_fech"  value="{certificado_encabezado_fech}" > 
	</div> 
    
     <div class="fieldset_campos">
	  <label>		Certificado fecha </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_certificado_fec"  id="form_certificado_fec"  value="{certificado_fec}" > 
	</div> 
    
     <div class="fieldset_campos">
	  <label>		Certificado horas </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_certificado_horas"  id="form_certificado_horas"  value="{certificado_horas}" > 
	</div> 	
    
     <div class="fieldset_campos">
	  <label>		Certificado ubicaci&oacute;n </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_certificado_ubicacion"  id="form_certificado_ubicacion"  value="{certificado_ubicacion}" > 
	</div>
     
     <div class="fieldset_campos">
	  <label>		Certificado organizadores </label>
	  <br  />
    <input  class="inputtext" type="text"   name="form_certificado_organizadores"  id="form_certificado_organizadores"  value="{certificado_organizadores}" > 
	</div> 
		  
		  		  		  
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span>
</button> 
  
	
	 	</fieldset>
 
<input type="hidden" value="{id_noticia}" name="id_noticia" id="id_noticia">
<input type="hidden" value="{id_evento}" name="id_evento" id="id_evento">

 

<script type="text/javascript">

document.main.id_item.value = '{id_evento}';
document.main.item_id.value = '{prefijo_nombre_extra_archivo}'+document.main.id_item.value;
	
function editElement()
{    
	if(document.main.form_tipo_formulario_confirmacion.value == 'online' && trim(document.main.form_link_online.value) == '')
	{
		alert('Debe ingresar link online');
		return false;
	}		
	
	if(!validacionCampoTextoSimple('form_nombre'))
	{
		return false;
	} 
	if(!validacionCampoTextoSimple('form_tipo_evento'))
	{
		return false;
	} 
		
	enviar_accion_admin('{opcion_modulo}|guardar',document.main.id_item.value);	 
}
</script>
{tag_volver}