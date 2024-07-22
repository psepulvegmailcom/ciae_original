 
 
  
 <!-- INCLUDE BLOCK : www/templates/site/admin/viajes/ficha_persona_honorario.tpl --> 


  <div id='id_observaciones'>
     
 <fieldset id='formulario_admin'>  
    
        <legend> Observaci&oacute;n general de solicitud (por ejemplos: cofinanciamiento pasaje y/o viatico, tramos, etc)  </legend>
        <p>Ingrese informaci&oacute;n que usted considere relevante para la gesti&oacute;n de compra de pasaje y/o pago de vi&aacute;tico.</p>
         <div class="fieldset_campos">
		<label>		Fecha solicitud</label> 
		<input   type="hidden"  name="formviajeglobal_fecha"    id="formviajeglobal_fecha"   {disable_input} value="{fecha_insert}" maxlength="20"   > <!--{fecha}--> {fecha_mostrar}  
	</div>  
    
	  <div class="fieldset_campos">
		  
		 <label>Observaci&oacute;n</label>
		<textarea class="inputtext" type="text"   name="formviajeglobal_observacion"  {disable_input}   id="formviajeglobal_observacion"  > </textarea> 
	</div>
    </fieldset>
 </div>
     <input type="hidden" name="itenerario_activo" >
 <!-- START BLOCK : bloque_fila_itinerario -->     
 <!-- INCLUDE BLOCK : www/templates/site/admin/viajes/fila_itenerario.tpl --> 
 <!-- END BLOCK : bloque_fila_itinerario -->   
    
 <script>
	function abrirNuevoItinerario(fila)
	{
		document.main.itenerario_activo.value = fila;
		showId('formulario_admin_'+fila);	 
	}
	abrirNuevoItinerario('1');
	
	function calculoViaticoDias(fila)
	{
		var inicio 				= searchElement('formviaje_fecha_inicio_'+fila);
		var fin 				= searchElement('formviaje_fecha_fin_'+fila);
		var fecha_inicio		= inicio.value;
		var fecha_fin 			= fin.value; 
		var int_fecha_inicio	= fecha_inicio.substring(0, 2)+fecha_inicio.substring(3,5)*30+fecha_inicio.substring(6,10)*365;
		var int_fecha_fin 		= fecha_fin.substring(0, 2)+fecha_fin.substring(3,5)*30+fecha_fin.substring(6,10)*365;
		
		var int_fecha_inicio	= new Date(fecha_inicio.substring(6,10)+'/'+fecha_inicio.substring(3,5)+'/'+fecha_inicio.substring(0, 2));
		var int_fecha_fin	= new Date(fecha_fin.substring(6,10)+'/'+fecha_fin.substring(3,5)+'/'+fecha_fin.substring(0, 2));
		
//		var fechaResta = ((int_fecha_fin - int_fecha_inicio)/ 1000/ 60/ 60 / 24)));
		var fechaResta = (int_fecha_fin - int_fecha_inicio)/1000;
		fechaResta  = fechaResta/60;
		fechaResta  = fechaResta/60;
		fechaResta  = fechaResta/24;
		
		if(fechaResta < 0 )
		{
			alert('La fecha de termino del tramo debe ser posterior a la de inicio');
			fin.value = '';
		}
		else
		{
			var dias 				= searchElement('formviaje_viatico_dias['+fila+']');
			dias.value = fechaResta;
			showtr('formviaje_viatico_si_paga_'+fila+'-1');
		} 
		
	}
	</script>
    
    
     
    