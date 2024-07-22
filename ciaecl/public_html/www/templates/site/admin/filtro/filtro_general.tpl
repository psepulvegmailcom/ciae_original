 
 
 <div  class="paginamiento_admin" style="margin-bottom: 10px; margin-top: 10px; text-align: center">
  <table  style="width: 100%; margin-top: 25px;" border="0"> 
  <tr><td  style="width: 50%">
 <strong>Buscar </strong>&nbsp;&nbsp; 
 <input type="text" name="buscar_filtro_busqueda" id="buscar_filtro_busqueda"  value="{buscar_filtro_busqueda}"    >  
	  </td><td>
	<strong>Ordenar por</strong> &nbsp;&nbsp;
		<select name="buscar_filtro_orden"  id="buscar_filtro_orden" style="min-width: 160px"      > 
		 <option value="" {selected}></option> 
 <!-- START BLOCK : bloque_form_id_orden -->
		 <option value="{Orden}" >{campoFiltro}</option>
 <!-- END BLOCK : bloque_form_id_orden -->
		</select> 
        <input type="button" value="Ir" onClick="javascript:process('',1);" >
	  </td></tr>
 </table> 
 <script>
 <!-- START BLOCK : bloque_form_buscar_orden_buscar --> 
	 setValue('buscar_filtro_busqueda','{valor_buscar}');
 <!-- END BLOCK : bloque_form_buscar_orden_buscar -->
 <!-- START BLOCK : bloque_form_buscar_orden_ordenar -->
	 
		selectValue('buscar_filtro_orden','{valor_ordenar}');
 <!-- END BLOCK : bloque_form_buscar_orden_ordenar -->
</script>
</div>
 

