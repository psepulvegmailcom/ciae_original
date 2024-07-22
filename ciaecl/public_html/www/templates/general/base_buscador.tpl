 
    <input type="hidden" name="tipo_formulario" value="formulario">
    <input type="hidden" name="busqueda" value="">
    <input type="hidden" name="total_listado" value="">
    <input type="hidden" name="busca_rangoNombre" value="">
    <input type="hidden" name="busca_areaProyecto" value="">
    <input type="hidden" name="tipoDoc" value="">
    <input type="hidden" name="page" value="">
    <input type="hidden" name="inicia_busca" value="">
    <input type="hidden" name="seteaTipo" value="">

  	<script type="text/javascript">
 
		<!-- START BLOCK : bloque_asignacion_valores_formulario -->	
		setValue('{variable}','{valor}');
		selectValue('{variable}','{valor}');
		<!-- END BLOCK : bloque_asignacion_valores_formulario -->
 
 
		 function buscarPaginamiento(pagina)
		 {
			 document.main.pagina.value = pagina; 
			 enviarFormulario();
		 }
		 
		 function buscadorFormulario()
		 { 
		 	document.main.tipo_formulario.value = "formulario"; 
			document.main.busca_rangoNombre.value = "";
			document.main.tipoDoc.value = ""; 
			document.main.pagina.value = "";
			document.main.page.value = ""; 
			document.main.seteaTipo.value = "1"; 
			main.action = "index.php?langSite=es&page=view_publicaciones&busqueda_flag=&busca_Autor_id=";   
			main.submit();  
		 }
		 
		 function buscadorFormularioNoticias()
		 { 
		 	document.main.tipo_formulario.value = "formulario"; 
			document.main.busca_rangoNombre.value = "";
			document.main.tipoDoc.value = ""; 
			document.main.pagina.value = "";
			document.main.page.value = ""; 
			document.main.seteaTipo.value = "1"; 
			main.action = "index.php?langSite=es&page=view_noticias&busqueda_flag=&busca_Autor_id=";   
			main.submit();  
		 }
		
		
		 function buscadorFormularioRecursos()
		 { 
		 	document.main.tipo_formulario.value = "formulario"; 
			document.main.busca_rangoNombre.value = "";
			document.main.tipoDoc.value = ""; 
			document.main.pagina.value = "";
			document.main.page.value = ""; 
			document.main.seteaTipo.value = "1"; 
			main.action = "index.php?langSite=es&page=view_biblioteca_digital&busqueda_flag=&busca_Autor_id=";   
			main.submit();  
		 }		
				
		 
		 function buscardorPaginaRango(tipo_busqueda,rango)
		 {
			 document.main.tipo_formulario.value = tipo_busqueda; 
			 document.main.busca_rangoNombre.value = rango;
			 document.main.pagina.value = ""; 
			 main.action = "index.php?langSite=es&page=view_publicaciones&busqueda_flag=&busca_Autor_id=";   
			 main.submit(); 
		 }
		 
		 function buscardorPaginaNube(palabra)
		 {
			 document.main.tipo_formulario.value = "formulario"; 
			 document.main.busca_palabra.value = palabra;
			 document.main.pagina.value = ""; 
			 enviarFormulario();
		 }
		 
		 	 
		 function buscadorFormularioPublArea(area)
		 {
			 document.main.tipo_formulario.value = "formulario";
			 document.main.busca_Anno.value = "";
			 document.main.busca_Area.value = area;
			 document.main.busca_rangoNombre.value = "";
			 document.main.busca_palabra.value = ""; 
			 document.main.pagina.value = ""; 
			 main.action = "index.php?langSite=es&page=view_publicaciones&busqueda_flag=&busca_Autor_id=";   
			 main.submit(); 
		 }
		 
		 		 
		function buscadorFormularioProYearOtraDirec(year)
		 { 
			document.main.tipo_formulario.value = "formulario";
			document.main.busca_Anno.value = year;
			document.main.busca_rangoNombre.value = "";
			document.main.busca_areaProyecto.value = ""; 
			document.main.busca_palabra.value = ""; 
			document.main.pagina.value = "";
			document.main.inicia_busca.value = "1"; 
			main.action = "index.php?langSite=es&page=view_proyectos&busqueda_flag=&busca_Autor_id=";   
			main.submit();   

		 }
		 
		function buscadorFormularioProWordOtraDirec()
		 { 
		 	document.main.tipo_formulario.value = "formulario";
			document.main.busca_rangoNombre.value = "";
			document.main.busca_areaProyecto.value = ""; 
			document.main.busca_Anno.value = ""; 
			document.main.pagina.value = "";
			document.main.inicia_busca.value = "1";   
			main.action = "index.php?langSite=es&page=view_proyectos&busqueda_flag=&busca_Autor_id=";   
			main.submit(); 
		 }
		
		function buscadorFormularioRecWordOtraDirec()
		 { 
		 	document.main.tipo_formulario.value = "formulario";
			document.main.pagina.value = "";
			document.main.inicia_busca.value = "1";   
			main.action = "index.php?langSite=es&page=view_recursos&busqueda_flag=&busca_Autor_id=";   
			main.submit(); 
		 }
					 
		 function buscadorFormularioProAreaOtraDirec(area)
		 {
			 document.main.tipo_formulario.value = "formulario";
			 document.main.busca_Anno.value = "";
			 document.main.busca_areaProyecto.value = area;
			 document.main.busca_rangoNombre.value = "";
			 document.main.busca_palabra.value = ""; 
			 document.main.pagina.value = "";
			 document.main.inicia_busca.value = "1";  
			main.action = "index.php?langSite=es&page=view_proyectos&busqueda_flag=&busca_Autor_id=";   
			main.submit(); 
		 }
		 
		 function buscardorPaginaProRangoOtraDirec(tipo_busqueda,rango)
		 {
			 document.main.tipo_formulario.value = tipo_busqueda; 
			 document.main.busca_rangoNombre.value = rango;
			 document.main.busca_areaProyecto.value = "";
			 document.main.busca_Anno.value = "";
			 document.main.busca_palabra.value = ""; 
			 document.main.pagina.value = "";
			 document.main.inicia_busca.value = "1";   
			main.action = "index.php?langSite=es&page=view_proyectos&busqueda_flag=&busca_Autor_id=";   
			main.submit(); 
		 }
		 
	</script>