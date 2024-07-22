<h1 class="title--despliegue text-center">{titulo}  /{tipo}</h1>


           <div class="{div2}">
		<!-- START BLOCK : bloque_elemento_imagen4 -->

            <figure>
              <img src="imageview.php?image=recursos/{foto4}&texto={imagen_bajada}" />
            </figure>

		<!-- END BLOCK : bloque_elemento_imagen4 -->
          </div>

		   <div class="box--info-despliegue">
			  <div class="row mb-5">
				<div class="col-12 col-md-3">
				  <div class="container--info-despliegue">
					<p>Autor: {autor}</br>
					    {editorial}<br />
						{paginas}<br />
						{isbn}<br /></p>
				  </div>
				</div>
				<div class="col-12 col-md-7">
				  <div class="container--info-despliegue">
				  <p> <em>{bajada}</em></p>
				  <p><strong>RESUMEN:</strong> {descripcion}</p>
				  </div>
				</div>

			 <!-- START BLOCK : bloque_elemento_link_externo_guia -->
			  <div class="col-12 col-md-4 col-lg-3 mt-4 mt-lg-0 text-center">
				<a href="{link_externo}" class="btn btn-warning d-block text-uppercase mb-2" target="_blank">Ver Disponibilidad</a>
			  </div>
			 <!-- END BLOCK : bloque_elemento_link_externo_guia -->

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
