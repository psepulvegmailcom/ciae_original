	    <div class="container">
      <div class="row">
    <!-- Wrapper for slides -->
   <div class="container">
      <div class="row">
        <div class="col-sm-8 blog-main">
            <!--div class="slider-home"-->
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                  <!--  BLOQUE BANNER -->
                  <!-- START BLOCK : bloque_banner_home -->
                     <div class="item {active}">
               		 <img src="imageview.php?image=banner/{imagen}" alt="Banner {titulo}" title="{titulo}" />
                      <div class="carousel-caption">
                       <style type="text/css">
  							.carousel-caption {
							background: rgba(0,0,0,0.4);
						}
						    .carousel-caption a {
							color: #fff;
						}
						</style>
                        <h5 > <a href="{link}" title="Ver Mas"  >{titulo} </h5>
                        <p >{bajada}  Ver m&aacute;s</a></p>
                      </div>
                    </div>
                   <!-- END BLOCK : bloque_banner_home -->
                 <!--  BLOQUE BANNER -->

                  <!-- Controls -->

                  <!--a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a-->
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>

                </div>

            </div>
       <!--/div-->
           </div>

         <div class="col-sm-4 sidebar">
         <div class="blue caluga-sidebar">
              <h4>Recursos de interés</h4>
              <!-- START BLOCK : bloque_home_eventos -->
              <div class="evento row">

                <div class="col-md-12">
                <!--<div class="col-md-4">
                <img src="imageview.php?image=recursos/{imagen}"  height="62px" width="90px">
              	</div>-->
                <div class="col-md-12" >
      <a href="index.php?page=view_recursos&amp;id={id_recurso}&langSite={langSiteEspecial_seleccionado}" >{titulo}</a>

               </div>
                  <!--span class="hora">10:20 - 14:40</span-->
                </div>
              </div>
              <!-- END BLOCK : bloque_home_eventos -->
              <a href="index.php?page=view_recursos&langSite={langSiteEspecial_seleccionado}"class="pull-right">VER M&Aacute;S +</a>
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


        <div class="banner-home">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">



                </div>
            </div>
        </div> <!-- /.banner-home -->
        </div><!-- /.blog-main -->


    <div class="col-sm-4 sidebar">

          <div class="blue caluga-sidebar" style=" height:500px;  overflow-y:   auto; ">
            <h4>Eventos</h4>
            <!-- START BLOCK : bloque_home_agenda_general -->
            	<!-- START BLOCK : bloque_home_agenda -->
            <div class="evento row">
            <div class="col-md-4 col-xs-6">
                  <div class="month">{mes} </div>
                  <div class="day">{dia} </div>
            </div>
            <div class="col-md-8 col-xs-6 info-agenda-home">
            <a href="index.php?page=view_noticias&amp;id={id_noticia}&langSite={langSiteEspecial_seleccionado}" >{titulo}</a><small>{proyecto}</small></a>
            </div>
            </div>
            	<!-- START BLOCK : bloque_home_agenda -->
            <!-- END BLOCK : bloque_home_agenda_general -->

          </div>
    <div class="col-sm-4 sidebar">
                <div>
                	</br>
                      </br>

                    </br>
                   </br>
                </div>
        </div>
        </div><!-- /.blog-sidebar -->

        <!-- /.blog-sidebar -->

      </div><!-- /.row -->

</div>
</div>
