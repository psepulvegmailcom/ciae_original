  <!-- INCLUDE BLOCK : www/templates/web/css_header_biblioteca.tpl -->   

	

    
    <section id="container--info-site">
      <div class="container">
		   <!-- START BLOCK : bloque_valores_busqueda --> 
        <h3 class="title--resultado-busqueda text-center">Resultados de b&uacute;squeda para <strong><em>{busca_palabra} </em></strong><br /> categor&iacute;a {buscador_tipo}</h3>
		   <!-- END BLOCK : bloque_valores_busqueda --> 
        <div class="row mb-5 resultado-busqueda">
		<!-- START BLOCK : bloque_imagen_listado_recurso -->
      <!-- ESTE BLOQUE TRAE EL RESULTADO DEL QUERY A LA VISTA BUSQUEDA DE LA BIBLIOTECA -->
          <div class="col-12 col-lg-6 box--resultado-busqueda">
            <figure class="img-doc-book"><img src="imageview.php?image=recursos/{imagen}&texto={imagen_bajada}" /></figure>
            <div class="container--info-resultado-busqueda">
              <h2><a href="index.php?page=view_biblioteca_digital&id={id_recurso}&langSite={langSiteEspecial_seleccionado}">{titulo}</a></h2>
              <p>{autor}</p>
              <p>{bajada}</p>
            </div>
            <div class="text-right">
              <a href="index.php?page=view_biblioteca_digital&id={id_recurso}&langSite={langSiteEspecial_seleccionado}" class="btn btn-yellow">Ver m&aacute;s</a>
            </div>
          </div>
      <!-- END BLOCK : bloque_imagen_listado_recurso --> 	
      <!-- START BLOCK : bloque_elemento -->     
          <div class="col-12 col-lg-6 box--resultado-busqueda">

            <div class="container--info-resultado-busqueda">
              <h2><a href="index.php?page=view_biblioteca_digital&id={id_recurso}&langSite={langSiteEspecial_seleccionado}">{titulo}</a></h2>
              <p>{bajada}</p>
            </div>
            <div class="text-right">
              <a href="index.php?page=view_biblioteca_digital&id={id_recurso}&langSite={langSiteEspecial_seleccionado}" class="btn btn-yellow">Ver m&aacute;s</a>
            </div>
          </div>
      <!-- END BLOCK : bloque_elemento --> 
      <!-- START BLOCK : bloque_elemento_dossier -->     
			<div class="col-12 col-lg-6 box--resultado-busqueda">
          <figure class="img-doc-book"><img src="imageview.php?image=recursos/{imagen}&texto={imagen_bajada}" /></figure>
            <div class="container--info-resultado-busqueda">
              <h2><a href="index.php?page=view_noticias&id={link_externo}&langSite={langSiteEspecial_seleccionado}" target="_blank">{titulo}</a></h2>
              <p>{bajada}</p>
            </div>
            <div class="text-right">
              <a href="index.php?page=view_noticias&id={link_externo}&langSite={langSiteEspecial_seleccionado}" class="btn btn-yellow" target="_blank">Ir al Dossier</a>
            </div>
          </div>
      <!-- END BLOCK : bloque_elemento_dossier --> 	
        </div>
      <!-- START BLOCK : bloque_elemento_paginacion -->
        {enlacePie}	
        <!-- END BLOCK : bloque_elemento_paginacion -->
      </div>
    </section>
	
	
<!-- INCLUDE BLOCK : www/templates/web/script_biblioteca_footer.tpl -->  