        <h1 class="title--despliegue text-center">{titulo}</h1>
        <div class="row mb-5 box--info-despliegue">
          <div class="col-12 order-1">
            <div class="container--box-video embed-responsive embed-responsive-16by9">
              <iframe  src="https://www.youtube.com/embed/{video}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-12 col-md-4 order-3 order-md-2">
            <div class="container--info-despliegue">
              <!--h4>Etiquetas</h4>
              <p><a href="#">Etiqueta 1</a>, <a href="#">etiqueta 2</a>, <a href="#">etiqueta 3</a></p-->
              <h4>Fecha de publicaci&oacute;n</h4>
              <p>{fecha}</p>
            </div>
          </div>
          <div class="col-12 col-md-8 order-2 order-md-3">
            <div class="container--info-despliegue">
				<p><em>{bajada}</em></p>
              <p><strong>Descripci&oacute;n:</strong>{descripcion}</p>
            </div>
          </div>
        </div>