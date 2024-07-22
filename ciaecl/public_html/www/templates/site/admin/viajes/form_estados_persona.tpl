 
   
<tr id='formulario_ficha_persona'>
<td colspan="{colspan_tabla}">

<fieldset id='formulario_admin_estado'> 

    <div class="fieldset_campos">
            <p><label>		Beneficiario </label> </p> 
             <br><br>{nombre} {apellido_paterno} {apellido_materno} ({email})
             
             </div>
             
             
    <div class="fieldset_campos">
            <p><label>		Rut </label> </p> {rut_html}-{rut_dv}<br>  
            <a     class="open_view"  id='popup_interno_pdf_interno_rut'  data-type="download.php?file=solicitudes_gestion/rut/{archivo_rut}">
            <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
     </div>
     
	
    <div class="fieldset_campos" id='ficha_pasaporte'>
            <p><label>		Pasaporte </label> </p> 
             {pasaporte}<br> 
             <a     class="open_view"  id='popup_interno_pdf_interno_pasaporte' data-type="download.php?file=solicitudes_gestion/pasaporte/{archivo_pasaporte}" ><img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
     </div>
     <script>
	 if('{pasaporte}' == '')
	 {
		 hiddenId('ficha_pasaporte');
	 }
	 </script>
     
    <div class="fieldset_campos">
            <p><label>		Cargo </label> </p> 
             <br><br>{cargo_gestion}  
             
             </div>
    <div class="fieldset_campos">
            <p><label>		CV </label> </p> 
             <a    class="open_view"  id='popup_interno_pdf_interno_cv' data-type="download.php?file=solicitudes_gestion/cv/{archivo_cv}" >
             <img  border=0 src="www/images/iconos/download_act.png"> Descarga archivo</a>
     </div>
     
         
         
         
</fieldset>
</td>
</tr>
<tr id='formulario_ficha_documentos'>
<td colspan="{colspan_tabla}">

<fieldset id='formulario_admin_estado'> 
 <!-- START BLOCK : bloque_estado_ficha_documentos -->
    <div class="fieldset_campos">
            <p><label>		Historial documentos solicitud </label> </p>
            <ul>
            <!-- START BLOCK : bloque_estado_ficha_documentos_detalle --> 
            <li> 
            <a    class="open_view"  id='popup_interno_pdf_interno_{archivo}' data-type="download.php?file=solicitudes_gestion/archivos/{archivo}" >
             <img  border=0 src="www/images/iconos/download_act.png"> {nombre} ({fecha})</a>
				</li>
            <!-- END BLOCK : bloque_estado_ficha_documentos_detalle --> 
		</ul>
     </div>
 <!-- END BLOCK : bloque_estado_ficha_documentos -->
     
     
     
     
</fieldset>
</td>
</tr>