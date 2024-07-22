        <h1 class="title--despliegue text-center">{titulo}  /{tipo}</h1>
  <div class="row mb-5 justify-content-center box--info-despliegue">

          <div class="col-12 col-md-5 col-lg-3 mb-4 mb-md-0 img-libro">
		<!-- START BLOCK : bloque_elemento_imagen -->
		  
            <figure>
              <img src="imageview.php?image=recursos/{imagen1}&texto={imagen_bajada}" />
            </figure>
		
		<!-- END BLOCK : bloque_elemento_imagen -->				  
          </div>
  
          <div class="col-12 col-md-7 col-lg-6">
            <div class="container--info-despliegue">
              <h4></h4>
              <p><strong>Autor:</strong> {autor}<br />
              {editorial}<br />
				{paginas}<br />
				{isbn}<br />
				  {agno}<br />
				</p>
				 <p> <em>{bajada}</em></p>
              <p><strong>RESUMEN:</strong> {descripcion}</p>
            </div>
          </div>
	  	 <!-- START BLOCK : bloque_elemento_link_externo -->
          <div class="col-12 col-md-4 col-lg-3 mt-4 mt-lg-0 text-center">
            <a href="{link_externo}" class="btn btn-warning d-block text-uppercase mb-2" target="_blank">Link a Editorial</a>
          </div>
	     <!-- END BLOCK : bloque_elemento_link_externo -->
	  	  	 <!-- START BLOCK : bloque_elemento_libro_digital -->
          <div class="col-12 col-md-4 col-lg-3 mt-4 mt-lg-0 text-center">
            <a href="{libro_digital}" class="btn btn-warning d-block text-uppercase mb-2" target="_blank">Versi&oacute;n Digital</a>
          </div>
	     <!-- END BLOCK : bloque_elemento_libro_digital -->
  </div>