<div class="container">
<div class="row">

        <div class="col-sm-8 single-new">
          <div class="grey-box-home">
            <h2 class="big-title">{nombre} {apellido_paterno}  </h2>
            <div class="post-new row item-row">
              <div class="col-md-4">
                <img src="imageview.php?image=personas/{imagen}" style="width:150px;" title=" {nombre} {apellido_paterno}   " class="img-responsive">
                <h2 class="title-grey-box">contacto</h2>
                <!--a href="{url_html}" target="_blank">CV</a-->
                 {email} 
				  <br></br>
                 
        <div>  
				  <a href="https://docs.google.com/viewerng/viewer?url=https://www.ciae.uchile.cl/download.php?file=cv/{archivo_cv}" target="_blank">{CV}</a>  &nbsp;&nbsp; 
				  
				 <a href="index.php?page=view_personas_investigadores&case=fichaBio&id={id_persona}&langSite=es">{Bio}</a>  
	   </div>                
              </div>
              <div class="col-md-8">
              <!-- INCLUDE BLOCK : www/templates/web/general_traducir_en_url.tpl -->
              <h4>Grado </h4>
                <p>{grado}</p>
               <!--h4>Afiliaci&oacute;n  </h4>
                <p>{afiliacion} </p>
                <p>{perfil}</p-->
				 

				<!-- INCLUDE BLOCK : www/templates/web/bloques/orden_bloque.tpl -->
                <br>                
              </div>
            </div><!-- /.post-new -->
          </div><!-- /.grey-box-home -->
        </div><!-- /.blog-main -->

        <div class="col-sm-4 sidebar">
        <!-- INCLUDE BLOCK : www/templates/web/personas/lista_tipo_persona_menu.tpl -->        
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Areas de investigaci&oacute;n</h4>             
              <ul>{listado_areas}</ul>              
          </div> 
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Proyectos </h4>
              <ul>
                <a href="index.php?langSite=es&page=view_proyectos&busqueda_flag=3&busca_Autor_id={id_persona}">Revisar Proyectos de {nombre} {apellido_paterno} </a>

              </ul>
          </div> 
          <div class="blue-nav caluga-sidebar-nav">
              <h4>Publicaciones </h4>
              <ul>
                <a href="index.php?langSite=es&page=view_publicaciones&busqueda_flag=1&busca_Autor_id={id_persona}">Revisar Publicaciones de {nombre} {apellido_paterno}  </a>

              </ul>
          </div>
          
           		
        </div><!-- /.blog-sidebar -->

      </div>
</div>