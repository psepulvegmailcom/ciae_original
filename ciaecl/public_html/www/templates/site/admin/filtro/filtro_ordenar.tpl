 <table id="tabla_noborder_admin">
  
	Ordenar por 
		<select name="tipo_filtro"  id="tipo_filtro"    > 
		 <option value="" {selected}></option> 
 <!-- START BLOCK : bloque_form_id_orden -->
		 <option value="{Orden}" >{campoFiltro}</option>
 <!-- START BLOCK : bloque_form_id_orden -->
		</select> 
        <input type="button" value="Ir" onClick="javascript:buscadorListadoAdmin('{page}&tipo_filtro='+document.getElementById('tipo_filtro').value);" >
 
 </table> 

