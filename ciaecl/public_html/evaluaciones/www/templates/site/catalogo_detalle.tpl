 

<div>

<div style="height:26px; border-bottom:2px #333333 solid; margin-bottom:5px;font-size:12px;">
	<div style="float:left; position:relative; width:300px; height:auto" >
	<strong style="text-transform:uppercase; font-size:120%">{producto}</strong> <font style="font-size:80%; text-transform:uppercase;">{sufijo}</font> 
	</div>

	<div style=" text-transform:uppercase;float: right; position:relative; width:300px;font-size:12px; text-align:right; font-size:80%; height:auto" >
	[CÓDIGO] <strong>{codigo}</strong> [PRECIO] <strong>{precio}</strong>
	
	</div>
	</div>
<div id='detalle_producto_foto' style="float:left; position:relative; width:280px; min-height: 500px;font-size:12px; text-align:center;">
<a href="docs/images/productos/{sufijo}.jpg" target="_blank"><img src="imageview.php?image=productos/{sufijo}.jpg"  style="max-height:300px; max-width:200px;"  width="200px"></a><br>
<!--{color}-->
<!-- START BLOCK : bloque_catalogo_detalle_tecnologia -->


<div style="border:1px  dotted #333333;  background:#BBBBBB; width:250px; margin:40px 2px 2px 2px;font-size:12px; text-align: justify; padding:4px;" >
<strong>[TECNOLOGIA]</strong><BR>{tecnologia}
</div>

</div>
<!-- END BLOCK : bloque_catalogo_detalle_tecnologia --> 
</div>
<div id='detalle_producto_descripcion' style="float: right; position:relative; vertical-align:top;font-size:12px; width:320px; min-height: 500px;">
{descripcion}<br><br>
<!-- START BLOCK : bloque_catalogo_detalle_campo -->
 <font style="text-transform: uppercase; font-weight:bold; font-size:12px; ">[{nombre_campo}]</font> &nbsp;<br>{valor_campo}<br><br>
<!-- END BLOCK : bloque_catalogo_detalle_campo --> 
</div>
</div>
