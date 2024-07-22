<!-- ESTILOS -->
<!-- INCLUDE BLOCK : www/templates/web/css_header_biblioteca.tpl -->
<div class="wrapper">

    <!-- INCLUDE BLOCK : www/templates/web/biblioteca_formulario.tpl -->

    <!-- START BLOCK : bloque_elemento_general -->
    <!-- INCLUDE BLOCK : www/templates/web/resultado_busqueda_recurso.tpl -->
    <!-- END BLOCK : bloque_elemento_general -->

    <!-- START BLOCK : bloque_no_elemento -->
    <center>{langSite_general_no_hay_elementos}</center>
    <!-- END BLOCK : bloque_no_elemento -->

    <!-- START BLOCK : bloque_home_recursos_general_pie -->

    <section id="destacados">
        <div class="container">
            <div class="row titulo-seccion-destacados">
                <div class="col-12 col-md-7 mx-auto">
                    <h2 class="title-section-home text-center">Destacados</h2>
                </div>
            </div>
            <div class="row grid" id="container--boxes-featured">
                <div class="grid-sizer col-1"></div>
                <!-- START BLOCK : bloque_home_recursos -->
                <!-- START BLOCK : bloque_home_recursos_uno -->
                <div class="col-12 col-md-6 col-lg-4 grid-item">
                    <div class="container--info-featured col-height-1">
                        <figure>
                            <a href="index.php?page=view_recursos_ciae&id={id_recurso}&langSite={langSiteEspecial_seleccionado}"><img src="imageview.php?image=recursos/{imagen}&texto={imagen_bajada}" /></a>
                        </figure>
                        <h2>
                            <a href="index.php?page=view_biblioteca_digital&id={id_recurso}&langSite={langSiteEspecial_seleccionado}">{titulo}</a>
                        </h2>
                    </div>
                </div>
                <!-- END BLOCK : bloque_home_recursos_uno -->
                <!-- START BLOCK : bloque_home_recursos_dos -->
                <div class="col-12 col-md-6 col-lg-4 grid-item">
                    <div class="container--info-featured col-height-2">
                        <figure>
                            <a href="index.php?page=view_recursos_ciae&id={id_recurso}&langSite={langSiteEspecial_seleccionado}"><img src="imageview.php?image=recursos/{imagen}&texto={imagen_bajada}" /></a>
                        </figure>
                        <h2>
                            <a href="index.php?page=view_biblioteca_digital&id={id_recurso}&langSite={langSiteEspecial_seleccionado}">{titulo}</a>
                        </h2>
                    </div>
                </div>
                <!-- END BLOCK : bloque_home_recursos_dos -->
                <!-- START BLOCK : bloque_home_recursos_generico -->
                <div class="col-12 col-md-6 col-lg-2 grid-item">
                    <div class="container--info-featured col-height-2">
                        <figure>
                            <a href="index.php?page=view_recursos_ciae&id={id_recurso}&langSite={langSiteEspecial_seleccionado}"><img src="imageview.php?image=recursos/{imagen}&texto={imagen_bajada}" /></a>
                        </figure>
                        <h2>
                            <a href="index.php?page=view_biblioteca_digital&id={id_recurso}&langSite={langSiteEspecial_seleccionado}">{titulo}</a>
                        </h2>
                    </div>
                </div>
                <!-- END BLOCK : bloque_home_recursos_generico -->
                <!-- END BLOCK : bloque_home_recursos -->
            </div>
        </div>
    </section>

    <section id="publicaciones-academicas">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="site-title">Publicaciones científicas</h2>
                </div>
                <div class="col-12">
                    <div class="owl-carousel owl-theme" id="container--carousel">
                        <!-- START BLOCK : bloque_home_publicaciones -->
                        <div class="item">
                            <div class="box--info-item">
                                <h4 class="category">Publicación</h4>
                                <h2 class="title"><a href="https://doi.org/{doi}" target="_blank">{titulo}</a></h2>
                                <a href="https://doi.org/{doi}" class="view-more" target="_blank">Ver publicaci&oacute;n >></a>
                            </div>
                        </div>
                        <!-- END BLOCK : bloque_home_publicaciones -->
                    </div>
                </div>
                <div class="col-12 text-center">
                    <a href="index.php?langSite=es&page=view_publicaciones" class="btn btn-warning">Ver todas las publicaciones</a>
                </div>
            </div>
        </div>
    </section>

    <section id="categorias">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 box--category-info">
                    <a href="index.php?langSite=es&page=view_biblioteca_digital&buscador_tipo=Dossier" class="d-flex align-items-center">
                        <div>
                            <figure><img src="www/style/bib/images/dossier.jpg" /></figure>
                            <h2 class="title-category">Dossier</h2>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 box--category-info">
                    <a href="index.php?langSite=es&page=view_biblioteca_digital&buscador_tipo=Didactico" class="d-flex align-items-center">
                        <div>
                            <figure><img src="www/style/bib/images/interactivos-infografias.jpg" /></figure>
                            <h2 class="title-category">Recursos did&aacute;cticos</h2>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 box--category-info">
                    <a href="index.php?langSite=es&page=view_biblioteca_digital&buscador_tipo=Foco" class="d-flex align-items-center">
                        <div>
                            <figure><img src="www/style/bib/images/boletines.jpg" /></figure>
                            <h2 class="title-category">Boletines En Foco</h2>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 box--category-info">
                    <a href="index.php?langSite=es&page=view_biblioteca_digital&buscador_tipo=Documentos" class="d-flex align-items-center">
                        <div>
                            <figure><img src="www/style/bib/images/documentos-informes.jpg" /></figure>
                            <h2 class="title-category">Documentos de Trabajo e Informes</h2>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 box--category-info">
                    <a href="index.php?langSite=es&page=view_biblioteca_digital&buscador_tipo=Multimedia" class="d-flex align-items-center">
                        <div>
                            <figure><img src="www/style/bib/images/videos.jpg" /></figure>
                            <h2 class="title-category">Videos</h2>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 box--category-info">
                    <a href="index.php?langSite=es&page=view_biblioteca_digital&buscador_tipo=Libros" class="d-flex align-items-center">
                        <div>
                            <figure><img src="www/style/bib/images/libros.jpg" /></figure>
                            <h2 class="title-category">Libros</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- END BLOCK : bloque_home_recursos_general_pie -->
</div>
<!-- INCLUDE BLOCK : www/templates/web/script_biblioteca_footer.tpl -->
