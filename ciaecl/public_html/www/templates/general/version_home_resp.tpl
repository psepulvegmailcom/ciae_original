	    <div class="container">
      <div class="row">                   
    <!-- Wrapper for slides -->
   <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <div class="slider-home">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                  <!-- Wrapper for slides -->  
                              
                  <div class="carousel-inner" role="listbox"> 
                  <!--  BLOQUE BANNER -->
                  <!-- START BLOCK : bloque_banner_home -->                                 
                     <div class="item {active}">                      
               		 <img src="imageview.php?image=banner/{imagen}" alt="Banner {titulo}" title="{titulo}" />
                      <div class="carousel-caption">
                        <h3>{titulo} </h3>
                        <p>{bajada}  <a href="{link}" target="_blank" title="Ver Mas">Ver m&aacute;s</a></p>
                      </div>
                    </div>
                   <!-- END BLOCK : bloque_banner_home -->       
                 <!--  BLOQUE BANNER -->                                                                 


                  <!-- Controls -->
             
                  <!--a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a-->
                 <!-- <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>-->
               
                </div>

            </div>
     
           </div>
            <div class="agenda-home">
              <h4>{langSite_home_titulo_agenda}</a></h4> 
              <!-- START BLOCK : bloque_home_eventos -->             
              <div class="evento row">
                <div class="col-md-4 col-xs-6">
                  <div class="month">{mes} </div>
                  <div class="day">{dia} </div>
                </div>
                <div class="col-md-8 col-xs-6 info-agenda-home">
                  <p>                 
                  <a href="index.php?page=view_noticias&amp;id={id_noticia}&langSite={langSiteEspecial_seleccionado}" >{titulo}</a></p>
                  <!--span class="hora">10:20 - 14:40</span-->
                </div>
              </div>   
              <!-- END BLOCK : bloque_home_eventos -->                      
              <a href="index.php?page=view_eventos&langSite={langSiteEspecial_seleccionado}"class="pull-right">VER M&Aacute;S +</a>              
            </div>
                 
      </div>     
    </div>
     
 <div class="row">

        <div class="col-sm-8 blog-main">
  <!-- START BLOCK : bloque_home_noticia_general -->
          <div class="grey-box-home">         
            <h2 class="title-grey-box">{langSite_home_titulo_noticia}</h2>
            <!-- START BLOCK : bloque_home_noticia -->            
            <div class="post-new row">
              <div class="col-md-3">  
              <img src="imageview.php?image=noticias/{imagen}" class="img-responsive" style="width:155px; height:100px"  alt='Imagen noticia {imagen}' />          
              </div>
              <div class="col-md-8">
                <span class="titulo-noticia-home"><a href="index.php?page=view_noticias&langSite={langSiteEspecial_seleccionado}&amp;id={id_noticia}">{titulo}</a> </span>
                <p>{bajada}</p>
              </div>
              <div class="col-md-1">
                <a href="index.php?page=view_noticias&langSite={langSiteEspecial_seleccionado}&amp;id={id_noticia}"class="link-square pull-right">+</a>
              </div>
            </div><!-- /.post-new -->
            <!-- END BLOCK : bloque_home_noticia -->
          </div><!-- /.blog-post -->
			<!-- END BLOCK : bloque_home_noticia_general -->
           <!-- START BLOCK : bloque_home_publicaciones_general -->
          <div class="grey-box-home">
            <h2 class="title-grey-box">{langSite_home_titulo_publicaciones}</h2>
            <!-- START BLOCK : bloque_home_publicaciones -->
            <div class="post-new row">
              <div class="col-md-11">
                <span class="titulo-noticia-home"> {autores}, <a href="index.php?page=view_publicaciones&id_publicaciones={id_publicaciones}&langSite=es ">"{titulo}"</a>  </span>
                </div>
              <div class="col-md-1">
                <a href="index.php?page=view_publicacion&id_publicaciones={id_publicaciones}" class="link-square pull-right">+</a>
              </div>
            </div><!-- /.post-new -->  
             <!-- END BLOCK : bloque_home_publicaciones -->  
    
          </div><!-- /.blog-post -->
		<!-- END BLOCK : bloque_home_publicaciones_general -->
        <div class="banner-home">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->                                
                  <div class="carousel-inner" role="listbox"> 
                  
                  <!--  BLOQUE BANNER PIE-->
                  <!-- START BLOCK : bloque_banner_home_pie -->                                 
                     <div class="item {active}">                      
               		 <a href="{link}" target="_blank"><img src="imageview.php?image=banner/{imagen}" alt="Banner {titulo}" title="{titulo}" /></a>
                    </div>
                   <!-- END BLOCK : bloque_banner_home_pie -->                   
                   
                 <!--  BLOQUE BANNER PIE -->                                                                   
                </div>
            </div>
        </div> <!-- /.banner-home -->
        </div><!-- /.blog-main -->

        
			
          <!-- START BLOCK : bloque_banner_video_youtube -->  
			<!-- INCLUDE BLOCK : www/templates/web/bloque_video_youtube.tpl -->
          <!-- END BLOCK : bloque_banner_video_youtube -->
          
          
          <div class="blue caluga-sidebar">
            <h4>Proyectos</h4>
            <!-- START BLOCK : bloque_home_proyectos -->
            <a href="" class="img-proyecto-link"><img src="www/images_new/proyecto_{i_fila}.png" class="img-responsive"></a>
            <a href="index.php?page=view_proyectos&case=ficha&id={id_proyecto}&langSite=es" class="titulo-proyecto">{proyecto}</a>
            <!-- END BLOCK : bloque_home_proyectos -->

          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

</div>
</div>