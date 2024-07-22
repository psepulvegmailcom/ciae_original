
	<div>
		<label>Comentario Resolución </label><br  />		
		<textarea id='evaluacion_resolucion_comentario'  name="evaluacion_resolucion_comentario{id_oferta}"    class="textarea_revision_text" style=" height:80px"  ></textarea>		
	</div> 
	<div>
	<label>Archivos</label><br>  El formato  para subir sus resoluciones es un archivo pdf.
	<br>
	<input type="file"   class="inputfile" name="evaluacion_resolucion_archivo{id_oferta}">
	
	</div>
	<div>
	<label>Categoría análisis</label><br>
	<select name="evaluacion_resolucion_categoria{id_oferta}">
	<option value="" >Seleccion categoría</option>
<!-- START BLOCK : bloque_evaluacion_categoria_resolucion --> 
	<option value="{id_categoria}">{categoria}</option> 
<!-- END BLOCK : bloque_evaluacion_categoria_resolucion --> 
	</select>
	</div>
	<div>
	
<button onclick="javascript:guardarResolucion('{id_oferta}');" type="button" title="Guardar Resolución"><span>Guardar Resolución</span></button>
	</div>
	
	
 <div class="fieldset_title_interno">Eliminar del Registro</div>
	<div>
	<label>Justificación de eliminación</label><br>
	<textarea  name="evaluacion_resolucion_justificacion{id_oferta}"  class="textarea_revision_text" ></textarea>
	</div>
	<div>
	
<button onclick="javascript:eliminarRegistro({id_oferta});" type="button" title="Eliminar del registro"><span>Eliminar del registro</span></button>
	</div>
	 