 
<div  class="fieldset_title" >{tpl_descripcion_oferta}   <span>(*)</span> <span>

<!--<a id="descripcion_ayuda_id" onmouseover="javascript:showTooltip('descripcion_ayuda_id','{ayuda_descripcion_oferta_general}','Descripción');"   onmouseover="javascript:showTooltip('descripcion_ayuda_id','{ayuda_descripcion_oferta_general}','Descripción');" > 
<img src="images/Info.ico"   border='0' /></a>-->
</span> </div>

<fieldset>
	<div><font id='ate_oferta_descripcion_estado' class="edicion_enrevision"> </font><br>
		<label></label>{ayuda_descripcion_oferta_general}<br /><br />
		<span id='ate_oferta_descripcion_max'>{max_largo_actual} caracteres de un máximo de {max_largo}</span><br />
		
		
		<textarea name="ate_oferta_descripcion" id='ate_oferta_descripcion' onKeyDown="textCounter('ate_oferta_descripcion','ate_oferta_descripcion_max',{max_largo});" onKeyUp="textCounter('ate_oferta_descripcion','ate_oferta_descripcion_max',{max_largo});">{oferta_descripcion}</textarea>
		  
	</div>
</fieldset>
<div  class="fieldset_title" >Regiones y Comunas en que ofrece servicios  
<span>(*)</span> <span>{ayuda_area_cobertura}</span><br> <font id='ate_institucion_zona_cobertura_estado' class="edicion_enrevision">{estado_edicion_zona_cobertura}</font></div>
<div style="text-align:center" id='ate_institucion_zona_cobertura_boton'> 
<button type="button"  onclick="javascript:verFormularioPopup('comunas_multiple');hiddenId('area_cobertura_comunas');hiddenId('area_cobertura_comunas_ocultar');
hiddenId('comuna_spinner');showId('area_cobertura_comunas_ver');">
<span>Seleccionar Regiones y Comunas</span></button> 		
 </div>
 <script>
 if(trim(document.getElementById('ate_institucion_zona_cobertura_estado').innerHTML) != '')
 {
 	hiddenId('ate_institucion_zona_cobertura_boton');
 }
 </script>
<br />
<div  align='right' id='area_cobertura_comunas_ver'>
<a href="javascript:showAreaCoberturaOferente(); showId('area_cobertura_comunas_ocultar');showId('comuna_spinner');"> 
Ver/Refrescar Lista de Comunas Seleccionadas</a></div>

<div style="text-align:center" id="comuna_spinner" class="div_oculto">
 <img src="images/spinner.gif"    />
 </div>
<div id='area_cobertura_comunas'   class='div_oculto' > </div>
<div  align='right' id='area_cobertura_comunas_ocultar'  class='div_oculto'><a href="javascript:hiddenId('area_cobertura_comunas');hiddenId('area_cobertura_comunas_ocultar');hiddenId('comuna_spinner');showId('area_cobertura_comunas_ver');">Ocultar Lista de Comunas Seleccionadas</a></div> 

<div  class="fieldset_title" >Niveles y tipo de establecimiento que atiende <span>(*)</span> <span>{ayuda_nivel_establecimiento}</span></div>
<fieldset>
	<div>
	 
		 
	 <!-- START BLOCK : bloque_ate_oferta_nivel -->
	<input type="checkbox"  class="inputcheckbox"  name="ate_oferta_nivel[]"  value="{bloque_ate_oferta_nivel_id}" {bloque_ate_oferta_nivel_selected}>
	<strong>{bloque_ate_oferta_nivel_registro}</strong>  <br />
	<!-- END BLOCK : bloque_ate_oferta_nivel -->
	 <input type="checkbox"  class="inputcheckbox" name="sel_ate_oferta_nivel" onclick="javascript:checkInputAll('ate_oferta_nivel[]');" />  
		 <strong>Seleccionar Todos</strong>
		 <br  /><br  /> <strong>Otro (Descríbala brevemente)</strong><br  /> 
			<input type="text"   maxlength="150" name="otro_nivel_oferta" value="{otro_nivel_oferta}" /> 
	</div>
</fieldset>

<div  class="fieldset_title">Tipo de Zona Geográfica <span>(*)</span> <span>{ayuda_zona_geografica}</span></div>
<fieldset>
<div>Indique el tipo de zona geográfica que su organización ofrece atender.</div>
	<div> 
	<!-- START BLOCK : bloque_ate_oferta_zona -->
	<input type="checkbox"  class="inputcheckbox" name="ate_oferta_zona[]" value="{bloque_ate_oferta_zona_id}" {bloque_ate_oferta_zona_selected}  /> <strong>{bloque_ate_oferta_zona_registro}</strong>
	<!-- END BLOCK : bloque_ate_oferta_zona -->
			
	<input type="checkbox"  class="inputcheckbox" name="sel_ate_oferta_zona" onclick="javascript:checkInputAll('ate_oferta_zona[]');" /> 
	 <strong>Seleccionar Todos</strong>
	</div>
</fieldset>
<div   class="fieldset_title">Beneficiarios directos del servicio <span>(*)</span> <span>{ayuda_beneficiario}</span> </div>
<fieldset>
	<div> 
			<!-- START BLOCK : bloque_ate_oferta_personas -->
			<input type="checkbox"  class="inputcheckbox"  name="ate_oferta_personas[]" value="{bloque_ate_oferta_personas_id}" {bloque_ate_oferta_personas_selected}><strong>{bloque_ate_oferta_personas_registro}</strong> <br />
			<!-- END BLOCK : bloque_ate_oferta_personas -->
			 <input type="checkbox"  class="inputcheckbox" name="sel_ate_oferta_personas" onclick="javascript:checkInputAll('ate_oferta_personas[]');" />  <strong>Seleccionar Todos</strong>
			 
	</div>
</fieldset>	
<div    class="fieldset_title"> Tipo de servicio <span>(*)</span> <span>{ayuda_tipo_servicio}</span></div>
<fieldset>
<div>Indique el tipo de servicio ATE que ofrece su organización</div>
	<div> 
			 <!-- START BLOCK : bloque_ate_oferta_servicio -->
			<input type="checkbox"  class="inputcheckbox" name="ate_oferta_servicio[]"  value="{bloque_ate_oferta_servicio_id}" {bloque_ate_oferta_servicio_selected}><strong>{bloque_ate_oferta_servicio_registro} {ayuda_servicio_registro}</strong>
			<!-- END BLOCK : bloque_ate_oferta_servicio -->
		 <input type="checkbox"  class="inputcheckbox" name="sel_ate_oferta_servicio" onclick="javascript:checkInputAll('ate_oferta_servicio[]');" />  <strong>Todos </strong>
			 
	</div>
</fieldset>
<div  class="fieldset_title">Metodolog&iacute;a Empleada <span>(*)</span> <span>{ayuda_}</span></div>
<fieldset>
<div>Indique la(s) metodología(s) de trabajo que utiliza su organización para prestar Asistencia Técnica</div>
	<div>   
	<label>  </label> 
			<!-- START BLOCK : bloque_ate_oferta_metodologia -->
			<input type="checkbox"  class="inputcheckbox"  name="ate_oferta_metodologia[]" value="{bloque_ate_oferta_metodologia_id}" {bloque_ate_oferta_metodologia_selected}><strong>{bloque_ate_oferta_metodologia_registro} </strong><br />
			<!-- END BLOCK : bloque_ate_oferta_metodologia -->
			 
			
			<input type="checkbox"  class="inputcheckbox" name="sel_ate_oferta_metodologia" onclick="javascript:checkInputAll('ate_oferta_metodologia[]');" /> 	 <strong>Seleccionar Todos</strong> 
			
			<br  /><br  /> <strong>Otra (Descríbala brevemente)</strong><br  /> 
			<span id='ate_oferta_metodologia_otra_max'>{max_largo_metodologia_actual} caracteres de un máximo de  {max_largo_metodologia}</span></label><br />
		
		<textarea name="otra_metodologia_oferta" id='otra_metodologia_oferta'      onKeyDown="textCounter('otra_metodologia_oferta','ate_oferta_metodologia_otra_max',{max_largo_metodologia});" onKeyUp="textCounter('otra_metodologia_oferta','ate_oferta_metodologia_otra_max',{max_largo_metodologia});">{otra_metodologia_oferta}</textarea> 
	</div>
</fieldset> 
<div   class="fieldset_title">Identificación de la(s) &Aacute;rea(s) de Asistencia T&eacute;cnica <span>(*)</span> <span>{ayuda_area_asistencia}</span></div><ul style="padding-left:27px; list-style:circle;">
<li class="lista_principal">Al seleccionar la subárea en la que {tipo_texto_asistencia} ofrece servicios ATE aparecerá una ventana emergente con la ficha para ingresar la(s) oferta(s) correspondiente(s). Si ha tenido experiencia(s) en los últimos 5 años, marque "Si" y aparecerá una ventana emergente con el portafolio de evidencias en el que deberá ingresar la(s) experiencia(s) correspondiente(s) y los documentos requeridos.</li>
<li class="lista_principal">En el caso de tener más de una oferta en la misma subárea, podrá incorporarla haciendo click en el botón "Ingresar más  Ofertas".</li>
<li class="lista_principal">En el  caso de tener más de una experiencia en la misma subárea, podrá incorporarla haciendo click en el botón "Ingresar más".</li>
<li class="lista_principal"> Para editar o eliminar algún elemento, deberá hacerlo en los botones correspondientes : "Ver Listado de Ofertas" y/o "Ver Listado de Experiencias".</li>
</ul>
 <br />
		{tpl_areas_ambito_oferta}


<script> 
	function agregarExperiencia(id_area,id_programa ){ 
		 verFormulario('portafolio',id_area,id_programa);  
	}
	
	function agregarOferta(id_area,id_programa )
	{ 
		var x = document.main.elements;	
		for (var i=0 ; i < x.length ; i++)
		{			    
			if(x[i].name == 'ate_oferta_programa[]' && x[i].value == id_programa && x[i].checked)
			{
				 verFormulario('oferta',id_area,id_programa);
			}									
		} 		 
	}
	
	function verFormulario(tipo,id_area,id_programa)
	{ 
		  var nuevo_ventana = window.open('indexPopup.php?caso_revision='+document.main.caso_revision.value+'&id_oferente='+document.main.id_oferente.value+'&option='+tipo+'&id_area='+id_area+'&id_programa='+id_programa,'ventana_extra_portafolio_form',optionOpenW);
	} 
	 	
function chequeoTipoDatos(action,level)
{
	 
			desbloquearFormularioDevuelto();
		chequeoTipoDatosCompleto(action,level); 
			bloquearFormularioDevuelto();				
}
function chequeoTipoDatosCompleto(action,level)
{
	var chequeo = true;  
	var chequeoEdicion = true; 
	if(typeof chequeoTipoDatosEdicion == 'function') {
		chequeoEdicion = chequeoTipoDatosEdicion(chequeo);
	} 
	if(chequeo && chequeoEdicion)
	{
		process(action,level);
	} 
}  
</script>
