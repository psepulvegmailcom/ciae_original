<div class="container">
<div class="row">

        <div class="col-sm-8 single-new">
          <div class="grey-box-home">
            <h2 class="big-title">{nombre} {apellido_paterno} </h2>
            <div class="post-new row item-row">
              <div class="col-md-4">
                <img src="imageview.php?image=personas/{imagen}" style="width:150px;" title=" {nombre} {apellido_paterno}  {apellido_materno}" class="img-responsive">
                <h2 class="title-grey-box">contacto</h2>
                <a href="{url_html}" target="_blank">{url}</a>
                 {email} 
              </div>
              <div class="col-md-8">
              <!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->
              <h4>Grado </h4>
                <p>{grado}</p>

                <p>{perfil}</p>
                 
				<!-- INCLUDE BLOCK : www/templates/web/bloques/orden_bloque.tpl -->
                <br>                
              </div>
            </div><!-- /.post-new -->
          </div><!-- /.grey-box-home -->
        </div><!-- /.blog-main -->

        <div class="col-sm-4 sidebar">
        
           
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Proyectos </h4>
              <ul>
                <a href="index.php?langSite=es&page=view_proyectos&busqueda_flag=3&busca_Autor_id={id_persona}">Revisar Proyectos de {nombre} {apellido_paterno} {apellido_materno}</a>

              </ul>
          </div> 
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Publicaciones </h4>
              <ul>
                <a href="index.php?langSite=es&page=view_recursos&busqueda_flag=5&busca_palabra={nombre} {apellido_paterno}">Revisar Publicaciones de {nombre} {apellido_paterno} </a>

              </ul>
          </div>
          <!--div class="blue-nav caluga-sidebar-nav">
              <h4>Actividades </h4>
              <ul>
                <a href="index.php?langSite=es&page=view_noticias&busqueda_flag=2&busca_palabra={apellido_paterno}">Revisar Noticias de {nombre} {apellido_paterno} </a>

              </ul>
          </div-->
          
           		
        </div><!-- /.blog-sidebar -->

      </div>
</div>