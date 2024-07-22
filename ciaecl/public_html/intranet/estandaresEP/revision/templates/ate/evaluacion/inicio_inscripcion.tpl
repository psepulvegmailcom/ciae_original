
<br><br><strong>Tipo de búsqueda</strong><br>
<div style=" padding-left:20px; padding-bottom:20px;">
<input name="busqueda_evaluacion_caso_consulta" type="radio" value="inscripcion" onClick="javascript:mostrarBloqueAgnos('inscripcion');"> Inscripción de Servicios ATE<br>
<input name="busqueda_evaluacion_caso_consulta" type="radio" value="satisfaccion" onClick="javascript:mostrarBloqueAgnos('satisfaccion');"> Satisfacción con los servicios contratados 
</div>

<div id='bloque_evaluacion_agnos'  >

 <strong>Año de búsqueda</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	<select name="busqueda_evaluacion_agno"  onChange="javascript:mostrarBloques()"> 
	{agnos_seleccion_busqueda}
	</select>
	</div>
</div>

<div id='bloque_evaluacion_tipo'  >

 	<strong>Tipo de oferente</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	 
<!-- START BLOCK : bloque_evaluacion_busqueda_tipo_oferente -->
	<input  type="checkbox" name="busqueda_evaluacion_tipo_oferente[]" value="{id_tipo}"   > {tipo}<br>
<!-- END BLOCK : bloque_evaluacion_busqueda_tipo_oferente --> 
	</div>
</div>


<div id='bloque_evaluacion_region'  >

 	<strong>Región</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	<select name="busqueda_evaluacion_region"   onchange="javascript:showComuna('busqueda_evaluacion_region','busqueda_evaluacion_comuna');">
	 {busqueda_region}
	 </select>
	</div>
	 	<strong>Comuna</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	<select name="busqueda_evaluacion_comuna"  > 
	 </select>
	</div>
</div>


<div id='bloque_evaluacion_planmejora'  >

 	<strong> Área de plan de mejoras</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	<select name="busqueda_evaluacion_areas"   >
	<option value="">Seleccione Área</option>
	 <!-- START BLOCK : bloque_evaluacion_busqueda_tipo_planmejoras -->
	<option value="{id_area}">{area}</option>
<!-- END BLOCK : bloque_evaluacion_busqueda_tipo_planmejoras --> 
	 </select>
	</div> 
</div>

<div id='bloque_evaluacion_meses'  >

 	<strong>Mes de inscripción del servicio</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	<select name="busqueda_evaluacion_mes"    >
	 
	{busqueda_meses} 
	 </select>
	</div> 
</div>

<div id='bloque_evaluacion_semaforo'  >

 	<strong>Semáforo</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	<select name="busqueda_evaluacion_semaforo[]"   multiple="multiple"   style="height:85px" >
	  
	<option value="0">Rojo</option>
	<option value="1">Naranja</option>
	<option value="2">Amarillo</option>
	<option value="3">Verde</option>
	<option value="4">Al menos una evalaución en cualquier color</option>
	 </select>
	</div> 
</div>
<div id='bloque_evaluacion_tipo_receptor'  >

 	<strong>Evaluador</strong><br>

	<div style=" padding-left:20px; padding-bottom:20px;">
	<input type="checkbox" name="busqueda_evaluacion_tipo_receptor_establecimiento" value="director"> Director<br>
	<input type="checkbox" name="busqueda_evaluacion_tipo_receptor_sostenedor" value="sostenedor"> Sostenedor<br>
	</div> 
</div>


<div id='boton_descarga_buscar' style="text-align:center; padding:10px;">
<button onclick="javascript:buscarOfertas()" type="button" title="Buscar" id='boton_evaluacion_buscar'  ><span>Buscar</span></button> </div>

 <!-- INCLUDE BLOCK : ../templates/ate/evaluacion/descarga.tpl -->
  <script>
  
	function buscarOfertas()
	{ 
		if(document.main.busqueda_evaluacion_agno.value == '')
		{
			showAlert('Debe seleccionar un año de búsqueda');
			return false;
		}
		process('',2);
	}
	document.main.evaluacion_caso_descarga.value = '';
	hiddenId('boton_descarga_base');
  function esconderTodo()
  {
  	  document.main.evaluacion_caso_descarga.value = '';
	  
	  document.main.busqueda_evaluacion_agno.value = '';
	  hiddenId('bloque_evaluacion_meses');
	  hiddenId('bloque_evaluacion_agnos');
	  hiddenId('bloque_evaluacion_tipo');
	  hiddenId('boton_descarga_buscar');
	  hiddenId('boton_descarga_base');
	  hiddenId('bloque_evaluacion_region');
	  hiddenId('bloque_evaluacion_planmejora');
	  hiddenId('bloque_evaluacion_semaforo');
	  hiddenId('bloque_evaluacion_tipo_receptor');
  }
  esconderTodo();
  function mostrarBloques()
  {  
	showId('boton_descarga_buscar');
	/*showId('boton_descarga_base');*/
	showId('bloque_evaluacion_meses'); 
	showId('bloque_evaluacion_tipo');
	showId('bloque_evaluacion_region');
	showId('bloque_evaluacion_planmejora'); 
	
	if( document.main.evaluacion_caso_descarga.value == 'satisfaccion')
	{
		showId('bloque_evaluacion_semaforo');
		showId('bloque_evaluacion_tipo_receptor');
	}		
  }
  	function mostrarBloqueAgnos(caso)
	{
		esconderTodo();
		showId('bloque_evaluacion_agnos');
		document.main.evaluacion_caso_descarga.value = caso;
	}
   
</script>