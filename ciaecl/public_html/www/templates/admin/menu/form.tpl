 <script src='www/libjs/whizzywig.js' type='text/javascript'></script> 
 
<!--{tag_volver}-->
<div class="fieldset_title">{caso_form} Men&uacute;</div>
	 
<fieldset style="background:#FFFFFF;"> 
<center>
<input type="button" class="buttontype" onclick="javascript:guardarItem();" title="Guardar Elemento" value="Guardar Elemento" />
<input type="button" class="buttontype" onclick="javascript:process('',1);" title="Cancelar" value="Cancelar" />
</center><br /><br />
<div>
<label>Opci&oacute;n</label><br />
<input  type='text' class='inputtext'  name='opcion' value='{opcion}'   title='Ingrese opci&oacute;n'   >
</div>
 

<div>
<label>Orden Relativo a sus similares</label><br />
 <SELECT id="orden" NAME="orden"  class='inputtext'    ><OPTION VALUE="0"><-- Seleccione Orden --> </OPTION>	
  <!-- START BLOCK : lista_orden_item -->
  	<OPTION VALUE="{list_item_valor}" {list_item_selected} >{list_item_texto}</OPTION>
  <!-- END BLOCK : lista_orden_item -->
		 			 	</SELECT> 
</div>
 <input type="hidden" name="acceso" value="publico" />
<div>
<label>Menu Padre</label><br />
 <SELECT id="menu_padre" NAME="menu_padre" SIZE=""  class='inputtext'    ><OPTION VALUE="0">Men&uacute; Ra&iacute;z </OPTION>	
  <!-- START BLOCK : lista_menu_padre_item -->
  	<OPTION VALUE="{list_item_valor}" {list_item_selected} >{list_item_texto}</OPTION>
  <!-- END BLOCK : lista_menu_padre_item -->
		 	 </SELECT> 
</div>

<div>
<label>Tipo Menu</label><br />
 <SELECT id="tipo_archivo" NAME="tipo_archivo" SIZE=""  class='inputtext'    ><OPTION VALUE="0"><-- Seleccione Tipo Men&uacute; --> </OPTION>	
  <!-- START BLOCK : lista_tipo_menu_item -->
  	<OPTION VALUE="{list_item_valor}" {list_item_selected} >{list_item_texto}</OPTION>
  <!-- END BLOCK : lista_tipo_menu_item -->
  </SELECT></div>

 

 
<div>
<label>Publicar</label><br />
<input type="radio" name="publicar"  class="inputcheckbox" value="0" {no_publicar_checked}/>No Publicar
<input type="radio" name="publicar"  class="inputcheckbox" value="1" {publicar_checked}  />Publicar
</div>
 
 <div style="background:#FFFFFF;" >
 
<label>Contenidos Idiomas<br /> 
</label>
  <!-- START BLOCK : lista_contenido_menu_idioma --> 
   <!-- INICIO FORMULARIO -->
				   <div class="bloque_eventos_publicaciones_fila"></div>
  <img src="cea/images/flags/{menu_lang}.jpg" style="padding:0"  border="0"/><br />
  
<!-- <br /> <strong>Nombre Menu</strong><br />
  <input type="text" name="nombre_{menu_lang}"  class='inputtext' value="{nombre}" />-->
 <br /> <strong>T&iacute;tulo Menu</strong><br />
  <input type="text" name="titulo_{menu_lang}" class='inputtext'  value="{titulo}" />
	<br /><strong>Contenido</strong>  <br /> 
	
	 {texto}   
	
				 <!--  <div class="bloque_eventos_publicaciones_fila"></div>-->
				 
				 <!-- FIN FORMULARIO -->
  <!-- END BLOCK : lista_contenido_menu_idioma -->
 

 
  

<center>
<input type="button" class="buttontype" onclick="javascript:guardarItem();" title="Guardar Elemento" value="Guardar Elemento" />
<input type="button" class="buttontype" onclick="javascript:process('',1);" title="Cancelar" value="Cancelar" />
</center>
</fieldset> 

<!--{tag_volver}-->
 
<input type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

 


function guardarItem()
{	  
	if(isEmpty(document.main.opcion.value))
	{
		alert('Debe ingresar la opcion menu');
		document.main.opcion.focus();
		return false;
	}  
	syncTextarea() ;
	
  <!-- START BLOCK : lista_contenido_menu_idioma_script -->
	/*document.main.texto_{menu_lang}.value = limpiarAcentos(document.main.texto_{menu_lang}.value); */
  <!-- END BLOCK : lista_contenido_menu_idioma_script -->

	process('guardar',1);
	 
}
</script>