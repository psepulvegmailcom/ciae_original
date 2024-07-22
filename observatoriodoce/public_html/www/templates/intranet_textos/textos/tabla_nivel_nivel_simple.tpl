<div style=" padding: 10px 0 10px 0">{descripcion}

 
<!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_ayuda_simple.tpl -->
</div>

<table border="0" style="width:99%; border:1px solid #cccccc; " cellpadding="0" cellspacing="0">
	<tr> 
		<td style="border:1px solid #cccccc; width:25%; "><input type="radio" name="nivel"  value="1"> <strong>Nivel 1</strong></td>
		<td style="border:1px solid #cccccc; width:25%; "><input type="radio" name="nivel"  value="2"> <strong>Nivel 2</strong></td>
		<td style="border:1px solid #cccccc; width:25%; "><input type="radio" name="nivel"  value="3"> <strong>Nivel 3</strong></td>
		<td style="border:1px solid #cccccc; width:25%; "><input type="radio" name="nivel"  value="4"> <strong>Nivel 4</strong></td>
	</tr>
	<tr>
	
		<td style="border:1px solid #cccccc; text-align:left ">
		<p> 
		{nivel_1}
		</p>
		<!-- START BLOCK : tabla_criterio_nivel_ayuda_nivel_1 -->
		<!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_ayuda_simple.tpl -->
		<!-- END BLOCK : tabla_criterio_nivel_ayuda_nivel_1 -->
		
		
		</td><td style="border:1px solid #cccccc; ">
		
		<p> 
		{nivel_2}
		</p>
		
		<!-- START BLOCK : tabla_criterio_nivel_ayuda_nivel_2 -->
		<!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_ayuda_simple.tpl -->
		<!-- END BLOCK : tabla_criterio_nivel_ayuda_nivel_2 -->
		</td>
		<td style="border:1px solid #cccccc; ">
		
		<p> 
		{nivel_3}
		</p> 
		
		<!-- START BLOCK : tabla_criterio_nivel_ayuda_nivel_3 -->
		<!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_ayuda_simple.tpl -->
		<!-- END BLOCK : tabla_criterio_nivel_ayuda_nivel_3 -->
		
		</td>
		<td style="border:1px solid #cccccc; text-align:left ">
		
		<p> 
		<div style="text-align:left ">{nivel_4}</div>
		</p>
		
		
		<!-- START BLOCK : tabla_criterio_nivel_ayuda_nivel_4 -->
		<!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_ayuda_simple.tpl -->
		<!-- END BLOCK : tabla_criterio_nivel_ayuda_nivel_4 -->
		
		
		</td>
	</tr> 
</table>
 
<!-- INCLUDE BLOCK : www/templates/intranet_textos/textos/tabla_nivel_guardar.tpl -->