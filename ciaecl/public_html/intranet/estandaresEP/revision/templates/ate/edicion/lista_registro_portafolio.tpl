
				<!-- INCLUDE BLOCK : ../templates/ate/registro/lista_registro_portafolio.tpl -->

 <script>
	var x=1;
	var div_boton_editar = 'portafolio_lista_editar_'+x;
	var div_boton_borrar = 'portafolio_lista_borrar_'+x;
	while(document.getElementById(div_boton_editar))
	{ 
		hiddenId(div_boton_editar);
		hiddenId(div_boton_borrar);
		x=x+1;
		div_boton_editar = 'portafolio_lista_editar_'+x;
		div_boton_borrar = 'portafolio_lista_borrar_'+x;
	}
 </script>