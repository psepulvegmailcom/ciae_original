 

<!-- START BLOCK : bloque_fila_itinerario_tramo_ficha -->
<tr id='formulario_ficha_tramo_{orden}'>
<td colspan="{colspan_tabla}">

    <fieldset id='formulario_admin_estado'> 
  
   
   
    <div class="fieldset_campos">
            <p><label>		Fechas </label> </p> 
             {fecha_inicio} al {fecha_fin}
     </div>
    <div class="fieldset_campos">
            <p><label>		Objetivo </label> </p> 
             {objetivo}
     </div>
    <div class="fieldset_campos">
            <p><label>		Origen </label> </p> 
             {origen}
     </div>
    <div class="fieldset_campos">
            <p><label>		Destino </label> </p> 
             {destino}
     </div>
     
    <div class="fieldset_campos" id='tramo_reembolso_{orden}'>
            <p><label>		Reembolso  </label> </p> 
            <div  id='tramo_reembolso_detalle_{orden}'>
            <br><br>Se solicita reembolso a cargo de centro de costo <i><strong>{reembolsos_si_paga}</strong></i>
            <br>
            
             <br>
             <a    class="open_view"  id='popup_interno_pdf_interno_reembolso_{orden}' data-type="download.php?file=solicitudes_gestion/reembolsos/{archivo_reembolsos}" >  
             <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
		</div>
    
            <div  id='tramo_reembolso_detalle_no_{orden}'>
            No se solicita reembolso
		</div>
     </div>
     <script>
	 if('{inscripcion_si}' == 'no')
	 {
		hiddenId('tramo_reembolso_detalle_{orden}'); 
	 }
	 else
	 {
		hiddenId('tramo_reembolso_detalle_no_{orden}'); 
	 }		 
	 </script>
     
    <div class="fieldset_campos" id='tramo_pasajes_{orden}'>
            <p><label>		Pasajes  </label> </p>  
            <div id='tramo_pasajes_detalle_{orden}'>
             Se solicita pago de pasajes a cargo del centro de costo <i><strong>{pasajes_si_paga}</strong></i>
		</div>
            <div id='tramo_pasajes_detalle_no_{orden}'>
             No se solicita pago de pasajes
		</div>
     </div>
     <script>
	 if('{pasajes_si}' == 'no')
	 {
		hiddenId('tramo_pasajes_detalle_{orden}'); 
	 }
	else
	 {
		hiddenId('tramo_pasajes_detalle_no_{orden}'); 
	 }		 
	 </script>
     
    <div class="fieldset_campos" id='tramo_viatico_{orden}'>
            <p><label>		Vi&aacute;tico   </label> </p>
            <div id='tramo_viatico_detalle_{orden}'>  
        Se solicita pago de vi&aacute;tico a cargo de centro de costo <i><strong>{viatico_si_paga}</strong></i>  <br>
        Se solicita pago de <strong>{viatico_dias}</strong> d&iacute;as
		</div>
            <div id='tramo_viatico_detalle_no_{orden}'>  
        No se solicita pago de vi&aacute;tico
		</div>
     </div>
     
     <script>
		if('{viatico_si}' == 'no')
		{
			hiddenId('tramo_viatico_detalle_{orden}'); 
		}
		else
		{
			hiddenId('tramo_viatico_detalle_no_{orden}'); 
		}
	 </script>
         <div class="fieldset_campos"  >
            <p><label>		Invitaci&oacute;n  </label> </p> 
            <br><br>
            
            <a    class="open_view"  id='popup_interno_pdf_interno_invitaciones_{orden}'  data-type="download.php?file=solicitudes_gestion/invitaciones/{archivo_invitaciones}">
               <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
     </div>
         <div class="fieldset_campos"  >
            <p><label>		Motivo actividad  </label> </p> 
             {tipo_actividad} {motivo_actividad_otro}
     </div>
         <div class="fieldset_campos"  >
            <p><label>		Tipo actividad  </label> </p> 
              {motivo_viaje} {motivo_viaje_otro} {motivo_viaje_institucion}
     </div>
         <div class="fieldset_campos"  >
          <p><label>		P&uacute;blico objetivo del evento   </label> </p> 
             {publico_objetivo_texto}
     </div>
      
    
    </fieldset>
</td>
</tr>
<!-- END BLOCK : bloque_fila_itinerario_tramo_ficha -->

 