   <h1 class="title--despliegue text-center">{titulo}  /{tipo}</h1>


        <div class="imagen-documento">
			<!-- START BLOCK : bloque_elemento_imagen -->
			<!-- START BLOCK : bloque_elemento_imagen_detalle -->
          <figure>
			<img src="imageview.php?image=recursos/{imagen}&texto={imagen_bajada}" />
          </figure>
			<!-- END BLOCK : bloque_elemento_imagen_detalle -->
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
