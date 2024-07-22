<ul>
<li><a href="javascript:DescargaReporte('reporte_revisiones_definitivas');">Descargar de reporte de revisiones definitivas</a></li>
<li><a href="javascript:DescargaReporte('reporte_revisiones_usuario');">Descargar de reporte de revisiones por usuario</a></li>
<li><a href="javascript:DescargaReporte('reporte_revisiones_inconsistencias');">Descargar de reporte de inconsistencias</a></li>

</ul> 

<script type="text/javascript">
function DescargaReporte(caso)
{ 
	process('view_reporte_general|'+caso+'|',0);	 
}
</script>