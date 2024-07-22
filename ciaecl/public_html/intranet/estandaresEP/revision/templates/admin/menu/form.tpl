
{tag_volver}
<div class="fieldset_title">{caso_form} Menú</div>
	 
<fieldset>
<div>
<label>Nombre Menu</label><br />
<input type="text" name="menu"  value="{menu}"  />
</div>

<div>
<label>Opci&oacute;n</label><br />
<input  type=text name='opcion' value='{opcion}'   title='Ingrese opci&oacute;n'   >
</div>

<div>
<label>Texto Explicativo</label><br />
<input  type=text name='texto' value='{texto}' size=20 title='Ingrese el texto explicativo'   >
</div>

<div>
<label>Orden Relativo a sus similares</label><br />
 <SELECT id="orden" NAME="orden"    ><OPTION VALUE="0"><-- Seleccione Orden --> </OPTION>	
  <!-- START BLOCK : lista_orden_item -->
  	<OPTION VALUE="{list_item_valor}" {list_item_selected} >{list_item_texto}</OPTION>
  <!-- END BLOCK : lista_orden_item -->
		 			 	</SELECT></td>
</div>

<div>
<label>Vista</label><br />
 <SELECT id="vista" NAME="vista" SIZE=""   ><OPTION VALUE="0"><-- Seleccione Vista --> </OPTION>	
  <!-- START BLOCK : lista_vista_item -->
  	<OPTION VALUE="{list_item_valor}" {list_item_selected} >{list_item_texto}</OPTION>
  <!-- END BLOCK : lista_vista_item -->
		 	 </SELECT> 
</div>
<div>
<label>Menu Padre</label><br />
 <SELECT id="menu_padre" NAME="menu_padre" SIZE=""   ><OPTION VALUE="0">Menú Raíz </OPTION>	
  <!-- START BLOCK : lista_menu_padre_item -->
  	<OPTION VALUE="{list_item_valor}" {list_item_selected} >{list_item_texto}</OPTION>
  <!-- END BLOCK : lista_menu_padre_item -->
		 	 </SELECT> 
</div>

<div>
<label>Tipo Menu</label><br />
 <SELECT id="tipo_archivo" NAME="tipo_archivo" SIZE=""   ><OPTION VALUE="0"><-- Seleccione Tipo Menú --> </OPTION>	
  <!-- START BLOCK : lista_tipo_menu_item -->
  	<OPTION VALUE="{list_item_valor}" {list_item_selected} >{list_item_texto}</OPTION>
  <!-- END BLOCK : lista_tipo_menu_item -->
  </SELECT></div>

<div>
<label>Archivo</label><br />
<input  type=text name='archivo' value='{archivo}' size=20 title='Ingrese el nombre del archivo'   >
</div>

<div>
<label>Permiso Usuario General</label><br />
<input type=checkbox name='permisoSel[]' value='0' onclick="" {list_todos_permisos_checked}  > Menu para todo P&uacute;blico
</div>

<div>
<label>
Permisos Particulares Usuarios</label><br />
  <!-- START BLOCK : lista_permiso_item -->
  	<input type=checkbox name='permisoSel[]' value='{list_item_valor}'  {list_item_disabled}   {list_item_checked} >{list_item_texto} <br />
  <!-- END BLOCK : lista_permiso_item -->

	</div>

<div>
<label>
Texto Plano <br /> <textarea name='body_contenido' cols=20 rows=25>{body_contenido}</textarea>


 
<div>
<label>Publicar</label><br />
<input type="radio" name="publicar"  class="inputcheckbox" value="0" {no_publicar_checked}/>No Publicar
<input type="radio" name="publicar"  class="inputcheckbox" value="1" {publicar_checked}  />Publicar
</div>
 
<button onclick="javascript:guardarItem();" type="button" title="Guardar"><span>Guardar</span></button> 
<button onclick="javascript:process('',1);" type="button" title="Cancelar"><span>Cancelar</span></button> 
</fieldset> 

{tag_volver}
 
<input type="hidden" name="id_item" value="{id_item}">

<script>
function guardarItem()
{	 
 
	if(isEmpty(document.main.menu.value))
	{
		alert('Debe ingresar el nombre menu');
		document.main.menu.focus();
		return false;
	}
	if(isEmpty(document.main.opcion.value))
	{
		alert('Debe ingresar la opcion menu');
		document.main.opcion.focus();
		return false;
	} 
	if(isEmpty(document.main.archivo.value) && isEmpty(document.main.body_contenido.value))
	{
		alert('Debe ingresar el nombre del archivo del menu o texto simple');
		return false;
	}
	else
	{
		if(!isEmpty(document.main.archivo.value) && document.main.tipo_archivo.value == 0)
		{
			alert('Debe seleccionar el tipo de menu');
			document.main.tipo_archivo.focus();
			return false;
		}
	} 
	if(confirm('¿Reviso que los permisos de accesos esten correctos?'))
	{
		process('guardar',1);
	}
}
</script>