


		<!-- INCLUDE BLOCK : www/templates/site/admin/form_header.tpl -->
		
		<fieldset id='formulario_admin'> 
	  
	<div class="fieldset_campos">
		<label>		T&Iacute;tulo </label> 
		<textarea class="inputtext" type="text"   name="form_titulo"  id="form_titulo"  >{titulo}</textarea> 
	</div>
		<div class="fieldset_campos">
		<label>		Resumen </label> 
		<textarea class="inputtext" type="text"   name="form_bajada"  id="form_bajada"  >{bajada}</textarea> 
	</div>
	<div class="label_fieldset">Noticia</div>
		<div class="fieldset_campos"> 
		
	 	{form_noticia_editor}
        <textarea class="form_noticia" type="text"   name="form_noticia"  id="form_noticia"  style="height:200px " >{noticia} </textarea> 
	</div>
    
    
	<div class="fieldset_campos">
		<label>		Fecha </label> 
		<input  class="inputtext" type="text"   name="form_fecha"  readonly="readonly" title="Seleccione la fecha" id="form_fecha"  value="{fecha_html}" maxlength="10" style="width:120px" > <A HREF="#" onClick="cal.select(document.main.form_fecha,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="www/images/buttons/cal.gif" border="0"  title="Seleccione la fecha" /></A>
	</div>
    
    
	<div class="fieldset_campos">
		<label>		 Autor </label> 
		<input  class="inputtext" type="text"   name="form_autor"  id="form_autor"  value="{autor}" maxlength="250"  > 
	</div> 
    
	<div class="fieldset_campos">
		<label>		Tipo  </label> 
		<input  type="radio" name='form_tipo' value="noticia" {checked_tipo_noticia}> Noticia<br>
		<input type="radio" name='form_tipo' value="evento" {checked_tipo_evento}> Evento<br> 
		
	</div>
	<div class="fieldset_campos">
		<label>		Idioma  </label> 
        <div>
		<input  type="radio" name='form_idioma' value="es" {checked_idioma_es}> Espa&ntilde;ol<br>
		<input type="radio" name='form_idioma' value="en" {checked_idioma_en}> Ingl&eacute;s<br> 
		<input type="radio" name='form_idioma' value="nn" {checked_idioma_nn}> Neutro<br> 
		</div>
	</div><div class="fieldset_campos">
		<label>		Estado  </label> 
		<input  type="radio"   name='form_activo' value="1" {checked_activo_1}> Publicado<br>
		<input type="radio" name='form_activo' value="0" {checked_activo_0}> No Publicado<br> 
	</div>
    <div class="fieldset_campos">
		<label>		Destacado Home </label> 
		<input  type="radio" name='form_destacado' value="1" {checked_destacado_1}> Destacado<br>
		<input type="radio" name='form_destacado' value="0" {checked_destacado_0}> No Destacado<br> 
	</div>
    <div class="fieldset_campos">
		<label>		Destacado Home Forzado </label> 
		<input  type="radio" name='form_destacado_forzado' value="1" {checked_destacado_forzado_1}> Destacado<br>
		<input type="radio" name='form_destacado_forzado' value="0" {checked_destacado_forzado_0}> No Destacado<br> 
	</div>

	<div class="fieldset_campos">
		<label>		 Imagen lateral 1 </label>
		 
        <textarea class="inputtext" type="text"   name="form_imagen_bajada"  id="form_imagen_bajada"  >{imagen_bajada}</textarea>  <br />
        <input class="inputtext" type="file" name="form_imagen"  />
		<!-- START BLOCK : bloque_imagen_lateral -->
		<br>
		<img src="imageview.php?image=noticias/{imagen}"  width="150px"  border="0"   /> 
		<input type="checkbox" name="formimagen_elimnar[]" value='imagen'> Eliminar imagen
		<!-- END BLOCK : bloque_imagen_lateral -->	
	</div>
	<div class="fieldset_campos">
		<label>		 Imagen lateral 2 </label> 
		 
        <textarea class="inputtext" type="text"   name="form_imagen2_bajada"  id="form_imagen2_bajada"  >{imagen2_bajada}</textarea>  <br />
        <input class="inputtext" type="file" name="form_imagen2"  /> 
		<!-- START BLOCK : bloque_imagen2_lateral -->
		<br>
		<img src="imageview.php?image=noticias/{imagen}"  width="150px"  border="0"   /> 
		<input type="checkbox" name="formimagen_elimnar[]" value='imagen2'> Eliminar imagen
		<!-- END BLOCK : bloque_imagen2_lateral -->	
	</div>
	<div class="fieldset_campos">
		<label>		 Imagen lateral 3 </label> 
		
        <textarea class="inputtext" type="text"   name="form_imagen3_bajada"  id="form_imagen3_bajada"  >{imagen3_bajada}</textarea>  <br />
        <input class="inputtext" type="file" name="form_imagen3"  />
		<!-- START BLOCK : bloque_imagen3_lateral -->
		<br><br>
		<img src="imageview.php?image=noticias/{imagen}"  width="150px"  border="0"   /> 
		<input type="checkbox" name="formimagen_elimnar[]" value='imagen3'> Eliminar imagen
		<!-- END BLOCK : bloque_imagen3_lateral -->	
	</div>
    
    
	<div class="fieldset_campos">
		<label>		 Galeria de imag&eacute;nes</label>  
        
		
        <!-- START BLOCK : bloque_galeria_archivo -->
		<div id='galeria_{fila}' style="padding: 0 0 20px 20px   ">
		 {fila}.- 
		 <input class="inputtext" type="file" name="form_galeria_{fila}"  /> 
         <!-- START BLOCK : bloque_galeria_archivo_imagen -->
         <img src="imageview.php?image=noticias/{id_item}/{imagen}"  width="80px"  border="0"   />
		 
			<input type="checkbox" name="formimagengaleria_eliminar[]" value='{imagen}'> Eliminar imagen
         <!-- END BLOCK : bloque_galeria_archivo_imagen -->
          
		 </div> 
        <!-- END BLOCK : bloque_galeria_archivo -->
	</div>
    
    
    
	<div class="fieldset_campos">
		<label>		 Link externo </label> 
        
        <!-- START BLOCK : bloque_noticia_link --><br>
			<div id='links_{fila}' style="padding: 20px 0 20px 40px ; text-align:left  ">
			<strong>Link {fila}:</strong><br>
		   <input type="hidden"  name="formlink[tipo][{fila}]" value="{tipo}" 	> 
		    <input type="hidden"  name="formlink[id_link][{fila}]" value="{id_link}" 	> 
			<table style="width:100%; padding-left:30px ">
		   <tr>
		   <td  style="width:90px "> Texto  :</td><td> <input  class="inputtext" type="text"  name="formlink[texto][{fila}]" value="{texto}" maxlength="250"       /> </td>
		   </tr>
			<tr>
		   <td>Url o archivo: </td><td> <input  class="inputtext" type="text"  name="formlink[url][{fila}]" value="{link}" maxlength="250"     /></td>
		   </tr>
		   <tr>
		   <td>
		   Orden: </td><td> <input  class="inputtext" type="text"  name="formlink[orden][{fila}]" value="{orden}{fila}"  maxlength="2" style="width:40px "  /> </td>
		   </tr>
		   <tr>
		   <td>
		   Archivo </td><td><input  class="inputtext" type="file"  name="formlink_file_{fila}"   />  
		   </td></tr>
		       <!-- START BLOCK : bloque_noticia_link_eliminar -->    
			   
		  <!-- <tr>
		   <td colspan="2"><input type="checkbox" name="formlink_eliminar[]" value='{id_link}'> Eliminar link  </td></tr> -->
		       <!-- END BLOCK : bloque_noticia_link_eliminar -->    			   
			   </table>
		   </div>
        <!-- END BLOCK : bloque_noticia_link -->
	</div>
	 
	
	 
 	<button type="button" onClick="javascript:editElement();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>


 



<input type="hidden" name="form_time_ingreso" value="{fecha_ingreso}" />
<input type="hidden" name="form_usuario" value="{usuario}" />

<input  class="inputtext" type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">
 
function editElement()
{     
	if(isEmpty(document.getElementById('form_titulo').value) || isEmpty(document.getElementById('form_noticia').value) || isEmpty(document.getElementById('form_fecha').value) || isEmpty(document.getElementById('form_autor').value))
	{
		alert('Debe los campos basicos del formulario (titulo, noticia, fecha y autor)'); 
		return false;
	}    
	process('{opcion_modulo}|guardar',0);	 
}
</script>
{tag_volver}