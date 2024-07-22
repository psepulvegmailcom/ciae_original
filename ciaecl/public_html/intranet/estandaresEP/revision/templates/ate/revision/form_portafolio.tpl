<!-- START BLOCK : bloque_ate_area_fila_oferta -->
	 <fieldset>
	<div class="fieldset_title_interno">Datos Postulación</div> 
 <br />	
					 
				
				<button type="button" onclick="javascript:verFormularioPopup('portafolio_oferta_lista{especial_rut}');"  ><span>Ver Listado de Ofertas</span></button><br /><br />
				
				
	<!-- *******************FORMULARIO REVISION******************* -->
	 <div>
	
	<div class="fieldset_title_interno">Revisión Datos Postulación</div>
	<input type="hidden" name="variablerevision_revision_info_responsable" value="{revision_info_responsable}" />
	 <div style="float:left; width:320px;  ">
	 <span class="span_modificacion" >Comentario Interno Revisi&oacute;n </span>
       <br />
          <textarea   class="textarea_revision"></textarea>
	 </div>
	 
	  <div style="float: right; width:320px;  ">
	 	<span class="span_modificacion" >Mensaje Postulante </span>
       <br />
          <textarea   class="textarea_revision"></textarea>
	 </div>
	 <div style="text-align:center">
		  <button type="button"  ><span>Aceptar Revisión</span></button>
		  <button type="button"  ><span>Rechazar Revisión </span></button>  
	 </div>
		
	 </div>	 
	 <!-- *******************FORMULARIO REVISION******************* --></fieldset>
				 <!-- END BLOCK : bloque_ate_area_fila_oferta -->
				 
				 <fieldset>
	<div class="fieldset_title_interno">Datos Postulación</div> 
				 	<br /><button type="button" onclick="javascript:verFormularioPopup{openespecial}('portafolio_lista{especial_rut}');"  ><span>Ver Listado de Experiencias</span></button></center>   <br /><br /> 	
				

	<!-- *******************FORMULARIO REVISION******************* -->
	 <div>
	
	<div class="fieldset_title_interno">Revisión Datos Postulación</div>
	<input type="hidden" name="variablerevision_revision_info_responsable" value="{revision_info_responsable}" />
	 <div style="float:left; width:320px;  ">
	 <span class="span_modificacion" >Comentario Interno Revisi&oacute;n </span>
       <br />
          <textarea   class="textarea_revision"></textarea>
	 </div>
	 
	  <div style="float: right; width:320px;  ">
	 	<span class="span_modificacion" >Mensaje Postulante </span>
       <br />
          <textarea   class="textarea_revision"></textarea>
	 </div>
	 <div style="text-align:center">
		  <button type="button"  ><span>Aceptar Revisión</span></button>
		  <button type="button"  ><span>Rechazar Revisión </span></button>  
	 </div>
		
	 </div>	 
	 <!-- *******************FORMULARIO REVISION******************* -->
				
						</fieldset>

 <script>
	function verFormularioPopupEspecial(opcion,rut)
	{  
		var	nombre = 'ventana_extra_lista_portafolio_recurso_ficha';
		var	url ='indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option='+opcion+'&rut='+rut ;
		  var nuevo_ventana = window.open(url,nombre,optionOpenW);
	}
	
	function verFormularioPopup(opcion,nombre)
	{
		if(nombre == '')
			nombre = 'ventana_extra'; 
		  var nuevo_ventana = window.open('indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option='+opcion,nombre,optionOpenW);
	}
</script>