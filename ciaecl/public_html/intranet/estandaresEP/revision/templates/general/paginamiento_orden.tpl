 
	<div style="padding:10px 0 10px 0; vertical-align:top;">
	Ordenar por : <select name="pagina_sistema_orden" style="width:150px; ">
	<!-- START BLOCK : opcion_orden -->	
	<option value="{opcion}"  {selected}>{texto}</option>
	<!-- END BLOCK : opcion_orden -->

	</select>
	 <input type="radio" class="inputcheckbox" value="asc"  name="pagina_sistema_direccion"  title="Ordenar Ascendentemente" {checked_asc} /><img src="images/iconos/asc.gif" title="Ordenar Ascendentemente" />
	<input type="radio" class="inputcheckbox"  value="desc"  title="Ordenar Descendentemente"  {checked_desc}  name="pagina_sistema_direccion"/><img src="images/iconos/desc.gif" title="Ordenar Descendentemente"  />
	 
	<button onclick="javascript:process('{opcion_extra_orden}',1);" type="button" title="Ingresar Noticia"><span>Filtrar</span></button>
	
	
	</div>
