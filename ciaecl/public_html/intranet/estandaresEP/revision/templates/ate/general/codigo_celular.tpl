<script>
	function cambiarCodigoCelular(variable_ate_no_codigo_celular)
	{
		 var e = searchElement(variable_ate_no_codigo_celular);
	 	e.value = document.main.ate_no_codigo_celular.value;
	} 
</script>
<select name="ate_no_codigo_celular"  style="width:60px; "  onchange='javascript:cambiarCodigoCelular(variable_ate_no_codigo_celular);'>
<!-- INCLUDE BLOCK : ../templates/ate/general/codigo_celular_option.tpl -->
</select>