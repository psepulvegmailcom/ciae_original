
<script>
function desbloquearFormularioDevuelto(){} 
function bloquearFormularioDevuelto(){} 
</script>
<div style="float:right; padding-bottom:10px; "><a href="javascript:process('portafolio_oferta_lista',0);" style="  padding-bottom:10px; ">{volver_listado}</a></div><br />
<input type="hidden" name="con_volver" value="{con_volver}" />
<div  class="fieldset_title" >Oferta <font id='ate_oferta_estado' class="edicion_enrevision"> </font></div><br />

<div id='bloque_botones_sup'>
	<center>
		<button type="button" onclick="javascript:chequeoTipoDatos('oferta|guardar',0);"  ><span>Guardar y Agregar Otra Oferta</span></button>  
		<button type="button" onclick="javascript:chequeoTipoDatos('oferta|cerrar',0);"  ><span>Guardar y Cerrar</span></button>     <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		  
	</center>
</div>	 
<br /> (*) Campos Obligatorios  <br />
	 
	 <script>
	function marcarProgramasIntegrales()
	{
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{			    
			if(x[i].name == 'ate_oferta_programa[]')
			{							 
				if(	x[i].value == document.main.id_programa.value)
				{
					x[i].checked = true;
					x[i].disabled = true;
				}							
			}
		}
	}
	marcarProgramasIntegrales();
	function mostrarListadoIntegral(caso )
	{
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{			    
			if(x[i].name == 'ate_oferta_programa[]'  )
			{							
				x[i].checked = false; 				
			}
		}
		if(caso == 'ocultar')
		{
			hiddenId('listado_subarea_integrales');
		}
		else
		{
			showId('listado_subarea_integrales');
		}
		marcarProgramasIntegrales();
	}
	</script>
	<input type="hidden" name='id_oferta' value="{id_oferta}" /> 
	<input type="hidden" name='id_actualizacion' value="{id_actualizacion}" />
	<div  class="fieldset_title" >Área y Subárea Asistencia Técnica</div>
	<fieldset>
	<div>
	<label>Área : </label> {area_portafolio} <input type="hidden" name='id_area' value="{area_portafolio_id}" />
	<br />
	<label>Subárea : </label> {subarea_portafolio}  <input type="hidden" name='id_programa' value="{subarea_portafolio_id}" />
	</div>
	 </fieldset>  

	<div  class="fieldset_title" >Nombre Oferta</div>
	<fieldset>
	<div>
		<input type="text" name="ate_oferta_nombre_oferta" maxlength="255" value="{nombre_oferta_valor}" /> (*)
	</div>
	</fieldset>

	<div  class="fieldset_title" >Descripción Oferta</div>
	<fieldset>
	<label></label><span id='ate_oferta_descripcion_oferta_max'>{max_largo_descripcion_oferta} caracteres de un máximo de {max_largo_texto}</span><br />
		
		<textarea name="ate_oferta_descripcion_oferta" id='ate_oferta_descripcion_oferta' onKeyDown="textCounter('ate_oferta_descripcion_oferta','ate_oferta_descripcion_oferta_max',{max_largo_texto});" onKeyUp="textCounter('ate_oferta_descripcion_oferta','ate_oferta_descripcion_oferta_max',{max_largo_texto});">{descripcion_oferta_valor}</textarea> <span>(*)</span><span>{ayuda_descripcion}</span>
	</fieldset> 

	<div  class="fieldset_title" >Oferta Integral</div>
	<fieldset>
	<label>Esta oferta corresponde a una oferta integral?</label><br>
	<input type='radio' onClick="javascript:mostrarListadoIntegral('mostrar');"  class="inputcheckbox" name='ate_oferta_integral' value='1' > Si <input   class="inputcheckbox"  onClick="javascript:mostrarListadoIntegral('ocultar');" type='radio' checked="checked" name='ate_oferta_integral' value='0' > No
	<br>
	<div id='listado_subarea_integrales'>
	{listado_subarea_integrales}
	</div> 
	<script>
		mostrarListadoIntegral('{caso_bloque_integral}');	
	<!-- START BLOCK : bloque_caso_bloque_integral -->
	 	var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{			    
			if(x[i].name == 'ate_oferta_integral' &&  x[i].value == 1 )
			{							
				x[i].checked = true; 				
			}
			if(x[i].name == 'ate_oferta_programa[]')
			{							 
				<!-- START BLOCK : bloque_caso_bloque_integral_id -->	
				if(	x[i].value == {id_programa})
				{
					x[i].checked = true;
				}			
				<!-- END BLOCK : bloque_caso_bloque_integral_id -->				
			}
		}
	<!-- END BLOCK : bloque_caso_bloque_integral -->
	</script> 
	</fieldset>

<div id='bloque_botones_inf'>
	<center>
	<button type="button" onclick="javascript:chequeoTipoDatos('oferta|guardar',0);"><span>Guardar y Agregar Otra Oferta</span></button>  	<button type="button" onclick="javascript:chequeoTipoDatos('oferta|cerrar',0);"  ><span>Guardar y Cerrar</span></button>     <button type="button" onclick="javascript:self.close();"  ><span>Cancelar</span></button>   
		 
	</center>
</div>	 
 
<!-- START BLOCK : ventana_cerrar -->
<script>self.close();</script>
<!-- END BLOCK : ventana_cerrar -->

<input type="hidden" name="guardar_caso" value="guardar{guardaredicion}" /> 


<script> 
		
function chequeoTipoDatos(action,level)
{
	 
			desbloquearFormularioDevuelto();
		chequeoTipoDatosCompleto(action,level); 
			bloquearFormularioDevuelto();	;			
}
function chequeoTipoDatosCompleto(action,level)
	{
		var chequeo = true;  
  
		if(isEmpty(document.main.ate_oferta_nombre_oferta.value))
		{
			showAlert('Debe ingresar el nombre de la oferta');
			document.main.ate_oferta_nombre_oferta.focus();
			return false; 
		} 
		if(isEmpty(document.main.ate_oferta_descripcion_oferta.value))
		{
			showAlert('Debe ingresar la descripción de la oferta');
			document.main.ate_oferta_descripcion_oferta.focus();
			return false; 
		} 
		process(action,level); 
	}  
	
	 
</script>
