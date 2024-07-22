 
<!-- INCLUDE BLOCK : www/templates/intranet_textos/reportes/alternativa.tpl -->


<div style="padding:15px "><a href="docs/tmp/{archivo_tmp}">Descarga tabla</a></div>



<div style="overflow:scroll; width:700px ; height:400px" id='repote_scroll'>
{reporte}
</div>
<script>
var W 	= getWidthWindow()-400;
document.getElementById('repote_scroll').style.width = W+'px';
</script>