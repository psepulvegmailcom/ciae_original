
<div  class="fieldset_title_separador"> {revision_titulo_revision}</div> 
<fieldset>
<!-- START BLOCK : bloque_revision_resumen --> 




<script>var mensaje_interno = '';</script>

 
<!-- START BLOCK : bloque_revision_resumen -->
 
  <div class="fieldset_title_interno">Datos de Usuario</div>
 <a  href="javascript:verDatosUsuario('ventanaDatosUsuario','SpinDatosUsuario');">(Ver Datos)</a>
 <div id='SpinDatosUsuario'  style=' text-align:center; '  class="div_oculto" >
	 <img src="images/spinner.gif" /><br />Cargando Información
</div>
<div id='ventanaDatosUsuario'  class="div_oculto" >
<div id='ventanaDatosUsuario_interno'  class="div_oculto" ></div>
<br />

<a href="javascript:hiddenId('SpinDatosUsuario');hiddenId('ventanaDatosUsuario_interno');hiddenId('ventanaDatosUsuario');">Ocultar Datos</a>
</div>
<script>
verDatosUsuario('ventanaDatosUsuario','SpinDatosUsuario');
</script>

<div class="fieldset_title_interno">Evaluación de Oferente </div>
<a href="javascript:verEvaluacionOferente();">Ver Evaluación Oferente</a>
 
 <div class="fieldset_title_interno">Historial Estados Oferente</div>
 <!---->
 <a  href="javascript:verHistorialOferente('ventanaHistorialOferente','SpinHistorialOferente');">(Ver Historial Estados Oferente)</a>
 <div id='SpinHistorialOferente'  style=' text-align:center; '  class="div_oculto" >
	 <img src="images/spinner.gif" /><br />Cargando Información
</div>

<div id='ventanaHistorialOferente'  class="div_oculto" >
<div id='ventanaHistorialOferente_interno'  class="div_oculto" ></div>
<br />

<a href="javascript:hiddenId('SpinHistorialOferente');hiddenId('ventanaHistorialOferente_interno');hiddenId('ventanaHistorialOferente');">Ocultar Datos</a>
</div>
<!---->

 
 



 <div class="fieldset_title_interno">Revisiones Anteriores</div>
  <!--<a  href="javascript:verRevisionesAnteriores('ventanaRevisionAnteriores','SpinRevisionAnteriores');">(Ver Revisiones Anteriores)</a> -->
 
<div id='SpinRevisionAnteriores'  style=' text-align:center; '  class="div_oculto" >
	 <img src="images/spinner.gif" /><br />Cargando Información
</div>
 
<div id='ventanaRevisionAnteriores'  class="div_oculto" >
<div id='ventanaRevisionAnteriores_interno'  class="div_oculto" ></div>
<br />

<!--<a href="javascript:hiddenId('SpinRevisionAnteriores');hiddenId('ventanaRevisionAnteriores_interno');hiddenId('ventanaRevisionAnteriores');">(Ocultar Revisiones Anteriores)</a>-->
</div>

<script>verRevisionesAnteriores('ventanaRevisionAnteriores','SpinRevisionAnteriores');</script>
 
 
 
 
 <div class="fieldset_title_interno">{revision_estados_revision}</div>
  <!-- START BLOCK : bloque_revision_item -->
  
	<div  style=" text-align:left;  padding-left:3px;  width:100%; vertical-align:top; min-height:30px;  "  class="revision_fila" >		<img src="images/iconos/revision{revision_img}.gif" style="max-height:30px; max-width:30px;"   /> 	&nbsp;&nbsp;&nbsp;&nbsp;	 <strong>{revision_item}</strong>  &nbsp;&nbsp;
	<a  href="javascript:verActualizacion('{revision_prefijo}','{revision_prefijo_particular}');">(Revisar Actualización)</a>
	 &nbsp;&nbsp;<br />
<small  style=" font-size:10px">{revision_total_elementos_activos} elementos por revisar | {revision_total_elementos_inactivos} elementos revisados | {revision_total_elementos} elementos total</small>	
	 <script>var item_aux = '{revision_item}';

	document.main.orden_revisiones_bloques_prefijo.value = document.main.orden_revisiones_bloques_prefijo.value + '{revision_prefijo}' + ',';
	document.main.orden_revisiones_bloques_prefijo_particular.value = document.main.orden_revisiones_bloques_prefijo_particular.value + '{revision_prefijo_particular}' + ',' ;
	</script>
	
	<!-- START BLOCK : bloque_revision_item_comentario -->
	<br />   
	<span class="span_modificacion" style=" " >Comentario Interno :</span> {comentario_interno}

	<script>mensaje_interno = mensaje_interno+' <span class="span_modificacion"  ><strong>'+item_aux+'</strong></span>   {comentario_interno} <br />  ';</script>
	 <!-- END BLOCK : bloque_revision_item_comentario -->
	
	 </div> 
	 <!-- END BLOCK : bloque_revision_item -->
	 
	 
 <div class="fieldset_title_interno" style="">{revision_mensaje_oferente}</div>
 
	<div  style="text-align:left; padding:2px;    width:100%  "  id='comentarios_oferente_div'  >	
  <!-- START BLOCK : bloque_mensaje_oferente_item -->  	 
		<span class="span_modificacion"  ><strong>{revision_item} :</strong></span>   {comentario_oferente}<br /><br /> 
<!-- END BLOCK : bloque_mensaje_oferente_item -->
	  </div> 
 

 
 

</fieldset>
 
 
	<!-- INCLUDE BLOCK : ../templates/ate/edicion/revison_bloque_abrir.tpl -->
 
 