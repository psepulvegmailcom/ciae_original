 
<!-- START BLOCK : bloque_titulo_persona -->
<div id="bloque_titulo_persona_{id_titulo}">
 <fieldset>
<div style=' text-transform:uppercase; font-size:120%; font-weight:bold; border-bottom:1px #333333 dotted; '> Diploma  <button type="button"  onclick="javascript:quitarTitulo('{id_titulo}')"><span>Eliminar Diploma</span></button></div>
 <div >
 	<label> Tipo diploma</label> <span>{obligatorio}</span><br />
	<select name="titulo_persona_tipo_titulo_{id_titulo}" >
	<option value=""  {selected}>Tipo de diploma</option>
	<!-- START BLOCK : bloque_titulo_persona_tipo -->
	<option value="{id_titulo}"  {selected}>{titulo}</option>
	<!-- END BLOCK : bloque_titulo_persona_tipo -->
	</select> 
			  <br />
	<label> Nombre diploma</label> <span>{obligatorio}</span><br />
	<input type="text" name="titulo_persona_nombre_titulo_{id_titulo}" value="{nombre_titulo}"><span>{ayuda_nombre_titulo}</span>
			  <br />
<span>Adjuntar certificado de diploma</span>   <br />
 <input type="file"  class="inputfile" name="titulo_persona_archivo_{id_titulo}" >	 	
		 
		 {archivo_actual} 
	</div>
	<div >
	<label>Institución que otorgó el diploma</label><br />
	<input type="text" name="titulo_persona_institucion_titulo_{id_titulo}" value="{institucion_titulo}">
		 <span>{ayuda_persona_postitulo_institucion}</span>
	</div>
 
 </fieldset>
 
 </div>
<input type='hidden' name='titulo_activo_{id_titulo}' value='si'>
 <script> 
 document.main.total_titulos.value = document.main.total_titulos.value + '_{id_titulo}'; 
 </script>
 <!-- END BLOCK : bloque_titulo_persona -->

<div id='bloque_titulo_persona_n{proximo_div}'>
</div> 

 <button type="button"  onclick="javascript:agregarTitulo()"><span>Agregar nuevo diploma</span></button>
 <input type='hidden' name='proximo_titulo' value='{proximo_div}'>
