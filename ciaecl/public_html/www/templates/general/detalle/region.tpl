
		<!-- START BLOCK : region_default -->
		<option value=""  selected="selected" >Seleccione Regi&oacute;n</option>
		<!-- END BLOCK : region_default -->

		<!-- START BLOCK : region_js_default -->
		<option value=""  selected="selected" onclick="javascript:{region_js};" >Seleccione Regi&oacute;n</option>
		<!-- END BLOCK : region_js_default -->		
		
		<!-- START BLOCK : region -->
		<option value="{region_id}" {selected}>{region_nombre}</option>
		<!-- END BLOCK : region -->
		<!-- START BLOCK : region_js -->
		<option value="{region_id}" {selected} onchange="javascript:alert('no funciona');{region_js};">{region_nombre}</option>
		<!-- END BLOCK : region_js -->