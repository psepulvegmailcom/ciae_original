<div id="seleccionEvaluacionesNoHay"  >
<table class="tabla_noborder_admin"    >
<tr>
<th><big>Elección Seminario</big></th>
</tr>
<tr><td><strong>Ud no se encuentra registrado en ninguna tarea activa.</strong></td></tr>
<tr><td><a href="?page=logout">Salir</a></td></tr>
 </table>

</div>
<div id="seleccionEvaluaciones" style="  ">

<table class="tabla_noborder_admin"    >
<tr>
<th><big>Elección Seminario</big></th>
</tr>
<tr><td><strong>Debe elegir el Seminario que desea trabajar:</strong></td></tr>
<tr><td style="text-align:left ">
<ul>
<!-- START BLOCK : bloque_bloque_eleccion_seminario -->
 <li style="padding-bottom:5px ">
<a href="javascript:setSeminario('{seminario}');">{descripcion}</a>
</li>
<!-- END BLOCK : bloque_bloque_eleccion_seminario -->
</ul>
</td></tr>
</table>
 
</div>
<script>
function setSeminario(seminario)
{
	document.main.seminario.value = seminario;
	process('home',0);
}
<!-- START BLOCK : bloque_bloque_eleccion_seminario_abrir -->
showId('seleccionEvaluaciones');

document.getElementById('seleccionEvaluaciones').style.height 		= '400px';
<!-- END BLOCK : bloque_bloque_eleccion_seminario_abrir -->
<!-- START BLOCK : bloque_bloque_eleccion_seminario_nohay_abrir -->
showId('seleccionEvaluacionesNoHay');

document.getElementById('seleccionEvaluacionesNoHay').style.height 		= '400px';
<!-- END BLOCK : bloque_bloque_eleccion_seminario_nohay_abrir -->
</script>
