<input type="hidden" name="id_solicitud" value="">
 <div style="padding-left:20px; padding-right:20px">
	{tag_volver}
<div class="fieldset_title">Solicitud de viaticos y viajes </div>
	
{mensaje_guardar}
 <div class="fieldset_campos">
<strong>  <big>  Los datos a ingresar a continuaci&oacute;n deben ser los datos de la persona que viajar&aacute;</big></strong>
    </div>
		<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/form_ficha_detalle.tpl -->
    
    
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 


<input type="hidden" name="time_ingreso" value="{time_ingreso}" />
<input type="hidden" name="usuario" value="{usuario}" />
 

<script type="text/javascript">
document.main.id_item.value = '{id_item}';
function editElement()
{     	 
	
 	<!-- INCLUDE BLOCK : www/templates/site/admin/viajes/ficha_persona_honorario_validacion.tpl -->
	for(var i= 1; i <= document.main.itenerario_activo.value;i++)
	{	
		if(!validacionCampoCheckedSimple('formviaje_pasajes_si['+i+']'))
		{  
			return false;
		}
		else
		{			 
			if(emptyCheckValue('formviaje_pasajes_si['+i+']') == 'si')
			{
				if(!validacionCampoTextoSimple('formviaje_pasajes_si_paga['+i+']'))
				{  
					return false;
				}
			}
		}	
		
		if(!validacionCampoCheckedSimple('formviaje_inscripcion_si['+i+']'))
		{  
			return false;
		}
		else
		{
			if(emptyCheckValue('formviaje_inscripcion_si['+i+']') == 'si')
			{ 
				if(!validacionCampoTextoSimple('archivo_reembolsos_'+i+''))
				{
					return false;
				}		
				if(!validacionCampoTextoSimple('formviaje_reembolsos_si_paga['+i+']'))
				{
					return false;
				}	
			} 
		}
		
		if(!validacionCampoCheckedSimple('formviaje_viatico_si['+i+']'))
		{  
			return false;
		}
		else
		{			 
			if(emptyCheckValue('formviaje_viatico_si['+i+']') == 'si')
			{
				if(!validacionCampoTextoSimple('formviaje_viatico_si_paga['+i+']'))
				{  
					return false;
				}
			}
		}	
		if(!validacionCampoTextoSimple('formviaje_objetivo['+i+']'))
		{
			return false;
		}	
		if(!validacionCampoTextoSimple('formviaje_fecha_inicio_'+i+''))
		{
			return false;
		}	
		if(!validacionCampoTextoSimple('formviaje_fecha_fin_'+i+''))
		{
			return false;
		}	
		if(!validacionCampoTextoSimple('formviaje_origen_'+i+''))
		{
			return false;
		}	
		if(!validacionCampoTextoSimple('formviaje_destino_'+i+''))
		{
			return false;
		}	
		if(!validacionCampoCheckedSimple('formviaje_publico_objetivo['+i+'][]'))
		{  		 
			return false;
		}			
		if(!validacionCampoCheckedSimple('formviaje_motivo_viaje['+i+']'))
		{  
			sacarMuestraErrorCampo('formviaje_motivo_viaje_institucion['+i+']');
			sacarMuestraErrorCampo('formviaje_motivo_viaje_otro['+i+']');
			return false;
		}		
		else
		{
			if(emptyCheckValue('formviaje_motivo_viaje['+i+']') == 'colaboracion_extranjero')	
			{			
				if(!validacionCampoTextoSimple('formviaje_motivo_viaje_institucion['+i+']'))
				{  
					return false;
				}	
			}
			if(emptyCheckValue('formviaje_motivo_viaje['+i+']') == 'otros')	
			{			
				if(!validacionCampoTextoSimple('formviaje_motivo_viaje_otro['+i+']'))
				{  
					return false;
				}	
			} 
		}
		if(!validacionCampoCheckedSimple('formviaje_tipo_actividad['+i+']'))
		{  		
			sacarMuestraErrorCampo('formviaje_motivo_actividad_otro['+i+']');
			return false;
		}		
		else
		{		
			if(emptyCheckValue('formviaje_tipo_actividad['+i+']') == 'otros')	
			{			
				if(!validacionCampoTextoSimple('formviaje_motivo_actividad_otro['+i+']'))
				{  
					return false;
				}	
			}	
		}

		if(!validacionCampoTextoSimple('archivo_invitaciones_'+i+''))
		{  
			return false;
		}		
	} 	
	if(confirm('Esta seguro de enviar formulario?'))
	{
		process('{opcion_modulo}|guardar',0);	 
	} 
}

function consultarEmail()
{
	process('{opcion_modulo}|consultar_email',0);
	
}
	
	<!-- START BLOCK : bloque_edicion_solicitud_devolucion_simple -->
		setValue('formviajeglobal_observacion','{observacion}');
		 
	<!-- END BLOCK : bloque_edicion_solicitud_devolucion_simple --> 
		
	<!-- START BLOCK : bloque_edicion_solicitud_devolucion -->  
		abrirNuevoItinerario('{aux_i}');
	
		setValue('id_item','{id_solicitud}');
		setValue('formviaje_id_solicitud[{aux_i}]','{id_solicitud}');
		setValue('formviaje_orden[{aux_i}]','{orden}');
		setValue('formviaje_objetivo[{aux_i}]','{objetivo}');
		setValue('formviaje_fecha_inicio[{aux_i}]','{fecha_inicio}');
		setValue('formviaje_fecha_fin[{aux_i}]','{fecha_fin}');
		setValue('formviaje_origen[{aux_i}]','{origen}');
		setValue('formviaje_destino[{aux_i}]','{destino}');
		setValue('formviaje_motivo_viaje_institucion[{aux_i}]','{motivo_viaje_institucion}');
		setValue('formviaje_motivo_viaje_otro[{aux_i}]','{motivo_viaje_otro}');
		setValue('formviaje_motivo_actividad_otro[{aux_i}]','{motivo_actividad_otro}'); 
	
		checkedValue('formviaje_viatico_si[{aux_i}]','no');
		if('{viatico_si}' == 'si')
		{
			calculoViaticoDias('{aux_i}');
			checkedValue('formviaje_viatico_si[{aux_i}]','si');
			selectValue('formviaje_viatico_si_paga[{aux_i}]','{viatico_si_paga}');
			setValue('formviaje_viatico_dias[{aux_i}]','{viatico_dias}');
			if('{viatico_si_paga}' == 'CIAE' || '{viatico_si_paga}' == '0')
			{						
				selectValue('formviaje_viatico_si_paga[{aux_i}]','110316024201256');
			}
		}
	
		checkedValue('formviaje_pasajes_si[{aux_i}]','no');
		if('{pasajes_si}' == 'si')
		{ 
			checkedValue('formviaje_pasajes_si[{aux_i}]','si');
			showtr('formviaje_pasajes_si_paga_{aux_i}-1');
			selectValue('formviaje_pasajes_si_paga[{aux_i}]','{pasajes_si_paga}'); 
			if('{pasajes_si_paga}' == 'CIAE' || '{pasajes_si_paga}' == '0')
			{						
				selectValue('formviaje_pasajes_si_paga[{aux_i}]','110316024201256');
			}
		}	

		checkedValue('formviaje_inscripcion_si[{aux_i}]','no');
		if('{inscripcion_si}' == 'si')
		{ 
			checkedValue('formviaje_inscripcion_si[{aux_i}]','si');
			showtr('inscripcion_si_paga_{aux_i}-1');
			selectValue('formviaje_reembolsos_si_paga[{aux_i}]','{reembolsos_si_paga}'); 
			if('{reembolsos_si_paga}' == 'CIAE' || '{reembolsos_si_paga}' == '0')
			{						
				selectValue('formviaje_reembolsos_si_paga[{aux_i}]','110316024201256');
			}
		}	
	
	 
		checkedValue('formviaje_tipo_actividad[{aux_i}]','{tipo_actividad}');
		checkedValue('formviaje_motivo_viaje[{aux_i}]','{motivo_viaje}');
		setValue('formviaje_archivo_reembolsos_{aux_i}','{archivo_reembolsos}');
		setValue('formviaje_archivo_invitaciones_{aux_i}','{archivo_invitaciones}'); 
	
		if('{archivo_invitaciones}' != '')
		{
			document.getElementById('formulario_invitacion_archivo_{aux_i}').innerHTML	= document.getElementById('formulario_invitacion_archivo_{aux_i}').innerHTML+ '<a    class="open_view"  id="popup_interno_pdf_interno_invitaciones" data-type="download.php?file=doc/solicitudes_gestion/invitaciones/{archivo_invitaciones}">      <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>';
		}

		if('{archivo_reembolsos}' != '')
		{
			document.getElementById('formulario_reembolsos_archivo_{aux_i}').innerHTML	= document.getElementById('formulario_reembolsos_archivo_{aux_i}').innerHTML+ '<a    class="open_view" id="popup_interno_pdf_interno_reembolsos"  data-type="download.php?file=doc/solicitudes_gestion/reembolsos/{archivo_reembolsos}">      <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>';
		}
	
	
	
		<!-- START BLOCK : bloque_edicion_solicitud_devolucion_objetivo -->
		checkedValue('formviaje_publico_objetivo[{aux_i}][]','{publico_objetivo_texto}');
		<!-- END BLOCK : bloque_edicion_solicitud_devolucion_objetivo -->
			 
	<!-- END BLOCK : bloque_edicion_solicitud_devolucion -->
</script>
{tag_volver}
</div>