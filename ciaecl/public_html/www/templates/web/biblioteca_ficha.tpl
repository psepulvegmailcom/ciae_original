    <script type="text/javascript">
	changeTitle('{titulo}');
    </script>

<!-- INCLUDE BLOCK : www/templates/web/css_header_biblioteca.tpl -->

 <div class="wrapper">
    <link rel="stylesheet" href="assets/library/bootstrap-4.3.1-dist/css/bootstrap.min.css" type="text/css" media="screen">

     <!-- INCLUDE BLOCK : www/templates/web/biblioteca_formulario.tpl -->

    <section id="container--info-site">
      <div class="container">



	<!-- START BLOCK : bloque_elemento_general_recurso -->
		<div class="imagen-documento">
			<!-- START BLOCK : bloque_elemento_imagen -->

          <figure>
            <img src="imageview.php?image=recursos/{imagen}&texto={imagen_bajada}" />
          </figure>

			<!-- END BLOCK : bloque_elemento_imagen -->
        </div>
        <div class="box--info-despliegue">
          <div class="row mb-5">
            <div class="col-12 col-md-3">
              <div class="container--info-despliegue">
                <p>Autor: {autor}</br>
                {extra}</p>
              </div>
            </div>
            <div class="col-12 col-md-7">
              <div class="container--info-despliegue">
                <p><strong>RESUMEN:</strong> {bajada}</p>
              </div>
            </div>
            <div class="col-12 col-md-2 text-center">

				<!-- START BLOCK : bloque_elemento_archivos -->
              <h4 class="title-box-2">Disponible:</h4>
              <!--a href="#" class="d-inline-block m-1"><img src="images/icon-document.jpg" /></a-->
              <a href="download.php?file=recursos/{archivo}" class="d-inline-block m-1"><img src="www/style/bib/images/icon-pdf.jpg" /></a>
              <!--a href="#" class="d-inline-block m-1"><img src="images/icon-ppt.jpg" /></a-->
              <!--a href="#" class="d-inline-block m-1"><img src="images/icon-jpg.jpg" /></a-->
				<!-- END BLOCK : bloque_elemento_archivos -->

            </div>
          </div>
        </div>
	 	 <!-- END BLOCK : bloque_elemento_general_recurso -->

		  <!-- START BLOCK : bloque_elemento_general_multimedia -->
				<!-- INCLUDE BLOCK : www/templates/web/biblioteca_ficha_multimedia.tpl -->
		  <!-- END BLOCK : bloque_elemento_general_multimedia -->

	 	  <!-- START BLOCK : bloque_elemento_general_interactivo -->
				<!-- INCLUDE BLOCK : www/templates/web/biblioteca_ficha_interactivo.tpl -->
		  <!-- END BLOCK : bloque_elemento_general_interactivo -->

	 	  <!-- START BLOCK : bloque_elemento_general_documento -->
				<!-- INCLUDE BLOCK : www/templates/web/biblioteca_ficha_documento.tpl -->
		  <!-- END BLOCK : bloque_elemento_general_documento -->

	 	  <!-- START BLOCK : bloque_elemento_general_libro -->
				<!-- INCLUDE BLOCK : www/templates/web/biblioteca_ficha_libro.tpl -->
		  <!-- END BLOCK : bloque_elemento_general_libro -->

	 	  <!-- START BLOCK : bloque_elemento_general_foco -->
				<!-- INCLUDE BLOCK : www/templates/web/biblioteca_ficha_foco.tpl -->
		  <!-- END BLOCK : bloque_elemento_general_foco -->

	 	  <!-- START BLOCK : bloque_elemento_general_guia -->
				<!-- INCLUDE BLOCK : www/templates/web/biblioteca_ficha_guia.tpl -->
		  <!-- END BLOCK : bloque_elemento_general_guia -->

      <!-- START BLOCK : bloque_elemento_general_dossier -->
        <!-- INCLUDE BLOCK : www/templates/web/biblioteca_ficha_dossier.tpl -->
      <!-- END BLOCK : bloque_elemento_general_dossier -->

      </div>
    </section>

  </div>





<!-- INCLUDE BLOCK : www/templates/web/script_biblioteca_footer.tpl -->
