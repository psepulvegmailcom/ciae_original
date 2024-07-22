showId('bloque_revision_informacion');
document.getElementById('bloque_revision_informacion').style.height 		= '150px';
 document.main.restriccionBloqueo.value = '|'; 
 var caso_formulario = '{caso_formulario}';
 if(caso_formulario == '')
 {
 	caso_formulario = 1;
 }
 if(document.main.casoFormularioBloqueo.value != '')
 {
 	caso_formulario = document.main.casoFormularioBloqueo.value;
 } 
 var caso_tipo_oferente = '{caso_tipo_oferente}';
 
		 
 function desbloqueAreaOferentes()
 {
 	var excluyentes = 'ate_oferta_programa[]|ate_oferta_programa_7|ate_oferta_programa_16|ate_oferta_programa_8|ate_oferta_programa_15|ate_oferta_programa[]|te_oferta_programa_16|ate_oferta_programa_17|ate_oferta_programa_1|ate_oferta_programa_2|ate_oferta_programa_9|ate_oferta_programa_3|ate_oferta_programa_4|ate_oferta_programa_11|ate_oferta_programa_5|ate_oferta_programa_6|ate_oferta_programa_13|';
	return excluyentes;
 }

/*************************** BLOQUES DE EMPRESAS ***************************/

	if(caso_formulario == 2 && caso_tipo_oferente == 'empresa')
	{
<!-- START BLOCK : bloque_bloqueo_revision_documento_empresa_vigencia --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_empresa_vigencia|';
<!-- END BLOCK : bloque_bloqueo_revision_documento_empresa_vigencia -->
<!-- START BLOCK : bloque_bloqueo_revision_documento_empresa_socio -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_empresa_socio|';   
<!-- END BLOCK : bloque_bloqueo_revision_documento_empresa_socio -->
<!-- START BLOCK : bloque_bloqueo_revision_documento_empresa_cbrs -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_empresa_cbrs|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_empresa_cbrs -->
<!-- START BLOCK : bloque_bloqueo_revision_documento_empresa_copia_arriendo -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_empresa_copia_arriendo|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_empresa_copia_arriendo -->
	} 

<!-- START BLOCK : bloque_bloqueo_revision_documento_financiera_dicom --> 
	if(caso_formulario == 3 && caso_tipo_oferente == 'empresa')
	{
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_financiero_archivo_financiera_dicom|';
	}    
<!-- END BLOCK : bloque_bloqueo_revision_documento_financiera_dicom --> 

/*************************** BLOQUES DE PERSONA NATURAL ***************************/ 

<!-- START BLOCK : bloque_bloqueo_revision_persona_natural --> 
	if(caso_tipo_oferente == 'persona')
	{
		if(caso_formulario == 1)
		{
			document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_persona_rut|ate_persona_dv|ate_persona_nombre|ate_persona_apellido_paterno|ate_persona_apellido_materno|ate_persona_direccion|ate_persona_email|ate_nopersona_region_id|ate_persona_comuna_id|ate_persona_telefono_codigo|ate_persona_telefono|ate_persona_celular_codigo|ate_persona_celular|ate_persona_url|';
		}
		if(caso_formulario == 4)
		{
			document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_persona_titulo_nombre|ate_persona_archivo_titulo|ate_persona_titulo_institucion|ate_persona_postitulo_nombre|ate_persona_archivo_postitulo|ate_persona_postitulo_institucion|ate_persona_postitulo2_nombre|ate_persona_archivo_postitulo2|ate_persona_postitulo2_institucion|';
		}
	}
	else
	{	
		if(caso_formulario == 'capital' && document.main.ate_persona_rut.value == '{id_extra}')
		{ 			 
			document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_persona_nombre_nueva|ate_persona_apellido_paterno_nueva|ate_persona_apellido_materno_nueva|ate_persona_titulo_nombre|ate_persona_archivo_titulo|ate_persona_titulo_institucion|ate_persona_postitulo_nombre|ate_persona_archivo_postitulo|ate_persona_postitulo_institucion|ate_persona_otro_registro|ate_persona_otro_registros[]|ate_persona_otro_registros_otro|';
		}
	}
<!-- END BLOCK : bloque_bloqueo_revision_persona_natural -->
 
<!-- START BLOCK : bloque_bloqueo_revision_registros_persona_natural -->
	if(caso_formulario == 1 && caso_tipo_oferente == 'persona')
	{
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_persona_registro[]|ate_persona_noregistro|';
	}
<!-- END BLOCK : bloque_bloqueo_revision_registros_persona_natural --> 

	if(caso_formulario == 2 && caso_tipo_oferente == 'persona')
	{
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion|';
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion -->
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion_2 -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion_2|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion_2 --> 
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion_3 -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion_3|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion_3 --> 
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion_4 -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion_4|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_carta_recomendacion_4 --> 
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion --> 
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion_2 -->   
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion_2|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion_2 --> 
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion_3 -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion_3|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion_3 --> 
<!-- START BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion_4 -->   
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_persona_acreditacion_4|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documento_persona_natural_persona_acreditacion_4 --> 
	}    
	
<!-- START BLOCK : bloque_bloqueo_revision_horas_persona_natural -->
	if(caso_formulario == 4 && caso_tipo_oferente == 'persona')
	{
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_persona_horas|';
	}    
<!-- END BLOCK : bloque_bloqueo_revision_horas_persona_natural --> 

	if(caso_formulario == 1 && caso_tipo_oferente != 'persona')
	{
<!-- START BLOCK : bloque_bloqueo_revision_informacion_general -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_institucion_rut|ate_institucion_dv|ate_institucion_razon_social|ate_institucion_nombre_fantasia|ate_institucion_agno_fundacion|ate_institucion_giro|ate_institucion_representante|ate_institucion_representante_apellido_paterno|ate_institucion_representante_apellido_materno|ate_institucion_direccion|ate_noinstitucion_region_id|ate_institucion_comuna_id|ate_institucion_telefono_codigo|ate_institucion_telefono|ate_institucion_email|ate_institucion_url|';
<!-- END BLOCK : bloque_bloqueo_revision_informacion_general -->
<!-- START BLOCK : bloque_bloqueo_ate_revision_info_responsable -->   
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_responsable_nombre|ate_responsable_apellido_paterno|ate_responsable_apellido_materno|ate_responsable_direccion|ate_responsable_telefono_codigo|ate_responsable_telefono|ate_responsable_celular_codigo|ate_responsable_celular|ate_responsable_email|ate_responsable_cargo|'; 
<!-- END BLOCK : bloque_bloqueo_ate_revision_info_responsable --> 
	}    
<!-- START BLOCK : bloque_bloqueo_revision_registros_externos --> 
	if(caso_formulario == 2 && caso_tipo_oferente != 'persona')
	{
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_otro_registro|ate_legal_otro_registros[]|ate_legal_otro_registros_otro|';
	}       
<!-- END BLOCK : bloque_bloqueo_revision_registros_externos -->

/*************************** BLOQUES DE UNIVERSIDADES ***************************/
	if(caso_formulario == 2 && caso_tipo_oferente == 'universidad')
	{
<!-- START BLOCK : bloque_bloqueo_revision_documentos_universidad_estatutos --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_universidad_estatutos|';
<!-- END BLOCK : bloque_bloqueo_revision_documentos_universidad_estatutos -->
<!-- START BLOCK : bloque_bloqueo_revision_documentos_universidad_acreditacion --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_universidad_acreditacion|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documentos_universidad_acreditacion -->
<!-- START BLOCK : bloque_bloqueo_revision_documentos_universidad_patrocinio -->   
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_universidad_patrocinio|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documentos_universidad_patrocinio -->
<!-- START BLOCK : bloque_bloqueo_revision_documentos_universidad_reconocimiento -->  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_universidad_reconocimiento|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documentos_universidad_reconocimiento -->
<!-- START BLOCK : bloque_bloqueo_revision_documentos_universidad_acreditacion_privada --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_universidad_acreditacion_privada|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documentos_universidad_acreditacion_privada --> 
<!-- START BLOCK : bloque_bloqueo_revision_documentos_universidad_patrocinio_privada  --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_legal_archivo_universidad_patrocinio_privada|'; 
<!-- END BLOCK : bloque_bloqueo_revision_documentos_universidad_patrocinio_privada  -->
	}      


/*************************** BLOQUES DE REVISIONES COMUNES ***************************/

	if((caso_formulario == 5 && caso_tipo_oferente == 'persona' ) || (caso_formulario == 4 && caso_tipo_oferente != 'persona' ))
	{
<!-- START BLOCK : bloque_bloqueo_revision_portafolio_experiencia_simple -->
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + desbloqueAreaOferentes();
<!-- END BLOCK : bloque_bloqueo_revision_portafolio_experiencia_simple -->
<!-- START BLOCK : bloque_bloqueo_revision_portafolio_ofertas_simple --> 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + desbloqueAreaOferentes(); 
<!-- END BLOCK : bloque_bloqueo_revision_portafolio_ofertas_simple -->
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_descripcion -->  	 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_oferta_descripcion|';	   
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_descripcion --> 
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_niveles -->    
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_oferta_nivel[]|otro_nivel_oferta|sel_ate_oferta_nivel|';	  
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_niveles --> 
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_zonageografica -->    	  
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_oferta_zona[]|sel_ate_oferta_zona|';	  
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_zonageografica --> 
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_beneficiarios -->   	 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_oferta_personas[]|sel_ate_oferta_personas|';
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_beneficiarios --> 
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_tiposervicio -->
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_oferta_servicio[]|sel_ate_oferta_servicio|';	  
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_tiposervicio --> 
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_metodologia -->     
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_oferta_metodologia[]|sel_ate_oferta_metodologia|otra_metodologia_oferta|';	 
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_metodologia --> 
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_areas -->	 
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + desbloqueAreaOferentes();	  
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_areas -->  
	} 

<!-- START BLOCK : bloque_bloqueo_revision_documentos_obligaciones_laborales -->
	if(caso_formulario == 2)
	{
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'doc_obligaciones_laborales|ate_legal_archivo_certificado_obligaciones_laborales|ate_legal_archivo_declaracion_obligaciones_laborales|';
	}  
<!-- END BLOCK : bloque_bloqueo_revision_documentos_obligaciones_laborales --> 
  
<!-- START BLOCK : bloque_bloqueo_revision_sedes_individual -->  
 	if(caso_formulario == 1 && caso_tipo_oferente != 'persona' )
	{
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_nosede_{id_extra}_region_id|ate_sede_{id_extra}_comuna_id|ate_sede_{id_extra}_direccion|ate_sede_{id_extra}_telefono_codigo|ate_sede_{id_extra}_telefono|ate_sede_{id_extra}_email|';
	}  
<!-- END BLOCK : bloque_bloqueo_revision_sedes_individual -->
 


	if(caso_formulario == 'capital' &&  caso_tipo_oferente != 'persona')
	{
<!-- START BLOCK : bloque_bloqueo_revision_portafolio_capital_humano_particular_relacion -->
		 if(document.main.ate_persona_rut.value == '{id_extra}')
		{	 
			document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + 'ate_persona_jornada|ate_persona_cargo|ate_persona_horas|';
		}
<!-- END BLOCK : bloque_bloqueo_revision_portafolio_capital_humano_particular_relacion -->
	}
 
	if(caso_formulario == 'capital' && caso_tipo_oferente != 'persona' )
	{ 		
		document.main.restriccionBloqueo.value = document.main.restriccionBloqueo.value + desbloqueAreaOferentes();
	}
/********************************************************************/
bloquearFormularioDevuelto();
/********************************************************************/

	if(caso_formulario == 'ofertas')
	{
<!-- START BLOCK : bloque_bloqueo_revision_portafolio_ofertas_particular -->  
		showId('bloque_botones_oferta_{id_extra}');
<!-- END BLOCK : bloque_bloqueo_revision_portafolio_ofertas_particular -->  
	}
	
	if(caso_formulario == 'experiencias')
	{
<!-- START BLOCK : bloque_bloqueo_revision_portafolio_experiencia_particular -->  
		showId('bloque_botones_experiencia_{id_extra}');
<!-- END BLOCK : bloque_bloqueo_revision_portafolio_experiencia_particular --> 
	}
<!-- START BLOCK : bloque_bloqueo_revision_oferta_general_areageografica -->  
 	if((caso_formulario == 5 && caso_tipo_oferente == 'persona' ) || (caso_formulario == 4 && caso_tipo_oferente != 'persona' ))
	{  
		showId('ate_institucion_zona_cobertura_boton');
	}  
<!-- END BLOCK : bloque_bloqueo_revision_oferta_general_areageografica -->  

	if(caso_formulario == 5 && caso_tipo_oferente != 'persona' )
	{  
<!-- START BLOCK : bloque_bloqueo_revision_portafolio_capital_humano_particular -->
		showId('boton_editar_capital_humano_{id_extra}');
		showId('boton_borrar_capital_humano_{id_extra}');
<!-- END BLOCK : bloque_bloqueo_revision_portafolio_capital_humano_particular --> 
	}   

	if(caso_formulario == 5 && caso_tipo_oferente != 'persona' )
	{
		/* desbloquea los inptu de nuevos capitales humanos en el caso que quieran agregar nuevos*/
		desbloquearFormularioDevuelto();
	}

 document.getElementById('bloque_revision_informacion_mensaje').innerHTML = '{mensaje_oferente}' +'<br>';   
 
<!-- START BLOCK : bloque_bloqueo_revision_portafolio_capital_humano_particular_nuevo --> 
 if(caso_formulario == 'capital' && caso_tipo_oferente != 'persona' )
 { 
	 	desbloquearFormularioDevuelto();
		hiddenId('bloque_revision_informacion'); 
 }
<!-- END BLOCK : bloque_bloqueo_revision_portafolio_capital_humano_particular_nuevo --> 