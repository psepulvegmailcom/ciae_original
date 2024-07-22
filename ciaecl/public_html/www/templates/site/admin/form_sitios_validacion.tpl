	var x 		= document.main.elements;
	var seleccionado_algun_sitio = false;	 
	for (var i=0 ; i < x.length ; i++)
	{		
	
		<!-- START BLOCK : bloque_sitios_usuarios_global -->		
		if(x[i].name == 'sitios_id_site[{fila}]' && x[i].checked)
		{
			seleccionado_algun_sitio = true;
			if(x[i].value != 100)
			{
				<!-- START BLOCK : bloque_sitios_usuarios_global_activo --> 			
				if(!validacionCampoTextoSimple("sitios_activo[{fila}]"))
				{
					return false;
				}  
				<!-- END BLOCK : bloque_sitios_usuarios_global_activo -->
				<!-- START BLOCK : bloque_sitios_usuarios_global_destacado --> 
				if(!validacionCampoTextoSimple("sitios_destacado[{fila}]"))
				{
					return false;
				}  
				<!-- END BLOCK : bloque_sitios_usuarios_global_destacado -->
				<!-- START BLOCK : bloque_sitios_usuarios_global_destacado_forzado --> 
				if(!validacionCampoTextoSimple("sitios_destacado_forzado[{fila}]"))
				{
					return false;
				}  
				<!-- END BLOCK : bloque_sitios_usuarios_global_destacado_forzado -->		
				<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo --> 
				if(!validacionCampoTextoSimple("sitios_id_tipo[{fila}]"))
				{
					return false;
				}  
				<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo -->		
				<!-- START BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura --> 
				if(!validacionCampoTextoSimple("sitios_id_tipo_estructura[{fila}]"))
				{
					return false;
				}  
				<!-- END BLOCK : bloque_sitios_usuarios_global_id_tipo_estructura --> 
			}
		}
		<!-- END BLOCK : bloque_sitios_usuarios_global --> 
		if(x[i].value == 100)
		{
			x[i].checked = false;
			if(!seleccionado_algun_sitio)
				x[i].checked = true;
		}
			 
	}  