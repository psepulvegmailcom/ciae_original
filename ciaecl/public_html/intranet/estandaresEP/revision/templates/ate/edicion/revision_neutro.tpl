<input type='hidden' name='orden_revisiones_bloques_prefijo' >
<input type='hidden' name='orden_revisiones_bloques_prefijo_particular' >

<div style="text-align:right; padding-right:10px"><a href="javascript:process('',1)">&lt;&lt; Volver </a></div>
 
{resumen_revision}

{contenido_revision}

<br /> 
<div style="text-align:right; padding-right:10px"><a href="javascript:process('',1)">&lt;&lt; Volver</a></div>
<br /><br /> 
 
<script>
function revisarValidarDatos(caso,id_caso)
{
	document.main.id_caso.value 	= id_caso;
	document.main.caso.value 		= caso; 
	process('{tipo_revision}',1);
}
</script>

<!-- INCLUDE BLOCK : ../templates/ate/edicion/revison_bloque_abrir.tpl -->