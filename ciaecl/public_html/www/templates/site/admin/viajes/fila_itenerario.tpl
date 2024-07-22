 
  
    <fieldset id='formulario_admin_{fila}'  > 
    <legend>Datos de tramo {fila}</legend> 
    
	  <div class="fieldset_campos">
		<label>		Objetivo espec&iacute;fico del tramo (Tramo {fila})</label> 
		<textarea class="inputtext" type="text"   name="formviaje_objetivo[{fila}]" {disable_input} id="formviaje_objetivo[{fila}]"  >{objetivo} </textarea> 
	</div>
	  <div class="fieldset_campos">
      <table width="100%" border="0">
      <tr><td>
		<label>		Fecha Inicio (Tramo {fila}) </label> 
		<input  class="inputtext" type="text"   name="formviaje_fecha_inicio_{fila}"  readonly="readonly"  {disable_input} title="" id="formviaje_fecha_inicio[{fila}]"   maxlength="10" style="width:120px"  value="{fecha_inicio}"> <A HREF="#" onClick="cal.select(document.main.formviaje_fecha_inicio_{fila},'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A> 
           
	</td><td> 
	   
		<label>		Fecha T&eacute;rmino (Tramo {fila})</label> 
		<input  class="inputtext" type="text"   name="formviaje_fecha_fin_{fila}" readonly  {disable_input} title="" id="formviaje_fecha_fin[{fila}]"   maxlength="10" style="width:120px"  value="{fecha_fin}">  <A HREF="#" onClick="cal.select(document.main.formviaje_fecha_fin_{fila},'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
        </td></tr></table>
	</div>
    
    <script type="application/javascript">
  $( function() {
    var availableTags_origen_{fila} = [
		<!-- START BLOCK : bloque_autocomplete_destino_origen -->
		html_entity_decode("{destino}"),
		<!-- END BLOCK : bloque_autocomplete_destino_origen -->
        ""
    ]; 
    $( "#formviaje_origen_{fila}" ).autocomplete({
      source: availableTags_origen_{fila}
    });
  } );
  </script>	 
	  <div class="fieldset_campos"> 
		<label>		Origen  (Tramo {fila})  (Indicar ciudad y pa&iacute;s) </label> 
		<input  class="inputtext" type="text"  value="{origen}"  autocomplete="off" id="formviaje_origen_{fila}"  {disable_input} title="" name="formviaje_origen[{fila}]"   maxlength="255"   >
	</div>
  
    <script>
  $( function() {
    var availableTags_destino_{fila} = [
		<!-- START BLOCK : bloque_autocomplete_destino_destino -->
		html_entity_decode("{destino}"),
		<!-- END BLOCK : bloque_autocomplete_destino_destino -->
        ""
    ]; 
    $( "#formviaje_destino_{fila}" ).autocomplete({
      source: availableTags_destino_{fila}
    });
  } );
  </script>	 
	  <div class="fieldset_campos">
		<label>		Destino  (Tramo {fila}) (Indicar ciudad y pa&iacute;s) </label>  
		<input  class="inputtext" type="text" value="{destino}"   autocomplete="off" name="formviaje_destino[{fila}]"  {disable_input} title="" id="formviaje_destino_{fila}"    maxlength="255"   >
	</div>
    
    
    
	  <div class="fieldset_campos">
		<label>		Solicita Vi&aacute;tico? (indicar qui&eacute;n paga)  (Tramo {fila})</label> 
		 <table style="width:99%" border="0">
                  <tr  id='formviaje_viatico_si[{fila}]_id_focus'> 
         <td><input type="radio"  {disable_input}  id="formviaje_viatico_si[{fila}]"  name="formviaje_viatico_si[{fila}]" onClick="javascript:calculoViaticoDias('{fila}')" value="si"> Si</td>    
              <td><input type="radio"  {disable_input}  id="formviaje_viatico_si[{fila}]"  name="formviaje_viatico_si[{fila}]" value="no"  onClick="javascript:hidetr('formviaje_viatico_si_paga_{fila}-1')"> No</td>
         </tr> 
         
         <tr id='formviaje_viatico_si_paga_{fila}-1'> 
         
         <td colspan="2" ><span id="formviaje_viatico_si_paga[{fila}]_id_focus"><strong>Centro de costo responsable pago:</strong></span>
         <br>
         <select name="formviaje_viatico_si_paga[{fila}]" {disable_input} id="formviaje_viatico_si_paga[{fila}]">
         <option value=""></option>
         <!-- START BLOCK : bloque_proyectos_paga_viatico -->
         <option value="{id_centro_costo}">{codigo} - {centro_costo} ({nombre} {apellido_paterno})</option>
         <!-- END BLOCK : bloque_proyectos_paga_viatico -->          
         </select>
         
          <br><br>
          <strong>Indicar si el viatico ser&aacute; completo o especificar cantidad noches de estad&iacute;a </strong>
          
          <br> 
          Cantidad de noches de estad&iacute;a: <input name="formviaje_viatico_dias[{fila}]" value="" id="formviaje_viatico_dias[{fila}]" >
          
         </td>
         </tr>
        <script>
		checkedValue('formviaje_viatico_si[{fila}]','{viatico_si}');
		selectValue('formviaje_viatico_si_paga[{fila}]','{viatico_si_paga}'); </script>
         </table>
	</div>
    <script>
	hidetr('formviaje_viatico_si_paga_{fila}-1');
	</script>
    
	  <div class="fieldset_campos">
		<label > 	Solicita Pago de Pasajes?  (Tramo {fila})</label> 
		 <table style="width:99%">
                  <tr id='formviaje_pasajes_si[{fila}]_id_focus'> 
         <td><input type="radio"  {disable_input}  name="formviaje_pasajes_si[{fila}]"  id="formviaje_pasajes_si[{fila}]" onClick="javascript:showtr('formviaje_pasajes_si_paga_{fila}-1')" value="si"> Si</td>         <td><input type="radio"  id="formviaje_pasajes_si[{fila}]"  {disable_input}  name="formviaje_pasajes_si[{fila}]"  onClick="javascript:hidetr('formviaje_pasajes_si_paga_{fila}-1')" value="no"> No</td>
         </tr>
         <tr id='formviaje_pasajes_si_paga_{fila}-1'> 
         <td  colspan="2">
         
          <span id="formviaje_pasajes_si_paga[{fila}]_id_focus"><strong>Centro de costo responsable pago:</strong></span><br>
         <select name="formviaje_pasajes_si_paga[{fila}]" {disable_input} id="formviaje_pasajes_si_paga[{fila}]">
         <option value=""></option>
         <!-- START BLOCK : bloque_proyectos_paga_pasajes -->
         <option value="{id_centro_costo}">{codigo} - {centro_costo} ({nombre} {apellido_paterno})</option>
         <!-- END BLOCK : bloque_proyectos_paga_pasajes -->       
         </select> 
         
         </td>
         </tr>
         </table>
        <script> 
		
		selectValue('formviaje_pasajes_si_paga[{fila}]','{pasajes_si_paga}');
		checkedValue('formviaje_pasajes_si[{fila}]','{pasajes_si}');
        </script>
	</div>
    <script>
	hidetr('formviaje_pasajes_si_paga_{fila}-1');
	</script>
    	  <div class="fieldset_campos">
		<label>	 Solicita reembolso de pago de inscripci&oacute;n a evento? (Tramo {fila})</label> 
		 <table style="width:99%" id="formviaje_inscripcion_si[{fila}]_id_focus" border="0">
                  <tr> 
         <td><input type="radio"  {disable_input}  name="formviaje_inscripcion_si[{fila}]" id="formviaje_inscripcion_si[{fila}]" onClick="javascript:showtr('inscripcion_si_paga_{fila}-1')" value="si"> Si</td>         
         <td><input type="radio"  id="formviaje_inscripcion_si[{fila}]" {disable_input}  name="formviaje_inscripcion_si[{fila}]"  onClick="javascript:hidetr('inscripcion_si_paga_{fila}-1')"   value="no" > No</td>
         </tr>
          <tr id='inscripcion_si_paga_{fila}-1'> 
          
          <td  colspan="2">
			  
 
          <span  ><strong>Centro de costo responsable pago:</strong></span><br>
          <select name="formviaje_reembolsos_si_paga[{fila}]" {disable_input} id="formviaje_reembolsos_si_paga[{fila}]">
         <option value=""></option>
         <!-- START BLOCK : bloque_proyectos_paga_reembolsos -->
         <option value="{id_centro_costo}">{codigo} - {centro_costo} ({nombre} {apellido_paterno})</option>
         <!-- END BLOCK : bloque_proyectos_paga_reembolsos -->    
         </select>
          <br><br>
          <p> Recuerde que para ejecutar el pago de reembolso, deber&aacute; presentar la factura (invoice) y el comprobante de pago del estado de cuenta de su tarjeta bancaria en caso que lo haya pagado mediante esa modalidad. La Universidad reembolsa s&oacute;lo documentos originales. </p></p> 
          <!--<input  class="inputtext"  type="file"  name="archivo_reembolsos_{fila}"  {disable_input} title="" id="archivo_reembolsos_{fila}"    >-->
          
          <input type="file" class="ArchivoUnico" id="Archivo4{fila}" name="file[]"/>
                <ul id="lista-archivoUnico4{fila}" >                </ul>
                <div id="responseArchivoUnico4{fila}"></div>          
              
			<input type="hidden" name="formviaje_archivo_reembolsos_{fila}" id="formviaje_archivo_reembolsos_{fila}"  >
			<input type="hidden" id="ruta_archivo4{fila}" value="doc/solicitudes_gestion/reembolsos/" name="ruta_archivo4{fila}"/>
			<input type="hidden" id="nombre_campo_archivo4{fila}" value="formviaje_archivo_reembolsos_{fila}" name="nombre_campo_archivo4{fila}"/>
        <div id='formulario_reembolsos_archivo_{fila}'>
			 </div>
          
          </td></tr> 
         </table>
	</div>
    <script>
	hidetr('inscripcion_si_paga_{fila}-1');
	</script>
    <div class="fieldset_campos" id='formulario_invitacion_archivo_{fila}'>
		<label>		Carta de invitaci&oacute;n  (Tramo {fila}) </label>  <br><br>
        (en caso de que no tenga carta, adjuntar email de confirmaci&oacute;n de invitaci&oacute;n)<br><br>
		<!--<input  class="inputtext"  type="file"  name="archivo_invitaciones_{fila}"  {disable_input}  id="archivo_invitaciones_{fila}"    >-->
		
		<input type="file" class="ArchivoUnico" id="Archivo5{fila}" name="file[]"/>
                <ul id="lista-archivoUnico5{fila}" >                </ul>
                <div id="responseArchivoUnico5{fila}"></div>          
              
			<input type="hidden" name="formviaje_archivo_invitaciones_{fila}" id="formviaje_archivo_invitaciones_{fila}"  >
			<input type="hidden" id="ruta_archivo5{fila}" value="doc/solicitudes_gestion/invitaciones/" name="ruta_archivo5{fila}"/>
			<input type="hidden" id="nombre_campo_archivo5{fila}" value="formviaje_archivo_invitaciones_{fila}" name="nombre_campo_archivo5{fila}"/>
		             
		
	</div>

    
    
        	  <div class="fieldset_campos" id='formviaje_motivo_viaje[{fila}]_id_focus'>
		<label>		Motivo de viaje (Tramo {fila})</label> 
		 <input name="formviaje_motivo_viaje[{fila}]" id="formviaje_motivo_viaje[{fila}]" type="radio"  {disable_input} value="Participacion en evento"> Participaci&oacute;n en evento<br>
         <input name="formviaje_motivo_viaje[{fila}]" id="formviaje_motivo_viaje[{fila}]" type="radio"  {disable_input} value=" Organizacion de evento"> Organizaci&oacute;n de evento<br>

		 <input name="formviaje_motivo_viaje[{fila}]" id="formviaje_motivo_viaje[{fila}]" type="radio"  {disable_input} value=" Actividad de difusion"> Actividad de difusi&oacute;n<br>
         <input name="formviaje_motivo_viaje[{fila}]" id="formviaje_motivo_viaje[{fila}]" type="radio"  {disable_input} value="Seminarios"> Seminarios<br> 
         <input name="formviaje_motivo_viaje[{fila}]" id="formviaje_motivo_viaje[{fila}]" type="radio"  {disable_input} value="Estadia de investigacion"> Estad&iacute;a de investigaci&oacute;n<br>                 
		 <input name="formviaje_motivo_viaje[{fila}]" id="formviaje_motivo_viaje[{fila}]" type="radio"  {disable_input}  value="Participacion en proyectos R&D dirigidos por otros grupos de investigacion"> Participaci&oacute;n en proyectos R&D dirigidos por otros grupos de investigaci&oacute;n<br>           
		 <input name="formviaje_motivo_viaje[{fila}]" id="formviaje_motivo_viaje[{fila}]" type="radio"  {disable_input} value="Colaboracion en el extranjero "> Colaboraci&oacute;n en el extranjero   <br>
         <input  class="inputtext" type="text"   name="formviaje_motivo_viaje_institucion[{fila}]"  {disable_input}   id="formviaje_motivo_viaje_institucion[{fila}]"    maxlength="255"   > <br> 
		 <input name="formviaje_motivo_viaje[{fila}]" {disable_input} id="formviaje_motivo_viaje[{fila}]" type="radio" value="Otros"> Otros (especificar) <br>
         <input  class="inputtext" type="text"   name="formviaje_motivo_viaje_otro[{fila}]"  {disable_input} title="" id="formviaje_motivo_viaje_otro[{fila}]"    maxlength="255"  > <br> 
	</div>
    
        <script>checkedValue('formviaje_motivo_viaje_otro[{fila}]','{motivo_viaje_otro}');</script>
    
        	  <div class="fieldset_campos" id="formviaje_tipo_actividad[{fila}]_id_focus">
		<label>		Tipo de actividad (Tramo {fila})</label> 
		 <input name="formviaje_tipo_actividad[{fila}]" id=" 	[{fila}]" type="radio"  {disable_input} value="Congreso internacional"> Congreso internacional<br>
         <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Congreso nacional"> Congreso nacional<br>
		 <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Taller"> Taller<br>
         <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Foro"> Foro<br>     
         <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Workshop"> Workshop<br>                
		 <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Competencia"> Competencia<br>                  
		 <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Exhibicion "> Exhibici&oacute;n  <br>           
		 <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Curso"> Curso  <br>             
		 <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Conferencia"> Conferencia  <br>             
		 <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Premiacion"> Premiaci&oacute;n <br>
		 <input name="formviaje_tipo_actividad[{fila}]" id="formviaje_tipo_actividad[{fila}]" type="radio"  {disable_input} value="Pasantia"> Pasant&iacute;a <br>
         
		 <input name="formviaje_tipo_actividad[{fila}]" {disable_input}  id="formviaje_tipo_actividad[{fila}]" type="radio" value="Otros"> Otros (especificar) <br>
         <input  class="inputtext" type="text"   name="formviaje_motivo_actividad_otro[{fila}]"  {disable_input} title="" id="formviaje_motivo_actividad_otro[{fila}]"    maxlength="255"   > <br> 
		   
        <script>checkedValue('formviaje_tipo_actividad[{fila}]','{tipo_actividad}');</script>
	</div>
        	  <div class="fieldset_campos" id="formviaje_publico_objetivo[{fila}][]_id_focus">
		<label>		P&uacute;blico objetivo del evento (Tramo {fila})</label> 
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]"  type="checkbox" {disable_input}  value="Investigadores"> Investigadores<br>
         <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Estudiantes postgrado"> Estudiantes Postgrado<br>
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Estudiantes pregrado"> Estudiantes Pregrado<br>
         <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Foro"> Foro<br>                 
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Graduados / licenciados"> Graduados / Licenciados<br>                  
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Estudiantes educacion basica"> Estudiantes educaci&oacute;n b&aacute;sica <br>             
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Estudiantes eduacion media"> Estudiantes educaci&oacute;n media <br>             
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Comunidad general"> Comunidad General  <br>             
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Compa&ntilde;ias industrias servicios"> Compa&ntilde;ias, industrias, servicios <br> 
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Profesores de colegios"> Profesores de colegio<br> 
		 <input name="formviaje_publico_objetivo[{fila}][]" id="formviaje_publico_objetivo[{fila}][]" type="checkbox" {disable_input} value="Gobierno"> Gobierno<br> 
	</div>

        <script>checkedValue('formviaje_tipo_actividad[{fila}]','{tipo_actividad}');</script>
	<!-- START BLOCK : bloque_fila_itinerario_nuevo -->    
    <div>
		<a onClick="javascript:abrirNuevoItinerario('{fila_siguiente}')"><strong><big>Haga click aqu&iacute; si su viaje tiene m&aacute;s de un destino</big></strong></a> 
     
     
          <!--<a onClick="javascript:obtenerFormularioItinerario('{fila_siguiente}','id_formulario_{fila}')">(+) Nuevo Tramosv</a>-->
     
    </div>
	<!-- END BLOCK : bloque_fila_itinerario_nuevo -->   
    </fieldset>
    <script>hiddenId('formulario_admin_{fila}');</script>
    <input type="hidden" name="formviaje_orden[{fila}]"  value="{fila}">
    <!--<div id='id_formulario_{fila}'>
    <div id='id_formulario_{fila}_interno'></div>
    </div>-->
     