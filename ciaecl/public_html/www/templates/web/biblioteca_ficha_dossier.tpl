        <h1 class="title--despliegue text-center">{titulo}  /{tipo}</h1>
  <div class="row mb-5 justify-content-center box--info-despliegue">

          <div class="col-12 col-md-5 col-lg-3 mb-4 mb-md-0 img-libro">
		<!-- START BLOCK : bloque_elemento_imagen3 -->
		  
            <figure>
              <img src="imageview.php?image=recursos/{imagen1}&texto={imagen_bajada}" />
            </figure>
		
		<!-- END BLOCK : bloque_elemento_imagen3 -->				  
          </div>
  
          <div class="col-12 col-md-7 col-lg-6">
            <div class="container--info-despliegue">
              <h4></h4>
              <p><strong>RESUMEN:</strong> {descripcion}</p>
            </div>
          </div>

	  	  	
          <div class="col-12 col-md-4 col-lg-3 mt-4 mt-lg-0 text-center">
            <a href="index.php?page=view_noticias&id={link_externo}" class="btn btn-warning d-block text-uppercase mb-2" target="_blank">Revisar el Dossier</a>
          </div>
	   
  </div>