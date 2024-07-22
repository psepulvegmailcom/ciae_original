<div  id='detalle_persona'>
        <fieldset id='formulario_admin'> 
         
        <legend>Datos personales </legend>
     
	  <div class="fieldset_campos">
		<label id='texto_busqueda_inicial'>		Email </label> 
		<input  class="inputtext" type="text"  autocomplete="off" name="form_email"  {disable_input}    id="form_email"  value="{email}" maxlength="255"    >
	</div>
        
        	<div class="fieldset_campos"> 
            
            
            
		<table style="width:99%" id='form_id_tipo_contrato_id_focus'  >
        
        <tr>
        <td style="text-align:left"><strong>Pertenece Universidad de Chile</strong></td><td style="text-align:left"><strong>No pertenece Universidad de Chile</strong></td>
        </tr>
        <tr>
        <td><input  type="radio" name="form_id_tipo_contrato"   value="planta_universidad" {disable_input}  onClick="javascript:mostrarFilaFacultad('universidad');" > Planta Universidad de Chile
        
		
        </td>
        <td><input  type="radio" name="form_id_tipo_contrato"   value="invitado_nacional" {disable_input}  onClick="javascript:mostrarFilaFacultad('otro');" > Invitado Nacional</td>
        </tr>
        <tr>
        <td><input  type="radio" name="form_id_tipo_contrato"   value="contrata_universidad" {disable_input}  onClick="javascript:mostrarFilaFacultad('universidad');" > Contrata Universidad de Chile</td>
		<td><input  type="radio" name="form_id_tipo_contrato"   value="invitado_extranjero" {disable_input}  onClick="javascript:mostrarFilaFacultad('otro');" > Invitado Extranjero</td>
        </tr>
        
        <tr>
        <td><input  type="radio" name="form_id_tipo_contrato"  value="honorario_universidad" {disable_input}   onClick="javascript:mostrarFilaFacultad('universidad');" > Honorarios Universidad de Chile</td>
                <td><input  type="radio" name="form_id_tipo_contrato"   value="sin_vinculo_universidad" {disable_input}  onClick="javascript:mostrarFilaFacultad('otro');" > No tiene v&iacute;nculo contractual con Universidad de Chile </td>
        </tr>   
        <tr>
        <td><input  type="radio" name="form_id_tipo_contrato"  value="contrata_ciae" {disable_input}  onClick="javascript:mostrarFilaFacultad('otro');" > Contrata CIAE</td>
                <td>  </td>
        </tr>
        
        <tr>
        <td><input  type="radio" name="form_id_tipo_contrato"   value="honorario_ciae" {disable_input} onClick="javascript:mostrarFilaFacultad('otro');"  > Honorarios CIAE</td>
                <td> </td>
        </tr>
        <tr id='fila_form_id_tipo_contrato_facultad'>
        <td colspan="2">
        Organisno externo: <!-- INCLUDE BLOCK : www/templates/site/admin/viajes/listado_facultades.tpl -->
        
        </td>
        </tr>
        <script>
		hidetr('fila_form_id_tipo_contrato_facultad');
		function mostrarFilaFacultad(caso)
		{
			hidetr('fila_form_id_tipo_contrato_facultad');
			selectValue('form_id_tipo_contrato_facultad','CIAE');
			if(caso == 'universidad')
				showtr('fila_form_id_tipo_contrato_facultad');	
		}
		checkedValue('form_id_tipo_contrato','{id_tipo_contrato}');

		var tipo_contrata = emptyCheckValue('form_id_tipo_contrato');
		if( '{id_tipo_contrato}' == 'planta_universidad' || '{id_tipo_contrato}' == 'contrata_universidad'  || '{id_tipo_contrato}' == 'honorario_universidad' )
		{			
			mostrarFilaFacultad('universidad'); 
			agregarOpcionSelectId("form_id_tipo_contrato_facultad",'{id_tipo_contrato_facultad}','{id_tipo_contrato_facultad}');			
		}
		</script>
        </table> 
	</div>
	
    
	  <div class="fieldset_campos">
      <table width="100%" border="0">
      <tr><td>
		<label>		Nombre  </label> 
		<input  class="inputtext" type="text"   name="form_nombre"  {disable_input}   title="ingrese nombre persona" id="form_nombre"  value="{nombre}" maxlength="255"   ></td>
        <td>
		<label>		Apellido paterno</label> 
		<input  class="inputtext" type="text"   name="form_apellido_paterno"   {disable_input}  title="Ingrese apellidos" id="form_apellido_paterno"  value="{apellido_paterno}" maxlength="255"   >
	</td>
        <td>
		<label>		Apellido materno</label> 
		<input  class="inputtext" type="text"   name="form_apellido_materno"   {disable_input}  title="Ingrese apellidos" id="form_apellido_materno"  value="{apellido_materno}" maxlength="255"   >
        </td></tr></table>
	</div>
   <!-- START BLOCK : bloque_datos_ficha_honorarios -->
   <div class="fieldset_campos"  id='form_genero_id_focus' >
   <label>		G&eacute;nero </label> 
   <input  type="radio" name="form_genero" id="form_genero" value="M"> Masculino &nbsp;&nbsp;&nbsp;&nbsp;<input  type="radio" name="form_genero"  id="form_genero"value="F"> Femenino
   
	 </div>
   <script>
	if('{genero}' != '')
	{
	   checkedValue('form_genero','{genero}');
	}
	</script>
   
   
	  <div class="fieldset_campos">
   <label>		Fecha de nacimiento </label> 
		<input  class="inputtext" type="text"   name="form_fecha_nacimiento"    {disable_input} title="" id="form_fecha_nacimiento"   maxlength="10" style="width:120px"  value="{fecha_nacimiento_html}"> <A HREF="#" onClick="cal.select(document.main.form_fecha_nacimiento,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
			</div> 
	  <div class="fieldset_campos">
   <label>		Direcci&oacute;n </label> 
		<input  class="inputtext" type="text"   name="form_direccion"      title="" id="form_direccion"   maxlength="255"   value="{form_direccion}">  
			</div>
	  <div class="fieldset_campos">
   <label>		Comuna </label> 
		 <select name="form_comuna_id" id='form_comuna_id'>
		 	
		  </select>
			</div>
			
	  <div class="fieldset_campos">
   <label>		Pa&iacute;s </label> 
		 <select name="form_pais_id" id='form_pais_id'>
		 	
		  </select>
			</div>
	  <div class="fieldset_campos">
   <label>		Tel&eacute;fono </label> 
		<input  class="inputtext" type="text"   name="form_telefono"      title="" id="form_telefono"   maxlength="100"   value="{form_telefono}">  
			</div>
			
			
    <!-- END BLOCK : bloque_datos_ficha_honorarios -->
			
	  <div class="fieldset_campos">
		<label>		Rut  (ingrese imagen escaneada de carnet de identidad) </label> 
		<table style="width:90%" border="0">
        <tr><td ><input  class="inputtext" type="text"   name="form_rut"   {disable_input}  title="" id="form_rut"  value="{rut}" maxlength="8" style="width:100px"   > - <input  class="inputtext" type="text"   {disable_input}  name="form_rut_dv"    title="" id="form_rut_dv"  value="{rut_dv}" maxlength="1" style="width:20px"   >  </td>
         
        
        <input name="archivo_rut_original" type="hidden" id="archivo_rut_original">
			<input type="hidden" name="form_archivo_rut" id="form_archivo_rut"  >
        <!-- START BLOCK : bloque_archivo_rut_file -->
        <td style="text-align:left">
        
            <a    class="open_view"  id='popup_interno_pdf_interno_rut'  data-type="download.php?file=solicitudes_gestion/rut/{archivo}"> 
        <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
        
        <script>document.getElementById('archivo_rut_original').value = "{archivo}";</script>
        </td>
        <!-- END BLOCK : bloque_archivo_rut_file -->
        
        
        <!-- START BLOCK : bloque_archivo_rut_form -->
        <td style="text-align:left; vertical-align: middle">
        
        	   <input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
                <ul id="lista-archivoUnico1" >                </ul>
                <div id="responseArchivoUnico1"></div>          
              
			<input type="hidden" id="ruta_archivo1" value="doc/solicitudes_gestion/rut/" name="ruta_archivo1"/>
			<input type="hidden" id="nombre_campo_archivo1" value="form_archivo_rut" name="nombre_campo_archivo1"/>
        
        </td>
        
        
        <!-- END BLOCK : bloque_archivo_rut_form -->
         </tr></table>
	</div> 
             
	  <div class="fieldset_campos">
		<label>		Pasaporte (ingrese imagen escaneada de pasaporte, solo donde aparece informaci&oacute;n personal)</label> 
		<table style="width:90%">
        <tr><td>
        <input  class="inputtext" type="text"   name="form_pasaporte"   {disable_input}   title="" id="form_pasaporte"  value="{pasaporte}" maxlength="100"  style="width:200px"  ></td> 
        
        <input name="archivo_pasaporte_original" id="archivo_pasaporte_original" type="hidden"   >
			<input type="hidden" name="form_archivo_pasaporte" id="form_archivo_pasaporte" value="">
        <!-- START BLOCK : bloque_archivo_pasaporte_file -->
        <td style="text-align:left">
        
            <a     class="open_view"  id='popup_interno_pdf_interno_pasaporte' data-type="download.php?file=solicitudes_gestion/pasaporte/{archivo}">
				<img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
        <script>document.getElementById('archivo_pasaporte_original').value = "{archivo}";</script>
        </td>
        <!-- END BLOCK : bloque_archivo_pasaporte_file -->
        
          <!-- START BLOCK : bloque_archivo_pasaporte_form -->
          <td style="text-align:left"> 
        
         <input type="file" class="ArchivoUnico" id="Archivo2" name="file[]"/>
                <ul id="lista-archivoUnico2" >                </ul>
                <div id="responseArchivoUnico2"></div>          
             
			<input type="hidden" id="ruta_archivo2" value="doc/solicitudes_gestion/pasaporte/" name="ruta_archivo2"/>
			<input type="hidden" id="nombre_campo_archivo2" value="form_archivo_pasaporte" name="nombre_campo_archivo2"/>
        
        
        
        </td>
        <!-- END BLOCK : bloque_archivo_pasaporte_form -->
        </tr></table>
	</div> 
    
    
	  <div class="fieldset_campos">
		<label>		CV </label> 
        <table style="width:90%">
        <tr> 
        <input name="archivo_cv_original" id="archivo_cv_original" type="hidden"   >
			<input type="hidden" name="form_archivo_cv" id="form_archivo_cv"  >
        <!-- START BLOCK : bloque_archivo_cv_file -->
        <td style="text-align:left">
            <a    class="open_view"  id='popup_interno_pdf_interno_cv'  data-type="download.php?file=solicitudes_gestion/cv/{archivo}"> 
        <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
         
        <script>document.getElementById('archivo_cv_original').value = "{archivo}";</script>
        </td>
        <!-- END BLOCK : bloque_archivo_cv_file -->
        
		   <!-- START BLOCK : bloque_archivo_cv_form -->
           <td style="text-align:left"> 
         <input type="file" class="ArchivoUnico" id="Archivo3" name="file[]"/>
                <ul id="lista-archivoUnico3" >                </ul>
                <div id="responseArchivoUnico3"></div>          
              
			<input type="hidden" id="ruta_archivo3" value="doc/solicitudes_gestion/cv/" name="ruta_archivo3"/>
			<input type="hidden" id="nombre_campo_archivo3" value="form_archivo_cv" name="nombre_campo_archivo3"/>
        
        
        </td>
        <!-- END BLOCK : bloque_archivo_cv_form -->
        </tr></table>
	</div>  
  
  
  
  
	  <div class="fieldset_campos">
		<label>		Cargo interno CIAE</label> 
        
        <select name="form_cargo_gestion"  {disable_input}    title="" id="form_cargo_gestion" >
        <option >Investigador(a) Asociado</option>
        <option>Postdoctodor(a)</option>
        <option>Asistente de investigaci&oacute;n</option>
        <option>Administrativo</option>
        <option value='No aplica'>No aplica</option>
        <option value=""></option>        
        </select>
		 
        <script> 
			agregarOpcionSelectId("form_cargo_gestion",'{cargo_gestion}','{cargo_gestion}');
		</script>
	</div>    
    </fieldset> 
     </div>
     
<script>
	if(document.getElementById("form_comuna_id"))
	{
		var x = document.getElementById("form_comuna_id");
		var c = document.createElement("option");
		c.text = "----"; 
		c.value = '1';
		x.options.add(c, 1); 
		<!-- START BLOCK : listado_comuna --> 
		var c = document.createElement("option");
		c.text = html_entity_decode("{comuna} - {region}"); 
		c.value = '{comuna_id}';
		x.options.add(c, {orden_region}{orden_comuna});
		<!-- END BLOCK : listado_comuna --> 
		selectValue('form_comuna_id','{comuna_id}');
	}
	if(document.getElementById("form_pais_id"))
	{  
		var x = document.getElementById("form_pais_id");		
		<!-- START BLOCK : listado_pais --> 
		var c = document.createElement("option");
		c.text = html_entity_decode("{pais}"); 
		c.value = '{pais_id}';
		x.options.add(c, {fila});
		<!-- END BLOCK : listado_pais --> 
		selectValue('form_pais_id','{pais_id}');
	}
</script>