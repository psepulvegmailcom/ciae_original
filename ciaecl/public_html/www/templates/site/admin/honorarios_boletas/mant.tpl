 
 
	 <div  id='detalle_persona'>
        <fieldset id='formulario_admin_honorarios'> 
         
        <legend>Importar reporte sistema de honorarios </legend>
        
        	<div class="fieldset_campos">
   <label>		Archivo </label>  
		
		<input type="file" class="ArchivoUnico" id="Archivo1" name="file[]"/>
                <ul id="lista-archivoUnico1" >                </ul>
                <div id="responseArchivoUnico1"></div>          
              
			<input type="hidden" id="ruta_archivo1" value="tmp/" name="ruta_archivo1"/>
			<input type="hidden" id="nombre_campo_archivo1" value="form_archivo_importacion" name="nombre_campo_archivo1"/>
     	<input type="hidden" name="form_archivo_importacion" id="form_archivo_importacion"  >
	     	 
		
		
		
		
		
			</div>
         <button onclick="javascript:enviar_accion_admin('{opcion_modulo}|importar','');" type="button"  ><span id='texto_boton_nuevo'>Importar informaci&oacute;n</span></button>  
	 </fieldset></div>
	 
	 <div  id='detalle_persona'>
        <fieldset id='formulario_admin_honorarios'> 
         
        <legend>Enviar boletas </legend>
        
        	  <button onclick="javascript:enviar_accion_admin('{opcion_modulo}|boletas','');" type="button"  ><span id='texto_boton_nuevo'>Enviar Boletas</span></button> 
        
	 </fieldset></div>
	
	 



<script type="text/javascript">
 

	
function enviarElement(opcion)
{      
	process('{opcion_modulo}|'+opcion,0);	  
}
</script>