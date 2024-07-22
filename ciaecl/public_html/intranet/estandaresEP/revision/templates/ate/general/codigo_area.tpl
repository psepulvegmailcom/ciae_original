<script> 
	function cambiarCodigoArea(variable_codigo)
	{
		var e = searchElement(variable_codigo);
		e.value = document.main.ate_no_codigo_area.value;
	}
</script>
<select name="ate_no_codigo_area"  style="width:60px; "  onchange='javascript:cambiarCodigoArea(variable_ate_no_codigo_area);'>
<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_area_option.tpl -->
</select>