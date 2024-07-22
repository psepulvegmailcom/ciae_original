


		<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->
		
		<fieldset id='formulario_admin'> 
	  
	<div class="fieldset_campos">
		<label>		T&iacute;tulo </label> 
		<textarea class="inputtext" type="text"   name="form_titulo"  id="form_titulo" maxlength="500"  >{titulo}</textarea> 
	</div>
	<div class="fieldset_campos">
		<label>		Resumen/Bajada </label> 
		<textarea class="inputtext" type="text"   name="form_bajada"  id="form_bajada"  maxlength="250"  >{bajada}</textarea> 
	</div>
	<div class="label_fieldset" >Noticia </div>
	<div class="fieldset_campos"> 		
	 	{form_noticia_editor}
        <textarea class="form_noticia"  type="text"   name="form_noticia"  id="form_noticia"  style="height:200px " >{noticia} </textarea> 
	</div>  
    
	<div class="fieldset_campos">
		<label>		Fecha <img class="tooltip_admin" src="www/images/iconos/32x32/Info2.png" title="En el caso de eventos, esta fecha debe ser la fecha de inicio del evento.<br>En el caso de noticias si se dejan como no publicadas con fecha futura el sistema la publicar&aacute; en la fecha especificada<br>Esta fecha permitir&aacute; al sistema calcular cuando las fechas caducar&aacute;n y desaparecer&aacute;n de destacados" ></label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10" style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div>
    
    
	<div class="fieldset_campos">
		<label>		 Autor/Fuente </label> 
		<input  class="inputtext" type="text" name="form_autor"  id="form_autor"  value="{autor}" maxlength="250"  > 
	</div> 
    
	<div class="fieldset_campos">
		<label>		Tipo   <img  class="tooltip_admin" src="www/images/iconos/32x32/Info2.png" title="Noticia o Evento, los eventos  aparecer&aacute;n  en el calendario del sitio" > </label>
		<input  type="radio" name='form_tipo' value="noticia" {checked_tipo_noticia}> Noticia<br>
		<input type="radio" name='form_tipo' value="evento" {checked_tipo_evento}> Evento<br> 
		<!-- <input type="radio" name='form_tipo' value="columna" {checked_tipo_evento}> Columna<br> -->
	</div>
	
	<div class="fieldset_campos">
		<label>		Trabaja con nosotros  <img  class="tooltip_admin" src="www/images/iconos/32x32/Info2.png" title="Aparecer&aacute; en la secci&oacute;n trabaja con nosotros" > </label>
		<input  type="checkbox" name='form_trabajo' {checked_id_trabajo}> Definir como trabaja con nosotros<br>
	</div>
	
	<div class="fieldset_campos">
		<label>	Contenido IE	 <img  class="tooltip_admin" src="www/images/iconos/32x32/Info2.png" title="Aparecer&aacute; en IE y en el home si est&aacute; destacado" > </label>
		<input  type="checkbox" name='form_investigaciones_ie' id="form_investigaciones_ie" {checked_id_investigaciones_ie}> Nuestras Investigaciones IE <br><br>	
		<input  type="checkbox" name='form_cursos_ie' id="form_cursos_ie" {checked_id_cursos_ie}> Cursos y Postgrados IE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input  type="radio" name='form_tipo_curso' value="postgrado" {checked_tipo_postgrado}>Postgrado <input  type="radio" name='form_tipo_curso' value="diplomado" {checked_tipo_diplomado}>Diplomado 
		<input  type="radio" name='form_tipo_curso' value="curso" {checked_tipo_curso}>Curso
		<input  type="radio" name='form_tipo_curso' value="magister" {checked_tipo_magister}>Mag&iacute;ster
		<input  type="radio" name='form_tipo_curso' value="0" > Ninguno<br-->
		<br>
		<br>
		<strong>Noticia tipo: </strong>
		<br>
		<input  type="radio" name='form_noticia_tipo' value="postgrado" {checked_noticia_postgrado}> Noticia de Postgrado <input  type="radio" name='form_noticia_tipo' value="diplomado" {checked_noticia_diplomado}>Noticia de Diplomado <input  type="radio" name='form_noticia_tipo' value="curso" {checked_noticia_curso}>Noticia de 
		Curso
		<input  type="radio" name='form_noticia_tipo' value="presentaciones" {checked_noticia_presentaciones}>
		Noticia de Presentaciones y conferencias
		<input  type="radio" name='form_noticia_tipo' value="0" >
		Ninguno
	</div>			
			
					
	<input type="hidden" name="form_idioma" value="es">
	
	<!--<div class="fieldset_campos">
		<label>		Idioma  </label> 
        <div>
		<input  type="radio" name='form_idioma' value="es" {checked_idioma_es}> Espa&ntilde;ol<br>
		<input type="radio" name='form_idioma' value="en" {checked_idioma_en}> Ingl&eacute;s<br> 
		<input type="radio" name='form_idioma' value="nn" {checked_idioma_nn}> Neutro<br> 
		</div>
	</div>-->
	
	 
   
   <div>
			<label>		Imagen principal <img class="tooltip_admin" src="www/images/iconos/32x32/Info2.png" title="Las im&aacute;genes debe respetar los tama&ntilde;os recomendados de los sitios.<br>El tama&ntilde;o ideal de la im&aacute;genes es 1100px / 710px, o proporcional, de no respetar esta proporci&oacute;n es probable que se deforme al visualizarla en la versi&oacute;n publica del sitio web." ></label><br  /> 
			<input type="file" class="imagenMultiple" id="images1" name="images[]"/>
			<ul id="lista-imagenes1">				</ul>
			<div id="response1"></div>
			<input type="hidden" id="ruta_imagen" value="{path_imagen}" name="ruta_imagen"/>
			<input type="hidden" id="nombre_campo_imagen1" value="form_imagen" name="nombre_campo_imagen1"/>
			<input type="hidden" name="form_imagen" id="form_imagen" value="{imagen}">  
			
	<!-- START BLOCK : bloque_imagen_anterior -->
	<div>
<a     class="open_view"  id='popup_interno_img_interno_noticias' data-type="imageview.php?image=noticias/{imagen}">
            <img  border=0 src="www/images/iconos/download_act.png"> Ver imagen actual</a>
	   </div><br>
	<!-- END BLOCK : bloque_imagen_anterior --> 
	 
	<strong>Texto descriptivo imagen principal: <img class="tooltip_admin" src="www/images/iconos/32x32/Info2.png" title="El texto descriptivo solo aparecer&aacute; como parte de la imagen, al visualizarla en el sitio" > </strong><input type="text"  class="inputtext"  name="form_imagen_bajada" value="{imagen_bajada}" maxlength="50">
	</div> 
    
	<div class="fieldset_campos">
		<label>		 Galeria de imag&eacute;nes (ingrese todas las im&aacute;genes que desee ingresar a la galer&iacute;a)</label>  
               <input type="file" class="imagenMultipleGaleria" id="images" name="images[]" multiple />
     
            <ul id="lista-imagenes-galeria">
                
            </ul>
            <div id="responseGaleria"></div>
         <input type="hidden" value="{id_item}" name="id_noticia_galeria" id="id_noticia_galeria"/>

         <input type="hidden" id="ruta_galeria" value="{path_galeria}" name="ruta_galeria"/>

		 <input type="hidden" id="ruta_raiz" value="{path_raiz}" name="ruta_raiz"/>
		
        <!-- START BLOCK : bloque_galeria_archivo -->

         <!-- START BLOCK : bloque_galeria_archivo_imagen -->
         	<img src="imageview.php?image=noticias/{id_item}/{imagen}"  width="80px"  border="0"   />		 
			<input type="checkbox" name="formimagengaleria_eliminar[]" value='{imagen}'> Eliminar imagen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <!-- START BLOCK : bloque_galeria_archivo_imagen_salto -->
			 <br><br>
			 <!-- END BLOCK : bloque_galeria_archivo_imagen_salto -->
         <!-- END BLOCK : bloque_galeria_archivo_imagen --> 
        <!-- END BLOCK : bloque_galeria_archivo --> 
	</div> 
    
    <div class="fieldset_campos" id="fieldset_campos">
      	<div class="_campos_1" id="_campos_1" > 
			<label id="titulo_formulario_links1">		Link externo 1 (ingresar url o archivo, solo se puede subir un link por vez)</label>         
         <p><strong>Texto:</strong>
			 <input type="text" id="texto1" name="formlink[texto][1]"  class="inputtext"  /></p>
           <p> <strong>Orden:</strong>  
            <select  id="orden1" name="formlink[orden][1]" >
				<option value="1">1</option>				<option value="2">2</option>				<optionvalue="3">3</option>				<option value="4">4</option>				<optionvalue="5">5</option>				<option value="6">6</option>				<optionvalue="7">7</option>				<option value="8">8</option>				<optionvalue="9">9</option>				<option value="10">10</option>
			   </select></p>
             
            <p><strong>Url:</strong>
				<input type="text" id="url1" name="formlink[url][1]"  class="inputtext" value=""/></p>
           
            </br><p><strong>Archivo:</strong></p>
            <input type="file" class="archivoClon" id="file1" name="file[]" /> <!-- 0 -->
            <ul id="lista-archivos1">			
            </ul>
            <div id="responseFile"></div> 
            <!--<input class="bt_agregacampos" id="bt1" type="button" value="+" />--> <!-- 1 -->
            <div class="error_form"></div>
			<input type="hidden" id="ruta_archivo" value="{path_archivo}" name="ruta_archivo"/> <!-- 2 -->
			<input type="hidden" id="doc1"   name="formlink[archivo][1]"/>  <!-- 3 -->
       </div>    
          <table style="width:100%; margin-left: 30px; "> 
        <!-- START BLOCK : bloque_noticia_link -->
			<tr>
				<td colspan="5"><label>Links  {fila}:</label>	</td></tr>
		       <!-- START BLOCK : bloque_noticia_link_eliminar -->    			   
                      <tr>
						  <td>&nbsp;&nbsp;&nbsp;</td>
                      <td style="vertical-align: top">
                      <input type="hidden"  name="id_link" value="{id_link}" 	> 
						  <strong>Texto :</strong> <div style="max-width: 250px; word-wrap: break-word"> {texto}  </div>
                      </td>
                      <td style="vertical-align: top"> <strong>Url:</strong> 
                      <!-- START BLOCK : bloque_noticia_link_eliminar_url_doc --> 
						<a class="open_view"  id='popup_interno_pdf_interno_noticias' data-type="download.php?file=noticias/{link}" >
            			<img  border=0 src="www/images/iconos/download_act.png"> Ver documento</a>
	    				<!-- END BLOCK : bloque_noticia_link_eliminar_url_doc --> 
                      <!-- START BLOCK : bloque_noticia_link_eliminar_url_url --> 
						<!--<a      href="{link}" target="_blank">
            			<img  border=0 src="www/images/iconos/download_act.png"> Ver link</a>-->
            			
						<a class="open_view" id='popup_interno_url_externo_link' data-type="{link}" >
            			<img  border=0 src="www/images/iconos/download_act.png"> Ver link</a>
	    				<!-- END BLOCK : bloque_noticia_link_eliminar_url_url --> 
                      </td>
                      <td style="vertical-align: top"> <strong>Orden:</strong>  {orden}  
                      </td>
                      <td  style="vertical-align: top"colspan="2"><input type="checkbox" name="formlink_eliminar[]" value='{id_link}'> Eliminar link  </td>
                      <br>
                      </tr> 
		       <!-- END BLOCK : bloque_noticia_link_eliminar -->  
        <!-- END BLOCK : bloque_noticia_link -->  
        </table>
	</div>     
	<div class="fieldset_campos">
		<label>		Palabras Clave </label> (ingresar separadas por coma ,  )<br  />
		<input  class="inputtext" type="text"   name="form_palabra_clave"  id="form_palabra_clave"  value="{palabra_clave}" maxlength="850"  > 
	</div>  

	<!-- para publicar en los tab de magister y diplomado-->
	<div class="label_fieldset">
		<label>PARA PUBLICAR EN PESTA&ntilde;AS DE DIPLOMADO Y MAGISTER:</label>
	</div>

	<div class="label_fieldset">
		<label>Pesta&ntilde;a FECHAS de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <textarea class="form_noticia"  type="text"   name="form_calendario_curso"  id="form_calendario_curso"  style="height:200px " >{calendario_curso} </textarea> 
	</div>
	<div class="label_fieldset">
		<label>Pesta&ntilde;a ARANCELES de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <textarea class="form_noticia"  type="text"   name="form_costo_evento"  id="form_costo_evento"  style="height:200px " >{costo_evento} </textarea>
	</div>
	<div class="label_fieldset">
		<label>Pesta&ntilde;a ARANCELES AGREGAR DESCUENTO de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <textarea class="form_noticia"  type="text"   name="form_descuento_evento"  id="form_descuento_evento"  style="height:200px " >{descuento_evento} </textarea> 
	</div>
	<div class="label_fieldset">
		<label>Pesta&ntilde;a REQUISITOS DE POSTULACI&oacute;N de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <textarea class="form_noticia"  type="text"   name="form_requisitos"  id="form_requisitos"  style="height:200px " >{requisitos} </textarea> 
	</div>
	<div class="label_fieldset">
		<label>Pesta&ntilde;a PLAN DE ESTUDIO de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <textarea class="form_noticia"  type="text"   name="form_plan_estudio"  id="form_plan_estudio"  style="height:200px " >{plan_estudio} </textarea> 
	</div>
	<div class="label_fieldset">
		<label>Pesta&ntilde;a PERFIL DE EGRESO de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <textarea class="form_noticia"  type="text"   name="form_perfil_egreso"  id="form_perfil_egreso"  size="100" >{perfil_egreso} </textarea> 
	</div>
	<div class="label_fieldset">
		<label>Modalidad de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <input class="form-control"  type="text"   name="form_modalidad_evento"  id="form_modalidad_evento"  value="{modalidad_evento}" />
	</div>
	<div class="label_fieldset">
		<label>Lugar de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
			<input class="form-control"  type="text"   name="form_lugar_curso"  id="form_lugar_curso"  value="{lugar_curso}" />
	</div>
	<div class="label_fieldset">
		<label>Dirigido a de diplomado y magister:</label>
	</div>
	<div class="fieldset_campos">
        <textarea class="form_noticia"  type="text"   name="form_dirigido"  id="form_dirigido"  style="height:200px " >{dirigido} </textarea> 
	</div>
	
	 
	<!-- START BLOCK : bloque_sitios_usuarios -->
	{contenido}
	<!-- END BLOCK : bloque_sitios_usuarios -->
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>


 


<input type="hidden" name="id_noticia_nuevo" value="{id_noticia_nuevo}" />
<input type="hidden" name="form_time_ingreso" value="{fecha_ingreso}" />
<input type="hidden" name="form_usuario" value="{usuario}" />

<script type="text/javascript">
	
document.main.id_item.value = '{id_item}';
function editElement()
{      
	/*
	if(document.main.form_tipo.value == 'noticia' && trim(document.main.form_imagen.value) == '')
	{
		alert('Debe ingresar imagen principal');
		return false;
	}
	if(!validacionCampoTextoSimple('form_titulo'))
	{
		return false;
	}   
	if(!validacionCampoTextoSimple('form_noticia'))
	{
		return false;
	}   
	if(!validacionCampoTextoSimple('form_autor'))
	{
		return false;
	}   
	if(!validacionCampoTextoSimple('form_fecha'))
	{
		return false;
	}  
	*/
	<!-- START BLOCK : bloque_sitios_usuarios_validacion -->
	{contenido}
	<!-- END BLOCK : bloque_sitios_usuarios_validacion -->
	 process('{opcion_modulo}|guardar',0);	  
}
</script>
{tag_volver}